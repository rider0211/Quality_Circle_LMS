<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Timon
 * Date: 6/27/2018
 * Time: 6:24 PM
 */

class User_model extends AbstractModel
{
    /**
     * This function used to manage categories
     */
    protected $table;

    function __construct(){
        parent::__construct();
        $this->_table = 'user';
        $this->table = 'user';
        $this->company_table = 'company';
        $this->companyuser_table = 'company_user';
        $this->load->helper('mail');
        $this->exam_table = 'exam_assign_employee';

    }

    function getUserIdList($fasi_id){
        $this->db->select($this->table.".id")->from($this->table);
        $this->db->join($this->company_table, $this->table.".company_id = ".$this->company_table.".id", "left");
        $this->db->where($this->table.'.active', 1);
        $this->db->where('responsible_fasi_id', $fasi_id);
        $query = $this->db->get();

        $id_list = array();
        $data_list = $query->result_array();
        foreach ($data_list as $key => $data) {
            $id_list[] = $data["id"];
        }
        return $id_list;
    }

    /**get userid list(in usertype) from access_type and access_id*/
    function getUserIdListFrType($user_type = 'Employee', $type = '', $id = 0){

        /*parameter validate*/
        $sessiondata = $this->session->get_userdata();
        if ($type == '') $type = $sessiondata['roleText'];
        if ($id == 0) $id = $sessiondata['userId'];

        if ($type == 'Employee') return $id;
        $this->db->select("a.id")->from($this->table.' a');
        if ($type == 'FASI'){
            $this->db->join($this->company_table. ' b', "a.company_id = b.id", "left");
            $this->db->where('b.responsible_fasi_id', $id);
        }
        if ($type == 'Company'){
            $this->db->where('a.company_id', $id);
        }

        if ($user_type != '')
            $this->db->where('a.user_type', $user_type);
        $this->db->where('a.active', 1);

        $id_list = array();
        $data_list = $this->db->get()->result_array();
        foreach ($data_list as $key => $data) {
            $id_list[] = $data["id"];
        }
        return $id_list;
    }
    
    function getEmployeeCount($searchcond = array()){
        $this->db->join($this->company_table, $this->table.".company_id = ".$this->company_table.".id", "left");
        $this->db->where($this->table.'.active', 1);
/*        $this->db->where('user_type', 'Learner');
        $this->db->or_where('user_type', 'Instructor');*/
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

    function getFasiInfo($c_id){
        $this->db->select("b.id, a.name as company_name, b.salutation, b.first_name, b.last_name, b.phone_number, b.picture, b.email, b.status")->from($this->company_table." a");
        $this->db->join($this->table." b", "a.responsible_fasi_id = b.id", "left");

        $this->db->where('a.id', $c_id);

        $query = $this->db->get();

        return $query->result_array();
    }

    function getAdminInfo(){
        $this->db->select()->from($this->table);
        
        $this->db->where('user_type', 'Admin');

        $query = $this->db->get();

        return $query->result_array();
    }

    function getRow($where = null){
        if ($where == null){
            $result = $this->db->get($this->table);
        }else{
            $result = $this->db->get_where($this->table, $where);
        }

        return $result->row();
    }

    function getNameList($where = null, $in_str = ''){
        if ($where == null){
            $result = $this->db->select('id, CONCAT(`salutation`, " ", `first_name`, " ", `last_name`) AS text ')->get($this->table);
        }else{
            //$result = $this->db->select('id, CONCAT(`salutation`, " ", `first_name`, " ", `last_name`) AS text ')->get_where($this->table, $where);

            $this->db->select('id, CONCAT(`salutation`, " ", `first_name`, " ", `last_name`) AS text ')->from($this->table);
            $this->db->where($where);
            if ($in_str != '')
                $this->db->where_in('company_id', $in_str, false);

            $result=$this->db->get();
        }

        return $result->result_array();
    }

    function getFullNameList($where = null){
        $this->db->select('a.id, CONCAT(`salutation`, " ", `first_name`, " ", `last_name`) AS text ');
        $this->db->from($this->table." a");

        $this->db->join($this->company_table." b", "a.company_id = b.id", "left");

        if ($where != null){
            $this->db->where($where);
        }
        $query = $this->db->get();

        $result_info['data'] = $query->result_array();
        return $result_info;
    }

    function getList($where = null){
        if ($where == null){
            $result = $this->db->get($this->table);
        } else {
            $result = $this->db->get_where($this->table, $where);
        }
        $res=$result->result_array();

        for($i = 0 ; $i < sizeof($res) ; $i ++){

            $item = $res[$i];
            $query = $this->db->get_where($this->company_table, "id=".$item['company_id']);
            $row = $query->row();
            if($row != null){
                $item['company_name'] = $row->name;
            }
            else{
                $item['company_name'] = '';
            }
            $res[$i] = $item;

        }
        return $res;
    }

    function getListByFasi($id){
        $query = $this->db->query('SELECT u.*, c.name company_name FROM user as u Left Join company as c on u.company_id = c.id where c.responsible_fasi_id = '.$id);
        $result = $query->result();
        return $result;
    }

    /**
     * This function used to check email exists or not
     * @param {string} $email : This is user email id
     * @return {boolean} $result : TRUE/FALSE
     */
    function checkEmailExist($email){
        $this->db->select('id');
        $this->db->where('email', $email);
        //$this->db->where('is_deleted', 0);
        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0){
            return true;
        } else {
            return false;
        }
    }

