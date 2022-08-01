<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Account_model extends CI_Model
{
    
    /**
     * This function used to manage accounting info
     */
   	protected $table;
   	protected $pay_table;
    
    function __construct()
    {
        parent::__construct();
        $this->table = 'accounting';
        $this->pay_table = 'payment_history';
    }

    function getPayUser($object_id, $company_id, $object_type)
    {
        $query = 'Select p.user_id as id, CONCAT(u.first_name, " ", u.last_name) AS fullname from payment_history as p join user as u on p.user_id=u.id where p.object_id='.$object_id.' and p.company_id='.$company_id.' and p.object_type="'.$object_type.'"';

        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }

    function insert($data){
        $data['created_at'] = date("Y-m-d H:i:s");
        $rst = $this->db->insert($this->table, $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function getAccountById_emerald($id) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        $data = $query->result_array();

        return $data[0];
    }

    function getAccountList($searchcond = array(), $limit = "", $offset = "")
    {
        $this->db->select("*")->from($this->table." a");

        foreach ($searchcond as $fname=>$val) {
            $this->db->where($fname, $val);
        }

        $this->db->order_by('id', 'DESC');

        $filtertotal = $this->db->count_all_results('', FALSE);
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

    function updateaccountstatus($row_id, $status)
    {
        $data['pay_status'] = $status;
        if($status == 1){
            $data['pay_date'] =  date("Y-m-d H:i:s");
        }
        else{
            $data['pay_date'] =  "";
        }
        $this->db->where('id', $row_id);
        $result = $this->db->update($this->table, $data);

        return $result;
    }

    function getTotalInvoice( ){
        $this->db->select("sum(amount) as total_amt")->from($this->table);
        $query = $this->db->get();

        return $query->row()->total_amt;
    }

    function getTotalAmount($searchcond ){
        $this->db->select("sum(amount) as total_amt")->from($this->table);

        foreach ($searchcond as $fname=>$val) {
            $this->db->where($fname, $val);
        }

        $query = $this->db->get();

        return $query->row()->total_amt;
    }

    function remove_account($row_id, $status)
    {

        $this->db->where('id', $row_id);

        if($status == 1){
            $this->db->delete($this->table);
        }
        else{
            $data['pay_status'] = $status;
            $data['updated_at'] =  date("Y-m-d H:i:s");
            $data['pay_date'] =  '';
            $data['amount'] = 0;

            $result = $this->db->update($this->table, $data);
        }
        return $result;
    }

    function getPaymentList($searchcond = array(), $limit = "", $offset = "")
    {
        $this->db->select("*,(select concat(first_name,' ',last_name) fullname from user where id = a.user_id) fullname")->from("payment_history a");

        foreach ($searchcond as $fname=>$val) {
            if ($fname == "user_type" && $val == "Admin"){
                $this->db->where("company_id", $this->session->get_userdata()['company_id']);
            }else if ($fname == "user_type" && $val == "Learner"){
                $this->db->where("user_id", $this->session->get_userdata()['user_id']);
            }else{
                $this->db->where("adsf", $val);
            }
        }

        $this->db->order_by('id', 'DESC');

        $filtertotal = $this->db->count_all_results('', FALSE);
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

    function insert_payment($data){
        $data['pay_date'] = date("Y-m-d H:i:s");
        $rst = $this->db->insert("payment_history", $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
}

?>
