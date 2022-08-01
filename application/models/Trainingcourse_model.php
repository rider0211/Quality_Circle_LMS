<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Timon
 * Date: 6/27/2018
 * Time: 6:24 PM
 */

class Trainingcourse_model extends CI_Model
{
    /**
     * This function used to manage categories
     */
    protected $table;

    function __construct()
    {
        parent::__construct();
        $this->table = 'training_course';		
		$this->course_table = 'course';
		$this->user_table = 'user';
    }

    function getRecent($count = null,$company_id = null){
        $this->db->select("course.*, training_course_time.id time_id, training_course_time.start_day,training_course_time.start_time,training_course_time.end_time");
        $this->db->join("training_course", "training_course.course_id = course.id", "LEFT");
        $this->db->join("training_course_time", "training_course.id = training_course_time.training_course_id", "LEFT");
        $this->db->where("course.course_type ","0");
        // $this->db->where("training_course_time.start_day >", date('Y-m-d'));
        $this->db->where("UNIX_TIMESTAMP(CONCAT(training_course_time.start_day,' ',training_course_time.start_time))  >", time());
        $this->db->limit('3');
        $this->db->order_by('training_course_time.start_day', 'asc');
        $result = $this->db->get("course")->result_array();
     
		foreach($result as $key => $val) {
			##############################get course####################
			
			$this->db->select('course_self_time');
			$this->db->from($this->course_table);
			$this->db->where('id', $val['course_id']);
	
			$queryss = $this->db->get();
			$result[$key]['course_self_time'] = $queryss->row_array()['course_self_time']; 
			##########################################################  
            $instructors = json_decode($val['instructors']);
            if(!empty($instructors)){
                $result[$key]['first_instructor'] = $this->db->where('id',$instructors[0])
                                                             ->where('user_type','instructor')
                                                             ->select('id,email')
                                                             ->get($this->user_table)->row_array();
            }
        }
        return $result;
    }
    function count($searchcond = array())
    {
        $this->db->where('active', 1);
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
        return $this->db->count_all_results($this->table);
    }

    function getAll()
    {
        $result = $this->db->get($this->table);
        return $result->result_array();
    }

    function getAllName()
    {
        $query = $this->db->query('SELECT c.*,uu.email as email, uu.password as password, u.email as fasi from company as c join users as uu on uu.id = c.id left join users as u on u.id = c.responsible_fasi_id');
        $result = $query->result();
        $result_info['data'] = $result;
        return $result_info;
    }

    function getNameList($where = null)
    {
        if ($where == null){
            $query = $this->db->select('id, `name` AS text ')->get($this->table);
        }else{
            $query = $this->db->select('id, `name` AS text ')->get_where($this->table, $where);
        }

        $result_info['data'] = $query->result_array();
        return $result_info;
    }

    function getCompanyidListByFasi($fasi_id){
        $this->db->select("id")->from($this->table)->where("responsible_fasi_id", $fasi_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getCompanyidListStrByFasi($fasi_id){
        $this->db->select("group_concat(id) id")->from($this->table)->where("responsible_fasi_id", $fasi_id);
        $query = $this->db->get();
        return $query->result_array()[0]["id"];
    }


    function update($data, $where = null)
    {
        $data['updated_at'] = date("Y-m-d H:i:s");
        $this->db->where($where);
        $result = $this->db->update($this->table, $data);

        return $result;
    }

    function delete($where = null)
    {
        return $this->db->delete($this->table, $where);
    }

    function insert($data){
        $data['created_at'] = date("Y-m-d H:i:s");
        if (isset($data["logo_image"]) || empty($data["logo_image"])){
            $data["logo_image"] = sprintf('%suser/photo/%s', PATH_UPLOAD, 'default_company.png');
            $data["logo_image"] = str_replace("./", "", $data["logo_image"]);
        }
        $rst = $this->db->insert($this->table, $data);
        return $rst;
    }

    function getList($where = null)
    {

        if ($where == null){
            $result = $this->db->get($this->table);
        }else{
            $result = $this->db->get_where($this->table, $where);
        }
        $res=$result->result_array();
        return $res;
    }

    function getListByID($id = null)
    {
        $query = $this->db->query('SELECT c.*,uu.email as email, uu.password as password, u.email as fasi , uu.share as share , uu.language as language from company as c join users as uu on uu.id = c.id left join users as u on u.id = c.responsible_fasi_id where c.id='.$id);

        $result = $query->result_array();

        return $result;
    }
    function getRow($id = 0)
    {

       $result = $this->db->get_where($this->table, 'id='.$id);

       return $result->row();

    }
    function getListByFasiID($id = null)
    {
        $query = $this->db->query('SELECT c.*,uu.email as email, uu.password as password, u.email as fasi from company as c join users as uu on uu.id = c.id left join users as u on u.id = c.responsible_fasi_id where u.id='.$id);
        $result = $query->result_array();
        return $result;
    }
    function getCompanyForFasi_emerald($fasiId) {
        $this->db->select('id, name');
        $this->db->from($this->table);
        $this->db->where('responsible_fasi_id', $fasiId);
        $query = $this->db->get();
        return $query->result_array();
    }
}
