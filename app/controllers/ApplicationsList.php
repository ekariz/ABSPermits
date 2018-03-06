<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApplicationsList extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('crud_model','apps');
        $this->load->model('crud_model','temp');
        $this->load->model('Common_model','common');
        $this->load->model('Abs_model','abs');

        $this->apps->table  =  'applications';
    }

   public function index(){

     $email             = $this->session->userdata('email');

     if(empty($email)){
       redirect( base_url() .'login' );
     }

     $signup            = $this->db->select("firstname,lastname,gender,ctncode,mobile,email")->get_where( 'signups', [ 'email' => $email  ] )->row();

     if($signup){
     $data['firstname']  = $signup->firstname;
     $data['lastname']   = $signup->lastname;
     $data['gender']     = $signup->gender;
     $data['ctncode']    = $signup->ctncode;
     $data['mobile']     = $signup->mobile;
     $data['email']      = $signup->email;
     }

     $data['approvalsteps']  =  $this->abs->get_approval_steps( );
     $data['applications']   =  $this->abs->get_applications( $email );

     $this->load->view('main/frontend/appmine/my_apps_view', $data );

    }


   public function view( $id ){

     $email             = $this->session->userdata('email');

     if(empty($email)){
       redirect( base_url() .'login' );
     }

     $signup            = $this->db->select("firstname,lastname,gender,ctncode,mobile,email")->get_where( 'signups', [ 'email' => $email  ] )->row();

     if($signup){
     $data['firstname']  = $signup->firstname;
     $data['lastname']   = $signup->lastname;
     $data['gender']     = $signup->gender;
     $data['ctncode']    = $signup->ctncode;
     $data['mobile']     = $signup->mobile;
     $data['email']      = $signup->email;
     }

     $data['approvalsteps']  =  $this->abs->get_approval_steps( );
     $data['applications']   =  $this->abs->get_applications( $email );

     $this->load->view('main/frontend/appmine/my_apps_view', $data );

    }

 }
