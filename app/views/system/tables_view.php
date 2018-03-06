<?php

?>
<form action="#" id="form-data" class="form-horizontal">
    <div class="form-body">
        <div class="form-group">
            <label class="control-label col-md-2">Connection</label>
            <div class="col-md-9">
                <?php  echo form_dropdown('connection', $connections, $active_database ,'id="connection" class="form-control" '); ?>
                <span class="help-block"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2">XML File</label>
            <div class="col-md-9">
                <?php  echo form_dropdown('xml', $xmls, $active_xml ,'id="xml" class="form-control" '); ?>
                <span class="help-block"></span>
            </div>
        </div>
         <div class="form-group">
            <label class="control-label col-md-2">&nbsp;</label>
            <div class="col-md-9">
               <button type="button" id="btnExecute" onclick="datadict.execute()" class="btn btn-primary"><i class="fa fa-cogs"></i> Execute</button>
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
 execute:function() {
   $('#btnExecute').attr('disabled',true);
   var xml= $('#xml').val();
    $.ajax({
    url : '<?php echo $this->router->class;?>/load_tables',
    type: "POST",
    data: $('#form-data').serialize(),
    success: function(responseText)
    {
       $('#btnExecute').attr('disabled',false);
       $('#dd_response').html( responseText );

       $.smallBox({
        title : "Success",
        content : "Done loading "+ xml,
        color : "#739E73",
        iconSmall : "fa fa-check",
        timeout : 2000
       });

    },
    error: function (jqXHR, textStatus, errorThrown)
    {
     alert('Error Executing xml file');
     $('#btnExecute').attr('disabled',false);
    }
  });
 },
}
</script>


