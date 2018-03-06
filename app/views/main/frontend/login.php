<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->

    <head>
        <meta charset="utf-8">
        <title>ABS :: Login</title>
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
                        <div class="main object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="100">
                            <div class="form-block center-block p-30 light-gray-bg border-clear">
                                <h2 class="title">Login</h2>
                                <form class="form-horizontal" id="form-login" method="POST"  action="Login/auth"  >
                                    <div class="form-group has-feedback">
                                        <label for="email" class="col-sm-3 control-label">Email</label>
                                        <div class="col-sm-8">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                            <i class="fa fa-user form-control-feedback"></i>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="password" class="col-sm-3 control-label">Password</label>
                                        <div class="col-sm-8">
                                            <input type="password" class="form-control" id="password"  name="password"  placeholder="password" required>
                                            <i class="fa fa-lock form-control-feedback"></i>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <button type="submit" class="btn btn-group btn-default btn-animated">Log In <i class="fa fa-user"></i></button>
                                            <ul class="space-top">
                                                <li><a href="page-login.html#">Forgot your password?</a></li>
                                            </ul>

                                        </div>
                                    </div>
                                </form>
                            </div>
                            <p class="text-center space-top">Don't have an account yet? <a href="signup.html">Sign up</a> Now.</p>
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
                $("#form-login").validate({
                    rules : {
                        email : {
                            required : true,
                            email : true
                        },
                        password : {
                            required : true,
                            minlength : 5,
                            maxlength : 50
                        },
                    },

                    messages : {
                        email : {
                            required : 'Please enter your email address',
                            email : 'Please enter a VALID email address'
                        },
                        password : {
                            required : 'Please enter your password'
                        },

                    },
                    submitHandler : function(form) {
                        $(form).ajaxSubmit({
                            dataType: 'json',
                            method: 'POST',
                            success : function(data) {
                               $("#form-login").addClass('submited');

                               if(data.success==1){
                                   swal({
                                     text: data.message,
                                     icon: "success",
                                     buttons: false,
                                     timer: 2000,
                                    });
                                    window.location='<?php  echo  base_url(); ?>?reload=<?php echo mt_rand();?>';
                               }else if(data.success==0){
                                  swal({
                                    text: data.message,
                                    icon: "warning",
                                  }).then((state) => {
                                    $("#form-login").removeClass('submited');
                                  });
                               }


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
