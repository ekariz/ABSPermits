<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->

    <head>
        <meta charset="utf-8">
        <title>ABS :: Login</title>
        <meta name="description" content="ABS IT SYSTEM">

        <!-- Mobile Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="images/favicon.ico">

         <?php  $this->load->view('main/frontend/header_css'); ?>
    </head>

     <body class="no-trans   ">

        <!-- scrollToTop -->
        <!-- ================ -->
        <div class="scrollToTop circle"><i class="icon-up-open-big"></i></div>

        <!-- page wrapper start -->
        <!-- ================ -->
        <div class="page-wrapper">

            <!-- background image -->
            <div class="fullscreen-bg"></div>

            <!-- banner start -->
            <!-- ================ -->
            <div class="pv-10 dark-translucent-bg">
                <div class="container">
                    <div  >
                        <!-- logo -->
                        <div id="logo" class="logo">
                            <h3 class="margin-clear"><a href="./" class="logo-fontx link-light">ABS <span class="text-default"> IT SYSTEM</span></a></h3>
                        </div>
                        <!-- name-and-slogan -->
                        <p class="small"> ABS Online permit application  System</p>

                        <div class="row ">
                         <div class="col-md-12">&nbsp;</div>
                         <div class="col-md-12"><h2>Sign in</h2></div>
                         <div class="col-md-12">ABS IT SYSTEM is collecting your ORCID iD so we can link your ORCID iD with ABS. When you click the “Authorize” button,
                                      we will ask you to share your iD using an authenticated process:
                                      <a href="https://support.orcid.org/hc/articles/360006897454"  target="_blank" >either by registering for an ORCID iD</a>
                                       or, if you already have one, by signing into your ORCID account, then granting us permission to get your ORCID iD. We do this to ensure that you are correctly identified and securely connecting your ORCID iD. Learn more about <a href="https://orcid.org/blog/2017/02/20/whats-so-special-about-signing" target="_blank" >What’s so special about signing in.</a></div>
                         <div class="col-md-6 ">
                            <div  class="alert alert-info" >If you already have an ORCID account, you can use it with ABS.
                            <br>
                            <a href="https://orcid.org/oauth/authorize?client_id=<?php echo $orcid_client_id;?>&response_type=code&scope=/<?php echo $orcid_scope;?>&redirect_uri=<?php echo $orcid_redirect_uri;?>&show_login=true"  style="background-color:#A6CE39" class="btn btn-group btn-default btn-animated"><i class="ai ai-orcid  ai-1x"></i> Login </a>
                            </div>
                         </div>
                         <div class="col-md-6 ">
                            <div  class="alert alert-info" >Not an ORCID user yet? Create an account, it is free and takes a few seconds.<br>
                            <a href="https://orcid.org/oauth/authorize?client_id=<?php echo $orcid_client_id;?>&response_type=code&scope=/<?php echo $orcid_scope;?>&redirect_uri=<?php echo $orcid_redirect_uri;?>&show_login=false"  style="background-color:#A6CE39" class="btn btn-group btn-success btn-animated"><i class="ai ai-orcid  ai-1x"></i> SignUp </a>
                            </div>
                         </div>
                        </div>
                        <!-- .subfooter start -->
                        <!-- ================ -->
                        <p class="text-center"><span class="  pr-10">Copyright © 2017 -  <?php echo date('Y');?>  ABS. All Rights Reserved</p>
                        <!-- .subfooter end -->
                    </div>
                </div>
            </div>
            <!-- banner end -->



        </div>
        <!-- page-wrapper end -->

    </body>
</html>
