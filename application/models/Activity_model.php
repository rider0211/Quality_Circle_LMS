<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Activity_model extends CI_Model
{
    
    /**
     * This function used to manage categories
     */
   	protected $table;
    
    function __construct()
    {
        parent::__construct();
        $this->table = 'activities';
        $this->user_table = 'users';
    }
    
    function getList($searchcond = array(), $limit = "", $offset = "")
    {
        $this->db->select("a.`created_at`, a.`activity_type`, a.`activity_message`, b.`first_name`, b.`last_name`")->from($this->table." a");
        $this->db->join($this->user_table." b", "a.user_id = b.id", "left");
        
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

        $this->db->order_by('a.`id`', 'DESC');

        if(isset($limit) && isset($offset))
        {
            $this->db->limit($limit, $offset);
        } 
        else if(isset($limit))
        {
            $this->db->limit($limit);
        }

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
        $data['created_at'] = date("Y-m-d H:i:s");
        $rst = $this->db->insert($this->table, $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    
}

?>
