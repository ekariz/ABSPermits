<?php

$steps_str = "'". implode("','",$approvalsteps) ."'";

foreach($approvalsteps as $stepid=>$stepname){
 $num_approved            = isset($approvals[$stepid]['approved']) ? ($approvals[$stepid]['approved']) : 0;
 $num_pending             = isset($approvals[$stepid]['pending']) ? ($approvals[$stepid]['pending']) : 0;

 $data_approved[$stepid]  = $num_approved;
 $data_pending[$stepid]   = $num_pending;

}

$data_approved_str = implode(',',$data_approved);
$data_pending_str  = implode(',',$data_pending);


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
        zoomType: 'xy'
    },
    colors: ['#00aa55', '#c00'],
    title: {
        text: 'Research Projects'
    },
    subtitle: {
        text: 'Pending vs Approved'
    },
    xAxis: [{
        categories: [<?php  echo $steps_str; ?>],
        crosshair: true
    }],
    yAxis: [{ // Primary yAxis
        labels: {
            format: '{value}',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        },
        title: {
            text: 'Approved',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        }
    }, { // Secondary yAxis
        title: {
            text: 'Pending',
            style: {
                color: Highcharts.getOptions().colors[2]
            }
        },
        labels: {
            format: '{value} ',
            style: {
                color: Highcharts.getOptions().colors[2]
            }
        },
        opposite: true
    }],
    tooltip: {
        shared: true
    },
    credits: {
      enabled: false
    },
    legend: {
        layout: 'vertical',
        align: 'left',
        x: 70,
        verticalAlign: 'top',
        y: 40,
        floating: true,
        backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
    },
    series: [
    {
        
        name: 'Pending',
        type: 'column',
        yAxis: 1,
        data: [<?php echo $data_pending_str ?>],
        tooltip: {
            valueSuffix: ''
        }

    }, {
        name: 'Approved',
        type: 'spline',
        data: [<?php echo $data_approved_str ?>],
        tooltip: {
            valueSuffix: ''
        }
    }]
});
  
});
</script>
