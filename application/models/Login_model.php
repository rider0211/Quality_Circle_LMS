<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model
{
    
    /**
     * This function used to check the login credentials of the user
     * @param string $email : This is email of the user
     * @param string $password : This is encrypted password of the user
     */
    function loginMeOld($email, $password, $remember=FALSE)
    {
        // echo $email;
        // echo $password;
        // exit;
        $this->db->select('BaseTbl.user_type as type');
        $this->db->from('user as BaseTbl');
        $this->db->where('BaseTbl.email', $email);
        $query = $this->db->get();

        $user = $query->result();


        $this->db->select('BaseTbl.id as id, BaseTbl.sign sign, BaseTbl.active active, BaseTbl.is_active is_active, BaseTbl.role role, BaseTbl.password as password, concat(BaseTbl.first_name , " ", BaseTbl.last_name) as fullname, BaseTbl.user_type as type, BaseTbl.isPasswordUptd, BaseTbl.is_blocked, BaseTbl.wrong_attempts, BaseTbl.blocked_till, BaseTbl.plan_id, BaseTbl.is_trialed, BaseTbl.expired, BaseTbl.email as email, BaseTbl.company_id, BaseTbl.picture as photo, BaseTbl.last_login, b.role company_user_type, c.url as company_url');
        $this->db->from('user as BaseTbl');
        $this->db->join("company_user b", 'BaseTbl.id = b.user_id', 'left');
        if($user[0]->type == 'Superadmin'){
            $this->db->join("company c", 'BaseTbl.company_id = c.id', 'left');
        }else{
            $this->db->join("company c", 'BaseTbl.company_id = c.id', 'right');
        }

        $this->db->where('BaseTbl.email', $email);
        $this->db->where('BaseTbl.is_deleted', 0);
        $query = $this->db->get();

        $user = $query->result();

        if(!empty($user)){
            if($password == $user[0]->password && $user[0]->active == "1"){

                $userAttempts = $user[0]->wrong_attempts;

                if($userAttempts >= 3 && $user[0]->is_blocked == 1) {

                    $current_dt_time = date('Y-m-d h:i:s');
                    $blocked_till_dt_time = $user[0]->blocked_till;

                    if(strtotime($current_dt_time) > strtotime($blocked_till_dt_time)) {


                        $updtedArr = array('wrong_attempts' => 0, 'is_blocked' => 0 , 'blocked_till' => null);

                        $this->db->where('email', $user[0]->email);
                        $result = $this->db->update("user", $updtedArr);



                        return array('result'=>true, 'user'=>$user);
                    } else {
                        $differneInseconds = $this->dateDifference($blocked_till_dt_time, $current_dt_time);

                        return array('result'=>false, 'msg'=>'Access Denied For 30 Minutes ! Please try in '. $differneInseconds, 'current_time' => date('y-m-d h:i:s'));
                    }
                }

                return array('result'=>true, 'user'=>$user);
                
            }else if($user[0]->active != "1"){
                return array('result'=>false, 'msg'=>'Access denied!');
            } else {

                // Handle 3 Consective Wrong Login Password Case

                // echo date("Y/m/d H:i:s");

                $userAttempts = $user[0]->wrong_attempts;

                if($userAttempts >= 3) {
                    return array('result'=>false, 'msg'=>'Access Denied For 30 Minutes ! Due to 3 Consective wrong attempts', 'current_time' => date('y-m-d h:i:s'));
                }

                else {
                    if(($userAttempts + 1) < 3) {
                        $updtedArr = array('wrong_attempts' => ($userAttempts +1));

                        $this->db->where('email', $user[0]->email);
                        $result = $this->db->update("user", $updtedArr);

                        return array('result'=>false, 'msg'=>'Please enter correct password!');
                    } else {
                        $updtedArr = array('wrong_attempts' => ($userAttempts +1) , 'is_blocked' => 1 , 'blocked_till' => date("Y-m-d h:i:s", strtotime("+30 minutes")));

                        $this->db->where('email', $user[0]->email);
                        $result = $this->db->update("user", $updtedArr);

                        return array('result'=>false, 'msg'=>'Access Denied For 30 Minutes ! Due to 3 Consective wrong attempts' , 'current_time' => date('y-m-d h:i:s'));
                    }
                    
                }
            }
        } else {
            return array('result'=>false, 'msg'=>'Your account doesn\'t exist. Please try again!');
        }
    }
	
	function loginMe($email, $password, $remember=FALSE, $viaOTP = false)
    {
        $this->db->select('BaseTbl.user_type as type');
        $this->db->from('user as BaseTbl');
        $this->db->where('BaseTbl.email', $email);
        $query = $this->db->get();

        $user = $query->result();

        $this->db->select('BaseTbl.id as id, BaseTbl.sign sign, BaseTbl.country_code as country_code, BaseTbl.phone as phone, BaseTbl.active active, BaseTbl.is_active is_active, BaseTbl.role role, BaseTbl.password as password, concat(BaseTbl.first_name , " ", BaseTbl.last_name) as fullname, BaseTbl.user_type as type, BaseTbl.isPasswordUptd, BaseTbl.is_blocked, BaseTbl.wrong_attempts, BaseTbl.blocked_till, BaseTbl.plan_id, BaseTbl.is_trialed, BaseTbl.expired, BaseTbl.email as email, BaseTbl.company_id, BaseTbl.picture as photo, BaseTbl.last_login, b.role company_user_type, c.url as company_url');
        $this->db->from('user as BaseTbl');
        $this->db->join("company_user b", 'BaseTbl.id = b.user_id', 'left');
        if($user[0]->type == 'Superadmin'){
            $this->db->join("company c", 'BaseTbl.company_id = c.id', 'left');
        }else{
            $this->db->join("company c", 'BaseTbl.company_id = c.id', 'right');
        }

        $this->db->where('BaseTbl.email', $email);
        $this->db->where('BaseTbl.is_deleted', 0);
        $query = $this->db->get();

        $user = $query->result();

		if(!empty($user)){
            if(($viaOTP || verifyHashedPassword($password, $user[0]->password)) && $user[0]->active == "1"){
                return array('result'=>true, 'user'=>$user);
            }else if($user[0]->active != "1"){
                return array('result'=>false, 'msg'=>'Access denied!');
            } else {
                return array('result'=>false, 'msg'=>'Please enter correct password!');
            }
        } else {
            return array('result'=>false, 'msg'=>'Your account doesn\'t exist. Please try again!');
        }
        return array('result'=>true, 'user'=>$user);
    }

    function loginMeCompany($email, $password, $company)
    {
        $this->db->select('BaseTbl.id as id, BaseTbl.active active, , BaseTbl.is_active is_active, BaseTbl.password as password, concat(BaseTbl.first_name , " ", BaseTbl.last_name) as fullname, BaseTbl.user_type as type, BaseTbl.plan_id, BaseTbl.is_trialed, BaseTbl.expired, BaseTbl.email as email, BaseTbl.company_id, BaseTbl.isPasswordUptd, BaseTbl.is_blocked, BaseTbl.wrong_attempts, BaseTbl.blocked_till, BaseTbl.picture as photo, BaseTbl.last_login, b.role company_user_type, c.url as company_url');
        $this->db->from('user as BaseTbl');
        $this->db->join("company_user b", 'BaseTbl.id = b.user_id', 'left');
        $this->db->join("company c", 'BaseTbl.company_id = c.id', 'left');
        $this->db->where('BaseTbl.email', $email);
        $this->db->where('BaseTbl.is_deleted', 0);
        $this->db->where('c.url', $company);
        $query = $this->db->get();

        $user = $query->result();
        if(!empty($user)){
            if(verifyHashedPassword($password, $user[0]->password) && $user[0]->active == "1"){
                return array('result'=>true, 'user'=>$user);
            }else if($user[0]->active != "1"){
                return array('result'=>false, 'msg'=>'Access denied!');
            } else {
                return array('result'=>false, 'msg'=>'Please enter correct password!');
            }
        } else {
            return array('result'=>false, 'msg'=>'Your account doesn\'t exist. Please try again!');
        }
    }


    public function dateDifference($date1, $date2)
    {       
        $date1=strtotime($date1);
        $date2=strtotime($date2); 
        $diff = abs($date1 - $date2);
        
        $day = $diff/(60*60*24); // in day
        $dayFix = floor($day);
        $dayPen = $day - $dayFix;
        if($dayPen > 0)
        {
            $hour = $dayPen*(24); // in hour (1 day = 24 hour)
            $hourFix = floor($hour);
            $hourPen = $hour - $hourFix;
            if($hourPen > 0)
            {
                $min = $hourPen*(60); // in hour (1 hour = 60 min)
                $minFix = floor($min);
                $minPen = $min - $minFix;
                if($minPen > 0)
                {
                    $sec = $minPen*(60); // in sec (1 min = 60 sec)
                    $secFix = floor($sec);
                }
            }
        }
        $str = "";
        if($dayFix > 0)
            $str.= $dayFix." day ";
        if($hourFix > 0)
            $str.= $hourFix." hour ";
        if($minFix > 0) 
            $str.= $minFix." min ";
        if($secFix > 0)
            $str.= $secFix." sec ";
        return $str;
    }

}

