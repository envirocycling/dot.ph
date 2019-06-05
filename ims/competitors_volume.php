<?php
include('config.php');
include('templates/template.php');
?>

<style>
    .border {
        border: solid 1px;
    }
</style>
<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
    function date1(str) {
        new JsDatePick({
            useMode: 2,
            target: str,
            dateFormat: "%Y/%m"

        });
    }
    ;

    $(window).load(function() {
        $(".editbox").hide();
        $("span").click(function() {
            var ID = $(this).attr('id');
            $("#value_" + ID).hide(500);
            $("#edit_" + ID).show(500);
        });
        $("button").click(function() {
            var ID = $(this).attr('id');
            var splits = ID.split("_");
            $("#total_" + splits[0]).hide();
            $("#value_" + ID).show(500);
            $("#edit_" + ID).hide(500);
            var capacity = $("#capacity_" + ID).val();


            var s_capacity = $("#s_capacity_" + ID).val();
            var accomplish = (s_capacity / capacity) * 100;
            if (isNaN(accomplish)) {
                accomplish = 0;
            }
            $("#value_" + ID).html(capacity);
            var lcwl = Number($("#capacity_" + splits[0] + "_LCWL").val());
            var onp = Number($("#capacity_" + splits[0] + "_ONP").val());
            var cbs = Number($("#capacity_" + splits[0] + "_CBS").val());
            var occ = Number($("#capacity_" + splits[0] + "_OCC").val());
            var mw = Number($("#capacity_" + splits[0] + "_MW").val());
            var cb = Number($("#capacity_" + splits[0] + "_CHIPBOARD").val());

            var total = Number(lcwl + onp + cbs + occ + mw + cb);

            $("#new_total_" + splits[0]).html(total);
            $("#accomplish_" + ID).html(Math.round(accomplish));
            var capacitydummy = $("#capacitydummy_" + ID).val();
            if (capacitydummy !== capacity) {
                capacitydummy = capacity;
                var splits = ID.split("_");
                var dataString = 'id=' + splits[0] + '&wp_grade=' + splits[1] + '&capacity=' + capacity;
                $.ajax({
                    type: "POST",
                    url: "sup_add_capacity_in_cv.php",
                    data: dataString,
                    cache: false
                });
            }
        });
    });
</script>

