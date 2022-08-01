<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Exam_model extends CI_Model
{
    
    /**
     * This function used to manage exams
     */
   	protected $table;
    
    function __construct()
    {
        parent::__construct();
        $this->table = 'exam';
        $this->exam_quiz_table = 'exam_quiz';
        //$this->topic_table = 'training_topic';    
        //$this->category_table = 'training_category';    
    }

    function count($searchcond = array())
    {
        foreach ($searchcond as $fname=>$val) {
            if(is_array($val)) {
                if(count($val)>0)
                    $this->db->where_in($fname, $val);    
                else
                    $this->db->where($fname, 0);    
            } else {
                $this->db->where($fname, $val);        
            }
        }
        return $this->db->count_all_results($this->table);
    }
    
    function getList($searchcond = array(), $limit = "", $offset = "")
    {
        $company_id = $this->session->get_userdata()['company_id'];
        $this->db->select("a.*, (select count(*) from exam_quiz b where b.exam_id = a.id) quiz_num")->from($this->table." a");
        $this->db->join("user c", 'a.create_id = c.id', 'left');
        $this->db->where("c.company_id", $company_id);

        $total = $this->db->count_all_results('', FALSE);

        foreach ($searchcond as $fname=>$val) {
            if(is_array($val)) {
                if(count($val)>0)
                    $this->db->where_in($fname, $val);    
                else
                    $this->db->where($fname, 0);       
            } else {
                $this->db->where($fname, $val);        
            }
        }
        $this->db->where("a.is_deleted", 0);

        $this->db->order_by('a.`reg_date`', 'DESC');

        $filtertotal = $this->db->count_all_results('', FALSE);
        if(isset($limit) && isset($offset))
        {
            $this->db->limit($limit, $offset);
        } 
        else if(isset($limit))
        {
            $this->db->limit($limit);
        }

        $query = $this->db->get();

        $result_info = array();
        if ($query->num_rows() > 0) {
            $result_info['total'] = $total;
            $result_info['filtertotal'] = $filtertotal;
            $result_info['data'] = $query->result_array();
        } else {
            $result_info['total'] = 0;
            $result_info['filtertotal'] = 0;
            $result_info['data'] = array();
        }

        return $result_info;
    }

    function getExamList()
    {
        $this->db->select("id, exam_title")->from($this->table);
        $this->db->where('status', 1);
        $this->db->order_by('`id`', 'ASC');

        $query = $this->db->get();

        return $query->result_array();
    }

    function getQuizIds($id){
        $query = "select * from exam_quiz_group where id = $id";
        $result = $this->db->query($query);
        return $result->result_array();
    }

    function getQuizGroupList($company_id)
    {
        $query = "select * from exam_quiz_group where company_id = $company_id";
        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }

    function getExamListByCompanyID($company_id)
    {
        $query = "select e.title as title, e.id as id from exam as e join user as u on e.create_id = u.id where u.company_id = $company_id";
        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }

    function getQuizGroup($id)
    {
        $query = "select * from exam_quiz_group WHERE id=$id";
        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }


    function getQuizListByCompanyID($company_id)
    {
        $query = "select e.ques_title as title, e.id as id from exam_quiz as e where e.type != 'essay' and e.company_id = $company_id";
        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }

    function getQuizGroupListByCompanyID($company_id)
    {
        $query = "select * from exam_quiz_group WHERE company_id = $company_id";
        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }

    function getExamListByIds($arr_id=array())
    {
        $this->db->select("a.id, exam_title, exam_image, quiz_count, a.created_at, a.exam_price")->from($this->table." a");

        if(count($arr_id) > 0) {
            $this->db->where_in('a.`id`', $arr_id);    
        }
        
        $this->db->order_by('a.`id`', 'ASC');

        $query = $this->db->get();

        return $query->result_array();
    }    

    function getList4Select2($q='')
    {
        $this->db->select("a.id, exam_title AS text")->from($this->table." a");

        if(!empty($q))
        {
            $this->db->like('a.exam_title', $q);
        }
        
        $this->db->order_by('a.`id`', 'ASC');

        $query = $this->db->get();

        return $query->result_array();
    }

    function getList4Select2ByIds($arr_id=array(), $str='')
    {
        $this->db->select("a.id, exam_title AS text")->from($this->table." a");

        if(count($arr_id) > 0) {
            $this->db->where_in('a.`id`', $arr_id);    
        }
        
        if(!empty($str)) {
            $this->db->like('a.`exam_title`', $str);        
        }
        
        $this->db->order_by('a.`id`', 'ASC');

        $query = $this->db->get();

        return $query->result_array();
    }
   
    function getRow($row_id)
    {        
        
        $query ="SELECT a.*,
                        (SELECT SUM(pass_mark) FROM exam_quiz WHERE exam_id = a.id) as total_pass_mark,
                        (SELECT SUM(max_mark) FROM exam_quiz WHERE exam_id = a.id) as total_max_mark
                   FROM exam a
                   WHERE a.id = $row_id";
        $result = $this->db->query($query);
        $res=$result->result_array();
        return $res;
        /*
        $this->db->select("a.*")->from($this->table." a");
        //$this->db->join($this->topic_table." c", 'a.topic_id = c.id', 'left');
        //$this->db->join($this->category_table." d", 'c.category_id = d.id', 'left');

        $this->db->where('a.id',$row_id);
        
        $query=$this->db->get();
        $result=$query->result_array();
        return $result;*/
       
    }

    function active($id){
        $this->db->set('status', 1);
        $this->db->set('updated_at', date("Y-m-d H:i:s"));
        $this->db->where('id', $id);
        return $this->db->update($this->table);
    }

    function inactive($id){
        $this->db->set('status', 0);
        $this->db->set('updated_at', date("Y-m-d H:i:s"));
        $this->db->where('id', $id);
        return $this->db->update($this->table);
    }

    function insert($data){
        $data['reg_date'] = date("Y-m-d H:i:s");
        $rst = $this->db->insert($this->table, $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function insertQuizGroup($data){
        $rst = $this->db->insert('exam_quiz_group', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function updateQuizGroup($data, $row_id){
        $this->db->where('id', $row_id);
        $result = $this->db->update('exam_quiz_group', $data);
        return $result;
    }

    function deleteQuizGroup($id){
        return $this->db->delete('exam_quiz_group', array('id' => $id));
    }

    function insertFeedback($data){
        //$data['reg_date'] = date("Y-m-d H:i:s");
        $rst = $this->db->insert('exam_feedback', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function update($data, $row_id)
    {
        $data['updated_at'] = date("Y-m-d H:i:s");        
        $this->db->where('id', $row_id);
        $result = $this->db->update($this->table, $data);

        return $result;
    }

    function delete($row_id)
    {
        return $this->db->delete($this->table, array('id' => $row_id));
        
    }

    function getTrainingInfo($param = array()){

        $sql = "select count(a.lesson_id) count, sum(a.time) time FROM
                (
                    select lesson_id, max(TO_SECONDS(end_at) - TO_SECONDS(start_at)) time from training_history
                    where user_id = " . $param['user_id'] ." and topic_id = " . $param['topic_id'] . "
                    group by lesson_id
                ) a";

        return $this->db->query($sql)->result_array();
    }

    function getAll_emerald() {
        $this->db->select('id, exam_title');
        $this->db->from($this->table);
        $query = $this->db->get();

        return $query->result_array();
    }

    function getQuizAllList($company_id) {
        $this->db->select('*');
        $this->db->from("exam_quiz");
        $this->db->where('type !=', 'essay');
        $this->db->where('company_id', $company_id);
        $this->db->where('exam_id', 0);
        $query = $this->db->get();

        return $query->result_array();
    }

    function getQuizList($id) {
        $this->db->select('*');
        $this->db->from("exam_quiz");
        $this->db->where('exam_id', $id);
        $this->db->order_by('position','ASC');
        $query = $this->db->get();

        return $query->result_array();
    }

    function getRowQuiz($id) {
        $this->db->select('*');
        $this->db->from("exam_quiz");
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row_array();
    }

    function getRowQuizGroup($id){
        $this->db->select('*');
        $this->db->from("exam_quiz_group");
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row_array();
    }

    function updateQuiz($data, $row_id)
    {
        $data['updated_at'] = date("Y-m-d H:i:s");
        $this->db->where('id', $row_id);
        $result = $this->db->update("exam_quiz", $data);

        return $result;
    }

    function insertQuiz($data){
        $data['updated_at'] = date("Y-m-d H:i:s");
        $this->db->insert("exam_quiz", $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function getMaxPosition($id) {
        $this->db->select('MAX(position)+1 max_pos');
        $this->db->from("exam_quiz");
        $this->db->where('exam_id = (select exam_id from exam_quiz where id = '.$id.')');
        $query = $this->db->get();

        return $query->row_array();
    }

    function deleteQuiz($row_id)
    {
        return $this->db->delete("exam_quiz", array('id' => $row_id));

    }

    function updatePosition($id, $start_pos, $new_pos){
        $new_pos = $new_pos + 1;
        $this->db->set('position', $new_pos);
        $this->db->set('updated_at', date("Y-m-d H:i:s"));
        $this->db->where('id', $id);
        $this->db->update("exam_quiz");
    }

    function updatePositionOther($exam_id, $start_pos, $new_pos){
        $new_pos = $new_pos + 1;
        $start_pos = $start_pos + 1;
        if ($start_pos < $new_pos){
            $this->db->set('position', 'position - 1', false);
        }else{
            $this->db->set('position','position + 1',false);
        }
        $this->db->set('updated_at', date("Y-m-d H:i:s"));
        $this->db->where('exam_id', $exam_id);
        if ($start_pos < $new_pos){
            $this->db->where('position > '.$start_pos);
            $this->db->where('position <= '.$new_pos);
        }else{
            $this->db->where('position < '.$start_pos);
            $this->db->where('position >= '.$new_pos);
        }
        $this->db->update("exam_quiz");
    }

    function getRowQuizByPos($exam_id,$id) {
        $this->db->select('*');
        $this->db->from("exam_quiz");
        $this->db->where('exam_id', $exam_id);
        $this->db->where('position', $id);
        $query = $this->db->get();

        return $query->row_array();
    }

    function updateUserAnswer($user_id, $id, $content, $mark){
        $this->db->set('description', $content);
        $this->db->set('mark1', $mark);
        $this->db->where('quiz_id', $id);
        $this->db->where('user_id', $user_id);
        $this->db->update("exam_quiz_history");
    }

    function insertUserAnswer($data){
        $rst = $this->db->insert("exam_quiz_history", $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function updateQuizGroupAnswer($user_id, $id, $gid, $content, $mark){
        $this->db->set('description', $content);
        $this->db->set('mark1', $mark);
        $this->db->where('quiz_id', $id);
        $this->db->where('user_id', $user_id);
        $this->db->where('group_id', $gid);
        $this->db->update("exam_quiz_history");
    }

    function insertQuizGroupAnswer($data){
        $rst = $this->db->insert("exam_quiz_history", $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function getUserAnswer($user_id,$id) {
        $this->db->select('*');
        $this->db->from("exam_quiz_history");
        $this->db->where('user_id', $user_id);
        $this->db->where('quiz_id', $id);
        $query = $this->db->get();

        return $query->row_array();
    }
    function getQuizGroupAnswer($user_id,$id, $gid, $cid) {
        $this->db->select('*');
        $this->db->from("exam_quiz_history");
        $this->db->where('user_id', $user_id);
        $this->db->where('quiz_id', $id);
        $this->db->where('group_id', $gid);
        $this->db->where('chapter_id', $cid);
        $query = $this->db->get();

        return $query->row_array();
    }

    function get_quiz_history($course_id)
    {
        $query = "select eqh.* from exam_quiz_history as eqh join chapter as c on eqh.chapter_id=c.id where c.course_id=$course_id";
        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }

    function getQuizGroupNum($user_id, $chapter_id)
    {
        $query = "select * from chapter_num where user_id=$user_id and chapter_id=$chapter_id";
        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }

    function insertQuizGroupNum($user_id, $chapter_id, $num)
    {
        $this->db->insert("chapter_num", array('user_id'=>$user_id, 'chapter_id'=>$chapter_id, 'num'=>$num));
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function updateQuizGroupNum($user_id, $chapter_id, $num)
    {
        $this->db->where('chapter_id', $chapter_id);
        $this->db->where('user_id', $user_id);
        $result = $this->db->update("chapter_num", array('num'=>$num));
        return $result;
    }


    function getQuizGroupHistoryByUser($gid, $user_id, $chapter_id){
        $query = "select * from exam_quiz_history where group_id=$gid and user_id=$user_id and chapter_id=$chapter_id";
        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }

    function insertExamHistory($data){
        if (!empty($data['user_id']) && !empty($data['exam_id'])){
            $this->db->delete("exam_history", array('user_id' => $data['user_id'],"exam_id"=>$data['exam_id']));
        }
        $data['exam_start_at'] = date("Y-m-d H:i:s");
        $this->db->insert("exam_history", $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function getQuizHistoryByUser($exam_id,$user_id)
    {
        $this->db->select("a.*")->from("exam_quiz_history a");
        $this->db->join("exam_quiz b", 'a.quiz_id = b.id', 'left');
        $this->db->where("b.exam_id", $exam_id);
        $this->db->where("a.user_id", $user_id);

        $this->db->order_by('b.position', 'ASC');

        $query = $this->db->get();
        return $query->result_array();
    }

    function updateExamHistory($data, $exam_id, $user_id)
    {
        $this->db->where('exam_id', $exam_id);
        $this->db->where('user_id', $user_id);
        $result = $this->db->update("exam_history", $data);

        return $result;
    }
    function getExamHistory($user_id,$exam_id) {
        $this->db->select('*');
        $this->db->from("exam_history");
        $this->db->where('user_id', $user_id);
        $this->db->where('exam_id', $exam_id);
        $query = $this->db->get();
        
        //print_r($user_id);
        //print_r($exam_id);
        //exit();

        return $query->row_array();
    }

    function getExamByHistory($row_id)
    {
        $this->db->select("a.user_id, a.exam_id, b.*")->from("exam_history a");
        $this->db->join($this->table." b", 'a.exam_id = b.id', 'left');
        $this->db->where('a.id',$row_id);

        $query=$this->db->get();
        $result=$query->row_array();
        return $result;
    }

    function getExamHistoryData($exam_id, $user_id)
    {
        $this->db->select("b.*")->from("exam_history a");
        $this->db->join($this->table." b", 'a.exam_id = b.id', 'left');

        $this->db->where('a.exam_id',$exam_id);
        $this->db->where('a.user_id',$user_id);

        $query=$this->db->get();
        $result=$query->row_array();
        return $result;
    }

    function updatePositionByDelete($id){
        $this->db->select("a.exam_id, a.position")->from("exam_quiz a");
        $this->db->where('a.id',$id);
        $query=$this->db->get();
        $result=$query->row_array();

        $this->db->set('position','position - 1',false);
        $this->db->set('updated_at', date("Y-m-d H:i:s"));
        $this->db->where('exam_id',$result['exam_id']);
        $this->db->where('position > '.$result['position']);
        $this->db->update("exam_quiz");
    }

    function deleteExamHistory($user_id,$exam_id)
    {
        return $this->db->delete("exam_history", array('user_id' => $user_id,"exam_id"=>$exam_id));

    }

    /*
    function getExamInfo($row_id)
    {
        $this->db->select("a.*")->from($this->table." a");
        $this->db->where('a.id',$row_id);
        
        $query=$this->db->get();
        $result=$query->row_array();
        return $result;
    }*/

    function getExamInfo($exam_id)
    {
       $query ="SELECT a.*,
                        (SELECT CONCAT(first_name,' ',last_name) FROM user WHERE id = a.marker1_id) AS marker1, 
                        (SELECT CONCAT(first_name,' ',last_name) FROM user WHERE id = a.marker2_id) AS marker2, 
                        (SELECT CONCAT(first_name,' ',last_name) FROM user WHERE id = a.observer_id) AS observer
                   FROM exam a
                  WHERE a.id = $exam_id";

        $result = $this->db->query($query);
        $res=$result->result_array();
        return $res;        
    }

    function updateAnswerMark($data){
        $this->db->where('id', $data['id']);
        $result = $this->db->update('exam_quiz_history', $data);
        return $result;
    }

    function updateExamResult($data){
        $this->db->where('id', $data['id']);
        $result = $this->db->update('exam_history', $data);
        return $result;
    }
}

?>
