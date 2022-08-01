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
        //$sessiondata = $this->session->get_userdata();
        //$this->load->view('dashboard', $sessiondata);
        $page_data["term"] = $this->term;
        $this->load->view('welcome', $page_data);
    }

    public function home(){
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        $this->load->library('Sidebar');
        $sessiondata = $this->session->get_userdata();
        $header_data['name'] = $sessiondata['name'];
        $header_data['role'] = $sessiondata['user_type'];
        $header_data['roleText'] = $sessiondata['roleText'];
        $side_params = array('selected_menu_id' => '1-1');
        $header_data['sidebar'] = $this->sidebar->generate($side_params, $header_data['role']);
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE){
            $page_data["term"] = $this->term;
            $this->load->view('login', $page_data);
        }else{            
            if($this->session->userdata('user_type') == 'Superadmin'){
                $this->load->model('Company_model');
                $page_data["company_count"] = $this->Company_model->count();
                $this->load->model('Course_model');
                $page_data["certification_count"] = $this->Course_model->getCertificateHistoryCount();
                $this->load->model('User_model');
                $page_data["employee_count"] = $this->User_model->getAdminCount();
                //
                //            $this->load->model('Topic_model');
                //            $page_data[topic_count] = $this->Topic_model->count();
                //
                //            $this->load->model('Account_model');
                //            $page_data[amount] = sprintf("%0.2f", $this->Account_model->getTotalAmount(array()));
                $this->load->model('Payment_model');
                $page_data['amount'] = $this->Payment_model->totalAmountForSuper();
                $list = $this->User_model->getList(array('user_type' => 'Admin'));
                $cnt = 0;
                foreach($list as $item){
                    $datetime = date("Y-m-d H:i:s", time() - 10 * 60);
                    if($item['last_login'] > $datetime){
                        $cnt++;
                    }
                }
                $page_data["logined_usercount"] = $cnt;
                //            $this->load->model('Certification_model');
                //            $this->load->model('Traininghistory_model');
                //            $certification_year = $this->Certification_model->getUserPerYear();
                $certification_status = array();
                //            foreach($certification_year as $key => $item){
                //                $year = $item[year];
                //                $item[training_count] = $this->Traininghistory_model->getEmployeeCountperYear($year);
                //                $certification_status[] = $item;
                //            }
                $page_data["certification_status"] = $certification_status;
                //            $this->load->model('Activity_model');
                //			$page_data[activity_datalist] = $this->Activity_model->getList(array(), 20);
                $this->load->model('Settings_model');
                $header_data['site_theme'] = $this->Settings_model->getTheme();
                if(sizeof($header_data['site_theme']) >= 1){
                    $header_data['site_theme'] = $header_data['site_theme'][0];
                }
                if(sizeof($header_data['site_theme']) == 0){
                    $header_data['site_theme'] = array();
                }
                $header_data['company_name'] = $this->getSettingValue('company_name');
                $header_data['company_phone'] = $this->getSettingValue('company_phone');
                $header_data["term"] = $this->term;
                $page_data["term"] = $this->term;
                $this->load->view('_templates/header', $header_data);
                $this->load->view('superadmin/dashboard', $page_data);
                $this->load->view('_templates/footer');
            }else{
                $this->loadViews("access", $header_data, NULL, NULL);
            }
        }
    }

    function getSettingValue($action = ''){
        $value_ar = $this->Settings_model->getGlobal("action='" . $action . "'");
        if(sizeof($value_ar) > 0){
            $value_ar = $value_ar[0]['value'];
        }else{
            $value_ar = "";
        }
        return $value_ar;
    }

    function cleanupdata(){
        $this->load->helper('directory');
        $upload_dir = "assets/uploads/";
        /*users*/
        $dir = 'user/photo/';
        $table = "users";
        $field = "picture";
        $files = directory_map($upload_dir . $dir);
        foreach($files as $file){
            /*default.jpg default.png*/
            if(is_int(strpos($file, "default")) && strpos($file, "default") == 0) continue;
            $file_path = $upload_dir . $dir . $file;
            $this->db->where($field, $file_path);
            $select_result = $this->db->get($table)->row();
            if(!$select_result){
                print_r($file_path . "<br>");
                unlink($file_path);
            }
        }
        /*training category*/
        $dir = "category/";
        $table = "training_category";
        $field = "image";
        $files = directory_map($upload_dir . $dir);
        foreach($files as $file){
            $file_path = $upload_dir . $dir . $file;
            $value = explode("_", $file);
            $this->db->where("id", $value[0]);
            if(count($value) > 1) $this->db->where($field, $value[1]);
            $select_result = $this->db->get($table)->row();
            if(!$select_result){
                print_r($file_path . "<br>");
                unlink($file_path);
            }
        }
        /*training lesson*/
        $dir = "lesson/";
        $table = "training_lesson";
        $field = "lesson_content";
        $files = directory_map($upload_dir . $dir);
        foreach($files as $key => $temp){
            foreach($temp as $file){
                $file_path = $upload_dir . $dir . $key . $file;
                $value = explode("_", $key);
                if(count($value) > 1) $this->db->where("id", $value[1]);
                $this->db->where($field, $file);
                $select_result = $this->db->get($table)->row();
                if(!$select_result){
                    print_r($file_path . "<br>");
                    unlink($file_path);
                }
            }
        }
        /*training topic*/
        $dir = "topic/";
        $table = "training_topic";
        $field = "image";
        $files = directory_map($upload_dir . $dir);
        foreach($files as $file){
            $file_path = $upload_dir . $dir . $file;
            $value = explode("_", $file);
            $this->db->where("id", $value[0]);
            if(count($value) > 1) $this->db->where($field, $value[1]);
            $select_result = $this->db->get($table)->row();
            if(!$select_result){
                print_r($file_path . "<br>");
                unlink($file_path);
            }
        }
        /*exam_quiz*/
        $dir = 'quiz/';
        $table = "exam_quiz";
        $field = "quiz_obj_path";
        $files = directory_map($upload_dir . $dir);
        foreach($files as $file){
            $file_path = $upload_dir . $dir . $file;
            $this->db->where($field, $file_path);
            $select_result = $this->db->get($table)->row();
            if(!$select_result){
                print_r($file_path . "<br>");
                unlink($file_path);
            }
        }
        /*exam_exam*/
        //        $dir = "exam/";  $table = "exam_exam";
        //        $field = "exam_image";
        //        $files = directory_map($upload_dir . $dir);
        //        foreach($files as $file){
        //            $file_path = $upload_dir . $dir . $file;
        //            $value = explode("_", $file);
        //            $this->db->where("id", $value[0]);
        //            if(count($value) > 1)
        //                $this->db->where($field, $value[1]);
        //
        //            $select_result = $this->db->get($table)->row();
        //            if(!$select_result){
        //                print_r($file_path . "<br>");
        //                unlink($file_path);
        //            }
        //        }
        print_r("<br>All unusable data deleted");
    }
}
