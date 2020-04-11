<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->

    <head>
        <meta charset="utf-8">
        <title>ABS :: My Profile</title>
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

           <?php  $this->load->view('main/frontend/header_user', $header_opts= ['show_top_header' => true, 'header_classes' => '' , 'firstname' => $firstname ]); ?>

            <div id="page-start"></div>


            <!-- breadcrumb start -->
            <!-- ================ -->
            <div class="breadcrumb-container">
                <div class="container">
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home pr-10"></i><a href="<?php echo base_url();?>Home.html">Home</a></li>
                        <li class="active"> My Profile</li>
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
                                <h2>My Profile</h2>

                                <form action="<?php echo base_url();?>Profile/save" id="form-profile" class="smart-form client-form" method="post" >

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
                                            <label class="control-label" for="password">Password *</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="" >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group   has-feedback">
                                            <label class="control-label" for="passwordconfirm">Confirm Password *</label>
                                            <input type="password" class="form-control" id="passwordconfirm" name="passwordconfirm" placeholder="" >
                                        </div>
                                    </div>


                                </div>

                                <div class="row">
                                        <div class="col-sm-12">
                                            <div class="">
                                                <label>
                                                    <button type="submit" class="btn btn-group btn-primary btn-animated"><i class="fa fa-check"></i> Update</button>
                                                </label>
                                            </div>
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
                $("#form-profile").validate({
                    rules : {
                        password : {
                            required : true,
                            minlength : 5,
                            maxlength : 50
                        },
                        passwordconfirm : {
                            required : true,
                            minlength : 5,
                            maxlength : 50,
                            equalTo : '#password'
                        },
                    },
                    messages : {
                        password : {
                            required : 'Please enter your password'
                        },
                        passwordconfirm : {
                            required : 'Please enter your password one more time',
                            equalTo : 'Please enter the same password as above'
                        },
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
                               $("#form-profile").addClass('submited');

                               if(data.success==1){
                                   swal({
                                     text: data.message,
                                     icon: "success",
                                     buttons: false,
                                     timer: 5000,
                                    });
                               }else if(data.success==0){
                                  swal({
                                    text: data.message,
                                    icon: "warning",
                                  }).then((state) => {
                                    $("#form-profile").removeClass('submited');
                                  });
                               }


                            }
                        });
                    },
                });

            });
        </script>

    </body>
</html>
