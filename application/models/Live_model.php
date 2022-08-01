<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Timon
 * Date: 6/27/2018
 * Time: 6:24 PM
 */

class Live_model extends AbstractModel
{
    /**
     * This function used to manage categories
     */
    protected $live_table;
    protected $course_user_table;
    protected $course_time_table;
    protected $user_table;
    protected $table;

    var $_table = 'virtual_course';

    function __construct()
    {
        parent::__construct();
        $this->course_table = 'virtual_course';
        $this->course_time_table = 'virtual_course_time';
        $this->course_user_table = 'virtual_course_user';
        $this->user_table = 'user';
    }
    function insertTrainingUser($data)
    {
        $data['reg_date'] = date("Y-m-d H:i:s");
        $this->db->insert($this->course_user_table, $data);
        $id = $this->db->insert_id();
        return $id;
    }
    function isBooking($course_id = 0, $user_id = 0){
        //$sql = "select * from training_course_user where training_course_time_id = $course_id and user_id = $user_id";
        $sql = "select * from virtual_course_user where virtual_course_time_id = '".$course_id."' and user_id = $user_id"; 
        return count($this->db->query($sql)->result_array());
    }
    function getFreeCourses($filter){
        $user = $this->session->userdata();
        $query = "SELECT c.id course_id, e.id course_time_id, f.id enroll_id, b.id training_id, b.title, c.duration, c.img_path, e.start_at, e.start_time, e.end_time
            FROM invite_user a
            LEFT JOIN `user` d ON d.email = a.email
            LEFT JOIN virtual_course b ON b.id = a.course_id
            LEFT JOIN virtual_course_time e ON e.virtual_course_id = b.id
            LEFT JOIN course c ON c.id = b.course_id
            LEFT JOIN enrollments f ON f.user_id = d.id AND f.course_id = c.id AND f.course_time_id = e.id
            WHERE a.course_type = 1 AND d.email = '".$user['email']."' AND b.create_id = '".$user['company_id']."' AND c.pay_type = 0";
            
        if($filter['location']){
            $query = $query . " And e.location = '".$filter['location']."'";
        }
        if($filter['course']){
            $query = $query . " And b.id = '".$filter['course']."'";
        }
        $query = $query . " ORDER BY e.start_at, e.start_time";
        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }

    function getPaidCourses($filter){
        $user = $this->session->userdata();
        $query = "SELECT b.id course_id, c.start_at, c.start_time, c.end_time, c.id course_time_id, a.id training_id, a.title, a.duration, b.course_self_time,
        c.start_at, d.id pay_id, f.id enroll_id, b.pay_price,b.img_path
        FROM virtual_course a
        LEFT JOIN course b ON a.course_id = b.id
        JOIN virtual_course_time c ON a.id = c.virtual_course_id
        LEFT JOIN payment_history d ON d.object_id = b.id AND d.object_type = 'live' AND d.user_id = '".$user['user_id']."' AND d.company_id = '".$user['company_id']."'
        LEFT JOIN enrollments f ON f.course_id = b.id AND f.course_time_id = c.id
        WHERE b.pay_type = 1 AND a.create_id = '".$user['company_id']."'";
        if($filter['location']){
            $query = $query . " And c.location = '".$filter['location']."'";
        }
        if($filter['course']){
            $query = $query . " And a.id = '".$filter['course']."'";
        }
        $query = $query . " ORDER BY c.start_at, c.start_time";
        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }

    function getListByCompanyId($company_id = 0)
    {
        $query = 'Select * from virtual_course as c left join virtual_course_time as ct on ct.virtual_course_id = c.id where c.create_id='.$company_id;
        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;

    }

    function deleteCourse($row_id)
    {
        $this->db->where("id", $row_id);
        $this->db->delete("virtual_course");
    }

    function getCourseById($id = NULL) {
        $this->db->select('a.*');
        $this->db->from('virtual_course'." a");
        $this->db->where('a.id', $id);

        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

    function update_chapter_library($library_id, $row_id)
    {
        $this->db->where('id', $row_id);
        $result = $this->db->update("chapter_live", array("library_id"=>$library_id));
        return $result;
    }

    function getLibrary($id = NULL){
        $this->db->select('a.*,b.name,b.file_path');
        $this->db->from("chapter_live"." a");
        $this->db->join("library".' b', 'a.library_id = b.id', 'left');
        $this->db->where('a.course_id',$id);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    function getListById($id = 0, $company_id = 0){
        $query = 'Select * from virtual_course as c left join virtual_course_time as ct on ct.virtual_course_id = c.id where c.create_id='.$company_id.' and c.id='.$id;
        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }
    function get_course_time_id($course_id)
    {   
        $query = "Select * from virtual_course_time WHERE virtual_course_id = ".$course_id." ORDER BY reg_date DESC";
        
        $result = $this->db->query($query);
        $res=$result->first_row();

        return $res;

    }
    function delete_time($id)
    {
        $res = $this->db->delete($this->course_time_table, array('id'=>$id));
        return $res;

    }

    function getListCourseId($company_id = 0){
        $query = 'Select * from virtual_course where create_id='.$company_id;
        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }
	
	function getListByCourseId($courseid = 0){
        $query = 'Select virtual_course.*, start_time, end_time from virtual_course LEFT JOIN virtual_course_time on virtual_course_time.virtual_course_id = virtual_course.id where course_id='.$courseid;
        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }

    function getListCourse($where = null)
    {
        if ($where == null) {
            $result = $this->db->get($this->course_table);
        } else {
            $result = $this->db->get_where($this->course_table, $where);
        }
        return $result->result_array();
    }
	
	function getListByVirtualCourseId($course_id){
		$query = 'Select * from virtual_course as c left join virtual_course_time as ct on ct.virtual_course_id = c.id where ct.id='.$course_id;		
        $result = $this->db->query($query);
        $res=$result->result_array();
		return $res;
	}

    function insert_course($data)
    {
        $data['reg_date'] = date("Y-m-d H:i:s");
        $data['is_deleted'] = 0;

        $this->db->insert($this->course_table, $data);
        $id = $this->db->insert_id();
        return $id;
    }

    function update_course($data, $row_id)
    {
        $this->db->where('id', $row_id);
        $result = $this->db->update($this->course_table, $data);
        return $result;
    }

    function insert_time($data)
    {
        $data['reg_date'] = date("Y-m-d H:i:s");
        // print_r($data);
        $this->db->insert($this->course_time_table, $data);
        $id = $this->db->insert_id();
        return $id;
    }

    function update_time($data, $where = null){
        $this->db->where($where);
        $result = $this->db->update($this->course_time_table, $data);
        return $result;
    }
	
	function deleteCourseVirtual($row_id){
		$res = '';
        $this->db->where("id", $row_id);
        if($this->db->delete("virtual_course")){
			$this->db->delete($this->course_time_table, array('virtual_course_id'=>$row_id));	
			$res = 1;
		}
		return $res;
    }


}
