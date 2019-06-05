<?php
include('config.php');
include('templates/template.php');
?>

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

    $(document).ready(function () {
        $(".formula").hide();
        $("#hide").click(function () {
            $(".formula").hide();
            $("#txtHint").html('<b>Click the prices to view details</b>');
        });

        $("span").click(function () {
            $(".formula").show();

            var id = $(this).attr('id');
            if (id == "") {
                document.getElementById("txtHint").innerHTML = "";
                return;
            }
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
//                    document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                    $("#txtHint").hide();
                    $("#txtHint").html(xmlhttp.responseText).fadeIn(2000);

                }
            }
            xmlhttp.open("GET", "view_avg_t.php?id=" + id, true);
            xmlhttp.send();


        });
    });
</script>
<style>
    .tbl td{
        border: 1px solid black;
        padding: 2px;
        font-size: 14px;
    }
    .head{
        background-color:gray;
        color:white;
        padding:5px;
    }
    .wp{
        font-weight: bold;
        background-color:#ebebe0;
    }
</style>
</head>
<div class="grid_5">
    <div class="box round first grid">
        <h2>Effective Price to TIPCO</h2>
        <form action="avg_transfer_price_to_tp.php" method="POST">
            <br>
            <h6>Please select your range of dates</h6>
            Start Period: <input type='text'  id='inputField' name='start_date' value="<?php
            if (isset($_POST['start_date'])) {
                echo $_POST['start_date'];
            } else {
                echo date('Y/m/d');
            }
            ?>" onfocus='date1(this.id);' readonly size="8"><br>
            End Period:<input type='text'  id='inputField2' name='end_date' value="<?php
            if (isset($_POST['end_date'])) {
                echo $_POST['end_date'];
            } else {
                echo date('Y/m/d');
            }
            ?>" onfocus='date1(this.id)
                            ;' readonly size="8"><br>
                              <?php
                              $query = "SELECT * FROM branches  ";
                              $result = mysql_query($query);
                              echo "Branch:";
                              $dropdown = "<select name='branch' >";
                              if (isset($_POST['branch'])) {
                                  if ($_POST['branch'] == '') {
                                      $dropdown .= "\r\n<option value='" . $_POST['branch'] . "'>All Branches</option>";
                                  } else {
                                      $dropdown .= "\r\n<option value='" . $_POST['branch'] . "'>" . $_POST['branch'] . "</option>";
                                  }
                              }
                              $dropdown .= "\r\n<option value=''>All Branches</option>";
                              while ($row = mysql_fetch_array($result)) {
                                  $dropdown .= "\r\n<option value='{$row['branch_name']}'>{$row['branch_name']}</option>";
                              }
                              $dropdown .= "\r\n</select><br>";
                              echo $dropdown;
                              ?>
            Prev Month/s to be show: <input type="number" name="months" value="<?php echo $_POST['months']; ?>"  size="2" min="1" max="12">
            <br>
            <input type="submit" name="submit" value="Generate Report">
        </form>
    </div>
