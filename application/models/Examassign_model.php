<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Examassign_model extends CI_Model
{
    
    /**
     * This function used to manage examassign
     */
   	protected $table;
    
    function __construct()
    {
        parent::__construct();
        $this->table = 'exam_assign';
        $this->user_table = 'users';
        $this->company_table = 'company';
        $this->exam_table = 'exam_exam';
    }

    function exam_count($searchcond = array())
    {
        $this->db->select("exam_list")->from($this->table." a");
        $this->db->join($this->user_table." b", 'a.assigned_user_id = b.id', 'left');
        $this->db->join($this->company_table." c", 'b.company_id = c.id', 'left');
        foreach ($searchcond as $fname=>$val) {
            $this->db->where($fname, $val);    
        }
        $query = $this->db->get();        
        $result_row = $query->result_array();

        $exam_list = json_decode($result_row[0]["exam_list"]);
        return count($exam_list);
    }

    function getList($searchcond = array(), $limit = "", $offset = "")
    {
        $this->db->select("a.*, b.first_name, b.last_name, b.user_type, b.email")->from($this->table." a");
        $this->db->join($this->user_table." b", 'a.assigned_user_id = b.id', 'left');
        
        //$total = $this->db->count_all_results('', FALSE);

        foreach ($searchcond as $fname=>$val) {
            $this->db->where($fname, $val);    
        }

        $this->db->order_by('a.`id`', 'DESC');

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


    
    function getUserList($searchcond = array(), $limit = "", $offset = "")
    {
        $this->db->select("a.*, b.first_name, b.last_name, b.user_type, b.email")->from($this->table." a");
        $this->db->join($this->user_table." b", 'a.assigned_user_id = b.id', 'left');
        
        //$total = $this->db->count_all_results('', FALSE);

        foreach ($searchcond as $fname=>$val) {
            $this->db->where($fname, $val);    
        }

        $this->db->order_by('a.`id`', 'DESC');

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

    function getCompanyList($searchcond = array(), $limit = "", $offset = "")
    {
        $this->db->select("a.*, b.name AS first_name, '' AS last_name, 'Company' AS user_type, b.email")->from($this->table." a");
        $this->db->join($this->company_table." b", 'a.assigned_user_id = b.id', 'left');
        
        //$total = $this->db->count_all_results('', FALSE);

        foreach ($searchcond as $fname=>$val) {
            $this->db->where($fname, $val);    
        }

        $this->db->order_by('a.`id`', 'DESC');

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


    function getExamList4Select2($uid=0, $role='', $skey='')
    {
        $this->db->select("exam_list")->from($this->table);

        $this->db->where('assigned_user_id', $uid);
        if($role=='Company')
            $this->db->where('company_flag', 1);
        else
            $this->db->where('company_flag', 0);
        
        //$this->db->like('exam_list', $skey, left);

        $query = $this->db->get();

        return $query->result_array();
    }

    function getRow($row_id)
    {
        $this->db->select("company_flag")->from($this->table)->where("id", $row_id);
        $company_data = $this->db->get()->result_array();
        if($company_data[0]['company_flag']) {
            $this->db->select("a.*, '' AS salutation, b.name AS first_name, '' AS last_name, 'Company' AS user_type, b.email")->from($this->table." a");
            $this->db->join($this->company_table." b", 'a.assigned_user_id = b.id', 'left');    
        } else {
            $this->db->select("a.*, b.salutation, b.first_name, b.last_name, b.user_type, b.email")->from($this->table." a");
            $this->db->join($this->user_table." b", 'a.assigned_user_id = b.id', 'left');    
        }
        $this->db->where('a.id', $row_id);
        $query=$this->db->get();
        $result=$query->result_array();
        return $result;
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

    function getPagingList($email = '', $type = "", $limit = "", $offset = "")
    {
        if ($type == '') $from =
            "SELECT concat('employee-', id) id, employee_id assigner_id, exam_id, start_date, company_email parent_email, 1 sort_v
                from exam_assign_employee
            UNION (
                select concat('company-', id) id, company_id assigner_id, exam_id, start_date, fasi_email parent_email, 2 sort_v
                from exam_assign_company )
            UNION (
                select concat('fasi-', id) id, fasi_id assigner_id, exam_id, start_date, parent_email, 3 sort_v
                from exam_assign_fasi )";
        else {

            /*employee_list for company*/
            $from = "SELECT concat('employee-', id) id, employee_id assigner_id, exam_id, start_date, company_email parent_email, 1 sort_v
                from exam_assign_employee\n";
            /*company_list for fasi*/
            if ($type == 'FASI' || $type == 'Admin' || $type == 'SuperAdmin')
                $from .= "UNION (
                            select concat('company-', id) id, company_id assigner_id, exam_id, start_date, fasi_email parent_email, 2 sort_v
                            from exam_assign_company ) \n";
            /*fasi_list for admin*/
            if ($type == 'Admin' || $type == 'SuperAdmin')
                $from .= "UNION (
                            select concat('fasi-', id) id, fasi_id assigner_id, exam_id, start_date, parent_email, 3 sort_v
                            from exam_assign_fasi )";

        }

        $this->db->select('a.*,
        b.user_type, b.`picture`, b.`salutation`,
        concat(IFNULL(e.name, ""), IFNULL(b.first_name, ""), " ", IFNULL(b.last_name, "")) name,
        b.`email`, d.`exam_category_name`, c.`exam_title`, c.`exam_price`, c.`repeat_days`, IFNULL(f.name, "-") company_name')
            ->from(" ( " . $from . " ) a");

        $this->db->join("users b", 'a.assigner_id = b.id', 'left');
        $this->db->join("exam_exam c", 'a.exam_id = c.id', 'left');
        $this->db->join("exam_category d", 'c.exam_category_id = d.id', 'left');
        $this->db->join("company e", 'b.id = e.id', 'left');
        $this->db->join("company f", 'b.company_id = f.id', 'left');

        if ($email != '')
            $this->db->where('a.parent_email', $email);

        $filtertotal = $this->db->count_all_results('', FALSE);

        $this->db->order_by('a.`sort_v`', 'DESC');
        $this->db->order_by('a.`assigner_id`', 'ASC');

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

        $sql = '';  $like = 'a.exam_title like "%' . $category . '%"';
        if ($assigner_type == 'SuperAdmin' || $assigner_type == 'Admin'){
            if ($obj_type == 'FASI'){
                $sql = 'select a.id, a.exam_title, c.id assign_id, c.start_date from exam_exam a
                    LEFT JOIN exam_assign_fasi c on c.exam_id = a.id and c.fasi_id = ' . $obj_id . '
                    where c.id is ' . ($isSelectable ? '' : 'not' ) . ' null and ' . $like . '
                    order by a.id asc;';
            }elseif ($obj_type == 'Company'){
                $sql = 'select a.id, a.exam_title, c.id assign_id, c.start_date from exam_exam a
                    LEFT JOIN exam_assign_company c on c.exam_id = a.id and c.company_id = ' . $obj_id . '
                    where c.id is ' . ($isSelectable ? '' : 'not' ) . ' null and ' . $like . '
                    order by a.id asc;';
            }elseif ($obj_type == 'Employee'){
                $sql = 'select a.id, a.exam_title, c.id assign_id, c.start_date from exam_exam a
                    LEFT JOIN exam_assign_employee c on c.exam_id = a.id and c.employee_id = ' . $obj_id . '
                    where c.id is ' . ($isSelectable ? '' : 'not' ) . ' null and ' . $like . '
                    order by a.id asc;';
            }
        }else if($assigner_type == 'FASI'){
            if ($obj_type == 'Company'){
                $sql = 'select a.id, a.exam_title, c.id assign_id, c.start_date from exam_exam a
                    LEFT JOIN exam_assign_fasi b on b.exam_id = a.id and b.fasi_id = ' . $assigner_id . '
                    LEFT JOIN exam_assign_company c on c.exam_id = a.id and c.company_id = ' . $obj_id . '
                    where b.id is not null and c.id is ' . ($isSelectable ? '' : 'not' ) . ' null and ' . $like . '
                    order by a.id asc;';
            }else if ($obj_type == 'Employee'){
                $sql = 'select a.id, a.exam_title, c.id assign_id, c.start_date from exam_exam a
                    LEFT JOIN exam_assign_fasi b on b.exam_id = a.id and b.fasi_id = ' . $assigner_id . '
                    LEFT JOIN exam_assign_employee c on c.exam_id = a.id and c.employee_id = ' . $obj_id . '
                    where b.id is not null and c.id is ' . ($isSelectable ? '' : 'not' ) . ' null and ' . $like . '
                    order by a.id asc;';
            }
        }else if ($assigner_type == 'Company'){
            $sql = 'select a.id, a.exam_title, c.id assign_id, c.start_date from exam_exam a
                    LEFT JOIN exam_assign_company b on b.exam_id = a.id and b.company_id = ' . $assigner_id . '
                    LEFT JOIN exam_assign_employee c on c.exam_id = a.id and c.employee_id = ' . $obj_id . '
                    where b.id is not null and c.id is ' . ($isSelectable ? '' : 'not' ) . ' null and ' . $like . '
                    order by a.id asc;';
        }

        return $this->db->query($sql)->result_array();
    }
}

?>
