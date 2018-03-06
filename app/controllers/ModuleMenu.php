<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModuleMenu extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('crud_model','menu');
        $this->load->model('Common_model','common');
        $this->menu->table  = 'sysmods';
    }

    public function index()
    {
        $modname = 'Menu';

        $mnutypes         = [];
        $mnutypes['dga']  = 'Data Grid - Auto Created';
        $mnutypes['dgc']  = 'Data Grid - Custom Made';
        $mnutypes['cmd']  = 'Custom Made Module';
        $mnutypes['mdn']  = 'Modal - Normal';
        $mnutypes['mdf']  = 'Modal - Full Screen';

        $colors         = [];
        $colors[]        = 'No Color';
        $colors['green']  = 'green';
        $colors['greenDark']  = 'greenDark';
        $colors['greenLight']  = 'greenLight';
        $colors['purple']  = 'purple';
        $colors['magenta']  = 'magenta';
        $colors['pink']  = 'pink';
        $colors['pinkDark']  = 'pinkDark';
        $colors['blue']  = 'blue';
        $colors['blueLight']  = 'blueLight';
        $colors['blueDark']  = 'blueDark';
        $colors['teal']  = 'teal';
        $colors['yellow']  = 'yellow';
        $colors['orange']  = 'orange';
        $colors['orangeDark']  = 'orangeDark';
        $colors['red']  = 'red';
        $colors['redLight']  = 'redLight';

        $data  =  [
                    'route'   => $this->router->class,
                    'modname' => $modname,
                    'apps'    => $this->common->select_assoc( 'sysapps', 'appid', 'appname' ),
                    'mnutypes'    => $mnutypes,
                    'colors'    => $colors,
                    ];

        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        $this->load->library('CustomCrud', $data );
        $this->load->view('system/module_menu_view', $data);
    }

   public function modules_list( $appid ){
        $modules = $this->common->select_assoc( 'sysmods', 'modid', 'modname', "appid='{$appid}'" );
        $data    = [];
        if(sizeof($modules)>0){
         $data[] = ['id'=>null,'name'=>'--select module--'];
         foreach($modules as $k=>$v){
          $data[] = ['id'=>$k,'name'=>$v];
         }
        }else{
         $data[] = ['id'=>null,'name'=>'no modules'];
        }
        echo json_encode($data);
   }

   public function tree_data( $appid='' ){
        $apps = $this->common->get_sys_apps( $appid );
        $json = [];
        if(sizeof($apps)>0){
         $key = 1;
         foreach($apps as $appid=>$appname){
           $json[] = '{ "key": "'.$appid.'", "title": "'.$appname.'", "tooltip": "'.$appname.'", "lazy": true }';
         }

        }

        echo '['. implode(',', $json)  .']';
   }

   public function tree_sub_data( $appid , $parentid=''){

        if(empty($modid)){
        $modules = $this->common->get_app_modules( $appid, $parentid );
        $json = [];
        if(sizeof($modules)>0){
         $key = 1;
         foreach($modules as $mnid=>$modname){
           $num_subs = $this->common->get_app_modules_subs( $appid,$mnid );
           $lazy     = $num_subs>0 ? 'true' : 'false';
           $json[]   = '{ "key": "'.$appid.'/'.$mnid.'", "title": "'.$modname.'", "tooltip": "'.$modname.'", "lazy":'.$lazy.'  }';
           //$json[]   = '{ "key": "'.$modid.'", "appid": "'.$appid.'", "title": "'.$modname.'", "tooltip": "'.$modname.'", "lazy":'.$lazy.'  }';
         }
         ++$key;
         }
        }

        echo '['. implode(',', $json)  .']';
   }

   public function add_node( $appid , $mnid='' ){

     $data['parentid'] = null;
     $data['modname']  = '';
     $data['modicon']  = '';
     $data['mnutype']  = '';
     $data['modcont']  = '';
     $data['modview']  = '';
     $data['modpos']   = '';
     $data['active']   = 1;
     $data['menupath']   = $appid;
     $data['id']       = null;

     if(empty($mnid)){
     $app = $this->common->get_sys_app( $appid );
     $data['success']  = !empty($app) ? 1 : 0;
     $data['message']  = !empty($app) ? 'ok' : 'Record Not Found';
     $data['appid']    = isset($app->appid ) ? $app->appid  : $appid;
     $data['menupath'] = isset($app->appname) ? $app->appname  : $appid;
     }else{
     $module   = $this->common->get_app_module( $appid, $mnid );

     $data['success']  = !empty($module) ? 1 : 0;
     $data['success']  = !empty($module) ? 1 : 1;
     $data['message']  = !empty($module) ? 'ok' : 'Record Not Found';
     $data['appid']    = isset($module['appid']) ? $module['appid'] : $appid;
     $data['parentid'] = isset($module['id']) ? $module['id'] : null;

     $parentid = $data['parentid'];
     $tree_array[] = $appid;
     if(!is_null($mnid)){
     $parents  = $this->common->get_app_parents( $appid, $mnid );
     $tree = [];
     if(sizeof($parents)>0){
      foreach($parents as $parent){
       $tree[] = $parent[1];
      }
      $tree[] = $appid;
      $tree_array = array_reverse($tree);
     }
    }

    $data['menupath'] = implode(' > ', $tree_array);

    }

    echo json_encode($data);

   }

   public function edit_node( $appid , $mnid='' ){

     if(empty($mnid)){
     $app = $this->common->get_sys_app( $appid );
     $data['success']  = 0;
     $data['message']  = 'Cannot Edit Root Element';
     }else{

     $module   = $this->common->get_app_module( $appid, $mnid );
     $parentid = $module['parentid'];

     if(empty($parentid)){
     $app = $this->common->get_sys_app( $appid );
     }

     $data['success']  = !empty($module) ? 1 : 0;
     $data['message']  = !empty($module) ? 'ok' : 'Record Not Found';
     $data['id']       = $module['id'];
     $data['appid']    = $module['appid'];
     $data['parentid'] = $module['parentid'];
     $data['modname']  = $module['modname'];
     $data['mnutype']  = $module['mnutype'];
     $data['modicon']  = $module['modicon'];
     $data['iconclr']  = $module['iconclr'];
     $data['modcont']  = $module['modcont'];
     $data['modview']  = $module['modview'];
     $data['modpos']   = $module['modpos'];
     $data['active']   = $module['active']==1 ? 1 : 0;

     $tree_array[] = $appid;
     if(!is_null($module['id'])){
     $parents  = $this->common->get_app_parents( $appid, $module['id']  );

     $tree = [];
     if(sizeof($parents)>0){
      foreach($parents as $parent){
       $tree[] = $parent[1];
      }

      if(empty($parentid)){
      $tree[] = $app->appname;
      }
      $tree_array = array_reverse($tree);
     }
    }
     $data['menupath'] = implode(' > ', $tree_array);
    }

    echo json_encode($data);

   }

   public function tree_sub_path( $appid , $mnid ){
     $module   = $this->common->get_app_module( $appid, $mnid );
     $parentid = $module['parentid'];
     $tree_array[] = $appid;
     if(!is_null($parentid)){
     $parents  = $this->common->get_app_parents( $appid, $parentid  );
     $tree = [];
     if(sizeof($parents)>0){
      foreach($parents as $parent){
       $tree[] = $parent[1];
      }
      $tree_array = array_reverse($tree);
     }
    }
    echo implode(' > ', $tree_array);
   }

   public function search_icons( ){

    $phrase  = $this->input->post('phrase');
    $icons   = $this->common->search_icon_fa( $phrase );

    if(sizeof($icons)>0){
      $result = [];
      foreach($icons as $icon){
       $result[] = [ 'code'=>$icon, 'name'=>$icon ];
      }
     echo json_encode($result);
    }else{
     echo '[]';
    }

   }

   public function setup_node( $appid , $mnid ){
    $module          = $this->common->get_app_module( $appid, $mnid );
    $data            = [];
    $data['appid']   = $module['appid'];
    $data['mnuid']   = $module['id'];
    $data['modname'] = $module['modname'];
    $data['modtype'] = $module['mnutype'];
    $data['vars']    = $module['vars'];

    $this->load->view('system/module_setup_view', $data);
   }

   public function setup_list_columns_properties( $appid , $mnid ){
    $module          = $this->common->get_app_module( $appid, $mnid );
    $data            = [];
    $data['appid']   = $module['appid'];
    $data['mnuid']   = $module['id'];
    $data['modname'] = $module['modname'];
    $data['modtype'] = $module['mnutype'];
    $data['vars']    = $module['vars'];
    $data['table_datatbl']    = $this->input->post('table_datatbl');
    $data['table_datasrc']    = $this->input->post('table_datasrc');


    $this->load->view('system/module_columns_properties_view', $data);
   }

   public function list_columns_pkey(){
        global $db;

        $table_datatbl = filter_input(INPUT_POST , 'table_datatbl');

         $fields = $this->db->field_data($table_datatbl );

         $colums = [];
         $keycolums = [];
         foreach ($fields as $field)
         {
           $colname   = $field->name;
           $colums[$colname]  = $colname;

           if($field->primary_key==1){
           $keycolums[]  = $colname;
           }

         }

        $skipcols      = array('audituser','auditdate','audittime','ipaddress','auditip','ipaddr');
        $colums_array  = array();

        if(($colums)){
            foreach ($colums as $column => $properties){
                if(!in_array($column, $skipcols)){
                  $colums_array[$column] = $column;
                }
            }
        }

        $default_column = isset($keycolums[0]) ? $keycolums[0] : '';
        echo form_dropdown('primary_key_col', $colums_array , $default_column , ' class="form-control" ' );
    }

   public function list_tables( $skip_table='' ){
    global $db;

    $tables_array = array();
    $tables_list = $this->db->list_tables();

    if($tables_list && sizeof($tables_list)>0){
     foreach($tables_list as $index=>$table){
      if(!strstr($table,'view') && $table!=$skip_table ){
       $tables_array[$table]  = $table;
      }
     }
    }

    ksort($tables_array);

    $table_datatbl = '';
    echo  form_dropdown('table_col_datasrc',$tables_array,$table_datatbl,"id=\"table_col_datasrc\" onchange=\"app.list_columns_select_src();\" class=\"form-control\"  " );

    }

   public function list_columns_select_src( $coldetype, $table_col_datasrc, $col_linked_to_foreign_col ){
        global $db;

        $linked_tbl_col     = $coldetype=='code' ? 'linked_tbl_col_code' : 'linked_tbl_col_name';
        $skipcols           = array('id','audituser','auditdate','audittime','ipaddress','auditip','ipaddr');

        $colums            = $this->db->list_fields($table_col_datasrc);

        $colums_array = array();

        $default_column =  $col_linked_to_foreign_col;

        if(($colums)){
            foreach ($colums as $column ){
                if(!in_array($column, $skipcols)){
                 $colums_array[$column] = $column;

                 if(($coldetype=='code' && (strstr($column,'CODE') || strstr($column,'code'))) && $col_linked_to_foreign_col==$column){
                    $default_column = $column;
                 }elseif($coldetype=='name' && (strstr($column,'NAME') || strstr($column,'name'))  ){
                    $default_column = $column;
                 }

                }
            }
        }

        echo  form_dropdown($linked_tbl_col,$colums_array,$default_column,"id=\"{$linked_tbl_col}\"  class=\"form-control\"  " );

    }

    public function pre_save_select_source(){

      $table_col_datasrc          = filter_input(INPUT_POST , 'table_col_datasrc');
      $col_linked_to_foreign_col  = filter_input(INPUT_POST , 'col_linked_to_foreign_col');
      $linked_tbl_col_code        = filter_input(INPUT_POST , 'linked_tbl_col_code');
      $linked_tbl_col_name        = filter_input(INPUT_POST , 'linked_tbl_col_name');

      //$json        = json_encode([
                                 //'table'    => $table_col_datasrc ,
                                 //'col_code' => $linked_tbl_col_code,
                                 //'col_name' => $linked_tbl_col_name
                                 //]);

      //$this->session->set_userdata($col_linked_to_foreign_col, $json );

        $_SESSION['linked_to_foreign_cols'][$col_linked_to_foreign_col] =
                                                                    [
                                                                    'table'=>$table_col_datasrc ,
                                                                    'col_code'=>$linked_tbl_col_code,
                                                                    'col_name'=>$linked_tbl_col_name
                                                                    ];


  /*

      $data['linked_to_foreign_cols'][$col_linked_to_foreign_col] =
                                                                    [
                                                                    'table'=>$table_col_datasrc ,
                                                                    'col_code'=>$linked_tbl_col_code,
                                                                    'col_name'=>$linked_tbl_col_name
                                                                    ];

       $stored  = $this->session->userdata( 'linked_to_foreign_cols' );

       $session_data = [];

       if(!empty($stored)){
        $session_data = array_merge ($stored, $data['linked_to_foreign_cols']);
       }else{
        $session_data = $data['linked_to_foreign_cols'];
       }

      $this->session->set_userdata($session_data);
      */
    }

   public function save_setup(){
        global $db;

        $vars      = '';

        if(sizeof($_POST)>0){
         $vars_array = $_POST;
         if(isset($_SESSION['linked_to_foreign_cols'])){
           $vars_array['selects'] = $_SESSION['linked_to_foreign_cols'];
         }
         $vars = base64_encode( serialize($vars_array) );
        }

        if(empty($datasrc) && !empty($datatbl)){
            $datasrc = $datatbl;
        }elseif(empty($datatbl) && !empty($datasrc)){
            $datatbl = $datasrc;
        }

      $mnid    = $this->input->post('mnid');
      $modcont = $this->input->post('modcont');

      $data              = [];
      $data['vars']      = $vars;
      $data['modcont']   = $modcont;

      if(empty($mnid)){
       echo json_encode( ["success" => 0, 'message' => 'Something went wrong.Try again later.' ] );
      }else{
       $this->menu->update( ['id' => $mnid], $data );
      }

      echo json_encode( ["success" => 1, 'message' => 'Saved' ] );

   }

   public function save()
    {

     $id = $this->input->post('id');

     $this->_validate();

     $data = array(
                'parentid' => $this->input->post('parentid'),
                'appid'    => $this->input->post('appid'),
                'modname'  => $this->input->post('modname'),
                'modicon'  => $this->input->post('modicon'),
                'iconclr'  => $this->input->post('iconclr'),
                //'modcont'  => $this->input->post('modcont'),
                //'modview'  => $this->input->post('modview'),
                'mnutype'   => $this->input->post('mnutype'),
                'modpos'   => $this->input->post('modpos'),
                'active'   => $this->input->post('active'),
            );

     if(empty($id)){
       $this->menu->save($data);
     }else{
       $this->menu->update( ['id' => $id], $data );
     }

     echo json_encode( ["status" => true, 'message' => 'Saved' ] );

    }

    public function remove($appid , $mnid )
    {
      $num_subs = $this->common->get_app_modules_subs( $appid,$mnid );
      if($num_subs>0){
       echo json_encode( ["status" => false, 'message' => 'Cannot Remove Parent Menu' ] );
      }else{
       $this->menu->delete_by_id($mnid);
       echo json_encode( ["status" => true, 'message' => 'removed' ] );
      }
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('appid') == '')
        {
            $data['inputerror'][] = 'appid';
            $data['error_string'][] = 'Application ID is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('modname') == '')
        {
            $data['inputerror'][] = 'modname';
            $data['error_string'][] = 'Menu Name is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('mnutype') == '')
        {
            $data['inputerror'][] = 'mnutype';
            $data['error_string'][] = 'Module Type is required';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

}
