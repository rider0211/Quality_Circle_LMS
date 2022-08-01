<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Topic_model extends CI_Model
{
    
    /**
     * This function used to manage Topics
     */
   	protected $table;
    
    function __construct()
    {
        parent::__construct();
        $this->table = 'training_topic';
        $this->category_table = 'training_category';
    }

    function count()
    {
        return $this->db->count_all($this->table);
    }
    
    /*
     * This function used to display paginated list 
     */    
    function getPagingList($searchcond = array(), $limit = "", $offset = "")
    {
        $this->db->select('a.*, b.category_name')->from($this->table." a");
        $this->db->join($this->category_table." b", 'a.category_id = b.id', 'left');
        
        $total = $this->db->count_all_results('', FALSE);

        foreach ($searchcond as $fname=>$val) {
            if(is_array($val)) {
                if(count($val)>0)
                    $this->db->where_in($fname, $val);    
                else
                    $this->db->where($fname, 0);     
            } else {
                $this->db->where($fname, $val);        
            }
        }

        $filtertotal = $this->db->count_all_results('', FALSE);

        $this->db->order_by('a.`id`', 'DESC');
        
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
            $result_info['total'] = $total;
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
     * This function used to display All list
     */    
    function getAllSimpleList($list_ids = array())
    {
        $this->db->select("a.id, training_title AS text, b.category_name, CURRENT_DATE() AS startdate")->from($this->table." a");  
        $this->db->join($this->category_table." b", 'a.category_id = b.id', 'left');
        
        if(count($list_ids) > 0)      
            $this->db->where_in('a.`id`', $list_ids);

        $this->db->order_by('a.category_id ASC, a.id ASC');    
            
        $query = $this->db->get();

        return $query->result_array();
    }


    /*
     * This function used to display title list
     */    
    function getTitleList($str_title='', $cid=0)
    {
        $this->db->select("id, training_title AS text")->from($this->table);  
        if($cid != 0)
            $this->db->where('`category_id`', $cid);
        if(!empty($str_title))
            $this->db->like('`training_title`', $str_title, 'left');

        $this->db->order_by('id', 'ASC');    
            
        $query = $this->db->get();

        return $query->result_array();
    }


    /*
     * This function used to select one record
     */ 
    function getTopicInfo($row_id)
    {
        $this->db->select("a.*, b.category_name")->from($this->table." a");
        $this->db->join($this->category_table." b", 'a.category_id = b.id', 'left');
        $this->db->where('a.`id`', $row_id);
        $query = $this->db->get();

        return $query->result_array();
    }

    /*
     * This function used to select one record
     */ 
    function getRow($row_id)
    {
        $this->db->where('`id`', $row_id);
        $query = $this->db->get($this->table);

        return $query->result_array();
    }   

     
    /*
     * This function used to select Training_Title list
     */ 
    function getTrainingTitleList($list_ids = array())
    {
        $this->db->select("training_title, lesson_count")->from($this->table);
        
        if(count($list_ids) > 0)
            $this->db->where_in('`id`',$list_ids);

        $query = $this->db->get();
        return $query->result_array();
    }


    function getAssignedList ($topic_list=array()) {
        $this->db->select()->from("training_topic"); 
        if(count($topic_list)>0)
            $this->db->where_in('`id`', $topic_list);
        else
            $this->db->where('`id`', 0);

        $query = $this->db->get();

        return $query->result_array();
        
    }


    /*
     * This function is used to add new Topic
     * @param $topic_info : New Topic
     * @return $insert_id : This is last inserted id
     */
    function addTopic($topic_info)
    {
        $this->db->trans_start();
        
        $topic_info['created_at'] = date("Y-m-d H:i:s");

        $this->db->insert($this->table, $topic_info);

        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }


    /**
     * This function is used to update the Topic information
     * @param array $topic_info : This is Topic updated information
     * @param number $row_id : This is Topic id
     */
    function updateTopic($topic_info, $row_id)
    {
        $topic_info['updated_at'] = date("Y-m-d H:i:s");        
        
        $this->db->update($this->table, $topic_info, array('id' => $row_id));

        return TRUE;
    }


    /**
     * This function is used to delete the Topic information
     * @param number $row_id : This is Topic id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteTopic($row_id)
    {
        return $this->db->delete($this->table, array('id' => $row_id));        
    }
}

?>
