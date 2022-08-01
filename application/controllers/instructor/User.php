<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
require APPPATH . '/third_party/PHPExcel.php';
/**
 * Created by PhpStorm.
 * User: Timon
 * Date: 6/27/2018
 * Time: 6:07 PM
 */

class User extends BaseController
{

    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Certification_model');
        $this->load->model('Notification_model');
        $this->load->model('Company_model');
        $this->load->model('Examassignemployee_model');
        $this->load->model('Exam_model');
        $this->load->model('Examassignemployee_model');
        $this->load->model('Translate_model');
        $this->load->model('Notification_model');

        $this->isLoggedIn();
    }

    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->employee_view();

    }

    public function edit_view($type='', $row_id=0){
        $this->load->library('Sidebar');

        $side_params = array('selected_menu_id'=>'2-4');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        $page_path = "fasi/user/employee_edit";
        $page_data['company_data']=$this->Company_model->getList(array('active'=>1));

        $lang_ar = $this->Translate_model->getLanguageList(array('active_flag' => 1,'add_flag' => 1 ));
        $page_data['lang_ar'] = $lang_ar['data'];

        if($row_id != 0)
        {
            $user_data = $this->User_model->getList(array('id'=>$row_id))[0];

            $page_data['id'] = $row_id;
            $page_data['user_type']=$user_data['user_type'];
            $page_data['salutation']=$user_data['salutation'];
            $page_data['first_name']=$user_data['first_name'];
            $page_data['last_name']=$user_data['last_name'];
            $page_data['birthday']=$user_data['birthday'];
            $page_data['picture']=$user_data['picture'];
            $page_data['department']=$user_data['department'];
            $page_data['job_title']=$user_data['job_title'];
            $page_data['phone_number']=$user_data['phone_number'];
            $page_data['company_id']=$user_data['company'];
            $page_data['task_area']=$user_data['task_area'];
            $page_data['language']=$user_data['language'];
            $page_data['notification_method']=$user_data['notification_method'];
            $page_data['email']=$user_data['email'];
            $page_data['nickname']=$user_data['nickname'];
            $page_data['password']='';
            $page_data['remember_token']=$user_data['remember_token'];
            $page_data['active']=$user_data['active'];
            $page_data['status']=$user_data['status'];
            $page_data['share']=$user_data['share'];
        }
        else
        {
            $page_data['id'] = 0;
            $page_data['user_type']='';
            $page_data['salutation']='Mr';
            $page_data['first_name']='';
            $page_data['last_name']='';
            $page_data['birthday']=date('m/d/Y');
            $page_data['picture']='';
            $page_data['department']='';
            $page_data['job_title']='';
            $page_data['phone_number']='';
            $page_data['company_id']='';
            $page_data['task_area']='';
            $page_data['language']='';
            $page_data['notification_method']='';
            $page_data['email']='';
            $page_data['nickname']='';
            $page_data['password']='';
            $page_data['remember_token']='';
            $page_data['active']=1;
            $page_data['status']='';
            $page_data['share']='N';
        }

        $this->loadViews($page_path, $this->global, $page_data , NULL);
    }

    public function employee_view(){
        $sessiondata = $this->session->get_userdata();
        $this->load->library('Sidebar');

        $side_params = array('selected_menu_id'=>'2-4');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        $this->global['company'] = $this->Company_model->getCompanyForFasi_emerald($sessiondata['userId']);
        $this->global['exam'] = $this->Exam_model->getAll_emerald();

        $this->loadViews("fasi/user/employee_list", $this->global, NULL , NULL);

    }

    /**
     * This function used to load All admin-user list
     */
    public function getData()
    {
        // $type = $this->input->post("type");
        // $table_data['data'] = $this->User_model->getListByFasi($this->session->userdata('user_id'));
        // for ($i = 0; $i < sizeof($table_data['data']); $i++) {
        //     $exam = $this->Examassignemployee_model->getExamByEmployee_emerald($table_data['data'][$i]->id);
        //     $table_data['data'][$i]->exam = json_encode($exam);
        // }
        $table_data['data'] = $this->User_model->getList(array('company_id' => $this->session->get_userdata() ['company_id'], 'user_type !=' => 'Admin'));
        foreach ($table_data['data'] as $key => $row){
            $table_data['data'][$key]["no"] = $key + 1;
			$table_data['data'][$key]["picture"] = NULL;
			$imgName = end(explode('/', $row['picture']));
			if($imgName != '' && file_exists(getcwd().'/assets/uploads/user/photo/'.$imgName)){
				$table_data['data'][$key]["picture"] = $row['picture'];		
			}			
        }

        $this->response($table_data);
    }

	/**
     * This function used to load All admin-user list for select2 
     */
    public function getNameListbyRole()
    {
        $sessiondata = $this->session->get_userdata();
        $where = array('responsible_fasi_id' => $sessiondata['userId']);
        $table_data['results'] = $this->Company_model->getNameList($where)['data'];
        //$table_data['results'] = $this->User_model->getNameList(array('user_type'=>$type));
        $this->response($table_data);
    }

    public function insert()
    {
        $insert_data = array();

        $upload_path = sprintf('%suser/photo/', PATH_UPLOAD);

        if (!file_exists($upload_path))
        {
            $this->makeDirectory($upload_path);
        }

        $rslt = $this->doUpload('picture', $upload_path);

        if ($rslt['possible'] == 1){
            $insert_data['picture'] = str_replace("./", "", $rslt['path']);
        }

        foreach ($this->input->post() as $key => $value) {
            $insert_data[$key] = $value;
        }
        unset($insert_data['id']);

        $timestamp = strtotime($insert_data['birthday']);
        $date = date('Y-m-d', $timestamp);
        $insert_data['birthday'] = $date;
        if (!empty(trim($this->input->post('password')))) {
            $insert_data['org_password'] = $this->input->post('password');
            $insert_data['password'] = getHashedPassword($this->input->post('password'));
        }

        $pool = '0123456789';
        $api_key = substr(str_shuffle(str_repeat($pool, ceil(10 / strlen($pool)))), 0, 10);
        $insert_data['api_key'] = $api_key;
                
        //return $this->User_model->insert($insert_data);
        $user_id = $this->User_model->insert($insert_data);

        //welcome notification creaste
        $notif_data["notification_type"] = "normal";
        $notif_data["from_user_id"] = $this->vendorId;
        $notif_data["to_user_id"] = $user_id;
        $notif_data["notification_title"] = "Welcome!";
        $notif_data["notification_message"] = sprintf("Welcome to register with %s in our site.", $insert_data["email"]);
        $this->Notification_model->create($notif_data);

        return $user_id;
    }

    public function delete()
    {
        $id = $this->input->post("id");
        $this->load->model('Certification_model');
        $userAr = $this->Certification_model->getRowByUserid($id);

        if(sizeof($userAr) > 0){
            echo 'error';
        }
        else {
            return $this->User_model->delete(array('id' => $id));
        }
    }

    public function update()
    {
        $update_data = array();
        $id = $this->input->post("id");
        $upload_path = sprintf('%suser/photo/', PATH_UPLOAD);

        if (!file_exists($upload_path))
        {
            $this->makeDirectory($upload_path);
        }

        $rslt = $this->doUpload('picture', $upload_path);
        if ($rslt['possible'] == 1){
            $update_data['picture'] = str_replace("./", "", $rslt['path']);

        }
        foreach ($this->input->post() as $key => $value) {
            $update_data[$key] = $value;
        }

        $timestamp = strtotime($update_data['birthday']);
        $date = date('Y-m-d', $timestamp);
        $update_data['birthday'] = $date;

        if($this->input->post('password') == ''){
            unset($update_data['password']);
        }else{
            $update_data['password'] = getHashedPassword($this->input->post('password'));
        }
        $share = $this->input->post('share');
        if(isset($share)){
            $update_data['share'] = 'Y';
        }
        else{
            $update_data['share'] = 'N';
        }
        return $this->User_model->update($update_data, array('id'=>$id));
    }

    public function export($type){

        $company = $this->input->get('company');
        $exam = $this->input->get('exam');
        $start = $this->input->get('start');
        $end = $this->input->get('end');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $sheet = $objPHPExcel->getActiveSheet();

        $pCol = 0;
        $pRow = 1;

        $field_name = array('id','user_type', 'salutation', 'first_name', 'last_name',
            'birthday', 'picture', 'department', 'job_title', 'phone_number',
            'company_name', 'task_area', 'language', 'notification_method', 'email',
            'password', 'remember_token', 'active');

        for ($pCol = 0; $pCol < count($field_name); $pCol++){
            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$field_name[$pCol]);
        }


        $result = $this->User_model->getExportList_emerald(array('user_type'=>$type, 'company'=>$company, 'exam'=>$exam, 'start'=>$start, 'end'=>$end));
        unset($result['created_at']);
        unset($result['updated_at']);

        $pCol = 0;
        $pRow = 2;

        foreach ($result as $row) {
            for ($pCol = 0; $pCol < count($field_name); $pCol++){
                $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row[$field_name[$pCol]]);
            }
            /*
            foreach ($row as $col){
                $sheet->setCellValueByColumnAndRow($pCol, $pRow,$col);
                $pCol++;
            }
            $pCol = 0;
            */
            $pRow++;
        }

        header('Content-Encoding: utf-8');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: inline;filename="export.xls"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

        //echo $objWriter->save('php://output');
        $objWriter->save('php://output');
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

                $page_data['user_type']=$sheet->getCellByColumnAndRow(0,$r)->getValue();
                $page_data['salutation']=$sheet->getCellByColumnAndRow(1,$r)->getValue();
                $page_data['first_name']=$sheet->getCellByColumnAndRow(2,$r)->getValue();
                $page_data['last_name']=$sheet->getCellByColumnAndRow(3,$r)->getValue();
                $timestamp = strtotime($sheet->getCellByColumnAndRow(4,$r)->getValue());
                $date = date('Y-m-d', $timestamp);
                $page_data['birthday']=$date;
                $page_data['department']=$sheet->getCellByColumnAndRow(5,$r)->getValue();
                $page_data['job_title']=$sheet->getCellByColumnAndRow(6,$r)->getValue();
                $page_data['phone_number']=$sheet->getCellByColumnAndRow(7,$r)->getValue();
                $page_data['task_area']=$sheet->getCellByColumnAndRow(8,$r)->getValue();
                $page_data['language']=$sheet->getCellByColumnAndRow(9,$r)->getValue();
                $page_data['notification_method']=$sheet->getCellByColumnAndRow(10,$r)->getValue();
                $page_data['email']=$sheet->getCellByColumnAndRow(11,$r)->getValue();
                $page_data['nickname']=$sheet->getCellByColumnAndRow(12,$r)->getValue();
                $page_data['password']=$sheet->getCellByColumnAndRow(13,$r)->getValue();
                $page_data['remember_token']=$sheet->getCellByColumnAndRow(14,$r)->getValue();
                $page_data['active']=$sheet->getCellByColumnAndRow(15,$r)->getValue();
                $page_data['status']=$sheet->getCellByColumnAndRow(16,$r)->getValue();

                if(!$this->User_model->insert($page_data)){
                    $sheet_out->setCellValueByColumnAndRow($col, $row,$page_data['email']);
                    $col++;
                    if(count($this->User_model->getRow(array('email'=>$page_data['email'])))>0)
                    {
                        $sheet_out->setCellValueByColumnAndRow($col, $row,"same email");

                    }elseif (count($this->User_model->getRow(array('nickname'=>$page_data['nickname'])))>0){
                        $sheet_out->setCellValueByColumnAndRow($col, $row,"same nickname");
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

        $field_name = array('id','user_type', 'salutation', 'first_name', 'last_name',
            'birthday', 'picture', 'department', 'job_title', 'phone_number',
            'company_id', 'task_area', 'language', 'notification_method', 'email',
            'password', 'remember_token', 'active');

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
