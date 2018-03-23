<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('crud_model','signups');
        $this->load->model('Common_model','common');

        $this->signups->table  = 'signups';

    }

    public function index(){
     $this->reset();
     $data = [];
     $data['countries']  =  $this->Common_model->select_assoc(  'countries',  'ctncode',  'ctnname' );
     $data['genders']    =  ['male' => 'Male','female' => 'female'];
     $this->load->view('main/frontend/signup', $data );
    }

    public function reset(){

    $array_items = ['clientid','email','subdomain','fullname'];
    $this->session->unset_userdata($array_items);

    }

   public function save(){

     $firstname        = $this->input->post('firstname');
     $lastname         = $this->input->post('lastname');
     $gender           = $this->input->post('gender');
     $ctncode          = $this->input->post('ctncode');
     $mobile           = $this->input->post('mobile');
     $email            = $this->input->post('email');
     $password         = $this->input->post('password');
     $passwordconfirm  = $this->input->post('passwordconfirm');
     $terms            = $this->input->post('terms');
     $password_check   = sha1($password);

     //$this->db->where('email',$email)->delete( 'signups' );

     $response['success']  = 0;
     $response['message']  = '';

     $signups = $this->db->select('email,verified')
     ->from('signups')
     ->where("email='{$email}' ")
     ->get();

     $row    = $signups->row();

    if(isset($row)){

     $extra = "<hr>We sent  email verification link to {$email} .Check your inbox for the verification email. If not found , please check you SPAM folder.";

     if(isset($row->verified) && $row->verified==1){
      $extra = "<hr>Click here <a href=\"login.html\" class=\"btn btn-danger\">Sign In</a> ";
     }

     $response['success'] = 0;
     $response['message'] = "{$email} is already registered.";
     $response['extra']   =  $extra;
     //$this->load->view( 'main/frontend/register_error' , $data );
    }else{

    $verifycode           = generateRandomString(10);

    $signups                = [];
    $signups['firstname']   = $firstname;
    $signups['lastname']    = $lastname;
    $signups['gender']      = $gender;
    $signups['ctncode']     = $ctncode;
    $signups['mobile']      = $mobile;
    $signups['email']       = $email;
    $signups['password']    = sha1($password);
    $signups['verifycode']  = $verifycode;

    $this->signups->save($signups);

    $response['success']  = 1;
    $response['message']  = "We sent  email verification link to {$email} .Check your inbox for the verification email. If not found , please check you SPAM folder.";

    $subject = "ABS Email Verification ";//Account Registration
    $message = self::make_email_body_notify( $firstname ,$email , $verifycode );

    $this->common->queue_mail( $email, $subject, $message );

    }

    echo json_encode( $response );

  }

   public function verification( $verifycode ){
      $this->reset();

      $email            = $this->input->get('email');

     //verify
      $signups        = $this->db->select("*")->get_where( $this->signups->table , [ 'email' => $email ] )->row();

      if(isset($signups) && isset($signups->verifycode)){


        //if verified, login
       if($signups->verified == 1 && $signups->hasuploads == 1){
        redirect( base_url() .'login' );
       }

       if($signups->verifycode == $verifycode){
         $this->db->query( "update {$this->signups->table} set verified=1  where email='{$email}' " );
       }else{
          die("Invalid Verification Code. Verify from the email we sent to your inbox");
       }
      }


      $register_data               = [];
      $register_data['email']      = $signups->email;
      $register_data['firstname']  = $signups->firstname;
      $register_data['lastname']   = $signups->lastname;

      $this->session->set_userdata( $register_data );

      redirect( base_url() .'signup/profile/'.$verifycode );

   }

   /*
    *http://abs.co.ke/signup/verification/Wxt6YN40oQ/?email=ekariz@gmail.com
    * */
   public function profile( $verifycode ){

     $email             = $this->session->userdata('email');
     $signup            = $this->db->select("*")->get_where( $this->signups->table , [ 'email' => $email ,'verifycode' => $verifycode ] )->row();

     $data = [];
     $data['countries']   =  $this->Common_model->select_assoc(  'countries',  'ctncode',  'ctnname' );
     $data['genders']     =  ['male' => 'Male','female' => 'female'];
     $data['firstname']   = $signup->firstname;
     $data['lastname']    = $signup->lastname;
     $data['gender']      = $signup->gender;
     $data['ctncode']     = $signup->ctncode;
     $data['mobile']      = $signup->mobile;
     $data['email']       = $signup->email;
     $data['docid']       = isJSON($signup->docid) ? json_decode($signup->docid , true) : [];
     $data['docpassport'] = isJSON($signup->docpassport) ? json_decode($signup->docpassport , true) : [];

     $this->load->view('main/frontend/signup-profile', $data );
    }

    public function uploads( ){

      $required_docs  = 2;
      $email          = $this->session->userdata('email');
      $signup         = $this->db->select("*")->get_where( $this->signups->table , [ 'email' => $email ] )->row();

       $upload_dir           = "./uploads/userdocs/";

        if(!is_dir($upload_dir)){
         if (!mkdir($upload_dir, 0777, true)) {
          echo json_encode( ["success" => 0, 'message' => 'Failed to create folders...'] );
          die;
         }
        }

        $config['upload_path']          = $upload_dir;
        $config['allowed_types']        = 'gif|jpg|jpeg|png';
        $config['remove_spaces']        = true;
        $config['overwrite']            = true;
        $config['encrypt_name']         = true;
        $config['file_ext_tolower']     = true;

        $this->load->library('upload', $config);

        $documents_id =  '';
        $documents_passport =  '';
        $documents_id_str =  '';
        $documents_passport_str =  '';

        if ($this->upload->do_upload('myid')){
         $documents_id        = $this->upload->data();
         $documents_id_str   = json_encode($documents_id);
        }

        if ($this->upload->do_upload('passport')){
         $documents_passport     = $this->upload->data();
         $documents_passport_str = json_encode($documents_passport);
        }

       $hasuploads             =  0;

       if(!empty($documents_id)){
        $data['docid'] = $documents_id_str;
        $hasuploads +=1;
       }

       if(!empty($documents_passport)){
        $data['docpassport'] = $documents_passport_str;
        $hasuploads +=1;
       }

       if($hasuploads<$required_docs){
        echo json_encode( ["success" => 0, 'message' => 'Upload all required documents' ] );
        die;
       }

       if(!empty($data)){
         $this->signups->update( ['email' => $email], $data);
       }

       $user_data = [];
       $user_data['userid']     = $signup->id;
       $user_data['ctncode']    = $signup->ctncode;
       $user_data['firstname']  = $signup->firstname;
       $user_data['lastname']   = $signup->lastname;
       $user_data['email']      = $signup->email;
       $user_data['mobile']     = $signup->mobile;
       $user_data['gender']     = $signup->gender;
       $user_data['logged_in']  = 1;

       $this->session->set_userdata( $user_data );

       //notify
       $subject = "ABS Sign Up Complete";//Account completion
       $message = self::make_email_body_complete( $signup->firstname, $signup->email );
       $this->common->queue_mail( $email, $subject, $message );

       echo json_encode( ["success" => 1, 'message' => 'Documents Uploaded' ] );

   }

    public function saveProfile( ){

       $required_docs  = 2;
       $email          = $this->session->userdata('email');
       $signup         = $this->db->select("*")->get_where( $this->signups->table , [ 'email' => $email ] )->row();
       $upload_dir     = "./uploads/userdocs/";

        if(!is_dir($upload_dir)){
         if (!mkdir($upload_dir, 0777, true)) {
          echo json_encode( ["success" => 0, 'message' => 'Failed to create folders...'] );
          die;
         }
        }

        $config['upload_path']          = $upload_dir;
        $config['allowed_types']        = 'gif|jpg|jpeg|png';//alert if not type
        $config['remove_spaces']        = true;
        $config['overwrite']            = true;
        $config['encrypt_name']         = true;
        $config['file_ext_tolower']     = true;

        $this->load->library('upload', $config);

        $documents_id       = [];
        $documents_passport = [];
        $data               = [];

        if ($this->upload->do_upload('myid')){
         $document    = $this->upload->data();
         $documents_id = $document;
        }

        if ($this->upload->do_upload('passport')){
         $document    = $this->upload->data();
         $documents_passport = $document;
        }

       $documents_id_str       = json_encode($documents_id);
       $documents_passport_str = json_encode($documents_passport);
       $numuploads             =  0;

       if(!empty($documents_id)){
        $data['docid'] = $documents_id_str;
        $numuploads +=1;
       }

       if(!empty($documents_passport)){
        $data['docpassport'] = $documents_passport_str;
        $numuploads +=1;
       }

       $data['hasuploads']   = $numuploads;

       if(!empty($data)){
         $this->signups->update( ['email' => $email], $data );
       }


       if($numuploads<$required_docs){
        $subject = "ABS Complete Your profile ";//Account completion
        $message = self::make_email_body_save_continue( $signup->firstname, $signup->email, $signup->verifycode );
        $this->common->queue_mail( $email, $subject, $message );
       }

       if(!empty($data)){
        $success = 1;
        $message = 'Saved.We sent email with a link to continue uploading all documents';
       }else{
        $success = 0;
        $message = 'Nothing Saved';
       }

       echo json_encode( [ 'success' => $success, 'message' => $message ] );

   }

   private function make_email_body_notify( $firstname, $email, $verifycode ){

          $this->config->load('product');

          $companyname   = $this->config->item('companyname');
          $productname   = $this->config->item('productname');
          $host          = base_url();
          $url           = "{$host}signup/verification/{$verifycode}/?email={$email}";

          return  <<<HTML

          <table id="" style="font-family:Verdana;font-size:14px"  cellpadding="5"  cellspacing="2"   width="100%" border="0">

          <tr>
           <td><h2>ABS Account Registration</h2></td>
          </tr>

          <tr>
           <td><br>Hello {$firstname} <br> </td>
          </tr>

          <tr>
           <td><br>An account has been created for you at {$productname}  Portal.<br>
            Please follow the link below to activate your account.<br>
            Activation Link >> <a href="{$url}">Activate your Account</a><br>
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

   private function make_email_body_save_continue( $firstname, $email, $accesscode ){

          $this->config->load('product');

          $companyname   = $this->config->item('companyname');
          $productname   = $this->config->item('productname');
          $host          = base_url();
          $url           = "{$host}signup/profile/{$accesscode}/?email={$email}";

          return  <<<HTML

          <table id="" style="font-family:Verdana;font-size:14px"  cellpadding="5"  cellspacing="2"   width="100%" border="0">

          <tr>
           <td><h2>ABS Account Registration</h2></td>
          </tr>

          <tr>
           <td><br>Hello {$firstname} <br> </td>
          </tr>

          <tr>
           <td><br>Your signed up with {$productname}  Portal.<br>
            Please follow the link below to complete your signup.<br>
             <a href="{$url}">Complete Signup</a><br>
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

   private function make_email_body_complete( $firstname, $email ){

          $this->config->load('product');

          $companyname   = $this->config->item('companyname');
          $productname   = $this->config->item('productname');
          $host          = base_url();
          $url           = "{$host}ApplicationForm?email={$email}";

          return  <<<HTML

          <table id="" style="font-family:Verdana;font-size:14px"  cellpadding="5"  cellspacing="2"   width="100%" border="0">

          <tr>
           <td><h2>ABS Signup</h2></td>
          </tr>

          <tr>
           <td><br>Hello {$firstname} <br> </td>
          </tr>

          <tr>
           <td><br>Your signed up with {$productname}  is now Complete.<br>
            To apply for an ABS PERMIT, please open the <a href="{$url}"> ABS Harmonized Application Form</a><br>
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

 }
