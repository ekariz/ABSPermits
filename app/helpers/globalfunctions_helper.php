<?php


/**
	Method to execute a command in the terminal
	Uses :
	
	1. system
	2. passthru
	3. exec
	4. shell_exec

*/
function terminal($command)
{
	//echo "\$command={$command} <br>";//remove 
	//system($command , $return_var);
	//print_pre($return_var); exit();//remove 
	
	//system
	if(function_exists('system'))
	{
		ob_start();
		system($command , $return_var);
		$output = ob_get_contents();
		ob_end_clean();
		$type = 'system';
	}
	//passthru
	else if(function_exists('passthru'))
	{
		ob_start();
		passthru($command , $return_var);
		$output = ob_get_contents();
		ob_end_clean();
		$type = 'passthru';
	}
	
	//exec
	else if(function_exists('exec'))
	{
		exec($command , $output , $return_var);
		$output = implode("n" , $output);
		$type = 'exec';
	}
	
	//shell_exec
	else if(function_exists('shell_exec'))
	{
		$output = shell_exec($command) ;
		$type = 'shell_exec';
	}
	
	else
	{
		$output = 'Command execution not possible on this system';
		$return_var = 1;
		$type = 'Command execution not possible on this system';
	}
	
	return array('output' => $output , 'status' => $return_var, 'type' => $type);
	
}


function make_post_call($url, $postdata) {

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL,   $url );
    curl_setopt($curl, CURLOPT_FAILONERROR, false);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 3000);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
    //curl_setopt($curl, CURLOPT_VERBOSE, true);

    $response = curl_exec( $curl );

    if (empty($response)) {
        echo (curl_error($curl));
        curl_close($curl);
    } else {
        $info  = curl_getinfo($curl);
        curl_close($curl);
        if($info['http_code'] != 200 && $info['http_code'] != 201 ) {
          echo "Received error: " . $info['http_code']. "\n";
          echo "Raw response:".$response."\n";
          die();
        }
    }

    return $response;

}

function make_get_call($url) {

    $curl = curl_init( $url);
    curl_setopt($curl, CURLOPT_POST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec( $curl );
    if (empty($response)) {
        echo (curl_error($curl));
        curl_close($curl);
    } else {
        $info = curl_getinfo($curl);
        curl_close($curl); // close cURL handler
        if($info['http_code'] != 200 && $info['http_code'] != 201 ) {
            echo "Received error: " . $info['http_code']. "\n";
            echo "Raw response:".$response."\n";
        }
    }

    return $response;
}

function make_file_upload_field( $name,$saved_var,$title='', $required='', $upload_handler='upload_files()' ){

 $file_name =  valueof($saved_var, 'file_name');
 $orig_name =  valueof($saved_var, 'orig_name');
 $exists    =  !empty($file_name)  ? true : false;
 $icon      =  isset($saved_var['client_name'])     ? 'check' : 'hourglass';
 $_title    =  !empty($file_name)  ? $orig_name : $title;

return "<i class=\"fa fa-{$icon}\"> </i><input type=\"file\" id=\"{$name}\" name=\"{$name}\"  onchange=\"{$upload_handler};\" {$required}  data-toggle=\"tooltip\" data-placement=\"top\" title=\"{$_title}\"  > ";
}

function make_form_help( $text ){

return "&nbsp;<a href=\"javascript:void(0);\"><i class=\"fa fa-question-circle\" style=\"color:blue\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"{$text}\"></i> </a>";

}

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

           if($sub_subs) {
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

           if($sub_subs) {
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

 function centerTrimNS($str){
     $str = trim($str);
     return preg_replace("/\s+/", "", $str);
 }

 function Camelize($text){
  return ucwords(centerTrim(strtolower($text)));
 }


 function generateRandomNumber($length = 10) {
    return substr(str_shuffle("0123456789"), 0, $length);
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


 function addYearToDate($timeStamp, $totalYears=1){
        $thePHPDate = getdate($timeStamp);
        $thePHPDate['year'] = $thePHPDate['year']+$totalYears;
        $timeStamp = mktime($thePHPDate['hours'], $thePHPDate['minutes'], $thePHPDate['seconds'], $thePHPDate['mon'], $thePHPDate['mday'], $thePHPDate['year']);
        return $timeStamp;
 }


 function textDate($strDate='',$supp=true){
 $return = '';

 if(is_numeric($strDate)){
  $strDate  = date('Y-m-d',$strDate);
 }else{
  $strDate  = isset($strDate) && !empty($strDate) ? $strDate : date('Y-m-d');
 }

 $return = date("D j",strtotime($strDate));

 $return .=  $supp==true ? "<sup>" : '';
 $return .=   date("S",strtotime($strDate));
 $return .=  $supp==true ? "</sup> " : '';

 $return .= date(" M Y",strtotime($strDate));

 return $return;

}//function


 function Shorten($string, $width=20, $postfix_str='...') {
  if(strlen($string) > $width) {
    $string = wordwrap($string, $width);
    $string = substr($string, 0, strpos($string, "\n"));
    $string = $string.$postfix_str;
  }

  return $string;
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

   function validatePhoneNumber($msisdn) {

        $msisdn        = centerTrimNS($msisdn);
        $msisdn2       = substr($msisdn, -9, 9);
        
        return  '254'.$msisdn2;
		
        $msisdn        = str_replace('+','',$msisdn);
        $start_char    = substr($msisdn, 0, 3);
        $msisdn_length = strlen($msisdn);

        if ($start_char == '+' && $msisdn_length == 13) {
            return substr($msisdn, 1);
        } else if ($start_char == '254' && $msisdn_length == 12) {
            return '+' . $msisdn;
        } else if ($start_char == '0' && $msisdn_length == 10) {
            $msisdn = "+254" . $msisdn;
            return str_replace("2540", "254", $msisdn);
        } else if ($start_char == '254' && $msisdn_length == 12) {
            $msisdn = "+" . $msisdn;
            return $msisdn;
        } else if ($start_char == '7' && $msisdn_length == 9) {
            return "+254" . $msisdn;
        } else {
            return $msisdn;
        }

        return $msisdn;
    }
