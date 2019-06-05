<link class="include" rel="stylesheet" type="text/css" href="../jquery.jqplot.min.css" />
<link rel="stylesheet" type="text/css" href="examples.min.css" />
<link type="text/css" rel="stylesheet" href="syntaxhighlighter/styles/shCoreDefault.min.css" />
<link type="text/css" rel="stylesheet" href="syntaxhighlighter/styles/shThemejqPlot.min.css" />
<script class="include" type="text/javascript" src="../jquery.min.js"></script>
<?php
session_start();
include("../../config.php");
$branch_array=array();
$values_array=array();


$query="SELECT sum(weight),month_delivered FROM sup_deliveries where year_delivered ='".date('Y')."'  and branch_delivered = '".$_SESSION['user_branch']."' group by month_delivered order by del_id asc";
$result=mysql_query($query);

while($row = mysql_fetch_array($result)) {
    array_push($branch_array,$row['month_delivered']);
    array_push($values_array,$row['sum(weight)']);

}

?>

<div id="chart1" style=""></div>
<script class="code" type="text/javascript">$(document).ready(function(){
    $.jqplot.config.enablePlugins = true;
    var s1 = [
<?php
foreach($values_array as $value) {
    echo $value.",";
}
?>
    ];


    var ticks = [
<?php
foreach($branch_array as $value) {
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






