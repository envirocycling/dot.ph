<?php
include("templates/template.php");
?><style>    table{        font-size:12.5px;    }    .total{        background-color: yellow;        font-weight: bold;    }    th{        width:500px;    }    #totalFooter{
        background-color: yellow;
        font-weight: bold;    }</style>
    <?php include("config.php");
    $wp_array=array();
    $supplier_array=array();
    $deliveries_per_month=array();
    $total_quota=0;
    $total_perf=0;
    ?>
    <script>
        function monthlyRemarks(str) {
            var x = screen.width/2 - 700/2;
            var y = screen.height/2 - 450/2;
            window.open("monthlyRemarks.php?id="+str,'mywindow','width=800,height=500');
        }
        function editCharacter(str){


            window.open("frmEditCharacter.php?id="+str,'mywindow','width=400,height=400');
        }

        function hideSupplier(str){


            window.open("frmHideSupplier.php?id="+str,'mywindow','width=500,height=150');
        }
    </script>
    <style>
    th{
        font-size: 12px;
        background-color:gray;
        color:white;
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
        background-color:#FFF5E0;
        font-size:12px;
        text-align:right;
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

</style>


<?php
$ngayon=date('F d, Y');
$start_date=$_POST['start_date'];
$breaker_date=$_POST['end_date'];

$filtering_branch=$_POST['branch'];
$weekly_month=date("F", strtotime($breaker_date));
$weekly_year=date("Y", strtotime($breaker_date));

?>
<!--
<div class="grid_7">
    <div class="box round first">
        <h2>Summary </h2>
<?php
//  echo"  <iframe src='quota_summary.php?start_date=$start_date&&end_date=$breaker_date&&grade=$filtering_grade&&branch=$filtering_branch&&month=$weekly_month&&year=$weekly_year         height='200' width='100%'></iframe>"
?>
    </div>
</div>

<div class="clear">

</div>

-->



<div class="grid_50" >
    <div class="box round first grid">


        <h2><?php

            $remarks_date=$weekly_year."/".date("m",strtotime($weekly_month));
            if(strtoupper($filtering_branch)!='') {

                echo "<h2>".strtoupper($filtering_branch)." Suppliers Average Receiving per Week for the period <u>$start_date to $breaker_date</u>  in MT on all grades</h2>";

            }else {

                echo "<h2>CONSOLIDATED Suppliers Average Receiving per Week for the period <u>$start_date to $breaker_date</u> in MT on all grades</h2>";

            }
            ?>


            <?php
            include("config.php");
            $filtering_grade_array=array("lcwl","onp","cbs","occ","mw","chipboard");
            foreach($filtering_grade_array as $filtering_grade) {
                ?>

            <h5><?php echo "<u><i>".$filtering_grade ."</i></u>";?></h5>
            <table>
                    <?php
                    $total_array=array();
                    $weeks_array=array();
                    $months_array=array();
                    $remarks_array=array();
                    $final_week1_total=0;
                    $final_week2_total=0;
                    $final_week3_total=0;
                    $final_week4_total=0;
                    $final_week5_total=0;



                    if($filtering_branch=='Sauyo/Kaybiga') {
                        $query="SELECT date_delivered FROM sup_deliveries where  month_delivered='$weekly_month' and year_delivered='$weekly_year' group by  date_delivered";

                    }else {
                        $query="SELECT date_delivered FROM sup_deliveries where  month_delivered='$weekly_month' and year_delivered='$weekly_year'   group by  date_delivered";

                    }
                    $result=mysql_query($query);
                    $day_counter=0;
                    while($row = mysql_fetch_array($result)) {
                        array_push($wp_array,$row['date_delivered']);
                        $day_counter++;
                    }


                    if($filtering_branch=='Sauyo/Kaybiga') {
                        $query="SELECT month_delivered,year_delivered FROM sup_deliveries where date_delivered >='$start_date' and date_delivered <='$breaker_date' and (branch_delivered ='Kaybiga' or branch_delivered ='Sauyo') group by  month_delivered,year_delivered order by date_delivered";
                    }else {
                        $query="SELECT month_delivered,year_delivered FROM sup_deliveries where  date_delivered >='$start_date' and date_delivered <='$breaker_date'  and branch_delivered like '%".$filtering_branch."%' group by  year_delivered,month_delivered order by date_delivered";
                    }

                    $result=mysql_query($query);

                    while($row = mysql_fetch_array($result)) {
                        array_push($weeks_array,$row['month_delivered']."-".$row['year_delivered']);
                        array_push($months_array,$row['month_delivered']."-".$row['year_delivered']);

                    }


                    $current_month_total=0;

                    if($filtering_branch=='Sauyo/Kaybiga') {
                        $query5="SELECT sum(weight),month_delivered,style,date_delivered,year_delivered from sup_deliveries join supplier_details on sup_deliveries.supplier_id=supplier_details.supplier_id where  supplier_details.status !='inactive' and date_delivered >='$start_date' and  date_delivered <='$breaker_date' and wp_grade like '%".$filtering_grade."%' and (branch_delivered ='Kaybiga' or branch_delivered ='Sauyo') group by  supplier_details.style,month_delivered,year_delivered order by date_delivered";
                    }else {
                        $query5="SELECT sum(weight),month_delivered,style,date_delivered,year_delivered from sup_deliveries join supplier_details on sup_deliveries.supplier_id=supplier_details.supplier_id where  supplier_details.status !='inactive' and    date_delivered >='$start_date' and date_delivered <='$breaker_date' and wp_grade like '%".$filtering_grade."%' and branch_delivered like '%".$filtering_branch."%' group by  supplier_details.style,month_delivered,year_delivered order by date_delivered";
                    }
                    $result5 =mysql_query($query5);
                    while($row5 = mysql_fetch_array($result5)) {
                        $deliveries_per_month[$row5['style']."+".ucfirst(strtolower($row5['month_delivered']))."-".$row5['year_delivered']]=(($row5['sum(weight)'])/1000);
                    }

                    $supplier_head_count=0;
                    echo "<thead>";


                    echo "<th>Character</th>";


                    array_pop($months_array);
                    array_push($weeks_array,"Week 1");
                    array_push($weeks_array,"Week 2");
                    array_push($weeks_array,"Week 3");
                    array_push($weeks_array,"Week 4");
                    array_push($weeks_array,"Week 5");
                    foreach ($weeks_array as $value) {
                        echo "<th>".$value."</th>";
                    }

                    echo "</thead>";
                    if($filtering_branch=='Sauyo/Kaybiga') {
                        $query="SELECT style FROM supplier_details where status!='inactive' and (branch ='Kaybiga' or branch ='Sauyo') group by style ";
                    }else {
                        $query="SELECT style FROM supplier_details where status!='inactive' and  branch like '%".$filtering_branch."%' group by style";
                    }
                    $result=mysql_query($query);
                    while($row = mysql_fetch_array($result)) {

                        array_push($supplier_array,$row['style']);

                    }
                    $supplier_array=array_unique($supplier_array);
                    $deliveries_array =array();

                    if(trim($filtering_grade)!='') {
                        if($filtering_branch=='Sauyo/Kaybiga') {
                            $query3="SELECT supplier_details.style as style,sum(weight),date_delivered,month_delivered FROM sup_deliveries  join supplier_details on sup_deliveries.supplier_id=supplier_details.supplier_id where supplier_details.status!='inactive' and month_delivered='$weekly_month' and year_delivered='$weekly_year' and wp_grade = '$filtering_grade' and   (branch_delivered ='Kaybiga' or branch_delivered ='Sauyo')  group by supplier_details.style,date_delivered";
                        }else {
                            $query3="SELECT supplier_details.style as style,sum(weight),date_delivered,month_delivered FROM sup_deliveries  join supplier_details on sup_deliveries.supplier_id=supplier_details.supplier_id where supplier_details.status!='inactive' and month_delivered='$weekly_month' and year_delivered='$weekly_year' and wp_grade = '$filtering_grade' and branch_delivered like '%".$filtering_branch."%' group by supplier_details.style,date_delivered";
                        }

                    }else {
                        if($filtering_branch=='Sauyo/Kaybiga') {
                            $query3="SELECT supplier_details.style as style,sum(weight),date_delivered,month_delivered FROM sup_deliveries  join supplier_details on sup_deliveries.supplier_id=supplier_details.supplier_id where supplier_details.status!='inactive' and month_delivered='$weekly_month' and year_delivered='$weekly_year'  and   (branch_delivered ='Kaybiga' or branch_delivered ='Sauyo') group by supplier_details.style,date_delivered";
                        }else {
                            $query3="SELECT supplier_details.style as style,sum(weight),date_delivered,month_delivered FROM sup_deliveries  join supplier_details on sup_deliveries.supplier_id=supplier_details.supplier_id where supplier_details.status!='inactive' and month_delivered='$weekly_month' and year_delivered='$weekly_year'  and branch_delivered like '%".$filtering_branch."%' group by supplier_details.style,date_delivered";
                        }
                    }

                    $result3=mysql_query($query3);
                    while($row3 = mysql_fetch_array($result3)) {

                        $deliveries_array[$row3['style']."+".$row3['date_delivered']]=($row3['sum(weight)']);
                    }



                    $week1_total=0;
                    $week2_total=0;
                    $week3_total=0;
                    $week4_total=0;
                    $week5_total=0;
                    foreach ($supplier_array as $value2) {
                        $total_per_branch=0;
                        echo "<tr class='data'>";

                        if(trim($value2)!='') {
                            echo "<td id='' >".$value2."</td>";
                        }else {
                            echo "<td id='' >Undefined</td>";

                        }





                        foreach($wp_array as $value) {

                            $key_finder=$value2."+".$value;
                            $seven_identifier=preg_split('[/]',$value);
                            if($seven_identifier[2] %7 != 0) {
                                if(!empty($deliveries_array[$key_finder])) {
                                    if($seven_identifier[2]<7 ) {
                                        $week1_total+= $deliveries_array[$key_finder];
                                    }else if($seven_identifier[2]<14 && $seven_identifier[2]>7 ) {
                                        $week2_total+= $deliveries_array[$key_finder];
                                    }else if($seven_identifier[2]<21 && $seven_identifier[2]>14) {
                                        $week3_total+= $deliveries_array[$key_finder];
                                    }else if($seven_identifier[2]<28 && $seven_identifier[2]>21) {
                                        $week4_total+= $deliveries_array[$key_finder];
                                    }else if($seven_identifier[2]>28) {
                                        $week5_total+= $deliveries_array[$key_finder];
                                    }
                                }else {
                                }
                            }else {
                                if($seven_identifier[2]==7 ) {
                                    if(!empty($deliveries_array[$key_finder])) {
                                        $week1_total+= $deliveries_array[$key_finder];
                                    }
                                }
                                if($seven_identifier[2]==14 ) {
                                    if(!empty($deliveries_array[$key_finder])) {
                                        $week2_total+= $deliveries_array[$key_finder];
                                    }
                                }
                                if($seven_identifier[2]==21 ) {
                                    if(!empty($deliveries_array[$key_finder])) {
                                        $week3_total+= $deliveries_array[$key_finder];
                                    }
                                }
                                if($seven_identifier[2]==28 ) {
                                    if(!empty($deliveries_array[$key_finder])) {
                                        $week4_total+= $deliveries_array[$key_finder];
                                    }
                                }
                            }

                        }

////////////////////////////////////////////////////////////////////////////////////////

                        foreach($months_array as $months) {
                            $key_finder2=$value2."+".$months;
                            $filtering_tool=$value2."_".$months;
                            if(!empty($deliveries_per_month[$key_finder2])) {
                                $end_of_the_month= date("Y/m/t", strtotime($months));
                                $divider=((date("j", strtotime($end_of_the_month)))/7);
                                echo "<td>".round(($deliveries_per_month[$key_finder2]/$divider),2)."</td>";

                            }
                            else {
                                echo "<td >-</td>";
                            }

                        }
                        $week1_total=($week1_total/1000);
                        $week2_total=($week2_total/1000);
                        $week3_total=($week3_total/1000);
                        $week4_total=($week4_total/1000);
                        $week5_total=($week5_total/1000);
                        //////////////////////////////////////////////////////////////////////////////////////////////////
                        /////////////////////////////----Weekly Breakdown----/////////////////////////////////////////////
                        //////////////////////////////////////////////////////////////////////////////////////////////////

                        $five_week_total=($week1_total+$week2_total+$week3_total+$week4_total+$week5_total);
                        $current_month_divider=($day_counter/7);
                        if ($five_week_total==0) {
                            echo "<td >-</td>";
                        }else {

                            echo "<td >".round(($five_week_total/$current_month_divider),2)."</td>";

                            $current_month_total+=($five_week_total/$current_month_divider);
                        }


                        if($week1_total==0) {
                            echo "<td id='weekly'>-</td>";
                        }else {
                            echo "<td id='weekly'>".round($week1_total,2)."</td>";
                        }
                        $final_week1_total+=$week1_total;
                        if($week2_total==0) {
                            echo "<td id='weekly'>-</td>";
                        }else {
                            echo "<td id='weekly'>".round($week2_total,2)."</td>";
                        }
                        $final_week2_total+=$week2_total;
                        if($week3_total==0) {
                            echo "<td id='weekly'>-</td>";
                        }else {
                            echo "<td id='weekly'>".round($week3_total,2)."</td>";
                        }
                        $final_week3_total+=$week3_total;
                        if($week4_total==0) {
                            echo "<td id='weekly'>-</td>";
                        }else {
                            echo "<td id='weekly'>".round($week4_total,2)."</td>";
                        }
                        $final_week4_total+=$week4_total;
                        if($week5_total==0) {
                            echo "<td id='weekly'>-</td>";
                        }else {
                            echo "<td id='weekly'>".round($week5_total,2)."</td>";

                        }
                        $final_week5_total+=$week5_total;
                        $week1_total=0;
                        $week2_total=0;
                        $week3_total=0;
                        $week4_total=0;
                        $week5_total=0;

                        echo "</tr>";
                        $supplier_head_count++;
                    }
                    echo "<tr class='data'>";
                    echo "<td class='TOTAL' >!TOTAL!</td>";
                    foreach($months_array as $var) {
                        $total_date=preg_split("/[-]/",$var);
                        $month=$total_date[0];
                        $year=$total_date[1];
                        if(trim($filtering_grade)!='') {
                            if($filtering_branch=='Sauyo/Kaybiga') {
                                $query31="SELECT sum(weight)/1000 as weight, month_delivered,year_delivered,date_delivered FROM sup_deliveries join supplier_details on sup_deliveries.supplier_id=supplier_details.supplier_id where supplier_details.status!='inactive' and wp_grade='".$filtering_grade."' and year_delivered='$year' and month_delivered ='$month' and   (branch_delivered ='Kaybiga' or branch_delivered ='Sauyo')  ";
                            }else {
                                $query31="SELECT sum(weight)/1000 as weight, month_delivered,year_delivered,date_delivered FROM sup_deliveries join supplier_details on sup_deliveries.supplier_id=supplier_details.supplier_id where supplier_details.status!='inactive' and   wp_grade='".$filtering_grade."' and year_delivered='$year' and month_delivered ='$month' and branch_delivered like '%".$filtering_branch."%'  ";
                            }
                        }else {
                            if($filtering_branch=='Sauyo/Kaybiga') {
                                $query31="SELECT sum(weight)/1000 as weight, month_delivered,year_delivered,date_delivered FROM sup_deliveries join supplier_details on sup_deliveries.supplier_id=supplier_details.supplier_id where supplier_details.status!='inactive' and  year_delivered='".$year."' and month_delivered ='$month'  and (branch_delivered ='Kaybiga' or branch_delivered ='Sauyo') ";
                            }else {
                                $query31="SELECT sum(weight)/1000 as weight, month_delivered,year_delivered,date_delivered FROM sup_deliveries join supplier_details on sup_deliveries.supplier_id=supplier_details.supplier_id where supplier_details.status!='inactive' and  year_delivered='".$year."' and month_delivered ='$month'  and branch_delivered like '%".$filtering_branch."%'  ";
                            }
                        }
                        $result31=mysql_query($query31);
                        if($row31 = mysql_fetch_array($result31)) {

                            $end_of_the_month= date("Y/m/t", strtotime($row31['date_delivered']));
                            $divider=((date("j", strtotime($end_of_the_month)))/7);
                            echo "<td class='TOTAL' >".number_format(round(($row31['weight']/$divider),2),2)."</td>";
                        }else {
                            echo "<td class='TOTAL' >-</td>";
                        }
                    }

                    echo "<td class='TOTAL' >".number_format(round($current_month_total,2),2)."</td>";
                    echo "<td class='TOTAL' >".number_format(round($final_week1_total,2),2)."</td>";
                    echo "<td class='TOTAL' >".number_format(round($final_week2_total,2),2)."</td>";
                    echo "<td class='TOTAL' >".number_format(round($final_week3_total,2),2)."</td>";
                    echo "<td class='TOTAL' >".number_format(round($final_week4_total,2),2)."</td>";
                    echo "<td class='TOTAL' >".number_format(round($final_week5_total,2),2)."</td>";

                    ?>
            </table>


                <?php echo "<hr>";
            }?>
    </div>
</div>



<div class="clear">

</div>

<div class="clear">

</div>
<div class="clear">

</div>
