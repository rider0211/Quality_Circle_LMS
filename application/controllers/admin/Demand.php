<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
// require APPPATH . '/third_party/PHPExcel.php';
// require APPPATH . '/third_party/TCPDF-master/tcpdf.php';
// include_once (APPPATH . '/third_party/iio/index.php');
// require APPPATH . '/libraries/FPDI/fpdi.php';
// require APPPATH . 'third_party/woocommerce/autoload.php';
// use Automattic\WooCommerce\Client;
// use Automattic\WooCommerce\HttpClient\HttpClientException;

class Demand extends BaseController{
    public function __construct(){
        parent::__construct();
        $this->load->model('Course_model');
        $this->load->model('Category_model');
        $this->load->model('Certification_model');
        $this->load->model('User_model');
        $this->load->model('Quiz_model');
        $this->load->model('Exam_model');
        $this->load->model('Inviteuser_model');
        $this->load->model('Plan_model');
        $this->load->model('Location_model');
        $this->isLoggedIn();
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '5');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        $this->load->library('pdf');

        // $this->woocommerce = new Client(
        //     'https://shop.gosmartacademy.com/', 
        //     'ck_b6411a22ed11f224a13d68bc2bb642a4227b69c3', 
        //     'cs_ae6ff61f63bed83c2d2e1880b1634449f30a2c04',
        //     ['version' => 'wc/v3', ]
        // );
    }
    
    public function index(){
        if($this->isMasterAdmin()){

        }else{
            $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function check_add_view(){
        $plan_id = $this->session->userdata('plan_id');
        $company_id = $this->session->userdata('company_id');
        $plan = $this->Plan_model->select($plan_id);
        if(empty($plan)){
            $result['msg'] = "You could not add! Select a subscription!";
            $result['success'] = false;
        }else{
            if($plan->price_type == 2){
                $result['msg'] = "";
                $result['success'] = true;
            }else{
                $filter = array("create_id" => $company_id);
                $cur_count = $this->Course_model->all_count($filter);
                $limit = $plan->demand_limit;
                /*if($cur_count >= $limit){
                    if($limit == 1)
                        $view_msg = 'demand';
                    else
                        $view_msg = 'demands';
                    $result['msg'] = "You could not add more than ".$limit." ".$view_msg."! Select a subscription!";
                    $result['success'] = false;
                }else{
                    $result['msg'] = "";
                    $result['success'] = true;
                }*/
                $result['msg'] = "";
                $result['success'] = true;
            }
        }
        $this->response($result);
    }
    
    public function viewCreate(){
        if($this->isMasterAdmin()){
            $company_id = $this->session->get_userdata() ['company_id'];
            $page_data['certification'] = $this->Certification_model->getRowByCompanyid($company_id);
            $page_data['instructor'] = $this->User_model->getInstructorByCompany($company_id);
            $page_data['observer'] = $this->User_model->getInstructorByCompany($company_id);
            $row_id = isset($_REQUEST['row_id']) ? intval($_REQUEST['row_id']) : 0;
            $exam_type = isset($_REQUEST['exam_type']) ? $_REQUEST['exam_type'] : "Auto";
            $this->load->model('Settings_model');
            if($row_id != 0){
                $exam_row = $this->Exam_model->getRow($row_id);
                if($exam_row[0]["exam_image"] != "") $exam_row[0]["preview_image"] = sprintf("%sassets/uploads/exam/%d_%s", base_url(), $exam_row[0]["id"], $exam_row[0]["exam_image"]);
                else $exam_row[0]["preview_image"] = "";
                $page_data['exam'] = $exam_row[0];
                $exam_type = $exam_row[0]["exam_type"];
            }else{
                $exam_row['id'] = '0';
                $exam_row["cert_temp_id"] = 0;
                $exam_row['exam_category_name'] = '';
                $exam_row['exam_category_code'] = '';
                $exam_row['category_id'] = 0;
                $exam_row['description'] = '';
                $exam_row["preview_image"] = '';
                $exam_row['status'] = '';
                $exam_row['created_at'] = '';
                $exam_row['updated_at'] = '';
                $page_data['exam'] = $exam_row;
            }
            if($exam_type == "Auto"){
                $this->loadViews("admin/exam/exam_edit", $this->global, $page_data, NULL);
            }else{
                $this->loadViews("admin/exam/exam_manual_edit", $this->global, $page_data, NULL);
            }
        }else{
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function getList(){
        if($this->isMasterAdmin()){
            $category_id = $this->input->get('category');
            if($category_id != null && $category_id != 0){
                $filter['category_id'] = $category_id;
            }
            $standard_id = $this->input->get('standard');
            if($standard_id != null && $standard_id != 0){
                $filter['standard_id'] = $standard_id;
            }
			$course_ids = $this->input->get('course');
            if($course_ids != null && $course_ids != 0){
                $filter['id'] = $course_ids;
            }
            $course_type = $this->input->get('course_type');
            if($course_type != null){
                $filter['course_type'] = 2;
            }else{
                $course_type = 2;
				$filter['course_type'] = $course_type;
            }
            $company_id = $this->session->get_userdata() ['company_id'];
            $displayLength = 5;
            $search = $this->input->get('sSearch');
            $status = $this->input->get('status');
            $start = $this->input->get('per_page');
            if(!isset($status)){
                $status = 1; // active                
            }
            if(!isset($start)){
                $start = 0;
            }
            $filter['start'] = $start;
            $filter['limit'] = $displayLength;
            $filter['search'] = $search;
            $filter['status'] = $status;
            $filter['company_id'] = $company_id;
            $this->global['course_data'] = $this->Course_model->getCourseByCompany($filter);
            unset($filter['start']);
            unset($filter['limit']);
            $this->global['iTotalRecords'] = count($this->Course_model->getCourseByCompany($filter));
            $this->global['status'] = $status;
            $this->global['sEcho'] = $search;
            $this->load->library('pagination');
            $config['base_url'] = site_url('admin/demand/getList?status=' . $status . '&sSearch=' . $search);
            $config['page_query_string'] = TRUE;
            $config['total_rows'] = $this->global['iTotalRecords'];
            $config['per_page'] = $displayLength;
            $config['num_links'] = 2;
            $config['uri_segment'] = 3;
            $config['full_tag_open'] = '<nav aria-label="..." class="pull-right"><ul class="pagination">';
            $config['full_tag_close'] = '</ul></nav>';
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
            $this->global['category_id'] = $category_id;
            $this->global['standard_id'] = $standard_id;
            $this->global['course_type'] = $course_type;
			$this->global['course_ids'] = $course_ids;			
            $this->pagination->initialize($config);
            $this->global['links'] = $this->pagination->create_links();
			$this->global['course_data_all'] = $this->Course_model->getAllCourse();
            $this->global['category'] = $this->Category_model->getListByCompanyID($this->session->userdata('company_id'));
            $this->global['standard'] = $this->db->get_where('category_standard')->result();
            // echo "<pre>";
            //     print_r($this->global['standard']);
            // exit;
            $this->loadViews("admin/demand/course_list", $this->global, NULL, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function delete(){
        $out_data = array();
        $id = $this->input->post('id');
        if($this->Course_model->deleteCourse($id)){
            $out_data["status"] = "Success";
            $out_data["message"] = "";
        }else{
            $out_data["status"] = "Fail";
            $out_data["message"] = "Could not delete the row.";
        }
        $this->response($out_data);
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
    
    public function getPageByChapterId(){
        $chapter_id = $this->input->post('chapter_id');
        $res = $this->Course_model->getPageByChID($chapter_id);
        $this->response($res);
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
    
    public function preview_course($row_id = 0){
        $this->load->library('Sidebar');
        if($this->isMasterAdmin()){
            $lang_ar = $this->Translate_model->getLanguageList(array('active_flag' => 1, 'add_flag' => 1));
            $page_data['lang_ar'] = $lang_ar['data'];
            $page_path = "admin/demand/preview_course";
            $course = $this->Course_model->select($row_id);
            $this->global['libraries'] = $this->Course_model->getLibrary($row_id);
            $this->global['course_name'] = $course->title;
            $this->global['course_id'] = $row_id;
            $this->global['active_id'] = 0;
            $this->loadViews($page_path, $this->global, NULL, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL , NULL); 
        }
    }
    
    public function view_course($id = NULL){
        $page_path = "admin/demand/view_course";
        $course = $this->Course_model->select($id);
        $this->global['course'] = $course;
        if($this->isMasterAdmin()){
            $this->loadViews($page_path, $this->global, NULL, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL , NULL); 
        }
    }
    
    public function view_row_assess($course_id = 0, $user_id = 0){
        if($this->isMasterAdmin() || $this->isInstructor()){
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
            $this->loadViews("admin/demand/view_assess", $this->global, $page_data, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL , NULL); 
        }
    }
    
    public function view_exam_history($course_id, $user_id){
        if($this->isMasterAdmin() || $this->isInstructor()){
            $exam_id = $this->Course_model->getExamId($course_id) [0]['exam_id'];
            $this->global['questions'] = $this->Exam_model->getQuizList($exam_id);
            $this->global['answers'] = $this->Exam_model->getQuizHistoryByUser($exam_id, $user_id);
            $this->global['exam_id'] = $exam_id;
            $this->loadViews("admin/demand/preview", $this->global, NULL, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL , NULL); 
        }
    }
    
    public function view_exam_feedback($course_id, $user_id){
        if($this->isMasterAdmin()){
            $exam_id = $this->Course_model->getExamId($course_id) [0]['exam_id'];
            $this->global['feedback'] = $this->Course_model->getExamFeedback($exam_id, $user_id);
            $this->loadViews("admin/exam/exam_feedback", $this->global, NULL, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL , NULL); 
        }
    }
    
    public function view_exam_certificate($course_id, $user_id){
        if($this->isMasterAdmin() || $this->isInstructor()){
            $exam_id = $this->Course_model->getExamId($course_id) [0]['exam_id'];
            $this->global['user_name'] = $this->session->get_userdata() ['user_name'];
            $params = $_POST;
            $company = $this->Certification_model->getCompanyByUserId($user_id);
            $learner = $this->Certification_model->getLearnerByUserId($user_id);
            $course = $this->Certification_model->getCourseById($course_id);
            $course_status = $this->Certification_model->getCourseStatusById($course_id, $user_id);
            $course_date = $course_status[0]['reg_date'] . "~" . $course_status[0]['end_date'];
            $exam_info = $this->Certification_model->getExamHistory($user_id, $exam_id);
            $exam_date = $exam_info[0]['exam_start_at'] . "~" . $exam_info[0]['exam_end_at'];
            $exam_history = $this->Exam_model->getExamHistory($user_id, $exam_id);
            $admin = $this->Certification_model->getCompanyAdmin($company[0]['id']);
            // echo "<pre>";
            //     print_r($admin);
            // exit();
            $params['CERTIFICATE NUMBER'] = $course_id.$user_id;
            $params['certificate'] = $this->Certification_model->getRowById($this->Exam_model->getRow($exam_id) [0]['certificate_id']) ['content'];
            $params['certificate_id'] = $this->Exam_model->getRow($exam_id) [0]['certificate_id'];
            $params['COMPANY NAME'] = $company[0]['name'];
            $params['PARTICIPANT NAME'] = $learner[0]['name'];
            $params['COURSE NAME'] = $course[0]['title'];
            $params['EXAM DATE'] = $exam_date;
            $params['EXAM TITLE'] = $exam_info[0]['title'];
            $params['EXAM SCORE'] = $exam_info[0]['mark'];
            $params['LOCATION'] = $course[0]['location'];
            $params['COURSE_NUMBER'] = $course[0]['number'];
            $params['NUMBER'] = $course[0]['ceu'];
            $params['DATE'] = $course[0]['start_at'];
            $params['CERTIFICATION DATE'] = substr($exam_info[0]['exam_end_at'], 0, 10);
            $params['CATEGORY'] = $course[0]['category'];
            $params['NAME'] = $params['user_name'];
            $params['SIGNATURE'] = "<img id=\"userSignImg\" style=\"width:70%;\" src=\"" . $admin[0]['sign'] . "\" />";
            $params['TITLE'] = $this->session->get_userdata() ['role'];
            $params['LOGO_COMPANY'] = "<img src=\"" . base_url() . "assets/img/logo.png\" alt=\"OLS\" height=\"80\" width=\"240\">";
            $params['LOGO_COURSE ACCERDITATION COMPANY'] = $params['score'];
            $this->global['certificate'] = $params;
            $this->loadViews("admin/demand/reportCard", $this->global, NULL, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL , NULL); 
        }
    }
    
    public function print_exam_certificate(){
        $param = $_POST;
        $html = $param['content'];
        //$upload_path = "c:/tmpfile/";
        $upload_path = 'assets/uploads/pdf/';
        if(!file_exists($upload_path)){
            $this->makeDirectory($upload_path);
        }
        $upload_pdf_path = $upload_path . time() . ".pdf";
        $temp_name = time() . ".html";
        file_put_contents($upload_path . $temp_name, $html);
        // $command_base_path = '/usr/local/bin/';
        //$command = $command_base_path.'wkhtmltopdf '.base_url().$upload_path.$temp_name.' '.$upload_pdf_path;
        // shell_exec($command);
        $command = 'wkhtmltopdf ' . $upload_path . $temp_name . ' "' . $upload_pdf_path . '"';
        //$command = 'wkhtmltopdf '.base_url().'assets/uploads/'.$temp_name.' "'.getcwd().'/'.$insert_data['file_path'].'"';
        if(strtolower(substr(PHP_OS, 0, 3)) == "win") chdir('C:\Program Files\wkhtmltopdf\bin');
        else $command = '/usr/local/bin/' . $command;
        shell_exec($command);
        $this->load->helper('download');
        $data = file_get_contents($upload_pdf_path);
        $name = time() . ".pdf";
        force_download($name, $data);
        $data['failed_count'] = 0;
        $data['url'] = base_url() . "admin/library";
        $this->response($data);
        //unlink(PATH_UPLOAD.$temp_name);
        // $this->load->helper('download');
        // $data = file_get_contents($upload_path.$temp_name);
        // $data = str_replace('src="https://gosmartacademy.com/assets/img/', 'src="assets/img/', $html);
        // $this->pdf->loadHtml($data);
        // $this->pdf->setPaper('A3', 'portrait');
        // Render the HTML as PDF
        // $this->pdf->render();
        // $name = time().".pdf";
        // // Output the generated PDF (1 = download and 0 = preview)
        // $attachment = $this->pdf->stream($name, array("Attachment"=>0));
        //force_download($name, $test);
        // $data['failed_count'] = 0;
        // $data['url'] = base_url()."admin/library";
        // $this->response($data);
        
    }
    /*
    public function view_exam_certificate($course_id, $user_id){
        $exam_id = $this->Course_model->getExamId($course_id)[0]['exam_id'];
        $this->global['user_name'] = $this->session->get_userdata()['user_name'];
        $params = $_POST;
        //print_r($course_id);
        //print_r($exam_id);
        //exit();
        $company = $this->Certification_model->getCompanyByUserId($user_id);
        $learner = $this->Certification_model->getLearnerByUserId($user_id);
        $course = $this->Certification_model->getCourseById($course_id);
        $course_status = $this->Certification_model->getCourseStatusById($course_id, $user_id);         
        $course_date = $course_status[0]['reg_date'] . "~" . $course_status[0]['end_date'];
        $exam_info = $this->Certification_model->getExamHistory($user_id,$exam_id);
        $exam_date = $exam_info[0]['exam_start_at'] . "~" . $exam_info[0]['exam_end_at'];
        $exam_history = $this->Exam_model->getExamHistory($user_id,$exam_id);       
        //print_r(count($exam_history));
        //exit();
        
        //$this->global['certificate'] = $this->Certification_model->getRowById($this->Exam_model->getRow($exam_id)[0]['certificate_id'])['content'];
        $params['certificate'] = $this->Certification_model->getRowById($this->Exam_model->getRow($exam_id)[0]['certificate_id'])['content'];
        
        $params['certificate'] = str_replace("{COMPANY NAME}", $company[0]['name'], $params['certificate']);
        $params['certificate'] = str_replace("{PARTICIPANT NAME}", $learner[0]['name'], $params['certificate']);
        $params['certificate'] = str_replace("{COURSE NAME}", $course[0]['title'], $params['certificate']);
        $params['certificate'] = str_replace("{EXAM DATE}", $exam_date, $params['certificate']);
        $params['certificate'] = str_replace("{EXAM TITLE}", $exam_info[0]['title'], $params['certificate']);
        $params['certificate'] = str_replace("{EXAM SCORE}", $exam_info[0]['mark'], $params['certificate']);
        
        $params['certificate'] = str_replace("{LOCATION}", $course[0]['location'], $params['certificate']);
        $params['certificate'] = str_replace("{NUMBER}", $course[0]['number'], $params['certificate']);
        $params['certificate'] = str_replace("{DATE}", $course[0]['start_at'], $params['certificate']);
       
        $params['certificate'] = str_replace("{NAME}", $params['user_name'], $params['certificate']);
        $params['certificate'] = str_replace("{SIGNATURE}", "<img id=\"userSignImg\" style=\"width:100%;\" src=\"".$exam_history['sign']."\" />", $params['certificate']);
        $params['certificate'] = str_replace("{TITLE}", $this->session->get_userdata()['role'], $params['certificate']);
        $params['certificate'] = str_replace("{LOGO_COMPANY}", "<img src=\"".base_url()."assets/img/logo.png\" alt=\"OLS\" height=\"80\" width=\"240\">", $params['certificate']);
        $params['certificate'] = str_replace("{LOGO_COURSE ACCERDITATION COMPANY}", $params['score'], $params['certificate']);
        $this->global['certificate'] = $params['certificate'];
        $this->loadViews("admin/demand/reportCard", $this->global, NULL , NULL);
    }*/
    public function view_assess($course_id = 0){
        $results = $this->Course_model->getAssessByCourseID($course_id);
        $page_data['assess'] = $results;
        $dataget = array('id' => $course_id);
        $page_data['pass_mark'] = $this->Course_model->data_gets('course', $dataget) [0]->pass_mark;
        $dataget = array('course_id' => $course_id, 'parent' => 0, 'exam_id' => 0, 'quiz_id !=' => 0);
        $page_data['session_quiz'] = $this->Course_model->getQuizPageByCourseId($course_id);
        $dataget = array('course_id' => $course_id, 'parent' => 0, 'exam_id' => 0);
        $page_data['course_session'] = $this->Course_model->data_gets('chapter', $dataget, '', 'position', 'asc');		
        $page_data['course_pay_user'] = $this->Course_model->get_pay_user($course_id);
        $page_data['quiz_history'] = $this->Exam_model->get_quiz_history($course_id);
        $asses_data = array();
        foreach($page_data['course_pay_user'] as $user){
            foreach($page_data['course_session'] as $chapter){
                for($i = 1;$i < 7;$i++){
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
        $page_data['asses_data'] = $asses_data;
		
		
        $this->loadViews("admin/demand/view_assess", $this->global, $page_data, NULL);
    }
    
    public function delete_assess(){
        $id = $this->input->post('id');
        $type = $this->input->post('type');
    }
    
    public function save_assess(){
        $id = $this->input->post('id');
        $type = $this->input->post('type');
        $user_id = $this->input->post('user_id');
        $data = $this->input->post('data_value');
        $dataget = array('course_id' => $id, 'parent' => 0, 'exam_id' => 0);
        $course_data = $this->Course_model->data_gets('chapter', $dataget, '', 'position', 'asc');
        for ($i = 0;$i < count($data);$i++){
            if($data[$i] != ""){
                $dataget = array('user_id' => $user_id, 'page_type' => $type, 'course_id' => $id, 'chapter_id' => $course_data[$i]->id);
                $ass_data = $this->Course_model->data_gets('course_assessment', $dataget);
                if(count($ass_data) == 0){
                    $dataget['assessment'] = $data[$i];
                    $this->Course_model->data_insert('course_assessment', $dataget);
                }else{
                    $this->Course_model->data_updates('course_assessment', array('assessment' => $data[$i]), $dataget);
                }
            }
        }
        $this->response(true);
    }
    
    public function detail_course($row_id = 0){
        if($this->isMasterAdmin()){
            $page_path = "admin/demand/detail_course";
            $course = $this->Course_model->select($row_id);
            $this->global['libraries'] = $this->Course_model->getLibrary($row_id);
            $this->global['course_name'] = $course->title;
            $this->global['course_id'] = $row_id;
            $this->load->view($page_path, $this->global);
        }else{
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function insert_library(){
        $row_id = $this->input->post('course_id');
        $chapter_id = $this->input->post('chapter_id');
        $library_id = $this->input->post('library_id');
        $this->Course_model->update_chapter_library($library_id, $chapter_id);
        return;
    }
    
    public function save_course_setting(){
        $create_id = $_SESSION['company_id'];
        $course_data['id'] = $this->input->post('id');
        $course_data['time_type'] = $this->input->post('time_type');
        $course_data['limit_time'] = $this->input->post('limit_time');
        $course_data['pay_type'] = $this->input->post('pay_type');
        $course_data['pay_price'] = $this->input->post('pay_price');
        $course_data['show_user'] = $this->input->post('show_user');
        $course_data['pass_mark'] = $this->input->post('pass_mark');
        $course_data['number_of_participants'] = $this->input->post('number_of_participants');
        $course_data['assesment_end_course_date'] = date('Y-m-d', strtotime($this->input->post('assesment_end_course_date')));
        if($this->input->post('is_ass_end') == 'on'){
            $course_data['is_ass_end'] = 1;
        }else{
            $course_data['is_ass_end'] = 0;
        }
        $course_data['instructors'] = json_encode($this->input->post('instructor[]'));
        //$course_data['enroll_users'] = json_encode($this->input->post('user[]'));
        $course_data['create_id'] = $create_id;
        if($course_data['id'] == 0){
			$course_data['active'] = 0;	
			$row_id = $this->Course_model->insert_course($course_data);
		}else{
			$courseData = $this->Course_model->select($course_data['id']);
			if(empty($courseData->title)){
				$course_data['active'] = 0;	
			}
            $this->Course_model->update_course($course_data, $course_data['id']);
            $row_id = $course_data['id'];
        }
        $this->response($row_id);
    }
    
    public function save_course_profile(){
		$countryName = $this->Location_model->getCountryNameById($this->input->post('country'));
		$stateName = $this->Location_model->getStateNameById($this->input->post('state'));
		$cityName = $this->Location_model->getCityNameById($this->input->post('city'));
        $price = $_GET['price'];
        $course_data['id'] = $this->input->post('id');
        $course_data['title'] = $this->input->post('title');
        $course_data['subtitle'] = $this->input->post('subtitle');
        $course_data['category_id'] = $this->input->post('category_id');
        $course_data['standard_id'] = implode(',',$this->input->post('standard_id'));
        $course_data['about'] = $this->input->post('about');
		$course_data['prerequisite'] = $this->input->post('prerequisite');	
		$course_data['course_self_time'] = $this->input->post('course_self_time');
		$course_data['learning_objective'] = $this->input->post('learning_objective');
		$course_data['attend'] = $this->input->post('attend');
		$course_data['agenda'] = $this->input->post('agenda');
		$course_data['duration'] = $this->input->post('duration');			
		if($this->input->post('course_type') == 0){
			$course_data['address'] = $this->input->post('address');
			$course_data['country'] = $this->input->post('country');
			$course_data['state'] = $this->input->post('state');
			$course_data['city'] = $this->input->post('city');
			$course_data['location'] = $this->input->post('address').', '.$countryName.', '.$stateName.', '.$cityName;	
		}else{
			$course_data['location'] = 'Online';
			$course_data['address'] = NULL;
			$course_data['country'] = 0;
			$course_data['state'] = 0;
			$course_data['city'] = 0;
		}		
        $course_data['start_at'] = $this->input->post('start_at');
		$course_data['end_at'] = $this->input->post('end_at');
        $course_data['course_type'] = $this->input->post('course_type');
		$newstring = preg_replace('~[^A-Za-z0-9 ?.!]~','',$this->input->post('number'));
		$return = '';
		foreach(explode(' ', $newstring) as $word){
			$return .= strtoupper($word[0]);
		}
		$course_data['number'] = $return.'_'.$course_data['id'];
        if($this->input->post('status') == 'on'){
            $course_data['active'] = 1;
        }else{
            $course_data['active'] = 2;
        }
        $highlight = $this->input->post('highlight[]');
		$prerequisitehighlight = $this->input->post('prerequisitehighlight[]');
        if($_FILES['image_path']['name'] != ""){
            /*random upload filename*/
            $_FILES['image_path']['name'] = microtime(true) . '.' . pathInfo($_FILES['image_path']['name'], PATHINFO_EXTENSION);
            $course_data['img_path'] = COURSE_FILE_PATH . $_FILES['image_path']["name"];
        }
        $this->Course_model->update_course($course_data, $course_data['id']);
        $this->Course_model->delete_highlight($course_data['id']);
		$this->Course_model->delete_prerequisite_highlight($course_data['id']);
        if($_FILES['image_path']['name'] != ""){
            $upload_path = sprintf('%scompany/course/', PATH_UPLOAD);
            if(!file_exists($upload_path)){
                $this->makeDirectory($upload_path);
            }
            $_FILES['image_path']['name'] = sprintf('%s', $_FILES['image_path']['name']);
            $_FILES['image_path']['type'] = $_FILES['image_path']['type'];
            $_FILES['image_path']['tmp_name'] = $_FILES['image_path']['tmp_name'];
            $_FILES['image_path']['size'] = $_FILES['image_path']['size'];
            $_FILES['image_path']['error'] = $_FILES['image_path']['error'];
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = '*';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if(!$this->upload->do_upload('image_path')){
                $error = array('error' => $this->upload->display_errors());
            }else{
                $data = array('upload_data' => $this->upload->data());
            }
        }
		for ($i = 0;$i < count($highlight);$i++){
            $this->Course_model->insert_highlight(array("course_id" => $course_data['id'], "content" => $highlight[$i]));
        }
        for($i = 0;$i < count($prerequisitehighlight);$i++){
            $this->Course_model->insert_prerequisite_highlight(array("course_id" => $course_data['id'], "content" => $prerequisitehighlight[$i]));
        }
        // Add Course Detail To WooCommerce Store
        // $courseData = array('name' => $course_data['title'], 'type' => 'simple', 'regular_price' => $price, 'description' => $course_data['about'], 'short_description' => $course_data['about'], 'categories' => [['id' => 35]], 'images' => [['src' => 'https://shop.gosmartacademy.com/wp-content/uploads/2020/06/course.png']]);
        // $ccResult = $this->woocommerce->post('products', $courseData);
        redirect('admin/demand/getList?course_type=2');
    }
    
    public function edit_course_tab($row_id = 0, $tab_id = 1){
        $this->global['edit_course'] = "1";
        $this->global['tab_active_id'] = $tab_id;
        $this->load->library('Sidebar');
        if($this->isMasterAdmin()){
            $lang_ar = $this->Translate_model->getLanguageList(array('active_flag' => 1, 'add_flag' => 1));
            $page_data['lang_ar'] = $lang_ar['data'];
            $page_path = "admin/demand/course_edit";
            if($row_id != 0){
                $course = $this->Course_model->select($row_id);
                $this->global['libraries'] = $this->Course_model->getLibrary($row_id);
                $this->global['course_name'] = $course->title;
                $this->global['course_id'] = $row_id;
                $this->global['active_id'] = 0;
                if($course->category_id == null || $course->category_id == 0) $this->global['category_id'] = 1;
                else $this->global['category_id'] = $course->category_id;
                $course_data = $this->Course_model->getCourseById($row_id);
                $this->global['highlight'] = $this->Course_model->getHighlightByCourse($row_id);
				$this->global['prerequisitehighlight'] = $this->Course_model->getPreRequisiteHighlightByCourse($row_id);
            }else{
                $course_data['id'] = 0;
                $course_data['time_type'] = 0;
                $course_data['limit_time'] = 0;
                $course_data['pay_type'] = 0;
                $course_data['pay_price'] = 0;
                $course_data['show_user'] = 0;
                $course_data['instructors'] = "";
                //$course_data['enroll_users'] = "";
                $course_data['title'] = "";
                $course_data['subtitle'] = "";
                $course_data['about'] = "";
                $course_data['location'] = "";
                $course_data['start_at'] = date("Y-m-d");
				$course_data['end_at'] = date("Y-m-d");
                $course_data['number'] = 0;
                $course_data['category_id'] = 1;
                $this->global['highlight'] = array();
				$this->global['prerequisitehighlight'] = array();
            }
            $this->global['course_data'] = $course_data;
            $this->global['exam_data'] = $this->Exam_model->getExamListByCompanyID($this->session->get_userdata() ['company_id']);
            $this->global['chapter_data'] = $this->Course_model->getChapterByCourseID($row_id);
            $this->global['quiz_data'] = $this->Exam_model->getQuizGroupListByCompanyID($this->session->get_userdata() ['company_id']);
            $this->global['category'] = $this->Category_model->getListByCompanyID($this->session->get_userdata() ['company_id']);
			$this->global['countries'] = $this->Location_model->getAllCounties();
			$this->global['states'] = $this->Location_model->getStateByCountryId($course->country);
			$this->global['cities'] = $this->Location_model->getCityByStateId($course->state);
            $this->loadViews($page_path, $this->global, NULL, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function edit_course($row_id = 0){
        if($this->isMasterAdmin()){
            $this->global['edit_course'] = "1";
            $this->global['tab_active_id'] = 1;
            $this->load->library('Sidebar');
            $lang_ar = $this->Translate_model->getLanguageList(array('active_flag' => 1, 'add_flag' => 1));
            $page_data['lang_ar'] = $lang_ar['data'];
            $page_path = "admin/demand/course_edit";
            if($row_id != 0){
                $course = $this->Course_model->select($row_id);
                $this->global['libraries'] = $this->Course_model->getLibrary($row_id);
                $this->global['course_name'] = $course->title;
                $this->global['course_id'] = $row_id;
                if($course->category_id == null || $course->category_id == 0) $this->global['category_id'] = 1;
                else $this->global['category_id'] = $course->category_id;
                $this->global['active_id'] = 0;
                $course_data = $this->Course_model->getCourseById($row_id);
                $this->global['highlight'] = $this->Course_model->getHighlightByCourse($row_id);
				$this->global['prerequisitehighlight'] = $this->Course_model->getPreRequisiteHighlightByCourse($row_id);
            }else{
                $this->global['active_id'] = 0;
                $course_data['id'] = 0;
                $course_data['time_type'] = 0;
                $course_data['limit_time'] = 0;
                $course_data['pay_type'] = 0;
                $course_data['pay_price'] = 0;
                $course_data['show_user'] = 0;
                $course_data['pass_mark'] = 0;
                $course_data['is_ass_end'] = 0;
                $course_data['instructors'] = "";
                //$course_data['enroll_users'] = "";
                $course_data['title'] = "";
				$course_data['address'] = "";
				$course_data['country'] = 0;
				$course_data['city'] = 0;
				$course_data['state'] = 0;
                $course_data['subtitle'] = "";
                $course_data['about'] = "";
                $course_data['location'] = "";
                $course_data['start_at'] = date("Y-m-d");
				$course_data['end_at'] = date("Y-m-d");
                $course_data['number'] = 0;
                $course_data['category_id'] = 1;
                $this->global['highlight'] = array();
				$this->global['prerequisitehighlight'] = array();
            }
            $this->global['course_data'] = $course_data;
            $this->global['location_data'] = $this->Location_model->getTrainingCourseLocationList();
			$this->global['countries'] = $this->Location_model->getAllCounties();
			$this->global['states'] = $this->Location_model->getStateByCountryId($course->country);
			$this->global['cities'] = $this->Location_model->getCityByStateId($course->state);
            $this->global['category'] = $this->Category_model->getListByCompanyID($this->session->get_userdata() ['company_id']);
			$this->global['category_standard_list'] = $this->Category_model->getListByCategoryID($course->category_id);
            $this->global['chapter_data'] = $this->Course_model->getChapterByCourseID($row_id);
            $this->global['quiz_data'] = $this->Exam_model->getQuizGroupListByCompanyID($this->session->get_userdata() ['company_id']);
            $this->global['exam_data'] = $this->Exam_model->getExamListByCompanyID($this->session->get_userdata() ['company_id']);
            $this->loadViews($page_path, $this->global, NULL, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
		
	function getStateById($countryID=NULL){
		$countryID = $_REQUEST['country'];
		$country = $this->Location_model->getStateByCountryId($countryID);
		$setData = array();
		if(!empty($country)){
			foreach($country as $key => $row){
				$setData[$key]['id'] = $row['id'];
				$setData[$key]['name'] = ucwords($row['name']);
			}
		}
		echo json_encode($setData);
	}
	
	function getCityById($cityID=NULL){
		$cityID = $_REQUEST['state'];
		$city = $this->Location_model->getCityByStateId($cityID);
		$setData = array();
		if(!empty($city)){
			foreach($city as $key => $row){
				$setData[$key]['id'] = $row['id'];
				$setData[$key]['name'] = ucwords($row['name']);
			}
		}
		echo json_encode($setData);
	}
		
    /////////////////////////////////////////////////////////////////////////////////////////////////
    public function view_chapter_and_page(){
        $dataHtml = "";
        $dataget = array('course_id' => $this->input->post('course_id'), 'parent' => 0);
        $results = $this->Course_model->data_gets('chapter', $dataget, '', 'position', 'ASC');
        // echo "<pre>";
        //     print_r($results);
        // exit;
        //count($results);
        //exit();
        if($results && $this->input->post('course_id') > 0){
            $dataHtml.= '<div>
              <ul class="my-sortable list-group">';
            foreach ($results as $val){
                if($val->exam_id == 0){
					$chstatus = 'Deactivate';
					if($val->status == 0){$chstatus = 'Activate';}
                    $dataHtml.= '<li class="list-group-item items" data-id="0" data-cid="' . $val->id . '"  data-status="' . $chstatus . '" style="margin-bottom: 15px; "><img src="' . base_url() . 'assets/img/chapter.png" style="height:22px; width:33px"><b>' . $val->title . '</b>';
                    $dataHtml.= $this->view_chapter_pages($val->id);
                    $dataHtml.= '</li>';
                }
            }
            foreach ($results as $val){
                if($val->exam_id != 0){
					$chstatus = 'Deactivate';
					if($val->status == 0){$chstatus = 'Activate';}
                    $dataHtml.= '<li class="list-group-item items" data-id="0" data-cid="' . $val->id . '" data-status="' . $chstatus . '" style="margin-bottom: 15px; background-color:#ed9c28;"><img src="' . base_url() . 'assets/img/chapter.png" style="height:22px; width:33px;"><b>' . $val->title . '</b>';
                    $dataHtml.= '</li>';
                }
            }
            $dataHtml.= '  </ul>
            </div>
            <br />';
        }else{
            $dataHtml.= '<li class="ui-state-default list-group-item">Chapter Empty</li>';
        }
        echo $dataHtml;
    }
    
    public function view_chapter_pages($cid){
        $dataHtml = '';
        $dataHtml.= '<ul class="my-sortable1">';
        $dataget = array('parent' => $cid,);
        $results = $this->Course_model->data_gets('chapter', $dataget, '', 'position', 'ASC');
        if($results){
            foreach ($results as $val){
				$chstatus = 'Deactivate';
				if($val->status == 0){$chstatus = 'Activate';}	
                if($val->quiz_id != 0) $dataHtml.= '<li class="list-group-item items " data-id="' . $val->id . '" data-cid="' . $cid . '"  data-status="' . $chstatus . '" style="background-color:#ff6628;margin: 14px 0px 7px 0px;">' . $val->title . '</li>';
                else $dataHtml.= '<li class="list-group-item items " data-id="' . $val->id . '" data-cid="' . $cid . '" data-status="' . $chstatus . '" style="margin: 14px 0px 7px 0px;">' . $val->title . '</li>';
            }
        }else{
            $dataHtml.= '<li class="list-group-item box_area2" align="center" style="border:none;"></li>';
        }
        $dataHtml.= '</ul>';
        return $dataHtml;
    }
    
    public function create_temp_chapter(){
        $dataget = array('parent' => 0);
        $check = $this->Course_model->data_gets('chapter', $dataget, '1', 'id', 'desc');
        if(!empty($check)){
            $ids = ($check[0]->position) + 1;
            $chapter = $ids + 1;
        }else{
            $chapter = 1;
            $ids = 0;
        }
        $data = array('course_id' => $this->input->post('course_id'), 'parent' => 0, 'title' => 'Chapter ' . $chapter, 'description' => 'Add Text Here', 'position' => $ids,);
        $result = $this->Course_model->data_insert('chapter', $data);
        if($result){
            echo json_encode(array('status' => 'success', 'msg' => 'Chapter created'));
        }else{
            echo json_encode(array('status' => 'error', 'msg' => 'Error'));
        }
    }
    
    public function create_temp_page(){
        $dataget = array('course_id' => $this->input->post('course_id'), 'parent' => 0);
        //$result = $this->Course_model->get_single_row('chapter', $dataget);
        $result = $this->Course_model->data_gets('chapter', $dataget, 1, 'position', 'desc');
        $cid = 1;
        if($result){
            $cid = $result[0]->id;
        }
        $dataget = array('course_id' => $this->input->post('course_id'), 'parent' => $cid);
        $check = $this->Course_model->data_gets('chapter', '', '1', 'position', 'desc');
        if($check){
            $ids = ($check[0]->position) + 1;
            $page = $ids;
        }else{
            $ids = 0;
            $page = 1;
        }
		$typeArray = array('1'=>'Exercise','2'=>'Evening Work','3'=>'Precourse Work','4'=>'Handout','5'=>'Case Study');
        $data = array('course_id' => $this->input->post('course_id'), 'parent' => $cid, 'page_type' => $this->input->post('page_type'), 'title' => $typeArray[$this->input->post('page_type')] .'-'. $page, 'description' => 'Add Text Here', 'position' => $ids,);
        $result = $this->Course_model->data_insert('chapter', $data);
        if($result){
            echo json_encode(array('status' => 'success', 'msg' => 'Pages created',));
        }else{
            echo json_encode(array('status' => 'error', 'msg' => 'Error'));
        }
    }
    
    public function view_chapter(){
        $dataHtml = "";
        $dataget = array('course_id' => $this->input->post('course_id'), 'parent' => 0);
        $results = $this->Course_model->data_gets('chapter', $dataget, '', 'position', 'ASC');
        if($results){
            $sno = 1;
            foreach ($results as $val){
                $sno++;
                $dataHtml.= '<div class="col-sm-12"><input type="radio" name="chapterT" class="cptitle_btn" onclick="chapter_view(' . $val->id . ')" id="' . $val->id . '" data-cid="' . $val->id . '" data-title="' . $val->title . '" data-detail="' . $val->description . '" data-library="' . $val->library_id . '"><span class="cptitile">' . $val->title . '</span>';
                $dataHtml.= $this->view_chapter_all_page($val->id, 1);
                $dataHtml.= '</div>';
            }
        }else{
            //$dataHtml.= '<div class="col-sm-12"><input type="radio" id="cptitle_btn" value="1"><span class="cptitile ctitle">Chapter 1</span></div>';
            
        }
        echo $dataHtml;
    }
    
    public function view_chapter_page(){
        $dataHtml = "";
        $dataget = array('course_id' => $this->input->post('course_id'), 'parent' => 0);
        $results = $this->Course_model->data_gets('chapter', $dataget, '', 'position', 'asc');
        if($results){
            foreach ($results as $val){
                if($val->exam_id != 0) continue;
                $dataHtml.= '<div class="col-sm-12"><input type="radio" name="chapterT" class="cptitle_btn" id="chbtn_' . $val->id . '" onclick="new_page_view(' . $val->id . ')"><span class="cptitile">' . $val->title . '</span>';
                $dataHtml.= $this->view_chapter_all_page($val->id);
                $dataHtml.= '</div>';
            }
        }else{
            $dataHtml.= '<div class="col-sm-12"><input type="checkbox" id="cptitle_btn" value="1"><span class="cptitile ctitle">Chapter Title</span></div>';
        }
        echo $dataHtml;
    }
    
    public function view_exam_page(){
        if($this->isMasterAdmin()){
            $dataget = array('course_id' => $this->input->post('course_id'), 'id' => $this->input->post('page_id'), 'parent' => 0);
            $results = $this->Course_model->data_gets('chapter', $dataget, '', 'position', 'asc');
            $this->response($results[0]);
        }else{
            $this->loadViews("access", $this->global, NULL , NULL); 
        }
    }
    
    public function view_quiz_page(){
        if($this->isMasterAdmin()){
            $dataget = array('course_id' => $this->input->post('course_id'), 'id' => $this->input->post('page_id'), 'parent !=' => 0);
            $results = $this->Course_model->data_gets('chapter', $dataget, '', 'position', 'asc');
            $this->response($results[0]);
        }else{
            $this->loadViews("access", $this->global, NULL , NULL); 
        }
    }
    
    public function view_chapter_all_page($cid, $surl = 0){
        $dataHtml = '';
        $dataget = array('parent' => $cid);
        $results = $this->Course_model->data_gets('chapter', $dataget, '', 'position', 'asc');
        if($results){
            foreach ($results as $val){
                $detail = 'Add txt here';
                if($val->description){
                    $detail = $val->description;
                }
                if($val->quiz_id != 0) continue;
                if($surl > 0){
                    $dataHtml.= '<div class="col-sm-12" style="padding-top: 3%;">
							<input type="radio" name="pagesT" class="cpPage_btn" onclick="page_view(this.id)" id ="' . $val->id . '" data-library="' . $val->library_id . '" data-title="' . $val->title . '" data-cid="' . $cid . '" data-detail="' . $detail . '" ><span class="cptitile" >' . $val->title . '</span>
								<a href="javascript:void(0)" onclick="remove_page(' . $val->id . ', ' . $cid . ')"><img src="' . base_url() . 'assets/img/garbage.png" style="width: 6%; float: right; padding-top: 3%;"></a>
						</div>';
                }else{
                    $dataHtml.= '<div class="col-sm-12" style="padding-top: 3%;">
							<input type="radio" name="pagesT" class="cpPage_btn st_test_' . $val->is_done . '" onclick="page_view(this.id)" data-library="' . $val->library_id . '" id ="' . $val->id . '" data-title="' . $val->title . '" data-cid="' . $cid . '" data-detail="' . $detail . '" ><span class="cptitile">' . $val->title . '</span>

					<a href="javascript:void(0)" onclick="remove_page(' . $val->id . ', ' . $cid . ')"><img src="' . base_url() . 'assets/img/garbage.png" style="width: 6%; float: right; padding-top: 3%;"></a>
						</div>';
                }
            }
        }
        return $dataHtml;
    }
    
    public function create_temp_page_id(){
        $dataget = array('parent !=' => 0);
        $check = $this->Course_model->data_gets('chapter', $dataget, '1', 'id', 'desc');
        $ids = ($check[0]->position) + 1;
        $page = $ids;
		$typeArray = array('1'=>'Exercise','2'=>'Evening Work','3'=>'Precourse Work','4'=>'Handout','5'=>'Case Study');
        $data = array('course_id' => $this->input->post('course_id'), 'parent' => $this->input->post('parent'), 'page_type' => $this->input->post('page_type'), 'title' => $typeArray[$this->input->post('page_type')] .'-'. $page, 'description' => 'Add Text Here', 'position' => $ids,);
        $result = $this->Course_model->data_insert('chapter', $data);
        if($result){
            echo json_encode(array('success' => 'true', 'msg' => 'Pages created'));
        }else{
            echo json_encode(array('success' => 'false', 'msg' => 'Error'));
        }
    }
    
    public function update_chapter_detail(){
        $session_dateTime = $this->input->post('session_dateTime');
        $dataget = array('course_id' => $this->input->post('course_id'), 'is_done' => '0');
        $results = $this->Course_model->data_gets('chapter', $dataget, '', 'id', 'asc');
        if($results){
            foreach ($results as $rval){
                $dategetid = array('id' => $rval->id);
                $dataset = array('is_done' => '1', 'session_dateTime' => $session_dateTime,);
                $result = $this->Course_model->data_updates('chapter', $dataset, $dategetid);
            }
            echo json_encode(array('status' => 'success', 'msg' => 'Chapter Updated'));
        }else{
            echo json_encode(array('status' => 'error', 'msg' => 'Chapter record not founded'));
        }
    }
    
    public function update_page_detail(){
        $dataget = array('course_id' => $this->input->post('course_id'), 'parent !=' => 0, 'is_done' => 0);
        $results = $this->Course_model->data_gets('chapter', $dataget, '', 'id', 'asc');
        if($results){
            foreach ($results as $rval){
                $dataget_1 = array('id' => $rval->id);
                $dataset = array('is_done' => '1');
                $result = $this->Course_model->data_updates('chapter', $dataset, $dataget_1);
            }
            echo json_encode(array('status' => 'success', 'msg' => 'Page Updated'));
        }else{
            echo json_encode(array('status' => 'error', 'msg' => 'Page record not founded'));
        }
    }
    
    public function update_exam_page(){
        $dataget = array('id' => $this->input->post('chapter_id'));
        $dataset = array('title' => $this->input->post('exam_page_title'), 'exam_id' => $this->input->post('exam_id'), 'exam_max_num' => $this->input->post('exam_max_num'));
        $result = $this->Course_model->data_updates('chapter', $dataset, $dataget);
        return $result;
    }
    
    public function update_quiz_page(){
        $dataget_1 = array('id' => $this->input->post('page_id'));
        $dataset = array('title' => $this->input->post('quiz_page_title'), 'quiz_id' => $this->input->post('quiz_id'), 'relative_page_id' => $this->input->post('relative_page_id'), 'attempt_num' => $this->input->post('attempt_num'));
        $result = $this->Course_model->data_updates('chapter', $dataset, $dataget_1);
        return $result;
    }
    
    public function delete_self(){
        $data = array('course_id' => $this->input->post('course_id'), 'is_done' => '0',);
        return $this->Course_model->data_delete('chapter', $data);
    }
    
    public function delete_self_page(){
        $data = array('course_id' => $this->input->post('course_id'), 'is_done' => '0',);
        return $this->Course_model->data_delete('chapter', $data);
    }
    
    public function edit_page($pid){
        if($pid != "" && is_numeric($pid)){
            $this->session->set_userdata('PAGE_ID', $pid);
        }
        echo true;
    }
    
    public function edit_chapter($cid){
        if($cid != "" && is_numeric($cid)){
            $this->session->set_userdata('CHAPTER_ID', $cid);
        }
        echo true;
    }
    
    public function view_chapters($cid = 0){
        if($cid != "" && is_numeric($cid)){
            $this->session->set_userdata('CHAPTER_ID', $cid);
        }
        return true;
    }
    
    public function view_pages($pid){
        if($pid != "" && is_numeric($pid)){
            $this->session->set_userdata('PAGE_ID', $pid);
            $this->session->set_userdata('PAGE_VIEW_OPT', 'ONLY_PAGE_VIEW');
        }
        return true;
    }
    
    public function view_only_chapter_page(){
        $dataHtml = "";
        $dataget = array('course_id' => $this->input->post('course_id'), 'parent' => 0);
        $results = $this->Course_model->data_gets('chapter', $dataget);
        if($results){
            foreach ($results as $val){
                $dataHtml.= '<div class="col-sm-12"><input type="radio" name="chapterT" class="cptitle_btn"   id="chbtn_' . $val->id . '" data-title="' . $val->title . '" data-detail="' . $val->description . '"><span class="cptitile">' . $val->title . '</span>';
                $dataHtml.= $this->view_only_chapter_all_page($val->id);
                $dataHtml.= '</div>';
            }
        }
        echo $dataHtml;
    }
    
    public function view_only_chapter_all_page($cid){
        $dataHtml = '';
        $dataget = array('parent' => $cid);
        $results = $this->Course_model->data_gets('chapter', $dataget);
        if($results){
            foreach ($results as $val){
                $detail = 'Add txt here';
                if($val->description){
                    $detail = $val->description;
                }
                $dataHtml.= '<div class="col-sm-12" style="padding-top: 3%;">
						<input type="radio" name="pagesT" class="cpPage_btn" onclick="page_view_demo_page(this.id)" id ="' . $val->id . '" data-title="' . $val->title . '" data-cid="' . $cid . '" data-detail="' . $detail . '"><span class="cptitile">' . $val->title . '</span></div>';
            }
        }
        return $dataHtml;
    }
    
    public function view_only_chapter_page1(){
        $dataHtml = "";
        $dataget = array('course_id' => $this->input->post('course_id'), 'parent' => 0);
        $results = $this->Course_model->data_gets('chapter', $dataget);
        if($results){
            foreach ($results as $val){
                $dataHtml.= '<div class="col-sm-12"><input type="radio" name="chapterT" class="cptitle_btn"   id="chbtn_' . $val->id . '" data-title="' . $val->title . '" data-detail="' . $val->description . '"><span class="cptitile">' . $val->title . '</span>';
                $dataHtml.= $this->view_only_chapter_all_page1($val->id);
                $dataHtml.= '</div>';
            }
        }
        echo $dataHtml;
    }
    
    public function view_only_chapter_all_page1($cid){
        $dataHtml = '';
        $dataget = array('parent' => $cid);
        $results = $this->Course_model->data_gets('chapter', $dataget);
        if($results){
            foreach ($results as $val){
                $detail = 'Add txt here';
                if($val->description){
                    $detail = $val->description;
                }
                $dataHtml.= '<div class="col-sm-12" style="padding-top: 3%;">
						<input type="radio" name="pagesT" class="cpPage_btn" onclick="page_view_demo_chpater(this.id)" id ="' . $val->id . '" data-title="' . $val->title . '" data-cid="' . $cid . '" data-detail="' . $detail . '"><span class="cptitile">' . $val->title . '</span></div>';
            }
        }
        return $dataHtml;
    }
    
    public function remove_page(){
        if(isset($_POST['activity']) && $_POST['activity'] == 'remove_page'){
            if($_POST['pid'] == ""){
                $data = array('status' => 'error', 'msg' => 'Sorry! Select Any Page option.');
                echo json_encode($data);
                exit();
            }else if($_POST['pid'] == 0){
                $data = array('status' => 'error', 'msg' => 'Sorry! Select Any Page .');
                echo json_encode($data);
                exit();
            }else{
                $dataget = array('course_id' => $this->input->post('course_id'), 'parent' => $_POST['cid']);
                $results = $this->Course_model->data_gets('chapter', $dataget, '', 'position', 'asc');
                if($results){
                    $active = 0;
                    foreach ($results as $value){
                        $pageid = $value->id;
                        if($pageid == $_POST['pid']){
                            $active = 1;
                            continue;
                        }
                        if($active == 1){
                            $dataset = array('position' => $value->position - 1);
                            $dataget = array('id' => $value->id);
                            $result1 = $this->Course_model->data_updates('chapter', $dataset, $dataget);
                        }
                    }
                }
                $dataget = array('id' => $_POST['pid']);
                $result = $this->Course_model->data_delete('chapter', $dataget);
                if($result){
                    $data = array('status' => 'success', 'msg' => 'Successfully! Done',);
                    echo json_encode($data);
                    exit();
                }else{
                    $data = array('status' => 'error', 'msg' => 'Sorry! Technical Error');
                    echo json_encode($data);
                    exit();
                }
            }
        }else{
            $data = array('status' => 'error', 'msg' => 'Sorry! Unauthorizes activity.');
            echo json_encode($data);
            exit();
        }
    }
    
    public function remove_chapter(){
        if(isset($_POST['activity']) && $_POST['activity'] == 'remove_chapter'){
            if($_POST['cid'] == ""){
                $data = array('status' => 'error', 'msg' => 'Sorry! Select Any Chapter Option.');
                echo json_encode($data);
                exit();
            }else if($_POST['cid'] == 0){
                $data = array('status' => 'error', 'msg' => 'Sorry! Select Any Chapter Option .');
                echo json_encode($data);
                exit();
            }else{
                $dataget = array('course_id' => $this->input->post('course_id'), 'parent' => 0);
                $results = $this->Course_model->data_gets('chapter', $dataget, '', 'position', 'asc');
                if($results){
                    $active = 0;
                    foreach ($results as $value){
                        $chapterid = $value->id;
                        if($chapterid == $_POST['cid']){
                            $active = 1;
                            continue;
                        }
                        if($active == 1){
                            $dataset = array('position' => $value->position - 1);
                            $dataget = array('id' => $value->id);
                            $result1 = $this->Course_model->data_updates('chapter', $dataset, $dataget);
                        }
                    }
                }
                $dataget = array('id' => $_POST['cid']);
                $result = $this->Course_model->data_delete('chapter', $dataget);
                if($result){
                    $dataget = array('parent' => $_POST['cid']);
                    $results = $this->Course_model->data_gets('chapter', $dataget);
                    if($results){
                        foreach ($results as $val){
                            $dataget1 = array('id' => $val->id);
                            $result = $this->Course_model->data_delete('chapter', $dataget1);
                        }
                    }
                    $data = array('status' => 'success', 'msg' => 'Successfully! Done',);
                    echo json_encode($data);
                    exit();
                }else{
                    $data = array('status' => 'error', 'msg' => 'Sorry! Technical Error');
                    echo json_encode($data);
                    exit();
                }
            }
        }else{
            $data = array('status' => 'error', 'msg' => 'Sorry! Unauthorizes activity.');
            echo json_encode($data);
            exit();
        }
    }
    
    public function save_exam_page(){
        $course_id = $this->input->post('course_id');
        $exam_id = $this->input->post('exam_id');
        $exam_page_title = $this->input->post('exam_page_title');
        $data = array('course_id' => $course_id, 'parent' => 0, 'title' => $exam_page_title, 'description' => 'This is Exam Page.', 'position' => 0, 'is_done' => '1', 'exam_max_num' => $this->input->post('exam_max_num'), 'exam_id' => $exam_id);
        $result = $this->Course_model->data_insert('chapter', $data);
        return $result;
    }
    
    public function save_quiz_page(){
        $chapter_id = $this->input->post('chapter_id');
        $course_id = $this->input->post('course_id');
        $quiz_id = $this->input->post('quiz_id');
        $quiz_page_title = $this->input->post('quiz_page_title');
        $relative_page_id = $this->input->post('relative_page_id');
        $dataget = array('course_id' => $this->input->post('course_id'), 'parent' => 0);
        $result = $this->Course_model->data_gets('chapter', $dataget, 1, 'position', 'desc');
        $cid = 1;
        if($chapter_id == null){
            if($result){
                $cid = $result[0]->id;
            }
        }else{
            $cid = $chapter_id;
        }
        $check = $this->Course_model->data_gets('chapter', '', '1', 'position', 'desc');
        if($check){
            $ids = ($check[0]->position) + 1;
            $page = $ids;
        }else{
            $ids = 0;
            $page = 1;
        }
        $data = array('course_id' => $this->input->post('course_id'), 'parent' => $cid, 'title' => $quiz_page_title, 'description' => 'This is Quiz Page.', 'position' => $ids, 'is_done' => '1', 'quiz_id' => $quiz_id, 'relative_page_id' => $relative_page_id, 'attempt_num' => $this->input->post('attempt_num'));
        $result = $this->Course_model->data_insert('chapter', $data);
        return true;
    }
    
    public function save_chapter(){
        if(isset($_POST['activity']) && $_POST['activity'] == 'add_chapter'){
            if($_POST['title'] == ''){
                $data = array('status' => 'error', 'msg' => 'Sorry! Chapter Title not found.');
                echo json_encode($data);
                exit();
            }else{
                if($_POST['cid'] > 0 || $_POST['pre_title'] != ""){
                    if($_POST['cid'] > 0){
                        $dataget = array('id' => $_POST['cid'],);
                    }else{
                        $dataget = array('title' => $_POST['pre_title'],);
                    }
                    $dataset = array('title' => $_POST['title'],);
                    $result = $this->Course_model->data_updates('chapter', $dataset, $dataget);
                    if($result){
                        $data = array('status' => 'success', 'msg' => 'Successfully! Done .', 'response' => $_POST['title']);
                        echo json_encode($data);
                        exit();
                    }else{
                        $data = array('status' => 'error', 'msg' => 'Sorry! Technical Error');
                        echo json_encode($data);
                        exit();
                    }
                }else{
                    $dataget = array('course_id' => $this->input->post('course_id'), 'parent' => 0);
                    $position = 0;
                    $result = $this->Course_model->data_gets('chapter', $dataget, '1', 'position', 'desc');
                    if($result){
                        $position = $result[0]->position;
                        $position++;
                    }
                    $dataset = array('course_id' => $this->input->post('course_id'), 'title' => $_POST['title'], 'position' => $position,);
                    $result1 = $this->Course_model->data_insert('chapter', $dataset);
                    if($result1){
                        $data = array('status' => 'success', 'msg' => 'Successfully! Done .', 'response' => $_POST['title']);
                        echo json_encode($data);
                        exit();
                    }else{
                        $data = array('status' => 'error', 'msg' => 'Sorry! Technical Error');
                        echo json_encode($data);
                        exit();
                    }
                }
            }
        }else{
            $data = array('status' => 'error', 'msg' => 'Sorry! Unauthorizes activity.');
            echo json_encode($data);
            exit();
        }
    }
    
    public function single_view_chapter(){
        $dataHtml = "";
        if(isset($_POST['cid'])){
            $dataget = array('id' => $_POST['cid'],);
            $detail = 'Add txt here';
            $result = $this->Course_model->get_single_row('chapter', $dataget);
            if($result){
                if($result->description != ""){
                    $detail = $result->description;
                }
                $data = array('chapter_id' => $result->id, 'title' => $result->title, 'description' => $detail);
                echo json_encode($data);
                exit();
            }else{
                $data = array('chapter_id' => 0, 'title' => 'Chapter Title', 'description' => $detail);
                echo json_encode($data);
                exit();
            }
        }
    }
    
    public function save_chapter_detail(){
        if(isset($_POST['activity']) && $_POST['activity'] == 'add_chapter_detail'){
            if($_POST['description'] == ''){
                $data = array('status' => 'error', 'msg' => 'Sorry! Chapter Detail not found.');
                echo json_encode($data);
                exit();
            }else{
                if($_POST['cid'] > 0){
                    $dataget = array('id' => $_POST['cid'],);
                    $dataset = array('description' => $_POST['description'],);
                    $result = $this->Course_model->data_updates('chapter', $dataset, $dataget);
                    if($result){
                        $data = array('status' => 'success', 'msg' => 'Successfully! Done',);
                        echo json_encode($data);
                        exit();
                    }else{
                        $data = array('status' => 'error', 'msg' => 'Sorry! Technical Error');
                        echo json_encode($data);
                        exit();
                    }
                }else{
                    $data = array('status' => 'error', 'msg' => 'Sorry! Add Chapter Title.');
                    echo json_encode($data);
                    exit();
                }
            }
        }else{
            $data = array('status' => 'error', 'msg' => 'Sorry! Unauthorizes activity.');
            echo json_encode($data);
            exit();
        }
    }
    
    public function save_page(){
        if(isset($_POST['activity']) && $_POST['activity'] == 'add_page'){
            if($_POST['page_title'] == ''){
                $data = array('status' => 'error', 'msg' => 'Sorry! Chapter Detail not found.');
                echo json_encode($data);
                exit();
            }else if($_POST['cid'] == 0){
                $data = array('status' => 'error', 'msg' => 'Sorry! Select Any Chapter option.');
                echo json_encode($data);
                exit();
            }else if($_POST['pid'] == ""){
                $data = array('status' => 'error', 'msg' => 'Sorry! Select Any Page option.');
                echo json_encode($data);
                exit();
            }else{
                if($_POST['pid'] > 0){
                    $dataget = array('id' => $_POST['pid']);
                    $dataset = array('parent' => $_POST['cid'], 'course_id' => $this->input->post('course_id'), 'title' => $_POST['page_title']);
                    $result = $this->Course_model->data_updates('chapter', $dataset, $dataget);
                    if($result){
                        $data = array('status' => 'success', 'msg' => 'Successfully! Done', 'response' => $_POST['page_title']);
                        echo json_encode($data);
                        exit();
                    }else{
                        $data = array('status' => 'error', 'msg' => 'Sorry! Technical Error');
                        echo json_encode($data);
                        exit();
                    }
                }else{
                    $dataget = array('course_id' => $this->input->post('course_id'), 'parent' => $_POST['cid']);
                    $position = 0;
                    $result = $this->Course_model->data_gets('chapter', $dataget, '1', 'position', 'desc');
                    if($result){
                        $position = $result[0]->position;
                        $position++;
                    }
                    $dataset = array('parent' => $_POST['cid'], 'course_id' => $this->input->post('course_id'), 'title' => $_POST['page_title'], 'position' => $position,);
                    $result = $this->Course_model->data_insert('chapter', $dataset);
                    if($result){
                        $data = array('status' => 'success', 'msg' => 'Successfully! Done .', 'response' => $_POST['page_title']);
                        echo json_encode($data);
                        exit();
                    }else{
                        $data = array('status' => 'error', 'msg' => 'Sorry! Technical Error');
                        echo json_encode($data);
                        exit();
                    }
                }
            }
        }else{
            $data = array('status' => 'error', 'msg' => 'Sorry! Unauthorizes activity.');
            echo json_encode($data);
            exit();
        }
    }
    
    public function save_page_detail(){
        if(isset($_POST['activity']) && $_POST['activity'] == 'add_page_detail'){
            if($_POST['description'] == ''){
                $data = array('status' => 'error', 'msg' => 'Sorry! Page Detail not found.');
                echo json_encode($data);
                exit();
            }else if($_POST['cid'] == 0){
                $data = array('status' => 'error', 'msg' => 'Sorry! Select Any Chapter option.');
                echo json_encode($data);
                exit();
            }else if($_POST['pid'] == ""){
                $data = array('status' => 'error', 'msg' => 'Sorry! Select Any Page option.');
                echo json_encode($data);
                exit();
            }else if($_POST['pid'] == 0){
                $data = array('status' => 'error', 'msg' => 'Sorry! Add Page Title First.');
                echo json_encode($data);
                exit();
            }else{
                $dataset = array('description' => $_POST['description']);
                $dataget = array('id' => $_POST['pid'], 'parent' => $_POST['cid']);
                $result = $this->Course_model->data_updates('chapter', $dataset, $dataget);
                if($result){
                    $data = array('status' => 'success', 'msg' => 'Successfully! Done',);
                    echo json_encode($data);
                    exit();
                }else{
                    $data = array('status' => 'error', 'msg' => 'Sorry! Technical Error');
                    echo json_encode($data);
                    exit();
                }
            }
        }else{
            $data = array('status' => 'error', 'msg' => 'Sorry! Unauthorizes activity.');
            echo json_encode($data);
            exit();
        }
    }
    
    public function copied_page(){
        //copied_page
        if(isset($_POST['activity']) && $_POST['activity'] == 'copied_page'){
            if($_POST['pid'] == ""){
                $data = array('status' => 'error', 'msg' => 'Sorry! Page Not Found.');
                echo json_encode($data);
                exit();
            }else if($_POST['pid'] == 0){
                $data = array('status' => 'error', 'msg' => 'Sorry! Page Not Found.');
                echo json_encode($data);
                exit();
            }else{
                $dataget = array('id' => $_POST['pid']);
                $result = $this->Course_model->get_single_row('chapter', $dataget);
                if($result){
                    $detail = '';
                    if($result->description != ""){
                        $detail = $result->description;
                    }
                    $dataget1 = array('parent' => $result->chapter_id,);
                    $position = 0;
                    $result1 = $this->Course_model->data_gets('chapter', $dataget1, '1', 'position', 'desc');
                    if($result1){
                        $position = $result1[0]->position;
                        $position++;
                    }
                    $dataset = array('course_id' => $result->course_id, 'parent' => $result->chapter_id, 'title' => $result->title . '_copied', 'description' => $detail, 'position' => $position, 'is_done' => '1');
                    $result1 = $this->Course_model->data_insert('chapter', $dataset);
                    if($result1){
                        $data = array('status' => 'success', 'msg' => 'Successfully! Done',);
                        echo json_encode($data);
                        exit();
                    }else{
                        $data = array('status' => 'error', 'msg' => 'Sorry! Technical Error');
                        echo json_encode($data);
                        exit();
                    }
                }else{
                    $data = array('status' => 'error', 'msg' => 'Sorry! Page Record Not Found.');
                    echo json_encode($data);
                    exit();
                }
            }
        }else{
            $data = array('status' => 'error', 'msg' => 'Sorry! Unauthorizes activity.');
            echo json_encode($data);
            exit();
        }
    }
    
    public function copied_chapter(){
        //copied_page
        if(isset($_POST['activity']) && $_POST['activity'] == 'copied_chapter'){
            if($_POST['cid'] == ""){
                $data = array('status' => 'error', 'msg' => 'Sorry! Chapter Not Found.');
                echo json_encode($data);
                exit();
            }else if($_POST['cid'] == 0){
                $data = array('status' => 'error', 'msg' => 'Sorry! Chapter Not Found.');
                echo json_encode($data);
                exit();
            }else{
                $dataget = array('id' => $_POST['cid']);
                $result = $this->Course_model->get_single_row('chapter', $dataget);
                if($result){
                    $detail = 'Add txt here';
                    if($result->description != ""){
                        $detail = $result->description;
                    }
                    $position = 0;
                    $results = $this->Course_model->data_gets('chapter', $dataget, '1', 'position', 'desc');
                    if($results){
                        $position = $results[0]->position;
                    }
                    $dataset = array('course_id' => $result->course_id, 'title' => $result->title . '_copied', 'description' => $detail, 'position' => $position, 'is_done' => '1');
                    $result1 = $this->Course_model->data_insert('chapter', $dataset);
                    if($result1){
                        $dataget1 = array('title' => $result->title . '_copied', 'course_id' => $result->course_id);
                        $result2 = $this->Course_model->get_single_row('chapter', $dataget1);
                        if($result2){
                            $newcid = $result2->id;
                            $dataget2 = array('parent' => $_POST['cid']);
                            $results = $this->Course_model->data_gets('chapter', $dataget2);
                            if($results){
                                $detail = 'Add txt here';
                                foreach ($results as $val){
                                    if($val->description != ""){
                                        $detail = $val->description;
                                    }
                                    $dataset2 = array('course_id' => $val->course_id, 'parent' => $newcid, 'title' => $val->title, 'description' => $detail, 'is_done' => '1');
                                    $result2 = $this->Course_model->data_insert('chapter', $dataset2);
                                }
                            }
                        }
                        $data = array('status' => 'success', 'msg' => 'Successfully! Done',);
                        echo json_encode($data);
                        exit();
                    }else{
                        $data = array('status' => 'error', 'msg' => 'Sorry! Technical Error');
                        echo json_encode($data);
                        exit();
                    }
                }else{
                    $data = array('status' => 'error', 'msg' => 'Sorry! Chapter Record Not Found.');
                    echo json_encode($data);
                    exit();
                }
            }
        }else{
            $data = array('status' => 'error', 'msg' => 'Sorry! Unauthorizes activity.');
            echo json_encode($data);
            exit();
        }
    }
    
    public function page_moved(){
        if(isset($_POST['activity']) && $_POST['activity'] == 'page_moved'){
            if($_POST['cid'] == "" || $_POST['cid'] == 0){
                $data = array('status' => 'error', 'msg' => 'Sorry! Chapter Not Found');
                echo json_encode($data);
                exit();
            }else if($_POST['pid'] == "" || $_POST['pid'] == 0){
                $data = array('status' => 'error', 'msg' => 'Sorry! Page Not Found.');
                echo json_encode($data);
                exit();
            }else{
                $pid = $_POST['pid'];
                $cid = $_POST['cid'];
                $startpos = $_POST['startpos'];
                $newpos = $_POST['newpos'];
                if($newpos > $startpos){
                    // -1
                    $dataget = array('course_id' => $this->input->post('course_id'), 'parent' => $_POST['cid']);
                    $databtw = array('column' => 'position', 'from' => $startpos + 1, 'to' => $newpos,);
                    $results = $this->Course_model->data_gets_between('chapter', $dataget, $databtw);
                    if($results){
                        foreach ($results as $val){
                            $dataset = array('position' => $val->position - 1);
                            $dataget = array('id' => $val->id);
                            $result = $this->Course_model->data_updates('chapter', $dataset, $dataget);
                        }
                    }
                    $dataget = array('id' => $pid);
                    $dataset = array('position' => $newpos);
                    $result = $this->Course_model->data_updates('chapter', $dataset, $dataget);
                }else{
                    // +1
                    $dataget = array('course_id' => $this->input->post('course_id'), 'parent' => $_POST['cid']);
                    $databtw = array('column' => 'position', 'from' => $newpos, 'to' => $startpos - 1,);
                    $results = $this->Course_model->data_gets_between('chapter', $dataget, $databtw);
                    if($results){
                        foreach ($results as $val){
                            $dataset = array('position' => $val->position + 1);
                            $dataget = array('id' => $val->id);
                            $result = $this->Course_model->data_updates('chapter', $dataset, $dataget);
                        }
                    }
                    $dataget = array('id' => $pid);
                    $dataset = array('position' => $newpos);
                    $result = $this->Course_model->data_updates('chapter', $dataset, $dataget);
                    $data = array('status' => 'success', 'msg' => 'Success! Moved Successfully.');
                    echo json_encode($data);
                    exit();
                }
            }
        }else{
            $data = array('status' => 'error', 'msg' => 'Sorry! Unauthorizes activity.');
            echo json_encode($data);
            exit();
        }
    }
    
    public function chapter_moved(){
        if(isset($_POST['activity']) && $_POST['activity'] == 'chapter_moved'){
            if($_POST['cid'] == "" || $_POST['cid'] == 0){
                $data = array('status' => 'error', 'msg' => 'Sorry! Chapter Not Found');
                echo json_encode($data);
                exit();
            }else{
                $cid = $_POST['cid'];
                $startpos = $_POST['startpos'];
                $newpos = $_POST['newpos'];
                if($newpos > $startpos){
                    // -1
                    $dataget = array('course_id' => $this->input->post('course_id'), 'parent' => 0);
                    $databtw = array('column' => 'position', 'from' => $startpos + 1, 'to' => $newpos,);
                    $results = $this->Course_model->data_gets_between('chapter', $dataget, $databtw);
                    if($results){
                        foreach ($results as $val){
                            $dataset = array('position' => $val->position - 1);
                            $dataget = array('id' => $val->id);
                            $result = $this->Course_model->data_updates('chapter', $dataset, $dataget);
                        }
                        $dataget = array('id' => $_POST['cid']);
                        $dataset = array('position' => $newpos);
                        $result = $this->Course_model->data_updates('chapter', $dataset, $dataget);
                    }
                }else{
                    // +1
                    $dataget = array('course_id' => $this->input->post('course_id'), 'parent' => 0);
                    $databtw = array('column' => 'position', 'from' => $newpos, 'to' => $startpos - 1,);
                    $results = $this->Course_model->data_gets_between('chapter', $dataget, $databtw);
                    if($results){
                        foreach ($results as $val){
                            $dataset = array('position' => $val->position + 1);
                            $dataget = array('id' => $val->id);
                            $result = $this->Course_model->data_updates('chapter', $dataset, $dataget);
                        }
                        $dataget = array('id' => $_POST['cid']);
                        $dataset = array('position' => $newpos);
                        $result = $this->Course_model->data_updates('chapter', $dataset, $dataget);
                        $data = array('status' => 'success', 'msg' => 'Success! Moved Successfully.');
                        echo json_encode($data);
                        exit();
                    }else{
                        $data = array('status' => 'error', 'msg' => 'Sorry! Record not found');
                        echo json_encode($data);
                        exit();
                    }
                }
            }
        }else{
            $data = array('status' => 'error', 'msg' => 'Sorry! Unauthorizes activity.');
            echo json_encode($data);
            exit();
        }
    }
    
    public function page_chapter_moved(){
        if(isset($_POST['activity']) && $_POST['activity'] == 'page_moved'){
            if($_POST['cid'] == "" || $_POST['cid'] == 0){
                $data = array('status' => 'error', 'msg' => 'Sorry! Chapter Not Found');
                echo json_encode($data);
                exit();
            }else if($_POST['newcid'] == "" || $_POST['newcid'] == 0){
                $data = array('status' => 'error', 'msg' => 'Sorry! New Chapter Not Found');
                echo json_encode($data);
                exit();
            }else if($_POST['pid'] == "" || $_POST['pid'] == 0){
                $data = array('status' => 'error', 'msg' => 'Sorry! Page Not Found.');
                echo json_encode($data);
                exit();
            }else{
                $pid = $_POST['pid'];
                $newcid = $_POST['newcid'];
                $cid = $_POST['cid'];
                $startpos = $_POST['startpos'];
                $newpos = $_POST['newpos'];
                $dataget = array('course_id' => $this->input->post('course_id'), 'parent' => $cid);
                $results = $this->Course_model->data_gets('chapter', $dataget, '', 'position', 'asc');
                if($results){
                    $active = 0;
                    foreach ($results as $value){
                        $pageid = $value->id;
                        if($pageid == $pid){
                            $active = 1;
                            continue;
                        }
                        if($active == 1){
                            $dataset = array('position' => $value->position - 1);
                            $dataget = array('id' => $value->id);
                            $result1 = $this->Course_model->data_updates('chapter', $dataset, $dataget);
                        }
                    }
                }
                $dataget = array('course_id' => $this->input->post('course_id'), 'parent' => $_POST['newcid']);
                $results = $this->Course_model->data_gets('chapter', $dataget, '', 'position', 'asc');
                if($results){
                    foreach ($results as $val){
                        $position = $val->position;
                        if($position >= $newpos){
                            $dataset = array('position' => $val->position + 1);
                            $dataget = array('id' => $val->id);
                            $result = $this->Course_model->data_updates('chapter', $dataset, $dataget);
                        }
                    }
                }
                $dataget = array('id' => $pid);
                $dataset = array('parent' => $newcid, 'position' => $newpos);
                $result = $this->Course_model->data_updates('chapter', $dataset, $dataget);
                $data = array('status' => 'success', 'msg' => 'Success! Moved Successfully.');
                echo json_encode($data);
                exit();
            }
        }else{
            $data = array('status' => 'error', 'msg' => 'Sorry! Unauthorizes activity.');
            echo json_encode($data);
            exit();
        }
    }
    
    public function page_available(){
        $dataget = array('course_id' => $this->input->post('course_id'), 'parent!=' => 0);
        $results = $this->Course_model->data_gets('chapter', $dataget, null, null, null, null);
        if($results){
            echo json_encode(array('status' => 'success', 'msg' => 'Available'));
        }else{
            echo json_encode(array('status' => 'error', 'msg' => 'No Available'));
        }
    }
    
    public function check_exam_page(){
        $page_id = $this->input->post('page_id');
        $dataget = array('id' => $page_id, 'exam_id !=' => 0, 'parent' => 0);
        $results = $this->Course_model->data_gets('chapter', $dataget);
        $dataget1 = array('id' => $page_id, 'quiz_id !=' => 0, 'parent !=' => 0);
        $results1 = $this->Course_model->data_gets('chapter', $dataget1);
        if($results){
            $this->response('1');
        }else if($results1){
            $this->response('2');
        }else{
            $this->response('0');
        }
    }
	
	public function update_row(){
		$page_id = $this->input->post('page_id');
		$status = $this->Course_model->update_row($page_id);
		$this->response($status);
	}
    
    public function view_course_history(){
        if($this->isMasterAdmin()){
            $this->loadViews("admin/demand/course_history", $this->global, null, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL , NULL); 
        }
    }

    public function view_certificate_history(){
        if($this->isMasterAdmin() || $this->isInstructor()){
            $this->loadViews("admin/demand/certificate_history", $this->global, null, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL , NULL); 
        }
    }
    
    public function getCertificateHistoryList(){
        $company_id = $this->session->get_userdata() ['company_id'];
        $table_data["data"] = $this->Course_model->getCertificateHistoryList($company_id);
        foreach ($table_data["data"] as $key => $row){
            $table_data["data"][$key]["no"] = $key + 1;
            if(count($this->Course_model->getExamId($row['course_id'])) > 0) $table_data["data"][$key]["exam_title"] = $this->Course_model->getExamId($row['course_id']) [0]['title'];
            else $table_data["data"][$key]["exam_title"] = '';
        }
        $records["data"] = $table_data["data"];
        $records['recordsTotal'] = $table_data["total"];
        $records['recordsFiltered'] = $table_data['filtertotal'];
        $this->response($records);
    }
    
    public function getTodayOnlineLearnerOld(){
        $table_data["data"] = $this->Course_model->getTodayOnlineLearner();
        $records["data"] = $table_data["data"];
        $this->response($records);
    }
	
	public function getTodayOnlineLearner($type = NULL){		
        $table_data["data"] = $this->Course_model->getTodayOnlineLearner();
		$user_id = $table_data["data"][0]->id;
		$records["data"] = $recordsvilt["data"] = $recordsilt["data"] = [];
		$myarr["data"] = $myarrvilt["data"] = $myarrilt["data"] = [];
		if($type == 'demand'){
			######################################## Demand Course Assemment #############################################
			$query = "Select * from course where start_at <= '".date("Y-m-d")."' and end_at >= '".date("Y-m-d")."' and active = 1";
			$result = $this->db->query($query);
			$resultCourse = $result->result_array();
			if(count($resultCourse) > 0){
				foreach($resultCourse as $key => $value){			
					$course[$key]['id'] = $value['id'];
					$course[$key]['title'] = $value['title'];
				}		
			}
			$i = 0;
			if(!empty($course)){
				foreach($course as $ckey => $cval){				
					if(!empty($table_data["data"])){					
						foreach($table_data["data"] as $ukey => $user){
							$query = "Select * from payment_history where object_id =  ".$cval['id']." and user_id =  ".$user->id." and object_type = 'course'";
							$result = $this->db->query($query);						
							if(!empty($result->result_array())){
								$records["data"][$i]['id'] = $user->id;
								$records["data"][$i]['first_name'] = $user->first_name;
								$records["data"][$i]['last_name'] = $user->last_name;
								$records["data"][$i]['course_title'] = ucfirst($cval['title']);
								$records["data"][$i]['email'] = $user->email;
								$records["data"][$i]['last_login'] = $user->last_login;
								$records["data"][$i]['course_id'] = $cval['id'];
							}
							$i++;
						}
					}				
				}
			}
			if(!empty($records)){
				$x = 0;		
				foreach($records["data"] as $datakey => $data){
					$myarr["data"][$x]['id'] = $data['id'];
					$myarr["data"][$x]['first_name'] = $data['first_name'];
					$myarr["data"][$x]['last_name'] = $data['last_name'];
					$myarr["data"][$x]['course_title'] = $data['course_title'];
					$myarr["data"][$x]['email'] = $data['email'];
					$myarr["data"][$x]['last_login'] = $data['last_login'];
					$myarr["data"][$x]['course_id'] = $data['course_id'];
					$x++;
				}	
			}			
			$this->response($myarr);
		}
		
		if($type == 'vilt'){
			######################################## VILT Course Assemment #############################################
			$queryvilt = "Select * from virtual_course";
			$resultvilt = $this->db->query($queryvilt);
			$resultCourseVilt = $resultvilt->result_array();
			if(count($resultCourseVilt) > 0){
				foreach($resultCourseVilt as $vkey => $vvalue){			
					$coursevilt[$vkey]['id'] = $vvalue['id'];
					$coursevilt[$vkey]['title'] = $vvalue['title'];
					$coursevilt[$vkey]['course_id'] = $vvalue['course_id'];
					$coursevilt[$vkey]['duration'] = $vvalue['duration'];
				}		
			}
			$i = 0;
			if(!empty($coursevilt)){
				foreach($coursevilt as $cvkey => $cvval){
					if(!empty($table_data["data"])){
						foreach($table_data["data"] as $ukey => $userv){
							if($cvval != ''){
								//$queryvilt = "Select * from virtual_course_time where virtual_course_id = ".$cvval['id']." and start_at >= '".date("Y-m-d h:i:s")."'";
								$queryvilt = "SELECT a.*, b.course_id, c.pay_type FROM virtual_course_time a 
                                            LEFT JOIN virtual_course b ON a.virtual_course_id = b.id 
                                            LEFT JOIN course c ON c.id = b.course_id
                                            WHERE virtual_course_id = ".$cvval['id'];
								$vilttimeres = $this->db->query($queryvilt);
								$timevres = $vilttimeres->result_array();
								if(!empty($timevres)){									
									foreach($timevres as $vckeys => $vctime){
										$durationVilt = $cvval['duration']-1;
										$startDatev = strtotime($vctime['start_at']);
										$currentDate = time();
										if($durationVilt > 0){
											$endDatev = strtotime('+'.$durationVilt.' days', $startDatev);
										}else{
											$currentDate = date("Y-m-d");
											$startDatev = date("Y-m-d",$startDatev);
											$endDatev = $startDatev;
										}										
										
										if($currentDate >= $startDatev && $currentDate <= $endDatev){
                                            if($vctime['pay_type'] == 1){
                                                $queryvirtual = "Select * from payment_history where object_id =  ".$vctime['course_id']." and user_id =  ".$userv->id." and object_type = 'live'";
                                            }else{
                                                $queryvirtual = "Select * from enrollments where course_id =  ".$vctime['course_id']." and user_id =  ".$userv->id;
                                            }
											$resultvirtual = $this->db->query($queryvirtual);
											if(!empty($resultvirtual->result_array())){
												$recordsvilt["data"][$i]['id'] = $userv->id;
												$recordsvilt["data"][$i]['first_name'] = $userv->first_name;
												$recordsvilt["data"][$i]['last_name'] = $userv->last_name;
												$recordsvilt["data"][$i]['course_title'] = ucfirst($cvval['title']);
												$recordsvilt["data"][$i]['email'] = $userv->email;
												$recordsvilt["data"][$i]['last_login'] = $userv->last_login;
												$recordsvilt["data"][$i]['course_id'] = $cvval['course_id'];													
											}
											$i++;
										}										
									}
								}
							}
						}
					}				
				}
			}
			if(!empty($recordsvilt)){
				$xv = 0;		
				foreach($recordsvilt["data"] as $datakeyv => $datav){
					$myarrvilt["data"][$xv]['id'] = $datav['id'];
					$myarrvilt["data"][$xv]['first_name'] = $datav['first_name'];
					$myarrvilt["data"][$xv]['last_name'] = $datav['last_name'];
					$myarrvilt["data"][$xv]['course_title'] = $datav['course_title'];
					$myarrvilt["data"][$xv]['email'] = $datav['email'];
					$myarrvilt["data"][$xv]['last_login'] = $datav['last_login'];
					$myarrvilt["data"][$xv]['course_id'] = $datav['course_id'];
					$xv++;
				}	
			}
			$this->response($myarrvilt);
		}
		
		if($type == 'ilt'){
			######################################## ILT Course Assemment #############################################
			$queryilt = "Select * from training_course";
			$resultilt = $this->db->query($queryilt);
			$resultCourseIlt = $resultilt->result_array();
			if(count($resultCourseIlt) > 0){
				foreach($resultCourseIlt as $ikey => $ivalue){			
					$courseilt[$ikey]['id'] = $ivalue['id'];
					$courseilt[$ikey]['title'] = $ivalue['title'];
					$courseilt[$ikey]['course_id'] = $ivalue['course_id'];
					$courseilt[$ikey]['duration'] = $ivalue['duration'];
				}		
			}
			$ix = 0;
			if(!empty($courseilt)){
				foreach($courseilt as $cikey => $cival){
					if(!empty($table_data["data"])){
						foreach($table_data["data"] as $ikey => $useri){
							if($cival != ''){
								//$queryilt = "Select * from training_course_time where training_course_id = ".$cival['id']." and date_str >= '".time()."'";
								$queryilt = "SELECT a.*, b.course_id, c.pay_type FROM training_course_time a 
                                            LEFT JOIN training_course b ON a.training_course_id = b.id 
                                            LEFT JOIN course c ON c.id = b.course_id
                                            WHERE training_course_id = ".$cival['id']."";
								$ilttimeres = $this->db->query($queryilt);
								$timeires = $ilttimeres->result_array();
								if(!empty($timeires)){
									foreach($timeires as $ickeys => $ictime){
										$startDatei = strtotime($ictime['start_day'] . " " . $ictime['start_time']);
										$durationIlt = $cival['duration']-1;
                                        $endDatei = strtotime('+'.$durationIlt .' days', strtotime($ictime['start_at']. " " . $ictime['end_time']));
										$currentDatei = time();										
										if($currentDatei >= $startDatei && $currentDatei <= $endDatei){										
                                            if($ictime['pay_type'] == 1){
                                                $queryiltp = "Select * from payment_history where object_id =  ".$ictime['course_id']." and user_id =  ".$useri->id." and object_type = 'training'";
                                            }else{
                                                $queryiltp = "Select * from enrollments where course_id =  ".$ictime['course_id']." and user_id =  ".$useri->id;
                                            }
											$resultiltp = $this->db->query($queryiltp);
											if(!empty($resultiltp->result_array())){
												$recordsilt["data"][$ix]['id'] = $useri->id;
												$recordsilt["data"][$ix]['first_name'] = $useri->first_name;
												$recordsilt["data"][$ix]['last_name'] = $useri->last_name;
												$recordsilt["data"][$ix]['course_title'] = ucfirst($cival['title']);
												$recordsilt["data"][$ix]['email'] = $useri->email;
												$recordsilt["data"][$ix]['last_login'] = $useri->last_login;
												$recordsilt["data"][$ix]['course_id'] = $cival['course_id'];													
											}
											$ix++;
										}
									}
								}
							}
						}
					}				

				}
			}
			if(!empty($recordsilt)){
				$xv = 0;		
				foreach($recordsilt["data"] as $datakeyv => $datailts){
					$myarrilt["data"][$xv]['id'] = $datailts['id'];
					$myarrilt["data"][$xv]['first_name'] = $datailts['first_name'];
					$myarrilt["data"][$xv]['last_name'] = $datailts['last_name'];
					$myarrilt["data"][$xv]['course_title'] = $datailts['course_title'];
					$myarrilt["data"][$xv]['email'] = $datailts['email'];
					$myarrilt["data"][$xv]['last_login'] = $datailts['last_login'];
					$myarrilt["data"][$xv]['course_id'] = $datailts['course_id'];
					$xv++;
				}	
			}
			
			$this->response($myarrilt);
		}       
    }
	
    public function getCourseHistoryList(){
        $company_id = $this->session->get_userdata() ['company_id'];
        $table_data["data"] = $this->Course_model->getCourseHistoryList($company_id);
        foreach ($table_data["data"] as $key => $row){
            $table_data["data"][$key]["no"] = $key + 1;
        }
        $records["data"] = $table_data["data"];
        $records['recordsTotal'] = $table_data["total"];
        $records['recordsFiltered'] = $table_data['filtertotal'];
        $this->response($records);
    }
    
    public function view_quiz_history($course_id = 0, $user_id = 0){
        if($this->isMasterAdmin()){
            $page_data['course_id'] = $course_id;
            $page_data['user_id'] = $user_id;
            $this->loadViews("admin/demand/quiz_history", $this->global, $page_data, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL , NULL);  
        }
    }
    
    public function getQuizHistoryList(){
        $param = $_GET;
        $course_id = $param['course_id'];
        $user_id = $param['user_id'];
        $table_data["data"] = $this->Quiz_model->getQuizHistoryList($course_id, $user_id);
        foreach ($table_data["data"] as $key => $row){
            $table_data["data"][$key]["no"] = $key + 1;
            $table_data['data'][$key]["quiz_num"] = count(json_decode($row['quiz_ids']));
        }
        $records["data"] = $table_data["data"];
        $records['recordsTotal'] = $table_data["total"];
        $records['recordsFiltered'] = $table_data['filtertotal'];
        $this->response($records);
    }
    
    public function view_quiz_answers($group_id = 0, $user_id = 0){
        if($this->isMasterAdmin()){
            $page_data['group_id'] = $group_id;
            $page_data['user_id'] = $user_id;
            $table_data['data'] = $this->Quiz_model->getQuizAnswerList($group_id, $user_id);
            $answer_cnt = 0;
            foreach ($table_data["data"] as $key => $row){
                $params['question'][$answer_cnt] = $this->Exam_model->getRowQuiz($table_data['data'][$key]["quiz_id"]);
                $params['question'][$answer_cnt]['content'] = json_decode($params['question'][$answer_cnt]['content'], true);
                $params['question'][$answer_cnt]['answer'] = json_decode($table_data['data'][$key]['description'], true);
                $params['question'][$answer_cnt]['mark'] = $table_data['data'][$key]['mark1'];
                $answer_cnt++;
            }
            $this->load->view('admin/demand/quiz_answers', $params, $this->global, $page_data, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL , NULL);
        }
    }
    
    function saveSessionDateTime(){
        $dataget = array('title' => $_POST['pageTitle'], 'course_id' => $_POST['courseId']);
        $results = $this->Course_model->getSessionDateTime('chapter', $dataget);
        if($results){
            foreach ($results as $rval){
                $dategetid = array('id' => $rval->id);
                $dataset = array('session_dateTime' => $_POST['dateTime']);
                $result = $this->Course_model->chapterSessionDateTimeUpdate('chapter', $dataset, $dategetid);
            }
            echo json_encode(array('status' => 'success', 'msg' => 'Chapter Updated'));
        }else{
            echo json_encode(array('status' => 'error', 'msg' => 'Chapter record not founded'));
        }
    }
    
    function getSessionDateTime(){
        $result = $this->Course_model->showSessionDateTime('chapter', $_POST['id']);
        echo json_encode($result);
        exit;
    }
    
    function removeSessionDateTime(){
        $courseId = $_POST['courseId'];
        $courseTitle = $_POST['pageTitle'];
        $result = $this->Course_model->removeSessionDateTime($courseId, $courseTitle);
        echo json_encode($result);
        exit;
    }

    function cronCourseCreateEmail(){
        $lastInsertCourse = $this->Course_model->getLastInsertCourse();
        if($lastInsertCourse){
            $id = $lastInsertCourse->id;
            $updateLastCourse = $this->Course_model->updateLastCourse($id);
            $this->load->library('email');
            $fromName = "Go Smart Academy";
            $to = 'sanchit11dhiman@gmail.com';
            $subject = 'New Course Available';
            $message = "
				 <html>
				   <head>
					 <title>New Course Created</title>
				   </head>
				   <body>
					 <p>Hello Sir/Madam,</p>
					 <p>Please checkout the new course is arrival.</p>
					 <p>Start new way of learning by susbscribe our new course.</p>
				   </body>
				 </html>";
            $from = "support@gosmartacademy.com";
            $this->email->from($from, $fromName);
            $this->email->to($to);
            $this->email->subject($subject);
            $this->email->message($message);
            $this->email->set_header('Content-Type', 'text/html');
            $this->email->send();
            /* if($this->email->send())
            {
            echo "Mail Sent Successfully";
            }
            else
            {
            echo "Failed to send email";
            show_error($this->email->print_debugger());
            } */
        }
    }
    //$allUsers = $this- >Course_model->allUserLearner();
    
}
?>