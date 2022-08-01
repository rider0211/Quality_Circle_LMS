<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
/**
 * Created by PhpStorm.
 * User: Timon
 * Date: 10/28/2018
 * Time: 9:45 AM
 */
class Live extends BaseController {
    /**
     * This is default constructor of the class
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('Live_model');
        $this->load->model('User_model');
        $this->load->model('Category_model');
        $this->load->model('Course_model');
        $this->load->model('Certification_model');
        $this->load->model('Exam_model');
        $this->load->model('Virtualcourse_model');
        $this->load->helper('common_helper');
        $this->isLoggedIn();
    }
    /**
     * This function used to load the default screen of trainingassign menu
     */
    public function index(){
        $this->showLive();
    }
    
    public function detail_course($row_id = 0){
        $page_path = "admin/live/detail_course";
        //$course = $this->Course_model->select($row_id);
        $course = $this->Live_model->getListById($row_id, $this->session->get_userdata() ['company_id']) [0];
        //$this->global['libraries'] = $this->Course_model->getLibrary($row_id);
        $this->global['libraries'] = $this->Live_model->getLibrary($row_id);
        $this->global['course_name'] = $course->title;
        $this->global['course_id'] = $row_id;
        $this->load->view($page_path, $this->global);
        //        $this->loadViews($page_path, $this->global, NULL , NULL);
        
    }
    
