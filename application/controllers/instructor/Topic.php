<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Topic (TopicController)
 * Topic Class to control all Topic related operations.
 * @author : ping
 * @version : 1.0
 * @since : 30 June 2018
 */
class Topic extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Topic_model');
        $this->load->model('Trainingassignfasi_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the default screen of topic menu
     */
    public function index()
    {
        $this->viewList();
    }


    public function viewList()
    {
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id'=>'4-3');      
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);

        if($this->isFasi()) 
        {   
            $this->loadViews("fasi/topic/list", $this->global, NULL , NULL);   
        } 
        else 
        {
            $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL , NULL);   
        }  
    }


    /**
     * This function used to load Topic Add Form
     */
    public function getList()
    {
        if($this->isFasi()) 
        {   
            $sessiondata = $this->session->get_userdata();
            $assigned_topics = $this->Trainingassignfasi_model->getAssignedList($sessiondata["userId"]);
            $arr_topics = array_column($assigned_topics, 'id');
            if(count($arr_topics) > 0)
                $cond = array("a.id"=>$arr_topics);     
            else
                $cond = array("a.id"=>0);     
            
            $data_rows = $this->Topic_model->getPagingList( $cond ); 
        
            $records["data"] = $data_rows['data'];        
            $records['recordsTotal'] = $data_rows["total"];
            $records['recordsFiltered'] = $data_rows['filtertotal'];

            $this->response($records);   
        } 
        else 
        {
            $this->response(array());  
        }
    }


     
}

?>
