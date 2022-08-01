<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Login (LoginController)
 * Login class to control to authenticate user credentials and starts user's session.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
require APPPATH . '/libraries/BaseController.php';

require APPPATH . '/third_party/twilio/src/Twilio/autoload.php';
		
// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;

class Login extends BaseController{
    public function __construct(){
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->model('User_model');
        $this->load->model('Settings_model');
        $this->load->model('Company_model');
        $this->load->model('Translate_model');
        $this->load->helper(array('cookie', 'string', 'language', 'url'));
        $this->load->helper('lms_email');
        $this->load->model('Plan_model');
		$this->load->model('Countries_model');		
    }

    public function index(){
        $this->isLoggedIn();
    }

    function isLoggedIn(){    	
        $isLoggedIn = $this->session->userdata('isLoggedIn');        
        $recheck = $this->recheck_session();
        if (!$recheck && get_cookie('email') && get_cookie('remember_token')){
            $recheck = $this->login_remembered_user();
        }
        if(!$recheck){
            $this->load->model('Settings_model');
            $headerInfo['site_theme'] = $this->Settings_model->getTheme();
            if(sizeof($headerInfo['site_theme']) >= 1){
                $headerInfo['site_theme'] = $headerInfo['site_theme'][0];
            }
            if(sizeof($headerInfo['site_theme'])  == 0){
                $headerInfo['site_theme'] = array();
            }
            $headerInfo['menu_name'] = 'login';
            $headerInfo["term"] = $this->term;
            $this->loadViews_front('login', $headerInfo);
        }else{    
            switch($this->session->userdata('user_type')){
                case "Superadmin":{
                    redirect('/superadmin');
                }
                case "Admin": {
                    redirect('/admin');
                }
                    break;
                case "Instructor": {
                    redirect('/instructor');
                }
                    break;
                case "Learner": {
                    redirect('/learner');
                }
                    break;
            }
        }
    }

    public function recheck_session(){
        $isLoggedIn = $this->session->userdata('isLoggedIn');        
        if(isset($isLoggedIn) && $isLoggedIn == TRUE){
            $this->session->set_userdata('last_check', time());
        }else{
            $this->session->unset_userdata(array('email', 'userId', 'user_id', 'isLoggedIn'));
            return FALSE;
        }   
        return TRUE;
    }

    public function logout(){        
        $activity_data["activity_type"] = "Logout";
        $activity_data["user_id"] = $this->session->userdata('user_id');
        if($activity_data["user_id"] != null){
            $activity_data["activity_message"] = $this->session->userdata('name')." logout.";
            $this->load->model('Activity_model');
            $this->Activity_model->insert($activity_data);
        }

        if (substr(CI_VERSION, 0, 1) == '2'){
            $this->session->unset_userdata(array($identity => '', 'userId' => '', 'user_id' => '', 'isLoggedIn' => ''));
        }else{
            $this->session->unset_userdata(array($identity, 'userId', 'user_id', 'isLoggedIn'));
        }

        if (get_cookie('email')){
            delete_cookie('email');
        }
        if (get_cookie('remember_token')){
            delete_cookie('remember_token');
        }
        $this->session->sess_destroy();
        redirect ( '/login' );
    }

    public function loginUser(){		
        $result 			= array();
    	$result['type'] 	= 0;
    	$result['redirect'] = 0;
    	if($this->input->post('email') && $this->input->post('password')){
    		if(filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)){
                $email = $this->input->post('email');
    			$password = $this->input->post('password');
                $visitorInfo = $this->ip_info("Visitor", "Location");
                $this->load->library('user_agent');
                $visitorInfo['browser'] = $this->agent->browser();
                $visitorInfo['browserVersion'] = $this->agent->version();
                $visitorInfo['platform'] = $this->agent->platform();
                $visitorInfo['full_user_agent_string'] = $_SERVER['HTTP_USER_AGENT'];

                $response = $this->Login_model->loginMe($email, $password);
                if($response['result'] == true){
                    $res = $response['user'][0];
                    if($res->is_active == 0){
                        $result['msg'] = 'Please verify your email to start login!!!';
                    }else{
						$OTPLogin = $this->Settings_model->getSiteConfiguration('id',1);
						if($OTPLogin['otp_login'] == 1){
							$data = $res;
							$otp = rand(11111,99999);
							$security_key = md5($res->email);
							/*if($res->email == 'owenglave46@gmail.com' || $res->email == 'owen.glave@qualitycircleint.com' || $res->email == 'oglave_13@yahoo.com' || $res->email == 'support@qualitycircleint.com'){
								$otp = 12345;		
							}*/
							
							$explodeVerification = explode(',',$OTPLogin['verify_by']);
							$emailVerification = $phoneNumberVerification = 'No';
							if(in_array('email',$explodeVerification)){
								$emailVerification = 'Yes';
							}
							if(in_array('phone',$explodeVerification)){
								$phoneNumberVerification = 'Yes';
							}							
							if($emailVerification == 'Yes'){
							//-------------------Send email to registered user for Email verificaiton  ----------------------							
							$this->User_model->update_otp_login($res->id,$security_key,$otp);
							$verificaiton_link = base_url().'otp-login/'.$security_key;
							$email_tempU = $this->Settings_model->getEmailTemplate("action='user_otp_login'");
							$email_tempU['message'] = str_replace("{USERNAME}", $data->fullname, $email_tempU['message']);
							$email_tempU['message'] = str_replace("{OTP}", $otp, $email_tempU['message']);
							$email_tempU['message'] = str_replace("{verification_link}", $verificaiton_link, $email_tempU['message']);
							$this->sendemail($data->email, $data->first_name, $email_tempU['message'] , $email_tempU['subject']);
							}
							if($phoneNumberVerification == 'Yes'){
							################ Twilio OTP Send SMS API #############################							
							if(!empty($res->phone) && !empty($res->country_code) && is_numeric($res->phone) && is_numeric($res->country_code)){
								$phonenumber = '+'.trim($res->country_code).trim($res->phone);
								if($emailVerification == 'Yes'){
									$smsStatus = $this->sendTwilioSMS($phonenumber,$otp,'Yes');
									if($smsStatus == 'Yes'){
										$email_tempU = $this->Settings_model->getEmailTemplate("action='user_otp_login'");
										$email_tempU['message'] = str_replace("{USERNAME}", $data->fullname, $email_tempU['message']);
										$email_tempU['message'] = str_replace("{OTP}", $otp, $email_tempU['message']);
										$email_tempU['message'] = str_replace("{verification_link}", $verificaiton_link, $email_tempU['message']);
										$this->sendemail($data->email, $data->first_name, $email_tempU['message'] , $email_tempU['subject']);										
									}
								}else{
									$this->sendTwilioSMS($phonenumber,$otp);
								}
							}
							}
							#######################################################################
	
							$result['type'] = 3;
							$result['msg'] = 'Please check OTP on your email or phone to start login!';
							$result['key'] = $security_key;
						}else{
							$this->loginUserDirect($res->email,$this->input->post('password'));	
						}
                    }
                }else{
                    $result['msg'] = $response['msg'];
                    $result['current_time'] = $response['current_time'];
                }                
            }else{
                $result['msg'] = 'Invalid Email address!';
            }
        }else {
            $result['msg'] = 'Please provide Email and Password!';
        }

