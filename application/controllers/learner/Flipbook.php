<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Flipbook extends BaseController{

    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Library_model');
        $this->load->model('Translate_model');
        $this->isLoggedIn();
        $this->isLearner();
    }

    public function view_book($id = ''){
        //$path = $this->input->post('path');
        $res = $this->Library_model->getMyBook($id)[0];
        $page_data['path'] = base_url().$res['file_path'];
        $this->load->view('learner/flipbook/wowbook', $page_data);
    }

}
