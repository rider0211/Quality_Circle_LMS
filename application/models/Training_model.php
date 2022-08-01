<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Timon
 * Date: 6/27/2018
 * Time: 6:24 PM
 */

class Training_model extends AbstractModel
{
    /**
     * This function used to manage categories
     */
    protected $course_table;
    protected $course_user_table;
    protected $course_time_table;
    protected $user_table;
    protected $table;

    var $_table = 'training_course';

    function __construct()
    {
        parent::__construct();
        $this->course_table = 'training_course';
        $this->course_time_table = 'training_course_time';
        $this->course_user_table = 'training_course_user';
        $this->user_table = 'user';
		$this->courses_table = 'course';
    }

    function update_chapter_library($library_id, $row_id)
    {
        $this->db->where('id', $row_id);
        $result = $this->db->update("chapter_training", array("library_id"=>$library_id));
        return $result;
    }

    function getLibrary($id = NULL){
        $this->db->select('a.*,b.name,b.file_path');
        $this->db->from("chapter_training"." a");
        $this->db->join("library".' b', 'a.library_id = b.id', 'left');
        $this->db->where('a.course_id',$id);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    function getCourseById($id = NULL) {
        $this->db->select('a.*');
        $this->db->from('training_course'." a");
        $this->db->where('a.id', $id);

        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }
    function getCourseByTrainingId($id = NULL) {
        $this->db->select('b.*');
        $this->db->from('training_course'." a");
        $this->db->join('course b','a.course_id = b.id', 'left');
        $this->db->where('a.id', $id);

        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

    function deleteCourse($row_id)
    {
        $this->db->where("id", $row_id);
        $this->db->delete("training_course");
    }

    function getLocation()
    {

        $query = "Select location from training_course_time where is_deleted = 0 GROUP BY location";

        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }
    /*start front*/
    function all($filter = NULL, $order = NULL, $direction = 'asc', $fields = "*"){
        if(!empty($filter['search'])) {
            $this->db->group_start();
            $this->db->or_like('training_course.title', $filter['search'], 'both'); 
            $this->db->group_end();
        }

        $this->db->select("a.*,a.id as training_time_id, training_course.title,
            training_course.subtitle,training_course.id,training_course.description,training_course.startday,training_course.endday,
            training_course.duration,training_course.course_id,course.category_id,course.standard_id,a.month mreg_date, a.sday dreg_date, 
            course.amount, course.discount, course.pay_price")
            ->from("training_course_time as a");
				
        $this->db->join("training_course", 'a.training_course_id = training_course.id', 'left');
        $this->db->join("course", 'training_course.course_id = course.id', 'left');
		// $this->db->join("training_course_time", 'training_course_time.training_course_id = course.id', 'left');

        if((!empty($filter['location'])) && isset($filter['location'])){
            $this->db->where('a.location', $filter['location']);
        }
        if((!empty($filter['category_id'])) && isset($filter['category_id'])){
            $this->db->where('course.category_id', $filter['category_id']);
        }
        if((!empty($filter['standard_id'])) && isset($filter['standard_id'])){
            $this->db->where('FIND_IN_SET(\''. $filter['standard_id'] .'\',course.standard_id)!=',0);
        }
		if($filter['sort'] == 'upcoming'){ 
            $this->db->where("UNIX_TIMESTAMP(CONCAT(a.start_day,' ',a.start_time))  >", time());
            $direction = 'asc';
        }else if($filter['sort'] == 'past'){
            $this->db->where("UNIX_TIMESTAMP(CONCAT(a.start_day,' ',a.start_time))  <", time());
            $direction = 'desc';
        }
        $this->db->order_by('a.start_day', $direction);
        unset($filter['sort']);
        // unset($filter['category_id']);
        // unset($filter['standard_id']);
        if(isset($filter['limit']) && isset($filter['start']))
        {
            $this->db->limit($filter['limit'], $filter['start']);
        }
        else if(isset($filter['limit']))
        {
            $this->db->limit($filter['limit']);
        }

        if((!empty($filter['create_id'])) && isset($filter['create_id'])){
            $this->db->where('training_course.create_id', $filter['create_id']);
        }
        $query = $this->db->get();

        // echo "<pre>";
        //     print_r($this->db->last_query());
        // exit;

        $result = $query->result();
        foreach ($result as $key => $value) {
            $course=$this->db->select('pay_type,pay_price')->from('course')->where('id',$value->course_id)->get()->result();

            if(count($course)>0){
                $result[$key]->pay_type = $course[0]->pay_type;
                $result[$key]->pay_price = $course[0]->pay_price;
            }
            $result[$key]->is_pay = $this->db->where('user_id',$this->session->userdata('user_id'))
                    ->where('object_type','training')
                    ->where('object_id',$value->training_course_id)
                    ->select('id')
                    ->get('payment_history')
                    ->row_array();
            $start_date = date_format(date_create($value->month.'/'.$value->sday),"m/d"); 
            $end_date = date("m/d",strtotime("+".($value->duration-1)." day", strtotime($start_date)));
            $today = strtotime(date('m/d'));
            if(strtotime($start_date) <= $today && strtotime($end_date) >= $today)
                $result[$key]->expired = 'no';
            else $result[$key]->expired = 'yes';
			
			
			$course_time = $this->Training_model->get_course_time_id($result[$key]->id);
            $result[$key]->course_time_id = $course_time->id; 			
        }
        return $result;
    }
		
	function getListByCompanyIdCourse($course){ 
		$query = "Select * from training_course as c left join training_course_time as ct on ct.training_course_id = c.id WHERE c.course_id='$course'";

        $result = $this->db->query($query);
        $res=$result->result_array();
		
        return $res;
    }
    function getFreeCourses($filter){
        $user = $this->session->userdata();
        $query = "SELECT c.id course_id, b.description, e.id course_time_id, b.id training_id, f.id enroll_id, b.title, e.start_day, e.start_time, e.end_time, e.date_str, c.duration, c.course_self_time, g.session_time
            FROM invite_user a
            LEFT JOIN `user` d ON d.email = a.email
            LEFT JOIN training_course b ON b.id = a.course_id
            LEFT JOIN training_course_time e ON e.training_course_id = b.id
            LEFT JOIN course c ON c.id = b.course_id
            LEFT JOIN enrollments f ON f.user_id = d.id AND f.course_id = c.id AND f.course_time_id = e.id
            LEFT JOIN ( SELECT SUM( course_time ) session_time, user_id, course_id FROM course_session WHERE user_id = '".$user['user_id']."' GROUP BY course_id ) g ON g.course_id = c.id AND d.id = g.user_id
            WHERE a.course_type = 0 AND d.email = '".$user['email']."' AND b.create_id = '".$user['company_id']."' AND c.pay_type = 0 ";
        if($filter['location']){
            $query = $query . " And e.location = '".$filter['location']."'";
        }
        if($filter['course']){
            $query = $query . " And b.id = '".$filter['course']."'";
        }
        $query = $query . " ORDER BY e.start_day, e.start_time";
        $result = $this->db->query($query);
        $res=$result->result_array();
   
        return $res;
    }

    function getPaidCourses($filter){
        $user = $this->session->userdata();
        $query = "SELECT b.id course_id, c.id course_time_id, a.id training_id, a.title, a.description, b.course_self_time,
                        a.duration, c.date_str, c.start_day, c.start_time, c.end_time, d.id pay_id, f.id enroll_id, b.pay_price, b.course_self_time, g.session_time
                FROM training_course a
                LEFT JOIN course b ON a.course_id = b.id
                LEFT JOIN training_course_time c ON a.id = c.training_course_id 
                LEFT JOIN payment_history d ON d.object_id = b.id AND d.object_type = 'training' AND d.user_id = '".$user['user_id']."' AND d.company_id = '".$user['company_id']."'
                LEFT JOIN enrollments f ON f.course_id = b.id AND f.course_time_id = c.id
                LEFT JOIN ( SELECT SUM( course_time ) session_time, user_id, course_id FROM course_session WHERE user_id = '".$user['user_id']."' GROUP BY course_id ) g ON g.course_id = b.id 
            WHERE b.pay_type = 1  AND a.create_id = '".$user['company_id']."'";
        if($filter['location']){
            $query = $query . " And c.location = '".$filter['location']."'";
        }
        if($filter['course']){
            $query = $query . " And a.id = '".$filter['course']."'";
        }
        $query = $query . " ORDER BY c.start_day, c.start_time";
        $result = $this->db->query($query);
        $res=$result->result_array();
        
        return $res;
    }

    function getListByCompanyIdLocation($company_id, $location){

        $query = "Select * from training_course as c left join training_course_time as ct on ct.training_course_id = c.id WHERE c.create_id=$company_id and ct.location='$location'";
        
        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }

    function count($filter = NULL) {
        if(!empty($filter['search'])) {
            $this->db->group_start();
            $this->db->or_like('training_course.title', $filter['search'], 'both');
            $this->db->group_end();
        }
        $this->db->select("*,a.month mreg_date, a.sday dreg_date")->from("training_course_time a");
        $this->db->join("training_course", 'a.training_course_id = training_course.id', 'left');
        $this->db->join("course", 'training_course.course_id = course.id', 'left');

        if((!empty($filter['location'])) && isset($filter['location'])){
            $this->db->where('a.location', $filter['location']);
        }
        if((!empty($filter['category_id'])) && isset($filter['category_id'])){
            $this->db->where('training_course.category_id', $filter['category_id']);
        }
        if((!empty($filter['standard_id'])) && isset($filter['standard_id'])){
            $this->db->where('course.standard_id', $filter['standard_id']);
        }
        if((!empty($filter['create_id'])) && isset($filter['create_id'])){
            $this->db->where('training_course.create_id', $filter['create_id']);
        }
       
        if($filter['sort'] == 'upcoming'){ 
            $this->db->where("UNIX_TIMESTAMP(CONCAT(a.start_day,' ',a.start_time))  >", time());
            $direction = 'asc';
        }else if($filter['sort'] == 'past'){
            $this->db->where("UNIX_TIMESTAMP(CONCAT(a.start_day,' ',a.start_time))  <", time());
            $direction = 'desc';
        }
        $query = $this->db->get();
        $result = $query->result_array();
        return count($result);

    }

    function select($id = null){
        $this->db->select("a.*, a.id as ids,c.img_path, c.pay_type, c.pay_price, c.amount, c.tax_rate, 
            c.discount, b.*, a.month mreg_date, a.sday dreg_date")->from("training_course_time a");
        $this->db->join("training_course b", 'a.training_course_id = b.id', 'left');
        $this->db->join('course c','c.id = b.course_id', 'left');
        $this->db->where('a.id', $id);
        $query = $this->db->get();
        $result = $query->row();
        
        $result->enrolls = count(json_decode($result->enroll_users));
        $instructors = json_decode($result->instructors);
        if(!empty($instructors)){
            $result->first_instructor = $this->db->where('id',$instructors[0])->where('user_type','instructor')
                ->select('id,email,picture')
                ->get($this->user_table)->row();
        }
        $result->is_pay = $this->db->where('user_id',$this->session->userdata('user_id'))
                    ->where('object_type','training')
                    ->where('object_id',$result->training_course_id)
                    ->select('id')
                    ->get('payment_history')
                    ->row_array();
        $start_date = date_format(date_create($result->mreg_date.'/'.$result->dreg_date),"m/d"); 
        $end_date = date("m/d",strtotime("+".($result->duration-1)." day", strtotime($start_date)));
        $result->end_month = date_format(date_create($end_date),"n");
        $result->end_day = date_format(date_create($end_date),"j");
        $today = strtotime(date('m/d'));
        if(strtotime($start_date) <= $today && strtotime($end_date) >= $today)
             $result->expired = 'no';
        else $result->expired = 'yes';
		
		$this->db->select('course_self_time');
		$this->db->from($this->courses_table);
		$this->db->where('id', $result->course_id);

		$queryss = $this->db->get();
		$result->course_self_time = $queryss->row_array()['course_self_time']; 
		
        return $result;
    }
    function upcoming_three_course($id, $categroy){
        $this->db->select("a.*,training_course.title,training_course.id as training_course_id,training_course.description,training_course.duration,training_course.course_id,a.month mreg_date, a.sday dreg_date")->from("training_course_time a");
        $this->db->join("training_course", 'a.training_course_id = training_course.id', 'left');
        $this->db->where('training_course.id <> '. $id);
        $this->db->where('training_course.category', $categroy);
        $this->db->where("UNIX_TIMESTAMP(CONCAT(start_day,' ',start_time))  >", time());
        $this->db->order_by('a.start_day', 'asc');
        $this->db->limit('3');

        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    function booknow($id,$user_id,$pay_data){
        $this->db->where('user_id',$user_id);
        $this->db->where('training_course_time_id',$id);
        $count = $this->db->count_all_results($this->course_user_table);
        if($count > 0){
            $data['type'] = 0;
            $data['msg'] = 'The same course already exists!';
        }else{
            $insert_data['reg_date'] = date("Y-m-d H:i:s");
            $insert_data['user_id'] = $user_id;
            $insert_data['training_course_time_id'] = $id;
            $this->db->insert($this->course_user_table, $insert_data);
            $id = $this->db->insert_id();
            $this->db->set("company_id","(select company_id from user where id = (select create_id from training_course where id = (select training_course_id from training_course_time where id = ".$id.")))",false);
            $this->db->insert("payment_history", $pay_data);
            if(isset($id)){
                $data['type'] = 1;
            }else{
                $data['type'] = 0;
                $data['msg'] = 'Failed!';
            }
            
        }
        return $data;
    }
    /*end front*/
    function get_course_time_id($course_id)
    {   
        $query = "Select * from training_course_time WHERE training_course_id = ".$course_id." ORDER BY reg_date DESC";
        
        $result = $this->db->query($query);
        $res=$result->first_row();

        return $res;

    }
    function getListByCompanyId($company_id = null)
    {
        if($company_id != null)
            $query = 'Select * from training_course as c left join training_course_time as ct on ct.training_course_id = c.id where c.create_id='.$company_id;
        else
            $query = 'Select * from training_course as c left join training_course_time as ct on ct.training_course_id = c.id';
        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;

    }

    function delete_time($id)
    {
        $res = $this->db->delete($this->course_time_table, array('id'=>$id));
        return $res;

    }

    function getPayCourseList($id){
        $query = "Select training_course_time_id as id from training_course_user where user_id=$id";
        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }

    function getListCourseId($company_id = null){
        if($company_id != null)
            $query = "Select tc.* from training_course as tc where tc.create_id=".$company_id;
        else
            $query = "Select tc.* from training_course as tc ";

        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }
	
	function getListByCourseId($courseid){
        $query = "Select training_course.*, start_day, start_time, end_time from training_course LEFT JOIN training_course_time on training_course_time.training_course_id = training_course.id where course_id=".$courseid;

        $result = $this->db->query($query);
        $res=$result->result_array();
        return $res;
    }

    function getPayUser($tid){
        $query = "Select u.id as id, CONCAT(u.first_name, \" \", u.last_name) AS fullname from training_course_user as tcu join user as u on tcu.user_id = u.id where tcu.training_course_time_id=$tid";
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

    function insertTrainingUser($data)
    {
        $data['reg_date'] = date("Y-m-d H:i:s");
        $this->db->insert($this->course_user_table, $data);
        $id = $this->db->insert_id();
        return $id;
    }

    function getCourseInstructor($id){
        $sql = "select instructors from training_course where id = $id";
        return $this->db->query($sql)->result_array();
    }

    function isBooking($course_id = 0, $user_id = 0){
        //$sql = "select * from training_course_user where training_course_time_id = $course_id and user_id = $user_id";
        $sql = "select * from training_course_user where training_course_time_id = '".$course_id."' and user_id = $user_id"; 
        return count($this->db->query($sql)->result_array());
    }

    function insert_course($data)
    {
        $data['reg_date'] = date("Y-m-d H:i:s");
        $data['is_deleted'] = 0;

        $this->db->insert($this->course_table, $data);
        $id = $this->db->insert_id();
        return $id;
    }

    function update_course($data, $id){
        $this->db->where('id', $id);
        $result = $this->db->update($this->course_table, $data);
        return $result;
    }

    function insert_time($data)
    {
        $data['reg_date'] = date("Y-m-d H:i:s");

        $this->db->insert($this->course_time_table, $data);
        $id = $this->db->insert_id();
        return $id;
    }

    function update_time($data, $where = null){
        $this->db->where($where);
        $result = $this->db->update($this->course_time_table, $data);
        return $result;
    }
	
	
	function getCountryNameById($countryId){		
		$this->db->select('name');
        $this->db->from('countries');
        $this->db->where('id', $countryId);
        $query = $this->db->get();
		
		return $query->row_array()['name'];
	}
	
	function getStateNameById($stateId){		
		$this->db->select('name');
        $this->db->from('states');
        $this->db->where('id', $stateId);
        $query = $this->db->get();
		
		return $query->row_array()['name'];
	}
	
	function getCityNameById($cityId){		
		$this->db->select('name');
        $this->db->from('cities');
        $this->db->where('id', $cityId);
        $query = $this->db->get();
		
		return $query->row_array()['name'];
	}
	
	function deleteCourseTraining($row_id){
		$res = '';
        $this->db->where("id", $row_id);
        if($this->db->delete("training_course")){
			$this->db->delete($this->course_time_table, array('training_course_id'=>$row_id));
			$res = 1;
		}
		return $res;
    }

}