        $this->output
        ->set_status_header(200)
        ->set_content_type('application/json', 'utf-8')
        ->set_output(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
        ->_display();
        exit();
    }

    public function loginUserDirect($email,$password){
    	$result 			= array();
    	$result['type'] 	= 0;
    	$result['redirect'] = 0;
    	if($email && $password){
    		if(filter_var($email, FILTER_VALIDATE_EMAIL)){
    			$email = $email;
    			$password = $password;
                $visitorInfo = $this->ip_info("Visitor", "Location");
                $this->load->library('user_agent');
                $visitorInfo['browser'] = $this->agent->browser();
                $visitorInfo['browserVersion'] = $this->agent->version();
                $visitorInfo['platform'] = $this->agent->platform();
                $visitorInfo['full_user_agent_string'] = $_SERVER['HTTP_USER_AGENT'];

    			$response = $this->Login_model->loginMe($email, $password);
    			if($response['result'] == true){
                    $res = $response['user'][0];
                    if($res->is_active == 0){
                        $result['msg'] = 'Please verify your email to start login!!!';
                    }else{
        				$result['type'] = 1;
    					$this->User_model->update_last_login($res->id);

                        // Insert User Login Logs Activity.
                        $visitorInfo['ip'] = '157.36.29.129';
                        $insArr = array('user_id' => $res->id, 'ip_address' => $visitorInfo['ip'], 'area' => $visitorInfo['city'].'('. $visitorInfo['country'].')', 'device' => $visitorInfo['platform'] , 'platform' => $visitorInfo['browser'], 'crdate' => date('Y-m-d h:i:s'));

                        $this->db->insert('user_login_log', $insArr);

    					$photo = base_url().$res->photo;
                        $sessionArray = array(
                            'userId'=>$res->id,
                            'user_type'=>$res->type,
                            'user_name'=>$res->fullname,
                            'is_password_updated' => $res->isPasswordUptd,
                            'company_user_type'=>$res->company_user_type,
                            'roleText'=>$res->type,
                            'user_photo'=>$photo,
                            'user_id'=>$res->id,
                            'email'=>$res->email,
                            'company_id'=>$res->company_id,
                            'name'=>$res->fullname,
                            'role'=>$res->role,
                            'sign'=>$res->sign,
                            'last_check'=>time(),
                            'company_url'=>base_url().'company/'.$res->company_url,
                            'isLoggedIn' => TRUE,
                            'plan_id' => $res->plan_id,
                            'is_trialed' => $res->is_trialed,
                            'expired' => $res->expired,
                        );
                        $this->session->set_userdata($sessionArray);
                        $activity_data["activity_type"] = "Login";
                        $activity_data["user_id"] = $res->id;
                        $activity_data["activity_message"] = $res->fullname." login successfully.";
                                
                        $this->load->model('Activity_model');
                        $this->Activity_model->insert($activity_data);				
                        
                        $result['redirect'] = 1;
                        $result['msg'] = 'Login successfully';
                        $this->session->set_userdata($sessionArray);
                        if($res->type === 'Admin'){
                            if(isset($res->plan_id)){
                                $plan = $this->Plan_model->select($res->plan_id);
                                if($plan->price_type != 2){
                                    if(isset($res->expired)){
                                        $date=date('Y-m-d');
                                        $date1=explode('-', $res->expired);
                                        $date2=explode('-', $date);
                                        $ndate1=$date1[0].$date1[1].$date1[2];
                                        $ndate2=$date2[0].$date2[1].$date2[2];   
                                        if($ndate2 > $ndate1){
                                            $result['type'] = 2;
                                            $result['msg'] = 'Invalid Expire Date!You must select subscription';
                                        }
                                    }else{
                                         $result['type'] = 2;
                                         $result['msg'] = 'Invalid Expire Date!You must select subscription';
                                    }
                                }
                            }else{
                                 $result['type'] = 2;
                                 $result['msg'] = 'Invalid Subscription!You must select subscription'.$res->plan_id;
                            }
                        }

                      }  
        			}
        			else 
        				$result['msg'] = $response['msg'];
                        $result['current_time'] = $response['current_time'];
    		}
    		else
    			$result['msg'] = 'Invalid Email address!';
    	}	
    	else 
    		$result['msg'] = 'Please provide Email and Password!';
    	
    	$this->output
    	->set_status_header(200)
    	->set_content_type('application/json', 'utf-8')
    	->set_output(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
    	->_display();
    	exit();    	    	
    }

    public function verify_otp(){
        $result = array();
        $result['type'] = 0;
        $result['redirect'] = 0;
        $otp = $this->input->post('otp');
        $token = $this->input->post('token');
        if($otp !=''){
            $email = $password = '';
            $result = $this->db->get_where('user', ['otp' => $otp, 'security_key' => $token])->result();
            if(!empty($result[0])){             
                $email = $result[0]->email;
                $password = $result[0]->password;
            }
            $response = $this->Login_model->loginMe($email, $password, false, true);
            if($response['result'] == true){
                $res = $response['user'][0];
                if($res->is_active == 0){                    
                    $result['msg'] = 'Please verify your email to start login!!!';
                }else{
                    $visitorInfo = $this->ip_info("Visitor", "Location");
                    $this->load->library('user_agent');
                    $visitorInfo['browser'] = $this->agent->browser();
                    $visitorInfo['browserVersion'] = $this->agent->version();
                    $visitorInfo['platform'] = $this->agent->platform();
                    $visitorInfo['full_user_agent_string'] = $_SERVER['HTTP_USER_AGENT'];

                    $result['type'] = 1;
                    $this->User_model->update_last_login($res->id);
                    
                    // Insert User Login Logs Activity.
                     $visitorInfo['ip'] = '157.36.29.129';
                    $insArr = array('user_id' => $res->id, 'ip_address' => $visitorInfo['ip'], 'area' => $visitorInfo['city'].'('. $visitorInfo['country'].')', 'device' => $visitorInfo['platform'] , 'platform' => $visitorInfo['browser'], 'crdate' => date('Y-m-d h:i:s'));
                    $this->db->insert('user_login_log', $insArr);
                    $photo = base_url().$res->photo;
                    $sessionArray = array(
                        'userId'=>$res->id,
                        'user_type'=>$res->type,
                        'user_name'=>$res->fullname,
                        'is_password_updated' => $res->isPasswordUptd,
                        'company_user_type'=>$res->company_user_type,
                        'roleText'=>$res->type,
                        'user_photo'=>$photo,
                        'user_id'=>$res->id,
                        'email'=>$res->email,
                        'company_id'=>$res->company_id,
                        'name'=>$res->fullname,
                        'role'=>$res->role,
                        'sign'=>$res->sign,
                        'last_check'=>time(),
                        'company_url'=>base_url().'company/'.$res->company_url,
                        'isLoggedIn' => TRUE,
                        'plan_id' => $res->plan_id,
                        'is_trialed' => $res->is_trialed,
                        'expired' => $res->expired,
                    );
                    $this->session->set_userdata($sessionArray);
                    $activity_data["activity_type"] = "Login";
                    $activity_data["user_id"] = $res->id;
                    $activity_data["activity_message"] = $res->fullname." login successfully.";
                            
                    $this->load->model('Activity_model');
                    $this->Activity_model->insert($activity_data);				
                    
                    $result['redirect'] = 1;
                    $result['msg'] = 'Login successfully';
                    $this->session->set_userdata($sessionArray);

                    if($res->type === 'Admin'){
                        if(isset($res->plan_id)){
                            $plan = $this->Plan_model->select($res->plan_id);
                            if($plan->price_type != 2){
                                if(isset($res->expired)){
                                    $date=date('Y-m-d');
                                    $date1=explode('-', $res->expired);
                                    $date2=explode('-', $date);
                                    $ndate1=$date1[0].$date1[1].$date1[2];
                                    $ndate2=$date2[0].$date2[1].$date2[2];   
                                    if($ndate2 > $ndate1){
                                        $result['type'] = 2;
                                        $result['msg'] = 'Invalid Expire Date!You must select subscription';
                                    }
                                }else{
                                    $result['type'] = 2;
                                    $result['msg'] = 'Invalid Expire Date!You must select subscription';
                                }
                            }
                        }else{
                            $result['type'] = 2;
                            $result['msg'] = 'Invalid Subscription!You must select subscription'.$res->plan_id;
                        }
                    }
                    $this->User_model->update_otp_login($res->id);
                }  
            }else{
                $result['msg'] = 'Invalid OTP!';
                $result['type'] = 0;
                $result['redirect'] = 0;
            }
        }else{
            $result['msg'] = 'Please provide OTP!';
            $result['type'] = 0;
            $result['redirect'] = 0;
        }
        $this->output
        ->set_status_header(200)
        ->set_content_type('application/json', 'utf-8')
        ->set_output(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
        ->_display();
        exit();
    }

    public function otpLogin($token){
        $recheck = $this->recheck_session();
        if($recheck){
            switch($this->session->userdata('user_type')){
                case "Superadmin":{redirect('/superadmin');}
                case "Admin": {redirect('/admin');}
                    break;
                case "Instructor": {redirect('/instructor');}
                    break;
                case "Learner": {redirect('/learner');}
                    break;
            }
        }
		$OTPLogin = $this->Settings_model->getSiteConfiguration('id',1);
		$emailVerification = $phoneNumberVerification = 'No';
		if($OTPLogin['otp_login'] == 1){
			$explodeVerification = explode(',',$OTPLogin['verify_by']);			
			if(in_array('email',$explodeVerification)){
				$emailVerification = 'Yes';
			}
			if(in_array('phone',$explodeVerification)){
				$phoneNumberVerification = 'Yes';
			}
		}
		$userMsg = 'Please check OTP to start login!';
		if($emailVerification == 'Yes' && $phoneNumberVerification == 'Yes'){
			$userMsg = 'Please check OTP on your email or phone to start login!';
		}else if($emailVerification == 'Yes' && $phoneNumberVerification == 'No'){
			$userMsg = 'Please check OTP on your email to start login!';
		}else{
			$userMsg = 'Please check OTP on your phone to start login!';
		}
        $result = $this->db->get_where('user', ['security_key' => $token])->result();
        if(empty($result) || $OTPLogin['otp_login'] == 2){
            redirect('/login');
        }
        $this->load->model('Settings_model');
        $headerInfo['site_theme'] = $this->Settings_model->getTheme();
        if(sizeof($headerInfo['site_theme']) >= 1){
            $headerInfo['site_theme'] = $headerInfo['site_theme'][0];
        }
        if(sizeof($headerInfo['site_theme'])  == 0){
            $headerInfo['site_theme'] = array();
        }
		$headerInfo['userMsg'] = $userMsg;
        $headerInfo['menu_name'] = 'otp-login';
        $headerInfo["term"] = $this->term;
        $headerInfo['token'] = $token;
        $this->loadViews_front('otp-login', $headerInfo);        
    }
    function resend_otp($token){
		$query = $this->db->get_where('user', ['security_key' => $token]);
		$response = $query->row();
		if(empty($response)){
		redirect('otp-login');
		}
		$security_key = md5($response->email);
		$otp = rand(11111,99999);
		$this->User_model->update_otp_login($response->id,$security_key,$otp);
		
		$OTPLogin = $this->Settings_model->getSiteConfiguration('id',1);
		$emailVerification = $phoneNumberVerification = 'No';
		if($OTPLogin['otp_login'] == 1){
			$explodeVerification = explode(',',$OTPLogin['verify_by']);			
			if(in_array('email',$explodeVerification)){
				$emailVerification = 'Yes';
			}
			if(in_array('phone',$explodeVerification)){
				$phoneNumberVerification = 'Yes';
			}							
			if($emailVerification == 'Yes'){			
				$verificaiton_link = base_url().'otp-login/'.$security_key;
				$email_tempU = $this->Settings_model->getEmailTemplate("action='user_otp_login'");
				$email_tempU['message'] = str_replace("{USERNAME}", $response->fullname, $email_tempU['message']);
				$email_tempU['message'] = str_replace("{OTP}", $otp, $email_tempU['message']);
				$email_tempU['message'] = str_replace("{verification_link}", $verificaiton_link, $email_tempU['message']);
				$this->sendemail($response->email, $response->first_name, $email_tempU['message'] , $email_tempU['subject']);
			}
		}
		if($phoneNumberVerification == 'Yes'){
		################ Twilio OTP Send SMS API #############################							
		if(!empty($response->phone) && !empty($response->country_code) && is_numeric($response->phone) && is_numeric($response->country_code)){
			$phonenumber = '+'.trim($response->country_code).trim($response->phone);
			if($emailVerification == 'Yes'){
				$smsStatus = $this->sendTwilioSMS($phonenumber,$otp,'Yes');
				if($smsStatus == 'Yes'){
					$email_tempU = $this->Settings_model->getEmailTemplate("action='user_otp_login'");
					$email_tempU['message'] = str_replace("{USERNAME}", $data->fullname, $email_tempU['message']);
					$email_tempU['message'] = str_replace("{OTP}", $otp, $email_tempU['message']);
					$email_tempU['message'] = str_replace("{verification_link}", $verificaiton_link, $email_tempU['message']);
					$this->sendemail($data->email, $data->first_name, $email_tempU['message'] , $email_tempU['subject']);										
				}
			}else{
				$this->sendTwilioSMS($phonenumber,$otp);
			}
		}
		}		
		$this->session->set_flashdata('success_msg', 'OTP send on your email or phone.');
		redirect($_SERVER['HTTP_REFERER']);
    }

    public function loginLockUser(){
        $result 			= array();
        $result['type'] 	= 0;
        $result['redirect'] = 0;
        if($this->input->post('email')!='' && $this->input->post('password') != ''){
            if(filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)){
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $response = $this->Login_model->loginMe($email, $password);
                if($response['result'] == true)
                {
                    $result['type'] = 1;
                    $res = $response['user'][0];
                    $this->User_model->update_last_login($res->id);
                    $photo = base_url().$res->photo;
                    $sessionArray = array(
                        'userId'=>$res->id,
                        'user_type'=>$res->type,
                        'is_password_updated' => $res->isPasswordUptd,
                        'user_name'=>$res->fullname,
                        'company_user_type'=>$res->company_user_type,
                        'roleText'=>$res->type,
                        'user_photo'=>$photo,
                        'user_id'=>$res->id,
                        'email'=>$res->email,
                        'company_id'=>$res->company_id,
                        'name'=>$res->fullname,
                        'role'=>$res->role,
                        'last_check'=>time(),
                        'company_url'=>base_url().'company/'.$res->company_url,
                        'isLoggedIn' => TRUE,
                        'plan_id' => $res->plan_id,
                        'is_trialed' => $res->is_trialed,
                        'expired' => $res->expired,
                    );
                    $this->session->set_userdata($sessionArray);
                    $activity_data["activity_type"] = "Login";
                    $activity_data["user_id"] = $res->id;
                    $activity_data["activity_message"] = $res->fullname." login successfully.";

                    $this->load->model('Activity_model');
                    $this->Activity_model->insert($activity_data);

                    $result['redirect'] = 1;
                    $result['msg'] = 'Login successfully';
                    $this->session->set_userdata($sessionArray);

                }
                else{
                    $result['msg'] = $response['msg'];
                    $this->logout();
                }
            }
            else{
                $result['msg'] = 'Invalid Email address!';
                $this->logout();
            }
        }
        else{
            $result['msg'] = 'Please provide Email and Password!';
            $this->logout();
        }
        $this->isLoggedIn();

    }

    public function remember_user($id){
        if (!$id){
            return FALSE;
        }
        $user = $this->User_model->getRow(array("id"=>$id));
        if(empty($user->remember_token)){
            $salt = random_string('alnum', 32). $user->email;
            $this->User_model->update_remember_token($id, $salt);
            $user->remember_token = $salt;
        }
        
        if(!empty($user->remember_token)){
            // if the user_expire is set to zero we'll set the expiration two years from now.
            $expire = (60*60*24*365*2);            
            set_cookie(array(
                'name'   => 'email',
                'value'  => $user->email,
                'expire' => $expire
            ));
            set_cookie(array(
                'name'   => 'remember_token',
                'value'  => $user->remember_token,
                'expire' => $expire
            ));
            $this->session->set_userdata('remember_token', $user->remember_token);
            return TRUE;
        }
        return FALSE;
    }

    public function login_remembered_user(){
        // check for valid data
        if (!get_cookie('email') || !get_cookie('remember_token')){
            return FALSE;
        }

        // get the user
        $user_row_data = $this->User_model->getRow(array("remember_token"=>get_cookie('remember_token'), "active"=>1));
        $user = $user_row_data["data"][0];

        
        // if the user was found, sign them in
        if (count($user) > 0){            
            $this->User_model->update_last_login($user["id"]);
            $this->remember_user($user["id"]);
            $photo = base_url().$user["picture"];
            $sessionArray = array('userId'=>$user["id"],
                'user_type'=>$user["user_type"],
                'is_password_updated' => $res->isPasswordUptd,
                'roleText'=>$user["user_type"],
                'user_photo'=>$photo,
                'user_id'=>$user["id"],
                'email'=>$user["email"],
                'notification_method'=>$user["notification_method"],
                'company_id'=>$user["company_id"],
                'name'=>$user["first_name"]." ".$user["last_name"],   
                'last_check'=>time(),             
                'isLoggedIn' => TRUE,
                'plan_id' => $user["plan_id"],
                'is_trialed' => $user["is_trialed"],
                'expired' => $user["expired"]
            );

            $this->session->set_userdata($sessionArray);
            $activity_data["activity_type"] = "Remember Login";
            $activity_data["user_id"] = $user["id"];
            $activity_data["activity_message"] = $user["first_name"]." ".$user["last_name"]." login successfully.";

            $this->load->model('Activity_model');
            $this->Activity_model->insert($activity_data);            
            return TRUE;
        }
        return FALSE;
    }

    public function recoverPassword(){
        $this->load->model('Settings_model');
        $headerInfo['site_theme'] = $this->Settings_model->getTheme();
        if(sizeof($headerInfo['site_theme']) >= 1){
            $headerInfo['site_theme'] = $headerInfo['site_theme'][0];
        }
        if(sizeof($headerInfo['site_theme'])  == 0){
            $headerInfo['site_theme'] = array();
        }
        $headerInfo['term'] = $this->term;
        $this->load->view('recover-password', $headerInfo);
    }

    function confirmEmail(){
        $status = '';        
        $this->load->library('form_validation');        
        $this->form_validation->set_rules('email','Email','trim|required|valid_email');                
        if($this->form_validation->run() == FALSE){
            $this->recoverPassword();
        }else{
            $email = $this->input->post('email');            
            if($this->User_model->checkEmailExist($email)){
                $user_data = $this->User_model->getCustomerInfoByEmail($email);
                $userInfo = $user_data[0];
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $token = '';
                for ($i = 0; $i < 10; $i++){
                    $token .= $characters[rand(0, $charactersLength - 1)];
                }
                $this->load->model("Token_model");
                $this->Token_model->insert(array("user_id"=>$userInfo['id'], "token"=>$token));
                $data1['reset_link'] = base_url() . "resetPasswordConfirmUser/" . $token;

                if(count($userInfo) > 0){
                    $data1["name"] = $userInfo['fullname'];
                    $data1["from_email"] = 'EMAIL_FROM';
                    $data1["to_email"] = $userInfo['email'];
                    $data1["subject"] = "Reset Password";
                    $data1["message"] = "Reset Your Password";
                }

                $activity_data['activity_type'] = "ForgotPassword";
                $activity_data['user_id'] = $userInfo['id'];
                $activity_data['activity_message'] = $userInfo['email']." checked successfully.";

                $this->load->model('Activity_model');
                $this->Activity_model->insert($activity_data);
                $this->load->helper('mail');
                $this->Settings_model->sendForgetEmail($data1['reset_link'],$email);
                $this->session->set_userdata("reset_link", $data1['reset_link']);
                $this->session->set_flashdata('invalid', $this->term['resetlinksentyouremailalready']);
                redirect('/forgotPassword');
            }else{
                $this->session->set_userdata("reset_link", '');
                $this->session->set_flashdata('invalid', $this->term['resetlinksentyouremailalready']);
            }
            redirect('/forgotPassword');
        }
    }

    public function showProfile($status = null){
        $this->load->library('Sidebar');
        $sessiondata = $this->session->get_userdata();
        $user = $this->User_model->getRow("id=".$sessiondata['userId']);
        $page_data['share'] = $user->share;
        $page_data['language'] = $user->language;        
        $page_data['sign'] =  "<img id=\"userSignImg\" style=\"width:100%;\" src=\"".$user->sign."\" />";

        $lang_ar = $this->Translate_model->getLanguageList(array('active_flag' => 1,'add_flag' => 1 ));
        $page_data['lang_ar'] = $lang_ar['data'];

        $side_params = array('selected_menu_id'=>'1-1');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->session->userdata('user_type'));

        $page_data['term'] = $this->term;
        $this->global['term'] = $this->term;

        $this->load->model('Settings_model');
        $this->global['site_theme'] = $this->Settings_model->getTheme();
        if(sizeof($this->global['site_theme']) >= 1){
            $this->global['site_theme'] = $this->global['site_theme'][0];
        }
        if(sizeof($this->global['site_theme'])  == 0){
            $this->global['site_theme'] = array();
        }
        $company = $this->Company_model->getRow($this->session->userdata('company_id'));
        if($user->user_type == "Admin"){
            // $page_data['plan'] = $this->Plan_model->getPlanCompany($this->session->userdata('company_id')->id);
            $page_data['plan'] = $this->Plan_model->select($user->plan_id);
            // $page_data['paypal_pk'] = $this
            $page_data['paypal_pk'] = $company->paypal_client_id;
            $page_data['paypal_sk'] = $company->paypal_secret_id;
            $page_data['stripe_pk'] = $company->stripe_client_id;
            $page_data['stripe_sk'] = $company->stripe_secret_id;
            $page_data['onetime_pay']  = $company->onetime_pay;

        }else if ($user->user_type == "Superadmin"){
            $this->load->model('Settings_model');
            $page_data['tax_rate'] = $this->Settings_model->getTaxRate()->value;
            $page_data['paypal_pk'] = $this->Settings_model->getPaypalClientId()->value;
            $page_data['paypal_sk'] = $this->Settings_model->getPaypalSecretId()->value;
            $page_data['stripe_pk'] = $this->Settings_model->getStripeClientId()->value;
            $page_data['stripe_sk'] = $this->Settings_model->getStripeClientId()->value;

        }
        $page_data['company_name'] = $company->name;
        $page_data['company_url']  = $company->url;
        $page_data['company_active'] = $company->active;
        $query = "Select * from user_login_log where user_id =".$sessiondata['userId']." order by crdate desc limit 10 ";
        $result = $this->db->query($query);
        $loginRes = $result->result();
        $page_data['loginRes'] = $loginRes;
		
		$page_data['country_list'] = $this->Countries_model->getList();
		$page_data['user'] = $user;
        if($status == "error"){
            $page_data["msg"] = "You should input required fields";
        }else {
            $page_data["msg"] = "";
        }
        $this->load->view('_templates/header', $this->global );
        $this->load->view("user_profile", $page_data);
        $this->load->view('_templates/footer', NULL);
    }
    /*
    public function sendEmail(){
        $address = $this->input->post('email');
        $this->email->clear();

        $this->email->to($address);
        $this->email->from('your@example.com');
        $this->email->subject('Reset your Password?');
        $this->email->message('Hi '.base_url().'resetPass/'.$address.' Click Here to reset Pasword.');
        $this->email->send();

    }*/

