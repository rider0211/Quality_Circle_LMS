<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
/**
 * Class : Examhistory (ExamController)
 * Examhistory Class to control all Examhistory operations.
 * @author : ping
 * @version : 1.0
 * @since : 11 July 2018
 */
class Bookshop extends BaseController {
    /**
     * This is default constructor of the class
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->model('Account_model');
        $this->load->model('User_model');
        $this->load->model('Settings_model');
        $this->load->model('Translate_model');
        $this->load->model('Library_model');
        $this->load->model('Bookshop_model');
        $this->isLoggedIn();
        $this->isLearner();
    }
    /**
     * This function used to load the default screen of exam menu
     */
    public function index(){
        $this->getAll();
    }
    
    public function getAll(){
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '7');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        if($this->isLearner()){
            $displayLength = 3;
            $search = $this->input->get('sSearch');
            $start = $this->input->get('per_page');
            if(!isset($start)){
                $start = 0;
            }
            $filter['start'] = $start;
            $filter['limit'] = $displayLength;
            $filter['search'] = $search;
            $this->global['courses'] = $this->Bookshop_model->all($filter);
            unset($filter['start']);
            unset($filter['limit']);
            $this->global['iTotalRecords'] = count($this->global['courses']);
            $this->global['sEcho'] = $search;
            $this->load->library('pagination');
            //            $config['base_url'] = site_url($this->company['company_url'].'/bookshop/?sSearch='.$search);
            $config['page_query_string'] = TRUE;
            $config['total_rows'] = $this->global['iTotalRecords'];
            $config['per_page'] = $displayLength;
            $config['num_links'] = 2;
            $config['uri_segment'] = 3;
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = '&laquo;';
            $config['first_tag_open'] = '<li class="page-item">';
            $config['first_tag_close'] = '</li>';
            $config['last_link'] = '&raquo;';
            $config['last_tag_open'] = '<li class="page-item">';
            $config['last_tag_close'] = '</li>';
            $config['next_link'] = '&rarr;';
            $config['next_tag_open'] = '<li class="page-item">';
            $config['next_tag_close'] = '</li>';
            $config['prev_link'] = '&larr;';
            $config['prev_tag_open'] = '<li class="page-item">';
            $config['prev_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li class="page-item">';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $this->global['links'] = $this->pagination->create_links();
            $this->global['menu'] = "bookshop";
            $this->loadViews("learner/bookshop/bookshop", $this->global, NULL, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function myBooks(){
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '8');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        if($this->isLearner()){
            $displayLength = 3;
            $search = $this->input->get('sSearch');
            $start = $this->input->get('per_page');
            if(!isset($start)){
                $start = 0;
            }
            $filter['start'] = $start;
            $filter['limit'] = $displayLength;
            $filter['search'] = $search;
            $this->global['courses'] = $this->Bookshop_model->my_all($filter);
            unset($filter['start']);
            unset($filter['limit']);
            $this->global['iTotalRecords'] = $this->Bookshop_model->my_count($filter);
            $this->global['sEcho'] = $search;
            $this->load->library('pagination');
            //            $config['base_url'] = site_url($this->company['company_url'].'/bookshop/?sSearch='.$search);
            $config['page_query_string'] = TRUE;
            $config['total_rows'] = $this->global['iTotalRecords'];
            $config['per_page'] = $displayLength;
            $config['num_links'] = 2;
            $config['uri_segment'] = 3;
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = '&laquo;';
            $config['first_tag_open'] = '<li class="page-item">';
            $config['first_tag_close'] = '</li>';
            $config['last_link'] = '&raquo;';
            $config['last_tag_open'] = '<li class="page-item">';
            $config['last_tag_close'] = '</li>';
            $config['next_link'] = '&rarr;';
            $config['next_tag_open'] = '<li class="page-item">';
            $config['next_tag_close'] = '</li>';
            $config['prev_link'] = '&larr;';
            $config['prev_tag_open'] = '<li class="page-item">';
            $config['prev_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li class="page-item">';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $this->global['links'] = $this->pagination->create_links();
            $this->global['menu'] = "mybooks";
            $this->loadViews("learner/bookshop/bookshop", $this->global, NULL, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }

    public function view($id = NULL){
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '7');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        if($this->isLearner()){
            $user_id = $this->session->get_userdata() ['user_id'];
            if(!empty($params1 = $_GET['token'])){
                $data = base64_decode($params1);
                $finalData = json_decode($data);
                $order_id = $finalData->order_id;
                $product_id = $finalData->product_id;
                $bookshop_id = $finalData->bookshop_id;
                $data_insert = $this->Bookshop_model->pay_book(array("user_id" => $user_id, "bookshop_id" => $bookshop_id, "order_id" => $order_id, "w_prod_id" => $product_id));
                $course = $this->Bookshop_model->select($id);
                $this->global['course'] = $course;
                $this->global['menu'] = "bookshop";
                $this->loadViews('learner/bookshop/bookshop_details', $this->global, NULL, NULL);
            }else{
                $course = $this->Bookshop_model->select($id);
                $this->global['course'] = $course;
                $this->global['menu'] = "bookshop";
                $this->loadViews('learner/bookshop/bookshop_details', $this->global, NULL, NULL);
            }
        }else{
            $this->loadViews("access", $this->global, NULL, NULL);  
        }
    }
    
    public function my_view($id = NULL){
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '8');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        $course = $this->Bookshop_model->select($id);
        $this->global['course'] = $course;
        $this->global['menu'] = "mybooks";
        $this->loadViews('learner/bookshop/bookshop_details', $this->global, NULL, NULL);
    }
    
    public function view_book($id = NULL){
        $res = $this->Library_model->getBookByLibraryId($id) [0];
        $page_data['path'] = base_url() . $res['file_path'];
        $this->load->view('admin/flipbook/wowbook', $page_data);
    }
    
    public function pay_book($row_id = 0){
        $user_id = $this->session->get_userdata() ['user_id'];
        $this->Bookshop_model->pay_book(array("user_id" => $user_id, "bookshop_id" => $row_id));
        //pay
        $price = $this->Bookshop_model->getRow($row_id) ['price'];
        $data['amount'] = $price;
        $data['user_id'] = $user_id;
        $data['object_type'] = 'book';
        $data['object_id'] = $row_id;
        $this->db->set("company_id", "(select company_id from user where id = (select user_id from library where id = (select library_id from book_shop where id = " . $row_id . ")))", false);
        $this->Account_model->insert_payment($data);
        redirect('learner/bookshop/view_book/' . $row_id);
    }
}
?>
