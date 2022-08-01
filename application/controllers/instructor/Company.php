<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
// require APPPATH . '/third_party/PHPExcel.php';
/**
 * Created by PhpStorm.
 * User: Timon
 * Date: 6/27/2018
 * Time: 6:07 PM
 */

class Company extends BaseController
{

    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Company_model');
        $this->load->model('User_model');
        $this->load->model('Translate_model');
        $this->isLoggedIn();
    }

    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->company_view();

    }

    public function edit_view($row_id=0){
        $this->load->library('Sidebar');

        $side_params = array('selected_menu_id'=>'3-1');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        $page_path = "fasi/company/company_edit";

        $page_data['fasi_data'] = $this->User_model->getList(array('user_type'=>FASI, 'active'=>1));

        $lang_ar = $this->Translate_model->getLanguageList(array('active_flag' => 1,'add_flag' => 1 ));
        $page_data['lang_ar'] = $lang_ar['data'];
        if($row_id != 0)
        {
            $user_data = $this->Company_model->getListByID($row_id)[0];

            $page_data['id'] = $row_id;
            $page_data['email'] = $user_data['email'];
            $page_data['password'] = '';
            $page_data['name']=$user_data['name'];
            $page_data['address']=$user_data['address'];
            $page_data['zipcode']=$user_data['zipcode'];
            $page_data['city']=$user_data['city'];
            $page_data['country']=$user_data['country'];
            $page_data['logo_image']=$user_data['logo_image'];
            $page_data['responsible_fasi_id']=$user_data['responsible_fasi_id'];
            $page_data['receive_notifications']=$user_data['receive_notifications'];
            $page_data['note']=$user_data['note'];
            $page_data['active']=$user_data['active'];
            $page_data['share']=$user_data['share'];
            $page_data['language']=$user_data['language'];

        }
        else
        {
            $page_data['id'] = 0;
            $page_data['name']='';
            $page_data['address']='';
            $page_data['email'] = '';
            $page_data['password'] = '';
            $page_data['zipcode']='';
            $page_data['city']='';
            $page_data['country']='';
            $page_data['logo_image']='';
            $page_data['responsible_fasi_id']='';
            $page_data['receive_notifications']='';
            $page_data['note']='';
            $page_data['active']=1;
            $page_data['share']='N';
            $page_data['language']='';

        }

        $this->loadViews($page_path, $this->global, $page_data , NULL);
    }

    public function company_view(){
        $this->load->library('Sidebar');

        $side_params = array('selected_menu_id'=>'3-1');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);

        $this->loadViews("fasi/company/company_list", $this->global, NULL , NULL);

    }

    public function getData()
    {
        $table_data['data'] = $this->Company_model->getListByFasiID($this->session->userdata('user_id'));

        $this->response($table_data);
    }

    public function insert()
    {
        $insert_data = array();
        $insert_data_user = array();

        $upload_path = sprintf('%suser/photo/', PATH_UPLOAD);

        if (!file_exists($upload_path))
        {
            $this->makeDirectory($upload_path);
        }

        $rslt = $this->doUpload('picture', $upload_path);

        if ($rslt['possible'] == 1){
            $insert_data['logo_image'] = str_replace("./", "", $rslt['path']);
            $insert_data_user['picture'] = str_replace("./", "", $rslt['path']);
        }

        $insert_data_user['email'] = $this->input->post('email');

        $insert_data_user['org_password'] = $this->input->post('password');
        $insert_data_user['company_name'] = $this->input->post('name');

        $insert_data_user['password'] = md5($this->input->post('password'));
        $insert_data_user['user_type'] = 'Company';
        $insert_data_user['language'] = $this->input->post('language');

        $user_id = $this->User_model->insert($insert_data_user);


        foreach ($this->input->post() as $key => $value) {
            $insert_data[$key] = $value;
        }

        $insert_data['id'] = $user_id;

        unset($insert_data['email']);
        unset($insert_data['password']);
        unset($insert_data['language']);

        $this->Company_model->insert($insert_data);
        return $user_id;
    }

    public function delete()
    {
        $id = $this->input->post("id");

        if($this->Company_model->delete(array('id'=>$id)) && $this->User_model->delete(array('id'=>$id)))
            $res['status'] = 'Success';
        else
            $res['status'] = 'Failed';
        return $res;
    }

    public function update()
    {
        $update_data = array();
        $update_data_user = array();

        $id = $this->input->post("id");
        $upload_path = sprintf('%suser/photo/', PATH_UPLOAD);

        if (!file_exists($upload_path))
        {
            $this->makeDirectory($upload_path);
        }

        $rslt = $this->doUpload('picture', $upload_path);
        if ($rslt['possible'] == 1){
            $update_data['logo_image'] = str_replace("./", "", $rslt['path']);
            $update_data_user['picture'] = str_replace("./", "", $rslt['path']);
        }

        $update_data_user['email'] = $this->input->post('email');
        if($this->input->post('password') == ''){
            unset($update_data_user['password']);
        }else{
            $update_data_user['password'] = md5($this->input->post('password'));
        }

        $share = $this->input->post('share');
        if(isset($share)){
            $update_data_user['share'] = 'Y';
        }
        else{
            $update_data_user['share'] = 'N';
        }
        $insert_data_user['language'] = $this->input->post('language');
        $this->User_model->update($update_data_user, array('id'=>$id));

        foreach ($this->input->post() as $key => $value) {
            $update_data[$key] = $value;
        }

        unset($update_data['email']);
        unset($update_data['password']);
        unset($update_data['id']);
        unset($update_data['share']);
        unset($update_data['language']);

        return $this->Company_model->update($update_data, array('id'=>$id));
    }

    public function export(){

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $sheet = $objPHPExcel->getActiveSheet();

        $pCol = 0;
        $pRow = 1;

        $field_name = array('id', 'name', 'address', 'zipcode', 'city', 'country',
            'logo_image', 'responsible_fasi_id', 'receive_notifications', 'note', 'active','created_at', 'updated_at','email','password', 'fasi');

        for ($pCol = 0; $pCol < count($field_name); $pCol++){
            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$field_name[$pCol]);
        }


        $result = $this->Company_model->getListByFasiID($this->session->userdata('user_id'));

        $pCol = 0;
        $pRow = 2;

        foreach ($result as $row) {
            foreach ($row as $col){
                $sheet->setCellValueByColumnAndRow($pCol, $pRow,$col);
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
        company_view();
    }

    public function import(){
        $upload_path = sprintf('%suser/excel/', PATH_UPLOAD);

        if (!file_exists($upload_path))
        {
            $this->makeDirectory($upload_path);
        }

        $rslt = $this->doUpload('upload_excel', $upload_path);

        $path = '';
        if ($rslt['possible'] == 1){
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

        $sheet_out->setBreakByColumnAndRow(1,0,PHPExcel_Worksheet::BREAK_COLUMN);

        $col = 0;$row = 1;
        for($r = 2;$r<=$sheet->getHighestRow();$r++) {
            if($sheet->getCellByColumnAndRow(0,$r)->getValue()) {

                $page_data['name']=$sheet->getCellByColumnAndRow(0,$r)->getValue();
                $page_data['address']=$sheet->getCellByColumnAndRow(1,$r)->getValue();
                $page_data['zipcode']=$sheet->getCellByColumnAndRow(2,$r)->getValue();
                $page_data['city']=$sheet->getCellByColumnAndRow(3,$r)->getValue();
                $page_data['country']=$sheet->getCellByColumnAndRow(5,$r)->getValue();
                $page_data['logo_image']=$sheet->getCellByColumnAndRow(6,$r)->getValue();
                $page_data['responsible_fasi_id']=$sheet->getCellByColumnAndRow(7,$r)->getValue();
                $page_data['receive_notifications']=$sheet->getCellByColumnAndRow(8,$r)->getValue();
                $page_data['note']=$sheet->getCellByColumnAndRow(9,$r)->getValue();
                $page_data['active']=$sheet->getCellByColumnAndRow(10,$r)->getValue();

                if(!$this->Company_model->insert($page_data)){
                    $sheet_out->setCellValueByColumnAndRow($col, $row,$page_data['name']);
                    $col++;
                    if(count($this->User_model->getRow(array('name'=>$page_data['name'])))>0)
                    {
                        $sheet_out->setCellValueByColumnAndRow($col, $row,"same name");

                    }else{
                        $sheet_out->setCellValueByColumnAndRow($col, $row,"format error(Mr, Mrs)!");
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

    public function down_temp(){

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $sheet = $objPHPExcel->getActiveSheet();

        $pCol = 0;
        $pRow = 1;

        $field_name = array('id', 'name', 'address', 'zipcode', 'city', 'country',
            'logo_image', 'responsible_fasi_id', 'receive_notification', 'note', 'active');;

        for ($pCol = 0; $pCol < count($field_name); $pCol++){
            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$field_name[$pCol]);
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
