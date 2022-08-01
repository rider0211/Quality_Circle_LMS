<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
class Cron extends CI_Controller
{
	 public function __construct()
    {
        parent::__construct();
         $this->load->model('Course_model'); 
    }
	
	public function index(){
		$lastInsertCourse = $this->Course_model->getLastInsertCourse();

		if($lastInsertCourse){
			
			$id = $lastInsertCourse->id;
			$updateLastCourse = $this->Course_model->updateLastCourse($id);
			
			$this->load->library('email');
           
			$emailTmp = $this->Settings_model->getEmailTemplate("action='new_course_arrival'");
			$content = $emailTmp['message'];
			$content = str_replace("{LOGO}", "<img src='".base_url('assets/logos/logo1.png')."'/>"."<img src='".base_url('assets/logos/logo2.png')."'/>", $content);
			$title = $emailTmp['subject'];
           
			$fromName="Go Smart Academy";
			$to='kumarsunny9@gmail.com';
			
			
			$from ="support@gosmartacademy.com";
			$this->email->from($from, $fromName);
			$this->email->to($to);

			$this->email->subject($title);
			$this->email->message($content);
			$this->email->set_header('Content-Type', 'text/html');
			$this->email->send();
 
			/* if($this->email->send())
			{
				echo "Mail Sent Successfully";
			}
			else
			{
				echo "Failed to send email";
				show_error($this->email->print_debugger());             
					} */

			}
	}
	
	}

?>