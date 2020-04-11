<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Scheduler extends CI_Controller {

 public function __construct()
    {
        parent::__construct();
        $this->load->model('crud_model','mail');
        $this->load->model('Common_model','common');


    }

  public function index(){
   die('Nothing Here');
  }

  public function mail( $limit=5 ){
     $this->load->library('email');
     $this->config->load('product');

//print_pre($this->email);//remove 

     $companyname       = $this->config->item('companyname');
     $companyemail      = $this->config->item('companyemail');
     $productname       = $this->config->item('productname');

     $queued_mail       = $this->common->get_queued_mail($limit);

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

      
       $sent = 0;
      
      if( $this->email->send() ){
	   $sent = 1; 
	  }else{
		echo $this->email->print_debugger();
	  }
	  
	  //echo $this->email->print_debugger();
	  
	  $this->email->clear(TRUE);
	  
      $this->db->query( "update queuemail set sent={$sent} where id={$id} " );

     }
    }

  }

  public function send_by_id( $id ){
     $this->load->library('email');
     $this->config->load('product');


     $companyname       = $this->config->item('companyname');
     $companyemail      = $this->config->item('companyemail');
     $productname       = $this->config->item('productname');

     $mail              = $this->common->get_queued_mail_id($id);

     $errors = array();

    if(sizeof($mail)>0){


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

      $sent = 0;
      
      if( $this->email->send() ){
	   $sent = 1; 
	  }else{
		echo $this->email->print_debugger();
	  }
	  
	  //clear attachments
	  
	  $this->email->clear(TRUE);
	  
      $this->db->query( "update queuemail set sent={$sent} where id={$id} " );


    }

  }



}
