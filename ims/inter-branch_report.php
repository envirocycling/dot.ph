<?php
include('templates/template.php');
include('config.php');
?>
<style>
    #total{
        font-weight:bold;
        background-color:yellow;
    }
    h3{
        color:white;
    }
</style>
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
<div class="grid_3">
    <div class="box round first grid">
        <h2>Filtering Options</h2>
        <form action="filter_inter-branch.php" method="POST">
            From: <input type='text'  id='inputField' name='from' value="" onfocus='date1(this.id);' readonly><br>
            TO: <input type='text'  id='inputField2' name='to' value="" onfocus='date1(this.id);' readonly><br>
            <input type="submit" value="Filter">
        </form>
        <a href="clear_inter-branch.php"><button>Clear Filter</button></a>
    </div>
</div>

<?php

echo "<h3><i>Inter-Branch Deliveries for the  period ".$_SESSION['inter-branch_from']." to ".$_SESSION['inter-branch_to']."</i></h3>";
?>
<?php
$result=mysql_query("SELECT sum(weight),branch,delivered_to,wp_grade FROM actual where date between '".$_SESSION['inter-branch_from']."' and  '".$_SESSION['inter-branch_to']."' and str_no like 'i%' and branch !='' group by branch,wp_grade");
$grades_array=array();
$delivered_to_array=array();
$delivery_details=array();
while($row=mysql_fetch_array($result)) {
    array_push($delivered_to_array,$row['delivered_to']);
    array_push($grades_array,$row['wp_grade']);
}
$delivered_to_array=array_unique($delivered_to_array);
$grades_array=array_unique($grades_array);
foreach($delivered_to_array as $branch) {
    echo "<div class='grid_10'>";
    echo "<div class='box round first grid'>";
    echo "<h2>Delivered to $branch</h2>";
    echo "<table class='data display datatable' id='example'> ";
    $result=mysql_query("SELECT sum(weight),branch,delivered_to,wp_grade FROM actual where date between '".$_SESSION['inter-branch_from']."' and  '".$_SESSION['inter-branch_to']."'  and  delivered_to='$branch'  and branch !='' and str_no like 'i%' group by branch,wp_grade");
    $branch_from=array();
    $wp_grade_array=array();
    $deliveries_array=array();
    $total_array=array();
    while($row=mysql_fetch_array($result)) {
        array_push($wp_grade_array,$row['wp_grade']);
        array_push($branch_from,$row['branch']);
        $deliveries_array[$row['branch']."+".$row['wp_grade']]=$row['sum(weight)'];
        array_push($total_array,$row['wp_grade']."+".$row['sum(weight)']);
    }
    echo "<thead>";
    echo "<th>BRANCH</th>";
    $wp_grade_array=array_unique($wp_grade_array);
    foreach($wp_grade_array as $grade) {
        echo "<th>$grade</th>";
    }
    echo "</thead>";
    $branch_from=array_unique($branch_from);
    foreach($branch_from as $branch) {

        echo "<tr>";
        echo "<td>$branch</td>";
        foreach($wp_grade_array as $grade) {
            $key=$branch."+".$grade;
            if(!empty($deliveries_array[$key])) {
                echo "<td>".number_format($deliveries_array[$key],2)."</td>";
            }else {
                echo "<td>-</td>";
            }
        }
        echo "</tr>";


    }
    echo "<tr id='total'>";
    echo "<td>~TOTAL~</td>";

    foreach($wp_grade_array as $grade) {
        $total_per_grade=0;
        foreach($total_array as $total) {
            $total_new=preg_split("/[+]/",$total);
            if($total_new[0]==$grade) {
                $total_per_grade+=$total_new[1];
            }
        }
        echo "<td>".number_format($total_per_grade,2)."</td>";
    }

    echo "</tr>";
    echo "</table>";
    echo "</div></div>";
}
?>
<div class="clear">
</div>
<div class="clear">
</div>