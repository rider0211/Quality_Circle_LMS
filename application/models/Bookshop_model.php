<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Timon
 * Date: 6/27/2018
 * Time: 6:24 PM
 */

class Bookshop_model extends AbstractModel
{
    /**
     * This function used to manage categories
     */
    protected $user_table;
    protected $table;

    var $_table = 'book_shop';

    function __construct()
    {
        parent::__construct();
        $this->table = 'book_shop';
        $this->library_table = 'library';
        $this->user_table = 'user';
        $this->my_books_table = 'my_books';
    }
    /*start front*/
    function all($filter = NULL, $order = NULL, $direction = 'asc', $fields = "*"){
        $user_id = $this->session->userdata('user_id');
        $where = "FIND_IN_SET('".$user_id."', assign_user) OR assign_user = 0"; 
        $this->db->where($where);
        if(!empty($filter['search'])) {
            $this->db->group_start();
            $this->db->or_like('book_shop.title', $filter['search'], 'both');
            $this->db->group_end();
        }

        $result = parent::all($filter); //echo $this->db->last_query();exit;  
        if(isset($user_id)){
            foreach($result as $key => $val) {
            //while(list($key,$val) = each($result)){
                $count = $this->db->where('user_id',$user_id)
                                  ->where('bookshop_id',$val->id)
                                  ->count_all_results($this->my_books_table);
                if($count > 0){
                    $val->is_mybook = '1';
                }else{
                    $val->is_mybook = '0';
                }
            }    
        }
        
        return $result;
    }
    

    function count($filter = NULL) {
        $user_id = $this->session->userdata('user_id');
        $where = "FIND_IN_SET('".$user_id."', assign_user) OR assign_user = 0"; 
        $this->db->where($where);
        if(!empty($filter['search'])) {
            $this->db->group_start();
            $this->db->or_like('book_shop.title', $filter['search'], 'both'); 
            $this->db->group_end();
        }
        return parent::count($filter);

    }
    
    function check_user($library_id){
        $query = "Select assign_user from library WHERE id = $library_id";

        $result = $this->db->query($query);
        $res=$result->result_array();

        return $res;
    }

    function my_all($filter = NULL, $order = NULL, $direction = 'asc', $fields = "*"){
        $user_id = $this->session->get_userdata()['user_id'];
        $this->db->join('my_books b', 'book_shop.id = b.bookshop_id', 'left');
        $this->db->where('b.user_id',$user_id);
        if(!empty($filter['search'])) {
            $this->db->group_start();
            $this->db->or_like('book_shop.title', $filter['search'], 'both');
            $this->db->group_end();
        }
        $result = parent::all($filter);
        foreach($result as $key => $val) {
        /*while(list($key,$val) = each($result)){*/
            $val->is_mybook = '0';
        }
        return $result;
    }

    function my_count($filter = NULL) {
        $user_id = $this->session->get_userdata()['user_id'];
        $this->db->join('my_books b', 'book_shop.id = b.bookshop_id', 'left');
        $this->db->where('b.user_id',$user_id);
        if(!empty($filter['search'])) {
            $this->db->group_start();
            $this->db->or_like('book_shop.title', $filter['search'], 'both');
            $this->db->group_end();
        }
        return parent::count($filter);

    }
    function select($id = null){
        $result = parent::select($id);
        $result->enrolls = count(json_decode($result->enroll_users));
        $instructors = json_decode($result->instructors);
        if(!empty($instructors)){
            $result->first_instructor = $this->db->where('id',$instructors[0])
                                                         ->where('user_type','instructor')
                                                         ->select('id,email,picture')
                                                         ->get($this->user_table)->row();
        }
        $user_id = $this->session->userdata('user_id');
        if(isset($user_id)){
                $count = $this->db->where('user_id',$user_id)
                                  ->where('bookshop_id',$result->id)
                                  ->count_all_results($this->my_books_table);
                if($count > 0){
                    $result->is_mybook = true;    
                }else{
                    $result->is_mybook = false;
                }
        }
        return $result;
    }
    function select_library($id = null){
        return $this->db->where('id',$id)->get($this->library_table)->row();
    }
    function purchase($id,$user_id,$order_id,$product_id){
        $this->db->where('user_id',$user_id);
        $this->db->where('bookshop_id',$id);
        $count = $this->db->count_all_results($this->my_books_table);
        if($count > 0){
            $data['type'] = 0;
            $data['msg'] = 'You have already purchased!';
        }else{
            $insert_data['reg_date'] = date("Y-m-d H:i:s");
            $insert_data['user_id'] = $user_id;
            $insert_data['bookshop_id'] = $id;
            $insert_data['order_id'] = $order_id;
            $insert_data['w_prod_id'] = $product_id;
            $this->db->insert($this->my_books_table, $insert_data);
            $id = $this->db->insert_id();
            if(isset($id)){
                $data['type'] = 1;
            }else{
                $data['type'] = 0;
                $data['msg'] = 'Failed!';
            }
            
        }
        return $data;
    }
    /*end front*/
    function pay_book($data){
      $user_id = $data['user_id'];
      $bookshop_id = $data['bookshop_id'];
      $this->db->where('user_id',$user_id);
        $this->db->where('bookshop_id',$bookshop_id);
        $count = $this->db->count_all_results($this->my_books_table);
        if($count > 0){
            $data['type'] = 0;
            $data['msg'] = 'You have already purchased!';
        }else{

        $data['reg_date'] = date("Y-m-d H:i:s");
        $rst = $this->db->insert("my_books", $data);
        $insert_id = $this->db->insert_id();
       
      }
     return $insert_id;
    }

    function getRow($id) {
        $this->db->select('*');
        $this->db->from("book_shop");
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row_array();
    }
}
