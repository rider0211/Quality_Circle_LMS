<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Location_model extends CI_Model
{
    
    /**
     * This function used to manage categories
     */
   	protected $table;
    
    function __construct()
    {
        parent::__construct();
        $this->table = 'training_course_time';
		$countryTable = 'countries';
    }

    function getTrainingCourseLocation()
    {
        $this->db->select("id, location, is_deleted")->from($this->table);
        $this->db->group_by('location');
        $this->db->order_by('`id`', 'ASC');

        $query = $this->db->get();

        return $query->result_array();
    }

    function getTrainingCourseLocationList()
    {
        $this->db->select("id, location, is_deleted")->from($this->table);
        $this->db->where('is_deleted', 0);
        $this->db->group_by('location');
        $this->db->order_by('`location`', 'ASC');

        $query = $this->db->get();

        return $query->result_array();
    }
	
	function getAllCounties(){
        $this->db->select("id, name")->from('countries');
        $this->db->order_by('sort, name', 'ASC');

        $query = $this->db->get();
        return $query->result_array();
    }
	
	function getStateByCountryId($countryId=NULL){
        $this->db->select("id, name")->from('states');        
        $this->db->where('country_id', $countryId);
        $this->db->order_by('name', 'ASC');

        $query = $this->db->get();

        return $query->result_array();
    }
	
	function getCityByStateId($cityId=NULL){
        $this->db->select("id, name")->from('cities');        
        $this->db->where('state_id', $cityId);
        $this->db->order_by('name', 'ASC');

        $query = $this->db->get();
		
        return $query->result_array();
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
	
	function getCountryNameById($countryId){
		$this->db->select("name")->from('countries');        
        $this->db->where('id', $countryId);
        $query = $this->db->get();
        return $query->result_array()[0]['name'];
	}
	
	function getStateNameById($stateId){
		$this->db->select("name")->from('states');        
        $this->db->where('id', $stateId);
        $query = $this->db->get();
        return $query->result_array()[0]['name'];
	}
	
	function getCityNameById($cityId){
		$this->db->select("name")->from('cities');        
        $this->db->where('id', $cityId);
        $query = $this->db->get();
        return $query->result_array()[0]['name'];
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
        //$data['updated_at'] = date("Y-m-d H:i:s");
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
}

?>
