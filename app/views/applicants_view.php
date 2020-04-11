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
                <h3 class="modal-title">Applicant</h3>
            </div>

            <div class="modal-body form">

                <form action="#" id="form-data" class="form-horizontal">
                 <input type="hidden" value="" id="id" name="id"/>
                 <input type="hidden" value="" id="ctncode" name="ctncode"/>

                 <ul id="hosTab" class="nav nav-tabs tabs-pull-left bordered">

                  <li class="active">
                    <a href="#tabGen" data-toggle="tab">General</a>
                  </li>

                  <li class="">
                    <a href="#tabInfo" data-toggle="tab">Info</a>
                  </li>


                  <li class="">
                    <a href="#tabContactsP" data-toggle="tab">Contacts</a>
                  </li>

                  <li class="">
                    <a href="#tabContactsS" data-toggle="tab">Local Contacts</a>
                  </li>

                  <li class="">
                    <a href="#tabContactsE" data-toggle="tab">Employer</a>
                  </li>

                  <li class="">
                    <a href="#tabPhoto" data-toggle="tab">Photo</a>
                  </li>

                 </ul>

                 <div id="hosTabContent" class="tab-content padding-10">

                 <div class="tab-pane active" id="tabGen">

                    <div class="form-body">

                        <div class="form-group">
                            <label class="control-label col-md-3" ><span id="link_id">ID/Passport No  <i class="fa fa-credit-card "></i>  </span></label>
                            <div class="col-md-3">
                                <input id="idpassno"  name="idpassno"   class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                            <label class="control-label col-md-2">Country <i class="fa fa-globe"></i> </label>
                            <div class="col-md-4">
                                <input id="ctnname"  name="ctnname"   class="form-control" type="text"   >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                              <label class="control-label col-md-3">First Name <i class="fa fa-user"></i> </label>
                            <div class="col-md-3">
                                <input id="firstname"  name="firstname"   class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                            <label class="control-label col-md-2">Title <i class="fa fa-user"></i> </label>
                            <div class="col-md-4">
                                <input id="title"  name="title"   class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3" for="midname" >Middle Name <i class="fa fa-user"></i> </label>
                            <div class="col-md-3">
                                <input id="midname"  name="midname"   class="form-control" type="text"  >
                            </div>
                              <label class="control-label col-md-2" for="dob" >Birth Date <i class="fa fa-calendar"></i> </label>
                            <div class="col-md-4">
                                <input id="dob"  name="dob"   class="form-control" type="text"  >
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3" for="lastname" >Last Name <i class="fa fa-user"></i> </label>
                            <div class="col-md-3">
                                <input id="lastname"  name="lastname"   class="form-control" type="text"   >
                            </div>
                            <label class="control-label col-md-2" for="gender" >Gender <i class="fa fa-female"></i> </label>
                            <div class="col-md-4">
                                <input id="gender"  name="gender"   class="form-control" type="text"   >
                            </div>
                        </div>

                    </div>

                 </div>


                 <div class="tab-pane " id="tabInfo">

                    <div class="form-body">


                          <div class="form-group">
                            <label class="control-label col-md-4" for="institutionname" >Institution Name <i class="fa fa-university"></i> </label>
                            <div class="col-md-8">
                                <input id="institutionname"  name="institutionname"   class="form-control" type="text"  >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4" for="specarea" >Area of Specialization <i class="fa fa-book"></i> </label>
                            <div class="col-md-8">
                                <input id="specarea"  name="specarea"   class="form-control" type="text"  >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4" for="idpassip" >Passport Issue Place <i class="fa fa-map-marker "></i> </label>
                            <div class="col-md-8">
                                <input id="idpassip"  name="idpassip"   class="form-control" type="text"  >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4" for="idpassdi" >Passport Issue Date <i class="fa fa-calendar"></i> </label>
                            <div class="col-md-8">
                                <input id="idpassdi"  name="idpassdi"   class="form-control" type="text"  >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4" for="idpassdi" >Orcid ID <i class="fa fa-calendar"></i> </label>
                            <div class="col-md-8">
                                <input id="orcid"  name="orcid"   class="form-control" type="text" readonly  >
                            </div>
                        </div>


                    </div>

                 </div>


                 <div class="tab-pane " id="tabContactsP">

                   <div class="form-body">

                        <div class="form-group">
                            <label class="control-label col-md-3">Postal Code <i class="fa fa-envelope"></i> </label>
                            <div class="col-md-9">
                                <input id="prmpcode"  name="prmpcode"   class="form-control " type="text"  >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Address <i class="fa fa-envelope"></i> </label>
                            <div class="col-md-9">
                                <input id="prmaddress"  name="prmaddress"   class="form-control " type="text"  >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="prmphone" >Phone <i class="fa fa-phone"></i> </label>
                            <div class="col-md-9">
                                <input id="prmphone"  name="prmphone"   class="form-control entries"  type="text"  >
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3" for="email" >Email <i class="fa fa-envelope"></i> </label>
                            <div class="col-md-9">
                                <input id="email"  name="email"   class="form-control entries" type="text"  >
                            </div>

                        </div>

                        <div class="form-group">
                             <label class="control-label col-md-3" for="prmresidence" >Town <i class="fa fa-building"></i> </label>
                            <div class="col-md-9">
                                <input id="prmtown"  name="prmtown"   class="form-control entries"  type="text"  >
                            </div>
                        </div>

                        <div class="form-group">
                             <label class="control-label col-md-3" for="prmresidence" >Residence <i class="fa fa-home"></i> </label>
                            <div class="col-md-9">
                                <input id="prmresidence"  name="prmresidence"   class="form-control entries" type="text"  >
                            </div>
                        </div>

                    </div>

                 </div>


                 <div class="tab-pane " id="tabContactsS">

                    <div class="form-body">

                        <div class="form-group">
                            <label class="control-label col-md-3">Postal Code <i class="fa fa-envelope"></i></label>
                            <div class="col-md-9">
                                <input id="secpcode"  name="secpcode"   class="form-control " type="text"  >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Address <i class="fa fa-envelope"></i></label>
                            <div class="col-md-9">
                                <input id="secaddress"  name="secaddress"   class="form-control " type="text"  >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="prmphone" >Phone <i class="fa fa-phone"></i></label>
                            <div class="col-md-9">
                                <input id="secphone"  name="secphone"   class="form-control entries"  >
                            </div>
                        </div>

                        <div class="form-group">
                             <label class="control-label col-md-3" for="prmresidence" >Town <i class="fa fa-building"></i></label>
                            <div class="col-md-9">
                                <input id="sectown"  name="sectown"   class="form-control entries" >
                            </div>
                        </div>

                        <div class="form-group">
                             <label class="control-label col-md-3" for="prmresidence" >Residence <i class="fa fa-home"></i></label>
                            <div class="col-md-9">
                                <input id="secresidence"  name="secresidence"   class="form-control entries" >
                            </div>
                        </div>

                    </div>

                 </div>


                 <div class="tab-pane " id="tabContactsE">

                  <div class="form-body">

                        <div class="form-group">
                            <label class="control-label col-md-3">Postal Code <i class="fa fa-envelope"></i> </label>
                            <div class="col-md-9">
                                <input id="emppcode"  name="emppcode"   class="form-control " type="text"  >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Address <i class="fa fa-envelope"></i> </label>
                            <div class="col-md-9">
                                <input id="empaddress"  name="empaddress"   class="form-control " type="text"  >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="emphone" >Phone <i class="fa fa-phone"></i> </label>
                            <div class="col-md-9">
                                <input id="emphone"  name="emphone"   class="form-control entries" >
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="emptown" >Town <i class="fa fa-building"></i> </label>
                            <div class="col-md-9">
                                <input id="emptown"  name="emptown"   class="form-control entries"  >
                            </div>
                        </div>

                        <div class="form-group">
                             <label class="control-label col-md-3" for="empctncode" >Country <i class="fa fa-globe"></i> </label>
                            <div class="col-md-9">
                                <input id="empctncode"  name="empctncode"   class="form-control entries" >
                            </div>
                        </div>


                    </div>

                 </div>



                 <div class="tab-pane " id="tabPhoto">

                  <div class="form-body">

                        <div class="form-group">
                            <div class="col-md-12" id="div_image">
                                <img src="<?php echo base_url(); ?>assets/img/blank.jpeg" id="userimg">
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
