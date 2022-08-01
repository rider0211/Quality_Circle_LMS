<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
// require APPPATH . '/third_party/PHPExcel.php';
// require APPPATH . '/third_party/TCPDF-master/tcpdf.php';
// include_once (APPPATH . '/third_party/iio/index.php');
// require APPPATH . '/libraries/FPDI/fpdi.php';
// require APPPATH . 'third_party/woocommerce/autoload.php';
// use Automattic\WooCommerce\Client;
// use Automattic\WooCommerce\HttpClient\HttpClientException;

class Coursecreation extends BaseController{
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
		$this->load->model('Live_model');		
		$this->load->model('Training_model');
        $this->load->model('Company_model');
        $this->load->helper('common_helper');
        $this->load->model('Standard_model', "Standard");
        $this->isLoggedIn();
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '13');
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
                $filter['course_type'] = $course_type;
            }else{
                $course_type = - 1;
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
            $config['base_url'] = site_url('admin/coursecreation/getList?status=' . $status . '&sSearch=' . $search);
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
            $this->pagination->initialize($config);
            $this->global['links'] = $this->pagination->create_links();
			$this->global['course_data_all'] = $this->Course_model->getAllCourse();
            $this->global['category'] = $this->Category_model->getListByCompanyID($this->session->userdata('company_id'));
            $this->global['standard'] = $this->db->get_where('category_standard')->result();
            // echo "<pre>";
            //     print_r($this->global['standard']);
            // exit;
            $this->loadViews("admin/coursecreation/course_list", $this->global, NULL, NULL);
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
			$company_url = $this->session->userdata('company_url');
            $page_data['lang_ar'] = $lang_ar['data'];
            $page_path = "admin/coursecreation/preview_course";
            $course = $this->Course_model->select($row_id);
            $this->global['libraries'] = $this->Course_model->getLibrary($row_id);
            $this->global['course_name'] = $course->title;
            $this->global['course_id'] = $row_id;
            $this->global['active_id'] = 0;
			$this->global['company_url'] = $company_url;
            $this->loadViews($page_path, $this->global, NULL, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL , NULL); 
        }
    }
    
    public function view_course($id = NULL){
        $page_path = "admin/coursecreation/view_course";
        $course = $this->Course_model->select($id);
        $this->global['course'] = $course;
        if($this->isMasterAdmin()){
            $this->loadViews($page_path, $this->global, NULL, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL , NULL); 
        }
    }
    
    public function view_row_assess($course_id = 0, $user_id = 0){
        if($this->isMasterAdmin()){
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
                    foreach ($page_data['session_quiz'] as $quiz){
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
            $page_data['asses_data'] = $asses_data;
            $this->loadViews("admin/coursecreation/view_assess", $this->global, $page_data, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL , NULL); 
        }
    }
    
    public function view_exam_history($course_id, $user_id){
        if($this->isMasterAdmin()){
            $exam_id = $this->Course_model->getExamId($course_id) [0]['exam_id'];
            $this->global['questions'] = $this->Exam_model->getQuizList($exam_id);
            $this->global['answers'] = $this->Exam_model->getQuizHistoryByUser($exam_id, $user_id);
            $this->global['exam_id'] = $exam_id;
            $this->loadViews("admin/coursecreation/preview", $this->global, NULL, NULL);
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
        if($this->isMasterAdmin()){
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
            $params['certificate'] = $this->Certification_model->getRowById($this->Exam_model->getRow($exam_id) [0]['certificate_id']) ['content'];
            $params['certificate_id'] = $this->Exam_model->getRow($exam_id) [0]['certificate_id'];
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
            $params['CATEGORY'] = $course[0]['category'];
            $params['NAME'] = $params['user_name'];
            $params['SIGNATURE'] = "<img id=\"userSignImg\" style=\"width:100%;\" src=\"" . $admin[0]['sign'] . "\" />";
            $params['TITLE'] = $this->session->get_userdata() ['role'];
            $params['LOGO_COMPANY'] = "<img src=\"" . base_url() . "assets/img/logo.png\" alt=\"OLS\" height=\"80\" width=\"240\">";
            $params['LOGO_COURSE ACCERDITATION COMPANY'] = $params['score'];
            $this->global['certificate'] = $params;
            $this->loadViews("admin/coursecreation/reportCard", $this->global, NULL, NULL);
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
        $this->loadViews("admin/coursecreation/reportCard", $this->global, NULL , NULL);
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
        $this->loadViews("admin/coursecreation/view_assess", $this->global, $page_data, NULL);
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
            $page_path = "admin/coursecreation/detail_course";
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
        $course_data['certification'] = $this->input->post('certification');
		$course_data['ceu'] = $this->input->post('ceu');
        $course_data['pay_price'] = $this->input->post('pay_price');
        $course_data['show_user'] = $this->input->post('show_user');
        $course_data['pass_mark'] = $this->input->post('pass_mark');
        $course_data['tax_rate'] = $this->input->post('tax_rate');
        $course_data['tax_type'] = $this->input->post('tax_type');
        $course_data['discount'] = $this->input->post('discount');
        $course_data['amount'] = $this->input->post('amount');
        
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
    public function getCourse(){
        $filter = $this->input->post();
        if($filter['type'] == 0){
            $subCourse = (array)$this->Training_model->getCourseById($filter["id"]);
            $mainCourse = $this->Course_model->select($subCourse['course_id']);
        }else if($filter['type'] == 1){
            $subCourse = (array)$this->Live_model->getCourseById($filter["id"]);
            $mainCourse = $this->Course_model->select($subCourse['course_id']);
        }else{
            $mainCourse = $this->Course_model->select($filter["id"]);
        }
        $this->response($mainCourse);
    }
    public function republishCourse(){
        
        $company = (array) $this->Company_model->getRow($this->session->get_userdata() ['company_id']);
        $data = $this->input->post();
        $mainCourse = (array)$this->Course_model->select($data['republish-id']);
        $mainCourse['discount'] = $data['republish-discount'];
        $mainCourse['amount'] = $data['republish-amount'];
        $mainCourse['pay_price'] = $data['republish-price'];
        $mainCourse['reg_date'] = date("Y-m-d H:s:i");
        $mainCourse['start_at'] = $this->input->post('startdays');
        $mainCourse['start_time'] = $this->input->post('starttime');
        
        $this->load->model("Chapter_model", "Chapter");
        $chapters = (array)$this->Chapter->all(array("course_id"=> $mainCourse['id']));
        
        if($data['republish-type'] == "0"){
            
            $subCourse = (array)$this->Training_model->one(array("course_id"=>$mainCourse['id']));
            unset($mainCourse['id']);
            $course_id = $this->Course_model->insert($mainCourse);

            $subCourse['course_id'] = $course_id;

            $course_time_model = new AbstractModel("training_course_time");
            $course_time = (array)$course_time_model->one(array("training_course_id"=>$subCourse["id"]));

            unset($subCourse["id"]);
            $sub_id = $this->Training_model->insert($subCourse);

            $course_time['training_course_id'] = $sub_id;
            $startTime = $this->input->post('starttime');
            $endTime = getEndTime($startTime);
            $course_time['start_day'] = $this->input->post('startdays');
            $course_time['start_time'] = $startTime;
            $course_time['date_str'] = strtotime($data['start_day'].' '.$data['start_time']);		
            $course_time['end_time'] = $endTime;
            $dates = explode("-", $this->input->post('startdays'));
            $course_time['year'] = $dates[0];
			$course_time['month'] = $dates[1];
			$course_time['sday'] = $dates[2];
			$course_time['reg_date'] = date("Y-m-d H:s:i");

            unset($course_time['id']);
            $this->Training_model->insert_time($course_time);

            $course_type = "face to face ILT Platform at" . substr($mainCourse["location"],1);
            $detail = $this->Training_model->getListByCourseId($data['republish-id']);	
            $course_url = base_url('company/'.$company['url']). "/training/view/" . $this->Training_model->get_course_time_id($detail[0]['id'])->id;
            $start_date = "<li> Start Date: " . date("M d, Y h:i:sa", strtotime($course_time['start_day'] . " " . $course_time['start_time'])) . "</li>";
            $end_date = "<li> End Date: " . date("M d, Y h:i:sa", strtotime("+".($detail[0]["duration"]-1) . " days", strtotime($course_time['start_day']. " " . $course_time['end_time']))) . "</li>";
            
        }else if($data['republish-type'] == "1"){

            $subCourse = (array)$this->Live_model->one(array("course_id"=>$mainCourse['id']));

            unset($mainCourse['id']);
            $course_id = $this->Course_model->insert($mainCourse);

            $subCourse['startday'] = $this->input->post('startdays');
            $subCourse['course_id'] = $course_id;

            unset($subCourse["id"]);
            $sub_id = $this->Live_model->insert($subCourse);

            $course_time['virtual_course_id'] = $sub_id;
			$startTime = $this->input->post('starttime');
            $endTime = getEndTime($startTime);
            $course_time['start_at'] = $this->input->post('startdays');
            $course_time['start_time'] = $startTime;
            $course_time['end_time'] = $endTime;
			$course_time['reg_date'] = date("Y-m-d H:s:i");

			$this->Live_model->insert_time($course_time);

            $course_type = "VILT platform";
            $detail = $this->Live_model->getListByCourseId($data['republish-id']);		
            $course_url = base_url('company/'.$company['url'].'/classes/view/'.$this->Live_model->get_course_time_id($detail[0]['id'])->id);
            $start_date = "<li> Start Date: " . date("M d, Y h:i:sa", strtotime($course_time['start_at'] . " " . $course_time['start_time'])) . "</li>";
            $end_date = "<li> End Date: " . date("M d, Y h:i:sa", strtotime("+" . ($detail[0]["duration"]-1) ." days", strtotime($course_time['start_at']. " " . $course_time['end_time']))) . "</li>";

        }else{
            $mainCourse['start_at'] = $this->input->post("startdays");
            $mainCourse['end_at'] = $this->input->post("enddays");
            unset($mainCourse['id']);
            $this->Course_model->insert($mainCourse);

            $course_type = "On Demand platform at your own pace";
            $course_url = base_url('company/'.$company['url'].'/demand/view/'.$data['republish-id']);
            $start_date = "";
            $end_date = "";

        }

        foreach($chapters as $session){
            $session = get_object_vars($session);
            $session['prev_id'] = $session['id'];
            unset($session['id']);
            $session['course_id'] = $course_id;
            $this->Chapter->insert($session);
        }
        $this->Chapter->updateParent($course_id);
        if($mainCourse["pay_type"] == 1){
            if($mainCourse['category_id'] != ""){
                $category = $this->Category_model->getRow($mainCourse['category_id'])[0]["name"];
            }
            if( $mainCourse['standard_id'] ){
                $category = $category . " and standard " . substr($this->Standard->getStrStandard($mainCourse['standard_id']), 1);
            }
            // $users = [];
            // $item['email']="oglave_13@yahoo.com";
            // $item['fullname'] = $this->User_model->getFullNameByEmail($item['email']);
            // array_push($users,$item);
            // $item['email']="ricardo.johnson@tijulecompany.com";
            // $item['fullname'] = $this->User_model->getFullNameByEmail($item['email']);
            // array_push($users,$item);
            // $item['email']="nicola.mighty@tijulecompany.com";
            // $item['fullname'] = $this->User_model->getFullNameByEmail($item['email']);
            // array_push($users,$item);
            // $item['email']="efitzgerald@tijulecompany.com";
            // $item['fullname'] = $this->User_model->getFullNameByEmail($item['email']);
            // array_push($users,$item);
            // $item['email']="seniordev1994128@gmail.com";
            // $item['fullname'] = 'James Coulter';
            // array_push($users,$item);
            $users = $this->User_model->getUsersForBlast($this->session->get_userdata()['company_id']);
            $this->load->library('email');
            $email_temp = $this->getEmailTemp('create_course',$this->session->get_userdata()['company_id']);
            $message = $email_temp['message'];
            $title = $email_temp['subject'];
            $img_url = base_url() . $detail[0]["img_path"];
            foreach($users as $item){
                $content = str_replace("{USERNAME}", $item['fullname'], $message);
                $content = str_replace("{COURSETITLE}", $mainCourse['title'], $content);
                $content = str_replace("{CATEGORY}", $category, $content);
                $content = str_replace("{COURSETYPE}", $course_type, $content);
                $content = str_replace("{PAYTYPE}", $mainCourse['pay_type'] == 0? "Closed Enrollment Course": "Open Enrollment Course", $content);
                $content = str_replace("{DURATION}", $detail[0]['duration'], $content);
                $content = str_replace("{PRICE}", $mainCourse['pay_price'], $content);
                $content = str_replace("{DISCOUNT}", $mainCourse['discount'], $content);
                $content = str_replace("{AMOUNT}", $mainCourse['amount'], $content);
                $content = str_replace("{IMAGEURL}", $img_url, $content);
                $content = str_replace("{COMPANYURL}", base_url($company['company_url']), $content);

                $content = str_replace("{COMPANYLOGO}", base_url()."assets/logos/logo1.png", $content);
                $content = str_replace("{EXAMPLERLOGO}", base_url()."assets/logos/logo2.png", $content);
                
                $content = str_replace("{STARTDATE}", $start_date, $content);
                $content = str_replace("{ENDDATE}", $end_date, $content);
                $content = str_replace("{VIEWCOURSE}", $course_url, $content);
                $content = str_replace("{ENROLLCOURSE}", base_url() . "company/QC", $content);
                $content = str_replace("{VIEWLINK}", base_url() . "company/QC", $content);
                // print_r($content);
                    
                $this->sendemail($item['email'],$item['fullname'],$content,$title);
            }
        }
        $this->response(array("success"=>true, "msg"=>"Course Republished"));


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
       	$course_data['about'] = $this->input->post('aboutvalue');
		$course_data['prerequisite'] = $this->input->post('prerequisitevalue');
		$course_data['course_self_time'] = $this->input->post('course_self_time');
		$course_data['learning_objective'] = $this->input->post('learning_objectivevalue');
		$course_data['agenda'] = $this->input->post('agendavalue');		

        $course_data['course_type'] = $this->input->post('course_type');

        $user = (array) $this->User_model->select($this->session->get_userdata()['user_id']);
		// $plan = $this->Plan_model->getPlanCompany($this->session->get_userdata()['company_id']);
        $plan = $this->Plan_model->select($user['plan_id']);
        if(!$plan->id){
            $plan = $this->Plan_model->select('1');
        }
        $company = (array) $this->Company_model->getRow($this->session->get_userdata() ['company_id']);

        $filter['company_id'] = $this->session->get_userdata()['company_id'];
        $filter['course_type'] = $course_data['course_type'];
        $limit = $this->Course_model->getLimitation($filter);

        $result = array('success'=>true, 'msg'=>'Success Course created');
        if($course_data['course_type'] == 2){
            if($limit > $plan->demand_limit ){
                $result = array('success'=>false, 'msg'=>'Full maximum demand course');
                
            }
        }else if($course_data['course_type'] == 1){
            if($limit > $plan->vilt_room_limit ){
                $result = array('success'=>false, 'msg'=>'Full maximum VILT course');
            }
        }else{
            if($limit > $plan->ilt_room_limit ){
                $result = array('success'=>false, 'msg'=>'Full maximum ILT course');
            }
        }
        if(!$result['success']){
            $this->Course_model->remove($course_data['id']);
            $this->response($result);
        }else{
            $upload_path = sprintf('%scompany/course/', PATH_UPLOAD);
            $courseData = $this->Course_model->select($course_data['id']);
            if($_FILES['objective_img']['name'] != ''){
                $upload_path = sprintf('%scompany/course/', PATH_UPLOAD);
                if(!file_exists($upload_path)){
                    $this->makeDirectory($upload_path);
                }			
                $rslt = $this->doUpload('objective_img', $upload_path);		
                if($rslt['possible'] == 1){
                    if(!empty($courseData->objective_img)){
                        if(file_exists($courseData->objective_img)){
                            unlink($courseData->objective_img);
                        }
                    }
                    $course_data['objective_img'] = str_replace("./", "", $rslt['path']);
                }else $course_data['objective_img'] = str_replace("./", "", "assets/img/" . 'default.png');		
            } 
            $course_data['attend'] = $this->input->post('attendvalue');
            
            if($_FILES['attend_img']['name'] != ''){
                $upload_path = sprintf('%scompany/course/', PATH_UPLOAD);
                if(!file_exists($upload_path)){
                    $this->makeDirectory($upload_path);
                }
                
                $rslt = $this->doUpload('attend_img', $upload_path);		
                if($rslt['possible'] == 1){
                    if(!empty($courseData->attend_img)){
                        if(file_exists($courseData->attend_img)){
                            unlink($courseData->attend_img);
                        }
                    }
                    $course_data['attend_img'] = str_replace("./", "", $rslt['path']);
                }else $course_data['attend_img'] = str_replace("./", "", "assets/img/" . 'default.png');		
            }
            if($_FILES['agenda_img']['name'] != ''){
                $upload_path = sprintf('%scompany/course/', PATH_UPLOAD);
                if(!file_exists($upload_path)){
                    $this->makeDirectory($upload_path);
                }
                $rslt = $this->doUpload('agenda_img', $upload_path);		
                if($rslt['possible'] == 1){
                    if(!empty($courseData->agenda_img)){
                        if(file_exists($courseData->agenda_img)){
                            unlink($courseData->agenda_img);
                        }
                    }
                    $course_data['agenda_img'] = str_replace("./", "", $rslt['path']);
                }else $course_data['agenda_img'] = str_replace("./", "", "assets/img/" . 'default.png');		
            }
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
            if($course_data['course_type'] != 2){
                $course_data['start_at'] = $this->input->post('start_at');
                $course_data['end_at'] = $this->input->post('end_at');	
            }else{
                $course_data['start_at'] = NULL;
                $course_data['end_at'] = NULL;	
            }
                    
            
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

            $course_data['startday'] = $this->input->post('start_at');
            $course_data['starttime'] = $this->input->post('starttime');
            if($course_data['category_id'] != ""){
                $category = $this->Category_model->getRow($course_data['category_id'])[0]["name"];
            }
            if( $this->input->post('standard_id') ){
                $category = $category . " and standard " . substr($this->Standard->getStrStandard($course_data['standard_id']), 1);
            }
            if($course_data['course_type'] == 2){
                $course_type = "On Demand platform at your own pace";
                $course_url = base_url('company/'.$company['url'].'/demand/view/'.$course_data['id']);
                $start_date = "";
                $end_date = "";
                // $category = "On Demand";
            }
            if($course_data['course_type'] == 1){
                $course_type = "VILT platform";
                $this->addLive($course_data);
                $detail = $this->Live_model->getListByCourseId($course_data['id']);		
                $course_url = base_url('company/'.$company['url'].'/classes/view/'.$this->Live_model->get_course_time_id($detail[0]['id'])->id);
                $start_date = "<li> Start Date: " . date("M d, Y h:i:sa", strtotime($detail[0]["start_at"] . " " . $detail[0]["start_time"])) . "</li>";
                $end_date = "<li> End Date: " . date("M d, Y h:i:sa",strtotime("+" . ($detail[0]["duration"]-1) . " days", strtotime($detail[0]['start_at']. " " . $detail[0]['end_time']))) . "</li>";
            }
            if($course_data['course_type'] == 0){
                $course_type = "face to face ILT Platform at" . substr($course_data["location"],1);
                
                $this->addIltCourse($course_data);
                $detail = $this->Training_model->getListByCourseId($course_data["id"]);	
                $course_url = base_url('company/'.$company['url']). "/training/view/" . $this->Training_model->get_course_time_id($detail[0]['id'])->id;
                $start_date = "<li> Start Date: " . date("M d, Y h:i:sa", strtotime($detail[0]["start_day"] . " " . $detail[0]["start_time"])) . "</li>";
                $end_date = "<li> End Date: " . date("M d, Y h:i:sa", strtotime("+" . ($detail[0]["duration"]-1) . " days", strtotime($detail[0]['start_day']. " " . $detail[0]['end_time']))) . "</li>";
            }
            
            // Add Course Detail To WooCommerce Store
            // $courseData = array('name' => $course_data['title'], 'type' => 'simple', 'regular_price' => $price, 'description' => $course_data['about'], 'short_description' => $course_data['about'], 'categories' => [['id' => 35]], 'images' => [['src' => 'https://shop.gosmartacademy.com/wp-content/uploads/2020/06/course.png']]);
            // $users = [];
            // $item['email']="oglave_13@yahoo.com";
            // $item['fullname'] = $this->User_model->getFullNameByEmail($item['email']);
            // array_push($users,$item);
            // $item['email']="ricardo.johnson@tijulecompany.com";
            // $item['fullname'] = $this->User_model->getFullNameByEmail($item['email']);
            // array_push($users,$item);
            // $item['email']="nicola.mighty@tijulecompany.com";
            // $item['fullname'] = $this->User_model->getFullNameByEmail($item['email']);
            // array_push($users,$item);
            // $item['email']="efitzgerald@tijulecompany.com";
            // $item['fullname'] = $this->User_model->getFullNameByEmail($item['email']);
            // array_push($users,$item);
            // $item['email']="seniordev1994128@gmail.com";
            // $item['fullname'] = 'James Coulter';
            // array_push($users,$item);
            $users = $this->User_model->getUsersForBlast($this->session->get_userdata()['company_id']);
            $this->load->library('email');
            $email_temp = $this->getEmailTemp('create_course',$this->session->get_userdata()['company_id']);
            $message = $email_temp['message'];
            $title = $email_temp['subject'];
            $img_url = base_url() . $detail[0]["img_path"];
            if($courseData->pay_type == 1){
                foreach($users as $item){
                    $content = str_replace("{USERNAME}", $item['fullname'], $message);
                    $content = str_replace("{COURSETITLE}", $course_data['title'], $content);
                    $content = str_replace("{CATEGORY}", $category, $content);
                    $content = str_replace("{COURSETYPE}", $course_type, $content);
                    $content = str_replace("{PAYTYPE}", $courseData->pay_type == 0? "Closed Enrollment Course": "Open Enrollment Course", $content);
                    $content = str_replace("{DURATION}", $detail[0]['duration'], $content);
                    $content = str_replace("{PRICE}", $courseData->pay_price, $content);
                    $content = str_replace("{DISCOUNT}", $courseData->discount, $content);
                    $content = str_replace("{AMOUNT}", $courseData->amount, $content);
                    $content = str_replace("{IMAGEURL}", $img_url, $content);
                    $content = str_replace("{COMPANYURL}", base_url($company['company_url']), $content);
    
                    $content = str_replace("{COMPANYLOGO}", base_url()."assets/logos/logo1.png", $content);
                    $content = str_replace("{EXAMPLERLOGO}", base_url()."assets/logos/logo2.png", $content);
                    
                    $content = str_replace("{STARTDATE}", $start_date, $content);
                    $content = str_replace("{ENDDATE}", $end_date, $content);
                    $content = str_replace("{VIEWCOURSE}", $course_url, $content);
                    $content = str_replace("{ENROLLCOURSE}", base_url() . "company/QC", $content);
                    $content = str_replace("{VIEWLINK}", base_url() . "company/QC", $content);
                    // print_r($content);
                    
                    $this->sendemail($item['email'],$item['fullname'],$content,$title);
                }
            }
            
            $this->response($result);
            // redirect('admin/coursecreation/getList');
        }
		
    }
	
	public function addIltCourse($iltCourse){
		$trainingDetail = $this->Training_model->getListByCourseId($iltCourse['id']);		
		if(!empty($trainingDetail)){
            $this->Training_model->deleteCourseTraining($trainingDetail[0]['id']);
        }
        $startday = NULL; 
        $endday = NULL; 
        $starttime = date('H:i:s');
        $course_data['startday'] = $iltCourse['startday'];
        $course_data['endday'] = $endday;
        $course_data['title'] = $iltCourse['title'];
        $course_data['subtitle'] = $iltCourse['subtitle'];
        $course_data['duration'] = $iltCourse['duration'];
        $course_data['objective'] = $iltCourse['learning_objective'];
        $course_data['attend'] = $iltCourse['attend'];
        $course_data['agenda'] = $iltCourse['agenda'];
        $course_data['course_pre_requisite'] = $iltCourse['prerequisite'];
        $course_data['course_link'] = '';
        $course_data['description'] = $iltCourse['about'];
        $course_data['number'] = $iltCourse['number'];
        $course_data['course_type'] = $iltCourse['course_type'];
        $course_data['course_id'] = $iltCourse['id'];
        $course_data['category_id'] = $iltCourse['id'];
        $course_data['category'] = $iltCourse['category_id'];
        $course_data['standard_id'] = '['.json_encode($iltCourse['standard_id']).']';
        $course_data['create_id'] = $this->session->get_userdata()['company_id'];
        $course_data['img_path'] = str_replace("./", "", "assets/img/" . 'default.png');
        if($iltCourse['img_path'] != ''){
            $course_data['img_path'] = $iltCourse['img_path'];
        }
        $course_data['objective_img'] = str_replace("./", "", "assets/img/" . 'default.png');
        if($iltCourse['objective_img'] != ''){
            $course_data['objective_img'] = $iltCourse['objective_img'];
        }
        $course_data['agenda_img'] = str_replace("./", "", "assets/img/" . 'default.png');
        if($iltCourse['agenda_img'] != ''){
            $course_data['agenda_img'] = $iltCourse['agenda_img'];
        }
        $course_data['attend_img'] = str_replace("./", "", "assets/img/" . 'default.png');
        if($iltCourse['attend_img'] != ''){
            $course_data['attend_img'] = $iltCourse['attend_img'];
        }
        $timestamp = time();
        $course_data['instructors'] = json_encode($this->input->post('instructor[]'));
        $course_data['highlights'] = json_encode($this->input->post('highlight[]'));
        if($course_data['course_type'] == 0){
            $explode = explode(',',$iltCourse['location']);			 
            $course_data['address'] = $iltCourse['address'];
            $course_data['country'] = $explode[count($explode)-3];
            $course_data['state'] = $explode[count($explode)-2];
            $course_data['city'] = $explode[count($explode)-1];
            $course_data['location'] = $iltCourse['location'];	
        }else{
            $course_data['location'] = 'Online';	
            $course_data['address'] = '';
            $course_data['country'] = '';
            $course_data['state'] = '';
            $course_data['city'] = '';
        }
        $row_id = $this->Training_model->insert_course($course_data);
        $course_time['training_course_id'] = $row_id;
        $course_time['country_id'] = $iltCourse['country'];
        $course_time['state_id'] = $iltCourse['state'];
        $course_time['city_id'] = $iltCourse['city'];
        // $course_time['start_day'] = date('Y-m-d',$timestamp);
        $course_time['start_day'] = $iltCourse['startday'];
        $course_time['start_time'] = $iltCourse['starttime'];
        $course_time['end_time'] = getEndTime($iltCourse['starttime']);
        $dates = explode("-", $iltCourse['startday']);
        // $course_time['date_str'] = strtotime($course_time['start_day'].' '.$course_time['start_time']);
        $course_time['year'] = $dates[0];
        $course_time['month'] = $dates[1];
        $course_time['sday'] = $dates[2];
        $course_time['location'] = $course_data['location'];
    
        $this->Training_model->insert_time($course_time);
		
	}

	public function addLive($liveCourse){
		$liveDetail = $this->Live_model->getListByCourseId($liveCourse['id']);		
		if(!empty($liveDetail)){
            $this->Live_model->deleteCourseVirtual($liveDetail[0]['id']);
        }
        $startday = NULL; 
        $endday = NULL; 
        $starttime = date('H:i:s');
        $course_data['startday'] = $liveCourse['startday'];
        $course_data['endday'] = $endday;
        $course_data['title'] = $liveCourse['title'];
        $course_data['subtitle'] = $liveCourse['subtitle'];
        $course_data['duration'] = $liveCourse['duration'];
        $course_data['about'] = $liveCourse['about'];
        $course_data['objective'] = $liveCourse['learning_objective'];
        $course_data['attend'] = $liveCourse['attend'];
        $course_data['agenda'] = $liveCourse['agenda'];
        $course_data['course_pre_requisite'] = $liveCourse['prerequisite'];
        $course_data['user_type'] = 0;
        // $course_data['pay_type'] = 0;
        $course_data['record_type'] = 0;
        // $course_data['pay_price'] = 0;
        $course_data['number'] = $liveCourse['number'];
        $course_data['course_type'] = $liveCourse['course_type'];
        $course_data['course_id'] = $liveCourse['id'];
        $course_data['category_id'] = $liveCourse['category_id'];
        $course_data['standard_id'] = '['.json_encode($liveCourse['standard_id']).']';
        $course_data['url'] = '';
        // if($course_data['pay_price'] == null){
        // 	$course_data['pay_price'] = 0;
        // }
        $course_data['create_id'] = $this->session->get_userdata()['company_id'];
        $course_data['img_path'] = str_replace("./", "", "assets/img/" . 'default.png');
        if($liveCourse['img_path'] != ''){
            $course_data['img_path'] = $liveCourse['img_path'];
        }
        $course_data['objective_img'] = str_replace("./", "", "assets/img/" . 'default.png');
        if($liveCourse['objective_img'] != ''){
            $course_data['objective_img'] = $liveCourse['objective_img'];
        }
        $course_data['agenda_img'] = str_replace("./", "", "assets/img/" . 'default.png');
        if($liveCourse['agenda_img'] != ''){
            $course_data['agenda_img'] = $liveCourse['agenda_img'];
        }
        $course_data['attend_img'] = str_replace("./", "", "assets/img/" . 'default.png');
        if($liveCourse['attend_img'] != ''){
            $course_data['attend_img'] = $liveCourse['attend_img'];
        }
        $timestamp = time();
        $start_at = date('Y-m-d H:i:s', $timestamp);
        $course_data['instructors'] = json_encode($this->input->post('instructor[]'));
        $course_data['highlights'] = json_encode($this->input->post('highlight[]'));
        $course_data['enroll_users'] = 0;
        if($liveCourse['course_type'] == 0){
            $course_data['address'] = $liveCourse['address'];
            $course_data['country'] = $liveCourse['country'];
            $course_data['state'] = $liveCourse['state'];
            $course_data['city'] = $liveCourse['city'];
            $course_data['location'] = $iltCourse['location'];
        }else{
            $course_data['location'] = 'Online';	
            $course_data['address'] = '';
            $course_data['country'] = '';
            $course_data['state'] = '';
            $course_data['city'] = '';
        }		
        
        $row_id = $this->Live_model->insert_course($course_data);
        $course_time['virtual_course_id'] = $row_id;
        $course_time['start_time'] = $liveCourse['starttime'];
        $course_time['end_time'] = getEndTime($liveCourse['starttime']);
        $course_time['start_at'] = $liveCourse['startday'];
        $course_time['reg_date'] = $start_at;
        $this->Live_model->insert_time($course_time);
		
	}
    
    public function edit_course_tab($row_id = 0, $tab_id = 1){
        $this->global['edit_course'] = "1";
        $this->global['tab_active_id'] = $tab_id;
        $this->load->library('Sidebar');
        if($this->isMasterAdmin()){
            $lang_ar = $this->Translate_model->getLanguageList(array('active_flag' => 1, 'add_flag' => 1));
            $page_data['lang_ar'] = $lang_ar['data'];
            $page_path = "admin/coursecreation/course_edit";
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
                $course_data['pay_type'] = 1;
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
            // $this->global['course_data'] = $course_data;
            // $this->global['exam_data'] = $this->Exam_model->getExamListByCompanyID($this->session->get_userdata() ['company_id']);
            // $this->global['chapter_data'] = $this->Course_model->getChapterByCourseID($row_id);
            // $this->global['quiz_data'] = $this->Exam_model->getQuizGroupListByCompanyID($this->session->get_userdata() ['company_id']);
            // $this->global['category'] = $this->Category_model->getListByCompanyID($this->session->get_userdata() ['company_id']);
			// $this->global['countries'] = $this->Location_model->getAllCounties();
			// $this->global['states'] = $this->Location_model->getStateByCountryId($course->country);
			// $this->global['cities'] = $this->Location_model->getCityByStateId($course->state);
            $this->global['course_data'] = $course_data;
            $this->global['location_data'] = $this->Location_model->getTrainingCourseLocationList();
			$this->global['countries'] = $this->Location_model->getAllCounties();
			$this->global['states'] = $this->Location_model->getStateByCountryId($course->country);
			$this->global['cities'] = $this->Location_model->getCityByStateId($course->state);
            $this->global['category'] = $this->Category_model->getListByCompanyID($this->session->get_userdata() ['company_id']);
            $this->global['chapter_data'] = $this->Course_model->getChapterByCourseID($row_id);
            $this->global['quiz_data'] = $this->Exam_model->getQuizGroupListByCompanyID($this->session->get_userdata() ['company_id']);
			$this->global['category_standard_list'] = $this->Category_model->getListByCategoryID($course->category_id);
            $this->global['exam_data'] = $this->Exam_model->getExamListByCompanyID($this->session->get_userdata() ['company_id']);
            $this->global['company'] = (array) $this->Company_model->getRow($this->session->get_userdata() ['company_id']);

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
            $page_path = "admin/coursecreation/course_edit";
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
                $course_data['pay_type'] = 1;
                $course_data['pay_price'] = 0;
                $course_data['amount'] = 0;
                $course_data['show_user'] = 0;
                $course_data['certification'] = 'Certification';
                $course_data['ceu'] = '';
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
                $course_data['discount'] = "";
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
            $this->global['chapter_data'] = $this->Course_model->getChapterByCourseID($row_id);
            $this->global['quiz_data'] = $this->Exam_model->getQuizGroupListByCompanyID($this->session->get_userdata() ['company_id']);
			$this->global['category_standard_list'] = $this->Category_model->getListByCategoryID($course->category_id);
            $this->global['exam_data'] = $this->Exam_model->getExamListByCompanyID($this->session->get_userdata() ['company_id']);
            $this->global['company'] = (array) $this->Company_model->getRow($this->session->get_userdata() ['company_id']);
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
            $this->loadViews("admin/coursecreation/course_history", $this->global, null, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL , NULL); 
        }
    }

    public function view_certificate_history(){
        if($this->isMasterAdmin()){
            $this->loadViews("admin/coursecreation/certificate_history", $this->global, null, NULL);
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
    
    public function getTodayOnlineLearner(){
        $table_data["data"] = $this->Course_model->getTodayOnlineLearner();
        $records["data"] = $table_data["data"];
        $this->response($records);
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
            $this->loadViews("admin/coursecreation/quiz_history", $this->global, $page_data, NULL);
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
            $this->load->view('admin/coursecreation/quiz_answers', $params, $this->global, $page_data, NULL);
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