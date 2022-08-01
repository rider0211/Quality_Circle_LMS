<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
// require APPPATH . '/third_party/PHPExcel.php';
/**
 * Created by PhpStorm.
 * User: Timon
 * Date: 6/27/2018
 * Time: 6:07 PM
 */
class Company extends BaseController {
    /**
     * This is default constructor of the class
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('Company_model');
        $this->load->model('User_model');
        $this->load->model('Translate_model');
        $this->load->model('Category_model');
		$this->load->model('Settings_model');
        $this->isLoggedIn();
    }
    /**
     * This function used to load the first screen of the user
     */
    public function index() {
        $this->company_view();
    }
    public function edit_view($row_id = 0) {
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '6');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        if($this->isSuperAdmin()){
            $page_path = "superadmin/company/company_edit";
            $lang_ar = $this->Translate_model->getLanguageList(array('active_flag' => 1, 'add_flag' => 1));
            $page_data['lang_ar'] = $lang_ar['data'];
            if ($row_id != 0) {
				$datas = $this->Settings_model->getSiteConfiguration($where);
                $user_data = $this->Company_model->getListByID($row_id) [0];
                $page_data['id'] = $row_id;
                $page_data['name'] = $user_data['name'];
                $page_data['logo_image'] = $user_data['logo_image'];
                $page_data['active'] = $user_data['active'];
                $page_data['status'] = $user_data['status'];
                $page_data['url'] = $user_data['url'];
                $page_data['discount'] = $user_data['discount'];
				
				$page_data['verify_by'] = $datas['verify_by'];
				$page_data['otp_login'] = $datas['otp_login'];
            } else {
                $page_data['id'] = 0;
                $page_data['name'] = '';
                $page_data['logo_image'] = '';
                $page_data['active'] = 1;
                $page_data['url'] = '';
				$page_data['verify_by'] = '';
                $page_data['discount'] = 0;
				$page_data['otp_login'] = '';
            }
            $this->loadViews($page_path, $this->global, $page_data, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL, NULL); 
        }
    }
    public function company_view() {
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '6');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        if($this->isSuperAdmin()){
            $this->loadViews("superadmin/company/company_list", $this->global, NULL, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL, NULL); 
        }
    }
    /**
     * This function used to load All admin-user list
     */
    public function getData() {
        $table_data['data'] = $this->Company_model->getAll();
        foreach ($table_data['data'] as $key => $row) {
            $table_data['data'][$key]["no"] = $key + 1;
        }
        $table_data['recordsTotal'] = count($table_data['data']);
        $table_data['recordsFiltered'] = count($table_data['data']);
        $this->response($table_data);
    }
    public function active() {
        $id = $this->input->post('id');
        $data["active"] = 1;
        return $this->Company_model->update($data, array('id' => $id));
    }
    public function inactive() {
        $id = $this->input->post('id');
        $data["active"] = 0;
        return $this->Company_model->update($data, array('id' => $id));
    }
    public function insert() {
        $insert_data = array();
        $upload_path = sprintf('%suser/photo/', PATH_UPLOAD);
        if (!file_exists($upload_path)) {
            $this->makeDirectory($upload_path);
        }
        $rslt = $this->doUpload('picture', $upload_path);
        if ($rslt['possible'] == 1) {
            $insert_data['logo_path'] = str_replace("./", "", $rslt['path']);
        }
        foreach ($this->input->post() as $key => $value) {
            $insert_data[$key] = $value;
            if ($key == 'active' || $key == 'status') {
                $insert_data[$key] = $value == 'on' ? 1 : 0;
            }
        }
        unset($insert_data['id']);
        $insert_id = $this->Company_model->insert($insert_data);
        // unset($insert_data);
        // $insert_data['company_id'] = $insert_id;
        // $insert_data['name'] = "Online Courses";
        // $this->Category_model->insert($insert_data);
        // $insert_data['company_id'] = $insert_id;
        // $insert_data['name'] = "Live Classes";
        // $this->Category_model->insert($insert_data);
        // $insert_data['company_id'] = $insert_id;
        // $insert_data['name'] = "ILT";
        // $this->Category_model->insert($insert_data);
        return;
    }
    public function delete() {
        $id = $this->input->post("id");
        if ($this->Company_model->delete(array('id' => $id))) $res['status'] = 'Success';
        else $res['status'] = 'Failed';
        return $res;
    }
    public function update() {
        $update_data = array();
        $id = $this->input->post("id");
        $upload_path = sprintf('%suser/photo/', PATH_UPLOAD);
        if (!file_exists($upload_path)) {
            $this->makeDirectory($upload_path);
        }
        $rslt = $this->doUpload('picture', $upload_path);
        if ($rslt['possible'] == 1) {
            $update_data['logo_path'] = str_replace("./", "", $rslt['path']);
        }
        foreach ($this->input->post() as $key => $value) {
            $update_data[$key] = $value;
            if ($key == 'active') {
                $insert_data[$key] = $value == 'on' ? 1 : 0;
            }
        }
        unset($update_data['id']);
		$method = implode(',',$this->input->post('verify_by'));
		$params = array('otp_login' => $this->input->post('otp_login'), 'verify_by' => $method);
		$this->Settings_model->updateSiteConfiguration($params, 1);		
		
		$setData['active'] = 0;
		if($update_data['active'] == 'on'){
			$setData['active'] = 1;
		}
        $setData['status'] = 0;
		if($update_data['status'] == 'on'){
			$setData['status'] = 1;
		}
		if ($rslt['possible'] == 1) {
            $setData['logo_path'] = str_replace("./", "", $rslt['path']);
        }
        $setData['discount'] = $this->input->post('discount');
		$setData['name'] = $update_data['name'];
		$setData['url'] = $update_data['url'];
		
        return $this->Company_model->update($setData, array('id' => $id));
    }
    public function export() {
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $sheet = $objPHPExcel->getActiveSheet();
        $pCol = 0;
        $pRow = 1;
        $field_name = array('id', 'name', 'address', 'zipcode', 'city', 'country', 'logo_image', 'responsible_fasi_id', 'receive_notifications', 'note', 'active', 'created_at', 'updated_at', 'email', 'password', 'fasi');
        for ($pCol = 0;$pCol < count($field_name);$pCol++) {
            $sheet->setCellValueByColumnAndRow($pCol, $pRow, $field_name[$pCol]);
        }
        $result_data = $this->Company_model->getAllName();
        $result = $result_data['data'];
        $pCol = 0;
        $pRow = 2;
        foreach ($result as $row) {
            foreach ($row as $col) {
                $sheet->setCellValueByColumnAndRow($pCol, $pRow, $col);
                $pCol++;
            }
            $pCol = 0;
            $pRow++;
        }
        header('Content-Encoding: utf-8');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: inline;filename="export.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        //$objWriter->save('export.xls');
        
    }
    public function import() {
        $upload_path = sprintf('%suser/excel/', PATH_UPLOAD);
        if (!file_exists($upload_path)) {
            $this->makeDirectory($upload_path);
        }
        $rslt = $this->doUpload('upload_excel', $upload_path);
        $path = '';
        if ($rslt['possible'] == 1) {
            $path = $rslt['path'];
        }
        $objExcel = PHPExcel_IOFactory::load($path);
        $sheet = $objExcel->getSheet(0);
        $objPHPExcel = new PHPExcel();
        $sheet_out = $objPHPExcel->getSheet(0);
        $sheet_out->getPageMargins()->setTop(0.6);
        $sheet_out->getPageMargins()->setLeft(0.4);
        $sheet_out->getPageMargins()->setRight(0.4);
        $sheet_out->getPageMargins()->setBottom(0.5);
        $sheet_out->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_B5);
        $sheet_out->getPageSetup()->clearPrintArea();
        $sheet_out->setBreakByColumnAndRow(1, 0, PHPExcel_Worksheet::BREAK_COLUMN);
        $col = 0;
        $row = 1;
        for ($r = 2;$r <= $sheet->getHighestRow();$r++) {
            if ($sheet->getCellByColumnAndRow(0, $r)->getValue()) {
                $page_data['name'] = $sheet->getCellByColumnAndRow(0, $r)->getValue();
                $page_data['address'] = $sheet->getCellByColumnAndRow(1, $r)->getValue();
                $page_data['zipcode'] = $sheet->getCellByColumnAndRow(2, $r)->getValue();
                $page_data['city'] = $sheet->getCellByColumnAndRow(3, $r)->getValue();
                $page_data['country'] = $sheet->getCellByColumnAndRow(5, $r)->getValue();
                $page_data['logo_image'] = $sheet->getCellByColumnAndRow(6, $r)->getValue();
                $page_data['responsible_fasi_id'] = $sheet->getCellByColumnAndRow(7, $r)->getValue();
                $page_data['receive_notifications'] = $sheet->getCellByColumnAndRow(8, $r)->getValue();
                $page_data['note'] = $sheet->getCellByColumnAndRow(9, $r)->getValue();
                $page_data['active'] = $sheet->getCellByColumnAndRow(10, $r)->getValue();
                if (!$this->Company_model->insert($page_data)) {
                    $sheet_out->setCellValueByColumnAndRow($col, $row, $page_data['name']);
                    $col++;
                    if (count($this->User_model->getRow(array('name' => $page_data['name']))) > 0) {
                        $sheet_out->setCellValueByColumnAndRow($col, $row, "same name");
                    } else {
                        $sheet_out->setCellValueByColumnAndRow($col, $row, "format error(Mr, Mrs)!");
                    }
                    $col = 0;
                    $row++;
                }
            }
        }
        header('Content-Encoding: utf-8');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: inline;filename="report.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->setPreCalculateFormulas(false);
        //$objWriter->save('import_result.xls');
        $objWriter->save('php://output');
        $out_data["status"] = "Success";
        $this->response($out_data);
    }
    public function down_temp() {
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $sheet = $objPHPExcel->getActiveSheet();
        $pCol = 0;
        $pRow = 1;
        $field_name = array('id', 'name', 'address', 'zipcode', 'city', 'country', 'logo_image', 'responsible_fasi_id', 'receive_notification', 'note', 'active');;
        for ($pCol = 0;$pCol < count($field_name);$pCol++) {
            $sheet->setCellValueByColumnAndRow($pCol, $pRow, $field_name[$pCol]);
        }
        header('Content-Encoding: utf-8');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: inline;filename="export.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        //$objWriter->save('template.xls');
        
    }
}
?>
