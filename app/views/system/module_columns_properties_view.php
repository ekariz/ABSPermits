<?php

         $modcfg = array() ;
         $cfg_column_selectsrc = array() ;

         if(isset($vars) && !empty($vars)){
          $modcfg             = unserialize( base64_decode( $vars ) );
          $table_datatbl      = valueof($modcfg, 'table_datatbl');
          $modpath            = valueof($modcfg, 'modpath');
         }

        if( isset($_SESSION['linked_to_foreign_cols']) ){
          unset($_SESSION['linked_to_foreign_cols']);
        }

        if(!empty($modcfg)) {
         foreach ($modcfg['alias'] as $dbcol => $alias ){

            $typecol    = "forminput_{$dbcol}";
            $inputType  = valueof($modcfg,$typecol);

            if($inputType=='select' || $inputType=='combogrid'){

              /**
               * get col src
               */
              $selectsrc  =  isset($modcfg['selects'][$dbcol]['table']) ? $modcfg['selects'][$dbcol]['table'] : null;
              $cfg_column_selectsrc[$dbcol] = array($inputType ,$selectsrc);

             if(!empty($selectsrc)){
              $selectsrc_array            = isset($modcfg['selects'][$dbcol]) ? $modcfg['selects'][$dbcol]  : [];
              $table_col_datasrc          = valueof($selectsrc_array, 'table');
              $linked_tbl_col_code        = valueof($selectsrc_array, 'col_code');
              $linked_tbl_col_name        = valueof($selectsrc_array, 'col_name');

              $_SESSION['linked_to_foreign_cols'][$dbcol]['table']     = $table_col_datasrc;
              $_SESSION['linked_to_foreign_cols'][$dbcol]['col_code']  = $linked_tbl_col_code;
              $_SESSION['linked_to_foreign_cols'][$dbcol]['col_name']  = $linked_tbl_col_name;

             }
            }
         }
        }

        $alignments            = array('left'=>'left','center'=>'center','right'=>'right');
        $visibles              = array('1'=>'Form & Grid','2'=>'Grid Only','3'=>'Form Only','4'=>'Not Visible');
        $validation_classes    = array('easyui-validatebox'=>'default');
        $requiredArray         = array(0=>'No',1=>'Yes');
        $allowImpExpArray      = array(1=>'Yes',0=>'No');
        $sortableArray         = array(0=>'No',1=>'Yes');
        $validtypes            = array('0'=>'none','email'=>'email','url'=>'url','ln05'=>'ln[min=0,max=5]','ln10'=>'ln[min=0,max=10]','ln20'=>'ln[min=0,max=20]');
        $forminputs_select     = array('text'=>'text','numberbox'=>'Number Box','numberspinner'=>'Number Spinner','timespinner'=>'Time Spinner','monthspinner'=>'Month Spinner','email'=>'email','textarea'=>'textarea','select'=>'select','combogrid'=>'combogrid','yearselect'=>'Year Select','radio'=>'radio','checkbox'=>'checkbox','date'=>'date','password'=>'password');
        $forminputs_noselect   = array('text'=>'text','numberbox'=>'Number Box','numberspinner'=>'Number Spinner','timespinner'=>'Time Spinner','monthspinner'=>'Month Spinner','email'=>'email','textarea'=>'textarea','select'=>'select','combogrid'=>'combogrid','yearselect'=>'Year Select','radio'=>'radio','checkbox'=>'checkbox','date'=>'date','password'=>'password');
        $forminputs_numbers    = array('text'=>'text','numberbox'=>'Number Box','numberspinner'=>'Number Spinner','timespinner'=>'Time Spinner','monthspinner'=>'Month Spinner');
        $forminputs_checkbox   = array('checkbox'=>'checkbox');

        $colums    = $this->db->list_fields($table_datasrc);

        $keycolums = [];

        if(count($colums)>15){
        }

        $skipcols = array('id', 'audituser','modifyby','modifydate','auditdate','audittime','ipaddress','auditip','ipaddr');
        $colums_array = array();

        if($colums){
         foreach ($colums as $column ){
               if(!in_array($column, $skipcols)){
                $colums_array[$column] = $column;
               }
         }
        }

        /**
         * alias for auto-gen modules
         */
        foreach ($colums_array as $column => $properties){
                $alias   = isset($modcfg['alias'][$column]) ? $modcfg['alias'][$column] : generateRandomChars("6");
                $data    = array(
                        'type'          => 'hidden',
                        'name'          => "alias[$column]",
                        'id'            => "alias[$column]",
                        'value'         => strtolower($alias),
                );
            echo  form_input( $data );
        }

        if(count($colums_array)){
            echo "<table width='100%' cellpadding='2' cellspacing='2'  class=\"tablex table-borderedx table-condensed \">";

            echo "<tr>";
            echo "<td>&nbsp;</td>";
             foreach ($colums_array as $column => $columnname){
                echo "<td><small><b>{$column}</b></small></td>";
             }
            echo "</tr>";


            //**************************************************
            echo "<tr>";
            echo "<td><label>Title:</label></td>";

            foreach ($colums_array as $column => $properties){

                if(strstr($column,'CODE')){
                 $title_default = 'Code';
                }elseif(strstr($column,'NAME')){
                 $title_default = 'Name';
                }else{
                 $title_default = $column;
                }

                $title      = isset($modcfg['title'][$column]) ? $modcfg['title'][$column] : Camelize($title_default);

                $data = array(
                        'name'          => "title[$column]",
                        'id'            => "title[$column]",
                        'value'         => $title,
                        'maxlength'     => '100',
                        'size'          => '10',
                        'class'         => 'form-control input-sm'
                );

                echo "<td>".form_input($data)."</td>";
             }

            echo "</tr>";

            echo "<tr>";
            echo "<td>Visible</td>";

            foreach ($colums_array as $column => $properties){
                $visible      = isset($modcfg['visible'][$column]) ? $modcfg['visible'][$column] : 1;
                $inputid      = "visible[$column]";
                echo "<td  title=\"Visibility\">".form_dropdown($inputid ,$visibles,$visible, "id=\"{$inputid}\" class=\"form-control\" ")."</td>";
             }

            echo "</tr>";

            //**************************************************

            echo "<tr>";
            echo "<td>Required</td>";

            foreach ($colums_array as $column => $properties){
                $required      = isset($modcfg['required'][$column]) ? $modcfg['required'][$column] : '1';
                $inputid       = "required[$column]";
                echo "<td  title=\"Required\">".form_dropdown($inputid ,$requiredArray,$required, "id=\"{$inputid}\" class=\"form-control\" ")."</td>";
             }

            echo "</tr>";

            //**************************************************

           if(count($colums)>=1){
            echo "<tr>";
            echo "<td>Form Input</td>";

            foreach ($colums_array as $column => $properties){

                if(strstr($column,'CODE') || strstr($column,'ACTIVE')){
                    $forminputs = $forminputs_select;
                    $defaultType = 'text';
                }elseif(strstr($column,'DATE')){
                    $forminputs  = $forminputs_select;
                    $defaultType = 'date';
                }elseif(strstr($column,'AMT') || strstr($column,'AMOUNT')){
                    $forminputs  = $forminputs_numbers;
                    $defaultType = 'numberbox';
                }elseif(substr($column,0,2)=='IS'){
                    $forminputs = $forminputs_checkbox;
                    $defaultType = 'text';
                }elseif(strtolower($column=='password')){
                    $forminputs = $forminputs_select;
                    $defaultType = 'password';
                }else{
                    $forminputs = $forminputs_noselect;
                    $defaultType = 'text';
                }

                //$forminput_type = isset($cfg_column_selectsrc[$column][0]) ? $cfg_column_selectsrc[$column][0] : $defaultType;

                $forminput_col  = "forminput_{$column}";
                $inputDefault   = valueof($modcfg,$forminput_col, $defaultType );
                $inputid        = "forminput_{$column}";

                echo "<td  title=\"Form Input\">".form_dropdown($inputid ,$forminputs,$inputDefault, "id=\"{$inputid}\" onchange=\"app.forminput_type_check('{$inputid}','{$column}');\"  class=\"form-control\" ")."</td>";
             }

            echo "</tr>";
           }

            //**************************************************
            echo "</table>";
        }
