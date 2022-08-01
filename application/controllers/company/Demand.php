<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


require APPPATH . '/libraries/BaseController.php';
class Demand  extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
		$this->load->model('Enrollments_model');				
        $this->load->model('User_model');
        $this->load->model('Settings_model');
        $this->load->model('Translate_model');
        $this->load->model('Course_model');
        $this->load->model('Exam_model');
        $this->load->model('Category_model');
        $this->load->model('Certification_model');
        $this->load->helper(array('cookie', 'string', 'language', 'url'));
        $this->load->helper('lms_email');
		$this->load->model('Company_model');
		$this->load->helper('common');
        $this->load->model('Coursesession_model','session_model');
    }

    public function index()
    {
        $this->showAll();
    }

    public function showCourse(){
        $search =  $this->input->get('sSearch');
        $displayLength = 3;
        $start = 0;
        $filter['start'] = $start;
        $filter['limit'] = $displayLength;
        $filter['search'] = $search;
        $filter['create_id'] = 1;
        $params['courses'] = $this->Course_model->all($filter);
        unset($filter['start']);
        unset($filter['limit']);
        $params['iTotalRecords'] = $this->Course_model->count($filter);
        $params['sEcho'] = $search;

        $this->load->library('pagination');
        $config['base_url'] = site_url($this->company['company_url'].'/demand/?sSearch='.$search);
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $params['iTotalRecords'];
        $config['per_page'] = $displayLength;
        $config['num_links'] = 2;
        $config['uri_segment'] = 3;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&rarr;';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&larr;';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $params['category'] = $this->Category_model->getListByCompanyID($this->session->userdata('company_id'));
        $params['links'] = $this->pagination->create_links();
            /*end*/
        $this->loadViews_front('company_page/on-demand', $params);
    }

    public function showCourseByCategory($category_id = 0){
        if($category_id == 0) {
            $this->showAll();
        }else{
            $params['menu_name'] = 'catalog';
            $params["term"] = $this->term;
            $params['company'] = $this->company;

            /*pagenation*/
            if($this->session->userdata ( 'isLoggedIn' ) != NULL ){
                $filter['user_id'] = $this->session->userdata('user_id');
            }

            $displayLength = 3;
            $search = $this->input->get('sSearch');
            $start = $this->input->get('per_page');
            if (!isset($start)) {
                $start = 0;
            }
            $filter['start'] = $start;
            $filter['limit'] = $displayLength;
            $filter['search'] = $search;
            $filter['course_type'] = 2;
            $filter['create_id'] = $this->session->userdata('company_id');
            $filter['category_id'] = $category_id;
            $params['courses'] = $this->Course_model->all($filter);
            unset($filter['start']);
            unset($filter['limit']);
            $params['iTotalRecords'] = $this->Course_model->count($filter);
            $params['sEcho'] = $search;

            $this->load->library('pagination');
            $config['base_url'] = site_url($this->company['company_url'].'/demand/?sSearch='.$search);
            $config['page_query_string'] = TRUE;
            $config['total_rows'] = $params['iTotalRecords'];
            $config['per_page'] = $displayLength;
            $config['num_links'] = 2;
            $config['uri_segment'] = 3;
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = '&laquo;';
            $config['first_tag_open'] = '<li class="page-item">';
            $config['first_tag_close'] = '</li>';
            $config['last_link'] = '&raquo;';
            $config['last_tag_open'] = '<li class="page-item">';
            $config['last_tag_close'] = '</li>';
            $config['next_link'] = '&rarr;';
            $config['next_tag_open'] = '<li class="page-item">';
            $config['next_tag_close'] = '</li>';
            $config['prev_link'] = '&larr;';
            $config['prev_tag_open'] = '<li class="page-item">';
            $config['prev_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li class="page-item">';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $params['category'] = $this->Category_model->getListByCompanyID($this->session->userdata('company_id'));
            $params['links'] = $this->pagination->create_links();
            $params['category_id'] = $category_id;
            /*end*/
            $this->loadViews_front('company_page/on-demand', $params);
        }

    }

    public function showAll(){
        $params['menu_name'] = 'catalog';
        $params["term"] = $this->term;
        $params['company'] = $this->company;

        $standard_id = $this->input->get('standard');
        if($standard_id != null && $standard_id != 0){
            $filter['standard_id'] = $standard_id;
        }

        $course_title = $this->input->get('title');
        if($course_title){
            $filter['course_title'] = $course_title;
        }

        /*pagenation*/
        if($this->session->userdata ( 'isLoggedIn' ) != NULL ){
            $filter['user_id'] = $this->session->userdata('user_id');
        }

        $displayLength = 3;
        $search = $this->input->get('sSearch');
        $start = $this->input->get('per_page');
        if (!isset($start)) {
            $start = 0;
        }
        $filter['start'] = $start;
        $filter['course_type'] = 2;
        $filter['limit'] = $displayLength;
        $filter['search'] = $search;
        //$filter['create_id'] = $this->session->userdata('company_id');
        if($this->session->userdata ( 'isLoggedIn' ) != NULL ){
            $filter['create_id'] = $this->session->userdata('company_id');
        }else{
            $filter['create_id'] = $this->company['id'];
        }
        //$filter['course_type'] = 2;
        $params['courses'] = $this->Course_model->all($filter);
        unset($filter['start']);
        unset($filter['limit']);
        $params['iTotalRecords'] = $this->Course_model->count($filter);
        $params['sEcho'] = $search;

        $this->load->library('pagination');
        $config['base_url'] = site_url($this->company['company_url'].'/demand/?sSearch='.$search);
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $params['iTotalRecords'];
        $config['per_page'] = $displayLength;
        $config['num_links'] = 2;
        $config['uri_segment'] = 3;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&rarr;';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&larr;';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $params['standard_id'] = $standard_id;
        $params['course_title'] = $course_title;
        $params['category'] = $this->Category_model->getListByCompanyID($this->session->userdata('company_id'));
        $params['links'] = $this->pagination->create_links();
        $params['standard'] = $this->db->get_where('category_standard')->result();
        // echo "<pre>";
        //     print_r($params['standard']);
        // exit;
        /*end*/
        $this->loadViews_front('company_page/on-demand', $params);
    }

    public function view($url = NULL, $id = NULL){
        $params['menu_name'] = 'catalog';
        $params["term"] = $this->term;
        $params['company'] = $this->company;
        $course = $this->Course_model->select($id);
		$totalCourseEnrollments = $this->Enrollments_model->totalCourseEnrollments($id,0);
		$course->enroll_course_count_user = $totalCourseEnrollments;
        $params['course'] = $course;

        $user_id = $this->session->get_userdata()['user_id'];
        $dataget = array(
            'id' => $id,
            'create_id' => $this->session->get_userdata()['company_id']
        );
        $data_course= $this->Course_model->data_gets('course', $dataget)[0];

        $results = $this->Course_model->getAssessByCourseID($id);

        $page_data['assess'] = $results;

        $page_data['session_quiz'] = $this->Course_model->getQuizPageByCourseId($id);

        $dataget = array(
            'course_id' => $id,
            'parent'=>0,
            'exam_id'=>0
        );
        $page_data['course_session'] = $this->Course_model->data_gets('chapter', $dataget, '', 'position', 'asc');

        $page_data['course_pay_user'] = $this->Course_model->get_pay_user($id);

        $page_data['quiz_history'] = $this->Exam_model->get_quiz_history($id);

        $asses_data = array();

        foreach ($page_data['course_pay_user'] as $user)
        {
            foreach ($page_data['course_session'] as $chapter){
                for ($i = 1; $i < 7; $i++){
                    $is_ass_exist = 0;

                    $page_type_sum = 0;
                    $page_type_num = 0;
                    foreach ($page_data['session_quiz'] as $quiz){

                        foreach ($page_data['assess'] as $asses) {
                            if ($i == $asses['page_type'] && $chapter->id == $asses['course_id'] && $asses['user_id'] == $user['user_id']) {
                                $asses_data[$user['user_id']][$chapter->id][$i] = $asses['assessment'];
                                $is_ass_exist = 1;
                                break;
                            }
                        }
                        if($is_ass_exist == 0)
                        {
                            if($quiz['relative_type'] == $i && $quiz['parent'] == $chapter->id && $i != 6){
                                $group_quiz_sum = 0;
                                $quiz_ids = json_decode($quiz['quiz_ids']);
                                for ($j = 0; $j < count($quiz_ids); $j++){
                                    foreach ($page_data['quiz_history'] as $q_h){

                                        if($q_h['chapter_id'] == $quiz['id'] && $q_h['user_id'] == $user['user_id']
                                            && $q_h['quiz_id'] == $quiz_ids[$j])
                                        {
                                            $group_quiz_sum = $group_quiz_sum+$q_h['mark1'];
                                        }
                                    }
                                }


                                $group_quiz_sum = (100 / (count($quiz_ids))*$group_quiz_sum/100);
                                $page_type_num++;
                                $page_type_sum = $page_type_sum + $group_quiz_sum;
                            }else if(is_null($quiz['relative_type']) && $quiz['parent'] == $chapter->id && $i == 6)
                            {
                                $group_quiz_sum = 0;
                                $quiz_ids = json_decode($quiz['quiz_ids']);
                                for ($j = 0; $j < count($quiz_ids); $j++){
                                    foreach ($page_data['quiz_history'] as $q_h){

                                        if($q_h['chapter_id'] == $quiz['id'] && $q_h['user_id'] == $user['user_id']
                                            && $q_h['quiz_id'] == $quiz_ids[$j])
                                        {
                                            $group_quiz_sum = $group_quiz_sum+$q_h['mark1'];
                                        }
                                    }
                                }


                                $group_quiz_sum = (100 / (count($quiz_ids))*$group_quiz_sum/100);
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
        foreach ($page_data['course_session'] as $session) {
            $sum_mark_total = 0;
            $is_null_num = 0;

            for ($i = 1; $i < 7; $i++) {
                $sum_mark_total = $sum_mark_total + $asses_data[$user_id][$session->id][$i];
                if (is_null($asses_data[$user_id][$session->id][$i])) {
                    $is_null_num++;
                }
            }
            if ($is_null_num != 6)
                $all_total = $all_total + round($sum_mark_total / (6 - $is_null_num), 2);
            else
                $is_all_null_num++;
        }
        if($is_all_null_num != (count($page_data['course_session'])))
            $all_avg = round($all_total/(count($page_data['course_session'])-$is_all_null_num), 2);


        $exam_data = $this->Course_model->get_exam_data_courseid($id);
        if(count($exam_data) == 0 && $all_avg > $data_course->pass_mark){
            $dataget = array(
                'course_id' => $id,
                'user_id' => $user_id,
            );

            $status = $this->Course_model->data_gets('course_status', $dataget);
            if(count($status) == 0){
                $dataset = array(
                    'course_id' => $id,
                    'user_id' => $user_id,
                    'end_date' => date("Y-m-d H:i:s"),
                    'status' => 4
                );
                $this->Course_model->data_insert('course_status', $dataset);
            }else{
                $dataset = array(
                    'end_date' => date("Y-m-d H:i:s"),
                    'status' => 4
                );
                $dataget = array(
                    'id' => $status[0]->id
                );
                $this->Course_model->data_updates('course_status', $dataset, $dataget);
            }
        }
        $this->loadViews_front('company_page/view-course', $params);
    }

    public function detail($url = NULL, $id = NULL){		

        $params['menu_name'] = 'catalog';
        if ($this->session->userdata('isLoggedIn') == NULL) {
            redirect('welcome');
        }

        $user_type = $this->session->userdata('user_type');

        if($user_type == 'Learner') { 
			
            $course = $this->Course_model->select($id);
            $params['course_self_time'] = $course->course_self_time;
           
            $params["term"] = $this->term;
            $params['company'] = $this->company;
            $params['libraries'] = $this->Course_model->getLibrary($id);

            $last_history = $this->Course_model->getLastHistoryByUserID($id, $this->session->get_userdata()['user_id']);
            if (count($last_history) == 0) {
                $last_history = $this->Course_model->getFirstChapter($id)[0];
                $params['last_history_ch_id'] = $last_history['id'];
            } else {
                $ch_id = $last_history[0]['chapter_id'];
                $params['last_history_ch_id'] = $ch_id;
            }

            foreach ($params['libraries'] as $key => $chapter) {
                $res = $this->checkAssessment_Chapter($chapter->id);
                $r = $params['libraries'][$key];
                $params['libraries'][$key]->assess = $res['check_num'];
            }
            //Last history insert
            $dataset = array(
                'course_id' => $id,
                'chapter_id' => $params['last_history_ch_id'],
                'user_id' => $this->session->get_userdata()['user_id'],
                'reg_date' => date("Y-m-d H:i:s")
            );
            $this->Course_model->data_insert('course_history', $dataset);

            $params['course_id'] = $id;
            $this->session->set_userdata(array('using_course_id' => $id));
            $params['course_name'] = $course->title;
            $params['user_id'] = $this->session->get_userdata()['user_id'];
			
			$timesids = 0;
			if(isset($_REQUEST['type']) && $_REQUEST['type'] == 'ilt' && $_REQUEST['time_id'] > 0){
				$timesids = $_REQUEST['time_id'];
			}
			
            $this->loadViews_front('company_page/details-courses', $params);
        }
        else{
            $course = $this->Course_model->select($id);

            $params["term"] = $this->term;
            $params['company'] = $this->company;
            $params['libraries'] = $this->Course_model->getLibrary($id);

            $last_history = $this->Course_model->getFirstChapter($id)[0];
            $params['last_history_ch_id'] = $last_history['id'];

            foreach ($params['libraries'] as $key => $chapter) {

                $params['libraries'][$key]->assess = 100;
            }
            //Last history insert

            $params['course_id'] = $id;
            $this->session->set_userdata(array('using_course_id' => $id));
            $params['course_name'] = $course->title;
			
            $this->loadViews_front('company_page/details-courses', $params);
        }
    }
    public function setSelfPace(){
        $filter = $this->input->post();
        $course_session = (array)$this->session_model->one($filter);
        if($course_session){
            $course_session['course_time'] = $course_session['course_time'] + 5;
            $this->session_model->save($course_session);
        }else{
            $data['user_id'] = $filter['user_id'];
            $data['course_id'] = $filter['course_id'];
            $data['course_time'] = 0;
            $this->session_model->save($data);
        }
    }
    public function checkAssessment_Chapter($ch_id = 0){

        $user_id = $this->session->get_userdata()['user_id'];

        $up_ch_id = null;
        $dataget = array(
            'id' => $ch_id
        );
        $course = $this->Course_model->data_gets('chapter', $dataget, '', 'position', 'asc')[0];

        if($course->exam_id == 0){

            if($course->parent != 0){
                $dataget = array(
                    'id' => $course->parent
                );
                $parent = $this->Course_model->data_gets('chapter', $dataget, '', 'position', 'asc')[0];
                $dataget = array(
                    'position <' => $parent->position,
                    'course_id' => $parent->course_id,
                    'parent' =>0,
                    'exam_id' =>0
                );
            }else{
                $dataget = array(
                    'position <' => $course->position,
                    'course_id' => $course->course_id,
                    'parent' =>0,
                    'exam_id' =>0
                );
            }



            $up_chapter = $this->Course_model->data_gets('chapter', $dataget, '', 'position', 'desc')[0];
            $up_ch_id = $up_chapter->id;

            if(is_null($up_ch_id)){
                $dataget = array(
                    'course_id' => $course->course_id,
                    'user_id' => $user_id,
                );

                $status = $this->Course_model->data_gets('course_status', $dataget);
                if(count($status) == 0){
                    $dataset = array(
                        'course_id' => $course->course_id,
                        'user_id' => $user_id,
                        'reg_date' => date("Y-m-d H:i:s"),
                        'status' => 1
                    );
                    $this->Course_model->data_insert('course_status', $dataset);
                }
            }
        }



        $dataget = array(
            'id' => $course->course_id
        );
        $course_data = $this->Course_model->data_gets('course', $dataget)[0];
        if($course_data->is_ass_end == 1 && $course->exam_id == 0){
            $dataset = array(
                'course_id' => $course->course_id,
                'chapter_id' => $ch_id,
                'user_id' => $user_id,
                'reg_date' => date("Y-m-d H:i:s")
            );
            $this->Course_model->data_insert('course_history', $dataset);
            $res = array('check_num'=>1);

            return $res;
        }
//////////////////////////////////////////////////////////////////////////////////
        $dataget = array(
            'id' => $course->course_id,
            'create_id' => $this->session->get_userdata()['company_id']
        );
        $data_course= $this->Course_model->data_gets('course', $dataget)[0];

        $results = $this->Course_model->getAssessByCourseID($course->course_id);

        $page_data['assess'] = $results;

        $page_data['session_quiz'] = $this->Course_model->getQuizPageByCourseId($course->course_id);

        $dataget = array(
            'course_id' => $course->course_id,
            'parent'=>0,
            'exam_id'=>0
        );
        $page_data['course_session'] = $this->Course_model->data_gets('chapter', $dataget, '', 'position', 'asc');

        $page_data['course_pay_user'] = $this->Course_model->get_pay_user($course->course_id);

        $page_data['quiz_history'] = $this->Exam_model->get_quiz_history($course->course_id);

        $asses_data = array();

        foreach ($page_data['course_pay_user'] as $user)
        {
            foreach ($page_data['course_session'] as $chapter){
                for ($i = 1; $i < 7; $i++){
                    $is_ass_exist = 0;

                    $page_type_sum = 0;
                    $page_type_num = 0;
                    foreach ($page_data['session_quiz'] as $quiz){

                        foreach ($page_data['assess'] as $asses) {
                            if ($i == $asses['page_type'] && $chapter->id == $asses['course_id'] && $asses['user_id'] == $user['user_id']) {
                                $asses_data[$user['user_id']][$chapter->id][$i] = $asses['assessment'];
                                $is_ass_exist = 1;
                                break;
                            }
                        }
                        if($is_ass_exist == 0)
                        {
                            if($quiz['relative_type'] == $i && $quiz['parent'] == $chapter->id && $i != 6){
                                $group_quiz_sum = 0;
                                $quiz_ids = json_decode($quiz['quiz_ids']);
                                for ($j = 0; $j < count($quiz_ids); $j++){
                                    foreach ($page_data['quiz_history'] as $q_h){

                                        if($q_h['chapter_id'] == $quiz['id'] && $q_h['user_id'] == $user['user_id']
                                            && $q_h['quiz_id'] == $quiz_ids[$j])
                                        {
                                            $group_quiz_sum = $group_quiz_sum+$q_h['mark1'];
                                        }
                                    }
                                }


                                $group_quiz_sum = (100 / (count($quiz_ids))*$group_quiz_sum/100);
                                $page_type_num++;
                                $page_type_sum = $page_type_sum + $group_quiz_sum;
                            }else if(is_null($quiz['relative_type']) && $quiz['parent'] == $chapter->id && $i == 6)
                            {
                                $group_quiz_sum = 0;
                                $quiz_ids = json_decode($quiz['quiz_ids']);
                                for ($j = 0; $j < count($quiz_ids); $j++){
                                    foreach ($page_data['quiz_history'] as $q_h){

                                        if($q_h['chapter_id'] == $quiz['id'] && $q_h['user_id'] == $user['user_id']
                                            && $q_h['quiz_id'] == $quiz_ids[$j])
                                        {
                                            $group_quiz_sum = $group_quiz_sum+$q_h['mark1'];
                                        }
                                    }
                                }


                                $group_quiz_sum = (100 / (count($quiz_ids))*$group_quiz_sum/100);
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
        foreach ($page_data['course_session'] as $session) {
            $sum_mark_total = 0;
            $is_null_num = 0;

            for ($i = 1; $i < 7; $i++) {
                $sum_mark_total = $sum_mark_total + $asses_data[$user_id][$session->id][$i];
                if (is_null($asses_data[$user_id][$session->id][$i])) {
                    $is_null_num++;
                }
            }
            if ($is_null_num != 6)
                $all_total = $all_total + round($sum_mark_total / (6 - $is_null_num), 2);
            else
                $is_all_null_num++;
        }
        if($is_all_null_num != (count($page_data['course_session'])))
            $all_avg = round($all_total/(count($page_data['course_session'])-$is_all_null_num), 2);


        if($course->exam_id == 0 && !is_null($up_ch_id)){
            $sum_mark_total = 0;
            $is_null_num = 0;
            for($i = 1; $i<7; $i++)
            {
                $sum_mark_total = $sum_mark_total+$asses_data[$user_id][$up_ch_id][$i];
                if(is_null($asses_data[$user_id][$up_ch_id][$i]))
                {
                    $is_null_num++;
                }
            }
            if($is_null_num != 6)
                $chapter_avg = round($sum_mark_total/(6-$is_null_num), 2);
        }

//////////////////////////////////////////////////////////////////////////////////////////////////


        if($course->exam_id != 0){

            if($all_avg < $data_course->pass_mark && !is_null($all_avg))
            {
                $last_history = $this->Course_model->getLastHistoryByUserID($course->course_id, $this->session->get_userdata()['user_id']);
                if(count($last_history) == 0){
                    $last_history = $this->Course_model->getFirstChapter($course->course_id)[0];
                    $last_id =$last_history['id'];
                }else{
                    $ch_id =$last_history[0]['chapter_id'];
                    $last_id = $ch_id;
                }

                $num = $this->Course_model->getCourseExamCheckStatus($user_id,$course->id)[0]['num'];
                if(!is_null($num) && $num <= 0){
                    $dataget = array(
                        'course_id' => $course->course_id,
                        'user_id' => $user_id,
                    );

                    $status = $this->Course_model->data_gets('course_status', $dataget);
                    if(count($status) == 0){
                        $dataset = array(
                            'course_id' => $course->course_id,
                            'user_id' => $user_id,
                            'end_date' => date("Y-m-d H:i:s"),
                            'status' => 3
                        );
                        $this->Course_model->data_insert('course_status', $dataset);
                    }else{
                        $dataset = array(
                            'end_date' => date("Y-m-d H:i:s"),
                            'status' => 3
                        );
                        $dataget = array(
                            'id' => $status[0]->id
                        );
                        $this->Course_model->data_updates('course_status', $dataset, $dataget);
                    }
                    $status_msg = 'exam';
                }

                $res = array('check_num'=>0, 'msg'=>$status_msg, 'last_id'=>$last_id);
                return $res;
            }
            else{
                $dataset = array(
                    'course_id' => $course->course_id,
                    'chapter_id' => $ch_id,
                    'user_id' => $user_id,
                    'reg_date' => date("Y-m-d H:i:s")
                );
                $this->Course_model->data_insert('course_history', $dataset);
                $res = array('check_num'=>1);
                return $res;
            }
        }
        else {

            if($chapter_avg < $data_course->pass_mark && !is_null($chapter_avg)){
                $last_history = $this->Course_model->getLastHistoryByUserID($course->course_id, $this->session->get_userdata()['user_id']);
                if(count($last_history) == 0){
                    $last_history = $this->Course_model->getFirstChapter($course->course_id)[0];
                    $last_id =$last_history['id'];
                }else{
                    $ch_id =$last_history[0]['chapter_id'];
                    $last_id = $ch_id;
                }

                $num = $this->Course_model->getCoursePageCheckStatus($user_id, $up_ch_id)[0]['num'];
                $status_msg = null;
                if($num <= 0){
                    $dataget = array(
                        'course_id' => $course->course_id,
                        'user_id' => $user_id,
                    );

                    $status = $this->Course_model->data_gets('course_status', $dataget);
                    if(count($status) == 0){
                        $dataset = array(
                            'course_id' => $course->course_id,
                            'user_id' => $user_id,
                            'end_date' => date("Y-m-d H:i:s"),
                            'status' => 2
                        );
                        $this->Course_model->data_insert('course_status', $dataset);
                    }else{
                        $dataset = array(
                            'end_date' => date("Y-m-d H:i:s"),
                            'status' => 2
                        );
                        $dataget = array(
                            'id' => $status[0]->id
                        );
                        $this->Course_model->data_updates('course_status', $dataset, $dataget);
                    }
                    $status_msg = 'You have to wait to pass session!';
                }

                $res = array('check_num'=>0, 'msg'=>$status_msg,'last_id'=>$last_id);
                return $res;
            }else{
                $dataset = array(
                    'course_id' => $course->course_id,
                    'chapter_id' => $ch_id,
                    'user_id' => $user_id,
                    'reg_date' => date("Y-m-d H:i:s")
                );
                $this->Course_model->data_insert('course_history', $dataset);
                $res = array('check_num'=>1);
                return $res;
            }

        }
    }

    public function examInstruction($exam_id=0,$course_id = 0)
    {
        $params['company'] = $this->company;
		if(empty($params['company'])){
			$company_id = $this->session->get_userdata()['company_id'];
		}
        $params['menu_name'] = 'catalog';
        if($this->session->userdata ( 'isLoggedIn' ) == NULL ){
            redirect('welcome');
        }
        $params['exam_id'] = $exam_id;
        $params['course_id'] = $course_id;
        $params['exam'] = $this->Exam_model->getRow($exam_id)[0];
		

/*      //increase exam_max_num
        $chapter_id = $this->input->get('chapter_id');
        $user_id = $this->session->get_userdata()['user_id'];
        $quiz_group_num = $this->Exam_model->getQuizGroupNum($user_id,$chapter_id);
        if (count($quiz_group_num) == 0){
            $this->Exam_model->insertQuizGroupNum($user_id, $chapter_id, 1);
        }else{
            $this->Exam_model->updateQuizGroupNum($user_id, $chapter_id, $quiz_group_num[0]['num']+1);
        }*/

        $this->load->view('company_page/exam-instruction', $params);
    }

    public function view_Quiz($quiz_id = 0){
        $params['company'] = $this->company;
        $params['menu_name'] = 'catalog';
        $params['question'] = $this->Exam_model->getRowQuiz($quiz_id);
        $params['quiz_id'] = $quiz_id;
        $params['exam_show_type'] = 0;
        $params['question']['content'] = json_decode($params['question']['content'],true);
        $this->load->view('company_page/showQuiz', $params);
    }

    public function view_QuizGroup($quiz_group_id = 0, $chapter_id, $current_quiz_pos = 0){
        $results = $this->Exam_model->getQuizGroup($quiz_group_id)[0];
        $quiz_ids = json_decode($results['quiz_ids']);
        if(count($quiz_ids) >= $current_quiz_pos+1){
            $this->view_Question($quiz_group_id, $current_quiz_pos+1, $quiz_ids[$current_quiz_pos], $chapter_id);
        }else{

            $user_id = $this->session->get_userdata()['user_id'];

            $quiz_group_num = $this->Exam_model->getQuizGroupNum($user_id,$chapter_id);
            if (count($quiz_group_num) == 0){
                $this->Exam_model->insertQuizGroupNum($user_id, $chapter_id, 1);
            }else{
                $this->Exam_model->updateQuizGroupNum($user_id, $chapter_id, $quiz_group_num[0]['num']+1);
            }


            $params['answers'] = $this->Exam_model->getQuizGroupHistoryByUser($quiz_group_id,$user_id,$chapter_id);
            $params['correct_count'] = 0;
            $params['wrong_count'] = 0;
            $course_data = $this->Course_model->getCourseDataByChID($chapter_id)[0];
            $params['pass_mark'] = $course_data['pass_mark'];
            $params['max_num'] = $course_data['attempt_num'] - $course_data['num'];
            for ($i=0;$i<count($params['answers']);$i++){
                if ($params['answers'][$i]['mark1'] == "100"){
                    $params['correct_count']++;
                }else{
                    $params['wrong_count']++;
                }
            }
            $this->load->view('company_page/resultQuizGroup', $params);
        }
    }

    public function view_Question($group_id, $cur_pos, $quiz_id, $chapter_id){
        $params['company'] = $this->company;
        $params['menu_name'] = 'catalog';
        $params['question'] = $this->Exam_model->getRowQuiz($quiz_id);
        $params['quiz_id'] = $quiz_id;
        $params['exam_show_type'] = 0;
        $params['group_id'] = $group_id;
        $params['cur_pos'] = $cur_pos;
        $params['chapter_id'] = $chapter_id;
        $params['question']['content'] = json_decode($params['question']['content'],true);
        $this->load->view('company_page/showQuiz', $params);
    }

    public function saveQuesResult()
    {
        $cur_pos = $this->input->post('cur_pos');
        $group_id = $this->input->post('group_id');
        $quiz_id = $this->input->post('quiz_id');
        $chapter_id = $this->input->post('chapter_id');
        $user_id = $this->session->get_userdata()['user_id'];
        $ansArry = $_POST;

        $question = $this->Exam_model->getRowQuiz($quiz_id);
        $question['content'] = json_decode($question['content'],true);
        $userAns = $ansArry;
        $mark = 0;
        switch ($question['type']) {
            case 'multi-choice':
                $correctCheck = $question['content']['correctCheck'];
                $checkbox = $question['content']['checkbox'];
                if (isset($checkbox[$correctCheck[0]])) {
                    $ans = $checkbox[$correctCheck[0]];
                } else {
                    $ans = "N/A";
                }
                if(isset($userAns['multichoice']))
                    if($ans == $userAns['multichoice']){
                        $mark = 100;
                    } else {
                        $mark = 0;
                    }
                break;
            case 'checkbox':
                $correctCheck=$question['content']['correctCheck'];
                $checkbox=$question['content']['checkbox'];
                $correctAns = array();

                if(is_array($correctCheck)) {
                    for ($j = 0; $j < count($correctCheck); $j++) {
                        $correctAns[] = $checkbox[$correctCheck[$j]];
                    }
                }
                if(!empty($userAns['checkbox']) && $userAns['checkbox'] === $correctAns){
                    $mark = 100;
                } else {
                    $mark = 0;
                }
                break;
            case 'true-false':
                $tftext=$question['content']['tf'];
                $settrue=$question['content']['settrue'];
                if (isset($tftext[$settrue])) {
                    if($userAns['true_false'][0] == $tftext[$settrue]){
                        $mark = 100;
                    } else {
                        $mark = 0;
                    }
                }
                break;
            case 'fill-blank':
                $blank=$question['content']['blank'];
                $temp_count = 0;
                $part_count = 0;
                for ($i=0;$i<count($blank);$i++){
                    $correct_answer = explode(";",$blank[$i]);
                    for ($j=0;$j<count($correct_answer);$j++){
                        if ($correct_answer[$j] == $userAns['blank'][$i]){
                            $part_count++;
                        }
                    }
                    if ($part_count < 1){
                        $temp_count++;
                    }
                }
                if($temp_count <= 0){
                    $mark = 100;
                } else {
                    $mark = 0;
                }
                break;
            case 'essay':

                break;
            case 'matching':
                $content=$question['content']['choice'];
                $match=$question['content']['match'];
                if($userAns['matching'] === $match){
                    $mark = 100;
                } else {
                    $mark = 0;
                }
                break;
        }
        if (count($this->Exam_model->getQuizGroupAnswer($user_id,$quiz_id, $group_id, $chapter_id)) == 0){
            $this->Exam_model->insertQuizGroupAnswer(array("chapter_id"=>$chapter_id,"user_id"=>$user_id,"quiz_id"=>$quiz_id,"group_id"=>$group_id,"description"=>json_encode($ansArry),"mark1"=>$mark));
        }else{
            $this->Exam_model->updateQuizGroupAnswer($user_id,$quiz_id,$group_id,json_encode($ansArry),$mark);
        }

        $this->view_QuizGroup($group_id,$chapter_id, $cur_pos);
    }

    public function showPreviewQuestion($exam_id=0)
    {
        $params['company'] = $this->company;
        $params['menu_name'] = 'catalog';
        if($this->session->userdata ( 'isLoggedIn' ) == NULL ){
            redirect('welcome');
        }
        $params['show_button'] = TRUE;
        $params['exam_show_type'] = $this->Exam_model->getRow($exam_id)[0]['solution_flag'];
        $params['exam_type'] = $this->Exam_model->getRow($exam_id)[0]['type'];
        $params['limit_time'] = $this->Exam_model->getRow($exam_id)[0]['limit_time'];
        if($this->input->post('id') != ''){
            $id = $this->input->post('id');
            $params['show_button'] = FALSE;
            $params['question'] = $this->Exam_model->getRowQuiz($id);
            $quiz_count = count($this->Exam_model->getQuizList($params['question']['exam_id']));
        }else if ($this->input->get('next') != '') {
            $next = $this->input->get('next');
            $params['question'] = $this->Exam_model->getRowQuizByPos($exam_id,$next);
            $quiz_count = count($this->Exam_model->getQuizList($params['question']['exam_id']));
        }else if ($this->input->get('before') != '') {
            $before = $this->input->get('before');
            $params['question'] = $this->Exam_model->getRowQuizByPos($exam_id,$before);
            $quiz_count = count($this->Exam_model->getQuizList($params['question']['exam_id']));
        }else{
            $this->Exam_model->insertExamHistory(array("user_id"=>$this->session->get_userdata()['user_id'],"exam_id"=>$exam_id));
            $params['question'] = $this->Exam_model->getQuizList($exam_id)[0];
            $quiz_count = count($this->Exam_model->getQuizList($exam_id));
            if($quiz_count == 0 || $exam_id == 0){
                print_r("No exists questions.");
                return;
            }
        }
        if ($params['exam_type'] == "Manual"){
            $temp_answer = $this->Exam_model->getUserAnswer($this->session->get_userdata()['user_id'],$params['question']['id']);
            $params['quiz_answer'] = json_decode($temp_answer['description'],true);
        }
        $params['exam_start_at'] = $this->Exam_model->getExamHIstory($this->session->get_userdata()['user_id'],$exam_id)['exam_start_at'];
        $params['question']['content'] = json_decode($params['question']['content'],true);
        $params['id'] = $params['question']['position'];
        $params['next'] = $params['id'] + 1;
        $params['before'] = $params['id'] - 1;
        $params['end'] = $quiz_count - 1;

        $this->load->view('company_page/showPreviewQuestion', $params);
    }

    public function reportCard($exam_id = 0)
    {
        $params['company'] = $this->company;
        $params['user_id'] = $this->session->get_userdata()['user_id'];
        $params['exam_id'] = $exam_id;
        $params['exam'] = $this->Exam_model->getRow($exam_id)[0];
        $this->load->view('company_page/exam-sign', $params);
    }

    public function show_exam_feedback($exam_id = 0,$course_id = 0)
    {
        $params['company'] = $this->company;
        $params['menu_name'] = 'catalog';
        $params['user_id'] = $this->session->get_userdata()['user_id'];
        $params['exam_id'] = $exam_id;


        /*start send_email*/
        //When users complete a course.
        $create_id = $this->Exam_model->getRow($exam_id)[0]['create_id'];
        $from_email = $this->getEmailAddress($create_id);

        $this->load->library('email');
        $email_temp = $this->getEmailTemp('complete_course',$params['company']['id']);
        $email_class  = new Email();
        $email_class->send_email($this->session->get_userdata()['email'],$email_temp['subject'],$email_temp['message'],$from_email);
        //Instructor & Admin gets email when a course is completed
        //to admin
        $email_temp = $this->getEmailTemp('IA_complete_course',$params['company']['id']);
            // for replace tags
            $course_data = $this->Course_model->getCourseById($course_id);
            $admin_name = $this->User_model->getFullNameById($create_id);
            $content = $email_temp['message'];
            $content = str_replace("{ADMIN_USERNAME}", $admin_name, $content);
            $content = str_replace("{LEANER_NAME}", $this->session->get_userdata()['user_name'], $content);
            $content = str_replace("{COURSE_NAME}", $course_data["title"] , $content);
            $content = str_replace("{LOGO}", "<img src='" . base_url('assets/logos/logo1.png') . "'/>"."<img src='" . base_url('assets/logos/logo2.png') . "'/>", $content);
            $content = str_replace("{CATEGORY}", $course_data["category_name"], $content);
            $content = str_replace("{STANDARD}", $course_data["standard_name"], $content);
        $email_class->send_email($from_email,$email_temp['subject'],$content,$this->session->get_userdata()['email']);
        //to instructor
        $instructors = $this->Course_model->select($course_id)->instructors;
        if(!empty($instructors)){
            $instructors = json_decode($instructors,true);
            foreach ($instructors as $key => $val) {
                // for replace tags
                $Instructor_name = $this->User_model->getFullNameById($val);
                $content = $email_temp['message'];
                $content = str_replace("{ADMIN_USERNAME}", $Instructor_name, $content);
                $content = str_replace("{LEANER_NAME}", $this->session->get_userdata()['user_name'], $content);
                $content = str_replace("{COURSE_NAME}", $course_data["title"] , $content);
                $content = str_replace("{LOGO}", "<img src='" . base_url('assets/logos/logo1.png') . "'/>"."<img src='" . base_url('assets/logos/logo2.png') . "'/>", $content);
                $content = str_replace("{CATEGORY}", $course_data["category_name"], $content);
                $content = str_replace("{STANDARD}", $course_data["standard_name"], $content);
                $email_class->send_email($this->getEmailAddress($val),$email_temp['subject'],$content,$this->session->get_userdata()['email']);
            }
        }
        /*end send_email*/
        $this->load->view('company_page/exam-feedback', $params);
    }

    public function save_exam_feedback(){
        $exam_id = $this->input->post('exam_id');
        $insert_data = array();

        foreach ($this->input->post() as $key => $value) {
            $insert_data[$key] = $value;
        }

        $this->Exam_model->insertFeedback($insert_data);

        $this->showPreviewQuestion($exam_id);
    }

    public function save_signature()
    {
        $user_id = $this->session->get_userdata()['user_id'];
        if (isset($_REQUEST["id"]) && isset($_REQUEST["sign"]))
        {
            $this->Exam_model->updateExamHistory(array("sign"=>$_REQUEST["sign"]),$_REQUEST["id"],$user_id);

            echo "SUCCESS";
        } else {
            echo "FAILED";
        }
    }

    public function restartCourse(){
        $chapter_id = $this->input->post('id');
        $user_id = $this->session->get_userdata()['user_id'];
        $dataget = array(
            'id' => $chapter_id
        );

        $chapter = $this->Course_model->data_gets('chapter', $dataget, '', 'position', 'asc')[0];

        $dataget = array(
            'id' => $chapter_id
        );

        $this->Course_model->deleteAllChapterNumber($chapter_id, $user_id);
        $this->Course_model->deleteAllCourseHistory($chapter_id, $user_id);
        $this->Course_model->deleteAllCourseAssessment($chapter_id, $user_id);
        $this->Course_model->deleteAllCourseStatus($chapter_id, $user_id);

        $this->response('true');

    }

    public function checkAssessment(){

        $ch_id = $this->input->post('id');
        $user_id = $this->session->get_userdata()['user_id'];
        
        $chapter = $this->Course_model->data_gets('chapter', array("id"=>$ch_id), '', 'position', 'asc')[0];
        $course = $this->Course_model->select( $chapter->course_id);

        $user_type = $this->session->userdata('user_type');
        if($user_type != 'Learner') {
            $res = array('check_num'=>1);
            $this->response($res);
        }
        if($chapter->quiz_id != 0){
            // get quiz ids based on chapter id
            $page_data['session_quiz'] = $this->Course_model->getQuizByChapterId($chapter->id);
            // get quiz exam result based on quiz group id
            $page_data['quiz_history'] = $this->Exam_model->getQuizGroupHistoryByUser($chapter->quiz_id, $user_id, $chapter->id);
            // get assessment data (handled by instructor)
            $results = $this->Course_model->getAssessByCourseID($chapter->course_id);
            $page_data['assess'] = $results;
            $asses_data = array();
            $is_ass_exist = 0;
            $page_type_sum = 0;
            $page_type_num = 0;

            foreach($page_data['session_quiz'] as $quiz){
                foreach ($page_data['assess'] as $asses){
                    if($chapter->id == $asses['chapter_id'] && $asses['user_id'] == $user_id){
                        $is_ass_exist = 1;
                        break;
                    }
                }
                if($is_ass_exist == 0){
                    if($quiz['parent'] == $chapter->id){
                        $group_quiz_sum = 0;
                        $quiz_ids = json_decode($quiz['quiz_ids']);
                        for ($j = 0;$j < count($quiz_ids);$j++){
                            foreach ($page_data['quiz_history'] as $q_h){
                                if($q_h['chapter_id'] == $quiz['id'] && $q_h['user_id'] == $user_id && $q_h['quiz_id'] == $quiz_ids[$j]){
                                    $group_quiz_sum = $group_quiz_sum + $q_h['mark1'];
                                }
                            }
                        }
                        $group_quiz_sum = $group_quiz_sum / (count($quiz_ids) * 100)*100;
                        $page_type_num++;
                        $page_type_sum = $page_type_sum + $group_quiz_sum;
                    }else {
                        $group_quiz_sum = 0;
                        $quiz_ids = json_decode($quiz['quiz_ids']);
                        for ($j = 0;$j < count($quiz_ids);$j++){
                            foreach ($page_data['quiz_history'] as $q_h){
                                if($q_h['chapter_id'] == $quiz['id'] && $q_h['user_id'] == $user_id && $q_h['quiz_id'] == $quiz_ids[$j]){
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
                if($page_type_sum > $course->passmark){
                    $res = array('check_num'=>0, 'msg'=>"You already passed it!");
                    $this->response($res);
                }else {
                    $res = array('check_num'=>1);
                    $this->response($res);
                }
            }else {
                $res = array('check_num'=>0, 'msg'=>"You cann't test it again!");
                $this->response($res);
            }
        }else if ($chapter->exam_id != 0) {
            $course_id = $course->id;
            
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
            foreach ($page_data['course_session'] as $chapter){
                for ($i = 1;$i < 7;$i++){
                    $is_ass_exist = 0;
                    $page_type_sum = 0;
                    $page_type_num = 0;
                    foreach($page_data['session_quiz'] as $quiz){
                        foreach ($page_data['assess'] as $asses){
                            if($i == $asses['page_type'] && $chapter->id == $asses['chapter_id'] && $asses['user_id'] == $user_id){
                                $asses_data[$chapter->id][$i] = $asses['assessment'];
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
                                        if($q_h['chapter_id'] == $quiz['id'] && $q_h['user_id'] == $user_id && $q_h['quiz_id'] == $quiz_ids[$j]){
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
                                        if($q_h['chapter_id'] == $quiz['id'] && $q_h['user_id'] == $user_id && $q_h['quiz_id'] == $quiz_ids[$j]){
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
                        $asses_data[$chapter->id][$i] = $page_type_sum;
                    }
                }
            }
            $page_data['asses_data'] = $asses_data;	
            $is_all_null_num = 0;
            $all_total = 0;
            foreach ($page_data['course_session'] as $session){
                $sum_mark_total = 0;
                $is_null_num = 0;

                for($i = 1; $i<7; $i++)
                {
                    $sum_mark_total = $sum_mark_total+$asses_data[$session->id][$i];
                    if(is_null($asses_data[$session->id][$i]))
                    {
                        $is_null_num++;
                    }
                }
                if($is_null_num!=6)
                    $all_total = $all_total+round($sum_mark_total/(6-$is_null_num), 2);
                else
                    $is_all_null_num++;
            }
            $average = round($all_total/(count($page_data['course_session'])-$is_all_null_num), 2);
            if($average < $page_data['pass_mark']){
                $res = array('check_num'=>0, 'msg'=>"You didn't passed sessions!");
                $this->response($res);
            }else{
                $res = array('check_num'=>1);
                $this->response($res);
            }
            
        }else{
            $res = array('check_num'=>1);
            $this->response($res);
        }
        
    }
    public function checkAssessment1(){

        $ch_id = $this->input->post('id');
        $user_id = $this->session->get_userdata()['user_id'];

        $up_ch_id = null;
        $dataget = array(
            'id' => $ch_id
        );
        $course = $this->Course_model->data_gets('chapter', $dataget, '', 'position', 'asc')[0];

        $user_type = $this->session->userdata('user_type');

        if($user_type != 'Learner') {
            $res = array('check_num'=>1);
            $this->response($res);
        }
        if($course->exam_id == 0){

            if($course->parent != 0){
                $dataget = array(
                    'id' => $course->parent
                );
                $parent = $this->Course_model->data_gets('chapter', $dataget, '', 'position', 'asc')[0];
                $dataget = array(
                    'position <' => $parent->position,
                    'course_id' => $parent->course_id,
                    'parent' =>0,
                    'exam_id' =>0
                );
            }else{
                $dataget = array(
                    'position <' => $course->position,
                    'course_id' => $course->course_id,
                    'parent' =>0,
                    'exam_id' =>0
                );
            }



            $up_chapter = $this->Course_model->data_gets('chapter', $dataget, '', 'position', 'desc')[0];
            $up_ch_id = $up_chapter->id;

            if(is_null($up_ch_id)){
                $dataget = array(
                    'course_id' => $course->course_id,
                    'user_id' => $user_id,
                );

                $status = $this->Course_model->data_gets('course_status', $dataget);
                if(count($status) == 0){
                    $dataset = array(
                        'course_id' => $course->course_id,
                        'user_id' => $user_id,
                        'reg_date' => date("Y-m-d H:i:s"),
                        'status' => 1
                    );
                    $this->Course_model->data_insert('course_status', $dataset);
                }
            }
        }



        $dataget = array(
            'id' => $course->course_id
        );
        $course_data = $this->Course_model->data_gets('course', $dataget)[0];

        if($up_chapter->quiz_id == 0){
            $course_data->is_ass_end = 1;
        }
        if($course_data->is_ass_end == 1 && $course->exam_id == 0){
            $dataset = array(
                'course_id' => $course->course_id,
                'chapter_id' => $ch_id,
                'user_id' => $user_id,
                'reg_date' => date("Y-m-d H:i:s")
            );
            $this->Course_model->data_insert('course_history', $dataset);
            $res = array('check_num'=>1);
            $this->response($res);
            return;
        }
        $dataget = array(
            'id' => $course->course_id,
            'create_id' => $this->session->get_userdata()['company_id']
        );
        $data_course= $this->Course_model->data_gets('course', $dataget)[0];

        $results = $this->Course_model->getAssessByCourseID($course->course_id);

        $page_data['assess'] = $results;

        $page_data['session_quiz'] = $this->Course_model->getQuizPageByCourseId($course->course_id);

        $dataget = array(
            'course_id' => $course->course_id,
            'parent'=>0,
            'exam_id'=>0
        );
        $page_data['course_session'] = $this->Course_model->data_gets('chapter', $dataget, '', 'position', 'asc');

        $page_data['course_pay_user'] = $this->Course_model->get_pay_user($course->course_id);

        $page_data['quiz_history'] = $this->Exam_model->get_quiz_history($course->course_id);

        $asses_data = array();

        foreach ($page_data['course_pay_user'] as $user)
        {
            foreach ($page_data['course_session'] as $chapter){
                for ($i = 1; $i < 7; $i++){
                    $is_ass_exist = 0;

                    $page_type_sum = 0;
                    $page_type_num = 0;
                    foreach ($page_data['session_quiz'] as $quiz){

                        foreach ($page_data['assess'] as $asses) {
                            if ($i == $asses['page_type'] && $chapter->id == $asses['course_id'] && $asses['user_id'] == $user['user_id']) {
                                $asses_data[$user['user_id']][$chapter->id][$i] = $asses['assessment'];
                                $is_ass_exist = 1;
                                break;
                            }
                        }
                        if($is_ass_exist == 0)
                        {
                            if($quiz['relative_type'] == $i && $quiz['parent'] == $chapter->id && $i != 6){
                                $group_quiz_sum = 0;
                                $quiz_ids = json_decode($quiz['quiz_ids']);
                                for ($j = 0; $j < count($quiz_ids); $j++){
                                    foreach ($page_data['quiz_history'] as $q_h){

                                        if($q_h['chapter_id'] == $quiz['id'] && $q_h['user_id'] == $user['user_id']
                                            && $q_h['quiz_id'] == $quiz_ids[$j])
                                        {
                                            $group_quiz_sum = $group_quiz_sum+$q_h['mark1'];
                                        }
                                    }
                                }


                                $group_quiz_sum = (100 / (count($quiz_ids))*$group_quiz_sum/100);
                                $page_type_num++;
                                $page_type_sum = $page_type_sum + $group_quiz_sum;
                            }else if(is_null($quiz['relative_type']) && $quiz['parent'] == $chapter->id && $i == 6)
                            {
                                $group_quiz_sum = 0;
                                $quiz_ids = json_decode($quiz['quiz_ids']);
                                for ($j = 0; $j < count($quiz_ids); $j++){
                                    foreach ($page_data['quiz_history'] as $q_h){

                                        if($q_h['chapter_id'] == $quiz['id'] && $q_h['user_id'] == $user['user_id']
                                            && $q_h['quiz_id'] == $quiz_ids[$j])
                                        {
                                            $group_quiz_sum = $group_quiz_sum+$q_h['mark1'];
                                        }
                                    }
                                }


                                $group_quiz_sum = (100 / (count($quiz_ids))*$group_quiz_sum/100);
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


        $all_avg = 0;
        $chapter_avg = 0;
        $is_all_null_num = 0;
        $all_total = 0;
        foreach ($page_data['course_session'] as $session) {
            $sum_mark_total = 0;
            $is_null_num = 0;

            for ($i = 1; $i < 7; $i++) {
                $sum_mark_total = $sum_mark_total + $asses_data[$user_id][$session->id][$i];
                if (is_null($asses_data[$user_id][$session->id][$i])) {
                    $is_null_num++;
                }
            }
            if ($is_null_num != 6)
                $all_total = $all_total + round($sum_mark_total / (6 - $is_null_num), 2);
            else
                $is_all_null_num++;
        }

        if($is_all_null_num != (count($page_data['course_session']))){
            $all_avg = round($all_total/(count($page_data['course_session'])-$is_all_null_num), 2);
            $is_quiz_exist = 1;
        }else if($is_all_null_num == (count($page_data['course_session']))){
            $is_quiz_exist = 0;
        }


        if($course->exam_id == 0 && !is_null($up_ch_id)){
            $sum_mark_total = 0;
            $is_null_num = 0;
            for($i = 1; $i<7; $i++)
            {
                $sum_mark_total = $sum_mark_total+$asses_data[$user_id][$up_ch_id][$i];
                if(is_null($asses_data[$user_id][$up_ch_id][$i]))
                {
                    $is_null_num++;
                }
            }
            if($is_null_num != 6)
                $chapter_avg = round($sum_mark_total/(6-$is_null_num), 2);
        }



        if($course->exam_id != 0){

            if($is_quiz_exist == 1 && $data_course->is_ass_end == 1 && !is_null($all_avg) && $all_avg < $data_course->pass_mark)
            {

                $last_history = $this->Course_model->getLastHistoryByUserID($course->course_id, $this->session->get_userdata()['user_id']);
                if(count($last_history) == 0){
                    $last_history = $this->Course_model->getFirstChapter($course->course_id)[0];
                    $last_id =$last_history['id'];

                }else{
                    $ch_id =$last_history[0]['chapter_id'];
                    $last_id = $ch_id;
                }
                $num = $this->Course_model->getCourseExamCheckStatus($user_id,$course->id)[0]['num'];
                if(!is_null($num) && $num <= 0){
                    $dataget = array(
                        'course_id' => $course->course_id,
                        'user_id' => $user_id,
                    );

                    $status = $this->Course_model->data_gets('course_status', $dataget);
 
                    if(count($status) == 0){
                        $dataset = array(
                            'course_id' => $course->course_id,
                            'user_id' => $user_id,
                            'end_date' => date("Y-m-d H:i:s"),
                            'status' => 3
                        );
                        $this->Course_model->data_insert('course_status', $dataset);
                    }else{
                        $dataset = array(
                            'end_date' => date("Y-m-d H:i:s"),
                            'status' => 3
                        );
                        $dataget = array(
                            'id' => $status[0]->id
                        );
                        $this->Course_model->data_updates('course_status', $dataset, $dataget);
                    }
                    $status_msg = 'exam';
                }
                $res = array('check_num'=>0, 'msg'=>$status_msg, 'last_id'=>$last_id);
                $this->response($res);
            }
            else{
                $dataset = array(
                    'course_id' => $course->course_id,
                    'chapter_id' => $ch_id,
                    'user_id' => $user_id,
                    'reg_date' => date("Y-m-d H:i:s")
                );
                $this->Course_model->data_insert('course_history', $dataset);
                $res = array('check_num'=>1);
                $this->response($res);
            }
        }
        else {

            if($is_quiz_exist == 1 && $data_course->is_ass_end == 1 && $chapter_avg < $data_course->pass_mark && !is_null($chapter_avg)){
                $last_history = $this->Course_model->getLastHistoryByUserID($course->course_id, $this->session->get_userdata()['user_id']);
                if(count($last_history) == 0){
                    $last_history = $this->Course_model->getFirstChapter($course->course_id)[0];
                    $last_id =$last_history['id'];
                }else{
                    $ch_id =$last_history[0]['chapter_id'];
                    $last_id = $ch_id;
                }

                $num = $this->Course_model->getCoursePageCheckStatus($user_id, $up_ch_id)[0]['num'];
                $status_msg = null;
                if($num <= 0){
                    $dataget = array(
                        'course_id' => $course->course_id,
                        'user_id' => $user_id,
                    );

                    $status = $this->Course_model->data_gets('course_status', $dataget);
                    if(count($status) == 0){
                        $dataset = array(
                            'course_id' => $course->course_id,
                            'user_id' => $user_id,
                            'end_date' => date("Y-m-d H:i:s"),
                            'status' => 2
                        );
                        $this->Course_model->data_insert('course_status', $dataset);
                    }else{
                        $dataset = array(
                            'end_date' => date("Y-m-d H:i:s"),
                            'status' => 2
                        );
                        $dataget = array(
                            'id' => $status[0]->id
                        );
                        $this->Course_model->data_updates('course_status', $dataset, $dataget);
                    }
                    $status_msg = 'You have to wait to pass session!';
                }

                $res = array('check_num'=>0, 'msg'=>$status_msg,'last_id'=>$last_id);
                $this->response($res);
            }else{
                $dataset = array(
                    'course_id' => $course->course_id,
                    'chapter_id' => $ch_id,
                    'user_id' => $user_id,
                    'reg_date' => date("Y-m-d H:i:s")
                );
                $this->Course_model->data_insert('course_history', $dataset);
                $res = array('check_num'=>1);
                $this->response($res);
            }

        }
    }

    public function checkExamExist(){
        $course_id = $this->input->post('course_id');
        $exam_id = $this->input->post('exam_id');
        $chapter_id = $this->input->post('chapter_id');
        $res = $this->Exam_model->getList(array('a.id' => $exam_id))['data'];
        $user_id = $this->session->get_userdata()['user_id'];
        $chapter = $this->Course_model->getChapter($chapter_id);
        $quiz_group_num = $this->Exam_model->getQuizGroupNum($user_id,$chapter_id);
        $this->response(array('course_id'=>$course_id, 'exam_num' => count($res), 'exist_num'=>$chapter[0]['exam_max_num']-$quiz_group_num[0]['num']));
    }

    public function checkQuizExist(){
        $course_id = $this->input->post('course_id');
        $quiz_id = $this->input->post('quiz_id');
        $chapter_id = $this->input->post('chapter_id');
        $user_id = $this->session->get_userdata()['user_id'];
        $res = $this->Exam_model->getRowQuizGroup($quiz_id);
        $chapter = $this->Course_model->getChapter($chapter_id);
        $quiz_group_num = $this->Exam_model->getQuizGroupNum($user_id,$chapter_id);
        
        if($quiz_group_num[0]['num']==null){
            $this->response(array('quiz_num' => count($res), 'exist_num'=>$chapter[0]['attempt_num']));
        }else{
            $this->response(array('quiz_num' => count($res), 'exist_num'=>$chapter[0]['attempt_num']-$quiz_group_num[0]['num']));
        }
    }

    public function examResult($exam_id = 0)
    {
        $params['company'] = $this->company;
        $user_id = $this->session->get_userdata()['user_id'];
        
        $course_id = $this->session->get_userdata()['using_course_id'];
        $course_data = $this->Course_model->getCourseById($course_id);
        $params['user_name'] = $this->session->get_userdata()['user_name'];
        $params['questions'] = $this->Exam_model->getQuizList($exam_id);
        $params['answers'] = $this->Exam_model->getQuizHistoryByUser($exam_id,$user_id);
        $params['correct_count'] = 0;
        $params['wrong_count'] = 0;
        $params['exam_id'] = $exam_id;

        for ($i=0;$i<count($params['answers']);$i++){
            if ($params['answers'][$i]['mark1'] == "100"){
                $params['correct_count']++;
            }else{
                $params['wrong_count']++;
            }
        }
        $params['score'] = round($params['correct_count']*100/count($params['answers']),2);
        $params['pass_grade'] = $this->Exam_model->getRow($exam_id)[0]['min_percent'];
        $params['exam_type'] = $this->Exam_model->getRow($exam_id)[0]['type'];
        
        $exam_type = $this->Exam_model->getRow($exam_id)[0]['type'];

        if ($params['pass_grade'] <=  $params['score']){
            $params['result'] = "Pass";

            $dataget = array(
                'course_id' => $course_id,
                'user_id' => $user_id,
            );

            $status = $this->Course_model->data_gets('course_status', $dataget);
            if(count($status) == 0){
                $dataset = array(
                    'course_id' => $course_id,
                    'user_id' => $user_id,
                    'end_date' => date("Y-m-d H:i:s"),
                    'status' => 4
                );
                if($exam_type=='Manual'){

                }else{
                   $this->Course_model->data_insert('course_status', $dataset); 
                }                
            }else{
                $dataset = array(
                    'end_date' => date("Y-m-d H:i:s"),
                    'status' => 4
                );
                $dataget = array(
                    'id' => $status[0]->id
                );
                if($exam_type=='Manual'){

                }else{
                    $this->Course_model->data_updates('course_status', $dataset, $dataget);
                }
            }
        }else{
            $params['result'] = "Fail";
        } 
        
        if($exam_type=='Manual'){
           $this->Exam_model->updateExamHistory(array("exam_end_at"=>date("Y-m-d H:i:s"),"mark"=>$params['score'],"exam_status"=>'Not Determine'),$exam_id,$user_id);  
          }else{
           $this->Exam_model->updateExamHistory(array("exam_end_at"=>date("Y-m-d H:i:s"),"mark"=>$params['score'],"exam_status"=>$params['result']),$exam_id,$user_id);        
        }       
          
        $exam_history = $this->Exam_model->getExamHistory($user_id,$exam_id);
        $params['time_taken'] = "";
        $time_taken_seconds = strtotime($exam_history['exam_end_at']) - strtotime($exam_history['exam_start_at']);
        if (floor($time_taken_seconds/3600) > 0){
            $params['time_taken'] .= (floor($time_taken_seconds/3600))." hours ";
        }
        if (floor(($time_taken_seconds%3600)/60) > 0){
            $params['time_taken'] .= (floor(($time_taken_seconds%3600)/60))." minutes ";
        }
        if (($time_taken_seconds%3600%60) > 0){
            $params['time_taken'] .= ($time_taken_seconds%3600%60)." seconds ";
        }
        
        if($params['result'] == "Pass"){

            if($exam_type=='Manual'){

            }else{
               
                // $company = $this->Certification_model->getCompanyByUserId($user_id);
                
                // $learner = $this->Certification_model->getLearnerByUserId($user_id);
                // $course = $this->Certification_model->getCourseById($course_id);
                // $course_status = $this->Certification_model->getCourseStatusById($course_id, $user_id);         
                // $course_date = $course_status[0]['reg_date'] . "~" . $course_status[0]['end_date'];
                // $exam_info = $this->Certification_model->getExamHistory($user_id,$exam_id);
                // $exam_date = $exam_info[0]['exam_start_at'] . "~" . $exam_info[0]['exam_end_at'];
               
                // $admin = $this->Certification_model->getCompanyAdmin($company[0]['id']);
                // $certificate['certificate_id'] = $this->Exam_model->getRow($exam_id)[0]['certificate_id'];
                // $certificate['COMPANY NAME'] = $company[0]['name'];
                // //print_r("company=".$params['COMPANY NAME']);
                // //die();
                // $certificate['PARTICIPANT NAME'] = $learner[0]['name'];
                
                // $certificate['COURSE NAME'] = $course[0]['title'];
                // $certificate['EXAM DATE'] = $exam_date;
                // $certificate['EXAM TITLE'] = $exam_info[0]['title'];
                // $certificate['EXAM SCORE'] = $exam_info[0]['mark'];
                
                // $certificate['LOCATION'] = $course[0]['location'];
                // $certificate['NUMBER'] = $course[0]['number'];
                // $certificate['DATE'] = $course[0]['start_at'];
                // $certificate['CERTIFICATION DATE'] = substr($exam_info[0]['exam_end_at'], 0, 10);
                // $certificate['CATEGORY'] = $course[0]['category'];  
                // $certificate['NAME'] = $params['user_name'];
                // $certificate['SIGNATURE'] =  "<img id=\"userSignImg\" style=\"width:100%;\" src=\"".$admin[0]['sign']."\" />";
                // $certificate['TITLE'] = $this->session->get_userdata()['role'];
                // $certificate['LOGO_COMPANY'] = "<img src=\"".base_url()."assets/img/logo.png\" alt=\"OLS\" height=\"80\" width=\"240\">";
                // $certificate['LOGO_COURSE ACCERDITATION COMPANY'] = $params['score'];
                // $params['certificate'] = $certificate;
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

                //$this->global['certificate'] = $params['certificate'];
                //When users receive certificate  successfully
                $create_id = $this->Exam_model->getRow($exam_id)[0]['create_id'];
                $from_email = $this->getEmailAddress($create_id);

                $this->load->library('email');
                $email_class  = new Email();
                $email_temp = $this->getEmailTemp('success_certificate',$params['company']['id']);

                /*  course data replace */
                
                $content = $email_temp['message'];
                $content = str_replace("{USERNAME}", $params['user_name'], $content);
                $content = str_replace("{COURSE_NAME}", $course_html , $content);
                $content = str_replace("{LOGO}", "<img src='" . base_url('assets/logos/logo1.png') . "'/>"."<img src='" . base_url('assets/logos/logo2.png') . "'/>", $content);
                $content = str_replace("{CATEGORY}", $course_data["category_name"], $content);
                $content = str_replace("{STANDARD}", $course_data["standard_name"], $content);

                $email_class->send_email($this->session->get_userdata()['email'],$email_temp['subject'],$content,$from_email);

            }

        }else{
            //When users didn’t receive certificate of failed exam.
            $create_id = $this->Exam_model->getRow($exam_id)[0]['create_id'];
            $from_email = $this->getEmailAddress($create_id);
            $this->load->library('email');
            $email_class  = new Email();
            $email_temp = $this->getEmailTemp('fail_certificate',$params['company']['id']);
                $content = $email_temp['message'];
                $content = str_replace("{USERNAME}", $params['user_name'], $content);
                $content = str_replace("{COURSE_NAME}", $course_html , $content);
                $content = str_replace("{LOGO}", "<img src='" . base_url('assets/logos/logo1.png') . "'/>"."<img src='" . base_url('assets/logos/logo2.png') . "'/>", $content);
                $content = str_replace("{CATEGORY}", $course_data["category_name"], $content);
                $content = str_replace("{STANDARD}", $course_data["standard_name"], $content);
            $email_class->send_email($this->session->get_userdata()['email'],$email_temp['subject'],$content,$from_email);
        }

        //Instructor & Admin gets notification of completion of exams.
        /*start send_email*/
        $create_id = $this->Exam_model->getRow($exam_id)[0]['create_id'];
        $from_email = $this->getEmailAddress($create_id);
        $this->load->library('email');
        $email_class  = new Email();

        $email_temp = $this->getEmailTemp('IA_complete_exam',$params['company']['id']);

            $admin_name = $this->User_model->getFullNameById($create_id);
            $content = $email_temp['message'];
            $content = str_replace("{ADMIN_USERNAME}", $admin_name, $content);
            $content = str_replace("{LEANER_NAME}", $this->session->get_userdata()['user_name'], $content);
            $content = str_replace("{COURSE_NAME}", $course_data["title"] , $content);
            $content = str_replace("{LOGO}", "<img src='" . base_url('assets/logos/logo1.png') . "'/>"."<img src='" . base_url('assets/logos/logo2.png') . "'/>", $content);
            $content = str_replace("{CATEGORY}", $course_data["category_name"], $content);
            $content = str_replace("{STANDARD}", $course_data["standard_name"], $content);
        $email_class->send_email($from_email,$email_temp['subject'],$content,$this->session->get_userdata()['email']);
        //to instructor
        $instructors = $this->Course_model->select($this->session->get_userdata()['using_course_id'])->instructors;
        if(!empty($instructors)){
            $instructors = json_decode($instructors,true);
            foreach ($instructors as $key => $val) {
                $Instructor_name = $this->User_model->getFullNameById($val);
                $content = $email_temp['message'];
                $content = str_replace("{ADMIN_USERNAME}", $Instructor_name, $content);
                $content = str_replace("{LEANER_NAME}", $this->session->get_userdata()['user_name'], $content);
                $content = str_replace("{COURSE_NAME}", $course_data["title"] , $content);
                $content = str_replace("{LOGO}", "<img src='" . base_url('assets/logos/logo1.png') . "'/>"."<img src='" . base_url('assets/logos/logo2.png') . "'/>", $content);
                $content = str_replace("{CATEGORY}", $course_data["category_name"], $content);
                $content = str_replace("{STANDARD}", $course_data["standard_name"], $content);
                $email_class->send_email($this->getEmailAddress($val),$email_temp['subject'],$content,$this->session->get_userdata()['email']);
            }
        }
        /*end send_email*/

        $this->load->view('company_page/reportCard',  $this->global);
    }

    public function print_exam_certificate()
    {
        $param = $_POST;
        $html = $param['content'];
        
        $upload_path = "c:/tmpfile/";

        if (!file_exists($upload_path))
        {
            $this->makeDirectory($upload_path);
        }
        $upload_pdf_path = $upload_path.time().".pdf";        
            
        $temp_name = time().".html";
        
        file_put_contents($upload_path.$temp_name, $html);

        $command = 'wkhtmltopdf '.$upload_path.$temp_name.' "'.$upload_pdf_path.'"';

        //$command = 'wkhtmltopdf '.base_url().'assets/uploads/'.$temp_name.' "'.getcwd().'/'.$insert_data['file_path'].'"';
        
        if(strtolower(substr(PHP_OS,0,3))=="win")
            chdir('C:\Program Files\wkhtmltopdf\bin');
        else
            $command = '/usr/local/bin/'.$command;
        shell_exec($command);
        
        //unlink(PATH_UPLOAD.$temp_name);
        $this->load->helper('download');
        $data = file_get_contents($upload_pdf_path); 
        $name = time().".pdf";
        force_download($name, $data);

        $data['failed_count'] = 0;
        $data['url'] = base_url()."admin/library";
        $this->response($data);
    
    }

    public function saveUserAnswers()
    {
        $user_id = $this->session->get_userdata()['user_id'];
        $ansArry = array();
        $post = $this->input->post('formData');
        parse_str($post, $ansArry);

        $submit = (int) $this->input->post('submit');

        $question = $this->Exam_model->getRowQuiz($ansArry['current_q_id']);
        $question['content'] = json_decode($question['content'],true);
        $userAns = $ansArry;
        $ans = '';
        $mark = 0;
        switch ($question['type']) {
            case 'multi-choice':
                $correctCheck = $question['content']['correctCheck'];
                $checkbox = $question['content']['checkbox'];
                if (isset($checkbox[$correctCheck[0]])) {
                    $ans = $checkbox[$correctCheck[0]];
                } else {
                    $ans = "N/A";
                }
                if(isset($userAns['multichoice'.$question['position']]))
                    if($ans == $userAns['multichoice'.$question['position']]){
                        $mark = 100;
                    } else {
                        $mark = 0;
                    }
                $checkData = array(
                    'correctCheck'=>$question['content']['correctCheck'],
                    'checkbox'=>$question['content']['checkbox'],
                    'userAns'=>$userAns
                );
                $this->load->view("admin/exam/reportcard/multichoice", $checkData);
                break;
            case 'checkbox':
                $correctCheck=$question['content']['correctCheck'];
                $checkbox=$question['content']['checkbox'];
                $correctAns = array();

                if(is_array($correctCheck)) {
                    for ($j = 0; $j < count($correctCheck); $j++) {
                        $correctAns[] = $checkbox[$correctCheck[$j]];
                    }
                }
                if(!empty($userAns['checkbox']) && $userAns['checkbox'] === $correctAns){
                    $mark = 100;
                } else {
                    $mark = 0;
                }
                $checkData = array(
                    'correctCheck'=>$question['content']['correctCheck'],
                    'checkbox'=>$question['content']['checkbox'],
                    'userAns'=>$userAns
                );
                $this->load->view("admin/exam/reportcard/checkbox", $checkData);
                break;
            case 'true-false':
                $tftext=$question['content']['tf'];
                $settrue=$question['content']['settrue'];
                if (isset($tftext[$settrue])) {
                    if($userAns['true_false'][0] == $tftext[$settrue]){
                        $mark = 100;
                    } else {
                        $mark = 0;
                    }
                }
                $checkData = array(
                    'tftext'=>$question['content']['tf'],
                    'settrue'=>$question['content']['settrue'],
                    'userAns'=>$userAns
                );
                $this->load->view("admin/exam/reportcard/true_false", $checkData);
                break;
            case 'fill-blank':
                $blank=$question['content']['blank'];
                $temp_count = 0;
                $part_count = 0;
                for ($i=0;$i<count($blank);$i++){
                    $correct_answer = explode(";",$blank[$i]);
                    for ($j=0;$j<count($correct_answer);$j++){
                        if ($correct_answer[$j] == $userAns['blank'][$i]){
                            $part_count++;
                        }
                    }
                    if ($part_count < 1){
                        $temp_count++;
                    }
                }
                if($temp_count <= 0){
                    $mark = 100;
                } else {
                    $mark = 0;
                }
                $checkData = array('blank'=>$question['content']['blank'],'userAns'=>$userAns);
                $this->load->view("admin/exam/reportcard/fill_blank", $checkData);
                break;
            case 'essay':

                break;
            case 'matching':
                $content=$question['content']['choice'];
                $match=$question['content']['match'];
                if($userAns['matching'] === $match){
                    $mark = 100;
                } else {
                    $mark = 0;
                }
                $checkData = array(
                    'content'=>$question['content']['choice'],
                    'match'=>$question['content']['match'],
                    'userAns'=>$userAns
                );
                $this->load->view("admin/exam/reportcard/matching", $checkData);
                break;
        }
        if (count($this->Exam_model->getUserAnswer($user_id,$ansArry['current_q_id'])) == 0){
            $this->Exam_model->insertUserAnswer(array("user_id"=>$user_id,"quiz_id"=>$ansArry['current_q_id'],"description"=>json_encode($ansArry),"mark1"=>$mark));
        }else{
            $this->Exam_model->updateUserAnswer($user_id,$ansArry['current_q_id'],json_encode($ansArry),$mark);
        }

    }


}