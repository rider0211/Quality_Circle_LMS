<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Timon
 * Date: 6/27/2018
 * Time: 6:24 PM
 */
//require APPPATH . '/libraries/AbstractModel.php';
class Enrollments_model extends AbstractModel{
    /**
     * This function used to manage categories
     */
    protected $table;
    var $_table = 'enrollments';

    function __construct(){
        $this->table = 'enrollments';
    }
	
	function getEnrolledList($user_id,$course_id,$time_id){
        $query = "Select count(id) as count from enrollments where user_id=$user_id and course_id=$course_id and course_time_id=$time_id";
        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res[0]['count'];
    }
	
	function insertEnrolledUser($data){
        $this->db->insert($this->table, $data);
        $id = $this->db->insert_id();
        return $id;
    }
	
	function totalCourseEnrollments($course_id,$time_id){
		$query = "Select count(id) as count from enrollments where course_id=$course_id and course_time_id = $time_id";
        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res[0]['count'];
	}
	
	function totalCourseEnrollmentsCount($course_id){
		$query = "Select count(id) as count from enrollments where course_id=$course_id";
        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res[0]['count'];
	}
	
	function delete($id){
         $this->db->delete($this->table, array('id'=>$id));
		 return "success";
	}
	
	function getCourseSchedules($course_id,$course_type){
		$data = [];
		if($course_type == 0){
			$query = "select training_course_time.start_day, training_course.id,training_course.course_id,course.title,training_course_time.date_str,training_course_time.sday,training_course_time.month,training_course_time.year,training_course_time.id as time_id FROM training_course, course,training_course_time where training_course.course_id = course.id and course.id = ".$course_id." and training_course_time.training_course_id = training_course.id";
			$result = $this->db->query($query);
			$data = $result->result_array();
			
		}else if($course_type == 1){
			$query = "select virtual_course_time.start_at, virtual_course.id,virtual_course.course_id,course.title,virtual_course_time.start_at,virtual_course_time.id as time_id FROM virtual_course, course,virtual_course_time where virtual_course.course_id = course.id and course.id = ".$course_id." and virtual_course_time.virtual_course_id = virtual_course.id";
			$result = $this->db->query($query);
			$result = $this->db->query($query);
			$data = $result->result_array();
			
		}else{
			$data = $data;
		}
		return $data;		
	}
	
    
}