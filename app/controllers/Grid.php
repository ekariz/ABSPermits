<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grid extends CI_Controller {

 public function index( ){
    $this->load->view('templates/users');
 }

 public static function data(  ){
  global $db,$config;

$config_section   = 'default';
$datascr          = isset($config[$config_section]['datascr']) ? $config[$config_section]['datascr'] : null;

header('Content-type : text/json');

$start            =  filter_input(INPUT_POST , 'start', FILTER_SANITIZE_STRING);
$start            =  !empty($start) ? $start : 0;
$length           =  filter_input(INPUT_POST , 'length', FILTER_SANITIZE_STRING);
$draw             =  filter_input(INPUT_POST , 'draw', FILTER_SANITIZE_STRING);

$order            =  isset($_POST['order']) ? $_POST['order'] : array();
$search           =  isset($_POST['search']) ? $_POST['search'] : array();
$columns          =  isset($_POST['columns']) ? $_POST['columns'] : array();

$max_per_page     =  10;

$select_cols     = array_keys($config[$config_section]['cols']);

if(isset($config[$config_section]['edit_by_id'])){
 $select_cols[] = 'ID';
}

$select_cols_sql = implode(',' , $select_cols);

//sort
$default_sort_col = isset( $config[$config_section]['sortby']) ?  $config[$config_section]['sortby'] : null;
$order_col_index  = isset($order[0]['column']) ? $order[0]['column'] : null;
$order_col_dir    = isset($order[0]['dir']) ? $order[0]['dir'] : ' desc ';
$sort_by_col      = isset($select_cols[$order_col_index]) && !empty($select_cols[$order_col_index]) ? $select_cols[$order_col_index] : $default_sort_col;
$sort_by_sql      = !empty($sort_by_col) ? " order by {$sort_by_col} {$order_col_dir}" : '';

//search
$sql_where_parts = array();
$sql_where = array();
$sql_where  = ' where 1=1 ';

if(isset($config[$config_section]['search_cols']) && sizeof($config[$config_section]['search_cols'])>0 && isset($search['value']) && !empty($search['value'])){
$search_val  = isset($search['value']) ? filter_var($search['value'], FILTER_SANITIZE_STRING ) : null;

 foreach($config[$config_section]['search_cols'] as $search_col){
  $sql_where_parts[] = "  {$search_col} like '%{$search_val}%'";
 }

}

$sql_where .=  sizeof($sql_where_parts)>0 ? " and ( " .implode( ' or ', $sql_where_parts) .")" : '';

$recordsTotal     =  $db->GetOne("select count(*) num from {$datascr}  {$sql_where} ");
$data             =  $db->SelectLimit("select {$select_cols_sql} from {$datascr}  {$sql_where}  {$sort_by_sql}",$max_per_page,$start);

$recordsFiltered  =   $recordsTotal;

echo '{
  "draw": '.$draw.',
  "recordsTotal": '.$recordsTotal.',
  "recordsFiltered": '.$recordsFiltered.',
  "data": [
  ';

$data_array = array();

    if($data){
    $count = 1;
     foreach($data as $row ){
       unset($row['ID']);
       unset($row['id']);
      foreach($row as $k=>$v) {
       if(!empty($v)){
        if(isset($config[$config_section]['formaters'][$k])){
         $fn      = $config[$config_section]['formaters'][$k];

         if(function_exists($fn)){
          $row[$k] = @$fn($v);
         }

        }
       }
      }


      if(isset($config[$config_section]['edit_by_id'])){

       if(isset($data->fields['ID']) || isset($data->fields['id'])){

        $id = isset($data->fields['ID']) ? $data->fields['ID'] : $data->fields['id'];

         if(isset($config[$config_section]['formaters']['ID']) || isset($config[$config_section]['formaters']['id'])){
          $fn            = isset($config[$config_section]['formaters']['ID']) ? $config[$config_section]['formaters']['ID'] : $config[$config_section]['formaters']['id'];

          $row['edit']   = $fn($id);
         }else{
          $row['edit']   = "<a href=\\\"javascript:void(0);\\\" onclick=\\\"alert('{$id}');\\\"  >Edit</a>";
         }

       }
      }

      if(isset($config[$config_section]['delete_by_id'])){
         if(isset($data->fields['ID']) || isset($data->fields['id'])){

         $id = isset($data->fields['ID']) ? $data->fields['ID'] : $data->fields['id'];

         if(isset($config[$config_section]['formaters']['DELETE']) || isset($config[$config_section]['formaters']['delete'])){
          $fn             = isset($config[$config_section]['formaters']['DELETE']) ? $config[$config_section]['formaters']['DELETE'] : $config[$config_section]['formaters']['delete'];
          $row['delete']  = $fn($id);
         }else{
          $row['delete']  = "<a href=\\\"javascript:void(0);\\\" onclick=\\\"alert('{$id}');\\\"  > Delete</a>";
         }

       }
      }

      $data_array[] =   "[\"". implode("\",\"", $row). "\"]";
     }
    }

 echo implode(','."\r\n", $data_array);

echo '
  ]
}';


 }

 public function data1( ){
    echo <<<RESP
    {"draw":1,"recordsTotal":57,"recordsFiltered":57,"data":[["Airi Satou","162700","33"],["Angelica Ramos","1200000","47"],["Ashton Cox","86000","66"],["Bradley Greer","132000","41"],["Brenden Wagner","206850","28"],["Brielle Williamson","372000","61"],["Bruno Nash","163500","38"],["Caesar Vance","106450","21"],["Cara Stevens","145600","46"],["Cedric Kelly","433060","22"]]}
RESP;
 }

}
