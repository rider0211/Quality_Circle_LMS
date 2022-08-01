<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = "welcome";
$route['landing'] = "welcome/landing";
$route['about'] = "welcome/about";
$route['landing2'] = "welcome/landing2";
$route['404_override'] = 'welcome/error404';
$route['translate_uri_dashes'] = FALSE;

$route['mautics'] = "mautic/index";

$route['login'] = "login";
$route['loginuser'] = "login/loginUser";
$route['signup'] = "login/signup";
$route['logout'] = "login/logout";
$route['validuser'] = "login/validuser";
$route['otp-login/(:any)'] = "login/otpLogin/$1";
$route['forgotPassword'] = "login/recoverPassword";
$route['checkemail'] = "login/confirmEmail";
$route['resetPasswordConfirmUser'] = "login/resetPasswordConfirmUser";
$route['resetPasswordConfirmUser/(:any)'] = "login/resetPasswordConfirmUser/$1";


$route['loglock'] = "login/lockUser";

$route['sendEmail'] = "login/sendEmail";
$route['resetPass'] = "login/resetPassword";
$route['updatePass'] = "login/updatePassword";
$route['profile'] = "login/showProfile";

$route['home'] = "welcome";
$route['welcome/verifyEmail/(:any)'] = 'welcome/verifyEmail/$1';


$route['save_stripe_response/(:any)/(:any)'] = "mautics/saveStripeResponse/$1/$2";


/*
*Front 
*/
//log
$route['company/(:any)/login'] = "company/login";
$route['company/(:any)/loginuser'] = "company/login/loginUser/$1";
$route['company/(:any)/signup'] = "company/login/signup/$1";
$route['company/(:any)/logout'] = "company/login/logout/$1";

$route['company/(:any)'] = "company/home/index/$1";


$route['company/(:any)/about'] = "company/about/index/$1";
//demand
$route['company/(:any)/demand'] = "company/demand/index/$1";
$route['company/(:any)/demand/view/(:num)'] = "company/demand/view/$1/$2";
$route['company/(:any)/demand/detail/(:num)'] = "company/demand/detail/$1/$2";
$route['company/(:any)/demand/save_signature'] = "company/demand/save_signature";
$route['company/(:any)/demand/examInstruction/(:num)/(:num)'] = "company/demand/examInstruction/$2/$3";
$route['company/(:any)/demand/showPreviewQuestion/(:num)'] = "company/demand/showPreviewQuestion/$2";
$route['company/(:any)/demand/examResult/(:num)'] = "company/demand/examResult/$2";
$route['company/(:any)/demand/reportCard/(:num)'] = "company/demand/reportCard/$2";
$route['company/(:any)/demand/saveUserAnswers'] = "company/demand/saveUserAnswers";
$route['company/(:any)/demand/setSelfPace'] = "company/demand/setSelfPace";
$route['company/(:any)/demand/showCourse'] = "company/demand/showCourse";

$route['company/(:any)/demand/restartCourse'] = "company/demand/restartCourse";
$route['company/(:any)/demand/view_QuizGroup/(:any)/(:any)'] = "company/demand/view_QuizGroup/$2/$3";
$route['company/(:any)/demand/saveQuesResult'] = "company/demand/saveQuesResult";
$route['company/(:any)/demand/checkExamExist'] = "company/demand/checkExamExist";
$route['company/(:any)/demand/checkQuizExist'] = "company/demand/checkQuizExist";
$route['company/(:any)/demand/checkAssessment'] = "company/demand/checkAssessment";
$route['company/(:any)/demand/show_exam_feedback/(:num)/(:num)'] = "company/demand/show_exam_feedback/$2/$3";
$route['company/(:any)/demand/view_Quiz/(:num)'] = "company/demand/view_Quiz/$2";

$route['company/(:any)/demand/save_exam_feedback'] = "company/demand/save_exam_feedback";
$route['company/(:any)/demand/save_quiz_ans'] = "company/demand/save_quiz_ans";

$route['company/(:any)/demand/showCourseByCategory/(:num)'] = "company/demand/showCourseByCategory/$2";
//virtual classes
$route['company/(:any)/classes'] = "company/classes/index/$1";
// Training Calendar
$route['company/(:any)/calendar'] = "company/calendar/index/$1";

$route['company/(:any)/calendar/showTraining/(:num)'] = "company/calendar/index/$1";