</head>
<div class="grid_9">
    <div class="box round first grid">
        <h2>Competitors Volume</h2>
        <table>
            <tr>
                <td><h6>Filtering Options</h6>
                    <form action="competitors_volume.php" method="POST">
                        Select Month: <input type='text'  id='inputField' name='date' value="<?php echo date('Y/m'); ?>" onfocus='date1(this.id);' readonly size="8"><br>
                        <select name="branch">
                            <option value="">All Branches</option>
                            <?php
                            $sql_branch = mysql_query("SELECT * FROM branches");
                            while ($rs_branch = mysql_fetch_array($sql_branch)) {
                                echo "<option value='" . $rs_branch['branch_name'] . "'>" . $rs_branch['branch_name'] . "</option>";
                            }
                            ?>
                        </select>
                        <br>
                        <input type="submit" name="submit" value="Generate Report">
                    </form></td>
                <td>
                    <?php
                    if (isset($_POST['submit'])) {
                        ?>
                    <div style="font-size: 12px; font-weight: bold; margin-top: 10px; margin-right: 70px; margin-left: 70px;">
                        <h5>Column Meaning </h5>
                        Supplier - "Subject" <br>
                        Capacity - Is the defined capacity of the subject. <br>
                        Data Gathered - is the data gathered to the subject. <br>
                        Accomplishment - is the data gathered over capacity. <br>
                        Head Count - number of data gathered giving to the subject.
                    </div>
                        <?php
                    }
                    ?>
                </td>
            </tr>
        </table>
        <?php
        if (isset($_POST['submit'])) {
            $date = $_POST['date'] . "/01";
            $month = date("F", strtotime($date));
            $year = date("Y", strtotime($date));
            $end_date = date("Y/m/t", strtotime($date));
            $supplier_array = array();
            $grade_array = array('LCWL', 'ONP', 'CBS', 'OCC', 'MW', 'CHIPBOARD');
            $sup_capacity = array();
            $sup_source_total_array = array();
            $sup_source_count_array = array();
            $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE branch like '%" . $_POST['branch'] . "%' and (classification='C1' or classification='C2' or classification='C3' or classification='PM') and status!='inactive'");
            while ($rs_sup = mysql_fetch_array($sql_sup)) {
                array_push($supplier_array, $rs_sup['supplier_id']);
                foreach ($grade_array as $grade) {
                    $sql_assess = mysql_query("SELECT sum(volume) FROM supplier_assessment WHERE deliver_to='" . $rs_sup['supplier_id'] . "' and wp_grade='$grade' and date_deleted<='$end_date' and status!='deleted'");
                    $rs_assess = mysql_fetch_array($sql_assess);
                    $sup_capacity[$rs_sup['supplier_id']][$grade] = $rs_assess['sum(volume)'];
                    $sql_capacity = mysql_query("SELECT * FROM supplier_capacity WHERE supplier_id='" . $rs_sup['supplier_id'] . "' and wp_grade='$grade' and date_effective<='$end_date' ORDER BY date_effective DESC");
                    $rs_capacity = mysql_fetch_array($sql_capacity);
                    $comp_capacity[$rs_sup['supplier_id']][$grade] = $rs_capacity['capacity'];
                }
                $c = 0;
                $total = 0;
                $sql_assess_sup = mysql_query("SELECT * FROM supplier_assessment WHERE deliver_to='" . $rs_sup['supplier_id'] . "' and date<='$end_date' and date_deleted<='$end_date' and status!='deleted' GROUP BY supplier_id");
                while ($rs_assess_sup = mysql_fetch_array($sql_assess_sup)) {
                    $sql_sup_del_to_efi = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='" . $rs_assess_sup['supplier_id'] . "' and month_delivered='$month' and year_delivered='$year'");
                    $rs_sup_del_to_efi = mysql_fetch_array($sql_sup_del_to_efi);
                    if ($rs_sup_del_to_efi['sum(weight)'] > 0) {
                        $total+=$rs_sup_del_to_efi['sum(weight)'];
                        $c++;
                    }
                }
                $sup_source_count_array[$rs_sup['supplier_id']] = $c;
                $sup_source_total_array[$rs_sup['supplier_id']] = $total / 1000;
            }
            echo '<table class="data display datatable" id="example" border="1">';
            echo "<thead>";
            echo "<th>Supplier</th>";
            echo "<th>Data Gathered</th>";
            echo "<th>Capacity</th>";
            echo "<th>Accomplishment</th>";
            echo "<th>Delivery</th>";
            echo "</thead>";
            foreach ($supplier_array as $sup_id) {
                $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='$sup_id'");
                $rs_sup = mysql_fetch_array($sql_sup);
                echo "<tr>";
                echo "<td>" . $sup_id . "_" . $rs_sup['supplier_name'] . "</td>";
                echo "<td>
                <table class='border'>
                <tr>
                <td class='border'><b>WP Grade</b></td>
                <td class='border'><b>Capacity</b></td>
                </tr>";
                $total = 0;
                foreach ($grade_array as $grade) {
                    echo "<tr>";
                    echo "<td class='border'>$grade</td>";
                    if (!empty($sup_capacity[$sup_id][$grade])) {
                        echo "<td class='border'><input type='hidden' id='s_capacity_" . $sup_id . "_" . $grade . "' value='" . $sup_capacity[$sup_id][$grade] . "'>" . $sup_capacity[$sup_id][$grade] . "</td>";
                    } else {
                        echo "<td class='border'>0</td>";
                    }
                    echo "</tr>";
                    $total+=$sup_capacity[$sup_id][$grade];
                }
                echo "<tr>";
                echo "<td class='border'>TOTAL</td>";
                echo "<td class='border'>$total</td>";
                echo "</tr>";
                echo "</table>";
                echo "</td>";
                echo "<td><table class='border'>
                <tr>
                <td class='border'><b>WP Grade</b></td>
                <td class='border'><b>Capacity</b></td>
                </tr>";
                $total = 0;
                foreach ($grade_array as $grade) {
                    echo "<tr>";
                    echo "<td class='border'>$grade</td>";
                    echo "<td class='border'>";
                    if (!empty($comp_capacity[$sup_id][$grade])) {
                        echo "<input type='hidden' id='capacitydummy_" . $sup_id . "_" . $grade . "' value='" . $comp_capacity[$sup_id][$grade] . "'>";
                        echo "<span id='" . $sup_id . "_" . $grade . "' class='text'>
                        <div id='value_" . $sup_id . "_" . $grade . "'>" . $comp_capacity[$sup_id][$grade] . "</div></span>
                        <div id='edit_" . $sup_id . "_" . $grade . "' class='editbox'><input id='capacity_" . $sup_id . "_" . $grade . "' type='text' name='capacity_" . $sup_id . "_" . $grade . "' value='" . $comp_capacity[$sup_id][$grade] . "' size='3'>
                        <button id='" . $sup_id . "_" . $grade . "'>Save</button></div>";
                        $total+=$comp_capacity[$sup_id][$grade];
                    } else {
                        echo "<input type='hidden' id='capacitydummy_" . $sup_id . "_" . $grade . "' value='0'>";
                        echo "<span id='" . $sup_id . "_" . $grade . "' class='text'>
                        <div id='value_" . $sup_id . "_" . $grade . "'>0</div></span>
                        <div id='edit_" . $sup_id . "_" . $grade . "' class='editbox'><input id='capacity_" . $sup_id . "_" . $grade . "' type='text' name='capacity_" . $sup_id . "_" . $grade . "' value='0' size='3'>
                        <button id='" . $sup_id . "_" . $grade . "'>Save</button></div>";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
                echo "<tr>";
                echo "<td class='border'>TOTAL</td>";
                echo "<td class='border'><div id='total_$sup_id'>$total</div><span><div id='new_total_$sup_id'></span></div></td>";
                echo "</tr>";
                echo "</table>";
                echo "</td>";
                echo "<td><table class='border'>
                <tr>
                <td class='border'><b>WP Grade</b></td>
                <td class='border'><b>Capacity</b></td>
                </tr>";
                $total = 0;
                foreach ($grade_array as $grade) {
                    echo "<tr>";
                    echo "<td class='border'>$grade</td>";
                    echo "<td class='border'><span id='accomplish_" . $sup_id . "_" . $grade . "'>" . round(($sup_capacity[$sup_id][$grade] / $comp_capacity[$sup_id][$grade]) * 100, 0) . "</span>%</td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "</td>";
                echo "<td>
                    <table class='border'>
                    <tr>
                    <td class='border'><b>Head Count</b></td>
                    <td class='border'><b>Volume</b></td>
                    </tr>
                    <tr>
                    <td class='border'>" . $sup_source_count_array[$sup_id] . "</td>
                    <td class='border'>" . $sup_source_total_array[$sup_id] . "</td>
                    </tr>
                    </table>
                    </td>";

                echo "</tr>";
            }
            echo '</table>';
        }
        ?>

    </div>
</div>

<div class="



     clear">
</div>
<div class="clear">
</div>
