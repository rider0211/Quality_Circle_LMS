<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Timon
 * Date: 6/27/2018
 * Time: 6:24 PM
 */

class Countries_model extends CI_Model
{
    /**
     * This function used to manage categories
     */
    protected $table;

    function __construct()
    {
        parent::__construct();
        $this->table = 'countries';
    }

    function getList($where = null){

        if($where == null){
            $this->db->order_by('id, name','asc');
			$result = $this->db->get($this->table);		
        }else{
            $result = $this->db->get_where($this->table, $where);
        }
        $res=$result->result_array();
        return $res;
    }
	
	
	function getCountryName($countryId){
        $query = "Select name from countries where id=".$countryId;

        $result = $this->db->query($query);
        $res=$result->result_array();
        return $res[0]['name'];
    }
	
	function getStateName($stateId = NULL){
		if($stateId != ''){
			$query = "Select name from states where id=".$stateId;
	
			$result = $this->db->query($query);
			$res=$result->result_array();
			return $res[0]['name'];
		}else{
			return '';
		}
    }
	
	function getCityName($cityId = NULL){
		if($cityId != ''){
			$query = "Select name from cities where id=".$cityId;
	
			$result = $this->db->query($query);
			$res=$result->result_array();
			return $res[0]['name'];
		}else{
			return '';	
		}
    }

}
