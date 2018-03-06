<?php

?>
<!DOCTYPE html>
<html lang="en-us" id="extr-page" >
    <head>
        <meta charset="utf-8">
        <title>Cloud High &reg;</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>assets/css/font-awesome.min.css">

        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>assets/css/smartadmin-production-plugins.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>assets/css/smartadmin-production.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>assets/css/smartadmin-skins.min.css">

        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>assets/css/demo.min.css">

        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>assets/css/custom.css">

        <!-- FAVICONS -->
        <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/favicon/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo base_url();?>assets/img/favicon/favicon.ico" type="image/x-icon">

        <!-- GOOGLE FONT -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

        <link rel="apple-touch-icon" href="<?php echo base_url();?>assets/img/splash/sptouch-icon-iphone.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url();?>assets/img/splash/touch-icon-ipad.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url();?>assets/img/splash/touch-icon-iphone-retina.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url();?>assets/img/splash/touch-icon-ipad-retina.png">

        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">

        <link rel="apple-touch-startup-image" href="<?php echo base_url();?>assets/img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
        <link rel="apple-touch-startup-image" href="<?php echo base_url();?>assets/img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
        <link rel="apple-touch-startup-image" href="<?php echo base_url();?>assets/img/splash/iphone.png" media="screen and (max-device-width: 320px)">
        <style>
             label.error{ color:#f00 }
        </style>

    </head>

    <body id="login">

        <header id="header">
            <!--<span id="logo"></span>-->

            <div id="logo-group">
                <span id="logo"> <img src="img/logo.png" alt="Cloud High"> </span>

                <!-- END AJAX-DROPDOWN -->
            </div>

            <span id="extr-page-header-space"> <span class="hidden-mobile hiddex-xs">Already registered?</span> <a href="login.html" class="btn btn-danger">Sign In</a> </span>

        </header>

        <div id="main" role="main">

            <!-- MAIN CONTENT -->
            <div id="content" class="container">

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 hidden-xs hidden-sm">
                        <h1 class="txt-color-red login-header-big">Cloud High Systems</h1>
                        <div class="hero">

                            <div class="pull-left login-desc-box-l">
                                <h4 class="paragraph-header">Cloud High is a web based HR, Payroll, Invoicing management software solution designed for small, medium as well as large enterprises.</h4>
                                <div class="login-app-icons">
                                    <a href="javascript:void(0);" class="btn btn-danger btn-sm">View Products</a>
                                    <a href="javascript:void(0);" class="btn btn-default btn-sm">Find out more</a>
                                </div>
                            </div>

                            <img src="./assets/img/front.png" class="pull-right display-image" alt="" style="width:210px"   >

                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <h5 class="about-heading">Are you Experiencing it?</h5>
                                <p>
                                   Citrus is very easy, flexible and user-friendly Web based System. Registration is free and you get a trial account for 90 days.
                                </p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <h5 class="about-heading">Not just your average system!</h5>
                                <p>
                                  Unlike traditional payroll management system, we are a modern new generation web platform focused on user experience and simplifying complex payroll processing.
                                </p>
                            </div>
                        </div>

                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                        <div class="well no-padding">

                            <form action="<?php echo base_url();?>Register/save" id="form-register" class="smart-form client-form" method="post" >
                                <header>
                                    Registration is FREE*
                                </header>

                                <fieldset>

                                    <section>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" id="fullname"  name="fullname" placeholder="Full Name">
                                            <b class="tooltip tooltip-bottom-right">Your Name</b> </label>
                                    </section>

                                    <section>
                                        <label class="input"> <i class="icon-append fa fa-mobile"></i>
                                            <input type="text" id="mobile"  name="mobile" placeholder="Mobile Phone">
                                            <b class="tooltip tooltip-bottom-right">Your Mobile Phone Number</b> </label>
                                    </section>

                                    <section>
                                        <label class="input"> <i class="icon-append fa fa-envelope"></i>
                                            <input type="email" id="email"  name="email" placeholder="Email address">
                                            <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                    </section>

                                    <section>
                                        <label class="input"> <i class="icon-append fa fa-lock"></i>
                                            <input type="password" id="password"  name="password" placeholder="Password"  >
                                            <b class="tooltip tooltip-bottom-right">Don't forget your password</b> </label>
                                    </section>

                                    <section>
                                        <label class="input"> <i class="icon-append fa fa-lock"></i>
                                            <input type="password" id="passwordconfirm"  name="passwordconfirm" placeholder="Confirm password">
                                            <b class="tooltip tooltip-bottom-right">Don't forget your password</b> </label>
                                    </section>
                                </fieldset>

                                <fieldset>

                                    <section>
                                        <label class="checkbox">
                                            <input type="checkbox" name="terms" id="terms">
                                            <i></i>I agree with the <a href="#" data-toggle="modal" data-target="#termsModal"> Terms and Conditions </a></label>
                                    </section>
                                </fieldset>
                                <footer>
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </footer>

                                <div class="message">
                                    <i class="fa fa-check"></i>
                                    <p>
                                        Thank you for your registration!
                                    </p>
                                </div>
                            </form>

                        </div>
                        <p class="note text-center">*FREE Trial will end after 90 days</p>

                    </div>
                </div>
            </div>

        </div>

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

            <h1>Virtual Global Limited Terms of Service</h1>

            <ul>

            <b>1. Terms</b>
             <p>By accessing the website at http://cloud-high.com, you are agreeing to be bound by these terms of service, all applicable laws and regulations, and agree that you are responsible for compliance with any applicable local laws. If you do not agree with any of these terms, you are prohibited from using or accessing this site. The materials contained in this website are protected by applicable copyright and trademark law.</p>
            <b>2. Use License</b>
            <p>Permission is granted to temporarily download one copy of the materials (information or software) on Virtual Global Limited's website for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:
            modify or copy the materials;
            use the materials for any commercial purpose, or for any public display (commercial or non-commercial);
            attempt to decompile or reverse engineer any software contained on Virtual Global Limited's website;
            remove any copyright or other proprietary notations from the materials; or
            transfer the materials to another person or "mirror" the materials on any other server.
            This license shall automatically terminate if you violate any of these restrictions and may be terminated by Virtual Global Limited at any time. Upon terminating your viewing of these materials or upon the termination of this license, you must destroy any downloaded materials in your possession whether in electronic or printed format.
            </p>
            <b>3. Disclaimer</b>
            <p>The materials on Virtual Global Limited's website are provided on an 'as is' basis. Virtual Global Limited makes no warranties, expressed or implied, and hereby disclaims and negates all other warranties including, without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights.
            Further, Virtual Global Limited does not warrant or make any representations concerning the accuracy, likely results, or reliability of the use of the materials on its website or otherwise relating to such materials or on any sites linked to this site.
            </p>
            <b>4. Limitations</b>
            <p>In no event shall Virtual Global Limited or its suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption) arising out of the use or inability to use the materials on Virtual Global Limited's website, even if Virtual Global Limited or a Virtual Global Limited authorized representative has been notified orally or in writing of the possibility of such damage. Because some jurisdictions do not allow limitations on implied warranties, or limitations of liability for consequential or incidental damages, these limitations may not apply to you.</p>
            <b>5. Accuracy of materials</b>
            <p>The materials appearing on Virtual Global Limited website could include technical, typographical, or photographic errors. Virtual Global Limited does not warrant that any of the materials on its website are accurate, complete or current. Virtual Global Limited may make changes to the materials contained on its website at any time without notice. However Virtual Global Limited does not make any commitment to update the materials.</p>
            <b>6. Links</b>
            <p>Virtual Global Limited has not reviewed all of the sites linked to its website and is not responsible for the contents of any such linked site. The inclusion of any link does not imply endorsement by Virtual Global Limited of the site. Use of any such linked website is at the user's own risk.</p>
            <b>7. Modifications</b>
            <p>Virtual Global Limited may revise these terms of service for its website at any time without notice. By using this website you are agreeing to be bound by the then current version of these terms of service.</p>
            <b>8. Governing Law</b>
            <p>These terms and conditions are governed by and construed in accordance with the laws of Republic of Mauritius and you irrevocably submit to the exclusive jurisdiction of the courts in that State or location</p>

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

        <!--================================================== -->

        <!--[if IE 8]>
         <h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
        <![endif]-->
        <script src="<?php echo base_url();?>assets/js/libs/jquery-2.1.1.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/libs/jquery-ui-1.10.3.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/app.config.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/custom.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/bootstrap/bootstrap.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/notification/SmartNotification.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/plugin/jquery-validate/jquery.validate.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/plugin/masked-input/jquery.maskedinput.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/plugin/msie-fix/jquery.mb.browser.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/plugin/fastclick/fastclick.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/app.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/ui.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/loadingoverlay.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/loadingoverlay_progress.min.js"  type="text/javascript" ></script>

        <script type="text/javascript">

        $(document).ready(function() {

             runAllForms();

             $(document).ajaxSend(function(event, request, settings) {
                $.LoadingOverlay("show");
             });

             $(document).ajaxStop(function(event, request, settings) {
                $.LoadingOverlay("hide");
             });

             $(document).ajaxComplete(function(event, request, settings) {
                $.LoadingOverlay("hide");
             });

            });


            $("#i-agree").click(function(){
                $this=$("#terms");
                if($this.checked) {
                    $('#termsModal').modal('toggle');
                } else {
                    $this.prop('checked', true);
                    $('#termsModal').modal('toggle');
                }
            });

            $(function() {
                $("#form-register").validate({
                    rules : {
                        fullname : {
                            required : true,
                            minlength : 5,
                            maxlength : 50
                        },
                        mobile : {
                            required : true,
                            minlength : 10,
                            maxlength : 12,
                            digits: true
                        },
                        email : {
                            required : true,
                            email : true
                        },
                        password : {
                            required : true,
                            minlength : 5,
                            maxlength : 20
                        },
                        passwordconfirm : {
                            required : true,
                            minlength : 5,
                            maxlength : 20,
                            equalTo : '#password'
                        },
                        terms : {
                            required : true
                        }
                    },

                    messages : {
                        fullname : {
                            required : 'Please enter your names',
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
                            required : 'You must agree with Terms and Conditions'
                        }
                    },
                    submitHandler : function(form) {
                        $(form).ajaxSubmit({
                            success : function() {
                                $("#form-register").addClass('submited');
                            }
                        });
                    },
                    errorPlacement : function(error, element) {
                        error.insertAfter(element.parent());
                    }
                });

            });
        </script>

    </body>
</html>
