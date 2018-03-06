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

        .stepwizard-step p {
            margin-top: 5px;
        }
        .stepwizard-row {
            display: table-row;
        }
        .stepwizard {
            display: table;
            width: 70%;
            position: relative;
        }
        .stepwizard-step button[disabled] {
            opacity: 1 !important;
            filter: alpha(opacity=100) !important;
        }
        .stepwizard-row:before {
            top: 25px;
            bottom: 0;
            position: absolute;
            content: " ";
            width: 100%;
            height: 1px;
            background-color: #ccc;
            z-order: 0;
        }
        .stepwizard-step {
            display: table-cell;
            text-align: center;
            position: relative;
        }
        .btn-circle {
            width: 30px;
            height: 30px;
            text-align: center;
            padding: 6px 0;
            font-size: 16px;
            line-height: 1.428571429;
            border-radius: 25px;
        }
      </style>
    </head>

    <body class="no-trans front-page  page-loader-1 ">

        <div class="scrollToTop circle"><i class="icon-up-open-big"></i></div>

        <div class="page-wrapper">

           <?php $this->load->view('main/frontend/header_user', $header_opts= ['show_top_header' => true, 'header_classes' => '' , 'firstname' => $firstname ]); ?>

            <!-- main-container start -->
            <!-- ================ -->

                <div class="container">

                    <div class="stepwizard col-md-offset-1">
                        <div class="stepwizard-row setup-panel">
                          <div class="stepwizard-step">
                            <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                            <p>Personal info</p>
                          </div>
                          <div class="stepwizard-step">
                            <a href="#step-2" type="button" class="btn btn-info btn-circle" disabled="disabled">2</a>
                            <p>Upload Documents</p>
                          </div>
                          <div class="stepwizard-step">
                            <a href="#step-3" type="button" class="btn btn-primary btn-circle" disabled="disabled">3</a>
                            <p>Resources details</p>
                          </div>
                          <div class="stepwizard-step">
                            <a href="#step-4" type="button" class="btn btn-primary btn-circle" disabled="disabled">4</a>
                            <p>Requirements</p>
                          </div>
                          <div class="stepwizard-step">
                            <a href="#step-5" type="button" class="btn btn-primary btn-circle" disabled="disabled">5</a>
                            <p>Finish</p>
                          </div>
                        </div>
                      </div>

                       <form role="form" action="<?php echo base_url();?>signup/save" id="form-signup" class="smart-form client-form" method="post" >

                        <div class="row setup-content" id="step-1">
                          <div class="col-xs-8 col-md-offset-1">
                            <div class="col-md-12 well">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label class="control-label" for="firstname">Are you a student? *</label>
                                            <select class="form-control" id="position" name="position" required="required" >
                                                <option value="" selected="">Choose option</option>
                                                <option value="1">Yes</option>
                                                <option value="2">No</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label class="control-label" for="lastname">Applying As? *</label>
                                            <select class="form-control"  id="position" name="position"  required="required">
                                                <option value="" selected="">Choose option</option>
                                                <option value="Individual">Individual</option>
                                                <option value="Academic Institution">Academic Institution</option>
                                                <option value="Company">Company/Research Program</option>
                                            </select>
                                        </div>
                                    </div>

                                 </div>

                                 <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group   has-feedback">
                                            <label class="control-label" for="researcherid">Researcher ID *</label>
                                            <input type="text" step="any" class="form-control" id="researcherid" name="researcherid" placeholder="Researcher ID"  required="required" >
                                        </div>
                                    </div>
                                 </div>

                                 <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group   has-feedback">
                                            <label class="control-label" for="legalofficername">Institution Legal Officer Name</label>
                                            <input type="text" class="form-control" id="legalofficername" name="legalofficername" placeholder=" " >
                                        </div>
                                    </div>
                                 </div>

                                 <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group   has-feedback">
                                            <label class="control-label" for="legalofficername">Institution Legal Officer Email</label>
                                            <input type="email" class="form-control" id="legalofficeremail" name="legalofficeremail" placeholder=" " >
                                        </div>
                                    </div>
                                 </div>

                                </div>

                              <!------------------------------------------>
                              <button class="btn btn-primary nextBtn btn-md pull-right" type="button" >Save & Continue</button>
                            </div>
                          </div>
                        </div>

                        <div class="row setup-content" id="step-2">
                          <div class="col-xs-8 col-md-offset-1">
                            <div class="col-md-12 well">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label class="control-label" for="documentregistration">Company Registration Document *</label>
                                            <input type="file" id="documentregistration" name="documentregistration" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label class="control-label" for="documentresearchproposal">Research Proposal *</label>
                                            <input type="file" id="documentresearchproposal" name="documentresearchproposal" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label class="control-label" for="documentaffiliation">Letter of Affiliation With local institution *</label>
                                            <input type="file" id="documentaffiliation" name="documentaffiliation" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label class="control-label" for="documentresearchbudget">Research Budget *</label>
                                            <input type="file" id="documentresearchbudget" name="documentresearchbudget" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label class="control-label" for="documentcv">Curriculum Vitae *</label>
                                            <input type="file" id="documentcv" name="documentcv" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label class="control-label" for="documentpic">PIC *</label>
                                            <input type="file" id="documentpic" name="documentpic" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label class="control-label" for="documentmat">MAT*</label>
                                            <input type="file" id="documentmat" name="documentmat" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label class="control-label" for="documentmta">MTA *</label>
                                            <input type="file" id="documentmta" name="documentmta" >
                                        </div>
                                    </div>
                                </div>

                                </div>
                              <button class="btn prevBtn btn-md pull-left" type="button" >Previous</button>
                              <button class="btn btn-primary nextBtn btn-md pull-right" type="button" >Save & Continue</button>
                            </div>
                          </div>
                        </div>

                        <div class="row setup-content" id="step-3">
                          <div class="col-xs-8 col-md-offset-1">
                            <div class="col-md-12 well">

                               <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-feedback">
                                            <label class="control-label" for="resources">Will you be Researching/Collecting and or exporting a genetic resource from Kenya? *</label>
                                        </div>
                                    </div>
                                </div>

                               <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-feedback">
                                            <select id="resources" name="resources" class="form-control" >
                                                <option value="" selected="">Choose option</option>
                                                <option value="1">Yes</option>
                                                <option value="2">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <button class="btn prevBtn btn-md pull-left" type="button" >Previous</button>
                            <button class="btn btn-primary nextBtn btn-md pull-right" type="button" >Continue</button>
                          </div>
                        </div>


                        <div class="row setup-content" id="step-4">
                          <div class="col-xs-8 col-md-offset-1 ">
                            <div class="col-md-12 well">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-feedback">
                                            <label class="control-label" for="firstname">Type of genetic resource to be collected *</label>
                                            <select name="typeofgenetic" id="typeofgenetic"  class="form-control" required="required" >
                                                <option value="" selected="">Choose option</option>
                                                <option value="1">Plant Material</option>
                                                <option value="2">Animal Material</option>
                                                <option value="3">Forest/Protected Area Material</option>
                                                <option value="4">Cultural &amp; Heritage Material</option>
                                                <option value="5">Plant or forest Seed</option>
                                            </select>
                                        </div>
                                    </div>

                                 </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-feedback">
                                            <label class="control-label" for="speciesname">Species name of the genetic resource to be collected *</label>
                                            <input type="text" class="form-control" id="speciesname" name="speciesname" placeholder=" " required="required" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-feedback">
                                            <label class="control-label" for="scientificname">Scientific name of the genetic resource to be collected? *</label>
                                            <input type="text" class="form-control" id="scientificname" name="scientificname" placeholder=" " required="required" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-feedback">
                                            <label class="control-label" for="commonname">Common name of the generic resource to be collected *</label>
                                            <input type="text" class="form-control" id="commonname" name="commonname" placeholder=" " required="required" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-feedback">
                                            <label class="control-label" for="projectlocation">Location or project area for genetic resource collection *</label>
                                            <input type="text" class="form-control" id="projectlocation" name="projectlocation" placeholder=" " required="required" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-feedback">
                                            <label class="control-label" for="projectarea">Is the project area inside a conservation area, gazetted forest or protected area? *</label>
                                            <input type="text" class="form-control" id="projectarea" name="projectarea" placeholder=" " required="required" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-feedback">
                                            <label class="control-label" for="resourceallocationpurpose">Purpose of genetic resource allocation? *</label>
                                            <input type="text" class="form-control" id="resourceallocationpurpose" name="resourceallocationpurpose" placeholder=" " required="required" >
                                        </div>
                                    </div>
                                </div>

                              <button class="btn prevBtn btn-md pull-left" type="button" >Previous</button>
                              <button class="btn btn-primary nextBtn btn-md pull-right" type="button" >Save & Continue</button>
                            </div>
                          </div>
                        </div>

                        <div class="row setup-content" id="step-5">
                          <div class="col-xs-8 col-md-offset-1">
                            <div class="col-md-12">
                              <h3> Step 5</h3>
                              <button class="btn prevBtn btn-md pull-left" type="button" >Previous</button>
                              <button class="btn btn-success btn-md pull-right" type="submit">Submit</button>
                            </div>
                          </div>
                        </div>

                      </form>

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

        $(document).ready(function () {
          var navListItems = $('div.setup-panel div a'),
                  allWells = $('.setup-content'),
                  allPrevBtn = $('.prevBtn'),
                  allNextBtn = $('.nextBtn');

          allWells.hide();

          navListItems.click(function (e) {
              e.preventDefault();
              var $target = $($(this).attr('href')),
                      $item = $(this);

              if (!$item.hasClass('disabled')) {
                  navListItems.removeClass('btn-primary').addClass('btn-default');
                  $item.addClass('btn-primary');
                  allWells.hide();
                  $target.show();
                  $target.find('input:eq(0)').focus();
              }
          });

          allNextBtn.click(function(){
              var curStep = $(this).closest(".setup-content"),
                  curStepBtn = curStep.attr("id"),
                  nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                  curInputs = curStep.find("input[type='text'],input[type='url']"),
                  isValid = true;

              $(".form-group").removeClass("has-error");
              for(var i=0; i<curInputs.length; i++){
                  if (!curInputs[i].validity.valid){
                      isValid = false;
                      $(curInputs[i]).closest(".form-group").addClass("has-error");
                  }
              }

              if (isValid)
                  nextStepWizard.removeAttr('disabled').trigger('click');
          });

          allPrevBtn.click(function(){
              var curStep = $(this).closest(".setup-content"),
                  curStepBtn = curStep.attr("id"),
                  nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a"),
                  curInputs = curStep.find("input[type='text'],input[type='url']"),
                  isValid = true;
                  //console.log(curStepBtn);
                  //console.log($('div.setup-panel div a[href="#' + curStepBtn + '"]').parent());
                  //console.log($('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a"));
                  //console.log("\r\n");
                  //console.log(curStepBtn-1);
              $(".form-group").removeClass("has-error");
              for(var i=0; i<curInputs.length; i++){
                  if (!curInputs[i].validity.valid){
                      isValid = false;
                      $(curInputs[i]).closest(".form-group").addClass("has-error");
                  }
              }

              if (isValid)
                  nextStepWizard.removeAttr('disabled').trigger('click');
          });

          $('div.setup-panel div a.btn-primary').trigger('click');
        });
        </script>

    </body>
</html>
