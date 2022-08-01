<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

include_once (APPPATH . '/libraries/BaseController.php');
// require APPPATH . '/third_party/PHPExcel.php';
require APPPATH . '/third_party/TCPDF-master/tcpdf.php';
include_once (APPPATH . '/third_party/iio/index.php');
/**
 * Created by PhpStorm.
 * User: Timon
 * Date: 2018-10-24
 * Time: PM 10:20
 */
class Library extends BaseController {
    /**
     * This is default constructor of the class
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Library_model');
        $this->load->model('Translate_model');
        $this->isLoggedIn();
    }
    /**
     * This function used to load the first screen of the user
     */
    public function index(){
        $this->library_view();
    }

    public function library_view($parent_id = 0){
        $this->load->library('Sidebar');
        if($this->isInstructor()){
            $side_params = array('selected_menu_id' => '2');
            $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
            $pageData['parent_id'] = $parent_id;
            $this->loadViews("instructor/library/library_list", $this->global, $pageData, NULL);
        }else{
            $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function create_contract($id = 0){
        $this->load->library('Sidebar');
        if($this->isInstructor()){
            $side_params = array('selected_menu_id' => '3');
            $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
            if($id == 0){
                $contract = "";
            }else{
                $contract = $this->Library_model->getList(array('id' => $id)) [0]['manual'];
            }
            $page_data['contract'] = $contract;
            $this->loadViews('instructor/library/create_contract', $this->global, $page_data, NULL);
        }else{
            $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function saveNewContract(){
        $user_id = $this->session->get_userdata() ['userId'];
        $company_id = $this->session->get_userdata() ['company_id'];
        $name = $this->input->post('title');
        $html = $this->input->post('content');
        $parent_id = $this->input->post('parent_id');
        $id = $this->input->post('id');
        $upload_path = sprintf('%sdirectory/%d/', PATH_UPLOAD, $user_id);
        if(!file_exists($upload_path)){
            $this->makeDirectory($upload_path);
        }
        $upload_path = $upload_path . $name;
        if(!file_exists($upload_path)){
            $insert_data['name'] = $name . '.pdf';
            $insert_data['file_type'] = 'manual';
            $insert_data['file_path'] = str_replace("./", "", $upload_path) . '.pdf';
            $insert_data['user_id'] = $user_id;
            $insert_data['create_id'] = $company_id;
            $insert_data['parent_id'] = $parent_id;
            $insert_data['manual'] = $html;
            $insert_data['manual_type'] = 1;
            $this->Library_model->insert($insert_data);
            $this->session->set_userdata('library_html', $html);
            $temp_name = time() . $user_id . ".html";
            file_put_contents(PATH_UPLOAD . $temp_name, $html);
            $command = 'wkhtmltopdf ' . base_url() . 'assets/uploads/' . $temp_name . ' "' . getcwd() . '/' . $insert_data['file_path'] . '"';
            if(strtolower(substr(PHP_OS, 0, 3)) == "win") chdir('C:\Program Files\wkhtmltopdf\bin');
            else $command = '/usr/local/bin/' . $command;
            shell_exec($command);
            unlink(PATH_UPLOAD . $temp_name);
            $data['failed_count'] = 0;
            $data['url'] = base_url() . "instructor/library";
            $this->response($data);
        }else{
            $data['failed_count'] = 1;
            $this->response($data);
        }
    }
    
    public function getPathById(){
        $id = $this->input->post('id');
        $table_data['data'] = $this->Library_model->getList(array('id' => $id));
        $path = '';
        foreach ($table_data['data'] as $key => $row){
            $path = $row['file_path'];
        }
        $this->response($path);
    }
    
    public function insert_doc(){
        $id1 = $this->input->post('id1');
        $id2 = $this->input->post('id2');
        for ($i = 0;$i < count($id2);$i++){
            $data['parent_id'] = $id1;
            $this->Library_model->update($data, array('id' => $id2[$i]));
        }
        return;
    }
    
    public function copy_doc(){
        $id1 = $this->input->post('id1');
        $id2 = $this->input->post('id2');
        for ($i = 0;$i < count($id2);$i++){
            $data = $this->Library_model->getList(array('id' => $id2[$i])) [0];
            $data['parent_id'] = $id1;
            unset($data['id']);
            unset($data['reg_date']);
            $this->Library_model->insert($data);
        }
        return;
    }
    
    public function getData(){
        $parent_id = $this->input->post('parent_id');
        // $table_data['data'] = $this->Library_model->getList(array('user_id' => $this->session->get_userdata() ['userId'], 'parent_id' => $parent_id));
        $table_data['data'] = $this->Library_model->getList(array('parent_id' => $parent_id));
        $table_data['recordsTotal'] = 0;
        $table_data['recordsFiltered'] = 0;
        foreach ($table_data['data'] as $key => $row){
            $table_data['data'][$key]["no"] = $key + 1;
            $table_data['data'][$key]["file_path"] = base_url() . $row['file_path'];
        }
        $table_data['recordsTotal'] = count($table_data['data']);
        $table_data['recordsFiltered'] = count($table_data['data']);
        $this->response($table_data);
    }
    
    public function createDirectory(){
        $user_id = $this->session->get_userdata() ['userId'];
        $company_id = $this->session->get_userdata() ['company_id'];
        $dir_name = $this->input->post('new_directory');
        $upload_path = sprintf('%sdirectory/%d/%s', PATH_UPLOAD, $user_id, $dir_name);
        if(!file_exists($upload_path)){
            $this->makeDirectory($upload_path);
        }
        $insert_data['name'] = $dir_name;
        $insert_data['file_type'] = 'DIRECTORY';
        $insert_data['file_path'] = $upload_path;
        $insert_data['user_id'] = $user_id;
        $insert_data['create_id'] = $company_id;
        $insert_data['parent_id'] = 0;
        $this->Library_model->insert($insert_data);
        $data['failed_count'] = 0;
        $this->response($data);
    }
    
    public function unsetShopping(){
        $id = $this->input->post('id');
        $data["is_shopping"] = 0;
        return $this->Library_model->update($data, array('id' => $id));
    }
    
    public function rename(){
        $id = $this->input->post('id');
        $data["name"] = $this->input->post('name');
        return $this->Library_model->update($data, array('id' => $id));
    }
    
    public function upload(){
        $insert_data = array();
        $user_id = $this->session->get_userdata() ['userId'];
        $company_id = $this->session->get_userdata() ['company_id'];
        $upload_path = sprintf('%sdirectory/%d/', PATH_UPLOAD, $user_id);
        if(!file_exists($upload_path)){
            $this->makeDirectory($upload_path);
        }
        $rslt = $this->doUpload('upload_file', $upload_path);
        if($rslt['possible'] == 1){
            $insert_data['file_path'] = str_replace("./", "", $rslt['path']);
        } else $insert_data['file_path'] = str_replace("./", "", $upload_path . 'default.png');
        $insert_data['name'] = $rslt['realName'];
        $insert_data['file_type'] = $rslt['file_type'];
        $insert_data['user_id'] = $user_id;
        $insert_data['create_id'] = $company_id;
        $insert_data['parent_id'] = $this->input->post('parent_id');
        $this->Library_model->insert($insert_data);
    }
    
    public function setShopping($id = 0){
        $this->load->library('Sidebar');
        $lang_ar = $this->Translate_model->getLanguageList(array('active_flag' => 1, 'add_flag' => 1));
        $page_data['lang_ar'] = $lang_ar['data'];
        $side_params = array('selected_menu_id' => '2');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        $page_path = "instructor/library/set_shopping";
        $user_data = $this->Library_model->getdataFromShop(array('library_id' => $id)) [0];
        if(isset($user_data)){
        }else{
            $user_data['id'] = 0;
            $user_data['library_id'] = $id;
            $user_data['title'] = '';
            $user_data['price'] = '';
            $user_data['description'] = '';
            $user_data['picture1'] = '';
            $user_data['picture2'] = '';
            $user_data['picture3'] = '';
            $user_data['picture4'] = '';
            $user_data['picture5'] = '';
        }
        $this->loadViews($page_path, $this->global, $user_data, NULL);
    }
    
    public function delete(){
        $id = $this->input->post("id");
        $this->Library_model->deleteshop(array('library_id' => $id));
        if($this->Library_model->delete(array('id' => $id))) $res['status'] = 'Success';
        else $res['status'] = 'Failed';
        return $res;
    }
    
    public function merge_doc(){
        $id_array = $this->input->post('merge_ids');
        $order_array = $this->input->post('merge_order');
        $merge_name = $this->input->post('merge_name');
        $user_id = $this->session->get_userdata() ['userId'];
        $insert_data = $this->Library_model->getList(array('id' => $id_array[0])) [0];
        $now = microtime(true); //date('Ymdhms');
        $realName = $merge_name . ".pdf";
        $tmpName = $now . ".pdf";
        $upload_path = sprintf('%sdirectory/%d/', PATH_UPLOAD, $user_id);
        if(!file_exists($upload_path)){
            $this->makeDirectory($upload_path);
        }
        $targetFile = $upload_path . $tmpName;
        $targetFile = str_replace("./", "", $targetFile);
        $path = getcwd() . "/";
        $path = str_replace("\\", "/", $path);
        $data_path = $path . $targetFile;
        $merge = new iio\libmergepdf\Merger(null, $data_path, 'F'); //D -download, I: open
        $ordered_ids = array();
        for ($i = 0;$i < count($id_array);$i++){
            for ($j = 0;$j < count($order_array);$j++){
                if($i + 1 == $order_array[$j]){
                    $ordered_ids[$i] = $id_array[$j];
                }
            }
        }
        for ($i = 0;$i < count($ordered_ids);$i++){
            $table_data = $this->Library_model->getList(array('id' => $ordered_ids[$i])) [0];
            $data_path = $path . $table_data['file_path'];
            $merge->addFile($data_path);
        }
        $res = null;
        $res = $merge->merge();
        unset($insert_data['id']);
        $insert_data['file_type'] = 'pdf';
        $insert_data['name'] = $realName;
        $insert_data['file_path'] = $targetFile;
        $this->Library_model->insert($insert_data);
        return $res;
    }
    
    public function set_price(){
        $insert_data = array();
        $upload_path = sprintf('%sbookshop/photo/', PATH_UPLOAD);
        if(!file_exists($upload_path)){
            $this->makeDirectory($upload_path);
        }
        $rslt = $this->doUpload('picture1', $upload_path);
        if($rslt['possible'] == 1){
            $insert_data['picture1'] = str_replace("./", "", $rslt['path']);
        } else $insert_data['picture1'] = str_replace("./", "", $upload_path . 'default.png');
        $rslt = $this->doUpload('picture2', $upload_path);
        if($rslt['possible'] == 1){
            $insert_data['picture2'] = str_replace("./", "", $rslt['path']);
        } else $insert_data['picture2'] = str_replace("./", "", $upload_path . 'default.png');
        $rslt = $this->doUpload('picture3', $upload_path);
        if($rslt['possible'] == 1){
            $insert_data['picture3'] = str_replace("./", "", $rslt['path']);
        } else $insert_data['picture3'] = str_replace("./", "", $upload_path . 'default.png');
        $rslt = $this->doUpload('picture4', $upload_path);
        if($rslt['possible'] == 1){
            $insert_data['picture4'] = str_replace("./", "", $rslt['path']);
        } else $insert_data['picture4'] = str_replace("./", "", $upload_path . 'default.png');
        $rslt = $this->doUpload('picture5', $upload_path);
        if($rslt['possible'] == 1){
            $insert_data['picture5'] = str_replace("./", "", $rslt['path']);
        } else $insert_data['picture5'] = str_replace("./", "", $upload_path . 'default.png');
        foreach ($this->input->post() as $key => $value){
            $insert_data[$key] = $value;
            if($this->input->post('assign_user')){
                $insert_data['assign_user'] = $this->input->post('assign_user');
            }else{
                $insert_data['assign_user'] = 0;
            }
        }
        unset($insert_data['id']);
        $id = $this->Library_model->insertshop($insert_data);
        $id = $this->input->post('library_id');
        $data["is_shopping"] = 1;
        return $this->Library_model->update($data, array('id' => $id));
    }
    
    public function update_price(){
        $insert_data = array();
        $id = $this->input->post("id");
        $upload_path = sprintf('%sbookshop/photo/', PATH_UPLOAD);
        if(!file_exists($upload_path)){
            $this->makeDirectory($upload_path);
        }
        $rslt = $this->doUpload('picture1', $upload_path);
        if($rslt['possible'] == 1){
            $insert_data['picture1'] = str_replace("./", "", $rslt['path']);
        } else $insert_data['picture1'] = str_replace("./", "", $upload_path . 'default.png');
        $rslt = $this->doUpload('picture2', $upload_path);
        if($rslt['possible'] == 1){
            $insert_data['picture2'] = str_replace("./", "", $rslt['path']);
        } else $insert_data['picture2'] = str_replace("./", "", $upload_path . 'default.png');
        $rslt = $this->doUpload('picture3', $upload_path);
        if($rslt['possible'] == 1){
            $insert_data['picture3'] = str_replace("./", "", $rslt['path']);
        } else $insert_data['picture3'] = str_replace("./", "", $upload_path . 'default.png');
        $rslt = $this->doUpload('picture4', $upload_path);
        if($rslt['possible'] == 1){
            $insert_data['picture4'] = str_replace("./", "", $rslt['path']);
        } else $insert_data['picture4'] = str_replace("./", "", $upload_path . 'default.png');
        $rslt = $this->doUpload('picture5', $upload_path);
        if($rslt['possible'] == 1){
            $insert_data['picture5'] = str_replace("./", "", $rslt['path']);
        } else $insert_data['picture5'] = str_replace("./", "", $upload_path . 'default.png');
        foreach ($this->input->post() as $key => $value){
            $insert_data[$key] = $value;
        }
        unset($insert_data['id']);
        $this->Library_model->updateshop($insert_data, array('id' => $id));
        $id = $this->input->post('library_id');
        $data["is_shopping"] = 1;
        return $this->Library_model->update($data, array('id' => $id));
    }
    
    public function create_manual($id = 0){
        if($id == 0){
            $page_data['content'] = "";
        }else{
            $data = $this->Library_model->getList(array('id' => $id)) [0];
            $page_data['content'] = str_replace("\n", "", $data['manual']);
        }
        $page_data['parent_id'] = 0;
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '2');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        $this->db->select('*');
        $blocks_category = $this->db->get('block_category')->result_array();
        $actual_link = site_url();
        $_outputHtml = '';
        for ($i = 0;$i < sizeof($blocks_category);$i++){
            $_outputHtml.= '<li class="elements-accordion-item" data-type="' . strtolower($blocks_category[$i]['name']) . '"><a class="elements-accordion-item-title">' . $blocks_category[$i]['name'] . '</a>';
            $_outputHtml.= '<div class="elements-accordion-item-content"><ul class="elements-list">';
            $this->db->where('cat_id', $blocks_category[$i]['id']);
            $_items = $blocks = $this->db->get('blocks')->result_array();
            for ($j = 0;$j < sizeof($_items);$j++){
                $_outputHtml.= '<li>' . '<div class="elements-list-item">' . '<div class="preview">' . '<div class="elements-item-icon">' . ' <i class="' . $_items[$j]['icon'] . '"></i>' . '</div>' . '<div class="elements-item-name">' . $_items[$j]['name'] . '</div>' . '</div>' . '<div class="view">' . '<div class="sortable-row">' . '<div class="sortable-row-container">' . ' <div class="sortable-row-actions">';
                $_outputHtml.= '<div class="row-move row-action">' . '<i class="fa fa-arrows-alt"></i>' . '</div>';
                $_outputHtml.= '<div class="row-remove row-action">' . '<i class="fa fa-remove"></i>' . '</div>';
                $_outputHtml.= '<div class="row-duplicate row-action">' . '<i class="fa fa-files-o"></i>' . '</div>';
                $_outputHtml.= '<div class="row-code row-action">' . '<i class="fa fa-code"></i>' . '</div>';
                $_outputHtml.= '</div>' . '<div class="sortable-row-content"  data-id="' . $_items[$j]['id'] . '" data-types="' . $_items[$j]['property'] . '"  data-last-type="' . explode(',', $_items[$j]['property']) [0] . '">' . str_replace('[site-url]', $actual_link, $_items[$j]['html']) . '</div>' . '</div>' . '</div>' . ' </div>' . '</div>' . '</li>';
            }
            $_outputHtml.= '</ul></div>';
            $_outputHtml.= '</li>';
        }
        $this->global['_outputHtml'] = $_outputHtml;
        $this->loadViews("instructor/library/create_manual", $this->global, $page_data, NULL);
    }
    
    public function create_manual_dir($id = 0){
        $page_data['content'] = "";
        $page_data['parent_id'] = $id;
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '2');
        $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
        $this->db->select('*');
        $blocks_category = $this->db->get('block_category')->result_array();
        $actual_link = site_url();
        $_outputHtml = '';
        for ($i = 0;$i < sizeof($blocks_category);$i++){
            $_outputHtml.= '<li class="elements-accordion-item" data-type="' . strtolower($blocks_category[$i]['name']) . '"><a class="elements-accordion-item-title">' . $blocks_category[$i]['name'] . '</a>';
            $_outputHtml.= '<div class="elements-accordion-item-content"><ul class="elements-list">';
            $this->db->where('cat_id', $blocks_category[$i]['id']);
            $_items = $blocks = $this->db->get('blocks')->result_array();
            for ($j = 0;$j < sizeof($_items);$j++){
                $_outputHtml.= '<li>' . '<div class="elements-list-item">' . '<div class="preview">' . '<div class="elements-item-icon">' . ' <i class="' . $_items[$j]['icon'] . '"></i>' . '</div>' . '<div class="elements-item-name">' . $_items[$j]['name'] . '</div>' . '</div>' . '<div class="view">' . '<div class="sortable-row">' . '<div class="sortable-row-container">' . ' <div class="sortable-row-actions">';
                $_outputHtml.= '<div class="row-move row-action">' . '<i class="fa fa-arrows-alt"></i>' . '</div>';
                $_outputHtml.= '<div class="row-remove row-action">' . '<i class="fa fa-remove"></i>' . '</div>';
                $_outputHtml.= '<div class="row-duplicate row-action">' . '<i class="fa fa-files-o"></i>' . '</div>';
                $_outputHtml.= '<div class="row-code row-action">' . '<i class="fa fa-code"></i>' . '</div>';
                $_outputHtml.= '</div>' . '<div class="sortable-row-content"  data-id="' . $_items[$j]['id'] . '" data-types="' . $_items[$j]['property'] . '"  data-last-type="' . explode(',', $_items[$j]['property']) [0] . '">' . str_replace('[site-url]', $actual_link, $_items[$j]['html']) . '</div>' . '</div>' . '</div>' . ' </div>' . '</div>' . '</li>';
            }
            $_outputHtml.= '</ul></div>';
            $_outputHtml.= '</li>';
        }
        $this->global['_outputHtml'] = $_outputHtml;
        $this->loadViews("instructor/library/create_manual", $this->global, $page_data, NULL);
    }
    
    public function upload_library_image(){
        $result = $this->doUpload('image', "./" . LIBRARY_IMG_PATH);
        if($result['possible'] == 1){
            $result['path'] = base_url() . "/" . LIBRARY_IMG_PATH . $result['tmpName'];
        }
        echo json_encode($result);
    }
    
    public function create_pdf(){
        $user_id = $this->session->get_userdata() ['userId'];
        $company_id = $this->session->get_userdata() ['company_id'];
        $name = $this->input->post('name');
        $html = $this->input->post('html');
        $parent_id = $this->input->post('parent_id');
        $upload_path = sprintf('%sdirectory/%d/', PATH_UPLOAD, $user_id);
        if(!file_exists($upload_path)){
            $this->makeDirectory($upload_path);
        }
        $upload_path = $upload_path . $name;
        if(!file_exists($upload_path)){
            $insert_data['name'] = $name . '.pdf';
            $insert_data['file_type'] = 'manual';
            $insert_data['file_path'] = str_replace("./", "", $upload_path) . '.pdf';
            $insert_data['user_id'] = $user_id;
            $insert_data['create_id'] = $company_id;
            $insert_data['parent_id'] = $parent_id;
            $insert_data['manual'] = $html;
            $insert_data['manual_type'] = 0;
            $this->Library_model->insert($insert_data);
            $this->session->set_userdata('library_html', $html);
            $temp_name = time() . $user_id . ".html";
            file_put_contents(PATH_UPLOAD . $temp_name, $html);
            $command = 'wkhtmltopdf ' . base_url() . 'assets/uploads/' . $temp_name . ' "' . getcwd() . '/' . $insert_data['file_path'] . '"';
            if(strtolower(substr(PHP_OS, 0, 3)) == "win") chdir('C:\Program Files\wkhtmltopdf\bin');
            else $command = '/usr/local/bin/' . $command;
            shell_exec($command);
            unlink(PATH_UPLOAD . $temp_name);
            $data['failed_count'] = 0;
            $data['url'] = base_url() . "instructor/library";
            $this->response($data);
        }else{
            $data['failed_count'] = 1;
            $this->response($data);
        }
    }
    
    public function assign_user(){
        $file = $this->input->post('file_id');
        $user = $this->input->post('user[]');
        $user_data = implode(',', $user);
        $file_data = explode(',', $file);
        $data = array('assign_user' => $user_data);
        foreach ($file_data as $res){
            $this->Library_model->update($data, array('id' => $res));
            redirect(base_url() . "instructor/library");
        }
    }

}
