<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Plan_model extends AbstractModel
{
    var $_table = 'plan';

    public function getPlanCompany($company_id){
        $query = "SELECT c.*, MAX(a.pay_date) pay_date FROM payment_history a
            LEFT JOIN `user` b ON b.id = a.user_id
            LEFT JOIN plan c ON c.id = a.object_id
            WHERE b.user_type = 'Admin' AND b.company_id = '".$company_id."' AND a.object_type = 'plan'";
        $result = $this->db->query($query)->row();
        if(count($result) == 0){
            $result = $this->select(1);
        }
        return $result;
    }
}
?>
