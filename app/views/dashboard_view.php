<?php

$steps_str = "'". implode("','",$approvalsteps) ."'";

foreach($approvalsteps as $stepid=>$stepname){
 $num_inbox = isset($num_docs[$stepid]) ? count($num_docs[$stepid]) : 0;
 $data_bars[$stepid] = $num_inbox;
}

$data_bars_str = implode(',',$data_bars);

?>
<!-- widget grid -->
<section id="widget-grid" class="">

<!-- row -->
<div class="row">
    <article class="col-sm-12">
        <!-- new widget -->
        <div class="jarviswidget" id="wid-id-0"  data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">

            <header>
                <span class="widget-icon"> <i class="glyphicon glyphicon-stats txt-color-darken"></i> </span>
                <h2>ABS PERMIT Analytics </h2>

                <ul class="nav nav-tabs pull-right in" id="myTab">
                    <li class="active">
                        <a data-toggle="tab" href="#s1"><i class="fa fa-bar-chart"></i> <span class="hidden-mobile hidden-tablet">Applications</span></a>
                    </li>

                </ul>

            </header>

            <!-- widget div-->
            <div class="no-padding">

                <div class="widget-body">
                    <!-- content -->
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade active in padding-10 no-padding-bottom" id="s1">
                            <div class="row no-space">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                                   <div id="container_apps"></div>

                                </div>

                            </div>

                            <div class="show-stat-microcharts">
                                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                                 <span class="font-xl txt-color-green timer" data-from="0" data-to="<?php echo $num_applications; ?>" data-speed="2500"><?php echo $num_applications; ?></span> <span class="label txt-color-darken">Applications</span>
                                 <ul class="smaller-stat hidden-sm pull-right">
                                    <li>
                                        <span class="label bg-color-pink" rel="tooltip" data-placement="left" data-original-title="20 local"><i class="fa fa-map-marker "></i> 20</span>
                                    </li>
                                    <li>
                                        <span class="label bg-color-blue" rel="tooltip" data-placement="left" data-original-title="50 Foreign"><i class="fa fa-globe"></i> 50</span>
                                    </li>
                                </ul>

                                </div>

                                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 text-center">
                                    <div class="easy-pie-chart txt-color-pink" data-percent="30" data-pie-size="50">
                                        <span class="percent percent-sign">30</span>
                                    </div>
                                    <span class="easy-pie-title"> Local </span>

                                </div>

                                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 text-center">
                                    <div class="easy-pie-chart txt-color-blue" data-percent="70" data-pie-size="50">
                                        <span class="percent percent-sign">70 </span>
                                    </div>
                                    <span class="easy-pie-title"> Foreign </span>

                                </div>

                                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 text-center">
                                    <div class="easy-pie-chart txt-color-magenta" data-percent="20" data-pie-size="50">
                                        <span class="percent percent-sign">20 <i class="fa fa-caret-up"></i></span>
                                    </div>
                                    <span class="easy-pie-title"> Approved <i class="fa fa-caret-calendar icon-color-good"></i></span>

                                </div>

                            </div>

                        </div>
                        <!-- end s1 tab pane -->


                    </div>

                    <!-- end content -->
                </div>

            </div>
            <!-- end widget div -->
        </div>
        <!-- end widget -->

    </article>
</div>

<!-- end row -->

<!-- row -->

<div class="row">

    <article class="col-sm-12 col-md-12 col-lg-6">

        <!-- new widget -->
         <div class="jarviswidget" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" >

            <header>
                <span class="widget-icon"> <i class="fa fa-group"></i> </span>
                <h2>another chart here</h2>

            </header>

            <!-- widget div-->
            <div>


                <div class="widget-body widget-hide-overflow padding">
                    <!-- content goes here -->

                    <div id="container_employee_count_basic_pay"></div>

                    <!-- end content -->
                </div>

            </div>
            <!-- end widget div -->
        </div>
        <!-- end widget -->


    </article>

    <article class="col-sm-12 col-md-12 col-lg-6">

        <!-- new widget -->
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">


            <header>
                <span class="widget-icon"> <i class="fa fa-building"></i> </span>
                <h2>some chart here</h2>

            </header>

            <!-- widget div-->
            <div>


                <div class="widget-body no-padding">
                    <!-- content goes here -->

                          test
                    <!-- end content -->

                </div>

            </div>
            <!-- end widget div -->
        </div>
        <!-- end widget -->

    </article>

</div>

<!-- end row -->

</section>
<!-- end widget grid -->



<script>

$(function () {
 pageSetUp();
  $('.timer').countTo();

  $('#container_apps').highcharts({
    chart: {
        height: 250,
        type: 'column'
    },
    title: {
        text: 'Inbox Per Organization'
    },
    plotOptions: {column: {colorByPoint: true}},
    xAxis: {
        categories: [ <?php  echo $steps_str; ?>],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Applications'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">Inbox for {point.key}</span><table>',
        pointFormat: '<tr><td style="padding:0"><b>{point.y:,.0f}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0,
            borderWidth: 2
        }
    },
    credits: {
            enabled: false
        },
    series: [{
         name: 'Inbox',
         data: [<?php echo $data_bars_str ?>]
         }
        ]
 });

});
</script>
