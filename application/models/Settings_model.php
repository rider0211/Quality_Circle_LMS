<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Timon
 * Date: 6/27/2018
 * Time: 6:24 PM
 */

class Settings_model extends CI_Model
{
    /**
     * This function used to manage categories
     */
    protected $theme_table;
    protected $menu_table;
    protected $global_table;
    protected $certificate_temp_table;
    protected $email_table;
    protected $notification_table;
    
    function __construct()
    {
        parent::__construct();
        $this->theme_table = 'setting_theme';
        $this->menu_table = 'setting_menu';
        $this->global_table = 'setting_global';
        $this->certificate_temp_table = 'setting_certificate';
        $this->email_table = 'setting_email';
        $this->email_template = 'settings_email_template';
        $this->notification_table ='setting_notification';
		$this->site_config_table ='setting_site_config';
    }

    function getTheme()
    {
        $result = $this->db->get($this->theme_table);

        $res=$result->result_array();
        return $res;
    }
    function getTaxRate(){
        return $this->db->get_where($this->global_table, "action='tax_rate'")->row();
    }
    function getPaypalClientId(){
        return $this->db->get_where($this->global_table, "action='paypal_client_id'")->row();
    }
    function getPaypalSecretId(){
        return $this->db->get_where($this->global_table, "action='paypal_secret_id'")->row();
    }
    function getStripeClientId(){
        return $this->db->get_where($this->global_table, "action='stripe_client_id'")->row();
    }
    function getStripeSecretId(){
        return $this->db->get_where($this->global_table, "action='stripe_secret_id'")->row();
    }
    function setPaypal($pk, $sk){
        $data = $this->db->get_where($this->global_table, "action='paypal_client_id'")->row_array();
        $data['value'] = $pk;
        $this->db->where("id", $data['id']);
        $result = $this->db->update($this->global_table, $data);
        $data = $this->db->get_where($this->global_table, "action='paypal_secret_id'")->row_array();
        $data['value'] = $sk;
        $this->db->where("id", $data['id']);
        $result = $this->db->update($this->global_table, $data);
    }
    function setStripe($pk, $sk){
        $data = $this->db->get_where($this->global_table, "action='stripe_client_id'")->row_array();
        $data['value'] = $pk;
        $this->db->where("id", $data['id']);
        $result = $this->db->update($this->global_table, $data);
        $data = $this->db->get_where($this->global_table, "action='stripe_secret_id'")->row_array();
        $data['value'] = $sk;
        $this->db->where("id", $data['id']);
        $result = $this->db->update($this->global_table, $data);
    }
    function setTaxRate($rate){

        $data = $this->db->get_where($this->global_table, "action='tax_rate'")->row_array();
        $data['value'] = $rate;
        $this->db->where("id", $data['id']);
        $result = $this->db->update($this->global_table, $data);
    }
    function getMenu($where)
    {
    	
        if ($where == null){
            $result = $this->db->get($this->menu_table);
        }else{
            $result = $this->db->get_where($this->menu_table, $where);
        }
        
        $res=$result->result_array();
        return $res;
    }
	
    function insertMenu($params){
    	$this->db->insert($this->menu_table, $params);
    	return $this->db->insert_id();
    }
   
    function updateMenu( $id)
    {
        $new_stuff = array('status' => '(status+1)%2');
        $this->db->where('id', $id);
        $result = $this->db->update($this->menu_table, $new_stuff);
    	return $result;
    }

    function saveTheme($params)
    {
        $this->db->insert($this->theme_table, $params);
    	return $this->db->insert_id();    	
    }
    
    function deleteTheme($id){
    	$this->db->delete($this->theme_table, array('id' => $id));
    	return true;
    }
    
    function updateTheme($data, $id){
    	$this->db->where('id', $id);
    	$result = $this->db->update($this->theme_table, $data);
    	
    	return $result;
    }

    function saveGlobal($data, $where = null)
    {    	
        $this->db->where($where);
        $result = $this->db->update($this->global_table, $data);

        return $result;
    }
	
    function setGlobal($params){
    	$this->db->insert($this->global_table, $params);
    	return $this->db->insert_id();    	
    }
    
    function getGlobal($where = null){
        if ($where == null){
            $result = $this->db->get($this->global_table);
        }else{
            $result = $this->db->get_where($this->global_table, $where);
        }
        $res=$result->result_array();
        return $res;
    }


    function getCertificate($where = null){
        if ($where == null){
            $result = $this->db->get($this->certificate_temp_table);
        }else{
            $result = $this->db->get_where($this->certificate_temp_table, $where);
        }
        $res=$result->result_array();
        return $res;
    }
    function deleteCertificate($id){
        $this->db->delete($this->certificate_temp_table, array('id' => $id));
        return true;
    }

