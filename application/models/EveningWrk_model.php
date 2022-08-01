<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class EveningWrk_model extends CI_Model
{
    
    /**
     * This function used to manage categories
     */
   	protected $table;
    
    function __construct()
    {
        parent::__construct();
        $this->table = 'evening_wrk_excercise';
    }

    function getListByCompanyID($company_id)
    {
        $this->db->select("*")->from($this->table);
        $this->db->where('company_id', $company_id);
        $this->db->order_by('`id`', 'ASC');

        $query = $this->db->get();

        return $query->result_array();
    }
	
	function getListByAll(){
        $this->db->select("*")->from($this->table);
        $this->db->order_by('`id`', 'ASC');

        $query = $this->db->get();

        return $query->result_array();
    }
	
	function getListAllByStudent(){
		$student_id = $this->session->userdata('user_id');
		$this->db->select("*")->from($this->table);
		$this->db->where('student_id',$student_id);
        $this->db->order_by('`id`', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
	
	
	function getNameByStudentId($row_id){		
        $this->db->select("first_name, last_name")->from('user')->where('id',$row_id);
        $query=$this->db->get();
        $result = $query->result_array();
		
		$fname = $lname = '';
		if(isset($result[0]['first_name'])){
			$fname = $result[0]['first_name'];
		}
		if(isset($result[0]['last_name'])){
			$lname = $result[0]['last_name'];
		}
		return $fname.' '.$lname;
    }
   
    
    function getList($searchcond = array(), $limit = "", $offset = "")
    {
        $this->db->select()->from($this->table);
        
        $this->db->order_by('`id`', 'DESC');

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

    function getCategoryList()
    {
        $this->db->select("id, category_name")->from($this->table);
        $this->db->where('status', 1);
        $this->db->order_by('`id`', 'ASC');

        $query = $this->db->get();

        return $query->result_array();
    }

    function getList4Select2($q='')
    {
        $this->db->select("id, category_name AS text")->from($this->table);
        if(!empty($q))
        {
            $this->db->like('category_name', $q);
        }
        $this->db->where('status', 1);
        $this->db->order_by('`id`', 'ASC');

        $query = $this->db->get();

        return $query->result_array();
    }

    function getRow($row_id)
    {
        $this->db->select()->from($this->table)->where('id',$row_id);
        $query=$this->db->get();
        return $query->result_array();
    }

    function insert($data){
        $rst = $this->db->insert($this->table, $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function update($data, $row_id)
    {
        $this->db->where('id', $row_id);
        $result = $this->db->update($this->table, $data);

        return $result;
    }

    function delete($row_id)
    {
        return $this->db->delete($this->table, array('id' => $row_id));
        
    }
}

?>
