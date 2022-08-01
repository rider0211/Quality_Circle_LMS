<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Timon
 * Date: 2018-10-24
 * Time: past 3:02
 */

require APPPATH . '/libraries/BaseController.php';

class Contact  extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->model('User_model');
        $this->load->model('Settings_model');
        $this->load->model('Translate_model');
        $this->load->helper(array('cookie', 'string', 'language', 'url'));
        $this->load->helper('lms_email');
        $this->load->model('Course_model');
    }

    public function index()
    {
        $this->showContact();

        if($this->input->post()) {
                $jform=$this->input->post();
                $message ='';
                $message .='<b>Name: </b>'.$jform['jform']['contact_name']; 
                $message .='<br><b>Email: </b>'.$jform['jform']['contact_email']; 
                $message .='<br><b>Subject: </b>'.$jform['jform']['contact_subject']; 
                $message .='<br><b>Message: </b>'.$jform['jform']['contact_message']; 
                $message .='<br><b>Service Offered: </b>'.$jform['jform']['com_fields']['services-offered']; 
                $message .='<br><b>Standards: </b>'.$jform['jform']['com_fields']['standards']; 
                
                $from_email = "vmsofttrix@gmail.com"; 
                $to_email = "vmsofttrix@gmail.com";

            //Load email library 
                $this->load->library('email'); 
                $this->email->set_mailtype("html");
                $this->email->from($from_email, 'GoSmart Academy'); 
                $this->email->to($to_email);
                $this->email->subject('Email Test'); 
                $this->email->message($message); 
                
            //Send mail 
                if($this->email->send()) {
                    $this->session->set_flashdata("email_sent","Email sent successfully."); 
                } else {
                    $this->session->set_flashdata("email_sent","Error in sending Email.");    
                }
        }
    }
    public function showContact(){
        $headerInfo['menu_name'] = 'contactus';
        $headerInfo["term"] = $this->term;
        $this->loadViews_front('contact', $headerInfo);
    }

    public function search(){
        $search = $this->input->get('term');
        $start = 0;
        $filter['start'] = $start;
        $filter['search'] = $search;
        $filter['create_id'] = 1;
        $params = $this->Course_model->all($filter);
        $res  =array();
        if($params){
            foreach($params as $row){ 
                $res[] = $row->title; 
            }
        }else{
            $res = array();
        } 
        echo json_encode($res);
    }
}