<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Trainingassign (TrainingassignController)
 * Trainingassign Class to control all Trainingassign related operations.
 * @author : ping
 * @version : 1.0
 * @since : 30 June 2018
 */
class Trainingassign extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Trainingassigncompany_model');
        $this->load->model('Trainingassignemployee_model');
        $this->load->model('Topic_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the default screen of trainingassign menu
     */
    public function index()
    {
        $this->viewList();
    }


    public function viewList()
    {
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id'=>'4-4');      
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);

            
        if($this->isFasi()) 
        {   
            $this->loadViews("fasi/trainingassign/trainingassign_list", $this->global, NULL , NULL);   
        } 
        else 
        {
            $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL , NULL);   
        }  
    }


    public function viewCreate()
    {
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id'=>'4-4');      
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);

        if($this->isFasi()) 
        {               
            /*$page_data[company_row_id] = intval($this->input->post('company_row_id'));
            $row_data = $this->Trainingassigncompany_model->getRow($page_data[company_row_id]);   
            $page_data[assign_row] = $row_data[0];*/

            $row_id = $this->input->post('company_row_id');
            $split = explode("-", $row_id);
            $page_data["id"] = $split[1];
            if ($split[0] == 'fasi')
                $row_data = $this->Trainingassignfasi_model->getRow($page_data["id"]);
            else if ($split[0] == 'company')
                $row_data = $this->Trainingassigncompany_model->getRow($page_data["id"]);
            else
                $row_data = $this->Trainingassignemployee_model->getRow($page_data["id"]);

            $page_data["assign_row"] = $row_data[0];

            $this->loadViews("fasi/trainingassign/trainingassign_edit", $this->global, $page_data , NULL);   
        } 
        else 
        {
            $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL , NULL);   
        }  
    }


    public function getValidList()
    {
        $sessiondata = $this->session->get_userdata();
        $this->load->model('Trainingassignfasi_model');
        $topic_list = $this->Trainingassignfasi_model->getAssignedList($sessiondata["userId"]); 

        foreach ($topic_list as $key => $topic) {
            $topic_list[$key]["row_id"] = null;
        }

        $records["results"] = $topic_list; 

        $this->response($records); 
    }

    public function saveAssignInfo()
    {
        $assign_data["company_id"] = intval($this->input->post('company_id'));
        $assign_info = json_decode($this->input->post('training_info'));

        if(isset($assign_info->row_id)) {
            //update
            $assign_data["start_date"] = $assign_info->startdate;
            $row_id = $assign_info->row_id;
            $this->Trainingassigncompany_model->updateTrainingassign($assign_data, $row_id); 
        } else {
            //insert
            $sessiondata = $this->session->get_userdata();
            $assign_data["topic_id"] = $assign_info->id;
            $assign_data["start_date"] = $assign_info->startdate;
            $assign_data["fasi_email"] = $sessiondata["email"];

            $row_id = $this->Trainingassigncompany_model->saveTrainingassign($assign_data);
        }

        print $row_id;
    }

    public function removeAssignInfo()
    {
        $assign_data["company_id"] = intval($this->input->post('company_id'));
        $assign_info = json_decode($this->input->post('training_info'));

        if(isset($assign_info->row_id)) {
            //update
            print $this->Trainingassigncompany_model->deleteTrainingassign($assign_info->row_id); 
        } 

        print false;
    }

    public function deleteTrainingassign()
    {
        $id = intval($this->input->post('id'));
          
        $out_data = array();
        if($this->Trainingassigncompany_model->deleteTrainingassign($id)) 
        {
            $out_data["status"] = "Success";
            $out_data["message"] = "";
        } 
        else 
        {            
            $out_data["status"] = "Fail";
            $out_data["message"] = "Could not delete the row.";
        }

        $this->response($out_data); 
    } 



    /**
     * This function used to load Trainingassign Add Form
     */
    public function getList()
    {
        if($this->isFasi()) 
        {   
            $company_id = intval($this->input->post('company_id'));
            $sessiondata = $this->session->get_userdata();
            $fasi_email = $sessiondata['email'];
            $search_cond = array();

            if($fasi_email) {
                $search_cond['email'] = $fasi_email;
            }

            $data_rows = $this->Trainingassigncompany_model->getPagingList($search_cond); 

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


    public function getCompanyInfo()
    {
        if($this->isFasi()) 
        { 
            $id = intval($this->input->post('row_id'));  
            if($id > 0) {
                $assign_row = $this->Trainingassign_model->getCompanyRow($id);
                $topic_list = json_decode($assign_row[0]["topic_list"]);

                $title_row_data = $this->Topic_model->getTrainingTitleList($topic_list);
                
                $title_list = array();
                foreach ($title_row_data as $key => $topic_row) {
                    $title_list[] = $topic_row["training_title"];
                }
                $assign_row[0]['topic_title_list'] = implode(", ", $title_list);

                $this->response($assign_row); 
            }
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
            $c_id = intval($this->input->post('company_id'));  
            if($c_id) 
            {                
                $assign_row = $this->Trainingassigncompany_model->getAssignedList($c_id);
                $this->response($assign_row); 
            }
        } 
        else  
        {
            $this->response(array());  
        }
    }

    public function selectable() {
        $params = $this->input->post();
        
        $sessiondata = $this->session->get_userdata();
        $params["fasi_id"] = $sessiondata["user_id"];
        
        $data["trainings"] = $this->Trainingassigncompany_model->selectableList($params);

        $this->load->view("admin/trainingassign/selectable",$data);
    }

    public function selected() {
        $params = $this->input->post();
        $data["trainings"] = $this->Trainingassigncompany_model->getAssignedList($params);
        $this->load->view("admin/trainingassign/selected",$data);
    }

    public function assign() {
        $sessiondata = $this->session->get_userdata();
        $cid = $this->input->post("company_id");
        $tid = $this->input->post("topic_id");
        $date = date("Y-m-d");
        $this->Trainingassigncompany_model->assign($cid,$tid,$date,$sessiondata["email"]);
        $this->response(array("success"=>true));
    }

    public function release() {
        $id = $this->input->post("id");
        $this->Trainingassigncompany_model->release($id);
        $this->response(array("success"=>true));
    }

    public function update() {
        $id = $this->input->post("id");
        $date = $this->input->post("date");
        $this->Trainingassigncompany_model->update($id,$date);
        $this->response(array("success"=>true));
    }
     
}

?>
