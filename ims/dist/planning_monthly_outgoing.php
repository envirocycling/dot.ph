<?php session_start(); ?>
<link class="include" rel="stylesheet" type="text/css" href="../jquery.jqplot.min.css" />
<link rel="stylesheet" type="text/css" href="examples.min.css" />
<script class="include" type="text/javascript" src="../jquery.min.js"></script>
<style>
    table{
        text-align:right;
    }
    #negative{
        color:red;
    }
    #positive{
        color:green;
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
include("../../config.php");
$branches_array=array();
$month=$_SESSION['planning_month'];
$date=$_SESSION['planning_date'];
$last_month = date('Y/m', strtotime($month."/01"."- 1 months") );

$next_month = date('Y/m', strtotime($month."/01"."+ 1 months") );
$query="SELECT branch from outgoing where branch !='' and date like '%2014/01%' group by branch ";
$result=mysql_query($query);
while($row = mysql_fetch_array($result)) {
    array_push($branches_array,strtoupper($row['branch']));
}
$query="SELECT branch from actual where branch !='' and date like '%$month%' group by branch ";
$result=mysql_query($query);

while($row = mysql_fetch_array($result)) {
    array_push($branches_array,strtoupper($row['branch']));
}


$branches_array=array_unique($branches_array);
mysql_query("UPDATE actual set branch='Kaybiga' where branch='Novaliches'");
function actualWeightGiver($branch,$month) {
    $tonnage=0;
    include("../../config.php");
    if($branch!='PAMPANGA' && $branch!='URDANETA') {
        $query="select actual.wp_grade,sum(DISTINCT actual.weight)/1000 as tonnage,outgoing.wp_grade,sum(DISTINCT outgoing.weight)/1000 from actual  left join outgoing on actual.str_no=outgoing.str where outgoing.date like '%$month%' and actual.branch='$branch' and outgoing.str not like '%i%' and str_no !='' group by actual.str_no,actual.wp_grade ;";
    }else if($branch=='PAMPANGA' ) {
        $query="select SUM(weight)/1000 as tonnage FROM actual where (branch='Pampanga' or branch='PAMPANGA') and date like '%$month%'";

    }else if($branch=='URDANETA') {
        $query="select SUM(weight)/1000 as tonnage FROM actual where (branch='Urdaneta' or branch='URDANETA' or branch='Pangasinan' or branch='PANGASINAN') and date like '%$month%'";

    }
    $result=mysql_query($query);
    while($row = mysql_fetch_array($result)) {
        $tonnage+=$row['tonnage'];
    }
    return $tonnage;
}
function fromLocWeightGiver($branch,$month) {
    $tonnage=0;
    include("../../config.php");
    $query="select branch,sum(weight)/1000 as tonnage from outgoing where branch='$branch' and date like '%$month%'";
    $result=mysql_query($query);
    while($row = mysql_fetch_array($result)) {
        $tonnage+=$row['tonnage'];
    }
    return $tonnage;
}

function interBranchSender($branch,$month) {
    $tonnage=0;
    include("../../config.php");
    $query="select actual.wp_grade,sum(DISTINCT actual.weight)/1000 as tonnage,outgoing.wp_grade,sum(DISTINCT outgoing.weight)/1000 from actual  left join outgoing on actual.str_no=outgoing.str where outgoing.date like '%$month%' and actual.branch='$branch' and outgoing.str  like '%i%' and outgoing.branch='$branch' group by actual.str_no,actual.wp_grade;";
    $result=mysql_query($query);
    while($row = mysql_fetch_array($result)) {
        $tonnage+=$row['tonnage'];
    }
    return $tonnage;
}

function interBranchReceiver($branch,$month) {
    $tonnage=0;
    include("../../config.php");
    $query="select actual.wp_grade,sum(DISTINCT actual.weight)/1000 as tonnage,outgoing.wp_grade,sum(DISTINCT outgoing.weight)/1000 from actual  left join outgoing on actual.str_no=outgoing.str where outgoing.date like '%$month%' and actual.delivered_to='$branch' and outgoing.str  like '%i%' group by actual.str_no,actual.wp_grade;";
    $result=mysql_query($query);
    while($row = mysql_fetch_array($result)) {
        $tonnage+=$row['tonnage'];
    }
    return $tonnage;
}

