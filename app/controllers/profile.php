<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('crud_model','signups');
        $this->load->model('Common_model','common');
        $this->signups->table  = 'signups';
    }

    public function index(){

     $email             = $this->session->userdata('email');

     if(empty($email)){
       redirect( base_url() .'login' );
     }

     $signup            = $this->db->select("*")->get_where( $this->signups->table , [ 'email' => $email ,'verifycode' => $verifycode ] )->row();

     $data = [];
     $data['countries']  =  $this->Common_model->select_assoc(  'countries',  'ctncode',  'ctnname' );
     $data['genders']    =  ['male' => 'Male','female' => 'female'];
     $data['firstname']  = $signup->firstname;
     $data['lastname']   = $signup->lastname;
     $data['gender']     = $signup->gender;
     $data['ctncode']    = $signup->ctncode;
     $data['mobile']     = $signup->mobile;
     $data['email']      = $signup->email;

     $this->load->view('main/frontend/profile', $data );
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

     $data['success']  = 0;
     $data['message']  = '';

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

     $data['success'] = 1;
     $data['message'] = "{$email} is already registered.";
     $data['extra']   =  $extra;
     $this->load->view( 'main/frontend/register_error' , $data );
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

    $data['success']  = 0;
    $data['message']  = "We sent  email verification link to {$email} .Check your inbox for the verification email. If not found , please check you SPAM folder.";

    $subject = "ABS Email Verification ";//Account Registration
    $message = self::make_email_body_notify( $firstname ,$email , $verifycode );

    $this->common->queue_mail( $email, $subject, $message );

    $this->load->view( 'main/frontend/register_done' , $data );

    }
  }

    public function uploads( ){

      $email         = $this->session->userdata('email');
      $signup        = $this->db->select("*")->get_where( $this->signups->table , [ 'email' => $email ] )->row();

       $upload_dir_id        = "./uploads/ids/{$signup->id}";
       $upload_dir_passport  = "./uploads/passports/{$signup->id}";
       $upload_dir           = "./uploads/userdocs/{$signup->id}";
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
        //$config['max_size']             = '100';
        //$config['max_width']            = '1024';
        //$config['max_height']           = '768';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('myid')){
         $error =  $this->upload->display_errors();
         echo json_encode( ["success" => 0, 'message' => $error ] );
         die;
        }else{
         $document    = $this->upload->data();
         $documents['id'] = $document;
        }

        if (!$this->upload->do_upload('passport')){
         $error =  $this->upload->display_errors();
         echo json_encode( ["success" => 0, 'message' => $error ] );
         die;
        }else{
         $document    = $this->upload->data();
         $documents['passport'] = $document;
        }

       $documents_str = json_encode($documents);
       $this->db->query( "update {$this->signups->table} set hasuploads=1, documents='{$documents_str}'  where email='{$email}' " );

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

       echo json_encode( ["success" => 1, 'message' => 'Uploaded' ] );

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

 }
