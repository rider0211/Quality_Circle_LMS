<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Scheduler extends BaseController {
	
	 public function __construct(){
        parent::__construct();
		$this->load->model('Course_model');
        $this->isLoggedIn();  
		$this->load->library('Sidebar');
		$side_params = array('selected_menu_id'=>'004-1');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        
	}
	
	public function schedulerCourse(){
		$this->load->library('Sidebar');
        if($this->isMasterAdmin()){
			$this->global['courses'] = $this->Course_model->getCronJobCourse();
			$this->loadViews("admin/scheduler/course_scheduler_home",$this->global, NULL , NULL);
		}else{
            $this->loadViews("access", $this->global, NULL , NULL);
		}
	}
	
	public function viewSchedulerCourse(){
		if($this->isMasterAdmin()){
			$this->loadViews("admin/scheduler/course_scheduler",$this->global, NULL , NULL);
		}else{
            $this->loadViews("access", $this->global, NULL , NULL);
		}
	}
	
}