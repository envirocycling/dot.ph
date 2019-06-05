<?php include("templates/template.php"); ?>
<style>    
    table{        
        font-size:11px;
    }
    .total{
        background-color: yellow;
        font-weight: bold;
    }
    th{ 
        width:500px;
    }
    #totalFooter{
        background-color: yellow;
        font-weight: bold;
    }
    #week{
        background-color:85EB6A;
    }
    button{
        border-style:hidden;
    }
    #price{
        background-color:#33CCCC;
    }
</style>

<script>
    function monthlyRemarks(str) {
        var x = screen.width/2 - 700/2;
        var y = screen.height/2 - 450/2;
        window.open("monthlyRemarks.php?id="+str,'mywindow','width=800,height=500');
    }
    function editCharacter(str){


        window.open("frmEditCharacter.php?id="+str,'mywindow','width=400,height=400');
    }
</script>
<?php include("config.php");
$wp_array=array();
if($_SESSION['usertype']!='Super User') {
    $_SESSION['weekly_branch']=$_SESSION['user_branch'];
}




$branch_array=array();?><div class="grid_15">    <div class="box round first grid">        <h2>            <?php $ngayon=date('F d, Y');
            echo "<h2> Weekly Receiving for ".date('F')." as of : <u><b><i>".$ngayon."</i></b></u></h2>"; ?></h2>                <?php            $query = "SELECT * FROM wp_grades ";
        $result = mysql_query($query) ;
        echo "<form action='weekly_filter.php' method='POST'>";
        echo "WP Grade:";
        $dropdown = "<td><select name='wp_grade' onchange='this.form.submit()'>";
        $dropdown .= "\r\n<option value='{$_SESSION['weekly_wp_grade']}'>{$_SESSION['weekly_wp_grade']}</option>";
        $dropdown .= "\r\n<option value=''>All Grades</option>";
        $dropdown .= "\r\n<option value=''>__________</option>";            while($row = mysql_fetch_array($result)) {
            $dropdown .= "\r\n<option value='{$row['wp_grade']}'>{$row['wp_grade']}</option>";
        }
        $dropdown  .= "\r\n</select></td>";
        echo $dropdown;
        $query = "SELECT * FROM branches";
        $result = mysql_query($query) ;
        if($_SESSION['usertype']=='Super User') {
            echo "Branch:";
            $dropdown  = "<td><select name='branch' onchange='this.form.submit()'>";
            $dropdown .= "\r\n<option value='{$_SESSION['weekly_branch']}'>{$_SESSION['weekly_branch']}</option>";
            $dropdown .= "\r\n<option value=''>All Branches</option>";
            $dropdown .= "\r\n<option value=''>__________</option>";                while($row = mysql_fetch_array($result)) {
                $dropdown .= "\r\n<option value='{$row['branch_name']}'>{$row['branch_name']}</option>";
            }
            $dropdown .= "\r\n</select></td>";
            echo $dropdown;
        }
            ?> Month: <select name="weekly_month" onchange='this.form.submit()'>                <option value="<?php echo $_SESSION['weekly_month'];?>"><?php echo $_SESSION['weekly_month'];?></option>                <option value="January">January</option>                <option value="February">February</option>                <option value="March">March</option>                <option value="April">April</option>                <option value="May">May</option>                <option value="June">June</option>                <option value="July">July</option>                <option value="August">August</option>                <option value="September">September</option>                <option value="October">October</option>                <option value="November">November</option>                <option value="December">December</option>            </select>            Year: <select name="weekly_year" onchange='this.form.submit()'>                <option value="<?php echo $_SESSION['weekly_year'];?>"><?php echo $_SESSION['weekly_year'];?></option>                <option value="2011">2011</option>                <option value="2012">2012</option>                <option value="2013">2013</option>                <option value="2014">2014</option>                <option value="2015">2015</option>                <option value="2016">2016</option>                <option value="2017">2017</option>                <option value="2018">2018</option>                <option value="2019">2019</option>                <option value="2020">2020</option>            </select>            <?php            echo "</form><br>";            ?>                       <table class="data display datatable" id="example">
                <?php


                $query="SELECT date_delivered FROM sup_deliveries where month_delivered='".$_SESSION['weekly_month']."' and year_delivered='".$_SESSION['weekly_year']."' group by  date_delivered";
                $result=mysql_query($query);
                while($row = mysql_fetch_array($result)) {
                    $date=date("Y/m", strtotime($row['date_delivered']));
                    $newDate=date("M d", strtotime($row['date_delivered']));
                    array_push($wp_array,$row['date_delivered']);
                }

                echo "<thead>";
                $weeks_array=array("Week 1","Week 2","Week 3","Week 4","Week 5");
                echo "<th>Sup ID</th>";
                echo "<th>Supplier Name</th>";
                echo "<th>Branch Registered</th>";
                echo "<th>Classification</th>";
                foreach ($weeks_array as $value) {
                    echo "<th>".$value."</th>";

                }
                echo "<th>TOTAL</th>";
                echo "<th>AVG Price</th>";

                echo "<th>Remarks</th>";
                echo "</thead>";

                if($_SESSION['weekly_branch']=='') {
                    $query="SELECT * FROM sup_deliveries join supplier_details on sup_deliveries.supplier_id=supplier_details.supplier_id where   year_delivered='".$_SESSION['weekly_year']."'  group by sup_deliveries.supplier_name";
                }else {
                    $query="SELECT * FROM sup_deliveries join supplier_details on sup_deliveries.supplier_id=supplier_details.supplier_id where year_delivered='".$_SESSION['weekly_year']."' and branch_delivered ='".$_SESSION['weekly_branch']."' group by sup_deliveries.supplier_name";

                }
                $result=mysql_query($query);
                while($row = mysql_fetch_array($result)) {

                    array_push($branch_array,$row['supplier_name']."+".$row['branch']."+".$row['style']."+".$row['supplier_id']);
                }
                $deliveries_array =array();
                if($_SESSION['usertype']=='Super User') {
                    $query3="SELECT supplier_id,supplier_name,sum(weight),date_delivered FROM sup_deliveries  where month_delivered='".$_SESSION['weekly_month']."' and year_delivered='".$_SESSION['weekly_year']."' and wp_grade like '%".$_SESSION['weekly_wp_grade']."%' and branch_delivered like '%".$_SESSION['weekly_branch']."%' group by supplier_name,date_delivered";
                }else {
                    $query3="SELECT supplier_id,supplier_name,sum(weight),date_delivered FROM sup_deliveries  where month_delivered='".$_SESSION['weekly_month']."' and year_delivered='".$_SESSION['weekly_year']."' and wp_grade like '%".$_SESSION['weekly_wp_grade']."%' and branch_delivered = '".$_SESSION['user_branch']."' group by supplier_name,date_delivered";
                }
                $result3=mysql_query($query3);
                while($row3 = mysql_fetch_array($result3)) {
                    $deliveries_array[$row3['supplier_name']."+".$row3['date_delivered']]=$row3['sum(weight)'];
                }
                $week1_total=0;
                $week2_total=0;
                $week3_total=0;
                $week4_total=0;
                $week5_total=0;
                foreach ($branch_array as $value2) {
                    $total_per_branch=0;
                    echo "<tr class='data'>";
                    $supplier_details=preg_split("/[+]/",$value2);
                    $value2=$supplier_details[0];
                    $branch_registered=$supplier_details[1];
                    $classification=$supplier_details[2];
                    $sup_id=$supplier_details[3];
                    echo "<td class='data' >".$sup_id."</td>";
                    echo "<td class='data' >".$value2."</td>";

                    echo "<td class='data' >".$branch_registered."</td>";
                    if($supplier_details[2]!='') {
                        echo "<td class='data'><button  value='".$sup_id."' onclick='editCharacter(this.value);'><u style='color:blue; font-size:10'><i>".$supplier_details[2]."</i></u></button></td>";
                    }else {
                        echo "<td class='data'><button  value='".$sup_id."' onclick='editCharacter(this.value);'><u style='color:blue; font-size:10'><i>edit</i></u></button></td>";
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

                    echo "<td id='week'>".number_format($week1_total)."</td>";



                    echo "<td id='week'>".number_format($week2_total)."</td>";
                    ;


                    echo "<td id='week'>".number_format($week3_total)."</td>";

///////////////////////////////////////////////

                    echo "<td id='week'>".number_format($week4_total)."</td>";
                    ;
///////////////////////////////////////////////////

                    echo "<td id='week'>".number_format($week5_total)."</td>";
                    echo "<td class='TOTAL'>".($week1_total+$week2_total+$week3_total+$week4_total+$week5_total)."</td>";

                    if($_SESSION['weekly_wp_grade']!='') {

                        $query2="SELECT  unit_cost FROM paper_buying where supplier_id='$sup_id' and wp_grade like '%".$_SESSION['weekly_wp_grade']."%' and date_received like '%".$date."%' and branch like '%".$_SESSION['weekly_branch']."%' order by date_received desc;";
                    }else {
                        $query2="SELECT AVG(unit_cost) as unit_cost FROM paper_buying where supplier_id='$sup_id' and date_received like '%".$date."%' and branch like '%".$_SESSION['weekly_branch']."%' order by date_received asc;";

                    }
                    $result2=mysql_query($query2);
                    $price=0;
                    if($row2 = mysql_fetch_array($result2)) {
                        $price=$row2['unit_cost'];
                    }
                    echo "<td id='price'>".number_format($price,2)."</td>";
/////////////////////////////////////////////////////////////////







                    $week1_total=0;
                    $week2_total=0;
                    $week3_total=0;
                    $week4_total=0;
                    $week5_total=0;


                    $query2="SELECT * FROM monthly_remarks where date='$date' and supplier_id='$sup_id' order by log_id desc";
                    $result2=mysql_query($query2);
                    $remarks="";
                    if($row2 = mysql_fetch_array($result2)) {
                        $remarks=$row2['remarks'];
                    }
                    echo "<td ><div style='overflow:scroll; overflow-x:hidden; width:200px;height:50px;'>".$remarks."</div>
<button  value='".$sup_id."_".$_SESSION['weekly_month']."_".$_SESSION['weekly_year']."' onclick='monthlyRemarks(this.value);'><u style='color:blue; font-size:10'><i>comment</i></u></button>
</td>";






                    echo "</tr>";
                }




                ?>
        </table>
    </div>
</div>

<div class="clear">

</div>

<div class="clear">

</div>