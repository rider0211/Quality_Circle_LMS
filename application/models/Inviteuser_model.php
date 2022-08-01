<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Timon
 * Date: 6/27/2018
 * Time: 6:24 PM
 */
//require APPPATH . '/libraries/AbstractModel.php';
class Inviteuser_model extends AbstractModel
{
    /**
     * This function used to manage categories
     */
    protected $table;
    var $_table = 'invite_user';

    function __construct()
    {
        $this->table = 'invite_user';
    }

    function getAll($filter = NULL, $order = NULL, $direction = 'asc', $fields = "*"){
        return parent::all($filter);
    }
   
    function getInviteUserVirtual($time_id,$type){
        $query = "SELECT
                        *
                    FROM
                        invite_user
                    WHERE
                        virtual_course_time_id = ".$time_id."
                    AND course_type = ".$type;
        $result = $this->db->query($query);
        $res=$result->result_array();
        return $res;
    }
	function getInviteUser($id,$type){
        $query = "SELECT
                        *
                    FROM
                        invite_user
                    WHERE
                        course_id = ".$id."
                    AND course_type = ".$type;
        $result = $this->db->query($query);
        $res=$result->result_array();
        return $res;
    }
	
	function getInviteUserCountFront($tid,$type,$email,$time_id){		
		if($type == 1){
			$query = "SELECT
                        *
                    FROM
                        invite_user
                    WHERE
                        virtual_course_time_id = ".$time_id."
                    AND course_type = ".$type."
                    AND email = '".$email."'";	
		}elseif($type == 0){
			$query = "SELECT
                        *
                    FROM
                        invite_user
                    WHERE
                        ilt_course_time_id = ".$time_id."
                    AND course_type = ".$type."
                    AND email = '".$email."'";		
		}else{
			$query = "SELECT
                        *
                    FROM
                        invite_user
                    WHERE
                        course_id= ".$tid."
                    AND course_type = ".$type."
                    AND email = '".$email."'";		
		}
        
        $result = $this->db->query($query);
        $res=$result->result_array();

        return count($res);
    }
	function getLimitation($company_id, $course_type){
        $query = "SELECT * FROM invite_user WHERE course_type = '$course_type' AND company_id = '$company_id'" ;
        $result = $this->db->query($query);
        $res=$result->result_array();

        return count($res);
    }
    function getInviteUserCount($tid,$type,$email){
        $query = "SELECT
                        *
                    FROM
                        invite_user
                    WHERE
                        course_id = ".$tid."
                    AND course_type = ".$type."
                    AND email = '".$email."'";
        $result = $this->db->query($query);
        $res=$result->result_array();

        return count($res);
    }
	
	function update_user($data, $row_id){
        $this->db->where('id', $row_id);
        $result = $this->db->update($this->table, $data);
        return $result;
    }

    ///////////////////////////////////////////////////////////////////////////////
}
