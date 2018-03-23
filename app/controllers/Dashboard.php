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
    foreach($applications as $application){
     foreach($approvalsteps as $stepno => $stepname){

      $column_approval  = "approved{$stepno}";
      $approved         = valueof($application, $column_approval);
      $appno            = valueof($application, 'appno');

      if($approved==1){
        $approvals[$stepno]['approved'][] = $appno;
      }else{
        $approvals[$stepno]['pending'][]  = $appno;
      }

      $xxx[$appno][$stepno]  = $approved;

      if(is_null($approved) && !isset($stage[$appno]) ){
       $stage[$appno]  = $stepno;
       $num_docs[$stepno][]  = $appno;
      }

     }
    }

    $data['approvalsteps']  = $approvalsteps;
    $data['num_docs']       = $num_docs;
print_pre($data);//remove
exit();//remove

    $this->load->view('dashboard_view', $data);

    }

}