$route['company/(:any)/classes/view/(:num)'] = "company/classes/view/$1/$2";
$route['company/(:any)/classes/detail/(:num)'] = "company/classes/detail/$1/$2";
//training classes
$route['company/(:any)/training'] = "company/training/index/$1";
$route['company/(:any)/training/view/(:num)'] = "company/training/view/$1/$2";
$route['company/(:any)/training/detail/(:num)'] = "company/training/detail/$1/$2";
$route['company/(:any)/training/pay/(:num)'] = "company/training/pay/$1/$2";
//book
$route['company/(:any)/bookshop'] = "company/bookshop/index/$1";
$route['company/(:any)/bookshop/view/(:num)'] = "company/bookshop/view/$1/$2";
$route['company/(:any)/bookshop/detail/(:num)'] = "company/bookshop/detail/$1/$2";
$route['company/(:any)/bookshop/pay/(:num)'] = "company/bookshop/pay/$1/$2";
$route['company/(:any)/bookshop/viewbook/(:num)'] = "company/bookshop/viewbook/$1/$2";
$route['company/(:any)/bookshop/getBookOrder'] = "company/bookshop/getBookOrder";
/*
 * Admin 
 */

$route['admin'] = "admin/welcome/home";
$route['admin/home'] = "admin/welcome/home";
$route['admin/settings/theme'] = "admin/settings/theme_view";
$route['admin/settings/menu'] = "admin/settings/menu_view";
$route['admin/settings/getmenu'] = "admin/settings/get_Menu";
$route['admin/settings/savetheme'] = "admin/settings/save_theme";
$route['admin/settings/emailtemp'] = "admin/settings/emailtemp_view";
$route['admin/settings/saveemailtemp'] = "admin/settings/save_emailtemp";
$route['admin/settings/smstemp'] = "admin/settings/smstemp_view";
$route['admin/settings/savesmstemp'] = "admin/settings/save_smstemp";

$route['admin/settings/certificate'] = "admin/settings/certificate_view";
$route['admin/settings/certificatechange'] = "admin/settings/certificate_update";
$route['admin/settings/certificateadd'] = "admin/settings/certificate_insert";
$route['admin/settings/certificatedelete'] = "admin/settings/certificate_delete";
$route['admin/settings/getcertificate'] = "admin/settings/get_certificate";
$route['admin/settings/certificateview'] = "admin/settings/certificate_edit_view";
$route['admin/settings/certificateview/(:num)'] = "admin/settings/certificate_edit_view/$1";
$route['admin/settings/savegeneral'] = "admin/settings/save_general";
$route['admin/settings/general_view'] = "admin/settings/general_view";
$route['admin/settings/translations'] = "admin/settings/trans_lang_view";

/* Demand Cron Url */ 
$route['cronJob'] = "admin/demand/cronCourseCreateEmail";

/* Category */
$route['admin/category'] = "admin/category";
$route['admin/category/getlist'] = "admin/category/getList";
$route['admin/category/getcategorylist'] = "admin/category/getCategoryList";
$route['admin/category/create'] = "admin/category/viewCreate";
$route['admin/category/add'] = "admin/category/saveCategory";
$route['admin/category/update/(:num)'] = "admin/category/update/$1";
$route['admin/category/delete/(:num)'] = "admin/category/delete/$1";
$route['admin/category/getrow/(:num)'] = "admin/category/selectrow/$1";
$route['admin/category/active'] = "admin/category/active";
$route['admin/category/inactive'] = "admin/category/inactive";


/* Video */
$route['admin/video'] = "admin/video";
$route['admin/video/getlist'] = "admin/video/getList";
$route['admin/video/getcategorylist'] = "admin/video/getVideoList";
$route['admin/video/create'] = "admin/video/viewCreate";
$route['admin/video/add'] = "admin/video/saveVideo";
$route['admin/video/update/(:num)'] = "admin/video/update/$1";
$route['admin/video/delete/(:num)'] = "admin/video/delete/$1";
$route['admin/video/getrow/(:num)'] = "admin/video/selectrow/$1";
$route['admin/video/active'] = "admin/video/active";
$route['admin/video/inactive'] = "admin/video/inactive";


