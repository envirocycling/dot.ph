<?php session_start(); ?>
<link class="include" rel="stylesheet" type="text/css" href="../jquery.jqplot.min.css" />
<link rel="stylesheet" type="text/css" href="examples.min.css" />
<link type="text/css" rel="stylesheet" href="syntaxhighlighter/styles/shCoreDefault.min.css" />
<link type="text/css" rel="stylesheet" href="syntaxhighlighter/styles/shThemejqPlot.min.css" />
<script class="include" type="text/javascript" src="../jquery.min.js"></script>
<?php

include("../../config.php");
$dates_array=array();
$weight_array=array();
$start_date=$_POST['start_date'];
$end_date=$_POST['end_date'];
$branch=$_POST['branch'];
$wp_grade=$_POST['wp_grade'];
$query="SELECT sum(weight),date_delivered FROM sup_deliveries where date_delivered >='".$start_date."' and date_delivered <='$end_date' and wp_grade='$wp_grade' and branch_delivered like '%$branch%' group by date_delivered order by date_delivered asc";


$result=mysql_query($query);


while($row = mysql_fetch_array($result)) {
    $date=date("M-d",strtotime($row['date_delivered']));
    array_push ($dates_array,$date);
    array_push($weight_array,$row['sum(weight)']);
}

?>

<div id="chart1" style=""></div>
<script class="code" type="text/javascript">$(document).ready(function(){
    $.jqplot.config.enablePlugins = true;
    var s1 = [
<?php
foreach($weight_array as $value) {
    echo $value.",";
}
?>
    ];


    var ticks = [
<?php
foreach($dates_array as $value) {
    echo "'".$value."'".",";
}

?>
    ];


    plot1 = $.jqplot('chart1', [s1], {
        // Only animate if we're not using excanvas (not in IE 7 or IE 8)..
        animate: !$.jqplot.use_excanvas,
        seriesDefaults:{
            renderer:$.jqplot.BarRenderer,
            pointLabels: { show: true }
        },
        axes: {
            xaxis: {
                renderer: $.jqplot.CategoryAxisRenderer,
                ticks: ticks


            },
            yaxis: {

                tickOptions: {
                    formatString: "%' d"
                },
                rendererOptions: {
                    // align the ticks on the y2 axis with the y axis.
                    alignTicks: true,
                    forceTickAt0: true
                }
            }

        },
        highlighter: { show: false }
    });

    $('#chart1').bind('jqplotDataClick',
    function (ev, seriesIndex, pointIndex, data) {
        $('#info1').html('series: '+seriesIndex+', point: '+pointIndex+', data: '+data);
    }
);
});
</script>





<script class="include" type="text/javascript" src="../jquery.jqplot.min.js"></script>
<script type="text/javascript" src="syntaxhighlighter/scripts/shCore.min.js"></script>
<script type="text/javascript" src="syntaxhighlighter/scripts/shBrushJScript.min.js"></script>
<script type="text/javascript" src="syntaxhighlighter/scripts/shBrushXml.min.js"></script>



<script class="include" type="text/javascript" src="../jquery.jqplot.min.js"></script>
<script class="include" type="text/javascript" src="../plugins/jqplot.barRenderer.min.js"></script>









