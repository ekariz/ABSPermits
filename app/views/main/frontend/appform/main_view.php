<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->

    <head>
        <meta charset="utf-8">
        <title>ABS :: Harmonized Application Form</title>
        <meta name="description" content="ABS SYSTEM">

        <!-- Mobile Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="images/favicon.ico">

         <?php  $this->load->view('main/frontend/header_css'); ?>
         <link href="<?php  echo base_url();?>assets/css/smart_wizard.min.css" rel="stylesheet" type="text/css" />
         <link href="<?php  echo base_url();?>assets/css/smart_wizard_theme_arrows.min.css" rel="stylesheet" type="text/css" />
         <style>
          div#smartwizard i.fa-check { color:green;}
          div#smartwizard i.fa-hourglass { color:#ccc;}
          div.form-group label  { font-weight:bold;color:#555; }
          a.danger,i.danger  { color:#900; }
         </style>
    </head>

    <body class="no-trans front-page  page-loader-1 ">

        <div class="scrollToTop circle"><i class="icon-up-open-big"></i></div>

        <div class="page-wrapper">

           <?php $this->load->view('main/frontend/header_user', $header_opts= ['show_top_header' => true, 'header_classes' => '' , 'firstname' => $firstname ]); ?>

            <!-- main-container start -->
            <!-- ================ -->
            <div class="container">

                    <form action="ApplicationForm/save" id="form-harmonized" role="form" data-toggle="validator" method="POST" accept-charset="utf-8">
                    <!-- SmartWizard html -->
                    <div id="smartwizard">
                        <ul>
                            <li><a href="#step-1">Step 1<br /><small>Personal</small></a></li>
                            <li><a href="#step-2">Step 2<br /><small>Documents</small></a></li>
                            <li><a href="#step-3">Step 3<br /><small>Resources</small></a></li>
                            <li><a href="#step-4">Step 4<br /><small>Requirements</small></a></li>
                            <li><a href="#step-5">Step 5<br /><small>Project Area</small></a></li>
                            <li><a href="#step-6">Step 6<br /><small>Research & Samples</small></a></li>
                            <li><a href="#step-7">Step 7<br /><small>PIC/MAT Desk</small></a></li>
                            <li><a href="#step-8">Step 8<br /><small>PIC/MAT/MTA</small></a></li>
                            <li><a href="#step-9">Step 9<br /><small>Payment</small></a></li>
                            <li><a href="#step-10">Step 10<br /><small>Finish</small></a></li>
                        </ul>

                        <div>

                            <div id="step-1" class="" style="min-height:500px;" >
                                <div id="form-step-0" role="form" data-toggle="validator">
                                    <br>
                                    <?php $this->load->view('main/frontend/appform/steps/personalinfo_view'); ?>
                                </div>
                            </div>

                            <div id="step-2" style="display:none;min-height:500px;" >
                                <div id="form-step-1" role="form" data-toggle="validator">
                                    <br>
                                    <?php $this->load->view('main/frontend/appform/steps/documents_view'); ?>
                                </div>
                            </div>

                            <div id="step-3" style="display:none;min-height:600px;" >
                                <div id="form-step-2" role="form" data-toggle="validator">
                                    <br>
                                    <?php $this->load->view('main/frontend/appform/steps/resources_view'); ?>
                                </div>
                            </div>

                            <div id="step-4" style="display:none;min-height:600px;" >
                                <div id="form-step-3" role="form" data-toggle="validator">
                                    <br>
                                    <?php $this->load->view('main/frontend/appform/steps/requirements_view'); ?>
                                </div>
                            </div>

                            <div id="step-5" style="display:none;min-height:600px;" >
                                <div id="form-step-4" role="form" data-toggle="validator">
                                    <br>
                                    <?php $this->load->view('main/frontend/appform/steps/gis_location_view'); ?>
                                </div>
                            </div>

                            <div id="step-6" style="display:none;min-height:700px;" >
                                <div id="form-step-5" role="form" data-toggle="validator">
                                    <br>
                                    <?php $this->load->view('main/frontend/appform/steps/samples_view'); ?>
                                </div>
                            </div>

                            <div id="step-7" style="display:none;min-height:500px;" >
                                <div id="form-step-6" role="form" data-toggle="validator">
                                    <br>
                                    <?php $this->load->view('main/frontend/appform/steps/doclinks_view'); ?>
                                </div>
                            </div>

                            <div id="step-8" style="display:none;min-height:500px;" >
                                <div id="form-step-7" role="form" data-toggle="validator">
                                    <br>
                                    <?php $this->load->view('main/frontend/appform/steps/exporting_view'); ?>
                                </div>
                            </div>

                            <div id="step-9" style="display:none;min-height:500px;" >
                                <div id="form-step-8" role="form" data-toggle="validator">
                                   <br>
                                   <div id="div_payments">
                                    <?php $this->load->view('main/frontend/appform/steps/payment_view'); ?>
                                    </div>

                                </div>
                            </div>

                            <div id="step-10" style="display:none;min-height:500px;" >
                                <div id="form-step-9" role="form" data-toggle="validator">
                                   <br>
                                   <div id="div_confirmation">
                                    <?php $this->load->view('main/frontend/appform/steps/finish_view'); ?>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                  </form>

                </div>

            <!-- main-container end -->

            <!-- ================ -->

            <footer id="footer" class="clearfix ">

                <!-- .subfooter start -->
                <!-- ================ -->
                <div class="subfooter default-bg">
                    <div class="container">
                        <div class="subfooter-inner">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-center"><span class="  pr-10">Copyright © 2017 -  <?php echo date('Y');?>  ABS. All Rights Reserved</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- .subfooter end -->

            </footer>
            <!-- footer end -->

        </div>
        <!-- page-wrapper end -->


    <?php  $this->load->view('main/frontend/footer'); ?>
    <script type="text/javascript" src="<?php  echo base_url();?>assets/js/validator.min.js"></script>
    <script type="text/javascript" src="<?php  echo base_url();?>assets/js/jquery.smartWizard.min.js"></script>
    <script type="text/javascript" src="<?php  echo base_url();?>assets/js/updater.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBu1DE67C8ozg-9DguEvuzN1dZmZ7BPk4I&libraries=places&callback=initAutocomplete"   async defer></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/frontend/js/abs_map_locator.js"></script>
    <script type="text/javascript">

        function test_rid(){
         var orchid = $('#orchid').val();
         var researcherid = $('#researcherid').val();

         if(orchid!=""){
          $('#researcherid').removeAttr( "required" );
         }else if(researcherid!=""){
          $('#orchid').removeAttr( "required" );
         }else{
          $('#researcherid').attr('required', 'required');
          $('#orchid').attr('required', 'required');
         }

        }

         $(document).ready(function(){

            $('[data-toggle="tooltip"]').tooltip();

            var btnFinish = $('<button></button>').text('Finish')
                                             .addClass('btn btn-info btn-finish')
                                             .on('click', function(){
                                                    if( !$(this).hasClass('disabled')){
                                                        var elmForm = $("#form-harmonized");
                                                        if(elmForm){
                                                            elmForm.validator('validate');
                                                            var elmErr = elmForm.find('.has-error');
                                                            console.log(elmErr);
                                                            elmErr.each(function(index,elm){
                                                                console.log('index='+index);
                                                                console.log(elm);
                                                                elm_type = $(elm).attr('type');
                                                            });
                                                            if(elmErr && elmErr.length > 0){
                                                                swal({ text: "Oops We Still Have Error In This Application Form", icon: "error"});
                                                                return false;
                                                            }else{
                                                                 /*$(elmForm).ajaxSubmit();*/
                                                                 /*elmForm.submit();*/
                                                                submit_application();
                                                                return false;
                                                            }
                                                        }
                                                    }
                                                });
            var btnCancel = $('<button></button>').text('Reset')
                                             .addClass('btn btn-warning')
                                             .on('click', function(){
                                                    $('#smartwizard').smartWizard("reset");
                                                    $('#form-harmonized').find("input, textarea").val("");
                                                });

            $('#smartwizard').smartWizard({
                    selected: <?php echo !is_null($stepnumber)? $stepnumber : 0;?>,
                    theme: 'arrows',
                    transitionEffect:'fade',
                    autoAdjustHeight:true,
                    showStepURLhash:true,
                    toolbarSettings: {toolbarPosition: 'bottom',
                                      toolbarExtraButtons: [btnFinish, btnCancel]
                                    },
                    anchorSettings: {
                                markDoneStep: true,
                                markAllPreviousStepsAsDone: true,
                                removeDoneStepOnNavigateBack: false,
                                enableAnchorOnDoneStep: true
                            },
                    lang:   {
                            next: 'Save & Continue',
                            previous: 'Back'
                          },
                 });

            $("#smartwizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
                console.log('stepNumber='+stepNumber);
                var elmForm = $("#form-step-" + stepNumber);
                if(stepDirection === 'forward' && elmForm){
                    elmForm.validator('validate');
                    var elmErr = elmForm.children('.has-error');
                    if(elmErr && elmErr.length > 0){
                        return false;
                    }
                }

               if(stepDirection === 'forward'){
                 switch(stepNumber){
                 case 1:
                  /*upload_files();*/
                 break;
                 case 2:
                  handle_is_export();
                  break;
                 case 7:
                  show_payment();
                  break;
                 }
               }

               /*
               auto-save steps fields
               */
               var autosave_fields=[],autosave_fields_str='',elm_type,elm_val,elms = elmForm.find('.form-control'),elms_checkbox = elmForm.find('.form-control-checkbox');

               if(elms.length>0) {

                elms.each(function(index,elm){
                elm_type = $(elm).attr('type');
                 switch(elm_type){
                 case 'checkbox':
                  if($(elm).prop('checked')){
                  elm_val  = $(elm).val();
                  autosave_fields.push(elm.id+'='+elm_val);
                  }
                 break;
                 default:
                  elm_val  = $(elm).val();
                  autosave_fields.push(elm.id+'='+elm_val);
                 }
                });

                if(elms_checkbox.length>0) {
                  elms_checkbox.each(function(index,elm){
                  elm_type = $(elm).attr('type');
                  switch(elm_type){
                  case 'checkbox':
                   if($(elm).prop('checked')){
                   elm_val  = $(elm).val();
                   autosave_fields.push(elm.id+'='+elm_val);
                  }
                  break;
                  default:
                   elm_val  = $(elm).val();
                   autosave_fields.push(elm.id+'='+elm_val);
                  }
                 });
                }

                var stepNumber_Now=0;
                if(stepDirection === 'forward' && stepNumber<=8){
                 stepNumber_Now = stepNumber+1;
                }else if(stepDirection === 'forward' && stepNumber>=1){
                 stepNumber_Now = stepNumber-1;
                }else{
                 stepNumber_Now = stepNumber;
                }

                autosave_fields.push('stepnumber='+stepNumber_Now);
                autosave_fields_str = autosave_fields.join('&');
                ui.bc("<?php  echo base_url();?>ApplicationForm/autosave",autosave_fields_str);

               }
                return true;
            });

            <?php if($stepnumber<8){?>
             $('button.btn-finish').prop('disabled', true);
            <?php }?>


            $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {
                if(stepNumber == 9){
                 $('button.btn-finish').prop('disabled', false);
                 $('.btn-finish').removeClass('disabled');
                 show_confirmation();
                }else{
                 $('button.btn-finish').attr("disabled", "disabled");
                 $('button.btn-finish').prop('disabled', true);
                 $('.btn-finish').addClass('disabled');
                }
            });


        });

        function handle_is_export(){
          var geneticresourcerc = $('#geneticresourcerc').val();
          if(geneticresourcerc==1){
           $('#table_row_mta').show();
           $('#table_row_import_permit').show();
          }else if(geneticresourcerc==2){
           $('#table_row_mta').hide();
           $('#table_row_import_permit').hide();

           if(confirm("You are about to be redirected to https://oris.nacosti.go.ke ")){
             top.location = 'https://oris.nacosti.go.ke';
           }

           return false;
          }else{
           $('#table_row_mta').hide();
           $('#table_row_import_permit').hide();
          }
        }

        function handle_export_docs(){
          var geneticresourcerc = $('#geneticresourcerc').val();
          var exportanswer      = $('#exportanswer').val();
          if(geneticresourcerc==1 && exportanswer!=1){
           $('#table_row_exporter_pic').show();
           $('#table_row_exporter_mat').show();
           $('#table_row_exporter_mta').hide();
           $('.td-mta').hide();
           $('.resources_deposit').show();
           $('#resourcesdeposit').prop('required', 'required');
          }else if(geneticresourcerc==1 && exportanswer==1){
           $('#table_row_exporter_pic').show();
           $('#table_row_exporter_mat').show();
           $('#table_row_exporter_mta').show();
           $('.td-mta').show();
           $('.resources_deposit').hide();
           $('#resourcesdeposit').val('');
           $('#resourcesdeposit').removeProp('required');
          }else{
           $('#table_row_exporter_pic').show();
           $('#table_row_exporter_mat').show();
           $('#table_row_exporter_mta').hide();
           $('.td-mta').hide();
           $('.resources_deposit').hide();
           $('#resourcesdeposit').val('');
           $('#resourcesdeposit').removeProp('required');
          }
        }

        function show_other_resource_type(){
           var resourcetype = $('#resourcetype').val();
            if(resourcetype=='other'){
              $('#div_resourcetypeother').show();
            }else{
              $('#div_resourcetypeother').hide();
            }
        }

        function show_payment(){
           ui.fc('ApplicationForm/payments','div_payments');
        }

        function show_confirmation(id){
           ui.fc('ApplicationForm/confirmation','div_confirmation');
        }

        function view_file(id){
           top.location = '<?php  echo base_url();?>ApplicationForm/ViewFile/'+id;
        }

        function delete_file(type,id,desc){
           if(confirm("Remove "+desc+"?")){
            ui.fc('ApplicationForm/remove/'+type+'/'+id,'div_confirmation');
           }
        }

        function  upload_files( ){
            var data = new FormData($('#form-harmonized')[0]);
            $.ajax({
            url: './ApplicationForm/upload',
            type: 'POST',
            data: data,
            cache: false,
            async: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(data, textStatus, jqXHR){
             if(data.success==1){
              if(typeof data.message ==='string'){
               /*swal({ text: data.message, icon: "success"});*/
              }
              if(typeof data.documents == 'object'){
                $.each(data.documents, function(index,documentid) {
                   var elm = "status-"+documentid;
                   if($("#"+elm)){
                      $("#"+elm).html('<i class="fa fa-check"></i>');
                   }
                });
              }
              show_confirmation();

             }else if(data.success==0){
              if(typeof data.message ==='string'){
               swal({ text: data.message, icon: "error"});
              }
             }
            },
            error: function(jqXHR, textStatus, errorThrown){
              swal({ text: textStatus, icon: "warning"});
            }
          });
       }

        function submit_application(){
        $('#form-harmonized').ajaxSubmit({
            dataType: 'json',
            method: 'POST',
            success : function(data) {
               $("#form-harmonized").addClass('submited');
               if(data.success==1){
                   swal({
                     text: data.message,
                     icon: "success",
                     buttons: false,
                     timer: 3000,
                    }).then((state) => {
                      top.location = "<?php  echo base_url();?>ApplicationsList";
                   });

               }else if(data.success==0){
                  swal({
                    text: data.message,
                    icon: "warning",
                  }).then((state) => {
                    $("#form-harmonized").removeClass('submited');
                  });
               }


            }
        });
       }


     var payments ={
      init:function(id,stepno){
       ui.call('<?php  echo base_url();?>Payments/payment','id='+id+'&stepno='+stepno ,'div_payments');
      },
      init_mpesa_stkpush:function(id,stepno){
       var mobile = $('#mobile').val();
       $('button#btnPay').prop('disabled', true);
       $.post('<?php  echo base_url();?>Payments/init_mpesa_stkpush', 'id='+id+'&stepno='+stepno+'&mobile='+mobile, function(data) {
        if (data.success === 1) {
         swal({
         text: "Enter MPESA PIN When Prompted On "+mobile+" ",
         icon: "info",
         buttons: false,
         timer: 3000,
        }).then((state) => {
         payment_poll(id,stepno);
        });

        }else{
          $('button#btnPay').prop('disabled', false);
          if(typeof data.message=='string' ){
           swal({ text: data.message, icon: "error"});
          }
        }
       }, "json");
      },
      paid:function(){
       show_payment();
      },
     }

     function  payment_poll(id,stepno){
        $.updater({
           url: '<?php  echo base_url();?>Payments/check_payment',
           data: { id:id, stepno:stepno },
           method: 'post',
           response: 'json',
           interval: 10000
         },
         function(data, response){
          if(data.success==1){
           $.updater.stop();
           swal({
             text: data.message,
             icon: "success",
             buttons: false,
             timer: 3000,
            }).then((state) => {
              payments.paid(data);
           });
          }else if(data.success==2){//waiting
           $.updater.stop();
           swal({ text: data.message, icon: "info"});
           $('button#btnPay').prop('disabled', false);
           //location.hash = 'step-5';
          }else if(data.success==3){//user cancelled
           $.updater.stop();
           swal({ text: data.message, icon: "error"});
           $('button#btnPay').prop('disabled', false);
           payments.paid();
          }else{
           swal({ text: data.message, icon: "info"});//continue polling
          }
         });
        }

    </script>


    </body>
</html>