/* Evening Work & Excercise for admin*/
$route['admin/eveningwrkexcercise'] = "admin/eveningwrk/index";
$route['admin/eveningwrkexcercise/getlist'] = "admin/eveningwrk/getList";
$route['admin/eveningwrkexcercise/create'] = "admin/eveningwrk/viewCreate";
$route['admin/eveningwrkexcercise/add'] = "admin/eveningwrk/saveExcercise";
$route['admin/eveningwrkexcercise/update/(:num)'] = "admin/eveningwrk/update/$1";
$route['admin/eveningwrkexcercise/delete/(:num)'] = "admin/eveningwrk/delete/$1";
$route['admin/eveningwrkexcercise/getrow/(:num)'] = "admin/eveningwrk/selectrow/$1";
$route['admin/eveningwrkexcercise/active'] = "admin/eveningwrk/active";
$route['admin/eveningwrkexcercise/inactive'] = "admin/eveningwrk/inactive";


/* Evening Work & Excercise for learner*/
$route['learner/eveningwrkexcercise'] = "learner/eveningwrk/index";
$route['learner/eveningwrkexcercise/getlist'] = "learner/eveningwrk/getList";
$route['learner/eveningwrkexcercise/create'] = "learner/eveningwrk/viewCreate";
$route['learner/eveningwrkexcercise/add'] = "learner/eveningwrk/saveExcercise";
$route['learner/eveningwrkexcercise/update/(:num)'] = "learner/eveningwrk/update/$1";
$route['learner/eveningwrkexcercise/delete/(:num)'] = "learner/eveningwrk/delete/$1";
$route['learner/eveningwrkexcercise/getrow/(:num)'] = "learner/eveningwrk/selectrow/$1";
$route['learner/eveningwrkexcercise/active'] = "learner/eveningwrk/active";
$route['learner/eveningwrkexcercise/inactive'] = "learner/eveningwrk/inactive";


/* Article */
$route['admin/article'] = "admin/article";
$route['admin/article/getlist'] = "admin/article/getList";
$route['admin/article/getcategorylist'] = "admin/article/getVideoList";
$route['admin/article/create'] = "admin/article/viewCreate";
$route['admin/article/add'] = "admin/article/saveVideo";
$route['admin/article/update/(:num)'] = "admin/article/update/$1";
$route['admin/article/delete/(:num)'] = "admin/article/delete/$1";
$route['admin/article/getrow/(:num)'] = "admin/article/selectrow/$1";
$route['admin/article/active'] = "admin/article/active";
$route['admin/article/inactive'] = "admin/article/inactive";


/* Lesson */
$route['admin/lesson'] = "admin/lesson";
$route['admin/lesson/getlist'] = "admin/lesson/getList";
$route['admin/lesson/getlessonlistbycid'] = "admin/lesson/getLessonListByCategory";
$route['admin/lesson/getlessonlist/(:num)'] = "admin/lesson/getLessonList/$1";
$route['admin/lesson/getlessonlist2'] = "admin/lesson/getLessonList2";
$route['admin/lesson/create'] = "admin/lesson/viewCreate";
$route['admin/lesson/list'] = "admin/lesson/viewList";
$route['admin/lesson/add'] = "admin/lesson/saveLesson";
$route['admin/lesson/edit/(:num)'] = "admin/lesson/viewCreate/$1";
$route['admin/lesson/uploadfile'] = "admin/lesson/saveLesson";
$route['admin/lesson/delete/(:num)'] = "admin/lesson/deleteLesson/$1";

/* Topic */
$route['admin/topic'] = "admin/topic";
$route['admin/topic/create'] = "admin/topic/viewCreate";

$route['admin/topic/getlist'] = "admin/topic/getList";
$route['admin/topic/gettopiclist'] = "admin/topic/getSelect2List";
$route['admin/topic/gettopiclist2'] = "admin/topic/getMultiSelect2List";
$route['admin/topic/getalltopics'] = "admin/topic/getMultiSelect2List";
$route['admin/topic/add'] = "admin/topic/saveTopic";
$route['admin/topic/edit/(:num)'] = "admin/topic/viewCreate/$1";
$route['admin/topic/delete/(:num)'] = "admin/topic/deleteTopic/$1";
$route['admin/topic/active'] = "admin/topic/active";
$route['admin/topic/inactive'] = "admin/topic/inactive";

$route['admin/training'] = "admin/training";
$route['admin/training/create'] = "admin/training/viewCreate";
$route['admin/training/getlist'] = "admin/training/getList";
$route['admin/training/getassignedtopics'] = "admin/training/getAssignedList";
$route['admin/training/save'] = "admin/training/saveAssignInfo";
$route['admin/training/remove'] = "admin/training/removeAssignInfo";
$route['admin/training/delete'] = "admin/training/deleteTrainingassign";

