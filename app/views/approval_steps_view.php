<?php

if (!$grid_html = $this->cache->get($this->router->class)){
$grid_html = $this->customcrud->drawDT();
$this->cache->save($this->router->class, $grid_html, 1);
}
echo $grid_html;

$this->customcrud->genJS();


?>
<style>
.modal-dialog-profile{
    position: relative;
    display: table;
    overflow-y: auto;
    overflow-x: auto;
    width: auto;
    min-width: 700px;
}
</style>
<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog modal-dialog-profile">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Approval Steps</h3>
            </div>

            <div class="modal-body form">

                <form action="#" id="form-data" class="form-horizontal">
                 <input type="hidden" value="" id="id" name="id"/>

                 <ul id="hosTab" class="nav nav-tabs tabs-pull-left bordered">

                  <li class="active">
                    <a href="#tabGen" data-toggle="tab">General</a>
                  </li>

                  <li class="">
                    <a href="#tabNtfApplicant" data-toggle="tab">Applicant Template</a>
                  </li>

                  <li class="">
                    <a href="#tabNtfApprover" data-toggle="tab">Approver Template</a>
                  </li>


                 </ul>

                 <div id="hosTabContent" class="tab-content padding-10">

                 <div class="tab-pane active" id="tabGen">

                    <div class="form-body">

                        <div class="form-group">
                            <label class="control-label col-md-3">Step no <i class="fa fa-pencil "></i> </label>
                            <div class="col-md-9">
                                <input id="stepno"  name="stepno"   class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3">Step Name <i class="fa fa-pencil "></i> </label>
                            <div class="col-md-9">
                                <input id="stepname"  name="stepname"   class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Description <i class="fa fa-pencil "></i> </label>
                            <div class="col-md-9">
                                <input id="stepdesc"  name="stepdesc"   class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Approved by <i class="fa fa-building "></i> </label>
                            <div class="col-md-9">
                                <?php echo form_dropdown('instcode', $institutions, '','id="instcode" class="form-control" ');  ?>
                                <span class="help-block"></span>
                            </div>
                        </div>



                    </div>

                 </div>


                 <div class="tab-pane " id="tabNtfApplicant">

                    <div class="form-body">

                       <div class="form-group">
                         <label class="control-label col-md-3"> Approved  <i class="fa fa-check"></i> </label>
                         <div class="col-md-9">
                            <?php echo form_dropdown('emtplaplapr', $templates, '','id="emtplaplapr" class="form-control" ');  ?>
                            <span class="help-block"></span>
                         </div>
                        </div>

                        <div class="form-group">
                         <label class="control-label col-md-3"> Dis-approved  <i class="fa fa-check"></i> </label>
                         <div class="col-md-9">
                            <?php echo form_dropdown('emtplapldsp', $templates, '','id="emtplapldsp" class="form-control" ');  ?>
                            <span class="help-block"></span>
                         </div>
                        </div>

                    </div>

                 </div>


                 <div class="tab-pane " id="tabNtfApprover">

                    <div class="form-body">

                       <div class="form-group">
                         <label class="control-label col-md-3"> Approved  <i class="fa fa-check"></i> </label>
                         <div class="col-md-9">
                            <?php echo form_dropdown('emtplinsapr', $templates, '','id="emtplinsapr" class="form-control" ');  ?>
                            <span class="help-block"></span>
                         </div>
                        </div>

                        <div class="form-group">
                         <label class="control-label col-md-3"> Dis-approved  <i class="fa fa-check"></i> </label>
                         <div class="col-md-9">
                            <?php echo form_dropdown('emtplinsdsp', $templates, '','id="emtplinsdsp" class="form-control" ');  ?>
                            <span class="help-block"></span>
                         </div>
                        </div>

                    </div>

                 </div>


                </form>
            </div>

            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="crud_custom.save()" class="btn btn-primary"><i class="fa fa-check"></i> Update</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<script>


var crud_custom ={
 save:function() {
    $('#btnSave').text('Please wait...');
    $('#btnSave').attr('disabled',true);
    $('#btnCancel').attr('disabled',true);
    $.ajax({
        url : '<?php echo $this->router->class;?>/save',
        type: "POST",
        data: $('#form-data').serialize(),
        dataType: "JSON",
        success: function(data)
        {
           if(data.status) {
               $('#id').val(data.id);
               crud.reload_table();
               swal({
                 text: data.message,
                 icon: "success",
                 buttons: false,
                 timer: 2000,
                });
           }else{
            var msg = (typeof data.message=='string') ? data.message : 'Something went wrong.Try again';
            swal({
            text: msg,
            icon: "error",
            });
           }
         $('#btnSave').html('Save');
         $('#btnSave').attr('disabled',false);
         $('#btnCancel').attr('disabled',false);

        },
       error: function (jqXHR, textStatus, errorThrown)
       {
        alert('Error saving data');
        $('#btnSave').html('Save');
        $('#btnSave').attr('disabled',false);
       }
    });
 },
ac_country:function()
{
 var options = {
  url: function(phrase) {
    return "<?php echo $this->router->class;?>/search_country";
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
    data.phrase = $("#ctnname").val();
    return data;
  },
  requestDelay: 400,
  list: {
        match: {
          enabled: true
        },
        onClickEvent: function() {
         var id = $("#ctnname").getSelectedItemData().id;
         var name = $("#ctnname").getSelectedItemData().name;
         $('#ctncode').val(id);
         crud_custom.get_investigator_email(id);
        },
        maxNumberOfElements: 10
      },
   template: {
     type: "custom",
     method: function(value, item) {
       return value;
    }
   },
  theme: "round"
 };
 $("#ctnname").easyAutocomplete(options);
 },
}

$(document).ready(function() {
pageSetUp();
crud_custom.ac_country();

$("#dob").datepicker({
    autoclose: true,
    dateFormat: 'yy-mm-dd',
    changeMonth: true,
    changeYear: true,
    todayHighlight: true,
    todayBtn: true,
    prevText: '<i class="fa fa-chevron-left"></i>',
    nextText: '<i class="fa fa-chevron-right"></i>',
});

$("#idpassdi").datepicker({
    autoclose: true,
    dateFormat: 'yy-mm-dd',
    changeMonth: true,
    changeYear: true,
    todayHighlight: true,
    todayBtn: true,
    prevText: '<i class="fa fa-chevron-left"></i>',
    nextText: '<i class="fa fa-chevron-right"></i>',
});

});


</script>
