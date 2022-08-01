<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
/**
 * Class : Exam (ExamController)
 * Exam Class to control all exam related operations.
 * @author : ping
 * @version : 1.0
 * @since : 7 July 2018
 */
class Demand extends BaseController {
    /**
     * This is default constructor of the class
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('Course_model');
        $this->load->model('Certification_model');
        $this->load->model('User_model');
        $this->load->model('Exam_model');
        $this->load->model('Company_model');
        $this->load->model('Category_model');
        $this->load->model('Account_model');
		$this->load->model('Enrollments_model');
		$this->load->model('Examhistory_model');		
        $this->isLoggedIn();
        $this->load->library('Sidebar');
		$this->load->helper('common');
        $side_params = array('selected_menu_id' => '4');
        $this->isLearner();
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
    }
    /**
     * This function used to load the first screen of the user
     */
    public function index(){
        if($this->isLearner()){            
			// $filter['course_type'] = 2;
			// $course_id = $this->input->get('course');
			// if($course_id != null && $course_id != 0){
            //     $filter['id'] = $course_id;
            // }
			// $category_id = $this->input->get('category');
            // if($category_id != null && $category_id != 0){
            //     $filter['category_id'] = $category_id;
            // }
            // $this->global[term] = $this->term;
            // $this->global['company'] = $this->company;
            // /*pagenation*/
            // if($this->session->userdata('isLoggedIn') != NULL){
            //     $filter['user_id'] = $this->session->userdata('user_id');
            // }
            // $displayLength = 3;
            // $search = $this->input->get('sSearch');
            // $start = $this->input->get('per_page');
            // if(!isset($start)){
            //     $start = 0;
            // }
            // $filter['start'] = $start;
            // $filter['limit'] = $displayLength;
            // $filter['search'] = $search;
            $this->global['free_course_list'] = $this->Course_model->getFreeCourses($this->input->get());
            $this->global['paid_course_list'] = $this->Course_model->getPaidCourses($this->input->get());
            // unset($filter['start']);
            // unset($filter['limit']);
            // $this->global['iTotalRecords'] = $this->Course_model->count($filter);
            // $this->global['sEcho'] = $search;
            // $this->load->library('pagination');
            // $config['base_url'] = site_url('learner/demand/?sSearch=' . $search);
            // $config['page_query_string'] = TRUE;
            // $config['total_rows'] = $this->global['iTotalRecords'];
            // $config['per_page'] = $displayLength;
            // $config['num_links'] = 2;
            // $config['uri_segment'] = 3;
            // $config['full_tag_open'] = '<ul class="pagination">';
            // $config['full_tag_close'] = '</ul>';
            // $config['first_link'] = '&laquo;';
            // $config['first_tag_open'] = '<li class="page-item">';
            // $config['first_tag_close'] = '</li>';
            // $config['last_link'] = '&raquo;';
            // $config['last_tag_open'] = '<li class="page-item">';
            // $config['last_tag_close'] = '</li>';
            // $config['next_link'] = '&rarr;';
            // $config['next_tag_open'] = '<li class="page-item">';
            // $config['next_tag_close'] = '</li>';
            // $config['prev_link'] = '&larr;';
            // $config['prev_tag_open'] = '<li class="page-item">';
            // $config['prev_tag_close'] = '</li>';
            // $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
            // $config['cur_tag_close'] = '</a></li>';
            // $config['num_tag_open'] = '<li class="page-item">';
            // $config['num_tag_close'] = '</li>';
            // $this->pagination->initialize($config);
            // $this->global['links'] = $this->pagination->create_links();			
            $this->global['category_id'] = $category_id;
			// $this->global['courses_id'] = $course_id;			
            $this->global['category'] = $this->Category_model->getListByCompanyID($this->session->userdata('company_id'));
			
			$listcourses['user_id'] = $this->session->userdata('user_id');
			$listcourses['course_type'] = 2;
			$this->global['coursesfilter'] = $this->Course_model->all($listcourses);
            /*end*/
            $this->loadViews('learner/demand/demand_list', $this->global, NULL, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
	public function save_exam_feedback($row_id){
        $exam_id = $this->input->post('exam_id');
		$user_id = $this->input->post('user_id');
		
		$result = $this->Examhistory_model->deleteFeedback($exam_id,$user_id);

        $insert_data = array();
        foreach ($this->input->post() as $key => $value) {
            $insert_data[$key] = $value;
        }
        $this->Exam_model->insertFeedback($insert_data);
		redirect('learner/examhistory/feedback/' . $row_id);
    }
    public function view_Quiz($quiz_id = 0){
        if($this->isLearner()){
            $params['company'] = $this->company;
            $params['menu_name'] = 'catalog';
            $params['question'] = $this->Exam_model->getRowQuiz($quiz_id);
            $params['quiz_id'] = $quiz_id;
            $params['exam_show_type'] = 0;
            $params['question']['content'] = json_decode($params['question']['content'], true);
            $this->load->view('learner/exam/showQuiz', $params);
        }else{
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function checkQuizExist(){
        $quiz_id = $this->input->post('quiz_id');
        $chapter_id = $this->input->post('chapter_id');
        $user_id = $this->session->get_userdata() ['user_id'];
        $res = $this->Exam_model->getRowQuizGroup($quiz_id);
        $chapter = $this->Course_model->getChapter($chapter_id);
        $quiz_group_num = $this->Exam_model->getQuizGroupNum($user_id, $chapter_id);
        $this->response(array('quiz_num' => count($res), 'exist_num' => $chapter[0]['attempt_num'] - $quiz_group_num[0]['num']));
    }
    
    public function detail_course($row_id = 0,$time_id = 0){
        if($this->isLearner()){
            $page_path = "learner/demand/detail_course";
            $course = $this->Course_model->select($row_id);
            $this->global['libraries'] = $this->Course_model->getLibrary($row_id);
            $this->global['course_name'] = $course->title;
            $this->global['course_id'] = $row_id;
			if($course->access_restrict == 1){
				$this->global['restriction'] = $course->access_restrict;	
			}else{
				$this->global['restriction'] = 0;	
			}
            $this->global['company_url'] = $this->Company_model->getList(array('id' => $this->session->userdata('company_id'))) [0]['url'];
            $last_history = $this->Course_model->getLastHistoryByUserID($row_id, $this->session->get_userdata() ['user_id']);
            if(count($last_history) == 0){
                $last_history = $this->Course_model->getFirstChapter($row_id) [0];
                $this->global['last_history_ch_id'] = $last_history['id'];
            }else{
                $ch_id = $last_history[0]['chapter_id'];
                $this->global['last_history_ch_id'] = $ch_id;
            }
			
			$enrolledUsersCount = $this->Enrollments_model->getEnrolledList($this->session->get_userdata()['user_id'],$course->id,$time_id);
			if($enrolledUsersCount == 0){
				$enrolled_data = array(
					'user_id' => $this->session->get_userdata()['user_id'],
					'course_id' => $course->id,			
					'course_time_id' => $time_id,					
					'course_title' => $course->title,
					'user_name' => $this->session->get_userdata()['user_name'],
					'user_email' => $this->session->get_userdata()['email'],
					'create_date' => date("Y-m-d H:i:s"),					
				);	
				$this->Enrollments_model->insertEnrolledUser($enrolled_data);			
				$totalCourseEnrollments = $this->Enrollments_model->totalCourseEnrollments($course->id,$time_id);
			}
            $this->load->view($page_path, $this->global);
        }else{
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function view_course($id = NULL, $hid = NULL){
        if($this->isLearner()){
            $totalCourseEnrollments = $this->Enrollments_model->totalCourseEnrollments($id,0);
			$page_path = "learner/demand/view_course";
            $course = $this->Course_model->select($id);			
			$course->enroll_users = $totalCourseEnrollments;
			$this->global['course'] = $course;
            $course_history['end_time'] = date("Y-m-d H:i:s");
            $this->Course_model->updateHistory($course_history, $hid);
			
            $this->loadViews($page_path, $this->global, NULL, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function pay_course($row_id = 0,$time_id = 0){
        $user_id = $this->session->get_userdata() ['user_id'];
        //$this->Course_model->pay_course(array("user_id"=>$user_id,"course_id"=>$row_id));
        $price = $this->Course_model->select($row_id)->pay_price;
        $data['amount'] = $price;
        $data['user_id'] = $user_id;
        $data['object_type'] = 'course';
        $data['object_id'] = $row_id;
        $this->db->set("company_id", "(select create_id from course where id = " . $row_id . ")", false);
        $this->Account_model->insert_payment($data);
		$course_data = $this->Course_model->getCourseById($row_id);
		$totalCourseEnrollments = $this->Enrollments_model->totalCourseEnrollments($row_id,$time_id);
		if($totalCourseEnrollments == 0){
			$enrolled_data = array(
				'user_id' => $this->session->get_userdata()['user_id'],
				'course_id' => $row_id,			
				'course_time_id' => $time_id,					
				'course_title' => $course_data["title"],
				'user_name' => $this->session->get_userdata()['user_name'],
				'user_email' => $this->session->get_userdata()['email'],
				'create_date' => date("Y-m-d H:i:s"),					
			);	
			$this->Enrollments_model->insertEnrolledUser($enrolled_data);	
		}
        /*start send_email*/
        $create_id = $this->Course_model->select($row_id)->create_id;
        $company_id = $this->session->userdata('company_id');
        $instructors = $this->Course_model->select($row_id)->instructors;
        
        //- When users are assigned a course by admin
        //- Instructor & Admin  gets  notification when there is enrollment
        $this->load->library('email');
        $email_temp = $this->getEmailTemp('IA_enroll', $company_id);
        $from_email = $this->getEmailAddress($user_id);
        $to_email = $this->getEmailAddress($create_id); //admin_email to send
        $admin_name = $this->User_model->getFullNameById($create_id);
        $content = $email_temp['message'];
        $content = str_replace("{ADMIN_USERNAME}", $admin_name, $content);
        $content = str_replace("{LEANER_NAME}", $this->session->get_userdata() ['user_name'], $content);
        $content = str_replace("{COURSE_NAME}", $course_data["title"], $content);
        $content = str_replace("{LOGO}", "<img src='" . base_url('assets/logos/logo1.png') . "'/>"."<img src='" . base_url('assets/logos/logo2.png') . "'/>", $content);
        $content = str_replace("{CATEGORY}", $course_data["category_name"], $content);
        $content = str_replace("{STANDARD}", $course_data["standard_name"], $content);
        $email_class = new Email();
        $email_class->send_email($to_email, $email_temp['subject'], $email_temp['message'], $from_email);
        //instructor email to send
        if(!empty($instructors)){
            $instructors = json_decode($instructors, true);
            foreach ($instructors as $key => $val){
                $email_class->send_email($this->getEmailAddress($val), $email_temp['subject'], $email_temp['message'], $from_email);
            }
        }
        /*end send_email*/
        redirect('learner/demand/detail_course/' . $row_id);
    }
    
    public function checkExamExist(){
        $course_id = $this->input->post('course_id');
        $exam_id = $this->input->post('exam_id');
        $chapter_id = $this->input->post('chapter_id');
        $res = $this->Exam_model->getList(array('a.id' => $exam_id))['data'];
        $user_id = $this->session->get_userdata() ['user_id'];
        $chapter = $this->Course_model->getChapter($chapter_id);
        $quiz_group_num = $this->Exam_model->getQuizGroupNum($user_id, $chapter_id);
        $this->response(array('course_id' => $course_id, 'exam_num' => count($res), 'exist_num' => $chapter[0]['exam_max_num'] - $quiz_group_num[0]['num']));
    }
    
    public function checkAssessment(){
        $ch_id = $this->input->post('id');
        $user_id = $this->session->get_userdata() ['user_id'];
        $up_ch_id = null;
        $dataget = array('id' => $ch_id);
        $course = $this->Course_model->data_gets('chapter', $dataget, '', 'position', 'asc') [0];
        if($course->exam_id == 0){
            if($course->parent != 0){
                $dataget = array('id' => $course->parent);
                $parent = $this->Course_model->data_gets('chapter', $dataget, '', 'position', 'asc') [0];
                $dataget = array('position <' => $parent->position, 'course_id' => $parent->course_id, 'parent' => 0, 'exam_id' => 0);
            }else{
                $dataget = array('position <' => $course->position, 'course_id' => $course->course_id, 'parent' => 0, 'exam_id' => 0);
            }
            $up_chapter = $this->Course_model->data_gets('chapter', $dataget, '', 'position', 'desc') [0];
            $up_ch_id = $up_chapter->id;
            if(is_null($up_ch_id)){
                $dataget = array('course_id' => $course->course_id, 'user_id' => $user_id,);
                $status = $this->Course_model->data_gets('course_status', $dataget);
                if(count($status) == 0){
                    $dataset = array('course_id' => $course->course_id, 'user_id' => $user_id, 'reg_date' => date("Y-m-d H:i:s"), 'status' => 1);
                    $this->Course_model->data_insert('course_status', $dataset);
                }
            }
        }
        $dataget = array('id' => $course->course_id);
        $course_data = $this->Course_model->data_gets('course', $dataget) [0];
        if($course_data->is_ass_end == 1 && $course->exam_id == 0){
            $dataset = array('course_id' => $course->course_id, 'chapter_id' => $ch_id, 'user_id' => $user_id, 'reg_date' => date("Y-m-d H:i:s"));
            $this->Course_model->data_insert('course_history', $dataset);
            $res = array('check_num' => 1);
            $this->response($res);
            return;
        }
        //////////////////////////////////////////////////////////////////////////////////
        $dataget = array('id' => $course->course_id, 'create_id' => $this->session->get_userdata() ['company_id']);
        $data_course = $this->Course_model->data_gets('course', $dataget) [0];
        $results = $this->Course_model->getAssessByCourseID($course->course_id);
        $page_data['assess'] = $results;
        $page_data['session_quiz'] = $this->Course_model->getQuizPageByCourseId($course->course_id);
        $dataget = array('course_id' => $course->course_id, 'parent' => 0, 'exam_id' => 0);
        $page_data['course_session'] = $this->Course_model->data_gets('chapter', $dataget, '', 'position', 'asc');
        $page_data['course_pay_user'] = $this->Course_model->get_pay_user($course->course_id);
        $page_data['quiz_history'] = $this->Exam_model->get_quiz_history($course->course_id);
        $asses_data = array();
        foreach ($page_data['course_pay_user'] as $user){
            foreach ($page_data['course_session'] as $chapter){
                for ($i = 1;$i < 7;$i++){
                    $is_ass_exist = 0;
                    $page_type_sum = 0;
                    $page_type_num = 0;
                    foreach ($page_data['session_quiz'] as $quiz){
                        foreach ($page_data['assess'] as $asses){
                            if($i == $asses['page_type'] && $chapter->id == $asses['course_id'] && $asses['user_id'] == $user['user_id']){
                                $asses_data[$user['user_id']][$chapter->id][$i] = $asses['assessment'];
                                $is_ass_exist = 1;
                                break;
                            }
                        }
                        if($is_ass_exist == 0){
                            if($quiz['relative_type'] == $i && $quiz['parent'] == $chapter->id && $i != 6){
                                $group_quiz_sum = 0;
                                $quiz_ids = json_decode($quiz['quiz_ids']);
                                for ($j = 0;$j < count($quiz_ids);$j++){
                                    foreach ($page_data['quiz_history'] as $q_h){
                                        if($q_h['chapter_id'] == $quiz['id'] && $q_h['user_id'] == $user['user_id'] && $q_h['quiz_id'] == $quiz_ids[$j]){
                                            $group_quiz_sum = $group_quiz_sum + $q_h['mark1'];
                                        }
                                    }
                                }
                                $group_quiz_sum = (100 / (count($quiz_ids)) * $group_quiz_sum / 100);
                                $page_type_num++;
                                $page_type_sum = $page_type_sum + $group_quiz_sum;
                            } else if(is_null($quiz['relative_type']) && $quiz['parent'] == $chapter->id && $i == 6){
                                $group_quiz_sum = 0;
                                $quiz_ids = json_decode($quiz['quiz_ids']);
                                for ($j = 0;$j < count($quiz_ids);$j++){
                                    foreach ($page_data['quiz_history'] as $q_h){
                                        if($q_h['chapter_id'] == $quiz['id'] && $q_h['user_id'] == $user['user_id'] && $q_h['quiz_id'] == $quiz_ids[$j]){
                                            $group_quiz_sum = $group_quiz_sum + $q_h['mark1'];
                                        }
                                    }
                                }
                                $group_quiz_sum = (100 / (count($quiz_ids)) * $group_quiz_sum / 100);
                                $page_type_num++;
                                $page_type_sum = $page_type_sum + $group_quiz_sum;
                            }
                        }else{
                            break;
                        }
                    }
                    if($is_ass_exist == 0){
                        if($page_type_num != 0){
                            $page_type_sum = $page_type_sum / $page_type_num;
                        }else{
                            $page_type_sum = null;
                        }
                        $asses_data[$user['user_id']][$chapter->id][$i] = $page_type_sum;
                    }
                }
            }
        }
        $all_avg = null;
        $chapter_avg = null;
        $is_all_null_num = 0;
        $all_total = 0;
        foreach ($page_data['course_session'] as $session){
            $sum_mark_total = 0;
            $is_null_num = 0;
            for ($i = 1;$i < 7;$i++){
                $sum_mark_total = $sum_mark_total + $asses_data[$user_id][$session->id][$i];
                if(is_null($asses_data[$user_id][$session->id][$i])){
                    $is_null_num++;
                }
            }
            if($is_null_num != 6) $all_total = $all_total + round($sum_mark_total / (6 - $is_null_num), 2);
            else $is_all_null_num++;
        }
        if($is_all_null_num != (count($page_data['course_session']))) $all_avg = round($all_total / (count($page_data['course_session']) - $is_all_null_num), 2);
        if($course->exam_id == 0 && !is_null($up_ch_id)){
            $sum_mark_total = 0;
            $is_null_num = 0;
            for ($i = 1;$i < 7;$i++){
                $sum_mark_total = $sum_mark_total + $asses_data[$user_id][$up_ch_id][$i];
                if(is_null($asses_data[$user_id][$up_ch_id][$i])){
                    $is_null_num++;
                }
            }
            if($is_null_num != 6) $chapter_avg = round($sum_mark_total / (6 - $is_null_num), 2);
        }
        //////////////////////////////////////////////////////////////////////////////////////////////////
        if($course->exam_id != 0){
            if($all_avg < $data_course->pass_mark && !is_null($all_avg)){
                $last_history = $this->Course_model->getLastHistoryByUserID($course->course_id, $this->session->get_userdata() ['user_id']);
                if(count($last_history) == 0){
                    $last_history = $this->Course_model->getFirstChapter($course->course_id) [0];
                    $last_id = $last_history['id'];
                }else{
                    $ch_id = $last_history[0]['chapter_id'];
                    $last_id = $ch_id;
                }
                $num = $this->Course_model->getCourseExamCheckStatus($user_id, $course->id) [0]['num'];
                if($num != null && $num <= 0){
                    $dataget = array('course_id' => $course->course_id, 'user_id' => $user_id,);
                    $status = $this->Course_model->data_gets('course_status', $dataget);
                    if(count($status) == 0){
                        $dataset = array('course_id' => $course->course_id, 'user_id' => $user_id, 'end_date' => date("Y-m-d H:i:s"), 'status' => 3);
                        $this->Course_model->data_insert('course_status', $dataset);
                    }else{
                        $dataset = array('end_date' => date("Y-m-d H:i:s"), 'status' => 3);
                        $dataget = array('id' => $status[0]->id);
                        $this->Course_model->data_updates('course_status', $dataset, $dataget);
                    }
                    $status_msg = 'You have to wait to pass session!';
                }
                $res = array('check_num' => 0, 'msg' => $status_msg, 'last_id' => $last_id);
                $this->response($res);
            }else{
                $dataset = array('course_id' => $course->course_id, 'chapter_id' => $ch_id, 'user_id' => $user_id, 'reg_date' => date("Y-m-d H:i:s"));
                $this->Course_model->data_insert('course_history', $dataset);
                $res = array('check_num' => 1);
                $this->response($res);
            }
        }else{
            if($chapter_avg < $data_course->pass_mark && !is_null($chapter_avg)){
                $last_history = $this->Course_model->getLastHistoryByUserID($course->course_id, $this->session->get_userdata() ['user_id']);
                if(count($last_history) == 0){
                    $last_history = $this->Course_model->getFirstChapter($course->course_id) [0];
                    $last_id = $last_history['id'];
                }else{
                    $ch_id = $last_history[0]['chapter_id'];
                    $last_id = $ch_id;
                }
                $num = $this->Course_model->getCoursePageCheckStatus($user_id, $up_ch_id) [0]['num'];
                $status_msg = null;
                if($num <= 0){
                    $dataget = array('course_id' => $course->course_id, 'user_id' => $user_id,);
                    $status = $this->Course_model->data_gets('course_status', $dataget);
                    if(count($status) == 0){
                        $dataset = array('course_id' => $course->course_id, 'user_id' => $user_id, 'end_date' => date("Y-m-d H:i:s"), 'status' => 2);
                        $this->Course_model->data_insert('course_status', $dataset);
                    }else{
                        $dataset = array('end_date' => date("Y-m-d H:i:s"), 'status' => 2);
                        $dataget = array('id' => $status[0]->id);
                        $this->Course_model->data_updates('course_status', $dataset, $dataget);
                    }
                    $status_msg = 'You have to wait to pass session!';
                }
                $res = array('check_num' => 0, 'msg' => $status_msg, 'last_id' => $last_id);
                $this->response($res);
            }else{
                $dataset = array('course_id' => $course->course_id, 'chapter_id' => $ch_id, 'user_id' => $user_id, 'reg_date' => date("Y-m-d H:i:s"));
                $this->Course_model->data_insert('course_history', $dataset);
                $res = array('check_num' => 1);
                $this->response($res);
            }
        }
    }
	
	public function view_exam_certificate($course_id, $user_id){
        if($this->isLearner()){
            $exam_id = $this->Course_model->getExamId($course_id) [0]['exam_id'];
            $this->global['user_name'] = $this->session->get_userdata() ['user_name'];
            $company = $this->Certification_model->getCompanyByUserId($user_id);
            $learner = $this->Certification_model->getLearnerByUserId($user_id);
            $course = $this->Certification_model->getCourseById($course_id);
            $course_status = $this->Certification_model->getCourseStatusById($course_id, $user_id);
            $course_date = $course_status[0]['reg_date'] . "~" . $course_status[0]['end_date'];
            $exam_info = $this->Certification_model->getExamHistory($user_id, $exam_id);
            $exam_date = $exam_info[0]['exam_start_at'] . "~" . $exam_info[0]['exam_end_at'];
            $exam_history = $this->Exam_model->getExamHistory($user_id, $exam_id);
            $admin = $this->Certification_model->getCompanyAdmin($company[0]['id']);
            $params['COURSE_NUMBER'] = $course[0]['number'];
            $params['CERTIFICATE NUMBER'] = $course_id.$user_id;
            $params['CATEGORY'] = $course[0]['category'];
			$params['COMPANY NAME'] = $company[0]['name'];
            $params['PARTICIPANT NAME'] = $learner[0]['name'];
            $params['COURSE NAME'] = $course[0]['title'];
            $params['EXAM DATE'] = $exam_date;
            $params['EXAM TITLE'] = $exam_info[0]['title'];
            $params['EXAM SCORE'] = $exam_info[0]['mark'];
            $params['LOCATION'] = str_replace(',,',',',$course[0]['location']);
            $params['NUMBER'] = $course[0]['ceu'];
			$params['COURSE TYPE'] = $course[0]['certification'];
            $params['DATE'] = $course[0]['start_at'];
            $params['CERTIFICATION DATE'] = substr($exam_info[0]['exam_end_at'], 0, 10);
            $params['NAME'] = $params['user_name'];
            $params['SIGNATURE'] = "<img id=\"userSignImg\" style=\"width:70%;\" src=\"" . $admin[0]['sign'] . "\" />";
            $params['TITLE'] = $this->session->get_userdata() ['role'];
            $params['LOGO_COMPANY'] = "<img src=\"" . base_url() . "assets/img/logo.png\" alt=\"OLS\" height=\"80\" width=\"240\">";
            $params['LOGO_COURSE ACCERDITATION COMPANY'] = $params['score'];
            $this->global['certificate'] = $params;
            $this->loadViews("instructor/demand/reportCard", $this->global, NULL, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function viewCourseHistory(){
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '3');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        if($this->isLearner()){
            $this->loadViews("learner/demand/course_history", $this->global, NULL, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function getCourseHistory(){
        $table_data['data'] = $this->Course_model->getHistoryByUserID($this->session->get_userdata() ['user_id']);
        $table_data['recordsTotal'] = 0;
        $table_data['recordsFiltered'] = 0;
        foreach ($table_data['data'] as $key => $row){
            $table_data['data'][$key]["no"] = $key + 1;
            $table_data['recordsTotal'] = count($table_data['data']);
            $table_data['recordsFiltered'] = count($table_data['data']);
        }
        $this->response($table_data);
    }
    
    public function showPreviewQuestion($exam_id = 0){
        if($this->isLearner()){
            $this->global['show_button'] = TRUE;
            $this->global['exam_show_type'] = $this->Exam_model->getRow($exam_id) [0]['solution_flag'];
            $this->global['limit_time'] = $this->Exam_model->getRow($exam_id) [0]['limit_time'];
            if($this->input->post('id') != ''){
                $id = $this->input->post('id');
                $this->global['show_button'] = FALSE;
                $this->global['question'] = $this->Exam_model->getRowQuiz($id);
                $quiz_count = count($this->Exam_model->getQuizList($this->global['question']['exam_id']));
            } else if($this->input->get('next') != ''){
                $next = $this->input->get('next');
                $this->global['question'] = $this->Exam_model->getRowQuizByPos($exam_id, $next);
                $quiz_count = count($this->Exam_model->getQuizList($this->global['question']['exam_id']));
            }else{
                $this->Exam_model->insertExamHistory(array("user_id" => $this->session->get_userdata() ['user_id'], "exam_id" => $exam_id));
                $this->global['question'] = $this->Exam_model->getQuizList($exam_id) [0];
                $quiz_count = count($this->Exam_model->getQuizList($exam_id));
                if($quiz_count == 0 || $exam_id == 0){
                    print_r("No exists questions.");
                    return;
                }
            }
            $this->global['exam_start_at'] = $this->Exam_model->getExamHIstory($this->session->get_userdata() ['user_id'], $exam_id) ['exam_start_at'];
            $this->global['question']['content'] = json_decode($this->global['question']['content'], true);
            $this->global['id'] = $this->global['question']['position'];
            $this->global['next'] = $this->global['id'] + 1;
            $this->global['end'] = $quiz_count - 1;
            $this->loadViews('learner/exam/showPreviewQuestion', $this->global, NULL, NULL);
        }else{
            $this->response($table_data);
        }
    }
    
    function reportCard($exam_id = 0){
        if($this->isLearner()){
            $user_id = $this->session->get_userdata() ['user_id'];
            $this->global['user_name'] = $this->session->get_userdata() ['user_name'];
            $this->global['questions'] = $this->Exam_model->getQuizList($exam_id);
            $this->global['answers'] = $this->Exam_model->getQuizHistoryByUser($exam_id, $user_id);
            $this->global['correct_count'] = 0;
            $this->global['wrong_count'] = 0;
            $this->global['exam_id'] = $exam_id;
            for ($i = 0;$i < count($this->global['answers']);$i++){
                if($this->global['answers'][$i]['mark1'] == "100"){
                    $this->global['correct_count']++;
                }else{
                    $this->global['wrong_count']++;
                }
            }
            $this->global['score'] = round($this->global['correct_count'] * 100 / count($this->global['answers']), 2);
            $this->global['pass_grade'] = $this->Exam_model->getRow($exam_id) [0]['min_percent'];
            $this->global['exam_type'] = $this->Exam_model->getRow($exam_id) [0]['type'];
            if($this->global['pass_grade'] <= $this->global['score']){
                $this->global['result'] = "Pass";
            }else{
                $this->global['result'] = "Fail";
            }
            $this->Exam_model->updateExamHistory(array("exam_end_at" => date("Y-m-d H:i:s"), "mark" => $this->global['score'], "exam_status" => $this->global['result']), $exam_id, $user_id);
            $exam_history = $this->Exam_model->getExamHistory($user_id, $exam_id);
            $this->global['time_taken'] = "";
            $time_taken_seconds = strtotime($exam_history['exam_end_at']) - strtotime($exam_history['exam_start_at']);
            if(floor($time_taken_seconds / 3600) > 0){
                $this->global['time_taken'].= (floor($time_taken_seconds / 3600)) . " hours ";
            }
            if(floor(($time_taken_seconds % 3600) / 60) > 0){
                $this->global['time_taken'].= (floor(($time_taken_seconds % 3600) / 60)) . " minutes ";
            }
            if(($time_taken_seconds % 3600 % 60) > 0){
                $this->global['time_taken'].= ($time_taken_seconds % 3600 % 60) . " seconds ";
            }
            $user_id = $this->session->get_userdata() ['user_id'];
            $course_id = $this->Certification_model->getCourseByExamId($exam_id) [0];
            $company = $this->Certification_model->getCompanyByUserId($user_id);
            $learner = $this->Certification_model->getLearnerByUserId($user_id);
            $course = $this->Certification_model->getCourseById($course_id);
            $course_status = $this->Certification_model->getCourseStatusById($course_id, $user_id);
            $course_date = $course_status[0]['reg_date'] . "~" . $course_status[0]['end_date'];
            $exam_info = $this->Certification_model->getExamHistory($user_id, $exam_id);
            $exam_date = $exam_info[0]['exam_start_at'] . "~" . $exam_info[0]['exam_end_at'];
            $admin = $this->Certification_model->getCompanyAdmin($company[0]['id']);
            $params['COMPANY NAME'] = $company[0]['name'];
            $params['PARTICIPANT NAME'] = $learner[0]['name'];
            $params['COURSE NAME'] = $course[0]['title'];
            $params['EXAM DATE'] = $exam_date;
            $params['EXAM TITLE'] = $exam_info[0]['title'];
            $params['EXAM SCORE'] = $exam_info[0]['mark'];
            $params['LOCATION'] = $course[0]['location'];
            $params['NUMBER'] = $course[0]['number'];
            $params['DATE'] = $course[0]['start_at'];
            $params['CERTIFICATION DATE'] = substr($exam_info[0]['exam_end_at'], 0, 10);
            $params['NAME'] = $params['user_name'];
            $params['SIGNATURE'] = "<img id=\"userSignImg\" style=\"width:100%;\" src=\"" . $admin[0]['sign'] . "\" />";
            $params['TITLE'] = $this->session->get_userdata() ['role'];
            $params['LOGO_COMPANY'] = "<img src=\"" . base_url() . "assets/img/logo.png\" alt=\"OLS\" height=\"80\" width=\"240\">";
            $params['LOGO_COURSE ACCERDITATION COMPANY'] = $params['score'];
            $this->global['certificate'] = $params;
            $this->loadViews("learner/exam/reportCard", $this->global, NULL, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function print_exam_certificate(){
        $param = $_POST;
        $html = $param['content'];
        $upload_path = "c:/tmpfile/";
        if(!file_exists($upload_path)){
            $this->makeDirectory($upload_path);
        }
        $upload_pdf_path = $upload_path . time() . ".pdf";
        $temp_name = time() . ".html";
        file_put_contents($upload_path . $temp_name, $html);
        $command = 'wkhtmltopdf ' . $upload_path . $temp_name . ' "' . $upload_pdf_path . '"';
        //$command = 'wkhtmltopdf '.base_url().'assets/uploads/'.$temp_name.' "'.getcwd().'/'.$insert_data['file_path'].'"';
        if(strtolower(substr(PHP_OS, 0, 3)) == "win") chdir('C:\Program Files\wkhtmltopdf\bin');
        else $command = '/usr/local/bin/' . $command;
        shell_exec($command);
        //unlink(PATH_UPLOAD.$temp_name);
        $this->load->helper('download');
        $data = file_get_contents($upload_pdf_path);
        $name = time() . ".pdf";
        force_download($name, $data);
        $data['failed_count'] = 0;
        $data['url'] = base_url() . "admin/library";
        $this->response($data);
    }
    
    function saveUserAnswers(){
        $user_id = $this->session->get_userdata() ['user_id'];
        $ansArry = array();
        $post = $this->input->post('formData');
        parse_str($post, $ansArry);
        $submit = (int)$this->input->post('submit');
        $question = $this->Exam_model->getRowQuiz($ansArry['current_q_id']);
        $question['content'] = json_decode($question['content'], true);
        $userAns = $ansArry;
        $ans = '';
        $mark = 0;
        switch ($question['type']){
            case 'multi-choice':
                $correctCheck = $question['content']['correctCheck'];
                $checkbox = $question['content']['checkbox'];
                if(isset($checkbox[$correctCheck[0]])){
                    $ans = $checkbox[$correctCheck[0]];
                }else{
                    $ans = "N/A";
                }
                if(isset($userAns['multichoice'])) if($ans == $userAns['multichoice']){
                    $mark = 100;
                }else{
                    $mark = 0;
                }
                $checkData = array('correctCheck' => $question['content']['correctCheck'], 'checkbox' => $question['content']['checkbox'], 'userAns' => $userAns);
                $this->load->view("admin/exam/reportcard/multichoice", $checkData);
                break;
            case 'checkbox':
                $correctCheck = $question['content']['correctCheck'];
                $checkbox = $question['content']['checkbox'];
                $correctAns = array();
                if(is_array($correctCheck)){
                    for ($j = 0;$j < count($correctCheck);$j++){
                        $correctAns[] = $checkbox[$correctCheck[$j]];
                    }
                }
                if(!empty($userAns['checkbox']) && $userAns['checkbox'] === $correctAns){
                    $mark = 100;
                }else{
                    $mark = 0;
                }
                $checkData = array('correctCheck' => $question['content']['correctCheck'], 'checkbox' => $question['content']['checkbox'], 'userAns' => $userAns);
                $this->load->view("admin/exam/reportcard/checkbox", $checkData);
                break;
            case 'true-false':
                $tftext = $question['content']['tf'];
                $settrue = $question['content']['settrue'];
                if(isset($tftext[$settrue])){
                    if($userAns['true_false'][0] == $tftext[$settrue]){
                        $mark = 100;
                    }else{
                        $mark = 0;
                    }
                }
                $checkData = array('tftext' => $question['content']['tf'], 'settrue' => $question['content']['settrue'], 'userAns' => $userAns);
                $this->load->view("admin/exam/reportcard/true_false", $checkData);
                break;
            case 'fill-blank':
                $blank = $question['content']['blank'];
                $temp_count = 0;
                $part_count = 0;
                for ($i = 0;$i < count($blank);$i++){
                    $correct_answer = explode(";", $blank[$i]);
                    for ($j = 0;$j < count($correct_answer);$j++){
                        if($correct_answer[$j] == $userAns['blank'][$i]){
                            $part_count++;
                        }
                    }
                    if($part_count < 1){
                        $temp_count++;
                    }
                }
                if($temp_count <= 0){
                    $mark = 100;
                }else{
                    $mark = 0;
                }
                $checkData = array('blank' => $question['content']['blank'], 'userAns' => $userAns);
                $this->load->view("admin/exam/reportcard/fill_blank", $checkData);
                break;
            case 'essay':
                break;
            case 'matching':
                $content = $question['content']['choice'];
                $match = $question['content']['match'];
                if($userAns['matching'] === $match){
                    $mark = 100;
                }else{
                    $mark = 0;
                }
                $checkData = array('content' => $question['content']['choice'], 'match' => $question['content']['match'], 'userAns' => $userAns);
                $this->load->view("admin/exam/reportcard/matching", $checkData);
                break;
            }
            if(count($this->Exam_model->getUserAnswer($user_id, $ansArry['current_q_id'])) == 0){
                $this->Exam_model->insertUserAnswer(array("user_id" => $user_id, "quiz_id" => $ansArry['current_q_id'], "description" => json_encode($ansArry), "mark1" => $mark));
            }else{
                $this->Exam_model->updateUserAnswer($user_id, $ansArry['current_q_id'], json_encode($ansArry), $mark);
            }
    }
    public function view_row_assess($course_id = 0, $user_id = 0){
        if($this->isLearner()){
            $results = $this->Course_model->getAssessByCourseID($course_id);
            $page_data['assess'] = $results;
            $dataget = array('id' => $course_id);
            $page_data['pass_mark'] = $this->Course_model->data_gets('course', $dataget) [0]->pass_mark;
            $dataget = array('course_id' => $course_id, 'parent' => 0, 'exam_id' => 0, 'quiz_id !=' => 0);
            $page_data['session_quiz'] = $this->Course_model->getQuizPageByCourseId($course_id);
            $dataget = array('course_id' => $course_id, 'parent' => 0, 'exam_id' => 0);
            $page_data['course_session'] = $this->Course_model->data_gets('chapter', $dataget, '', 'position', 'asc');
            $page_data['course_pay_user'] = $this->Course_model->get_pay_data($course_id, $user_id);
            if(empty($page_data['course_pay_user'])){
                $page_data['course_pay_user'] = $this->Course_model->get_unpay_data($course_id, $user_id);
            }
            $page_data['quiz_history'] = $this->Exam_model->get_quiz_history($course_id);
            $asses_data = array();
            $user['user_id'] = $user_id;
            foreach ($page_data['course_session'] as $chapter){
                for ($i = 1;$i < 7;$i++){
                    $is_ass_exist = 0;
                    $page_type_sum = 0;
                    $page_type_num = 0;
                    foreach($page_data['session_quiz'] as $quiz){
                        foreach ($page_data['assess'] as $asses){
                            if($i == $asses['page_type'] && $chapter->id == $asses['chapter_id'] && $asses['user_id'] == $user['user_id']){
                                $asses_data[$user['user_id']][$chapter->id][$i] = $asses['assessment'];
                                $is_ass_exist = 1;
                                break;
                            }
                        }
                        if($is_ass_exist == 0){
                            if($quiz['relative_type'] == $i && $quiz['parent'] == $chapter->id && $i != 6){
                                $group_quiz_sum = 0;
                                $quiz_ids = json_decode($quiz['quiz_ids']);
                                for ($j = 0;$j < count($quiz_ids);$j++){
                                    foreach ($page_data['quiz_history'] as $q_h){
                                        if($q_h['chapter_id'] == $quiz['id'] && $q_h['user_id'] == $user['user_id'] && $q_h['quiz_id'] == $quiz_ids[$j]){
                                            $group_quiz_sum = $group_quiz_sum + $q_h['mark1'];
                                        }
                                    }
                                }
                                // $group_quiz_sum = (100 / (count($quiz_ids)) * $group_quiz_sum / 100);
                                $group_quiz_sum = $group_quiz_sum / (count($quiz_ids) * 100)*100;
                                $page_type_num++;
                                $page_type_sum = $page_type_sum + $group_quiz_sum;
                            }else if(is_null($quiz['relative_type']) && $quiz['parent'] == $chapter->id && $i == 6){
                                $group_quiz_sum = 0;
                                $quiz_ids = json_decode($quiz['quiz_ids']);
                                for ($j = 0;$j < count($quiz_ids);$j++){
                                    foreach ($page_data['quiz_history'] as $q_h){
                                        if($q_h['chapter_id'] == $quiz['id'] && $q_h['user_id'] == $user['user_id'] && $q_h['quiz_id'] == $quiz_ids[$j]){
                                            $group_quiz_sum = $group_quiz_sum + $q_h['mark1'];
                                        }
                                    }
                                }
                                // $group_quiz_sum = (100 / (count($quiz_ids)) * $group_quiz_sum / 100);
                                $group_quiz_sum = $group_quiz_sum / (count($quiz_ids) * 100)*100;
                                $page_type_num++;
                                $page_type_sum = $page_type_sum + $group_quiz_sum;
                            }
                        }else{
                            break;
                        }
                    }
                    if($is_ass_exist == 0){
                        if($page_type_num != 0){
                            $page_type_sum = $page_type_sum / $page_type_num;
                        }else{
                            $page_type_sum = null;
                        }
                        $asses_data[$user['user_id']][$chapter->id][$i] = $page_type_sum;
                    }
                }
            }
            $page_data['asses_data'] = $asses_data;	
            $user = $this->session->userdata();
            $this->global['user_data'] = $user;
            $this->loadViews("learner/demand/view_assess", $this->global, $page_data, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL , NULL); 
        }
    }
    function preview_exam($history_id = 0){
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '2');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        if($this->isLearner()){
            $user_id = $this->session->get_userdata() ['user_id'];
            $exam_id = $this->Exam_model->getExamByHistory($history_id) ['id'];
            $this->global['questions'] = $this->Exam_model->getQuizList($exam_id);
            $this->global['answers'] = $this->Exam_model->getQuizHistoryByUser($exam_id, $user_id);
            $this->global['exam_id'] = $exam_id;
            $exam_history = $this->Exam_model->getExamHistory($user_id, $exam_id);
            $this->loadViews("learner/exam/preview", $this->global, NULL, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    function getTime(){
        echo strtotime(date("Y-m-d H:i:s"));
    }
}
?>