<?php
include('templates/template.php');
include("config.php");
$branch=$_SESSION['selected_branch'];
$date=$_SESSION['text_report_date'];
$today=date('Y/m',strtotime($date));
$month=date('Y/m');
$current_date=date('Y/m/d');
$last_1st_day=date("Y/m/d", mktime(0,0,0, date("m")-1, 1, date("Y")));
$last_last_day=date("Y/m/t", strtotime($last_1st_day));
$last_month= date("Y/m", strtotime($last_1st_day));
$day_ahead=date("Y/m/d",strtotime($date."+1 days"));
?>
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
    #header{
        color:white;
    }
    #total_percentage{
        font-size:17px;
        position:absolute;
        margin-top:-615px;
        margin-left:740px;
    }
    #total{
        font-weight: bold;
        background-color:yellow;
    }
    #table td{
        border-bottom: solid;
        border-right:solid;
        border-width:1px;
        padding:10px;
        text-align:right;
    }

</style>
<h2>
    <?php
    echo "<span id='header'>".$branch." Text Report for <u>$date</u></span>";
    ?>

</h2>


<div class="grid_3">
    <div class="box round first">
        <h2>Filtering Options</h2>
        <form action="filter_text_report.php" method="POST">
            Date: <input type='text'  id='inputField' name='date' value="<?php echo $date;?>" onfocus='date1(this.id);' readonly size="8"><br>
            <input type="submit" value="Filter">
        </form>
        <a href="text_report_clear_filter.php"><button>Clear Filter</button></a>
    </div>
</div>

<div class="grid_6">
    <div class="box round first">
        <h2>Summary</h2>
        <h5><table border="1" id="table">
                <?php
                echo "<tr><td>Month: </td><td>".date('F',strtotime($date))."</td></tr>";
                $query="SELECT * FROM sup_deliveries where date_delivered <= '".date('Y/m/d',strtotime($date))."' and month_delivered='".date('F',strtotime($date))."' and year_delivered='".date('Y',strtotime($date))."' and branch_delivered='$branch' group by date_delivered;";
                $result=mysql_query($query);
                echo "<tr><td># of Rcvng Days:</td>";
                $date_counter=0;
                while($row = mysql_fetch_array($result)) {
                    $date_counter++;
                }
                echo "<td>".$date_counter."</td><td>".number_format(((date('d',strtotime($date))/date('t',strtotime($date)))*100),2)."%</td></tr>";
                $query="SELECT sum(weight) FROM sup_deliveries where date_delivered like '%".date('Y/m',strtotime($date))."%' and branch_delivered='$branch';";
                $result=mysql_query($query);
                echo "<tr><td>TOTAL Receiving:</td>";
                $total_receiving=0;
                while($row = mysql_fetch_array($result)) {
                    $total_receiving=$row['sum(weight)'];
                    echo "<td>".number_format($row['sum(weight)'],2)."</td>";
                }
                $first_day_of_the_month=$month."/01";
                $last_day_of_the_month=date("Y/m/t",strtotime($month."/01"));
                $query="SELECT UCASE(wp_grade),sum(bale_weight) from bales where branch like '%$branch%'  and str_no=0  and wp_grade!='VOID' AND str_no NOT LIKE  '%DR%'  and status !='rebaled' ";
                $result=mysql_query($query);
                echo "<tr><td>Actual Inventory:</td>";
                $total_actual=0;
                while($row = mysql_fetch_array($result)) {
                    $total_actual=$row['sum(bale_weight)'];
                }
                $query="SELECT sum(weight) FROM loose_papers where branch='$branch' and date='".$day_ahead."'";
                $result=mysql_query($query);
                $total_loose=0;
                while($row = mysql_fetch_array($result)) {
                    $total_loose=$row['sum(weight)'];
                }
                $final_total_actual=$total_actual+$total_loose;
                echo "<td>".number_format($final_total_actual,2)."</td>";
                echo "<tr><td>MTD</td>";
                echo "<td>".number_format((($total_receiving/1000)/$date_counter),2)."</td>";
                echo "<td>";
                echo "</tr>";
                $query="SELECT count(supplier_id) FROM sup_deliveries where date_delivered = '".date('Y/m/d',strtotime($date))."' and branch_delivered='$branch' group by priority_number;";
                $result=mysql_query($query);
                $supplier_count=0;
                while($row = mysql_fetch_array($result)) {
                    $supplier_count++;
                }
                echo "<tr><td>Suppliers Count</td>";
                echo "<td>".$supplier_count."</td>";
                echo "</tr>";
                $query="SELECT count(log_id) FROM outgoing where date = '".date('Y/m/d',strtotime($date))."' and branch='$branch' and str not like '%DR%' group by str ;";
                $result=mysql_query($query);
                $str_out=0;
                while($row = mysql_fetch_array($result)) {
                    $str_out++;
                }
                echo "<tr><td>STR Outgoing Count</td>";
                echo "<td>".$str_out."</td>";
                $query="SELECT count(log_id) FROM outgoing where date = '".date('Y/m/d',strtotime($date))."' and branch='$branch' and str like '%DR%' group by str ;";
                $result=mysql_query($query);
                $dr_out=0;
                while($row = mysql_fetch_array($result)) {
                    $dr_out++;
                }
                echo "<td>DR Outgoing Count</td>";
                echo "<td>".$dr_out."</td>";
                echo "</tr>";
                ?>
            </table>
        </h5>
    </div>
