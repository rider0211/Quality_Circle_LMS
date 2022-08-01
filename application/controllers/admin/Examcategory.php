<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
/**
 * Class : Examcategory (ExamcategoryController)
 * Examcategory Class to control all examcategory related operations.
 * @author : ping
 * @version : 1.0
 * @since : 7 July 2018
 */
class Examcategory extends BaseController {
    /**
     * This is default constructor of the class
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('Examcategory_model');
        $this->isLoggedIn();
    }
    /**
     * This function used to load the first screen of the user
     */
    public function index(){
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '5-1');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        if($this->isMasterAdmin()){
            $this->loadViews("admin/examcategory/examcategory_list", $this->global, NULL, NULL);
        }else{
            $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }

    public function viewCreate(){
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '5-1');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        if($this->isMasterAdmin()){
            $row_id = isset($_REQUEST['row_id']) ? intval($_REQUEST['row_id']) : 0;
            if($row_id != 0){
                $category_row = $this->Examcategory_model->getRow($row_id);
                $this->global['category'] = $category_row[0];
            }else{
                $category['id'] = '';
                $category['exam_category_name'] = '';
                $category['exam_category_code'] = '';
                $category['description'] = '';
                $category['status'] = '';
                $category['created_at'] = '';
                $category['updated_at'] = '';
                $this->global['category'] = $category;
            }
            $this->loadViews("admin/examcategory/examcategory_edit", $this->global, NULL, NULL);
        }else{
            //$this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    /**
     * This function used to load All examcategory list
     */
    public function getList(){
        //$total = $this->Examcategory_model->all();
        $out_data = array();
        $table_data = $this->Examcategory_model->getList();
        $records["data"] = $table_data['data'];
        //$records["recordsTotal"] = $total;
        $records['recordsTotal'] = $table_data["total"];
        $records['recordsFiltered'] = $table_data['filtertotal'];
        $this->response($records);
    }
    /**
     * This function used to load actived examcategory list (for select2 )
     */
    public function getCategoryList(){
        $term = isset($_REQUEST["term"]) ? $_REQUEST["term"] : '';
        $records["results"] = $this->Examcategory_model->getCategoryList($term);
        $this->response($records);
    }
    /**
     * This function used to load Actived examcategory list
     */
    public function getExamcategoryList(){
        $table_data = $this->Examcategory_model->getList4Select2($this->input->get('q'));
        $records["results"] = $table_data;
        $this->response($records);
    }

    public function selectrow($id){
        $out_data = $this->Examcategory_model->getRow($id);
        $this->response($out_data);
    }

    public function active(){
        $id = $this->input->post('id');
        return $this->Examcategory_model->active($id);
    }

    public function inactive(){
        $id = $this->input->post('id');
        return $this->Examcategory_model->inactive($id);
    }

    public function saveExamcategory(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('exam_category_name', 'Examcategory', 'required|max_length[50]|trim');
        $this->form_validation->set_rules('exam_category_code', 'Examcategorycode', 'required|max_length[50]|trim');
        if($this->form_validation->run() == FALSE){
            //$this->loadViews("admin/examcategory/examcategory_edit", $this->global, NULL , NULL);
            //$this->load->view('myform');
            redirect('admin/examcategory/create');
        }else{
            $examcategory_data['id'] = $this->input->post('row_id');
            $examcategory_data['exam_category_name'] = $this->input->post('exam_category_name');
            $examcategory_data['exam_category_code'] = $this->input->post('exam_category_code');
            $examcategory_data['description'] = $this->input->post('description');
            if($examcategory_data['id'] == 0) $row_id = $this->Examcategory_model->insert($examcategory_data);
            else {
                $this->Examcategory_model->update($examcategory_data, $examcategory_data['id']);
            }
            redirect('admin/examcategory');
        }
    }

    public function delete(){
        $out_data = array();
        $id = $this->input->post('id');
        if($this->Examcategory_model->delete($id)){
            $out_data["status"] = "Success";
            $out_data["message"] = "";
        }else{
            $out_data["status"] = "Fail";
            $out_data["message"] = "Could not delete the row.";
        }
        $this->response($out_data);
    }
}
?>