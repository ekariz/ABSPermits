<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Priviledges extends CI_Controller {
  private $reports=[];
  public function __construct()
    {
        parent::__construct();

        $this->load->model('crud_model','roles');
        $this->load->model('Common_model','common');

        $this->roles->table      = 'sysroles';

    }

 public function index( ){

     $data           = [];
     $modules        = [];
     $appid          = isset($_SESSION['appid']) ? $_SESSION['appid'] : 'RG';

     $modules_raw    = $this->common->get_app_modules( $appid );

     $roles_raw      = $this->common->select_assoc( 'sysroles', 'rolecode', 'rolename');

     $roles_def['0'] = '--select role--';
     $roles          = array_merge($roles_raw, $roles_def);
     krsort($roles);

     $modules[] = '--select module--';
     foreach($modules_raw as $k=>$v){
       $modules[$k] = $v;
     }

     $data['roles']   = $roles;
     $data['modules'] = $modules;

     $this->load->view('system/priviledges_view.php', $data );

 }

 public function load_menu( $rolecode, $moduleid ){

    $appid       = isset($_SESSION['appid']) ? $_SESSION['appid'] : 'HR';
    $appmenu     = $this->common->get_app_menu( $appid );
    $rolerights  = $this->common->get_role_rights(  $appid, $rolecode );

    $data['moduleid']    = $moduleid;
    $data['appmenu']     = $appmenu;
    $data['rolerights']  = $rolerights;

    $this->load->view('system/priviledges_menu_view.php', $data );
 }

 public function save(  ){

    $appid    = $this->session->userdata('appid');
    //$appid    = 'HR';

    if($appid == '')
    {
        $data['message']   = 'Something went wrong.Please Refresh and Try Again. ';
        $data['success']   = 0;
        echo json_encode($data);
        exit();
    }

    if($this->input->post('rolecode') == '')
    {
        $data['message']   = 'Select Role';
        $data['success']   = 0;
        echo json_encode($data);
        exit();
    }

    if($this->input->post('moduleid') == '')
    {
        $data['message']   = 'Select Module';
        $data['success']   = 0;
        echo json_encode($data);
        exit();
    }

    $rolecode   = $this->input->post('rolecode');
    $moduleid   = $this->input->post('moduleid');
    $auditdate  = date('Y-m-d');
    $audittime  = time();
    $audituser  = $this->session->userdata('userid');
    $auditip    = $this->input->ip_address();
    $data       = [];

    //clear existing
    $this->db->where('appid',$appid)->where('rolecode',$rolecode)->where('moduleid',$moduleid)->delete( 'sysrights' );

    $allow_access = [];
    $data         = [];

    //$access = $this->input->post('access');

    if( isset($_POST['access']) && sizeof($_POST['access'])>0 ) {
     foreach( $this->input->post('access') as $menuid => $status){

       $allow_access[$menuid] = 1;

       $menu_parents  = $this->common->get_app_parents( $appid, $menuid );

       $parent_array  = [];

       if($menu_parents){
         if(sizeof($menu_parents)>0){
          foreach($menu_parents as $menu_parent){
           $menu_parent_id = $menu_parent[0];
           if($menu_parent_id!=$menuid){
            $allow_access[$menu_parent_id] = 1;
           }
          }
         }
        }

     }
    }

   if(sizeof($allow_access)>0){
    foreach($allow_access as $menuid=>$state){

    $data[] = [
         'appid'      =>  $appid ,
         'rolecode'   =>  $rolecode ,
         'moduleid'   =>  $moduleid ,
         'menuid'     =>  $menuid ,
         'audituser'  =>  $audituser ,
         'auditdate'  =>  $auditdate ,
         'audittime'  =>  $audittime ,
        ];

     }
    }

    if(sizeof($data)>0){
     $this->db->insert_batch( 'sysrights', $data );
    }

    $data['message']   = 'Priviledges Saved';
    $data['success']   = 1;
    echo json_encode($data);

 }


}
