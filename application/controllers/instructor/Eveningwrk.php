<?php if(!defined('BASEPATH')){
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';
// require APPPATH . '/third_party/PHPExcel.php';
// require APPPATH . '/third_party/TCPDF-master/tcpdf.php';
// include_once (APPPATH . '/third_party/iio/index.php');
// require APPPATH . '/libraries/FPDI/fpdi.php';
// require APPPATH . 'third_party/woocommerce/autoload.php';
// use Automattic\WooCommerce\Client;
// use Automattic\WooCommerce\HttpClient\HttpClientException;
/**
 * Class : Category (CategoryController)
 * Category Class to control all category related operations.
 * @author : ping
 * @version : 1.0
 * @since : 26 June 2018
 */
class Eveningwrk extends BaseController {
    /**
     * This is default constructor of the class
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('EveningWrk_model');
        $this->load->model('Standard_model');
		$this->load->model('Category_model');		
        $this->isLoggedIn();
        // $this->woocommerce = new Client('https://shop.gosmartacademy.com/', 'ck_b6411a22ed11f224a13d68bc2bb642a4227b69c3', 'cs_ae6ff61f63bed83c2d2e1880b1634449f30a2c04', ['version' => 'wc/v3', ]);
    }
    public function index(){
        $this->viewList();
    }
    /**
     * This function used to load the first screen of the user
     */
    public function viewList(){
        $this->load->library('Sidebar');
        if($this->isMasterAdmin() || $this->isInstructor()){
            $side_params = ['selected_menu_id' => '14'];
            $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
            $this->loadViews("instructor/eveningwrk/index", $this->global, null, null);
        }else{
            $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
            $this->loadViews("access", $this->global, null, null);
        }
    }

    public function view_create(){
        $this->load->library('Sidebar');
        $side_params = ['selected_menu_id' => '14'];
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        if($this->isMasterAdmin() || $this->isInstructor()){            
            $this->load->library('form_validation');
            $page_data["id"] = intval($this->input->post('row_id'));
            if($page_data["id"] != 0){
                $video_data = $this->EveningWrk_model->getRow($page_data[id]);
                $page_data["excercise"] = $video_data[0];
            }else{
                $page_data["excercise"] = '';
            }
			$page_data["allstudents"] = $this->User_model->getAllStudents();
			$page_data["categories"] = $this->Category_model->getListByCompanyID($this->session->get_userdata() ['company_id']);
            $this->loadViews("instructor/eveningwrk/excercise_edit", $this->global, $page_data, null);
        }else{
            $this->loadViews("access", $this->global, null, null);
        }
    }
    /**
     * This function used to load All category list
     */
    public function getList(){
        $out_data = [];
        $table_data['data'] = $this->EveningWrk_model->getListByAll();
        $table_data['recordsTotal'] = 0;
        $table_data['recordsFiltered'] = 0;
        foreach($table_data['data'] as $key => $row){
            $table_data['data'][$key]["no"] = $key + 1;
            $table_data['data'][$key]["status"] = $row['status'] == 1 ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Deactive</span>';
            $table_data['data'][$key]["cr_date"] = date("j M Y", strtotime($row['created_at']));
			$table_data['data'][$key]["student_id"] = $this->EveningWrk_model->getNameByStudentId($row['student_id']);
            $table_data['recordsTotal'] = count($table_data['data']);
            $table_data['recordsFiltered'] = count($table_data['data']);
        }
       	$this->response($table_data);
    }
    	
	public function saveExcercise(){
        $video_data = [];
        foreach ($this->input->post() as $key => $value){
            $video_data[$key] = $value;
        } 
		if($_FILES['document']['name'] != ""){
            $upload_path = sprintf('%sexcercise/', PATH_UPLOAD);
            if(!file_exists($upload_path)){
                $this->makeDirectory($upload_path);
            }
            $_FILES['document']['name'] = sprintf('%s', $_FILES['document']['name']);
            $_FILES['document']['type'] = $_FILES['document']['type'];
            $_FILES['document']['tmp_name'] = $_FILES['document']['tmp_name'];
            $_FILES['document']['size'] = $_FILES['document']['size'];
            $_FILES['document']['error'] = $_FILES['document']['error'];
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = '*';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if(!$this->upload->do_upload('document')){
                $error = array('error' => $this->upload->display_errors());
            }else{
                $fileData = array('upload_data' => $this->upload->data());
				if(intval($video_data["id"]) > 0){
					$out_data = $this->EveningWrk_model->getRow($video_data["id"]);
					$upload_path_chk = 'assets/uploads/excercise/';
					$file_path = FCPATH.$upload_path_chk.$out_data[0]['document'];
					if(file_exists($file_path)){ unlink($file_path); }
				}
				$video_data['document'] = $fileData['upload_data']['file_name'];
            }
        }
		if($_FILES['document2']['name'] != ""){
            $upload_path2 = sprintf('%sexcercise/', PATH_UPLOAD);
            if(!file_exists($upload_path2)){
                $this->makeDirectory($upload_path2);
            }
            $_FILES['document2']['name'] = sprintf('%s', $_FILES['document2']['name']);
            $_FILES['document2']['type'] = $_FILES['document2']['type'];
            $_FILES['document2']['tmp_name'] = $_FILES['document2']['tmp_name'];
            $_FILES['document2']['size'] = $_FILES['document2']['size'];
            $_FILES['document2']['error'] = $_FILES['document2']['error'];
            $config['upload_path'] = $upload_path2;
            $config['allowed_types'] = '*';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if(!$this->upload->do_upload('document2')){
                $error = array('errors' => $this->upload->display_errors());
            }else{
                $fileData2 = array('upload_data' => $this->upload->data());
				if(intval($video_data["id"]) > 0){
					$out_data2 = $this->EveningWrk_model->getRow($video_data["id"]);
					$upload_path_chk2 = 'assets/uploads/excercise/';
					$file_path2 = FCPATH.$upload_path_chk2.$out_data2[0]['document2'];
					if(file_exists($file_path2)){ unlink($file_path2); }
				}
				$video_data['document2'] = $fileData2['upload_data']['file_name'];
            }
        }
		if($_FILES['document3']['name'] != ""){
            $upload_path3 = sprintf('%sexcercise/', PATH_UPLOAD);
            if(!file_exists($upload_path3)){
                $this->makeDirectory($upload_path3);
            }
            $_FILES['document3']['name'] = sprintf('%s', $_FILES['document3']['name']);
            $_FILES['document3']['type'] = $_FILES['document3']['type'];
            $_FILES['document3']['tmp_name'] = $_FILES['document3']['tmp_name'];
            $_FILES['document3']['size'] = $_FILES['document3']['size'];
            $_FILES['document3']['error'] = $_FILES['document3']['error'];
            $config['upload_path3'] = $upload_path;
            $config['allowed_types'] = '*';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if(!$this->upload->do_upload('document3')){
                $error = array('error3' => $this->upload->display_errors());
            }else{
                $fileData3 = array('upload_data' => $this->upload->data());
				if(intval($video_data["id"]) > 0){
					$out_data3 = $this->EveningWrk_model->getRow($video_data["id"]);
					$upload_path_chk3 = 'assets/uploads/excercise/';
					$file_path3 = FCPATH.$upload_path_chk3.$out_data3[0]['document3'];
					if(file_exists($file_path3)){ unlink($file_path3); }
				}
				$video_data['document3'] = $fileData3['upload_data']['file_name'];
            }
        }
        if(intval($video_data["id"]) == 0){
            unset($video_data["id"]);
            $row_id = $this->EveningWrk_model->insert($video_data);
        }else{
            $row_id = $video_data["id"];
            $this->EveningWrk_model->update($video_data, $video_data["id"]);
        }
        redirect('instructor/eveningwrk');
    }

    public function active(){
        $id = $this->input->post('id');
        $data["status"] = 1;
        return $this->Category_model->update($data, $id);
    }

    public function inactive(){
        $id = $this->input->post('id');
        $data["status"] = 0;
        return $this->Category_model->update($data, $id);
    }

    public function update($id){
        $category_data = [];
        foreach ($this->input->post() as $key => $value){
            if($key == 'file'){
                continue;
            }
            $category_data[$key] = $value;
        }
        return $this->Category_model->update($category_data, $id);
    }

    public function delete($id){
        $out_data = [];
		$out_data = $this->EveningWrk_model->getRow($id);		
		$upload_path_chk = 'assets/uploads/excercise/';
		$file_path = FCPATH.$upload_path_chk.$out_data[0]['document'];
		if(file_exists($file_path)){
			unlink($file_path);
		}
		$file_path2 = FCPATH.$upload_path_chk.$out_data[0]['document2'];
		if(file_exists($file_path2)){
			unlink($file_path2);
		}
		$file_path3 = FCPATH.$upload_path_chk.$out_data[0]['document3'];
		if(file_exists($file_path3)){
			unlink($file_path3);
		}
        if($this->EveningWrk_model->delete($id)){
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