    public function updatePassword(){
        $token = $this->input->post("token");
        $this->load->model("Token_model");
        $data = $this->Token_model->getOne($token);
        if($data == null){
            $this->session->set_flashdata('invalid', $this->term['tokenisnotvalid']);
            redirect(base_url("/resetPasswordConfirmUser/".$token));
        }
        $this->load->library('form_validation');

        if($data->expire_time > date('Y-m-d H:i:s', time())){
            $pass = $this->input->post('password');
            $confirm_password = $this->input->post('confirm-password');
            if($pass != $confirm_password){
                $this->session->set_flashdata('invalid', $this->term['passwordnotmatch']);
                redirect(base_url("/resetPasswordConfirmUser/".$token));
            }
            $admin_data['password'] = getHashedPassword($this->input->post('password'));
            $this->User_model->update($admin_data, array('id'=>$data->user_id));
            $this->Settings_model->sendRemeberPassEmail($data->user_id, $pass);
            $result["type"] = 1;
            $result["url"] = "/login";
            redirect(base_url("/login"));
        }else{
            $result["type"] = 1;
            $result["msg"] = "Your expire time is passed";
            $this->session->set_flashdata('invalid', $this->term['yourtokenisexpired']);
            redirect(base_url("/resetPasswordConfirmUser/".$token));
        }
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit();
    }
    
