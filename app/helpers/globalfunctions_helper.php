<?php

  function priviledge_list_menu_subs( $subs, $rolerights ){

         foreach($subs as $menu){
           $parentid = valueof($menu, 'parentid');
           $modname = valueof($menu, 'modname');
           $modicon = valueof($menu, 'modicon');
           $iconclr = valueof($menu, 'iconclr');
           $mnutype = valueof($menu, 'mnutype');
           $modcont = valueof($menu, 'modcont');
           $id      = valueof($menu, 'id');
           $sub_subs    = valueof($menu, 'subs');
           $vars     = valueof($menu, 'vars');

           echo  "<li>\r\n";

           if(sizeof($sub_subs)>0) {
             echo  "<span class=\"menu-item-parent\"><b>{$modname}</b></span>";
             echo   "<ul class=\"list-unstyled child\" >\r\n";
              echo  priviledge_list_menu_subs( $sub_subs, $rolerights );
             echo   "</ul>\r\n";
           }else{

              $checkbox_id =  "access[{$id}]";
              $checked     =  array_key_exists($id, $rolerights) ? 'checked' : '';
              $checkbox    =  '<input type="checkbox" '.$checked.' id="'.$checkbox_id.'"  name="'.$checkbox_id.'" value="1" class="priviledge" >';

              echo  "{$checkbox} <label for=\"{$checkbox_id}\">{$modname}</label>";

           }

         }

       echo  "</li>\r\n";

    }

  function list_menu_subs( $subs ){
       global $appid;


         foreach($subs as $menu){
           $parentid = valueof($menu, 'parentid');
           $modname = valueof($menu, 'modname');
           $modicon = valueof($menu, 'modicon');
           $iconclr = valueof($menu, 'iconclr');
           $mnutype = valueof($menu, 'mnutype');
           $modcont = valueof($menu, 'modcont');
           $id      = valueof($menu, 'id');
           $sub_subs    = valueof($menu, 'subs');
           $vars     = valueof($menu, 'vars');

           //$modcfg = [];
           //if(!empty($vars)){
           //$modcfg = unserialize( base64_decode( $vars ) );
           //}

           switch($mnutype){
             case 'dga':
              $modcont  = "DataCrud/{$id}";
             break;
             case 'dgc':
              $modcont  = "DataCrud/{$id}";
             break;
             case 'cmd':
             case 'cpg':

             break;
            }

            echo  "<li>\r\n";

           if(sizeof($sub_subs)>0) {
             echo  "<a href=\"#\"><i class=\"fa fa-lg fa-fw {$modicon}  txt-color-{$iconclr}\"></i> <span class=\"menu-item-parent\">{$modname}</span></a>";
             echo   "<ul>\r\n";
              echo  list_menu_subs( $sub_subs );
             echo   "</ul><!--end sub menu 2.-->\r\n";
           }else{

             if($mnutype=='mdn' || $mnutype=='mdf'){
              echo  "<a href=\"{$modcont}.html\" data-toggle=\"modal\" data-target=\"#ModuleModal\" ><i class=\"fa fa-lg fa-fw {$modicon}  txt-color-{$iconclr}\"></i>  {$modname} </a>";
             }else{
              echo  "<a href=\"{$modcont}.html\"><i class=\"fa fa-lg fa-fw {$modicon}  txt-color-{$iconclr}\"></i>  {$modname} </a>";
             }

           }

         }

       echo  "</li>\r\n";

    }

  function isJSON($string){
   return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
  }

  function utf8_converter($array){
        array_walk_recursive($array, function(&$item, $key){
            if(!mb_detect_encoding($item, 'utf-8', true)){
                    $item = utf8_encode($item);
            }
        });
        return $array;
    }

  function generateID($table,$column='ID', $db=null){
    $column = !empty($column) ? $column : 'ID';
    $sql    = "select MAX(".$column.") AS max_id from ".$table;
    $query  = $db->query($sql);
    $row    = $query->row();
    if(isset($row))
    {
     return $row->max_id + 1;
    }
    return 0;
  }

 function generateUniqueCode($prefix,$current_id,$padding=6){
    $id =  str_pad($current_id, $padding, "0", STR_PAD_LEFT);
    return $prefix.$id;
 }

function valueof($var, $key , $default_return_value = null , $run_value_in_this_function='' ){

    $return_value =  $default_return_value;

     if(is_object($var)){
        if(isset($var->$key)){
            $return_value = trim($var->$key);
        }
     }elseif(is_array($var)){
        if(isset($var[$key])){
            $value =  $var[$key];
            $return_value =  is_string($value) ? trim($value) : $value;
        }
    }else{
         $return_value = $default_return_value;
    }

  if(!empty($return_value) && !empty($run_value_in_this_function)){
    if(function_exists($run_value_in_this_function)){
        $return_value = $run_value_in_this_function($return_value);
    }
  }

  return $return_value;

 }

 function print_pre($s) {
    print "<pre>";print_r($s);print "</pre>";
 }

 function centerTrim($str){
     $str = trim($str);
     return preg_replace("/\s+/", " ", $str);
 }

 function Camelize($text){
  return ucwords(centerTrim(strtolower($text)));
 }


 function generateRandomString($length = 10) {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}

 function generateRandomChars($length = 10) {
    return substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}

 function json_response($success , $message, $extra = array() ){

    $_array =   array(
     'success' => $success,
      'message' => $message,
     );

    if(sizeof($extra)>0){
     $_array = array_merge($_array, $extra);
    }

    return  json_encode(
      $_array
    );
 }

 function addDayToDate($timeStamp, $totalDays=1){
        $thePHPDate = getdate($timeStamp);
        $thePHPDate['mday'] = $thePHPDate['mday']+$totalDays;
        $timeStamp = mktime($thePHPDate['hours'], $thePHPDate['minutes'], $thePHPDate['seconds'], $thePHPDate['mon'], $thePHPDate['mday'], $thePHPDate['year']);
        return $timeStamp;
 }

 function fuzzyDate($d, $d_istime=false) {

        if($d_istime){
         $ts = time() - $d;
        }else{
         $ts = time() - strtotime(str_replace("-","/",$d));
        }


        if($ts>31536000){
            $val = round($ts/31536000,0).' year';
        }else if($ts>2419200){
          $val = round($ts/2419200,0).' month';
        }else if($ts>604800){
            $val = round($ts/604800,0).' week';
        }else if($ts>86400){
            $val = round($ts/86400,0).' day';
        }else if($ts>3600){
            $val = round($ts/3600,0).' hour';
        }else if($ts>60){
            $val = round($ts/60,0).' minute';
        }else{
            $val = $ts.' second';
        }

        if($val>1){
            $val .= 's ago';
        }else{
            $val .= ' ago';
        }

        return $val;
 }

