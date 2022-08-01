<?php
defined('BASEPATH') OR ('No direct script access allowed');
if(! function_exists(send_smtp_message)) {
	function send_smtp_message($receiver_email, $title, $content, $from) {

		$ci =& get_instance();
		$ci->load->library('email');

		//SMTP & mail configuration
		$config = array(
				'protocol'  => 'smtp',
				'smtp_host' => 'ssl://dev.webtutor.in.net',
				'smtp_port' => 465,
				'smtp_user' => 'dev@dev.webtutor.in.net',
				'smtp_pass' => 'dev1234@pass',
				'mailtype'  => 'html',
				'charset'   => 'utf-8'
		);
		$ci->email->initialize($config);
		$ci->email->set_mailtype("html");
		$ci->email->set_newline("\r\n");

		//Email content
		$content .= '<h1>Sending email via SMTP server</h1>';
		$content .= '<p>This email has sent via SMTP server from CodeIgniter application.</p>';

		$ci->email->to($receiver_email);
		$ci->email->from($from,'MyWebsite');
		$ci->email->subject($title);
		$ci->email->message($content);

		//Send email
		$ci->email->send();
	}
}
if(! function_exists(send_phpmail_message)) {
	function send_phpmail_message($to, $from, $subject, $message)
	{
		require_once(APPPATH."third_party/phpmailer/class.phpmailer.php");
		$mail = new PHPMailer;
        $mail->IsSMTP();
        //$mail->SMTPDebug = 2;

        $mail->SMTPAuth = true;                 // turn on SMTP authentication
    	$mail->Host     = 'localhost';          // specify main and backup server
    	$mail->Port     = 25;                   // SMTP PORT
    //	$mail->SMTPSecure = 'tls';
    	$mail->Username = 'dev@dev.webtutor.in.net';  // SMTP username
    	$mail->Password = 'dev1234@pass';       // SMTP password


    	//$mail->setFrom($from, SITE_NAME);
    	$mail->From = $from;
        $mail->FromName = 'LMS';
    	$mail->addAddress($to);             // Add a recipient
    	//$mail->addBCC('test@gmail.com');  // Add Bcc
    	$mail->WordWrap = 50;
    	$mail->isHTML(true);                // Set email format to HTML

    	$mail->Subject = $subject;
    	$mail->Body    = $message;
    	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    	if(!$mail->send()) {
    	    echo 'Message could not be sent.';
    	    echo 'Mailer Error: ' . $mail->ErrorInfo;
    	} else {
    	   // echo 'Message has been sent';
    	}

	}
}


?>