    public function lockUser(){
        $this->load->view("lock-screen", '');
    }

    function resetPasswordConfirmUser($token){
        $this->load->model('Settings_model');
        $data['site_theme'] = $this->Settings_model->getTheme();
        if(sizeof($data['site_theme']) >= 1){
            $data['site_theme'] = $data['site_theme'][0];
        }
        if(sizeof($data['site_theme'])  == 0){
            $data['site_theme'] = array();
        }
        $data['token'] = $token;
        $data['term'] = $this->term;
        $this->load->view('new-password', $data);
    }

    function createPasswordUser(){
        $status = '';
        $message = '';
        $email = $this->input->post("email");
        $activation_id = $this->input->post("activation_code");        
        $this->load->library('form_validation');        
        $this->form_validation->set_rules('password','Password','required|max_length[20]');
        $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
        
        if($this->form_validation->run() == FALSE){
            $this->resetPasswordConfirmUser($activation_id, urlencode($email));
        }else{
            $password = $this->input->post('password');
            $cpassword = $this->input->post('cpassword');
            
            // Check activation id in database
            $is_correct = $this->login_model->checkActivationDetails($email, $activation_id);
            
            if($is_correct == 1){                
                $this->login_model->createPasswordUser($email, $password);                
                $status = 'success';
                $message = 'Password changed successfully';
            }else{
                $status = 'error';
                $message = 'Password changed failed';
            }
            
            setFlashData($status, $message);
            redirect("/login");
        }
    }

