<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
// require APPPATH . '/third_party/PHPExcel.php';
// require APPPATH . '/third_party/TCPDF-master/tcpdf.php';
/**
 * Class : Account (AccountController)
 * Account Class to control all account related operations.
 * @author : ping
 * @version : 1.0
 * @since : 19 July 2018
 */
class Account extends BaseController {
    /**
     * This is default constructor of the class
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('Account_model');
        $this->load->model('Examhistory_model');
        $this->load->model('Plan_model');
        $this->isLoggedIn();
    }
    /**
     * This function used to load the first screen of the user
     */
    public function index(){
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '5');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        if($this->isSuperAdmin()){
            $invoice_amt = $this->Account_model->getTotalInvoice();
            $open_amt = $this->Account_model->getTotalAmount(array("pay_status" => "0"));            
            $page_data['invoice_amt'] = $invoice_amt;
            $page_data['open_amt'] = $open_amt;
            $this->loadViews("superadmin/account/account_list", $this->global, $page_data, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    /**
     * This function used to load All account list
     */
    // public function getList(){
    //     if($this->isSuperAdmin()){
    //         $table_data = $this->Account_model->getAccountList();
    //         $records["data"] = $table_data['data'];
    //         $records['recordsTotal'] = $table_data["total"];
    //         $records['recordsFiltered'] = $table_data['filtertotal'];
    //         $this->response($records);
    //     }else{
    //         $records["data"] = array();
    //         $records['recordsTotal'] = 0;
    //         $records['recordsFiltered'] = 0;
    //         $this->response($records);
    //     }
    // }
    public function invoiceDetail($id){
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '1');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        $filter['object_type'] = 'plan';
        $filter['id'] = $id;
        $this->load->model('Payment_model');
        $page_data['invoice'] = $this->Payment_model->getInoviceDetail($filter)[0];
        $this->load->model('Settings_model');
        $page_data['tax'] = $this->Settings_model->getTaxRate();
        // print_r($this->db->last_query());
        // die;
        $page_data['user'] = $this->session->userdata();
        $this->loadViews("_templates/company_invoice", $this->global, $page_data, NULL);
    }
    public function export($id){
        $filter['object_type'] = 'plan';
        $filter['id'] = $id;
        $this->load->model('Payment_model');
        $page_data['invoice'] = $this->Payment_model->getInoviceDetail($filter)[0];
        $this->load->model('Settings_model');
        $page_data['tax'] = $this->Settings_model->getTaxRate();
        // print_r($this->db->last_query());
        // die;
        $page_data['user'] = $this->session->userdata();
        $html = $this->load->view('_templates/company_invoice', $page_data, false);
        // print_r($html);
        // die;
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->writeHTML($html);
        $pdf->Output('invoice.pdf', 'I');

    }
    public function getinvoicelist(){
        $filter['object_type'] = 'plan';
        $this->load->model('Payment_model');
        $data = $this->Payment_model->getInvoices($filter);
        $records["data"] = $data;
        $records['recordsTotal'] = $table_data["total"];
        $records['recordsFiltered'] = $table_data['filtertotal'];
        $this->response($records);
        // $filtertotal = $this->db->count_all_results('', FALSE);
        // $this->response($data);
    }
    
    public function getpaymentlist(){
        if($this->isSuperAdmin()){
            $table_data = $this->Account_model->getPaymentList();
            $records["data"] = $table_data['data'];
            $records['recordsTotal'] = $table_data["total"];
            $records['recordsFiltered'] = $table_data['filtertotal'];
            $this->response($records);
        }else{
            $records["data"] = array();
            $records['recordsTotal'] = 0;
            $records['recordsFiltered'] = 0;
            $this->response($records);
        }
    }
    
    public function updateAccountStatus(){
        if($this->isSuperAdmin()){
            $id = intval($this->input->post('id'));
            $status = intval($this->input->post('status'));
            return $this->Account_model->updateaccountstatus($id, $status);
        }
    }
    
    public function account_export(){
        $ids = $this->input->get('ids');
        $ids = explode(',', $ids);
        $pay_status = $this->input->get('pay_status');
        $result = array();
        foreach ($ids as $id){
            $account = $this->Account_model->getAccountById_emerald($id);
            array_push($result, $account);
        }
        $table_data = $this->Account_model->getAccountList();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $sheet = $objPHPExcel->getActiveSheet();
        $pCol = 0;
        $pRow = 1;
        $field_name = array('Type', 'Company', 'First name', 'Last name', 'Title', 'Price', 'Fasi', 'Pay Date', 'Status');
        for ($pCol = 0;$pCol < count($field_name);$pCol++){
            $sheet->setCellValueByColumnAndRow($pCol, $pRow, $field_name[$pCol]);
        }
        $pCol = 0;
        $pRow = 2;
        foreach ($result as $row){
            if($row['history_type'] == '0'){
                $sheet->setCellValueByColumnAndRow($pCol, $pRow, 'Training');
            }else{
                $sheet->setCellValueByColumnAndRow($pCol, $pRow, 'Exam');
            }
            $pCol++;
            $sheet->setCellValueByColumnAndRow($pCol, $pRow, $row['company_name']);
            $pCol++;
            $sheet->setCellValueByColumnAndRow($pCol, $pRow, $row['first_name']);
            $pCol++;
            $sheet->setCellValueByColumnAndRow($pCol, $pRow, $row['last_name']);
            $pCol++;
            $sheet->setCellValueByColumnAndRow($pCol, $pRow, $row['history_title']);
            $pCol++;
            $sheet->setCellValueByColumnAndRow($pCol, $pRow, $row['amount']);
            $pCol++;
            $sheet->setCellValueByColumnAndRow($pCol, $pRow, $row['fasi_name']);
            $pCol++;
            $sheet->setCellValueByColumnAndRow($pCol, $pRow, $row['pay_date']);
            $pCol++;
            if($row['pay_status'] == 0){
                $status = 'OPEN';
            }else{
                $status = 'PAID';
            }
            $sheet->setCellValueByColumnAndRow($pCol, $pRow, $status);
            $pCol++;
            $pCol = 0;
            $pRow++;
        }
        header('Content-Encoding: utf-8');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: inline;filename="exam_history_export.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }
    
    public function remove_row(){
        if($this->isSuperAdmin()){
            $id = intval($this->input->post('id'));
            $status = intval($this->input->post('status'));
            return $this->Account_model->remove_account($id, $status);
        }
    }
    
    public function payment(){
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '3');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        if($this->isSuperAdmin()){
            $invoice_amt = $this->Account_model->getTotalInvoice();
            $open_amt = $this->Account_model->getTotalAmount(array("pay_status" => "0"));           
            $page_data['invoice_amt'] = $invoice_amt;
            $page_data['open_amt'] = $open_amt;
            $this->loadViews("superadmin/account/payment_list", $this->global, $page_data, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function subscription(){
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '4');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        if($this->isSuperAdmin()){            
            $datas = $this->Plan_model->all();
            $this->loadViews("superadmin/account/plan_list", $this->global, $page_data, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function subscription_list(){
        if($this->isSuperAdmin()){
            $table_data = $this->Plan_model->all();
            $count = $this->Plan_model->count();
            $records["data"] = $table_data;
            $records['recordsTotal'] = $count;
            $records['recordsFiltered'] = $count;
            $this->response($records);
        }else{
            $records["data"] = array();
            $records['recordsTotal'] = 0;
            $records['recordsFiltered'] = 0;
            $this->response($records);
        }
    }
    
    public function subscription_edit($row_id = 0){
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '4');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        if($this->isSuperAdmin()){
            $page_path = "superadmin/account/plan_edit";
            $lang_ar = $this->Translate_model->getLanguageList(array('active_flag' => 1, 'add_flag' => 1));
            $page_data['lang_ar'] = $lang_ar['data'];
            if($row_id != 0){
                $result = $this->Plan_model->select($row_id);
                $page_data['price_type'] = $result->price_type;
                $page_data['id'] = $row_id;
                $page_data['name'] = $result->name;
                $page_data['price'] = $result->price;
                $page_data['user_limit'] = $result->user_limit;
                $page_data['library_limit'] = $result->library_limit;
                $page_data['demand_limit'] = $result->demand_limit;
                $page_data['vilt_user_limit'] = $result->vilt_user_limit;
                $page_data['vilt_room_limit'] = $result->vilt_room_limit;
                $page_data['ilt_user_limit'] = $result->ilt_user_limit;
                $page_data['ilt_room_limit'] = $result->ilt_room_limit;
            }else{
                $page_data['price_type'] = - 1;
                $page_data['id'] = 0;
                $page_data['name'] = '';
                $page_data['price'] = 0;
                $page_data['user_limit'] = 0;
                $page_data['library_limit'] = 0;
                $page_data['demand_limit'] = 0;
                $page_data['vilt_user_limit'] = 0;
                $page_data['vilt_room_limit'] = 0;
                $page_data['ilt_user_limit'] = 0;
                $page_data['ilt_room_limit'] = 0;
            }
            $this->loadViews($page_path, $this->global, $page_data, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL, NULL); 
        }
    }

    public function subscription_save(){
        $update_data = array();
        $id = $this->input->post("id");
        foreach ($this->input->post() as $key => $value){
            $update_data[$key] = $value;
        }
        unset($update_data['id']);
        return $this->Plan_model->update($update_data, array('id' => $id));
    }
    /*    public function subscription()
    {
        $this->load->library('Sidebar');
        if($this->isSuperAdmin())
        {
            $invoice_amt = $this->Account_model->getTotalInvoice();
            $open_amt = $this->Account_model->getTotalAmount(array("pay_status" => "0"));
    
            $side_params = array('selected_menu_id'=>'4');
            $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
    
            $page_data['invoice_amt'] = $invoice_amt;
            $page_data['open_amt'] = $open_amt;
            $this->loadViews("superadmin/account/account_list", $this->global, $page_data , NULL);
        }else{
            $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL , NULL);
        }
    
    }*/
}
?>
