<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
/**
 * Class : Examhistory (ExamController)
 * Examhistory Class to control all Examhistory operations.
 * @author : ping
 * @version : 1.0
 * @since : 11 July 2018
 */
class Examhistory extends BaseController {
    /**
     * This is default constructor of the class
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('Exam_model');
        $this->load->model('Quiz_model');
        $this->load->model('Examassign_model');
        $this->load->model('Examhistory_model');
        $this->isLoggedIn();
        $this->isLearner();
    }
    /**
     * This function used to load the default screen of exam menu
     */
    public function index(){
    }
    
    public function viewExamHistory(){
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '2');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        if($this->isLearner()){
            $this->loadViews("learner/exam/examhistory", $this->global, NULL, NULL);
        }else{
           // $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function viewSCCHistory(){
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '2');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        if($this->isLearner()){
            $this->loadViews("learner/analysis/scchistory", $this->global, NULL, NULL);
        }else{
            //$this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function getExamhistoryList(){
        $sessiondata = $this->session->get_userdata();
        $company_id = $sessiondata['company_id'];
        $user_id = $sessiondata['user_id'];
        $type = $this->input->post('type');
        $limit = $this->input->post('limit');
        //        if(!isset($type))
        //            $type = "general";
        //        $cond = array("a.exam_type"=>$type);
        $cond = array("a.user_id" => $user_id);
        $table_data = $this->Examhistory_model->getList($cond, $limit);
        foreach ($table_data["data"] as $key => $row){
            $table_data["data"][$key]["start_seconds"] = strtotime($table_data["data"][$key]["exam_start_at"]);
            $table_data["data"][$key]["end_seconds"] = strtotime($table_data["data"][$key]["exam_end_at"]);
        }
        $records["data"] = $table_data['data'];
        //$records["recordsTotal"] = $total;
        $records['recordsTotal'] = $table_data["total"];
        $records['recordsFiltered'] = $table_data['filtertotal'];
        $this->response($records);
    }
    
    public function getExamhistoryItem(){
        $id = $this->input->post('id');
        $examlist = $this->Examhistory_model->getRow($id);
        if(sizeof($examlist) > 0){
            echo $examlist[0]['user_sign_image'];
        }else{
            echo "";
        }
    }
    
    public function check($id = NULL){
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '2');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        if($this->isLearner()){
            $this->global['quiz_number'] = $this->Examhistory_model->getQuizNumber($id) ["quiz_num"];
            $this->global['exam_info'] = $this->Examhistory_model->getExamInfo($id);
            $this->global['exam_quiz_info'] = $this->Examhistory_model->getExamQuizInfo($id);
            $this->global['markers'] = $this->Examhistory_model->getExamMarker($id);
            $this->global['exam_user'] = $this->Examhistory_model->getExamUser($id);
            $this->global['exam_history'] = $this->Examhistory_model->getExamHistory($id);
            //            print_r($this->global['exam_quiz_info']);
            //            die(0);
            $this->loadViews("learner/exam/exam_check", $this->global, NULL, NULL);
        }else{
            //$this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function feedback($id = NULL){
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '2');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        if($this->isLearner()){
            $this->global['exam_history'] = $this->Examhistory_model->getExamhistoryData($id);
			$this->global['feedback'] = $this->Examhistory_model->getExamFeedback($id);
            $this->loadViews("learner/exam/exam_feedback", $this->global, NULL, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
}
?>
