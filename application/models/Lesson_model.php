<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Lesson_model extends CI_Model
{
    
    /**
     * This function used to manage Lessons
     */
   	protected $table;
    
    function __construct()
    {
        parent::__construct();
        $this->table = 'training_lesson';
        $this->category_table = 'training_category';
    }

    /*
     * This function used to display paginated list 
     */    
    function getPagingList($search_cond = array(), $limit = "", $offset = "")
    {
        $this->db->select('a.*, b.category_name')->from($this->table." a");
        $this->db->join($this->category_table." b", 'a.category_id = b.id', 'left');
        
        $filtertotal = $this->db->count_all_results('', FALSE);

        $this->db->order_by('`id`', 'DESC');
        
        if(isset($limit) && isset($offset))
        {
            $this->db->limit($limit, $offset);
        } 
        else if(isset($limit))
        {
            $this->db->limit($limit);
        }

        $query = $this->db->get();

        $result_info = array();
        if ($query->num_rows() > 0) {
            $result_info['total'] = $filtertotal;
            $result_info['filtertotal'] = $filtertotal;
            $result_info['data'] = $query->result_array();
        } else {
            $result_info['total'] = 0;
            $result_info['filtertotal'] = 0;
            $result_info['data'] = array();
        }

        return $result_info;
    }

    /*
     * This function used to display All list
     */    
    function getAllList($search_cond = array())
    {
        $this->db->select()->from($this->table);        
        $this->db->order_by('`id`', 'DESC');        
        $query = $this->db->get();

        return $query->result_array();
    }

    /*
     * This function used to display select2 list
     */    
    function getLessonSelect2List($category_id=0)
    {
        $this->db->select("id, lesson_title AS text")->from($this->table);  
        if($category_id > 0)
        {
            $this->db->where('category_id', $category_id);
        }      
        $this->db->order_by('`id`', 'ASC');        
        $query = $this->db->get();

        return $query->result_array();
    }

    /*
     * This function used to select one record
     */ 
    function getLessonList($ids = array())
    {
        $this->db->select("a.*, b.category_name")->from($this->table." a");
        $this->db->join($this->category_table." b", 'a.category_id = b.id', 'left');
        $this->db->where_in('a.`id`', $ids);
        $this->db->order_by(sprintf('FIELD(a.id, %s)', implode(",", $ids)));
        $query = $this->db->get();

        return $query->result_array();
    }

    /*
     * This function used to select one record
     */ 
    function getLessonInfo($row_id)
    {
        $this->db->select("a.*, b.category_name")->from($this->table." a");
        $this->db->join($this->category_table." b", 'a.category_id = b.id', 'left');
        $this->db->where('a.`id`', $row_id);
        $query = $this->db->get();

        return $query->result_array();
    }

    
    /*
     * This function is used to add new lesson
     * @return number $insert_id : This is last inserted id
     */
    function addLesson($lesson_info)
    {
        $this->db->trans_start();
        
        $lesson_info['created_at'] = date("Y-m-d H:i:s");

        $this->db->insert($this->table, $lesson_info);

        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }


    /**
     * This function is used to update the lesson information
     * @param array $lesson_info : This is lesson updated information
     * @param number $row_id : This is lesson id
     */
    function update($lesson_info, $row_id)
    {
        $lesson_info['updated_at'] = date("Y-m-d H:i:s");        
        
        $this->db->update($this->table, $lesson_info, array('id' => $row_id));

        return TRUE;
    }


    /**
     * This function is used to delete the lesson information
     * @param number $row_id : This is lesson id
     * @return boolean $result : TRUE / FALSE
     */
    function delete($row_id)
    {
        return $this->db->delete($this->table, array('id' => $row_id));        
    }

    function all($filter = NULL) {
        $this->db->select("training_lesson.*");
        $this->db->select("training_category.category_name");
        $this->db->join("training_category","training_lesson.category_id=training_category.id","left");
        if($filter)
            $this->where($filter);
        //$this->db->order_by("created_at desc");

        if($filter["limit"])
            return $this->db->get('training_lesson',$filter["limit"],$filter["offset"])->result();

        return $this->db->get('training_lesson')->result();
    }

    function where($filter) {
        if ($filter["category_id"])
            $this->db->where('category_id',$filter["category_id"]);
        if($filter["lesson_id"]) {
            $this->db->where_in('training_lesson.id', $filter["lesson_id"]);
            $this->db->order_by(sprintf('FIELD(training_lesson.id, %s)', implode(",", $filter["lesson_id"])));
        }
        if($filter["no_lesson_id"])
            $this->db->where_not_in('training_lesson.id',$filter["no_lesson_id"]);
    }
}

?>
