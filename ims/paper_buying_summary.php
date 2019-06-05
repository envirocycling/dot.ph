<?php
include("templates/template.php");
?>
<style>
    table{
        font-size:10px;
    }
    .total{
        background-color: yellow;
        font-weight: bold;
    }
    .avg{
        background-color: orange;
        font-weight: bold;
    }
    th{
        width:500px;
    }
    #totalFooter{
        background-color: yellow;
        font-weight: bold;
    }
</style>
<?php include("config.php");
$wp_array=array();
$supplier_array=array();
$deliveries_per_month=array();
$total_quota=0;
$total_perf=0;
?>

<style>

    th{
        font-size: 12px;
        background-color:gray;
        color:white;
        padding:5px;
    }
    button{
        border-style:hidden;
        background-color:transparent;
        font-size: 11px;
    }
    #weekly{
        background-color:#FFE6B2;
    }
    #TARGET{
        background-color:#FFEBC2;
        font-weight:bold;
    }
    #percentage{
        background-color:#FFF0D1;

    }
    td{
        font-size:11px;
        text-align:right;
        padding: 5px;
    }
    #left_header{
        background-color:#FFFAF0;
        font-size: 10px;
        text-align:left;
    }
    #view_brkdwn{
        font-size: 11px;
    }
    #static_size{
        width:200px;
        height:50px;

    }
    #price{
        background-color:#EBE0CC;
    }
    #branch{
        color:blue;
    }
    #branch_name{
        text-align:left;
    }
    #label{
        text-align:left;
    }
    .hidden{
        width: 10px;
    }
    #label2{
        background-color: #fff5e0;
    }
    .lcwlwithplus{
        background-color: #FFCC66;
        font-weight: bold;
    }
</style>
<script>
    function openWindow(str) {
        var x = screen.width / 2 - 700 / 2;
        var y = screen.height / 2 - 450 / 2;
        window.open("view_paper_buying.php?details=" + str, 'mywindow', 'width=1000,height=650');
    }
</script>

<?php
$ngayon=date('F d, Y');
$start_date=$_POST['start_date'];
$breaker_date=$_POST['end_date'];
$is_quota=$_POST['is_quota'];
$filtering_branch=$_POST['branch'];
$weekly_month=date("F", strtotime($breaker_date));
$weekly_year=date("Y", strtotime($breaker_date));

?>

