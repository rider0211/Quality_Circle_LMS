<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Timon
 * Date: 6/27/2018
 * Time: 6:24 PM
 */
//require APPPATH . '/libraries/AbstractModel.php';
class Course_model extends AbstractModel
{
    /**
     * This function used to manage categories
     */
    protected $table;
    var $_table = 'course';

    function __construct()
    {
        $this->table = 'course';
        $this->history_table = 'course_history';
        $this->user_table = 'user';
        $this->library_table = 'library';
        $this->page_table = 'page';
        $this->chapter_table = 'chapter';
    }

    function getAll($filter = NULL, $order = NULL, $direction = 'asc', $fields = "*"){
        return parent::all($filter);
    }
    function getChapter($id){
        $query = "SELECT * from chapter WHERE id=$id";

        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }

    function getHistoryByUserID($user_id = null){
        $query = "select cs.*, concat(u.first_name, ' ', u.last_name) as name, c.title as title from course_status as cs join course as c on cs.course_id=c.id join user as u on cs.user_id=u.id where u.id=$user_id ORDER BY cs.reg_date desc";
        $result = $this->db->query($query);
        $res=$result->result_array();
/*        if($user_id == null){
            $query = "Select * from course_history as ch join course as c on ch.course_id = c.id";

        }else{
            $query = "Select * from course_history as ch join course as c on ch.course_id = c.id WHERE ch.user_id = $user_id";

        }
        $result = $this->db->query($query);
        $res=$result->result_array();*/

        return $res;
    }

    function getFirstChapter($course_id){
        $query = "Select * from chapter where course_id = $course_id and parent = 0 and exam_id = 0 order BY position";

        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }

    function getLastHistoryByUserID($course_id, $user_id){
        $query = "Select * from course_history where user_id = $user_id and course_id = $course_id order BY reg_date DESC";

        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }

