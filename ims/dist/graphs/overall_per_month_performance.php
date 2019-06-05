<?php session_start(); ?>
<link class="include" rel="stylesheet" type="text/css" href="../jquery.jqplot.min.css" />
<link rel="stylesheet" type="text/css" href="examples.min.css" />
<link type="text/css" rel="stylesheet" href="syntaxhighlighter/styles/shCoreDefault.min.css" />
<link type="text/css" rel="stylesheet" href="syntaxhighlighter/styles/shThemejqPlot.min.css" />
<script class="include" type="text/javascript" src="../jquery.min.js"></script>
<?php

include("../../config.php");
$branch_array=array();
$values_array=array();

if($_SESSION['weekly_year']!=date('Y')) {
    $query="SELECT sum(weight),month_delivered FROM sup_deliveries where year_delivered ='".$_SESSION['weekly_year']."'   group by month_delivered order by date_delivered asc";
}else {
    $query="SELECT sum(weight),month_delivered FROM sup_deliveries where year_delivered ='".$_SESSION['weekly_year']."'   group by month_delivered order by date_delivered asc";

}
$result=mysql_query($query);


while($row = mysql_fetch_array($result)) {
    array_push($branch_array,$row['month_delivered']);
    $year=$_SESSION['weekly_year'];
    $month=date("m", strtotime($row['month_delivered']));
    $pick_up_date=$year."/".$month;
    $query2="SELECT sum(net_weight) FROM pick_up where  date like '%$pick_up_date%';";
    $result2=mysql_query($query2);
    if($row2 = mysql_fetch_array($result2)) {
        array_push($values_array,$row['sum(weight)']+$row2['sum(net_weight)']);
    }else {
        array_push($values_array,$row['sum(weight)']);

    }



  
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


<?php
echo "<form action='../../weekly_filter.php' method='POST'>";

?>



Year: <select name="weekly_year" onchange='this.form.submit()'>
    <option value="<?php echo $_SESSION['weekly_year'];?>"><?php echo $_SESSION['weekly_year'];?></option>
    <option value="2011">2011</option>
    <option value="2012">2012</option>
    <option value="2013">2013</option>
    <option value="2014">2014</option>
    <option value="2015">2015</option>
    <option value="2016">2016</option>
    <option value="2017">2017</option>
    <option value="2018">2018</option>
    <option value="2019">2019</option>
    <option value="2020">2020</option>


</select>


<?php
echo "</form><br>";



?>





