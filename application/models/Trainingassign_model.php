<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Trainingassign_model extends CI_Model
{
    
    /**
     * This function used to manage categories
     */
   	protected $fasi_table;
    protected $company_assign_table;
    protected $employee_table;
    protected $user_table;
    protected $company_table;

    
    function __construct()
    {
        parent::__construct();
        $this->fasi_table = 'training_assign_fasi';
        $this->company_assign_table = 'training_assign_company';
        $this->employee_table = 'training_assign_employee';
        $this->user_table = 'users';
        $this->company_table = 'company';
    }
    
    /*
     * This function used to display paginated list 
     */    
    function getFasiPagingList($search_cond = array(), $limit = "", $offset = "")
    {
        $this->db->select('a.*, b.salutation, b.first_name, b.last_name, b.picture, b.email')->from($this->fasi_table." a");
        $this->db->join($this->user_table." b", 'a.fasi_id = b.id', 'left');
        
        $filtertotal = $this->db->count_all_results('', FALSE);

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

    
    /*
     * This function used to display All list
     */    
    function getAllList($search_cond = array())
    {
        $this->db->select()->from($this->table);        
        $this->db->order_by('`id`', 'DESC');        
        $query = $this->db->get();

        return $query->result_array();
    }

    function getFasiRow($row_id)
    {
        $this->db->select('a.*, b.salutation, b.first_name, b.last_name, b.picture, b.email')->from($this->fasi_table." a");
        $this->db->join($this->user_table." b", 'a.fasi_id = b.id', 'left');

        $this->db->where('a.`id`', $row_id);
        
        $query=$this->db->get();
        
        return $query->result_array();
        
    }

    function getAssignedFasiRow($fasi_id)
    {
        $this->db->select('a.*, b.salutation, b.first_name, b.last_name, b.picture, b.email')->from($this->fasi_table." a");
        $this->db->join($this->user_table." b", 'a.fasi_id = b.id', 'left');

        $this->db->where('a.`fasi_id`', $fasi_id);
        
        $query=$this->db->get();
        
        return $query->result_array();
        
    }

    function getFasiAssignedTopicList($f_id)
    {
        $this->db->select('topic_list')->from($this->fasi_table);
        $this->db->where('fasi_id`', $f_id);
        
        $query=$this->db->get();
        
        return $query->result_array();
        
    }

    function addFasiTrainingassign($data){
        $data['created_at'] = date("Y-m-d H:i:s");

        $this->db->trans_start();
        
        $rst = $this->db->insert($this->fasi_table, $data);
        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();
        
        return $insert_id;
    }

    function updateFasiTrainingassign($data, $row_id)
    {
        $data['updated_at'] = date("Y-m-d H:i:s");        
        $this->db->where('id', $row_id);
        $result = $this->db->update($this->fasi_table, $data);

        return $result;
    }

    function deleteFasiTrainingassign($row_id)
    {
        //$this->db->where('absid', $absid);
        //$sql = $this->db->get_compiled_delete($this->table);
        //print $sql;
        return $this->db->delete($this->fasi_table, array('id' => $row_id));
        
    }




    /*
     * This function used to display paginated list 
     */    
    function getCompanyPagingList($search_cond = array(), $limit = "", $offset = "")
    {
        $this->db->select('a.*, c.name AS company_name, b.salutation, b.first_name, b.last_name, b.picture, b.email')->from($this->company_assign_table." a");
        $this->db->join($this->user_table." b", 'a.company_id = b.id', 'left');
        $this->db->join($this->company_table." c", 'b.company_id = c.id', 'left');
        
        $filtertotal = $this->db->count_all_results('', FALSE);

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

    function getCompanyRow($row_id)
    {
        $this->db->select('a.*, b.salutation, b.first_name, b.last_name, b.picture, b.email')->from($this->company_assign_table." a");
        $this->db->join($this->user_table." b", 'a.company_id = b.id', 'left');

        $this->db->where('a.`id`', $row_id);
        
        $query=$this->db->get();
        
        return $query->result_array();        
    }

    function getAssignedCompanyRow($c_id)
    {
        $this->db->select('a.*, b.salutation, b.first_name, b.last_name, b.picture, b.email')->from($this->company_assign_table." a");
        $this->db->join($this->user_table." b", 'a.company_id = b.id', 'left');

        $this->db->where('a.`company_id`', $c_id);
        
        $query=$this->db->get();
        
        return $query->result_array();        
    }


    function getCompanyAssignedTopicList($cid)
    {
        $this->db->select('topic_list')->from($this->company_assign_table);
        $this->db->where('`company_id`', $cid);
        
        $query=$this->db->get();
        
        return $query->result_array();
        
    }


    function addCompanyTrainingassign($data){
        $data['created_at'] = date("Y-m-d H:i:s");

        $this->db->trans_start();
        
        $rst = $this->db->insert($this->company_assign_table, $data);
        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();
        
        return $insert_id;
    }

    function updateCompanyTrainingassign($data, $row_id)
    {
        $data['updated_at'] = date("Y-m-d H:i:s");        
        $this->db->where('id', $row_id);
        $result = $this->db->update($this->company_assign_table, $data);

        return $result;
    }

    function deleteCompanyTrainingassign($row_id)
    {
        return $this->db->delete($this->company_assign_table, array('id' => $row_id));        
    }






    /*
     * This function used to display paginated list 
     */    
    function getEmployeePagingList($search_cond = array(), $limit = "", $offset = "")
    {
        $this->db->select('a.*, b.salutation, b.first_name, b.last_name, b.picture, b.email')->from($this->employee_table." a");
        $this->db->join($this->user_table." b", 'a.employee_id = b.id', 'left');
        //$this->db->join($this->user_table." b", 'a.company_id = b.id', 'left');
        
        $filtertotal = $this->db->count_all_results('', FALSE);

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

    function getEmployeeRow($row_id)
    {
        $this->db->select('a.*, b.salutation, b.first_name, b.last_name, b.picture, b.email')->from($this->employee_table." a");
        $this->db->join($this->user_table." b", 'a.employee_id = b.id', 'left');

        $this->db->where('a.`id`', $row_id);
        
        $query=$this->db->get();
        
        return $query->result_array();
        
    }


    function getAssignedTopicList($employee_id)
    {
        $this->db->select('topic_list')->from($this->employee_table);
        $this->db->where('`employee_id`', $employee_id);
        
        $query=$this->db->get();
        
        return $query->result_array();
        
    }

    function addEmployeeTrainingassign($data){
        $data['created_at'] = date("Y-m-d H:i:s");

        $this->db->trans_start();
        
        $rst = $this->db->insert($this->employee_table, $data);
        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();
        
        return $insert_id;
    }

    function updateEmployeeTrainingassign($data, $row_id)
    {
        $data['updated_at'] = date("Y-m-d H:i:s");        
        $this->db->where('id', $row_id);
        $result = $this->db->update($this->employee_table, $data);

        return $result;
    }

    function deleteEmployeeTrainingassign($row_id)
    {
        return $this->db->delete($this->employee_table, array('id' => $row_id));
        
    }

    /**complex of common function for training_assign
     * @author : TIDE
     */

    function getPagingList($email = '', $type = "", $limit = "", $offset = "")
    {
        if ($type == '') $from =
            "SELECT concat('employee-', id) id, employee_id assigner_id, topic_id, start_date, company_email parent_email
                from training_assign_employee
            UNION (
                select concat('company-', id) id, company_id assigner_id, topic_id, start_date, fasi_email parent_email
                from training_assign_company
            )
            UNION (
                select concat('fasi-', id) id, fasi_id assigner_id, topic_id, start_date, parent_email
                from training_assign_fasi
            )";
        else {

            /*employee_list for company*/
            $from = "SELECT concat('employee-', id) id, employee_id assigner_id, topic_id, start_date, company_email parent_email
                          from training_assign_employee\n";
            /*company_list for fasi*/
            if ($type == 'FASI' || $type == 'Admin' || $type == 'SuperAdmin')
                $from .= "UNION (
                            select concat('company-', id), company_id assigner_id, topic_id, start_date, fasi_email parent_email
                            from training_assign_company ) \n";
            /*fasi_list for admin*/
            if ($type == 'Admin' || $type == 'SuperAdmin')
                $from .= "UNION (
                            select concat('fasi-', id) id, fasi_id assigner_id, topic_id, start_date, parent_email
                            from training_assign_fasi ) ";

        }

        $this->db->select('a.*,
        b.`picture`, b.`salutation`,
        b.user_type, concat(IFNULL(e.name, ""), IFNULL(b.first_name, ""), " ", IFNULL(b.last_name, "")) name, b.`email`, d.`category_name`, c.`training_title`, c.`price`, c.`repeat_days`, IFNULL(f.name, "-") company_name')
            ->from(" ( " . $from . " ) a");

        $this->db->join("users b", 'a.assigner_id = b.id', 'left');
        $this->db->join("training_topic c", 'a.topic_id = c.id', 'left');
        $this->db->join("training_category d", 'c.category_id = d.id', 'left');
        $this->db->join("company e", 'b.id = e.id', 'left');
        $this->db->join("company f", 'b.company_id = f.id', 'left');

        if ($email != '')
            $this->db->where('a.parent_email', $email);

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

    /*assigner(type="fasi", id=101, email="fasi1@lms.com"), obj(type="Company", id="102"), 101, true(selectable, false:selected)*/
    function assign_select_list($assigner = array(), $obj = array(), $isSelectable = true, $category = ''){
        $assigner_type = $assigner['type'];
        $assigner_id = $assigner['id'];
        $assigner_email = $assigner['type'];
        $obj_type = $obj['type'];
        $obj_id = $obj['id'];

        $sql = '';  $like = 'a.training_title like "%' . $category . '%"';
        if ($assigner_type == 'SuperAdmin' || $assigner_type == 'Admin'){
            if ($obj_type == 'FASI'){
                $sql = 'select a.id, a.training_title, c.id assign_id, c.start_date from training_topic a
                    LEFT JOIN training_assign_fasi c on c.topic_id = a.id and c.fasi_id = ' . $obj_id . '
                    where c.id is ' . ($isSelectable ? '' : 'not' ) . ' null and ' . $like . '
                    order by a.id asc;';
            }elseif ($obj_type == 'Company'){
                $sql = 'select a.id, a.training_title, c.id assign_id, c.start_date from training_topic a
                    LEFT JOIN training_assign_company c on c.topic_id = a.id and c.company_id = ' . $obj_id . '
                    where c.id is ' . ($isSelectable ? '' : 'not' ) . ' null and ' . $like . '
                    order by a.id asc;';
            }elseif ($obj_type == 'Employee'){
                $sql = 'select a.id, a.training_title, c.id assign_id, c.start_date from training_topic a
                    LEFT JOIN training_assign_employee c on c.topic_id = a.id and c.employee_id = ' . $obj_id . '
                    where c.id is ' . ($isSelectable ? '' : 'not' ) . ' null and ' . $like . '
                    order by a.id asc;';
            }
        }else if($assigner_type == 'FASI'){
            if ($obj_type == 'Company'){
                $sql = 'select a.id, a.training_title, c.id assign_id, c.start_date from training_topic a
                    LEFT JOIN training_assign_fasi b on b.topic_id = a.id and b.fasi_id = ' . $assigner_id . '
                    LEFT JOIN training_assign_company c on c.topic_id = a.id and c.company_id = ' . $obj_id . '
                    where b.id is not null and c.id is ' . ($isSelectable ? '' : 'not' ) . ' null and ' . $like . '
                    order by a.id asc;';
            }else if ($obj_type == 'Employee'){
                $sql = 'select a.id, a.training_title, c.id assign_id, c.start_date from training_topic a
                    LEFT JOIN training_assign_fasi b on b.topic_id = a.id and b.fasi_id = ' . $assigner_id . '
                    LEFT JOIN training_assign_employee c on c.topic_id = a.id and c.employee_id = ' . $obj_id . '
                    where b.id is not null and c.id is ' . ($isSelectable ? '' : 'not' ) . ' null and ' . $like . '
                    order by a.id asc;';
            }
        }else if ($assigner_type == 'Company'){
            $sql = 'select a.id, a.training_title, c.id assign_id, c.start_date from training_topic a
                    LEFT JOIN training_assign_company b on b.topic_id = a.id and b.company_id = ' . $assigner_id . '
                    LEFT JOIN training_assign_employee c on c.topic_id = a.id and c.employee_id = ' . $obj_id . '
                    where b.id is not null and c.id is ' . ($isSelectable ? '' : 'not' ) . ' null and ' . $like . '
                    order by a.id asc;';
        }

        return $this->db->query($sql)->result_array();
    }

}

?>
