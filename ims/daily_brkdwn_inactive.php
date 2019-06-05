<?php include("templates/template.php"); ?>
<style>    table{        font-size:12.5px;    }    .total{        background-color: yellow;        font-weight: bold;    }    th{        width:500px;    }    #totalFooter{        background-color: yellow;        font-weight: bold;    }</style><?php include("config.php");
$wp_array=array();
$branch_array=array();



?>
<div class="grid_10"> 
    <div class="box round first grid">
        <h2><?php $ngayon=date('F d, Y');
            echo "<h2> Daily Receiving for ".date('F')." as of : <u><b><i>".$ngayon."</i></b></u></h2>"; ?></h2>        <div class="block">            <?php            $query = "SELECT * FROM wp_grades ";
            $result = mysql_query($query) ;
            echo "<form action='weekly_filter.php' method='POST'>";
            echo "WP Grade:";
            $dropdown = "<td><select name='wp_grade' onchange='this.form.submit()'>";
            $dropdown .= "\r\n<option value='{$_SESSION['weekly_wp_grade']}'>{$_SESSION['weekly_wp_grade']}</option>";
            $dropdown .= "\r\n<option value=''>All Grades</option>";
            $dropdown .= "\r\n<option value=''>__________</option>";            while($row = mysql_fetch_array($result)) {
                $dropdown .= "\r\n<option value='{$row['wp_grade']}'>{$row['wp_grade']}</option>";
            }
            $dropdown .= "\r\n</select></td>";
            echo $dropdown;
            $query = "SELECT * FROM branches  ";
            $result = mysql_query($query) ;
            if($_SESSION['usertype']=='Super User') {
                echo "Branch Delivered:";
                $dropdown = "<td><select name='branch' onchange='this.form.submit()'>";
                $dropdown .= "\r\n<option value='{$_SESSION['weekly_branch']}'>{$_SESSION['weekly_branch']}</option>";
                $dropdown .= "\r\n<option value=''>All Branches</option>";
                $dropdown .= "\r\n<option value=''>__________</option>";                while($row = mysql_fetch_array($result)) {
                    $dropdown .= "\r\n<option value='{$row['branch_name']}'>{$row['branch_name']}</option>";
                }
                $dropdown.= "\r\n</select></td>";
                echo $dropdown;
            }            ?>
            Month: <select name="weekly_month" onchange='this.form.submit()'><option value="<?php echo $_SESSION['weekly_month'];?>"><?php echo $_SESSION['weekly_month'];?></option>                <option value="January">January</option>                <option value="February">February</option>                <option value="March">March</option>                <option value="April">April</option>                <option value="May">May</option> <option value="June">June</option><option value="July">July</option>                <option value="August">August</option>                <option value="September">September</option>                <option value="October">October</option>                <option value="November">November</option>                <option value="December">December</option>            </select>            Year: <select name="weekly_year" onchange='this.form.submit()'>                <option value="<?php echo $_SESSION['weekly_year'];?>"><?php echo $_SESSION['weekly_year'];?></option>                <option value="2011">2011</option>                <option value="2012">2012</option>                <option value="2013">2013</option>                <option value="2014">2014</option>                <option value="2015">2015</option>                <option value="2016">2016</option>                <option value="2017">2017</option>                <option value="2018">2018</option>                <option value="2019">2019</option>                <option value="2020">2020</option>            </select>            <?php            echo "</form><br>";            ?>            <div class="block">                <table class="data display datatable" id="example">                    <?php                    echo "<thead>";
                    echo "<th>Supplier Name</th>";
                    $query="SELECT date_delivered FROM sup_deliveries where month_delivered='".$_SESSION['weekly_month']."' and year_delivered='".$_SESSION['weekly_year']."' group by  date_delivered";
                    $result=mysql_query($query);                    while($row = mysql_fetch_array($result)) {
                        $newDate=date("M d", strtotime($row['date_delivered']));
                        echo "<th>".$newDate."</th>";
                        array_push($wp_array,$row['date_delivered']);
                    }                    echo









                    "<th id='total'>TOTAL</th>";
                    echo "</thead>";
                    $query="SELECT * FROM sup_deliveries where month_delivered='".$_SESSION['weekly_month']."' and year_delivered='".$_SESSION['weekly_year']."' and branch_delivered like '%".$_SESSION['weekly_branch']."%' group by supplier_name";
                    $result=mysql_query($query);                    while($row = mysql_fetch_array($result)) {
                        array_push($branch_array,$row['supplier_name']);
                    }                    $deliveries_array









                            =array();
                    if($_SESSION['usertype']=='Super User') {
                        $query3="SELECT supplier_name,sum(weight),date_delivered FROM sup_deliveries  where month_delivered='".$_SESSION['weekly_month']."' and year_delivered='".$_SESSION['weekly_year']."' and wp_grade like '%".$_SESSION['weekly_wp_grade']."%' and branch_delivered like '%".$_SESSION['weekly_branch']."%' group by supplier_name,date_delivered";
                    }else {
                        $query3="SELECT supplier_name,sum(weight),date_delivered FROM sup_deliveries  where month_delivered='".$_SESSION['weekly_month']."' and year_delivered='".$_SESSION['weekly_year']."' and wp_grade like '%".$_SESSION['weekly_wp_grade']."%' and branch_delivered = '".$_SESSION['user_branch']."' group by supplier_name,date_delivered";
                    }                    $result3









                            =mysql_query($query3);                    while($row3 = mysql_fetch_array($result3)) {
                        $deliveries_array[$row3['supplier_name']."+".$row3['date_delivered']]=$row3['sum(weight)'];
                    }                    foreach









                    ($branch_array as $value2) {
                        $total_per_branch=0;
                        echo "<tr class='data'>";
                        echo "<td class='data' >".$value2."</td>";
                        foreach($wp_array as $value) {
                            $key_finder=$value2."+".$value;
                            if(!empty($deliveries_array[$key_finder])) {
                                echo "<td>".round($deliveries_array[$key_finder],1)."</td>";
                                $total_per_branch=$total_per_branch+$deliveries_array[$key_finder];
                            }else {
                                echo "<td>-</td>";
                            }
                        }
    echo
    "<td class='total'>".$total_per_branch."</td>";
    echo "</tr>";
}                    /*                    echo "<tr>";                    echo "<td id='totalFooter'>.TOTAL.</td>";                    if($_SESSION['usertype']=='Super User') {                        $query3="SELECT sum(weight) FROM sup_deliveries  where month_delivered='".$_SESSION['weekly_month']."' and year_delivered='".$_SESSION['weekly_year']."' and wp_grade like '%".$_SESSION['weekly_wp_grade']."%' and branch_delivered like '%".$_SESSION['weekly_branch']."%' group by date_delivered order by date_delivered asc";                    }else {                        $query3="SELECT sum(weight) FROM sup_deliveries  where month_delivered='".$_SESSION['weekly_month']."' and year_delivered='".$_SESSION['weekly_year']."' and wp_grade like '%".$_SESSION['weekly_wp_grade']."%' and branch_delivered = '".$_SESSION['user_branch']."' group by date_delivered order by date_delivered asc";                    }                    $result3=mysql_query($query3);                    $overall=0;                    while($row3 = mysql_fetch_array($result3)) {                        echo "<td id='totalFooter'>".number_format($row3['sum(weight)'],1)."</td>";                        $overall+=$row3['sum(weight)'];                    }                    echo "<td id='totalFooter'>".number_format($overall,1)."</td>";                    echo "</tr>"*/                    ?>                </table>            </div>        </div>    </div>