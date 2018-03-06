<?php

if($appmenu){
 if(sizeof($appmenu)>0){
    echo "<ul class=\"list-unstyled\" >\r\n";
    echo "<li>&nbsp;<a href=\"javascript:void(0)\" onclick=\"priviledges.select_all()\" >Select All</a> &nbsp;|  &nbsp;<a href=\"javascript:void(0)\" onclick=\"priviledges.select_none()\" >Select None</a> &nbsp;</li>\r\n";
  foreach($appmenu as $menu){
   $parentid = valueof($menu, 'parentid');
   $modname = valueof($menu, 'modname');
   $modicon = valueof($menu, 'modicon');
   $iconclr = valueof($menu, 'iconclr');
   $mnutype = valueof($menu, 'mnutype');
   $modcont = valueof($menu, 'modcont');
   $id      = valueof($menu, 'id');
   $subs    = valueof($menu, 'subs');
   $menu_class = sizeof($subs)>0 ? 'menu-item-parent' : '';

   if($parentid==0 && ($parentid==$moduleid || $id==$moduleid) ){

      $checkbox_id =  "access[{$id}]";
      $checked     =  array_key_exists($id, $rolerights) ? 'checked' : '';
      $checkbox    =  '<input type="checkbox" '.$checked.' id="'.$checkbox_id.'"  name="'.$checkbox_id.'" value="1" class="priviledge" >';

     echo "<li>\r\n";

       echo  "{$checkbox} <label for=\"{$checkbox_id}\">{$modname}</label>";

      if(sizeof($subs)>0){
          echo   "<ul class=\"list-unstyled\" >\r\n";
           priviledge_list_menu_subs( $subs ,$rolerights );
          echo   "</ul>";
      }
     echo "</li>\r\n";

    }
   }

   echo "</ul>\r\n";
 }
}
