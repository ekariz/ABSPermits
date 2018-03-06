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
     $signup            = $this->db->select("firstname,lastname,gender,ctncode,mobile,email")->get_where( $this->signups->table , [ 'email' => $email  ] )->row();

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


    $signups                = [];
    $signups['password']    = sha1($password);

    //$this->signups->save($signups);

    $data['success']  = 1;
    $data['message']  = "Password Changed";

    echo json_encode($data);

  }

 }
