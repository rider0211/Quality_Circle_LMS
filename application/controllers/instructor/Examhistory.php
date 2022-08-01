<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
/**
 * Class : Examhistory (ExamController)
 * Examhistory Class to control all Examhistory operations.
 * @author : ping
 * @version : 1.0
 * @since : 11 July 2018
 */
class Examhistory extends BaseController {
    /**
     * This is default constructor of the class
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('Exam_model');
		$this->load->model('Course_model');
        $this->load->model('Quiz_model');
        $this->load->model('Examassign_model');
        $this->load->model('Examhistory_model');
		$this->load->model('Enrollments_model');		
        $this->load->model('Virtualcourse_model');
		$this->load->model('Trainingcourse_model');	
		$this->load->helper('common');	
        $this->isLoggedIn();
    }
    /**
     * This function used to load the default screen of exam menu
     */
    public function index(){
    }
    
    public function viewExamHistory(){
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '3-2');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        if($this->isInstructor()){
            $this->loadViews("instructor/exam/examhistory", $this->global, NULL, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function viewSCCHistory(){
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '7-3');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        if($this->isInstructor()){
            $this->loadViews("instructor/analysis/scchistory", $this->global, NULL, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function getExamhistoryList(){
        $sessiondata = $this->session->get_userdata();
        $company_id = $sessiondata['company_id'];
        $type = $this->input->post('type');
        $limit = $this->input->post('limit');
        //        if(!isset($type))
        //            $type = "general";
        //        $cond = array("a.exam_type"=>$type);
        $cond = array("b.create_id = (select id from user where user_type = \"Admin\" and active = 1 and company_id = " . $company_id . ")");
        $table_data = $this->Examhistory_model->getList($cond, $limit);
        foreach($table_data["data"] as $key => $row){
            $table_data["data"][$key]["start_seconds"] = strtotime($table_data["data"][$key]["exam_start_at"]);
            $table_data["data"][$key]["end_seconds"] = strtotime($table_data["data"][$key]["exam_end_at"]);
        }
        $records["data"] = $table_data['data'];
        //$records["recordsTotal"] = $total;
        $records['recordsTotal'] = $table_data["total"];
        $records['recordsFiltered'] = $table_data['filtertotal'];
        $this->response($records);
    }
    
    public function getExamhistoryItem(){
        $id = $this->input->post('id');
        $examlist = $this->Examhistory_model->getRow($id);
        if(sizeof($examlist) > 0){
            echo $examlist[0]['user_sign_image'];
        }else{
            echo "";
        }
    }
    
    public function check($id = NULL){
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '4-2');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        if($this->isInstructor()){
            $this->global['quiz_number'] = $this->Examhistory_model->getQuizNumber($id) ["quiz_num"];
            $this->global['exam_info'] = $this->Examhistory_model->getExamInfo($id);
            $this->global['exam_quiz_info'] = $this->Examhistory_model->getExamQuizInfo($id);
            $this->global['markers'] = $this->Examhistory_model->getExamMarker($id);
            $this->global['exam_user'] = $this->Examhistory_model->getExamUser($id);
            $this->global['exam_history'] = $this->Examhistory_model->getExamHistory($id);
            //            print_r($this->global['exam_quiz_info']);
            //            die(0);
            $this->loadViews("instructor/exam/exam_check", $this->global, NULL, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function feedback($id = NULL){
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '4-2');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        if($this->isInstructor()){
            $this->global['feedback'] = $this->Examhistory_model->getExamFeedback($id);
            $this->loadViews("instructor/exam/exam_feedback", $this->global, NULL, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function preview_history($id){
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '3-2');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        if($this->isInstructor()){
            $user_id = $this->session->get_userdata() ['user_id'];
            $exam_row = $this->Exam_model->getExamByHistory($id);
            if($exam_row["exam_image"] != "") $exam_row["preview_image"] = sprintf("%sassets/uploads/exam/%d_%s", base_url(), $exam_row["id"], $exam_row["exam_image"]);
            else $exam_row["preview_image"] = "";
            $this->global['exam'] = $exam_row;
            $this->global["questions"] = $this->Exam_model->getQuizList($exam_row['id']);
            $this->global['answers'] = $this->Exam_model->getQuizHistoryByUser($exam_row['id'], $user_id);
            $this->loadViews("instructor/exam/exam_history_preview", $this->global, NULL, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
	
	public function enrolled_course_users($course_id,$time_id,$dateString=NULL){
	
		$this->load->library('Sidebar');
        $side_params = array(
            'selected_menu_id' => '12'
        );
		$date = NULL;
		if(isset($dateString) && !empty($dateString)){
			$date = date('F d, Y',$dateString);
		}
		$this->global['schedule_date'] = $date;
		$this->global['courseid'] = $course_id;
		$this->global['timeid'] = $time_id;
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);	
			
        $this->loadViews("instructor/exam/enrolled_course_users", $this->global, NULL, NULL);	
	}
	
	public function course_enrolled_users($course_id,$time_id){
		$records["data"] = array();
		$query = "SELECT enrollments.*, CONCAT(user.first_name, ' ', user.last_name) AS fullname FROM enrollments 
                LEFT JOIN user ON user.id = enrollments.user_id
                WHERE course_id = ".$course_id." AND course_time_id = ".$time_id."";
		$result = $this->db->query($query)->result_array();						
		if(!empty($result)){
			$i = 0;
			foreach($result as $keys => $course){
				$title = $email = $lname = $fname = $last_login = 'Not Available';
				if(isset($course['user_name'])){
					$user_name = $course['user_name'];
				}
				if(isset($course['course_title'])){
					$title = $course['course_title'];
				}
				if(isset($course['user_email'])){
					$email = $course['user_email'];
				}
				if(isset($course['create_date'])){
					$last_login = $course['create_date'];
				}
				$records["data"][$i]['id'] = $course['id'];
				$records["data"][$i]['serial'] = $keys+1;
				$records["data"][$i]['full_name'] = $course['fullname'];
				$records["data"][$i]['course_title'] = ucfirst($title);
				$records["data"][$i]['email'] = $course['user_email'];
				$records["data"][$i]['created'] = $last_login;
				$records["data"][$i]['course_id'] = $course['course_id'];
				$i++;
			}
		}
		$this->response($records);
	}	
	
	public function today_enrolled_users($course_id){
		$records["data"] = array();
		$query = "Select * from payment_history where object_id = ".$course_id." and object_type = 'course'";
		$result = $this->db->query($query);						
		if(!empty($result->result_array())){
			$i = 0;
			foreach($result->result_array() as $keys => $course){				
				$course_id = $course['object_id'];
				$user_id = $course['user_id'];
				$query = "Select title from course where id = $course_id";
        		$result = $this->db->query($query);
				$resultCourse = $result->result_array();
				
				$qryUser = "Select * from user where id = $user_id";
        		$results = $this->db->query($qryUser);
				$resultUser = $results->result_array();
				
				$title = $email = $lname = $fname = $last_login = 'Not Available';
				if(isset($resultUser[0]['first_name'])){
					$fname = $resultUser[0]['first_name'];
				}
				if(isset($resultUser[0]['last_name'])){
					$lname = $resultUser[0]['last_name'];
				}
				if(isset($resultUser[0]['email'])){
					$email = $resultUser[0]['email'];
				}
				if(isset($resultCourse[0]['title'])){
					$title = $resultCourse[0]['title'];
				}
				if(isset($resultUser[0]['last_login'])){
					$last_login = $resultUser[0]['last_login'];
				}
				$records["data"][$i]['id'] = $resultCourse[0]['id'];
				$records["data"][$i]['serial'] = $keys+1;
				$records["data"][$i]['first_name'] = $fname;
				$records["data"][$i]['last_name'] = $lname;
				$records["data"][$i]['course_title'] = ucfirst($title);
				$records["data"][$i]['email'] = $email;
				$records["data"][$i]['last_login'] = $last_login;
				$records["data"][$i]['course_id'] = $resultCourse[0]['object_id'];		
				$i++;
			}
		}
		$this->response($records);
	}	
	
	public function enrolledcourse(){
		$this->load->library('Sidebar');
        $side_params = array(
            'selected_menu_id' => '12'
        );		
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
		
		 	$myData = array();
			$table_data = $this->Course_model->getAllCourse();
			$records["data"] = $table_data;
			if(!empty($records["data"])){			
				foreach($records["data"] as $key => $val){
					$title = $val['title'];	
					if($val['title'] == ''){ $title = 'Not Available'; }
					$total_entollments = $this->Enrollments_model->totalCourseEnrollmentsCount($val['id']);
					$myData["data"][$key]['no'] = $key+1;
					$myData["data"][$key]['id'] = $val['id'];
					$myData["data"][$key]['type'] = $val['course_type'];
					$myData["data"][$key]['title'] = ucfirst($title);				
					$myData["data"][$key]['count'] = $total_entollments;
				}	
			} 
			$this->global['mydata'] = $myData;
        $this->loadViews("instructor/exam/enrolled_courses", $this->global, NULL, NULL);	
	}
	
	public function getList(){
        $myData["data"] = $records["data"] = [];
        $table_data = $this->Course_model->getAllCourse();
		if(!empty($table_data)){
        	$records["data"] = $table_data;
		}
		if(!empty($records["data"])){			
			foreach($records["data"] as $key => $val){
				$title = $val['title'];	
				if($val['title'] == ''){ $title = 'Not Available'; }
				$total_entollments = $this->Enrollments_model->totalCourseEnrollments($val['id']);
				$myData["data"][$key]['no'] = $key+1;
				$myData["data"][$key]['id'] = $val['id'];
				$myData["data"][$key]['title'] = ucfirst($title);				
				$myData["data"][$key]['count'] = $total_entollments;
			}	
		}        
        $this->response($myData);
    }
	
	public function deleteEnrollments(){
        $out_data = array();
        $id = $this->input->post('id');
        if($this->Enrollments_model->delete($id)){
            $out_data["status"] = "Success";
            $out_data["message"] = "";
        }else{
            $out_data["status"] = "Fail";
            $out_data["message"] = "Could not delete the row.";
        }
        $this->response($out_data);
    }
	public function getSign(){
        $filter = $this->input->post();
        $data = $this->Examhistory_model->getSign($filter);
        $this->response(array("success"=>true,"data"=>$data));
    }
	
	public function searchResult(){
		if ($this->input->is_ajax_request()){
		$condition = array();
		if(isset($_REQUEST['course_type'])){
			$condition['course_type'] = $_REQUEST['course_type'];
		}
		if(isset($_REQUEST['course_title'])){
			$condition['course_title'] = $_REQUEST['course_title'];
		}
		$myData = array();
			$table_data = $this->Course_model->getAllCourseFilter($condition);
			$records["data"] = $table_data;
			if(!empty($records["data"])){			
				foreach($records["data"] as $key => $val){
					$title = $val->title;	
					if($val->title == ''){ $title = 'Not Available'; }
					$total_entollments = $this->Enrollments_model->totalCourseEnrollmentsCount($val->id);
					$myData["data"][$key]['no'] = $key+1;
					$myData["data"][$key]['id'] = $val->id;
					$myData["data"][$key]['type'] = $val->course_type;
					$myData["data"][$key]['title'] = ucfirst($title);				
					$myData["data"][$key]['count'] = $total_entollments;				
				}
			}
			$this->load->view("instructor/exam/enrolled_courses_search", $myData, NULL, NULL);	
		}	
	}
}

?>
 	