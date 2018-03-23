<?php

$docid_exists           = false;
$docpassport_exists     = false;
$docid_required           = true;
$docpassport_required   = true;

$docid_class       = '';
$docpassport_class = '';

if(isset($docid['full_path'])){
 if(is_file($docid['full_path'])){
  $docid_exists = true;
  $docid_required = false;
 }
}

if(isset($docpassport['full_path'])){
 if(is_file($docpassport['full_path'])){
  $docpassport_exists = true;
  $docpassport_required = false;
 }
}

if($docid_exists){
  $docid_class =  "<span class='glyphicon glyphicon-ok no-error form-control-feedback'></span>";
}

if($docpassport_exists){
  $docpassport_class =  "<span class='glyphicon glyphicon-ok no-error form-control-feedback'></span>";
}

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
        <meta name="author" content="Vista Solutions">

        <!-- Mobile Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="images/favicon.ico">

         <?php  $this->load->view('main/frontend/header_css'); ?>
    </head>

    <body class="no-trans front-page  page-loader-1 ">

        <div class="scrollToTop circle"><i class="icon-up-open-big"></i></div>

        <div class="page-wrapper">

             <?php  $this->load->view('main/frontend/header', $header_opts= ['show_top_header' => false, 'header_classes' => 'dark' ]); ?>

            <div id="page-start"></div>


            <!-- breadcrumb start -->
            <!-- ================ -->
            <div class="breadcrumb-container">
                <div class="container">
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home pr-10"></i><a href="<?php echo base_url();?>Home.html">Home</a></li>
                        <li class="active">Sign Up</li>
                    </ol>
                </div>
            </div>
            <!-- breadcrumb end -->


            <!-- main-container start -->
            <!-- ================ -->
            <div class="main-container dark-translucent-bg" style="background-image:url('<?php echo base_url();?>assets/frontend/images/banner1.jpg');">
                <div class="container">
                    <div class="row">
                        <!-- main start -->
                        <!-- ================ -->
                        <div class="main object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="100">
                            <div class="form-block center-block p-30 light-gray-bg border-clear">

                                <form action="<?php echo base_url();?>signup/uploads" id="form-uploads" class="smart-form client-form" method="post" >

                                <div class="row">
                                  <div class="col-md-12">
                                    <span class="alert alert-info">Hi <?php echo $firstname; ?>, Please complete your Registration</span>
                                    <hr>
                                  </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group   has-feedback">
                                            <label class="control-label" for="firstname">First Name *</label>
                                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" value="<?php echo $firstname; ?>" readonly >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group   has-feedback">
                                            <label class="control-label" for="lastname">Last Name *</label>
                                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name"  value="<?php echo $lastname; ?>"  readonly >
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
                                            <label class="control-label" for="myid">Attach Your ID</label>
                                            <input type="file" class="form-control" id="myid" name="myid" placeholder="" <?php echo $docid_required; ?> >
                                            <?php echo $docid_class; ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group   has-feedback">
                                            <label class="control-label" for="passport">Attach Passport Photo*</label>
                                            <input type="file" class="form-control" id="passport" name="passport" placeholder="" <?php echo $docpassport_required; ?>>
                                            <?php echo $docpassport_class; ?>
                                        </div>
                                    </div>


                                </div>


                                <div class="row">
                                        <div class="col-sm-12">
                                        <button onclick="save_profile();return false;" class="btn btn-group btn-default btn-animated pull-left">Save <i class="fa fa-save"></i></button>

                                        <button type="submit" class="btn btn-group btn-primary btn-animated pull-right">Next <i class="fa fa-arrow-right"></i></button>
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

            $( document ).ready( function () {
                $("#form-uploads").validate({
                    rules : {
                        <?php if(!$docid_exists){ ?>
                        myid : {
                            required : true,
                        },
                        <?php } ?>
                        <?php if(!$docpassport_exists){ ?>
                        passport : {
                            required : true,
                        },
                        <?php } ?>
                    },
                    messages : {
                        <?php if(!$docid_exists){ ?>
                        myid : {
                            required : 'Please Attach a scanned copy of your Passport/National ID',
                        },
                        <?php } ?>
                        <?php if(!$docpassport_exists){ ?>
                        passport : {
                            required : 'Please Attach a scanned copy of your Passport Photo',
                        },
                        <?php } ?>

                    },
                    errorElement: "em",
                    errorPlacement: function ( error, element ) {
                        error.addClass( "help-block" );
                        element.parents( ".col-sm-5" ).addClass( "has-feedback" );
                        if ( element.prop( "type" ) === "checkbox" ) {
                            error.insertAfter( element.parent( "label" ) );
                        } else {
                            error.insertAfter( element );
                        }
                        if ( !element.next( "span" )[ 0 ] ) {
                            $( "<span class='glyphicon glyphicon-remove has-error form-control-feedback'></span>" ).insertAfter( element );
                        }
                    },
                    success: function ( label, element ) {
                        if ( !$( element ).next( "span" )[ 0 ] ) {
                          $( "<span class='glyphicon glyphicon-ok no-error form-control-feedback'></span>" ).insertAfter( $( element ) );
                        }
                    },
                    highlight: function ( element, errorClass, validClass ) {
                        $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
                        $( element ).next( "span" ).addClass( "glyphicon-remove has-error" ).removeClass( "glyphicon-ok no-error" );
                    },
                    unhighlight: function ( element, errorClass, validClass ) {
                        $( element ).parents( ".col-sm-5" ).addClass( "has-success no-error" ).removeClass( "has-error" );
                        $( element ).next( "span" ).addClass( "glyphicon-ok  no-error" ).removeClass( "glyphicon-remove  has-error" );
                    },
                    submitHandler : function(form) {
                        $(form).ajaxSubmit({
                            dataType: 'json',
                            method: 'POST',
                            success : function(data) {
                               $("#form-uploads").addClass('submited');

                               if(data.success==1){
                                   swal({
                                     text: data.message,
                                     icon: "success",
                                     buttons: false,
                                     timer: 3000,
                                    }).then((state) => {
                                      window.location='<?php  echo  base_url(); ?>home';
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
                    },
                });

            });

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
                     timer: 10000,
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
