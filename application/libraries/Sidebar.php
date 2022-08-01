<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * Custom SideBar Class
 *
 * Create Custom SideBar
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ping
 * 
 */
class Sidebar {

	public $sidemenu_superadmin = array();

	public $sidemenu_admin = array();

    public $sidemenu_instructor = array();

    public $sidemenu_learner = array();

    public function __construct()
    {

       $CI =& get_instance();

        $isLoggedIn = $CI->session->userdata('isLoggedIn');
      if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
      {

      }
      else
      {
          $CI->load->model('User_model');
          $userid = $CI->session->userdata('userId');

          $user = $CI->User_model->getRow('id='.$userid);
          $lang = $user->language;
      }

      if (!$lang) $lang = DEFAULT_LANG;

      $where['lang_code'] = $lang;
      $CI->load->model('Translate_model');
      $lang_data = $CI->Translate_model->getLanguageList($where)['data'][0];

      $field_term = 'term';	$field_lang_user = $lang_data['field_name'];
      $data_rows = $CI->Translate_model->getTermList($field_term, $field_lang_user);

      $this->term = array();
      foreach($data_rows['data'] as $key => $value){
          $this->term[$value[$field_term]] = $value[$field_lang_user];
      }

        $this->sidemenu_superadmin = array(
            array( 'id'=>'1', 'level'=>1, 'label'=>$this->term['dashboard'], 'href'=>'superadmin/home', 'icon'=>'fa-home',
                'submenu'=>array()
            ),
            array( 'id'=>'2', 'level'=>1, 'label'=>$this->term['usermanagement'], 'href'=>'superadmin/user/', 'icon'=>'fa-users',
                'submenu'=>array()
            ),
   /*         array( 'id'=>'3', 'level'=>1, 'label'=>$this->term['paymenthistory'], 'href'=>'superadmin/account/payment', 'icon'=>'fa-money-bill',
                'submenu'=>array()
            ),*/
            array( 'id'=>'4', 'level'=>1, 'label'=>$this->term['subscriptionmanagement'], 'href'=>'superadmin/account/subscription', 'icon'=>'fa-cogs',
                'submenu'=>array()
            ),
/*            array( 'id'=>'5', 'level'=>1, 'label'=>$this->term['accounting'], 'href'=>'superadmin/account', 'icon'=>'fa-university',
                'submenu'=>array()
            ),*/
            array( 'id'=>'6', 'level'=>1, 'label'=>$this->term['companymanagement'], 'href'=>'superadmin/company', 'icon'=>'fa-database',
                'submenu'=>array()
            ),
            array('id'=>'14', 'level'=>1, 'label'=>$this->term['emailtemplatesetting'], 'href'=>'admin/settings/emailtemp', 'icon'=>'fa-cogs',
                'submenu'=>array()
            ),
			array(
                'id' => '15',
                'level' => 1,
                'label' => 'Settings',
                'href' => 'admin/settings/site_configuration',
                'icon' => 'fa-cog',
                'submenu' => array()
            ),

        );

        $this->sidemenu_admin = array(
            array( 'id'=>'1', 'level'=>1, 'label'=>$this->term['dashboard'], 'href'=>'admin/home', 'icon'=>'fa-home',
                'submenu'=>array()
            ),
            array( 'id'=>'2', 'level'=>1, 'label'=>$this->term['usermanagement'], 'href'=>'admin/user/admin', 'icon'=>'fa-users',
                'submenu'=>array()
            ),
            array( 'id'=>'3', 'level'=>1, 'label'=>$this->term['library'], 'href'=>'admin/library', 'icon'=>'fa-database',
                'submenu'=>array()
            ),
            array( 'id'=>'055', 'level'=>1, 'label'=>'Videos', 'href'=>'admin/video', 'icon'=>'fa-video',
                'submenu'=>array()
            ),
            array( 'id'=>'065', 'level'=>1, 'label'=>'Articles', 'href'=>'admin/article', 'icon'=>'fa-file-image',
                'submenu'=>array()
            ),
            array( 'id'=>'14', 'level'=>1, 'label'=>'Quiz', 'href'=>'#', 'icon'=>'fa-envelope',
                'submenu'=>array(
                    array('id'=>'14-1', 'level'=>2, 'label'=>'Quiz List', 'href'=>'admin/exam/viewQuizList', 'icon'=>''),
                    array('id'=>'14-2', 'level'=>2, 'label'=>'Quiz Group List', 'href'=>'admin/exam/viewQuizGroupList', 'icon'=>''),
                    /*array('id'=>'14-3', 'level'=>2, 'label'=>'Quiz History', 'href'=>'admin/exam/viewQuizHistory', 'icon'=>''),*/
                )
            ),
            array( 'id'=>'155', 'level'=>1, 'label'=>"Course Locations", 'href'=>'admin/location', 'icon'=>'fa-database',
                'submenu'=>array()
            ),
            array( 'id'=>'44', 'level'=>1, 'label'=>$this->term['exam'], 'href'=>'#', 'icon'=>'fa-plane',
                'submenu'=>array(
                    array('id'=>'44-1', 'level'=>2, 'label'=>$this->term['examlist'], 'href'=>'admin/exam', 'icon'=>''),
                    array('id'=>'44-2', 'level'=>2, 'label'=>$this->term['examhistory'], 'href'=>'admin/examhistory/viewexam', 'icon'=>''),
                )
            ),
            array('id'=>'5', 'level'=>1, 'label'=>$this->term['ondemand'], 'href'=>'admin/demand/getList', 'icon'=>'fa-file-image',
                'submenu'=>array()
            ),
			array(
                'id' => '13',
                'level' => 1,
                'label' => 'Courses Creation',
                'href' => 'admin/coursecreation/getList',
                'icon' => 'fa-file-image',
                'submenu' => array()
            ),
            array('id'=>'6', 'level'=>1, 'label'=>$this->term['instructorledtraining'], 'href'=>'admin/training', 'icon'=>'fa-building',
                'submenu'=>array()
            ),			
            array('id'=>'7', 'level'=>1, 'label'=>'Virtual Instructor Led Training', 'href'=>'admin/live', 'icon'=>'fa-file-image',
                'submenu'=>array()
            ),
			array(
                'id' => '99',
                'level' => 1,
                'label' => 'Evening Work & Excercise',
                'href' => 'admin/eveningwrkexcercise',
                'icon' => 'fa-file-image',
                'submenu' => array()
            ) ,
			array( 'id'=>'004', 'level'=>1, 'label'=>'Scheduler', 'href'=>'#', 'icon'=>'fa-plane',
                'submenu'=>array(
                    array('id'=>'004-1', 'level'=>2, 'label'=>'Course', 'href'=>'scheduler/course', 'icon'=>''),
                    array('id'=>'004-2', 'level'=>2, 'label'=>'Exam', 'href'=>'scheduler/exam', 'icon'=>''),
                )
            ),
            array('id'=>'8', 'level'=>1, 'label'=>$this->term['inbox'], 'href'=>'admin/message', 'icon'=>'fa-envelope',
                'submenu'=>array()
            ),
            array('id'=>'15', 'level'=>1, 'label'=>$this->term['category'], 'href'=>'admin/category', 'icon'=>'fa-database',
                'submenu'=>array()
            ),
            array('id'=>'17', 'level'=>1, 'label'=>$this->term['emailtemplatesetting'], 'href'=>'admin/settings/emailtemp', 'icon'=>'fa-cogs',
                'submenu'=>array()
            ),
/*            array('id'=>'10', 'level'=>1, 'label'=>$this->term['paymenthistory'], 'href'=>'admin/account/payment', 'icon'=>'fa-money-bill',
                'submenu'=>array()
            ),*/
/*            array('id'=>'11', 'level'=>1, 'label'=>$this->term['subscriptionmanagement'], 'href'=>'admin/account/subscription', 'icon'=>'fa-cogs',
                'submenu'=>array()
            ),*/
            array('id'=>'12', 'level'=>1, 'label'=>$this->term['certification'], 'href'=>'admin/settings/certificate', 'icon'=>'fa-certificate',
                'submenu'=>array()
            ),
/*            array('id'=>'13', 'level'=>1, 'label'=>$this->term['accounting'], 'href'=>'admin/account', 'icon'=>'fa-university',
                'submenu'=>array()
            ),*/
			array(
                'id' => '16',
                'level' => 1,
                'label' => 'Enrollment Courses',
                'href' => 'admin/examhistory/enrolledcourse',
                'icon' => 'fa-certificate',
                'submenu' => array()
            ) ,
			
			array(
                'id' => '18',
                'level' => 1,
                'label' => 'Settings',
                'href' => 'admin/settings/site_configuration',
                'icon' => 'fa-cog',
                'submenu' => array()
            ),

        );

        $this->sidemenu_instructor = array(
            array( 'id'=>'1', 'level'=>1, 'label'=>$this->term['dashboard'], 'href'=>'instructor/home', 'icon'=>'fa-home',
                'submenu'=>array()
            ),
            array( 'id'=>'2', 'level'=>1, 'label'=>$this->term['library'], 'href'=>'instructor/library', 'icon'=>'fa-database',
                'submenu'=>array()
            ),
            array( 'id'=>'055', 'level'=>1, 'label'=>'Videos', 'href'=>'admin/video', 'icon'=>'fa-video',
                'submenu'=>array()
            ),
            array( 'id'=>'065', 'level'=>1, 'label'=>'Articles', 'href'=>'admin/article', 'icon'=>'fa-file-image',
                'submenu'=>array()
            ),
            array( 'id'=>'11', 'level'=>1, 'label'=>'Quiz', 'href'=>'#', 'icon'=>'fa-envelope',
                'submenu'=>array(
                    array('id'=>'11-1', 'level'=>2, 'label'=>'Quiz List', 'href'=>'instructor/exam/viewQuizList', 'icon'=>''),
                    array('id'=>'11-2', 'level'=>2, 'label'=>'Quiz Group List', 'href'=>'instructor/exam/viewQuizGroupList', 'icon'=>''),
                    /*array('id'=>'11-3', 'level'=>2, 'label'=>'Quiz History', 'href'=>'instructor/exam/viewQuizHistory', 'icon'=>''),*/
                )
            ),
            array( 'id'=>'3', 'level'=>1, 'label'=>$this->term['exam'], 'href'=>'#', 'icon'=>'fa-plane',
                'submenu'=>array(
                    array('id'=>'3-1', 'level'=>2, 'label'=>$this->term['examlist'], 'href'=>'instructor/exam', 'icon'=>''),
                    array('id'=>'3-2', 'level'=>2, 'label'=>$this->term['examhistory'], 'href'=>'instructor/examhistory/viewexam', 'icon'=>''),
                )
            ),
			array( 'id'=>'13', 'level'=>1, 'label'=>"Course Locations", 'href'=>'instructor/location', 'icon'=>'fa-database',
                'submenu'=>array()
            ),
            array('id'=>'4', 'level'=>1, 'label'=>$this->term['ondemand'], 'href'=>'instructor/demand/getList', 'icon'=>'fa-file-image',
                'submenu'=>array()
            ),
			array('id'=>'39', 'level'=>1, 'label'=>'Course Creation', 'href'=>'instructor/coursecreation/getList', 'icon'=>'fa-save',
                'submenu'=>array()
            ),
            array('id'=>'5', 'level'=>1, 'label'=>$this->term['instructorledtraining'], 'href'=>'instructor/training', 'icon'=>'fa-building',
                'submenu'=>array()
            ),
            array('id'=>'6', 'level'=>1, 'label'=>'Virtual Instructor Led Training', 'href'=>'instructor/live', 'icon'=>'fa-file-image',
                'submenu'=>array()
            ),
			array(
                'id' => '14',
                'level' => 1,
                'label' => 'Evening Work & Excercise',
                'href' => 'instructor/eveningwrk',
                'icon' => 'fa-envelope',
                'submenu' => array()
            ) ,
            array('id'=>'7', 'level'=>1, 'label'=>$this->term['inbox'], 'href'=>'instructor/message', 'icon'=>'fa-envelope',
                'submenu'=>array()
            ),
            /*
            array('id'=>'8', 'level'=>1, 'label'=>$this->term['accounting'], 'href'=>'instructor/account', 'icon'=>'fa-university',
                'submenu'=>array()
            ),*/
            array('id'=>'10', 'level'=>1, 'label'=>$this->term['category'], 'href'=>'instructor/category', 'icon'=>'fa-database',
                'submenu'=>array()
            ),
			array('id'=>'15', 'level'=>1, 'label'=>$this->term['certification'], 'href'=>'instructor/settings/certificate', 'icon'=>'fa-certificate',
                'submenu'=>array()
            ),
			array(
                'id' => '12',
                'level' => 1,
                'label' => 'Enrollment Courses',
                'href' => 'instructor/examhistory/enrolledcourse',
                'icon' => 'fa-certificate',
                'submenu' => array()
            ),

        );

        $this->sidemenu_learner = array(
            array( 'id'=>'1', 'level'=>1, 'label'=>$this->term['dashboard'], 'href'=>'learner/home', 'icon'=>'fa-home',
                'submenu'=>array()
            ),
            array( 'id'=>'2', 'level'=>1, 'label'=>$this->term['examhistory'], 'href'=>'learner/examhistory/viewexam', 'icon'=>'fa-plane',
                'submenu'=>array()
            ),
            array( 'id'=>'3', 'level'=>1, 'label'=>$this->term['coursehistory'], 'href'=>'learner/demand/viewCourseHistory', 'icon'=>'fa-database',
                'submenu'=>array()
            ),
            array( 'id'=>'4', 'level'=>1, 'label'=>$this->term['ondemand'], 'href'=>'learner/demand', 'icon'=>'fa-file-image',
                'submenu'=>array()
            ),
            array( 'id'=>'5', 'level'=>1, 'label'=>$this->term['instructorledtraining'], 'href'=>'learner/training', 'icon'=>'fa-building',
                'submenu'=>array()
            ),
            // array( 'id'=>'5', 'level'=>1, 'label'=>$this->term['instructorledtraining'], 'href'=>'learner/training/getTraining', 'icon'=>'fa-building',
            //     'submenu'=>array()
            // ),
            array('id'=>'6', 'level'=>1, 'label'=>'Virtual Instructor Led Training', 'href'=>'learner/live', 'icon'=>'fa-file-image',
                'submenu'=>array()
            ),
            array('id'=>'7', 'level'=>1, 'label'=>$this->term['bookshop'], 'href'=>'learner/bookshop', 'icon'=>'fa-database',//bookshop/getAll
                'submenu'=>array()
            ),
            array('id'=>'8', 'level'=>1, 'label'=>$this->term['mybooks'], 'href'=>'learner/bookshop/mybooks', 'icon'=>'fa-save', //bookshop/myBooks
                'submenu'=>array()
            ),
     /*       array('id'=>'12', 'level'=>1, 'label'=>$this->term['paymenthistory'], 'href'=>'learner/account/payment', 'icon'=>'fa-money-bill',
                'submenu'=>array()
            ),*/
            array('id'=>'10', 'level'=>1, 'label'=>$this->term['inbox'], 'href'=>'learner/message', 'icon'=>'fa-envelope',
                'submenu'=>array()
            ),
			array(
                'id' => '11',
                'level' => 1,
                'label' => 'Evening Work & Excercise',
                'href' => 'learner/eveningwrkexcercise',
                'icon' => 'fa-envelope',
                'submenu' => array()
            ) ,
      /*      array('id'=>'11', 'level'=>1, 'label'=>$this->term['accounting'], 'href'=>'learner/account', 'icon'=>'fa-university',
                'submenu'=>array()
            ),*/
        );

    }

