<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
/**
 * Class : Exam (ExamController)
 * Exam Class to control all exam related operations.
 * @author : ping
 * @version : 1.0
 * @since : 7 July 2018
 */
class Exam extends BaseController {
    /**
     * This is default constructor of the class
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('Exam_model');
        $this->load->model('Certification_model');
        $this->load->model('User_model');
        $this->isLoggedIn();
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '3-1');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
    }
    /**
     * This function used to load the first screen of the user
     */
    public function index(){
        if($this->isInstructor()){
            $this->loadViews("instructor/exam/exam_list", $this->global, NULL, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function viewQuizList(){
        $side_params = array('selected_menu_id' => '11-1');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        $this->loadViews("instructor/exam/quiz_list", $this->global, NULL, NULL);
    }
    
    public function getQuizList(){
        $table_data['data'] = $this->Exam_model->getQuizAllList($this->session->get_userdata() ['company_id']);
        foreach ($table_data['data'] as $key => $row){
            $table_data['data'][$key]["no"] = $key + 1;
        }
        $records["data"] = $table_data['data'];
        $records['recordsTotal'] = $table_data["total"];
        $records['recordsFiltered'] = $table_data['filtertotal'];
        $this->response($records);
    }
    
    public function viewQuizGroupList(){
        $side_params = array('selected_menu_id' => '11-2');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        $this->loadViews("instructor/exam/quiz_group_list", $this->global, NULL, NULL);
    }
    
    public function getQuizIds(){
        $id = $this->input->post('id');
        $res = $this->Exam_model->getQuizIds($id) [0];
        $this->response($res);
    }
    
    public function save_quiz_group(){
        $id = $this->input->post('row_id');
        $data['quiz_ids'] = json_encode($this->input->post('quiz_ids[]'));
        $data['company_id'] = $this->session->get_userdata() ['company_id'];
        $data['title'] = $this->input->post('quiz_group_title');
        if($id == ''){
            $this->Exam_model->insertQuizGroup($data);
        }else{
            $this->Exam_model->updateQuizGroup($data, $id);
        }
        $this->viewQuizGroupList();
    }
    
    public function quiz_group_delete(){
        $id = $this->input->post('id');
        if($this->Exam_model->deleteQuizGroup($id)){
            $out_data["status"] = "Success";
            $out_data["message"] = "";
        }else{
            $out_data["status"] = "Fail";
            $out_data["message"] = "Could not delete the row.";
        }
        $this->response($out_data);
    }
    
    public function getQuizGroupList(){
        $table_data['data'] = $this->Exam_model->getQuizGroupList($this->session->get_userdata() ['company_id']);
        foreach ($table_data['data'] as $key => $row){
            $table_data['data'][$key]["no"] = $key + 1;
            $table_data['data'][$key]["quiz_num"] = count(json_decode($row['quiz_ids']));
        }
        $records["data"] = $table_data['data'];
        $records['recordsTotal'] = $table_data["total"];
        $records['recordsFiltered'] = $table_data['filtertotal'];
        $this->response($records);
    }
    
    public function viewCreate(){
        if($this->isInstructor()){
            $company_id = $this->session->get_userdata() ['company_id'];
            $page_data['certification'] = $this->Certification_model->getRowByCompanyid($company_id);
            $page_data['instructor'] = $this->User_model->getInstructorByCompany($company_id);
            $page_data['observer'] = $this->User_model->getObserverByCompany($company_id);
            $row_id = isset($_REQUEST['row_id']) ? intval($_REQUEST['row_id']) : 0;
            $exam_type = isset($_REQUEST['exam_type']) ? $_REQUEST['exam_type'] : "Auto";
            $this->load->model('Settings_model');
            if($row_id != 0){
                $exam_row = $this->Exam_model->getRow($row_id);
                if($exam_row[0]["exam_image"] != "") $exam_row[0]["preview_image"] = sprintf("%sassets/uploads/exam/%d_%s", base_url(), $exam_row[0]["id"], $exam_row[0]["exam_image"]);
                else $exam_row[0]["preview_image"] = "";
                $page_data['exam'] = $exam_row[0];
                $exam_type = $exam_row[0]["type"];
                $this->global["questions"] = $this->Exam_model->getQuizList($row_id);
            }else{
                $exam_row['id'] = '0';
                $exam_row["cert_temp_id"] = 0;
                $exam_row['exam_category_name'] = '';
                $exam_row['exam_category_code'] = '';
                $exam_row['category_id'] = 0;
                $exam_row['title'] = '';
                $exam_row['description'] = '';
                $exam_row["preview_image"] = '';
                $exam_row['status'] = '';
                $exam_row['created_at'] = '';
                $exam_row['updated_at'] = '';
                $page_data['exam'] = $exam_row;
            }
            $this->global["save"] = FALSE;
            if($exam_type == "Auto"){
                $this->loadViews("instructor/exam/exam_edit", $this->global, $page_data, NULL);
            }else{
                $this->loadViews("instructor/exam/exam_manual_edit", $this->global, $page_data, NULL);
            }
        }else{
            $this->loadViews("access", $this->global, NULL , NULL);
        }
    }
    /**
     * This function used to load All exam list
     */
    public function getList(){
        //$total = $this->Exam_model->all();
        $out_data = array();
        $table_data = $this->Exam_model->getList();
        foreach ($table_data['data'] as $key => $row){
            $table_data['data'][$key]["no"] = $key + 1;
        }
        $records["data"] = $table_data['data'];
        //$records["recordsTotal"] = $total;
        $records['recordsTotal'] = $table_data["total"];
        $records['recordsFiltered'] = $table_data['filtertotal'];
        $this->response($records);
    }

    public function getSelectableQuizList(){
        $param["category_id"] = $this->input->post('category_id');
        $param["no_quiz_id"] = $this->input->post('ids');
        $this->load->model('Quiz_model', '', TRUE);
        $quiz_list['data'] = $this->Quiz_model->all($param);
        return $this->response($quiz_list);
    }
    
    public function getSelectedQuizList(){
        $quiz_id_list = $this->input->post('ids');
        if(isset($quiz_id_list)){
            $this->load->model('Quiz_model', '', TRUE);
            $param["category_id"] = $this->input->post('category_id');
            $param["quiz_id"] = $quiz_id_list;
            $quiz_list['data'] = $this->Quiz_model->all($param);
        }else{
            $quiz_list['data'] = array();
        }
        return $this->response($quiz_list);
    }
    /**
     * This function used to load Actived exam list
     */
    public function getExamList(){
        $table_data = $this->Exam_model->getList4Select2($_REQUEST['term']);
        $records["results"] = $table_data;
        $this->response($records);
    }
    
    public function selectrow($id){
        $out_data = $this->Exam_model->getRow($id);
        $this->response($out_data);
    }
    
    public function active(){
        $id = $this->input->post('id');
        return $this->Exam_model->active($id);
    }
    
    public function inactive(){
        $id = $this->input->post('id');
        return $this->Exam_model->inactive($id);
    }
    
    public function delete(){
        $out_data = array();
        $id = $this->input->post('id');
        if($this->Exam_model->delete($id)){
            $out_data["status"] = "Success";
            $out_data["message"] = "";
        }else{
            $out_data["status"] = "Fail";
            $out_data["message"] = "Could not delete the row.";
        }
        $this->response($out_data);
    }
    
    public function delete_quiz(){
        $out_data = array();
        $id = $this->input->post('id');
        if($this->Exam_model->deleteQuiz($id)){
            $out_data["status"] = "Success";
            $out_data["message"] = "";
        }else{
            $out_data["status"] = "Fail";
            $out_data["message"] = "Could not delete the row.";
        }
        $this->response($out_data);
    }
    
    public function save_exam_title(){
        $exam_id = $this->input->post('exam_id');
        $data["title"] = $this->input->post('title');
        $data["type"] = $this->input->post('type');
        $data["description"] = $this->input->post('description');
        $data["instruction"] = $this->input->post('instruction');
        $image_path = "";
        if($_FILES['exam_image']['name'] != ""){
            $_FILES['exam_image']['name'] = microtime(true) . '.' . pathInfo($_FILES['exam_image']['name'], PATHINFO_EXTENSION);
            $data['image_path'] = $_FILES['exam_image']["name"];
            $image_path = $data['image_path'];
        }
        if($exam_id == "0"){
            $exam_id = $this->Exam_model->insert($data);
        }else{
            $this->Exam_model->update($data, $exam_id);
        }
        if($_FILES['exam_image']['name'] != ""){
            $upload_path = sprintf('%sexam/', PATH_UPLOAD);
            if(!file_exists($upload_path)){
                $this->makeDirectory($upload_path);
            }
            $_FILES['exam_image']['name'] = sprintf('%s', $_FILES['exam_image']['name']);
            $_FILES['exam_image']['type'] = $_FILES['exam_image']['type'];
            $_FILES['exam_image']['tmp_name'] = $_FILES['exam_image']['tmp_name'];
            $_FILES['exam_image']['size'] = $_FILES['exam_image']['size'];
            $_FILES['exam_image']['error'] = $_FILES['exam_image']['error'];
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = '*';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if(!$this->upload->do_upload('exam_image')){
                $error = array('error' => $this->upload->display_errors());
            }else{
                $data = array('upload_data' => $this->upload->data());
            }
        }
        echo json_encode(array("exam_id" => $exam_id, "image_path" => $image_path));
    }
    
    public function add_exam_manual(){
        $user_id = $this->session->get_userdata() ['user_id'];
        $exam_id = $this->input->post('exam_id');
        $data["limit_time"] = $this->input->post('limit_time');
        $data["min_percent"] = $this->input->post('min_percent');
        $data["certificate_id"] = $this->input->post('certificate_id');
        $data["marker1_id"] = $this->input->post('marker1_id');
        $data["marker2_id"] = $this->input->post('marker2_id');
        $data["observer_id"] = $this->input->post('observer_id');
        $data["create_id"] = $user_id;
        $data["type"] = "Manual";
        if($exam_id == "0"){
            $exam_id = $this->Exam_model->insert($data);
        }else{
            $this->Exam_model->update($data, $exam_id);
        }
        redirect('instructor/exam');
    }
    
    public function add_exam_auto(){
        $user_id = $this->session->get_userdata() ['user_id'];
        $exam_id = $this->input->post('exam_id');
        $data["limit_time"] = $this->input->post('limit_time');
        $data["min_percent"] = $this->input->post('min_percent');
        $data["certificate_id"] = $this->input->post('certificate_id');
        $data["create_id"] = $user_id;
        $data["type"] = "Auto";
        if($exam_id == "0"){
            $exam_id = $this->Exam_model->insert($data);
        }else{
            $this->Exam_model->update($data, $exam_id);
        }
        redirect('instructor/exam');
    }
    
    public function create_quiz(){
        $type = $this->input->post('quiz_type');
        $id = $this->input->post('quiz_id');
        $side_params = array('selected_menu_id' => '11-1');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        if($type == null){
            $this->global["id"] = $id;
            $this->global['qData'] = $this->Exam_model->getRowQuiz($id);
            $this->global['qData']['content'] = json_decode($this->global['qData']['content'], true);
            $this->global['exam_id'] = $this->global['qData']['exam_id'];
            $this->global['quiz_code'] = $this->global['qData']['quiz_code'];
            $this->global['is_only_quiz'] = 1;
            $this->global["question_count"] = count($this->Exam_model->getQuizList($this->global['exam_id']));
            switch ($this->global['qData']['type']){
                case 'multi-choice':
                    $this->global['title'] = 'Multi Choice';
                    $this->loadViews("instructor/exam/multi_choice", $this->global, NULL, NULL);
                break;
                case 'checkbox':
                    $this->global['title'] = 'Checkbox';
                    $this->loadViews("instructor/exam/checkbox", $this->global, NULL, NULL);
                break;
                case 'true-false':
                    $this->global['title'] = 'True / False';
                    $this->loadViews("instructor/exam/true_false", $this->global, NULL, NULL);
                break;
                case 'fill-blank':
                    $this->global['title'] = 'Fill in the Blank';
                    $this->loadViews("instructor/exam/fill_blank", $this->global, NULL, NULL);
                break;
                case 'essay':
                    $this->global['title'] = 'Essay';
                    $this->loadViews("instructor/exam/essay", $this->global, NULL, NULL);
                break;
                case 'matching':
                    $this->global['title'] = 'Matching';
                    $this->loadViews("instructor/exam/matching", $this->global, NULL, NULL);
                break;
                default:
            }
        }else{
            switch ($type){
                case '1':
                    $this->multiChoiceQuiz();
                break;
                case '2':
                    $this->checkboxQuiz();
                break;
                case '3':
                    $this->trueFalseQuiz();
                break;
                case '4':
                    $this->fillBlankQuiz();
                break;
                case '5':
                    $this->matchingQuiz();
                break;
                default:
                    $url = '';
            }
        }
    }

    public function multiChoiceQuiz(){
        $side_params = array('selected_menu_id' => '11-1');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        $this->global["id"] = !empty($this->input->post('id')) ? $this->input->post('id') : 0;
        $this->global['title'] = 'Multi Choice';
        $this->global['qData'] = $this->Exam_model->getRowQuiz($this->global["id"]);
        $this->global['is_only_quiz'] = 1;
        $this->loadViews("instructor/exam/multi_choice", $this->global, NULL, NULL);
    }

    public function matchingQuiz(){
        $side_params = array('selected_menu_id' => '11-1');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        $this->global["id"] = !empty($this->input->post('id')) ? $this->input->post('id') : 0;
        $this->global['title'] = 'Matching';
        $this->global['qData'] = $this->Exam_model->getRowQuiz($this->global["id"]);
        $this->global['is_only_quiz'] = 1;
        $this->loadViews("instructor/exam/matching", $this->global, NULL, NULL);
    }

    public function fillBlankQuiz(){
        $side_params = array('selected_menu_id' => '11-1');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        $this->global["id"] = !empty($this->input->post('id')) ? $this->input->post('id') : 0;
        $this->global['title'] = 'Fill in the Blank';
        $this->global['qData'] = $this->Exam_model->getRowQuiz($this->global["id"]);
        $this->global['is_only_quiz'] = 1;
        $this->loadViews("instructor/exam/fill_blank", $this->global, NULL, NULL);
    }

    public function trueFalseQuiz(){
        $side_params = array('selected_menu_id' => '11-1');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        $this->global["id"] = !empty($this->input->post('id')) ? $this->input->post('id') : 0;
        $this->global['title'] = 'True / False';
        $this->global['qData'] = $this->Exam_model->getRowQuiz($this->global["id"]);
        $this->global['is_only_quiz'] = 1;
        $this->loadViews("instructor/exam/true_false", $this->global, NULL, NULL);
    }

    public function checkboxQuiz(){
        $side_params = array('selected_menu_id' => '11-1');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        $this->global["id"] = !empty($this->input->post('id')) ? $this->input->post('id') : 0;
        $this->global['title'] = 'Checkbox';
        $this->global['qData'] = $this->Exam_model->getRowQuiz($this->global["id"]);
        $this->global['is_only_quiz'] = 1;
        $this->loadViews("instructor/exam/checkbox", $this->global, NULL, NULL);
    }

    public function multiChoice($exam_id = 0){
        $this->global["id"] = !empty($this->input->post('id')) ? $this->input->post('id') : 0;
        $this->global['title'] = 'Multi Choice';
        $this->global['exam_id'] = $exam_id;
        $this->global['qData'] = $this->Exam_model->getRowQuiz($this->global["id"]);
        $this->global["question_count"] = count($this->Exam_model->getQuizList($exam_id));
        $this->loadViews("instructor/exam/multi_choice", $this->global, NULL, NULL);
    }

    public function matching($exam_id = 0){
        $this->global["id"] = !empty($this->input->post('id')) ? $this->input->post('id') : 0;
        $this->global['title'] = 'Matching';
        $this->global['exam_id'] = $exam_id;
        $this->global['qData'] = $this->Exam_model->getRowQuiz($this->global["id"]);
        $this->global["question_count"] = count($this->Exam_model->getQuizList($exam_id));
        $this->loadViews("instructor/exam/matching", $this->global, NULL, NULL);
    }

    public function essay($exam_id = 0){
        $this->global["id"] = !empty($this->input->post('id')) ? $this->input->post('id') : 0;
        $this->global['title'] = 'Essay';
        $this->global['exam_id'] = $exam_id;
        $this->global['qData'] = $this->Exam_model->getRowQuiz($this->global["id"]);
        $this->global["question_count"] = count($this->Exam_model->getQuizList($exam_id));
        $this->loadViews("instructor/exam/essay", $this->global, NULL, NULL);
    }

    public function fillBlank($exam_id = 0){
        $this->global["id"] = !empty($this->input->post('id')) ? $this->input->post('id') : 0;
        $this->global['title'] = 'Fill in the Blank';
        $this->global['exam_id'] = $exam_id;
        $this->global['qData'] = $this->Exam_model->getRowQuiz($this->global["id"]);
        $this->global["question_count"] = count($this->Exam_model->getQuizList($exam_id));
        $this->loadViews("instructor/exam/fill_blank", $this->global, NULL, NULL);
    }

    public function trueFalse($exam_id = 0){
        $this->global["id"] = !empty($this->input->post('id')) ? $this->input->post('id') : 0;
        $this->global['title'] = 'True / False';
        $this->global['exam_id'] = $exam_id;
        $this->global['qData'] = $this->Exam_model->getRowQuiz($this->global["id"]);
        $this->global["question_count"] = count($this->Exam_model->getQuizList($exam_id));
        $this->loadViews("instructor/exam/true_false", $this->global, NULL, NULL);
    }

    public function checkbox($exam_id = 0){
        $this->global["id"] = !empty($this->input->post('id')) ? $this->input->post('id') : 0;
        $this->global['title'] = 'Checkbox';
        $this->global['exam_id'] = $exam_id;
        $this->global['qData'] = $this->Exam_model->getRowQuiz($this->global["id"]);
        $this->global["question_count"] = count($this->Exam_model->getQuizList($exam_id));
        $this->loadViews("instructor/exam/checkbox", $this->global, NULL, NULL);
    }

    public function addMultiRow(){
        $data['count'] = $this->input->post('count');
        $this->load->view('instructor/exam/multiple-choice-row', $data);
    }

    public function addCheckboxRow(){
        $data['count'] = $this->input->post('count');
        $this->load->view('instructor/exam/checkbox-row', $data);
    }

    public function addBlankRow(){
        $data['count'] = $this->input->post('count');
        $this->load->view('instructor/exam/blank-row', $data);
    }

    public function addMatchingRow(){
        $data['count'] = $this->input->post('count');
        $this->load->view('instructor/exam/matching-row', $data);
    }

    public function saveQuestion(){
        $type = $this->input->post('que_type');
        $exam_id = $this->input->post('exam_id');
        $quiz_code = $this->input->post('quiz_code');
        $quesdata['type'] = $type;
        $quesdata['ques_title'] = $this->input->post('ques_title');
        $quesdata['feedback'] = $this->input->post('feedback');
        $quesdata['tags'] = $this->input->post('tags');
        switch ($type){
            case 'multi-choice':
                $order = $this->input->post('order');
                $correctCheck = $this->input->post('correctCheck');
                for ($i = 0;$i < count($order);$i++){
                    if($order[$i] == $correctCheck[0]){
                        $correctCheck[0] = $i;
                        break;
                    }
                }
                $quesdata['content'] = array('correctCheck' => $correctCheck, 'checkbox' => $this->input->post('checkbox'));
            break;
            case 'checkbox':
                $order = $this->input->post('order');
                $correctCheck = $this->input->post('correctCheck');
                $correct = array();
                for ($i = 0;$i < count($order);$i++){
                    for ($j = 0;$j < count($correctCheck);$j++){
                        if($order[$i] == $correctCheck[$j]){
                            $correct[$j] = $i;
                        }
                    }
                }
                $quesdata['content'] = array('correctCheck' => $correct, 'checkbox' => $this->input->post('checkbox'));
            break;
            case 'true-false':
                $order = $this->input->post('order');
                $settrue = $this->input->post('settrue');
                if($order[0] == $settrue){
                    $settrue = 0;
                }else{
                    $settrue = 1;
                }
                $quesdata['content'] = array('tf' => $this->input->post('tf'), 'settrue' => $settrue);
            break;
            case 'fill-blank':
                $blank = str_replace('[Blank]', '__', $_POST['ques_title']);
                $quesdata['ques_title'] = $blank;
                $quesdata['content'] = array('blank' => $this->input->post('blank'));
            break;
            case 'essay':
                $quesdata['content'] = $this->input->post('max-length');
            break;
            case 'matching':
                $quesdata['content'] = array('choice' => $this->input->post('choice'), 'match' => $this->input->post('match'));
            break;
            default:
        }
        if($type != "essay"){
            $quesdata['content'] = json_encode($quesdata['content']);
        }
        $quesdata['exam_id'] = $exam_id;
        $quesdata['quiz_code'] = $quiz_code;
        $quesdata['company_id'] = $this->session->get_userdata() ['company_id'];
        $update = $this->input->post('edit');
        $queFile = $this->do_upload();
        if($queFile !== FALSE && is_array($queFile)){
            $quesdata['ques_file'] = $queFile['file_name'];
        }
        if($update != ''){
            $this->Exam_model->updateQuiz($quesdata, $update);
        }else{
            $quesdata['position'] = $this->input->post('position');
            $quiz_id = $this->Exam_model->insertQuiz($quesdata);
        }
        if($this->input->post('is_only_quiz') == 1){
            redirect('instructor/exam/viewQuizList');
        }else{
            redirect('instructor/exam/create?row_id=' . $exam_id);
        }
    }

    public function editQuestion($id){
        $this->global["id"] = $id;
        $this->global['qData'] = $this->Exam_model->getRowQuiz($id);
        $this->global['qData']['content'] = json_decode($this->global['qData']['content'], true);
        $this->global['exam_id'] = $this->global['qData']['exam_id'];
        $this->global["question_count"] = count($this->Exam_model->getQuizList($this->global['exam_id']));
        switch ($this->global['qData']['type']){
            case 'multi-choice':
                $this->global['title'] = 'Multi Choice';
                $this->loadViews("instructor/exam/multi_choice", $this->global, NULL, NULL);
            break;
            case 'checkbox':
                $this->global['title'] = 'Checkbox';
                $this->loadViews("instructor/exam/checkbox", $this->global, NULL, NULL);
            break;
            case 'true-false':
                $this->global['title'] = 'True / False';
                $this->loadViews("instructor/exam/true_false", $this->global, NULL, NULL);
            break;
            case 'fill-blank':
                $this->global['title'] = 'Fill in the Blank';
                $this->loadViews("instructor/exam/fill_blank", $this->global, NULL, NULL);
            break;
            case 'essay':
                $this->global['title'] = 'Essay';
                $this->loadViews("instructor/exam/essay", $this->global, NULL, NULL);
            break;
            case 'matching':
                $this->global['title'] = 'Matching';
                $this->loadViews("instructor/exam/matching", $this->global, NULL, NULL);
            break;
            default:
        }
    }

    public function cloneQuestion(){
        $id = $this->input->post('id');
        $quiz = $this->Exam_model->getRowQuiz($id);
        unset($quiz['id']);
        unset($quiz['position']);
        $quiz['position'] = $this->Exam_model->getMaxPosition($id) ['max_pos'];
        $this->Exam_model->insertQuiz($quiz);
    }

    public function removeQuestion(){
        $id = $this->input->post('id');
        $this->Exam_model->updatePositionByDelete($id);
        $this->Exam_model->deleteQuiz($id);
    }

    public function update_position(){
        $exam_id = $this->input->post('exam_id');
        $id = $this->input->post('id');
        $start_pos = $this->input->post('startpos');
        $new_pos = $this->input->post('newpos');
        $this->Exam_model->updatePositionOther($exam_id, $start_pos, $new_pos);
        $this->Exam_model->updatePosition($id, $start_pos, $new_pos);
    }

    public function showPreviewQuestion($exam_id = 0){
        if($this->isInstructor()){
            $this->global['show_button'] = TRUE;
            $this->global['exam_show_type'] = $this->Exam_model->getRow($exam_id) [0]['solution_flag'];
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
                    return;
                }
            }
            $this->global['question']['content'] = json_decode($this->global['question']['content'], true);
            $this->global['id'] = $this->global['question']['position'];
            $this->global['next'] = $this->global['id'] + 1;
            $this->global['end'] = $quiz_count - 1;
            if($this->input->post('id') != ''){
                $this->load->view('instructor/exam/showPreviewQuestion', $this->global);
            }else{
                $this->loadViews("instructor/exam/showPreviewQuestion", $this->global, NULL, NULL);
            }
        }else{
            $this->loadViews("access", $this->global, NULL , NULL);
        }
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
                $this->load->view("instructor/exam/reportcard/multichoice", $checkData);
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
                $this->load->view("instructor/exam/reportcard/checkbox", $checkData);
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
                $this->load->view("instructor/exam/reportcard/true_false", $checkData);
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
                $this->load->view("instructor/exam/reportcard/fill_blank", $checkData);
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
                $this->load->view("instructor/exam/reportcard/matching", $checkData);
                break;
            }
            if(count($this->Exam_model->getUserAnswer($user_id, $ansArry['current_q_id'])) == 0){
                $this->Exam_model->insertUserAnswer(array("user_id" => $user_id, "quiz_id" => $ansArry['current_q_id'], "description" => json_encode($ansArry), "mark1" => $mark));
            }else{
                $this->Exam_model->updateUserAnswer($user_id, $ansArry['current_q_id'], json_encode($ansArry), $mark);
            }
    }

    function reportCard($exam_id = 0){
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
        $this->global['certificate'] = $this->Certification_model->getRowById($this->Exam_model->getRow($exam_id) [0]['certificate_id']) ['content'];
        $this->global['certificate'] = str_replace("{USER_NAME}", $this->global['user_name'], $this->global['certificate']);
        $this->global['certificate'] = str_replace("{EXAM_DATE}", $exam_history['exam_end_at'], $this->global['certificate']);
        $this->global['certificate'] = str_replace("{EXAM_TITLE}", $this->Exam_model->getRow($exam_id) [0]['title'], $this->global['certificate']);
        $this->global['certificate'] = str_replace("{EXAM_SCORE}", $this->global['score'], $this->global['certificate']);
        $this->Exam_model->deleteExamHistory($user_id, $exam_id);
        $this->loadViews("instructor/exam/reportCard", $this->global, NULL, NULL);
    }

    public function do_upload($filename = 'userfile'){
        $config['upload_path'] = './assets/uploads/exam/quiz';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        if(!$this->upload->do_upload($filename)){
            $error = array('error' => $this->upload->display_errors());
            return false;
        }else{
            $data = $this->upload->data();
            return $data;
        }
    }
}
?>