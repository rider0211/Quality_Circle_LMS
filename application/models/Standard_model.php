<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Standard_model extends CI_Model{
    
    /**
     * This function used to manage categories
     */
   	protected $table;
    
    function __construct()
    {
        parent::__construct();
        $this->table = 'category_standard';
    }

     function getStandardListByCategoryId($category_id)
    {
        $this->db->select("id, name")->from($this->table);
        $this->db->where('category_id', $category_id);
        $this->db->order_by('`id`', 'ASC');

        $query = $this->db->get();

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
        return $this->db->delete($this->table, array('id' => $row_id));        
    }
	function getRow($row_id = '')
    {
        $this->db->select()->from($this->table)->where('id',$row_id);
        $query=$this->db->get();
        return $query->result_array();
    }
    function getStrStandard($filter){
        $standardStr = "";
        foreach(explode(",", $filter) as $index=>$id){
            $standardStr = $standardStr . ", " . $this->db->select()->from($this->table)->where('id',$id)->get()->row_array()["name"];
        }
        return $standardStr;
    }
}