    function insertCertificate($data){

        $rst = $this->db->insert($this->certificate_temp_table, $data);
        return $this->db->insert_id();
    }

    function updateCertificate($data, $where = null)
    {
        $this->db->where($where);
        $result = $this->db->update($this->certificate_temp_table, $data);

        return $result;
    }
    
    function insertEmailSettings($params){
    	$this->db->insert($this->email_table, $params);
    	return $this->db->insert_id();
    }

    function getEmailSettings() {
    	$sql = $this->db->get($this->email_table);
    	
    	return $sql->row_array();
    }
    function updateEmailSettings($data, $id)
    {
    	$this->db->where('id', $id);
    	$result = $this->db->update($this->email_table, $data); 
    	return $result;
    }
    
    function insertEmailTemplate($params){
    	$this->db->insert($this->email_template, $params);
    	return $this->db->insert_id();
    }
    function updateEmailTemplate($data, $id)
    {
    	$this->db->where('id', $id);
    	$result = $this->db->update($this->email_template, $data);
    	return $result;
    }
    function getEmailTemplate($where){
    	$result = $this->db->get_where($this->email_template, $where);
    	$res=$result->row_array();
        return $res;
    }
    function getEmailTemplates($where){
    	$result = $this->db->get_where($this->email_template, $where);
    	$res=$result->result_array();
        return $res;
    }
    
    function insertNotification($params){
    	$this->db->insert($this->notification_table, $params);
    	return $this->db->insert_id();
    }
    function updateNotification($data, $id)
    {
    	$this->db->where('id', $id);
    	$result = $this->db->update($this->notification_table, $data);
    	return $result;
    }
    function getNotification($where){
    	$result = $this->db->get($this->notification_table);
    	$res=$result->row_array();
    	return $res;
    }


    function sendForgetEmail($link , $email){
        $result = $this->db->get_where($this->email_template, "action='reset_password'");
        $email_temple=$result->row();
        $content = $email_temple->message;

        $theme = $this->getThemeSetting();
        $user = $this->getUserByEmail($email);
        $field = array('{FIRSTNAME}','{LASTNAME}','{PASS_KEY_URL}','{SITE_NAME}');
        $value = array($user->first_name,$user->last_name, $link,$theme['site_name']);

        $content = str_replace($field,$value,$content);
        $content = $this->rebuild_html($content);

        require_once(APPPATH . "libraries/BaseController.php");
        BaseController::get_instance()->sendemail($email, 'Verification Code', $content, $email_temple->subject, 1);
    }

    function sendRemeberPassEmail($user_id, $pass){
        $result = $this->db->get_where($this->email_template, "action='password_reset'");
        $email_temple=$result->row();
        $content = $email_temple->message;

        $theme = $this->getThemeSetting();
        $user = $this->getUserByID($user_id);

        $field = array('{FIRSTNAME}','{LASTNAME}','{EMAIL}','{PASSWORD}','{SITE_NAME}');
        $value = array($user->first_name,$user->last_name,$user->email, $pass,$theme['site_name']);

        $content = str_replace($field,$value,$content);
        $content = $this->rebuild_html($content);
        @send_phpmail_message($user->email , $email_temple->subject, $content);

        $activity_data["activity_type"] = "Password reset";
        $activity_data["user_id"] = $user->id;
        $activity_data["activity_message"] = $user->first_name . " " . $user->last_name . " reset password.";
        $this->load->model('Activity_model');
        $this->Activity_model->insert($activity_data);
    }

    function getThemeSetting(){
        // get theme
        $result = $this->db->get('setting_theme');
        $theme=$result->result_array()[0];
        return $theme;
    }
    function getUserByEmail($email){
        $result = $this->db->get_where('user', "email='".$email."'");
        $user=$result->row();
        return $user;
    }
    function getUserByID($id){
        $result = $this->db->get_where('user', "id=".$id."");
        $user=$result->row();
        return $user;
    }


    function sendEmailTemplate($param = array(), $email = ''){
        $action = $param["action"];
        $info = $this->getEmailTemplate(array('action' => $action));

        $message = $info["message"];
        foreach($param as $key => $value){
            $message = str_replace('{' . $key . '}', $value, $message);
        }

        $result["message"] = $this->rebuild_html($message);
        $result["subject"] = $info["subject"];

        @send_phpmail_message($email, $result["subject"], $result["message"]);

        return $result;
    }
	
	function getSiteConfiguration($where){
    	$result = $this->db->get($this->site_config_table);
    	$res=$result->row_array();
    	return $res;
    }
	
	function updateSiteConfiguration($data, $id){
    	$this->db->where('id', $id);
    	$result = $this->db->update($this->site_config_table, $data);
    	
    	return $result;
    }

}
