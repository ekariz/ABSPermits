<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->

    <head>
        <meta charset="utf-8">
        <title>ORCID Authorization</title>
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
                        <li><i class="fa fa-home pr-10"></i><a href="./">Home</a></li>
                        <li class="active">Login</li>
                    </ol>
                </div>
            </div>
            <!-- breadcrumb end -->


            <!-- main-container start -->
            <!-- ================ -->
            <div class="main-container dark-translucent-bg" style="background-image:url('assets/frontend/images/banner1.jpg');">
                <div class="container">
                    <div class="row">
                        <!-- main start -->
                        <!-- ================ -->

                            <div class=" center-block p-30 light-gray-bg border-clear">
                                <h2 class="title">ORCID Authorization</h2>
                                    <div class=" ">
<!--
                                    <div class="alert alert-success">ORCID provides a persistent digital identifier that distinguishes you from other researchers. Learn more at <a href="https://orcid.org/"  target="_blank" >orcid.org</a></div>
-->
                                    <div class="alert alert-default">
                                      ABS IT SYSTEM is collecting your ORCID iD so we can link your ORCID iD with ABS. When you click the “Authorize” button,
                                      we will ask you to share your iD using an authenticated process:
                                      <a href="https://support.orcid.org/hc/articles/360006897454"  target="_blank" >either by registering for an ORCID iD</a>
                                       or, if you already have one, by signing into your ORCID account, then granting us permission to get your ORCID iD. We do this to ensure that you are correctly identified and securely connecting your ORCID iD. Learn more about <a href="https://orcid.org/blog/2017/02/20/whats-so-special-about-signing" target="_blank" >What’s so special about signing in.</a>
                                    </div>
                                    </div>

                                    <div class="form-group">
                                       <a href="https://orcid.org/oauth/authorize?client_id=<?php echo $orcid_client_id;?>&response_type=code&scope=/<?php echo $orcid_scope;?>&redirect_uri=<?php echo $orcid_redirect_uri;?>"  style="background-color:#A6CE39" class="btn btn-group btn-success btn-animated"><i class="ai ai-orcid  ai-1x"></i> create or Connect to your ORCID iD </a>

<!--
                                       <a href="#" onclick="orcidOAUTH()"  style="background-color:#A6CE39" class="btn btn-group btn-success btn-animated"><i class="ai ai-orcid  ai-1x"></i> create or Connect to your ORCID iD </a>
-->

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

            });


            var oauthWindow;
            function orcidOAUTH() {
             var oauthWindow = window.open("https://orcid.org/oauth/authorize?client_id=<?php echo $orcid_client_id;?>&response_type=code&scope=/<?php echo $orcid_scope;?>&redirect_uri=<?php echo $orcid_redirect_uri;?>", "_blank", "toolbar=no, scrollbars=yes, width=500, height=600, top=500, left=500");
            }

        </script>

    </body>
</html>