$route['admin/examcategory'] = "admin/examcategory";
$route['admin/examcategory/create'] = "admin/examcategory/viewCreate";
$route['admin/examcategory/getlist'] = "admin/examcategory/getList";
$route['admin/examcategory/getcategorylist'] = "admin/examcategory/getCategoryList";
$route['admin/examcategory/add'] = "admin/examcategory/saveExamcategory";
$route['admin/examcategory/active'] = "admin/examcategory/active";
$route['admin/examcategory/inactive'] = "admin/examcategory/inactive";
$route['admin/examcategory/delete'] = "admin/examcategory/delete";

$route['admin/exam'] = "admin/exam";
$route['admin/exam/create'] = "admin/exam/viewCreate";
$route['admin/exam/getlist'] = "admin/exam/getList";
$route['admin/exam/add'] = "admin/exam/saveExam";
$route['admin/exam/active'] = "admin/exam/active";
$route['admin/exam/inactive'] = "admin/exam/inactive";
$route['admin/exam/delete'] = "admin/exam/delete";
$route['admin/exam/getselectablequizlist'] = 'admin/exam/getSelectableQuizList';
$route['admin/exam/getselectedquizlist'] = 'admin/exam/getSelectedQuizList';

$route['admin/examassign'] = "admin/examassign";
$route['admin/examassign/create'] = "admin/examassign/viewCreate";
$route['admin/examassign/getlist'] = "admin/examassign/getList";
$route['admin/examassign/getexamlist'] = "admin/examassign/getExamList";
$route['admin/examassign/getassignedexamlist'] = "admin/examassign/getAssignedExamList";
$route['admin/examassign/add'] = "admin/examassign/saveExamassign";
$route['admin/examassign/delete'] = "admin/examassign/deleteExamassign";

$route['admin/traininghistory/viewtopic'] = "admin/traininghistory/viewTopicList";
$route['admin/traininghistory/viewlesson'] = "admin/traininghistory/viewLessonList";
$route['admin/traininghistory/gettopiclist'] = "admin/traininghistory/getTopicList";
$route['admin/traininghistory/getlessonlist'] = "admin/traininghistory/getLessonList";
$route['admin/examhistory/viewexam'] = "admin/examhistory/viewExamHistory";
$route['admin/examhistory/viewscc'] = "admin/examhistory/viewSCCHistory";
$route['admin/examhistory/getexamhistorylist'] = "admin/examhistory/getExamhistoryList";

$route['admin/certification'] = "admin/certification";
$route['admin/certification/getlist'] = "admin/certification/getList";
$route['admin/certification/view'] = "admin/certification/viewCertification";
$route['admin/certification/delete'] = "admin/certification/deleteCertification";
$route['admin/certification/export'] = 'admin/certification/export';

$route['admin/account'] = "admin/account";
$route['admin/account/getlist'] = "admin/account/getList";
$route['admin/account/updatestatus'] = "admin/account/updateAccountStatus";
$route['admin/account/account_export'] = "admin/account/account_export";


$route['admin/user'] = "admin/user";
$route['admin/user/add'] = "admin/user/insert";
$route['admin/user/change'] = "admin/user/update";
$route['admin/user/add_view'] = "admin/user/edit_view";
$route['admin/user/add_view/(:num)'] = "admin/user/edit_view/$1";
$route['admin/user/export/(:num)'] = "admin/user/export/$1";
$route['admin/user/down_temp'] = "admin/user/down_temp";
$route['admin/user/import'] = "admin/user/import";
$route['admin/user/delete'] = "admin/user/delete";
$route['admin/user/view'] = "admin/user/getData";
$route['admin/user/employee'] = "admin/user/employee_view";
$route['admin/user/admin'] = "admin/user/admin_view";
$route['admin/user/instructor'] = "admin/user/instructor_view";
$route['admin/user/inactive'] = "admin/user/inactive";
$route['admin/user/active'] = "admin/user/active";

$route['admin/library/view'] = "admin/library/getData";
$route['admin/library/unsetShopping'] = "admin/library/unsetShopping";
$route['admin/library/setShopping'] = "admin/library/setShopping";
$route['admin/library/delete'] = "admin/library/delete";