<?php if($filtering_branch =='') {  ?>

    <?php
    include("config.php");

    $sql = mysql_query("SELECT * FROM paper_buying WHERE date_received>='$start_date' and date_received<='$breaker_date' ");
    while($rs = mysql_fetch_array($sql)) {
        $unit_cost = $rs['unit_cost'];
        $unit_cost = number_format($unit_cost,2);
        mysql_query("UPDATE paper_buying SET unit_cost='$unit_cost' WHERE log_id='".$rs['log_id']."'");
    }

    $pricing_details_array=array();
    $filtering_grade_array=array("LCWL","ONP","CBS","OCC","MW","CHIPBOARD");
    $branch_array=array();
    $grade_array=array("LCWL","ONP","CBS","OCC","MW","CHIPBOARD");
    $price_array=array();
    $query2="SELECT * from branches";
    $result2=mysql_query($query2);
    $total_array=array();
    $weighted_avg = array();
    $weighted_avg_10plus = array();
    $total_w_avg = 0;
    $total_w_avg_10plus = 0;
    while($row2 = mysql_fetch_array($result2)) {
        $filtering_branch=$row2['branch_name'];
        array_push($branch_array,$filtering_branch);
        foreach($filtering_grade_array as $filtering_grade) {
            $unit_cost_array=array();
            $tonnage_on_cost_array=array();
            if($is_quota=='with quota only') {
                $query="SELECT (unit_cost) as unit_cost,sum(corrected_weight),quota FROM paper_buying join incentive_scheme on paper_buying.supplier_id=incentive_scheme.sup_id where paper_buying.wp_grade like '$filtering_grade%' and date_received >='$start_date' and date_received <='$breaker_date'  and unit_cost >0 and  branch like '%$filtering_branch%'  group by unit_cost order by sum(corrected_weight) desc, unit_cost asc";
            }else if($is_quota=='all') {
                if ($filtering_grade=="LCWL") {
                    $query="SELECT (unit_cost) as unit_cost,sum(corrected_weight) FROM paper_buying where paper_buying.wp_grade like '%$filtering_grade%' and  branch like '%$filtering_branch%' and date_received >='$start_date' and date_received <='$breaker_date'  and unit_cost >0  group by unit_cost order by sum(corrected_weight) desc, unit_cost asc";
                } else if ($filtering_grade=="ONP") {
                    $query="SELECT (unit_cost) as unit_cost,sum(corrected_weight) FROM paper_buying where (paper_buying.wp_grade like '%$filtering_grade%' or paper_buying.wp_grade='NPB' or paper_buying.wp_grade='OPD' or paper_buying.wp_grade='OIN') and  branch like '%$filtering_branch%' and date_received >='$start_date' and date_received <='$breaker_date'  and unit_cost >0  group by unit_cost order by sum(corrected_weight) desc, unit_cost asc";
                } else if ($filtering_grade=="MW") {
                    $query="SELECT (unit_cost) as unit_cost,sum(corrected_weight) FROM paper_buying where (paper_buying.wp_grade like '%$filtering_grade%' or paper_buying.wp_grade='CORETUBE' or paper_buying.wp_grade='CT') and  branch like '%$filtering_branch%' and date_received >='$start_date' and date_received <='$breaker_date'  and unit_cost >0  group by unit_cost order by sum(corrected_weight) desc, unit_cost asc";
                } else if ($filtering_grade=="CHIPBOARD") {
                    $query="SELECT (unit_cost) as unit_cost,sum(corrected_weight) FROM paper_buying where (paper_buying.wp_grade like '%$filtering_grade%' or paper_buying.wp_grade='CB') and  branch like '%$filtering_branch%' and date_received >='$start_date' and date_received <='$breaker_date'  and unit_cost >0  group by unit_cost order by sum(corrected_weight) desc, unit_cost asc";
                } else {
                    $query="SELECT (unit_cost) as unit_cost,sum(corrected_weight) FROM paper_buying where paper_buying.wp_grade like '$filtering_grade%' and  branch like '%$filtering_branch%' and date_received >='$start_date' and date_received <='$breaker_date'  and unit_cost >0  group by unit_cost order by sum(corrected_weight) desc, unit_cost asc";
                }
            }else if($is_quota=='without quota only') {
                $query="SELECT (unit_cost) as unit_cost,sum(corrected_weight),quota FROM paper_buying left join incentive_scheme on paper_buying.supplier_id=incentive_scheme.sup_id where paper_buying.wp_grade like '$filtering_grade%' and date_received >='$start_date' and date_received <='$breaker_date'  and unit_cost >0 and  branch like '%$filtering_branch%' and quota is null group by unit_cost order by sum(corrected_weight) desc, unit_cost asc";
            }
            $result=mysql_query($query);
            while($row = mysql_fetch_array($result)) {
                $unit_cost=trim($row['unit_cost']);
                if($is_quota=='with quota only') {
                    if($row['quota']>0) {
                        array_push($tonnage_on_cost_array,$unit_cost."-".$row['sum(corrected_weight)']);
                        array_push($unit_cost_array,$unit_cost);
                    }
                }else  if($is_quota=='without quota only') {
                    $null_checker= $row['quota'];
                    array_push($tonnage_on_cost_array,$unit_cost."-".$row['sum(corrected_weight)']);
                    array_push($unit_cost_array,$unit_cost);
                }else if($is_quota=='all') {
                    array_push($tonnage_on_cost_array,$unit_cost."-".$row['sum(corrected_weight)']);
                    array_push($unit_cost_array,$unit_cost);
                }
            }
            $unit_cost_array=array_unique($unit_cost_array);
            $total_tonnage=0;
            foreach($unit_cost_array as $cost) {
                $tonnage=0;
                foreach($tonnage_on_cost_array as $value) {
                    $tonnage_details=preg_split("[-]",$value);
                    if($cost==$tonnage_details[0]) {
                        $tonnage += ($tonnage_details[1]/1000);
                    }
                }
                $total_tonnage+=$tonnage;
                $pricing_details_array[$filtering_branch."-".$filtering_grade."-".$cost]=$tonnage;
                array_push($price_array,$filtering_grade."-".$cost);

            }


            $total_array[$filtering_branch."-".$filtering_grade]=$total_tonnage;
            ?>
            <?php
        }
    }


////////////////////////////////////////////////////////////////////////////////////

    $price_array=(array_unique($price_array));
    rsort($price_array);

    foreach($grade_array as $wp_grade) {
        $ctr=0;
        echo '<div class="grid_10" >
    <div class="box round first grid">';
        echo "<h2>Paper Buying Summary of ";
        if ($_POST['branch'] == '') {
            echo "All Branches in ";
        } else {
            echo $_POST['branch']." in ";
        }

        echo $wp_grade;

        echo " from $start_date to $breaker_date</h2>";
        echo "<br>";
//        echo "<h3>$wp_grade</h3>";
        echo "<table>";
        echo "<thead>";
        echo "<th width='150'>Price</th>";
        $cost_this_grade=array();

        foreach($branch_array as $val) {
            echo "<th>".$val."</th>";
        }

        foreach($price_array as $price) {
            $price_details=preg_split("[-]",$price);
            if($price_details[0]==$wp_grade) {
                array_push($cost_this_grade,$price_details[1]);
            }
        }
        echo "<th>TOTAL</th>";
        echo "</thead>";

        echo "<tr>";
        echo "<td class='TOTAL' id='label'>TOTAL</td>";
        $pricing_details_array[$filtering_branch."-".$filtering_grade."-".$cost]=$tonnage;
        $xandyTOTAL=0;
        foreach ($branch_array as $branch_name) {
            if(!empty($total_array[$branch_name."-".$wp_grade])) {
                echo "<td class='TOTAL'>".number_format($total_array[$branch_name."-".$wp_grade],2)."</td>";
                $xandyTOTAL+=$total_array[$branch_name."-".$wp_grade];
            }else {
                echo "<td class='TOTAL'>-</td>";
            }
        }
        echo "<td class='TOTAL' >".number_format($xandyTOTAL,2)."</td>";
        echo "</tr>";


        $total_this_branch=0;
        $total_10plus = array();
        sort($cost_this_grade);
        foreach($branch_array as $branch) {
            $weighted_avg[$branch]=0;
            $total_10plus[$branch]=0;
            $weighted_avg_10plus[$branch]=0;
        }
        foreach ($cost_this_grade as $cost_this_grade_element) {
            foreach($branch_array as $branch) {
                $key=$branch."-".$wp_grade."-".$cost_this_grade_element;
                if (!empty ($pricing_details_array[$key])) {
                    if ($wp_grade=='LCWL' && $cost_this_grade_element>=10.90) {
                        $total_10plus[$branch]+=$pricing_details_array[$key];
                        $weighted_avg_10plus[$branch]+=$cost_this_grade_element*$pricing_details_array[$key];
                    }else if ($wp_grade=='ONP' && $cost_this_grade_element>=6.50) {
                        $total_onp_6plus[$branch]+=$pricing_details_array[$key];
                        //$branch.'='.$total_onp_6plus[$branch].'<br>';
                        $weighted_avg_onp_6plus[$branch]+=$cost_this_grade_element*$pricing_details_array[$key];
                    }else if ($wp_grade=='MW' && $cost_this_grade_element>=3.50) {
                        $total_mw_6plus[$branch]+=$pricing_details_array[$key];
                        $weighted_avg_mw_6plus[$branch]+=$cost_this_grade_element*$pricing_details_array[$key];
                    }else if ($wp_grade=='OCC' && $cost_this_grade_element>=5) {
                        $total_occ_6plus[$branch]+=$pricing_details_array[$key];
                        $weighted_avg_occ_6plus[$branch]+=$cost_this_grade_element*$pricing_details_array[$key];
                    }else if ($wp_grade=='CBS' && $cost_this_grade_element>=5.50) {
                        $total_cbs_6plus[$branch]+=$pricing_details_array[$key];
                        $weighted_avg_cbs_6plus[$branch]+=$cost_this_grade_element*$pricing_details_array[$key];
                    }
                    if ($wp_grade=='LCWL' && $cost_this_grade_element <= 11) {
                        $cost101 = $cost_this_grade_element + 1.5;
                    } else {
                        $cost101 = $cost_this_grade_element;
                    }
                    $weighted_avg[$branch]+=$cost101*$pricing_details_array[$key];
                }
            }
        }

        echo "<tr>";
        echo "<td class='avg' id='label'>Weighted-Avg(Tot)</td>";
        $pricing_details_array[$filtering_branch."-".$filtering_grade."-".$cost]=$tonnage;
        foreach($branch_array as $branch) {
            if (!empty ($weighted_avg[$branch])) {
                $total_w_avg+=($total_array[$branch."-".$wp_grade]*$weighted_avg[$branch]/$total_array[$branch."-".$wp_grade])*1000;
                echo "<td class='avg'>".round($weighted_avg[$branch]/$total_array[$branch."-".$wp_grade],2)."<br>
</td>";
            } else {
                echo "<td class='avg'>-</td>";
            }
        }
        echo "<td class='TOTAL'>".round($total_w_avg/($xandyTOTAL*1000),2)."</td>";
        echo "</tr>";
//rjrjrjrjrj
       /* if ($wp_grade=='LCWL') {
            echo "<tr>";
            echo "<td class='lcwlwithplus' id='label'>Weighted-Avg(10.90+)</td>";
            $pricing_details_array[$filtering_branch."-".$filtering_grade."-".$cost]=$tonnage;
            $xandyTOTAL=0;
            foreach($branch_array as $branch) {
                if (!empty ($weighted_avg_10plus[$branch])) {
                    $total_w_avg_10plus+=($total_array[$branch."-".$wp_grade]*$weighted_avg_10plus[$branch]/$total_10plus[$branch])*1000;
                    echo "<td class='lcwlwithplus'>".round($weighted_avg_10plus[$branch]/$total_10plus[$branch],2)."</td>";
                    $xandyTOTAL+=$total_10plus[$branch];
                } else {
                    echo "<td class='lcwlwithplus'>-</td>";
                }
            }

            echo "<td class='TOTAL'>".round($total_w_avg_10plus/($xandyTOTAL*1000),2)."</td>";
            echo "</tr>";
        }
//rjrjrjrjrj
        if ($wp_grade=='ONP') {
            echo "<tr>";
            echo "<td class='lcwlwithplus' id='label'>Weighted-Avg(6.50+)</td>";
            $pricing_details_array[$filtering_branch."-".$filtering_grade."-".$cost]=$tonnage;
            $xandyTOTAL=0;
            foreach($branch_array as $branch) {
                if (!empty ($weighted_avg_onp_6plus[$branch])) {
                    $total_w_avg_10plus+=($total_array[$branch."-".$wp_grade]*$weighted_avg_onp_6plus[$branch]/$total_onp_6plus[$branch])*1000;
                    echo "<td class='lcwlwithplus'>".round($weighted_avg_onp_6plus[$branch]/$total_onp_6plus[$branch],2)."</td>";
                    $xandyTOTAL+=$total_10plus[$branch];
                } else {
                    echo "<td class='lcwlwithplus'>-</td>";
                }
            }

            echo "<td class='TOTAL'>".round($total_w_avg_10plus/($xandyTOTAL*1000),2)."</td>";
            echo "</tr>";
        }
        //rjrjrjrjrj
        if ($wp_grade=='MW') {
            echo "<tr>";
            echo "<td class='lcwlwithplus' id='label'>Weighted-Avg(3.50+)</td>";
            $pricing_details_array[$filtering_branch."-".$filtering_grade."-".$cost]=$tonnage;
            $xandyTOTAL=0;
            foreach($branch_array as $branch) {
                if (!empty ($weighted_avg_mw_6plus[$branch])) {
                    $total_w_avg_10plus+=($total_array[$branch."-".$wp_grade]*$weighted_avg_mw_6plus[$branch]/$total_mw_6plus[$branch])*1000;
                    echo "<td class='lcwlwithplus'>".round($weighted_avg_mw_6plus[$branch]/$total_mw_6plus[$branch],2)."</td>";
                    $xandyTOTAL+=$total_10plus[$branch];
                } else {
                    echo "<td class='lcwlwithplus'>-</td>";
                }
            }

            echo "<td class='TOTAL'>".round($total_w_avg_10plus/($xandyTOTAL*1000),2)."</td>";
            echo "</tr>";
        }//rjrjrjrjrj
        if ($wp_grade=='OCC') {
            echo "<tr>";
            echo "<td class='lcwlwithplus' id='label'>Weighted-Avg(5+)</td>";
            $pricing_details_array[$filtering_branch."-".$filtering_grade."-".$cost]=$tonnage;
            $xandyTOTAL=0;
            foreach($branch_array as $branch) {
                if (!empty ($weighted_avg_occ_6plus[$branch])) {
                    $total_w_avg_10plus+=($total_array[$branch."-".$wp_grade]*$weighted_avg_occ_6plus[$branch]/$total_occ_6plus[$branch])*1000;
                    echo "<td class='lcwlwithplus'>".round($weighted_avg_occ_6plus[$branch]/$total_occ_6plus[$branch],2)."</td>";
                    $xandyTOTAL+=$total_10plus[$branch];
                } else {
                    echo "<td class='lcwlwithplus'>-</td>";
                }
            }

            echo "<td class='TOTAL'>".round($total_w_avg_10plus/($xandyTOTAL*1000),2)."</td>";
            echo "</tr>";
        }//rjrjrjrjrj
        if ($wp_grade=='CBS') {
            echo "<tr>";
            echo "<td class='lcwlwithplus' id='label'>Weighted-Avg(5.5+)</td>";
            $pricing_details_array[$filtering_branch."-".$filtering_grade."-".$cost]=$tonnage;
            $xandyTOTAL=0;
            foreach($branch_array as $branch) {
                if (!empty ($weighted_avg_cbs_6plus[$branch])) {
                    $total_w_avg_10plus+=($total_array[$branch."-".$wp_grade]*$weighted_avg_cbs_6plus[$branch]/$total_cbs_6plus[$branch])*1000;
                    echo "<td class='lcwlwithplus'>".round($weighted_avg_cbs_6plus[$branch]/$total_cbs_6plus[$branch],2)."</td>";
                    $xandyTOTAL+=$total_10plus[$branch];
                } else {
                    echo "<td class='lcwlwithplus'>-</td>";
                }
            }

            echo "<td class='TOTAL'>".round($total_w_avg_10plus/($xandyTOTAL*1000),2)."</td>";
            echo "</tr>";
        }
        */

        foreach ($cost_this_grade as $cost_this_grade_element) {
            echo "<tr>";
            echo "<td id='branch_name'><b>".number_format($cost_this_grade_element,2)."<b></td>";
            $total=0;
            foreach($branch_array as $branch) {
                $key=$branch."-".$wp_grade."-".$cost_this_grade_element;
                if (!empty ($pricing_details_array[$key])) {
                    echo "<td id='".$cost_this_grade_element."_".$branch."_".$start_date."_".$breaker_date."_".$wp_grade."' onclick='openWindow(this.id);' title='Click to View Details'><font style='font-size:11; font-weight:bold'>".number_format($pricing_details_array[$key],2)."</font></td>";
                    $total+=$pricing_details_array[$key];
                } else {
                    echo "<td>-</td>";
                }
            }
            echo "<td class='TOTAL'>".number_format($total,2)."</td>";
            echo "</tr>";
            $ctr++;
        }

        echo "<tr>";
        echo "<td class='TOTAL' id='label'>TOTAL w/o Pamp</td>";
        $pricing_details_array[$filtering_branch."-".$filtering_grade."-".$cost]=$tonnage;
        $xandyTOTAL=0;
        foreach ($branch_array as $branch_name) {
            if(!empty($total_array[$branch_name."-".$wp_grade])) {
                if ($branch_name == 'Pampanga') {
                    echo "<td class='TOTAL'>-</td>";
                } else {
                    echo "<td class='TOTAL'>".number_format($total_array[$branch_name."-".$wp_grade],2)."</td>";
                    $xandyTOTAL+=$total_array[$branch_name."-".$wp_grade];
                }
            }else {
                echo "<td class='TOTAL'>-</td>";
            }
        }
        echo "<td class='TOTAL' >".number_format($xandyTOTAL,2)."</td>";
        echo "</tr>";

       /* if ($wp_grade=='LCWL') {
            echo "<tr>";
            echo "<td class='lcwlwithplus' id='label'>Weighted-Avg(10.90+)</td>";
            $pricing_details_array[$filtering_branch."-".$filtering_grade."-".$cost]=$tonnage;
            $xandyTOTAL=0;
            foreach($branch_array as $branch) {
                if (!empty ($weighted_avg_10plus[$branch])) {
                    $total_w_avg_10plus+=$weighted_avg_10plus[$branch];
                    echo "<td class='lcwlwithplus'>".round($weighted_avg_10plus[$branch]/$total_10plus[$branch],2)."</td>";
                    $xandyTOTAL+=$total_array[$branch_name."-".$wp_grade];
                } else {
                    echo "<td class='lcwlwithplus'>-</td>";
                }
            }
            echo "<td class='TOTAL'>".round($xandyTOTAL/$total_w_avg_10plus,2)."</td>";
            echo "</tr>";
        }*/

        echo "<tr>";
        $total_w_avg = 0;
        $xandyTOTAL = 0;
        echo "<td class='avg' id='label'>Weighted-Avg(Tot)</td>";
        $pricing_details_array[$filtering_branch."-".$filtering_grade."-".$cost]=$tonnage;
        foreach($branch_array as $branch) {
            if (!empty ($weighted_avg[$branch])) {
                $total_w_avg+=($total_array[$branch."-".$wp_grade]*$weighted_avg[$branch]/$total_array[$branch."-".$wp_grade])*1000;
                echo "<td class='avg'>".round($weighted_avg[$branch]/$total_array[$branch."-".$wp_grade],2)."<br>
</td>";
                $xandyTOTAL+=$total_array[$branch."-".$wp_grade];
            } else {
                echo "<td class='avg'>-</td>";
            }
        }
        echo "<td class='TOTAL'>".round($total_w_avg/($xandyTOTAL*1000),2)."</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td class='TOTAL' id='label'>TOTAL</td>";
        $pricing_details_array[$filtering_branch."-".$filtering_grade."-".$cost]=$tonnage;
        $xandyTOTAL=0;
        foreach ($branch_array as $branch_name) {
            if(!empty($total_array[$branch_name."-".$wp_grade])) {
                echo "<td class='TOTAL'>".number_format($total_array[$branch_name."-".$wp_grade],2)."</td>";
                $xandyTOTAL+=$total_array[$branch_name."-".$wp_grade];
            }else {
                echo "<td class='TOTAL'>-</td>";
            }
        }
        echo "<td class='TOTAL' >".number_format($xandyTOTAL,2)."</td>";
        echo "</tr>";

        echo "</table>";
        echo "</div></div>";
        unset ($weighted_avg);
        $total_w_avg = "0";
        $total_w_avg_10plus = "0";

    }













//////////////////////////////////////////
    ?>

<div class="clear">
</div>

<div class="clear">
</div>
<div class="clear">
</div>
    <?php }else {?>
<div class="grid_8" >
    <div class="box round first grid">
            <?php
            echo "<h5><u><b id='branch'>$filtering_branch</b></u> </h5>";
            include("config.php");
            ?>
            <?php
            $filtering_grade_array=array("LCWL","ONP","CBS","OCC","MW","CHIPBOARD");
            foreach($filtering_grade_array as $filtering_grade) {
                ?>
        <h5><?php echo "<u><i>".$filtering_grade ."</i></u>";?></h5>
        <table>
                    <?php
                    $unit_cost_array=array();
                    $tonnage_on_cost_array=array();
                    if($is_quota=='with quota only') {
                        $query="SELECT (unit_cost) as unit_cost,sum(corrected_weight),quota FROM paper_buying join incentive_scheme on paper_buying.supplier_id=incentive_scheme.sup_id where paper_buying.wp_grade like '%$filtering_grade%' and date_received >='$start_date' and date_received <='$breaker_date'  and unit_cost >0 and  branch like '%$filtering_branch%'  group by unit_cost order by sum(corrected_weight) desc, unit_cost asc";
                    } else if($is_quota=='all') {
                        if ($filtering_grade=="LCWL") {
                            $query="SELECT (unit_cost) as unit_cost,sum(corrected_weight) FROM paper_buying where paper_buying.wp_grade like '%$filtering_grade%' and  branch like '%$filtering_branch%' and date_received >='$start_date' and date_received <='$breaker_date'  and unit_cost >0  group by unit_cost order by sum(corrected_weight) desc, unit_cost asc";
                        } else if ($filtering_grade=="ONP") {
                            $query="SELECT (unit_cost) as unit_cost,sum(corrected_weight) FROM paper_buying where (paper_buying.wp_grade like '%$filtering_grade%' or paper_buying.wp_grade='NPB' or paper_buying.wp_grade='OPD') and  branch like '%$filtering_branch%' and date_received >='$start_date' and date_received <='$breaker_date'  and unit_cost >0  group by unit_cost order by sum(corrected_weight) desc, unit_cost asc";
                        } else if ($filtering_grade=="MW") {
                            $query="SELECT (unit_cost) as unit_cost,sum(corrected_weight) FROM paper_buying where (paper_buying.wp_grade like '%$filtering_grade%' or paper_buying.wp_grade='CORETUBE' or paper_buying.wp_grade='CT') and  branch like '%$filtering_branch%' and date_received >='$start_date' and date_received <='$breaker_date'  and unit_cost >0  group by unit_cost order by sum(corrected_weight) desc, unit_cost asc";
                        } else if ($filtering_grade=="CHIPBOARD") {
                            $query="SELECT (unit_cost) as unit_cost,sum(corrected_weight) FROM paper_buying where (paper_buying.wp_grade like '%$filtering_grade%' or paper_buying.wp_grade='CB') and  branch like '%$filtering_branch%' and date_received >='$start_date' and date_received <='$breaker_date'  and unit_cost >0  group by unit_cost order by sum(corrected_weight) desc, unit_cost asc";
                        } else {
                            $query="SELECT (unit_cost) as unit_cost,sum(corrected_weight) FROM paper_buying where paper_buying.wp_grade like '$filtering_grade%' and  branch like '%$filtering_branch%' and date_received >='$start_date' and date_received <='$breaker_date'  and unit_cost >0  group by unit_cost order by sum(corrected_weight) desc, unit_cost asc";
                        }
                    } else if($is_quota=='without quota only') {
                        $query="SELECT (unit_cost) as unit_cost,sum(corrected_weight),quota FROM paper_buying left join incentive_scheme on paper_buying.supplier_id=incentive_scheme.sup_id where paper_buying.wp_grade like '$filtering_grade%' and date_received >='$start_date' and date_received <='$breaker_date'  and unit_cost >0 and  branch like '%$filtering_branch%' and quota is null group by unit_cost order by sum(corrected_weight) desc, unit_cost asc";
                    }
                    $result=mysql_query($query);
                    while($row = mysql_fetch_array($result)) {
                        $unit_cost=trim($row['unit_cost']);
                        $unit_cost=number_format($unit_cost,2);


                        if($is_quota=='with quota only') {
                            if($row['quota']>0) {
                                array_push($tonnage_on_cost_array,$unit_cost."-".$row['sum(corrected_weight)']);
                                array_push($unit_cost_array,$unit_cost);
                            }
                        }else  if($is_quota=='without quota only') {
                            $null_checker= $row['quota'];

                            array_push($tonnage_on_cost_array,$unit_cost."-".$row['sum(corrected_weight)']);
                            array_push($unit_cost_array,$unit_cost);

                        }else if($is_quota=='all') {
                            array_push($tonnage_on_cost_array,$unit_cost."-".$row['sum(corrected_weight)']);
                            array_push($unit_cost_array,$unit_cost);

                        }
                    }

                    rsort($unit_cost_array);
                    $unit_cost_array=array_unique($unit_cost_array);

                    echo "<th>Unit Cost</th>";
                    echo "<th>Tonnage</th>";
                    $total_tonnage=0;

                    foreach($unit_cost_array as $cost) {
                        echo "<tr>";
                        echo "<td>$cost</td>";
                        $tonnage=0;
                        foreach($tonnage_on_cost_array as $value) {
                            $tonnage_details=preg_split("[-]",$value);
                            if($cost==$tonnage_details[0]) {
                                $tonnage += ($tonnage_details[1]/1000);
                            }
                        }
                        $total_tonnage+=$tonnage;
                        echo "<td>".number_format($tonnage,2)."</td>";
                        echo "</tr>";


                    }



                    echo "<tr>";
                    echo "<td class='TOTAL'>TOTAL</td>";
                    echo "<td class='TOTAL'>".number_format($total_tonnage,2)."</td>";
                    echo "</tr>";

                    ?>

        </table>


                <?php echo "<hr>";

            }

            ?>
    </div>
</div>



<div class="clear">

</div>

<div class="clear">

</div>
<div class="clear">

</div>




    <?php }?>