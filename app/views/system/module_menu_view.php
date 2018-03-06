<?php
$apps['zzzzzzzz'] = 'Select App';
krsort($apps);

?>

<?php  echo form_dropdown('appid', $apps, 'zzzzzzzz','id="appid" class="form-control" onchange="app.modules_list();" '); ?>
<br>
<table id="treetable" class="table table-bordered table-condensed table-hover table-striped fancytree-fade-expander">
    <colgroup>
        <col width="80px"></col>
        <col width="30px"></col>
        <col width="*"></col>
        <col width="100px"></col>
        <col width="100px"></col>
        <col width="100px"></col>
    </colgroup>
    <thead>
        <tr> <th></th> <th></th> <th>Menu</th> <th>Edit</th> <th>Add Sub</th> <th>Setup</th> </tr>
    </thead>
    <tbody>
        <tr> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> </tr>
    </tbody>
</table>


<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Apps</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form-data" class="form-horizontal">
                    <input type="hidden" value="" id="appid" name="appid" />
                    <input type="hidden" value="" id="id" name="id" />
                    <input type="hidden" value="" id="parentid" name="parentid" />
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Menu Path</label>
                            <div class="col-md-9" id="div_appid">
                                <input id="menupath"  name="menupath" placeholder="" class="form-control" type="text" readonly disabled >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Menu Name</label>
                            <div class="col-md-9">
                                <input id="modname"  name="modname" placeholder="Menu Name" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Interface Type</label>
                            <div class="col-md-9">
                                <?php  echo form_dropdown('mnutype', $mnutypes, '','id="mnutype" class="form-control"   '); ?>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Icon</label>
                            <div class="col-md-6">
                                <input id="modicon"  name="modicon" placeholder="Icon" class="form-control" type="text" style="width:200px;" onchange="app.show_icon();">
                            </div>
                            <div class="col-md-3" id="modicon-view">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Icon Color</label>
                            <div class="col-md-9">
                                <?php  echo form_dropdown('iconclr', $colors, '','id="iconclr" class="form-control" onchange="app.show_icon();" '); ?>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Position</label>
                            <div class="col-md-9">
                                <input id="modpos"  name="modpos" value="1" class="form-control" type="number" min="1" max="15">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Active</label>
                            <div class="col-md-9">
                                <input id="active"  name="active" value="1" class="form-control" type="checkbox">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="app.save()" class="btn btn-primary"><i class="fa fa-check"></i> Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_setup" role="dialog">
    <div class="modal-dialog modal-lg" style="width: 100%;height: 100%;padding: 0;margin: 0;" >
        <div class="modal-content" style="height: 100%;min-height: 100%;height: auto;border-radius: 0;">

            <div class="modal-body form">
                <form action="#" id="form-setup" class="form-horizontal">
                    <div class="form-body" id="div_setup_node">

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSaveSetup" onclick="app.save_setup()" class="btn btn-success"><i class="fa fa-check"></i> Save Setup</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->


<!-- Bootstrap modal -->
<div class="modal fade" id="modal_setup_selectsrc" role="dialog">
    <div class="modal-dialog modal-md" >
        <div class="modal-content"  >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title-fcol">Select Data Source</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form-selectsrc" class="form-horizontal">
                    <div class="form-body" id="div_setup_node">
                      <table width="100%" border="0" cellpadding="2"  cellspacing="1" >
                      <input type="hidden" id="col_linked_to_foreign_col" name="col_linked_to_foreign_col" >

                      <tr>
                       <td  width="180px">Select Src </td>
                       <td id="tdTables"><?php  echo form_dropdown('table_col_datasrc', [], '','id="table_col_datasrc" class="form-control" '); ?></td>
                      </tr>

                      <tr>
                       <td>Code Column</td>
                       <td id="tdFKCode">&nbsp;</td>
                      </tr>

                      <tr>
                       <td>Name Column</td>
                       <td id="tdFKName" >&nbsp;</td>
                      </tr>

                      </table>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSaveSetup" onclick="app.pre_save_select_source()" class="btn btn-primary">  Set Source</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->


<script>

glyph_opts = {
 map: {
  doc: "fa fa-file-o",
  docOpen: "fa fa-file-o",
  checkbox: "fa fa-square-o",
  checkboxSelected: "fa fa-check-square-o",
  checkboxUnknown: "fa fa-square",
  dragHelper: "fa fa-arrow-right",
  dropMarker: "fa fa-long-arrow-right",
  error: "fa fa-warning",
  expanderClosed: "fa fa-caret-right",
  expanderLazy: "fa fa-angle-right",
  expanderOpen: "fa fa-caret-down",
  folder: "fa fa-folder-o",
  folderOpen: "fa fa-folder-open-o",
  loading: "fa fa-spinner fa-pulse"
 }
};

$("#treetable").fancytree({
    extensions: ["dnd", "edit", "glyph", "table","contextMenu"],
    checkbox: true,
    dnd: {
        focusOnClick: true,
        dragStart: function(node, data) { return true; },
        dragEnter: function(node, data) { return true; },
        dragDrop: function(node, data) { data.otherNode.copyTo(node, data.hitMode); }
    },
    glyph: glyph_opts,
    source: {url: "ModuleMenu/tree_data/"},
    table: {
        checkboxColumnIdx: 1,
        nodeColumnIdx: 2
    },
    activate: function(event, data) {
    },
 });
