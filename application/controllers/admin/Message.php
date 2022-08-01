<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
// require APPPATH . '/third_party/PHPExcel.php';
/**
 * Class : Account (AccountController)
 * Account Class to control all account related operations.
 * @author : ping
 * @version : 1.0
 * @since : 19 July 2018
 */
class Message extends BaseController{
    /**
     * This is default constructor of the class
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Company_model');
        $this->load->model('Feedback_model');
    }
    /**
     * This function used to load the first screen of the user
     */
    public function index(){
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '8');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        if($this->session->userdata('user_type') == 'Admin'){
        //if($this->isSuperAdmin()){           
            $userId = $this->session->get_userdata() ['user_id'];
            $page_data['message_receive_list'] = $this->Feedback_model->get_inbox_message($userId);
            $new_ms_nums = $this->Feedback_model->get_inbox_news_nums($userId);
            $page_data['new_ms_nums'] = $new_ms_nums;
            for ($i = 0;$i < sizeof($page_data['message_receive_list']);$i++){
                $item = $page_data['message_receive_list'][$i];
                if($item['user_type'] == 'Admin'){
                    $tmp_ar = $this->Company_model->getRow($item['sender_id']);
                    if(sizeof($tmp_ar) > 0){
                        $item['company_name'] = $tmp_ar->name;
                    }else{
                        $item['company_name'] = "Unknown";
                    }
                }
                $item_date = strtotime($item['created_at']);
                $item['created_at'] = date("M j", $item_date);
                $page_data['message_receive_list'][$i] = $item;
            }
            $this->loadViews("admin/message/inbox_list", $this->global, $page_data, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    public function sent(){
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '8');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        //if($this->isSuperAdmin()){            
        if($this->session->userdata('user_type') == 'Admin'){
            $userId = $this->session->get_userdata() ['user_id'];
            $page_data['message_receive_list'] = $this->Feedback_model->get_sent_message($userId);
            $new_ms_nums = $this->Feedback_model->get_inbox_news_nums($userId);
            $page_data['new_ms_nums'] = $new_ms_nums;
            for ($i = 0;$i < sizeof($page_data['message_receive_list']);$i++){
                $item = $page_data['message_receive_list'][$i];
                if($item['user_type'] == 'Company'){
                    $tmp_ar = $this->Company_model->getRow($item['receiver_id']);
                    if(sizeof($tmp_ar) > 0){
                        $item['company_name'] = $tmp_ar->name;
                    }else{
                        $item['company_name'] = "Unknown";
                    }
                }
                $item_date = strtotime($item['created_at']);
                $item['created_at'] = date("M j", $item_date);
                $page_data['message_receive_list'][$i] = $item;
            }
            $this->loadViews("admin/message/sent", $this->global, $page_data, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    function photo_unlink(){
        $currentDirectory = getcwd();
        $uploadDirectory = $_POST['uploadPath'];
        $uploadPath = $currentDirectory . $uploadDirectory;
        unlink($uploadPath);
    }

    function profile_photo(){
        $currentDirectory = getcwd();
        $uploadDirectory = $_POST['uploadPath'];
        $fileName = $_FILES['the_file']['name'];
        $fileSize = $_FILES['the_file']['size'];
        $fileTmpName = $_FILES['the_file']['tmp_name'];
        $fileType = $_FILES['the_file']['type'];
        $fileExtension = strtolower(end(explode('.', $fileName)));
        $uploadPath = $currentDirectory . $uploadDirectory . '/' . basename($fileName);
        move_uploaded_file($fileTmpName, $uploadPath);
    }

    public function details($update_flag = 0, $msg_id = ''){
        $this->load->library('Sidebar');
        $userId = $this->session->get_userdata() ['user_id'];
        if($update_flag == 1){
            $last_item = $this->Feedback_model->get_last_message_details($msg_id);
            if($last_item->sender_id != $userId){
                $this->Feedback_model->update_message_status($msg_id);
            }
        }
        $side_params = array('selected_menu_id' => '10');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        if($this->session->userdata('user_type') == 'Admin'){
        //if($this->isAdmin()){            
            $page_data['message_details_list'] = $this->Feedback_model->get_message_details($msg_id);
            $new_ms_nums = $this->Feedback_model->get_inbox_news_nums($userId);
            $page_data['new_ms_nums'] = $new_ms_nums;
            if(sizeof($page_data['message_details_list']) > 0){
                $first_item = $page_data['message_details_list'][0];
                $f_item_date = strtotime($first_item['created_at']);
                $page_data['f_created_at'] = date("F j, Y", $f_item_date);
                if($first_item['sender_id'] == $userId){
                    $page_data['f_sent_flag'] = 1;
                    $page_data['f_sender_name'] = 'You';
                    $page_data['f_receiver_name'] = $this->getSendRevName($first_item['receiver_id']);
                }else{
                    $page_data['f_sent_flag'] = 0;
                    $page_data['f_receiver_name'] = 'You';
                    $page_data['f_sender_name'] = $this->getSendRevName($first_item['sender_id']);
                }
                for ($i = 0;$i < sizeof($page_data['message_details_list']);$i++){
                    $item = $page_data['message_details_list'][$i];
                    if($item['sender_id'] == $userId){
                        $item['sender_name'] = 'You';
                        $item['receiver_name'] = $this->getSendRevName($item['receiver_id']);
                    }else{
                        $item['receiver_name'] = 'You';
                        $item['sender_name'] = $this->getSendRevName($item['sender_id']);
                    }
                    $item_date = strtotime($item['created_at']);
                    $item['created_at'] = date("F j, Y, g:i a", $item_date);
                    $page_data['message_details_list'][$i] = $item;
                }
            }
            $page_data['msg_id'] = $msg_id;
            $this->loadViews("admin/message/details", $this->global, $page_data, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    public function compose(){
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '8');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        if($this->isAdmin()){            
            $userId = $this->session->get_userdata() ['user_id'];
            $company_id = $this->session->get_userdata() ['company_id'];
            $page_data['company_receiver_list'] = $this->User_model->getList("user_type = 'Admin'");
            $new_ms_nums = $this->Feedback_model->get_inbox_news_nums($userId);
            $page_data['new_ms_nums'] = $new_ms_nums;
            $page_data['instructor_receiver_list'] = $this->User_model->getInstructorByMessage($company_id);
            $page_data['learner_receiver_list'] = $this->User_model->getUserByMessage($company_id);
            $this->loadViews("admin/message/compose", $this->global, $page_data, NULL);
        }else{
        }
    }
    ////////// Rest Api Section ///////////////
    ///
    public function send_message(){
        $this->load->library('form_validation');
        $receiver_id = $this->input->post('receiver_id');
        $content = $this->input->post('content');
        $sender_id = $this->session->userdata('userId');
        $message_id = $this->generateRandomString(15);
        $msg_id = $this->Feedback_model->send_new_message($sender_id, $receiver_id, $content, $message_id, 1);
        echo "success";
    }
    public function reply_message(){
        $this->load->library('form_validation');
        $msg_id = $this->input->post('msg_id');
        $content = $this->input->post('content');
        $sender_id = $this->session->get_userdata() ['user_id'];
        $message_details_list = $this->Feedback_model->get_message_details($msg_id);
        if(sizeof($message_details_list) == 0){
            echo "error";
        }
        $first_item = $message_details_list[0];
        if($first_item['sender_id'] == $sender_id){
            $receiver_id = $first_item['receiver_id'];
        }
        if($first_item['receiver_id'] == $sender_id){
            $receiver_id = $first_item['sender_id'];
        }
        $msg_id = $this->Feedback_model->send_new_message($sender_id, $receiver_id, $content, $msg_id);
        echo "success";
    }
    ///////////////
    public function generateRandomString($length = 10){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0;$i < $length;$i++){
            $randomString.= $characters[rand(0, $charactersLength - 1) ];
        }
        return $randomString;
    }
    
    function getSendRevName($id = 0){
        $item = $this->User_model->getRow('id = ' . $id);
        if($item != null){
            if($item->user_type == 'Company'){
                $comp = $this->Company_model->getRow($item->id);
                return $comp->name;
            }else{
                return $item->first_name . ' ' . $item->last_name;
            }
        }else{
            return "Unknown";
        }
    }
}
?>