</div>
<div class="grid_5">
    <div class="box round first">
        <h2>Receiving</h2>
        <table class="data display datatable" id="example">
            <?php
            $query="SELECT UCASE(wp_grade),sum(weight) FROM sup_deliveries where date_delivered='$date' and branch_delivered='$branch' group by wp_grade;";
            $result=mysql_query($query);
            echo "<thead>";
            echo "<tr class='data'>";
            echo "<th class='data'>WP Grade</th>";
            echo "<th class='data'>Weight</th>";
            echo "<th class='data'>Tons</th>";
            echo "</tr>";
            echo "</thead>";
            $total_weight=0;
            $total_tonnage=0;
            while($row = mysql_fetch_array($result)) {
                echo
                "<tr class='data'>";
                echo "<td class='data'>".$row['UCASE(wp_grade)']."</td>";
                echo "<td class='data'>".number_format($row['sum(weight)'],2)."</td>";
                echo "<td class='data'>".number_format(($row['sum(weight)']/1000),2)."</td>";
                $total_tonnage+=($row['sum(weight)']/1000);
                $total_weight+=$row['sum(weight)'];
                echo "</tr>";
            }
            ?>
            <?php
            echo "
                <tr>";
            echo "<td id='total'>z_TOTAL_z</td>";
            echo "<td id='total'>".number_format($total_weight,2)."</td>";
            echo "<td id='total'>".number_format($total_tonnage,2)."</td>";
            echo "</tr>";
            ?>
        </table>
    </div>
</div>
<div class="grid_5">
    <div class="box round first">
        <h2>Outgoing</h2>
        <table class="data display datatable" id="example">
            <?php
            $query="SELECT UCASE(wp_grade),sum(weight) FROM outgoing where date='$date' and branch='$branch' group by wp_grade;";
            $result=mysql_query($query);
            echo "<thead>";
            echo "<tr class='data'>";
            echo "<th class='data'>WP Grade</th>";
            echo "<th class='data'>Weight</th>";
            echo "<th class='data'>Tons</th>";
            echo "</tr>";
            echo "</thead>";
            $total_weight=0;
            $total_tonnage=0;
            while($row = mysql_fetch_array($result)) {
                echo
                "<tr class='data'>";
                echo "<td class='data'>".$row['UCASE(wp_grade)']."</td>";
                echo "<td class='data'>".number_format($row['sum(weight)'],2)."</td>";
                echo "<td class='data'>".number_format(($row['sum(weight)']/1000),2)."</td>";
                $total_tonnage+=($row['sum(weight)']/1000);
                $total_weight+=$row['sum(weight)'];
                echo "</tr>";
            }
            ?>
            <?php
            echo "<tr>";
            echo "<td id='total'>z_TOTAL_z</td>";
            echo "<td id='total'>".number_format($total_weight,2)."</td>";
            echo "<td id='total'>".number_format($total_tonnage,2)."</td>";
            echo "</tr>";
            ?>
        </table>
    </div>