    /**
     * This function is used to get customer information by email-id for forget password email
     * @param string $email : Email id of customer
     * @return object $result : Information of customer
     */
    function getCustomerInfoByEmail($email){
        $this->db->select('id, email, CONCAT(first_name, " ", last_name) AS fullname');
        $this->db->from($this->table);
        $this->db->where('is_deleted', 0);
        $this->db->where('email', $email);
        $query = $this->db->get();

        return $query->result_array();
    }

    function insert($data){
        $data['reg_date'] = date("Y-m-d H:i:s");
        $data['is_deleted'] = 0;

        if (isset($data[picture]) || empty($data[picture])){
            //$data[picture] = sprintf('%suser/photo/%s', PATH_UPLOAD, ($data[user_type] == 'Company') ? 'default_company.png' : 'default.png');
            $data[picture] = str_replace("./", "", $data[picture]);
        }

        $this->db->insert($this->table, $data);
        $role = $data['user_type'];
        $active = $data['active'];
        $company_id = $data['company_id'];
        unset($data['user_type']);
        $user_id = $this->db->insert_id();

        return $user_id;
    }

    function update($data, $where = null){
        $data['updated_at'] = date("Y-m-d H:i:s");
        $this->db->where($where);
        $result = $this->db->update($this->table, $data);


        if (isset($data['active']) && $data['user_type'] != 'Admin'){
            $where_user['user_id'] = $where['id'];
            $this->db->where($where_user);
            if (isset($data['user_type']))
            $data_user['role'] = $data['user_type'];
            if (isset($data['company_id']))
            $data_user['company_id'] = $data['company_id'];
            if (isset($data['active']))
            $data_user['active'] = $data['active'];
            $result = $this->db->update($this->companyuser_table, $data_user);
        }

        return $result;
    }

    /**
     * update_last_login
     *
     * @param int|string $id
     *
     * @return bool
     * @author Ben Edmunds
     */
    public function update_last_login($id){
        $this->load->helper('date');

        $this->db->update($this->table, array('last_login' => date("Y-m-d H:i:s")), array('id' => $id));

        return $this->db->affected_rows() == 1;
    }

    public function update_otp_login($id=NULL,$security_key=NULL,$otp=NULL){
        $this->db->update($this->table, array('otp' => $otp,'security_key' => $security_key), array('id' => $id));
        return $this->db->affected_rows() == 1;
    }

    /**
     * update_remember_token
     *
     * @param int|string $id
     *
     * @return bool
     * @author Ben Edmunds
     */
    public function update_remember_token($id, $salt){
        $this->db->update($this->table, array('remember_token' => $salt), array('id' => $id));

        return $this->db->affected_rows() == 1;
    }

    function delete($where = null){

        $res = $this->db->delete($this->table, $where);
        if ($where['user_type'] != 'Admin')
            $this->db->delete($this->companyuser_table, array('user_id'=>$where['id']));
        return $res;

    }

    function getFasiList_emerald() {
        $this->db->select('id, first_name, last_name');
        $this->db->from($this->table);
        $this->db->where('user_type', 'FASI');
        $query = $this->db->get();

        return $query->result_array();
    }