    function insertHistory($data){
        $data['reg_date'] = date("Y-m-d H:i:s");
        $rst = $this->db->insert($this->history_table, $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function insertPayData($data)
    {
        $rst = $this->db->insert('payment_history', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function updateHistory($data, $row_id)
    {
        $this->db->where('id', $row_id);
        $result = $this->db->update($this->history_table, $data);
        return $result;
    }

    function getPageByChID($ch_id)
    {
        $query = "SELECT * from chapter WHERE parent=$ch_id and exam_id = 0 and quiz_id = 0";

        $result = $this->db->query($query);

        return $result->result_array();
    }
    function getFreeCourses($filter){
        $user = $this->session->userdata();
        $query = "SELECT c.id course_id, c.start_at, f.id enroll_id, c.title, c.duration, c.img_path, c.end_at
        FROM invite_user a
        LEFT JOIN `user` b ON a.email = b.email
        LEFT JOIN course c ON a.course_id = c.id
        LEFT JOIN enrollments f ON f.user_id = b.id AND f.course_id = c.id
        WHERE a.email = '".$user['email']."' AND b.payment_status = '1' AND a.course_type = 2 AND pay_type = 0 AND c.create_id = '".$user['company_id']."'";
        if($filter['category']){
            $query = $query . " And c.category_id = '".$filter['category']."'";
        }
        if($filter['course']){
            $query = $query . " And c.id = '".$filter['course']."'";
        }
        
        $result = $this->db->query($query);
        $res=$result->result_array();
        return $res;
    }

    function getPaidCourses($filter){
        $user = $this->session->userdata();
        $query = "SELECT a.id course_id, a.title, a.duration, a.start_at, d.id pay_id, f.id enroll_id, a.pay_price, a.img_path, a.end_at
        FROM course a
        LEFT JOIN payment_history d ON d.object_id = a.id AND d.object_type = 'course' AND d.user_id = '".$user['user_id']."' AND d.company_id = '".$user['company_id']."'
	    LEFT JOIN enrollments f ON f.course_id = a.id
        WHERE course_type = 2 and pay_type = 1 AND create_id = '".$user['company_id']."'";
        if($filter['category']){
            $query = $query . " And c.category_id = '".$filter['category']."'";
        }
        if($filter['course']){
            $query = $query . " And c.id = '".$filter['course']."'";
        }
        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }
    /*start front function*/
    function all($filter = NULL, $order = NULL, $direction = 'asc', $fields = "*"){
		$currentDate = date('Y-m-d');
        $this->db->where('show_user',0);
        $this->db->where('active',1)->where('end_at >=',$currentDate);

        if((!empty($filter['course_title'])) && isset($filter['course_title'])){
            $this->db->like('course.title', $filter['course_title']); 
        }

        if((!empty($filter['id'])) && isset($filter['id'])){
            $this->db->where('id', $filter['id']);
        }
		
		if((!empty($filter['category_id'])) && isset($filter['category_id'])){
            $this->db->where('category_id', $filter['category_id']);
        }

        if((!empty($filter['standard_id'])) && isset($filter['standard_id'])){
            $this->db->where('standard_id', $filter['standard_id']);
        }

        if(!empty($filter['course_type'])){
            $this->db->where('course_type', $filter['course_type']);
        }

        // if((!empty($filter['create_id'])) && isset($filter['create_id'])){
        //     $this->db->where('create_id', $filter['create_id']);
        // }
        if(!empty($filter['user_id'])){
            $this->db->or_where('show_user',1);
            $this->db->or_where('show_user',2)->like('enroll_users','"'.$filter['user_id'].'"','',FALSE);
        }

        // if((!empty($filter['title'])) && isset($filter['title'])){
        //    $this->db->like('course.title', $filter['title'], 'both');
        // }

        unset($filter['user_id']);
        unset($filter['course_title']);
        if(!empty($filter['search'])) {
            $this->db->group_start();
            $this->db->like('course.title', $filter['search']); 
            $this->db->or_like('course.location', $filter['search']); 
            $this->db->group_end();
        }

        $this->db->select("*,DATE_FORMAT(reg_date,'%b %d,%Y') as freg_date");
        //$result = parent::all($filter,'pay_price','desc');
        $result = parent::all($filter,'id','desc');
        // echo "<pre>";
        //     print_r($this->db->last_query());
        // exit;
        //while (list($key, $val) = each($result)) {
        foreach($result as $key => $val) {
            $result[$key]->enrolls = count(json_decode($val->enroll_users));
            $instructors = json_decode($val->instructors);
            if(!empty($instructors)){
                $result[$key]->first_instructor = $this->db->where('id',$instructors[0])
                ->where('user_type','instructor')
                ->select('id,email')
                ->get($this->user_table)->row_array();
                $result[$key]->is_pay = $this->db->where('user_id',$this->session->userdata('user_id'))
                    ->where('object_type','course')
                    ->where('object_id',$val->id)
                    ->select('id')
                    ->get('payment_history')
                    ->row_array();
            }
        }
        return $result;
    }

    function getUsers()
    {
        $this->db->select('id');
        $this->db->from('user');
        $this->db->where('user_type','Learner');
        $query = $this->db->get();
        $result = $query->result();
        return $result;

    }

    function count($filter = NULL) {
        $this->db->where('show_user',0);
        $this->db->where('active',1);

        if((!empty($filter['course_title'])) && isset($filter['course_title'])){
            $this->db->like('course.title', $filter['course_title']); 
        }

        if(!empty($filter['course_type'])){
            $this->db->where('course_type', $filter['course_type']);
        }

        if((!empty($filter['standard_id'])) && isset($filter['standard_id'])){
            $this->db->where('standard_id', $filter['standard_id']);
        }

        // if((!empty($filter['title'])) && isset($filter['title'])){
        //    $this->db->like('course.title', $filter['title'], 'both');
        // }

        if(!empty($filter['user_id'])){
            $this->db->or_where('show_user',1);
            $this->db->or_where('show_user',2)->like('enroll_users','"'.$filter['user_id'].'"','',FALSE);
        }

        unset($filter['user_id']);
        unset($filter['course_title']);
        if(!empty($filter['search'])) {
            $this->db->group_start();
            $this->db->or_like('course.title', $filter['search'], 'both');
            $this->db->or_like('course.location', $filter['search'], 'both'); 
             /*$this->db->or_like('course.email', $filter['search'], 'both');*/
            $this->db->group_end();
        }
        return parent::count($filter);
    }

    function getRecent($count = null,$company_id = null){
        if(!isset($count)){
            $count = 3;
        }
        if(isset($company_id)){
            $this->db->where('create_id',$company_id);
        }
		$currentDate = date('Y-m-d');
        $this->db->where('active',1)->where('course_type',2)->where('end_at >=',$currentDate);
        $this->db->order_by('reg_date','desc');
        $this->db->limit(3,0);
		//$this->db->where ("(reg_date >= now())");
        $this->db->select("*,DATE_FORMAT(reg_date,'%b %d,%Y') as freg_date");
        $result = $this->db->get($this->table)->result_array();
       
        //while (list($key, $val) = each($result)) {
        foreach($result as $key => $val) {
            $result[$key]['enrolls'] = count(json_decode($val['enroll_users']));
            $instructors = json_decode($val['instructors']);
            if(!empty($instructors)){
                $result[$key]['first_instructor'] = $this->db->where('id',$instructors[0])
                                                             ->where('user_type','instructor')
                                                             ->select('id,email')
                                                             ->get($this->user_table)->row_array();
                $result[$key]['is_pay'] = $this->db->where('user_id',$this->session->userdata('user_id'))
                                                    ->where('object_type','course')
                                                    ->where('object_id',$val['id'])
                                                    ->select('id')
                                                    ->get('payment_history')->row_array();

            }
        }
        return $result;
    }

    function select($id = null){
        $this->db->select("*,DATE_FORMAT(reg_date,'%b %d,%Y') as freg_date");
        $result = parent::select($id);
        $result->enrolls = count(json_decode($result->enroll_users));
        $instructors = json_decode($result->instructors);
        if(!empty($instructors)){
            $result->first_instructor = $this->db->where('id',$instructors[0])
                                                         ->where('user_type','instructor')
                                                         ->select('id,email,picture')
                                                         ->get($this->user_table)->row();
            $result->is_pay = $this->db->where('user_id',$this->session->userdata('user_id'))
                ->where('object_type','course')
                ->where('object_id',$id)
                ->select('id')
                ->get('payment_history')->row_array();
        }
        $result->highlights = $this->db->where('course_id',$result->id)->get('highlight')->result();
        return $result;
    }
    function getLimitation($filter){
        $query = "SELECT COUNT(*) count FROM course WHERE course_type = '".$filter['course_type']."' and create_id = '".$filter['company_id']."'";
        $result = $this->db->query($query)->row();
        return $result->count;
    }
    function getLibrary($id = NULL){
        $this->db->select('a.*,b.name,b.file_path');
        $this->db->from($this->chapter_table." a");
        $this->db->join($this->library_table.' b', 'a.library_id = b.id', 'left');
        $this->db->where('a.course_id',$id);
        $this->db->order_by('position', 'asc');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    function getLibrary_live($id = NULL){
        $this->db->select('a.*,b.name,b.file_path');
        $this->db->from('chapter_live'." a");
        $this->db->join($this->library_table.' b', 'a.library_id = b.id', 'left');
        $this->db->where('a.course_id',$id);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    function getLibrary_training($id = NULL){
        $this->db->select('a.*,b.name,b.file_path');
        $this->db->from('chapter_training'." a");
        $this->db->join($this->library_table.' b', 'a.library_id = b.id', 'left');
        $this->db->where('a.course_id',$id);
        $this->db->order_by('position', 'asc');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    /*end front function*/
    function getCourseByCompany($filter = NULL) {

        $this->db->select('a.*');
        $this->db->from($this->table." a");
        $this->db->where('a.active', $filter["status"]);
        $this->db->where('a.create_id', $filter["company_id"]);
		if(isset($filter["id"]))
            $this->db->where('a.id', $filter["id"]);
        if(isset($filter["category_id"]))
            $this->db->where('a.category_id', $filter["category_id"]);
        if(isset($filter["standard_id"]))
            $this->db->where('a.standard_id', $filter["standard_id"]);
        if(isset($filter["course_type"]))
            $this->db->where('a.course_type', $filter["course_type"]);
        if(!empty($filter['search'])) {
            $this->db->group_start();
            $this->db->or_like('a.title', $filter['search'], 'both');
            $this->db->or_like('a.subtitle', $filter['search'], 'both');
            $this->db->or_like('a.about', $filter['search'], 'both');
            $this->db->group_end();
        }
        $this->db->order_by('start_at','ASC');
        $this->db->limit($filter['limit'], $filter['start']);

        $query = $this->db->get();
        $result = $query->result_array();
        //while (list($key, $val) = each($result)) {
        foreach($result as $key => $val) {
            $result[$key]->enrolls = count(json_decode($val->enroll_users));
            $instructors = json_decode($val['instructors']);
            if(!empty($instructors)){
                $result[$key]['first_instructor'] = $this->db->where('id',$instructors[0])
                    ->where('user_type','instructor')
                    ->select('email')
                    ->get($this->user_table)->row_array()['email'];
            }
        }
        return $result;
    }

    function deleteCourse($row_id)
    {
        $this->db->where("id", $row_id);
        $this->db->delete("course");
    }

    function getCourseById($id = NULL) {
        $this->db->select('a.*,b.name as category_name, c.name as standard_name');
        $this->db->from($this->table." a");
        $this->db->join('category b','a.category_id = b.id','left');
        $this->db->join('category_standard c','a.standard_id = c.id','left');
        $this->db->where('a.id', $id);

        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

    function insert_course($data){
        $data['reg_date'] = date("Y-m-d H:i:s");
        $rst = $this->db->insert($this->table, $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function update_course($data, $row_id)
    {
        $this->db->where('id', $row_id);
        $result = $this->db->update($this->table, $data);
        return $result;
    }

    function getHighlightByCourse($id = NULL) {
        $this->db->select('a.*');
        $this->db->from("highlight a");
        $this->db->where('a.course_id', $id);

        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
	
	function getPreRequisiteHighlightByCourse($id = NULL) {
        $this->db->select('a.*');
        $this->db->from("prerequisitehighlight a");
        $this->db->where('a.course_id', $id);

        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function delete_highlight($row_id)
    {
        $this->db->where("course_id", $row_id);
        $this->db->delete("highlight");
    }

    function insert_highlight($data)
    {
        $result = $this->db->insert("highlight", $data);
        return $result;
    }
	
	function delete_prerequisite_highlight($row_id)
    {
        $this->db->where("course_id", $row_id);
        $this->db->delete("prerequisitehighlight");
    }

    function insert_prerequisite_highlight($data)
    {
        $result = $this->db->insert("prerequisitehighlight", $data);
        return $result;
    }

    function update_chapter_library($library_id, $row_id)
    {
        $this->db->where('id', $row_id);
        $result = $this->db->update("chapter", array("library_id"=>$library_id));
        return $result;
    }

    function update_chapter_library_training($library_id, $row_id){
        $this->db->where('id', $row_id);
        $result = $this->db->update("chapter_training", array("library_id"=>$library_id));
        return $result;
    }

    function update_chapter_library_live($library_id, $row_id){
        $this->db->where('id', $row_id);
        $result = $this->db->update("chapter_live", array("library_id"=>$library_id));
        return $result;
    }

    function pay_course($data){
        $data['reg_date'] = date("Y-m-d H:i:s");
        $rst = $this->db->insert("course_history", $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function getAssessByCourseID($course_id){
        $query = "SELECT ca.*, ch.title, ch.quiz_id FROM course_assessment AS ca JOIN user AS u ON ca.user_id = u.id RIGHT JOIN chapter as ch ON ca.chapter_id = ch.id WHERE ca.course_id = $course_id AND ch.exam_id = 0 ORDER BY ch.position";

        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }

    function getQuizPageByCourseId($course_id){
        $query = "SELECT ch.*, ch1.page_type as relative_type, eqg.quiz_ids as quiz_ids from chapter as ch left join chapter as ch1 on ch.relative_page_id = ch1.id join exam_quiz_group as eqg on ch.quiz_id = eqg.id where ch.course_id=$course_id and ch.quiz_id != 0";

        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }
    function getQuizByChapterId($chapter_id){
        $query = "SELECT ch.*, eqg.quiz_ids AS quiz_ids 
            FROM chapter AS ch 
            JOIN exam_quiz_group AS eqg ON ch.quiz_id = eqg.id 
            WHERE ch.id=$chapter_id and ch.quiz_id != 0";

        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }

    function get_exam_data_courseid($course_id){
        $query = "SELECT ch.* from chapter as ch where ch.course_id = $course_id and ch.exam_id!=0";
        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }

    function get_pay_user($course_id){
        //$query = "SELECT ph.*, CONCAT(u.first_name, ' ', u.last_name)AS fullname FROM payment_history as ph JOIN user as u ON ph.user_id = u.id WHERE ph.object_type = 'course' AND ph.object_id = $course_id GROUP BY ph.user_id";

        $query = "SELECT ph.*, CONCAT(u.first_name, ' ', u.last_name)AS fullname FROM payment_history as ph JOIN user as u ON ph.user_id = u.id WHERE ph.object_type <> 'plan' AND ph.object_id = $course_id ";
        
        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }
    function getAssessUser($course, $user_id){
        if($course['pay_type'] == 1){
            $query = "SELECT ph.*, CONCAT(u.first_name, ' ', u.last_name)AS fullname FROM payment_history as ph JOIN user as u ON ph.user_id = u.id WHERE ph.object_type <> 'plan' AND ph.object_id = ". $course['id']." and ph.user_id=$user_id GROUP BY ph.user_id";
        }else{
            $query = "SELECT *, course_id object_id, user_name as fullname FROM enrollments WHERE enrollments.course_id = " . $course['id'] ." and user_id=$user_id";
        }
        return $this->db->query($query)->result_array();
    }

    function getExamId($course_id){
        $query = "select ch.*, e.title from chapter as ch join exam as e on ch.exam_id=e.id where ch.course_id=$course_id and ch.exam_id != 0";
        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }

    function get_pay_data($course_id, $user_id)
    {
        $query = "SELECT ph.*, CONCAT(u.first_name, ' ', u.last_name)AS fullname FROM payment_history as ph JOIN user as u ON ph.user_id = u.id WHERE ph.object_type = 'course' AND ph.object_id = $course_id and ph.user_id=$user_id GROUP BY ph.user_id";

        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }
    function get_unpay_data($course_id, $user_id)
    {
        $query = "SELECT u.id AS user_id, CONCAT(u.first_name, ' ', u.last_name)AS fullname FROM user as u  WHERE u.id = $user_id ";

        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }

    function getChapterByCourseID($course_id){
        $this->db->select('a.*');
        $this->db->from("chapter a");
        $this->db->where('a.course_id', $course_id);
        $this->db->where('a.parent', 0);
        $this->db->where('a.exam_id', 0);

        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    ///////////////////////////////////////////////////////////////////////////////

    function data_gets($tblName, $dataget = '', $limits ='', $orderby='', $orderformat ='asc', $orDatget='' ) {

        $this->db->select('*');
        
        if($dataget != ''){

            foreach ($dataget as $field => $value)

                $this->db->where($field, $value);

        }

        if($orDatget != ''){

            foreach ($orDatget as $field => $value)

                $this->db->or_where($field, $value);

        }

        if ($limits != ''){

            $this->db->limit($limits);

        }

        if ($orderby != ''){

            $this->db->order_by($orderby, $orderformat);

        }

        $query = $this->db->get($tblName);

        return $query->result();

    }

    function get_single_row($tableName, $dataget, $returnType = ''){

        if($dataget != ''){

            foreach ($dataget as $field => $value)

                $this->db->where($field, $value);

        }

        $result = $this->db->get($tableName);

        if ($result->num_rows() > 0) {

            if ($returnType == 'array')

                return $result->row_array();

            else

                return $result->row();

        }

        else

            return FALSE;

    }

    function getNumNoAssessByCourse($course_id, $user_id){
        $query = "Select * from chapter WHERE id NOT IN (SELECT chapter_id from course_assessment where user_id=$user_id and course_id=$course_id and assessment != 0) and course_id=$course_id and parent = 0";

        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }

    function checkAssessByChapter($user_id, $position, $course_id){
        $query = "Select * from chapter WHERE id NOT IN (SELECT chapter_id FROM course_assessment WHERE user_id=$user_id and course_id=$course_id) and position < $position and course_id=$course_id and parent = 0 and exam_id = 0";

        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }

    function get_row($tableName, $colName, $id, $returnType = '') {

        $this->db->where($colName, $id);

        $result = $this->db->get($tableName);

        if ($result->num_rows() > 0) {

            if ($returnType == 'array')

                return $result->row_array();

            else

                return $result->row();

        }

        else

            return FALSE;

    }

    function data_updates($tblName, $dataset,  $dataget){

        $this->db->set($dataset);

        $this->db->where($dataget);

        $this->db->update($tblName);

        return $this->db->affected_rows();

    }

    function data_insert($tblName, $data){

        $this-> db->insert($tblName, $data);

        return $this->db->affected_rows();

    }

    function data_delete($tblName, $dataget){

        $this->db->where($dataget);

        $this->db->delete($tblName);

        return $this->db->affected_rows();

    }

    function delete_multi($tblName, $dataget) {

        $this->db->where($dataget);

        $this->db->delete($tblName);

        return TRUE;
    }

    function data_gets_between($tblName, $dataget, $databtw){
        $this->db->select('*');
        $datafind = "";
        if($dataget != ''){
            $sno = 0;
            foreach ($dataget as $field => $value){
                if($sno == 0){
                    $datafind = "$field = $value ";
                }else{
                    $datafind .= "AND $field = $value ";
                }
                $sno++;
            }
        }

        $datafindbtw = '';
        if($databtw != ''){
            $datafindbtw = "AND ".$databtw['column']." between ".$databtw['from']." AND ".$databtw['to'];
        }

        $sql = "SELECT `".$databtw['column']."`, `id` FROM $tblName WHERE $datafind $datafindbtw";

        $query=$this->db->query($sql);

        return $query->result();

    }

    function getCoursePageCheckStatus($user_id, $chapter_id)
    {
        $query = "select (select count(*) from chapter as ch where ch.quiz_id != 0 and ch.parent=$chapter_id)-(select count(*) from chapter as ch JOIN chapter_num as ch_n on ch.id=ch_n.chapter_id where ch_n.user_id=$user_id and ch.quiz_id != 0 and ch.parent=$chapter_id and ch_n.num >= ch.attempt_num) as num";
        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }

    function getCourseExamCheckStatus($user_id, $chapter_id)
    {
        $query = "select (select exam_max_num from chapter as ch where ch.id=$chapter_id)-(select num from chapter_num where chapter_id=$chapter_id and user_id=$user_id) as num";
        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }

    function getCourseHistoryList($company_id)
    {
        $query = "select cs.*, concat(u.first_name, ' ', u.last_name) as name, c.title as title from course_status as cs join course as c on cs.course_id=c.id join user as u on cs.user_id=u.id where c.create_id=$company_id ORDER BY cs.reg_date desc";
        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }

    function getCertificateHistoryList($company_id)
    {
        $query = "select cs.*, concat(u.first_name, ' ', u.last_name) as name, c.title as title from course_status as cs join course as c on cs.course_id=c.id join user as u on cs.user_id=u.id where c.create_id=$company_id and cs.status=4";
        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }

    function deleteAllChapterNumber($chapter_id, $user_id)
    {
        $query = "delete chn.* from chapter_num as chn join chapter as ch on chn.chapter_id=ch.id where ch.course_id = (select course_id from chapter where id=$chapter_id) and chn.user_id = $user_id";
        $result = $this->db->query($query);
    }

    function deleteAllCourseHistory($chapter_id, $user_id)
    {
        $query = "delete chn.* from course_history as chn join chapter as ch on chn.chapter_id=ch.id where ch.course_id = (select course_id from chapter where id=$chapter_id) and chn.user_id = $user_id";
        $result = $this->db->query($query);
    }

    function deleteAllCourseAssessment($chapter_id, $user_id)
    {
        $query = "delete chn.* from course_assessment as chn join chapter as ch on chn.chapter_id=ch.id where ch.course_id = (select course_id from chapter where id=$chapter_id) and chn.user_id = $user_id";
        $result = $this->db->query($query);
    }

    function deleteAllCourseStatus($chapter_id, $user_id)
    {
        $query = "delete chn.* from course_status as chn where chn.course_id = (select course_id from chapter where id=$chapter_id) and chn.user_id = $user_id";
        $result = $this->db->query($query);
    }

    function getCourseDataByChID($chapter_id)
    {
        $query = "select * from chapter as ch join course as c on ch.course_id=c.id join chapter_num as chn on chn.chapter_id=ch.id where ch.id=$chapter_id";
        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }

    function getExamFeedback($exam_id,$user_id)
    {
        $this->db->select("a.*")->from("exam_feedback a");
        $this->db->where('a.exam_id = '.$exam_id.' and a.user_id = '.$user_id.'');

        $query = $this->db->get();
        return $query->row();
    }

    function all_count($filter = NULL){
        if($filter!=NULL) {
            foreach($filter as $name=>$value) {
                if($name=="start" || $name=="limit" || $name=="search")
                    continue;
                if (is_array($value)) {
                    $this->db->where_in($this->sfield($name), $value);
                } else {
                    $this->db->where($this->sfield($name), $value);
                }
            }
        }
        return $this->db->count_all_results($this->table);
    }
    function sfield($field) {
        if(!strpos($field, "."))
            return $this->db->protect_identifiers($this->table) . "." . $field;
        return $field;
    }

    function getCertificateHistoryCount($company_id = 0)

    {
        $query = "SELECT
                        count(*) as count
                  FROM
                        course_status AS cs
                        JOIN course AS c ON cs.course_id = c.id
                        JOIN user AS u ON cs.user_id = u.id
                        WHERE
                            cs. STATUS = 4";
        if($company_id != 0)
            $query = $query." AND c.create_id = ".$company_id;
        $result = $this->db->query($query);
        $res=$result->row_array();

        return $res['count'];
    }
	function getSessionDateTime($tblName, $dataget){
		$this->db->select('*');
		$this->db->where('title', $dataget['title']);
		$this->db->where('course_id', $dataget['course_id']);
		$query = $this->db->get($tblName);
		return $query->result();
		
	}
	
	 function chapterSessionDateTimeUpdate($tblName, $dataset,  $dataget){

        $this->db->set($dataset);

        $this->db->where($dataget);

        $this->db->update($tblName);

        return $this->db->affected_rows();

    }
	function showSessionDateTime($tblName, $id){
		$this->db->select('session_dateTime');
		$this->db->where('id', $id);
		$query = $this->db->get($tblName);
		return $query->result();
	}
	function removeSessionDateTime($courseId,$courseTitle){
		$this->db->set('session_dateTime', '');
        $this->db->where('course_id', $courseId);
        $this->db->where('title', $courseTitle);
        $this->db->update('chapter');
        return $this->db->affected_rows();
	}
	public function getTodayOnlineLearner(){
		$loginDate = date("Y-m-d");
		$this->db->select('*');
		$this->db->where('user_type', 'Learner');
		$this->db->like('last_login', $loginDate);
		$query = $this->db->get('user');
		return $query->result(); 
		
	}
	public function allUserLearner(){
		
		$query = "Select * from user where user_type = 'Learner' and is_active = 1";
        $result = $this->db->query($query);
        $res=$result->ccc();
        return $res;
		
		/* $this->db->select('email');
		$this->db->where('user_type', 'Learner');
		$this->db->where('is_active', 1);
		$query = $this->db->get('user');
		return $query->getRow(); */
		
	}
	public function getLastInsertCourse(){ 
		$this->db->select("*");
		$this->db->limit(1);
		$this->db->order_by('id',"DESC");
		$this->db->where('is_cron', 0);
		$query = $this->db->get('course');
		$result = $query->row();
		return $result;
	}
	public function updateLastCourse($id){
		$this->db->set('is_cron', 1);
        $this->db->where('id', $id);
        $this->db->update('course');
        return $this->db->affected_rows();
	}
	
	public function update_row($chapter_id){
		$result = $this->getChapter($chapter_id);
		$status = ($result[0]['status'] == 1)?0:1;
		$this->db->set('status', $status);
        $this->db->where('id', $chapter_id);
        $this->db->update('chapter');		
        return $status;	
	}
	
	
	public function getCronJobCourse(){
		$this->db->select("*");
		$this->db->order_by('id',"DESC");
		$this->db->where('is_cron', 1);
		$query = $this->db->get('course');
		$result = $query->result_array();
		return $result;
		
	}
	
	public function getPaymentHistory($user_id){
		$query = "SELECT * from payment_history WHERE user_id=$user_id and object_type = 'course'";
        $result = $this->db->query($query);
		$res = $result->result_array();		
		return $res;
	}
	
	public function getPaymentHistoryByCourse($course_id){
		$query = "Select id from payment_history where object_id =  ".$course_id." and object_type = 'course'";
		$result = $this->db->query($query);
		return $result->num_rows();
	}
    
	public function getAllCourse(){
		$query = "SELECT * from course ORDER BY course_type";
        $result = $this->db->query($query);
		$res = $result->result_array();		
		return $res;
	} 
	
	public function getAllCourseFilter($filter=NULL){
		$this->db->from('course');
        if((!empty($filter['course_title'])) && isset($filter['course_title'])){
            $this->db->where('course.id', $filter['course_title']); 
        }
        if(isset($filter['course_type'])){
			if($filter['course_type'] != ''){
            	$this->db->where('course.course_type',$filter['course_type']);
			}
        }
		$query = $this->db->get();
        $result = $query->result();
		return $result;
	} 
	
	public function getCourseDetailById($course_id){
		$query = "SELECT * from course where id = ".$course_id."";
		$result = $this->db->query($query);
		$res = $result->result_array();
		return $res;
	}
    public function getCourseTime($course_id, $course_type){
        if ($course_type == 0) {
            $sql = "SELECT a.id, a.img_path, a.title, course_self_time, a.course_type,  c.start_day start_at,  a.duration, a.active, a.create_id, a.category_id, a.standard_id FROM course a
            LEFT JOIN training_course b ON  b.course_id = a.id
            LEFT JOIN training_course_time c ON c.training_course_id = b.id";
        }else {
            $sql = "SELECT a.id, a.img_path, a.title, course_self_time, a.course_type,  c.start_at,  a.duration, a.active, a.create_id, a.category_id, a.standard_id FROM course a
            LEFT JOIN virtual_course b ON  b.course_id = a.id
            LEFT JOIN virtual_course_time c ON c.virtual_course_id = b.id";
        }
        $sql = $sql . " WHERE a.course_type = $course_type AND a.id = $course_id" ;
        return $this->db->query($sql)->row_array();
    }
    
}
