<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Exports extends BaseController{
	
	public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
        $this->isLoggedIn();
    }
	
	/************************ upload csv file ******************************/
	
	public function import_users(){
		
		if($this->isMasterAdmin()){
			
			$fileName = $_FILES["file"]["tmp_name"];
			if(isset($fileName) && !empty($fileName)){			
				
				$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel');
					
					if(!empty($_FILES['file']['name']) && $_FILES["file"]["size"] > 0 && in_array($_FILES['file']['type'], $csvMimes)){
					
					$file = fopen($fileName, "r");
					$num = 1;
					while(($column = fgetcsv($file, 10000, ",")) !== FALSE){
						
						if($num > 1){							
													
							$insert_data['first_name'] = $insert_data['last_name'] = '';
							$insert_data['email'] = $insert_data['is_active'] = '';
							$insert_data['organization'] = $insert_data['address1'] = '';
							$insert_data['address2'] = $insert_data['country_code'] = '';
							$insert_data['address2'] = $insert_data['country_code'] = '';
							
							if(isset($column[0])){
								$insert_data['first_name'] = $column[0];
							}
							if(isset($column[1])){
								$insert_data['last_name'] = $column[1];
							}
							if(isset($column[2])){
								$insert_data['email'] = $column[2];
							}
							if(isset($column[3])){
								$insert_data['password'] = md5($column[3]);
							}							
							if(isset($column[4])){
								$insert_data['active'] = $column[4];
							}
							if(isset($column[5])){
								$insert_data['organization'] = $column[5];
							}
							if(isset($column[6])){
								$insert_data['address1'] = $column[6];
							}
							if(isset($column[7])){
								$insert_data['address2'] = $column[7];
							}
							if(isset($column[8])){
								$insert_data['country_code'] = $column[8];
							}
							if(isset($column[9])){
								$insert_data['phone'] = $column[9];
							}
							if(isset($column[10])){
								$insert_data['city'] = $column[10];
							}
							if(isset($column[11])){
								$insert_data['state'] = $column[11];
							}
							if(isset($column[12])){
								$insert_data['zip_code'] = $column[12];
							}
							if(isset($column[13])){
								$insert_data['country'] = $column[13];
							}
							if(isset($column[14])){
								$insert_data['company_id'] = $column[14];
							}
							if(isset($column[15])){
								$insert_data['role'] = $column[15];
							}
							if(isset($column[16])){
								$insert_data['user_type'] = $column[16];
							}
							
							$pool = '0123456789';
							$api_key = substr(str_shuffle(str_repeat($pool, ceil(10/strlen($pool)))), 0, 10);
							$insert_data['api_key'] = $api_key;
							
							$this->User_model->insert($insert_data);						
						}
						$num++;
					}
					return redirect('/admin/user');
				}			
			}else{
				return redirect('/admin/user');
			}			
		}
	}
	
	/***********************export_purchase_report**************************/
 	public function export_users(){
		if($this->isMasterAdmin()){				
			# Conditions...
			$conditions = array();
			$cond = array();
			
			$i = 0;
			foreach($cond as $key => $value){
				$conditions[$i] = $value;
				$i++;
			}
			
			$users = $this->User_model->getList(array('company_id' => $this->session->get_userdata() ['company_id'], 'user_type' => 'Learner'));
			
			if(count($users) > 0){
				
				$delimiter = ",";
				$filename = "users_" . date('d-F-Y') . ".csv";
				
				//create a file pointer
				$f = fopen('php://memory', 'w');
				
				//set column headers
				$fields = array('First Name','Last Name','Contact','Email','Address','Company','User Type');
				
				fputcsv($f, $fields, $delimiter);
				
				//output each row of the data, format line as csv and write to file pointer
				$rowCounter = 2;
				foreach($users as $key => $user):
					$address = $user['address1'].' '.$user['address2'].' '.$user['state'];
					$lineData = array($user['first_name'],$user['last_name'],$user['phone'],$user['email'],$address,$user['company_name'],$user['user_type']);					
					fputcsv($f, $lineData, $delimiter);					
					$rowCounter++;
				endforeach;
				//move back to beginning of file
				fseek($f, 0);
				
				//set headers to download file rather than displayed
				header('Content-Type: text/csv');
				header('Content-Disposition: attachment; filename="' . $filename . '";');
				
				//output all remaining data on a file pointer
				fpassthru($f);
			}
		}else{
			$this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL , NULL);   
		}
	}
	
}
?>