<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('crud_model','login');

    }

    public function index(){
     $this->reset();
     redirect( base_url() .'LoginBackend.html' );
     //$this->load->view('main/login_view'  );
    }

    public function user(){
     $this->reset();
     redirect( base_url() .'Login.html' );
     //$this->load->view('main/login_view'  );
    }

    public function reset(){
     $array_items = ['logged_in','userid','roleid','rolename','email','username','fullname','mobile','hospitalid','hospitalcode','hospitalname','hospitalmobile'];
    $this->session->unset_userdata($array_items);

    }


 }
