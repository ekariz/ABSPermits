 <style>
 div#div_menu { padding-left :10px;min-height:270px;max-height:270px;overflow:hidden;overflow-y:auto}
 ul.child { padding-left :30px;}
 ul.child li { padding :0;}
 </style>
 <form action="#" id="form-data" class="form-horizontal">
 <table class="table table-bordered table-responive table-condensed" >

       <tr>
        <td width="200px"><b>Role</b></td>
        <td><?php  echo form_dropdown('rolecode', $roles, '','id="rolecode" class="form-control" onchange="priviledges.load_menu()"  '); ?></td>
       </tr>

       <tr>
        <td><b>Module</b></td>
        <td><?php  echo form_dropdown('moduleid', $modules, '','id="moduleid" class="form-control" onchange="priviledges.load_menu()" '); ?></td>
       </tr>

<!--
       <tr>
        <td>&nbsp;</td>
        <td> &nbsp;<a href="javascript:void(0)" onclick="priviledges.select_all()" >Select All</a> &nbsp;|  &nbsp;<a href="javascript:void(0)" onclick="priviledges.select_none()" >Select None</a> &nbsp;</td>
       </tr>
-->

       <tr>
        <td><b>Menu</b></td>
        <td><div id="div_menu"></div></td>
       </tr>

       <tr>
        <td>&nbsp;</td>
        <td>
         <button type="button" id="btnSave" onclick="priviledges.save()" class="btn btn-primary"><i class="fa fa-check"></i> Grant Rights</button>
         <button type="button" class="btn btn-default" onclick="priviledges.reset()"><i class="fa fa-refresh"></i> Reset</button>
        </td>
       </tr>

    </table>
 </form>
<script>
//pageSetUp();

var priviledges={
 load_menu:function(){
    var rolecode=$('#rolecode').val(),moduleid=$('#moduleid').val();
    if(rolecode!='' && moduleid>0){
     ui.fc('<?php echo $this->router->class;?>/load_menu/'+rolecode+'/'+moduleid, 'div_menu');
    }
 },
 select_all:function(){
  $(".priviledge").prop("checked", true);
 },
 select_none:function(){
  $(".priviledge").prop("checked", false);
 },
 reset:function(){
   this.load_menu();
 },
 save:function(){
  $('#btnSave').attr('disabled',true);
  $.ajax({
    url : '<?php echo $this->router->class;?>/save',
    type: "POST",
    data: $('#form-data').serialize(),
    dataType: "JSON",
    success: function(data)
    {
       if(data.success==1) {
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
         timeout : 5000
        });
       }
       $('#btnSave').attr('disabled',false);
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
     alert('Error Processing. Try again in a few minutes');
     $('#btnSave').attr('disabled',false);
    }
  });
 },
}
</script>
