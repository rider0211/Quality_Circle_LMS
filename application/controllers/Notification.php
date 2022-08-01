<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
require APPPATH . '/third_party/TCPDF-master/tcpdf.php';

class Notification extends BaseController {
	
	public function __construct() {
        parent::__construct();
        $this->load->model('Notification_model');
    }

    /**     
     */
    public function index() {
        $sessiondata = $this->session->get_userdata();
        $data = $this->Notification_model->getByUserID($sessiondata["user_id"]);
        echo json_encode($data);
    } 

    public function update_read_notif() {
        $notifi_id = $this->input->post('notif_id');
        $this->Notification_model->update_read($notifi_id);
    }

    public function create() {
        if ("POST" === $this->input->server('REQUEST_METHOD')) {
            $this->Notification_model->create();
        }
    }

    public function send_mail($email_data=array()) {
        $this->load->library('email');

        $this->email->from($email_data["from_email"]);
        $this->email->to($email_data["to_email"]);
        $this->email->subject($email_data["subject"]);
        $this->email->message($email_data["message"]);

        $this->email->send();

    }

    public function certification()
    {
        $token = $this->input->get('token');

        $this->load->model("Certification_model");
        $this->load->model("Settings_model");

        $this->load->model("Token_model");
        $token_item = $this->Token_model->getOne($token);

        if(isset($token_item )) {
            $certification_row = $this->Certification_model->getRow($token_item->user_id);
            $certification = $certification_row[0];

            $this->load->model('Settings_model');
            $cert_templ_data = $this->Settings_model->getCertificate();
            $certification_template = $cert_templ_data[0];

            $cert_year = $certification["year"];
            $cert_month = $certification["month"];
            $cert_day = $certification["day"];

            $cert_content = $certification_template["content"];
            $quiz_count = $certification["quiz_count"];
            $correct_count = $certification["correct_count"];
            $correct_percent = intval($correct_count * 100 / $quiz_count);

            $first_name = $certification["first_name"];
            $last_name = $certification["last_name"];
            $company_name = $certification["company_name"];
            $birthday = $certification["birthday"];
            $score = $correct_count . '(' . $correct_percent . '%)';
            $exam_name = $certification["exam_title"];
            $validate = $certification["validate"];

            $cn_num = $certification['cn_num'];
            $cert_content = str_replace("{first_name}", $first_name, $cert_content);
            $cert_content = str_replace("{last_name}", $last_name, $cert_content);
            $cert_content = str_replace("{company_name}", $company_name, $cert_content);
            $cert_content = str_replace("{birthday}", $birthday, $cert_content);
            $cert_content = str_replace("{score}", $score, $cert_content);
            $cert_content = str_replace("{exam_name}", $exam_name, $cert_content);
            $cert_content = str_replace("{validate}", $validate, $cert_content);

            $cert_top_logo = site_url($certification_template["logo"]);
            $cert_bottom_logo = site_url($certification_template["middle_logo"]);
            $cert_left_name = $certification_template["left_des"];
            $cert_right_name = $certification_template["right_des"];
            $cert_left_sign = site_url($certification_template["left_sign"]);
            $cert_right_sign = site_url($certification_template["right_sign"]);

            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            $content = '
    <table style="width:100%; border: 9px #CCC solid; height: 430px; padding: 18px; padding-left: 10px;font-size: 1.2em; margin: 0 auto;">
        <tr>
            <td>
                <table style="width:98%; border: 3px #ccc solid;">
                    <tr>
                        <td>
                            <table>
                                <tr>
                                   <td style="padding-top: 20px; width: 100%;">
                                
                                    <table style="padding-top: 25px;padding-bottom: 20px; width: 100%;" >
                                            <tr style="padding-top: 20px; color: #777;">
                                                <td style="padding-top: 20px; color: #333;text-align:left; font-size:14px;float:left;width:50%;">
                                                    <b style="color: #777;">CN-Number: '.$cn_num.'</b>
                                                </td>
                                                <td style="padding-top: 20px; color: #333;  padding-right:10px; auto;width:46%;text-align: right;">
                                                    <span style="color: #777;right: 10px; margin-right: 10px;padding-right: 10px;">Date: </span><br />
                                                    <b style="color: #777;">'.$cert_year.'</b>
                                                    <b style="color: #777;">'.$cert_month.'</b>
                                                    <b style="color: #777;">'.$cert_day.'</b>
                                                </td>
                                               
                                            </tr>
                                        </table>
                                        
                                 
                                </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;margin-top: 30px;">
                                        <img src="' . $cert_top_logo . '" width="440px">
                                        <div style="color: #fff; width: 100%; height: 2px; border: 0;"  />
                                    </td>
                                </tr>   
                                <tr>
                                    <td style="text-align: center; padding-top: 25px; font-style: italic; font-size: 15px;color: #777;line-height: 22px;"> 
                                            ' . $cert_content . '
                                    </td>
                                </tr>
                                <tr>
                                    <td>    
                                        <table style="vertical-align: bottom; padding-top: 35px; color: #333; padding-bottom: 30px;">
                                            <tr>
                                                <td style="text-align:left; font-size:14px;float:left;width:32%;">
                                                    <div style=""><img style="width:150px" src="' . $cert_left_sign . '"></div>
                                                    <div style="font-weight: bold;">' . $cert_left_name . '</div>
                                                    <div style="color: #bbb;">Course Teacher</div>
                                                </td>
                                                <td style="text-align: center;margin:0 auto;width:32%;">
                                                    <img style="width:100px" src="' . $cert_bottom_logo . '">
                                                </td>
                                                <td style="text-align:center; font-size:14px;float:right;width:32%;">
                                                    <div style="text-align: right;"><img style="width:150px" src="' . $cert_right_sign . '"></div>
                                                    <div style="font-weight: bold; text-align: right;">' . $cert_right_name . '</div>
                                                    <div style="color: #bbb; text-align: right;" >Admin</div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    ';
            $pdf->AddPage();
            $html = <<<EOD
    $content
EOD;
            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            $pdf->Output('certification'.$cn_num.'.pdf', 'I');
        }
        else{

            //      $this->loadViews("errors/html/error_4041", NULL, NULL, NULL);

            $this->load->view("errors/html/error_4041", NULL);
        }
    }

