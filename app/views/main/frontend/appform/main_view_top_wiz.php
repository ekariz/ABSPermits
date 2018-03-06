<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->

    <head>
        <meta charset="utf-8">
        <title>ABS :: Harmonized Application Form</title>
        <meta name="description" content="ABS SYSTEM">
        <meta name="author" content="Vista Solutions">

        <!-- Mobile Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="images/favicon.ico">

         <?php  $this->load->view('main/frontend/header_css'); ?>
         <style>
        .file-input-wrapper {
            height: 35px;
            overflow: hidden;
            position: absolute;
            width: 123px;
            background-color: #fff;
            cursor: pointer;
        }

        .file-input-wrapper > input[type="file"] {
            font-size: 40px;
            position: absolute;
            top: 0;
            right: 0;
            opacity: 0;
            cursor: pointer;
        }
         </style>
    </head>

    <body class="no-trans front-page  page-loader-1 ">

        <div class="scrollToTop circle"><i class="icon-up-open-big"></i></div>

        <div class="page-wrapper">

           <?php  $this->load->view('main/frontend/header_user', $header_opts= ['show_top_header' => true, 'header_classes' => '' , 'firstname' => $firstname ]); ?>

            <div id="page-start"></div>


            <!-- breadcrumb start -->
            <!-- ================ -->
            <div class="breadcrumb-container">
                <div class="container">
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home pr-10"></i><a href="<?php echo base_url();?>Home.html">Home</a></li>
                        <li class="active"> Harmonized Application Form</li>
                    </ol>
                </div>
            </div>
            <!-- breadcrumb end -->


            <!-- main-container start -->
            <!-- ================ -->

            <div class="container">
                <div class="row form-group">
                    <div class="col-xs-12">
                        <ul class="nav nav-pills nav-justified thumbnail setup-panel">
                            <li class="active"><a href="#step-1">
                                <h4 class="list-group-item-heading">Step 1</h4>
                                <p class="list-group-item-text">First step description</p>
                            </a></li>
                            <li class="disabled"><a href="#step-2">
                                <h4 class="list-group-item-heading">Step 2</h4>
                                <p class="list-group-item-text">Second step description</p>
                            </a></li>
                            <li class="disabled"><a href="#step-3">
                                <h4 class="list-group-item-heading">Step 3</h4>
                                <p class="list-group-item-text">Third step description</p>
                            </a></li>

                            <li class="disabled"><a href="#step-4">
                                <h4 class="list-group-item-heading">Step 4</h4>
                                <p class="list-group-item-text">Second step description</p>
                            </a></li>

                        </ul>
                    </div>
                </div>
                <div class="row setup-content" id="step-1">
                    <div class="col-xs-12">
                        <div class="col-md-12 well text-center">
                            <h1> STEP 1</h1>

                             <form>
                            <div class="container">
                                <div class="row clearfix">
                                    <div class="col-md-10 column">
                                        <a id="add_row" class="btn btn-success pull-left">Add Row</a><a id='delete_row' class="btn btn-danger pull-right">Delete Row</a>
                                        <br /><br /><br />

                                        <table class="table table-bordered table-hover" id="tab_logic">
                                            <thead>
                                                <tr >
                                                    <th class="text-center">
                                                        #
                                                    </th>
                                                    <th class="text-center">
                                                        Name
                                                    </th>
                                                    <th class="text-center">
                                                        Surname
                                                    </th>
                                                    <th class="text-center">
                                                        Email
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr id='addr0'>
                                                    <td>
                                                    1
                                                    </td>
                                                    <td>
                                                    <input type="text" name='name0'  placeholder='Name' class="form-control"/>
                                                    </td>
                                                    <td>
                                                    <input type="text" name='sur0' placeholder='Surname' class="form-control"/>
                                                    </td>
                                                    <td>
                                                    <input type="text" name='email0' placeholder='Email' class="form-control"/>
                                                    </td>
                                                </tr>
                                                <tr id='addr1'></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- <a id="add_row" class="btn btn-success pull-left">Add Row</a><a id='delete_row' class="btn btn-danger pull-right">Delete Row</a> -->
                            </div>
                            </form>


                            <button id="activate-step-2" class="btn btn-primary btn-md">Save and Continue</button>
                        </div>
                    </div>
                </div>
                <div class="row setup-content" id="step-2">
                    <div class="col-xs-12">
                        <div class="col-md-12 well text-center">
                            <h1 class="text-center"> STEP 2</h1>

                <div class="container">

                      <div class="row">
                        <div class="col-lg-12">
                           <form class="well" action="upload.php" method="post" enctype="multipart/form-data">
                              <div class="form-group">
                                <label for="file">Select a file to upload</label>
                                <input type="file" name="file">
                                <p class="help-block">Only jpg,jpeg,png and gif file with maximum size of 1 MB is allowed.</p>
                              </div>
                              <input type="submit" class="btn btn-lg btn-primary" value="Upload">
                            </form>
                        </div>
                      </div>
                </div>
                <!-- /container -->




                            <button id="activate-step-3" class="btn btn-primary btn-md">Activate Step 3</button>
                        </div>
                    </div>
                </div>
                <div class="row setup-content" id="step-3">
                    <div class="col-xs-12">
                        <div class="col-md-12 well text-center">
                            <h1 class="text-center"> STEP 3</h1>

            <form></form>

                            <button id="activate-step-4" class="btn btn-primary btn-md">Activate Step 4</button>
                        </div>
                    </div>
                </div>

                <div class="row setup-content" id="step-4">
                    <div class="col-xs-12">
                        <div class="col-md-12 well text-center">
                            <h1 class="text-center"> STEP 4</h1>

            <form></form>

                        </div>
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

        // Activate Next Step

        $(document).ready(function() {

            var navListItems = $('ul.setup-panel li a'),
                allWells = $('.setup-content');

            allWells.hide();

            navListItems.click(function(e)
            {
                e.preventDefault();
                var $target = $($(this).attr('href')),
                    $item = $(this).closest('li');

                if (!$item.hasClass('disabled')) {
                    navListItems.closest('li').removeClass('active');
                    $item.addClass('active');
                    allWells.hide();
                    $target.show();
                }
            });

            $('ul.setup-panel li.active a').trigger('click');

            // DEMO ONLY //
            $('#activate-step-2').on('click', function(e) {
                $('ul.setup-panel li:eq(1)').removeClass('disabled');
                $('ul.setup-panel li a[href="#step-2"]').trigger('click');
                $(this).remove();
            })

            $('#activate-step-3').on('click', function(e) {
                $('ul.setup-panel li:eq(2)').removeClass('disabled');
                $('ul.setup-panel li a[href="#step-3"]').trigger('click');
                $(this).remove();
            })

            $('#activate-step-4').on('click', function(e) {
                $('ul.setup-panel li:eq(3)').removeClass('disabled');
                $('ul.setup-panel li a[href="#step-4"]').trigger('click');
                $(this).remove();
            })

            $('#activate-step-3').on('click', function(e) {
                $('ul.setup-panel li:eq(2)').removeClass('disabled');
                $('ul.setup-panel li a[href="#step-3"]').trigger('click');
                $(this).remove();
            })
        });


        // Add , Dlelete row dynamically

             $(document).ready(function(){
              var i=1;
             $("#add_row").click(function(){
              $('#addr'+i).html("<td>"+ (i+1) +"</td><td><input name='name"+i+"' type='text' placeholder='Name' class='form-control input-md'  /> </td><td><input  name='sur"+i+"' type='text' placeholder='Surname'  class='form-control input-md'></td><td><input  name='email"+i+"' type='text' placeholder='Email'  class='form-control input-md'></td>");

              $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
              i++;
          });
             $("#delete_row").click(function(){
                 if(i>1){
                 $("#addr"+(i-1)).html('');
                 i--;
                 }
             });

        });

        </script>

    </body>
</html>
