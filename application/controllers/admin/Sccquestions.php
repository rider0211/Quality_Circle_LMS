<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
class Sccquestions extends BaseController{
    /**
     * This is default constructor of the class
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('sccquestions_model');
        $this->load->model('sccanswers_model');
        $this->isLoggedIn();
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '5-5');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
    }

    public function index() {
        $this->viewlist();
    }

    public function viewlist() {
        $this->loadViews('admin/sccquestions/sccquestions_list', $this->global, NULL, NULL);
    }

    public function getlist() {
        $filter = $this->input->post();
        $data["recordsTotal"] = $this->sccquestions_model->count();
        $data["recordsFiltered"] = $this->sccquestions_model->count($filter);
        $data["data"] = $this->sccquestions_model->getlist($filter);
        $this->response($data);
    }

    public function preview($id) {
        $sgu_id = $this->input->post("sgu_id");
        $data["question"] = $this->sccquestions_model->select($sgu_id);
        $data["answers"] = $this->sccanswers_model->select($sgu_id);
        $this->loadViews("admin/sccquestions/sccquestions_preview", $this->global, $data);
    }

    public function check() {
        $sgu_id = $this->input->post("sgu_id");
        $solution = $this->input->post("solution");
        $answer_row = $this->sccanswers_model->select($sgu_id, $solution);
        if ($answer_row[0]["right_answer"]) echo "Right";
        else echo "Fail";
    }

}
