<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Login (LoginController)
 * Login class to control to authenticate user credentials and starts user's session.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
require APPPATH . '/libraries/BaseController.php';

class Login extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->model('User_model');
        $this->load->model('Company_model');
        $this->load->model('Settings_model');
        $this->load->model('Translate_model');

        $this->load->helper(array('cookie', 'string', 'language', 'url'));
        $this->load->helper('lms_email');
    }

    public function index()
    {
        $this->isLoggedIn();
    }

    function isLoggedIn()
    {
    	
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        
        $recheck = $this->recheck_session();

        // auto-login the user if they are remembered
        if (!$recheck && get_cookie('email') && get_cookie('remember_token'))
        {
            $recheck = $this->login_remembered_user();
        }

        if(!$recheck)
        {
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
        }
        else
        {    
        		switch ($this->session->userdata('user_type')) {
                    case "SuperAdmin":
                    case "Admin": {
                        redirect('/admin');
                    }
                        break;
                    default: {
                        if ($this->session->userdata('company_user_type') == "Instructor"){
                            redirect('/instructor');
                        }else{
                            redirect('welcome');
                        }
                    }
                        break;
                }
        }
    }

    public function recheck_session()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        
        if(isset($isLoggedIn) && $isLoggedIn == TRUE) {
            $this->session->set_userdata('last_check', time());
        } else {
            $this->session->unset_userdata(array('email', 'userId', 'user_id', 'isLoggedIn'));
            return FALSE;
        }   
        return TRUE;
    }

    function logout($url) {
        
        if ($this->session->userdata('user_id')) {   
            $activity_data["activity_type"] = "Logout";
            $activity_data["user_id"] = $this->session->userdata('user_id');
            $activity_data["activity_message"] = $this->session->userdata('name')." logout.";

            $this->load->model('Activity_model');
            $this->Activity_model->insert($activity_data);
        }

        if (substr(CI_VERSION, 0, 1) == '2') {
            $this->session->unset_userdata(array($identity => '', 'userId' => '', 'user_id' => '', 'isLoggedIn' => ''));
        } else {
            $this->session->unset_userdata(array($identity, 'userId', 'user_id', 'isLoggedIn'));
        }

        // delete the remember me cookies if they exist
        if (get_cookie('email')) {
            delete_cookie('email');
        }

        if (get_cookie('remember_token')) {
            delete_cookie('remember_token');
        }

        // Destroy the session
        $this->session->sess_destroy();

        redirect( "location: https://webrtc.gosmartacademy.com/instructor_dashboard.php?logout='1'",'refresh');
        //redirect ( 'company/'.$url );
        //exit();
    }

    public function loginUser($company_name)
    {
    	$result 			= array();
    	$result['type'] 	= 0;
    	$result['redirect'] = 0;
    	if($this->input->post('email') && $this->input->post('password')) {
    		if(filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)) {
    			$email = $this->input->post('email');
    			$password = $this->input->post('password');
    			$response = $this->Login_model->loginMeCompany($email, $password, $company_name);
    			if($response['result'] == true)
    			{
                    $res = $response['user'][0];
                    if($res->is_active == 0) {
                        $result['msg'] = 'Please verify your email to start login!!!';
                    }
                    else {
        				$result['type'] = 1;
    					$res = $response['user'][0];    				
    					$this->User_model->update_last_login($res->id);
    					$photo = base_url().$res->photo;
    					$sessionArray = array(
    							'userId'=>$res->id,
    							'user_type'=>$res->type,
    							'company_user_type'=>$res->company_user_type,
                                'is_password_updated' => $res->isPasswordUptd,
    							'roleText'=>$res->type,
    							'user_photo'=>$photo,
    							'user_id'=>$res->id,
    							'email'=>$res->email,
    							'company_id'=>$res->company_id,
    							'name'=>$res->fullname,
    							'last_check'=>time(),
    							'isLoggedIn' => TRUE
    					);
    					$this->session->set_userdata($sessionArray);
    					$activity_data["activity_type"] = "Login";
    					$activity_data["user_id"] = $res->id;
    					$activity_data["activity_message"] = $res->fullname." login successfully.";
    						 
    					$this->load->model('Activity_model');
    					$this->Activity_model->insert($activity_data);				
    					
    					$result['redirect'] = 1;
    					$result['msg'] = $res->fullname.' login successfully';
    					$this->session->set_userdata($sessionArray);
                    }
    			    				
    			}
    			else 
    				$result['msg'] = $response['msg'];
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

    public function signup($company_url = ''){
        $data = array();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('firstname', 'First Name', 'required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|callback_password_check');
        $this->form_validation->set_rules('confirm_password', 'Password', 'required|min_length[8]|callback_password_check');
        $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'required|matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
        if ($this->form_validation->run() == FALSE) {
            $errors = $this->form_validation->error_array();
            foreach($errors as $error){
                $data['errors'] = $error;
            }
            $data['type'] = 0;
        } else {
            $company_data = $this->Company_model->getByUrl($company_url);
            if(count($company_data) == 0){
                $data['type'] = 0;
                $data['msg'] = 'No Exist Url!';
            }else{
                $data["first_name"] = $this->input->post('firstname');
                $data["last_name"] = $this->input->post('lastname');
                $data["organization"] = $this->input->post('organization');
                $data["email"] = $this->input->post('email');
                $data["password"] = getHashedPassword($this->input->post('password'));
                $data["user_type"] = 'Learner';
                $data["company_id"] = $company_data['id'];
                $data["is_active"] = 0;
                $data["activation_code"] = $this->serialkey();
                $data["isPasswordUptd"]  = 1;

                $user_id = $this->User_model->signup($data);
                if(isset($user_id)){
                    $data['type'] = 0;
                    $data['msg'] = 'Please verify your email to start login!!';
                }
                else
                {
                    $data['type'] = 0;
                    $data['msg'] = 'Retry sign up!';
                }

                // send First signup success email
                $emailTmp= $this->Settings_model->getEmailTemplate("action='welcome_email'");

                $content = $emailTmp['message'];
                $title = $emailTmp['subject'];

                $content = str_replace("{USERNAME}", $data["first_name"].' '.$data["last_name"], $content);

                $content = str_replace("{LOGO}", "<img src='" . base_url('assets/logos/logo1.png') . "'/>"."<img src='" . base_url('assets/logos/logo2.png') . "'/>", $content);

                $this->sendemail($data["email"], $data["first_name"].' '.$data["last_name"], $content , $title);


                //-------------------Send email to registered user for Email verificaiton  ----------------------

                $verificaiton_link = base_url().'welcome/verifyEmail/'.$data["activation_code"];
                $email_tempU = $this->Settings_model->getEmailTemplate("action='email_verification_authentication'");
                $email_tempU['message'] = str_replace("{username}", $data["first_name"].' '.$data["last_name"], $email_tempU['message']);
                $email_tempU['message'] = str_replace("{verification_link}", $verificaiton_link, $email_tempU['message']);
                // $this->sendemail($email, 'Email Verification', $email_tempU['message'], $email_tempU['subject']);
                $this->sendemail($data["email"], $data["first_name"].' '.$data["last_name"], $email_tempU['message'] , $email_tempU['subject']);


                /*$response = $this->Login_model->loginMe($data["email"], $data["password"]);
                if($response['result'] == true)
                {
                    $result['type'] = 1;
                    $res = $response['user'][0];
                    $this->User_model->update_last_login($res->id);
                    $photo = base_url().$res->photo;
                    $sessionArray = array(
                        'userId'=>$res->id,
                        'user_type'=>$res->type,
                        'user_name'=>$res->fullname,
                        'company_user_type'=>$res->company_user_type,
                        'roleText'=>$res->type,
                        'user_photo'=>$photo,
                        'user_id'=>$res->id,
                        'email'=>$res->email,
                        'company_id'=>$res->company_id,
                        'name'=>$res->fullname,
                        'last_check'=>time(),
                        'isLoggedIn' => TRUE
                    );
                    $this->session->set_userdata($sessionArray);
                    $activity_data[activity_type] = "Login";
                    $activity_data[user_id] = $res->id;
                    $activity_data[activity_message] = $res->fullname." login successfully.";

                    $this->load->model('Activity_model');
                    $this->Activity_model->insert($activity_data);

                    $result['redirect'] = 1;
                    $result['msg'] = 'Login successfully';
                    $this->session->set_userdata($sessionArray);


                    // send signup success email
                    $emailTmp= $this->Settings_model->getEmailTemplate("action='welcome_email'");

                    $content = $emailTmp['message'];
                    $title = $emailTmp['subject'];

                    $content = str_replace("{USERNAME}", $data["first_name"].' '.$data["last_name"], $content);

                    $content = str_replace("{LOGO}", "<img src='" . base_url('assets/logos/logo1.png') . "'/>"."<img src='" . base_url('assets/logos/logo2.png') . "'/>", $content);

                    $this->sendemail($res->email, $res->fullname, $content , $title);

                   // $this->sendemail($data["email"], $data["first_name"].' '. $data["last_name"], $content,$title );
                }*/
            }

        }
        $this->output
        ->set_status_header(200)
        ->set_content_type('application/json', 'utf-8')
        ->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
        ->_display();
        exit();
    }

    /**
     * Validate the password
     *
     * @param string $password
     *
     * @return bool
     */
    public function password_check($password = '')
    {
        $password = trim($password);
        $regex_lowercase = '/[a-z]/';
        $regex_uppercase = '/[A-Z]/';
        $regex_number = '/[0-9]/';
        $regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';
        if (empty($password))
        {
            $this->form_validation->set_message('password_check', 'The {field} field is required.');
            return FALSE;
        }
        if (preg_match_all($regex_lowercase, $password) < 1)
        {
            $this->form_validation->set_message('password_check', 'The {field} field must be at least one Lowercase OR Upper Case letter.');
            return FALSE;
        }
        if (preg_match_all($regex_uppercase, $password) < 1)
        {
            $this->form_validation->set_message('password_check', 'The {field} field must be at least one Uppercase OR Lower Case letter.');
            return FALSE;
        }
        if (preg_match_all($regex_number, $password) < 1)
        {
            $this->form_validation->set_message('password_check', 'The {field} field must have at least one number.');
            return FALSE;
        }
        if (preg_match_all($regex_special, $password) < 1)
        {
            $this->form_validation->set_message('password_check', 'The {field} field must have at least one special character.' . ' ' . htmlentities('!@#$%^&*()\-_=+{};:,<.>§~'));
            return FALSE;
        }
        if (strlen($password) < 8)
        {
            $this->form_validation->set_message('password_check', 'The {field} field must be at least 8 characters in length.');
            return FALSE;
        }
        if (strlen($password) > 32)
        {
            $this->form_validation->set_message('password_check', 'The {field} field cannot exceed 32 characters in length.');
            return FALSE;
        }
        return TRUE;
    }



    public function random($length, $chars = '')
    {
        if (!$chars) {
            $chars = implode(range('a','f'));
            $chars .= implode(range('0','9'));
        }
        $shuffled = str_shuffle($chars);
        return substr($shuffled, 0, $length);
    }

    public function serialkey()
    {
        return $this->random(8).'-'.$this->random(8).'-'.$this->random(8).'-'.$this->random(8);
    }


}

?>
