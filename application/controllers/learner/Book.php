<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
require APPPATH . '/third_party/PHPExcel.php';
require APPPATH . '/third_party/TCPDF-master/tcpdf.php';
include_once (APPPATH . '/third_party/iio/index.php');
/**
 * Created by PhpStorm.
 * User: Timon
 * Date: 2018-10-24
 * Time: PM 10:20
 */
class Book extends BaseController{
    /**
     * This is default constructor of the class
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Library_model');
        $this->load->model('Translate_model');
        $this->isLoggedIn();
        $this->isLearner();
    }
    /**
     * This function used to load the first screen of the user
     */
    public function index(){
        $this->viewBookList();
    }
    
    public function insert_doc(){
        $id1 = $this->input->post('id1');
        $id2 = $this->input->post('id2');
        $data["parent_id"] = $id1;
        return $this->Library_model->update($data, array('id' => $id2));
    }
    
    public function viewBookList(){
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '7');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        $table_data['data'] = $this->Library_model->getBook();
        foreach ($table_data['data'] as $key => $row){
            $table_data['data'][$key]["no"] = $key + 1;
            $table_data['data'][$key]["file_path"] = base_url() . $row['file_path'];
        }
        $book_data['book_list'] = $table_data['data'];
        $this->loadViews("learner/book/book_list", $this->global, $book_data, NULL);
    }

    public function viewBookDetail($id){
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '7');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        $table_data['data'] = $this->Library_model->getBook($id) [0];
        $book_data['book'] = $table_data['data'];
        $this->loadViews("learner/book/book_detail", $this->global, $book_data, NULL);
    }
}
