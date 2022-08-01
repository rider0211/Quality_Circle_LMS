<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
require APPPATH . '/third_party/PHPExcel.php';
/**
 * Created by PhpStorm.
 * User: Timon
 * Date: 2018-10-24
 * Time: PM 3:00
 */

class User extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Certification_model');
        $this->load->model('Notification_model');
        $this->load->model('Company_model');
        $this->load->model('Examassignemployee_model');
        $this->load->model('Exam_model');
        $this->load->model('Translate_model');
        $this->isLoggedIn();
    }
}