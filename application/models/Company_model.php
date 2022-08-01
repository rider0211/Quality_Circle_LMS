<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Timon
 * Date: 6/27/2018
 * Time: 6:24 PM
 */

class Company_model extends CI_Model
{
    /**
     * This function used to manage categories
     */
    protected $table;

    function __construct()
    {
        parent::__construct();
        $this->table = 'company';
    }
    function getByUrl($url = null){
        if(isset($url)){
            $this->db->where('is_deleted',0)->where('active',1);
            $this->db->where('url',$url);
            $this->db->select("*"); 
            return $this->db->get($this->table)->row_array();
        }
        return false;
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


    function update($data, $where = null)
    {
        //$data['updated_at'] = date("Y-m-d H:i:s");
        $this->db->where($where);
        $result = $this->db->update($this->table, $data);

        return $result;
    }

    function delete($where = null)
    {
        return $this->db->delete($this->table, $where);
    }

    function insert($data){
        $data['reg_date'] = date("Y-m-d H:i:s");

        if (isset($data["logo_path"]) || empty($data["logo_path"])){
            //$data[logo_path] = sprintf('%suser/photo/%s', PATH_UPLOAD, 'default_company.png');
            $data["logo_path"] = str_replace("./", "", $data["logo_path"]);
        }

        $rst = $this->db->insert($this->table, $data);
        if($rst){
            $rst = $this->db->insert_id();
        }
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
        $query = $this->db->query("select * from company where id=$id");

        $result = $query->result_array();

        return $result;
    }
    function getRow($id = 0)
    {

       $result = $this->db->get_where($this->table, 'id='.$id);

       return $result->row();

    }

}
