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
class Account extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Account_model');
        $this->load->model('Examhistory_model');
        $this->isLoggedIn();  
        
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->load->library('Sidebar');
        
        if($this->isInstructor())
        {
            $invoice_amt = $this->Account_model->getTotalInvoice();
            $open_amt = $this->Account_model->getTotalAmount(array("pay_status" => "0"));

            $side_params = array('selected_menu_id'=>'8');
            $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);

            $page_data['invoice_amt'] = $invoice_amt;
            $page_data['open_amt'] = $open_amt;
            $this->loadViews("instructor/account/account_list", $this->global, $page_data , NULL);
        } else {

            $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL , NULL);   
        }
        
    }
    
    
    /**
     * This function used to load All account list
     */
    public function getList()
    {
        if($this->isInstructor())
        { 
            $table_data = $this->Account_model->getAccountList();
            
            $records["data"] = $table_data['data'];
            $records['recordsTotal'] = $table_data["total"];
            $records['recordsFiltered'] = $table_data['filtertotal'];

            $this->response($records); 
        } else {
            $records["data"] = array();        
            $records['recordsTotal'] = 0;
            $records['recordsFiltered'] = 0;

            $this->response($records); 
        }
    }

    public function updateAccountStatus()
    {
        if($this->isInstructor())
        { 
            $id = intval($this->input->post('id'));
            $status = intval($this->input->post('status'));
            return $this->Account_model->updateaccountstatus($id,$status);
        }
    }

    public function account_export()
    {
        $ids = $this->input->get('ids');
        $ids = explode(',', $ids);

        $pay_status = $this->input->get('pay_status');

        $result = array();

        foreach ($ids as $id) {
            $account = $this->Account_model->getAccountById_emerald($id);
            array_push($result, $account);
        }

        $table_data = $this->Account_model->getAccountList();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $sheet = $objPHPExcel->getActiveSheet();

        $pCol = 0;
        $pRow = 1;

        $field_name = array('Type', 'Company',	'First name',	'Last name' ,'Title', 'Price', 'Fasi', 'Pay Date', 'Status');

        for ($pCol = 0; $pCol < count($field_name); $pCol++){
            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$field_name[$pCol]);
        }

        $pCol = 0;
        $pRow = 2;

        foreach ($result as $row) {
            if($row['history_type'] == '0'){
                $sheet->setCellValueByColumnAndRow($pCol, $pRow,'Training');
            }
            else{
                $sheet->setCellValueByColumnAndRow($pCol, $pRow,'Exam');
            }
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['company_name']);
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['first_name']);
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['last_name']);
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['history_title']);
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['amount']);
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['fasi_name']);
            $pCol++;


            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['pay_date']);
            $pCol++;

            if($row['pay_status'] == 0){
                $status = 'OPEN';
            }
            else{
                $status = 'PAID';
            }

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$status);
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


    public function remove_row()
    {
        if($this->isInstructor())
        {
            $id = intval($this->input->post('id'));
            $status = intval($this->input->post('status'));
            return $this->Account_model->remove_account($id,$status);
        }
    }

    public function payment()
    {
        $this->load->library('Sidebar');
        if($this->isInstructor())
        {
            $invoice_amt = $this->Account_model->getTotalInvoice();
            $open_amt = $this->Account_model->getTotalAmount(array("pay_status" => "0"));

            $side_params = array('selected_menu_id'=>'10');
            $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);

            $page_data['invoice_amt'] = $invoice_amt;
            $page_data['open_amt'] = $open_amt;
            $this->loadViews("instructor/account/account_list", $this->global, $page_data , NULL);
        } else {
            $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL , NULL);
        }
    }
    public function subscription()
    {
        $this->load->library('Sidebar');
        if($this->isInstructor())
        {
            $invoice_amt = $this->Account_model->getTotalInvoice();
            $open_amt = $this->Account_model->getTotalAmount(array("pay_status" => "0"));

            $side_params = array('selected_menu_id'=>'11');
            $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);

            $page_data['invoice_amt'] = $invoice_amt;
            $page_data['open_amt'] = $open_amt;
            $this->loadViews("instructor/account/account_list", $this->global, $page_data , NULL);
        } else {
            $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL , NULL);
        }

    }
}

?>
