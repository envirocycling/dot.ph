<?php include("templates/template.php"); ?><style>    table{        font-size:12.5px;    }    .total{        background-color: yellow;        font-weight: bold;    }    th{        width:500px;    }    #totalFooter{        background-color: yellow;        font-weight: bold;    }</style><?php include("config.php");
$wp_array=array();
$supplier_array=array();
$deliveries_per_month=array();
?>
<script>
    function monthlyRemarks(str) {
        var x = screen.width/2 - 700/2;
        var y = screen.height/2 - 450/2;
        window.open("monthlyRemarks.php?id="+str,'mywindow','width=800,height=500');
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

</style>
<div class="grid_50" >
    <div class="box round first grid">
        <h2><?php $ngayon=date('F d, Y');

          
            $remarks_date=$_SESSION['weekly_year']."/".date("m",strtotime($_SESSION['weekly_month']));
            if(strtoupper($_SESSION['weekly_branch'])!='') {
                if($_SESSION['weekly_wp_grade']!='') {
                    echo "<h2>".strtoupper($_SESSION['weekly_branch'])." Suppliers Weekly Receiving for ".$_SESSION['weekly_month']." in MT on ".$_SESSION['weekly_wp_grade']."</h2>";
                }else {
                    echo "<h2>".strtoupper($_SESSION['weekly_branch'])." Suppliers Weekly Receiving for ".$_SESSION['weekly_month']." in MT on all grades</h2>";
                }
            }else {
                if($_SESSION['weekly_wp_grade']!='') {
                    echo "<h2>CONSOLIDATED Suppliers Weekly Receiving for ".$_SESSION['weekly_month']." in MT on wp grade: ".$_SESSION['weekly_wp_grade']."</h2>";
                }else {
                    echo "<h2>CONSOLIDATED Suppliers Weekly Receiving for ".$_SESSION['weekly_month']." in MT on all grades</h2>";
                }
            }
            ?>
            <?php
            $query = "SELECT * FROM wp_grades ";
            $result = mysql_query($query) ;
            echo "<form action='weekly_filter.php' method='POST'>";
            echo "WP Grade:";
            $dropdown = "<td><select name='wp_grade' onchange='this.form.submit()'>";
            $dropdown .= "\r\n<option value='{$_SESSION['weekly_wp_grade']}'>{$_SESSION['weekly_wp_grade']}</option>";
            $dropdown .= "\r\n<option value=''>All Grades</option>";
            $dropdown .= "\r\n<option value=''>__________</option>";
            while($row = mysql_fetch_array($result)) {
                $dropdown .= "\r\n<option value='{$row['wp_grade']}'>{$row['wp_grade']}</option>";
            }
            $dropdown  .= "\r\n</select></td>";
            echo $dropdown;
            $query = "SELECT * FROM branches  ";
            $result = mysql_query($query) ;

            echo "Branch:";
            $dropdown = "<td><select name='branch' onchange='this.form.submit()'>";
            $dropdown .= "\r\n<option value='{$_SESSION['weekly_branch']}'>{$_SESSION['weekly_branch']}</option>";
            $dropdown .= "\r\n<option value=''>All Branches</option>";
            $dropdown .= "\r\n<option value='Sauyo/Kaybiga'>Sauyo/Kaybiga</option>";
            $dropdown .= "\r\n<option value=''>__________</option>";
            while($row = mysql_fetch_array($result)) {
                $dropdown .= "\r\n<option value='{$row['branch_name']}'>{$row['branch_name']}</option>";
            }
            $dropdown  .= "\r\n</select></td>";
            echo $dropdown;



            ?> Month: <select name="weekly_month" onchange='this.form.submit()'>
                <option value="<?php echo $_SESSION['weekly_month'];?>">
                    <?php echo $_SESSION['weekly_month'];?></option>
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
                <option value="<?php echo $_SESSION['weekly_year'];?>">
                    <?php echo $_SESSION['weekly_year'];?></option>
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
            <table class="data display datatable" id="example">
                <?php
                $total_array=array();
                $final_week1_total=0;
                $final_week2_total=0;
                $final_week3_total=0;
                $final_week4_total=0;
                $final_week5_total=0;
                $current_month_total=0;
                $final_percentage1_total=0;
                $final_percentage2_total=0;
                $final_percentage3_total=0;
                $final_percentage4_total=0;
                $final_percentage5_total=0;
                $total_target_receiving=0;
                if($_SESSION['weekly_branch']=='Sauyo/Kaybiga') {
                    $query="SELECT date_delivered FROM sup_deliveries where month_delivered='".$_SESSION['weekly_month']."' and year_delivered='".$_SESSION['weekly_year']."' and (branch_delivered = 'Kaybiga' or branch_delivered ='Sauyo') group by  date_delivered";

                }else {
                    $query="SELECT date_delivered FROM sup_deliveries where month_delivered='".$_SESSION['weekly_month']."' and year_delivered='".$_SESSION['weekly_year']."' and branch_delivered like '%".$_SESSION['weekly_branch']."%' group by  date_delivered";

                }
                $result=mysql_query($query);
                while($row = mysql_fetch_array($result)) {
                    $newDate=date("M d", strtotime($row['date_delivered']));
                    array_push($wp_array,$row['date_delivered']);
                }
                $weeks_array=array();
                $months_array=array();
                $breaker_date='';
                $period_date='';

                if($_SESSION['weekly_month']=='January') {
                    $breaker_date=$_SESSION['weekly_year']."/"."01"."/01";
                    $period_date=$_SESSION['weekly_year']."/"."01";
                }else if($_SESSION['weekly_month']=='February') {
                    $breaker_date=$_SESSION['weekly_year']."/"."02"."/01";
                    $period_date=$_SESSION['weekly_year']."/"."02";
                }else if($_SESSION['weekly_month']=='March') {
                    $breaker_date=$_SESSION['weekly_year']."/"."03"."/01";
                    $period_date=$_SESSION['weekly_year']."/"."03";
                }else if($_SESSION['weekly_month']=='April') {
                    $breaker_date=$_SESSION['weekly_year']."/"."04"."/01";
                    $period_date=$_SESSION['weekly_year']."/"."04";
                }else if($_SESSION['weekly_month']=='May') {
                    $breaker_date=$_SESSION['weekly_year']."/"."05"."/01";
                    $period_date=$_SESSION['weekly_year']."/"."05";
                }else if($_SESSION['weekly_month']=='June') {
                    $breaker_date=$_SESSION['weekly_year']."/"."06"."/01";
                    $period_date=$_SESSION['weekly_year']."/"."06";
                }else if($_SESSION['weekly_month']=='July') {
                    $breaker_date=$_SESSION['weekly_year']."/"."07"."/01";
                    $period_date=$_SESSION['weekly_year']."/"."07";
                }else if($_SESSION['weekly_month']=='August') {
                    $breaker_date=$_SESSION['weekly_year']."/"."08"."/01";
                    $period_date=$_SESSION['weekly_year']."/"."08";
                }else if($_SESSION['weekly_month']=='September') {
                    $breaker_date=$_SESSION['weekly_year']."/"."09"."/01";
                    $period_date=$_SESSION['weekly_year']."/"."09";
                }else if($_SESSION['weekly_month']=='October') {
                    $breaker_date=$_SESSION['weekly_year']."/"."10"."/01";
                    $period_date=$_SESSION['weekly_year']."/"."10";
                }else if($_SESSION['weekly_month']=='November') {
                    $breaker_date=$_SESSION['weekly_year']."/"."11"."/01";
                    $period_date=$_SESSION['weekly_year']."/"."11";
                }else if($_SESSION['weekly_month']=='December') {
                    $breaker_date=$_SESSION['weekly_year']."/"."12"."/01";
                    $period_date=$_SESSION['weekly_year']."/"."12";
                }
                $period_checker=$_SESSION['weekly_month'];
                if($_SESSION['weekly_branch']=='Sauyo/Kaybiga') {
                    $query="SELECT month_delivered FROM sup_deliveries where month_delivered!='".$_SESSION['weekly_month']."' and year_delivered='".$_SESSION['weekly_year']."' and date_delivered <'$breaker_date'  and (branch_delivered ='Kaybiga' or branch_delivered ='Sauyo') group by  month_delivered order by date_delivered";

                }else {
                    $query="SELECT month_delivered FROM sup_deliveries where month_delivered!='".$_SESSION['weekly_month']."' and year_delivered='".$_SESSION['weekly_year']."' and date_delivered <'$breaker_date'  and branch_delivered like '%".$_SESSION['weekly_branch']."%' group by  month_delivered order by date_delivered";


                }

                $supplier_details_array=array();
                $query40="SELECT supplier_details.supplier_id as supplier_id,supplier_details.supplier_name as supplier_name,supplier_details.branch as branch,supplier_details.classification as classification FROM supplier_details join sup_deliveries on supplier_details.supplier_id=sup_deliveries.supplier_id where sup_deliveries.year_delivered='".$_SESSION['weekly_year']."' " ;
                $result40=mysql_query($query40);
                while($row40 = mysql_fetch_array($result40)) {
                    $supplier_details_array[$row40['supplier_id']]=($row40['supplier_name']."+".$row40['branch']."+".$row40['classification']);
                }

                //////////////////////////////////////////
                $remarks_array=array();

                $query21="SELECT * FROM monthly_remarks where date='$remarks_date'  ";
                $result21=mysql_query($query21);

                while($row21 = mysql_fetch_array($result21)) {
                    $remarks_array[$row21['supplier_id']]=$row21['remarks'];

                }




                $price_array=array();

                $query21="SELECT  unit_cost,supplier_id FROM paper_buying where  wp_grade = '".$_SESSION['weekly_wp_grade']."' and date_received like '%".$remarks_date."%' and branch like '%".$_SESSION['weekly_branch']."%' order by date_received asc;";
                $result21=mysql_query($query21);

                while($row21 = mysql_fetch_array($result21)) {
                    $price_array[$row21['supplier_id']]=$row21['unit_cost'];

                }
                ///////////////////////////////////////////////


                $result=mysql_query($query);
                while($row = mysql_fetch_array($result)) {
                    array_push($weeks_array,$row['month_delivered']);
                    array_push($months_array,$row['month_delivered']);
                }

                if($_SESSION['weekly_branch']=='Sauyo/Kaybiga') {
                    $query5="SELECT sum(weight),month_delivered,supplier_id,date_delivered from sup_deliveries where   year_delivered='".$_SESSION['weekly_year']."' and date_delivered <'$breaker_date' and wp_grade like '%".$_SESSION['weekly_wp_grade']."%' and (branch_delivered ='Kaybiga' or branch_delivered ='Sauyo')  group by  supplier_id,month_delivered order by date_delivered";

                }else {
                    $query5="SELECT sum(weight),month_delivered,supplier_id,date_delivered from sup_deliveries where   year_delivered='".$_SESSION['weekly_year']."' and date_delivered <'$breaker_date' and wp_grade like '%".$_SESSION['weekly_wp_grade']."%' and branch_delivered like '%".$_SESSION['weekly_branch']."%' group by  supplier_id,month_delivered order by date_delivered";

                }
                $result5 =mysql_query($query5);



                $pick_up_array=array();


                $query51="SELECT sum(net_weight),supplier_name,date FROM pick_up where wp_grade like '%".$_SESSION['weekly_wp_grade']."%'  and date like '%".$_SESSION['weekly_year']."%';";
                $result51 =mysql_query($query51);
                while($row51 = mysql_fetch_array($result51)) {
                    $pick_up=$row51['sum(net_weight)'];
                    $pick_up_sup=$row51['sum(net_weight)'];
                    $date_pick=$row51['date'];
                    $pick_up_array[$pick_up_sup."+".$date_pick]=$pick_up;
                }



                while($row5 = mysql_fetch_array($result5)) {
                    $pick_up=0;
                    if(!empty($pick_up_array[$row5['supplier_id']])) {
                        $pick_up=$pick_up_array[$row5['supplier_id']."+".$row5['date_delivered']];
                    }

                    $deliveries_per_month[$row5['supplier_id']."+".ucfirst(strtolower($row5['month_delivered']))]=(($row5['sum(weight)']+$pick_up)/1000);

                }


                array_push($weeks_array,$_SESSION['weekly_month']);
                array_push($weeks_array,"Week 1");
                array_push($weeks_array,"Week 2");
                array_push($weeks_array,"Week 3");
                array_push($weeks_array,"Week 4");
                array_push($weeks_array,"Week 5");
                $supplier_head_count=0;
                echo "<thead>";

                echo "<th>ID</th>";
                echo "<th>Supplier Name</th>";
                echo "<th>Branch Registered</th>";
                echo "<th>Classification</th>";
                foreach ($weeks_array as $value) {
                    echo "<th>".$value."</th>";
                }
                echo "<th>Buying Price</th>";
                echo "<th>Remarks</th>";


                echo "</thead>";
                if($_SESSION['weekly_branch']=='Sauyo/Kaybiga') {
                    $query="SELECT supplier_id FROM sup_deliveries where  year_delivered='".$_SESSION['weekly_year']."'  and   (branch_delivered ='Kaybiga' or branch_delivered ='Sauyo') group by supplier_id";
                }else {
                    $query="SELECT supplier_id FROM sup_deliveries where  year_delivered='".$_SESSION['weekly_year']."'  and branch_delivered like '%".$_SESSION['weekly_branch']."%'    group by supplier_id";

                }
                $result=mysql_query($query);
                while($row = mysql_fetch_array($result)) {
                    array_push($supplier_array,$row['supplier_id']);
                }
                $supplier_array=array_unique($supplier_array);
                $deliveries_array =array();
                if(trim($_SESSION['weekly_wp_grade'])!='') {
                    if($_SESSION['weekly_branch']=='Sauyo/Kaybiga') {
                        $query3="SELECT supplier_id,sum(weight),date_delivered,month_delivered FROM sup_deliveries  where month_delivered='".$_SESSION['weekly_month']."' and year_delivered='".$_SESSION['weekly_year']."' and wp_grade = '".$_SESSION['weekly_wp_grade']."' and   (branch_delivered ='Kaybiga' or branch_delivered ='Sauyo')  group by supplier_id,date_delivered";
                    }else {
                        $query3="SELECT supplier_id,sum(weight),date_delivered,month_delivered FROM sup_deliveries  where month_delivered='".$_SESSION['weekly_month']."' and year_delivered='".$_SESSION['weekly_year']."' and wp_grade = '".$_SESSION['weekly_wp_grade']."' and branch_delivered like '%".$_SESSION['weekly_branch']."%' group by supplier_id,date_delivered";
                    }
                }else {
                    if($_SESSION['weekly_branch']=='Sauyo/Kaybiga') {
                        $query3="SELECT supplier_id,sum(weight),date_delivered,month_delivered FROM sup_deliveries  where month_delivered='".$_SESSION['weekly_month']."' and year_delivered='".$_SESSION['weekly_year']."'  and   (branch_delivered ='Kaybiga' or branch_delivered ='Sauyo') group by supplier_id,date_delivered";
                    }else {
                        $query3="SELECT supplier_id,sum(weight),date_delivered,month_delivered FROM sup_deliveries  where month_delivered='".$_SESSION['weekly_month']."' and year_delivered='".$_SESSION['weekly_year']."'  and branch_delivered like '%".$_SESSION['weekly_branch']."%' group by supplier_id,date_delivered";
                    }
                }
                $result3=mysql_query($query3);
                while($row3 = mysql_fetch_array($result3)) {
                    $pick_up=0;
                    if(!empty($pick_up_array[$row3['supplier_id']])) {
                        $pick_up=$pick_up_array[$row3['supplier_id']."+".$row3['date_delivered']];
                    }
                    $deliveries_array[$row3['supplier_id']."+".$row3['date_delivered']]=($row3['sum(weight)']+$pick_up);
                }
                $week1_total=0;
                $week2_total=0;
                $week3_total=0;
                $week4_total=0;
                $week5_total=0;




                foreach ($supplier_array as $value2) {
                    $total_per_branch=0;
                    echo "<tr class='data'>";
                    if(!empty($supplier_details_array[$value2])) {
                        $supplier_details= $supplier_details_array[$value2];
                        $supplier_details=preg_split("/[+]/",$supplier_details);
                        echo "<td id='' class='data' >".$value2."</td>";
                        echo "<td id='left_header' >"."<a rel='facebox' href='view_delivery_brkdwn.php?sup_id=$value2 && year=".$_SESSION['weekly_year']." && wp_grade=".$_SESSION['weekly_wp_grade']."' id='view_brkdwn' >".$supplier_details[0]."</a></td>";
                        echo "<td id='left_header' >".$supplier_details[1]."</td>";
                        echo "<td id='left_header' >".$supplier_details[2]."</td>";

                    }else {
                        echo "<td id='' >".$value2."</td>";
                        echo "<td id='left_header' >"."<a rel='facebox' href='view_delivery_brkdwn.php?sup_id=$value2 && year=".$_SESSION['weekly_year']." && wp_grade=".$_SESSION['weekly_wp_grade']."' id='view_brkdwn' >UNKNOWN</a></td>";
                        echo "<td id='left_header' ><i>Undefined</i></td>";
                        echo "<td id='left_header' ><i>Undefined</i></td>";

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
/////////////////////////////////////////////////////////////////////////////////////////////
                    foreach($months_array as $months) {
                        $key_finder2=$value2."+".$months;
                        $filtering_tool=$value2."_".$months;
                        if(!empty($deliveries_per_month[$key_finder2])) {
                            echo "<td ><button value='".$filtering_tool."_".$_SESSION['weekly_year']."' onclick='monthlyRemarks(this.value);' title='Click to view remarks'>".round($deliveries_per_month[$key_finder2],2)."</button></a></td>";
                        }
                        else {
                            echo "<td ><button value='".$filtering_tool."_".$_SESSION['weekly_year']."' onclick='monthlyRemarks(this.value);' title='Click to view remarks'>-</button></a></td>";
                        }
                    }
/////////////////////////////////////////////////////////////////////////////////////////


                    $week1_total=($week1_total/1000);
                    $week2_total=($week2_total/1000);
                    $week3_total=($week3_total/1000);
                    $week4_total=($week4_total/1000);
                    $week5_total=($week5_total/1000);
/////////////////////----Weekly Breakdown----//////////////////////////////////////////////////////
                    if(round($week1_total+$week2_total+$week3_total+$week4_total+$week5_total+0,2)==0) {
                        echo "<td class='TOTAL'><button value='".$value2."_".$_SESSION['weekly_month']."_".$_SESSION['weekly_year']."' onclick='monthlyRemarks(this.value);' title='Click to view remarks'>-</button></td>";
                    }else {
                        $total_current_month=$week1_total+$week2_total+$week3_total+$week4_total+$week5_total;
                        echo "<td class='TOTAL'><button value='".$value2."_".$_SESSION['weekly_month']."_".$_SESSION['weekly_year']."' onclick='monthlyRemarks(this.value);' title='Click to view remarks'>".$total_current_month."</button></td>";
///////// <button value='".$value2."_".$_SESSION['weekly_month']."_".$_SESSION['weekly_year']."' onclick='monthlyRemarks(this.value);' title='Click to view remarks'>".$total_current_month."</button>
                    }

///////////////////////////////////////////////////////////////////////////////
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
                    $current_month_total+=($week1_total+$week2_total+$week3_total+$week4_total+$week5_total+0);
                    $week1_total=0;
                    $week2_total=0;
                    $week3_total=0;
                    $week4_total=0;
                    $week5_total=0;
                    if(!empty($price_array[$value2])) {
                        echo "<td id='price'>";
                        $price=$price_array[$value2];

                        echo $price;

                        echo "</div></td>";

                    }else {
                        echo "<td  id='price'></td>";
                    }

                    if(!empty($remarks_array[$value2])) {
                        echo "<td><div style='overflow:scroll; overflow-x:hidden; width:200px;height:60px;'>";
                        $remarks=$remarks_array[$value2];

                        echo $remarks;

                        echo "</div>
                               <button  value='".$value2."_".$_SESSION['weekly_month']."_".$_SESSION['weekly_year']."' onclick='monthlyRemarks(this.value);'><u style='color:blue; font-size:10'><i>comment</i></u></button>
                             </td>";

                    }else {
                        echo " <td>
                               <button  value='".$value2."_".$_SESSION['weekly_month']."_".$_SESSION['weekly_year']."' onclick='monthlyRemarks(this.value);'><u style='color:blue; font-size:10'><i>comment</i></u></button>
                             </td>";
                    }





                    echo "</tr>";

                    $supplier_head_count++;
                }
/////////////////////////////////////////////
                echo "<tr class='data'>";
                echo "<td class='TOTAL' >!TOTAL!</td>";

                echo "<td class='TOTAL' >Head Count: $supplier_head_count</td>";
                echo "<td class='TOTAL' ></td>";
                echo "<td class='TOTAL' ></td>";
                foreach($months_array as $month) {
                    if(trim($_SESSION['weekly_wp_grade'])!='') {
                        if($_SESSION['weekly_branch']=='Sauyo/Kaybiga') {
                            $query31="SELECT sum(weight)/1000 as weight,month_delivered FROM sup_deliveries where  wp_grade='".$_SESSION['weekly_wp_grade']."' and year_delivered='".$_SESSION['weekly_year']."' and month_delivered ='$month' and   (branch_delivered ='Kaybiga' or branch_delivered ='Sauyo')  ";
                        }else {
                            $query31="SELECT sum(weight)/1000 as weight, month_delivered FROM sup_deliveries where  wp_grade='".$_SESSION['weekly_wp_grade']."' and year_delivered='".$_SESSION['weekly_year']."' and month_delivered ='$month' and branch_delivered like '%".$_SESSION['weekly_branch']."%'  ";

                        }
                    }else {
                        if($_SESSION['weekly_branch']=='Sauyo/Kaybiga') {
                            $query31="SELECT sum(weight)/1000 as weight,month_delivered FROM sup_deliveries where year_delivered='".$_SESSION['weekly_year']."' and month_delivered ='$month'  and (branch_delivered ='Kaybiga' or branch_delivered ='Sauyo') ";

                        }else {
                            $query31="SELECT sum(weight)/1000 as weight,month_delivered FROM sup_deliveries where year_delivered='".$_SESSION['weekly_year']."' and month_delivered ='$month'  and branch_delivered like '%".$_SESSION['weekly_branch']."%'  ";

                        }
                    }
                    $result31=mysql_query($query31);

                    if($row31 = mysql_fetch_array($result31)) {
                        echo "<td class='TOTAL' >".number_format(round($row31['weight'],2),2)."</td>";

                    }else {
                        echo "<td class='TOTAL' >-</td>";

                    }
                }
                echo "<td class='TOTAL' >".number_format(round($current_month_total,2),2)."</td>";
                echo "<td class='TOTAL'  >".number_format(round($final_week1_total,2),2)."</td>";
                echo "<td class='TOTAL'  >".number_format(round($final_week2_total,2),2)."</td>";
                echo "<td class='TOTAL'  >".number_format(round($final_week3_total,2),2)."</td>";
                echo "<td class='TOTAL'  >".number_format(round($final_week4_total,2),2)."</td>";
                echo "<td class='TOTAL' >".number_format(round($final_week5_total,2),2)."</td>";
                echo "<td class='TOTAL' ></td>";
                echo "<td class='TOTAL' ></td>";
/////////////////////////////////////////////
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