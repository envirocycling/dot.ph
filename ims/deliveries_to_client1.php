<?php

include("templates/template.php");



include("config.php");

?>



<style>



    .total{

        background-color: yellow;

    }



</style>



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



<div class="grid_5">

    <div class="box round first grid">

        <h2>Deliveries to Client</h2>

        <form action="deliveries_to_client1.php" method="POST">

            <br>

            <h6>Please select your range of dates</h6>

            <?php

            if (isset($_POST['submit'])) {

                ?>



                Start Period: <input type='text'  id='inputField' name='from' value="<?php echo $_POST['from']; ?>" onfocus='date1(this.id);' readonly size="8"><br>

                End Period:<input type='text'  id='inputField2' name='to' value="<?php echo $_POST['to']; ?>" onfocus='date1(this.id);' readonly size="8"><br>

                WP Grade: <select name="wp_grade">

                    <option value="<?php echo $_POST['wp_grade']; ?>"><?php echo $_POST['wp_grade']; ?></option>

                    <option value="">All</option>

                    <option value="LCOCC">LCOCC</option>

                    <option value="LCMW">LCMW</option>

                </select>

                <br>

                <?php

                echo "Branch: <select name='branch'>";

                $sql_branches = mysql_query("SELECT * FROM branches") or die(mysql_error());

                echo "<option value='" . $_POST['branch'] . "'>" . $_POST['branch'] . "</option>";

                echo "<option value=''>All Branches</option>";



                while ($rs_branches = mysql_fetch_array($sql_branches)) {

                    echo "<option value='" . $rs_branches['branch_name'] . "'>" . $rs_branches['branch_name'] . "</option>";

                }

                echo "</select>";

            } else {

                ?>

                Start Period: <input type='text'  id='inputField' name='from' value="<?php echo date('Y/m/d'); ?>" onfocus='date1(this.id);' readonly size="8"><br>

                End Period:<input type='text'  id='inputField2' name='to' value="<?php echo date('Y/m/d'); ?>" onfocus='date1(this.id);' readonly size="8"><br>

                WP Grade: <select name="wp_grade">

                    <option value="">All</option>

                    <option value="LCOCC">OCC</option>

                    <option value="LCMW">MW</option>

                </select>

                <br>

                <?php

                echo "Branch: <select name='branch'>";

                $sql_branches = mysql_query("SELECT * FROM branches") or die(mysql_error());

                echo "<option value=''>All Branches</option>";



                while ($rs_branches = mysql_fetch_array($sql_branches)) {

                    echo "<option value='" . $rs_branches['branch_name'] . "'>" . $rs_branches['branch_name'] . "</option>";

                }

                echo "</select>";

            }

            ?>

            <br>

            <input name="submit" type="submit" value="Generate Report">

        </form>

    </div>

</div>



<?php

if (isset($_POST['submit'])) {

    $deliver_to_array = array();

    $del_array = array();

    if ($_POST['wp_grade'] == '') {

        $sql_del_to = mysql_query("SELECT delivered_to FROM actual WHERE branch like '%" . $_POST['branch'] . "%' and (wp_grade='LCOCC' or wp_grade='LCMW' or wp_grade='LCMW_S' or wp_grade='LCMW_P') and date>='" . $_POST['from'] . "' and date<='" . $_POST['to'] . "' GROUP BY delivered_to") or die(mysql_error());

    } else {

        if ($_POST['wp_grade'] == 'LCMW') {

            $sql_del_to = mysql_query("SELECT delivered_to FROM actual WHERE branch like '%" . $_POST['branch'] . "%' and (wp_grade='" . $_POST['wp_grade'] . "' or wp_grade='LCMW_S' or wp_grade='LCMW_P') and date>='" . $_POST['from'] . "' and date<='" . $_POST['to'] . "' GROUP BY delivered_to") or die(mysql_error());

        } else {

            $sql_del_to = mysql_query("SELECT delivered_to FROM actual WHERE branch like '%" . $_POST['branch'] . "%' and wp_grade='" . $_POST['wp_grade'] . "' and date>='" . $_POST['from'] . "' and date<='" . $_POST['to'] . "' GROUP BY delivered_to") or die(mysql_error());

        }

    }



    while ($rs_del_to = mysql_fetch_array($sql_del_to)) {

        array_push($deliver_to_array, $rs_del_to['delivered_to']);

    }



    foreach ($deliver_to_array as $deliver_to) {

        $start_q = $_POST['from'];

        $breaker_date = $_POST['to'];



        while ($start_q <= $breaker_date) {

            if ($_POST['wp_grade'] == '') {

                $sql_del = mysql_query("SELECT sum(weight) FROM actual WHERE branch like '%" . $_POST['branch'] . "%' and delivered_to='$deliver_to' and (wp_grade='LCOCC' or wp_grade='LCMW' or wp_grade='LCMW_S' or wp_grade='LCMW_P') and date='$start_q'") or die(mysql_error());

            } else if($_POST['wp_grade']=='LCMW') {

                $sql_del = mysql_query("SELECT sum(weight) FROM actual WHERE branch like '%" . $_POST['branch'] . "%' and delivered_to='$deliver_to' and (wp_grade='LCMW' or wp_grade='LCMW_S' or wp_grade='LCMW_P') and date='$start_q'") or die(mysql_error());

            }else {

				$sql_del = mysql_query("SELECT sum(weight) FROM actual WHERE branch like '%" . $_POST['branch'] . "%' and delivered_to='$deliver_to' and  wp_grade='".$_POST['wp_grade']."' and date='$start_q'") or die(mysql_error());

			}



            $rs_del = mysql_fetch_array($sql_del);



            $del_array[$deliver_to][$start_q] = $rs_del['sum(weight)'];



            $start_q = date('Y/m/d', strtotime("+1 day", strtotime($start_q)));

        }

    }

    ?>

    <div class="grid_10" >

        <div class="box round first grid">

            <h2>Deliveries to Client 

                <?php

                if ($_POST['branch'] == '') {

                    echo "from All Branches";

                } else {

                    echo "from " . $_POST['branch'];

                }



                if ($_POST['wp_grade'] == '') {

                    echo " in All Grades.";

                } else {

                    echo " in " . $_POST['wp_grade'] . ".";

                }

                ?>

            </h2>



            <table class="data display datatable" id="example" border="1">

                <?php

                echo "<thead>";

                echo "<th>Date</th>";

                foreach ($deliver_to_array as $deliver_to) {

                    echo "<th>$deliver_to</th>";

                }

                echo "<th>Total</th>";

                echo "</thead>";



                $start_q = $_POST['from'];

                $breaker_date = $_POST['to'];



                while ($start_q <= $breaker_date) {

                    $total = 0;

                    echo "<tr>";

                    echo "<td>$start_q</td>";

                    foreach ($deliver_to_array as $deliver_to) {

                        if ($del_array[$deliver_to][$start_q] == '') {

                            echo "<td>-</td>";

                        } else {

                            $total+=$del_array[$deliver_to][$start_q];

                            echo "<td>" . round($del_array[$deliver_to][$start_q], 2) . "</td>";

                        }

                    }

                    echo "<td class='total'>" . round($total, 2) . "</td>";

                    echo "</tr>";

                    $start_q = date('Y/m/d', strtotime("+1 day", strtotime($start_q)));

                }

                ?>



            </table>

        </div>

    </div>



    <?php

}

?>

<div class="clear">



</div>

