<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Chapter_model extends AbstractModel
{
    
    var $_table = 'chapter';
    public function updateParent($course_id){
        $query = "UPDATE chapter c1 LEFT JOIN chapter c2 ON c1.parent = c2.`prev_id` SET c1.parent = c2.id WHERE c1.`course_id` = $course_id  AND c2.`course_id` = $course_id;";
        $this->db->query($query);
    }
}

?>
