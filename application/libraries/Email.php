<?php
/**
 * Created by PhpStorm.
 * User: Timon
 * Date: 2/23/2019
 * Time: 1:17 PM
 */

class Email
{
	public function __construct()
	{
		$this->ci =& get_instance();
		$this->ci->load->helper('lms_email');
	}
    public function send_email($to_email, $titlte, $content,$from_email){
/*    	print_r($to_email.':'.$titlte.':'.$content.':'.$from_email);
    	die();*/
    	$this->ci->email->clear();
        $this->ci->email->to($address);
        $this->ci->email->from($from_email);
        $this->ci->email->subject($titlte);
        $this->ci->email->message($content);
        $this->ci->email->send();
    }
}