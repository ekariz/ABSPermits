<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->

    <head>
        <meta charset="utf-8">
        <title>ABS :: My Applications</title>
        <meta name="description" content="ABS SYSTEM">
        <meta name="author" content="Vista Solutions">

        <!-- Mobile Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="images/favicon.ico">

         <?php  $this->load->view('main/frontend/header_css'); ?>
         <link href="<?php  echo base_url();?>assets/css/smart_wizard.min.css" rel="stylesheet" type="text/css" />
         <link href="<?php  echo base_url();?>assets/css/smart_wizard_theme_arrows.min.css" rel="stylesheet" type="text/css" />
         <style>
          div#smartwizard i.fa-check { color:green;}
          div#smartwizard i.fa-hourglass { color:#ccc;}
          div.form-group label  { font-weight:bold;color:#555; }
          a.danger,i.danger  { color:#900; }
          i.success  { color:#090; }
         </style>
    </head>

    <body class="no-trans front-page  page-loader-1 ">

        <div class="scrollToTop circle"><i class="icon-up-open-big"></i></div>

        <div class="page-wrapper">

           <?php $this->load->view('main/frontend/header_user', $header_opts= ['show_top_header' => true, 'header_classes' => '' , 'firstname' => $firstname ]); ?>

            <!-- main-container start -->
            <!-- ================ -->
            <div class="container">
             <div class="row" id="div_application">

              <div class="alert alert-info">
               <strong>My Submitted Applications</strong>
              </div>
              <?php  $this->load->view('main/frontend/appmine/list_view' ); ?>
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

    <?php  $this->load->view('main/frontend/footer'); ?>

    <script type="text/javascript" src="<?php  echo base_url();?>assets/js/validator.min.js"></script>
    <script type="text/javascript" src="<?php  echo base_url();?>assets/js/jquery.smartWizard.min.js"></script>

    <script type="text/javascript">
     $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();
     });

     function open_application(id){
      ui.fc('<?php echo $this->router->class;?>/open_application/'+id,'div_application');
     };

     function view_application(id){
      var win=window.open('<?php echo $this->router->class;?>/view_application/'+id,'report','height=800,width=830,toolbar=no,menubar=no,directories=no,location=no,scrollbars=yes,status=no,resizable=no,fullscreen=no,top=0,left=0');
      win.focus();
     };
    </script>

    </body>
</html>
