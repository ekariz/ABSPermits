<!DOCTYPE html>
<html lang="en-us" >
    <head>
        <meta charset="utf-8">
        <title>ABS BAHAMAS &reg;</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">


        <!-- Basic Styles -->
        <link rel="stylesheet" type="text/css" media="screen" href="<?php  echo base_url();?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php  echo base_url();?>assets/css/font-awesome.min.css">

        
        <link rel="stylesheet" type="text/css" media="screen" href="<?php  echo base_url();?>assets/css/smartadmin-production-plugins.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php  echo base_url();?>assets/css/smartadmin-production.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php  echo base_url();?>assets/css/smartadmin-skins.min.css">

        <link rel="stylesheet" type="text/css" media="screen" href="<?php  echo base_url();?>assets/css/custom.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php  echo base_url();?>assets/css/login.css">

        <!-- FAVICONS -->
        <link rel="shortcut icon" href="<?php  echo base_url();?>assets/img/favicon/favicon.ico?v=2" type="image/x-icon">
        <link rel="icon" href="<?php  echo base_url();?>assets/img/favicon/favicon.ico?v=1" type="image/x-icon">
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


        </style>

    </head>

    <body  >
 
 <div class="site-wrapper">
  <div class="site-wrapper-inner">
    <div class="cover-container">
      <div class="masthead clearfix">
        <div class="inner">
 
           <span id="logo"> <img src="<?php  echo base_url();?>assets/frontend/images/logo-abs.png" alt="ABS BAHAMAS"> </span>
 
        </div>
      </div>

      <div class="inner cover">
           <form action="#" id="login-form" class="smart-form client-form" method="POST" >
                                <header>
                                    <strong>Sign In</strong>
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

                                </fieldset>
                                <footer>
                                    <button type="submit" class="btn btn-primary float-right ">
                                       <i class="fa fa-check"></i> Sign in
                                    </button>
                                    
                                </footer>
                            </form>

      </div>

      <div class="mastfoot">
        <div class="inner">
          <!-- Validation -->

          <p><a href="https://examplE.com"  target="_blank">ABS</a></p>

          <p>&copy; <?php echo date('Y'); ?>  <a href="http://best.gov.bs/">BEST </a></p>
        </div>
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
        if (location.protocol !== "https:") {
       //  location.protocol = 'https:';
        }
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
