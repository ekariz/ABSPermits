<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

 public function index(){
    $this->load->model('crud_model','app');
    $this->load->model('Common_model','common');
    $this->load->model('Abs_model','abs');
    $this->config->load('product');

    $companyname    = $this->config->item('companyname');
    $productname    = $this->config->item('productname');

    $apps           =  $this->common->get_sys_apps_detailed_user();
    $default_appid  =  $this->common->get_default_sys_app_user();

    $data           =  [
                        'title'       => $productname,
                        'route'       => $this->router->class,
                        'apps'        => $apps,
                        'def_appid'   => $default_appid,
                        'companyname' => $companyname,
                        'productname' => $productname,
                       ];
    $data['requiredocs']     = $this->abs->get_requiredocs();
    if( !empty($this->session->userdata['logged_in']) && $this->session->userdata['logged_in'] === 1 ) {

    if(isset($_SESSION['appid']) && !empty($_SESSION['appid'])){
     $ui_appid = $_SESSION['appid'];
    }else{
     $_SESSION['appid'] = $default_appid;
     $ui_appid          = $default_appid;
    }

    $rolecode = $this->session->userdata('rolecode');

    $appmenu  = $this->common->get_app_role_menu( $ui_appid , $rolecode );
    $app      = $this->common->get_sys_app( $ui_appid );

    $data['ui_appid']   = $ui_appid;
    $data['appmenu']    = $appmenu;
    $data['appname']    = $app->appname;
    $data['firstname']  = $this->session->userdata('firstname');
    $data['lastname']   = $this->session->userdata('lastname');
    $data['email']      = $this->session->userdata('email');
    $data['mobile']     = $this->session->userdata('mobile');


    $this->load->view('main/frontend/home_user', $data );
    }else{
    $this->load->view('main/frontend/home', $data );
    }

 }

 public function switch_to_app( $appid ){
   $data['appid']   = $appid;
   $this->session->set_userdata( $data );
   echo json_encode( ['success'=>1 ,'message'=>'ok'] );
 }

}
