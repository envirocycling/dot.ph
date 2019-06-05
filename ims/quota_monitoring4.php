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
        font-size: 11px;
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
        font-size:10px;
    }
    #left_header{
        background-color:#FFFAF0;
        font-size: 10px;
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
    #price{
        background-color:#EBE0CC;
    }
    .quota{
        font-weight:bold;

    }
    .quota_percent:after{
        font-weight:bold;
        content:"%";

    }
</style>


<?php
$ngayon=date('F d, Y');
$start_date=$_POST['start_date'];
$breaker_date=$_POST['end_date'];
$filtering_grade=$_POST['wp_grade'];
$filtering_branch=$_POST['branch'];
$weekly_month=date("F", strtotime($breaker_date));
$weekly_year=date("Y", strtotime($breaker_date));
$week_for_comparison_total=0;
$current_week_total=0;
$average_prev_month_total=0;
$five_week_total_final=0;



function getTotalDeliveries($start_date,$end_date,$wp_grade,$branch) {
    include('config.php');


    $weight=0;
    $query40="select sum(sup_deliveries.weight) as weight from sup_deliveries right join incentive_scheme on incentive_scheme.sup_id=sup_deliveries.supplier_id where date_delivered >'".$start_date."' and date_delivered < '$end_date' and incentive_scheme.remarks='' and sup_deliveries.branch_delivered like '%$branch%' and incentive_scheme.quota>0 and wp_grade like '%$wp_grade%'  " ;
    $result40=mysql_query($query40);
    while($row40 = mysql_fetch_array($result40)) {
        $weight+=$row40['weight'];
    }
    return $weight/1000;
}



function getDeliveries($supplier_id,$start_date,$end_date,$wp_grade) {
    include('config.php');


    $weight=0;
    $query40=" select sum(weight) from sup_deliveries where supplier_id='$supplier_id' and date_delivered >'".$start_date."' and date_delivered < '$end_date' and wp_grade like '%$wp_grade%' " ;
    $result40=mysql_query($query40);
    while($row40 = mysql_fetch_array($result40)) {
        $weight+=$row40['sum(weight)'];
    }
    return $weight/1000;
}


?>

