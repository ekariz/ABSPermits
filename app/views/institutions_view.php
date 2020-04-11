<?php

if (!$grid_html = $this->cache->get($this->router->class)){
$grid_html = $this->customcrud->drawDT();
$this->cache->save($this->router->class, $grid_html, 1);
}
echo $grid_html;

$this->customcrud->genJS();
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
                <h3 class="modal-title">Manage Institution</h3>
            </div>

            <div class="modal-body form">

                <form action="<?php echo $this->router->class;?>/save" id="form-data" class="smart-form client-form" method="post" >
                 <input type="hidden" value="" id="id" name="id"/>

                    <table class="table  table-striped table-bordered table-responsive  table-condensed nowrap">

                     <tr>
                      <td nowrap width="20%"><strong>Institution Code</strong></td>
                      <td><input id="instcode" name="instcode" placeholder="Category Code" class="form-control" type="text" ></td>
                     </tr>

                     <tr>
                      <td nowrap width="20%"><strong>Institution Name</strong></td>
                      <td><input id="instname" name="instname" placeholder="Category Name" class="form-control" type="text" ></td>
                     </tr>

                     <tr>
                      <td nowrap width="20%"><strong>Licence Charges</strong></td>
                      <td><input id="charges" name="charges" placeholder="Charges" class="form-control" type="number" ></td>
                     </tr>

                     <tr>
                      <td nowrap ><strong>Institution Logo</strong></td>
                      <td><input type="file" class="form-control" id="photo" name="photo"  required ></td>
                     </tr>

                     <tr>
                      <td nowrap >&nbsp;</td>
                      <td>
                        <div id="div_image">
                         <img src="<?php echo base_url(); ?>assets/img/blank.jpeg">
                        </div>
                      </td>
                     </tr>

                    </table>

                </form>
            </div>

            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="crud.save()" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->


<script>

crud.save =function() {
    $('#btnSave').text('Please wait...');
    $('#btnSave').attr('disabled',true);
    $('#btnCancel').attr('disabled',true);
    $('#form-data').ajaxSubmit({
        dataType: 'json',
        method: 'POST',
        url: '<?php echo $this->router->class;?>/save',
        success : function(data) {
            $('#btnSave').html('Save');
            $('#btnSave').attr('disabled',false);
            $('#btnCancel').attr('disabled',false);
           if(data.success==1){
               $('#modal_form').modal('hide');
               crud.reset();
               swal({
                 text: data.message,
                 icon: "success",
                 buttons: false,
                 timer: 2000,
                });
           }else if(data.success==0){
              swal({
                text: data.message,
                icon: "warning",
              }).then((state) => {
              });
           }
        }
    });
};




</script>
