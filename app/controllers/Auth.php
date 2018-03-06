<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('crud_model','login');

    }

    public function index(){
     $this->reset();
     //redirect( base_url() );
     $this->load->view('main/login_view'  );
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
     $password_check  = sha1($password);

     $user = $this->db->select('u.id, u.rolecode, g.rolename, u.username,  u.email, u.mobile,  u.disabled ')
     ->from('sysusers u')
     ->where("u.email='{$email}' ")
     ->where("u.password='{$password_check}' ")
     ->join('sysroles g', 'g.rolecode = u.rolecode', 'left')
     ->get();

    $row    = $user->row();

    if(!isset($row)){
     sleep(1);
     die(json_response(0, 'Wrong User ID or Password'));
    }else{

    $user_data = [];
    $user_data['userid']     = $row->id;
    $user_data['rolecode']   = $row->rolecode;
    $user_data['rolename']   = $row->rolename;
    $user_data['username']   = $row->username;
    $user_data['email']      = $row->email;
    $user_data['mobile']     = $row->mobile;
    $user_data['logged_in']  = 1;

    $this->session->set_userdata( $user_data );

    //print_pre($_SESSION);//remove

    echo json_response(1, 'login successful');

    }

  }

 }
