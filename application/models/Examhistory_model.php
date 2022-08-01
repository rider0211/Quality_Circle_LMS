<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Examhistory_model extends CI_Model
{
    
    /**
     * This function used to manage exams
     */
   	protected $table;
    
    function __construct()
    {
        parent::__construct();
        $this->table = 'exam_history';
        $this->exam_table = 'exam';
        $this->exam_category_table = 'exam_category';    
        $this->quiz_table = 'exam_quiz';
        $this->user_table = 'user';
        $this->company_user_table = 'company_user';

    }


    function getTimespend($searchcond = array())
    {
        //$this->db->select("TIMEDIFF(max(exam_end_at),min(exam_start_at)) as time_spend")->from($this->table);
        $this->db->select("
        SEC_TO_TIME(
            sum(
                IF (
                    exam_end_at > exam_start_at, TIME_TO_SEC(TIMEDIFF(exam_end_at, exam_start_at)), 0
                )
            )
        ) as time_spend")->from($this->table);

        foreach ($searchcond as $fname=>$val) {
            if(is_array($val)) {
                if(count($val)>0)
                    $this->db->where_in($fname, $val);    
                else
                    $this->db->where($fname, 0);    
            } else {
                $this->db->where($fname, $val);        
            }
        }

        $query = $this->db->get();

        if ($query->num_rows() > 0){
            $result = $query->result();

            return $result[0]->time_spend;   
        } 

        return 0;
    }

    function getSccStatus($searchcond = array())
    {
        $this->db->select("SUBSTR(MONTHNAME(exam_start_at), 1, 3) monthname, count(*) count, month(exam_start_at) month")->from($this->table);
		
        foreach ($searchcond as $fname=>$val) {
            if(is_array($val)) {
                if(count($val)>0)
                    $this->db->where_in($fname, $val);
                else
                    $this->db->where($fname, 0);
            } else {
                $this->db->where($fname, $val);
            }
        }
		
        $this->db->where('exam_type', 'SCC');
		
        $this->db->group_by('MONTHNAME(exam_start_at)');
        $this->db->order_by('month(exam_start_at)', 'ASC');
        
        $data = $this->db->get()->result();
        $monthname = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
        foreach($monthname as $str) $result[$str] = 0;
        
        foreach($data as $key => $value){
            $result[$value->monthname] = $value->count;
        }
        return $result;
    }

    function getTopicStatus($searchcond = array())
    {
        $this->db->select("a.user_id, c.exam_category_name cat_name, count(*) count")->from($this->table. " a");
        $this->db->join($this->exam_table." b" , "a.exam_id = b.id", "left");
        $this->db->join($this->exam_category_table." c" , "b.exam_category_id = c.id", "left");

        foreach ($searchcond as $fname=>$val) {
            if(is_array($val)) {
                if(count($val)>0)
                    $this->db->where_in($fname, $val);
                else
                    $this->db->where($fname, 0);
            } else {
                $this->db->where($fname, $val);
            }
        }

        $this->db->group_by('cat_name');
        $data = $this->db->get()->result();

        $result["data"] = $data;
        $total_count = 0;
        foreach($data as $item) $total_count += $item->count;
        $result["total_count"] = $total_count;

        return $result;
    }

    function getAmount()
    {
        $this->db->select("SUM(b.exam_price) AS amount")->from($this->table." a");
        $this->db->join($this->exam_table." b", 'a.exam_id = b.id', 'left');

        $this->db->where("YEAR(a.exam_start_at)=YEAR(CURRENT_DATE()) AND MONTH(a.exam_start_at)=MONTH(CURRENT_DATE())");    

        $query = $this->db->get();
        $result = $query->result_array();
        if(count($result)>0)
            return $result[0]["amount"];
        else 
            return 0;
    }



    function getList($searchcond = array(), $limit = "", $offset = "")
    {
        $this->db->select("a.id,b.title,b.type,a.exam_status,a.sign,CONCAT(c.first_name, ' ', c.last_name) AS fullname,c.email,a.exam_start_at,a.exam_end_at, a.mark total_marks")->from($this->table." a");
        $this->db->join($this->exam_table." b", "a.exam_id = b.id ", 'left');
        $this->db->join($this->user_table." c", 'a.user_id = c.id', 'left');
        // $this->db->join("exam_quiz e", 'a.exam_id = e.exam_id', 'left');
        // $this->db->join("exam_quiz_history f", 'e.id = f.quiz_id and c.id = f.user_id', 'left');

        foreach ($searchcond as $fname=>$val) {
            $this->db->where($fname, $val);    
        }
        $this->db->where("a.exam_end_at != ''");        
        $this->db->group_by('a.id');        
        
        //$this->db->order_by('a.`id`', 'DESC');

        $filtertotal = $this->db->count_all_results('', FALSE);
        if(isset($limit) && isset($offset))
        {
            $this->db->limit($limit, $offset);
        } 
        else if(isset($limit))
        {
            $this->db->limit($limit);
        }
        $this->db->order_by('a.exam_start_at', 'DESC'); 
        $query = $this->db->get();
        // echo $this->db->last_query();
        // die;

        $result_info = array();
        if ($query->num_rows() > 0) {
            $result_info['total'] = $filtertotal;
            $result_info['filtertotal'] = $filtertotal;
            $result_info['data'] = $query->result_array();
        } else {
            $result_info['total'] = 0;
            $result_info['filtertotal'] = 0;
            $result_info['data'] = array();
        }

        return $result_info;
    }
    
    function getRow($row_id)
    {
        $this->db->select("a.*, b.exam_type, b.quiz_count, b.max_count, b.repeat_days")->from($this->table." a");
        $this->db->join($this->exam_table." b","a.exam_id=b.id","left");

        $this->db->where('a.id',$row_id);
        
        $query=$this->db->get();
        $result=$query->result_array();
        return $result;
    }

    function passExam($id){
        $this->db->set('exam_status', 'pass');
        $this->db->set('updated_at', date("Y-m-d H:i:s"));
        $this->db->where('id', $id);
        return $this->db->update($this->table);
    }

    function insert($data){
        $data['created_at'] = date("Y-m-d H:i:s");
        $data['exam_start_at'] = date("Y-m-d H:i:s");
        $rst = $this->db->insert($this->table, $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function update($data, $row_id)
    {
        $data['updated_at'] = date("Y-m-d H:i:s");        
        $this->db->where('id', $row_id);
        $result = $this->db->update($this->table, $data);

        return $result;
    }

    function delete($row_id)
    {
        //$this->db->where('absid', $absid);
        //$sql = $this->db->get_compiled_delete($this->table);
        //print $sql;
        return $this->db->delete($this->table, array('id' => $row_id));
        
    }




    function getAccountList($searchcond = array(), $limit = "", $offset = "")
    {
        $this->db->select("e.name AS company_name, d.first_name, d.last_name, b.exam_type, b.exam_title, b.exam_price, a.exam_start_at, a.exam_end_at, a.exam_status, a.account_status, a.id, CONCAT(c.salutation,' ',c.first_name,' ',c.last_name) AS fasi_name")->from($this->table." a");
        $this->db->join($this->exam_table." b", 'a.exam_id = b.id', 'left');
        $this->db->join($this->user_table." d", 'a.user_id = d.id', 'left');
        $this->db->join($this->company_table." e", 'd.company_id = e.id', 'left');
        $this->db->join($this->user_table." c", 'e.responsible_fasi_id = c.id', 'left');

        foreach ($searchcond as $fname=>$val) {
            $this->db->where($fname, $val);    
        }

        $this->db->order_by('a.`id`', 'DESC');

        $filtertotal = $this->db->count_all_results('', FALSE);
        if(isset($limit) && isset($offset))
        {
            $this->db->limit($limit, $offset);
        } 
        else if(isset($limit))
        {
            $this->db->limit($limit);
        }

        $query = $this->db->get();

        $result_info = array();
        if ($query->num_rows() > 0) {
            $result_info['total'] = $filtertotal;
            $result_info['filtertotal'] = $filtertotal;
            $result_info['data'] = $query->result_array();
        } else {
            $result_info['total'] = 0;
            $result_info['filtertotal'] = 0;
            $result_info['data'] = array();
        }

        return $result_info;
    }
    function updateaccountstatus($row_id)
    {
        $data["account_status"] = 'paid';      
        $this->db->where('id', $row_id);
        $result = $this->db->update($this->table, $data);

        return $result;
    }

    function getExamInfofrhid($history_id){
        $this->db->select("b.exam_title, c.exam_category_name category")->from($this->table." a");
        $this->db->join($this->exam_table." b", 'a.exam_id = b.id', 'left');
        $this->db->join($this->exam_category_table." c", 'b.exam_category_id = c.id', 'left');
        $this->db->where('a.id', $history_id);
        return $this->db->get()->row_array();
    }

    function count($searchcond = array())
    {
        foreach ($searchcond as $fname=>$val) {
            if(is_array($val)) {
                if(count($val)>0)
                    $this->db->where_in($fname, $val);
                else
                    $this->db->where($fname, 0);
            } else {
                $this->db->where($fname, $val);
            }
        }
        $this->db->from($this->table." a");
        return $this->db->count_all_results();
    }
    function getQuizNumber($id)
    {
        $this->db->select("count(*) quiz_num")->from($this->quiz_table." a");
        $this->db->where('exam_id = (select exam_id from exam_history where id = '.$id.')');

        $query = $this->db->get();

        return $query->row_array();
    }
    function getExamUser($id)
    {
        $this->db->select("CONCAT(b.first_name, ' ', b.last_name) AS fullname,a.*")->from($this->table." a");
        $this->db->join($this->user_table." b", 'a.user_id = b.id', 'left');
        $this->db->where('a.exam_id = (select exam_id from exam_history where id = '.$id.')');

        $query = $this->db->get();

        return $query->result();
    }
    function getExamHistory($id)
    {
        $this->db->select("b.*")->from($this->quiz_table." a");
        $this->db->join("exam_quiz_history b", 'a.id = b.quiz_id', 'left');
        $this->db->where('a.exam_id = (select exam_id from exam_history where id = '.$id.')');

        $this->db->order_by('b.user_id, b.quiz_id ASC');
        $query = $this->db->get();

        return $query->result();
    }
    function getExamMarker($id)
    {
        $this->db->select("(select CONCAT(a.first_name, ' ', a.last_name) from user a where a.id = b.marker1_id) marker1,(select CONCAT(a.first_name, ' ', a.last_name) from user a where a.id = b.marker2_id) marker2")->from($this->exam_table." b");
        $this->db->where('b.id = (select exam_id from exam_history where id = '.$id.')');

        $query = $this->db->get();

        return $query->row();
    }
    function getExamInfo($id)
    {
        $this->db->select("a.*")->from($this->exam_table." a");
        $this->db->where('a.id = (select exam_id from exam_history where id = '.$id.')');

        $query = $this->db->get();

        return $query->row();
    }
    function getExamQuizInfo($id)
    {
        $this->db->select("a.*")->from($this->quiz_table." a");
        $this->db->where('a.exam_id = (select exam_id from exam_history where id = '.$id.')');

        $query = $this->db->get();

        return $query->result();
    }
    function getExamFeedback($id)
    {
        $this->db->select("a.*")->from("exam_feedback a");
        $this->db->where('a.exam_id = (select exam_id from exam_history where id = '.$id.') and a.user_id = (select user_id from exam_history where id = '.$id.')');

        $query = $this->db->get();

        return $query->row();
    }
	function getExamhistoryData($id)
    {
        $this->db->select("*")->from("exam_history")->where("id = '".$id."'");
        $query = $this->db->get();
        return $query->row();
    }
	function deleteFeedback($exam_id,$user_id)
    {
       $this->db->delete('exam_feedback', array('exam_id' => $exam_id,'user_id' => $user_id)); 
	   return true;
    }
    function change_mark($mark,$type,$id){
        if ($type == 1){
            $this->db->set('mark1', $mark);
        }else if ($type == 2){
            $this->db->set('mark2', $mark);
        }
        $this->db->where('id', $id);
        return $this->db->update("exam_quiz_history");
    }
    function getSign($filter){
        $this->db->where("user_id", $filter["user_id"]);
        $this->db->where("course_id", $filter["course_id"]);
        $this->db->join("chapter","chapter.exam_id = exam_history.exam_id");
        $this->db->select("exam_history.*");
        return $this->db->get("exam_history")->row_array();
    }
    
}

?>
