<?php

include("templates/template.php");
$start_date=$_POST['start_date'];
$end_date=$_POST['end_date'];
$wp_grade=$_POST['wp_grade'];
?>

<style>
    #total{
        font-weight: bold;
        background-color: yellow;
    }
    .mini_table td{
        border-width:1px;
        border-right: solid;

    }

    .mini_table tr{

        border-bottom: solid;
        border-width:1px;
        text-align:right;
        font-size: 12px;
    }

    .mini_table th{

        padding-right : 14px;
    }
</style>
<?php
$sql = mysql_query("SELECT * FROM pricing_against_competitors WHERE company_type='branch' GROUP BY company");
while($row = mysql_fetch_array($sql)) {
    $branch = $row['company'];

    ?>
<div class="grid_10">
    <div class="box round first grid">
            <?php
           

            echo "<h2>Supplier Deliveries to Competitors Report for the period <u><b><i>$start_date to $end_date</i></b></u> on $wp_grade for $branch</h2>";


            ?>
        <table class="data display datatable" id="example">
                <?php
                echo "<thead>";
                echo '<tr class="data">';
                echo "<th>Competitor</th>";
                echo "<th>Competitor's Price <br> (min-max)</th>";
                echo "<th>Capacity of Suppliers Affected</th>";

                echo "<th>Number of Suppliers Affected</th>";
                echo "<th>Tons we are not Getting</th>";
                echo "<th>Tons we are not Getting Breakdown</th>";
                echo "</tr>";

                echo "</thead>";
                include("config.php");


                $total1 = '';
                $total2 = '';
                $total3 = '';

                if($branch=='Quezon City') {
                    $query = "SELECT * FROM pricing_against_competitors where date <='$end_date' and wp_grade='$wp_grade' and approved_status='approved' and company!='$branch' order by date asc";

                }else {
                    $query = "SELECT * FROM pricing_against_competitors where  date <='$end_date' and wp_grade='$wp_grade' and approved_status='approved' and company!='$branch' order by date asc";

                }
                $result=mysql_query($query);
                while($row = mysql_fetch_array($result)) {
                  
              
                    $array_competitor_price[$row['company']]=$row['price']."-".$row['max_price'];
                }

                $array_competitors=array();


                if($branch=='Quezon City') {
                    $query = "SELECT * FROM supplier_capacity join supplier_details on supplier_capacity.supplier_id=supplier_details.supplier_id where supplier_capacity.date_effective <='$end_date' and supplier_capacity.wp_grade='$wp_grade' and (supplier_details.branch='Sauyo' or supplier_details.branch='Kaybiga') group by supplier_capacity.delivers_to";
                }else {
                    $query = "SELECT * FROM supplier_capacity join supplier_details on supplier_capacity.supplier_id=supplier_details.supplier_id where supplier_capacity.date_effective <='$end_date' and supplier_capacity.wp_grade='$wp_grade' and supplier_details.branch='$branch' group by supplier_capacity.delivers_to";

                }

                $result=mysql_query($query);
                while($row = mysql_fetch_array($result)) {

                    array_push($array_competitors,$row['delivers_to']);
                }
                // array_push($array_competitors,"");
                $array_suppliers_with_competitors=array();
                $array_price_per_supplier=array();
                if($branch=='Quezon City') {
                    $query = "SELECT * FROM supplier_capacity join supplier_details on supplier_capacity.supplier_id=supplier_details.supplier_id where supplier_capacity.date_effective >= '$start_date' and supplier_capacity.date_effective <='$end_date' and supplier_capacity.wp_grade='$wp_grade' and (supplier_details.branch='Sauyo' or supplier_details.branch='Kaybiga') order by supplier_capacity.date_effective asc";
                }else {
                    $query = "SELECT * FROM supplier_capacity join supplier_details on supplier_capacity.supplier_id=supplier_details.supplier_id where supplier_capacity.date_effective >= '$start_date' and supplier_capacity.date_effective <='$end_date' and supplier_capacity.wp_grade='$wp_grade' and supplier_details.branch='$branch' order by supplier_capacity.date_effective asc";

                }
                $result=mysql_query($query);
                while($row = mysql_fetch_array($result)) {
                    $array_suppliers_with_competitors[$row['supplier_id']]=$row['delivers_to']."+".$row['potential_to_lose']."+".$row['capacity']."+".$row['competitor_price'];
                }
                $array_deliveries_to_competitors=array();



                foreach($array_competitors as $competitor) {

                    $total_capacity=0;
                    $total_potential_to_lose=0;
                    $total_head_count=0;
                    $price_of_supplier='';

                    foreach($array_suppliers_with_competitors as $supplier_with_competitor) {
                        $element_array=preg_split("/[+]/",$supplier_with_competitor);
                        $competitor_of_the_supplier=$element_array[0];
                        if($competitor_of_the_supplier==$competitor) {
                            $total_capacity+=$element_array[2];
                            $total_potential_to_lose+=$element_array[1];
                            $total_head_count++;
                            if($element_array[3]!='') {
                                $price_of_supplier.=$element_array[3]."~".$element_array[1].",";

                            }else {
                                $price_of_supplier.="0"."~".$element_array[1].",";
                            }

                        }

                    }

                    $price_of_supplier=  substr_replace($price_of_supplier ,"",-1);
                    array_push($array_deliveries_to_competitors,$competitor."+".$total_capacity."+".$total_potential_to_lose."+".$total_head_count."+".$price_of_supplier);
                }


                foreach($array_deliveries_to_competitors as $deliveries_to_competitors) {
                    echo "<tr>";
                    $deliveries_to_competitors_element=preg_split("/[+]/",$deliveries_to_competitors);
                    if ($deliveries_to_competitors_element[0]=='') {
                        echo "<td>UNDEFINED</td>";
                    }
                    else {
                        echo "<td>".$deliveries_to_competitors_element[0]."</td>";
                    }
                    if(!empty($array_competitor_price[$deliveries_to_competitors_element[0]])) {
                        echo "<td>".$array_competitor_price[$deliveries_to_competitors_element[0]]."</td>";
                    }else {
                        echo "<td></td>";
                    }

                    echo "<td>".$deliveries_to_competitors_element[1]."</td>";

                    echo "<td>".$deliveries_to_competitors_element[3]."</td>";
                    echo "<td>".$deliveries_to_competitors_element[2]."</td>";

                    $price_breakdown=preg_split("/[,]/",$deliveries_to_competitors_element[4]);

                    echo "<td>";
                    $array_of_prices=array();

                    foreach ($price_breakdown as $brkdwn) {
                        $brkdwn_element=preg_split("/[~]/",$brkdwn);
                        $price=$brkdwn_element[0];
                        array_push($array_of_prices,$price);

                    }


                    $array_of_prices=array_unique($array_of_prices);

                    $array_of_price_with_tonnage_final=array();
                    foreach($array_of_prices as $price_element) {
                        $tons_not_getting_at_price=0;
                        $head_count=0;
                        foreach ($price_breakdown as $brkdwn) {
                            $brkdwn_element=preg_split("/[~]/",$brkdwn);
                            $price=$brkdwn_element[0];
                            if($price==$price_element) {
                                if(!empty($brkdwn_element[1])) {
                                    $tons_not_getting_at_price+=$brkdwn_element[1];

                                }
                                $head_count++;
                            }

                        }

                        array_push($array_of_price_with_tonnage_final,$price_element."+".$tons_not_getting_at_price."+".$head_count);
                    }

                    echo "<table border=1 class='mini_table'>";
                    echo "<tr>";
                    echo "<th>Price</th>";
                    echo "<th>Tonnage</th>";
                    echo "<th>Head Count</th>";
                    echo "</tr>";
                    foreach($array_of_price_with_tonnage_final as $tonnage_with_price) {
                        echo "<tr>";
                        $tonnage_with_price_element=preg_split("/[+]/",$tonnage_with_price);
                        echo "<td>".$tonnage_with_price_element[0]."</td>";
                        echo "<td>".$tonnage_with_price_element[1]."</td>";
                        echo "<td>".$tonnage_with_price_element[2]."</td>";

                        echo "</tr>";

                    }





                    echo "</table>";

                    echo "</td>";


                    echo "</tr>";
                    $total1 +=$deliveries_to_competitors_element[1];

                    $total3 +=$deliveries_to_competitors_element[3];
                    $total2 +=$deliveries_to_competitors_element[2];

                }

                echo "<tr id='total'>";
                echo "<td>!TOTAL!</td>";
                echo "<td></td>";
                echo "<td>$total1</td>";

                echo "<td>$total3</td>";
                echo "<td>$total2</td>";
                echo "<td></td>";


                echo "</tr>";

                ?>







        </table>

    </div>
</div>

    <?php
}
?>
<div class="clear">

</div>
