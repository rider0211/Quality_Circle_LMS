<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller
{

    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Plan_model');
    }

    public function get_user_by_apikey($api_key = NULL){
        $data = array();
        if(!isset($api_key))
            $this->response($data);
        $data = $this->User_model->getList(array('api_key'=>$api_key,'user_type !='=>'superadmin'))[0];
        unset($data['password']);
        $this->response($data);
    }

    public function get_vilt_limit_by_apikey($api_key = NULL){
        $result = array();
        if(!isset($api_key))
            $this->response($data);
        
        $data = $this->User_model->getList(array('api_key'=>$api_key,'user_type !='=>'superadmin'))[0];
        $plan_id = $data['plan_id'];
        $plan = $this->Plan_model->select($plan_id);

        $result['vilt_room_user'] = 0;
        $result['vilt_room'] = 0;
        if(!empty($plan)){
            $result['vilt_room_user'] = $plan->vilt_user_limit;
            $result['vilt_room'] = $plan->vilt_room_limit;
        }
        
        $this->response($result);
    }
    public function response($data = NULL) {
        $this->output->set_status_header ( 200 )->set_content_type ( 'application/json', 'utf-8' )->set_output ( json_encode ( $data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) )->_display ();
        exit ();
    }

}

?>
