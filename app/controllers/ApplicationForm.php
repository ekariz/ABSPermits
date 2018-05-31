<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApplicationForm extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('crud_model','apps');
        $this->load->model('crud_model','temp');
        $this->load->model('Common_model','common');
        $this->load->model('Abs_model','abs');

        $this->apps->table  =  'applications';
        $this->temp->table  =  'applicationstmp';
    }

   public function index(){

     $email             = $this->session->userdata('email');

     if(empty($email)){
       redirect( base_url() .'login' );
     }

     $signup            = $this->db->select("firstname,lastname,gender,ctncode,mobile,email")->get_where( 'signups', [ 'email' => $email  ] )->row();
     $presaved_data     = $this->db->select("*")->get_where( $this->temp->table, [ 'email' => $email  ] )->row();
     $colums             = $this->db->list_fields( $this->temp->table );
     $data               = [];
     $data['stepnumber'] = 0;
     /**
      * get alll db cols as data array keys
      */
     if($colums){
      if(sizeof($colums)>0){
        foreach($colums as $colum){
          $data[$colum] = null;
         }
      }
     }

     if($signup){
     $data['firstname']  = $signup->firstname;
     $data['lastname']   = $signup->lastname;
     $data['gender']     = $signup->gender;
     $data['ctncode']    = $signup->ctncode;
     $data['mobile']     = $signup->mobile;
     $data['email']      = $signup->email;
     }

     //if($presaved_data){
      //foreach($presaved_data as $field=>$value){
       //$data[$field]      = isJSON($value) ? json_decode($value , true) : $value;
      //}
     //}

    $data['paids']     = [];
    $data['payrefs']   = [];
    $data['paytimes']  = [];
    $data['paymodes']  = [];

    if($presaved_data){
     foreach($presaved_data as $field=>$value){

      if(strstr($field,'paid')  ){
       $data['paids'][$field] = $value;
      }elseif(strstr($field,'payref')  ){
       $data['payrefs'][$field] = $value;
      }elseif(strstr($field,'paytime')  ){
       $data['paytimes'][$field] = $value;
      }elseif(strstr($field,'paymode')  ){
       $data['paymodes'][$field] = $value;
      }else{
       $data[$field]      = isJSON($value) ? json_decode($value , true) : $value;
      }
     }
    }


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

     $data['approvalsteps']  =  $this->abs->get_approval_steps( );
     $data['charges']        =  $this->abs->get_institutions_charges( );

     $this->load->view('main/frontend/appform/main_view', $data );

    }

   public function payments(){

     $email             = $this->session->userdata('email');

     if(empty($email)){
       redirect( base_url() .'login' );
     }

     $signup            = $this->db->select("firstname,lastname,gender,ctncode,mobile,email")->get_where( 'signups', [ 'email' => $email  ] )->row();
     $presaved_data     = $this->db->select("*")->get_where( $this->temp->table, [ 'email' => $email  ] )->row();
     $colums             = $this->db->list_fields( $this->temp->table );
     $data               = [];
     $data['stepnumber'] = 0;
     /**
      * get alll db cols as data array keys
      */
     if($colums){
      if(sizeof($colums)>0){
        foreach($colums as $colum){
          $data[$colum] = null;
         }
      }
     }

     if($signup){
     $data['firstname']  = $signup->firstname;
     $data['lastname']   = $signup->lastname;
     $data['gender']     = $signup->gender;
     $data['ctncode']    = $signup->ctncode;
     $data['mobile']     = $signup->mobile;
     $data['email']      = $signup->email;
     }

    $data['paids']     = [];
    $data['payrefs']   = [];
    $data['paytimes']  = [];
    $data['paymodes']  = [];

    if($presaved_data){
     foreach($presaved_data as $field=>$value){

      if(strstr($field,'paid')  ){
       $data['paids'][$field] = $value;
      }elseif(strstr($field,'payref')  ){
       $data['payrefs'][$field] = $value;
      }elseif(strstr($field,'paytime')  ){
       $data['paytimes'][$field] = $value;
      }elseif(strstr($field,'paymode')  ){
       $data['paymodes'][$field] = $value;
      }else{
       $data[$field]      = isJSON($value) ? json_decode($value , true) : $value;
      }
     }
    }

    $data['approvalsteps']  =  $this->abs->get_approval_steps( );
    $data['charges']        =  $this->abs->get_institutions_charges( );

     $this->load->view("main/frontend/appform/steps/payment_view", $data );

    }



   public function confirmation(){

     $email             = $this->session->userdata('email');

     if(empty($email)){
       redirect( base_url() .'login' );
     }

     $signup            = $this->db->select("firstname,lastname,gender,ctncode,mobile,email")->get_where( 'signups', [ 'email' => $email  ] )->row();
     $presaved_data     = $this->db->select("*")->get_where( $this->temp->table, [ 'email' => $email  ] )->row();
     $colums             = $this->db->list_fields( $this->temp->table );
     $data               = [];
     $data['stepnumber'] = 0;
     /**
      * get alll db cols as data array keys
      */
     if($colums){
      if(sizeof($colums)>0){
        foreach($colums as $colum){
          $data[$colum] = null;
         }
      }
     }

     if($signup){
     $data['firstname']  = $signup->firstname;
     $data['lastname']   = $signup->lastname;
     $data['gender']     = $signup->gender;
     $data['ctncode']    = $signup->ctncode;
     $data['mobile']     = $signup->mobile;
     $data['email']      = $signup->email;
     }

     if($presaved_data){
      foreach($presaved_data as $field=>$value){
       $data[$field]      = isJSON($value) ? json_decode($value , true) : $value;
      }
     }

//print_pre($data);//remove

     $this->load->view('main/frontend/appform/steps/finish_view', $data );

    }

   /**
    * auto-save step fields on successful verification
    */
   public function autosave(){

     $email              = $this->session->userdata('email');

     if(empty($email)) return;

     $colums             = $this->db->list_fields( $this->temp->table );
     $data               = [];

     if($colums){
      if(sizeof($colums)>0){
        foreach($colums as $column){
         if(isset($_POST[$column])){
          $value = $this->input->post( $column );
          $data[$column] = is_array($value) ? json_encode($value) : $value;
         }
        }

       if(!empty($data)){
        if( $this->db->get_where( $this->temp->table  , ['email' => $email] )->num_rows() > 0 ) {
         $this->temp->update( ['email' => $email], $data );
        }else{
         $data['email'] = $email;
         $this->temp->save($data);
        }
       }

      }
     }
     echo 'OK';

  }

   public function upload(){

    $email              = $this->session->userdata('email');

    if(empty($email)){
     echo json_encode( ["success" => 0, 'message' => "login session expired.Please re-login" ] );
     die;
    }

    /**
     * presave form
     */

    if(isset($_FILES)){

        $folderid    = sha1($email);
        $upload_dir  = "./uploads/appdocs/{$folderid}";

        if(!is_dir($upload_dir)){
         if (!mkdir($upload_dir, 0777, true)) {
          echo json_encode( ["success" => 0, 'message' => 'Failed to create folders...'] );
          die;
         }
        }

        $config['upload_path']          = $upload_dir;
        $config['allowed_types']        = 'pdf';
        $config['encrypt_name']         = true;
        $config['remove_spaces']        = true;
        $config['overwrite']            = true;
        $config['file_ext_tolower']     = true;

        $this->load->library('upload', $config);

        $expected_files =  [];
        $expected_files['documentregistration']      = 'Company Registration Document';
        $expected_files['documentresearchproposal']  = 'Research Proposal';
        $expected_files['documentaffiliation']       = 'Letter of Affiliation With local institution';
        $expected_files['documentresearchbudget']    = 'Research Budget ';
        $expected_files['documentcv']                = 'Curriculum Vitae';
        $expected_files['documentpic']               = 'Prior Informed Consent (PIC)';
        $expected_files['documentmat']               = 'Mutually Agreed Terms (MAT)';
        $expected_files['documentmta']               = 'Material Transfer Agreement';
        $expected_files['documentip']                = 'Import Permit';

        $documents =  [];

        foreach($expected_files as $expected_file_id => $expected_file_name){
          if( isset($_FILES[$expected_file_id]) && isset($_FILES[$expected_file_id]['tmp_name']) && !empty($_FILES[$expected_file_id]['tmp_name']) ){
           if($this->upload->do_upload($expected_file_id)){
            $upload_response              = $this->upload->data();
            $documents[$expected_file_id] = json_encode($upload_response);
           }else{
            $error =  $this->upload->display_errors();
            $error = strip_tags($error);
            echo json_encode( ["success" => 0, 'message' => "{$expected_file_name}:".$error ] );
            die;
           }
         }
        }

       if(sizeof($documents)>0)
       {
       $num_documents          = count($documents);
       $documents_ids          = array_keys($documents);
       $this->temp->update( ['email' => $email], $documents );
       echo json_response( 1,  "Uploaded {$num_documents} documents" ,[ 'documents' => $documents_ids] );
       die;
       }

    }

    echo json_encode( ["success" => 0, 'message' => "Nothing Uploaded"] );
    die;
   }

   public function remove( $type, $id ){
    $email              = $this->session->userdata('email');
    if(empty($email)) return;

    $folderid    = sha1($email);
    $file        = FCPATH ."uploads/appdocs/{$folderid}/{$id}";

    if(is_readable($file)){
     if(unlink($file)){
      $data[$type] = null;
      $this->temp->update( ['email' => $email ], $data );
     }
    }

    $this->confirmation();


   }

   public function ViewFile( $id ){
    $email              = $this->session->userdata('email');
    if(empty($email)) return;

    $folderid    = sha1($email);
    $file        = FCPATH ."uploads/appdocs/{$folderid}/{$id}";

    if(is_readable($file)){

    $this->load->helper('download');
    $this->load->helper('file');

    force_download( $file , NULL);

    }

   }

   public function save(){

     $email             = $this->session->userdata('email');

     if(empty($email)){
       die(json_response(0, 'Session Expired.refresh page to login'));
     }

    $signup            = $this->db->select("firstname,lastname,gender,ctncode,mobile,email")->get_where( 'signups', [ 'email' => $email  ] )->row();
    $presaved_data     = $this->db->select("*")->get_where( $this->temp->table, [ 'email' => $email  ] )->row();

    $documentregistration        = !empty($presaved_data->documentregistration) ? json_decode($presaved_data->documentregistration, true) : null;
    $documentresearchproposal    = !empty($presaved_data->documentresearchproposal) ? json_decode($presaved_data->documentresearchproposal, true) : null;
    $documentaffiliation         = !empty($presaved_data->documentaffiliation) ? json_decode($presaved_data->documentaffiliation, true) : null;
    $documentaffiliation         = !empty($presaved_data->documentaffiliation) ? json_decode($presaved_data->documentaffiliation, true) : null;
    $documentresearchbudget      = !empty($presaved_data->documentresearchbudget) ? json_decode($presaved_data->documentresearchbudget, true) : null;
    $documentcv                  = !empty($presaved_data->documentcv) ? json_decode($presaved_data->documentcv, true) : null;
    $documentpic                 = !empty($presaved_data->documentpic) ? json_decode($presaved_data->documentpic, true) : null;
    $documentmat                 = !empty($presaved_data->documentmat) ? json_decode($presaved_data->documentmat, true) : null;
    $documentmta                 = !empty($presaved_data->documentmta) ? json_decode($presaved_data->documentmta, true) : null;

    $documentregistration_id        =  valueof($documentregistration, 'file_name');
    $documentresearchproposal_id    =  valueof($documentresearchproposal, 'file_name');
    $documentaffiliation_id         =  valueof($documentaffiliation, 'file_name');
    $documentresearchbudget_id      =  valueof($documentresearchbudget, 'file_name');
    $documentcv_id                  =  valueof($documentcv,  'file_name');
    $documentpic_id                 =  valueof($documentpic, 'file_name');
    $documentmat_id                 =  valueof($documentmat, 'file_name');
    $exportanswer                   =  valueof($presaved_data, 'exportanswer', null);
    $geneticresourcerc              =  valueof($presaved_data, 'geneticresourcerc', null);

    $required['position'] = 'Are you a student?';
    $required['applyingas'] = 'Applying As';
    //$required['orchid'] = 'ORCHID';
    $required['legalofficername'] = 'Institution Legal Officer Name:';
    $required['legalofficeremail'] = 'Institution Legal Officer Email';
    $required['geneticresourcerc'] = 'Will you be  exporting a genetic resource from Kenya? ';
    $required['resourcetype'] = 'Type of genetic resource to be collected *';
    $required['speciesname'] = 'Species name of the genetic resource to be collected *:';
    $required['commonname'] = 'Common/vernacular name of the generic resource to be collected *:';
    $required['projectlocation'] = 'Location or project area for genetic resource collection *:';
    $required['projectarea'] = 'Is the project area inside a conservation area, gazetted forest or protected area? *:';
    //$required['resourceallocationpurpose'] = 'Purpose of genetic resource collection *:';
    $required['purpose'] = 'Purpose of collection';
    $required['researchtype'] = 'Type of Research to be Carried out';
    $required['samplesamount'] = 'Amount of proposed samples to be collected';
    $required['sampleuom'] = 'Proposed samples Unit of Measure';
    $required['conservestatus'] = 'Select the conservation status of the sample to be collected';
    $required['conservestatusdesc'] = 'Describe the conservation status of the sample to be collected';
    $required['restraditionalknow'] = 'Will research on traditional knowledge is to be collected?';
    $required['exportgeneticresources'] = 'Will you need to export the collected genetic resources from kenya?';
    $required['legislationagree'] = 'You Must Agree with the National Legislation of Kenya and conditions for acquiring an ABS permit';

    $required_docs['documentregistration'] = 'Company Registration Document';
    $required_docs['documentresearchproposal'] = 'Research Proposal';
    $required_docs['documentaffiliation'] = 'Letter of Affiliation With local institution';
    $required_docs['documentresearchbudget'] = 'Research Budget ';
    $required_docs['documentcv'] = 'Curriculum Vitae';
    $required_docs['documentpic'] = 'Prior Informed Consent (PIC)';
    $required_docs['documentmat'] = 'Mutually Agreed Terms (MAT) ';

    if($exportanswer==1){
    $required_docs['documentmta'] = 'Material Transfer Agreement (MTA)';
    }

    foreach($required as $fieldid =>$fielddesc){
     $value = $this->input->post( $fieldid );
     if(empty($value)){
       die(json_response(0, "{$fielddesc} Is Required"));
     }
    }

    foreach($required_docs as $docid=>$docdesc){
     if(!isset($presaved_data->$docid)){
       die(json_response(0, "{$docdesc} Is Required"));
     }elseif(empty($presaved_data->$docid)){
       die(json_response(0, "{$docdesc} Is Required"));
     }elseif(!isJSON($presaved_data->$docid)){
       die(json_response(0, "{$docdesc} Is Required"));
     }
    }

    $data = [];
    $paids = [];

    if(sizeof($presaved_data)>0){
     foreach($presaved_data as $col => $val){
      $data[$col] = $val;

      if(strstr($col,'paid')){
       $paids[$col] = $val;
      }

     }
    }

    $approvalsteps  =  $this->abs->get_approval_steps( );
    $num_steps      = count($approvalsteps);
    $num_paid       = 0;
    foreach($approvalsteps as $stepno=>$stepname){
    $col_paid    = "paid{$stepno}";
    $paid        = valueof($paids, $col_paid);
     if($paid==1){
     ++$num_paid;
     }
    }

    if($num_paid<$num_steps){
     $diff = $num_steps - $num_paid;
     die(json_response(0, "You Have Not Yet Paid {$diff} Institutions"));
    }

    unset($data['stepnumber']);

    $appnextid   =  $this->get_next_docno( 'appnos' );
    $appno       =  generateUniqueCode("ABS/",$appnextid,6);
    $appno      .= '-' .date('y');

    $data['appno']    = $appno;
    $data['apptime']  = time();
    $data['success']  = 0;
    $data['message']  = "Something went wrong .Please try again later";

    if(sizeof($data)>0){
    $this->apps->save($data);

    $this->db->where( 'email' , $email )->delete( $this->temp->table  );

    $approver1_instcode      = $this->abs->get_approver( 1 );
    $main_approver           = $this->abs->get_institutions_main_approver( $approver1_instcode );
    $main_approver_email     = $main_approver->email;
    $main_approver_username  = $main_approver->username;

    $subject = "ABS PERMIT Application Successful ";//Account Registration
    $message = self::make_email_body_notification( $signup->firstname, $signup->email, $appno );
    $this->common->queue_mail( $email, $subject, $message );

    $main_approver_email ='abspermitsprototype@gmail.com';
    $subject = "ABS Application Reference #{$appno}";
    $message = self::make_email_body_notification_admin( $main_approver_username, $main_approver_email, $signup->firstname, $signup->email, $appno );
    $this->common->queue_mail( $main_approver_email, $subject, $message );

    $data['success']  = 1;
    $data['message']  = "Application Submited.Your Reference No. is {$appno}";
    }

    echo json_encode($data);

  }


  private  function  get_next_docno( $column_next_docno )
  {
      $table          = 'docnos';
      $docnos         = $this->db->select('*')->get_where( $table );
      $num_rows       = $docnos->num_rows();

      $nextid = 0;

      if( empty($num_rows) ) {
       $nextid                   =  1;
       $data[$column_next_docno] =  $nextid ;
       $this->db->insert( $table , $data);
      }else{
       $row                      =  $docnos->row();
       $nextid                   =  $row->$column_next_docno + 1;
       $data[$column_next_docno] =  $nextid;
       $this->db->update( $table , $data );
      }

      return $nextid;

  }


   private function make_email_body_notification( $firstname, $email, $apprefno ){

          $this->config->load('product');

          $companyname   = $this->config->item('companyname');
          $productname   = $this->config->item('productname');
          $host          = base_url();
          $url           = "{$host}ApplicationsList/viewref/{$apprefno}/?email={$email}";

          return  <<<HTML

          <table id="" style="font-family:Verdana;font-size:14px"  cellpadding="5"  cellspacing="2"   width="100%" border="0">

          <tr>
           <td><h2>ABS Application</h2></td>
          </tr>

          <tr>
           <td><br>Thank you {$firstname} <br> </td>
          </tr>

          <tr>
           <td><br>Your Harmonized Application Reference Number is <b>{$apprefno}</b>.<br>
            Please follow the link below to view the approval progress of your application.<br>
             <a href="{$url}">Track Application</a><br>
            <br> </td>
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

           <tr>
           <td>
             <br>
            <small style="color:#999">
             <a href="{$host}">Home</a> | <a href="{$host}/contacts">Contact Us</a>
             </small>
           </td>
          </tr>

          </table>

HTML;
}

   private function make_email_body_notification_admin( $main_approver_username, $main_approver_email, $applicant_firstname, $applicant_email, $appno  ){

          $this->config->load('product');

          $companyname   = $this->config->item('companyname');
          $productname   = $this->config->item('productname');
          $baseurl       = $this->config->item('baseurl');
          $host          = base_url();
          $url           = "http://admin.{$baseurl}/#Workflow/?email={$main_approver_email}";

          return  <<<HTML

          <table id="" style="font-family:Verdana;font-size:14px"  cellpadding="5"  cellspacing="2"   width="100%" border="0">

          <tr>
           <td><h2>ABS Application</h2></td>
          </tr>

          <tr>
           <td>Hi {$main_approver_username},</td>
          </tr>

          <tr>
           <td><br>{$applicant_firstname} ({$applicant_email})  has submitted a Harmonized ABS Application with Reference Number is <b>{$appno}</b>.
           <br>To view the application, <a href="{$url}">Click Here</a>
            <br> </td>
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
             This message was sent to {$main_approver_email}  <br>
             From:{$companyname}  <br>
             </small>
           </td>
          </tr>

         </table>

HTML;
}



 }
