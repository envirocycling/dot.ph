<style>
    table{
        text-align:right;
    }
    td,th{
        text-align:right;
        border-style: hidden;
        border-right:solid;
        border-bottom:solid;
        border-width:1px;
    }
    #total{
        font-weight:bold;
        background-color:yellow;
    }
    #target{
        font-weight:bold;

        background-color: orange;
    }
    #percentage{
        font-weight:bold;
        background-color:aqua;
    }
</style>
<?php
session_start();
include("config.php");
$branch_deliveries=array();
$branches=array();
$wp_grades=array();
$month=$_SESSION['planning_month'];
$date=$_SESSION['planning_date'];
$as_of=$_SESSION['planning_as_of'];
$query="SELECT branch,sum(weight)/1000 as weight,wp_grade from actual where branch !='' and date like '%$month%' group by branch,wp_grade ";
$result=mysql_query($query);

$last_month = date('Y/m', strtotime($month."/01"."- 1 months") );
$next_month = date('Y/m', strtotime($month."/01"."+ 1 months") );

$per_branch_target=array();
$result2=mysql_query("SELECT * from monthly_target where month='$month'");
while($row2=mysql_fetch_array($result2)) {
    $wp_grade=$row2['wp_grade'];
    if ($row2['wp_grade']!='LCWL' && $row2['wp_grade']!='CHIPBOARD') {
        $wp_grade="LC".$row2['wp_grade'];
    }
    $per_branch_target[$row2['branch']."+".$wp_grade]=$row2['target'];
}

$per_grade_target=array();
$result2=mysql_query("SELECT wp_grade,sum(target) as target from monthly_target where month='$month' group by wp_grade");
while($row2=mysql_fetch_array($result2)) {
    $wp_grade=$row2['wp_grade'];
    if ($row2['wp_grade']!='LCWL' && $row2['wp_grade']!='CHIPBOARD') {
        $wp_grade="LC".$row2['wp_grade'];
    }
    $per_grade_target[$wp_grade]=$row2['target'];
}





function actualWeightGiver($branch,$wp_grade,$month,$as_of) {
    $tonnage=0;
    include("../../config.php");
    if($branch!='PAMPANGA' && $branch!='URDANETA') {
        $query="select actual.wp_grade,sum(DISTINCT actual.weight)/1000 as tonnage,outgoing.wp_grade,sum(DISTINCT outgoing.weight)/1000 from actual  left join outgoing on actual.str_no=outgoing.str where outgoing.date like '%$month%' and actual.branch='$branch' and outgoing.str not like '%i%' and str_no !='' and actual.wp_grade='$wp_grade' group by actual.str_no,actual.wp_grade ;";
    }else if($branch=='PAMPANGA' ) {
        $query="select SUM(weight)/1000 as tonnage FROM actual where (branch='Pampanga' or branch='PAMPANGA') and date like '%$month%' and wp_grade='$wp_grade'";

    }else if($branch=='URDANETA') {
        $query="select SUM(weight)/1000 as tonnage FROM actual where (branch='Urdaneta' or branch='URDANETA' or branch='Pangasinan' or branch='PANGASINAN') and date like '%$month%' and wp_grade='$wp_grade'";

    }
    $result=mysql_query($query);
    while($row = mysql_fetch_array($result)) {
        $tonnage+=$row['tonnage'];
    }
    return $tonnage;
}

function fromLocWeightGiver($branch,$wp_grade,$month,$as_of) {
    $tonnage=0;
    include("config.php");
    $query="select branch,sum(weight)/1000 as tonnage from outgoing where branch='$branch' and outgoing.wp_grade='$wp_grade' and date like '%$month%'";
    $result=mysql_query($query);
    while($row = mysql_fetch_array($result)) {
        $tonnage+=$row['tonnage'];
    }
    return $tonnage;
}

function interBranchSender($branch,$wp_grade,$month,$as_of) {
    $tonnage=0;
    include("config.php");
    $query="select actual.wp_grade,sum(DISTINCT actual.weight)/1000 as tonnage,outgoing.wp_grade,sum(DISTINCT outgoing.weight)/1000 from actual  left join outgoing on actual.str_no=outgoing.str where outgoing.date like '%$month%' and actual.branch='$branch' and actual.wp_grade='$wp_grade' and outgoing.str  like '%i%' and outgoing.branch='$branch' group by actual.str_no,actual.wp_grade;";
    $result=mysql_query($query);
    while($row = mysql_fetch_array($result)) {
        $tonnage+=$row['tonnage'];
    }
    return $tonnage;
}

function interBranchReceiver($branch,$wp_grade,$month,$as_of) {
    $tonnage=0;
    include("config.php");
    $query="select actual.wp_grade,sum(DISTINCT actual.weight)/1000 as tonnage,outgoing.wp_grade,sum(DISTINCT outgoing.weight)/1000 from actual  left join outgoing on actual.str_no=outgoing.str where outgoing.date like '%$month%' and actual.delivered_to='$branch' and actual.wp_grade='$wp_grade' and outgoing.str  like '%i%' group by actual.str_no,actual.wp_grade;";
    $result=mysql_query($query);
    while($row = mysql_fetch_array($result)) {
        $tonnage+=$row['tonnage'];
    }
    return $tonnage;
}

