<?php

echo $this->customcrud->drawDT(false);

$this->customcrud->genJS(
  $load_datagrid      = true,
  $modal_title_change = false,
  $btn_add_visible    = false,
  $btn_import_visible = false,
  $btn_export_visible = false
  );

?>
<style>
.modal-dialog{
    position: relative;
    display: table;
    overflow-y: auto;
    overflow-x: auto;
    width: auto;
    min-width: 800px;
}
</style>


<iframe id="_iframex" name="_iframex" frameborder="0" width="0" height="0"></iframe>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"><?php echo $approval_name; ?> Approval </h3>
            </div>

            <div class="modal-body form">

                <form action="<?php echo $this->router->class;?>/save" target="_iframex" id="form-data" class="form-horizontal" method="post" enctype="multipart/form-data" >
                 <input type="hidden" value="" id="appno" name="appno"/>
                 <input type="hidden" value="" id="id" name="id"/>

                    <table class="table  table-striped table-bordered table-responsive  table-condensed nowrap">

                     <tr>
                      <td nowrap width="20%"><strong>Application No</strong></td>
                      <td><div id="div_appno"></div></td>
                      <td nowrap width="20%"><strong>Applicant Name</strong></td>
                      <td><div id="div_fullname"></div></td>
                     </tr>

                     <tr>
                      <td nowrap ><strong>Applicant Phone</strong></td>
                      <td><div id="div_phone"></div></td>
                      <td nowrap ><strong>Applicant Email</strong></td>
                      <td><div id="div_email"></div></td>
                     </tr>

                     <tr>
                      <td nowrap ><strong>Applicant Country</strong></td>
                      <td><div id="div_country"></div></td>
                      <td nowrap ><strong>Date Applied</strong></td>
                      <td><div id="div_date"></div></td>
                     </tr>

                     <tr>
                      <td colspan="4" ><div id="div_documents"></div></td>
                     </tr>

                     <tr>
                      <td colspan="4" >
                       <div id="div_approvals">
                        <table class="table table-bordered table-condensed">
                         <tr>
                          <?php
                          foreach($approvalsteps as $stepno=>$stepname){
                           echo "<th>{$stepname}</th>";
                          }
                          ?>
                         </tr>
                        </table>
                        </div>
                      </td>
                     </tr>

                     </table>

                </form>
            </div>

            <div class="modal-footer">
                <button type="button" id="btnView" onclick="workflow.view_application()" class="btn btn-info pull-left"><i class="fa fa-eye"></i> View</button>
                <button type="button" id="btnApprove" onclick="workflow.approve()" class="btn btn-success"><i class="fa fa-check"></i> Approve</button>
                <button type="button" id="btnDispproveInit" onclick="workflow.init_disapprove()" class="btn btn-danger"><i class="fa fa-history"></i> Dis-approve</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form_disapprove" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"><?php echo $approval_name; ?> Dis Approval</h3>
            </div>

            <div class="modal-body form">

                <form action="<?php echo $this->router->class;?>/disapprove"   id="form-disapprove" class="form-horizontal" method="post" enctype="multipart/form-data" >

                <div class="col-md-12 form-group">
                    <label for="email">Enter Reason</label>
                    <textarea type="text" class="form-control input-sm" name="reason" id="reason"   placeholder="Reason..."  ></textarea>
                    <div class="help-block with-errors"></div>
                </div>

                </form>
            </div>

            <div class="modal-footer">
                <button type="button" id="btnDispprove" onclick="workflow.disapprove()" class="btn btn-danger"><i class="fa fa-check"></i> Dis-Approve</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->


<script>


var workflow ={
 edit: function(id){
  crud.edit(id,'workflow.list_documents');
 },
 list_documents:function(){
  var id = $('#id').val(),
   appno = $('#appno').val();
   ui.fc('<?php echo $this->router->class;?>/list_documents/'+id,'div_documents');
   ui.fc('<?php echo $this->router->class;?>/list_approvals/'+id,'div_approvals');
 },
 approve:function (){
  var appno = $('#appno').val();
  $.SmartMessageBox({
   title : "Confirm",
   content : "Approve Application No. <font color='green'>"+appno+"</font>?",
   buttons : '[No][Yes]'
  },function(bp) {
  if (bp === "Yes") {
   $('#btnApprove').attr('disabled',true);
   $('#btnDispprove').attr('disabled',true);
   $.ajax({
    url : '<?php echo $this->router->class;?>/approve',
    type: "POST",
    data: $('#form-data').serialize(),
    dataType: "JSON",
    success: function(data)
    {
       if(data.success==1) {
         swal({
          text:data.message,
          icon: "success",
          buttons: false,
          timer: 2000,
         });
         crud.reload_table();
         $('#modal_form').modal('hide');
         $('#form-data')[0].reset();
       }else{
        swal({ text: data.message, icon: "error"});
       }
    $('#btnApprove').attr('disabled',false);
    $('#btnDispprove').attr('disabled',false);
   },
    error: function (jqXHR, textStatus, errorThrown)
   {
    $('#btnApprove').attr('disabled',false);
    $('#btnDispprove').attr('disabled',false);
    swal({ text: 'Error Approving', icon: "error"});
   }
  });
  }
 });
},
 init_disapprove:function(){
  $('#modal_form').modal('hide');
  $('#modal_form_disapprove').modal('show');
 },
 disapprove:function(){
    var id = $('#id').val(),
    appno = $('#appno').val(),
    reason = $('#reason').val();

   if(reason==''){
    $.bigBox({
     title : "Error",
     content : "Enter Disapproval Reason",
     color : "#C46A69",
     icon : "fa fa-warning shake animated",
     timeout : 3000
    });
   }else{
    $.SmartMessageBox({
        title : "Confirm",
        content : "Disapprove Application No. <font color='red'>"+appno+"</font>?",
        buttons : '[No][Yes]'
    }, function(bp) {
        if (bp === "Yes") {
         $('#btnApprove').attr('disabled',true);
         $('#btnDispprove').attr('disabled',true);
         $.ajax({
            url : "<?php echo $this->router->class;?>/disapprove/"+id,
            type: "POST",
            data: $('#form-data').serialize() + '&reason='+reason,
            dataType: "JSON",
            success: function(data) {
            if(data.success==1) {
             $.smallBox({
                title : "Status",
                content : "<i class='fa fa-thumbs-up'></i> <i>Application Disapproved</i>",
                color : "#C79121",
                iconSmall : "fa fa-remove bounce animated",
                timeout : 3000
             });
             crud.reload_table();
             $('#modal_form_disapprove').modal('hide');
             $('#form-data')[0].reset();
             $('#form-disapprove')[0].reset();
            }else{
             $('#modal_form_disapprove').modal('hide');
             swal({ text: data.message, icon: "error"});
            }
            $('#btnApprove').attr('disabled',false);
            $('#btnDispprove').attr('disabled',false);
           },
           error: function (jqXHR, textStatus, errorThrown) {
             $('#btnApprove').attr('disabled',false);
             $('#btnDispprove').attr('disabled',false);
             $('#modal_form_disapprove').modal('hide');
             swal({ text: 'Error Disapproving', icon: "error"});
            }
         });
        }
    });
  }
 },
 view_application:function(){
  swal({
     text: 'view doc',
     icon: "success",
     buttons: false,
     timer: 2000,
    });
 },
 view_document:function(docid){
  var id = $('#id').val();
   $('#_iframex').attr('src', '<?php echo $this->router->class;?>/view_document/'+id+'/'+docid);
 },
};


</script>
