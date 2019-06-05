<?php include("templates/template.php"); ?>


<style>    table{        font-size:12.5px;    }    .total{        background-color: yellow;        font-weight: bold;    }    #totalFooter{        background-color: yellow;        font-weight: bold;    }</style><?php include("config.php");
$wp_array=array();
$branch_array=array();?><div class="grid_10">    <div class="box round first grid">        <h2>            <?php $ngayon=date('F d, Y');
            echo "<h2> Branch Receiving for ".date('F')." as of : <u><b><i>".$ngayon."</i></b></u></h2>"; ?></h2>                  <?php            echo "<form action='weekly_filter.php' method='POST'>";            ?>            Month: <select name="weekly_month" onchange='this.form.submit()'>                <option value="<?php echo $_SESSION['weekly_month'];?>"><?php echo $_SESSION['weekly_month'];?></option>                <option value="January">January</option>                <option value="February">February</option>                <option value="March">March</option>                <option value="April">April</option>                <option value="May">May</option>                <option value="June">June</option>                <option value="July">July</option>                <option value="August">August</option>                <option value="September">September</option>                <option value="October">October</option>                <option value="November">November</option>                <option value="December">December</option>            </select>            Year: <select name="weekly_year" onchange='this.form.submit()'>                <option value="<?php echo $_SESSION['weekly_year'];?>"><?php echo $_SESSION['weekly_year'];?></option>                <option value="2011">2011</option>                <option value="2012">2012</option>                <option value="2013">2013</option>                <option value="2014">2014</option>                <option value="2015">2015</option>                <option value="2016">2016</option>                <option value="2017">2017</option>                <option value="2018">2018</option>                <option value="2019">2019</option>                <option value="2020">2020</option>            </select>            <?php            echo "</form><br>";            ?>                <table class="data display datatable" id="example">                    <?php                    echo "<thead>";
                    echo "<th>Branch Name</th>";
                    $query="SELECT UCASE(wp_grade) as wp_grade  FROM sup_deliveries where month_delivered='".$_SESSION['weekly_month']."' and year_delivered='".$_SESSION['weekly_year']."' group by wp_grade order by wp_grade asc";
                    $result=mysql_query($query);
                    while($row = mysql_fetch_array($result)) {
                        echo "<th>".$row['wp_grade']."</th>";
                        array_push($wp_array,$row['wp_grade']);
                    }                    echo




                    "<th id='total'>TOTAL</th>";
                    echo "</thead>";
                    $query="SELECT UCASE(branch_name) FROM branches";
                    $result=mysql_query($query);
                    while($row = mysql_fetch_array($result)) {
                        array_push($branch_array,$row['UCASE(branch_name)']);
                    }
                    $deliveries_array=array();
                    $query3="SELECT UCASE(branch_delivered),sum(weight),UCASE(wp_grade) as wp_grade FROM sup_deliveries  where month_delivered='".$_SESSION['weekly_month']."' and year_delivered='".$_SESSION['weekly_year']."' group by branch_delivered,wp_grade";
                    $result3=mysql_query($query3);
                    while($row3 = mysql_fetch_array($result3)) {
                        $deliveries_array[$row3['UCASE(branch_delivered)']."+".$row3['wp_grade']]=$row3['sum(weight)'];
                    }
                    foreach($branch_array as $value2) {
                        $total_per_branch=0;
                        echo "<tr class='data'>";
                        echo "<td class='data' width=30px>".$value2."</td>";
                        foreach($wp_array as $value) {
                            $key_finder=$value2."+".$value;
                            if(!empty($deliveries_array[$key_finder])) {
                                echo "<td>".number_format($deliveries_array[$key_finder],1)."</td>";
                                $total_per_branch=$total_per_branch+$deliveries_array[$key_finder];
                            }else {
                                echo "<td>-</td>";
                            }
                        }
                        echo
                        "<td class='total'>".number_format($total_per_branch,1)."</td>";
                        echo "</tr>";
                    }
                    echo "<tr>";
                    echo "<td id='totalFooter'>z_TOTAL_z</td>";
                    $query3="SELECT sum(weight),UCASE(wp_grade) as wp_grade  FROM sup_deliveries where month_delivered='".$_SESSION['weekly_month']."' and year_delivered='".$_SESSION['weekly_year']."' group by wp_grade";
                    $result3=mysql_query($query3);
                    $overall=0;
                    while($row3 = mysql_fetch_array($result3)) {
                        echo "<td id='totalFooter'>".number_format($row3['sum(weight)'],1)."</td>";
                        $overall+=$row3['sum(weight)'];
                    }                    echo












"<td id='totalFooter'>".number_format($overall,1)."</td>";
echo "</tr>"                    ?>                </table>            </div>        </div>
<div class="clear">

</div>

<div class="clear">

</div>
<div class="clear">

</div>