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

$month_filter = date("m",strtotime($_SESSION['weekly_month']));
$month_and_year_filter=$_SESSION['weekly_year']."/".$month_filter;


$target_array=array();
$query="SELECT sum(target)as target,UPPER(branch) as branch  from monthly_target where month='$month_and_year_filter' group by branch";
$result=mysql_query($query);
while($row = mysql_fetch_array($result)) {
    $target_array[$row['branch']]=$row['target'];
}

$branch_array=array();
$branch_actual_deliveries=array();
$query="SELECT sum(weight) as weight,UPPER(branch) as branch  from actual where date like '%$month_and_year_filter%' group by branch";
$result=mysql_query($query);
while($row = mysql_fetch_array($result)) {
    array_push($branch_array,$row['branch']);
    $branch_actual_deliveries[$row['branch']]=$row['weight']/1000;
}



?>

<script>
    $(document).ready(function(){
        var s1 = [
<?php
foreach($branch_array as $branch) {
    if(!empty($branch_actual_deliveries[$branch])) {
        echo $branch_actual_deliveries[$branch].",";
    }else {
        echo "0,";
    }
}
?>

        ];
        var s2 = [<?php
foreach($branch_array as $val) {
    if(!empty($target_array[$val])) {
        echo $target_array[$val].",";

    }else {
        echo "0,";
    }
}
?>];

            var ticks = [
<?php
foreach($branch_array as $value) {
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


<!--<a rel="facebox" href="../../form_specify_target.php"><button>Specify Target</button></a>-->
<?php
echo "<form action='../../weekly_filter.php' method='POST'>";

?>
Month: <select name="weekly_month" onchange='this.form.submit()'>
    <option value="<?php echo $_SESSION['weekly_month'];?>"><?php echo $_SESSION['weekly_month'];?></option>
    <option value="January">January</option>
    <option value="February">February</option>
    <option value="March">March</option>
    <option value="April">April</option>
    <option value="May">May</option>
    <option value="June">June</option>
    <option value="July">July</option>
    <option value="August">August</option>
    <option value="September">September</option>
    <option value="October">October</option>
    <option value="November">November</option>
    <option value="December">December</option>

</select>


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
<hr>

<?php

echo "<table>";
echo "<th>Branch</th>";
echo "<th>Target</th>";
echo "<th>Actual</th>";

while($row = mysql_fetch_array($result)) {
    echo "<tr>";
    echo "<td>".$row['branch']."</td>";
    echo "<td>".number_format($row['target'],2)."</td>";
    echo "<td>".number_format(($row['sum(actual.weight)']/1000),2)."</td>";

    echo "</tr>";
}

foreach($branch_array as $branch) {
   

    echo "<tr>";
    echo "<td>".$branch."</td>";
    if(!empty($target_array[$branch])) {
        echo "<td>".$target_array[$branch]."</td>";
    }else {
        echo "<td></td>";
    }
    if(!empty($branch_actual_deliveries[$branch])) {
        echo "<td>".$branch_actual_deliveries[$branch]."</td>";
    }else {
        echo "<td></td>";
    }

    echo "</tr>";







}








echo "</table>";




?>