var app ={
 modules_list :function (){
 var appid = $('#appid').val();
 $("#treetable").fancytree("destroy");
 $("#treetable").fancytree({
    extensions: ["dnd", "edit", "glyph", "table","contextMenu"],
    checkbox: true,
    dnd: {
        focusOnClick: true,
        autoExpandMS: 400,
        preventVoidMoves: true,
        preventRecursiveMoves: true,
        dragStart: function(node, data) {return true;},
        dragEnter: function(node, data) {
            return ["before", "after"];
        },
        dragDrop: function(node, data) {
          data.otherNode.moveTo(node, data.hitMode);
        }
    },
    glyph: glyph_opts,
    source: {url: "ModuleMenu/tree_data/"+appid},
    table: {
        checkboxColumnIdx: 1,
        nodeColumnIdx: 2
    },
    activate: function(event, data) {
    },
    lazyLoad: function(event, data) {
       var node = data.node;
       console.log(data);
       data.result = {
        url: "ModuleMenu/tree_sub_data/"+node.key
       }
    },
    renderColumns: function(event, data) {
        var node = data.node,
            $tdList = $(node.tr).find(">td");
            $tdList.eq(0).text(node.getIndexHier());
            $tdList.eq(3).text(!!node.folder);
            var link_edit   = "<a href=\"javascript:void(0);\" onclick=\"app.edit_node('"+node.key+"', '"+node.title+"');\" title=\" edit "+node.title+"\" ><i class=\"fa fa-pencil txt-color-purple\"></i></a>";
            var link_addsub = "<a href=\"javascript:void(0);\" onclick=\"app.add_node('"+node.key+"', '"+node.title+"');\" title=\" add sub to "+node.title+"\" ><i class=\"fa fa-plus txt-color-blueDark\"></i></a>";
            var link_setup  = "<a href=\"javascript:void(0);\" onclick=\"app.setup_node('"+node.key+"', '"+node.title+"');\" title=\" setup "+node.title+"\" ><i class=\"fa fa-sliders txt-color-orangeDark\"></i></a>";
            /*var div_actions  = "<div class=\"btnBlock\" >"+link_edit+"&nbsp;"+link_addsub+"&nbsp;"+link_setup+"&nbsp;</div>";*/
            $tdList.eq(3).html(link_edit);
            $tdList.eq(4).html(link_addsub);
            $tdList.eq(5).html(link_setup);
        /*  $tdList.eq(3).text(!!node.folder);*/
    },
    contextMenu: {
    menu: {
      "edit": { "name": "Edit", "icon": "edit" },
      "add": { "name": "Sub", "icon": "add" },
      "setup": { "name": "Setup", "icon": "edit" },
      "sep1": "---------",
      "delete": { "name": "Delete", "icon": "delete" },
      "quit": { "name": "Quit", "icon": "quit" }
    },
    actions: function(node, action, options) {
     switch(action){
       case 'add':
        app.add_node(node.key, node.title);
       break;
       case 'edit':
        app.edit_node(node.key, node.title);
       break;
       case 'setup':
        app.setup_node(node.key, node.title);
       break;
       case 'delete':
        app.remove(node.key, node.title);
       break;
     }
    }
   },
 });
},
 add_node :function (nodekey,name){
    ui.fpf('<?php echo $this->router->class;?>/add_node/'+nodekey);
    $('#form-data')[0].reset();
    $('#id').val('');
    $('#parentid').val(nodekey);
    $('#appid').val(nodekey);
    $('#appname').val(name);
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();
    $('#modal_form').modal('show');
    $('.modal-title').text('Add Sub to - '+name);
    $('#btnSave').text('save');
    $('#btnSave').attr('disabled',false);
    $('#modicon-view').html('&nbsp;');
    this.icon_ac();
 },
 edit_node :function (nodekey,name){
    $('#form-data')[0].reset();
    $('#btnSave').attr('disabled',true);
    ui.fpa('<?php echo $this->router->class;?>/edit_node/'+nodekey,"app.show_icon");
    $('.modal-title').text('Edit '+name);
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();
    $('#modal_form').modal('show');
    $('#btnSave').text('Save');
    $('#btnSave').attr('disabled',false);
    $('#modicon-view').html('&nbsp;');
    this.icon_ac();
 },
 setup_node :function (nodekey,name){
    $('#form-setup')[0].reset();
    $('#btnSaveSetup').attr('disabled',true);
    ui.fc('<?php echo $this->router->class;?>/setup_node/'+nodekey,'div_setup_node');
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();
    $('#modal_setup').modal('show');
    $('#btnSaveSetup').text('Save');
    $('#btnSaveSetup').attr('disabled',false);
 },
 icon_ac:function() {
 var options = {
  url: function(phrase) {
    return "<?php echo $this->router->class;?>/search_icons";
  },
  getValue: function(element) {
    return element.name;
  },
  ajaxSettings: {
    dataType: "json",
    method: "POST",
    data: {
      dataType: "json"
    }
  },
  preparePostData: function(data) {
    data.phrase = $("#modicon").val();
    return data;
  },
  requestDelay: 400,
  list: {
    match: {
      enabled: true
    },
    maxNumberOfElements: 10
  },
  template: {
    type: "custom",
    method: function(value, item) {
      return "<span class='fa " + (item.code).toLowerCase() + "' ></span> " + value;
    }
  },
  theme: "round"
 };
 $("#modicon").easyAutocomplete(options);
 },
 show_icon: function(){
  modicon = $("#modicon").val();
  iconclr = $("#iconclr").val();
  $('#modicon-view').html('<i class="fa fa-lg fa-fw  '+modicon+' txt-color-'+iconclr+' "></i>');
 },
 save:function (){
    $('#btnSave').text('saving...');
    $('#btnSave').attr('disabled',true);
    $.ajax({
        url : '<?php echo $this->router->class;?>/save',
        type: "POST",
        data: $('#form-data').serialize(),
        dataType: "JSON",
        success: function(data)
        {
           if(data.status) {
             $('#modal_form').modal('hide');
             $('#form-data')[0].reset();
             app.modules_list();
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
            $.bigBox({
             title : "Error",
             content : 'Fill in All Required Fields',
             color : "#C46A69",
             icon : "fa fa-warning shake animated",
             timeout : 3000
            });
           }
        $('#btnSave').text('save');
        $('#btnSave').attr('disabled',false);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
         alert('Error saving data');
         $('#btnSave').text('save');
         $('#btnSave').attr('disabled',false);
        }
    });
},
 remove:function (node,title) {
    $.SmartMessageBox({
        title : "Confirm Delete",
        content : "Are you sure you want to delete <font color='red'>"+title+"</font>?",
        buttons : '[No][Yes]'
    }, function(bp) {
        if (bp === "Yes") {
         $.ajax({
            url : "<?php echo $this->router->class;?>/remove/"+node,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
            if(data.status) {
             $.smallBox({
                title : "Status",
                content : "<i class='fa fa-thumbs-up'></i> <i>Record Deleted</i>",
                color : "#C79121",
                iconSmall : "fa fa-trash-o bounce animated",
                timeout : 1500
             });
             app.modules_list();
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
 set_same_source:function(){
    var table_datatbl = $('#table_datatbl').val();
    $('[name="table_datasrc"]').val(table_datatbl);
    jQuery("select#table_datasrc option[value='"+table_datatbl+"']").attr("selected", "selected");
 },
 list_columns_pkey:function(){
  ui.cc('<?php echo $this->router->class;?>/list_columns_pkey', 'table_datatbl='+$('#table_datatbl').val(), 'tdPkey');
 },
 list_columns_properties:function(appid,mnid) {
   ui.cc('<?php echo $this->router->class;?>/setup_list_columns_properties/'+appid+'/'+mnid, $('#form-setup').serialize() , 'tdColumns');
},
forminput_type_check:function(inputid, columnname) {
   var inputval = $('#'+inputid).val();
   $('input#col_linked_to_foreign_col').val('');
   if(inputval==='select' || inputval==='combogrid'){
    var table_datatbl = $('#table_datatbl').val();
    $('input#col_linked_to_foreign_col').val(columnname);
    ui.fc('<?php echo $this->router->class;?>/list_tables/'+table_datatbl,'tdTables');
    $('#modal_setup_selectsrc').modal('show');
    $('.modal-title-fcol').text("Select linked table for column '"+columnname+"'");
   }
},
list_columns_select_src:function() {
  var table_col_datasrc = $('#table_col_datasrc').val();
  var col_linked_to_foreign_col = $('#col_linked_to_foreign_col').val();
  ui.fc('<?php echo $this->router->class;?>/list_columns_select_src/code/'+table_col_datasrc+'/'+col_linked_to_foreign_col, 'tdFKCode');
  ui.fc('<?php echo $this->router->class;?>/list_columns_select_src/name/'+table_col_datasrc+'/'+col_linked_to_foreign_col, 'tdFKName');
},
pre_save_select_source:function(){
 var col_linked_to_foreign_col = $('#col_linked_to_foreign_col').val();
  $.ajax({
  type: 'POST',
  url:'<?php echo $this->router->class;?>/pre_save_select_source',
  data: $('#form-selectsrc').serialize(),
   success: function(responseText){
    $('#modal_setup_selectsrc').modal('hide');
   }
  });
 },
 save_setup:function(){
  $("#btnSave").attr("disabled", "disabled");
  $.post('<?php echo $this->router->class;?>/save_setup',   $('#form-setup').serialize()   , function(data) {
  $("#btnSave").removeAttr( "disabled");
   if(data.success===1){
     $.smallBox({
      title : "Success",
      content : data.message,
      color : "#739E73",
      iconSmall : "fa fa-check",
      timeout : 2000
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
  }, "json" );
 }
}

</script>
<?php
//$this->customcrud->genJS(false);
?>

