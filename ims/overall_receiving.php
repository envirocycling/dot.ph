<style>
    table{

        font-size:12.5px;
        text-align:right;

    }

</style>

<?php
date_default_timezone_set('America/Los_Angeles');
include("templates/template.php");
$_SESSION['selected_grade']='lcwl';
include("config.php");
?>
<div id="container" class="clear">
    <div id="content">
        <?php
        include("searchForm.php");
        $ngayon=date('m/d/y');
        echo "<h2> White Ledger Deliveries as of : <u><b><i>".$ngayon."</i></b></u></h2>";

        include("summary.php");

        ?>
        <table summary="Summary Here" cellpadding="0" cellspacing="0" border="2">
            <?php
            $months_array=array("January","February","March","April","May","June","July","August","September","October","November","December");
            echo "<thead>";
            echo "<th>Supplier Name</th>";
            foreach ($months_array as $value) {
                echo "<th>".$value."</th>";
            }
            echo "<th id='total'>TOTAL</th>";
            echo "</thead>";


            $query="SELECT supplier_name,count(supplier_name) FROM sup_deliveries  where  supplier_id like '".$_SESSION['supplier_id']."%' and branch_delivered like '%".$_SESSION['supplier_branch']."%' and supplier_name like '%".$_SESSION['supplier_name']."%' and branch_delivered like '%".$_SESSION['supplier_branch']."%' and supplier_type like '%".$_SESSION['supplier_type']."%'  and bh_in_charge like '".$_SESSION['bh_criteria']."%' group by supplier_name order by supplier_name asc,del_id asc;";
            $result=mysql_query($query);
            $supplier_array=array();
            while($row = mysql_fetch_array($result)) {
                array_push($supplier_array,$row['supplier_name']) ;
                $head_count=$row['count(supplier_name)'];
            }


            $deliveries_array=array();

            $query3="SELECT supplier_id,del_id,supplier_name,sum(weight),month_delivered FROM sup_deliveries  where   supplier_id like '".$_SESSION['supplier_id']."%' and branch_delivered like '%".$_SESSION['supplier_branch']."%' and supplier_name like '%".$_SESSION['supplier_name']."%'  and supplier_type like '%".$_SESSION['supplier_type']."%'  and  year_delivered ='".$_SESSION['yearcriteria']."'  and bh_in_charge like '".$_SESSION['bh_criteria']."%' group by supplier_name,month_delivered order by supplier_name asc,del_id asc;";
            $result3=mysql_query($query3);

            while($row3 = mysql_fetch_array($result3)) {
                $deliveries_array[$row3['supplier_name']."+".$row3['month_delivered']]=$row3['sum(weight)'];
            }

            $overall_total=0;
            $january_total=0;
            $february_total=0;
            $march_total=0;
            $april_total=0;
            $may_total=0;
            $june_total=0;
            $july_total=0;
            $august_total=0;
            $september_total=0;
            $october_total=0;
            $november_total=0;
            $december_total=0;


            foreach($supplier_array as $value2) {
                $total_per_sup=0;
                echo "<tr class='dark'>";
                echo "<td>".$value2."</td>";
                foreach($months_array as $value) {
                    $key_finder=$value2."+".$value;
                    if(!empty($deliveries_array[$key_finder])) {
                        echo "<td>".number_format($deliveries_array[$key_finder],1)."</td>";
                        $total_per_sup=$total_per_sup+$deliveries_array[$key_finder];
                        if($value=='January') {
                            $january_total=$january_total+$deliveries_array[$key_finder];
                        }else if($value=='February') {
                            $february_total=$february_total+$deliveries_array[$key_finder];
                        }else if($value=='March') {
                            $march_total=$march_total+$deliveries_array[$key_finder];
                        }else if($value=='April') {
                            $april_total=$april_total+$deliveries_array[$key_finder];
                        }else if($value=='May') {
                            $may_total=$may_total+$deliveries_array[$key_finder];
                        }
                        else if($value=='June') {
                            $june_total=$june_total+$deliveries_array[$key_finder];
                        }
                        else if($value=='July') {
                            $july_total=$july_total+$deliveries_array[$key_finder];
                        }
                        else if($value=='August') {
                            $august_total=$august_total+$deliveries_array[$key_finder];
                        }else if($value=='September') {
                            $september_total=$september_total+$deliveries_array[$key_finder];
                        }else if($value=='October') {
                            $october_total=$october_total+$deliveries_array[$key_finder];
                        }else if($value=='November') {
                            $november_total=$november_total+$deliveries_array[$key_finder];
                        }else if($value=='December') {
                            $december_total=$december_total+$deliveries_array[$key_finder];
                        }


                    }else {
                        echo "<td>-</td>";
                    }

                }
                echo "<td class='total'>".number_format($total_per_sup,1)."</td>";
                $overall_total=$overall_total+$total_per_sup;
                echo "</tr>";
            }

            echo "<tr id='total'>";
            echo "<td>TOTAL</td>";
            echo "<td>".number_format($january_total,1)."</td>";
            echo "<td>".number_format($february_total,1)."</td>";
            echo "<td>".number_format($march_total,1)."</td>";
            echo "<td>".number_format($april_total,1)."</td>";
            echo "<td>".number_format($may_total,1)."</td>";
            echo "<td>".number_format($june_total,1)."</td>";
            echo "<td>".number_format($july_total,1)."</td>";
            echo "<td>".number_format($august_total,1)."</td>";
            echo "<td>".number_format($september_total,1)."</td>";
            echo "<td>".number_format($october_total,1)."</td>";
            echo "<td>".number_format($november_total,1)."</td>";
            echo "<td>".number_format($december_total,1)."</td>";
            echo "<td>".number_format($overall_total,1)."</td>";
            echo "</tr>";




            echo "<tr id='total'>";
            echo "<td>Average</td>";
            echo "<td>".number_format($january_total/$head_count,1)."</td>";
            echo "<td>".number_format($february_total/$head_count,1)."</td>";
            echo "<td>".number_format($march_total/$head_count,1)."</td>";
            echo "<td>".number_format($april_total/$head_count,1)."</td>";
            echo "<td>".number_format($may_total/$head_count,1)."</td>";
            echo "<td>".number_format($june_total/$head_count,1)."</td>";
            echo "<td>".number_format($july_total/$head_count,1)."</td>";
            echo "<td>".number_format($august_total/$head_count,1)."</td>";
            echo "<td>".number_format($september_total/$head_count,1)."</td>";
            echo "<td>".number_format($october_total/$head_count,1)."</td>";
            echo "<td>".number_format($november_total/$head_count,1)."</td>";
            echo "<td>".number_format($december_total/$head_count,1)."</td>";
            echo "<td>".number_format($overall_total/$head_count,1)."</td>";

            echo "</tr>";








            ?>







        </table>

    </div>
</div>