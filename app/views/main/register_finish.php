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

        </header>

        <div id="main" role="main">

            <!-- MAIN CONTENT -->
            <div id="content" class="container">

                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                    <div class="alert alert-info fade in" id="div-alert-default" >
                     <i class="fa-fw fa fa-check"></i>
                     <strong>Setup </strong>  We have all we need to setup your new application.
                    </div>

                    <div class="alert alert-success fade in" id="div-alert-success"  style="display:none">
                     <i class="fa-fw fa fa-check"></i>
                     <strong>Congratulations</strong>  The system is now ready for use.
                    </div>

                    <div class="jarviswidget jarviswidget-color-orangeLight" id="wid-id-x" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false" role="widget">

                               <header role="heading">
                                <span class="widget-icon"> <i class="fa fa-database"></i> </span>
                                <h2><b><?php echo $companyname; ?></b> initialization...please wait</h2>
                                </header>

                               <!-- widget div-->
                              <div role="content">

                                <!-- widget content -->
                                <div class="widget-body">

                                    <div class="row">

                                        <div class="col-sm-12" id="divLoading">

                                            <table class="table table-bordered table-responive">

                                             <tr>
                                              <td>
                                                <div id="progress-bar-wrapper" class="progress progress-sm progress-striped active">
                                                 <div id="progress-bar" class="progress-bar bg-color-redLight "  role="progressbar" style="width: 5%"></div>
                                                </div>
                                               </td>
                                             </tr>

                                             <tr>
                                              <td id="step1" class="text-primary" ><i class="fa fa-check" ></i> Create database</td>
                                             </tr>

                                             <tr>
                                              <td id="step2"  class="text-muted" ><i class="fa fa-check" ></i> Create database items</td>
                                             </tr>

                                             <tr>
                                              <td id="step3"  class="text-muted" ><i class="fa fa-check" ></i> Create Login Account</td>
                                             </tr>

                                             <tr>
                                              <td id="step4"  class="text-muted" ><i class="fa fa-check"></i> Clean up...</td>
                                             </tr>

                                             <tr>
                                              <td>
                                              <div id="divlaunch" style="display:none" >
                                                <a href="<?php echo $accessurl;?>login.html" id="btnLogin" disabled="disabled" class="btn btn-default"><i class="fa fa-arrow-right"></i> Log In</a>
                                               </div>
                                              </td>
                                             </tr>

                                            </table>

                                        </div>

                                    </div>

                                </div>
                                <!-- end widget body-->

                            </div>
                            <!-- end widget content -->

                        </div>

                    </div>
                </div>
            </div>

        </div>

         <!--[if IE 8]>
         <h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
        <![endif]-->
        <script src="<?php echo base_url();?>assets/js/libs/jquery-2.1.1.min.js"  type="text/javascript" ></script>
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

          $(document).ready(function() {

             $(document).ajaxSend(function(event, request, settings) {
                $("#divLoading").LoadingOverlay("show", {color : "rgba(255, 255, 255, 0.6)"});
             });

             $(document).ajaxStop(function(event, request, settings) {
                $("#divLoading").LoadingOverlay("hide");
             });

             $(document).ajaxComplete(function(event, request, settings) {
                $("#divLoading").LoadingOverlay("hide");
             });

             setTimeout("setup.initialize(1)",1000);

         });

         var setup ={
              initialize:function(step){
               $.post('<?php echo base_url();?>Setup/steps/'+step, 'step='+step, function(data) {
                if (data.success === 1) {

                   var step_next = step+1;
                   var progress  = step*25;

                   $('#step'+step).attr('class', 'text-success');

                   if($('#step'+step_next)){
                    $('#step'+step_next).attr('class', 'text-primary');
                   }

                   $("#progress-bar").css("width", progress+"%");

                   if(step>=4){
                    $("#status").html("The system is now ready for use");
                    $("#div-alert-default").hide();
                    $("#div-alert-success").show();
                    $("#divlaunch").show();
                    $('#btnLogin').attr('disabled',false);
                    $('#btnLogin').attr('class','btn btn-primary');
                    $('#progress-bar').attr('class','progress-bar bg-color-greenLight ');
                   }

                  if (typeof data.step=='number' && data.step>1 && step<4) {
                   setup.initialize( data.step );
                  }
                }else if (data.success === 2) {
                    $.bigBox({
                     title : "Company Setup",
                     content : data.message,
                     color : "#739E73",
                     timeout: 10000,
                     icon : "fa fa-check",
                     number : "1"
                    });
                } else {
                   $.bigBox({
                    title : "Error",
                    content : data.message,
                    color : "#C46A69",
                    timeout: 6000,
                    icon : "fa fa-warning shake animated",
                    number : "1"
                   });
                }
               }, "json");
         },
         }
   </script>

    </body>
</html>
