<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


require APPPATH . '/libraries/BaseController.php';

class About  extends BaseController
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
    }

    public function index()
    {
        $this->showAbout();
    }
    public function showAbout(){
        $headerInfo['menu_name'] = 'contactus';
        $headerInfo["term"] = $this->term;
        $headerInfo['company'] = $this->company;
        $this->loadViews_front('company_page/about-us', $headerInfo);
    }
}