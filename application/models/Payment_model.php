<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Payment_model extends AbstractModel
{
    var $_table = 'payment_history';
    
    public function totalAmountForSuper(){
        $query = "SELECT SUM(amount) total_amount FROM payment_history
        WHERE object_type = 'plan'";
        return $this->db->query($query)->row();
    }

    public function totalAmountForLearner($filter){
        $query = "SELECT SUM(amount) total_amount FROM payment_history
        WHERE user_id = '" . $filter["user_id"]. "'";
        return $this->db->query($query)->row();
    }

    public function totalAmountForAdmin($filter){
        $query = "SELECT SUM(amount) total_amount FROM payment_history
        WHERE company_id = '". $filter["company_id"]. "'";
        return $this->db->query($query)->row();
    }

    public function getInvoices($filter = NULL){
        $this->db->select("$this->_table.*, user.first_name, user.last_name, company.name company_name");
        $this->db->join('user', "user.id = $this->_table.user_id", 'left');
        $this->db->join('company', "company.id = user.company_id", 'left');
        if($filter['object_type'] == 'plan'){
            $this->db->join('plan', "plan.id = payment_history.object_id", 'left');
            $this->db->select('plan.name payment_title');
        }
        $result = parent::all($filter);
        return $result;
    }

    public function getAdminPayment($filter){
        $query = "SELECT a.*, b.title title, c.`name`, c.url, d.first_name, d.last_name, d.email 
        FROM payment_history a
        LEFT JOIN course b ON b.id = a.object_id
        LEFT JOIN company c ON c.id = a.company_id
        LEFT JOIN `user` d ON d.id = a.user_id
        WHERE a.company_id = '" .$filter['company_id']. "' AND  a.object_type <> 'plan' AND a.object_type <> 'book'
        
        UNION
        
        SELECT a.*, b.title title, c.`name`, c.url, d.first_name, d.last_name, d.email 
        FROM payment_history a
        LEFT JOIN book_shop b ON b.id = a.object_id
        LEFT JOIN company c ON c.id = a.company_id
        LEFT JOIN `user` d ON d.id = a.user_id
        WHERE a.company_id = '" .$filter['company_id']. "' AND a.object_type = 'book'
        
        UNION
        
        SELECT a.*, b.name title, c.`name`, c.url, d.first_name, d.last_name, d.email 
        FROM payment_history a
        LEFT JOIN plan b ON b.id = a.object_id
        LEFT JOIN company c ON c.id = a.company_id
        LEFT JOIN `user` d ON d.id = a.user_id
        WHERE a.company_id = '" .$filter['company_id']. "' AND a.object_type = 'plan'";

        $result = $this->db->query($query)->result_array();
        $filtertotal = $this->db->count_all_results('', FALSE);
        if(isset($limit) && isset($offset))
        {
            $this->db->limit($limit, $offset);
        }
        else if(isset($limit))
        {
            $this->db->limit($limit);
        }
        $result_info = array();
        if (sizeof($result) > 0) {
            $result_info['total'] = $filtertotal;
            $result_info['filtertotal'] = $filtertotal;
            $result_info['data'] = $result;
        } else {
            $result_info['total'] = 0;
            $result_info['filtertotal'] = 0;
            $result_info['data'] = array();
        }
        return $result_info;
    }
    public function getLearnerPayment($filter){
        $query = "SELECT a.*, b.title, c.`name` FROM `payment_history` a
        LEFT JOIN course b on a.object_id = b.id
        LEFT JOIN company c ON c.id = a.company_id
        WHERE user_id = '". $filter["user_id"]. "' AND (object_type <> 'plan')
        
        UNION
        
        SELECT a.*, b.title, c.`name` FROM `payment_history` a
        LEFT JOIN book_shop b on a.object_id = b.id
        LEFT JOIN company c ON c.id = a.company_id
        WHERE user_id = '1743' AND object_type = 'book'";
        $result = $this->db->query($query)->result_array();
        $filtertotal = $this->db->count_all_results('', FALSE);
        if(isset($limit) && isset($offset))
        {
            $this->db->limit($limit, $offset);
        }
        else if(isset($limit))
        {
            $this->db->limit($limit);
        }
        $result_info = array();
        if (sizeof($result) > 0) {
            $result_info['total'] = $filtertotal;
            $result_info['filtertotal'] = $filtertotal;
            $result_info['data'] = $result;
        } else {
            $result_info['total'] = 0;
            $result_info['filtertotal'] = 0;
            $result_info['data'] = array();
        }
        return $result_info;
    }
    public function getInoviceDetail($filter){
        $this->db->select("$this->_table.*, user.first_name, user.email, user.phone, user.last_name, company.url, company.name company_name");
        $this->db->join('user', "user.id = $this->_table.user_id", 'left');
        $this->db->join('company', "company.id = user.company_id", 'left');
        if($filter['object_type'] == 'plan'){
            $this->db->join('plan', "plan.id = payment_history.object_id", 'left');
            $this->db->select('plan.name payment_title, plan.price');
        }else if($filter['object_type'] == 'training' || $filter['object_type'] == 'live' || $filter['object_type'] == 'course'){
            $this->db->join('course', "course.id = payment_history.object_id", 'left');
            $this->db->select('course.title payment_title, course.tax_type, course.tax_rate');
        } else if($filter['object_type'] == 'book'){
            $this->db->join('book_shop', "book_shop.id = payment_history.object_id", 'left');
            $this->db->select('book_shop.title payment_title');
        }
        return parent::all($filter);
    }
}
?>