</div>
<div class="grid_10">
    <div class="box round first">
        <h2>MTD vs TARGET</h2>
        <table class="data display datatable" id="example">
            <?php
            $query="SELECT sum(weight),UCASE(wp_grade),wp_grade,date_delivered from sup_deliveries where branch_delivered like '%$branch%' and date_delivered like '%".date('Y/m',strtotime($date))."%' and wp_grade !='VOID' group by wp_grade ";
            $result=mysql_query($query);
            echo "<thead>";
            echo "<tr class='data'>";
            echo "<th class='data'>WP Grade</th>";
            echo "<th class='data'>Weight</th>";
            echo "<th class='data'>Percentage</th>";
            echo "</tr>";
            echo "</thead>";
            $total_weight=0;
            $total_tonnage=0;
            while($row = mysql_fetch_array($result)) {
                echo
                "<tr class='data'>";
                echo "<td class='data'>".$row['UCASE(wp_grade)']."</td>";
                echo "<td class='data'>".number_format($row['sum(weight)'],2)."</td>";
                $current_period= date('F',strtotime($date));
                if($current_period=='January' || $current_period=='February' || $current_period=='March' ) {
                    $period='first';
                }else if(
                $current_period=='April' ||  $current_period=='May' ||  $current_period=='June') {
                    $period='second';
                }else if(
                $current_period=='July' ||  $current_period=='August' ||  $current_period=='September') {
                    $period='third';
                }else if(
                $current_period=='October' || $current_period=='November' ||  $current_period=='December' ) {
                    $period='fourth';
                }
                $query3="SELECT * from target_receiving where branch='$branch' and wp_grade='".$row['UCASE(wp_grade)']."' and period='$period' and date like '%".date('Y/m',strtotime($date))."%' order by log_id desc limit 1";
                $result3=mysql_query($query3);
                $target_receiving=1;
                $tester=0;
                if($row3 = mysql_fetch_array($result3)) {
                    $target_receiving=$row3['weight'];
                    $tester++;
                }
                if($tester==0) {
                    $query3="SELECT * from target_receiving where branch='$branch' and wp_grade='".$row['UCASE(wp_grade)']."' and period='$period' and date <='".date('Y/m/t',strtotime($date))."' order by log_id desc limit 1";
                    $result3=mysql_query($query3);
                    $target_receiving=1;
                    $tester=0;
                    if($row3 = mysql_fetch_array($result3)) {
                        $target_receiving=$row3['weight'];
                    }
                }
                if(
                $target_receiving==1) {
                    echo
                    "<td class='data'>-</td>";

                }else {
                    echo "<td class='data'>".number_format((($row['sum(weight)']/$target_receiving)*100),1)."%</td> ";
                }

                $total_tonnage+=($row['sum(weight)']/1000);
                $total_weight+=$row['sum(weight)'];
                echo "</tr>
                ";
            }
            ?>
            <?php
            $query3="SELECT sum(weight) from target_receiving where branch='$branch' and period='$period' ";
            $result3=mysql_query($query3);
            $total_target=1;
            if($row3 = mysql_fetch_array($result3)) {
                $total_target=$row3['sum(weight)'];
            }
            echo
            "<td id='total'>z_TOTAL_z</td>";
            echo "<td id='total'>".number_format($total_weight,2)."</td>";
            if($total_target>0) {
                echo "<td id='total'>".(number_format(($total_weight/$total_target),2)*100)."%</td>";
            }else {
                echo "<td id='total'>".(number_format((0),2)*100)."%</td>";
            }
            echo "</tr>";
            ?>
        </table>

    </div>