    public function generate($params = NULL, $user_role='')
	{

		$menu_data = array();
		switch($user_role) {
			case ROLE_SUPERADMIN: {
					$menu_data = $this->sidemenu_superadmin;
				} break;
			case ROLE_ADMIN: {
					$menu_data = $this->sidemenu_admin; 
				} break;
			case ROLE_INSTRUCTOR: {
					$menu_data = $this->sidemenu_instructor; 
				} break;
			case ROLE_LEARNER: {
					$menu_data = $this->sidemenu_learner;
				} break;
			default : 
				$menu_data = $this->sidemenu_learner;
		}
		

		$str_sidemenu = '<ul class="nav nav-main">';
		//echo '<pre>';print_r($menu_data);echo '</pre>';
		foreach ($menu_data as $mainkey => $mainmenu) {
			$li_class = "";	
			if($mainmenu['id'] != 9) {
				if(is_array($mainmenu['submenu']) && count($mainmenu['submenu'])>0 )
					$li_class = "nav-parent";
				
				if($params != NULL) {
					list($selected_menu_id, $submenu_ids) = explode('-', $params['selected_menu_id'], 2);
					if($mainmenu['id'] == $selected_menu_id) {
						$li_class .= " nav-expanded nav-active";
					}
				}
				
				if(empty($li_class)) {
					$str_sidemenu .= '<li>';
				} else {
					$str_sidemenu .= sprintf('<li class="%s">', $li_class);
				}
				$str_sidemenu .= sprintf('
						<a href="%s" class="nav-link">
							<i class="fas %s" aria-hidden="true"></i>
							<span >%s</span>
						</a>', $mainmenu['href']=="#"?$mainmenu['href']:base_url().$mainmenu['href'], $mainmenu['icon'], $mainmenu['label']);
				
				if(is_array($mainmenu['submenu']) && count($mainmenu['submenu'])>0 )
					$str_sidemenu .= $this->generate_submenu($mainmenu, $params['selected_menu_id']);
					
				$str_sidemenu .= '</li>';
			}
			else {
				if(empty($li_class)) {
					$str_sidemenu .= '<li>';
				} else {
					$str_sidemenu .= sprintf('<li class="%s">', $li_class);
				}
				$str_sidemenu .= sprintf('
						<a href="%s" class="nav-link">
							<i class="fas %s" aria-hidden="true"></i>
							<span >%s</span>
						</a>', $mainmenu['href']=="#"?$mainmenu['href']:base_url().$mainmenu['href'], $mainmenu['icon'], $mainmenu['label']);
				
				if(is_array($mainmenu['submenu']) && count($mainmenu['submenu'])>0 )
					$str_sidemenu .= $this->generate_submenu($mainmenu, $params['selected_menu_id']);
					
				$str_sidemenu .= '</li>';
			}
		}
		$str_sidemenu .= '</ul>';
		

		return $str_sidemenu;
	}

    public function generate_submenu($menu, $params, $menulevel=2)
    {
        $str_menu = '';
        $sub_li_class = '';
        $active = '';
        if(is_array($menu['submenu']) && count($menu['submenu'])>0 ) {
            $str_menu .= '<ul class="nav nav-children">';

            foreach ($menu['submenu'] as $subkey => $submenu) {

                $arr_submenu_data = '';
                if (isset($submenu['submenu'])) {
                    $arr_submenu_data = $this->generate_submenu($submenu, $params, $menulevel+1);
                }

                $sub_li_class = isset($submenu['class'])?$submenu['class']:'';
                $list_menu_ids = explode('-', $params, $menulevel+1);

                if(isset($submenu['submenu']) && is_array($submenu['submenu']) && count($submenu['submenu'])>0 )
                    $sub_li_class .= " nav-parent";

                if($submenu['id'] == implode('-', array_slice($list_menu_ids, 0, $menulevel))) {
                    $sub_li_class .= " nav-expanded nav-active";
                }

                $str_menu .= sprintf('<li class="%s">
							<a href="%s" class="nav-link">%s</a>', $sub_li_class, $submenu['href']=='#'?$submenu['href']:base_url().$submenu['href'], $submenu['label']);

                if (isset($arr_submenu_data)) {
                    $str_menu .= $arr_submenu_data;
                }
                $str_menu .='</li>';
            }
            $str_menu .= '</ul>';
        }

        $str_menu .= '</li>';

        return $str_menu;
    }
}
