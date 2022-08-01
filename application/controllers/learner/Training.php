<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
class Training extends BaseController {
    /**
     * This is default constructor of the class
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('Training_model');
		$this->load->helper('common');
        $this->load->model('Account_model');
		$this->load->model('Enrollments_model');
		$this->load->model('Course_model');	
        $this->load->model('Company_model');
		
        $this->isLoggedIn();
        $this->isLearner();
    }
    /**
     * This function used to load the default screen of trainingassign menu
     */
    public function index(){
        // $this->showTraining();
        $this->getTraining();
    }

    public function showTraining(){		
        $location = $this->input->get('location');
		$course = $this->input->get('course');
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '5');
        $this->global["sidebar"] = $this->sidebar->generate($side_params, $this->role);
        // if($this->isLearner()){
        $training_data = array();
        if($location != null && $location != 'all') {
            $res_id_list = $this->Training_model->getListByCompanyIdLocation($this->session->get_userdata() ['company_id'], $location);
        }else if($course != null && $course != 'all') {
            //$res_id_list = $this->Training_model->getListByCompanyIdCourse($course);
            $res_id_list = $this->Training_model->select($course);				
            if(is_object($res_id_list)){								
                $objarray = json_decode(json_encode($res_id_list), true);
                $res_id_list = [$objarray];	
            }
        }else{
            $res_id_list = $this->Training_model->getListByCompanyId($this->session->get_userdata()['company_id']);
        }
        $res_pay_list = $this->Training_model->getPayCourseList($this->session->get_userdata()['user_id']);
        $training_data['course_list'] = $res_id_list;
        $training_data['course_filter_list'] = $this->Training_model->getListByCompanyId($this->session->get_userdata()['company_id']);
        $training_data['pay_course_list'] = $res_pay_list;
        $training_data['location'] = $this->Training_model->getLocation();
        $training_data['location_name'] = $location;
        $training_data['course_name'] = $course;
        $this->loadViews("learner/training/training_list", $this->global, $training_data, NULL);
        // }else{
        //     $this->loadViews("access", $this->global, NULL, NULL);
        // }
    }

    public function getTraining(){		
        $location = $this->input->get('location');
		$course = $this->input->get('course');
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '5');
        $this->global["sidebar"] = $this->sidebar->generate($side_params, $this->role);
        $user = $this->session->userdata();
        // if($this->isLearner()){
            $training_data = array();
            
            $res_free_courses = $this->Training_model->getFreeCourses($this->input->get());
            $res_paid_courses = $this->Training_model->getPaidCourses($this->input->get());
            $training_data['free_course_list'] = $res_free_courses;
            $training_data['course_filter_list'] = $this->Training_model->getListByCompanyId($this->session->get_userdata()['company_id']);
            $training_data['paid_course_list'] = $res_paid_courses;
            $training_data['location'] = $this->Training_model->getLocation();
            $training_data['location_name'] = $location;
            $training_data['course_name'] = $course;
            $training_data['company'] = $this->Company_model->getListByID($user['company_id'])[0];
            // print_r($training_data['course_filter_list']);
            // die;
            $this->loadViews("learner/training/training_list", $this->global, $training_data, NULL);
        // }else{
        //     $this->loadViews("access", $this->global, NULL, NULL);
        // }
    }

    public function booknow(){
        $course_time_id = $this->input->post('course_time_id');
		$course_id = $this->input->post('course_id');
        $data['training_course_time_id'] = $course_time_id;
        $data['user_id'] = $this->session->get_userdata() ['user_id'];
        
		$course = (array)$this->Course_model->select($course_id);
		$enrolledUsersCount = $this->Enrollments_model->getEnrolledList($this->session->get_userdata()['user_id'],$course_id,$course_time_id);		
		if($enrolledUsersCount == 0){
			$enrolled_data = array(
				'user_id' => $this->session->get_userdata()['user_id'],
				'course_id' => $course_id,			
				'course_time_id' => $course_time_id,					
				'course_title' => $course['title'],
				'user_name' => $this->session->get_userdata()['user_name'],
				'user_email' => $this->session->get_userdata()['email'],
				'create_date' => date("Y-m-d H:i:s"),					
			);	
			$this->Enrollments_model->insertEnrolledUser($enrolled_data);

            $user_data = $this->User_model->getList(array('id' => $this->session->get_userdata()['user_id'])) [0];

            $this->load->library('email');
			$email_temp = $this->getEmailTemp('assign_course',$this->session->userdata('company_id'));
			$content = $email_temp['message'];
			$title = $email_temp['subject'];
	
			$content = str_replace("{USERNAME}", $user_data['first_name'].' '.$user_data['last_name'], $content);
			$URL = $this->Company_model->getList(array('id'=>$this->session->userdata('company_id')))[0]['url'];
			$course_html = "<a href='". base_url('company/'.$URL.'/training/view/'.$course_id)."' >" . $course["title"] . "</a>";
			$content = str_replace("{COURSE_NAME}", $course_html , $content);
			$content = str_replace("{LOGO}", "<img src='" . base_url('assets/logos/logo1.png') . "'/>"."<img src='" . base_url('assets/logos/logo2.png') . "'/>", $content);
			$content = str_replace("{CATEGORY}", $course["category_name"], $content);
			if(isset($course["standard_name"]) && !empty($course["standard_name"])) {
				$content = str_replace("{STANDARD}", $course["standard_name"], $content);
			}else{
				$content = str_replace("{STANDARD}", 'ISO 22000:2018', $content);
			}
	
			if($course["location"]) {
				$content = str_replace("{LOCATION}", $course["location"], $content);
			}else{
				$content = str_replace("{LOCATION}", '', $content);
			}
            // print_r($content);
			$this->sendemail($user_data['email'], $user_data['first_name'].' '.$user_data['last_name'],$content,$title);
		}
		if($this->Training_model->isBooking($course_time_id, $this->session->get_userdata()['user_id']) > 0){
            return false;
        }	
        $id = $this->Training_model->insertTrainingUser($data);
        echo $id;
        exit;
        //return $this->Training_model->insertTrainingUser($data);
        
    }

    public function viewDetail($id){
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '5');
        $this->global["sidebar"] = $this->sidebar->generate($side_params, $this->role);
        if($this->isLearner()){
			
            $training_data = array();			
            $res_id_list = $this->Training_model->select(intval($id));
			$totalCourseEnrollments = $this->Enrollments_model->totalCourseEnrollments($res_id_list->course_id,$id);
			$res_id_list->enroll_users_counts = $totalCourseEnrollments;
            $training_data['course_list'] = $res_id_list;			
            $this->loadViews("learner/training/training_detail", $this->global, $training_data, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    public function pay_training(){
		$time_id = $this->input->post('time_id');
        $course_id = $this->input->post('course_id');
        $user_id = $this->session->get_userdata() ['user_id'];		
		$ilt_course_id = $this->input->post('ilt_course_id');
		
        //$this->Course_model->pay_course(array("user_id"=>$user_id,"course_id"=>$row_id));
        $price = $this->Training_model->getCourseByTrainingId($course_id)['pay_price'];
        $data['amount'] = $price;
        $data['user_id'] = $user_id;
        $data['object_type'] = 'training';
        $data['object_id'] = $course_id;
        $this->db->set("company_id", "(select create_id from training_course where id = " . $course_id . ")", false);
        $this->Account_model->insert_payment($data);
		// if($ilt_course_id != '' && isset($ilt_course_id)){
		// 	$course_id = $ilt_course_id;
		// }
		// $course_data = $this->Course_model->getCourseById($course_id);
		// if($time_id != '' && isset($time_id)){
		// 	$totalCourseEnrollments = $this->Enrollments_model->totalCourseEnrollments($course_id,$time_id);
		// 	if($totalCourseEnrollments == 0){
		// 		$enrolled_data = array(
		// 			'user_id' => $this->session->get_userdata()['user_id'],
		// 			'course_id' => $course_id,			
		// 			'course_time_id' => $time_id,					
		// 			'course_title' => $course_data["title"],
		// 			'user_name' => $this->session->get_userdata()['user_name'],
		// 			'user_email' => $this->session->get_userdata()['email'],
		// 			'create_date' => date("Y-m-d H:i:s"),					
		// 		);	
		// 		$this->Enrollments_model->insertEnrolledUser($enrolled_data);	
		// 	}
		// }
        /*start send_email*/
        /*end send_email*/
        // $this->response($records);
        $this->response($data = 'success');
    }
}
?>
