<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sms {

  function send($number, $message)
  {
    $ci = & get_instance();
    $data=array("username"=>SMS_FROM,"hash"=>HASH_CODE,'apikey'=>false);
    $sender  = SENDER_NAME;
    $numbers = array($number);
    $ci->load->library('textlocal', $data);

    $response = $ci->textlocal->sendSms($numbers, $message, $sender);
    return $response;
  }
}
