<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Traininghistory (TraininghistoryController)
 * Traininghistory Class to control all Traininghistory operations.
 * @author : ping
 * @version : 1.0
 * @since : 17 July 2018
 */
class Traininghistory extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Category_model');
        $this->load->model('Topic_model');
        $this->load->model('Lesson_model');
        $this->load->model('Trainingassignemployee_model');
        $this->load->model('Traininghistory_model');        
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the default screen of exam menu
     */
    public function index()
    {
        
    }

    public function viewTopicList()
    {
        $this->load->library('Sidebar');
        
        $side_params = array('selected_menu_id'=>'7-1');      
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        
        if($this->isFasi()) 
        {
            $this->loadViews("fasi/analysis/topichistory", $this->global, NULL , NULL);   
        } 
        else 
        {
            $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL , NULL);   
        } 
    }

    public function viewLessonList()
    {
        $this->load->library('Sidebar');
        
        $side_params = array('selected_menu_id'=>'7-1');      
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        
        if($this->isFasi()) 
        {
            $page_data["log_id"] = $this->input->post('log_id');
            $this->loadViews("fasi/analysis/lessonhistory", $this->global, $page_data , NULL);   
        } 
        else 
        {
            $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL , NULL);   
        } 
    }

    public function getTopicList()
    {
        if($this->isFasi()) 
        {   
            $sessiondata = $this->session->get_userdata();
            $search_cond = array();
            $limit = $this->input->post("limit");
            $search_cond = array_merge($search_cond, array("e.responsible_fasi_id"=>$sessiondata["userId"]));
            

            $data_rows = $this->Traininghistory_model->getTopicList($search_cond, $limit); 

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

    public function getLessonList()
    {
        if($this->isFasi()) 
        {   
            $sessiondata = $this->session->get_userdata();
            $log_id = $this->input->post('log_id');
            $search_cond = array();

            $search_cond = array_merge($search_cond, array("f.responsible_fasi_id"=>$sessiondata["userId"], "log_id"=>$log_id));
            

            $data_rows = $this->Traininghistory_model->getLessonList($search_cond); 

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

}

?>
