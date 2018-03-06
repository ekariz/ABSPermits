        <script type="text/javascript" src="<?php echo base_url();?>assets/frontend/plugins/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/frontend/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/frontend/plugins/modernizr.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/frontend/plugins/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/frontend/plugins/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/frontend/plugins/isotope/isotope.pkgd.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/frontend/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/frontend/plugins/waypoints/jquery.waypoints.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/frontend/plugins/jquery.countTo.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/frontend/plugins/jquery.parallax-1.1.3.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/frontend/plugins/jquery.validate.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/frontend/plugins/vide/jquery.vide.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/frontend/plugins/owl-carousel/owl.carousel.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/frontend/plugins/pace/pace.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/frontend/plugins/jquery.browser.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/frontend/plugins/SmoothScroll.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugin/jquery-form/jquery-form.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugin/jquery-validate/jquery.validate.min.js"  ></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugin/masked-input/jquery.maskedinput.min.js" ></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/frontend/js/template.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/sweetalert.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/ui.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/loadingoverlay.min.js"   ></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/loadingoverlay_progress.min.js"   ></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/frontend/js/custom.js"></script>

        <script>
            $(document).ready(function() {

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
        </script>