function intransitLastMonth($branch,$wp_grade,$month,$last_month,$as_of) {
    $tonnage=0;
    include("config.php");
    $query="select actual.wp_grade,sum(DISTINCT actual.weight)/1000 as tonnage,outgoing.wp_grade,sum(DISTINCT outgoing.weight)/1000 from actual  left join outgoing on actual.str_no=outgoing.str where outgoing.date like '%$last_month%' and actual.date  like '%$month%' and actual.branch='$branch' and actual.wp_grade='$wp_grade' and outgoing.str not like '%i%' group by actual.str_no,actual.wp_grade;";
    $result=mysql_query($query);
    while($row = mysql_fetch_array($result)) {
        $tonnage+=$row['tonnage'];
    }
    return $tonnage;
}
function intransitThisMonth($branch,$wp_grade,$month,$next_month) {
    $tonnage=0;
    include("config.php");
    $query="select actual.wp_grade,sum(DISTINCT actual.weight)/1000 as tonnage,outgoing.wp_grade,sum(DISTINCT outgoing.weight)/1000 from actual  left join outgoing on actual.str_no=outgoing.str where outgoing.date like '%$month%' and actual.date  like '%$next_month%'and actual.branch='$branch' and actual.wp_grade='$wp_grade' and outgoing.str not like '%i%' group by actual.str_no,actual.wp_grade;";
    $result=mysql_query($query);
    while($row = mysql_fetch_array($result)) {
        $tonnage+=$row['tonnage'];
    }
    return $tonnage;
}

while($row = mysql_fetch_array($result)) {
    $branch_deliveries[strtoupper($row['branch'])."+".$row['wp_grade']]=$row['weight'];
    array_push($branches,strtoupper($row['branch']));
    array_push($wp_grades,$row['wp_grade']);
}


while($row = mysql_fetch_array($result)) {


}
$wp_grades=array_unique($wp_grades);
$branches=array_unique($branches);
?>

<?php

echo "<table border=1>";
echo "<th>Branch</th>";
foreach($wp_grades as $grade) {
    echo "<th>".$grade."</th>";
}
echo "<th>TOTAL</th>";

$total_deliveries_array=array();
$final_total=array();
foreach($branches as $branch_name) {
    $total_right=0;
    echo "<tr>";
    echo "<td>".$branch_name."</td>";
    foreach($wp_grades as $grade) {
        $from_loc=0;
        $actual=0;
        $intransit_this_month=0;
        $intransit_last_month=0;
        $interbranch_sent=0;
        $interbranch_received=0;
        $from_loc=fromLocWeightGiver($branch_name,$grade,$month);
        $actual=actualWeightGiver($branch_name,$grade,$month);
        $intransit_this_month=intransitThisMonth($branch_name,$grade,$month,$next_month);
        $intransit_last_month=intransitLastMonth($branch_name,$grade,$month,$last_month);
        $interbranch_sent=interBranchSender($branch_name,$grade,$month);
        $interbranch_received=interBranchReceiver($branch_name,$grade,$month);
        echo "<td>".number_format((($actual+$intransit_last_month+$interbranch_sent)-($intransit_this_month+$interbranch_received)),0)."</td>";
        $total_right+=(($actual+$intransit_last_month+$interbranch_sent)-($intransit_this_month+$interbranch_received));
        array_push($total_deliveries_array,$grade."+".(($actual+$intransit_last_month+$interbranch_sent)-($intransit_this_month+$interbranch_received)));
    }
    echo "<td id='total'>".number_format($total_right,0)."</td>";
    echo "</tr>";
}
foreach ($wp_grades as $grade) {
    $tonnage=0;
    foreach($total_deliveries_array as $delivery) {
        $delivery_details=preg_split("/[+]/",$delivery);
        if($delivery_details[0]==$grade) {
            $tonnage+=$delivery_details[1];
        }
    }
    $final_total[$grade]=$tonnage;

}
echo "<tr>";

echo "<td id='total'>TOTAL</td>";
$left_and_right_total=0;
foreach ($wp_grades as $grade) {
    if(!empty ($final_total[$grade])) {
        echo "<td id='total'>".number_format($final_total[$grade],0)."</td>";
        $left_and_right_total+=$final_total[$grade];
    }else {
        echo "<td id='total'>0</td>";
    }

}
echo "<td id='total'>".number_format($left_and_right_total,0)."</td>";
echo "</tr>";

echo "<td id='target'>TARGET</td>";
$total_target=0;

foreach ($wp_grades as $grade) {
    if(!empty ($per_grade_target[$grade])) {
        echo "<td id='target'>".number_format($per_grade_target[$grade],0)."</td>";
        $total_target+=$per_grade_target[$grade];
    }else {
        echo "<td id='target'>0</td>";
    }

}
echo "<td id='target'>".number_format($total_target,0)."</td>";
echo "</tr>";




echo "<td id='percentage'>% to Target</td>";
$total_target=0;

foreach ($wp_grades as $grade) {
    if(!empty ($per_grade_target[$grade])) {
        if(!empty ($final_total[$grade])) {
            $percentage=0;
            $percentage=(($final_total[$grade]/$per_grade_target[$grade])*100);
            echo "<td id='percentage'>".number_format($percentage,0)."%</td>";
        }
    }else {
        echo "<td id='percentage'>0%</td>";
    }

}
echo "<td id='percentage'>".number_format($total_target,0)."</td>";
echo "</tr>";

echo "</table>";


?>