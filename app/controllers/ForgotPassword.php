<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ForgotPassword extends CI_Controller {

 public function __construct()
    {
        parent::__construct();
        $this->load->model('crud_model','user');
        $this->load->model('Abs_model','abs');
        $this->load->model('Common_model','common');

        $this->user->table = 'sysusers';


    }

  public function index(){
    $this->clear_session();
    $this->load->view('main/forgotpassword_view'  );
  }

  public function clear_session(){

  $array_items = ['logged_in','userid','username','rolecode','rolename','email','mobile','passreset_email'];
  $this->session->unset_userdata($array_items);

  }

  public function reset(){

   $email  = $this->input->post('email');
   $mobile = $this->input->post('mobile');

   $this->clear_session();

   //get user
   $user = $this->db->select('*')
     ->from('sysusers')
     ->where("email='{$email}' ")
     ->get();

     if($user->num_rows() == 0){
      exit("Account Not Found");
     }

    //$company     = $this->hr->get_company();
    $companyname = 'ABS';

    $row        = $user->row();
    $fullname   = $row->username;
    $resetcode  = generateRandomString(10);

    $this->db->query("update sysusers set resetcode='{$resetcode}' where email='{$email}' ");

    $subject    = "Password Reset Link";
    $message    = self::make_email_body_notify(  $fullname ,$email , $resetcode, $companyname );

    $this->common->queue_mail( $email, $subject, $message );

    $data['success']  = 0;
    $data['message']  = "We sent password reset verification link to {$email} .Check your inbox for the verification email. If not found , please check you SPAM folder.";

    $this->load->view( 'main/password/message_verification_view' , $data );

  }

  public function verification( $resetcode ){
      $this->clear_session();

      $email       = $this->input->get('email');

      $user        = $this->db->select("resetcode, email")->get_where( 'sysusers' , [ 'email' => $email ] )->row();

       if(!isset($user) || !isset($user->resetcode)){
        die("Invalid Password Reset Verification Code. Verify from the email we sent to your inbox");
       }

       if($user->resetcode == $resetcode){
        $this->db->query("update sysusers set resetcode=null where email='{$email}' ");
       }else{
        die("Invalid Password Reset Verification Code. Verify from the email we sent to your inbox");
       }

      $register_data['passreset_email']   = $email;

      $this->session->set_userdata( $register_data );

      redirect( base_url() .'ForgotPassword/initreset' );

   }

  public function initreset(){

    $email           = $this->session->userdata('passreset_email');

    if(empty($email)) exit('Ops!');

    $this->config->load('product');
    $companyname         = $this->config->item('companyname');
    $productname         = $this->config->item('productname');
    $data                = [];
    $data['email']       = $email;
    $data['productname'] = $productname;
    $data['companyname'] = $companyname;

    $this->load->view( 'main/password/reset_view' , $data );
  }

  public function do_reset(){

    $email           = $this->session->userdata('passreset_email');
    $password        = $this->input->post('password');
    $passwordconfirm = $this->input->post('passwordconfirm');

    if(empty($email) || empty($password)|| empty($passwordconfirm)) exit('Ops!');

    $this->config->load('product');
    $companyname         = $this->config->item('companyname');
    $productname         = $this->config->item('productname');

    $data                = [];
    $data['password']    = sha1($password);

    $this->user->update( ['email' => $email], $data );

    $this->clear_session();

    $companyname             = $this->config->item('companyname');
    $productname             = $this->config->item('productname');
    $response['message']     = "Your password has been reset.";
    $response['productname'] = $productname;
    $response['companyname'] = $companyname;

    $this->load->view( 'main/password/message_done_view' , $response );

  }


  private function make_email_body_notify( $fullname, $email, $resetcode , $companyname ){

          $this->config->load('product');

          $companyname   = $this->config->item('companyname');
          $productname   = $this->config->item('productname');
          $host          = base_url();
          $url           = "{$host}ForgotPassword/verification/{$resetcode}/?email={$email}";

          return  <<<HTML

          <table id="" style="font-family:Verdana;font-size:14px"  cellpadding="5"  cellspacing="2"   width="100%" border="0">

          <tr>
           <td><br>Hello {$fullname} <br> </td>
          </tr>

          <tr>
           <td><br><a href="{$url}">Click here</a> to reset your password for {$productname}.</td>
          </tr>

          <tr>
           <td><br>If you have any questions have a look at our online FAQ or call our customer service team during working hours.</td>
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

  private function make_email_body( $fullname , $email , $subdomain_url ){

          $this->config->load('product');

          $companyname   = $this->config->item('companyname');
          $productname   = $this->config->item('productname');

          return  <<<HTML

          <table id="" style="font-family:Verdana;font-size:14px"  cellpadding="5"  cellspacing="2"   width="100%" border="0">

          <tr>
           <td><br>Hello {$fullname} <br> </td>
          </tr>

          <tr>
           <td><br>Thank you for Creating a Company Account with {$companyname} <br> </td>
          </tr>

          <tr>
           <td><br>To Access your {$productname}, <a href="{$subdomain_url}" target="_blank" >Click here</a>.</td>
          </tr>

          <tr>
           <td><br>If you have any questions have a look at our online FAQ or call our customer service team during working hours.</td>
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