    function getExportList_emerald($data = null){
        if ($data == null){
            $result = $this->db->get($this->table);
        } else {
            $where = "user_type='".$data['user_type']."'";
            if (isset($data['company']) && $data['company'] != 0)
                $where .= 'and company_id='.$data['company'];
            $result = $this->db->get_where($this->table, $where);
        }
        $res=$result->result_array();

        $return = array();

        for($i = 0 ; $i < sizeof($res) ; $i ++){
            $item = $res[$i];
            if (isset($data['exam']) && $data['exam'] != 0) {
                $examWhere = 'employee_id='.$item['id'];
                if (isset($data['start']) && !empty($data['start']))
                    $examWhere .= " and start_date>'".$data['start']."'";
                if (isset($data['end']) && !empty($data['end']))
                    $examWhere .= " and start_date<'".$data['end']."'";
                $examQuery = $this->db->get_where($this->exam_table, $examWhere);
                $row = $examQuery->row();
                if ($row != null) {
                    $query = $this->db->get_where($this->company_table, "id=".$item['company_id']);
                    $row = $query->row();
                    if($row != null){
                        $item['company_name'] = $row->name;
                    }
                    else{
                        $item['company_name'] = '';
                    }

                    array_push($return, $item);
                }
            } else {
                $query = $this->db->get_where($this->company_table, "id=".$item['company_id']);
                $row = $query->row();
                if($row != null){
                    $item['company_name'] = $row->name;
                }
                else{
                    $item['company_name'] = '';
                }

                array_push($return, $item);
            }
        }
        return $return;
    }

    function getfrEmail($id = 0, $email = ''){
        $sql = "select * from user where id != $id and email = '$email'";
        return count($this->db->query($sql)->result_array());
    }
    function getInstructorByCompany($id){
        $this->db->select('a.id, a.email, CONCAT(a.first_name, " ", a.last_name) AS fullname')->from($this->table." a");

        $this->db->where('a.company_id', $id);
        $this->db->where('a.user_type', "Instructor");
        $this->db->where('a.active', 1);
        $this->db->where('a.is_deleted != 1');

        $query = $this->db->get();

        return $query->result_array();
    }
    function getObserverByCompany($id){
        $this->db->select('a.id, CONCAT(a.first_name, " ", a.last_name) AS fullname')->from($this->table." a");

        $this->db->where('a.company_id', $id);
        $this->db->where('a.user_type', "Learner");
        $this->db->where('a.active', 1);
        $this->db->where('a.is_deleted != 1');

        $query = $this->db->get();

        return $query->result_array();
    }
	function getAllStudents(){
        $this->db->select('a.id, CONCAT(a.first_name, " ", a.last_name) AS fullname')->from($this->table." a");

        $this->db->where('a.user_type', "Learner");
        $this->db->where('a.active', 1);
        $this->db->where('a.is_deleted != 1');

        $query = $this->db->get();

        return $query->result_array();
    }
    function signup($data){
		if(isset($data['country_list'])){
			unset($data['country_list']);	
		}		
        $data["reg_date"] = date("Y-m-d H:i:s");
        $data["is_deleted"] = 0;
        $data["active"] = 1;
		if(isset($data['country'])){
			
		}else{
			$data['country'] = 'US';
		}
		
        $this->db->insert($this->table, $data);
        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    function getInstructor($id = NULL) {
        $this->db->select('id,CONCAT(first_name, " ", last_name) AS fullname, email');
        $this->db->from($this->table);
        $this->db->where('company_id', $id);
        $this->db->where('user_type', "Instructor");
        $this->db->where('active', 1);
        $this->db->where('is_deleted', 0);
        $total = $this->db->count_all_results('', FALSE);
        $filtertotal = $this->db->count_all_results('', FALSE);

        $query = $this->db->get();
        $result_info = array();
        if ($query->num_rows() > 0) {
            $result_info['total'] = $total;
            $result_info['filtertotal'] = $filtertotal;
            $result_info['data'] = $query->result_array();
        } else {
            $result_info['total'] = 0;
            $result_info['filtertotal'] = 0;
            $result_info['data'] = array();
        }
        return $result_info;
    }
    function getInstructorByMessage($id = NULL) {
        $this->db->select('id,CONCAT(first_name, " ", last_name) AS fullname, email');
        $this->db->from($this->table);
        $this->db->where('company_id', $id);
        $this->db->where('user_type', "Instructor");
        $this->db->where('active', 1);
        $this->db->where('is_deleted', 0);

        $query = $this->db->get();

        return $query->result_array();
    }
    function getUser($id = NULL) {
        $this->db->select('id,CONCAT(first_name, " ", last_name) AS fullname, email');
        $this->db->from($this->table);
        $this->db->where('company_id', $id);
        $this->db->where('user_type', "Learner");
        $this->db->where('active', 1);
        $this->db->where('is_deleted', 0);
        $total = $this->db->count_all_results('', FALSE);
        $filtertotal = $this->db->count_all_results('', FALSE);

        $query = $this->db->get();
        $result_info = array();
        if ($query->num_rows() > 0) {
            $result_info['total'] = $total;
            $result_info['filtertotal'] = $filtertotal;
            $result_info['data'] = $query->result_array();
        } else {
            $result_info['total'] = 0;
            $result_info['filtertotal'] = 0;
            $result_info['data'] = array();
        }
        return $result_info;
    }
    function getUserById($id = NULL) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);

