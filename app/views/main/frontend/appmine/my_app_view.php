<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->

    <head>
        <meta charset="utf-8">
        <title>ABS :: Application <?php echo $appno; ?></title>
        <meta name="description" content="ABS SYSTEM">

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
              <?php
               $this->load->view("main/frontend/appmine/application_details_view.php" );
              ?>
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
    <iframe id="_iframex" name="_iframex" frameborder="0" width="0" height="0"></iframe>
    <?php  $this->load->view('main/frontend/footer'); ?>

    <script type="text/javascript" src="<?php  echo base_url();?>assets/js/updater.js"></script>

    <script type="text/javascript">
     $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();
     });

     var permit ={
      download:function(id,stepno){
       $('#_iframex').attr('src','<?php  echo base_url();?>ApplicationsList/GetPermit/'+id+'/'+stepno);
      }
     }

     var payments ={
      init:function(id,stepno){
       ui.call('<?php  echo base_url();?>ApplicationsList/payment','id='+id+'&stepno='+stepno ,'div_application');
      },
      init_mpesa_stkpush:function(id,stepno){
       var mobile = $('#mobile').val();
       $('button#btnPay').prop('disabled', true);
       $.post('<?php  echo base_url();?>ApplicationsList/init_mpesa_stkpush', 'id='+id+'&stepno='+stepno+'&mobile='+mobile, function(data) {
        if (data.success === 1) {
         swal({
         text: "Enter MPESA PIN When Prompted On "+mobile+" ",
         icon: "info",
         buttons: false,
         timer: 3000,
        }).then((state) => {
         payment_poll(id,stepno);
        });

        }else{
          $('button#btnPay').prop('disabled', false);
          if(typeof data.message=='string' ){
           swal({ text: data.message, icon: "error"});
          }
        }
       }, "json");
      },
      paid:function(data){
       ui.fc('<?php  echo base_url();?>ApplicationsList/application_details/'+data.id  ,'div_application');
      },
     }

     function  payment_poll(id,stepno){
        $.updater({
           url: '<?php  echo base_url();?>ApplicationsList/check_payment',
           data: { id:id, stepno:stepno },
           method: 'post',
           response: 'json',
           interval: 10000
         },
         function(data, response){
          if(data.success==1){
           $.updater.stop();
           swal({
             text: data.message,
             icon: "success",
             buttons: false,
             timer: 3000,
            }).then((state) => {
              payments.paid(data);
           });
          }else if(data.success==2){//waiting
           $.updater.stop();
           swal({ text: data.message, icon: "info"});
           $('button#btnPay').prop('disabled', false);
           location.hash = 'step-5';
          }else if(data.success==3){//user cancelled
           $.updater.stop();
           swal({ text: data.message, icon: "error"});
           $('button#btnPay').prop('disabled', false);
          }else{
           swal({ text: data.message, icon: "info"});//continue polling
          }
         });
        }

    </script>

    </body>
</html>
