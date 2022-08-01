<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Trainingassignfasi_model extends CI_Model
{
    
    /**
     * This function used to manage categories
     */
   	protected $fasi_table;
    protected $user_table;
    
    function __construct()
    {
        parent::__construct();
        $this->fasi_table = 'training_assign_fasi';
        $this->user_table = 'users';
        $this->topic_table = 'training_topic';
        $this->category_table = 'training_category';
    }
    
    /*
     * This function used to display paginated list 
     */    
    function getPagingList($search_cond = array(), $limit = "", $offset = "")
    {
        $this->db->select('a.*, b.`picture`, b.`salutation`, concat(IFNULL(b.first_name,""), IFNULL(e.name,"")) first_name, b.`last_name`, b.`email`, d.`category_name`, c.`training_title`, c.`price`, c.`repeat_days`')
            //->from($this->fasi_table." a");
            ->from(" (
                    select concat('fasi-', id) id, fasi_id assigner_id, topic_id, start_date, parent_email
                    from training_assign_fasi
                    UNION (
                        select concat('company-', id), company_id assigner_id, topic_id, start_date, fasi_email parent_email
                        from training_assign_company )
                    UNION (
                        SELECT concat('employee-', id), employee_id assigner_id, topic_id, start_date, company_email parent_email
                        from training_assign_employee )
                ) a");
        /*$this->db->join($this->user_table." b", 'a.fasi_id = b.id', 'left');
        $this->db->join($this->topic_table." c", 'a.topic_id = c.id', 'left');
        $this->db->join($this->category_table." d", 'c.category_id = d.id', 'left');
        */

        $this->db->join($this->user_table." b", 'a.assigner_id = b.id', 'left');
        $this->db->join($this->topic_table." c", 'a.topic_id = c.id', 'left');
        $this->db->join($this->category_table." d", 'c.category_id = d.id', 'left');
        $this->db->join("company e", 'b.id = e.id', 'left');

        $filtertotal = $this->db->count_all_results('', FALSE);

        $this->db->order_by('`assigner_id`', 'ASC');
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
        $this->db->select('a.fasi_id assigner_id, a.*, b.salutation, b.first_name, b.last_name, b.picture, b.email, b.user_type')->from($this->fasi_table." a");
        $this->db->join($this->user_table." b", 'a.fasi_id = b.id', 'left');

        $this->db->where('a.`id`', $row_id);
        
        $query=$this->db->get();
        
        return $query->result_array();
        
    }

    function getAssignedList($fasi_id)
    {
        $this->db->select('a.id AS row_id, a.topic_id AS id, c.category_name, b.training_title AS text, a.start_date AS startdate')->from($this->fasi_table." a");
        $this->db->join($this->topic_table." b", 'a.topic_id = b.id', 'left');
        $this->db->join($this->category_table." c", 'b.category_id = c.id', 'left');

        $this->db->where('a.`fasi_id`', $fasi_id);
        
        $query=$this->db->get();
        
        return $query->result_array();
        
    }

    function saveTrainingassign($data){
        $data['created_at'] = date("Y-m-d H:i:s");

        $this->db->trans_start();
        
        $rst = $this->db->insert($this->fasi_table, $data);
        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();
        
        return $insert_id;
    }

    function updateTrainingassign($data, $row_id)
    {
        $data['updated_at'] = date("Y-m-d H:i:s");        
        $this->db->where('id', $row_id);
        $result = $this->db->update($this->fasi_table, $data);

        return $result;
    }

    function deleteTrainingassign($row_id)
    {
        return $this->db->delete($this->fasi_table, array('id' => $row_id));
    }

    function selectableList($param)
    {
        $sql = "SELECT a.id,a.training_title 
                FROM training_topic a
                    LEFT JOIN training_assign_fasi b ON a.id=b.topic_id
                        AND b.fasi_id=?
                    LEFT JOIN training_category c ON a.category_id=c.id
                WHERE b.id IS NULL" . (!empty($param["category"])?" AND c.category_name LIKE '%{$param["category"]}%'":"");
        return $this->db->query($sql,$param["fasi_id"])->result_array();
    }

    function selectedList($param)
    {
        $sql = "SELECT a.id,a.training_title,b.start_date,b.id assign_id
                FROM training_topic a
                    LEFT JOIN training_assign_fasi b ON a.id=b.topic_id
                    LEFT JOIN training_category c ON a.category_id=c.id
                WHERE b.fasi_id=?" . (!empty($param["category"])?" AND c.category_name LIKE '%{$param["category"]}%'":"");
        return $this->db->query($sql,$param["fasi_id"])->result_array();
    }

    function assign($fid,$tid,$date,$email) {
        $this->db->set("start_date","SYSDATE()",FALSE);
        $this->db->set("created_at", "SYSDATE()", FALSE);
        $this->db->insert("training_assign_fasi",array("fasi_id"=>$fid,"topic_id"=>$tid,"parent_email"=>$email));
    }

    function release($id) {
        $this->db->where("id",$id);
        $this->db->delete("training_assign_fasi");
    }

    function update($id,$date) {
        $this->db->set("start_date", $date);
        $this->db->set("updated_at", "SYSDATE()", FALSE);
        $this->db->where("id",$id);
        $this->db->update("training_assign_fasi");
    }

}

?>
