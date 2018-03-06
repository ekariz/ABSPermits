<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Workflow extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('crud_model','applications');
        $this->load->model('Common_model','common');
        $this->load->model('Abs_model','abs');

        $this->applications->table         = 'applications';
        $this->applications->dataview      = 'viewapplications';

        $approvalsteps             =  $this->abs->get_approval_steps( );

        $instcode                  =  $this->session->userdata('instcode');//instcode
        $my_approvalstep           =  $this->abs->my_approvalstep( $instcode );
        $this->columns             = [
                                     'appno'       => "App No",
                                     'firstname'   => "First Name",
                                     'lastname'    => "Last Name",
                                     'approved1'   => "approved1",
                                     'approved2'   => "approved2",
                                     'approved3'   => "approved3",
                                     'approved4'   => "approved4",
                                     'approved5'   => "approved4",
                                     ];

        if($approvalsteps && count($approvalsteps)>0){
         foreach($approvalsteps as $stepno=>$stepname){

            $col_title_prefix = "&nbsp;";
           if($stepno==$my_approvalstep){
            $col_title_prefix = "<i class=\"fa fa-check\"></i>";
           }

           $approval_col                 = "approved{$stepno}";
           $this->columns[$approval_col] = $col_title_prefix.' '.$stepname;
         }
        }


        $column_order     = array_keys($this->columns);
        $column_order[]   = null;

        $this->applications->columns        = array_keys($this->columns);
        $this->applications->column_order   = $column_order;
        $this->applications->column_search  = ['appno','email'];
        $this->applications->order          = ['appno' => 'desc'];
    }

    public function index()
    {

        $nosearchcolumns['approved1']   = 'approved1';
        $nosearchcolumns['approved2']   = 'approved2';
        $nosearchcolumns['approved3']   = 'approved3';
        $nosearchcolumns['approved4']   = 'approved4';
        $nosearchcolumns['approved5']   = 'approved5';
        $nosearchcolumns['approved6']   = 'approved6';
        $nosearchcolumns['approved7']   = 'approved7';
        $nosearchcolumns['approved8']   = 'approved8';
        $nosearchcolumns['approved9']   = 'approved9';
        $nosearchcolumns['approved10']  = 'approved10';

        $appname = 'Applications';
        $params  =  [
                    'route'   => $this->router->class,
                    'appname' => $appname,
                    'columns' => $this->columns,
                    'nosearchcolumns' => $nosearchcolumns,
                    ];

        $data                   =  [];

        $data['approvalsteps']  =  $this->abs->get_approval_steps();
        $instcode               =  $this->session->userdata('instcode');//instcode
        $data['approvalstep']   =  $this->abs->my_approvalstep( $instcode );
        $data['approval_name']  =  valueof( $data['approvalsteps'], $data['approvalstep'] );

        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        $this->load->library('CustomCrud', $params);
        $this->load->view('workflow_view', $data);

    }

    public function data()
    {
        $list = $this->applications->get_datatables();
        $data = array();
        $no   =  filter_input(INPUT_POST , 'start', FILTER_SANITIZE_STRING);
        $draw =  filter_input(INPUT_POST , 'draw', FILTER_SANITIZE_STRING);
        foreach ($list as $index => $application) {

        $no++;
        $row = array();

        foreach($this->applications->column_order as $index => $colname){
         if(strstr($colname,'approved')){
          $approved       = $application->$colname;
          $approved_icon  = $approved ? 'check success' : 'hourglass gray';
          $row[]          = "<i class=\"fa fa-{$approved_icon}\"></i>";
         }else{
          if(!is_null($colname)){
           $row[] = $application->$colname;
          }
         }
        }

        $row[] = '
              <a   href="javascript:void(0)" title="View" onclick="workflow.edit('."'".$application->id."'".')"><i class="fa fa-eye"></i> View</a>
              &nbsp;
              ';

        $data[] = $row;

        }

        $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->applications->count_all(),
                "recordsFiltered" => $this->applications->count_filtered(),
                "data" => $data,
                );

        echo json_encode($output);
    }

    public function edit($id)
    {
        $data_raw = $this->applications->get_by_id($id);

        $data                = (object) [];
        $data->id            = $data_raw->id;
        $data->appno         = $data_raw->appno;
        $data->div_appno     = "<a href=\"javascript:void(0)\" onclick=\"workflow.view_application({$data_raw->id})\">{$data_raw->appno}</a>";
        $data->div_fullname  = Camelize($data_raw->firstname.' '.$data_raw->lastname);
        $data->div_documents = '';
        $data->div_date      = fuzzyDate($data_raw->apptime, 1);
        $data->div_country   = $data_raw->ctnname;
        $data->div_email     = $data_raw->email;
        $data->div_phone     = $data_raw->mobile;

        echo json_encode($data);
    }

    public function list_documents($id)
    {
      $data_raw = $this->applications->get_by_id($id);
      $data = [];

      if($data_raw){
      foreach($data_raw as $field=>$value){
       if(strstr($field,'document') || strstr($field,'export')){
        $data[$field]      = isJSON($value) ? json_decode($value , true) : $value;
       }
      }
     }

     $this->load->view('documents_view', $data);

    }


    public function view_document( $id,$docid )
    {
    $data_raw       = $this->applications->get_by_id($id);

    $email          = $data_raw->email;

    if(empty($email)) die('Ops!');

    $folderid    = sha1($email);
    $file        = FCPATH ."uploads/appdocs/{$folderid}/{$docid}";

    if(is_readable($file)){

    $this->load->helper('download');

    force_download( $file , NULL);

    }
    }

    public function list_approvals($id)
    {
      $data_raw  = $this->applications->get_by_id($id);
      $data      = [];

      $data['approvalsteps']  =  $this->abs->get_approval_steps( );

      if($data_raw){
      foreach($data_raw as $field=>$value){
       if(strstr($field,'approved')){
        $data['approvals'][$field]      =  $value;
       }
      }
     }

     $this->load->view('approvals_view', $data);

    }

    public function approve()
    {

    $id                =  $this->input->post('id');
    $approvalsteps     =  $this->abs->get_approval_steps( );
    $instcode          =  $this->session->userdata('instcode');//instcode
    $my_approvalstep   =  $this->abs->my_approvalstep( $instcode );
    $my_approvalstep_name   =  valueof($approvalsteps, $my_approvalstep);
    $next_approvalstep      =  $my_approvalstep+1;
    $next_approvalstep_name =  valueof($approvalsteps, $next_approvalstep);
    $next_approvalstep_name = !empty($next_approvalstep_name) ? $next_approvalstep_name : $my_approvalstep_name;
    $next_instcode          = $this->abs->get_approver( $next_approvalstep );
    $next_approver          = $this->abs->get_institutions_main_approver( $next_instcode,$rolecode = 'IA' );

    $application       =  $this->applications->get_by_id($id);

    $pending_approvals = [];

    foreach($approvalsteps as $stepno => $stepname){
     $column_approval  = "approved{$stepno}";

     if($stepno >= $my_approvalstep){
       if($application->$column_approval==1){
        //echo json_response(0,"Already Approve by {$stepname}");
        //die;
       }
     }elseif($stepno < $my_approvalstep){
       if(empty($application->$column_approval)){
        $pending_approvals [] = $stepname;
       }
     }

    }

    if(count($pending_approvals)){
     $pending_approvals_str = implode(',' , $pending_approvals);
     echo json_response(0,"Please wait for approval by: {$pending_approvals_str}");
     die;
    }

     /*approve next col*/
     if( !empty($my_approvalstep) ){

     $column_approval  = "approved{$my_approvalstep}";
     $column_approver  = "approver{$my_approvalstep}";
     $column_time      = "approvetime{$my_approvalstep}";

     $data                   = [];
     $data[$column_approval] = 1;
     $data[$column_approver] = $this->session->userdata('userid');;
     $data[$column_time]     = time();

     $this->applications->update( ['id' => $id], $data );

     self::notify_approved($id, $my_approvalstep_name, $next_approvalstep_name, $next_approver->username, $next_approver->email);
     echo json_response(1,'Approved');
     die;
    }

     echo json_response(0,'All Approval Done');
   }

    public function disapprove()
    {

    $id                =  $this->input->post('id');
    $reason            =  $this->input->post('reason');
    $approvalsteps     =  $this->abs->get_approval_steps( );
    $instcode          =  $this->session->userdata('instcode');//instcode
    $my_approvalstep   =  $this->abs->my_approvalstep( $instcode );
    $my_approvalstep_name   =  valueof($approvalsteps, $my_approvalstep);
    $application       =  $this->applications->get_by_id($id);

    $done_approvals = [];

    foreach($approvalsteps as $stepno => $stepname){
     if($stepno > $my_approvalstep){
      $column_approval  = "approved{$stepno}";
       if($application->$column_approval==1){
        $done_approvals [] = $stepname;
       }
     }
    }

    if(count($done_approvals)){
     $done_approvals_str = implode(',' , $done_approvals);
     echo json_response(0,"Disapproved failed beacuse {$done_approvals_str} has already approved");
     die;
    }

     /*approve next col*/
     if( !empty($my_approvalstep) ){

     $column_approval  = "approved{$my_approvalstep}";
     $column_reason    = "discomment{$my_approvalstep}";
     $column_approver  = "approver{$my_approvalstep}";
     $column_time      = "approvetime{$my_approvalstep}";

     $data                    = [];
     $data[$column_approval]  = null;
     $data[$column_reason]    = $reason;
     $data[$column_approver]  = $this->session->userdata('userid');;
     $data[$column_time]      = time();

     $this->applications->update( ['id' => $id], $data );

     self::notify_disapproved($id, $my_approvalstep_name ,$reason);
     echo json_response(1,'Disapproved');
     die;
    }

     echo json_response(0,'Ops!');
   }


   private function notify_approved($id, $stepname_current, $stepname_next, $next_approver_username, $next_approver_email ){

    $application       = $this->applications->get_by_id($id);

    /**
     * applicant
     */
    $subject = "ABS Application Reference {$application->appno}";
    $message = self::make_email_body_approve_applicant( $application->firstname, $application->email,$stepname_current,$stepname_next, $application->appno  );
    $this->common->queue_mail( $application->email, $subject, $message ,$application->firstname);

    /**
     * next company admin
     */
    $subject = "ABS Application Reference {$application->appno}";
    $message = self::make_email_body_approve_admin( $next_approver_username, $next_approver_email,$stepname_current,$stepname_next, $application->appno  );
    $this->common->queue_mail( $next_approver_email, $subject, $message ,$next_approver_username );

   }

   private function notify_disapproved($id, $stepname_current ,$reason){

     $application       = $this->applications->get_by_id($id);

    /**
     *applicant
    */
    $subject = "ABS Application Reference {$application->appno}";
    $message = self::make_email_body_disapprove_applicant( $application->firstname, $application->email,$stepname_current ,$reason , $application->appno  );
    $this->common->queue_mail( $application->email, $subject, $message ,$application->firstname);

   }

   private function make_email_body_approve_applicant( $firstname, $email,$stepname_current,$stepname_next, $appno ){

          $this->config->load('product');

          $companyname   = $this->config->item('companyname');
          $productname   = $this->config->item('productname');
          $host          = base_url();
          $url           = "{$host}#ApplicationsList/{$appno}";
          $url           = str_replace('admin.','',$url);

          return  <<<HTML

          <table id="" style="font-family:Verdana;font-size:14px"  cellpadding="5"  cellspacing="2"   width="100%" border="0">

          <tr>
           <td><h2>Hi {$firstname}</h2></td>
          </tr>

          <tr>
           <td><br><b>{$stepname_current}</b> has approved your Harmonized ABS Application Reference Number <b>{$appno}</b>.<br>
          </tr>

          <tr>
           <td><br>The next approval will be done by <b>{$stepname_next}</b><br>
            <br>To Track the application progress, <a href="{$url}">click here</a> </td>
          </tr>

          <tr>
           <td><br>If you received this email in error, you can safely ignore this email.</td>
          </tr>

          <tr>
           <td><br>Best regards  <hr>  {$companyname} Customer Care</td>
          </tr>

           <tr>
           <td>
             <br>
            <small style="color:#999">
             This message was sent to {$email}  <br>
             From:{$companyname}  <br>
             </small>
           </td>
          </tr>

         </table>

HTML;
 }

   private function make_email_body_approve_admin( $firstname, $email,$stepname_current,$stepname_next, $appno ){

          $this->config->load('product');

          $companyname   = $this->config->item('companyname');
          $productname   = $this->config->item('productname');
          $host          = base_url();
          $url           = "{$host}#Workflow/{$appno}";

          return  <<<HTML

          <table id="" style="font-family:Verdana;font-size:14px"  cellpadding="5"  cellspacing="2"   width="100%" border="0">

          <tr>
           <td><h2>Hi {$firstname}</h2></td>
          </tr>

          <tr>
           <td><br><b>{$stepname_current}</b> has approved a Harmonized ABS Application Reference Number <b>{$appno}</b>.<br>
            <br>To View the application , <a href="{$url}">click here</a> </td>
          </tr>

          <tr>
           <td><br>If you received this email in error, you can safely ignore this email.</td>
          </tr>

          <tr>
           <td><br>Best regards  <hr>  {$companyname} Customer Care</td>
          </tr>

           <tr>
           <td>
             <br>
            <small style="color:#999">
             This message was sent to {$email}  <br>
             From:{$companyname}  <br>
             </small>
           </td>
          </tr>

         </table>

HTML;
 }

   private function make_email_body_disapprove_applicant( $firstname, $email,$stepname_current ,$reason , $appno ){

          $this->config->load('product');

          $companyname   = $this->config->item('companyname');
          $productname   = $this->config->item('productname');
          $host          = base_url();
          $url           = "{$host}#ApplicationsList/{$appno}";
          $url           = str_replace('admin.','',$url);

          return  <<<HTML

          <table id="" style="font-family:Verdana;font-size:14px"  cellpadding="5"  cellspacing="2"   width="100%" border="0">

          <tr>
           <td><h2>Hi {$firstname}</h2></td>
          </tr>

          <tr>
           <td><br><b>{$stepname_current}</b> has dis-approved your Harmonized ABS Application Reference Number <b>{$appno}</b>.<br>
           The dis-approval reason was :<b>{$reason}</b><br>
          </tr>

          <tr>
           <td>To Track the application progress, <a href="{$url}">click here</a> </td>
          </tr>

          <tr>
           <td><br>If you received this email in error, you can safely ignore this email.</td>
          </tr>

          <tr>
           <td><br>Best regards  <hr>  {$companyname} Customer Care</td>
          </tr>

           <tr>
           <td>
             <br>
            <small style="color:#999">
             This message was sent to {$email}  <br>
             From:{$companyname}  <br>
             </small>
           </td>
          </tr>

         </table>

HTML;
 }

}