</div>
<div class="grid_10">
    <div class="box round first">
        <h2>INVENTORY BREAKDOWN</h2>
        <table class="data display datatable" id="example">
            <?php
            $first_day_of_the_month=$month."/01";
            $last_day_of_the_month=date("Y/m/t",strtotime($month."/01"));
            $query="SELECT UCASE(wp_grades.wp_grade),sum(bales.bale_weight) from bales right join wp_grades on bales.wp_grade=wp_grades.wp_grade where bales.branch like '%$branch%'  and bales.str_no=0  and bales.wp_grade not like '%VOID%' AND bales.str_no NOT LIKE  '%DR%'  and bales.status !='rebaled'  group by wp_grades.wp_grade";
            $result=mysql_query($query);
            echo "<thead>";
            echo "<tr class='data'>";
            echo "<th class='data'>WP Grade</th>";
            echo "<th class='data'>Bale Weight</th>";
            echo "<th class='data'>Loose Papers </th>";
            echo "<th class='data'>Net Weight</th>";
            echo "<th class='data'>Tons</th>";
            echo "</tr>";
            echo "</thead>";
            $total_weight=0;
            $total_tonnage=0;
            $total_loose=0;
            $total_net_weight=0;
            $wp_grades_on_bales=array();
            $wp_grades_on_loose=array();

            while($row = mysql_fetch_array($result)) {
                echo
                "<tr class='data'>";
                echo "<td class='data'>".$row['UCASE(wp_grades.wp_grade)']."</td>";

                echo "<td class='data'>".number_format($row['sum(bales.bale_weight)'],2)."</td>";
                if($row['UCASE(wp_grades.wp_grade)']!='LCWL' && $row['UCASE(wp_grades.wp_grade)']!='CHIPBOARD' &&  $row['UCASE(wp_grades.wp_grade)']!='WL STICKIES' ) {
                    $wp_grade="LC".$row['UCASE(wp_grades.wp_grade)'];

                }else {
                    $wp_grade=$row['UCASE(wp_grades.wp_grade)'];
                }
                $query2="SELECT * from loose_papers where branch='$branch' and date='$day_ahead' and wp_grade='".$wp_grade."'";
                $result2=mysql_query($query2);
                $loose_papers=0;

                while($row2 = mysql_fetch_array($result2)) {
                    $loose_papers=$row2['weight'];
                }
                echo "<td class='data'>".number_format($loose_papers,2)."</td>";
                $net_weight=($loose_papers+$row['sum(bales.bale_weight)']);
                echo "<td class='data'>".number_format($net_weight,2)."</td>";
                echo "<td class='data'>".number_format(($net_weight/1000),2)."</td>";
                $total_tonnage+=($net_weight/1000);
                $total_weight+=$row['sum(bales.bale_weight)'];
                $total_loose+=$loose_papers;
                $total_net_weight+=($net_weight);
                echo "</tr>";
                array_push($wp_grades_on_bales,$wp_grade);
            }
            $query3="SELECT wp_grade,sum(weight) from loose_papers where branch='$branch' and date='$day_ahead' group by wp_grade";
            $result3=mysql_query($query3);

            while($row3 = mysql_fetch_array($result3)) {
                /*
                if($row3['wp_grade']!='LCWL' && $row3['wp_grade']!='CHIPBOARD'  && $row3['wp_grade']!='LCCB') {
                    $loose_wp= substr($row3['wp_grade'], 2);
                }else {
                    $loose_wp= $row3['wp_grade'];
                }
                echo $loose_wp."<br>";
                */
                $loose_wp= $row3['wp_grade'];
                if(in_array($loose_wp,$wp_grades_on_bales )) {

                }else {
                    echo "<tr>";
                    echo "<td id=''>".$loose_wp."</td>";
                    echo "<td id=''>0.00</td>";
                    echo "<td id=''>".number_format($row3['sum(weight)'],2)."</td>";
                    echo "<td id=''>".number_format($row3['sum(weight)'],2)."</td>";
                    echo "<td id=''>".number_format(($row3['sum(weight)'])/1000,2)."</td>";
                    echo "</tr>";
                    $total_loose+=$row3['sum(weight)'];
                    $total_net_weight+=$row3['sum(weight)'];
                    $total_tonnage+=($row3['sum(weight)']/1000);
                }
            }
            ?>
            <?php
            echo "<tr>";
            echo "<td id='total'>z_TOTAL_z</td>";
            echo "<td id='total'>".number_format($total_weight,2)."</td>";
            echo "<td id='total'>".number_format($total_loose,2)."</td>";
            echo "<td id='total'>".number_format($total_net_weight,2)."</td>";
            echo "<td id='total'>".number_format($total_tonnage,2)."</td>";
            echo "</tr>";
            echo "<br>";

            ?>
        </table>

    </div>
</div>

<div class="clear">

</div>



<div class="clear">

</div>
