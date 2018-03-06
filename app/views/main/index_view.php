<?php


?>

    <body class="smart-style-6 minified fixed-header fixed-ribbon fixed-navigation fixed-page-footer">

        <header id="header">
            <div id="logo-group">

                <span id="logo"> <img src="<?php echo base_url();?>assets/img/logo.png" alt="Labs"> </span>

                <span id="activity" class="activity-dropdown"> <i class="fa fa-user"></i> <b class="badge"> 21 </b> </span>

                <div class="ajax-dropdown">

                    <!-- the ID links are fetched via AJAX to the ajax container "ajax-notifications" -->
                    <div class="btn-group btn-group-justified" data-toggle="buttons">
                        <label class="btn btn-default">
                            <input type="radio" name="activity" id="ajax/notify/mail.html">
                            Msgs (14) </label>
                        <label class="btn btn-default">
                            <input type="radio" name="activity" id="ajax/notify/notifications.html">
                            notify (3) </label>
                        <label class="btn btn-default">
                            <input type="radio" name="activity" id="ajax/notify/tasks.html">
                            Tasks (4) </label>
                    </div>

                    <!-- notification content -->
                    <div class="ajax-notifications custom-scroll">

                        <div class="alert alert-transparent">
                            <h4>Click a button to show messages here</h4>
                            This blank page message helps protect your privacy, or you can show the first message here automatically.
                        </div>

                        <i class="fa fa-lock fa-4x fa-border"></i>

                    </div>
                    <!-- end notification content -->

                    <!-- footer: refresh area -->
                    <span> Last updated on: 12/12/2013 9:43AM
                        <button type="button" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Loading..." class="btn btn-xs btn-default pull-right">
                            <i class="fa fa-refresh"></i>
                        </button>
                    </span>
                    <!-- end footer -->

                </div>
                <!-- END AJAX-DROPDOWN -->
            </div>

            <!-- app dropdown -->
            <div class="project-context hidden-xs">

                <span class="label"><?php  echo $appname; ?>:</span>
                <span class="project-selector dropdown-toggle" data-toggle="dropdown">History <i class="fa fa-angle-down"></i></span>

                <!-- Suggestion: populate this list with fetch and push technique -->
                <ul class="dropdown-menu">
                    <li>
                        <a href="javascript:void(0);">module 1</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">module 2</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">module 3</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="javascript:void(0);"><i class="fa fa-power-off"></i> Clear</a>
                    </li>
                </ul>
                <!-- end dropdown-menu-->

            </div>
            <!-- end projects dropdown -->

            <!-- pulled right: nav area -->
            <div class="pull-right">

                <!-- collapse menu button -->
                <div id="hide-menu" class="btn-header pull-right">
                    <span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
                </div>
                <!-- end collapse menu -->

                <!-- #MOBILE -->
                <!-- Top menu profile link : this shows only when top menu is active -->
                <ul id="mobile-profile-img" class="header-dropdown-list hidden-xs padding-5">
                    <li class="">
                        <a href="#" class="dropdown-toggle no-margin userdropdown" data-toggle="dropdown">
                            <img src="<?php echo base_url();?>assets/img/avatars/sunny.png" alt="<?php echo $username;?>" class="online" />
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0"><i class="fa fa-cog"></i> Setting</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="profile.html" class="padding-10 padding-top-0 padding-bottom-0"> <i class="fa fa-user"></i> <u>P</u>rofile</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="toggleShortcut"><i class="fa fa-arrow-down"></i> <u>S</u>hortcut</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="launchFullscreen"><i class="fa fa-arrows-alt"></i> Full <u>S</u>creen</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="<?php echo base_url();?>logout/?v=<?php echo mt_rand();?>" class="padding-10 padding-top-5 padding-bottom-5" data-action="userLogout"><i class="fa fa-sign-out fa-lg"></i> <strong><u>L</u>ogout</strong></a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <!-- logout button -->
                <div id="logout" class="btn-header transparent pull-right">
                    <span> <a href="./logout" title="Sign Out" data-action="userLogout" data-logout-msg="You can improve your security further after logging out by closing this opened browser"><i class="fa fa-sign-out"></i></a> </span>
                </div>
                <!-- end logout button -->

                <!-- search mobile button (this is hidden till mobile view port) -->
                <div id="search-mobile" class="btn-header transparent pull-right">
                    <span> <a href="javascript:void(0)" title="Search"><i class="fa fa-search"></i></a> </span>
                </div>
                <!-- end search mobile button -->

                <!-- input: search field -->
                <form action="search.html" class="header-search pull-right">
                    <input id="search-fld"  type="text" name="param" placeholder="Find reports and more" data-autocomplete=''>
                    <button type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                    <a href="javascript:void(0);" id="cancel-search-js" title="Cancel Search"><i class="fa fa-times"></i></a>
                </form>
                <!-- end input: search field -->

                <!-- fullscreen button -->
                <div id="fullscreen" class="btn-header transparent pull-right">
                    <span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i class="fa fa-arrows-alt"></i></a> </span>
                </div>
                <!-- end fullscreen button -->

                <!-- #Voice Command: Start Speech -->
                <div id="speech-btn" class="btn-header transparent pull-right hidden-sm hidden-xs">
                    <div>
                        <a href="javascript:void(0)" title="Voice Command" data-action="voiceCommand"><i class="fa fa-microphone"></i></a>
                        <div class="popover bottom"><div class="arrow"></div>
                            <div class="popover-content">
                                <h4 class="vc-title">Voice command activated <br><small>Please speak clearly into the mic</small></h4>
                                <h4 class="vc-title-error text-center">
                                    <i class="fa fa-microphone-slash"></i> Voice command failed
                                    <br><small class="txt-color-red">Must <strong>"Allow"</strong> Microphone</small>
                                    <br><small class="txt-color-red">Must have <strong>Internet Connection</strong></small>
                                </h4>
                                <a href="javascript:void(0);" class="btn btn-success" onclick="commands.help()">See Commands</a>
                                <a href="javascript:void(0);" class="btn bg-color-purple txt-color-white" onclick="$('#speech-btn .popover').fadeOut(50);">Close Popup</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end voice command -->

                <!-- multiple lang dropdown : find all flags in the flags page -->
                <ul class="header-dropdown-list hidden-xs">
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img src="<?php echo base_url();?>assets/img/blank.gif" class="flag flag-us" alt="United States"> <span> English (US) </span> <i class="fa fa-angle-down"></i> </a>
                        <ul class="dropdown-menu pull-right">
                            <li class="active">
                                <a href="javascript:void(0);"><img src="<?php echo base_url();?>assets/img/blank.gif" class="flag flag-us" alt="United States"> English (US)</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);"><img src="<?php echo base_url();?>assets/img/blank.gif" class="flag flag-fr" alt="France"> Français</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);"><img src="<?php echo base_url();?>assets/img/blank.gif" class="flag flag-es" alt="Spanish"> Español</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);"><img src="<?php echo base_url();?>assets/img/blank.gif" class="flag flag-de" alt="German"> Deutsch</a>
                            </li>

                        </ul>
                    </li>
                </ul>
                <!-- end multiple lang -->

            </div>
            <!-- end pulled right: nav area -->

        </header>
        <!-- END HEADER -->

        <!-- Left panel : Navigation area -->
        <!-- Note: This width of the aside area can be adjusted through LESS variables -->
        <aside id="left-panel">

            <!-- User info -->
            <div class="login-info">
                <span> <!-- User image size is adjusted inside CSS, it should stay as it -->

                    <a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
                        <img src="<?php echo base_url();?>assets/img/avatars/sunny.png" alt="me" class="online" />
                        <span>
                            <?php  echo $username; ?>
                        </span>
                        <i class="fa fa-angle-down"></i>
                    </a>

                </span>
            </div>
            <!-- end user info -->

            <span class="minifyme" data-action="minifyMenu">
             <i class="fa fa-arrow-circle-left hit"></i>
            </span>

            <!-- NAVIGATION : This navigation is also responsive-->
            <nav>

                <ul>
                    <li class="active">
                        <a href="Dashboard.html" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>
                    </li>

                    <?php

                    if($appmenu){
                     if(sizeof($appmenu)>0){
                      foreach($appmenu as $menu){
                       $parentid = valueof($menu, 'parentid');
                       $modname = valueof($menu, 'modname');
                       $modicon = valueof($menu, 'modicon');
                       $iconclr = valueof($menu, 'iconclr');
                       $mnutype = valueof($menu, 'mnutype');
                       $modcont = valueof($menu, 'modcont');
                       $id      = valueof($menu, 'id');
                       $subs    = valueof($menu, 'subs');
                       $menu_class = sizeof($subs)>0 ? 'menu-item-parent' : '';

                       if($parentid==0){
                         echo "<li>\r\n";
                          echo "<a href=\"#\"><i class=\"fa fa-lg fa-fw {$modicon} txt-color-{$iconclr}\"></i> <span class=\"{$menu_class}\">{$modname}</span></a>\r\n";
                          if(sizeof($subs)>0){
                              echo   "<ul>\r\n";
                               list_menu_subs( $subs );
                              echo   "</ul><!--end sub menu 1.-->\r\n";
                          }
                         echo "</li>\r\n";
                       }
                      }
                     }
                    }

                    ?>

                </ul>
            </nav>

        </aside>
        <!-- END NAVIGATION -->

        <!-- MAIN PANEL -->
        <div id="main" role="main">

            <!-- RIBBON -->
            <div id="ribbon">

                <span class="ribbon-button-alignment">
                    <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
                        <i class="fa fa-refresh"></i>
                    </span>
                </span>

                <!-- breadcrumb -->
                <ol class="breadcrumb">
                    <li>Home</li><li>Dashboard</li>
                </ol>
                <!-- end breadcrumb -->

                <!-- You can also add more buttons to the
                ribbon for further usability

                Example below:
