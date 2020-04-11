<?php

?>
<section id="widget-grid" class="">
<div class="row">
<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

<div class="jarviswidget jarviswidget-sortable"
    data-widget-colorbutton="false"
    data-widget-editbutton="false"
    data-widget-togglebutton="false"
    data-widget-deletebutton="false"
    data-widget-fullscreenbutton="true"
    data-widget-custombutton="false"
    data-widget-collapsed="false"
    data-widget-sortable="false"
    role="widget"
>

 <header role="heading">
    <span class="widget-icon"><i class="fa fa-building-o"></i> </span>
    <h2><strong>Assign</strong>Email Templates  </h2>
    <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span>
 </header>

    <div role="content">

    <div class="widget-body">
     <form action="#" id="form-data" onsubmit="return false;">

      <table class="table  table-borderless  table-responsive   table-condensed responsive nowrap">

         <tr>
          <td nowrap >New Signup Email Verification Template</td>
          <td><?php echo form_dropdown('emtpl_sev', $templates, '','id="emtpl_sev" class="form-control1" ');  ?><span class="help-block"></span></td>
         </tr>


         <tr>
          <td ><b>&nbsp;</b></td>
          <td align="left"><button id="btnSave" onclick="settings.save();" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Update</button></td>
         </tr>

        </table>

     </form>
    </div>

    </div>

   </div>
  </article>
 </div>
</section>

<script>

pageSetUp();

var settings ={
 edit:function (id, triggerFn){
    $('#form-data')[0].reset();
    $('.has-error').removeClass('has-error');
    $('.help-block').empty();
    ui.fpf( '<?php echo $this->router->class;?>/edit/' );
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
       $('#btnSave').attr('disabled',false);
       $('.has-error').removeClass('has-error');
       $('.help-block').empty();

       if(data.status) {
         $.smallBox({
          title : "Success",
          content : data.message,
          color : "#739E73",
          iconSmall : "fa fa-check",
          timeout : 2000
        });
       }else{
        if(typeof data.inputerror!='undefined'){
         for (var i = 0; i < data.inputerror.length; i++){
          $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
          $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
         }
        }
        var message = typeof data.message=='string' ? data.message : 'Fill in All Required Fields';
        $.bigBox({
         title : "Error",
         content : message,
         color : "#C46A69",
         icon : "fa fa-warning shake animated",
         timeout : 3000
        });
       }

    },
    error: function (jqXHR, textStatus, errorThrown)
    {
     alert('Error saving data');
     $('#btnSave').attr('disabled',false);
    }
  });

 },
}

settings.edit();

</script>