$route['admin/company'] = "admin/company";
$route['admin/company/view'] = "admin/company/getData";
$route['admin/company/add'] = "admin/company/insert";
$route['admin/company/change'] = "admin/company/update";
$route['admin/company/add_view'] = "admin/company/edit_view";
$route['admin/company/add_view/(:num)'] = "admin/company/edit_view/$1";
$route['admin/company/export'] = "admin/company/export";
$route['admin/company/down_temp'] = "admin/company/down_temp";
$route['admin/company/import'] = "admin/company/import";
$route['admin/company/delete'] = "admin/company/delete";






/*
 * instructor Routes 
 */
$route['instructor'] = "instructor/welcome/home";
$route['instructor/home'] = "instructor/welcome/home";	

$route['instructor/topic'] = "instructor/topic";
$route['instructor/topic/getlist'] = "instructor/topic/getList";

$route['instructor/trainingassign'] = "instructor/trainingassign";
$route['instructor/trainingassign/create'] = "instructor/trainingassign/viewCreate";
$route['instructor/trainingassign/getvalidlist'] = "instructor/trainingassign/getValidList";
$route['instructor/trainingassign/save'] = "instructor/trainingassign/saveAssignInfo";
$route['instructor/trainingassign/remove'] = "instructor/trainingassign/removeAssignInfo";
$route['instructor/trainingassign/getassignedtopics'] = "instructor/trainingassign/getAssignedList";
$route['instructor/trainingassign/getlist'] = "instructor/trainingassign/getList";
$route['instructor/trainingassign/delete'] = "instructor/trainingassign/deleteTrainingassign";

$route['instructor/exam'] = "instructor/exam";
$route['instructor/exam/getlist'] = "instructor/exam/getList";
$route['instructor/exam/create'] = "instructor/exam/viewCreate";


/* Category */
$route['instructor/category'] = "instructor/category";
$route['instructor/category/getlist'] = "instructor/category/getList";
$route['instructor/category/getcategorylist'] = "instructor/category/getCategoryList";
$route['instructor/category/create'] = "instructor/category/viewCreate";
$route['instructor/category/add'] = "instructor/category/saveCategory";
$route['instructor/category/update/(:num)'] = "instructor/category/update/$1";
$route['instructor/category/delete/(:num)'] = "instructor/category/delete/$1";
$route['instructor/category/getrow/(:num)'] = "instructor/category/selectrow/$1";
$route['instructor/category/active'] = "instructor/category/active";
$route['instructor/category/inactive'] = "instructor/category/inactive";

$route['instructor/settings/certificate'] = "instructor/settings/certificate_view";
$route['instructor/settings/certificatechange'] = "instructor/settings/certificate_update";
$route['instructor/settings/certificateadd'] = "instructor/settings/certificate_insert";
$route['instructor/settings/certificatedelete'] = "instructor/settings/certificate_delete";
$route['instructor/settings/getcertificate'] = "instructor/settings/get_certificate";
$route['instructor/settings/certificateview'] = "instructor/settings/certificate_edit_view";
$route['instructor/settings/certificateview/(:num)'] = "instructor/settings/certificate_edit_view/$1";
$route['instructor/settings/savegeneral'] = "instructor/settings/save_general";
$route['instructor/settings/general_view'] = "instructor/settings/general_view";
$route['instructor/settings/translations'] = "instructor/settings/trans_lang_view";

$route['instructor/training'] = "instructor/training";
$route['instructor/training/create'] = "instructor/training/viewCreate";
$route['instructor/training/getlist'] = "instructor/training/getList";
$route['instructor/training/getassignedtopics'] = "instructor/training/getAssignedList";
$route['instructor/training/save'] = "instructor/training/saveAssignInfo";
$route['instructor/training/remove'] = "instructor/training/removeAssignInfo";
$route['instructor/training/delete'] = "instructor/training/deleteTrainingassign";

$route['instructor/examassign'] = "instructor/examassign";
$route['instructor/examassign/create'] = "instructor/examassign/viewCreate";
$route['instructor/examassign/getlist'] = "instructor/examassign/getList";
$route['instructor/examassign/getvalidexamlist'] = "instructor/examassign/getValidExamList";
$route['instructor/examassign/getassignedexamlist'] = "instructor/examassign/getAssignedExamList";
$route['instructor/examassign/save'] = "instructor/examassign/saveExamassign";
$route['instructor/examassign/delete'] = "instructor/examassign/deleteExamassign";

