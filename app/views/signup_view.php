<?php

echo $this->customcrud->drawDT();

$this->customcrud->genJS(
  $load_datagrid      = true,
  $modal_title_change = false,
  $btn_add_visible    = false,
  $btn_import_visible = false,
  $btn_export_visible = false
  );

?>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Company</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form-data" class="form-horizontal">
                    <input type="hidden" value="" id="id" name="id"/>
                    <div class="form-body">

                        <div class="form-group">
                            <label class="control-label col-md-3">Dependant Name</label>
                            <div class="col-md-9">
                                <input id="fullname"  name="fullname" placeholder="" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>


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
<!-- End Bootstrap modal -->

<script>


</script>

