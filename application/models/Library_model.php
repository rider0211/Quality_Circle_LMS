<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Timon
 * Date: 2018-10-24
 * Time: PM 10:33
 */

class Library_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->table = 'library';
        $this->bookshoptable = 'book_shop';
        $this->user_table = 'user';
        $this->companyuser_table = 'company_user';

        $this->load->helper('mail');

    }

    function getBook($id = null){
        if($id == null){
            $query = "Select b.id as id, b.title as title, b.price as price, b.description as description,
                      b.image_path as image_path, b.picture1 as picture1, b.picture2 as picture2, b.picture3 as picture3,
                      b.picture4 as picture4, b.picture5 as picture5, c.file_path as file_path  from book_shop as b join library as c on b.library_id = c.id where c.file_type='pdf'";

        }else{
            $query = "Select b.id as id, b.title as title, b.price as price, b.description as description,
                      b.image_path as image_path, b.picture1 as picture1, b.picture2 as picture2, b.picture3 as picture3,
                      b.picture4 as picture4, b.picture5 as picture5, c.file_path as file_path  from book_shop as b join library as c on b.library_id = c.id where c.file_type='pdf' and b.id=$id";

        }
        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }

    function getMyBook($id = null){
        if($id == null){
            $query = "Select a.id as id, b.title as title, b.price as price, b.description as description,
                      b.image_path as image_path, b.picture1 as picture1, b.picture2 as picture2, b.picture3 as picture3,
                      b.picture4 as picture4, b.picture5 as picture5, c.file_path as file_path  from user_book as a join book_shop as b on a.book_id = b.id join library as c on b.library_id = c.id where c.file_type='pdf'";

        }else{
            $query = "Select a.id as id, b.title as title, b.price as price, b.description as description,
                      b.image_path as image_path, b.picture1 as picture1, b.picture2 as picture2, b.picture3 as picture3,
                      b.picture4 as picture4, b.picture5 as picture5, c.file_path as file_path  from user_book as a join book_shop as b on a.book_id = b.id join library as c on b.library_id = c.id where c.file_type='pdf' and a.id=$id";

        }
        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }

    function insertshop($data){

        $this->db->insert($this->bookshoptable, $data);
        $id = $this->db->insert_id();
        return $id;
    }

    function updateshop($data, $where = null){
        $this->db->where($where);
        $result = $this->db->update($this->bookshoptable, $data);

        return $result;
    }

    function insert($data)
    {
        $data['reg_date'] = date("Y-m-d H:i:s");
        $data['is_shopping'] = 0;

        $this->db->insert($this->table, $data);
        $id = $this->db->insert_id();
        return $id;
    }



    function update($data, $where = null)
    {
        $this->db->where($where);
        $result = $this->db->update($this->table, $data);

        return $result;
    }

    function delete($where = null)
    {

        return $this->db->delete($this->table, $where);

    }

    function deleteshop($where = null)
    {
        return $this->db->delete($this->bookshoptable, $where);
    }

    function getdataFromShop($where = null)
    {
        if ($where == null){
            $result = $this->db->get($this->bookshoptable);
        } else {
            $result = $this->db->get_where($this->bookshoptable, $where);
        }
        $res=$result->result_array();
        return $res;
    }

    function getList($where = null)
    {
        if ($where == null){
            $result = $this->db->get($this->table);
        } else {
            $result = $this->db->get_where($this->table, $where);
        }
        $res=$result->result_array();

        return $res;
    }
    function getBookByLibraryId($id)
    {
        $this->db->join('book_shop b', 'b.library_id = library.id', 'left');
        $this->db->where('b.id',$id);
        $result = $this->db->get($this->table);
        $res=$result->result_array();

        return $res;
    }

    function all_count($filter = NULL){
        if($filter!=NULL) {
            foreach($filter as $name=>$value) {
                if($name=="start" || $name=="limit" || $name=="search")
                    continue;
                if (is_array($value)) {
                    $this->db->where_in($this->sfield($name), $value);
                } else {
                    $this->db->where($this->sfield($name), $value);
                }
            }
        }
        return $this->db->count_all_results($this->table);
    }
    function sfield($field) {
        if(!strpos($field, "."))
            return $this->db->protect_identifiers($this->table) . "." . $field;
        return $field;
    }

    function getLibraryCount($filter){
        $query = "SELECT COUNT(*) count FROM library WHERE create_id = '". $filter['company_id']."' AND file_type = 'DIRECTORY'";
        $result = $this->db->query($query)->row();
        return $result->count;
    }
}