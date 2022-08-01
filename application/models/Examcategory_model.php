<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Examcategory_model extends CI_Model
{
    
    /**
     * This function used to manage examcategories
     */
   	protected $table;
    
    function __construct()
    {
        parent::__construct();
        $this->table = 'exam_category';
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

    function getCategoryList($cname='')
    {
        $this->db->select("id, exam_category_name AS text")->from($this->table);
        if(!empty($cname)) {
            $this->db->like('exam_category_name', $cname, 'left');    
        }
        $this->db->where('status', 1);
        $this->db->order_by('`id`', 'ASC');

        $query = $this->db->get();

        return $query->result_array();
    }

    function getList4Select2($q='')
    {
        $this->db->select("id, exam_category_name AS text")->from($this->table);
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
        $result=$query->result_array();
        return $result;
    }

    function active($id){
        $this->db->set('status', 1);
        $this->db->set('updated_at', date("Y-m-d H:i:s"));
        $this->db->where('id', $id);
        return $this->db->update($this->table);
    }

    function inactive($id){
        $this->db->set('status', 0);
        $this->db->set('updated_at', date("Y-m-d H:i:s"));
        $this->db->where('id', $id);
        return $this->db->update($this->table);
    }

    function insert($data){
        $data['created_at'] = date("Y-m-d H:i:s");
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
}

?>