-->
                <span class="ribbon-button-alignment pull-right">
                <span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa-grid"></i> Change Grid</span>
                <span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa-plus"></i> Add</span>
                <span id="search" class="btn btn-ribbon" data-title="search"><i class="fa-search"></i> <span class="hidden-mobile">Search</span></span>
                </span>

            </div>
            <!-- END RIBBON -->

            <!-- MAIN CONTENT -->
            <div id="content">
               main
            </div>
            <!-- END MAIN CONTENT -->

        </div>
        <!-- END MAIN PANEL -->

        <!-- PAGE FOOTER -->
        <div class="page-footer">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <span class="txt-color-white">PerePay &reg; <span class="hidden-xs"> - Envisage Mobile</span> LTD <?php  echo date('Y');?></span>
                </div>

                <div class="col-xs-6 col-sm-6 text-right hidden-xs">
                    state : Online
                </div>
            </div>
        </div>
        <!-- END PAGE FOOTER -->


        <div id="shortcut">
            <ul>
                <?php
                 if(isset($apps)){
                  if(sizeof($apps)>0){
                   foreach($apps as $app){

                    $appid   = $app['appid'];
                    $appname = $app['appname'];
                    $appicon = $app['appicon'];
                    $iconclr = $app['iconclr'];
                    $selected = $appid==$ui_appid ? 'selected' : '';

                    echo "<li>\r\n";
                     echo "<a href=\"#\" onclick=\"open_app('{$appid}');\" class=\"jarvismetro-tile big-cubes {$selected} bg-color-{$iconclr}\"> <span class=\"iconbox\"> <i class=\"fa fa-{$appicon} fa-4x\"></i> <span>{$appname} </span> </span> </a>\r\n";
                    echo "</li>\r\n";

                   }
                  }
                 }

                 echo "<li>\r\n";
                  echo "<a href=\"#Profile.html\" class=\"jarvismetro-tile big-cubes bg-color-pinkDark\"> <span class=\"iconbox\"> <i class=\"fa fa-user fa-4x\"></i> <span>My Profile </span> </span> </a>\r\n";
                 echo "</li>\r\n";
                ?>

            </ul>
        </div>
        <!-- END SHORTCUT AREA -->

        <!--================================================== -->
        <!--[if IE 8]>
         <h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
        <![endif]-->
        <script src="<?php echo base_url();?>assets/js/libs/jquery-2.1.1.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/libs/jquery-ui-1.10.3.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/app.config.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/custom.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/bootstrap/bootstrap.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/notification/SmartNotification.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/smartwidgets/jarvis.widget.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/plugin/jquery-validate/jquery.validate.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/plugin/masked-input/jquery.maskedinput.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/plugin/select2/select2.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/plugin/highChartCore/highcharts.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/plugin/msie-fix/jquery.mb.browser.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/plugin/fastclick/fastclick.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/app.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/ui.js"       type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/db.min.js"   type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/dataTables.bootstrap.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/dataTables.responsive.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/responsive.bootstrap.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/jquery.easy-autocomplete.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/jquery.ajax-combobox.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/plugin/jquery-ui-combogrid/jquery.ui.combogrid-1.6.4.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/speech/voicecommand.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/loadingoverlay.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/loadingoverlay_progress.min.js"  type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/sweetalert.min.js" type="text/javascript" ></script>
        <script src="<?php echo base_url();?>assets/js/jquery.countTo.js"  type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/plugin/sparkline/jquery.sparkline.min.js"></script>

        <script>
            function open_app(appid){
             $.post('Home/switch_to_app/'+appid, '', function(data) {
              if (data.success === 1) {
               top.location = '<?php echo base_url()."?".rand()."#Dashboard.html?"; ?>';
              }else{
               alert(data.message);
              }
             }, "json");
            }

            $(document).ready(function() {

             pageSetUp();

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
