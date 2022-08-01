<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Token_model extends CI_Model
{
    
    /**
     * This function used to manage exams
     */
   	protected $table;
    
    function __construct()
    {
        parent::__construct();
        $this->table = 'temp_token';
    }

    function count()
    {
        return $this->db->count_all($this->table);
    }

    function insert($data){
        $data['expire_time'] = date('Y-m-d H:i:s', time()+60*20);
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
    function getOne($token)
    {
        $this->db->select("*")->from($this->table);
        $this->db->where('token', $token);
        $query = $this->db->get();
        return $query->row();
    }

    function delete($row_id)
    {
        return $this->db->delete($this->table, array('id' => $row_id));
        
    }
}

?>
