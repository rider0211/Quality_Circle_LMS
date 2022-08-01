<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Timon
 * Date: 6/27/2018
 * Time: 6:24 PM
 */

class Translate_model extends CI_Model
{
    /**
     * This function used to manage categories
     */
    protected $table;

    function __construct()
    {
        parent::__construct();
        $this->table = 'trans_term';
        $this->lang_table = 'trans_lang';
    }

    function getLanguageList($searchcond = array(), $searchstr = '')
    {
        $this->db->select("*, lang_name text")->from($this->lang_table);

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

        if(!empty($searchstr))
            $this->db->like('lang_name', $searchstr);

        $filtertotal = $this->db->count_all_results('', FALSE);

        $this->db->order_by('lang_name', 'ASC');

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
            $data = $query->result_array();
            foreach ($data as $item) {
                $field_name = isset($item['field_name']) ? $item['field_name'] : '';
                $term_count = $this->getCount('term');
                $done_count = $this->getCount($field_name);
                $item['term_count'] = $term_count;
                $item['done_count'] = $done_count;
                $result_info["data"][] = $item;
            }

        } else {
            $result_info['total'] = 0;
            $result_info['filtertotal'] = 0;
            $result_info['data'] = array();
        }

        return $result_info;

    }

    function getTermList($item, $lang_field_name)
    {
        $this->db->select("id, $item, $lang_field_name")->from($this->table);

        $filtertotal = $this->db->count_all_results('', FALSE);

        //$this->db->order_by('english', 'ASC');

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

    function getCount($lang_field_name){
        if ($lang_field_name == '') return 0;
        $this->db->select($lang_field_name)->from($this->table);
        $this->db->where($lang_field_name . ' != ', '""', false);
        $total = $this->db->count_all_results();
        return $total;
    }

    function update_lang($data){
        return $this->update($data, $this->lang_table);
    }

    function update_term($data)
    {
        return $this->update($data, $this->table);
    }

    function update($data, $table){
        $this->db->where('id', $data["id"]);
        $result = $this->db->update($table, $data);
    }


}
