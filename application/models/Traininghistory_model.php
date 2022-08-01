<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Traininghistory_model extends CI_Model
{
    
    /**
     * This function used to manage exams
     */
   	protected $table;
    
    function __construct()
    {
        parent::__construct();
        $this->table = 'training_history';
        $this->topic_table = 'training_topic';   
        $this->category_table = 'training_category'; 
        $this->lesson_table = 'training_lesson';    

        $this->user_table = 'users';    
        $this->company_table = 'company';    
        
    }


    function getPassedLessonCount($where = array())
    {
        $this->db->where($where);
        $this->db->where("state", 'pass');
        $this->db->from($this->table);

        return $this->db->count_all_results();
    }

    function checkPrevLessonState($where = array())
    {
        $this->db->where($where);
        $query = $this->db->get($this->table);

        if($query->num_rows() > 0) {
            return true;
        }
        return false;
    }

    function getTimespend($searchcond = array())
    {
        $this->db->select("
        SEC_TO_TIME(
            sum(
                IF (
                    end_at > start_at, TIME_TO_SEC(TIMEDIFF(end_at, start_at)), 0
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

            if ($result[0]->time_spend == null) return 0;

            return $result[0]->time_spend;   
        } 

        return 0;
    }

    function getTopicList($searchcond = array(), $limit = "", $offset = "")
    {
        $this->db->select("a.log_id, e.name AS company_name, d.first_name, d.last_name, c.category_name, min(start_at) start_date, max(end_at) end_date, a.topic_id, b.training_title, b.lesson_count, SUM(IF(state='pass',1,0)) AS passed_count, SUM(IF(state='open',1,0)) AS opened_count")->from($this->table." a");
        $this->db->join($this->topic_table." b", 'a.topic_id=b.id', 'left');
        $this->db->join($this->category_table." c", 'b.category_id=c.id', 'left');
        $this->db->join($this->user_table." d", 'a.user_id=d.id', 'left');
        $this->db->join($this->company_table." e", 'd.company_id=e.id', 'left');


        foreach ($searchcond as $fname=>$val) {
            $this->db->where($fname, $val);    
        }

        $this->db->order_by('a.log_id', 'DESC');
        $this->db->group_by('a.log_id');

        $filtertotal = $this->db->count_all_results('', FALSE);
        if(isset($limit) && isset($offset))
        {
            $this->db->limit($limit, $offset);
        } 
        else if(isset($limit))
        {
            $this->db->limit($limit);
        }

        /*$sql = $this->db->get_compiled_select('', FALSE);
        $fp = fopen("1.txt", "a+");
        fwrite($fp, "\nquery = ".$sql);
        fclose($fp);*/
        
        $query = $this->db->get();

        $result_info = array();
        if ($query->num_rows() > 0) {
            $result_info['total'] = $filtertotal;
            $result_info['filtertotal'] = $filtertotal;
            $result_info['data'] = $query->result_array();


            for($i = 0; $i < sizeof($result_info['data']); $i ++){
                $item = $result_info['data'][$i];
                $diff = $this->dateDifference($item['start_date'], $item['end_date']);
                $item['duration'] = $diff;
                $result_info['data'][$i] = $item;
            }


        } else {
            $result_info['total'] = 0;
            $result_info['filtertotal'] = 0;
            $result_info['data'] = array();
        }

        return $result_info;
    }

    function dateDifference($date_1 , $date_2  )
    {
        $diff = abs(strtotime($date_1) - strtotime($date_2));

        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

        $hour = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days *(60*60*24))/(60*60));
        $min = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days *60*60*24 - $hour * 60*60)/(60));
        $sec = ($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days *60*60*24 - $hour * 60*60 - $min * 60);

        $str = '';

        if($years > 0){
            $str .= $years.' years ';
        }
        if($months > 0){
            $str .= $months.' months ';
        }
        if($days > 0){
            $str .= $days.' days ';
        }
        if($hour > 0){
            $str .= $hour.' hours ';
        }
        if($min > 0){
            $str .= $min.' mins ';
        }
        if($sec > 0){
            $str .= $sec.' secs';
        }

        if ($str == '') $str = '0 secs';
        return $str;

    }

    function getLessonList($searchcond = array(), $limit = "", $offset = "")
    {
        $this->db->select("f.name AS company_name, e.first_name, e.last_name, a.*, c.category_name, b.training_title, b.lesson_count, d.lesson_title, d.lesson_type")->from($this->table." a");
        $this->db->join($this->topic_table." b", 'a.topic_id=b.id', 'left');
        $this->db->join($this->category_table." c", 'b.category_id=c.id', 'left');
        $this->db->join($this->lesson_table." d", 'a.lesson_id=d.id', 'left');

        $this->db->join($this->user_table." e", 'a.user_id=e.id', 'left');
        $this->db->join($this->company_table." f", 'e.company_id=f.id', 'left');

        foreach ($searchcond as $fname=>$val) {
            $this->db->where($fname, $val);    
        }

        $this->db->order_by('a.`lesson_id`', 'ASC');
        
        $filtertotal = $this->db->count_all_results('', FALSE);
        if(isset($limit) && isset($offset))
        {
            $this->db->limit($limit, $offset);
        } 
        else if(isset($limit))
        {
            $this->db->limit($limit);
        }

        /*$sql = $this->db->get_compiled_select('', FALSE);
        $fp = fopen("1.txt", "a+");
        fwrite($fp, "\nquery = ".$sql);
        fclose($fp);*/
        
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
    
    function getFailedLastLesson($user_id = '', $topic_id = '', $lesson_count = 0)
    {

        /*$sql = "select log_id, pass_count + 1 last_failed_lesson_num from
                (
                    select
                    log_id, sum(if(state = 'pass', 1, 0)) pass_count
                    from training_history
                    where user_id = $user_id  and topic_id = $topic_id
                    GROUP BY log_id
                ) a
                where a.pass_count != $lesson_count
                ";*/

        $sql = "select log_id, min(lesson_num) unpass_count
                from training_history
                  where user_id = $user_id  and topic_id = $topic_id and state = 'open'
                  GROUP BY log_id
                ";

        $query=$this->db->query($sql);
        return $query->row_array();
    }

    function insert($history_data)
    {   

        $this->db->trans_start();
        
        $history_data["start_at"] = date("Y-m-d H:i:s");
        $history_data["end_at"] = date("Y-m-d H:i:s");
        $history_data["created_at"] = date("Y-m-d H:i:s");

        $this->db->insert($this->table, $history_data);

        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;

    }

    function selectRow($where_cond=array())
    {
        $this->db->select()->from($this->table);
        foreach ($where_cond as $key => $value) {
            $this->db->where($key, $value);    
        }

        $query=$this->db->get();
        return $query->row_array();
    }

    function update($data, $row_id)
    {
        $data['updated_at'] = date("Y-m-d H:i:s");        
        $this->db->where('id', $row_id);
        $result = $this->db->update($this->table, $data);

        return $result;
    }

    function getEmployeeCountPerYear($year = 0){

        $sql = "select * FROM
                (
                    select user_id, min(if(state = 'pass', 1, 0)) passed from training_history
                    WHERE year(created_at) = $year
                    GROUP BY log_id
                ) a
                where a.passed = 1
                ";

        return count($this->db->query($sql)->result_array());

    }

    
}

?>
