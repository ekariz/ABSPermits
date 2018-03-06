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


        <!-- Basic Styles -->
        <link rel="stylesheet" type="text/css" media="screen" href="<?php  echo base_url();?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php  echo base_url();?>assets/css/font-awesome.min.css">

        <link rel="stylesheet" type="text/css" media="screen" href="<?php  echo base_url();?>assets/css/smartadmin-production-plugins.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php  echo base_url();?>assets/css/smartadmin-production.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php  echo base_url();?>assets/css/smartadmin-skins.min.css">

        <link rel="stylesheet" type="text/css" media="screen" href="<?php  echo base_url();?>assets/css/demo.min.css">

        <link rel="shortcut icon" href="<?php  echo base_url();?>assets/img/favicon/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php  echo base_url();?>assets/img/favicon/favicon.ico" type="image/x-icon">

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

    <body id="login">

<!--
        <header id="header">

            <div id="logo-group">
                <span id="logo"> <img src="<?php  echo base_url();?>img/logo-blue.png" alt="Citrus"> </span>

            </div>

        </header>
-->

        <div id="main" role="main">

            <!-- MAIN CONTENT -->
            <div id="content" class="container">

                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                        <div class="alert alert-info alert-block">
                           <h4 class="alert-heading">Email Verification Required</h4>
                            <?php  echo $message; ?>
                        </div>
                    </div>

                </div>

            </div>

        </div>


    </body>
</html>
