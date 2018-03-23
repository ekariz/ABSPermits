<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->

    <head>
        <meta charset="utf-8">
        <title>ABS :: Signup</title>
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
            <div class="main-container dark-translucent-bg" style="background-image:url('<?php echo base_url();?>assets/frontend/images/banner2.jpg');">
                <div class="container">
                    <div class="row">
                        <!-- main start -->
                        <!-- ================ -->
                        <div class="main object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="100">
                            <div class="form-block center-block p-30 light-gray-bg border-clear">
                                <h2 class="title">Sign Up</h2>
                                <span>To be Able to Apply for ABS PERMIT</span>
                                <hr>
                                <form action="<?php echo base_url();?>signup/save" id="form-signup" class="smart-form client-form" method="post" >

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group   has-feedback">
                                            <label class="control-label" for="firstname">First Name *</label>
                                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group   has-feedback">
                                            <label class="control-label" for="lastname">Last Name *</label>
                                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" >
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group   has-feedback">
                                            <label class="control-label" for="gender">Gender *</label>
                                            <?php echo form_dropdown('gender', $genders, '','id="gender" class="form-control" ');  ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group   has-feedback">
                                            <label class="control-label" for="countrycode">Country *</label>
                                            <?php echo form_dropdown('ctncode', $countries, '','id="ctncode" class="form-control" ');  ?>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group   has-feedback">
                                            <label class="control-label" for="email">Email *</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group   has-feedback">
                                            <label class="control-label" for="mobile">Mobile *</label>
                                            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile" >
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
                                            <div class="checkbox">
                                                <label>
                                                <input type="checkbox" name="terms" id="terms">
                                                <i></i>I agree with the <a href="#" data-toggle="modal" data-target="#termsModal"> Terms and Conditions </a></label>
                                                </label>
                                            </div>
                                        </div>
                                </div>

                                <div class="row">
                                        <div class="col-sm-12">
                                            <div class="checkbox">
                                                <label>
                                                    <button type="submit" class="btn btn-group btn-default btn-animated">Sign Up <i class="fa fa-check"></i></button>
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


        <!-- Modal -->
        <div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            &times;
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Terms & Conditions</h4>
                    </div>
                    <div class="modal-body custom-scroll terms-body">

             <div id="left">

            <h1>ABS Terms of Service</h1>

            </ul>

            </div>

            <br><br>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-primary" id="i-agree">
                            <i class="fa fa-check"></i> I Agree
                        </button>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


        <!-- JavaScript files placed at the end of the document so the pages load faster -->
       <?php  $this->load->view('main/frontend/footer'); ?>

        <script type="text/javascript">


            $("#i-agree").click(function(){
                $this=$("#terms");
                if($this.checked) {
                    $('#termsModal').modal('toggle');
                } else {
                    $this.prop('checked', true);
                    $('#termsModal').modal('toggle');
                }
            });

            $( document ).ready( function () {
                $("#form-signup").validate({
                    rules : {
                        firstname : {
                            required : true,
                            minlength : 2,
                            maxlength : 50
                        },
                        lastname : {
                            required : true,
                            minlength : 2,
                            maxlength : 50
                        },
                        mobile : {
                            required : true,
                            minlength : 10,
                            maxlength : 12,
                            digits: true
                        },
                        gender : {
                            required : true
                        },
                        ctncode : {
                            required : true
                        },
                        email : {
                            required : true,
                            email : true
                        },
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
                        terms : {
                            required : true
                        }
                    },

                    messages : {
                        firstname : {
                            required : 'Please enter your first name',
                        },
                        lastname : {
                            required : 'Please enter your last name',
                        },
                        gender : {
                            required : 'Please select your gender',
                        },
                        ctncode : {
                            required : 'Please select your country',
                        },
                        mobile : {
                            required : 'Enter numbers only without a + prefix',
                        },
                        email : {
                            required : 'Please enter your email address',
                            email : 'Please enter a VALID email address'
                        },
                        password : {
                            required : 'Please enter your password'
                        },
                        passwordconfirm : {
                            required : 'Please enter your password one more time',
                            equalTo : 'Please enter the same password as above'
                        },
                        terms : {
                            required : 'You must agree with ABS Terms and Conditions'
                        }
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
                               $("#form-signup").addClass('submited');

                               if(data.success==1){
                                   swal({
                                     text: data.message,
                                     icon: "success",
                                     buttons: false,
                                     closeOnClickOutside: false,
                                    });
                                    /*window.location='<?php  echo  base_url(); ?>/Signup/done.html';*/
                               }else if(data.success==0){
                                  swal({
                                    text: data.message,
                                    icon: "warning",
                                  }).then((state) => {
                                    $("#form-signup").removeClass('submited');
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
