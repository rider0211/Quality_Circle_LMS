<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
/**
 * Class : Topic (TopicController)
 * Topic Class to control all Topic related operations.
 * @author : ping
 * @version : 1.0
 * @since : 30 June 2018
 */
class Topic extends BaseController {
    /**
     * This is default constructor of the class
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('Topic_model');
        $this->isLoggedIn();
    }
    /**
     * This function used to load the default screen of topic menu
     */
    public function index(){
        $this->viewList();
    }
    public function viewList(){
        $this->load->library('Sidebar');
        if($this->isMasterAdmin()){
            $side_params = array('selected_menu_id' => '4-3');
            $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
            $this->loadViews("admin/topic/list", $this->global, NULL, NULL);
        }else{
            $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    public function viewCreate($row_id = 0){
        $this->load->library('Sidebar');
        if($this->isMasterAdmin()){
            $this->load->library('form_validation');
            $side_params = array('selected_menu_id' => '4-3');
            $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
            $this->load->model('Category_model', '', TRUE);
            $page_data['categories'] = $this->Category_model->getCategoryList();
            if($row_id != 0){
                $row_topic = $this->Topic_model->getTopicInfo($row_id) [0];
                $page_data['row_id'] = $row_id;
                $page_data['training_title'] = $row_topic['training_title'];
                $page_data['category_id'] = $row_topic['category_id'];
                $page_data['category_name'] = $row_topic['category_name'];
                $page_data['training_timer'] = $row_topic['training_timer'];
                $page_data['price'] = $row_topic['price'];
                $page_data['image'] = $row_topic['image'];
                if($row_topic['image'] != ""){
                    $page_data["preview_image"] = sprintf("%sassets/uploads/topic/%d_%s", base_url(), $row_topic["id"], $row_topic["image"]);
                }else{
                    $page_data["preview_image"] = "";
                }
                $page_data['email_notification'] = $row_topic['email_notification'];
                $page_data['sms_notification'] = $row_topic['sms_notification'];
                $page_data['summary'] = $row_topic['summary'];
                $page_data['description'] = $row_topic['description'];
                $page_data['repeat_days'] = $row_topic['repeat_days'];
                $page_data['lesson_list'] = json_decode($row_topic['content']);
                $page_data['lesson_count'] = $row_topic['lesson_count'];
                $page_data['content'] = $row_topic['content'];
            }else{
                $page_data['row_id'] = '';
                $page_data['training_title'] = '';
                $page_data['category_id'] = '';
                $page_data['category_name'] = '';
                $page_data['training_timer'] = 0;
                $page_data['price'] = '0';
                $page_data['email_notification'] = 0;
                $page_data['sms_notification'] = 0;
                $page_data['summary'] = '';
                $page_data['image'] = '';
                $page_data['preview_image'] = "";
                $page_data['description'] = '';
                $page_data['repeat_days'] = 0;
                $page_data['lesson_count'] = 0;
                $page_data['content'] = '';
            }
            $this->loadViews("admin/topic/edit", $this->global, $page_data, NULL);
        }else{
            $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    /**
     * This function used to load Topic Add Form
     */
    public function getList(){
        if($this->isMasterAdmin()){
            $data_rows = $this->Topic_model->getPagingList();
            $records["data"] = $data_rows['data'];
            //$records["recordsTotal"] = $total;
            $records['recordsTotal'] = $data_rows["total"];
            $records['recordsFiltered'] = $data_rows['filtertotal'];
            $this->response($records);
        }else{
            $this->response(array());
        }
    }
    /**
     * This function used to load Topic Add Form
     */
    public function getSelect2List(){
        //if($this->isSuperAdmin() || $this->isAdmin())
       // {
            $data_rows = $this->Topic_model->getTitleList(isset($_REQUEST['term']) ? $_REQUEST['term'] : '', isset($_REQUEST['cid']) ? intval($_REQUEST['cid']) : 0);
            $records["results"] = $data_rows;
            $this->response($records);
        //}
    }
    /**
     * This function used to load Topic Add Form
     */
    public function getMultiSelect2List(){
        //if($this->isSuperAdmin() || $this->isAdmin())
       // {
            $data_rows = $this->Topic_model->getAllSimpleList();
            $records["results"] = $data_rows;
            $this->response($records);
       // }
    }
    /**
     * This function used to add new Topic or update old Topic
     */
    public function saveTopic(){
        if($this->isMasterAdmin()){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('training_title', 'TopicTitle', 'required|max_length[100]|trim');
            $this->form_validation->set_rules('category_id', 'Category', 'integer|required');
            if($this->form_validation->run() == FALSE){
                $this->viewCreate(0);
            }else{
                //print_r($this->input->post());
                $topic_info = array();
                $topic_info['row_id'] = intval($this->input->post('row_id'));
                $topic_info['training_title'] = $this->input->post('training_title');
                $topic_info['category_id'] = $this->input->post('category_id');
                $topic_info['training_timer'] = $this->input->post('training_timer');
                $topic_info['price'] = $this->input->post('price');
                $topic_info['email_notification'] = $this->input->post('email_notification') == 'on' ? 1 : 0;
                $topic_info['sms_notification'] = $this->input->post('sms_notification') == 'on' ? 1 : 0;
                $topic_info['repeat_days'] = $this->input->post('repeat_days');
                $topic_info['summary'] = $this->input->post('summary');
                $topic_info['description'] = $this->input->post('description');
                //$topic_info['content'] = json_encode($this->input->post('lesson_list'));
                //$topic_info['lesson_count'] = count($this->input->post('lesson_list'));
                $topic_info['content'] = $this->input->post('lessons');
                $topic_info['lesson_count'] = $this->input->post('lesson_count');
                $topic_info['status'] = 1;
                if(!empty($_FILES['image']['name'])){
                    /*random upload filename*/
                    $_FILES['image']['name'] = microtime(true) . '.' . pathInfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                    $topic_info['image'] = $_FILES['image']['name'];
                }
                $sessiondata = $this->session->get_userdata();
                $topic_info['user_id'] = $sessiondata['userId'];
                if($topic_info['row_id'] != 0){
                    $row_id = $topic_info['row_id'];
                    unset($topic_info['row_id']);
                    $this->Topic_model->updateTopic($topic_info, $row_id);
                    if(!empty($_FILES['image']['name'])){
                        $upload_path = sprintf('%stopic/', PATH_UPLOAD);
                        if(!file_exists($upload_path)){
                            $this->makeDirectory($upload_path);
                        }
                        //remove old image_file
                        // upload new image_file
                        $_FILES['cfile']['name'] = sprintf('%d_%s', $row_id, $_FILES['image']['name']);
                        $_FILES['cfile']['type'] = $_FILES['image']['type'];
                        $_FILES['cfile']['tmp_name'] = $_FILES['image']['tmp_name'];
                        $_FILES['cfile']['size'] = $_FILES['image']['size'];
                        $_FILES['cfile']['error'] = $_FILES['image']['error'];
                        $config['upload_path'] = $upload_path;
                        $config['allowed_types'] = '*';
                        //$config['max_size']             = 100000;
                        //$config['max_width']            = 1024;
                        //$config['max_height']           = 768;
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if(!$this->upload->do_upload('cfile')){
                            $error = array('error' => $this->upload->display_errors());
                            //$this->load->view('upload_form', $error);                            
                        }else{
                            $data = array('upload_data' => $this->upload->data());
                            //$this->load->view('upload_success', $data);                            
                        }
                    }
                    redirect('admin/topic');
                }else{
                    unset($topic_info['row_id']);
                    $row_id = $this->Topic_model->addTopic($topic_info);
                    if(isset($row_id)){
                        if(!empty($_FILES['image']['name'])){
                            $upload_path = sprintf('%stopic/', PATH_UPLOAD);
                            if(!file_exists($upload_path)){
                                $this->makeDirectory($upload_path);
                            }
                            $_FILES['cfile']['name'] = sprintf('%d_%s', $row_id, $_FILES['image']['name']);
                            $_FILES['cfile']['type'] = $_FILES['image']['type'];
                            $_FILES['cfile']['tmp_name'] = $_FILES['image']['tmp_name'];
                            $_FILES['cfile']['size'] = $_FILES['image']['size'];
                            $_FILES['cfile']['error'] = $_FILES['image']['error'];
                            $config['upload_path'] = $upload_path;
                            $config['allowed_types'] = '*';
                            //$config['max_size']             = 100000;
                            //$config['max_width']            = 1024;
                            //$config['max_height']           = 768;
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            if(!$this->upload->do_upload('cfile')){
                                $error = array('error' => $this->upload->display_errors());
                                //$this->load->view('upload_form', $error);                                
                            }else{
                                $data = array('upload_data' => $this->upload->data());
                                //$this->load->view('upload_success', $data);                                
                            }
                        }
                    }
                    redirect('admin/topic');
                }
            }
        }else{
            $this->loadThis();
        }
    }
    
    public function active(){
        $id = $this->input->post('id');
        $data["status"] = 1;

        return $this->Topic_model->updateTopic($data, $id);
    }

    public function inactive(){
        $id = $this->input->post('id');
        $data["status"] = 0;        
        return $this->Topic_model->updateTopic($data, $id);
    }
    
    public function deleteTopic($id){
        $out_data = array();
        if($this->Topic_model->deleteTopic($id)) 
        {
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
