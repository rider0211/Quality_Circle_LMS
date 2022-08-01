<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Notification_model extends CI_Model {

    /**
     * This function used to manage exams
     */
    protected $table;

	public function __construct() {
        parent::__construct();
        $this->table = 'notification';        
    }

    public function getAll() {
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    public function getByUserID($id, $limit=true) {
        // urutkan dari yang paling baru
        $this->db->order_by('created_at', 'DESC');
        if ($limit) {
            $this->db->from($this->table);
            $this->db->where('to_user_id', $id);
            $this->db->where('is_read', 0);
            //$this->db->limit(5);
            $query = $this->db->get();
        } else {
            $query = $this->db->get_where($this->table, ['user_id' => $id]);
        }
        return $query->result_array();
    }

    public function getByUseremail($email) {
    	$this->db->order_by('created_at', 'DESC');
        $query = $this->db->get_where($this->table, ['email' => $email], 10);
        return $query->result();
    }

    /*public function create() {
        $data = array(
            'to_user_id' => $this->input->post('user_id'),
            'notification_title' => $this->input->post('title'),
            'notification_message' => $this->input->post('message')
        );

        $this->db->insert($this->table, $data);
    }*/

    public function create($data) {
        $data["created_at"] = date("y-m-d H:i:s");
        $this->db->insert($this->table, $data);
    }

    public function update_read($id='') {
        $data["updated_at"] = date("y-m-d H:i:s");
        $data["is_read"] = 1;        
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);       
    }


    public function getTrainingNotificationList($step_date = array()){

        $where = '';
        foreach($step_date as $step_day){
            if ($where != '') $where .= ' or ';
            $where .= ' mod ( DATEDIFF(now(), a.start_date) + ' . $step_day . ', b.repeat_days) = 0';
        }
        $sql = '
            SELECT
                a.id, b.training_title, b.category_id, now(), a.start_date,
                b.repeat_days, b.email_notification, b.sms_notification, c.phone_number, c.email,c.notification_method,
                d.category_name category
            FROM training_assign_employee a
                LEFT JOIN training_topic b on a.topic_id = b.id
                LEFT JOIN users c on a.employee_id = c.id
                LEFT JOIN training_category d on b.category_id = d.id';

        if ($where != '')
            $sql .= ' where ' . $where;

        //print_r($sql.'<br>');

        return $this->db->query($sql)->result_array();
    }

    public function getExamNotificationList($step_date = array()){

        $where = '';
        foreach($step_date as $step_day){
            if ($where != '') $where .= ' or ';
            $where .= ' mod ( DATEDIFF(now(), a.start_date) + ' . $step_day . ', b.repeat_days) = 0';
        }
        $sql = '
            SELECT
                a.id, b.exam_title, b.exam_category_id, now(), a.start_date,
                b.repeat_days, b.email_notification, b.sms_notification, c.phone_number, c.email,c.notification_method,
                d.exam_category_name category
            FROM exam_assign_employee a
                LEFT JOIN exam_exam b on a.exam_id = b.id
                LEFT JOIN users c on a.employee_id = c.id
                LEFT JOIN exam_category d on b.exam_category_id = d.id';

        if ($where != '')
            $sql .= ' where ' . $where;

        //print_r($sql.'<br>');

        return $this->db->query($sql)->result_array();
    }

}