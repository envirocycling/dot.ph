<?php

include('templates/template.php');

$_SESSION['current_month']=date('F');
$_SESSION['supplier_branch']="";
$_SESSION['supplier_name']="";
$_SESSION['supplier_type']="";
$_SESSION['supplier_id']="";
include ('config.php');


?>

<div class="wrapper col1">
    <div id="featured_slide">

        <div id="slider">
            <ul id="categories">
                <li class="category">
                    <h2>Overall</h2>
                    <?php
                    $ngayon=date('m/d/y');
                    echo "<h2>Deliveries as of : <u><b><i>".$ngayon."</i></b></u></h2>";

                    $query="SELECT supplier_type,format(sum(weight),2),sum(weight) FROM sup_deliveries  where wp_grade= 'lcwl' and supplier_type !='0' and month_delivered='".$_SESSION['current_month']."' group by supplier_type;";
                    $result=mysql_query($query);
                    echo "<table border=2>";
                    echo "<thead>";

                    echo "<th>Supplier Type</th>";
                    echo "<th>Tonnage</th>";
                    echo "</thead>";
                    $total=0;
                    while($row = mysql_fetch_array($result)) {
                        echo "<tr class='light'>";
                        echo "<td>".$row['supplier_type']."</td>";
                        echo "<td>".$row['format(sum(weight),2)']."</td>";
                        $val=$row['format(sum(weight),2)'];
                        echo "</tr>";
                        $total=$total+$row['sum(weight)'];
                    }
                    echo "<tr>
                        <th>Total</th>";
                    echo "<td>".number_format($total,2)."</td>";
                    echo "</tr>";

                    echo "</table>";

                    ?>

                    <p class="readmore"><a href="overall_receiving.php">View whole record &raquo;</a></p>


                </li>
                <li class="category">
                    <h2>With Incentives</h2>
                    <?php
                    $ngayon=date('m/d/y');
                    echo "<h2>Deliveries as of : <u><b><i>".$ngayon."</i></b></u></h2>";

                    $query="SELECT scheme,format(sum(deliveries),2) as deliveries,sum(deliveries) from incentive_scheme group by scheme";
                    $result=mysql_query($query);
                    echo "<table border=2>";
                    echo "<thead>";

                    echo "<th>Scheme Type</th>";
                    echo "<th>Total Tonnage</th>";
                    echo "</thead>";
                    $total=0;
                    while($row = mysql_fetch_array($result)) {
                        echo "<tr class='light'>";
                        echo "<td>".$row['scheme']."</td>";
                        echo "<td>".$row['deliveries']."</td>";

                        echo "</tr>";
                        $total=$total+$row['sum(deliveries)'];

                    }
                    echo "<tr>";
                    echo "<th>TOTAL</th>";
                    echo "<td>".number_format($total,2)."</td>";
                    echo "</tr>";

                    echo "</table>";

                    ?>


                    <p class="readmore"><a href="inc_deliveries.php">View whole record &raquo;</a></p>


                </li>
                <li class="category">
                    <h2>WL</h2>
                    <?php
                    $ngayon=date('m/d/y');
                    echo "<h2>Deliveries as of : <u><b><i>".$ngayon."</i></b></u></h2>";

                    $query="SELECT supplier_type,format(sum(weight),2),sum(weight) FROM sup_deliveries  where wp_grade= 'lcwl' and supplier_type !='0' and month_delivered='".$_SESSION['current_month']."' group by supplier_type;";
                    $result=mysql_query($query);
                    echo "<table border=2>";
                    echo "<thead>";

                    echo "<th>Supplier Type</th>";
                    echo "<th>Tonnage</th>";
                    echo "</thead>";
                    $total=0;
                    while($row = mysql_fetch_array($result)) {
                        echo "<tr class='light'>";
                        echo "<td>".$row['supplier_type']."</td>";
                        echo "<td>".$row['format(sum(weight),2)']."</td>";
                        $val=$row['format(sum(weight),2)'];
                        echo "</tr>";
                        $total=$total+$row['sum(weight)'];
                    }
                    echo "<tr>
                        <th>Total</th>";
                    echo "<td>".number_format($total,2)."</td>";
                    echo "</tr>";

                    echo "</table>";

                    ?>


                    <p class="readmore"><a href="wl_receiving.php">View whole record &raquo;</a></p>


                </li>


                <li class="category">
                    <h2>ONP</h2>
                    <?php
                    $ngayon=date('m/d/y');
                    echo "<h2>Deliveries as of : <u><b><i>".$ngayon."</i></b></u></h2>";

                    $query="SELECT supplier_type,format(sum(weight),2),sum(weight) FROM sup_deliveries  where wp_grade= 'onp' and supplier_type !='0' and month_delivered='".$_SESSION['current_month']."' group by supplier_type;";
                    $result=mysql_query($query);
                    echo "<table border=2>";
                    echo "<thead>";

                    echo "<th>Supplier Type</th>";
                    echo "<th>Tonnage</th>";
                    echo "</thead>";
                    $total=0;
                    while($row = mysql_fetch_array($result)) {
                        echo "<tr class='light'>";
                        echo "<td>".$row['supplier_type']."</td>";
                        echo "<td>".$row['format(sum(weight),2)']."</td>";
                        $val=$row['format(sum(weight),2)'];
                        echo "</tr>";
                        $total=$total+$row['sum(weight)'];
                    }
                    echo "<tr>
                        <th>Total</th>";
                    echo "<td>".number_format($total,2)."</td>";
                    echo "</tr>";

                    echo "</table>";

                    ?>


                    <p class="readmore"><a href="onp_receiving.php">View whole record &raquo;</a></p>


                </li>


                <li class="category">
                    <h2>CBS</h2>
                    <?php
                    $ngayon=date('m/d/y');
                    echo "<h2>Deliveries as of : <u><b><i>".$ngayon."</i></b></u></h2>";

                    $query="SELECT supplier_type,format(sum(weight),2),sum(weight) FROM sup_deliveries  where wp_grade= 'lcwl' and supplier_type !='0' and month_delivered='".$_SESSION['current_month']."' group by supplier_type;";
                    $result=mysql_query($query);
                    echo "<table border=2>";
                    echo "<thead>";

                    echo "<th>Supplier Type</th>";
                    echo "<th>Tonnage</th>";
                    echo "</thead>";
                    $total=0;
                    while($row = mysql_fetch_array($result)) {
                        echo "<tr class='light'>";
                        echo "<td>".$row['supplier_type']."</td>";
                        echo "<td>".$row['format(sum(weight),2)']."</td>";
                        $val=$row['format(sum(weight),2)'];
                        echo "</tr>";
                        $total=$total+$row['sum(weight)'];
                    }
                    echo "<tr>
                        <th>Total</th>";
                    echo "<td>".number_format($total,2)."</td>";
                    echo "</tr>";

                    echo "</table>";

                    ?>


                    <p class="readmore"><a href="cbs_receiving.php">View whole record &raquo;</a></p>


                </li>

                <li class="category">
                    <h2>OCC</h2>

                    <?php
                    $ngayon=date('m/d/y');
                    echo "<h2>Deliveries as of : <u><b><i>".$ngayon."</i></b></u></h2>";

                    $query="SELECT supplier_type,format(sum(weight),2),sum(weight) FROM sup_deliveries  where wp_grade= 'lcwl' and supplier_type !='0' and month_delivered='".$_SESSION['current_month']."' group by supplier_type;";
                    $result=mysql_query($query);
                    echo "<table border=2>";
                    echo "<thead>";

                    echo "<th>Supplier Type</th>";
                    echo "<th>Tonnage</th>";
                    echo "</thead>";
                    $total=0;
                    while($row = mysql_fetch_array($result)) {
                        echo "<tr class='light'>";
                        echo "<td>".$row['supplier_type']."</td>";
                        echo "<td>".$row['format(sum(weight),2)']."</td>";
                        $val=$row['format(sum(weight),2)'];
                        echo "</tr>";
                        $total=$total+$row['sum(weight)'];
                    }
                    echo "<tr>
                        <th>Total</th>";
                    echo "<td>".number_format($total,2)."</td>";
                    echo "</tr>";

                    echo "</table>";

                    ?>




                    <p class="readmore"><a href="occ_receiving.php">View whole record &raquo;</a></p>


                </li>


                <li class="category">
                    <h2>MW</h2>

                    <?php
                    $ngayon=date('m/d/y');
                    echo "<h2>Deliveries as of : <u><b><i>".$ngayon."</i></b></u></h2>";

                    $query="SELECT supplier_type,format(sum(weight),2),sum(weight) FROM sup_deliveries  where wp_grade= 'lcwl' and supplier_type !='0' and month_delivered='".$_SESSION['current_month']."' group by supplier_type;";
                    $result=mysql_query($query);
                    echo "<table border=2>";
                    echo "<thead>";

                    echo "<th>Supplier Type</th>";
                    echo "<th>Tonnage</th>";
                    echo "</thead>";
                    $total=0;
                    while($row = mysql_fetch_array($result)) {
                        echo "<tr class='light'>";
                        echo "<td>".$row['supplier_type']."</td>";
                        echo "<td>".$row['format(sum(weight),2)']."</td>";
                        $val=$row['format(sum(weight),2)'];
                        echo "</tr>";
                        $total=$total+$row['sum(weight)'];
                    }
                    echo "<tr>
                        <th>Total</th>";
                    echo "<td>".number_format($total,2)."</td>";
                    echo "</tr>";

                    echo "</table>";

                    ?>


                    <p class="readmore"><a href="mw_receiving.php">View whole record &raquo;</a></p>


                </li>

                <li class="category">
                    <h2>CB</h2>

                    <?php
                    $ngayon=date('m/d/y');
                    echo "<h2>Deliveries as of : <u><b><i>".$ngayon."</i></b></u></h2>";

                    $query="SELECT supplier_type,format(sum(weight),2),sum(weight) FROM sup_deliveries  where wp_grade= 'lcwl' and supplier_type !='0' and month_delivered='".$_SESSION['current_month']."' group by supplier_type;";
                    $result=mysql_query($query);
                    echo "<table border=2>";
                    echo "<thead>";

                    echo "<th>Supplier Type</th>";
                    echo "<th>Tonnage</th>";
                    echo "</thead>";
                    $total=0;
                    while($row = mysql_fetch_array($result)) {
                        echo "<tr class='light'>";
                        echo "<td>".$row['supplier_type']."</td>";
                        echo "<td>".$row['format(sum(weight),2)']."</td>";
                        $val=$row['format(sum(weight),2)'];
                        echo "</tr>";
                        $total=$total+$row['sum(weight)'];
                    }
                    echo "<tr>
                        <th>Total</th>";
                    echo "<td>".number_format($total,2)."</td>";
                    echo "</tr>";

                    echo "</table>";

                    ?>

                    <p class="readmore"><a href="onp_receiving.php">View whole record &raquo;</a></p>


                </li>




            </ul>
            <a class="prev disabled"></a> <a class="next disabled"></a>
            <div style="clear:both"></div>
        </div>
    </div>
</div>
</body>
</html>