    public function addLive(){
		$course_data['id'] = $this->input->post('id');
		$course_data['title'] = $this->input->post('title');
		$course_data['subtitle'] = $this->input->post('subtitle');
		$course_data['duration'] = $this->input->post('duration');
		$course_data['about'] = $this->input->post('about');
		$course_data['objective'] = $this->input->post('objective');
		$course_data['attend'] = $this->input->post('attend');
		$course_data['agenda'] = $this->input->post('agenda');
		$course_data['course_pre_requisite'] = $this->input->post('course_pre_requisite');
		$course_data['user_type'] = $this->input->post('user_type');
		$course_data['pay_type'] = $this->input->post('pay_type');
		$course_data['record_type'] = $this->input->post('record_type');
		$course_data['pay_price'] = $this->input->post('pay_price');
		$course_data['startday'] = NULL;
		$course_data['endday'] = NULL;
		if(!empty($_REQUEST['number'])){
		$newstring = preg_replace('~[^A-Za-z0-9 ?.!]~','',$this->input->post('number'));
		$return = '';
		foreach(explode(' ', $newstring) as $word){
			$return .= strtoupper($word[0]);
		}
		$course_data['number'] = $return.'_'.$course_data['id'];
		}
		//$course_data['category_id'] = $this->input->post('category_id');
		$course_data['course_type'] = $this->input->post('course_type');		
		$course_data['course_id'] = $this->input->post('category_id');
		$course_data['category'] = $this->input->post('category');
		$course_data['url'] = $this->input->post('vilt_url');
		if($course_data['pay_price'] == null){
			$course_data['pay_price'] = 0;
		}		
		$course_data['create_id'] = $this->session->get_userdata() ['company_id'];
		$course_data['img_path'] = $this->input->post('img_path_previous');
		if($_FILES['img_path']['name'] != ''){
			$upload_path = sprintf('%slive/%d/', PATH_UPLOAD, $this->input->post('id'));
			if(!file_exists($upload_path)){
				$this->makeDirectory($upload_path);
			}
			$rslt = $this->doUpload('img_path', $upload_path);		
			if($rslt['possible'] == 1){
				$course_data['img_path'] = str_replace("./", "", $rslt['path']);
			}else $course_data['img_path'] = str_replace("./", "", "assets/img/" . 'default.png');		
		}
		$course_data['objective_img'] = $this->input->post('objective_img_previous');
		if($_FILES['objective_img']['name'] != ''){
			$upload_path = sprintf('%slive/%d/', PATH_UPLOAD, $this->input->post('id'));
			if(!file_exists($upload_path)){
				$this->makeDirectory($upload_path);
			}
			$rslt = $this->doUpload('objective_img', $upload_path);		
			if($rslt['possible'] == 1){
				$course_data['objective_img'] = str_replace("./", "", $rslt['path']);
			}else $course_data['objective_img'] = str_replace("./", "", "assets/img/" . 'default.png');		
		}
		$course_data['attend_img'] = $this->input->post('attend_img_previous');
		if($_FILES['attend_img']['name'] != ''){
			$upload_path = sprintf('%slive/%d/', PATH_UPLOAD, $this->input->post('id'));
			if(!file_exists($upload_path)){
				$this->makeDirectory($upload_path);
			}
			$rslt = $this->doUpload('attend_img', $upload_path);		
			if($rslt['possible'] == 1){
				$course_data['attend_img'] = str_replace("./", "", $rslt['path']);
			}else $course_data['attend_img'] = str_replace("./", "", "assets/img/" . 'default.png');		
		}
		$course_data['agenda_img'] = $this->input->post('agenda_img_previous');
		if($_FILES['agenda_img']['name'] != ''){
			$upload_path = sprintf('%slive/%d/', PATH_UPLOAD, $this->input->post('id'));
			if(!file_exists($upload_path)){
				$this->makeDirectory($upload_path);
			}
			$rslt = $this->doUpload('agenda_img', $upload_path);		
			if($rslt['possible'] == 1){
				$course_data['agenda_img'] = str_replace("./", "", $rslt['path']);
			}else $course_data['agenda_img'] = str_replace("./", "", "assets/img/" . 'default.png');		
		}
		$startday = date('Y-m-d');
		$starttime = $this->input->post('starttime');
		$timestamp = strtotime($startday . ' ' . $starttime);
		$start_at = date('Y-m-d H:i:s', $timestamp);
		$course_data['instructors'] = json_encode($this->input->post('instructor[]'));
		$course_data['standard_id'] = json_encode($this->input->post('standard_id[]'));
		$course_data['enroll_users'] = json_encode($this->input->post('user[]'));
		$myHighlights = array_filter($this->input->post('highlights[]'));
		$highlights = json_encode($myHighlights);
        $course_data['highlights'] = $highlights;
		if($this->input->post('course_type') == 0){
			$course_data['address'] = $this->input->post('address');
			$course_data['country'] = $this->input->post('country');
			$course_data['state'] = $this->input->post('state');
			$course_data['city'] = $this->input->post('city');
			$course_data['location'] = $course_data['address'].' '.$course_data['country'].' '.$course_data['state'].' '.$course_data['city'];	
		}else{
			$course_data['location'] = 'Online';	
			$course_data['address'] = '';
			$course_data['country'] = '';
			$course_data['state'] = '';
			$course_data['city'] = '';
		}
		if($this->input->post('title') != '' && $this->input->post('subtitle') != '' && $this->input->post('category_id') != '' && $this->input->post('course_type') != ''){
			if($course_data['id'] == 0){
				$row_id = $this->Live_model->insert_course($course_data);
				$course_time['virtual_course_id'] = $row_id;
				$course_time['start_at'] = $start_at;
				$this->Live_model->insert_time($course_time);
				
				if(!empty($_REQUEST['number'])){
					$newstring = preg_replace('~[^A-Za-z0-9 ?.!]~','',$this->input->post('number'));
					$return = '';
					foreach(explode(' ', $newstring) as $word){
						$return .= strtoupper($word[0]);
					}
					$course_datas['number'] = $return.'_'.$row_id;
				}
				$this->Live_model->update_course($course_datas, $row_id);
			}else{
				unset($course_data['id']);
				$this->Live_model->update_course($course_data, $this->input->post('id'));
				$row_id = $course_data['id'];
			}
		}
		$this->index();
	}
        
    
    public function editLive($id = 0){
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '7');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        if($this->isMasterAdmin()){           
            $page_path = "admin/live/live_edit";
            if($id != 0){
                $live_data = $this->Live_model->getListById($id, $this->session->get_userdata() ['company_id']) [0];
                $live_data['id'] = $id;
                $live_data['category_id'] = $live_data['course_id'];
                $live_data['vilt_url'] = $live_data['url'];
            }else{
                $live_data['id'] = 0;
                $live_data['title'] = '';
                $live_data['subtitle'] = '';
                $live_data['duration'] = '';
                $live_data['about'] = '';
                $live_data['objective'] = '';
                $live_data['attend'] = '';
                $live_data['agenda'] = '';
                $live_data['user_type'] = '';
                $live_data['pay_type'] = '';
                $live_data['record_type'] = '';
                $live_data['pay_price'] = '';
                $live_data['instructors'] = '';
                $live_data['enroll_users'] = '';
                $live_data['create_id'] = '';
                $live_data['category_id'] = 1;
                $live_data['vilt_url'] = '';
            }
            //$live_data['category'] = $this->Category_model->getListByCompanyID($this->session->get_userdata()['company_id']);
			$live_data['category_ids'] = $this->Category_model->getListByCompanyID($this->session->get_userdata() ['company_id']);
            $live_data['categoryCourse'] = $this->Course_model->getAll(array('create_id' => $this->session->get_userdata() ['company_id'], 'course_type' => 1, 'active' => 1));
            $this->loadViews($page_path, $this->global, $live_data, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL , NULL);   
        }
    }
    
    public function getinstructor(){
        $company_id = $this->session->get_userdata() ['company_id'];
        $table_data = $this->User_model->getInstructor($company_id);
        foreach ($table_data["data"] as $key => $row){
            $table_data["data"][$key]["no"] = $key + 1;
        }
        $records["data"] = $table_data["data"];
        $records['recordsTotal'] = $table_data["total"];
        $records['recordsFiltered'] = $table_data['filtertotal'];
        $this->response($records);
    }
    
    public function getuser(){
        $company_id = $this->session->get_userdata() ['company_id'];
        $table_data = $this->User_model->getUser($company_id);
        foreach ($table_data["data"] as $key => $row){
            $table_data["data"][$key]["no"] = $key + 1;
        }
        $records["data"] = $table_data["data"];
        $records['recordsTotal'] = $table_data["total"];
        $records['recordsFiltered'] = $table_data['filtertotal'];
        $this->response($records);
    }
	
	public function showLiveFilter($course_id = NULL){
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '7');
        $this->global["sidebar"] = $this->sidebar->generate($side_params, $this->role);
        if($this->isMasterAdmin()){			
            $training_data = array();
            $result_list = $this->Live_model->getListByCompanyId($this->session->get_userdata() ['company_id']);            
			if($course_id != ''){
				$res_id_list = $this->Live_model->getListByCourseId($course_id);
			}else{
				$res_id_list = $this->Live_model->getListCourseId($this->session->get_userdata() ['company_id']);
			}
            foreach ($res_id_list as $key => $row){
                foreach ($result_list as $k => $r){
                    if($r['virtual_course_id'] == $row['id']){
                        $timestamp = strtotime($r['start_at']);
                        $month = date('m', $timestamp);
                        if(!array_key_exists($month, $time_list[$row['id']])) $time_list[$row['id']][$month] = array();
                        array_push($time_list[$row['id']][$month], $r);
                    }
                }
            }
            $res_course_list = array();
            foreach ($res_id_list as $key => $row){
                $instructor = json_decode($row['instructors']) [0];
                $row['instructor_email'] = $this->User_model->getList(array(id => $instructor)) [0]['email'];
                $res_course_list[$row['id']] = $row;
            }
			
            $training_data['course_list'] = $res_course_list;
            $training_data['training_list'] = $time_list;
            //$training_data['category'] = $this->Category_model->getListByCompanyID($this->session->get_userdata()['company_id']);
            $training_data['category'] = $this->Course_model->getAll(array('create_id' => $this->session->get_userdata() ['company_id'], 'course_type' => 1, 'active' => 1));
			$this->loadViews("admin/live/live_list", $this->global, $training_data, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL , NULL);
        }
    }
    
    public function showLive($d = 0){
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '7');
        $this->global["sidebar"] = $this->sidebar->generate($side_params, $this->role);
        if($this->isMasterAdmin()){            
            $training_data = array();
            $result_list = $this->Live_model->getListByCompanyId($this->session->get_userdata() ['company_id']);
            $res_id_list = $this->Live_model->getListCourseId($this->session->get_userdata() ['company_id']);
            $time_list = array();
            foreach ($res_id_list as $key => $row){
                foreach ($result_list as $k => $r){
                    if($r['virtual_course_id'] == $row['id']){
                        $timestamp = strtotime($r['start_at']);
                        $month = date('m', $timestamp);
                        if(!array_key_exists($month, $time_list[$row['id']])) $time_list[$row['id']][$month] = array();
                        array_push($time_list[$row['id']][$month], $r);
                    }
                }
            }
            $res_course_list = array();
            foreach ($res_id_list as $key => $row){
                $instructor = json_decode($row['instructors']) [0];
                $row['instructor_email'] = $this->User_model->getList(array(id => $instructor)) [0]['email'];
                $res_course_list[$row['id']] = $row;
            }
			$allCourseList = $this->Live_model->getListCourseId($this->session->get_userdata() ['company_id']);
			$res_all_course_list = [];
			foreach($allCourseList as $keys => $rows){
                $res_all_course_list[$rows['course_id']] = $rows;
            }
            $training_data['course_list'] = $res_course_list;
            $training_data['training_list'] = $time_list;
			$training_data['all_course_list'] = $res_all_course_list;
            $dis_month = $_SESSION['dis_month'];
            if(intval($d) > 0){
                $dis_month = $dis_month + 1;
            }
            if(intval($d) < 0){
                $dis_month = $dis_month - 1;
            }
            $this->session->set_userdata('dis_month', $dis_month);
            $training_data['dis_month'] = $dis_month;
            //$training_data['category'] = $this->Category_model->getListByCompanyID($this->session->get_userdata()['company_id']);
            $training_data['category'] = $this->Course_model->getAll(array('create_id' => $this->session->get_userdata() ['company_id'], 'course_type' => 1, 'active' => 1));

            $this->loadViews("admin/live/live_list", $this->global, $training_data, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL , NULL);   
        }
    }
    
    public function deleteTime(){
        $id = $this->input->post('id');
        return $this->Live_model->delete_time($id);
    }

    public function add_time(){
        $time = $this->input->post('starttime');
        $day = $this->input->post('startday');
        $timestamp = strtotime($day . ' ' . $time);
        $start_at = date('Y-m-d H:i:s', $timestamp);
        //$location = $this->input->post('change_location');
        $id = $this->input->post('change_id');
        $data['start_at'] = $start_at;
        $data['virtual_course_id'] = $id;
        $data['start_time'] = $time;
        $data['end_time'] = getEndTime($time);
        return $this->Live_model->insert_time($data);
    }
    
    public function update_time(){
        $time = $this->input->post('starttime');
        $day = $this->input->post('startday');
        $timestamp = strtotime($day . ' ' . $time);
        $start_at = date('Y-m-d H:i:s', $timestamp);
        //$location = $this->input->post('change_location');
        $id = $this->input->post('change_id');
        $time_id = $this->input->post('time_id');
        $data['start_at'] = $start_at;
        $data['virtual_course_id'] = $id;
        $data['start_time'] = $time;
        $data['end_time'] = getEndTime($time);
        return $this->Live_model->update_time($data, array('id' => $time_id));
    }
    
    public function delete(){
        $out_data = array();
        $id = $this->input->post('id');
        if($this->Live_model->deleteCourse($id)){
            $out_data["status"] = "Success";
            $out_data["message"] = "";
        }else{
            $out_data["status"] = "Fail";
            $out_data["message"] = "Could not delete the row.";
        }
        $this->response($out_data);
    }
    
    public function enterCourse(){
        $course_id = $this->input->post('course_id');
        $is_instructor = $this->input->post('is_instructor');
        $start_at = $this->input->post('start_at');
        $explodeDateTime = explode(" ", $start_at);
        $out = array();
        $bbb = new Bbb();
        $is_meeting = $bbb->is_meeting_running("course-" . $course_id);
        if(!isset($is_meeting) && $is_instructor == 0){
            $out['success'] = 0;
            $out['msg'] = "course is not running!";
        }else{
            $userId = $this->session->get_userdata() ['user_id'];
            $user = $this->User_model->getUserById($userId);
            $user = $user[0];
            if(!isset($is_meeting)){
                $response = $bbb->create_meeting("course-" . $course_id, "course-" . $course_id);
                if($response->returncode != "FAILED"){
                    if($is_instructor == 1){
                        $url = $bbb->join_meeting("course-" . $course_id, $user['first_name'] . ' ' . $user['last_name'], $user['first_name'] . ' ' . $user['last_name'], $response->moderatorPW);
                    }else{
                        $url = $bbb->join_meeting("course-" . $course_id, $user['first_name'] . ' ' . $user['last_name'], $user['first_name'] . ' ' . $user['last_name'], $response->attendeePW);
                    }
                }else{
                    $course = $this->Virtualcourse_model->getCourseById($course_id);
                    if($is_instructor == 1){
                        $url = $bbb->join_meeting("course-" . $course_id, $user['first_name'] . ' ' . $user['last_name'], $user['first_name'] . ' ' . $user['last_name'], $course['moderatorPW']);
                    }else{
                        $url = $bbb->join_meeting("course-" . $course_id, $user['first_name'] . ' ' . $user['last_name'], $user['first_name'] . ' ' . $user['last_name'], $course['attendeePW']);
                    }
                }
                $this->Virtualcourse_model->update_course(array("moderatorPW" => $response->moderatorPW, "attendeePW" => $response->attendeePW), $course_id);
            }else{
                $course = $this->Virtualcourse_model->getCourseById($course_id);
                if($is_instructor == 1){
                    $url = $bbb->join_meeting("course-" . $course_id, $user['first_name'] . ' ' . $user['last_name'], $user['first_name'] . ' ' . $user['last_name'], $course['moderatorPW']);
                }else{
                    $url = $bbb->join_meeting("course-" . $course_id, $user['first_name'] . ' ' . $user['last_name'], $user['first_name'] . ' ' . $user['last_name'], $course['attendeePW']);
                }
            }
            $out['success'] = 1;
            $out['msg'] = $url;
        }
        echo json_encode($out);
    }

    function generateMeetingURL(){
    }
	
	public function deleteVirtualCourse(){
        $out_data = array();
        $id = $this->input->post('id');
        if($this->Live_model->deleteCourseVirtual($id)){
            $out_data["status"] = "Success";
            $out_data["message"] = "";
        }else{
            $out_data["status"] = "Fail";
            $out_data["message"] = "Could not delete the row.";
        }
        $this->response($out_data);
    }
	
}
