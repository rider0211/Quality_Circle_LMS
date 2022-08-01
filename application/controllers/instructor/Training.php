<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Training extends BaseController{
    /**
     * This is default constructor of the class
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('Training_model');
        $this->load->model('Account_model');
        $this->load->model('User_model');
        $this->load->model('Category_model');
        $this->load->model('Course_model');
        $this->load->model('Certification_model');
        $this->load->model('Exam_model');
		$this->load->model('Location_model');
		$this->load->model('Countries_model');	
        $this->load->helper('common_helper');
        $this->isLoggedIn();
    }
    /**
     * This function used to load the default screen of trainingassign menu
     */
    public function index(){
        $this->session->set_userdata('dis_month', 0);
        $this->showTraining();
    }
    
    public function detail_course($row_id = 0){
        $page_path = "instructor/training/detail_course";
        $course = $this->Training_model->select($row_id);
        $this->global['libraries'] = $this->Training_model->getLibrary($row_id);
        $this->global['course_name'] = $course->title;
        $this->global['course_id'] = $row_id;
        $this->load->view($page_path, $this->global);
    }
    
    public function createCourse(){
        $timestamp = strtotime($this->input->post('startday'));
        $month = date('m', $timestamp);
        $sday = date('d', $timestamp);
        $course_data['title'] = $this->input->post('title');
		$course_data['subtitle'] = $this->input->post('subtitle');
		$course_data['startday'] = NULL;
		$course_data['endday'] = NULL;
		$standardids = json_encode($this->input->post('standard_id[]'));
		$course_data['standard_id'] = $standardids;		
        $course_data['description'] = $this->input->post('description');
        $course_data['duration'] = intval($this->input->post('duration'));
        $course_data['objective'] = $this->input->post('objective');
		$objective_img_url = $this->input->post('objective_img_url');
        $course_data['attend'] = $this->input->post('attend');
        //$course_data['category_id'] = $this->input->post('category_id');
        $course_data['course_id'] = $this->input->post('category_id');
		$course_data['category'] = $this->input->post('category');
		
		$course_data['course_type'] = $this->input->post('course_type');		
        $course_data['agenda'] = $this->input->post('agenda');
		$course_data['course_pre_requisite'] = $this->input->post('course_pre_requisite');
        $course_data['create_id'] = $this->session->get_userdata() ['company_id'];
		$agenda_img_url = $this->input->post('agenda_img_url');
        $course_data['create_id'] = $this->session->get_userdata() ['company_id'];
        $instructors = json_encode($this->input->post('instructor[]'));
        $course_data['instructors'] = $instructors;
		$highlights = json_encode($this->input->post('highlights[]'));
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
        $upload_path = sprintf('%straining/photo/', PATH_UPLOAD);
        if(!file_exists($upload_path)){
            $this->makeDirectory($upload_path);
        }
        $rslt = $this->doUpload('attend_img', $upload_path);
        if($rslt['possible'] == 1){
            $course_data['attend_img'] = str_replace("./", "", $rslt['path']);
        }else{
            $course_data['attend_img'] = str_replace("./", "", $attend_img_url);
        }
        $rslt = $this->doUpload('agenda_img', $upload_path);
        if($rslt['possible'] == 1){
            $course_data['agenda_img'] = str_replace("./", "", $rslt['path']);
        }else{
            $course_data['agenda_img'] = str_replace("./", "", $agenda_img_url);
        }
        $rslt = $this->doUpload('objective_img', $upload_path);
        if($rslt['possible'] == 1){
            $course_data['objective_img'] = str_replace("./", "", $rslt['path']);
        }else{
            $course_data['objective_img'] = str_replace("./", "", $objective_img_url);
        }
        $res = $this->Training_model->insert_course($course_data);
		
		if(!empty($_REQUEST['number'])){
			$newstring = preg_replace('~[^A-Za-z0-9 ?.!]~','',$this->input->post('number'));
			$return = '';
			foreach(explode(' ', $newstring) as $word){
				$return .= strtoupper($word[0]);
			}
			$course_datas['number'] = $return.'_'.$res;
		}
		$this->Training_model->update_course($course_datas, $res);
        /*$data['month'] = $month;
        $data['sday'] = $sday;
        $data['training_course_id'] = $res;
		$data['location'] = $course_data['location'];
		$data['date_str'] = $timestamp;		
        $this->Training_model->insert_time($data);*/
        $this->response($res);
    }
    
    public function getPayUser(){
        $tid = $this->input->post('tid');
        $res = $this->Training_model->getPayUser($tid);
        foreach($res as $key => $row){
            $res[$key]["no"] = $key + 1;
        }
        $records["data"] = $res;
        $this->response($records);
    }
	
	public function getCourseByRowId(){
		$row_id = $this->input->post('course_id');
		$course_data = $this->Course_model->getCourseById($row_id);
		$this->response($course_data);
	}
	
	public function getCourseByTrainingId(){
		$row_id = $this->input->post('id');
		$course_data = $this->Training_model->getCourseById($row_id);
		$this->response($course_data);
	}
    
    public function updateCourse(){
        $id = $this->input->post('id');
        $course_data['title'] = $this->input->post('title');
		$course_data['subtitle'] = $this->input->post('subtitle');
		$course_data['startday'] = NULL;
		$course_data['endday'] = NULL;
		$standardids = json_encode($this->input->post('standard_id[]'));
		$course_data['standard_id'] = $standardids; 
		if(!empty($_REQUEST['number'])){
			$newstring = preg_replace('~[^A-Za-z0-9 ?.!]~','',$this->input->post('number'));
			$return = '';
			foreach(explode(' ', $newstring) as $word){
				$return .= strtoupper($word[0]);
			}
			$course_data['number'] = $return.'_'.$id;
		}
        $course_data['description'] = $this->input->post('description');
        $course_data['duration'] = intval($this->input->post('duration'));
        $course_data['objective'] = $this->input->post('objective');
        $objective_img_url = $this->input->post('objective_img_url');
        $course_data['attend'] = $this->input->post('attend');
        $attend_img_url = $this->input->post('attend_img_url');
        //$course_data['category_id'] = $this->input->post('category_id');
        $course_data['course_id'] = $this->input->post('category_id');
		$course_data['category'] = $this->input->post('category');
		$course_data['course_type'] = $this->input->post('course_type');
        $course_data['agenda'] = $this->input->post('agenda');
		$course_data['course_pre_requisite'] = $this->input->post('course_pre_requisite');
        $agenda_img_url = $this->input->post('agenda_img_url');
        $course_data['create_id'] = $this->session->get_userdata() ['company_id'];
        $instructors = json_encode($this->input->post('instructor[]'));
        $course_data['instructors'] = $instructors;
		$myHighlights = array_filter($this->input->post('highlights[]'));
		$highlights = json_encode($myHighlights);
        $course_data['highlights'] = $highlights;
        $upload_path = sprintf('%straining/photo/', PATH_UPLOAD);
        if(!file_exists($upload_path)){
            $this->makeDirectory($upload_path);
        }
        $rslt = $this->doUpload('attend_img', $upload_path);
        if($rslt['possible'] == 1){
            $course_data['attend_img'] = str_replace("./", "", $rslt['path']);
        }else{
            $course_data['attend_img'] = str_replace("./", "", $attend_img_url);
        }
        $rslt = $this->doUpload('agenda_img', $upload_path);
        if($rslt['possible'] == 1){
            $course_data['agenda_img'] = str_replace("./", "", $rslt['path']);
        }else{
            $course_data['agenda_img'] = str_replace("./", "", $agenda_img_url);
        }
        $rslt = $this->doUpload('objective_img', $upload_path);
        if($rslt['possible'] == 1){
            $course_data['objective_img'] = str_replace("./", "", $rslt['path']);
        }else{
            $course_data['objective_img'] = str_replace("./", "", $objective_img_url);
        }
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
        $res = $this->Training_model->update_course($course_data, $id);
       	$this->response($id);
    }
    
    public function deleteTime(){
        $id = $this->input->post('id');
        return $this->Training_model->delete_time($id);
    }
    
    public function add_time(){
        $startDays = $this->input->post('startdays');
		$startTime = $this->input->post('starttime');
        $endTime = getEndTime($startTime);
		$startDays = explode('-',$startDays);
		$year = $startDays[0];
		$month = $startDays[1];
		$day = $startDays[2];
		$country_id = $this->input->post('country');
		$state_id = $this->input->post('state');
		$city_id = $this->input->post('city');
		
        $countryName = $this->Countries_model->getCountryName($country_id);
		$stateName = $this->Countries_model->getStateName($state_id);
		$cityName = $this->Countries_model->getCityName($city_id);
		
        $location = $this->input->post('change_location');
        $id = $this->input->post('change_id');
        $data['year'] = $year;
        $data['month'] = $month;
        $data['sday'] = $day;
		$data['country_id'] = $country_id;
		$data['state_id'] = $state_id;
		$data['city_id'] = $city_id;
		$data['location'] = $countryName;
		if($stateName != ''){
			$data['location'] = $countryName.', '.$stateName;
		}
		if($cityName != ''){
			$data['location'] = $countryName.', '.$stateName.', '.$cityName;
		}
		
		$data['start_day'] = $this->input->post('startdays');
		$data['start_time'] = $startTime;
        $data['end_time'] = $endTime;
		$data['date_str'] = strtotime($data['start_day'].' '.$data['start_time']);	
        $data['training_course_id'] = $id;
        return $this->Training_model->insert_time($data);
    }
    
    public function getinstructor(){
        $company_id = $this->session->get_userdata() ['company_id'];
        $table_data = $this->User_model->getInstructor($company_id);
        foreach($table_data["data"] as $key => $row){
            $table_data["data"][$key]["no"] = $key + 1;
        }
        $records["data"] = $table_data["data"];
        $records['recordsTotal'] = $table_data["total"];
        $records['recordsFiltered'] = $table_data['filtertotal'];
        $this->response($records);
    }
    
    public function getCourseInstructor(){
        $id = $this->input->post('id');
        $this->response($this->Training_model->getCourseInstructor($id) [0]["instructors"]);
    }
    
    public function update_time(){
		$startDays = $this->input->post('startdays');
		$startTime = $this->input->post('starttime');
        $endTime = getEndTime($startTime);
		$startDays = explode('-',$startDays);
		$year = $startDays[0];
		$month = $startDays[1];
		$day = $startDays[2];
		$country_id = $this->input->post('country');
		$state_id = $this->input->post('state');
		$city_id = $this->input->post('city');
		
        $countryName = $this->Countries_model->getCountryName($country_id);
		$stateName = $this->Countries_model->getStateName($state_id);
		$cityName = $this->Countries_model->getCityName($city_id);
		
        $location = $this->input->post('change_location');
        $id = $this->input->post('change_id');
        $data['year'] = $year;
        $data['month'] = $month;
        $data['sday'] = $day;
		$data['country_id'] = $country_id;
		$data['state_id'] = $state_id;
		$data['city_id'] = $city_id;
		
		$data['location'] = $countryName;
		if($stateName != ''){
			$data['location'] = $countryName.', '.$stateName;
		}
		if($cityName != ''){
			$data['location'] = $countryName.', '.$stateName.', '.$cityName;
		}
		
		$data['start_day'] = $this->input->post('startdays');
		$data['start_time'] = $startTime;
		$data['date_str'] = strtotime($data['start_day'].' '.$data['start_time']);		
        $data['end_time'] = $endTime;
		$time_id = $this->input->post('time_id');
        $data['training_course_id'] = $id;
       	return $this->Training_model->update_time($data, array('id' => $time_id));	
    }
	
	public function getCourseDetail(){
		$course_id =$this->input->post('course_id');
		$records["course"] = $this->Course_model->getCourseById($course_id);
		$records["course"]['country'] = $this->Training_model->getCountryNameById($records["course"]['country']);		
		$records["course"]['state'] = $this->Training_model->getStateNameById($records["course"]["state"]);
		$records["course"]['city'] = $this->Training_model->getCityNameById($records["course"]["city"]);
		$records["chapter"] = $this->Course_model->getChapterByCourseID($records["course"]['id']);
		
		$this->response($records);
	}
	
	public function showTrainingFilter($course_id = NULL){
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '6');
        $this->global["sidebar"] = $this->sidebar->generate($side_params, $this->role);
        if($this->isInstructor()){			
            $training_data = array();
            $result_list = $this->Training_model->getListByCompanyId($this->session->get_userdata() ['company_id']);	
			if($course_id != ''){
				$res_id_list = $this->Training_model->getListByCourseId($course_id);
			}else{
				$res_id_list = $this->Training_model->getListCourseId($this->session->get_userdata() ['company_id']);
			}
            $time_list = array();
            foreach($res_id_list as $key => $row){
                foreach($result_list as $k => $r){
                    if($r['training_course_id'] == $row['id']){
                        if(!array_key_exists($r['month'], $time_list[$row['id']])) $time_list[$row['id']][$r['month']] = array();
                        array_push($time_list[$row['id']][$r['month']], $r);
                    }
                }
            }
            // var_dump($time_list);
            // die();
            $res_course_list = array();
            foreach($res_id_list as $key => $row){
                $res_course_list[$row['id']] = $row;
            }

			$allCourseList = $this->Training_model->getListCourseId($this->session->get_userdata() ['company_id']);
			$res_all_course_list = [];
			foreach($allCourseList as $keys => $rows){
                $res_all_course_list[$rows['course_id']] = $rows;
            }
			
            //$training_data['category'] = $this->Category_model->getListByCompanyID($this->session->get_userdata()['company_id']);
            $training_data['category'] = $this->Course_model->getAll(array('create_id' => $this->session->get_userdata() ['company_id'], 'course_type' => 0, 'active' => 1));
            /*print_r($training_data['category']);
            die();*/
			
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
			$training_data['countries'] = $this->Location_model->getAllCounties();
            $this->loadViews("instructor/training/training_list", $this->global, $training_data, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL , NULL);
        }
    }
    
    public function showTraining($d = 0){
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '6');
        $this->global["sidebar"] = $this->sidebar->generate($side_params, $this->role);
        if($this->isInstructor()){			
            $training_data = array();
            $result_list = $this->Training_model->getListByCompanyId($this->session->get_userdata() ['company_id']);			
            $res_id_list = $this->Training_model->getListCourseId($this->session->get_userdata() ['company_id']);
            $time_list = array();
            foreach($res_id_list as $key => $row){
                foreach($result_list as $k => $r){
                    if($r['training_course_id'] == $row['id']){
                        if(!array_key_exists($r['month'], $time_list[$row['id']])) $time_list[$row['id']][$r['month']] = array();
                        array_push($time_list[$row['id']][$r['month']], $r);
                    }
                }
            }
            // var_dump($time_list);
            // die();
            $res_course_list = array();
            foreach($res_id_list as $key => $row){
                $res_course_list[$row['id']] = $row;
            }
            //$training_data['category'] = $this->Category_model->getListByCompanyID($this->session->get_userdata()['company_id']);
            $training_data['category'] = $this->Course_model->getAll(array('create_id' => $this->session->get_userdata() ['company_id'], 'course_type' => 0, 'active' => 1));
			$training_data['category_ids'] = $this->Category_model->getListByCompanyID($this->session->get_userdata() ['company_id']);
            /*print_r($training_data['category']);
            die();*/
			
            $training_data['course_list'] = $res_course_list;
            $training_data['training_list'] = $time_list;
			$training_data['all_course_list'] = $res_course_list;
            $dis_month = $_SESSION['dis_month'];
            if(intval($d) > 0){
                $dis_month = $dis_month + 1;
            }
            if(intval($d) < 0){
                $dis_month = $dis_month - 1;
            }
            $this->session->set_userdata('dis_month', $dis_month);
            $training_data['dis_month'] = $dis_month;
			$training_data['countries'] = $this->Location_model->getAllCounties();
            $this->loadViews("instructor/training/training_list", $this->global, $training_data, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL , NULL);
        }
    }

    public function delete(){
        $out_data = array();
        $id = $this->input->post('id');
        if($this->Training_model->deleteCourse($id)){
            $out_data["status"] = "Success";
            $out_data["message"] = "";
        }else{
            $out_data["status"] = "Fail";
            $out_data["message"] = "Could not delete the row.";
        }
        $this->response($out_data);
    }
	
	public function deleteIltCourse(){
        $out_data = array();
        $id = $this->input->post('id');
        if($this->Training_model->deleteCourseTraining($id)){
            $out_data["status"] = "Success";
            $out_data["message"] = "";
        }else{
            $out_data["status"] = "Fail";
            $out_data["message"] = "Could not delete the row.";
        }
        $this->response($out_data);
    }
    
    public function getuser(){
        $company_id = $this->session->get_userdata() ['company_id'];
        $table_data = $this->User_model->getUser($company_id);
        foreach($table_data["data"] as $key => $row){
            $table_data["data"][$key]["no"] = $key + 1;
        }
        $records["data"] = $table_data["data"];
        $records['recordsTotal'] = $table_data["total"];
        $records['recordsFiltered'] = $table_data['filtertotal'];
        $this->response($records);
    }

}
?>
