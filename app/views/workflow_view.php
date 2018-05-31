<?php

echo $this->customcrud->drawDT(false);

$this->customcrud->genJS(
  $load_datagrid      = true,
  $modal_title_change = false,
  $btn_add_visible    = false,
  $btn_import_visible = false,
  $btn_export_visible = false
  );

$select_consult_with = '<select id="consult_with" name="consult_with[]" multiple="multiple" >';
foreach($approvalsteps as $stepno=>$stepname){
 $select_consult_with .='<option value="'.$stepno.'">'.$stepname.'</option>';
}
$select_consult_with .= '</select>';


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
                <h3 class="modal-title" id="h3_title" ><div id="div_title"><?php echo $approval_name; ?> Approval </div></h3>
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
                <button type="button" id="btnView" onclick="workflow.view_application()" class="btn btn-info pull-left"><i class="fa fa-print"></i> View</button>
                <button type="button" id="btnConsult" onclick="workflow.init_consult()" class="btn btn-warning pull-left"><i class="fa fa-comments-o "></i> Consult</button>
                <button type="button" id="btnApprove" onclick="workflow.init_approve()" class="btn btn-success"><i class="fa fa-check"></i> Approve</button>
                <button type="button" id="btnDispproveInit" onclick="workflow.init_disapprove()" class="btn btn-danger"><i class="fa fa-history"></i> Dis-approve</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form_approve" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"><?php echo $approval_name; ?> Approval Comments</h3>
            </div>

            <div class="modal-bodyx formx">

                <form action="<?php echo $this->router->class;?>/approve"   id="form-approve" class="form-horizontal" method="post" enctype="multipart/form-data" >

                <div class="col-md-12 form-groupx">
                    <textarea type="text" class="form-control  " name="comments-approve" id="comments-approve"   placeholder="Comment..."  ></textarea>
                </div>

                </form>
            </div>

            <div class="modal-footer">
                <button type="button" id="btnModalApprove" onclick="workflow.approve()" class="btn btn-success"><i class="fa fa-check"></i> Approve</button>
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

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form_consult" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Consultation</h3>
            </div>

            <div class="modal-body form">

                <div class="row">
                  <div class="col-md-12">
                    <span class="alert alert-info">The consultation will be sent via email</span>
                    <hr>
                  </div>
                </div>

                <form id="form-consult" class="form-horizontal" role="form" onsubmit="return false">

                <div class="form-group">
                <label class="col-sm-2 control-label" for="consult_with">Consult with</label>
                 <div class="col-sm-10">
                   <?php  echo $select_consult_with; ?>
                 </div>
                </div>

                <div class="form-group">
                <label class="col-sm-2 control-label" for="subject">Subject</label>
                 <div class="col-sm-10">
                  <input type="text" class="form-control input-sm" name="subject" id="subject" value=""  >
                 </div>
                </div>

                <div class="form-group">
                <label class="col-sm-2 control-label" for="message">Message</label>
                 <div class="col-sm-10">
                  <textarea type="text" class="form-control input-sm" name="message" id="message"   placeholder="Message..." rows="5" ></textarea>
                 </div>
                </div>

                <div class="form-group">
                <label class="col-sm-2 control-label" for="">Documents</label>
                 <div class="col-sm-10">
                  <label class="text-muted control-label" for="consultdocs"> <input type="checkbox" id="consultdocs" name="consultdocs"  value="1" > Attach application document in the email</label>
                 </div>
                </div>

                </form>
            </div>

            <div class="modal-footer">
                <button type="button" id="btnDispprove" onclick="workflow.consult()" class="btn btn-info"><i class="fa fa-paper-plane-o"></i> Send</button>
                <button type="button" class="btn btn-default" onclick="workflow.close_consult();">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->


<script>

 $('[data-toggle="tooltip"]').tooltip();

 $('#consult_with').multiselect( {
  maxHeight: 400,
  includeSelectAllOption: true,
  enableFiltering: true
 });

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
 init_consult:function(){
  var  appno = $('#appno').val();
  $('#subject').val('CONSULTATION ON ABS PERMIT APPLICATION NO '+appno);
  $('#modal_form').modal('hide');
  $('#modal_form_consult').modal('show');
 },
 close_consult:function(){
  $('#modal_form').modal('show');
  $('#modal_form_consult').modal('hide');
 },
 consult:function()
 {
  var id = $('#id').val(),
   appno = $('#appno').val();
  $.SmartMessageBox({
   title : "Confirm",
   content : "Send Consulation On Application No. <font color='green'>"+appno+"</font>?",
   buttons : '[No][Yes]'
  },function(bp) {
  if (bp === "Yes") {
   $('#btnConsult').attr('disabled',true);
   $('#btnApprove').attr('disabled',true);
   $('#btnDispprove').attr('disabled',true);
   $.ajax({
    url : '<?php echo $this->router->class;?>/consult',
    type: "POST",
    data: $('#form-consult').serialize() +'&id='+id+'&appno='+appno,
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
         workflow.close_consult();
         $('#form-consult')[0].reset();
      }else{
        swal({ text: data.message, icon: "error"});
       }
    $('#btnConsult').attr('disabled',false);
    $('#btnApprove').attr('disabled',false);
    $('#btnDispprove').attr('disabled',false);
   },
    error: function (jqXHR, textStatus, errorThrown)
   {
    $('#btnConsult').attr('disabled',false);
    $('#btnApprove').attr('disabled',false);
    $('#btnDispprove').attr('disabled',false);
    swal({ text: 'Error sending', icon: "error"});
   }
  });
  }
 });
 },
 init_approve:function(){
  $('#modal_form').modal('hide');
  $('#modal_form_disapprove').modal('hide');
  $('#modal_form_approve').modal('show');
 },
 approve:function (){
  var appno = $('#appno').val();
  var comments = $('#comments-approve').val();
  if(comments===''){
    swal({ text: 'Enter a Comment', icon: "warning"});
   return;
  }
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
    data: $('#form-data').serialize() + '&comments=' + comments,
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
         $('#modal_form_approve').modal('hide');
         $('#form-data')[0].reset();
         $('#comments-approve').val('');
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
    if(reason===''){
     swal({ text: 'Enter Disapproval Reason', icon: "warning"});
     return;
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
             $('#reason').val('');
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
  var id = $('#id').val();
  var win=window.open('<?php echo $this->router->class;?>/view/'+id,'report','height=800,width=830,toolbar=no,menubar=no,directories=no,location=no,scrollbars=yes,status=no,resizable=no,fullscreen=no,top=0,left=0');
  win.focus();
 },
 view_document:function(docid){
   var id = $('#id').val();
   $('#_iframex').attr('src', '<?php echo $this->router->class;?>/view_document/'+id+'/'+docid);
 },
};


</script>