function intransitLastMonth($branch,$month,$last_month) {
    $tonnage=0;
    include("../../config.php");

    $query="select actual.wp_grade,sum(DISTINCT actual.weight)/1000 as tonnage,outgoing.wp_grade,sum(DISTINCT outgoing.weight)/1000 from actual  left join outgoing on actual.str_no=outgoing.str where outgoing.date like '%$last_month%' and actual.date  like '%$month%'and actual.branch='$branch' and outgoing.str not like '%i%' group by actual.str_no,actual.wp_grade;";
    $result=mysql_query($query);
    while($row = mysql_fetch_array($result)) {
        $tonnage+=$row['tonnage'];
    }

    return $tonnage;
}
function intransitThisMonth($branch,$month,$next_month) {
    $tonnage=0;
    include("../../config.php");
    $query="select actual.wp_grade,sum(DISTINCT actual.weight)/1000 as tonnage,outgoing.wp_grade,sum(DISTINCT outgoing.weight)/1000 from actual  left join outgoing on actual.str_no=outgoing.str where outgoing.date like '%$month%' and actual.date  like '%$next_month%' and actual.branch='$branch' and outgoing.str not like '%i%' group by actual.str_no,actual.wp_grade;";
    $result=mysql_query($query);
    while($row = mysql_fetch_array($result)) {
        $tonnage+=$row['tonnage'];
    }
    return $tonnage;
}


$actual_all_branch=array();
?>

<div id="chart1" style=""></div>
<script class="code" type="text/javascript">
    $(document).ready(function(){
        var s1 = [

<?php
foreach($branches_array as $branch_name) {
    echo fromLocWeightGiver($branch_name,$month).",";
}

?>


        ];
        var s2 = [<?php
foreach($branches_array as $branch_name) {
    $intransit_this_month=intransitThisMonth($branch_name,$month,$next_month);
    $intransit_last_month=intransitLastMonth($branch_name,$month,$last_month);
    $interbranch_sent=interBranchSender($branch_name,$month);
    $actual=actualWeightGiver($branch_name,$month);
    $interbranch_received=interBranchReceiver($branch_name,$month);
    echo  (($actual+$intransit_last_month+$interbranch_sent)-($intransit_this_month+$interbranch_received)).",";
    $actual_all_branch[$branch_name]=(($actual+$intransit_last_month+$interbranch_sent)-($intransit_this_month+$interbranch_received));
}

?>
        ];
        var s3 = [
<?php
foreach($branches_array as $branch_name) {
    echo ($actual_all_branch[$branch_name]- fromLocWeightGiver($branch_name,$month)).",";
}

?>
        ];
        var ticks = [
<?php
foreach($branches_array as $branch_name) {
    echo "'".$branch_name."'".",";
}
?>
        ];
        var plot1 = $.jqplot('chart1', [s1, s2, s3], {
            // The "seriesDefaults" option is an options object that will
            // be applied to all series in the chart.
            seriesDefaults:{
                renderer:$.jqplot.BarRenderer,
                rendererOptions: {fillToZero: true},    
                pointLabels: { show: true }
            },
            // Custom labels for the series are specified with the "label"
            // option on the series option.  Here a series option object
            // is specified for each series.
            series:[
                {label:'From Location Weight'},
                {label:'Actual Weight on Destination'},
                {label:'Variance'}
            ],
            // Show the legend and put it outside the grid, but inside the
            // plot container, shrinking the grid to accomodate the legend.
            // A value of "outside" would not shrink the grid and allow
            // the legend to overflow the container.
            legend: {
                show: true,
                placement: 'outsideGrid'
            },
            axes: {
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
<hr>
Computation
<hr>
<table border="1">
    <th>Branch</th>
    <th>From Location Weight</th>
    <th>Destination Net Weight</th>
    <th>Intransit This Month(-)</th>
    <th>Intransit Last Month(+)</th>
    <th>InterBranch Received(-)</th>
    <th>InterBranch Sent(+)</th>
    <th>Corrected Weight</th>
    <th>Variance</th>
    <?php

    foreach($branches_array as $branch_name) {
        echo "<tr>";
        $from_loc=fromLocWeightGiver($branch_name,$month);
        echo "<td>".$branch_name."</td>";
        echo "<td>".number_format($from_loc,2)."</td>";
        $actual=actualWeightGiver($branch_name,$month);
        echo "<td>".number_format($actual,2)."</td>";
        $intransit_this_month=intransitThisMonth($branch_name,$month,$next_month);
        $intransit_last_month=intransitLastMonth($branch_name,$month,$last_month);


        $interbranch_sent=interBranchSender($branch_name,$month);
        $interbranch_received=interBranchReceiver($branch_name,$month);
        echo "<td id='negative'>(".number_format(($intransit_this_month),2).")</td>";
        echo "<td>".number_format(($intransit_last_month),2)."</td>";
        echo "<td id='negative'>(".number_format(($interbranch_received),2).")</td>";
        echo "<td>".number_format(($interbranch_sent),2)."</td>";


        echo "<td>".number_format((($actual+$intransit_last_month+$interbranch_sent)-($intransit_this_month+$interbranch_received)),2)."</td>";
        $variance=($actual+$intransit_last_month+$interbranch_sent)-($intransit_this_month+$interbranch_received)-$from_loc;
        if($variance<0) {
            $variance=$variance*-1;
            echo "<td id='negative'>(".number_format($variance,2).")</td>";

        }else {
            echo "<td id='positive'>".number_format($variance,2)."</td>";
        }


        echo "</tr>";
    }


    ?>


</table>