    public function send_due_all(){

        $this->load->helper('mail');
        $step_date = array(7, 30);
        $training_data = $this->Notification_model->getTrainingNotificationList($step_date);
        foreach ($training_data as $key => $value) {
            $start_date = $value["start_date"];
            $category = $value["category"];
            $training_title = $value["training_title"];

            $phone_number = $value["phone_number"];
            $email = $value["email"];

            $content = sprintf('Training(%s - %s) is due on %s', $category, $training_title, $start_date);
            $isEmail = $value['email_notification'] == 1;
            $isSMS = $value['sms_notification'] == 1;
            $userMethod = $value['notification_method'];
            if ($isEmail && $userMethod == 'Email'){
                @send_phpmail_message($email, 'LMS Notification', $content);
                print_r('Email<br>' . $email . '<br>' . $content . '<br><br>');
            }
            if ($isSMS && $userMethod == 'SMS'){
                sendSMS($phone_number, $content);
                print_r('SMS<br>' . $phone_number . '<br>' . $content . '<br><br>');
            }
            print_r("<br><br>");
        }

        $exam_data = $this->Notification_model->getExamNotificationList($step_date);
        foreach ($exam_data as $key => $value) {
            $start_date = $value["start_date"];
            $phone_number = $value["phone_number"];
            $email = $value["email"];

            $category = $value["category"];
            $exam_title = $value["exam_title"];

            $content = sprintf('Exam(%s - %s) is due on %s', $category, $exam_title, $start_date);
            $isEmail = $value['email_notification'] == 1;
            $isSMS = $value['sms_notification'] == 1;
            $userMethod = $value['notification_method'];

            if ($isEmail){
                if ($userMethod != 'Email') continue;
                @send_phpmail_message($email, 'LMS Notification', $content);
                print_r('Email<br>' . $email . '<br>' . $content . '<br><br>');
            }
            if ($isSMS){
                if ($userMethod != 'SMS') continue;
                sendSMS($phone_number, $content);
                print_r('SMS<br>' . $phone_number . '<br>' . $content . '<br><br>');
            }
            print_r("<br><br>");
        }

    }

    public function send_email(){
        $this->load->helper('mail');
		$email = "JohnWayne144@hotmail.com";
        $res = @send_phpmail_message($email , "this is test", "Testing email content");
        echo "result:". $res . $email;

    }
}