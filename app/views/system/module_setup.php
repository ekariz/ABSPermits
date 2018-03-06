<?php

$appid   = filter_input(INPUT_POST , 'appid');
         $modid   = filter_input(INPUT_POST , 'modid');
         $menuid  = filter_input(INPUT_POST , 'menuid');

         $tables_array = array();
         $tables_array_all = array();
         $modcfg       = array();
         $table_keycol_select  = form_dropdown('primary_key_col', array(0=>'...'),0);

         $tables = $db->MetaTables('TABLES');
         $views  = $db->MetaTables('VIEWS');

         if(count($tables)){
          foreach ($tables as $table){
           $tables_array[$table]  = $table;
           $tables_array_all[$table]  = $table;
          }
         }

         if($views && sizeof($views)>0){
          foreach ($views as $view){
           $tables_array_all[$view]  = $view;
          }
         }

         $module = $db->GetRow("SELECT * FROM SYSMODMNU WHERE APPID='{$appid}' and MODID='{$modid}' and MNUID={$menuid} ");
         $vars   = $db->GetOne("SELECT VARS FROM SYSMODCFG WHERE APPID='{$appid}' and MODID='{$modid}' and MNUID={$menuid} ");

         if(!empty($vars)){
          $modcfg = unserialize( base64_decode( $vars ) );
         }


         $modtype            = valueof($module, 'MODTYPE');
         $table_datatbl      = valueof($modcfg, 'table_datatbl');
         $table_datasrc      = valueof($modcfg, 'table_datasrc');

         $form_width         = valueof($modcfg, 'form_width',400);
         $form_height        = valueof($modcfg, 'form_height',200);

         $window_width       = valueof($modcfg, 'window_width',500);
         $window_height      = valueof($modcfg, 'window_height',400);

         $primary_key_col    = valueof($modcfg, 'primary_key_col');

         switch($modtype){
             case 'dga':
              $allow_config_cols  = true;
              $allow_reconfig_mod = true;
             break;
             case 'dgc':
              $allow_config_cols  = true;
              $allow_reconfig_mod = false;
             break;
             case 'cmd':
             case 'cpg':
              $allow_config_cols  = false;
              $allow_reconfig_mod = false;
             break;
         }

         if(!empty($vars)){
          $allow_reconfig_mod = true;
         }

         if(sizeof($modcfg)>0){

          $chk_minimizable    = valueof($modcfg, 'chk_minimizable');
          $chk_maximizable    = valueof($modcfg, 'chk_maximizable');
          $chk_collapsible    = valueof($modcfg, 'chk_collapsible');
          $chk_closable       = valueof($modcfg, 'chk_closable');
          $chk_resizable      = valueof($modcfg, 'chk_resizable');

          $chk_button_add     = valueof($modcfg, 'chk_button_add');
          $chk_button_edit    = valueof($modcfg, 'chk_button_edit');
          $chk_button_save    = valueof($modcfg, 'chk_button_save');
          $chk_button_delete  = valueof($modcfg, 'chk_button_delete');
          $chk_button_import  = valueof($modcfg, 'chk_button_import');
          $chk_button_export  = valueof($modcfg, 'chk_button_export');

         }else{
          $chk_minimizable    = 1;
          $chk_maximizable    = 0;
          $chk_collapsible    = 1;
          $chk_closable       = 1;
          $chk_resizable      = 0;

          $chk_button_add     = 1;
          $chk_button_edit    = 1;
          $chk_button_save    = 1;
          $chk_button_delete  = 1;
          $chk_button_import  = 1;
          $chk_button_export  = 1;

         }

         $button_add         = $chk_button_add==1 ? 'checked' : '';
         $button_edit        = $chk_button_edit==1 ? 'checked' : '';
         $button_save        = $chk_button_save==1 ? 'checked' : '';
         $button_delete      = $chk_button_delete==1 ? 'checked' : '';
         $button_import      = $chk_button_import==1 ? 'checked' : '';
         $button_export      = $chk_button_export==1 ? 'checked' : '';

         $minimizable      = $chk_minimizable==1 ? 'checked' : '';
         $maximizable      = $chk_maximizable==1 ? 'checked' : '';
         $collapsible      = $chk_collapsible==1 ? 'checked' : '';
         $closable         = $chk_closable==1 ? 'checked' : '';
         $resizable        = $chk_resizable==1 ? 'checked' : '';
         $openAnimation    = 'show';
         $closeAnimation   = 'hide';
         $winAnimations    =  array(
             'hide'=>'hide',
             'slide'=>'slide',
             'fade'=>'fade'
         );
         $methods       = array('post'=>'post','get'=>'get');
         $method        = 'post';
         $queryParams   = '{}';//{a:1,b:2}

         if($allow_config_cols){
          $allow_config_cols_handler = "mm.list_columns_properties();";
         }else{
          $allow_config_cols_handler = "";
         }

         $tables_save_select = ui::form_select_fromArray('table_datatbl',$tables_array,$table_datatbl,"onchange=\"mm.set_same_source();mm.list_columns_pkey();{$allow_config_cols_handler}\" class=\"easyui-validatebox easyui-combobox\" ",false, 200, 5000);
         $tables_list_select = ui::form_select_fromArray('table_datasrc',$tables_array_all,$table_datasrc,"onchange=\"mm.list_columns_pkey();{$allow_config_cols_handler}\"  class=\"easyui-validatebox easyui-combobox\" ",false, 200,5000 );


         if(!empty($table_datatbl)){

         //get primary key col**********************************************************************************
         $skipcols  = array('AUDITUSER','AUDITDATE','AUDITTIME','IPADDRESS','AUDITIP','IPADDR');
         $colums    = $db->MetaColumns($table_datatbl);

         $keycolums = $db->MetaPrimaryKeys($table_datatbl);

          $colums_array = array();

         if(($colums)){
            foreach ($colums as $column => $properties){
               if(!in_array($column, $skipcols)){
                $colums_array[$column] = $column;
                }
            }
         }

        if(!empty($primary_key_col)){
         $default_column = $primary_key_col;
        }else{
         $default_column = isset($keycolums[0]) ? $keycolums[0] : '';
        }

        $table_keycol_select = ui::form_select_fromArray('primary_key_col', $colums_array , $default_column , '', false, 200);

        //***********************************************************************************************************
         }


              $html =  '<form id="frmMMcfg" name="frmMMcfg"  method="POST"  enctype="multipart/form-data" onsubmit="return false;"  > ';

              $html .=  "<table width=\"100%\" border=\"0\" cellpadding=\"2\"  cellspacing=\"2\" >";

              $html .=  "<tr>";
               $html .=  "<td  width=\"130px\">Data Table</td>";
               $html .=  "<td>{$tables_save_select}</td>";
              $html .=  "</tr>";

              $html .=  "<tr>";
               $html .=  "<td>Data Source</td>";
               $html .=  "<td>{$tables_list_select}</td>";
              $html .=  "</tr>";

              $html .=  "<tr>";
               $html .=  "<td nowrap>Window Dimensions</td>";
               $html .=  "<td>
                Width <input type=\"text\" name=\"window_width\"  id=\"window_width\" size=\"5\"   value=\"{$window_width}\"  class=\"easyui-validatebox textbox\" >
                Height<input type=\"text\" name=\"window_height\"  id=\"window_height\" size=\"5\" value=\"{$window_height}\"  class=\"easyui-validatebox textbox\" >
               </td>";
              $html .=  "</tr>";

              $html .=  "<tr>";
               $html .=  "<td>Form Dimensions</td>";
               $html .=  "<td>
                Width <input type=\"text\" name=\"form_width\"  id=\"form_width\" size=\"5\"   value=\"{$form_width}\"  class=\"easyui-validatebox textbox\" >
                Height<input type=\"text\" name=\"form_height\"  id=\"form_height\" size=\"5\" value=\"{$form_height}\"  class=\"easyui-validatebox textbox\" >
               </td>";
              $html .=  "</tr>";

              $html .=  "<tr>";
               $html .=  "<td>Window</td>";
               $html .=  "<td>
                  <input type=\"checkbox\" id=\"chk_minimizable\" name=\"chk_minimizable\" value=\"1\" {$minimizable} ><label for=\"chk_minimizable\">Minimizable</label>
                  <input type=\"checkbox\" id=\"chk_maximizable\" name=\"chk_maximizable\"  value=\"1\" {$maximizable}><label for=\"chk_maximizable\">Maximizable</label>
                  <input type=\"checkbox\" id=\"chk_closable\" name=\"chk_closable\" value=\"1\"  {$closable}><label for=\"chk_closable\">Closable</label>
                  <input type=\"checkbox\" id=\"chk_resizable\" name=\"chk_resizable\" value=\"1\" {$resizable}><label for=\"chk_resizable\">Resizable</label>
                  <input type=\"checkbox\" id=\"chk_collapsible\" name=\"chk_collapsible\" value=\"1\" {$collapsible}><label for=\"chk_collapsible\">Collapsible</label>
               </td>";
              $html .=  "</tr>";

              $html .=  "<tr>";
               $html .=  "<td>ToolBar Buttons</td>";
               $html .=  "<td>
                  <input type=\"checkbox\" id=\"chk_button_add\" name=\"chk_button_add\" value=\"1\" {$button_add} ><label for=\"chk_button_add\">Add</label>
                  <input type=\"checkbox\" id=\"chk_button_edit\" name=\"chk_button_edit\"  value=\"1\" {$button_edit}><label for=\"chk_button_edit\">Edit</label>
                  <input type=\"checkbox\" id=\"chk_button_save\" name=\"chk_button_save\" value=\"1\" {$button_save}><label for=\"chk_button_save\">Save</label>
                  <input type=\"checkbox\" id=\"chk_button_delete\" name=\"chk_button_delete\" value=\"1\" {$button_delete}><label for=\"chk_button_delete\">Delete</label>
                  <input type=\"checkbox\" id=\"chk_button_import\" name=\"chk_button_import\" value=\"1\"  {$button_import}><label for=\"chk_button_import\">Import</label>
                  <input type=\"checkbox\" id=\"chk_button_export\" name=\"chk_button_export\" value=\"1\" {$button_export}><label for=\"chk_button_export\">Export</label>
               </td>";
              $html .=  "</tr>";

              $html .=  "<tr>";
               $html .=  "<td>Primary Key Col</td>";
               $html .=  "<td id=\"tdPkey\">{$table_keycol_select}</td>";
              $html .=  "</tr>";

              $html .=  "<tr>";
               $html .=  "<td id=\"tdColumns\" colspan=\"2\">&nbsp;</td>";
              $html .=  "</tr>";

              $html .=  "<tr>";
               $html .=  "<td>&nbsp;</td>";
               $html .=  "<td>";
                $html .=  "<button type=\"submit\" id=\"btnSave\" onclick=\"mm.save();\">Save Config File</button>";
                $html .=  "<button onclick=\"$('#dlg').dialog('close');\">Close</button>";
               $html .=  "</td>";
              $html .=  "</tr>";

              $html .=  "</table>";
              $html .=  "</form>";
//              $html .=  "</div>";

              $html .=  "<script>
              {$allow_config_cols_handler}

              //\$('#table_datatbl').combo({ });

              </script>";

              return $html;
