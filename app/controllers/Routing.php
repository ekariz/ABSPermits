<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Routing extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('crud_model','applications');
        $this->load->model('Common_model','common');
        $this->load->model('Abs_model','abs');
        $this->load->model('User_model','user');
        $this->load->model('Researcher_model','researcher');
        $this->config->load('product');
        
        $this->companyname     = $this->config->item('companyname');
        $this->productname     = $this->config->item('productname');
        $this->baseurl         = $this->config->item('baseurl');
 
        $this->applications->table         = 'applications';
        $this->applications->dataview      = 'viewapplicationsnew';

        $this->columns             = [
                                     'appno'       => "App No",
                                     'email'       => "Email",
                                     'firstname'   => "First Name",
                                     'ctnname'     => "Country",
                                     'apptime'     => "Application Date",
                                     ];


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

        $appname = 'Application Routing';
        $params  =  [
                    'route'   => $this->router->class,
                    'appname' => $appname,
                    'columns' => $this->columns,
                    'nosearchcolumns' => $nosearchcolumns,
                    ];

        $data                   =  [];

        $data['approvalsteps']  =  $this->abs->get_approval_steps();
        //$instcode               =  $this->session->userdata('instcode');//instcode
        //$data['approvalstep']   =  $this->abs->my_approvalstep( $instcode );
        $data['approval_name']  =  $appname;

        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        $this->load->library('CustomCrud', $params);
        $this->load->view('routing_view', $data);

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
         
          if(strstr($colname,'apptime'))
          {
           $row[]          =  !empty($application->$colname) ? textDate($application->$colname). ' '.date('H:i:s',$application->$colname) : null;
          }elseif(!is_null($colname)){
           $row[] = $application->$colname;
          }
          
        }

        $row[] = '
              <a   href="javascript:void(0)" title="View" onclick="workflow.edit('."'".$application->id."'".')"><i class="fa fa-folder-open-o"></i> Open</a>
              &nbsp;
              ';

        $data[] = $row;

        }
        
        $this->db->where('routed', null);
        $recordsTotal  = $this->applications->count_all();
		
        $this->db->where('routed', null);
        $recordsFiltered  = $this->applications->count_filtered();

        $output = array(
                "draw"             => $draw,
                "recordsTotal"     => $recordsTotal,
                "recordsFiltered"  => $recordsFiltered,
                "data"             => $data,
                );
                
        echo json_encode($output);
        
    }

    public function edit($id)
    {
        $data_raw            = $this->applications->get_by_id($id);
        $instcode            =  $this->session->userdata('instcode');
        $my_approvalstep     =  $this->abs->my_approvalstep( $instcode );
        $approvalstep_desc   =  $this->abs->get_step_description( $my_approvalstep );

        $data                = (object) [];
        $data->id            = $data_raw->id;
        $data->div_title     = "{$instcode} - {$approvalstep_desc}";
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

    private function make_institution_document($id, $approval_desc )
    {
    
    $instcode          =  $this->session->userdata('instcode');//instcode
    $institution       =  $this->abs->get_institutions_by_code($instcode);
    
    $data = [];
    $data['approval_desc']        = $approval_desc;
    $data['applyingas_list']      = $this->abs->get_applyas();
    $data['resource_list']        = $this->abs->get_resource_types();
    $data['researchtype_list']    = $this->abs->get_research_types();
    $data['purposes_list']        = $this->abs->get_purposes();
    $data['conservestatus_list']  = $this->abs->get_iucn_red_list();
    $data['sample_uom_list']      = $this->abs->get_sample_uom();

    $data['positions']      = [];
    $data['positions']['']  = 'Choose option';
    $data['positions'][1]   = 'Yes';
    $data['positions'][2]   = 'No';

    $data['export_answer_list']      = [];
    $data['export_answer_list']['']  = 'Choose option';
    $data['export_answer_list'][1]   = 'Yes';
    $data['export_answer_list'][2]   = 'No';

    $data_raw = $this->applications->get_by_id($id);
    
    $researcher = $this->researcher->get_researcher_by_email($data_raw->email);
    
    $urlphoto           = valueof($researcher, 'urlphoto'); 
    $data['urlphoto']   = str_replace($this->baseurl,FCPATH,$urlphoto); 
	
      if($data_raw){
       foreach($data_raw as $field=>$value){
        $data[$field]      = isJSON($value) ? json_decode($value , true) : $value;
       }
      }

     $data['instcode']  = $institution->instcode;
     $data['instname']  = $institution->instname;
     $instphoto         = json_decode($institution->instphoto, true);

     $data['thumburl']  =  './img/blank.jpeg';

     if(isset($instphoto['document']['raw_name'])){
      $upload_dir  = "./uploads/insphotos/";
      $raw_name    =  $instphoto['document']['raw_name'];
      $file_ext    =  $instphoto['document']['file_ext'];
      $thumb       =  "{$upload_dir}{$raw_name}_thumb{$file_ext}";
      $data['thumburl']  = $thumb;
     }
     


     $this->load->library('pdfgenerator');
     $html     = $this->load->view("application_form_approved_view", $data, true);

      $pdfs_dir       = "./pdfs/{$id}/";
      $document       = [];

      if(!is_dir($pdfs_dir)){
       if (!mkdir($pdfs_dir, 0777, true)) {
        //die;
       }
      }

     $filename = "{$pdfs_dir}{$institution->instcode}.pdf";

     $output = $this->pdfgenerator->generate($html, $filename, false, 'A4', 'portrait');
     file_put_contents($filename, $output);

    }

    public function view($id)
    {

    $instcode          =  $this->session->userdata('instcode');
    $my_approvalstep   =  $this->abs->my_approvalstep( $instcode );

    if(empty($my_approvalstep)){
     //echo ("You Have Not Been Authorized to Approve");
     //die;
    }

    $data = [];
    $data['applyingas_list']      = $this->abs->get_applyas();
    $data['resource_list']        = $this->abs->get_resource_types();
    $data['researchtype_list']    = $this->abs->get_research_types();
    $data['purposes_list']        = $this->abs->get_purposes();
    $data['conservestatus_list']  = $this->abs->get_iucn_red_list();
    $data['sample_uom_list']      = $this->abs->get_sample_uom();

    $data['yesno_list']      = [];
    $data['yesno_list']['']  = 'Choose option';
    $data['yesno_list'][1]   = 'Yes';
    $data['yesno_list'][2]   = 'No';

    $data['positions']      = [];
    $data['positions']['']  = 'Choose option';
    $data['positions'][1]   = 'Yes';
    $data['positions'][2]   = 'No';

    $data['export_answer_list']      = [];
    $data['export_answer_list']['']  = 'Choose option';
    $data['export_answer_list'][1]   = 'Yes';
    $data['export_answer_list'][2]   = 'No';

    $data_raw   = $this->applications->get_by_id($id);
    $researcher = $this->researcher->get_researcher_by_email($data_raw->email);
    
    $urlphoto           = valueof($researcher, 'urlphoto'); 
    $data['urlphoto']   = str_replace($this->baseurl,FCPATH,$urlphoto); 
	
    $approvalstep_desc   =  $this->abs->get_step_description( $my_approvalstep );

      if($data_raw){
       foreach($data_raw as $field=>$value){
        $data[$field]      = isJSON($value) ? json_decode($value , true) : $value;
       }
      }

     $this->load->library('pdfgenerator');
     $html     = $this->load->view("application_form_view.php", $data, true);

     $filename = "ABS_PERMIT_REF_{$data_raw->appno}";
     $this->pdfgenerator->generate($html, $filename, true, 'A4', 'portrait');

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
       }elseif(strstr($field,'aprcomment')){
        $data['aprcomments'][$field]      =  $value;
       }elseif(strstr($field,'discomment')){
        $data['discomments'][$field]      =  $value;
       }
      }
     }

     $this->load->view('approvals_view', $data);

    }

    public function consult()
    {

    $id                =  $this->input->post('id');
    $appno             =  $this->input->post('appno');
    $consult_with      =  $this->input->post('consult_with');
    $subject           =  $this->input->post('subject');
    $message_body      =  $this->input->post('message');
    $consultdocs       =  $this->input->post('consultdocs');
    $username          =  $this->session->userdata('username');

    if(empty($appno)){
     echo json_response(0,"Select an Application");
     die;
    }

    if(empty($subject)){
     echo json_response(0,"Enter Consultation Subject");
     die;
    }

    if(empty($message_body)){
     echo json_response(0,"Enter Consultation Message");
     die;
    }

    if(empty($consult_with)){
     echo json_response(0,"Select Organization to Consult with");
     die;
    }

    $approvalsteps     =  $this->abs->get_approval_steps( );
    $instcode          =  $this->session->userdata('instcode');//instcode
    $my_approvalstep   =  $this->abs->my_approvalstep( $instcode );
    $data_raw          =  $this->applications->get_by_id($id);
    $data = [];

    if($data_raw){
     foreach($data_raw as $field=>$value){
      if(strstr($field,'document') || strstr($field,'export')){
       $data[$field]      = isJSON($value) ? json_decode($value , true) : $value;
      }
     }
    }

    foreach($consult_with as $stepno ){
     $approver_instcode       = $this->abs->get_approver( $stepno );
     $main_approver           = $this->abs->get_institutions_main_approver( $approver_instcode );
     $main_approver_email     = $main_approver->email;
     $main_approver_username  = $main_approver->username;

     $main_approver_email  = 'abspermitsprototype@gmail.com';
     $message = self::make_email_body_notification( $data_raw , $username, $message_body, $main_approver_username, $main_approver_email );
     $this->common->queue_mail( $main_approver_email, $subject, $message );

    }//loop

    echo json_response(1,"Consultation Sent");

   }

    public function approve()
    {

	$id                =  $this->input->post('id');
	$appno             =  $this->input->post('appno');
	$route_to          =  $this->input->post('route_to');
	$comments          =  $this->input->post('comments');
	
	if(empty($route_to)){
	 echo json_response(0,"Select Route to Institution");
	 die;	
	}
	
	$userid            = $this->session->userdata('userid');
	$user              =  $this->user->read( $userid );
	$approvalsteps     =  $this->abs->get_approval_steps( );



	$next_approvalstep       =  $route_to;
	$next_approvalstep_name  =  valueof($approvalsteps, $next_approvalstep);
	$next_approvalstep_name  = !empty($next_approvalstep_name) ? $next_approvalstep_name : $my_approvalstep_name;
	$next_instcode           = $this->abs->get_approver( $next_approvalstep );
	$next_approver           = $this->abs->get_institutions_main_approver( $next_instcode,$rolecode = 'IA' );
	
	$this->applications->dataview      = 'viewapplications';
	$application             =  $this->applications->get_by_id($id);

	$pending_approvals = [];

	$data['routed']           = 1;
	$data['instcode']         = $next_instcode;
	$data['routed_time']      = time();
	$data['routed_comments']  = $comments;

	$this->applications->update( ['id' => $id], $data );
     
    $subject = "ABS Application Reference {$application->appno} Routed to your inbox";
    $message = self::make_email_body_routed( $next_approver->username, $next_approver->email,$user->username, $next_approver->username, $application->appno );
    $this->common->queue_mail( $next_approver->email, $subject, $message ,$next_approver->username);
    
    echo json_response(1,"Application routed to {$next_approver->username}");
   
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
     echo json_response(0,"Disapproval failed beacuse {$done_approvals_str} has already approved");
     die;
    }

     /*approve next col*/
     if( !empty($my_approvalstep) ){

     $column_approval  = "approved{$my_approvalstep}";
     $column_reason    = "discomment{$my_approvalstep}";
     $column_approver  = "approver{$my_approvalstep}";
     $column_time      = "approvetime{$my_approvalstep}";

     $data                    = [];
     $data[$column_approval]  = 0;
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
   
 

   private function notify_disapproved($id, $stepname_current ,$reason){

     $application       = $this->applications->get_by_id($id);

    /**
     *applicant
    */
    $subject = "ABS Application Reference {$application->appno}";
    $message = self::make_email_body_disapprove_applicant( $application->firstname, $application->email,$stepname_current ,$reason , $application->appno  );
    $this->common->queue_mail( $application->email, $subject, $message ,$application->firstname);

   }
 
   private function make_email_body_routed( $fullname, $email,$from_username, $route_to_name, $appno ){

          $this->config->load('product');

          $companyname   = $this->config->item('companyname');
          $productname   = $this->config->item('productname');
          $host          = base_url();
          $url           = "{$host}#Workflow/{$appno}";

          return  <<<HTML

          <table id="" style="font-family:Verdana;font-size:14px"  cellpadding="5"  cellspacing="2"   width="100%" border="0">

          <tr>
           <td><h2>Hi {$fullname}</h2></td>
          </tr>

          <tr>
           <td><br><b>{$from_username}</b> has Routed a Harmonized ABS Application Reference Number <b>{$appno}</b> to {$route_to_name}.<br>
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
           <br>The dis-approval reason was :<b>{$reason}</b><br>
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

   private function make_email_body_notification( $data_raw , $fromnamne, $message_body, $main_approver_username, $main_approver_email ){

          $this->config->load('product');

          $companyname   = $this->config->item('companyname');
          $productname   = $this->config->item('productname');
          $host          = base_url();
          $url           = "{$host}#workflow";

          return  <<<HTML

          <table id="" style="font-family:Verdana;font-size:14px"  cellpadding="5"  cellspacing="2"   width="100%" border="0">

          <tr>
           <td><h2>Hi {$main_approver_username}</h2></td>
          </tr>

          <tr>
           <td>You have a new consultation from {$fromnamne}</td>
          </tr>

          <tr>
           <td>{$message_body}<br>
          </tr>

          <tr>
           <td>
            <table>
             <tr>
              <td>Application Reference</td>
              <td>{$data_raw->appno}</td>
             </tr>

             <tr>
              <td>Applicant Name</td>
              <td>{$data_raw->firstname} {$data_raw->lastname}</td>
             </tr>

             <tr>
              <td>Applicant County</td>
              <td>{$data_raw->ctnname}</td>
             </tr>

             <tr>
              <td>Applied As</td>
              <td>{$data_raw->applyingasname}</td>
             </tr>

             <tr>
              <td>Email</td>
              <td>{$data_raw->email}</td>
             </tr>

             <tr>
              <td>Mobile</td>
              <td>{$data_raw->mobile}</td>
             </tr>

            </table>
          </tr>

          <tr>
           <td>To view the ABS PERMIT Application, <a href="{$url}">click here</a> </td>
          </tr>

          <tr>
           <td><br>If you received this email in error, you can safely ignore this email.</td>
          </tr>

          <tr>
           <td><br>Best regards  <hr>  {$companyname}</td>
          </tr>

           <tr>
           <td>
             <br>
            <small style="color:#999">
             This message was sent to {$main_approver_email}  <br>
             From:{$companyname}  <br>
             </small>
           </td>
          </tr>

         </table>

HTML;
 }

 

}
