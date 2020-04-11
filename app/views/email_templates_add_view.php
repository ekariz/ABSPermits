<?php
$editor_placeholders =  [];
 if(isset($tempvars) && sizeof($tempvars)>0){
  foreach($tempvars as $var=>$vardesc)
  {
	$editor_placeholders[] = "'{$var}'";
	//echo "el.add('{$vardesc}','{$var}');\r\n";
  }
}
?>
<style>
.main {
 background-color:white;
}
</style>

  <div class="main" >
	  
	<form action="#" id="data-form" class="form-horizontal" method="POST" action="<?php echo $this->router->class;?>/save"  >
   <input type="hidden"  id="tmplref" name="tmplref" value="<?php echo $tmplref;?>" />
   
	 <div class="form-body">
 
          <div class="form-group">
           <label class="col-sm-1 control-label" for="title">Name</label>
            <div class="col-sm-11">
             <input type="text" id="templatename" name="templatename"   class="form-control" >
            </div>
          </div>

          <div class="form-group">
           <label class="col-sm-1 control-label" for="sectcode">Template </label>
            <div class="col-sm-11">
             <textarea type="text" id="template" name="template"   class="form-control" cols="80" rows="10" ></textarea>
            </div>
          </div>
          
          </div>
        </form>
 
  
    <div class="row">
	 <div class="col-sm-1"  >
		 &nbsp;
	 </div>
	 <div class="col-sm-11">
     <button type="button" id="btnSave" onclick="crud.save()" class="btn btn-success"><i class="fa fa-check"></i> Save</button>&nbsp; | &nbsp;
     <button type="button" id="btnCancel" onclick="crud.cancel()" class="btn btn-default">Close</button>
    </div>
    </div>
    
</div>
<script>

var crud ={
 cancel:function(){
  if(confirm("Are you sure you want to cancel and loose all changes?")){
   location.hash = '#EmailTemplates.html';
  }
 },
 save:function() {
    $('#btnSave').text('Please wait...');
    $('#btnSave').attr('disabled',true);
    $('#btnCancel').attr('disabled',true);
    var template =  CKEDITOR.instances.template.getData();
    $.ajax({
        url : '<?php echo $this->router->class;?>/save',
        type: "POST",
        data: $('#data-form').serialize()+"&template="+ encodeURIComponent(template),
        dataType: "JSON",
        success: function(data)
        {
           if(data.success==1) {
               $('#id').val(data.id);
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
}

$(document).ready(function() {


var editor = CKEDITOR.replace( 'template' , {
   height: '300px',
   startupFocus : true,
   uiColor: '#9AB8F3',
    extraPlugins: 'placeholder_select',
    placeholder_select : {
    placeholders: [<?php echo implode(',', $editor_placeholders); ?>],
   },
});


jQuery("body").on('CKE.placeholder.onload', function(e, el){
<?php
 if(isset($tempvars) && sizeof($tempvars)>0){
  foreach($tempvars as $var=>$vardesc)
  {
	echo "el.add('{$vardesc}','{$var}');\r\n";
  }
}
?>
});
 
pageSetUp();

});

</script>