    public function validuser(){
        $email = $this->session->get_userdata()['email'];
        $password = $this->input->post('password');
        $response = $this->Login_model->loginMe($email, $password);
        echo json_encode($response);
    }

    public function signup(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('firstname', 'First Name', 'required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required');
		$this->form_validation->set_rules('country_code', 'Country Code', 'required|numeric');
		$this->form_validation->set_rules('phone', 'Phone Number', 'required|numeric');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password', 'Password','required|min_length[8]|callback_password_check');
        $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'required|min_length[8]|callback_password_check');
        $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'required|matches[password]');        
		
		$data['country_list'] = $this->Countries_model->getList();
		
        if ($this->form_validation->run() == FALSE){
            $data['errors'] = $this->form_validation->error_array();
            $data['company_data'] = $this->Company_model->getList(array("is_deleted"=>0,"active"=>1));
            $data['menu_name'] = 'login';
            $this->loadViews_front('signup',$data);
        }else{
            $data["first_name"] = $this->input->post('firstname');
            $data["last_name"] = $this->input->post('lastname');
            $data["organization"] = $this->input->post('organization');
			$data["country_code"] = $this->input->post('country_code');
			$data["phone"] = $this->input->post('phone');
            $data["email"] = $this->input->post('email');
            $data["password"] = getHashedPassword($this->input->post('password'));
            $data["user_type"] = $this->input->post('user_type');
            $pool = '0123456789';
            $api_key = substr(str_shuffle(str_repeat($pool, ceil(10 / strlen($pool)))), 0, 10);
            $data["api_key"] = $api_key;
            $data["is_active"] = 0;
            $data["activation_code"] = $this->serialkey();
            $data["isPasswordUptd"] = 1;
 
            if($data["user_type"] === "Admin"){
                $insert_company_data = array();
                $insert_company_data['name'] = $data["organization"];
                $insert_company_id = $this->Company_model->insert($insert_company_data);
                $data["company_id"] = $insert_company_id;
            }else{
                $data["company_id"] = $this->input->post('company_id');
            }   
            $user_id = $this->User_model->signup($data);
            $response = $this->Login_model->loginMe($data["email"], $data["password"]);
            if($response['result'] == true){
                    $emailTmp = $this->Settings_model->getEmailTemplate("action='signup_company'");
                    $content = $emailTmp['message'];
                    $title = $emailTmp['subject'];
                    $content = str_replace("{USERNAME}", $data["first_name"] . ' ' . $data["last_name"], $content);
                    $content = str_replace("{LOGO}", "<img src='".base_url('assets/logos/logo1.png')."'/>"."<img src='".base_url('assets/logos/logo2.png')."'/>", $content);
                    $this->sendemail($data['email'], $data['first_name'] . $data['last_name'], $content, $title);
            }
            $verificaiton_link = base_url().'welcome/verifyEmail/'.$data["activation_code"];
            $email_tempU = $this->Settings_model->getEmailTemplate("action='email_verification_authentication'");
            $email_tempU['message'] = str_replace("{username}", $data["first_name"].' '.$data["last_name"], $email_tempU['message']);
            $email_tempU['message'] = str_replace("{verification_link}", $verificaiton_link, $email_tempU['message']);
            $this->sendemail($data["email"], $data["first_name"].' '.$data["last_name"], $email_tempU['message'] , $email_tempU['subject']);
            
            $this->session->set_flashdata('success_msg', 'Please verify your email to start login !!!');
            // redirect($_SERVER['HTTP_REFERER']);
            $this->load->view('confirm_verify',$data);
        }

    }
    public function resend_verification(){
        $email = $this->input->post('email');
        $data = (array)$this->User_model->one(array("email" => $email));
        $pool = '0123456789';
        $api_key = substr(str_shuffle(str_repeat($pool, ceil(10 / strlen($pool)))), 0, 10);
        $data["api_key"] = $api_key;
        $data["is_active"] = 0;
        $data["activation_code"] = $this->serialkey();
        $data["isPasswordUptd"] = 1;
        $this->User_model->update(array("activation_code"=>$data["activation_code"]), array("id"=>$data["id"]));
        $response = $this->Login_model->loginMe($data["email"], $data["password"]);
        if($response['result'] == true){
                $emailTmp = $this->Settings_model->getEmailTemplate("action='signup_company'");
                $content = $emailTmp['message'];
                $title = $emailTmp['subject'];
                $content = str_replace("{USERNAME}", $data["first_name"] . ' ' . $data["last_name"], $content);
                $content = str_replace("{LOGO}", "<img src='".base_url('assets/logos/logo1.png')."'/>"."<img src='".base_url('assets/logos/logo2.png')."'/>", $content);
                $this->sendemail($data['email'], $data['first_name'] . $data['last_name'], $content, $title);
        }
        $verificaiton_link = base_url().'welcome/verifyEmail/'.$data["activation_code"];
        $email_tempU = $this->Settings_model->getEmailTemplate("action='email_verification_authentication'");
        $email_tempU['message'] = str_replace("{username}", $data["first_name"].' '.$data["last_name"], $email_tempU['message']);
        $email_tempU['message'] = str_replace("{verification_link}", $verificaiton_link, $email_tempU['message']);
        $this->sendemail($data["email"], $data["first_name"].' '.$data["last_name"], $email_tempU['message'] , $email_tempU['subject']);
        $this->response(array("success"=> true, "msg"=> "Verification sent"));
    }


    /**
     * Validate the password
     *
     * @param string $password
     *
     * @return bool
     */
    public function password_check($password = ''){
        $password = trim($password);
        $regex_lowercase = '/[a-z]/';
        $regex_uppercase = '/[A-Z]/';
        $regex_number = '/[0-9]/';
        $regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';
        if (empty($password)){
            $this->form_validation->set_message('password_check', 'The {field} field is required.');
            return FALSE;
        }
        if (preg_match_all($regex_lowercase, $password) < 1){
            $this->form_validation->set_message('password_check', 'The {field} field must be at least one Lowercase OR Upper Case letter.');
            return FALSE;
        }
        if (preg_match_all($regex_uppercase, $password) < 1){
            $this->form_validation->set_message('password_check', 'The {field} field must be at least one Uppercase OR Lower Case letter.');
            return FALSE;
        }
        if (preg_match_all($regex_number, $password) < 1){
            $this->form_validation->set_message('password_check', 'The {field} field must have at least one number.');
            return FALSE;
        }
        if (preg_match_all($regex_special, $password) < 1){
            $this->form_validation->set_message('password_check', 'The {field} field must have at least one special character.' . ' ' . htmlentities('!@#$%^&*()\-_=+{};:,<.>§~'));
            return FALSE;
        }
        if (strlen($password) < 8){
            $this->form_validation->set_message('password_check', 'The {field} field must be at least 8 characters in length.');
            return FALSE;
        }
        if (strlen($password) > 32){
            $this->form_validation->set_message('password_check', 'The {field} field cannot exceed 32 characters in length.');
            return FALSE;
        }
        return TRUE;
    }

    public function random($length, $chars = ''){
        if (!$chars){
            $chars = implode(range('a','f'));
            $chars .= implode(range('0','9'));
        }
        $shuffled = str_shuffle($chars);
        return substr($shuffled, 0, $length);
    }

    public function serialkey(){
        return $this->random(8).'-'.$this->random(8).'-'.$this->random(8).'-'.$this->random(8);
    }


    public function send_mail($to , $toname , $content , $title, $type = 0){ 
         $from_email = "support@gosmartacademy.com"; 
         $to_email = $to; 
   
         //Load email library 
         $this->load->library('email');         
         $this->email->set_mailtype('html'); 
         $this->email->from($from_email, $toname); 
         $this->email->to($to_email);
         $this->email->subject($title); 
         $this->email->message($content);
   
         //Send mail 
         if($this->email->send()){
            return true;
         }else{
            return false;
         }
    }


    public function update_password(){
        // echo "<pre>";
        //  print_r($this->input->post());
        // exit;
        //$this->load->model('Authmodel');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('password', 'Password','required|min_length[8]|callback_password_check');
        $this->form_validation->set_rules('repassword', 'Password', 'required|min_length[8]|callback_password_check');
        $this->form_validation->set_rules('repassword', 'Password Confirmation', 'required|matches[password]');
        if ($this->form_validation->run() == FALSE){
            $errors = validation_errors();
            echo json_encode(['error'=>$errors]);
        }else{
            $password     = getHashedPassword($this->input->post('password'));

            $user_type    = $this->input->post('user_type');

            $upArr  = array('password' => $password, 'isPasswordUptd' => 1);

            switch ($user_type){
              case 'admin':
                $this->db->where('id', $this->session->userdata('userId'));
                $query = $this->db->update('user', $upArr);
                break;
              case 'company':
                $this->db->where('id', $this->session->userdata('userId'));
                $query = $this->db->update('user', $upArr);
                break;
              case 'employees':
                $this->db->where('id', $this->session->userdata('userId'));
                $query = $this->db->update('user', $upArr);
                break;
              default:
                $this->db->where('id', $this->session->userdata('userId'));
                $query = $this->db->update('user', $upArr);
            }

            if($query){
                $this->session->set_userdata('is_password_updated', 1);
                echo json_encode(['success'=>'Password updated successfully.']);
            }

        }
    }


    public function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE){
        $output = NULL;
        if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE){
            $ip = $_SERVER["REMOTE_ADDR"];
            if ($deep_detect){
                if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }
        $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
        $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
        $continents = array(
            "AF" => "Africa",
            "AN" => "Antarctica",
            "AS" => "Asia",
            "EU" => "Europe",
            "OC" => "Australia (Oceania)",
            "NA" => "North America",
            "SA" => "South America"
        );
        if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)){
            $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
            if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2){
                switch ($purpose){
                    case "location":
                        $output = array(
                            "city"           => @$ipdat->geoplugin_city,
                            "state"          => @$ipdat->geoplugin_regionName,
                            "country"        => @$ipdat->geoplugin_countryName,
                            "country_code"   => @$ipdat->geoplugin_countryCode,
                            "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                            "continent_code" => @$ipdat->geoplugin_continentCode,
                            "ip"             => $ip
                        );
                        break;
                    case "address":
                        $address = array($ipdat->geoplugin_countryName);
                        if (@strlen($ipdat->geoplugin_regionName) >= 1)
                            $address[] = $ipdat->geoplugin_regionName;
                        if (@strlen($ipdat->geoplugin_city) >= 1)
                            $address[] = $ipdat->geoplugin_city;
                        $output = implode(", ", array_reverse($address));
                        break;
                    case "city":
                        $output = @$ipdat->geoplugin_city;
                        break;
                    case "state":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "region":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "country":
                        $output = @$ipdat->geoplugin_countryName;
                        break;
                    case "countrycode":
                        $output = @$ipdat->geoplugin_countryCode;
                        break;
                }
            }
        }
        return $output;
    }
	
	function sendTwilioSMS($phone,$otp,$mailStatus=NULL){
		$emailStatus = 'No';
		try{
			$phonenumber = $phone;
			$sid = 'AC8aa28cf11da6af828155fe1d0aa0e543';
			$token = '8b20e2b103093ee5d5c447a7ca20d399';
			 
			$client = new Client($sid, $token);		
			// Use the client to do fun stuff like send text messages!								
			$response = $client->messages->create(
				// the number you'd like to send the message to
				$phonenumber,
				[
					// A Twilio phone number you purchased at twilio.com/console									
					'from' => '+12058801305',
					// the body of the text message you'd like to send
					'body' => "You OTP: ".$otp
				]
			);
		}catch( \Exception $e){
			if($mailStatus != '' && $mailStatus == 'Yes'){
				$emailStatus = 'Yes';
			}
		}		
		return $emailStatus;
	}
	
}

?>
