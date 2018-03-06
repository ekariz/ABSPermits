<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('crud_model','login');
    }

    public function index(){
     $this->reset();
     //redirect( base_url() );
     $this->load->view('main/frontend/login'  );
    }

    public function reset(){

    $array_items = ['logged_in','userid','username','rolecode','rolename','email','mobile'];
    $this->session->unset_userdata($array_items);

    }

    public function auth()
    {

     $this->reset();

     $email           = $this->input->post('email');
     $password        = $this->input->post('password');

     if(empty($email)){
      die(json_response(0, 'Enter Your Registered Email Address'));
     }elseif(empty($password)){
      die(json_response(0, 'Enter Your Password'));
     }

     $password_check  = sha1($password);

     $user = $this->db->select('*')
     ->from('signups')
     ->where("email='{$email}' ")
     ->where("password='{$password_check}' ")
     ->get();

    $row    = $user->row();

    if(!isset($row)){
     sleep(1);
     die(json_response(0, 'Wrong User ID or Password'));
    }elseif(isset($row->verified) && empty($row->verified) ){
     sleep(1);
     die(json_response(0, "We sent  email verification link to {$email} .Check your inbox for the verification email. If not found , please check you SPAM folder"));
    }else{

    $user_data = [];
    $user_data['userid']     = $row->id;
    $user_data['ctncode']    = $row->ctncode;
    $user_data['firstname']  = $row->firstname;
    $user_data['lastname']   = $row->lastname;
    $user_data['email']      = $row->email;
    $user_data['mobile']     = $row->mobile;
    $user_data['gender']     = $row->gender;
    $user_data['logged_in']  = 1;

    $this->session->set_userdata( $user_data );

    echo json_response(1, 'login successful');

    }

  }

 }
