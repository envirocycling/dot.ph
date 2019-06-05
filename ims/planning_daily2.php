<?php session_start();?>
<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
    function date1(str){
        new JsDatePick({
            useMode:2,
            target:str,
            dateFormat:"%Y/%m/%d"

        });
    };
</script>

<style>
    #total{
        font-weight:bold;
        background-color:yellow;
    }
    td,th{
        text-align:right;
        border-style: hidden;
        border-right:solid;
        border-bottom:solid;
        border-width:1px;
    }

</style>

<?php
include('config.php');


?>


</head>
<div class="grid_10">
    <div class="box round first grid">
        <div id="faceboxxx">
            <?php

            echo "<form action='filter_planning_daily.php' method='POST'>";

            echo "Select Date: <input type='text'  id='inputField' value='".$_SESSION['planning_date']."' name='date' onfocus='date1(this.id);' readonly>";
            echo "<input type='submit' value='Filter'>";
            echo "</form>";




            ?>


        </div></div></div>
<hr>

<?php
$branch_array=array();
$grades_array=array();
$deliveries_array=array();
$result=mysql_query("SELECT branch,wp_grade,sum(weight) FROM actual where date ='".$_SESSION['planning_date']."' group by branch,wp_grade order by sum(weight) desc;");
while($row=mysql_fetch_array($result)) {
    array_push($branch_array,$row['branch']);
    array_push($grades_array,$row['wp_grade']);
    $deliveries_array[$row['branch']."+".$row['wp_grade']]=$row['sum(weight)'];

}
$grades_array=array_unique($grades_array);
$branch_array=array_unique($branch_array);
$grades_total=0;
echo "<table border=1>";
echo "<th>BRANCH</th>";
foreach($grades_array as $grade) {
    echo "<th>$grade</th>";
}
echo "<th>Total</th>";

foreach($branch_array as $branch_name) {
    $total_column=0;
    echo "<tr>";
    echo "<td>".strtoupper($branch_name)."</td>";

    foreach ($grades_array as $grade) {
        $key=$branch_name."+".$grade;
        if(!empty ($deliveries_array[$key])) {
            echo "<td>".number_format(($deliveries_array[$key]/1000),0)."</td>";
            $total_column+=($deliveries_array[$key]/1000);
        }else {
            echo "<td></td>";
        }
    }
    echo "<td id='total'>".number_format($total_column,0)."</td>";
    echo "</tr>";
}
echo "<tr>";
echo "<td  id='total'>TOTAL</td>";
$result=mysql_query("SELECT wp_grade,sum(weight) FROM actual where date ='".$_SESSION['planning_date']."' group by wp_grade order by sum(weight) desc;");
$final_total=0;
$total_array=array();
while($row=mysql_fetch_array($result)) {
    $total_array[$row['wp_grade']]=($row['sum(weight)']/1000);
    $final_total+=($row['sum(weight)']/1000);
}
foreach($grades_array as $grade) {
    if(!empty($total_array[$grade])) {
        echo "<td  id='total'>".number_format($total_array[$grade],0)."</td>";
    }else {
        echo "<td  id='total'></td>";
    }
}

echo "<td  id='total'>".number_format(($final_total),0)."</td>";
echo "</tr>";

echo "</table>";
?>

</body>
</html>