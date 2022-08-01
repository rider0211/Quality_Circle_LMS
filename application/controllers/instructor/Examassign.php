<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Examassign (ExamassignController)
 * Examassign Class to control all Examassign related operations.
 * @author : ping
 * @version : 1.0
 * @since : 30 June 2018
 */
class Examassign extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Examassignfasi_model');
        $this->load->model('Examassigncompany_model');
        $this->load->model('Examassignemployee_model');

        $this->load->model('Exam_model');
        $this->isLoggedIn(); $this->load->library('Sidebar');
        $side_params = array('selected_menu_id'=>'5-4');      
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);

    }
    
    /**
     * This function used to load the default screen of examassign menu
     */
    public function index()
    {
        $this->viewList();
    }


    public function viewlist()
    {
        if($this->isFasi()) 
        {   
            $this->loadViews("fasi/examassign/examassign_list", $this->global, NULL , NULL);   
        } 
        else 
        {
            $this->global["sidebar"] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL , NULL);   
        }  
    }

    public function viewCreate()
    {
        if($this->isFasi()) 
        {               
            $row_id = $this->input->post('company_row_id');
            $split = explode("-", $row_id);
            $page_data["id"] = $split[1];

            if ($split[0] == 'fasi')
                $row_data = $this->Examassignfasi_model->getRow($page_data["id"]);
            else if ($split[0] == 'company')
                $row_data = $this->Examassigncompany_model->getRow($page_data["id"]);
            else
                $row_data = $this->Examassignemployee_model->getRow($page_data["id"]);

            $page_data["assign_row"] = $row_data[0];
            $this->loadViews("fasi/examassign/examassign_edit", $this->global, $page_data , NULL);   
        } 
        else 
        {
            $this->global["sidebar"] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL , NULL);   
        }  
    }


    /**
     * This function used to load Examassign Add Form
     */
    public function getList()
    {
        if($this->isFasi()) 
        {   
            $sessiondata = $this->session->get_userdata();
            $fasi_email = $sessiondata['email'];
            $search_cond = array();

            if($fasi_email) {
                $search_cond['email'] = $fasi_email;
            }

            $data_rows = $this->Examassigncompany_model->getPagingList($search_cond); 

            $records["data"] = $data_rows["data"];        
            $records["recordsTotal"] = $data_rows["total"];
            $records["recordsFiltered"] = $data_rows["filtertotal"];

            $this->response($records);   
        } 
        else 
        {
            $this->response(array());  
        }
    }


    public function getAssignedList()
    {
        if($this->isFasi()) 
        { 
            $f_id = intval($this->input->post('company_id'));  
            if($f_id) 
            {                
                $assign_row = $this->Examassigncompany_model->getAssignedList($f_id);

                $this->response($assign_row); 
            }
        } 
        else  
        {
            $this->response(array());  
        }
    }

    public function deleteExamassign()
    {
        $id = intval($this->input->post('id'));
          
        $out_data = array();
        if($this->Examassigncompany_model->release($id)) 
        {
            $out_data['status'] = "Success";
            $out_data["message"] = "";
        } 
        else 
        {            
            $out_data["status"] = "Fail";
            $out_data["message"] = "Could not delete the row.";
        }

        $this->response($out_data); 
    }  

    public function selectable() {
        $params = $this->input->post();

        if($params["type"]=="Company"){
            $params["company_id"] = $params["assigned_id"];
            unset($params["assigned_id"]);
            $sessiondata = $this->session->get_userdata();
            $params["fasi_id"] = $sessiondata["user_id"];

            $data["exams"] = $this->Examassigncompany_model->selectableList($params);
        }
        
        $this->load->view("admin/examassign/selectable",$data);
    }

    public function selected() {
        $params = $this->input->post();

        if($params["type"]=="Company"){
            $params["company_id"] = $params["assigned_id"];
            unset($params["assigned_id"]);
            $data["exams"] = $this->Examassigncompany_model->getAssignedList($params);
        }
        
        $this->load->view("admin/examassign/selected",$data);
    }

    public function assign() {
        $sessiondata = $this->session->get_userdata();
        $user_type = $this->input->post("type");
        $assigned_id = $this->input->post("assigned_id");
        $examid = $this->input->post("exam_id");
        $date = $this->input->post("date");
        if($user_type == "Company")
        {
            $this->Examassigncompany_model->assign($assigned_id,$examid,$date,$sessiondata["email"]);
        }
        
        $this->response(array("success"=>true));
    }

    public function release() {
        $id = $this->input->post("id");
        $this->Examassigncompany_model->release($id);
        $this->response(array("success"=>true));
    }

    public function update() {
        $id = $this->input->post("id");
        $date = $this->input->post("date");
        $this->Examassigncompany_model->update($id,$date);
        $this->response(array("success"=>true));
    }
}

?>
