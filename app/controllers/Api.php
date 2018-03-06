<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Api extends REST_Controller {

 public function __construct() {
  parent::__construct();
  $this->load->model('user_model', 'user');
  $this->load->model('attendance_model','attendance');
 }

 public function user_get(){
  $id = $this->uri->segment(3);
  $r  = $this->user->read($id);
  $this->response($r);
 }

 public function user_post(){
  $data = array(
  'name' => $this->input->post('name'),
  'pass' => $this->input->post('pass'),
  'type' => $this->input->post('type')
 );

  //$r = $this->user->insert($data);
  //$this->response($r);

 }


 public function auth_post(){

    if(isset($_POST['userid']) && isset($_POST['password']) ){
     $userid    = $this->input->post('userid', TRUE);
     $password  = $this->input->post('password', TRUE);
    }else{
     $data      = json_decode( $this->input->raw_input_stream );
     $userid    = isset($data->userid) ? $data->userid : null;
     $password  = isset($data->password) ? $data->password : null;
    }

  $data = [
  'userid'    => $userid,
  'password'  => $password,
  ];

  $r = $this->user->auth($data);
  $this->response($r);

 }


 public function attendance_post(){

   if(isset($_POST['staffno']) && isset($_POST['attdate']) ){
      $staffno      = $this->input->post('staffno', TRUE);
      $attdate      = $this->input->post('attdate', TRUE);
      $lat          = $this->input->post('lat', TRUE);
      $lng          = $this->input->post('lng', TRUE);
      $location     = $this->input->post('location', TRUE);
      $deviceid     = $this->input->post('deviceid', TRUE);
      $operation    = $this->input->post('operation', TRUE);
      $imagebase64  = $this->input->post('imagebase64', TRUE);
    }else{
      $data        = json_decode( $this->input->raw_input_stream );
      $staffno     = isset($data->staffno) ? $data->staffno : null;
      $attdate     = isset($data->attdate) ? $data->attdate : null;
      $lat         = isset($data->lat) ? $data->lat : null;
      $lng         = isset($data->lng) ? $data->lng : null;
      $location    = isset($data->location) ? $data->location : null;
      $operation   = isset($data->operation) ? $data->operation : null;
      $deviceid    = isset($data->deviceid) ? $data->deviceid : null;
      $imagebase64 = isset($data->imagebase64) ? $data->imagebase64 : null;
    }

    $profile = $this->user->read( $staffno );

    if(sizeof($profile)==0){
      $r  =   ['status' => false , 'message' => 'Staff Not Found'];
      $this->response($r);
    }else{

      $data = [
      'staffno'    => $staffno,
      'attdate'    => $attdate,
      'lat'        => $lat,
      'lng'        => $lng,
      'location'   => $location,
      'operation'  => $operation,
      'deviceid'     => $deviceid,
      'imagebase64'  => $imagebase64,
      ];

      $r = $this->attendance->insert($data);
      $this->response($r);

    }
 }

}
