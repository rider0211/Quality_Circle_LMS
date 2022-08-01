<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
   require APPPATH . '/libraries/BaseController.php';
   
   /**
    * Class : Lesson (LessonController)
    * Lesson Class to control all Lesson related operations.
    * @author : ping
    * @version : 1.0
    * @since : 26 June 2018
    */
   class Lesson extends BaseController{
       /**
        * This is default constructor of the class
        */
       public function __construct(){
           parent::__construct();
           $this->load->model('Lesson_model');
           $this->isLoggedIn();   
       }
       
       /**
        * This function used to load the first screen of the user
        */
       public function index(){
           $this->viewList();
       }
   
       public function viewList(){
           $this->load->library('Sidebar');   
           if($this->isMasterAdmin()){
               $side_params = array('selected_menu_id'=>'4-2');      
               $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
   
               $this->loadViews("admin/lesson/list", $this->global, NULL , NULL);   
           }else{
               $this->global['sidebar'] = $this->sidebar->generate();
               $this->loadViews("access", $this->global, NULL , NULL);   
           }  
       }   
   
       public function viewCreate( $row_id=0){
           $this->load->library('Sidebar');   
           if($this->isMasterAdmin()){
               $this->load->library('form_validation');
   
               $side_params = array('selected_menu_id'=>'4-2');      
               $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role); 
               
               $this->load->model('Category_model', '', TRUE);
   
               $page_data['categories'] = $this->Category_model->getCategoryList();
               $page_data['lesson_types'] = Array("text", "url", "image", "video");
   
               if($row_id != 0){
                   $row_lesson = $this->Lesson_model->getLessonInfo($row_id)[0];
   
                   $page_data['row_id'] = $row_id;
                   $page_data['lesson_title'] = $row_lesson['lesson_title'];
                   $page_data['lesson_code'] = $row_lesson['lesson_code'];
                   $page_data['lesson_type'] = $row_lesson['lesson_type'];
                   $page_data['category_id'] = $row_lesson['category_id'];
                   $page_data['category_name'] = $row_lesson['category_name'];   
                   $page_data['lesson_content'] = '';
                   $page_data['lesson_url'] = '';
                   if($page_data['lesson_type'] == 'text'){
                       $page_data['lesson_content'] = $row_lesson['lesson_content'];
                   } else if($page_data['lesson_type'] == 'url'){
                       $page_data['lesson_url'] = $row_lesson['lesson_content'];
                   } else if($page_data['lesson_type'] == 'video'){
                       $page_data['lesson_video'] = $row_lesson['lesson_content'];
                   }else{
                       $page_data['uploaded_files'] = json_decode($row_lesson['lesson_content']);
                   }
               }else{
                   $page_data['row_id'] = '';
                   $page_data['lesson_title'] = '';
                   $page_data['lesson_code'] = '';
                   $page_data['lesson_type'] = 'text';
                   $page_data['lesson_content'] = '';
                   $page_data['lesson_url'] = '';
                   $page_data['uploaded_files'] = '';  
                   $page_data['category_id'] = '';
                   $page_data['category_name'] = '';   
               }
               
               $this->loadViews("admin/lesson/edit", $this->global, $page_data , NULL);   
           }else{
               $this->global['sidebar'] = $this->sidebar->generate();
               $this->loadViews("access", $this->global, NULL , NULL);   
           }  
       }
   
       /**
        * This function used to load LOSSON Add Form
        */
       public function getList(){
        if($this->isMasterAdmin()){
               $data_rows = $this->Lesson_model->getPagingList();           
               foreach ($data_rows['data'] as $key => $row){
                   $data_rows['data'][$key]["no"] = $key + 1;
               }
   
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
        * This function used to load Only LOSSONid and lessontitle
        */
       public function getLessonListByCategory(){
        if($this->isMasterAdmin()){
               $category_id = $this->input->post('c_id');
               $data_rows = $this->Lesson_model->getLessonSelect2List($category_id);
               //$records["results"] = $data_rows; 
               $this->response($data_rows);   
           }else{
               $this->response(array());  
           }
       }
   
       /*usable to check list of lesson*/
       public function getSelectableLessonList(){
           $param["category_id"] = $this->input->post('category_id');
           $param["no_lesson_id"] = $this->input->post('ids');
           $this->load->model('Lesson_model', '', TRUE);
   
           $lesson_list['data'] = $this->Lesson_model->all($param);
   
           return $this->response($lesson_list);
       }
   
       public function getSelectedLessonList(){
           $lesson_id_list = $this->input->post('ids');
   
           if(isset($lesson_id_list)){
               $this->load->model('Lesson_model', '', TRUE);
               $param["category_id"] = $this->input->post('category_id');
               $param["lesson_id"] = $lesson_id_list;
               $quiz_list['data'] = $this->Lesson_model->all($param);
           }else{
               $quiz_list['data'] = array();
           }
           return $this->response($quiz_list);
       }
       /**
        * This function used to load Only LOSSONid and lessontitle
        */
       public function getLessonList($category_id=0){
        if($this->isMasterAdmin()){
               $data_rows = $this->Lesson_model->getLessonSelect2List($category_id);
               $records["results"] = $data_rows; 
               $this->response($records);   
           }else{
               $this->response(array());  
           }
       }
       /**
        * This function used to load Only LOSSONid and lessontitle
        */
       public function getLessonList2(){
        if($this->isMasterAdmin()){
               $category_id = isset($_REQUEST["q1"])?$_REQUEST["q1"]:3;
               $data_rows = $this->Lesson_model->getLessonSelect2List($category_id);
               $records["results"] = $data_rows; 
               $this->response($records);   
           }else{
               $this->response(array());  
           }
       }
       /**
        * This function used to add new Lesson or update old Lesson
        */
       public function saveLesson(){
        if($this->isMasterAdmin()){
               //print_r($this->input->post());
               $this->load->library('form_validation');
   
               /*$this->form_validation->set_rules('lesson_title', 'LessonTitle', 'required|max_length[50]|trim');
               $this->form_validation->set_rules('lesson_code', 'LessonCode', 'trim|required|max_length[10]');
               $this->form_validation->set_rules('category_id', 'Category', 'integer|required');
               $this->form_validation->set_rules('lesson_type', 'LessonType', 'trim|required');
               
               if($this->form_validation->run() == FALSE)
               {
                   print "invalid";
                   //$this->viewCreate(0);
               } 
               else 
               {*/
                   //$lesson_info['row_id'] = isset($this->input->post('row_id'))?$this->input->post('row_id'):'';
   
                   $lesson_info['row_id'] = $this->input->post('row_id');                
                   $lesson_info['lesson_title'] = $this->input->post('lesson_title');
                   $lesson_info['lesson_code'] = $this->input->post('lesson_code');
                   $lesson_info['category_id'] = $this->input->post('category_id');
                   $lesson_info['lesson_type'] = $this->input->post('lesson_type');
   
                   $file_names = $_FILES['file']['name'];
   
                   if($lesson_info['lesson_type'] == 'text' ){
                       $lesson_info['lesson_content'] = $this->input->post('lesson_content');
                   } else if($lesson_info['lesson_type'] == 'url' ){
                       $lesson_info['lesson_content'] = $this->input->post('lesson_url');
                   }else{ 
                       if(isset($_FILES['file']))
                       {
                           if($lesson_info['lesson_type'] == 'video' ){
                               $file_names =  time().'.'.$this->getExtension($_FILES['file']['name']);
                               $lesson_info['lesson_content'] = $file_names;
                           }
                           else{
                               for($i = 0 ; $i < sizeof($file_names); $i ++){
                                   $file_names[$i] =  time().'_'.$i.'.'.$this->getExtension($file_names[$i]);
                               }
                               $lesson_info['lesson_content'] = json_encode($file_names);
                           }
                       }
                   }
   
                   $sessiondata = $this->session->get_userdata();
                   $lesson_info['user_id'] = $sessiondata['userId'];
   
                   if($lesson_info['row_id']>0){
                       $row_id = $lesson_info['row_id'];
                       unset($lesson_info['row_id']);
                       $this->Lesson_model->update($lesson_info, $row_id);
                   }else{
                       unset($lesson_info['row_id']);
                       $row_id = $this->Lesson_model->addLesson($lesson_info);
                   }
                   
                   if(isset($_FILES['file'])){
                       $upload_path = sprintf('%slesson/lesson_%d/', PATH_UPLOAD, $row_id);
   
                       if(!file_exists($upload_path)) 
                       {
                           $this->makeDirectory($upload_path);
                       }
                       if($lesson_info['lesson_type'] == 'video' ){
                           $_FILES['cfile']['name'] = $file_names;
                           $_FILES['cfile']['type'] = $_FILES['file']['type'];
                           $_FILES['cfile']['tmp_name'] = $_FILES['file']['tmp_name'];
                           $_FILES['cfile']['size'] = $_FILES['file']['size'];
                           $_FILES['cfile']['error'] = $_FILES['file']['error'];
   
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
                       }else{
                           $filecount = count($_FILES['file']['name']);
                           if($filecount > 0){
   
                               for ($i = 0; $i < $filecount; $i++){
   
                                   $_FILES['cfile']['name'] = $file_names[$i];
                                   $_FILES['cfile']['type'] = $_FILES['file']['type'][$i];
                                   $_FILES['cfile']['tmp_name'] = $_FILES['file']['tmp_name'][$i];
                                   $_FILES['cfile']['size'] = $_FILES['file']['size'][$i];
                                   $_FILES['cfile']['error'] = $_FILES['file']['error'][$i];
   
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
                       }
                   }
               //}
               if($lesson_info['lesson_type'] == 'text' || $lesson_info['lesson_type'] == 'url'){
                    redirect('admin/lesson');
               }else{
                   echo "success";
   
               }
           }else{
               $this->loadThis();  
           }
       }

       public function deleteLesson($id){
           $out_data = array();
           if($this->Lesson_model->delete($id)){
               $out_data["status"] = "Success";
               $out_data["message"] = "";
           }else{
               $out_data["status"] = "Fail";
               $out_data["message"] = "Could not delete the row.";
           }   
           $this->response($out_data); 
       }

       public function getExtension($path){
           $ext = pathinfo($path, PATHINFO_EXTENSION);
           return $ext;   
       }
       
   }
   
   ?>