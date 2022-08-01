<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Certification_model extends CI_Model
{
    
    /**
     * This function used to manage cetification
     */
   	protected $table;
    
    function __construct()
    {
        parent::__construct();
        $this->table = 'certification';
        $this->user_table = 'users'; 
        $this->company_table = 'company'; 
        $this->exam_table = 'exam_exam';
        $this->exam_history_table = 'exam_history';  
        $this->setting_cert_table = 'setting_certificate';  
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
        $this->db->join($this->user_table." b", 'a.user_id = b.id', 'left');
        $this->db->join($this->company_table." f", 'b.company_id = f.id', 'left');
        return $this->db->count_all_results(); 
    }
    
    function getList($searchcond = array(), $limit = "", $offset = "")
    {
        $company_id = $this->session->get_userdata()['company_id'];
        $this->db->select("a.*, f.name AS company_name, b.first_name, b.last_name, b.birthday, b.email, d.`exam_title`, d.cert_temp_id, e.title AS cert_title")->from($this->table." a");
        $this->db->join($this->user_table." b", 'a.user_id = b.id', 'left');
        $this->db->join($this->company_table." f", 'b.company_id = f.id', 'left');
        $this->db->join($this->exam_history_table." c", 'a.exam_history_id = c.id', 'left');
        $this->db->join($this->exam_table." d", 'c.exam_id = d.id', 'left');
        $this->db->join($this->setting_cert_table." e", 'd.cert_temp_id = e.id', 'left');
        if ($company_id != 0){
            $this->db->where('e.company_id', $company_id);
        }

        foreach ($searchcond as $fname=>$val) {
            if(is_array($val)) {
                if(count($val) > 0)
                    $this->db->where_in($fname, $val);    
                else
                    $this->db->where($fname, 0);    
            } else {
                $this->db->where($fname, $val);        
            }
        }

        $this->db->where('delete_flag', 0);    

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

    
    function getRow($row_id)
    {
        $this->db->select("a.*, year(a.created_at) year, SUBSTR(MONTHNAME(a.created_at), 1, 3) month, day(a.created_at) day, b.first_name, b.last_name, b.birthday, d.`exam_title`, d.`cert_temp_id`, d.quiz_count, e.title AS cert_title, c.correct_count, f.name company_name")->from($this->table." a");
        $this->db->join($this->user_table." b", 'a.user_id = b.id', 'left');
        $this->db->join($this->exam_history_table." c", 'a.exam_history_id = c.id', 'left');
        $this->db->join($this->exam_table." d", 'c.exam_id = d.id', 'left');
        $this->db->join($this->setting_cert_table." e", 'd.cert_temp_id = e.id', 'left');
        $this->db->join('company f', 'b.company_id = f.id', 'left');

        $this->db->where('a.id',$row_id);
        
        $query=$this->db->get();
        $result=$query->result_array();
        return $result;
    }

    function insert($data){
        $data['created_at'] = date("Y-m-d H:i:s");

        $this->db->select("MAX(id) as max_id")->from($this->table);
        $query=$this->db->get();
        $last_id=$query->row()->max_id;
        $data['cn_num'] = intval($last_id) + 1001;

        $rst = $this->db->insert($this->table, $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function update($data, $row_id)
    {
        $data['updated_at'] = date("Y-m-d H:i:s");
        $data['check_status'] = $data['status'];
        unset($data['status']);
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


    function getRowByUserid($id)
    {
        $this->db->select("*")->from($this->table);
        $this->db->where('user_id',$id);

        $query=$this->db->get();
        $result=$query->result_array();
        return $result;
    }

    function getUserPerYear(){

        $sql = "select year, count(*) certification_count FROM (
                    select year(created_at) year from certification
                    where delete_flag = 0
                    GROUP BY year, user_id
                ) a
                GROUP BY a.year";

        return $this->db->query($sql)->result_array();
    }

    function getRowByCompanyid($id)
    {
        $this->db->select("*")->from("setting_certificate");
        $this->db->where('company_id',$id);

        $query=$this->db->get();
        $result=$query->result_array();
        return $result;
    }

    function getRowById($row_id)
    {
        $this->db->select("a.content")->from($this->setting_cert_table." a");

        $this->db->where('a.id',$row_id);

        $query=$this->db->get();
        $result=$query->row_array();
        return $result;
    }

    function getCompanyByUserId($user_id)
    {
        $query ="SELECT * 
                   FROM company 
                  WHERE id IN (SELECT company_id FROM user WHERE id = $user_id)";

        $result = $this->db->query($query);
        $res=$result->result_array();
        return $res;
    }

    function getLearnerByUserId($user_id)
    {
        $query ="SELECT concat(first_name, ' ', last_name) AS name
                   FROM user 
                  WHERE id = $user_id";

        $result = $this->db->query($query);
        $res=$result->result_array();
        return $res;
    }

    function getCourseById($course_id)
    {
        $query ="SELECT a.*,b.name as category
                   FROM course a
                   LEFT JOIN category b ON b.id = a.category_id
                  WHERE a.id = $course_id";

        $result = $this->db->query($query);
        $res=$result->result_array();
        return $res;
    }

    function getExamHistory($user_id, $exam_id)
    {
        $query ="SELECT a.*,b.*
                   FROM exam_history a, exam b
                  WHERE a.user_id = $user_id
                  AND a.exam_id = $exam_id
                  AND a.exam_id = b.id";

        $result = $this->db->query($query);
        $res=$result->result_array();
        return $res;
    }

    function getCourseStatusById($course_id, $user_id)
    {
        $query ="SELECT *
                   FROM course_status 
                  WHERE course_id = $course_id
                    AND user_id = $user_id";

        $result = $this->db->query($query);
        $res=$result->result_array();
        return $res;
    }

    function getCourseByExamId($exam_id)
    {
        $query ="SELECT course_id
                   FROM chapter 
                  WHERE exam_id = $exam_id";

        $result = $this->db->query($query);
        $res=$result->result_array();
        return $res;
    }

    function getCompanyAdmin($company_id)
    {
        $query ="SELECT * 
                   FROM user 
                  WHERE company_id = $company_id
                    AND user_type = 'Admin'";

        $result = $this->db->query($query);
        $res=$result->result_array();
        return $res;
    }
}

?>
