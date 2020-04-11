<?php

$required_docphoto   = isset($docpassport['file_name']) ? '' : 'required';
$required_docidpass  = isset($docidpass['file_name']) ? '' : 'required';
?>
<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->

    <head>
        <meta charset="utf-8">
        <title>ABS :: Registration</title>
        <meta name="description" content="ABS SYSTEM">

        <!-- Mobile Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="images/favicon.ico">

         <?php  $this->load->view('main/frontend/header_css'); ?>
    </head>

    <body class="no-trans front-page  page-loader-1 ">

        <div class="scrollToTop circle"><i class="icon-up-open-big"></i></div>

        <div class="page-wrapper">

             <?php  // $this->load->view('main/frontend/header', $header_opts= ['show_top_header' => false, 'header_classes' => 'dark' ]); ?>

            <div id="page-start"></div>



            <!-- main-container start -->
            <!-- ================ -->
            <div class="main-container dark-translucent-bg" style="background-image:url('<?php echo base_url();?>assets/frontend/images/banner1.jpg');">
                <div class="container">
                    <div class="row">
                        <!-- main start -->
                        <!-- ================ -->
                        <div class="main object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="100">
                            <div class="form-block center-block p-30 light-gray-bg border-clear">

                                <form action="<?php echo base_url();?>signup/upload" id="form-uploads" class="smart-form client-form" method="POST"  accept-charset="utf-8" >

                                <div class="row">
                                  <div class="col-md-12">
                                    <strong>Hi <?php echo $firstname; ?>, Please complete your Registration</strong>
                                    <hr>
                                  </div>
                                </div>

                                <div class="row">

                                     <div class="col-md-6">
                                        <div class="form-group   has-feedback">
                                            <label class="control-label" for="titlecode">Title *</label>
                                            <?php echo form_dropdown('titlecode', $titles, $title,'id="titlecode" class="form-control readonly" ');  ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group   has-feedback">
                                            <label class="control-label" for="lastname">First Name *</label>
                                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name"  value="<?php echo $firstname; ?>" readonly >
                                        </div>
                                    </div>

                                </div>

                                 <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group   has-feedback">
                                            <label class="control-label" for="midname">Middle Name *</label>
                                            <input type="text" class="form-control" id="midname" name="midname" placeholder="Middle Name"  value="<?php echo $midname; ?>" readonly  >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group   has-feedback">
                                            <label class="control-label" for="lastname">Last Name *</label>
                                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name"   value="<?php echo $lastname; ?>" readonly >
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group   has-feedback">
                                            <label class="control-label" for="gender">Gender *</label>
                                            <?php echo form_dropdown('gender', $genders, $gender,'id="gender" class="form-control" readonly ');  ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group   has-feedback">
                                            <label class="control-label" for="countrycode">Country *</label>
                                            <?php echo form_dropdown('ctncode', $countries, $ctncode,'id="ctncode" class="form-control" readonly ');  ?>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group   has-feedback">
                                            <label class="control-label" for="email">Email *</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email"  value="<?php echo $email; ?>"  readonly >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group   has-feedback">
                                            <label class="control-label" for="mobile">Mobile *</label>
                                            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile"  value="<?php echo $mobile; ?>"  readonly >
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group   has-feedback">
                                            <label class="control-label" for="myid">Attach Your ID/Passport</label>
                                            <?php
                                             echo make_file_upload_field( 'docid', $docidpass, 'ID/Passport', $required_docidpass);
                                            ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group   has-feedback">
                                            <label class="control-label" for="passport">Attach Passport Photo*</label>
                                            <?php
                                             echo make_file_upload_field( 'docpassport', $docpassport, 'Passport Photo', $required_docphoto);
                                            ?>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                        <div class="col-sm-12">

                                        <hr>
                                        <button onclick="save_profile();return false;" class="btn btn-group btn-primary btn-animated pull-right">Next <i class="fa fa-arrow-right"></i></button>

                                        </div>
                                </div>

                              </form>
                            </div>
                        </div>
                        <!-- main end -->
                    </div>
                </div>
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

        <!-- JavaScript files placed at the end of the document so the pages load faster -->
       <?php  $this->load->view('main/frontend/footer'); ?>

        <script type="text/javascript">

        function  upload_files( ){
            var data = new FormData($('#form-uploads')[0]);
            $.ajax({
            url: '<?php  echo  base_url(); ?>Signup/upload',
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
               swal({ text: data.message, icon: "success"});
              }

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

        function save_profile(){
         $('#form-uploads').ajaxSubmit({
            dataType: 'json',
            method: 'POST',
            url: '<?php  echo  base_url(); ?>Signup/saveProfile',
            success : function(data) {
               $("#form-uploads").addClass('submited');
               if(data.success==1){
                   swal({
                     text: data.message,
                     icon: "success",
                     buttons: false,
                     timer: 3000,
                    }).then((state) => {
                     top.location = '<?php echo  base_url(); ?>ApplicationForm';
                    });
               }else if(data.success==0){
                  swal({
                    text: data.message,
                    icon: "warning",
                  }).then((state) => {
                    $("#form-login").removeClass('submited');
                  });
               }
            }
         });
        }
   </script>
 </body>
</html>
