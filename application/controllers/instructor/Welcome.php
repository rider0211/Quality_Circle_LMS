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
    public function index() {
        $this->load->view('welcome');
    }

    public function home() {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE) {
            redirect('login');
        }else{
            $this->load->library('Sidebar');
            $sessiondata = $this->session->get_userdata();
            $header_data['name'] = $sessiondata['name'];
            $header_data['role'] = $sessiondata['user_type'];
            $header_data['roleText'] = $sessiondata['roleText'];
            $side_params = array('selected_menu_id' => '1-1');
            $header_data['sidebar'] = $this->sidebar->generate($side_params, $header_data['role']);
            if($this->session->userdata('user_type') == 'Instructor'){                
            //if($this->isInstructor()){
                $this->load->model('User_model');
                $page_data['learner_count'] = $this->User_model->getEmployeeCount(array('company_id' => $this->session->get_userdata() ['company_id'], 'user_type' => 'Learner'));
                $this->load->model('Course_model');
                $page_data["certification_count"] = $this->Course_model->getCertificateHistoryCount($this->session->get_userdata() ['company_id']);
                $this->load->model('Exam_model');
                $page_data["exam_count"] = $this->Exam_model->count(array('create_id' => $this->session->get_userdata() ['userId']));
                //
                //            $this->load->model('Topic_model');
                //            $page_data[topic_count] = $this->Topic_model->count();
                //
                //            $this->load->model('Account_model');
                //            $page_data[amount] = sprintf("%0.2f", $this->Account_model->getTotalAmount(array()));
                $page_data["amount"] = 999;
                $list = $this->User_model->getList(array('user_type' => 'Learner', 'company_id' => $this->session->get_userdata() ['company_id']));
                $cnt = 0;
                foreach($list as $item) {
                    $datetime = date("Y-m-d H:i:s", time() - 10 * 60);
                    if($item['last_login'] > $datetime) {
                        $cnt++;
                    }
                }
                $page_data["logined_usercount"] = $cnt;
                $this->load->model('Settings_model');
                $header_data['site_theme'] = $this->Settings_model->getTheme();
                if(sizeof($header_data['site_theme']) >= 1) {
                    $header_data['site_theme'] = $header_data['site_theme'][0];
                }
                if(sizeof($header_data['site_theme']) == 0) {
                    $header_data['site_theme'] = array();
                }
                $header_data['company_name'] = $this->getSettingValue('company_name');
                $header_data['company_phone'] = $this->getSettingValue('company_phone');
                $this->loadViews('instructor/dashboard', $header_data, $page_data);
            }else{
                $this->loadViews("access", $header_data, NULL, NULL);
            }
        }
    }

    function getSettingValue($action = '') {
        $value_ar = $this->Settings_model->getGlobal("action='" . $action . "'");
        if(sizeof($value_ar) > 0) {
            $value_ar = $value_ar[0]['value'];
        }else{
            $value_ar = "";
        }
        return $value_ar;
    }
}
