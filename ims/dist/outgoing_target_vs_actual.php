<?php session_start(); ?>
<style>
    td{
        border-style:dashed;
        border-width: 1px;
            padding:10px;

    }
</style>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<script src="../../js/jquery-1.6.4.min.js" type="text/javascript"></script>
<script src="../../js/setup.js" type="text/javascript"></script>
<link href="../../src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="../../src/facebox.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('a[rel*=facebox]').facebox({
            loadingImage : 'src/loading.gif',
            closeImage   : 'src/closelabel.png'
        })
    })
</script>
<?php include("../../config.php"); ?>

<link class="include" rel="stylesheet" type="text/css" href="../jquery.jqplot.min.css" />

<style>

    #legend{
        float:right;
    }
    #tipco{
        background-color:yellow;
        color:white;

    }
    #competitor{
        background-color:red;
        color:white;

    }

    #competitor2{
        background-color:green;
        color:white;

    }
</style>
<script class="include" type="text/javascript" src="../jquery.min.js"></script>
<?php
$target=array();
$actual=array();
$branch=array();

$query="SELECT sum(actual.weight),actual.branch,target from actual join target_per_month on target_per_month.branch_name=actual.branch  where month ='2013/07' group by actual.branch;";
$result=mysql_query($query);

while($row = mysql_fetch_array($result)) {
    array_push($actual,($row['sum(actual.weight)']/1000));
    if($branch=='Novaliches') {
        array_push($branch,'Kaybiga');

    }else {
        array_push($branch,$row['branch']);

    }
    array_push($target,$row['target']);


}

?>

<script>
    $(document).ready(function(){
        var s1 = [
<?php
foreach($actual as $value) {
    echo $value.",";

}
?>

        ];
        var s2 = [<?php
foreach($target as $value) {
    echo $value.",";

}
?>];

            var ticks = [
<?php
foreach($branch as $value) {
    echo "'".$value."'".",";

}
?>



            ];

            var plot1 = $.jqplot('chart1', [s1, s2,], {
                seriesDefaults:{
                    renderer:$.jqplot.BarRenderer,
                    rendererOptions: {fillToZero: true}
                },
                series:[
                    {label:'Actual Deliveries'},
                    {label:'Record to Beat'},
                    {label:'Airfare'}
                ],

                legend: {
                    show: true,
                    placement: 'outsideGrid'
                },
                axes: {
                    // Use a category axis on the x axis and use our custom ticks.
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

<script type="text/javascript" src="../plugins/jqplot.cursor.min.js"></script>


<div id="chart1" style=""></div>


<a rel="facebox" href="../../form_specify_target.php"><button>Specify Target</button></a>
<hr>
<?php
echo "<table>";
echo "<th>Branch</th>";
echo "<th>Target</th>";
echo "<th>Actual</th>";
$query="SELECT sum(actual.weight),branch,target from actual join target_per_month on target_per_month.branch_name=actual.branch  where month ='2013/07' group by actual.branch;";
$result=mysql_query($query);

while($row = mysql_fetch_array($result)) {
    echo "<tr>";
    echo "<td>".$row['branch']."</td>";
    echo "<td>".number_format($row['target'],2)."</td>";
    echo "<td>".number_format(($row['sum(actual.weight)']/1000),2)."</td>";

    echo "</tr>";
}
echo "</table>";
?>