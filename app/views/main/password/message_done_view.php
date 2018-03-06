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

    </head>

    <body id="login">


        <div id="main" role="main">

            <!-- MAIN CONTENT -->
            <div id="content" class="container">

                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                        <div class="alert alert-success alert-block">
                           <h4 class="alert-heading">Password Changed</h4>
                            <?php  echo $message; ?>
                        </div>

                        <a href="<?php  echo base_url();?>LoginBackend.html" id="btnLogin"  class="btn btn-primary"><i class="fa fa-arrow-right"></i> Log In</a>

                    </div>

                </div>

            </div>

        </div>

        <p class="note text-center"><?php  echo $productname;?> by <?php  echo $companyname;?> All Rights Reserved.</p>

    </body>
</html>
