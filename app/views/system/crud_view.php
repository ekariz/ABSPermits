<?php

//if (!$grid_html = $this->cache->get($this->router->class)){
//$grid_html = $this->customcrud->drawDT();
//$this->cache->save($this->router->class, $grid_html, 300);
//}

echo $this->customcrud->drawDT();
$this->customcrud->genJS();

$dates = [];

?>

<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Manage</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form-data" class="form-horizontal">
                    <input type="hidden" value="" id="id" name="id" />
                    <div class="form-body">

                        <?php
                          if(sizeof($this->crud->columns)>0) {
                           foreach($this->crud->columns as $col=>$column_name){
                               $visible   = valueof($columnsvisibles, $col, 1);
                               $inputType = valueof($columntypes, $col, 1 );
                               $required  = '';
                               $input     = '';

                               if($visible==1  || $visible==3){
                                switch($inputType) {
                                    case 'text':
                                    default:
                                     $input  = "<input id=\"{$col}\"  name=\"{$col}\" placeholder=\"{$column_name}\" class=\"form-control\" type=\"text\">";
                                     break;
                                    case 'numberbox':
                                     $input  = "<input id=\"{$col}\" name=\"{$col}\" class=\"form-control\"  {$required}  >";
                                     break;
                                    case 'numberspinner':
                                     $input  = "<input type=\"number\" id=\"{$col}\" name=\"{$col}\" class=\"form-control\"  style=\"width:80px;\" data-options=\"min:0,precision:2\" >";
                                     break;
                                    case 'timespinner':
                                     $input  = "<input type=\"number\" id=\"{$col}\" name=\"{$col}\" class=\"form-control\"  style=\"width:80px;\" >";
                                     break;
                                    case 'monthspinner':
                                     $input  = "<input type=\"number\" id=\"{$col}\" name=\"{$col}\" class=\"form-control\"  style=\"width:80px;\" data-options=\"min:1,max:12,precision:0\" >";
                                     break;
                                    case 'email':
                                     $input  = "<input type=\"email\" id=\"{$col}\" name=\"{$col}\" class=\"form-control\" {$required}  >";
                                     break;
                                    case 'textarea':
                                     $input  = "<textarea  id=\"{$col}\" name=\"{$col}\" class=\"form-control\" {$required}  ></textarea>";
                                     break;
                                    case 'password':
                                     $input  = "<input type=\"password\" id=\"{$col}\" name=\"{$col}\" class=\"form-control\" {$required}  >";
                                     break;
                                    case 'date':
                                     $input  = "<input type=\"text\" id=\"{$col}\" name=\"{$col}\"   {$required} placeholder=\"YYYY-MM-DD\" class=\"form-control datepicker\" >";
                                     $dates[] = $col;
                                     break;
                                    case 'checkbox':
                                     $input  = "<input type=\"checkbox\" id=\"{$col}\" name=\"{$col}\" value=\"1\" class=\"form-control\" {$required}  >";
                                    break;
                                    case 'select':

                                        $table_col_datasrc          = isset($columnselects[$col]['table']) ? $columnselects[$col]['table'] : null;
                                        $linked_tbl_col_code        = isset($columnselects[$col]['col_code']) ? $columnselects[$col]['col_code'] : null;
                                        $linked_tbl_col_name        = isset($columnselects[$col]['col_name']) ? $columnselects[$col]['col_name'] : null;

                                        if(!empty($table_col_datasrc) && !empty($linked_tbl_col_code) && !empty($linked_tbl_col_name) ){
                                         $select_data        = [];
                                         $select_data[]      = '---select---';
                                         $select_data_src    = $this->common->select_assoc( $table_col_datasrc, $linked_tbl_col_code, $linked_tbl_col_name );

                                         if(sizeof($select_data_src>0)){
                                          foreach($select_data_src as $k=>$v){
                                            $select_data[$k] = $v;
                                          }
                                         }

                                         $input         = form_dropdown( $col, $select_data, '','id="'.$col.'" class="form-control" ');
                                        }

                                   break;
                                   case 'combogrid':
                                   $input  = "<input type=\"text\" id=\"{$col}\" name=\"{$col}\" class=\"form-control\" {$required}  >";
                                    echo '<script>';
                                     //echo ui::ComboGrid($combogrid_array,$col);
                                    echo '</script>';
                                   break;
                                   case 'yearselect':
                                    $year     = date("Y")-5;
                                    $end_year = date("Y")+1;

                                    $input = "<select name=\"{$col}\"  id=\"{$col}\" >";
                                    $input .= "<option value=\"\">[Year]</option>";
                                    while ($year < $end_year) {
                                     $input .= "<option value=\"{$year}\" >{$year}</option>";
                                     ++$year;
                                    }
                                   $input .= "</select>";
                                   break;
                                 }
                            echo <<<FIELD
                                <div class="form-group">
                                    <label class="control-label col-md-3">{$column_name}</label>
                                    <div class="col-md-9">
                                        {$input}
                                        <span class="help-block"></span>
                                    </div>
                                </div>
FIELD;
                           }
                          }
                        }
  ?>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="crud.save()" class="btn btn-primary"><i class="fa fa-check"></i> Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
<?php
if(sizeof($dates)>0){
 foreach($dates as $date){
 echo "\$(\"#{$date}\").datepicker({
    autoclose: true,
    dateFormat: 'yy-mm-dd',
    changeMonth: true,
    changeYear: true,
    todayHighlight: true,
    todayBtn: true,
    prevText: '<i class=\"fa fa-chevron-left\"></i>',
    nextText: '<i class=\"fa fa-chevron-right\"></i>',
  });\r\n";
 }
}
?>
</script>

