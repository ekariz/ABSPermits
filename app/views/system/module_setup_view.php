<?php


        $controllers = [];
        $list = glob(APPPATH . 'controllers/*');
        //print_pre($list);//remove

        foreach($list as $part){
         if(is_file($part)){
           $controller = basename($part, '.php');
           $controllers[$controller] = $controller;
         }elseif(is_dir($part)){
           $pathinfo = pathinfo($part);
           $basename = valueof($pathinfo, 'basename');
           foreach( glob($part .'/*' . 'php') as $controller2){
            $controller3     = basename($controller2, '.php');
            $controller_name = "{$basename}/{$controller3}";
            //$controllers[$controller_name] = $controller_name;
            $controllers[$basename][$controller_name] = $controller3;
           }
         }
        }

//print_pre($controllers);//remove

        foreach(glob(APPPATH . 'controllers/*' . 'php') as $controller){
           $controller = basename($controller, '.php');
           $controllers[$controller] = $controller;
        }

         $tables_array = array();
         $tables_array_all = array();
         $modcfg       = array();
         $table_keycol_select  = form_dropdown('primary_key_col', array(0=>'...'),0);

        $tables_list = $this->db->list_tables();

        if($tables_list && sizeof($tables_list)>0){
         foreach($tables_list as $index=>$table){
          if(strstr($table,'view')){
           $tables_array_all[$table]  = $table;
          }else{
           $tables_array[$table]  = $table;
           $tables_array_all[$table]  = $table;
          }
         }
        }

        ksort($tables_array);
        ksort($tables_array_all);

         $modcfg = null;

         if(!empty($vars)){
          $modcfg = unserialize( base64_decode( $vars ) );
         }

         $table_datatbl      = valueof($modcfg, 'table_datatbl');
         $table_datasrc      = valueof($modcfg, 'table_datasrc');
         $primary_key_col    = valueof($modcfg, 'primary_key_col');
         $modcont            = valueof($modcfg, 'modcont');
         $allow_config_cols  = false;
         $allow_reconfig_mod = false;

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

         if($modcfg) {

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

         if($allow_config_cols){
          $allow_config_cols_handler = "app.list_columns_properties('{$appid}',{$mnuid});";
         }else{
          $allow_config_cols_handler = "";
         }

         //$table_datatbl = 'hremployterms';
         //$table_datasrc = 'hremployterms';

         $tables_save_select = form_dropdown('table_datatbl',$tables_array,$table_datatbl,"id=\"table_datatbl\" onchange=\"app.set_same_source();app.list_columns_pkey();{$allow_config_cols_handler}\" class=\"form-control\"  " );
         $tables_list_select = form_dropdown('table_datasrc',$tables_array_all,$table_datasrc,"id=\"table_datasrc\"  onchange=\"app.list_columns_pkey();{$allow_config_cols_handler}\"  class=\"form-control\"  "  );

         if(!empty($table_datatbl)){

         //get primary key col**********************************************************************************
         $skipcols  = array('audituser','auditdate','audittime','ipaddress','auditip','ipaddr');

         $fields = $this->db->field_data($table_datatbl );
         $colums = [];
         $keycolums = [];
         foreach ($fields as $field)
         {
           $colname   = $field->name;
           $colums[]  = $colname;

           if($field->primary_key==1){
           $keycolums[]  = $colname;
           }

         }

          $colums_array = array();

         if(($colums)){
            foreach ($colums as $column){
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

        $table_keycol_select = form_dropdown('primary_key_col', $colums_array , $default_column , 'id="primary_key_col" class="form-control" ' );

        //***********************************************************************************************************
      }

              $html =  '<form id="frmMMcfg" name="frmMMcfg"  method="POST"  enctype="multipart/form-data" onsubmit="return false;"  > ';

              $html .=  "<table width=\"100%\" border=\"0\" class=\"table table-bordered table-condensed \" >";
              $html .=  "<input type=\"hidden\" value=\"{$mnuid}\" id=\"mnid\" name=\"mnid\"  />";

              if($allow_config_cols) {

              $html .=  "<input type=\"hidden\" value=\"datacrud\" id=\"modcont\" name=\"modcont\"  />";

              $html .=  "<tr>";
               $html .=  "<td  width=\"130px\">Data Table</td>";
               $html .=  "<td>{$tables_save_select}</td>";
              $html .=  "</tr>";

              $html .=  "<tr>";
               $html .=  "<td>Data Source</td>";
               $html .=  "<td>{$tables_list_select}</td>";
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
               $html .=  "<td id=\"\" colspan=\"2\" ><div id=\"tdColumns\"  style=\"max-width:1200px;overflow-x: hidden;overflow-x:auto;\"></div></td>";
              $html .=  "</tr>";

            }else{//config controller path

              $inputid  = "modcont";

              $html .=  "<tr>";
               $html .=  "<td  width=\"130px\">Controller Route</td>";
               $html .=  "<td>".form_dropdown($inputid ,$controllers,$modcont, "id=\"{$inputid}\" class=\"form-control\" ")."</td>";
              $html .=  "</tr>";

              $html .=  "</table>";
              $html .=  "</form>";

            }
              print $html;
