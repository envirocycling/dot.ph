<link class="include" rel="stylesheet" type="text/css" href="../jquery.jqplot.min.css" />
<link rel="stylesheet" type="text/css" href="examples.min.css" />
<link type="text/css" rel="stylesheet" href="syntaxhighlighter/styles/shCoreDefault.min.css" />
<link type="text/css" rel="stylesheet" href="syntaxhighlighter/styles/shThemejqPlot.min.css" />
<script class="include" type="text/javascript" src="../jquery.min.js"></script>
<?php
include("../../config.php");
$grades_array=array();
$values_array=array();


$query="SELECT count(request_id),branch FROM requests where branch !='' and status !='cancelled' group by branch order by count(request_id) desc";
$result=mysql_query($query);

while($row = mysql_fetch_array($result)) {
    array_push($grades_array,$row['branch']);
    array_push($values_array,$row['count(request_id)']);
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
foreach($grades_array as $value) {
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




