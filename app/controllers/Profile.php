<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('crud_model','researchers');
        $this->load->model('Common_model','common');
        $this->load->model('Researcher_model','researcher');
        $this->researchers->table  = 'researchers';
    }

   public function index(){

     $email             = $this->session->userdata('email');

     if(empty($email)){
       redirect( base_url() .'login' );
     }

     $signup            = $this->db->select("*")->get_where( $this->researchers->table , [ 'email' => $email  ] )->row();

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

   public function save(){

     $email            = $this->session->userdata('email');
     $password         = $this->input->post('password');
     $passwordconfirm  = $this->input->post('passwordconfirm');

     $data['success']  = 0;
     $data['message']  = '';


    $researchers                = [];
    $researchers['password']    = sha1($password);

    //$this->researchers->save($researchers);

    $data['success']  = 1;
    $data['message']  = "Password Changed";

    echo json_encode($data);

  }

 }
