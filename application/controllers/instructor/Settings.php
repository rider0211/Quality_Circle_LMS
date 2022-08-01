<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
/**
 * Created by PhpStorm.
 * User: Timon
 * Date: 7/13/2018
 * Time: 9:17 AM
 */
class Settings extends BaseController {
    public function __construct(){
        parent::__construct();
        $this->load->model('Settings_model');
        $this->load->model('Translate_model');
        $this->load->library('Country');
        $this->isLoggedIn();
    }
    
    public function index(){
        $this->theme_view();
    }
    
    public function theme_view(){
        $this->load->library('Sidebar');
        if($this->isInstructor()){
            $side_params = array('selected_menu_id' => '9');
            $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
            $theme = $this->Settings_model->getTheme() [0];
            $this->loadViews("instructor/settings/setting_theme", $this->global, $theme, NULL);
        }else{
            $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function menu_view(){
        $this->load->library('Sidebar');
        if($this->isInstructor()){
            $side_params = array('selected_menu_id' => '9');
            $this->global['instructor'] = $this->sidebar->generate($side_params, $this->role);
            $this->loadViews("instructor/settings/setting_menu", $this->global, NULL, NULL);
        }else{
            $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function get_Menu(){
        $level = $this->input->post('level');
        $menu['data'] = $this->Settings_model->getMenu(array('level' => $level));
        $this->response($menu);
    }
    
    public function save_theme(){
        $insert_data = array();
        $upload_path = sprintf('%ssettings/theme/', PATH_UPLOAD);
        if(!file_exists($upload_path)){
            $this->makeDirectory($upload_path);
        }
        $rslt = $this->doUpload('logo', $upload_path);
        if($rslt['possible'] == 1){
            $insert_data['logo'] = str_replace("./", "", $rslt['path']);
        }
        $rslt = $this->doUpload('favicon', $upload_path);
        if($rslt['possible'] == 1){
            $insert_data['favicon'] = str_replace("./", "", $rslt['path']);
        }
        $rslt = $this->doUpload('login_bg', $upload_path);
        if($rslt['possible'] == 1){
            $insert_data['login_bg'] = str_replace("./", "", $rslt['path']);
        }
        foreach ($this->input->post() as $key => $value){
            $insert_data[$key] = $value;
        }
        if($this->input->post('editid')){
            $editid = $this->input->post('editid');
        }
        unset($insert_data['editid']);
        if($editid) $this->Settings_model->updateTheme($insert_data, $editid);
        else $this->Settings_model->saveTheme($insert_data);
        redirect(base_url('instructor/settings/theme'));
    }
    
    public function global_view(){
        $this->load->library('Sidebar');
        if($this->isInstructor()){
            $side_params = array('selected_menu_id' => '9');
            $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
            $etmp['email_account_created'] = $this->Settings_model->getGlobal(array('action' => 'email_account_created')) [0]['value'];
            $etmp['forgotten_password'] = $this->Settings_model->getGlobal(array('action' => 'forgotten_password')) [0]['value'];
            $etmp['password_reset'] = $this->Settings_model->getGlobal(array('action' => 'password_reset')) [0]['value'];
            $etmp['feedback_received'] = $this->Settings_model->getGlobal(array('action' => 'feedback_received')) [0]['value'];
            $etmp['exam_passed'] = $this->Settings_model->getGlobal(array('action' => 'exam_passed')) [0]['value'];
            $etmp['exam_unpassed'] = $this->Settings_model->getGlobal(array('action' => 'exam_unpassed')) [0]['value'];
            $etmp['notification_employee'] = $this->Settings_model->getGlobal(array('action' => 'notification_employee')) [0]['value'];
            $etmp['notification_fasi'] = $this->Settings_model->getGlobal(array('action' => 'notification_fasi')) [0]['value'];
            $etmp['notification_exam'] = $this->Settings_model->getGlobal(array('action' => 'notification_exam')) [0]['value'];
            //            $this->loadViews("instructor/settings/setting_emailtemp", $this->global, $etmp , NULL);
            
        }else{
            $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function save_emailtemp(){
        $insert_data = array();
        foreach ($this->input->post() as $key => $value){
            $insert_data['value'] = $value;
            $this->Settings_model->saveGlobal($insert_data, array('action' => $key));
        }
        $this->emailtemp_view();
    }
    
    public function emailtemp_view(){
        $this->load->library('Sidebar');
        $company_id = $this->session->get_userdata() ['company_id'];
        if($this->isInstructor()){
            $side_params = array('selected_menu_id' => '17');
            $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
            if($this->input->get('email')){
                $where = array('action' => $this->input->get('email'), 'company_id' => $company_id);
                $data = $this->Settings_model->getEmailTemplate($where);
                if($data){
                    $etmp['subject'] = $data['subject'];
                    $e_message = str_replace("'", "\'", $data['message']);
                    $etmp['message'] = str_replace("\n", "", $e_message);
                    $etmp['editid'] = $data['id'];
                }
            }
            $this->db->select('*');
            $blocks_category = $this->db->get('block_category')->result_array();
            $actual_link = site_url();
            $_outputHtml = '';
            for ($i = 0;$i < sizeof($blocks_category);$i++){
                $_outputHtml.= '<li class="elements-accordion-item" data-type="' . strtolower($blocks_category[$i]['name']) . '"><a class="elements-accordion-item-title">' . $blocks_category[$i]['name'] . '</a>';
                $_outputHtml.= '<div class="elements-accordion-item-content"><ul class="elements-list">';
                $this->db->where('cat_id', $blocks_category[$i]['id']);
                $_items = $blocks = $this->db->get('blocks')->result_array();
                for ($j = 0;$j < sizeof($_items);$j++){
                    $_outputHtml.= '<li>' . '<div class="elements-list-item">' . '<div class="preview">' . '<div class="elements-item-icon">' . ' <i class="' . $_items[$j]['icon'] . '"></i>' . '</div>' . '<div class="elements-item-name">' . $_items[$j]['name'] . '</div>' . '</div>' . '<div class="view">' . '<div class="sortable-row">' . '<div class="sortable-row-container">' . ' <div class="sortable-row-actions">';
                    $_outputHtml.= '<div class="row-move row-action">' . '<i class="fa fa-arrows-alt"></i>' . '</div>';
                    $_outputHtml.= '<div class="row-remove row-action">' . '<i class="fa fa-remove"></i>' . '</div>';
                    $_outputHtml.= '<div class="row-duplicate row-action">' . '<i class="fa fa-files-o"></i>' . '</div>';
                    $_outputHtml.= '<div class="row-code row-action">' . '<i class="fa fa-code"></i>' . '</div>';
                    $_outputHtml.= '</div>' . '<div class="sortable-row-content"  data-id="' . $_items[$j]['id'] . '" data-types="' . $_items[$j]['property'] . '"  data-last-type="' . explode(',', $_items[$j]['property']) [0] . '">' . str_replace('[site-url]', $actual_link, $_items[$j]['html']) . '</div>' . '</div>' . '</div>' . ' </div>' . '</div>' . '</li>';
                }
                $_outputHtml.= '</ul></div>';
                $_outputHtml.= '</li>';
            }
            $this->global['_outputHtml'] = $_outputHtml;
            $this->loadViews("instructor/settings/setting_emailtemp", $this->global, $etmp, NULL);
        }else{
            $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function save_smstemp(){
        $insert_data = array();
        if($this->input->post('editid')){
            $editid = $this->input->post('editid');
        }
        $params = array('action' => 'sms_template', 'value' => $this->input->post('sms_template'));
        if(!$editid) $this->Settings_model->setGlobal($params);
        else $this->Settings_model->saveGlobal($params, array('id' => $editid));
        //$this->smstemp_view();
        redirect(base_url('instructor/settings/smstemp'));
    }
    
    public function smstemp_view(){
        $this->load->library('Sidebar');
        if($this->isInstructor()){
            $side_params = array('selected_menu_id' => '9');
            $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
            $smsData = $this->Settings_model->getGlobal(array('action' => 'sms_template'));
            $etmp['sms_template'] = $smsData[0]['value'];
            $etmp['editid'] = $smsData[0]['id'];
            $this->loadViews("instructor/settings/setting_smstemp", $this->global, $etmp, NULL);
        }else{
            $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function certificate_view(){
        $this->load->library('Sidebar');
        if($this->isInstructor()){
            $side_params = array('selected_menu_id' => '15');
            $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
            $this->loadViews("instructor/settings/setting_certificate_temp_list", $this->global, NULL, NULL);
        }else{
            $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function certificate_edit_view($row_id = 0){
        $this->load->library('Sidebar');
        if($this->isInstructor()){
            $side_params = array('selected_menu_id' => '15');
            $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
            if($row_id != 0){
                $data = $this->Settings_model->getCertificate(array('id' => $row_id)) [0];
                $page_data['id'] = $row_id;
                $page_data['title'] = $data['title'];
                $page_data['logo'] = $data['logo'];
                $page_data['content'] = str_replace("\n", "", $data['content']);
                $page_data['left_sign'] = $data['left_sign'];
                $page_data['right_sign'] = $data['right_sign'];
                $page_data['left_des'] = $data['left_des'];
                $page_data['right_des'] = $data['right_des'];
                $page_data['watermark'] = $data['watermark'];
                $page_data['middle_logo'] = $data['middle_logo'];
                //print_r("id = "+$row_id + ";------------");
                //print_r($page_data['content']);
                //exit();                
            }else{
                $page_data['id'] = 0;
                $page_data['title'] = '';
                $page_data['logo'] = '';
                $page_data['content'] = '';
                $page_data['left_sign'] = '';
                $page_data['right_sign'] = '';
                $page_data['left_des'] = '';
                $page_data['right_des'] = '';
                $page_data['watermark'] = '';
                $page_data['middle_logo'] = '';
            }
            $this->db->select('*');
            $blocks_category = $this->db->get('block_category')->result_array();
            $actual_link = site_url();
            $_outputHtml = '';
            for ($i = 0;$i < sizeof($blocks_category);$i++){
                $_outputHtml.= '<li class="elements-accordion-item" data-type="' . strtolower($blocks_category[$i]['name']) . '"><a class="elements-accordion-item-title">' . $blocks_category[$i]['name'] . '</a>';
                $_outputHtml.= '<div class="elements-accordion-item-content"><ul class="elements-list">';
                $this->db->where('cat_id', $blocks_category[$i]['id']);
                $_items = $blocks = $this->db->get('blocks')->result_array();
                for ($j = 0;$j < sizeof($_items);$j++){
                    $_outputHtml.= '<li>' . '<div class="elements-list-item">' . '<div class="preview">' . '<div class="elements-item-icon">' . ' <i class="' . $_items[$j]['icon'] . '"></i>' . '</div>' . '<div class="elements-item-name">' . $_items[$j]['name'] . '</div>' . '</div>' . '<div class="view">' . '<div class="sortable-row">' . '<div class="sortable-row-container">' . ' <div class="sortable-row-actions">';
                    $_outputHtml.= '<div class="row-move row-action">' . '<i class="fa fa-arrows-alt"></i>' . '</div>';
                    $_outputHtml.= '<div class="row-remove row-action">' . '<i class="fa fa-remove"></i>' . '</div>';
                    $_outputHtml.= '<div class="row-duplicate row-action">' . '<i class="fa fa-files-o"></i>' . '</div>';
                    $_outputHtml.= '<div class="row-code row-action">' . '<i class="fa fa-code"></i>' . '</div>';
                    $_outputHtml.= '</div>' . '<div class="sortable-row-content"  data-id="' . $_items[$j]['id'] . '" data-types="' . $_items[$j]['property'] . '"  data-last-type="' . explode(',', $_items[$j]['property']) [0] . '">' . str_replace('[site-url]', $actual_link, $_items[$j]['html']) . '</div>' . '</div>' . '</div>' . ' </div>' . '</div>' . '</li>';
                }
                $_outputHtml.= '</ul></div>';
                $_outputHtml.= '</li>';
            }
            $this->global['_outputHtml'] = $_outputHtml;
            //echo '<pre>';print_r($page_data);echo '</pre>';die;
            $this->loadViews('instructor/settings/setting_certificate_temp_edit', $this->global, $page_data, NULL);
        }else{
            $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function get_certificate(){
        $table_data['data'] = $this->Settings_model->getCertificate();
        $this->response($table_data);
    }
    
    public function certificate_delete(){
        $id = $this->input->post('id');
        echo $this->Settings_model->deleteCertificate($id);
    }
    
    public function certificate_insert(){
        $insert_data = array();
        $insert_data["company_id"] = $this->session->get_userdata() ['company_id'];
        $insert_data["id"] = $this->input->post('id');
        $insert_data["title"] = $this->input->post('title');
        $insert_data["content"] = $this->input->post('content');
        if($insert_data["id"] == 0){
            echo $this->Settings_model->insertCertificate($insert_data);
        }else{
            $this->Settings_model->updateCertificate($insert_data, array('id' => $insert_data["id"]));
            echo $insert_data["id"];
        }
    }
    
    public function certificate_update(){
        $update_data = array();
        $id = $this->input->post("id");
        $upload_path = sprintf('%scertificate/temp/', PATH_UPLOAD);
        if(!file_exists($upload_path)){
            $this->makeDirectory($upload_path);
        }
        $rslt = $this->doUpload('left_sign', $upload_path);
        if($rslt['possible'] == 1){
            $update_data['left_sign'] = str_replace("./", "", $rslt['path']);
        }
        $rslt = $this->doUpload('right_sign', $upload_path);
        if($rslt['possible'] == 1){
            $update_data['right_sign'] = str_replace("./", "", $rslt['path']);
        }
        $rslt = $this->doUpload('logo', $upload_path);
        if($rslt['possible'] == 1){
            $update_data['logo'] = str_replace("./", "", $rslt['path']);
        }
        $rslt = $this->doUpload('middle_logo', $upload_path);
        if($rslt['possible'] == 1){
            $update_data['middle_logo'] = str_replace("./", "", $rslt['path']);
        }
        $rslt = $this->doUpload('watermark', $upload_path);
        if($rslt['possible'] == 1){
            $update_data['watermark'] = str_replace("./", "", $rslt['path']);
        }
        foreach ($this->input->post() as $key => $value){
            $update_data[$key] = $value;
        }
        unset($update_data['id']);
        return $this->Settings_model->updateCertificate($update_data, array('id' => $id));
    }
    
    public function general_view(){
        $this->load->library('Sidebar');
        if($this->isInstructor()){
            $side_params = array('selected_menu_id' => '9');
            $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
            $etmp['company_name'] = $this->Settings_model->getGlobal(array('action' => 'company_name')) [0]['value'];
            $etmp['company_address'] = $this->Settings_model->getGlobal(array('action' => 'company_address')) [0]['value'];
            $etmp['zip_code'] = $this->Settings_model->getGlobal(array('action' => 'zip_code')) [0]['value'];
            $etmp['city'] = $this->Settings_model->getGlobal(array('action' => 'city')) [0]['value'];
            $etmp['state'] = $this->Settings_model->getGlobal(array('action' => 'state')) [0]['value'];
            $etmp['country'] = $this->Settings_model->getGlobal(array('action' => 'country')) [0]['value'];
            $etmp['company_email_address'] = $this->Settings_model->getGlobal(array('action' => 'company_email_address')) [0]['value'];
            $etmp['company_phone'] = $this->Settings_model->getGlobal(array('action' => 'company_phone')) [0]['value'];
            $etmp['meta_description'] = $this->Settings_model->getGlobal(array('action' => 'meta_description')) [0]['value'];
            $etmp['address_phone'] = $this->Settings_model->getGlobal(array('action' => 'address_phone')) [0]['value'];
            if($this->Settings_model->getGlobal()) $etmp['mode'] = 'editmode';
            else $etmp['mode'] = 'insertmode';
            $this->loadViews("instructor/settings/setting_global", $this->global, $etmp, NULL);
        }else{
            $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function save_general(){
        $insert_data = array();
        if($this->input->post('mode') == 'insertmode'){
            foreach ($this->input->post() as $key => $value){
                $insert_data['action'] = $key;
                $insert_data['value'] = $value;
                $this->Settings_model->setGlobal($insert_data);
            }
        } elseif($this->input->post('mode') == 'editmode'){
            foreach ($this->input->post() as $key => $value){
                $insert_data['value'] = $value;
                $this->Settings_model->saveGlobal($insert_data, array('action' => $key));
            }
        }
        redirect(base_url('instructor/settings/general_view'));
        //$this->general_view();
        
    }
    
    public function emailsettings(){
        $this->load->library('Sidebar');
        if($this->isInstructor()){
            $side_params = array('selected_menu_id' => '9');
            $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
            $data = $this->Settings_model->getEmailSettings();
            $etmp['editid'] = $data['id'];
            $etmp['company_email'] = $data['company_email'];
            $etmp['billing_email'] = $data['billing_email'];
            $etmp['support_email'] = $data['support_email'];
            $etmp['type'] = $data['type'];
            $etmp['smtp_host'] = $data['smtp_host'];
            $etmp['smtp_user'] = $data['smtp_user'];
            $etmp['smtp_password'] = $data['smtp_password'];
            $etmp['smtp_port'] = $data['smtp_port'];
            $etmp['mail_ecription'] = $data['mail_ecription'];
            $this->loadViews("instructor/settings/setting_email", $this->global, $etmp, NULL);
        }else{
            $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function saveemail(){
        if($this->input->post('editid')) $editid = $this->input->post('editid');
        $params = array();
        $params['company_email'] = $this->input->post('company_email');
        $params['billing_email'] = $this->input->post('billing_email');
        $params['support_email'] = $this->input->post('support_email');
        $params['type'] = $this->input->post('type');
        $params['smtp_host'] = $this->input->post('smtp_host');
        $params['smtp_user'] = $this->input->post('smtp_user');
        $params['smtp_password'] = $this->input->post('smtp_password');
        $params['smtp_port'] = $this->input->post('smtp_port');
        $params['mail_ecription'] = $this->input->post('mail_ecription');
        if(!$editid) $this->Settings_model->insertEmailSettings($params);
        else $this->Settings_model->updateEmailSettings($params, $editid);
        redirect(base_url('instructor/settings/emailsettings'));
    }
    
    public function saveemailtemplate(){
        $company_id = $this->session->get_userdata() ['company_id'];
        $subject = $this->input->post('subject');
        $msg = $this->input->post('content');
        $params = array('subject' => $subject, 'message' => $msg, 'action' => $this->input->post('action'), 'company_id' => $company_id);
        if(!$this->input->post('editid')) $this->Settings_model->insertEmailTemplate($params);
        else $this->Settings_model->updateEmailTemplate($params, $this->input->post('editid'));
        redirect(base_url('admin/settings/emailtemp/') . '?email=' . $this->input->post('action'));
    }
    
    public function trans_lang_view(){
        $this->load->library('Sidebar');
        if($this->isInstructor()){
            $side_params = array('selected_menu_id' => '9');
            $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
            $this->loadViews("instructor/settings/setting_translations", $this->global, NULL, NULL);
        }else{
            $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function get_trans_seletable_lang_list(){
        $searchstr = $_REQUEST['term'];
        $where["add_flag"] = 0;
        $result = $this->Translate_model->getLanguageList($where, $searchstr);
        $this->response(array("results" => $result["data"]));
    }
    
    public function get_trans_selected_lang_list(){
        $where["add_flag"] = 1;
        $data_rows = $this->Translate_model->getLanguageList($where);
        $records["data"] = $data_rows["data"];
        $records["recordsTotal"] = $data_rows["total"];
        $records["recordsFiltered"] = $data_rows["filtertotal"];
        $this->response($records);
    }
    
    public function update_trans_activate(){
        $id = $this->input->post("id");
        $active_flag = $this->input->post("value");
        $data["id"] = $id;
        $data["active_flag"] = $active_flag;
        $this->Translate_model->update_lang($data);
    }
    
    public function trans_term_view($lang_id = 0){
        $where["id"] = $lang_id;
        $lang_data = $this->Translate_model->getLanguageList($where) ["data"][0];
        $this->load->library('Sidebar');
        if($this->isInstructor()){
            $side_params = array('selected_menu_id' => '9');
            $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
            $data["lang_id"] = $lang_data["id"];
            $data["lang_name"] = $lang_data["lang_name"];
            $data["field_name"] = $lang_data["field_name"];
            $this->loadViews("insturctor/settings/setting_translations_term", $this->global, $data, NULL);
        }else{
            $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function get_trans_term_list($lang_id = 0){
        $where["id"] = $lang_id;
        $lang_data = $this->Translate_model->getLanguageList($where) ["data"][0];
        $first_lang_name = $this->Translate_model->getLanguageList(array('lang_code' => DEFAULT_LIST_LANG)) ["data"][0];
        $data_rows = $this->Translate_model->getTermList($first_lang_name['field_name'], $lang_data['field_name']);
        $records["data"] = $data_rows["data"];
        $records["recordsTotal"] = $data_rows["total"];
        $records["recordsFiltered"] = $data_rows["filtertotal"];
        $this->response($records);
    }

    function update_trans_term(){
        $field = $this->input->post('field');
        $values = $this->input->post('value');
        $object = json_decode($values);
        foreach($object as $key => $value){
            $data["id"] = $value->id;
            $data[$field] = $value->content;
            $this->Translate_model->update_term($data);
        }
    }
    
    public function menusettings(){
        $this->load->library('Sidebar');
        if($this->isInstructor()){
            $side_params = array('selected_menu_id' => '9');
            $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
            //if($this->input->post('srt'))
            //$where = array('level' => $this->input->post('srt'));
            $where = array('level' => 'SuperAdmin');
            $etmp['menuData_superAdmin'] = $this->Settings_model->getMenu($where);
            $where = array('level' => 'Admin');
            $etmp['menuData_admin'] = $this->Settings_model->getMenu($where);
            $where = array('level' => 'Company');
            $etmp['menuData_company'] = $this->Settings_model->getMenu($where);
            $where = array('level' => 'FASI');
            $etmp['menuData_fasi'] = $this->Settings_model->getMenu($where);
            $where = array('level' => 'Employee');
            $etmp['menuData_employee'] = $this->Settings_model->getMenu($where);
            //print_r($etmp['menuData_admin']);
            $this->loadViews("instructor/settings/setting_menu", $this->global, $etmp, NULL);
        }else{
            $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function newmenu(){
        $this->load->library('Sidebar');
        if($this->isInstructor()){
            $side_params = array('selected_menu_id' => '9');
            $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
            $this->loadViews("instructor/settings/settings_new_menu", $this->global, $etmp, NULL);
        }else{
            $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function createmenu(){
        //echo '<pre>';print_r($this->input->post());echo '</pre>';die;
        $params = array('icon' => $this->input->post('icon'), 'name' => $this->input->post('name'), 'path' => $this->input->post('path'), 'level' => $this->input->post('level'), 'code' => $this->input->post('code'), 'status' => 1);
        if(!$this->input->post('editid')) $this->Settings_model->insertMenu($params);
        else $this->Settings_model->updateMenu($params, $this->input->post('editid'));
        redirect(base_url('instructor/settings/menusettings'));
    }
    
    public function menustatus(){
        $id = $this->input->post('id');
        if($id){
            $this->Settings_model->updateMenu($id);
            /*redirect('admin/settings/menusettings');*/
        }
    }
    
    public function notificationsettings(){
        $this->load->library('Sidebar');
        if($this->isInstructor()){
            $side_params = array('selected_menu_id' => '9');
            $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
            $data = $this->Settings_model->getNotification($where);
            $etmp['editid'] = $data['id'];
            $etmp['sms_active'] = $data['sms_active'];
            $etmp['provider'] = $data['provider'];
            $etmp['api_url'] = $data['api_url'];
            $this->loadViews("instructor/settings/settings_notification", $this->global, $etmp, NULL);
        }else{
            $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }

    public function savenotification(){
        $params = array('sms_active' => ($this->input->post('actve')) ? 'Y' : 'N', 'provider' => $this->input->post('provider'), 'api_url' => $this->input->post('api'));
        if(!$this->input->post('editid')) $this->Settings_model->insertNotification($params);
        else $this->Settings_model->updateNotification($params, $this->input->post('editid'));
        redirect('instructor/settings/notificationsettings');
    }

}
?>
