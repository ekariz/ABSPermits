<!DOCTYPE html>
<html lang="en-us" id="extr-page" manifest="manifest.appcache">

    <head>
        <meta charset="utf-8">
        <title>ABS &reg;</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">


        <!-- Basic Styles -->
        <link rel="stylesheet" type="text/css" media="screen" href="<?php  echo base_url();?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php  echo base_url();?>assets/css/font-awesome.min.css">

        <link rel="stylesheet" type="text/css" media="screen" href="<?php  echo base_url();?>assets/css/smartadmin-production-plugins.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php  echo base_url();?>assets/css/smartadmin-production.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php  echo base_url();?>assets/css/smartadmin-skins.min.css">

        <link rel="stylesheet" type="text/css" media="screen" href="<?php  echo base_url();?>assets/css/demo.min.css">

        <link rel="stylesheet" type="text/css" media="screen" href="<?php  echo base_url();?>assets/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php  echo base_url();?>assets/css/dataTables.responsive.bootstrap.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php  echo base_url();?>assets/css/easy-autocomplete.min.css">

        <link rel="stylesheet" type="text/css" media="screen" href="<?php  echo base_url();?>assets/css/custom.css">

        <!-- FAVICONS -->
        <link rel="shortcut icon" href="<?php  echo base_url();?>assets/img/favicon/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php  echo base_url();?>assets/img/favicon/favicon.ico" type="image/x-icon">

        <!-- GOOGLE FONT -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

        <link rel="apple-touch-icon" href="<?php  echo base_url();?>assets/img/splash/sptouch-icon-iphone.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php  echo base_url();?>assets/img/splash/touch-icon-ipad.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php  echo base_url();?>assets/img/splash/touch-icon-iphone-retina.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php  echo base_url();?>assets/img/splash/touch-icon-ipad-retina.png">

        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">

        <link rel="apple-touch-startup-image" href="<?php  echo base_url();?>assets/img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
        <link rel="apple-touch-startup-image" href="<?php  echo base_url();?>assets/img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
        <link rel="apple-touch-startup-image" href="<?php  echo base_url();?>assets/img/splash/iphone.png" media="screen and (max-device-width: 320px)">
        <style>
             label.error{ color:#f00 }
        </style>

    </head>

    <body class="animated fadeInDown">

        <header id="header">

            <div id="logo-group">
                <span id="logo"> <img src="./assets/img/logo-white.png" alt="Login"> </span>
            </div>

<!--
            <span id="extr-page-header-space"> <span class="hidden-mobile">Need an account?</span> <a href="register.html" class="btn btn-danger">Create account</a> </span>
-->

        </header>

        <div id="main" role="main">

            <!-- MAIN CONTENT -->
            <div id="content" class="container">

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm">
                        <h1 class="txt-color-red login-header-big">ABS</h1>
                        <div class="hero">

                            <div class="pull-left login-desc-box-l">
                                <h4 class="paragraph-header">The ABS Online permit application system was developed by the Kenyan government to expedite permit application process for researchers at the same time improving the efficiency and transparency of the entire permit application process. </h4>
                                <div class="login-app-icons">
                                    <a href="javascript:void(0);" class="btn btn-default btn-sm">Find out more</a>
                                </div>
                            </div>

                            <img src="./assets/img/front.png" class="pull-right display-image" alt="" style="width:210px"   >

                        </div>


                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
                        <div class="well no-padding">
                            <form action="#" id="login-form" class="smart-form client-form" method="POST" >
                                <header>
                                    Sign In
                                </header>

                                <fieldset>

                                    <section>
                                        <label class="label">E-mail</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="email" name="email">
                                            <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter email address/username</b></label>
                                    </section>

                                    <section>
                                        <label class="label">Password</label>
                                        <label class="input"> <i class="icon-append fa fa-lock"></i>
                                            <input type="password" name="password">
                                            <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b> </label>
                                        <div class="note">
                                            <a href="ForgotPassword.html">Forgot password?</a>
                                        </div>
                                    </section>

<!--
                                    <section>
                                        <label class="checkbox">
                                            <input type="checkbox" name="remember" checked="">
                                            <i></i>Stay signed in</label>
                                    </section>

-->
                                </fieldset>
                                <footer>
                                    <button type="submit" class="btn btn-primary">
                                        Sign in
                                    </button>
                                </footer>
                            </form>

                        </div>

                </div>
            </div>

        </div>

        <!--================================================== -->

        <script src="<?php echo base_url();?>assets/js/plugin/pace/pace.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/libs/jquery-2.1.1.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/libs/jquery-ui-1.10.3.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/bootstrap/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/plugin/jquery-validate/jquery.validate.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/plugin/jquery-form/jquery-form.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/notification/SmartNotification.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/app.config.js"></script>
        <script src="<?php echo base_url();?>assets/js/app.min.js"></script>

        <script type="text/javascript">
        runAllForms();

        $(function () {
             $("#login-form").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 3,
                        maxlength: 20
                    }
                },
                messages: {
                    email: {
                        required: 'Please enter your email address',
                        email: 'Please enter a VALID email address'
                    },
                    password: {
                        required: 'Please enter your password'
                    }
                },
                submitHandler: function (ev) {
                  $(ev).ajaxSubmit({
                    type: 'POST',
                    url: '<?php echo base_url();?>LoginBackend/auth',
                    data: {
                        'userid': $('#userid').val(),
                        'password': $('#password').val()
                    },
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                        if (data.success == 0) {
                            $.bigBox({
                             title : "Login Error",
                             content : data.message,
                             color : "#C46A69",
                             icon : "fa fa-warning shake animated",
                             timeout : 3000
                            });
                        } else if (data.success == 1) {
                            window.location='<?php  echo  base_url(); ?>';
                        }
                    }
                  });
                },

                errorPlacement: function (error, element) {
                    //error.insertAfter(element.parent());
                },

                invalidHandler: function () {
                    $.bigBox({
                     title : "Login Error",
                     content : "Enter User ID and Password",
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
