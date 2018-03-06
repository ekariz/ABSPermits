<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Scheduler extends CI_Controller {

 public function __construct()
    {
        parent::__construct();
        $this->load->model('crud_model','mail');
        $this->load->model('Common_model','common');
        //$this->load->model('HR_model','hr');


    }

  public function index(){
   die('Nothing Here');
  }

  public function mail( $index=0 ){
     $this->load->library('email');
     $this->config->load('product');


     $companyname       = $this->config->item('companyname');
     $companyemail      = $this->config->item('companyemail');
     $productname       = $this->config->item('productname');

     $queued_mail       = $this->common->get_queued_mail(2);

     $errors = array();

    if(sizeof($queued_mail)>0){
     foreach($queued_mail as $mail){

      $id       = valueof($mail, 'id');
      $toemail  = valueof($mail, 'toemail');
      $subject  = valueof($mail, 'subject');
      $message  = valueof($mail, 'message');
      $priority = valueof($mail, 'priority',3);
      $this->email->clear();
      $this->email->from( $companyemail, $companyname );
      $this->email->to( $toemail );
      $this->email->subject( $subject );
      $this->email->message( $message );

      $this->email->send();

     //echo $this->email->print_debugger();

      $this->db->query( "update queuemail set sent=1  where id={$id} " );

     }
    }

  }



}
