<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Examassigncompany_model extends CI_Model
{
    
    /**
     * This function used to manage 
     */
   	
    function __construct()
    {
        parent::__construct();
        $this->assign_company_table = 'exam_assign_company';
        $this->assign_fasi_table = 'exam_assign_fasi';
        $this->user_table = 'users';
        $this->company_table = 'company';
        $this->exam_table = 'exam_exam';
        $this->category_table = 'exam_category';
    }
    

    function count($search_cond = array())
    {
        $this->db->select()->from($this->assign_company_table." a");
        $this->db->join($this->user_table." b", 'a.company_id = b.id', 'left');
        $this->db->join($this->company_table." e", 'b.company_id = e.id', 'left');

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

        return $this->db->count_all_results(); 
    }

    /*
     * This function used to display paginated list 
     */    
    function getPagingList($search_cond = array(), $limit = "", $offset = "")
    {
        $this->db->select('a.*, b.user_type, b.`picture`, b.`salutation`, b.`first_name`, b.`last_name`, b.`email`, d.`exam_category_name`, c.`exam_title`, c.`exam_price`, c.`repeat_days`, e.name AS company_name')->from($this->assign_company_table." a");
        $this->db->join($this->user_table." b", 'a.company_id = b.id', 'left');
        $this->db->join($this->company_table." e", 'b.company_id = e.id', 'left');
        $this->db->join($this->exam_table." c", 'a.exam_id = c.id', 'left');
        $this->db->join($this->category_table." d", 'c.exam_category_id = d.id', 'left');
        
        $this->db->where('fasi_email', $search_cond['email']);
        $filtertotal = $this->db->count_all_results('', FALSE);

        $this->db->order_by('`company_id`', 'ASC');
        $this->db->order_by('`id`', 'DESC');
        
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

    
    function getRow($row_id)
    {
        $this->db->select('a.company_id assigner_id, a.*, b.user_type, b.salutation, b.first_name, b.last_name, b.picture, b.email, c.name AS company_name')->from($this->assign_company_table." a");
        $this->db->join($this->user_table." b", 'a.company_id = b.id', 'left');
        $this->db->join($this->company_table." c", 'a.company_id = c.id', 'left');

        $this->db->where('a.`id`', $row_id);
        
        $query=$this->db->get();
        
        return $query->result_array();
        
    }

    function getAssignedList($param)
    {
        $this->db->select('a.id assign_id, a.exam_id AS id, c.exam_category_name, b.exam_title, a.start_date')->from($this->assign_company_table." a");
        $this->db->join($this->exam_table." b", 'a.exam_id = b.id', 'left');
        $this->db->join($this->category_table." c", 'b.exam_category_id = c.id', 'left');

        $this->db->where('a.`company_id`', $param["company_id"]);
        if(!empty($param["category"])) {
            $this->db->like('c.exam_category_name', $param["category"]);
        }
        
        $query=$this->db->get();        
        return $query->result_array();
        
    }

    function selectableList($param)
    {
        $this->db->select('a.id assign_id, a.exam_id AS id, c.exam_category_name, b.exam_title, a.start_date')->from($this->assign_fasi_table." a");
        $this->db->join($this->exam_table." b", 'a.exam_id = b.id', 'left');
        $this->db->join($this->category_table." c", 'b.exam_category_id = c.id', 'left');
        $this->db->join($this->assign_company_table." d", 'a.exam_id = d.exam_id and d.company_id = '.$param["company_id"], 'left');

        $where = "( d.id is NULL OR d.company_id != $param["company_id"] )";
        $this->db->where($where);
        $this->db->where("a.fasi_id", $param["fasi_id"]);
        if(!empty($param["category"]))
            $this->db->like("c.category_name", $param["category"]);

        //print $this->db->get_compiled_select('', false);

        return $this->db->get()->result_array();

    }


   /* function selectedList($param)
    {
        $sql = "SELECT a.id,a.training_title,b.start_date,b.id assign_id
                FROM training_topic a
                    LEFT JOIN training_assign_fasi b ON a.id=b.topic_id
                    LEFT JOIN training_category c ON a.category_id=c.id
                WHERE b.fasi_id=?" . (!empty($param[category])?" AND c.category_name LIKE '%{$param[category]}%'":"");
        return $this->db->query($sql,$param[fasi_id])->result_array();
    }*/

    function assign($cid,$tid,$date,$email) {
        $this->db->set("start_date", $date);
        $this->db->set("created_at", "SYSDATE()", FALSE);
        $this->db->insert($this->assign_company_table, array("company_id"=>$cid,"exam_id"=>$tid,"fasi_email"=>$email));
    }

    function release($id) {
        $this->db->where("id",$id);
        $this->db->delete($this->assign_company_table);
    }

    function update($id,$date) {
        $this->db->set("start_date", $date);
        $this->db->set("updated_at", "SYSDATE()", FALSE);
        $this->db->where("id",$id);
        $this->db->update($this->assign_company_table);
    }

    
}

?>
