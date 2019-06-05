<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
    function date1(str) {
        new JsDatePick({
            useMode: 2,
            target: str,
            dateFormat: "%Y/%m/%d"

        });
    }
    ;
</script>

<style>
    body{
        font-size: 30px;
    }
    input{
        font-size: 30px;
    }
</style>
<center>
    <h1>
        <body>

            <?php
            date_default_timezone_set("Asia/Singapore");
            include('config.php');
            $sup_id = $_POST['sup_id'];
            $type = $_POST['type'];
            $wp_grade = $_POST['wp_grade'];
            $scheme = $_POST['scheme'];
            $quota = $_POST['quota'];
            $incentive = $_POST['incentive'];

            echo "<h3>" . $sup_id . '_' . $_POST['supplier_name'] . "<br>" . $wp_grade . "</h3>" . "<h4>Incentive date range selection</h4><br>";
            ?>
            <form action="" method="POST">
                <input type='hidden'  name='sup_id' value="<?php echo $sup_id; ?>">
                <input type='hidden'  name='type' value="<?php echo $type; ?>">
                <input type='hidden'  name='wp_grade' value="<?php echo $wp_grade; ?>">
                <input type='hidden'  name='scheme' value="<?php echo $scheme; ?>">
                <input type='hidden'  name='incentive' value="<?php echo $incentive; ?>">

                From: <input type='text'  id='inputField' name='from' value="" onfocus='date1(this.id);' readonly required><br>
                TO: <input type='text'  id='inputField2' name='to' value="" onfocus='date1(this.id);' readonly required><br>
                Base Price: <input type='number' name='base_price' value="" step="any" required><br>
                Quota(Kg): <input type='number'  name='quota' value="" step="any" required><br><br>
                <input type="submit" value="Renew Incentive" name="submit">
            </form>
            <?php
            if (isset($_POST['submit'])) {
                $sup_id = $_POST['sup_id'];
                $scheme = date('Y/m/d', strtotime($_POST['from'])) . "-" . date('Y/m/d', strtotime($_POST['to']));
                $start_date = date('Y/m/d', strtotime($_POST['from']));
                $end_date = date('Y/m/d', strtotime($_POST['to']));
                $quota = $_POST['quota'];
                $base_price = $_POST['base_price'];
                $incentive = $_POST['incentive'];
                $covered_incentive = '';
                $wp_grade = $_POST['wp_grade'];
                $type = $_POST['type'];
//                echo $wp_grade."-asdsd";
//
                if ($wp_grade == 'all_without_lcwl') {
                    $query2 = "SELECT sum(weight) FROM sup_deliveries where supplier_id='" . $sup_id . "'and wp_grade NOT LIKE '%LCWL%' and date_delivered between '" . $start_date . "' and '" . $end_date . "' group by wp_grade";
                } else if ($wp_grade == 'all_without_occ') {
                    $query2 = "SELECT sum(weight) FROM sup_deliveries where supplier_id='" . $sup_id . "'and wp_grade NOT LIKE '%OCC%' and date_delivered between '" . $start_date . "' and '" . $end_date . "' group by wp_grade";
                } else {
                    $query2 = "SELECT sum(weight) FROM sup_deliveries where supplier_id='" . $sup_id . "'and wp_grade='" . $wp_grade . "' and date_delivered between '" . $start_date . "' and '" . $end_date . "' group by wp_grade";
                }
                $result2 = mysql_query($query2);
                $row2 = mysql_fetch_array($result2);
                $current_deliveries = $row2['sum(weight)'];
//
                if ($wp_grade == 'all_grades') {
                    $filter_grade = '';
                } else {
                    $filter_grade = $wp_grade;
                }
                $wp_array = array();
                if ($wp_grade == 'all_without_lcwl') {
                    $sql_wp = mysql_query("SELECT * FROM paper_buying WHERE supplier_id='$sup_id' and wp_grade NOT like '%LCWL%' and date_received<='" . date("Y/m/d") . "'  and branch!='' and paper_buying > 0  GROUP BY wp_grade");
                } else {
                    $sql_wp = mysql_query("SELECT * FROM paper_buying WHERE supplier_id='$sup_id' and wp_grade like '%$filter_grade%' and date_received<='" . date("Y/m/d") . "'  and branch!='' and paper_buying > 0  GROUP BY wp_grade");
                }
                while ($rs_wp = mysql_fetch_array($sql_wp)) {
                    array_push($wp_array, $rs_wp['wp_grade']);
                }
                
                $wp_prices = '';
                $count = count($wp_array);
                $ctr = 1;
                foreach ($wp_array as $wp) {
                    if ($wp_grade == 'all_without_lcwl') {
                        $sql_prices = mysql_query("SELECT * FROM paper_buying WHERE supplier_id='$sup_id' and wp_grade NOT LIKE '%LCWL%' and date_received<='" . date("Y/m/d") . "'  and branch!='' and paper_buying > 0 ORDER BY date_received DESC");
                    } else {
                        $sql_prices = mysql_query("SELECT * FROM paper_buying WHERE supplier_id='$sup_id' and wp_grade='$wp' and date_received<='" . date("Y/m/d") . "'  and branch!='' and paper_buying > 0  ORDER BY date_received DESC");
                    
//                        echo "SELECT * FROM paper_buying WHERE supplier_id='$sup_id' and wp_grade='$wp' and date_received<='" . date("Y/m/d") . "'  and branch!='' and paper_buying > 0  ORDER BY date_received DESC";
                    }
                    $rs_prices = mysql_fetch_array($sql_prices);
                    if ($wp_prices == '') {
                        if ($count == $ctr) {
                            $wp_prices.=$wp . ':' . $rs_prices['unit_cost'];
                        } else {
                            $wp_prices.=$wp . ':' . $rs_prices['unit_cost'] . '&nbsp;&nbsp;|';
                        }
                    } else if ($count == $ctr) {
                        $wp_prices.='&nbsp;&nbsp;' . $wp . ':' . $rs_prices['unit_cost'];
                    } else {
                        $wp_prices.='&nbsp;&nbsp;' . $wp . ':' . $rs_prices['unit_cost'] . '&nbsp;&nbsp;|';
                    }
                    $ctr++;
                }

                mysql_query("INSERT INTO incentive_scheme(sup_id,scheme,start_date,end_date,quota,current_deliveries,base_price,incentive,covered_incentive,wp_grade,wp_prices,type,confirm)
                         VALUES('$sup_id','$scheme','$start_date','$end_date','$quota','$current_deliveries','$base_price','$incentive','$covered_incentive','$wp_grade','$wp_prices','$type','1')") or die(mysql_error());
                echo '<script>
                    alert("Successful");
                    location.replace("inc_deliveries.php");
                    </script>';
            }
            ?>
        </body>
    </h1>
</center>