<?php
$_header_classes = '';

if(isset($header_classes)){
 $_header_classes = $header_classes;
}
?>
            <!-- header-container start -->
            <div class="header-container">

                <!-- header-top start -->
                <?php
                if($show_top_header){
                 $this->load->view('main/frontend/header_top_user');
                }
                ?>
                <!-- header-top end -->

                <!-- header start -->
                <!-- classes:  -->
                <!-- "fixed": enables fixed navigation mode (sticky menu) e.g. class="header fixed clearfix" -->
                <!-- "dark": dark version of header e.g. class="header dark clearfix" -->
                <!-- "full-width": mandatory class for the full-width menu layout -->
                <!-- "centered": mandatory class for the centered logo layout -->
                <!-- ================ -->
                <header class="header fixed clearfix <?php echo $header_classes?> ">

                    <div class="container">
                        <div class="row">
                            <div class="col-md-3">
                                <!-- header-left start -->
                                <!-- ================ -->
                                <div class="header-left clearfix">

                                    <!-- logo -->
                                    <div id="logo" class="logo">
                                        <a href="#"><img id="logo_img" src="<?php  echo base_url();?>/assets/frontend/images/logo_abs.jpg" alt="ABS"></a>
                                    </div>

                                    <!-- name-and-slogan -->
                                    <div class="site-slogan">
                                        Permit Application System
                                    </div>

                                </div>
                                <!-- header-left end -->

                            </div>
                            <div class="col-md-9">

                                <!-- header-right start -->
                                <!-- ================ -->
                                <div class="header-right clearfix">

                                <!-- main-navigation start -->
                                <!-- classes: -->
                                <!-- "onclick": Makes the dropdowns open on click, this the default bootstrap behavior e.g. class="main-navigation onclick" -->
                                <!-- "animated": Enables animations on dropdowns opening e.g. class="main-navigation animated" -->
                                <!-- "with-dropdown-buttons": Mandatory class that adds extra space, to the main navigation, for the search and cart dropdowns -->
                                <!-- ================ -->
                                <div class="main-navigation  animated with-dropdown-buttons">

                                    <!-- navbar start -->
                                    <!-- ================ -->
                                    <nav class="navbar navbar-default" role="navigation">
                                        <div class="container-fluid">

                                            <!-- Toggle get grouped for better mobile display -->
                                            <div class="navbar-header">
                                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                                                    <span class="sr-only">Toggle navigation</span>
                                                    <span class="icon-bar"></span>
                                                    <span class="icon-bar"></span>
                                                    <span class="icon-bar"></span>
                                                </button>

                                            </div>

                                            <!-- Collect the nav links, forms, and other content for toggling -->
                                            <div class="collapse navbar-collapse" id="navbar-collapse-1">
                                                <!-- main-menu -->
                                                <?php  $this->load->view('main/frontend/mainmenu_user'); ?>
                                                <!-- main-menu end -->

                                                <!-- header dropdown buttons -->
                                                <div class="header-dropdown-buttons hidden-xs ">
                                                    <div class="btn-group dropdown">
                                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-search"></i></button>
                                                        <ul class="dropdown-menu dropdown-menu-right dropdown-animation">
                                                            <li>
                                                                <form role="search" class="search-box margin-clear">
                                                                    <div class="form-group has-feedback">
                                                                        <input type="text" class="form-control" placeholder="Search">
                                                                        <i class="icon-search form-control-feedback"></i>
                                                                    </div>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                </div>
                                                <!-- header dropdown buttons end-->

                                            </div>

                                        </div>
                                    </nav>
                                    <!-- navbar end -->

                                </div>
                                <!-- main-navigation end -->
                                </div>
                                <!-- header-right end -->

                            </div>
                        </div>
                    </div>

                </header>
                <!-- header end -->
            </div>
            <!-- header-container end -->
