<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Sccanswers_model extends CI_Model
{
    
    /**
     * This function used to manage exams
     */
   	protected $table = 'scc_answers';
    
    function count($filter = NULL) {
        if($filter)
            $this->db->where($filter);
        return $this->db->count_all_results($this->table);
    }

    function select($id, $answer='') {
        $this->db->where(sgu_id, $id);
        if(!empty($answer))
            $this->db->where(answer_possibility, $answer);
        $answers = $this->db->get($this->table)->result_array();
        return $answers;
    }


}

?>
