<?php

?>
<form action="#" id="form-data" class="form-horizontal">
    <div class="form-body">

        <div class="form-group">
            <label class="control-label col-md-2">Source DB</label>
            <div class="col-md-9">
                <?php  echo form_dropdown('connection_source', $connections, '' ,'id="connection_source" class="form-control" onchange="datadict.list_tables_source()" '); ?>
                <span class="help-block"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2">Source Table</label>
            <div class="col-md-9" id="div_table_source">
               <?php  echo form_dropdown('table_source', $blank_array, '' ,'id="table_source"  class="form-control"  '); ?>
             </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2">Destination DB</label>
            <div class="col-md-9">
                <?php  echo form_dropdown('connection_destination', $connections, '' ,'id="connection_destination" class="form-control"  onchange="datadict.list_tables_destination()"  '); ?>
                <span class="help-block"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2">Destination Table</label>
             <div class="col-md-9" id="div_table_destination">
               <?php  echo form_dropdown('table_destination', $blank_array, '' ,'id="table_destination" class="form-control" '); ?>
             </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2">Copy Mode</label>
             <div class="col-md-9" id="div_table_destination">
               <?php  echo form_dropdown('copymode', $copymodes, '' ,'id="copymode" class="form-control" '); ?>
             </div>
            </div>
        </div>

         <div class="form-group">
            <label class="control-label col-md-2">&nbsp;</label>
            <div class="col-md-9">
               <button type="button" id="btnCopy" onclick="datadict.copy()" class="btn btn-primary"><i class="fa fa-cogs"></i> Copy Data</button>
            </div>
        </div>

        <div class="form-group">
          <div class="col col-md-2" >&nbsp;</div>
          <div class="col col-md-10"  id="dd_response" >&nbsp;</div>
        </div>

      </div>
     </form>

<script>


var datadict={
 list_tables_source:function() {
    var conn = $('#connection_source').val();
    ui.ps('<?php echo $this->router->class;?>/list_tables/','conn='+conn,'table_source');
 },
 list_tables_destination:function() {
    var conn = $('#connection_destination').val();
    var table_source = $('#table_source').val();
    ui.ps('<?php echo $this->router->class;?>/list_tables/','conn='+conn ,'table_destination', table_source);
 },
 copy:function() {
   $('#btnCopy').attr('disabled',true);
    $.ajax({
    url : '<?php echo $this->router->class;?>/copy',
    type: "POST",
    data: $('#form-data').serialize(),
    success: function(responseText)
    {
       $('#btnCopy').attr('disabled',false);
       $('#dd_response').html( responseText );

       $.smallBox({
        title : "Success",
        content : "Done loading Views",
        color : "#739E73",
        iconSmall : "fa fa-check",
        timeout : 2000
       });

    },
    error: function (jqXHR, textStatus, errorThrown)
    {
     alert('Error Executing Views');
     $('#btnCopy').attr('disabled',false);
    }
  });
 },
}
</script>