</div>
<?php
if (isset($_POST['submit'])) {
    $start_day = $_POST['start_date'];
    $end_day = $_POST['end_date'];
    $count = $_POST['months'];


    $wp_grade_array = array('LCWL', 'ONP', 'CBS', 'OCC', 'MW', 'CHIPBOARD');

    $branches_array = array();
// 
    $sql_branch = mysql_query("SELECT * FROM branches WHERE branch_name like '%" . $_POST['branch'] . "%'");
    while ($rs_branch = mysql_fetch_array($sql_branch)) {
        array_push($branches_array, $rs_branch['branch_name']);
    }
    $avg = array();

    $tot_amount_cost = array();

    $daily_sales_ton = array();

    $buying = array();

    $tot_amount_cost_m = array();

    $daily_sales_ton_m = array();

    $buying_m = array();



    foreach ($wp_grade_array as $wp_grade) {
        $start = $start_day;
        $prev_start = date("Y/m/d", strtotime("-" . $count . " months", strtotime($start)));
        $ps_q = $prev_start;
        while ($ps_q < $start) {
            $ps_start_q = date("Y/m/", strtotime($ps_q)) . "01";
            $ps_end_q = date("Y/m/t", strtotime($ps_q));
            foreach ($branches_array as $branch) {
                $sql_price = mysql_query("SELECT * FROM tipco_prices WHERE branch='$branch' and wp_grade='$wp_grade' and date_effective<='$ps_end_q' ORDER BY date_effective DESC");
                $rs_price = mysql_fetch_array($sql_price);
                $ppr_buy = 0;
                $sql_amount_cost = mysql_query("SELECT * FROM paper_buying WHERE unit_cost>'" . $rs_price['price'] . "' and branch='$branch' and wp_grade='$wp_grade' and date_received>='$ps_start_q' and date_received<='$ps_end_q'");
                while ($rs_amount_cost = mysql_fetch_array($sql_amount_cost)) {
                    $spc_price = $rs_amount_cost['unit_cost'] - $rs_price['price'];
                    $ppr_buy += ($spc_price * $rs_amount_cost['corrected_weight']);
                }

                $tot_amount_cost_m[$wp_grade][$ps_start_q][$ps_end_q] += $ppr_buy;
            }

            if ($wp_grade != 'LCWL' && $wp_grade != 'CHIPBOARD') {
                $wp_grade_q = "LC" . $wp_grade;
            } else {
                $wp_grade_q = $wp_grade;
            }
            $sql_daily_sales = mysql_query("SELECT sum(weight) FROM actual WHERE branch like '%" . $_POST['branch'] . "%' and wp_grade='$wp_grade_q' and date>='$ps_start_q' and date<='$ps_end_q'");
            $rs_daily_sales = mysql_fetch_array($sql_daily_sales);
            $daily_sales_ton_m[$wp_grade][$ps_start_q][$ps_end_q] = $rs_daily_sales['sum(weight)'];


            $sql_buying = mysql_query("SELECT * FROM tipco_buying WHERE wp_grade='$wp_grade' and date_effective<='$ps_end_q' ORDER BY date_effective DESC");
            $rs_buying = mysql_fetch_array($sql_buying);

            $buying_m[$wp_grade] = $rs_buying['price'];
            $ps_q = date("Y/m/d", strtotime("+1 month", strtotime($ps_q)));
        }


        $start_q = $start_day;
        while ($start_q <= $end_day) {
            $end_q = date('Y/m/d', strtotime("+6 days", strtotime($start_q)));

//            $tot_amount_cost[$wp_grade][$start_q][$end_q] = 0;
            foreach ($branches_array as $branch) {
                $sql_price = mysql_query("SELECT * FROM tipco_prices WHERE branch='$branch' and wp_grade='$wp_grade' and date_effective<='$end_q' ORDER BY date_effective DESC");
                $rs_price = mysql_fetch_array($sql_price);
                $ppr_buy = 0;
                $sql_amount_cost = mysql_query("SELECT * FROM paper_buying WHERE unit_cost>'" . $rs_price['price'] . "' and branch='$branch' and wp_grade='$wp_grade' and date_received>='$start_q' and date_received<='$end_q'");
                while ($rs_amount_cost = mysql_fetch_array($sql_amount_cost)) {
                    $spc_price = $rs_amount_cost['unit_cost'] - $rs_price['price'];
                    $ppr_buy += ($spc_price * $rs_amount_cost['corrected_weight']);
                }

                $tot_amount_cost[$wp_grade][$start_q][$end_q] += $ppr_buy;
            }

            if ($wp_grade != 'LCWL' && $wp_grade != 'CHIPBOARD') {
                $wp_grade_q = "LC" . $wp_grade;
            } else {
                $wp_grade_q = $wp_grade;
            }
            $sql_daily_sales = mysql_query("SELECT sum(weight) FROM actual WHERE branch like '%" . $_POST['branch'] . "%' and wp_grade='$wp_grade_q' and date>='$start_q' and date<='$end_q'");
            $rs_daily_sales = mysql_fetch_array($sql_daily_sales);
            $daily_sales_ton[$wp_grade][$start_q][$end_q] = $rs_daily_sales['sum(weight)'];


            $sql_buying = mysql_query("SELECT * FROM tipco_buying WHERE wp_grade='$wp_grade' and date_effective<='$end_q' ORDER BY date_effective DESC");
            $rs_buying = mysql_fetch_array($sql_buying);

            $buying[$wp_grade] = $rs_buying['price'];
            $start_q = date('Y/m/d', strtotime("+7 days", strtotime($start_q)));
        }
    }
    ?>

    <div class="grid_10">
        <div class="box round first grid">
            <h2>Effective Price to TIPCO in
                <?php
                if ($_POST['branch'] == '') {
                    echo "All Branches.";
                } else {
                    echo $_POST['branch'] . ".";
                }
                ?>

            </h2>
            <br><br>
            <table border="1" class="tbl">
                <tr class="head">
                    <td>WP Grade</td>
                    <?php
                    $start = $start_day;
                    $prev_start = date("Y/m/d", strtotime("-" . $count . " months", strtotime($start)));
                    $ps_q = $prev_start;
                    while ($ps_q < $start) {
//                        $ps_start_q = date("Y/m/", strtotime($ps_q)) . "01";
//                        $ps_end_q = date("Y/m/t", strtotime($ps_q));
                        $ps_month = date('M, Y', strtotime($ps_q));
                        echo "<td>$ps_month</td>";
                        $ps_q = date("Y/m/d", strtotime("+1 month", strtotime($ps_q)));
                    }
                    while ($start <= $end_day) {
                        $start_q = date('M d, Y', strtotime($start));
                        $end_q = date('M d, Y', strtotime("+6 days", strtotime($start)));

                        $day1 = date('d', strtotime($start));
                        $day2 = date('d', strtotime($end_q));

                        $month1 = date('M', strtotime($start));
                        $month2 = date('M', strtotime($end_q));

                        $year1 = date('Y', strtotime($start));
                        $year2 = date('Y', strtotime($end_q));

                        if ($month1 == $month2 && $year1 == $year2) {
                            echo "<td>$month1 $day1 - $day2, $year1</td>";
                        } else if ($month1 != $month2 && $year1 == $year2) {
                            echo "<td>$month1 $day1 - $month2 $day2, $year1</td>";
                        } else {
                            echo "<td>$month1 $day1, $year1 - $month2 $day2, $year2</td>";
                        }
                        $start = date('Y/m/d', strtotime("+7 days", strtotime($start)));
                    }
                    ?>
                </tr>
                <?php
                foreach ($wp_grade_array as $wp_grade) {
                    echo "<tr>";
                    echo "<td class='wp'>$wp_grade</td>";
                    $start = $start_day;
                    $ps_q = $prev_start;
                    while ($ps_q < $start) {
                        $ps_start_q = date("Y/m/", strtotime($ps_q)) . "01";
                        $ps_end_q = date("Y/m/t", strtotime($ps_q));

                        $t = round($tot_amount_cost_m[$wp_grade][$ps_start_q][$ps_end_q], 2);
                        $d = round($daily_sales_ton_m[$wp_grade][$ps_start_q][$ps_end_q], 2);
                        $b = round($buying_m[$wp_grade], 2);
                        echo "<td><span id='" . $wp_grade . "_" . $ps_start_q . "_" . $ps_end_q . "_" . $_POST['branch'] . "_" . $b . "'>" . round(($t + ($d * $b)) / $d, 2) . "</span><div class='formula'> = ( $t + ( $d * $b )) / $d</div></td>";
                        $ps_q = date("Y/m/d", strtotime("+1 month", strtotime($ps_q)));
                    }
                    $start_q = $start_day;
                    while ($start_q <= $end_day) {
                        $end_q = date('Y/m/d', strtotime("+6 days", strtotime($start_q)));

                        $t = round($tot_amount_cost[$wp_grade][$start_q][$end_q], 2);
                        $d = round($daily_sales_ton[$wp_grade][$start_q][$end_q], 2);
                        $b = round($buying[$wp_grade], 2);

                        echo "<td><span id='" . $wp_grade . "_" . $start_q . "_" . $end_q . "_" . $_POST['branch'] . "_" . $b . "'>" . round(($t + ($d * $b)) / $d, 2) . "</span><div class='formula'> = ( $t + ( $d * $b )) / $d</div></td>";

                        $start_q = date('Y/m/d', strtotime("+7 days", strtotime($start_q)));
                    }
                    echo "</tr>";
                }
                ?>
            </table>
            <button id='hide'>Hide</button>
            <br><br>

            <b>Click button [Hide] to hide formula</b>
            <br>            <br>

            <div id="txtHint"><b>Click the prices to view details</b></div>
        </div>
    </div>
    <?php
}
?>

</body>
</html>

<div class="clear">
</div>
<div class="clear">
</div>
