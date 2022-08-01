<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
class Quizzes extends BaseController {
    /**
     * This is default constructor of the class
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('Quiz_model');
        $this->isLoggedIn();
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '5-2');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
    }

    public function index(){
        $this->loadViews('admin/quizzes/list', $this->global, NULL, NULL);
    }
    
    public function getlist(){
        $filter = $this->input->post();
        $data["recordsTotal"] = $this->Quiz_model->count();
        $data["recordsFiltered"] = $this->Quiz_model->count($filter);
        $data["data"] = $this->Quiz_model->all($filter);
        $this->response($data);
    }
    
    public function create($type){
        $this->load->model('Examcategory_model');
        $this->load->model('Topic_model');
        $question = array();
        $question["uuid"] = strtoupper(md5(date("Ymdhis")));
        $question["points"] = 100;
        $question["quiz_type"] = $type;
        $question["content"] = array();
        $answers = array();
        if($type == 'TrueFalse' || $type == 'MultipleChoice') $answers = array(array("html" => '', "correct" => true));
        else if($type == 'MultipleResponse' || $type == 'MultipleSwitch') $answers = array(array("html" => ''));
        else if($type == 'FillInTheBlank') $answers = array(array("html" => ''));
        else if($type == 'Sequence') $answers = array(array("html" => ''));
        else if($type == 'Matching') $question["content"]["column1"] = $question["content"]["column2"] = array(array("id" => 0, "html" => ''));
        else if($type == 'WordBank') $answers = array("extra" => array(''));
        else if($type == 'Numeric') $answers = array('');
        else if($type == 'Grouping') $answers = array(array("html" => "", "items" => array("")));
        $question["content"]["answers"] = $answers;
        if($type == 'TrueFalse' && !$question["content"]["message"]) $question["content"]["message"] = array("True", "False");
        if($type == 'MultipleSwitch' && !$question["content"]["message"]) $question["content"]["message"] = array("true" => "True", "false" => "False");
        if($type == 'Numeric') $question["operators"] = array('equal' => 'Equal', 'notEqual' => 'Not Equal', 'greaterThan' => 'Greater Than', 'greaterThanOrEqual' => 'Greate Than Or Equal', 'lessThan' => 'Less Than', 'lessThanOrEqual' => 'Less Than Or Equal', 'between' => 'Between');
        if($type == 'MultipleChoiceText' || $type == 'MultipleChoiceLine' || $type == 'Correct'){
            $data["types"] = array("MultipleChoiceText", "MultipleChoiceLine", "Correct");
        } else if($type == 'MultipleResponse' || $type == 'MultipleSwitch'){
            $data["types"] = array("MultipleResponse", "MultipleSwitch");
        }
        $data["question"] = $question;
        $data["categories"] = $this->Examcategory_model->getCategoryList();
        $data["topics"] = $this->Topic_model->getAllSimpleList();
        $this->loadViews("admin/quizzes/edit", $this->global, $data, NULL);
    }
    
    public function edit($id){
        $this->load->model('Examcategory_model');
        $this->load->model('Topic_model');
        $data["question"] = $this->Quiz_model->select($id);
        $data["categories"] = $this->Examcategory_model->getCategoryList();
        $data["topics"] = $this->Topic_model->getAllSimpleList();
        $type = $data["question"]["quiz_type"];
        if($type == 'Numeric') $data["question"]["operators"] = array('equal' => 'Equal', 'notEqual' => 'Not Equal', 'greaterThan' => 'Greater Than', 'greaterThanOrEqual' => 'Greate Than Or Equal', 'lessThan' => 'Less Than', 'lessThanOrEqual' => 'Less Than Or Equal', 'between' => 'Between');
        if($type == 'MultipleChoiceText' || $type == 'MultipleChoiceLine' || $type == 'Correct'){
            $data["types"] = array("MultipleChoiceText", "MultipleChoiceLine", "Correct");
        } else if($type == 'MultipleResponse' || $type == 'MultipleSwitch'){
            $data["types"] = array("MultipleResponse", "MultipleSwitch");
        }
        $this->loadViews("admin/quizzes/edit", $this->global, $data, NULL);
    }
    
    public function save(){
        $params = $this->input->post();
        $path_parts = pathinfo($_FILES['image']['name']);
        $params["quiz_obj_path"] = $this->generateFileName() . "." . $path_parts['extension'];
        $upload_path = sprintf('%squiz/', PATH_UPLOAD);
        if(!file_exists($upload_path)){
            $this->makeDirectory($upload_path);
        }
        if(!empty($_FILES['image']['name'])){
            $_FILES['image']['name'] = $params["quiz_obj_path"];
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = '*';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if(!$this->upload->do_upload('image')){
                $error = array('error' => $this->upload->display_errors());
                //$this->load->view('upload_form', $error);                
            }else{
                $data = array('upload_data' => $this->upload->data());
                //$this->load->view('upload_success', $data);                
            }
        }
        $params["quiz_obj_path"] = 'assets/uploads/quiz/' . $params["quiz_obj_path"];
        if(empty($_FILES['image']['name'])){
            $params["quiz_obj_path"] = '';
        }
        $qid = $this->Quiz_model->save($params);
        redirect("admin/quizzes/index");
    }
    
    public function preview($id){
        $data["question"] = $this->Quiz_model->select($id);
        $this->loadViews("admin/quizzes/preview", $this->global, $data);
    }
    
    public function delete(){
        $id = $this->input->post("id");
        $this->Quiz_model->remove($id);
        $this->response(array("success" => true));
    }
    
    public function check(){
        $id = $this->input->post(id);
        $question = $this->Quiz_model->select($id);
        $solution = $this->input->post("solution");
        $this->load->model("solution_model");
        exit(number_format($this->solution_model->checkup($question, $solution) * 5 / $question["marks"], 2));
    }
    
}
