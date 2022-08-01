<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Certification (CertificationController)
 * Certification Class to control all Fasi certification related operations.
 * @author : ping
 * @version : 1.0
 * @since : 16 July 2018
 */
class Certification extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Certification_model');        
        $this->load->library('Sidebar');        
        $this->isLoggedIn();  
        $this->global['sidebar'] = $this->sidebar->generate(array('selected_menu_id'=>'6'), $this->role);        
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->viewList();
    }


    /**
     * This function used to load the certification list
     */
    public function viewList()
    {

        $side_params = array('selected_menu_id'=>'6-1');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);

        if($this->isFasi()) {   
            $this->loadViews("fasi/certification/certification_list", $this->global, NULL , NULL); 
        } else {
            $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL , NULL);   
        }
        
    }


    /**
     * This function used to view selected certification
     */
    public function viewCertification()
    {
        if($this->isFasi()) {   
            
            $cert_id = $this->input->post('cid');

            $certification_row = $this->Certification_model->getRow( $cert_id );
            $page_data["certification"] = $certification_row[0];

            $this->load->model('Settings_model'); 

            $certification_temp = $this->Settings_model->getCertificate(array('id'=>$certification_row[0]["cert_temp_id"]));
            $page_data["certification_template"] = $certification_temp[0];

            $this->loadViews("fasi/certification/certification_view", $this->global, $page_data , NULL); 

        } else {
            $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL , NULL);   
        }
        
    }


    public function viewExport() 
    {
            
        if($this->isSuperAdmin() || $this->isAdmin()) 
        {   
               
        } 
        else 
        {
            $this->loadViews("access", $this->global, NULL , NULL);   
        }  
    }
    
    
    /**
     * This function used to load All certification list
     */
    public function getList()
    {
        //$total = $this->Certification_model->all();
        
        $out_data = array();
        $sessiondata = $this->session->get_userdata();
        $this->load->model('Company_model');        
        $company_rows = $this->Company_model->getCompanyidListByFasi($sessiondata["userId"]);
        foreach ($company_rows as $row)
        {
            $company_list[] = $row['id'];
        }


        $type = $this->input->post('type');

        $out_data = array();

        $cond = array("b.company_id"=>$company_list, 'a.certification_type' => $type);

        $table_data = $this->Certification_model->getList($cond); 
        
        $records["data"] = $table_data['data'];        
        //$records["recordsTotal"] = $total;
        $records['recordsTotal'] = $table_data["total"];
        $records['recordsFiltered'] = $table_data['filtertotal'];

        for($i = 0 ; $i < sizeof($records["data"]) ; $i ++){
            $item = $records["data"][$i];

            $cur_date= date("Y-m-d H:i:s");

            $item['status'] =  $item['check_status'];

            if($cur_date > $item['validate'] && $item['validate'] != '0000-00-00 00:00:00'){
                $item['status'] = 2;
                $item['txt_status'] = $this->term['expired'];
            }
            else{
                if($type == 'SCC') {
                    if ($item['check_status'] == 0) {
                        $item['txt_status'] = $this->term['waitingreview'];
                    } else {
                        $item['txt_status'] = $this->term['available'];
                    }
                }
                else{
                    $item['status'] = 1;
                    $item['txt_status'] = $this->term['available'];
                }
            }

            $records["data"][$i] = $item;
        }

        $this->response($records); 
    }

    
    public function selectrow($id)
    {
        $out_data = $this->Certification_model->getRow($id);  
        $this->response($out_data); 
    }

    public function scc_approve()
    {
        if($this->isFasi()) {
            $id = $this->input->post('id');
            $status = $this->input->post('status');
            $cert_data['status'] = $status;

            return $this->Certification_model->update($cert_data, $id);
        }
    }


    /**
     * This function used to load the certification list
     */
    public function scc_list()
    {
        $side_params = array('selected_menu_id'=>'6-2');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);

        if($this->isFasi()) {
            $this->loadViews("fasi/certification/scc_certification_list", $this->global, NULL , NULL);
        } else {
            $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL , NULL);
        }
    }


}

?>