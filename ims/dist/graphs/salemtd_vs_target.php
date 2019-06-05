<?php session_start(); ?>
<link class="include" rel="stylesheet" type="text/css" href="../jquery.jqplot.min.css" />
<link rel="stylesheet" type="text/css" href="examples.min.css" />
<script class="include" type="text/javascript" src="../jquery.min.js"></script>
<style>
    table{
        text-align:right;
    }
    #negative{
        color:red;
    }
    #positive{
        color:green;
    }
    td,th{
        text-align:right;
        border-style: hidden;
        border-right:solid;
        border-bottom:solid;
        border-width:1px;
    }
</style>
<?php include("../../config.php");

$target_array=array();
$from=$_GET['from'];
$to=$_GET['to'];
$month=date("Y/m",strtotime($to));
$branch=$_GET['branch'];

$grades_array=array('LCWL','ONP','CBS','OCC','MW','CHIPBOARD','OTHERS');

$query="SELECT sum(weight),wp_grade FROM actual where branch like '%$branch%' and date >= '$from' and date <='$to'  group by wp_grade";
$result=mysql_query($query);

while($row = mysql_fetch_array($result)) {
    $actual_wp_grade=$row['wp_grade'];
    if($actual_wp_grade!='LCWL') {
        $actual_wp_grade=str_replace('LC','',$actual_wp_grade);
    }

    $actual_array[$actual_wp_grade]=$row['sum(weight)']/1000;
}

$query="SELECT sum(target) as target,wp_grade FROM monthly_target where month ='$month' and( branch like '%$branch%') group by wp_grade order by log_id asc";
$result=mysql_query($query);
while($row = mysql_fetch_array($result)) {
    $target_per_grade[$row['wp_grade']]=$row['target'];
}
?>


<div id="chart1" style=""></div>
<script class="code" type="text/javascript">
    $(document).ready(function(){
        var s1 = [
<?php

foreach($grades_array as $grades) {
    if(!empty ($actual_array[$grades])) {
//        if($grades=='LCWL') {
//            $actual_array[$grades]=$actual_array[$grades]-1;
//        }
//        if($grades=='OCC') {
//            $actual_array[$grades]=$actual_array[$grades]+1;
//        }
        if($grades=='MW') {
            $actual_array[$grades]=$actual_array[$grades]+$actual_array['MW-PPQ']+$actual_array['AP_K']+$actual_array['MW_S'];
        }
        if($grades=='ONP') {
            $actual_array[$grades]=$actual_array[$grades]+$actual_array['NPB']+$actual_array['OPD'];
        }
        if($grades=='LCWL') {
            $actual_array[$grades]=$actual_array[$grades]+$actual_array['WL_GW']+$actual_array['WL_CBS']+$actual_array['WL_GUMS'];
        }
        echo $actual_array[$grades].",";

    }
    else {
        echo "0,";
    }
}
?>
        ];
        var s2 = [

<?php
foreach($grades_array as $grades) {
    if(!empty ($target_per_grade[$grades])) {
        echo $target_per_grade[$grades].",";

    }
    else {
        echo "0,";
    }
}
?>
        ];

        var ticks = [
<?php
foreach($grades_array as $grades) {
    echo "'".$grades."',";
}
?>
        ];
        var plot1 = $.jqplot('chart1', [s1, s2], {
            // The "seriesDefaults" option is an options object that will
            // be applied to all series in the chart.
            seriesDefaults:{
                renderer:$.jqplot.BarRenderer,
                rendererOptions: {fillToZero: true},
                pointLabels: { show: true }
            },
            // Custom labels for the series are specified with the "label"
            // option on the series option.  Here a series option object
            // is specified for each series.
            series:[
                {label:'Sales MTD'},
                {label:'Target on Sales'}
            ],
            // Show the legend and put it outside the grid, but inside the
            // plot container, shrinking the grid to accomodate the legend.
            // A value of "outside" would not shrink the grid and allow
            // the legend to overflow the container.
            legend: {
                show: true,
                placement: 'outsideGrid'
            },
            axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
                    ticks: ticks
                },
                // Pad the y axis just a little so bars can get close to, but
                // not touch, the grid boundaries.  1.2 is the default padding.
                yaxis: {
                    pad: 1.05,
                    tickOptions: {formatString: '%d'}
                }
            }
        });
    });
</script>
<script class="include" type="text/javascript" src="../jquery.jqplot.min.js"></script>
<script class="include" type="text/javascript" src="../plugins/jqplot.barRenderer.min.js"></script>
<hr>