<div class="grid_50" >
    <div class="box round first grid">
        <h2><?php

            $remarks_date=$weekly_year."/".date("m",strtotime($weekly_month));
            if(strtoupper($filtering_branch)!='') {
                if($filtering_grade!='') {
                    echo "<h2>".strtoupper($filtering_branch)." Suppliers Average Receiving per Week for the period <u>$start_date to $breaker_date</u> in MT on ".$filtering_grade."</h2>";
                }else {
                    echo "<h2>".strtoupper($filtering_branch)." Suppliers Average Receiving per Week for the period <u>$start_date to $breaker_date</u>  in MT on all grades</h2>";
                }
            }else {
                if($filtering_grade!='') {
                    echo "<h2>CONSOLIDATED Suppliers Average Receiving per Week for the period <u>$start_date to $breaker_date</u> in MT on wp grade: ".$filtering_grade."</h2>";
                }else {
                    echo "<h2>CONSOLIDATED Suppliers Average Receiving per Week for the period <u>$start_date to $breaker_date</u> in MT on all grades</h2>";
                }
            }
            ?>

            <table class="data display datatable" id="example">
                <?php
                $months_list_array=array();
                $months_list_array_real=array();

                $begining_month=date("M",strtotime($start_date));
                $begining_month_real=date("Y/m/d",strtotime($start_date));

                $ending_month=date("M",strtotime($breaker_date."+1 month"));
                $ending_month_real=date("Y/m/d",strtotime($breaker_date."+1 month"));




                $month_to_add=$begining_month;
                $month_to_add_real=$begining_month_real;




                while($month_to_add !=$ending_month) {
                    $month_to_push=$month_to_add;
                    $month_to_push_real=$month_to_add_real;

                    $month_to_add=date("M",strtotime($month_to_add."+1 month"));
                    $month_to_add_real=date("Y/m/d",strtotime($month_to_add_real."+1 month"));

                    array_push($months_list_array,$month_to_push."-".$month_to_add);
                    array_push($months_list_array_real,$month_to_push_real."-".$month_to_add_real);

                }



                $supplier_details_array=array();
                $query40=" select * from supplier_details join incentive_scheme on supplier_details.supplier_id=incentive_scheme.sup_id where status !='inactive' and incentive_scheme.remarks=''" ;
                $result40=mysql_query($query40);
                while($row40 = mysql_fetch_array($result40)) {
                    $supplier_details_array[$row40['supplier_id']]=($row40['supplier_name']."+".$row40['branch']."+".$row40['style']."+".$row40['description']);
                }




                $quota_array=array();
                $total_quota=0;
                $query40="SELECT incentive_scheme.sup_id as sup_id,incentive_scheme.quota as quota,start_date as start_date,end_date ,wp_grade,sup_id,incentive_scheme.scheme as scheme from incentive_scheme where incentive_scheme.remarks ='' and incentive_scheme.wp_grade like '%$filtering_grade%'" ;
                $result40=mysql_query($query40);
                while($row40 = mysql_fetch_array($result40)) {
                    $query41="SELECT sum(weight) from sup_deliveries where  date_delivered >= '".$row40['start_date']."' and date_delivered <='".$row40['end_date']."' and wp_grade='".$row40['wp_grade']."' and supplier_id='".$row40['sup_id']."' " ;
                    $result41=mysql_query($query41);
                    $quota_tonnage=0;

                    while($row41 = mysql_fetch_array($result41)) {
                        $quota_tonnage=$row41['sum(weight)'];
                        $quota_tonnage=$quota_tonnage/1000;

                    }
                    $quota_array[$row40['sup_id']]=($row40['quota']/1000)."-".$quota_tonnage."-".$row40['scheme'];
                }

                echo "<thead>";
                echo "<th>ID</th>";

                echo "<th>Supplier Name</th>";
                echo "<th>Branch Registered</th>";
                echo "<th>Character</th>";
                echo "<th>Desc</th>";

                echo "<th>______Scheme_____</th>";
                echo "<th>Quota</th>";

                echo "<th>Perf (MT)</th>";
                echo "<th>Perf (%)</th>";
                foreach($months_list_array as $month) {
                    $month_array=preg_split("[-]",$month);
                    echo "<th>"."MID of ".$month_array[0]."- MID of ".$month_array[1]."</th>";

                }
                echo "</thead>";
                $query="select * from supplier_details join incentive_scheme on supplier_details.supplier_id=incentive_scheme.sup_id where status !='inactive' and incentive_scheme.remarks='' and branch like '%$filtering_branch%' and wp_grade like '%$filtering_grade%'" ;

                $result=mysql_query($query);
                while($row = mysql_fetch_array($result)) {
                    array_push($supplier_array,$row['supplier_id']);
                }
                $supplier_array=array_unique($supplier_array);
                $supplier_head_count=0;
                $total_bottom_array=array();
                foreach ($supplier_array as $value2) {
                    $supplier_head_count++;
                    $total_per_branch=0;
                    echo "<tr class='data'>";
                    if(!empty($supplier_details_array[$value2])) {
                        $supplier_details= $supplier_details_array[$value2];
                        $supplier_details=preg_split("/[+]/",$supplier_details);
                        echo "<td id='' class='data' >".$value2."</td>";
                        echo "<td id='left_header' >"."<a rel='facebox' href='view_delivery_brkdwn.php?sup_id=$value2 && year=".$weekly_year." && wp_grade=".$filtering_grade."' id='view_brkdwn' >".$supplier_details[0]."</a></td>";
                        echo "<td id='left_header' >".$supplier_details[1]."</td>";
                        if($supplier_details[2]!='') {
                            echo "<td id='left_header'><button  value='".$value2."' onclick='editCharacter(this.value);'><u style='color:blue; font-size:10'><i>".$supplier_details[2]."</i></u></button></td>";
                        }else {
                            echo "<td id='left_header'><button  value='".$value2."' onclick='editCharacter(this.value);'><u style='color:blue; font-size:10'><i>edit</i></u></button></td>";
                        }
                        echo "<td id='left_header' >".$supplier_details[3]."</td>";
                    }else {
                        echo "<td id='' >".$value2."</td>";
                        echo "<td id='left_header' >"."<a rel='facebox' href='view_delivery_brkdwn.php?sup_id=$value2 && year=".$weekly_year." && wp_grade=".$filtering_grade."' id='view_brkdwn' >UNKNOWN</a></td>";
                        echo "<td id='left_header' ><i>Undefined</i></td>";
                        echo "<td id='left_header' ><i>Undefined</i></td>";
                        echo "<td id='left_header' ><i>Undefined</i></td>";

                    }
                    if(!empty($quota_array[$value2])) {
                        $quota_details=preg_split("[-]",$quota_array[$value2]);
                        $weekly_year=date("Y", strtotime($breaker_date));
                        echo "<td id='left_header'><b>".date("M d, y", strtotime($quota_details[2]))."-".date("M d, y", strtotime($quota_details[3]))."</b></td>";
                        echo "<td id='left_header' class='quota'>".round($quota_details[0],2)."</td>";
                        echo "<td id='left_header' class='quota'>".round($quota_details[1],2)."</td>";
                        $perf_percentage=round(($quota_details[1]/$quota_details[0])*100,0);
                        if($perf_percentage >=100 ) {
                            echo "<td id='left_header' class='quota_percent' style='color:green;'>".$perf_percentage."</td>";
                        }else if($perf_percentage >=50 && $perf_percentage<100) {
                            echo "<td id='left_header' class='quota_percent' style='color:blue;'>".$perf_percentage."</td>";
                        }else {
                            echo "<td id='left_header' class='quota_percent' style='color:red;'>".$perf_percentage."</td>";
                        }
                        $total_quota+=$quota_details[0];
                        $total_perf+=$quota_details[1];
                    }else {
                        echo "<td id='left_header'></td>";
                        echo "<td id='left_header'></td>";
                        echo "<td id='left_header'></td>";
                        echo "<td id='left_header'></td>";

                    }

                    foreach($months_list_array_real as $month) {

                        $start_of_quota=date("Y/m/d",strtotime($quota_details[2]));

                        $start_of_quota=date("Y/m/d",strtotime($quota_details[2]));
                        $end_of_quota=date("Y/m/d",strtotime($quota_details[3]));
                        $start_of_quota=preg_split("[/]",$start_of_quota);
                        $end_of_quota=preg_split("[/]",$end_of_quota);

                        $start_of_quota_day=$start_of_quota[2];
                        $end_of_quota_day=$end_of_quota[2];

                        $filtering_month_array=preg_split("[-]",$month);

                        $filtering_month_1=$filtering_month_array[0];
                        $filtering_month_1=preg_split("[/]",$filtering_month_1);


                        $filtering_month_2=$filtering_month_array[1];
                        $filtering_month_2=preg_split("[/]",$filtering_month_2);

                        $beg_filter_date=$filtering_month_1[0]."/".$filtering_month_1[1]."/".$start_of_quota_day;
                        $ending_filter_date=$filtering_month_2[0]."/".$filtering_month_2[1]."/".$end_of_quota_day;
                        $beg_filter_date=date("Y/m/d",strtotime($beg_filter_date."-1 day"));
                        $ending_filter_date=date("Y/m/d",strtotime($ending_filter_date."+1 day"));
                        $getDeliveries=getDeliveries($value2,$beg_filter_date,$ending_filter_date,$filtering_grade);

                        echo "<td>".number_format($getDeliveries,2)."</td>";
                        array_push($total_bottom_array,$month."+".$getDeliveries."+".$value2);

                    }
                }
                echo "<tr class='data'>";
                echo "<td class='TOTAL' >!TOTAL!</td>";
                echo "<td class='TOTAL' >Head Count: $supplier_head_count</td>";
                echo "<td class='TOTAL' ></td>";
                echo "<td class='TOTAL' ></td>";
                echo "<td class='TOTAL' ></td>";
                echo "<td class='TOTAL' ></td>";
                echo "<td class='TOTAL' >".round($total_quota,2)."</td>";
                echo "<td class='TOTAL' >".round($total_perf,2)."</td>";
                echo "<td class='TOTAL' ></td>";
                foreach($months_list_array_real as $month) {
                    $total_bottom=0;
                    foreach($total_bottom_array as $val) {
                        $val_breaked=preg_split("/[+]/",$val);
                        if($val_breaked[0]==$month) {
                            $total_bottom+=$val_breaked[1];
                        }
                    }
                    echo "<td class='TOTAL' >".round($total_bottom,2)."</td>";
                }










                echo "</tr>";
                ?>
            </table>
    </div>
</div>



<div class="clear">

</div>

<div class="clear">

</div>
<div class="clear">

</div>