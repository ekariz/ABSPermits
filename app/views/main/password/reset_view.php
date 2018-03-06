<?php

?>
<!DOCTYPE html>
<html lang="en-us" id="extr-page" >
    <head>
        <meta charset="utf-8">
        <title>ABS &reg;</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php  echo base_url();?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php  echo base_url();?>assets/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php  echo base_url();?>assets/css/smartadmin-production.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php  echo base_url();?>assets/css/smartadmin-skins.min.css">
        <style>
             label.error{ color:#f00 }
        </style>

    </head>

    <body id="login">


        <div id="main" role="main">

            <!-- MAIN CONTENT -->
            <div id="content" class="container">

                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                        <form action="<?php echo base_url();?>ForgotPassword/do_reset" id="form-reset" class="smart-form client-form" method="post" >
                                <header>
                                    Reset your Password
                                </header>

                                <fieldset>

                                    <section>
                                        <label class="input"> <i class="icon-append fa fa-envelope"></i>
                                            <input type="email" id="email"  name="email" value="<?php  echo $email;?>" disabled readonly >
                                    </section>

                                    <section>
                                        <label class="input"> <i class="icon-append fa fa-lock"></i>
                                            <input type="password" id="password"  name="password" placeholder="New Password" >
                                            <b class="tooltip tooltip-bottom-right">Don't forget your password</b> </label>
                                    </section>

                                    <section>
                                        <label class="input"> <i class="icon-append fa fa-lock"></i>
                                            <input type="password" id="passwordconfirm"  name="passwordconfirm" placeholder="Confirm password">
                                            <b class="tooltip tooltip-bottom-right">Don't forget your password</b> </label>
                                    </section>
                                </fieldset>

                                <footer>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-check"></i> Reset
                                    </button>
                                </footer>

                            </form>

                    </div>

                </div>

            </div>

        </div>
        <p class="note text-center"><?php  echo $productname;?> by <?php  echo $companyname;?> All Rights Reserved.</p>

        <script src="<?php echo base_url();?>assets/js/libs/jquery-2.1.1.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/libs/jquery-ui-1.10.3.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/app.config.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/custom.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/bootstrap/bootstrap.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/notification/SmartNotification.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/plugin/jquery-validate/jquery.validate.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/plugin/masked-input/jquery.maskedinput.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/plugin/msie-fix/jquery.mb.browser.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/plugin/fastclick/fastclick.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/app.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/ui.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/loadingoverlay.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/loadingoverlay_progress.min.js"  type="text/javascript" ></script>

        <script type="text/javascript">

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


            $(function() {
                $("#form-reset").validate({
                    rules : {
                        password : {
                            required : true,
                            minlength : 5,
                            maxlength : 20
                        },
                        passwordconfirm : {
                            required : true,
                            minlength : 5,
                            maxlength : 20,
                            equalTo : '#password'
                        },
                        terms : {
                            required : true
                        }
                    },

                    messages : {
                        password : {
                            required : 'Please enter your password'
                        },
                        passwordconfirm : {
                            required : 'Please enter your password one more time',
                            equalTo : 'Please enter the same password as above'
                        },
                    },
                    submitHandler : function(form) {
                        $(form).ajaxSubmit({
                            success : function() {
                                $("#form-register").addClass('submited');
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
