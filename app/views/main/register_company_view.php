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
        <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/favicon/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo base_url();?>assets/img/favicon/favicon.ico" type="image/x-icon">
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
                <span id="logo"> <img src="<?php echo base_url();?>img/logo-blue.png" alt="Cloud High"> </span>

                <!-- END AJAX-DROPDOWN -->
            </div>

<!--
            <span id="extr-page-header-space"> <span class="hidden-mobile hiddex-xs">Already registered?</span> <a href="login.html" class="btn btn-danger">Sign In</a> </span>
-->

        </header>

        <div id="main" role="main">

            <!-- MAIN CONTENT -->
            <div id="content" class="container">

                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="well no-padding">

                           <form action="#" id="form-register" class="smart-form client-form">

                                <header>
                                    Company Details
                                </header>

                                <fieldset>

                                    <section>
                                        <label class="input"> <i class="icon-append fa fa-building"></i>
                                            <input type="text" id="companyname"  name="companyname" placeholder="Company Name"></label>
                                    </section>

                                     <section>
                                        <label class="input"> <i class="icon-append fa fa-envelope"></i>
                                            <input type="email" id="email"  name="email" placeholder="Company Email">
                                            <b class="tooltip tooltip-bottom-right">Company Email Address</b> </label>
                                    </section>


                                    <section>
                                        <label class="input"> <i class="icon-append fa fa-phone"></i>
                                            <input type="text" id="telephone"  name="telephone" placeholder="Telephone"  ></label>
                                    </section>

                                    <section>
                                        <label class="input"> <i class="icon-append fa fa-envelope"></i>
                                            <input type="text" id="address"  name="address" placeholder="Postal Address"></label>
                                    </section>

                                    <div class="row">
                                        <section class="col col-6">
                                            <label class="input"> <i class="icon-append fa fa-globe"></i>
                                                <input type="text" id="location" name="location" placeholder="physical location">
                                            </label>
                                        </section>
                                        <section class="col col-6">
                                            <label class="input"><i class="icon-append fa fa-user"></i>
                                                <input type="text" id="contact" name="contact" placeholder="contact person">
                                            </label>
                                        </section>
                                    </div>

                                </fieldset>

                                <fieldset>

                                  <section>

                                    <label>
                                     <i></i>
                                     <span class="text-muted">Create a unique sub-domain for accessing the web application. eg http://example.citrus.mu </span>
                                    </label>

                                   <div class="input-group">
                                        <span class="input-group-addon">https://</span>
                                        <input class="form-control subdomain" id="subdomain" name="subdomain" placeholder="businessname" type="text" >
                                        <span class="input-group-addon" id="ext_domain">.citrus.mu</span>
                                    </div>

                                    </section>

                                </fieldset>
                                <footer>
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </footer>

                            </form>

                        </div>
                        <p class="note text-center">*FREE Trial will end after 90 days</p>

                    </div>
                </div>
            </div>

        </div>

         <!--[if IE 8]>
         <h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
        <![endif]-->
        <script src="<?php echo base_url();?>assets/js/libs/jquery-2.1.1.min.js"  type="text/javascript" ></script>
<!--
        <script src="<?php echo base_url();?>assets/js/libs/jquery-ui-1.10.3.min.js"  type="text/javascript" ></script>
-->
        <script src="<?php echo base_url();?>assets/js/app.config.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/custom.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/bootstrap/bootstrap.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/notification/SmartNotification.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/plugin/jquery-validate/jquery.validate.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/plugin/jquery-form/jquery-form.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/plugin/masked-input/jquery.maskedinput.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/plugin/msie-fix/jquery.mb.browser.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/app.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/loadingoverlay.min.js"  type="text/javascript" ></script>

        <script type="text/javascript" >

         $("#companyname").keyup(function(){
            $this=$("#companyname");
            subdomain =$this.val();
            subdomain = subdomain.replace(/\s/g, '');
            subdomain = jQuery.trim(subdomain).substring(0, 10).trim(this);
            $('#subdomain').val( subdomain );
            $('#ext_domain').val( '.citrus.mu' );
         });

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

        $(function () {

            $("#form-register").validate({

            rules : {
                email : {
                    required : true,
                    email : true
                },
                companyname : {
                    required : true,
                    minlength : 5,
                    maxlength : 50
                },
                telephone : {
                    required : true,
                    minlength : 10,
                    maxlength : 15
                },
                address : {
                    required : true,
                    minlength : 5,
                    maxlength : 50
                },
                contact : {
                    required : true
                },
                location : {
                    required : true
                },
                subdomain : {
                    required : true,
                    minlength : 5,
                    maxlength : 20
                }
            },
            messages : {
                companyname : {
                    required : 'Please enter Company Name',
                },
                telephone : {
                    required : 'Please enter Company telephone'
                },
                address : {
                    required : 'Please enter Company Postal address',
                },
                contact : {
                    required : 'Please enter Company Contact Person',
                },
                location : {
                    required : 'Please enter Physical Location',
                },
                subdomain : {
                    required : 'Please enter subdomain for creating your unique web address',
                },
            },
            submitHandler: function (ev) {
              $(ev).ajaxSubmit({
                type: 'POST',
                url: '<?php echo base_url();?>register/save_company',
                data: {
                        'new': 1,
                    },
                dataType: 'json',
                success: function (data) {
                    if (data.success == 1) {

                     $.bigBox({
                            title : "Company Registration",
                            content : data.message,
                            color : "#739E73",
                            timeout: 10000,
                            icon : "fa fa-check",
                            number : "1"
                     });
                     $.LoadingOverlay("show");
                     window.location='<?php echo base_url();?>register/finish';

                    } else if (data.success == 0) {

                        $.bigBox({
                            title : "Error",
                            content : data.message,
                            color : "#C46A69",
                            timeout: 6000,
                            icon : "fa fa-warning shake animated",
                            number : "1"
                        });

                    }
                }
              });
            },
            errorPlacement : function(error, element) {
                error.insertAfter(element.parent());
            },
            invalidHandler: function () {
                $.bigBox({
                 title : "Error",
                 content : "Fill in all fields",
                 color : "#C46A69",
                 icon : "fa fa-warning shake animated",
                 timeout : 3000
                });
            }
        });

       });
   </script>

    </body>
</html>
