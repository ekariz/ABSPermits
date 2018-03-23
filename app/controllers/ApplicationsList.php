<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApplicationsList extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        //$this->load->model('crud_model','apps');
        //$this->load->model('crud_model','temp');
        $this->load->model('crud_model','applications');
        $this->load->model('Common_model','common');
        $this->load->model('Abs_model','abs');

        $this->applications->table         = 'applications';
        $this->applications->dataview      = 'viewapplications';
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

   public function view_application($id)
    {

    $data = [];
    $data['applyingas_list']      = $this->abs->get_applyas();
    $data['resource_list']        = $this->abs->get_resource_types();
    $data['researchtype_list']    = $this->abs->get_research_types();
    $data['purposes_list']        = $this->abs->get_purposes();
    $data['conservestatus_list']  = $this->abs->get_iucn_red_list();
    $data['sample_uom_list']      = $this->abs->get_sample_uom();

    $data['positions']      = [];
    $data['positions']['']  = 'Choose option';
    $data['positions'][1]   = 'Yes';
    $data['positions'][2]   = 'No';

    $data['export_answer_list']      = [];
    $data['export_answer_list']['']  = 'Choose option';
    $data['export_answer_list'][1]   = 'Yes';
    $data['export_answer_list'][2]   = 'No';

    $data_raw = $this->applications->get_by_id($id);


      if($data_raw){
       foreach($data_raw as $field=>$value){
        //if(!strstr($field,'document')  ){
        $data[$field]      = isJSON($value) ? json_decode($value , true) : $value;
        //}
       }
      }

     $this->load->library('pdfgenerator');
     $html     = $this->load->view("application_form_view.php", $data, true);
     //exit($html);//remove

     $filename = "ABS_PERMIT_REF_{$data_raw->appno}";
     $this->pdfgenerator->generate($html, $filename, true, 'A4', 'portrait');

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
