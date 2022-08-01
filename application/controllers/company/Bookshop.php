<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

// require APPPATH . 'third_party/woocommerce/autoload.php';

// use Automattic\WooCommerce\Client;

// use Automattic\WooCommerce\HttpClient\HttpClientException;


require APPPATH . '/libraries/BaseController.php';
class Bookshop  extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->model('User_model');
        $this->load->model('Settings_model');
        $this->load->model('Translate_model');
        $this->load->model('Bookshop_model');
        $this->load->helper(array('cookie', 'string', 'language', 'url'));
        $this->load->helper('lms_email');
        $this->load->library('encryption');

        // $this->woocommerce = new Client(
        //     'https://shop.gosmartacademy.com/', 
        //     'ck_b6411a22ed11f224a13d68bc2bb642a4227b69c3', 
        //     'cs_ae6ff61f63bed83c2d2e1880b1634449f30a2c04',
        //     [
        //         'version' => 'wc/v3',
        //     ]
        // );
    }

    public function index()
    {
        $this->showAll();
    }

    public function showAll(){
        $params['menu_name'] = 'catalog';
        $params["term"] = $this->term;
        $params['company'] = $this->company;

        /*pagenation*/
        $displayLength = 3;
        $search = $this->input->get('sSearch');
        $start = $this->input->get('per_page');
        if (!isset($start)) {
            $start = 0;
        }
        $filter['start'] = $start;
        $filter['limit'] = $displayLength;
        $filter['search'] = $search;
        $params['courses'] = $this->Bookshop_model->all($filter);
        unset($filter['start']);
        unset($filter['limit']);
        $params['iTotalRecords'] = $this->Bookshop_model->count($filter); 
        $params['sEcho'] = $search;

        $this->load->library('pagination');
        $config['base_url'] = site_url($this->company['company_url'].'/bookshop/?sSearch='.$search);
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $params['iTotalRecords'];
        $config['per_page'] = $displayLength;
        $config['num_links'] = 2;
        $config['uri_segment'] = 3;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&rarr;';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&larr;';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $params['links'] = $this->pagination->create_links();
        /*end*/
        $this->loadViews_front('company_page/book-shop', $params);
    }

 public function decryptData($data) {
        // Store the cipher method
        $ciphering = "AES-128-CTR";

        // Use OpenSSl Encryption method
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;

        // Non-NULL Initialization Vector for encryption
        $decryption_iv = '1234567891011121';

        $decryption_key = "---gosm@rtac@demy2020---";

        // Use openssl_decrypt() function to decrypt the data
        $decryption=openssl_decrypt ($encryption, $ciphering,
        $decryption_key, $options, $decryption_iv);

        return $decryption;
  }
    public function view($url = NULL, $id = NULL){

        $params['menu_name'] = 'catalog';
        $params["term"] = $this->term;
        $params['company'] = $this->company;
        
        $user_id = $this->session->userdata('user_id');
        if(!empty($params1   = $_GET['token'])){
        $data = base64_decode($params1);
        $finalData = json_decode($data);
        $order_id = $finalData->order_id;
        $product_id = $finalData->product_id;
        $bookshop_id    = $finalData->bookshop_id;
        $data = $this->Bookshop_model->purchase($bookshop_id, $user_id,$order_id,$product_id);
        $course = $this->Bookshop_model->select($id);
        $params['course'] = $course;
        $this->loadViews_front('company_page/book-shop-details', $params);
         }else{
        $course = $this->Bookshop_model->select($id);
        $params['course'] = $course;
        $this->loadViews_front('company_page/book-shop-details', $params);
         }


    }

   
    public function detail($url = NULL, $id = NULL){
        $params['menu_name'] = 'catalog';
        /**/
    }
    public function pay($url = NULL, $id = NULL){
        $user_id = $this->session->userdata('user_id');
        $book_id = $id;
        $data = $this->Bookshop_model->purchase($book_id, $user_id);
        $this->output
        ->set_status_header(200)
        ->set_content_type('application/json', 'utf-8')
        ->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
        ->_display();
        exit();
    }
    public function viewbook($url = NULL, $id = NULL){
        $params['menu_name'] = 'catalog';
        $params["term"] = $this->term;
        $params['company'] = $this->company;
        $book = $this->Bookshop_model->select_library($id);
        $params['book'] = $book;
        $this->loadViews_front('company_page/details-books', $params);
    }

      public function getBookOrder(){
       /* $results = $this->woocommerce->get('orders');
        echo "<pre>";
        print_r($results);
        echo "</pre>";
        foreach($results as $details){
        echo "<tr><td>" . $details->id."</td>
                 <td>" . $details->billing->first_name.$details->billing->last_name."</td>              
                 <td>" . $details->meta_data[1]->value.$details->line_items[0]->name.$details->line_items[0]->product_id."</td>
                 ";
        }*/

       
             /*  email

            [payment_method]
            [payment_method_title]
            [transaction_id] 
            [date_paid] 
            [date_paid_gmt] 
            [date_completed] 
            [date_completed_gmt]
            [cart_hash] 
            [meta_data] =>1=>value

            line_items[0]
                         [name] 
                            [product_id]
           */
              
    }
}