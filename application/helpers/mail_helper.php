<?php
defined('BASEPATH') OR ('No direct script access allowed');
if(! function_exists("send_smtp_message")) {
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
if(! function_exists("send_phpmail_message")) {
	function send_phpmail_message($to, $subject, $message)
	{
        $req_ip = $_SERVER['REMOTE_ADDR'];
        if ($req_ip == '127.0.0.1') return;

        $CI =& get_instance();

        $result = $CI->db->get('setting_theme');
        $setting_theme = $result->row_array();

        $result = $CI->db->get('setting_email');
        $email_conf = $result->row_array();

        $Host = $email_conf['smtp_host'];
        $Port = $email_conf['smtp_port'];
        $SMTPSecure = $email_conf['mail_ecription'];
        $Username = $email_conf['smtp_user'];
        $Password = $email_conf['smtp_password'];
        $support_email  = $email_conf['support_email'];
        $site_name = $setting_theme['site_name'];

        if($email_conf['type'] == 'phpmail') {

            require_once(APPPATH . "third_party/phpmailer/class.phpmailer.php");
            $mail = new PHPMailer;
            $mail->IsSMTP();
            //$mail->SMTPDebug = 2;
            $mail->CharSet = 'UTF-8';
            $mail->SMTPAuth = true;                 // turn on SMTP authentication
            $mail->Host = $Host;      // specify main and backup server
            $mail->Port = $Port;
            $mail->SMTPSecure = $SMTPSecure;
            $mail->Username = $Username;
            $mail->Password = $Password;

            /*
            $mail->SMTPAuth = true;                 // turn on SMTP authentication
            $mail->Host     = 'atlantis2370.8solutions-datacenter.de';          // specify main and backup server
            $mail->Port     = 25;                   // SMTP PORT
            $mail->SMTPSecure = 'tls';
            $mail->Username = 'system@a-u-s-umweltberatung.de';  // SMTP username
            $mail->Password = 'SRVSEiqSmmUkAHLHFPgyJfE2';       // SMTP password*/

            $mail->From = $support_email;
            $mail->FromName = $site_name;

            $mail->addAddress($to);             // Add a recipient
            //$mail->addBCC('test@gmail.com');  // Add Bcc
            $mail->WordWrap = 50;
            $mail->isHTML(true);                // Set email format to HTML

            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if (!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                // echo 'Message has been sent';
            }
        }
        else{
            $CI->load->library('email');

            //SMTP & mail configuration
            $config = array(
                'protocol'  => 'smtp',
                'smtp_host' => $SMTPSecure.'://'.$Host,
                'smtp_port' => $Port,
                'smtp_user' => $Username,
                'smtp_pass' => $Password,
                'mailtype'  => 'html',
                'charset'   => 'utf-8'
            );
            $CI->email->initialize($config);
            $CI->email->set_mailtype("html");
            $CI->email->set_newline("\r\n");

            //Email content

            $CI->email->to($to);
            $CI->email->from($support_email,$site_name);
            $CI->email->subject($subject);
            $CI->email->message($message);

            //Send email
            $CI->email->send();
        }
	}

     function sendSMS($to, $content) {
        # Plivo AUTH ID
        $AUTH_ID = AUTH_ID;
        # Plivo AUTH TOKEN
        $AUTH_TOKEN = AUTH_TOKEN;
        # SMS sender ID.
        $src = SMS_SENDER;
        # SMS destination number
        $dst = $to;
        # SMS text
        $text = $content;
        $url = 'https://api.plivo.com/v1/Account/'.$AUTH_ID.'/Message/';
        $data = array("src" => "$src", "dst" => "$dst", "text" => "$text");
        $data_string = json_encode($data);
        $ch=curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_USERPWD, $AUTH_ID . ":" . $AUTH_TOKEN);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $response = curl_exec( $ch );
        curl_close($ch);

        return $response;
    }
    function  checkuser($library_id =''){
        $CI =& get_instance();
        $result = $CI->bookshop_model->check_user($library_id); 
        return $result[0]['assign_user'];
    }
}


?>