        $query = $this->db->get();
        return $query->result_array();
    }
    function getUserByMessage($id = NULL) {
        $this->db->select('id,CONCAT(first_name, " ", last_name) AS fullname, email');
        $this->db->from($this->table);
        $this->db->where('company_id', $id);
        $this->db->where('user_type', "Learner");
        $this->db->where('active', 1);
        $this->db->where('is_deleted', 0);

        $query = $this->db->get();
        return $query->result_array();
    }
    function getAdmin($id = NULL) {
        $this->db->select('id,CONCAT(first_name, " ", last_name) AS fullname, email');
        $this->db->from($this->table);
        $this->db->where('company_id', $id);
        $this->db->where('user_type', "Admin");
        $this->db->where('active', 1);
        $this->db->where('is_deleted', 0);
        $query = $this->db->get();
        return $query->result_array();
    }
    function getEmailAddressById($id = NULL){
        $this->db->select('email');
        $this->db->from($this->table);
        $this->db->where('id',$id);
        $result = $this->db->get()->first_row();
        $email = '';
        if(!empty($result)){
            $email = $result->email;
        }else{
            $email = '';
        }
        return $email;
    }

    function getFullNameByEmail($email = NULL){
        $this->db->select('CONCAT(first_name, " ", last_name) AS fullname');
        $this->db->from($this->table);
        $this->db->where('email',$email);
        $result = $this->db->get()->first_row();
        $fullname = '';
        if(!empty($result)){
            $fullname = $result->fullname;
        }else{
            $fullname = '';
        }
        return $fullname;
    }

    function getFullNameById($id = NULL){
        $this->db->select('CONCAT(first_name, " ", last_name) AS fullname');
        $this->db->from($this->table);
        $this->db->where('id',$id);
        $result = $this->db->get()->first_row();
        $fullname = '';
        if(!empty($result)){
            $fullname = $result->fullname;
        }else{
            $fullname = '';
        }
        return $fullname;
    }

    function getSuperEmailAddress(){
        $this->db->select('email');
        $this->db->from($this->table);
        $this->db->where('user_type','Superadmin');
        $result = $this->db->get()->first_row();
        $email = '';
        if(!empty($result)){
            $email = $result->email;
        }else{
            $email = '';
        }
        return $email;
    }

    function count($filter = NULL){
        if($filter!=NULL) {
            foreach($filter as $name=>$value) {
                if($name=="start" || $name=="limit" || $name=="search")
                    continue;
                if (is_array($value)) {
                    $this->db->where_in($this->field($name), $value);
                } else {
                    $this->db->where($this->field($name), $value);
                }
            }
        }
        return $this->db->count_all_results($this->table);
    }
    function field($field) {
        if(!strpos($field, "."))
            return $this->db->protect_identifiers($this->table) . "." . $field;
        return $field;
    }

    function getAdminCount($searchcond = array()){
        $this->db->join($this->company_table, $this->table.".company_id = ".$this->company_table.".id", "left");
        $this->db->where($this->table.'.active', 1);
        $this->db->where('user_type', 'Admin');
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

    function getUsersForBlast($id){
        $this->db->select('id,CONCAT(first_name, " ", last_name) AS fullname, email');
        $this->db->from($this->table);
        $this->db->where('company_id', $id);
        $this->db->where("user_type <> 'Superadmin'");
        $this->db->where('active', 1);
        $this->db->where('is_deleted', 0);
        $query = $this->db->get();
        return $query->result_array();
    }
}