$route['instructor/traininghistory/viewtopic'] = "instructor/traininghistory/viewTopicList";
$route['instructor/traininghistory/viewlesson'] = "instructor/traininghistory/viewLessonList";
$route['instructor/traininghistory/gettopiclist'] = "instructor/traininghistory/getTopicList";
$route['instructor/traininghistory/getlessonlist'] = "instructor/traininghistory/getLessonList";
$route['instructor/examhistory/viewexam'] = "instructor/examhistory/viewExamHistory";
$route['instructor/examhistory/viewscc'] = "instructor/examhistory/viewSCCHistory";
$route['instructor/examhistory/getexamhistorylist'] = "instructor/examhistory/getExamhistoryList";

$route['instructor/certification'] = "instructor/certification";
$route['instructor/certification/getlist'] = "instructor/certification/getList";
$route['instructor/certification/view'] = "instructor/certification/viewCertification";	
$route['instructor/certification/delete'] = "instructor/certification/deleteCertification";

$route['instructor/library/view'] = "instructor/library/getData";
$route['instructor/library/unsetShopping'] = "instructor/library/unsetShopping";
$route['instructor/library/setShopping'] = "instructor/library/setShopping";
$route['instructor/library/delete'] = "instructor/library/delete";


$route['instructor/user'] = "instructor/user";
$route['instructor/user/add'] = "instructor/user/insert";
$route['instructor/user/change'] = "instructor/user/update";
$route['instructor/user/add_view/(:any)'] = "instructor/user/edit_view/$1";
$route['instructor/user/add_view/(:any)/(:num)'] = "instructor/user/edit_view/$1/$2";
$route['instructor/user/export/(:any)'] = "instructor/user/export/$1";
$route['instructor/user/down_temp'] = "instructor/user/down_temp";
$route['instructor/user/import'] = "instructor/user/import";
$route['instructor/user/delete'] = "instructor/user/delete";
$route['instructor/user/view'] = "instructor/user/getData";
$route['instructor/user/employee'] = "instructor/user/employee_view";
$route['instructor/user/getnamelistbyrole'] = "instructor/user/getNameListbyRole";



$route['instructor/company'] = "instructor/company";
$route['instructor/company/view'] = "instructor/company/getData";
$route['instructor/company/add'] = "instructor/company/insert";
$route['instructor/company/change'] = "instructor/company/update";
$route['instructor/company/add_view'] = "instructor/company/edit_view";
$route['instructor/company/add_view/(:num)'] = "instructor/company/edit_view/$1";
$route['instructor/company/export'] = "instructor/company/export";
$route['instructor/company/down_temp'] = "instructor/company/down_temp";
$route['instructor/company/import'] = "instructor/company/import";
$route['instructor/company/delete'] = "instructor/company/delete";





/*
 * Learner Routes
 */
$route['learner'] = "learner/welcome/home";
$route['learner/home'] = "learner/welcome/home";

$route['learner/examhistory/viewexam'] = "learner/examhistory/viewExamHistory";
/*
 * Superadmin Routes
 */
$route['superadmin'] = "superadmin/welcome/home";
$route['superadmin/home'] = "superadmin/welcome/home";

$route['superadmin/user'] = "superadmin/user";
$route['superadmin/user/add'] = "superadmin/user/insert";
$route['superadmin/user/change'] = "superadmin/user/update";
$route['superadmin/user/add_view'] = "superadmin/user/edit_view";
$route['superadmin/user/add_view/(:num)'] = "superadmin/user/edit_view/$1";
$route['superadmin/user/export/(:num)'] = "superadmin/user/export/$1";
$route['superadmin/user/down_temp'] = "superadmin/user/down_temp";
$route['superadmin/user/import'] = "superadmin/user/import";
$route['superadmin/user/delete'] = "superadmin/user/delete";
$route['superadmin/user/view'] = "superadmin/user/getData";
$route['superadmin/user/employee'] = "superadmin/user/employee_view";
$route['superadmin/user/admin'] = "superadmin/user/admin_view";
$route['superadmin/user/employee'] = "superadmin/user/employee_view";
$route['superadmin/user/instructor'] = "superadmin/user/instructor_view";
$route['superadmin/user/inactive'] = "superadmin/user/inactive";
$route['superadmin/user/active'] = "superadmin/user/active";


/*
 * Settings Routes
 */


/* Scheduler Routes Start */
 $route['scheduler/course'] = "admin/scheduler/schedulerCourse";
 $route['scheduler/course/view'] = "admin/scheduler/viewSchedulerCourse";




