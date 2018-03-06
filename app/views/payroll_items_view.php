<?php

echo $this->customcrud->drawDT();

$this->customcrud->genJS(
  $load_datagrid      = true,
  $modal_title_change = false,
  $btn_add_visible    = true,
  $btn_import_visible = false,
  $btn_export_visible = false,
  $btn_add_text       = 'New Item'
  );

?>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Unit</h3>
            </div>
            <div class="modal-body form">
                <form class="smart-form" novalidate="novalidate" id="form-data" onsubmit="return false;">
                    <input type="hidden" value="" id="id" name="id"/>

                   <ul id="propTab" class="nav nav-tabs tabs-pull-left bordered">

                    <li class="active">
                        <a href="#tabGen" data-toggle="tab">General</a>
                    </li>

                    <li class="">
                        <a href="#tabPayslip" data-toggle="tab">Payslip</a>
                    </li>

                    </ul>

                    <div id="propTabContent" class="tab-content padding-10">

                    <div class="tab-pane active" id="tabGen">
                    <fieldset>
                    <div class="form-body">

                        <div class="form-group">
                            <label class="control-label col-md-3">Item Code</label>
                            <div class="col-md-9">
                                <input id="itmcode"  name="itmcode" placeholder="" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Item Name</label>
                            <div class="col-md-9"  >
                                <input id="itmname"  name="itmname" placeholder="" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Short Name</label>
                            <div class="col-md-9"  >
                                <input id="shortname"  name="shortname" placeholder="" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Item Type:</label>
                            <div class="col-md-9">
                                <?php  echo form_dropdown('itypecode', $itemtypes, '','id="itypecode" class="form-control" onchange="show_select_balance();" '); ?>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Value Min Value</label>
                            <div class="col-md-9">
                                <input type="number" id="minval"  name="minval"  class="form-control" type="number" >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Value Max Value</label>
                            <div class="col-md-9">
                                <input type="number" id="maxval"  name="maxval"   class="form-control" type="number" >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group" id="div_depo" style="display:none" >
                            <label class="control-label col-md-3 txt-color-red">Deposit Cumm Item</label>
                            <div class="col-md-9">
                                <?php  echo form_dropdown('itmcum', $items_balance_depo, '','id="itmcum" class="form-control" '); ?>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group" id="div_loan" style="display:none" >
                            <label class="control-label col-md-3 txt-color-red">Loan Balance Item</label>
                            <div class="col-md-9">
                                <?php  echo form_dropdown('itmbal', $items_balance_loan, '','id="itmbal" class="form-control" '); ?>
                                <span class="help-block"></span>
                            </div>
                        </div>

                     </div>
                     </fieldset>
                    </div>

                    <div class="tab-pane" id="tabPayslip">

                    <fieldset>
                    <div class="form-body">

                         <div class="form-group">
                            <label class="control-label col-md-3">Recurrs Monthly</label>
                            <div class="col-md-9">
                                <input id="recurr"  name="recurr" value="1" class="form-control" type="checkbox" >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Show in Profile</label>
                            <div class="col-md-9">
                                <input id="sftshow"  name="sftshow" value="1" class="form-control" type="checkbox" >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Year To Date</label>
                            <div class="col-md-9">
                                <input id="ytdshow"  name="ytdshow" value="1" class="form-control" type="checkbox" >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Show On Payslip</label>
                            <div class="col-md-9">
                                <input id="psshow"  name="psshow" value="1" class="form-control" type="checkbox">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-7">Payslip Position</label>
                            <div class="col-md-5">
                                <input id="posdisp"  name="posdisp" class="form-control" type="number" >
                                <span class="help-block"></span>
                            </div>
                        </div>

                     </div>
                     </fieldset>

                    </div>

                    </div><!-- /.propTabContent -->

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="crud.save()" class="btn btn-primary"><i class="fa fa-check"></i> Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
<script>

function show_select_balance(){
 var itypecode= $('#itypecode').val();
 $('#div_depo').hide();
 $('#div_loan').hide();
 if(itypecode=='DEPO'){
  $('#div_depo').show();
 }
 if(itypecode=='LOANREP'){
  $('#div_loan').show();
 }
}

</script>
