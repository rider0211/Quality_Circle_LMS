<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
class Welcome extends BaseController {
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index(){
        $this->load->view('welcome');
    }

    public function home(){
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        if (!isset($isLoggedIn) || $isLoggedIn != TRUE){
            redirect('login');
        }else{
            $this->isLearner();
            $this->load->library('Sidebar');
            $sessiondata = $this->session->get_userdata();
            $user_id = $sessiondata['user_id'];
            $header_data['name'] = $sessiondata['name'];
            $header_data['role'] = $sessiondata['user_type'];
            $header_data['roleText'] = $sessiondata['roleText'];
            $side_params = array('selected_menu_id' => '1-1');
            $header_data['sidebar'] = $this->sidebar->generate($side_params, $header_data['role']);
            //if($this->isLearner()){
            if($this->session->userdata('user_type') == 'Learner'){               
                $this->load->model('Examhistory_model');
                $cond = array("a.user_id" => $user_id);
                $exam_data = $this->Examhistory_model->getList($cond);
                $header_data['exam_count'] = count($exam_data['data']);
                $this->load->model('Course_model');
                $course_data = $this->Course_model->getHistoryByUserID($user_id);
                $header_data['course_count'] = count($course_data);
                $this->load->model('Settings_model');
                $filter['user_id'] = $user_id;
                $this->load->model('Payment_model');
                $page_data['amount'] = $this->Payment_model->totalAmountForLearner($filter);
                $header_data['site_theme'] = $this->Settings_model->getTheme();
                if (sizeof($header_data['site_theme']) >= 1){
                    $header_data['site_theme'] = $header_data['site_theme'][0];
                }
                if (sizeof($header_data['site_theme']) == 0){
                    $header_data['site_theme'] = array();
                }
                $header_data['company_name'] = $this->getSettingValue('company_name');
                $header_data['company_phone'] = $this->getSettingValue('company_phone');
                $this->loadViews('learner/dashboard', $header_data, $page_data);
            }else{
                $this->loadViews("access", $header_data, NULL, NULL);
            }
        }
    }

    function getSettingValue($action = ''){
        $value_ar = $this->Settings_model->getGlobal("action='" . $action . "'");
        if (sizeof($value_ar) > 0){
            $value_ar = $value_ar[0]['value'];
        }else{
            $value_ar = "";
        }
        return $value_ar;
    }
}
