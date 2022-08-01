<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Inviteuser extends BaseController{

    public function __construct(){
        parent::__construct();
        $this->load->model('Inviteuser_model');
        $this->load->model('Course_model');
        $this->load->model('Company_model');
		$this->load->model('Virtualcourse_model');
		$this->load->model('Trainingcourse_model');		
		$this->load->model('Category_model');
		$this->load->model('Standard_model');
		$this->load->model('User_model');
		$this->load->model('Plan_model');
		
        $this->isLoggedIn();
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id'=>'5');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
    }

    public function index(){       
        if($this->isMasterAdmin()){

        }else{
            $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL , NULL);
        }        
    }
 
    public function getInviteUser(){
		$res = [];
		if($this->input->post('id') != ''){
			$tid = $this->input->post('id');
			$course_type = $this->input->post('course_type');
			$res = $this->Inviteuser_model->getInviteUser($tid,$course_type);
			foreach ($res as $key => $row) {
				$res[$key]["no"] = $key + 1;
			}
		}
        $records["data"] = $res;
        $this->response($records);
    }
	
	public function getInviteUserVirtual(){
		$res = [];
		if($this->input->post('id') != ''){
			$tid = $this->input->post('id');
			$course_type = $this->input->post('course_type');
			$res = $this->Inviteuser_model->getInviteUserVirtual($tid,$course_type);
			foreach ($res as $key => $row) {
				$res[$key]["no"] = $key + 1;
			}
		}
        $records["data"] = $res;
        $this->response($records);
    }
	
	public function editInviteuser(){
		$data['first_name'] = $this->input->post('first_name');
        $data['last_name'] = $this->input->post('last_name');
        $data['email'] = trim($this->input->post('email'));
		
		$this->Inviteuser_model->update_user($data,$this->input->post('edit_invite_id'));
		echo "success";
	}
	
	public function createInviteuserOld($type = '', $flag = '0'){
        $data['first_name'] = $this->input->post('first_name');
        $data['last_name'] = $this->input->post('last_name');
        $data['email'] = trim($this->input->post('email'));
        $data['course_id'] = $this->input->post('course_id');
		$data['virtual_course_time_id'] = $this->input->post('add_course_time_id');
        $data['course_type'] = $this->input->post('course_type');
		
		$temp = $this->Inviteuser_model->getInviteUserCount($data['course_id'],$data['course_type'],$data['email']);
        if($flag == '1' && $temp == 0){
            $res = $this->Inviteuser_model->insert($data);
        }

        $company_id = $this->session->userdata('company_id');
        $course_data = $this->Course_model->getCourseById($data['course_id']);
		//$courseArr = ['enroll_users' => $course_data['enroll_users']+1];
		//$this->Course_model->update_course($courseArr,$data['course_id']);
        $this->load->library('email');
        $email_temp = $this->getEmailTemp('assign_course',$company_id);
        $content = $email_temp['message'];
        $title = $email_temp['subject'];

        $content = str_replace("{USERNAME}", $data["first_name"].' '.$data["last_name"], $content);
        $URL = $this->Company_model->getList(array('id'=>$this->session->userdata('company_id')))[0]['url'];
        $course_html = "<a href='". base_url('company/'.$URL.'/'.$type.'/view/'.$data['course_id'])."' >" . $course_data["title"] . "</a>";
        $content = str_replace("{COURSE_NAME}", $course_html , $content);
        $content = str_replace("{LOGO}", "<img src='" . base_url('assets/logos/logo1.png') . "'/>"."<img src='" . base_url('assets/logos/logo2.png') . "'/>", $content);
        $content = str_replace("{CATEGORY}", $course_data["category_name"], $content);
        if($course_data["standard_name"]) {
            $content = str_replace("{STANDARD}", $course_data["standard_name"], $content);
        }else{
            $content = str_replace("{STANDARD}", 'ISO 22000:2018', $content);
        }

        if($course_data["location"]) {
            $content = str_replace("{LOCATION}", $course_data["location"], $content);
        }else{
            $content = str_replace("{LOCATION}", '', $content);
        }
        
        $this->sendemail($data['email'],$data['first_name'].' '.$data['last_name'],$content,$title);

        echo "success";
    }
	public function addExistUser($type = '', $flag = '0'){
		$data['course_id'] = $this->input->post('course_id');
		$data['virtual_course_time_id'] = $this->input->post('add_course_time_id');
		$data['ilt_course_time_id'] = $this->input->post('add_ilt_time_id');		
        $data['course_type'] = $this->input->post('course_type');
		$data['user_id'] = $this->input->post('user_id');
		$data['company_id'] = $this->session->userdata('company_id');
		$result = array("success"=> true, "msg"=>"success");

		$user = (array) $this->User_model->select($this->session->get_userdata()['user_id']);
		// $plan = $this->Plan_model->getPlanCompany($this->session->get_userdata()['company_id']);
        $plan = $this->Plan_model->select($user['plan_id']);
		if(!$plan->id){
            $plan = $this->Plan_model->select('1');
        }
		if($this->Inviteuser_model->getAll($data)){
			$result = array("success"=> false, "msg"=>"User already invited");
			$this->response($result);
		}else{
			$user_data = $this->User_model->getList(array('id' => $data['user_id'])) [0];

			$data['first_name'] = $user_data['first_name'];
			$data['last_name'] = $user_data['last_name'];
			$data['email'] = $user_data['email'];

			if($data['course_type'] == 2){
				$temp = $this->Inviteuser_model->getInviteUserCount($data['course_id'],$data['course_type'],$data['email']);
			}else{
				if($data['course_type'] == 1){
					$time_id = $data['virtual_course_time_id'];	
					$limit = $this->Inviteuser_model->getLimitation($data['company_id'], 1);
					if($limit >= $plan->user_limit){
						$result = array("success"=> false, "msg"=>"Full maximum VILT user");
						$this->response($result);
					}
					
				}else{
					$time_id = $data['ilt_course_time_id'];	
					$limit = $this->Inviteuser_model->getLimitation($data['company_id'], 0);
					if($limit >= $plan->user_limit){
						$result = array("success"=> false, "msg"=>"Full maximum ILT user");
						$this->response($result);
					}
				}
				$temp = $this->Inviteuser_model->getInviteUserCountFront($data['course_id'],$data['course_type'],$data['email'],$time_id);
				if($temp != 0 ){
					$result = array("success"=> false, "msg"=>"User already invited");
					$this->response($result);
				}
			}	
			
			if($flag == '1' && $temp == 0){
				$res = $this->Inviteuser_model->insert($data);
			}
			
			$company_id = $this->session->userdata('company_id');
			if($data['course_type'] == 1){
				$course_datas = $this->Virtualcourse_model->getCourseById($data['course_id']);			
				$data['course_id'] = $data['virtual_course_time_id'];
				$course_data["category_name"] = '';
				if(isset($course_datas['category']) && !empty($course_datas['category'])){
					$categoryData = $this->Category_model->getRow($course_datas['category']);
					$course_data["category_name"] = $categoryData[0]['name'];
				}
				$course_data["title"] = ucwords($course_datas['title']);
				$course_data["location"] = $course_datas['location'];
				$standardname = '';
				if(isset($course_datas['standard_id']) && !empty($course_datas['standard_id'])){
					$course_datas['standard_id'] = str_replace("[","",$course_datas['standard_id']);
					$course_datas['standard_id'] = str_replace("]","",$course_datas['standard_id']);
					$course_datas['standard_id'] = str_replace('"',"",$course_datas['standard_id']);
					$standards = explode(',',$course_datas['standard_id']);			
					foreach($standards as $standard){
						$categoryStandardData = $this->Standard_model->getRow($standard);
						if(isset($categoryStandardData[0]['name']) && !empty($categoryStandardData[0]['name'])){
							$standardname .= $categoryStandardData[0]['name'].', ';
						}
					}
				}
				$course_data["standard_name"] = $standardname;
			}
			if($data['course_type'] == 0){
				$course_datas = $this->Trainingcourse_model->getRow($data['course_id']);
				$course_data["category_name"] = '';			
				if(isset($course_datas->category) && !empty($course_datas->category)){
					$categoryData = $this->Category_model->getRow($course_datas->category);
					$course_data["category_name"] = $categoryData[0]['name'];
				}
				$course_data["title"] = ucwords($course_datas->title);
				$course_data["location"] = $course_datas->location;			
				$standardname = '';
				if(isset($course_datas->standard_id) && !empty($course_datas->standard_id)){
					$course_datas->standard_id = str_replace("[","",$course_datas->standard_id);
					$course_datas->standard_id = str_replace("]","",$course_datas->standard_id);
					$course_datas->standard_id = str_replace('"',"",$course_datas->standard_id);
					$standards = explode(',',$course_datas->standard_id);			
					foreach($standards as $standard){
						$categoryStandardData = $this->Standard_model->getRow($standard);
						if(isset($categoryStandardData[0]['name']) && !empty($categoryStandardData[0]['name'])){
							$standardname .= $categoryStandardData[0]['name'].', ';
						}
					}
				}
				$course_data["standard_name"] = $standardname;
				$data['course_id'] = $data['ilt_course_time_id'];
			}		
			if($data['course_type'] == 2){
				$course_data = $this->Course_model->getCourseById($data['course_id']);
			}
			//$courseArr = ['enroll_users' => $course_data['enroll_users']+1];
			//$this->Course_model->update_course($courseArr,$data['course_id']);
			$this->load->library('email');
			$email_temp = $this->getEmailTemp('assign_course',$data['company_id']);
			$content = $email_temp['message'];
			$title = $email_temp['subject'];
	
			$content = str_replace("{USERNAME}", $data["first_name"].' '.$data["last_name"], $content);
			$URL = $this->Company_model->getList(array('id'=>$this->session->userdata('company_id')))[0]['url'];
			$course_html = "<a href='". base_url('company/'.$URL.'/'.$type.'/view/'.$data['course_id'])."' >" . $course_data["title"] . "</a>";
			$content = str_replace("{COURSE_NAME}", $course_html , $content);
			$content = str_replace("{LOGO}", "<img src='" . base_url('assets/logos/logo1.png') . "'/>"."<img src='" . base_url('assets/logos/logo2.png') . "'/>", $content);
			$content = str_replace("{CATEGORY}", $course_data["category_name"], $content);
			if(isset($course_data["standard_name"]) && !empty($course_data["standard_name"])) {
				$content = str_replace("{STANDARD}", $course_data["standard_name"], $content);
			}else{
				$content = str_replace("{STANDARD}", 'ISO 22000:2018', $content);
			}
	
			if($course_data["location"]) {
				$content = str_replace("{LOCATION}", $course_data["location"], $content);
			}else{
				$content = str_replace("{LOCATION}", '', $content);
			}
			$this->sendemail($data['email'],$data['first_name'].' '.$data['last_name'],$content,$title);
	
			$this->response($result);
		}
		
	}
    public function createInviteuser($type = '', $flag = '0'){
        $data['first_name'] = $this->input->post('first_name');
        $data['last_name'] = $this->input->post('last_name');
        $data['email'] = trim($this->input->post('email'));
        $data['course_id'] = $this->input->post('course_id');
		$data['virtual_course_time_id'] = $this->input->post('add_course_time_id');
		$data['ilt_course_time_id'] = $this->input->post('add_ilt_time_id');		
        $data['course_type'] = $this->input->post('course_type');
		$data['company_id'] = $this->session->userdata('company_id');  // add company ID in invite user table
		$user = (array) $this->User_model->select($this->session->get_userdata()['user_id']);
		// $plan = $this->Plan_model->getPlanCompany($this->session->get_userdata()['company_id']);
        $plan = $this->Plan_model->select($user['plan_id']);
		$total_count = $this->User_model->count(array('company_id'=>$data['company_id']));

		$result = array("success"=> true, "msg"=>"success");
		if($total_count >= $plan->user_limit){
			$result = array("success"=> false, "msg"=>"Full of User Limitation");
			$this->response($result);
		}else{
			if($data['course_type'] == 2){
				$temp = $this->Inviteuser_model->getInviteUserCount($data['course_id'],$data['course_type'],$data['email']);
			}else{
				if($data['course_type'] == 1){
					$time_id = $data['virtual_course_time_id'];	
					$limit = $this->Inviteuser_model->getLimitation($data['company_id'], 1);
					if($limit >= $plan->user_limit){
						$result = array("success"=> false, "msg"=>"Full maximum VILT user");
						$this->response($result);
					}
					
				}else{
					$time_id = $data['ilt_course_time_id'];	
					$limit = $this->Inviteuser_model->getLimitation($data['company_id'], 0);
					if($limit >= $plan->user_limit){
						$result = array("success"=> false, "msg"=>"Full maximum ILT user");
						$this->response($result);
					}
				}
				$temp = $this->Inviteuser_model->getInviteUserCountFront($data['course_id'],$data['course_type'],$data['email'],$time_id);
				if($temp != 0 && $flag != 0 ){
					$result = array("success"=> false, "msg"=>"User already invited");
					$this->response($result);
				}
			}		
			if($flag == '1'){
			    $res = $this->Inviteuser_model->insert($data);
			}
			$company_id = $this->session->userdata('company_id');
			if($data['course_type'] == 1){
				$course_datas = $this->Virtualcourse_model->getCourseById($data['course_id']);			
				$data['course_id'] = $data['virtual_course_time_id'];
				$course_data["category_name"] = '';
				if(isset($course_datas['category']) && !empty($course_datas['category'])){
					$categoryData = $this->Category_model->getRow($course_datas['category']);
					$course_data["category_name"] = $categoryData[0]['name'];
				}
				$course_data["title"] = ucwords($course_datas['title']);
				$course_data["location"] = $course_datas['location'];
				$standardname = '';
				if(isset($course_datas['standard_id']) && !empty($course_datas['standard_id'])){
					$course_datas['standard_id'] = str_replace("[","",$course_datas['standard_id']);
					$course_datas['standard_id'] = str_replace("]","",$course_datas['standard_id']);
					$course_datas['standard_id'] = str_replace('"',"",$course_datas['standard_id']);
					$standards = explode(',',$course_datas['standard_id']);			
					foreach($standards as $standard){
						$categoryStandardData = $this->Standard_model->getRow($standard);
						if(isset($categoryStandardData[0]['name']) && !empty($categoryStandardData[0]['name'])){
							$standardname .= $categoryStandardData[0]['name'].', ';
						}
					}
				}
				$course_data["standard_name"] = $standardname;
			}
			if($data['course_type'] == 0){
				$course_datas = $this->Trainingcourse_model->getRow($data['course_id']);
				$course_data["category_name"] = '';			
				if(isset($course_datas->category) && !empty($course_datas->category)){
					$categoryData = $this->Category_model->getRow($course_datas->category);
					$course_data["category_name"] = $categoryData[0]['name'];
				}
				$course_data["title"] = ucwords($course_datas->title);
				$course_data["location"] = $course_datas->location;			
				$standardname = '';
				if(isset($course_datas->standard_id) && !empty($course_datas->standard_id)){
					$course_datas->standard_id = str_replace("[","",$course_datas->standard_id);
					$course_datas->standard_id = str_replace("]","",$course_datas->standard_id);
					$course_datas->standard_id = str_replace('"',"",$course_datas->standard_id);
					$standards = explode(',',$course_datas->standard_id);			
					foreach($standards as $standard){
						$categoryStandardData = $this->Standard_model->getRow($standard);
						if(isset($categoryStandardData[0]['name']) && !empty($categoryStandardData[0]['name'])){
							$standardname .= $categoryStandardData[0]['name'].', ';
						}
					}
				}
				$course_data["standard_name"] = $standardname;
				$data['course_id'] = $data['ilt_course_time_id'];
			}		
			if($data['course_type'] == 2){
				$course_data = $this->Course_model->getCourseById($data['course_id']);
			}
			//$courseArr = ['enroll_users' => $course_data['enroll_users']+1];
			//$this->Course_model->update_course($courseArr,$data['course_id']);
			$this->load->library('email');
			$email_temp = $this->getEmailTemp('assign_course',$data['company_id']);
			$content = $email_temp['message'];
			$title = $email_temp['subject'];

			$content = str_replace("{USERNAME}", $data["first_name"].' '.$data["last_name"], $content);
			$URL = $this->Company_model->getList(array('id'=>$this->session->userdata('company_id')))[0]['url'];
			$course_html = "<a href='". base_url('company/'.$URL.'/'.$type.'/view/'.$data['course_id'])."' >" . $course_data["title"] . "</a>";
			$content = str_replace("{COURSE_NAME}", $course_html , $content);
			$content = str_replace("{LOGO}", "<img src='" . base_url('assets/logos/logo1.png') . "'/>"."<img src='" . base_url('assets/logos/logo2.png') . "'/>", $content);
			$content = str_replace("{CATEGORY}", $course_data["category_name"], $content);
			if(isset($course_data["standard_name"]) && !empty($course_data["standard_name"])) {
			    $content = str_replace("{STANDARD}", $course_data["standard_name"], $content);
			}else{
			    $content = str_replace("{STANDARD}", 'ISO 22000:2018', $content);
			}

			if($course_data["location"]) {
			    $content = str_replace("{LOCATION}", $course_data["location"], $content);
			}else{
			    $content = str_replace("{LOCATION}", '', $content);
			}
			$this->sendemail($data['email'],$data['first_name'].' '.$data['last_name'],$content,$title);
			$this->response($result);
		}
    }

    public function deleteInviteuser(){
        $id = $this->input->post('id');
        return $this->Inviteuser_model->remove($id);
    }

    public function get_Inviteuser(){
        $email = $this->input->post('email');
        $type = $this->input->post('type');
        $course_id = $this->input->post('course_id');
		$time_id = $this->input->post('time_id');
        echo json_encode($this->Inviteuser_model->getInviteUserCountFront($course_id,$type,$email,$time_id)) ;
    }    

}

?>