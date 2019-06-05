<style>
    table{
        text-align:right;
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
$query="SELECT branch,sum(weight)/1000 as weight,wp_grade from actual where branch !='' and date like '%$month%' group by branch,wp_grade ";
$result=mysql_query($query);

$last_month = date('Y/m', strtotime($month."/01"."- 1 months") );
$next_month = date('Y/m', strtotime($month."/01"."+ 1 months") );


function actualWeightGiver($branch,$wp_grade,$month) {
    $tonnage=0;
    include("config.php");
    $query="select actual.wp_grade,sum(DISTINCT actual.weight)/1000 as tonnage,outgoing.wp_grade,sum(DISTINCT outgoing.weight)/1000 from actual  left join outgoing on actual.str_no=outgoing.str where outgoing.date like '%$month%' and actual.branch='$branch' and outgoing.str not like '%i%' and actual.wp_grade='$wp_grade' group by actual.str_no,actual.wp_grade;";
    $result=mysql_query($query);
    while($row = mysql_fetch_array($result)) {
        $tonnage+=$row['tonnage'];
    }
    return $tonnage;
}

function fromLocWeightGiver($branch,$wp_grade,$month) {
    $tonnage=0;
    include("config.php");
    $query="select branch,sum(weight)/1000 as tonnage from outgoing where branch='$branch' and outgoing.wp_grade='$wp_grade' and date like '%$month%'";
    $result=mysql_query($query);
    while($row = mysql_fetch_array($result)) {
        $tonnage+=$row['tonnage'];
    }
    return $tonnage;
}

function interBranchSender($branch,$wp_grade,$month) {
    $tonnage=0;
    include("config.php");
    $query="select actual.wp_grade,sum(DISTINCT actual.weight)/1000 as tonnage,outgoing.wp_grade,sum(DISTINCT outgoing.weight)/1000 from actual  left join outgoing on actual.str_no=outgoing.str where outgoing.date like '%$month%' and actual.branch='$branch' and actual.wp_grade='$wp_grade' and outgoing.str  like '%i%' and outgoing.branch='$branch' group by actual.str_no,actual.wp_grade;";
    $result=mysql_query($query);
    while($row = mysql_fetch_array($result)) {
        $tonnage+=$row['tonnage'];
    }
    return $tonnage;
}

function interBranchReceiver($branch,$wp_grade,$month) {
    $tonnage=0;
    include("config.php");
    $query="select actual.wp_grade,sum(DISTINCT actual.weight)/1000 as tonnage,outgoing.wp_grade,sum(DISTINCT outgoing.weight)/1000 from actual  left join outgoing on actual.str_no=outgoing.str where outgoing.date like '%$month%' and actual.delivered_to='$branch' and actual.wp_grade='$wp_grade' and outgoing.str  like '%i%' group by actual.str_no,actual.wp_grade;";
    $result=mysql_query($query);
    while($row = mysql_fetch_array($result)) {
        $tonnage+=$row['tonnage'];
    }
    return $tonnage;
}

function intransitLastMonth($branch,$wp_grade,$month,$last_month) {
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
$wp_grades=array_unique($wp_grades);
$branches=array_unique($branches);
?>

<?php

echo "<table border=1>";
echo "<th>Branch</th>";
foreach($wp_grades as $grade) {
    echo "<th>".$grade."</th>";
}

foreach($branches as $branch_name) {
    echo "<tr>";
    echo "<td>".$branch_name."</td>";
    foreach($wp_grades as $grade) {
        $from_loc=fromLocWeightGiver($branch_name,$grade,$month);
        $actual=actualWeightGiver($branch_name,$grade,$month);

        $intransit_this_month=intransitThisMonth($branch_name,$grade,$month,$next_month);
        $intransit_last_month=intransitLastMonth($branch_name,$grade,$month,$last_month);


        $interbranch_sent=interBranchSender($branch_name,$grade,$month);
        $interbranch_received=interBranchReceiver($branch_name,$grade,$month);

        echo "<td>".number_format((($actual+$intransit_last_month+$interbranch_sent)-($intransit_this_month+$interbranch_received)),2)."</td>";
    }
    echo "</tr>";
}

echo "</table>";


?>