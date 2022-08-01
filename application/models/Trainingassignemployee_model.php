<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Trainingassignemployee_model extends CI_Model
{
    
    /**
     * This function used to manage categories
     */
   	
    function __construct()
    {
        parent::__construct();
        $this->assign_employee_table = 'training_assign_employee';
        $this->assign_company_table = 'training_assign_company';
        $this->user_table = 'users';
        $this->company_table = 'company';
        $this->topic_table = 'training_topic';
        $this->category_table = 'training_category';
    }


    function count($search_cond = array())
    {
        $this->db->select()->from($this->assign_employee_table." a");
        $this->db->join($this->user_table." b", 'a.employee_id = b.id', 'left');
        $this->db->join($this->company_table." e", 'b.company_id = e.id', 'left');

        foreach ($search_cond as $fname=>$val) {
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
        $this->db->select('a.*, b.`picture`, b.`salutation`, b.`first_name`, b.`last_name`, b.`email`, d.`category_name`, c.`training_title`, c.`price`, c.`repeat_days`, e.name AS company_name')->from($this->assign_employee_table." a");
        $this->db->join($this->user_table." b", 'a.employee_id = b.id', 'left');
        $this->db->join($this->company_table." e", 'b.company_id = e.id', 'left');
        $this->db->join($this->topic_table." c", 'a.topic_id = c.id', 'left');
        $this->db->join($this->category_table." d", 'c.category_id = d.id', 'left');
        
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
        $this->db->select('a.employee_id assigner_id, a.*, b.salutation, b.first_name, b.last_name, b.picture, b.email, b.user_type, c.name AS company_name')->from($this->assign_employee_table." a");
        $this->db->join($this->user_table." b", 'a.employee_id = b.id', 'left');
        $this->db->join($this->company_table." c", 'a.employee_id = c.id', 'left');

        $this->db->where('a.`id`', $row_id);
        
        $query=$this->db->get();
        
        return $query->result_array();
        
    }

    function saveTrainingassign($data){
        $data['created_at'] = date("Y-m-d H:i:s");

        $this->db->trans_start();
        
        $rst = $this->db->insert($this->assign_employee_table, $data);
        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();
        
        return $insert_id;
    }

    function updateTrainingassign($data, $row_id)
    {
        $data['updated_at'] = date("Y-m-d H:i:s");        
        $this->db->where('id', $row_id);
        $result = $this->db->update($this->assign_employee_table, $data);

        return $result;
    }

    function deleteTrainingassign($row_id)
    {
        return $this->db->delete($this->assign_employee_table, array('id' => $row_id));
    }


    function getAssignedList($param)
    {
        $this->db->select('a.id AS assign_id, a.topic_id AS id, c.category_name, b.training_title, a.start_date, b.category_id category_id ')->from($this->assign_employee_table." a");
        $this->db->join($this->topic_table." b", 'a.topic_id = b.id', 'left');
        $this->db->join($this->category_table." c", 'b.category_id = c.id', 'left');

        $this->db->where('a.`employee_id`', $param["employee_id"]);
        if (isset($param["category_id"]) && isset($param["category_id"]))
            $this->db->where('b.category_id', $param["category_id"]);
        if(!empty($param["category"])) {
            $this->db->like('c.category_name', $param["category"]);
        }

        $query=$this->db->get();
        
        return $query->result_array();
        
    }

    
    function selectableList($param)
    {
        $this->db->select('a.id assign_id, a.topic_id AS id, c.category_name, b.training_title, a.start_date')->from($this->assign_company_table." a");
        $this->db->join($this->topic_table." b", 'a.topic_id = b.id', 'left');
        $this->db->join($this->category_table." c", 'b.category_id = c.id', 'left');
        $this->db->join($this->assign_employee_table." d", 'a.topic_id = d.topic_id', 'left');

        $where = "( d.id is NULL OR d.employee_id != $param["employee_id"] )";
        $this->db->where($where);
        $this->db->where("a.company_id", $param["company_id"]);
        if(!empty($param["category"]))
            $this->db->like("c.category_name", $param["category"]);

        return $this->db->get()->result_array();

    }


   /* function selectedList($param)
    {
        $sql = "SELECT a.id,a.training_title,b.start_date,b.id assign_id
                FROM training_topic a
                    LEFT JOIN training_assign_fasi b ON a.id=b.topic_id
                    LEFT JOIN training_category c ON a.category_id=c.id
                WHERE b.fasi_id=?" . (!empty($param["category"])?" AND c.category_name LIKE '%{$param["category"]}%'":"");
        return $this->db->query($sql,$param[fasi_id])->result_array();
    }*/

    function assign($eid,$tid,$date,$email) {
        $this->db->set("start_date","SYSDATE()",FALSE);
        $this->db->set("created_at", "SYSDATE()", FALSE);
        $this->db->insert($this->assign_employee_table, array("employee_id"=>$eid,"topic_id"=>$tid,"company_email"=>$email));
    }

    function release($id) {
        $this->db->where("id",$id);
        $this->db->delete($this->assign_employee_table);
    }

    function update($id,$date) {
        $this->db->set("start_date", $date);
        $this->db->set("updated_at", "SYSDATE()", FALSE);
        $this->db->where("id",$id);
        $this->db->update($this->assign_employee_table);
    }

    function getAssignedCategoryList($user_id = 0){
        $this->db->select('c.*, count(*) count')->from($this->assign_employee_table . ' a');
        $this->db->join($this->topic_table . ' b', 'a.topic_id = b.id');
        $this->db->join($this->category_table . ' c', 'b.category_id = c.id');
        $this->db->where('a.employee_id', $user_id);
        $this->db->group_by('c.id');
        $this->db->order_by('c.id');
        return $this->db->get()->result_array();
    }
}

?>
