<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Sccquestions_model extends CI_Model
{
    
    /**
     * This function used to manage exams
     */
   	protected $quiz_table = 'scc_questions';
    protected $answer_table = 'scc_answers';
    
    function count($filter = NULL) {
        if($filter)
            $this->db->where($filter);
        return $this->db->count_all_results($this->quiz_table);
    }

    function groupcount() {
    	$this->db->select("SUBSTR(`category`,1,1), COUNT(*)")->from($this->quiz_table);
        $this->db->group_by("SUBSTR(`category`,1,1)");
        return $this->db->get()->result_array();
    }
    function getlist($filter = NULL, $limit=-1, $offset=0) {
        $this->db->select('a.*, GROUP_CONCAT(b.`answer_possibility`) AS answers, 
            REPLACE(GROUP_CONCAT(IF(b.`right_answer`,b.`answer_possibility`,"")), ",", "") AS right_answer');
        $this->db->from($this->quiz_table." a");
        $this->db->join($this->answer_table." b", "a.`sgu_id`=b.`sgu_id` AND a.`category`=b.`category`", "left");
        if($filter)
            $this->db->where($filter);
        $this->db->group_by("a.`category`");
        $this->db->order_by("a.`sgu_id`");
        if($limit>-1)
            $this->db->limit($limit, $offset); 
        
        return $this->db->get()->result_array();
    }  
    function getsguidlist($filter = NULL) {
        $this->db->select('sgu_id');
        $this->db->from($this->quiz_table);
        if($filter)
            $this->db->where($filter);
        
        return $this->db->get()->result_array();
    }  
    function select($id) {
        $this->db->where(sgu_id, $id);
        $quiz = $this->db->get($this->quiz_table)->result_array();
        return $quiz;
    }
}

?>
