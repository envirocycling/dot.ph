<?php
session_start();

?>
<style>
    #body{
        margin-left:0px;
    }
    td,th{
        text-align:right;
        border-style: hidden;
        border-right:solid;
        border-bottom:solid;
        border-width:1px;
    }
</style>


<div id="body">
    <?php
    $month=$_SESSION['planning_month'];
    $date=$_SESSION['planning_date'];
    $as_of=$_SESSION['planning_as_of'];
    $last_month = date('Y/m', strtotime($month."/01"."- 1 months") );

    $next_month = date('Y/m', strtotime($month."/01"."+ 1 months") );
    include("../../config.php");
    $branches_array=array();

    $query="SELECT branch from outgoing where branch !='' and date like '%$month%' and date <='$as_of' and date group by branch ";
    $result=mysql_query($query);

    while($row = mysql_fetch_array($result)) {
        array_push($branches_array,strtoupper($row['branch']));
    }

    $query="SELECT branch from actual where branch !='' and date like '%$month%' and date <='$as_of' group by branch ";
    $result=mysql_query($query);

    while($row = mysql_fetch_array($result)) {
        array_push($branches_array,strtoupper($row['branch']));
    }

    $branches_array=array_unique($branches_array);
    function actualWeightGiver($branch,$month,$as_of) {
        $tonnage=0;
        include("../../config.php");
        if($branch!='PAMPANGA' && $branch!='URDANETA') {
            $query="select actual.wp_grade,sum(DISTINCT actual.weight)/1000 as tonnage,outgoing.wp_grade,sum(DISTINCT outgoing.weight)/1000 from actual  left join outgoing on actual.str_no=outgoing.str where outgoing.date like '%$month%'  and outgoing.date <='$as_of' and actual.branch='$branch' and outgoing.str not like '%i%' and str_no !='' group by actual.str_no,actual.wp_grade ;";
        }else if($branch=='PAMPANGA' ) {
            $query="select SUM(weight)/1000 as tonnage FROM actual where (branch='Pampanga' or branch='PAMPANGA') and date like '%$month%' and date <='$as_of'";

        }else if($branch=='URDANETA') {
            $query="select SUM(weight)/1000 as tonnage FROM actual where (branch='Urdaneta' or branch='URDANETA' or branch='Pangasinan' or branch='PANGASINAN') and date like '%$month%' and date <='$as_of'";

        }
        $result=mysql_query($query);
        while($row = mysql_fetch_array($result)) {
            $tonnage+=$row['tonnage'];
        }
        return $tonnage;
    }

    function fromLocWeightGiver($branch,$month,$as_of) {
        $tonnage=0;
        include("../../config.php");
        $query="select branch,sum(weight)/1000 as tonnage from outgoing where branch='$branch' and date like '%$month%' and date <='$as_of'";
        $result=mysql_query($query);
        while($row = mysql_fetch_array($result)) {
            $tonnage+=$row['tonnage'];
        }
        return $tonnage;
    }

    function interBranchSender($branch,$month,$as_of) {
        $tonnage=0;
        include("../../config.php");
        $query="select actual.wp_grade,sum(DISTINCT actual.weight)/1000 as tonnage,outgoing.wp_grade,sum(DISTINCT outgoing.weight)/1000 from actual  left join outgoing on actual.str_no=outgoing.str where outgoing.date like '%$month%' and outgoing.date <='$as_of' and actual.branch='$branch' and outgoing.str  like '%i%' and outgoing.branch='$branch' group by actual.str_no,actual.wp_grade;";
        $result=mysql_query($query);
        while($row = mysql_fetch_array($result)) {
            $tonnage+=$row['tonnage'];
        }
        return $tonnage;
    }

    function interBranchReceiver($branch,$month,$as_of) {
        $tonnage=0;
        include("../../config.php");
        $query="select actual.wp_grade,sum(DISTINCT actual.weight)/1000 as tonnage,outgoing.wp_grade,sum(DISTINCT outgoing.weight)/1000 from actual  left join outgoing on actual.str_no=outgoing.str where outgoing.date like '%$month%' and outgoing.date <='$as_of' and actual.delivered_to='$branch' and outgoing.str  like '%i%' group by actual.str_no,actual.wp_grade;";
        $result=mysql_query($query);
        while($row = mysql_fetch_array($result)) {
            $tonnage+=$row['tonnage'];
        }
        return $tonnage;
    }

    function intransitLastMonth($branch,$month,$last_month,$as_of) {
        $tonnage=0;
        include("../../config.php");

        $query="select actual.wp_grade,sum(DISTINCT actual.weight)/1000 as tonnage,outgoing.wp_grade,sum(DISTINCT outgoing.weight)/1000 from actual  left join outgoing on actual.str_no=outgoing.str where outgoing.date like '%$last_month%' and actual.date  like '%$month%' and actual.date <='$as_of' and actual.branch='$branch' and outgoing.str not like '%i%' group by actual.str_no,actual.wp_grade;";
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

    foreach($branches_array as $branch_name) {

        $from_loc=fromLocWeightGiver($branch_name,$month,$as_of);
        $actual=actualWeightGiver($branch_name,$month,$as_of);

        $intransit_this_month=intransitThisMonth($branch_name,$month,$next_month);
        $intransit_last_month=intransitLastMonth($branch_name,$month,$last_month,$as_of);


        $interbranch_sent=interBranchSender($branch_name,$month,$as_of);
        $interbranch_received=interBranchReceiver($branch_name,$month,$as_of);

        $actual_all_branch[$branch_name]=(($actual+$intransit_last_month+$interbranch_sent)-($intransit_this_month+$interbranch_received));

    }





    ?>


    <link class="include" rel="stylesheet" type="text/css" href="../jquery.jqplot.min.css" />
    <link rel="stylesheet" type="text/css" href="examples.min.css" />
    <link type="text/css" rel="stylesheet" href="syntaxhighlighter/styles/shCoreDefault.min.css" />
    <link type="text/css" rel="stylesheet" href="syntaxhighlighter/styles/shThemejqPlot.min.css" />

    <!--[if lt IE 9]><script language="javascript" type="text/javascript" src="../excanvas.js"></script><![endif]-->
    <script class="include" type="text/javascript" src="../jquery.min.js"></script>


    <div class="example-content">

        <div id="pie1" style="margin-top:20px; margin-left:20px; width:400px; height:400px;"></div>






        <script class="code" type="text/javascript">$(document).ready(function(){
            var plot1 = $.jqplot('pie1', [
                [<?php 


foreach($branches_array as $branch) {

    echo "['".$branch."'," .$actual_all_branch[$branch] ."],";


}

?>]], {


            gridPadding: {top:0, bottom:38, left:0, right:0},
            seriesDefaults:{
                renderer:$.jqplot.PieRenderer,
                trendline:{ show:false },
                rendererOptions: { padding: 8, showDataLabels: true }
            },
            legend:{
                show:true,
                placement: 'outside',
                rendererOptions: {
                    numberRows: 1
                },
                location:'s',
                marginTop: '15px'
            }
        });
    });</script>


        <script class="include" type="text/javascript" src="../jquery.jqplot.min.js"></script>
        <script type="text/javascript" src="syntaxhighlighter/scripts/shCore.min.js"></script>
        <script type="text/javascript" src="syntaxhighlighter/scripts/shBrushJScript.min.js"></script>
        <script type="text/javascript" src="syntaxhighlighter/scripts/shBrushXml.min.js"></script>
        <!-- End Don't touch this! -->

        <!-- Additional plugins go here -->

        <script class="include" type="text/javascript" src="../plugins/jqplot.pieRenderer.min.js"></script>

        <!-- End additional plugins -->
        <hr>

        <table border="1" id="table">
            <th>Branch</th>

            <th>Destination Net Weight</th>

            <?php

            foreach($branches_array as $branch) {
                echo "<tr>";
                echo "<td>$branch</td>";

                echo "<td>".number_format($actual_all_branch[$branch],2)."</td>";
                echo "</tr>";

            }


            ?>


        </table>







