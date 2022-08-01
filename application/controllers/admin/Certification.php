<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
// require APPPATH . '/third_party/TCPDF-master/tcpdf.php';
/**
 * Class : Certification (CertificationController)
 * Certification Class to control all certification related operations.
 * @author : ping
 * @version : 1.0
 * @since : 11 July 2018
 */
class Certification extends BaseController {
    /**
     * This is default constructor of the class
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('Certification_model');
        $this->load->library('Sidebar');
        $this->isLoggedIn();
        $this->global['sidebar'] = $this->sidebar->generate(array('selected_menu_id' => '12'), $this->role);
    }
    /**
     * This function used to load the first screen of the user
     */
    public function index(){
        $this->viewList();
    }
    /**
     * This function used to load the certification list
     */
    public function viewList(){
        $this->global['sidebar'] = array('selected_menu_id' => '12');
        if($this->isMasterAdmin()){
            $this->loadViews("admin/certification/certification_list", $this->global, NULL, NULL);
        }else{
            $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    /**
     * This function used to load the certification list
     */
    public function scc_list(){
        $side_params = array('selected_menu_id' => '12');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        if($this->isMasterAdmin()){
            $this->loadViews("admin/certification/scc_certification_list", $this->global, NULL, NULL);
        }else{
            $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    /**
     * This function used to view selected certification
     */
    public function viewCertification(){
        if($this->isMasterAdmin()){
            $cert_id = $this->input->post('cid');
            $certification_row = $this->Certification_model->getRow($cert_id);
            $this->load->model('Settings_model');
            $certification_temp = $this->Settings_model->getCertificate(array('id' => $certification_row[0]["cert_temp_id"]));
            $page_data["certification"] = $certification_row[0];
            $page_data["certification_template"] = $certification_temp[0];
            $this->loadViews("admin/certification/certification_view", $this->global, $page_data, NULL);
        }else{
            $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }

    public function viewExport(){
        if($this->isMasterAdmin()){
            
        }else{
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    /**
     * This function used to load All certification list
     */
    public function getList(){
        //$total = $this->Certification_model->all();
        $type = $this->input->post('type');
        $out_data = array();
        $table_data = $this->Certification_model->getList(array('a.certification_type' => $type));
        $records["data"] = $table_data['data'];
        //$records["recordsTotal"] = $total;
        $records['recordsTotal'] = $table_data["total"];
        $records['recordsFiltered'] = $table_data['filtertotal'];
        for($i = 0;$i < sizeof($records["data"]);$i++){
            $item = $records["data"][$i];
            $cur_date = date("Y-m-d H:i:s");
            $item['status'] = $item['check_status'];
            if($cur_date > $item['validate'] && $item['validate'] != '0000-00-00 00:00:00'){
                $item['status'] = 2;
                $item['txt_status'] = 'Expired';
            }else{
                if($type == 'SCC'){
                    if($item['check_status'] == 0){
                        $item['txt_status'] = 'Waiting Review';
                    }else{
                        $item['txt_status'] = 'Available';
                    }
                }else{
                    $item['status'] = 1;
                    $item['txt_status'] = 'Available';
                }
            }
            $records["data"][$i] = $item;
        }
        $this->response($records);
    }
    /**
     * This function used to load Actived certification list
     */
    public function getCertificationList(){
        $table_data = $this->Certification_model->getList4Select2($_REQUEST['term']);
        $records["results"] = $table_data;
        $this->response($records);
    }

    public function selectrow($id){
        $out_data = $this->Certification_model->getRow($id);
        $this->response($out_data);
    }

    public function deleteCertification(){
        if($this->isMasterAdmin()){
            $id = $this->input->post('id');
            foreach (json_decode($id) as $id){
                $cert_data["delete_flag"] = 1;
                $cert_data["deleted_at"] = date("Y-m-d H:i:s");
                $this->Certification_model->update($cert_data, $id);
            }
        }
    }

    public function scc_approve(){
        if($this->isMasterAdmin()){
            $id = $this->input->post('id');
            $status = $this->input->post('status');
            $cert_data['status'] = $status;
            return $this->Certification_model->update($cert_data, $id);
        }
    }

    public function export(){
        $content = $this->input->post('certifi_content');
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 001');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        // set some language-dependent strings (optional)
        if(@file_exists(dirname(__FILE__) . '/lang/eng.php')){
            require_once (dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        // ---------------------------------------------------------
        // set default font subsetting mode
        $pdf->setFontSubsetting(true);
        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 14, '', true);
        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
        // set text shadow effect
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
        // Set some content to print
        $html = <<<EOD
$content
EOD;
        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('example_001.pdf', 'I');
    }

    function sendemail(){
        $email = $this->input->post('email');
        //$content = $this->input->post('content');
        $id = $this->input->post('id');
        foreach (json_decode($id) as $id){
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $token = '';
            for ($i = 0;$i < 10;$i++){
                $token.= $characters[rand(0, $charactersLength - 1)];
            }
            $this->load->model("Token_model");
            $this->Token_model->insert(array("user_id" => $id, "token" => $token));
            $content = "<div>You received ceritifcation from administrator. Please click blow link to open certification.</div><br/>" . base_url('notification/certification?token=' . $token);
            $this->load->helper('mail');
            @send_phpmail_message($email, 'LMS Notification', $content);
            $sessiondata = $this->session->get_userdata();
            $activity_data["activity_type"] = "Email";
            $activity_data["user_id"] = $sessiondata["userId"];
            $activity_data["activity_message"] = $sessiondata["name"] . " sended Certification Email to " . $email;
            $this->load->model('Activity_model');
            $this->Activity_model->insert($activity_data);
        }
    }

}
?>
