<?php
defined('BASEPATH') OR ('No direct script access allowed');

    function getCategoryNameById($category_id =''){
        $CI =& get_instance();
		$CI->load->model('Category_model');
        $result = $CI->Category_model->getRow($category_id);
        return $result[0]['name'];
    }
	function getEndTime($startTime){
		switch($startTime){
			case "7:00 AM": 
				return "3:00 PM";
			case "8:00 AM": 
				return "4:00 PM";
			case "9:00 AM": 
				return "5:00 PM";
			case "10:00 AM": 
				return "6:00 PM";
		}
	}
	function getStandardNameById($standard_id =''){
        $CI =& get_instance();
		$CI->load->model('Standard_model');
        $result = $CI->Standard_model->getRow($standard_id);
        return $result[0]['name'];
    }
	
	function getCourseImgById($course_id){
		$CI =& get_instance();
		$CI->load->model('Course_model');
     	$result = $CI->Course_model->getCourseById($course_id);		
        return $result['img_path'];
	}
	
	function getCourseDetail($course_id,$course_type){
		//$result = $this->Course_model->getCourseDetailById($course_id);		
		$CI2 =& get_instance();
		$CI2->load->model('Enrollments_model');
     	$result = $CI2->Enrollments_model->getCourseSchedules($course_id,$course_type);
		
		return $result;
	}
	function getScheTotalCount($course_id,$time_id){
		//$result = $this->Course_model->getCourseDetailById($course_id);		
		$CI2 =& get_instance();
		$CI2->load->model('Enrollments_model');
     	$count = $CI2->Enrollments_model->totalCourseEnrollments($course_id,$time_id);
		
		return $count;
	}

?>