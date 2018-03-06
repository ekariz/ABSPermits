<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CRUD library
 *
 *
 * @author Erastus Kariuki
 */
class CustomCrud
{
 private $appname;
 private $columns;
 private $columnsvisibles;
 private $gridcolumns;
 private $nosearchcolumns=[];
 private $route;
 private $mnid;

 public function __construct($params)
    {

     if(isset($params['route'])){
      $this->route = $params['route'];
     }

     if(isset($params['mnid'])){
      $this->mnid = "/{$params['mnid']}";
     }

     if(isset($params['appname'])){
      $this->appname = $params['appname'];
     }

     if(isset($params['columns'])){
      $this->columns = $params['columns'];
     }

     if(isset($params['columnsvisibles'])){
      $this->columnsvisibles = $params['columnsvisibles'];
     }

     if(isset($params['gridcolumns'])){
      $this->gridcolumns = $params['gridcolumns'];
     }

     if(isset($params['nosearchcolumns'])){
      $this->nosearchcolumns = $params['nosearchcolumns'];
     }

    }

public function drawDT( $btn_add_visible = true ){

  if(sizeof($this->gridcolumns)>0){
     $gridcolumns = $this->gridcolumns;
  }elseif(sizeof($this->columns)>0){
     $gridcolumns = $this->columns;
  }
//print_pre($gridcolumns);//remove


  $btn_add_text    = 'Add';
  $btn_add         =  $btn_add_visible ? '<button class="btn btn-primary btn-sm" id="btnAdd" onclick="crud.add()"><i class="fa fa-plus"></i> '.$btn_add_text.'</button>' : '';

  $table   = "<table id=\"{$this->route}\" class=\"table table-striped table-bordered table-hover table-condensed responsive nowrap\" cellspacing=\"0\" width=\"100%\" >";
   $table .= "<thead>\r\n";

//---------------------------------------------------------------------
   $table .= "<tr>\r\n";

  if(sizeof($gridcolumns)>0){
    $index = 0;
   foreach($gridcolumns as $column =>$column_name){
      if(!array_key_exists($column, $this->nosearchcolumns)){
       $column_name =  ($column_name);
       $table .= "<td><input type=\"text\" style=\"width:125px\"   id=\"search_{$column}\" placeholder=\"Search {$column_name}\" data-index=\"{$index}\" onkeyup=\"crud.filterData(this.id,{$index})\" /></td>";
      }else{
       $table .= "<td>&nbsp;</td>\r\n";
      }
      ++$index;
   }

  }

  $table .= "<td>{$btn_add}</td>\r\n";
  $table .= "</tr>\r\n";

//---------------------------------------------------------------------

  $table .= "<tr>\r\n";
  if(sizeof($gridcolumns)>0){
   foreach($gridcolumns as $column =>$column_name){
      $column_name = ($column_name);
      $table .= "<th>{$column_name}</th>";
   }
  }
   $table .= "<th>Action</th>\r\n";
  $table .= "</tr>\r\n";

//---------------------------------------------------------------------

  $table .= "</thead>\r\n";

  $table .= "<tbody>\r\n";
  $table .= "</tbody>\r\n";

  $table .= "<tfoot>\r\n";

  if(sizeof($gridcolumns)>0){
   foreach($gridcolumns as $column =>$column_name){
      $column_name = Camelize($column_name);
      $table .= "<td style=\"color:#ccc\">{$column_name}</td>";
   }
  }

  $table .= "<td>&nbsp;</td>\r\n";

  $table .= "</tfoot>\r\n";

  $table .= "</table>\r\n";

  return $table;

}

public function genJS(
  $load_datagrid      = true,
  $modal_title_change = true,
  $btn_add_visible    = true,
  $btn_import_visible = true,
  $btn_export_visible = true,
  $btn_add_text       = 'Add',
  $btn_import_text    = 'Import',
  $btn_export_text    = 'Export',
  $btn_save_text      = 'Save'
 ){

  $btn_import_visible = false;
  $btn_export_visible = false;

  $btn_add    =  $btn_add_visible ? '<button class="btn btn-primary btn-sm"   onclick="crud.add()"><i class="fa fa-plus"></i> '.$btn_add_text.'</button>' : '';
  $btn_import =  $btn_import_visible ? '<button class="btn btn-default btn-sm" id="btnImport"  onclick="crud.import()"><i class="fa fa-arrow-down"></i>  '.$btn_import_text.'</button>' : '';
  $btn_export =  $btn_export_visible ? '<button class="btn btn-default btn-sm" id="btnExport"  onclick="crud.export()"><i class="fa fa-arrow-up"></i>  '.$btn_export_text.'</button>' : '';
  $tb_buttons = "{$btn_add}&nbsp;{$btn_import}&nbsp;{$btn_export}";

?>
<script>
<?php
 if($load_datagrid){
?>
var table;
    table = $('#<?php echo $this->route; ?>').DataTable({
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "lengthChange": true,
        "paging": true,
        "ordering": true,
        "info": true,
        "order": [],
        "ajax": {
            "url": '<?php echo "{$this->route}/data{$this->mnid}";?>',
            "type": "POST"
        },
        "columnDefs": [{
            "targets": [ -1 ],
            "orderable": false,
        },
        ],
    });

<?php if( $btn_add_visible || !$btn_import_visible || $btn_export_visible ){ ?>
 $("div#<?php echo $this->route;?>_length").html('<div class="tb_buttons" style="float:left;padding-right:50px;margin-right:100px;" ><?php echo $tb_buttons; ?></div>');
 $("div#<?php echo $this->route;?>_length").hide();
 $('#btnAdd').html('<i class="fa fa-plus"></i> <?php echo $btn_add_text; ?>');
<?php } ?>

$("#<?php echo $this->route;?>_filter").css("display","none");

<?php
}
?>
var crud={
 reset:function(){
     $('#data-form').trigger("reset");
     $('select').val('')
     $("select").prop('selectedIndex', -1);
     $('#data-form :checkbox, :radio').prop('checked', false);
     $('input[type=checkbox]').prop('checked', false);
     $('#id').val(0);
     $("button#btnDelete").attr("disabled", "disabled");
     crud.reload_table();
     $('button#btnSave').prop('disabled', false);
 },
 add:function(){
    $('#form-data')[0].reset();
    $('select').val('');
    $('input[type=checkbox]').prop('checked', false);
    $('#id').val('');
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();
    $('#modal_form').modal('show');
    <?php if($modal_title_change){ ?>
    $('.modal-title').text('Add <?php echo $this->appname;?>');
    <?php } ?>
    $('#btnSave').html('<?php echo $btn_save_text; ?>');
    $('#btnSave').attr('disabled',false);
    if (typeof after_add_hook !== 'undefined' && $.isFunction(after_add_hook)) {
     after_add_hook();
    }
 },
 edit:function (id, triggerFn){
    $('#form-data')[0].reset();
    $('select').val('');
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();
    $('#btnSave').html('<?php echo $btn_save_text; ?>');
    $('#btnSave').attr('disabled',false);
    $.ajax({
        url : '<?php echo "{$this->route}/edit{$this->mnid}";?>/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data){
            ui.fp(data);
            $('#modal_form').modal('show');
            <?php if($modal_title_change){ ?>
             $('.modal-title').text('Edit <?php echo $this->appname;?>');
            <?php } ?>
            if(typeof triggerFn=='string' && triggerFn!=''){eval(triggerFn+'()');}
        },
        error: function (jqXHR, textStatus, errorThrown){
            alert('Error get data from server');
            console.log(textStatus);
        }
    });
    if (typeof after_edit_hook !== 'undefined' && $.isFunction(after_edit_hook)) {
     after_edit_hook();
    }
 },
 reload_table:function (){
    <?php
    if($load_datagrid){
      echo 'table.ajax.reload(null,false);';
    }
    ?>
 },
 filterData:function(id,i){
  var v = $('#'+id).val();
  console.log(v);
  table.columns(i).search(v).draw();
 },
 save:function (){
    $('#btnSave').text('Please wait...');
    $('#btnSave').attr('disabled',true);
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();
    $.ajax({
        url : '<?php echo "{$this->route}/save{$this->mnid}";?>',
        type: "POST",
        data: $('#form-data').serialize(),
        dataType: "JSON",
        success: function(data)
        {
           if(data.status) {
            $('#modal_form').modal('hide');
             crud.reset();
             if (typeof after_save_hook !== 'undefined' && $.isFunction(after_save_hook)) {
              setTimeout(after_save_hook, 5000);
             }
             $.smallBox({
              title : "Success",
              content : data.message,
              color : "#739E73",
              iconSmall : "fa fa-check",
              timeout : 2000
            });
           }else{
            if(typeof data.inputerror!='undefined'){
             for (var i = 0; i < data.inputerror.length; i++){
              $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
              $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
             }
            }
            var message = typeof data.message=='string' ? data.message : 'Fill in All Required Fields';
            $.bigBox({
             title : "Error",
             content : message,
             color : "#C46A69",
             icon : "fa fa-warning shake animated",
             timeout : 3000
            });
           }
         $('#btnSave').html('<?php echo $btn_save_text; ?>');
         $('#btnSave').attr('disabled',false);

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
         alert('Error saving data');
         $('#btnSave').html('<?php echo $btn_save_text; ?>');
         $('#btnSave').attr('disabled',false);
        }
    });
},
 remove:function (id) {
    $.SmartMessageBox({
        title : "Confirm Delete",
        content : "Are you sure you want to delete this record?",
        buttons : '[No][Yes]'
    }, function(bp) {
        if (bp === "Yes") {
         $.ajax({
            url : '<?php echo "{$this->route}/remove{$this->mnid}";?>/'+id,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
             if(data.status) {
               $('#modal_form').modal('hide');
               crud.reload_table();
               crud.reset();
               $.smallBox({
                title : "Status",
                content : "<i class='fa fa-thumbs-up'></i> <i>Record Deleted</i>",
                color : "#C79121",
                iconSmall : "fa fa-trash-o bounce animated",
                timeout : 1500
               });
             }else{
              $.bigBox({
               title : "Error",
               content : data.message,
               color : "#C46A69",
               icon : "fa fa-warning shake animated",
               timeout : 3000
              });
             }
            },
            error: function (jqXHR, textStatus, errorThrown) {
             $.bigBox({
                title : "Error",
                content : 'Error deleting data',
                color : "#C46A69",
                icon : "fa fa-warning shake animated",
                timeout : 3000
             });
            }
         });
        }

    });
 },
  import:function(){
    $("#importModal").modal('show');
   },
   export:function(){
    $("#exportModal").modal('show');
   },
   do_export:function(id,module_packed)  {
    var export_size =$('#export_size').val();
    $.post('<?php echo "{$this->route}/export{$this->mnid}";?>', 'export_size='+export_size, function(data) {
     if (data.success === 1) {

        $("#exportModal").modal('hide');

      if(typeof data.export === 'string'){
        top.location = './' + data.export;
      }else{
         alert('unable to get export file location');
      }

     } else {
      var err;
      if(typeof data.message === 'undefined'){
        err  =  'An error occured';
      }else{
        err  =  data.message;
      }
       alert( err );
     }
    }, "json");
   },
}

</script>
<?php

}

}
