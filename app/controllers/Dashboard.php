<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Abs_model','abs');
    }

    public function index()
    {

    $data                   = [];
    $applications           =  $this->abs->get_applications_all( );
    $approvalsteps          =  $this->abs->get_approval_steps();

    $approvals = [];
    $stage = [];
    $num_docs = [];
    
    foreach($approvalsteps as $stepno => $stepname){
		 
      if(!isset($approvals[$stepno]['approved'])){
		$approvals[$stepno]['approved'] = 0;  
	  }
		 
      if(!isset($approvals[$stepno]['{'])){
		$approvals[$stepno]['pending'] = 0;  
	  }
	  
	}
	
    foreach($applications as $application){
     foreach($approvalsteps as $stepno => $stepname){

      $column_approval  = "approved{$stepno}";
      $approved         = valueof($application, $column_approval);
      $appno            = valueof($application, 'appno');
     
      if($approved==1){
        $approvals[$stepno]['approved']  += 1;
      }else{
        $approvals[$stepno]['pending']   += 1;
      }

      //if(is_null($approved) && !isset($stage[$appno]) ){
       //$stage[$appno]  = $stepno;
       //$num_docs[$stepno][]  = $appno;
      //}

     }
    }

    $data['num_applications']  = sizeof($applications);
    $data['approvalsteps']  = $approvalsteps;
    $data['num_docs']       = $num_docs;
    $data['approvals']       = $approvals;
//print_pre($data);//remove
//exit();//remove

    $this->load->view('dashboard_view', $data);

    }

}
