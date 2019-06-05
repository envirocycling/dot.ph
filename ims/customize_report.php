<?php
include("config.php");
include("templates/template.php");
ini_set('max_execution_time', 1000);
?>
<style>

    #total{
        background-color: yellow;
    }
    #prev{
        background-color: orange;
    }

</style>
<script>
    $(window).load(function () {
        $(".editbox").hide();
        $("span").click(function() {
            var ID = $(this).attr('id');
            $("#addl_price_value_" + ID).hide(500);
            $("#addl_price_edit_" + ID).show(500);
            $("#expctd_vol_value_" + ID).hide(500);
            $("#expected_vol_edit_" + ID).show(500);
        });
        $("button").click(function() {
            var ID = $(this).attr('id');
            var splits = ID.split("_");
            if (splits[0] == 'target'){

                var supplier_id = splits[2];
                var ID = splits[1]+'_'+splits[2];

                var date = splits[3];
                var wp_grade = splits[4];
                $("#addl_price_edit_" + ID).hide(500);
                $("#addl_price_value_" + ID).show(500);
                $("#expected_vol_edit_" + ID).hide(500);
                $("#expctd_vol_value_" + ID).show(500);

                var addtl_price = $("#addtl_price_" + ID).val();
                var expctd_vol = $("#expected_vol_" + ID).val();

                $("#addl_price_value_" + ID).html(addtl_price);
                $("#expctd_vol_value_" + ID).html(expctd_vol);

                if (addtl_price != '' || expctd_vol != ''){
                    alert('Successfully Save');
                    var dataString = 'supplier_id=' + supplier_id + '&date=' + date + '&addtl_price=' + addtl_price + '&expctd_vol=' + expctd_vol + '&wp_grade=' + wp_grade;
                    $.ajax({
                        type: "POST",
                        url: "save_sup_buying_price.php",
                        data: dataString,
                        cache: false
                    });
                }
            } else {
                var supplier_id = splits[1];
                var wp_grade = splits[2];
                var remarks = $("#remarks_" + supplier_id).val();

                $("#remedit_" + supplier_id).html(remarks);

                $("#remarks_edit_" + supplier_id).hide(500);
                $("#remarks_value_" + supplier_id).show(500);

                if (remarks != ''){
                    alert('Successfully Save');

                    var dataString = 'supplier_id='+supplier_id+'&remarks=' + remarks + '&wp_grade='+wp_grade;
                    $.ajax({
                        type: "POST",
                        url: "save_sup_buying_price_remarks.php",
                        data: dataString,
                        cache: false
                    });

                }
            }
        });
    });
    function remarks (str){
        $("#remarks_value_" + str).hide(500);
        $("#remarks_edit_" + str).show(500);
    }
</script>

<div class="grid_16" >
    <div class="box round first grid">
        <?php
        $start_date=$_POST['start_date'];
        $breaker_date=$_POST['end_date'];
        $start_week=$_POST['start_week'];
        $filtering_grade=$_POST['wp_grade'];
        $filtering_branch=$_POST['branch'];

        $end_week = date('Y/m/d', strtotime("+27 days", strtotime($start_week)));

        echo "<h2>Customize Report from $start_date to: $breaker_date and the target is from $start_week to $end_week in ";
        if ($filtering_branch == '') {
            echo "All Branch on";
        } else {
            echo $filtering_branch." on ";
        }

        if ($filtering_grade == '') {
            echo "All Grades";
        } else {
            echo $filtering_grade;
        }
        echo ". </h2>";
        ?>

        <table class="data display datatable" id="example" border="1">
            <?php
            $last_month = date('Y/m/d', strtotime("-1 month", strtotime($breaker_date)));
            $last_month_last_day = date('Y/m/t', strtotime($last_month));

            $prev_start_week = date('Y/m/d', strtotime("-28 days", strtotime($start_week)));
            $prev_month_month = date('Y/m', strtotime($prev_start_week));
            $prev_end_week = date('Y/m/d', strtotime("+27 days", strtotime($prev_start_week)));

            $last_6month = date('Y/m/d', strtotime("-6 months", strtotime($breaker_date)));
            $last_6month_month = date('Y/m', strtotime("-6 months", strtotime($breaker_date)));
            $last_6month_1st_day = date('Y/m', strtotime($last_6month));
            $last_6month_1st_day = $last_6month_1st_day."/01";

            $current_month_last_day_day = date('t', strtotime($breaker_date));
            $current_month_month = date('Y/m', strtotime($breaker_date));
            $current_month_current_day_day = date('d', strtotime($breaker_date));
            $day_percentage = $current_month_current_day_day / $current_month_last_day_day;

            $supplier_id_array = array ();
            $supplier_capacity = array ();
            $supplier_name = array ();
            $supplier_unit_cost = array ();
            $supplier_del = array ();
            $supplier_addtl_price_array = array ();
            $supplier_expected_vol_array = array ();
            $supplier_del_cur_week = array ();
            $deliveries_last_6month = array ();
            $supplier_remarks = array();

            $sql_sup = mysql_query("SELECT supplier_id,supplier_name FROM supplier_details WHERE branch like '%$filtering_branch%' and status!='inactive'");
            while ($rs_sup = mysql_fetch_array($sql_sup)) {
                array_push ($supplier_id_array,$rs_sup['supplier_id']);
                $supplier_name[$rs_sup['supplier_id']]=$rs_sup['supplier_name'];
                $sql_cap = mysql_query("SELECT capacity FROM supplier_capacity WHERE supplier_id='".$rs_sup['supplier_id']."' and wp_grade like '%$filtering_grade%' and date_effective<='$breaker_date' ORDER BY date_effective DESC LIMIT 1");
                $rs_cap = mysql_fetch_array($sql_cap);
                $supplier_capacity[$rs_sup['supplier_id']]=$rs_cap['capacity'];
                $sql_cost = mysql_query("SELECT unit_cost FROM paper_buying WHERE wp_grade like '%$filtering_grade%' and date_received<='$breaker_date' and supplier_id='".$rs_sup['supplier_id']."'");
                $rs_cost = mysql_fetch_array($sql_cost);
                $supplier_unit_cost[$rs_sup['supplier_id']]=$rs_cost['unit_cost'];
            }

            foreach ($supplier_id_array as $supplier_id) {
                $start_week_q = $start_week;
                while ($start_week_q < $end_week) {
                    $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
                    $sql_cur_week = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='$supplier_id' and date_delivered>='$start_week_q' and date_delivered<='$end_week_q' and wp_grade like '%$filtering_grade%'");
                    $rs_cur_week = mysql_fetch_array($sql_cur_week);
                    $supplier_del_cur_week[$supplier_id][$start_week_q][$end_week_q]=$rs_cur_week['sum(weight)'];
                    $start_week_q = date('Y/m/d', strtotime("+7 days", strtotime($start_week_q)));
                }
            }

            foreach ($supplier_id_array as $supplier_id) {
                $start_week_q = $start_week;
                while ($start_week_q < $end_week) {
                    $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
                    $sql_price_marketing = mysql_query("SELECT unit_cost,additional_price,expected_volume,additional_volume FROM sup_buying_price WHERE supplier_id='$supplier_id' and wp_grade like '%$filtering_grade%' and date_effective='$end_week_q' ORDER BY date_effective DESC LIMIT 1");
                    $rs_price_marketing = mysql_fetch_array($sql_price_marketing);
                    $supplier_addtl_price_array[$supplier_id][$start_week_q][$end_week_q]=$rs_price_marketing['unit_cost'];
                    $supplier_expected_vol_array[$supplier_id][$start_week_q][$end_week_q]=$rs_price_marketing['expected_volume'];
                    $start_week_q = date('Y/m/d', strtotime("+7 days", strtotime($start_week_q)));
                }
            }

            foreach ($supplier_id_array as $supplier_id) {
                $sql_last_6months = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='$supplier_id' and wp_grade like '%$filtering_grade%' and date_delivered>='$last_6month_1st_day' and date_delivered<='$last_month_last_day'");
                $rs_last_6months = mysql_fetch_array($sql_last_6months);
                $deliveries_last_6month[$supplier_id]=round($rs_last_6months['sum(weight)']/6,2);

                $sql_marketing_remarks = mysql_query("SELECT remarks FROM sup_buying_price_remarks WHERE supplier_id='$supplier_id' and wp_grade like '%$filtering_grade%' and date_updated<='$breaker_date' ORDER BY date_updated DESC LIMIT 1");
                $rs_marketing_remarks = mysql_fetch_array($sql_marketing_remarks);
                $supplier_remarks[$supplier_id]=$rs_marketing_remarks['remarks'];
            }

            foreach ($supplier_id_array as $supplier_id) {
                $start_q = $start_date;
                while ($start_q < $breaker_date) {
                    $month_q = date("F", strtotime($start_q));
                    $year_q = date("Y", strtotime($start_q));
                    $sql_del = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='$supplier_id' and wp_grade like '%$filtering_grade%' and month_delivered>='$month_q' and year_delivered<='$year_q'");
                    $rs_del = mysql_fetch_array($sql_del);
                    $supplier_del[$supplier_id][$month_q][$year_q]=$rs_del['sum(weight)'];
                    $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
                }
            }

            echo "<thead>";
            echo "<th>Suppiler ID</th>";
            echo "<th>Supplier Name</th>";
            echo "<th>Capacity</th>";
            $start_q = $start_date;
            while ($start_q < $breaker_date) {
                $month_q = date("M", strtotime($start_q));
                $year_q = date("Y", strtotime($start_q));
                $ym = date("Y/m", strtotime($start_q));
                if ($ym == $current_month_month) {
                    echo "<th>Last 6 Mos.</th>";
                    echo "<th>$month_q-$year_q</th>";
                } else {
                    echo "<th>$month_q-$year_q</th>";
                }
                $start_q = date("Y/m/d", strtotime("+1 month", strtotime($start_q)));
            }

            $count = 1;
            $start_week_q = $start_week;
            while ($start_week_q < $end_week) {
                $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
                echo "<th>Actual Del <br> Week $count $start_week_q $end_week_q</th>";
                $start_week_q = date('Y/m/d', strtotime("+7 days", strtotime($start_week_q)));
                $count++;
            }
            echo "<th>Unit Cost</th>";
            $count = 1;
            $start_week_q = $start_week;
            while ($start_week_q < $end_week) {
                $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
                echo "<th>New Price Week $count</th>";
                echo "<th>Target Week $count</th>";
                $start_week_q = date('Y/m/d', strtotime("+7 days", strtotime($start_week_q)));
                $count++;
            }
            echo "<th>________Remarks_______</th>";
            echo "</thead>";

            foreach ($supplier_id_array as $supplier_id) {
                $last_6month_del = 0;
                echo "<tr>";
                echo "<td>$supplier_id</td>";
                echo "<td>$supplier_name[$supplier_id]</td>";
                echo "<td>$supplier_capacity[$supplier_id]</td>";
                $start_q = $start_date;
                while ($start_q < $breaker_date) {
                    $del_moth = date("Y/m", strtotime($start_q));
                    $month_q = date("F", strtotime($start_q));
                    $year_q = date("Y", strtotime($start_q));

                    if ($del_moth == $current_month_month) {
                        echo "<td>".$deliveries_last_6month[$supplier_id]."</td>";
                        if (empty($supplier_del[$supplier_id][$month_q][$year_q])) {
                            echo "<td>-</td>";
                        } else {
                            echo "<td>".$supplier_del[$supplier_id][$month_q][$year_q]."</td>";
                        }
                    } else {
                        if (empty($supplier_del[$supplier_id][$month_q][$year_q])) {
                            echo "<td>-</td>";
                        } else {
                            echo "<td>".$supplier_del[$supplier_id][$month_q][$year_q]."</td>";
                        }
                    }

                    $start_q = date("Y/m/d", strtotime("+1 month", strtotime($start_q)));
                }
                $start_week_q = $start_week;
                while ($start_week_q < $end_week) {
                    $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
                    if (empty ($supplier_del_cur_week[$supplier_id][$start_week_q][$end_week_q])) {
                        echo "<td>-</td>";
                    } else {
                        echo "<td>".$supplier_del_cur_week[$supplier_id][$start_week_q][$end_week_q]."</td>";
                    }
                    $start_week_q = date('Y/m/d', strtotime("+7 days", strtotime($start_week_q)));
                }
                echo "<td>$supplier_unit_cost[$supplier_id]</td>";
                $c = 1;
                $start_week_q = $start_week;
                while ($start_week_q < $end_week) {
                    $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
                    if (empty ($supplier_addtl_price_array[$supplier_id][$start_week_q][$end_week_q])) {
                        echo "<td>";
                        echo "<span id='".$c."_" . $supplier_id . "' class='text'>";
                        echo "<div id='addl_price_value_".$c."_".$supplier_id."'>-</div>";
                        echo "</span>";
                        echo "<div id='addl_price_edit_".$c."_".$supplier_id."' class='editbox'>";
                        echo "<input class='marketing' id='addtl_price_".$c."_".$supplier_id."' value='' size='4'>";
                        echo "</div>";
                        echo "</td>";
                    } else {
                        echo "<td>";
                        echo "<span id='".$c."_" . $supplier_id . "' class='text'>";
                        echo "<div id='addl_price_value_".$c."_".$supplier_id."'>".$supplier_addtl_price_array[$supplier_id][$start_week_q][$end_week_q]."</div>";
                        echo "</span>";
                        echo "<div id='addl_price_edit_".$c."_".$supplier_id."' class='editbox'>";
                        echo "<input class='marketing' id='addtl_price_".$c."_".$supplier_id."' value='".$supplier_addtl_price_array[$supplier_id][$start_week_q][$end_week_q]."' size='4'>";
                        echo "</div>";
                        echo "</td>";
                        echo "</td>";
                    }
                    if (empty ($supplier_expected_vol_array[$supplier_id][$start_week_q][$end_week_q])) {
                        echo "<td>";
                        echo "<span id='".$c."_" . $supplier_id . "' class='text'>";
                        echo "<div id='expctd_vol_value_".$c."_".$supplier_id."'>-</div>";
                        echo "</span>";
                        echo "<div id='expected_vol_edit_".$c."_".$supplier_id."' class='editbox'>";
                        echo "<input class='marketing' id='expected_vol_".$c."_".$supplier_id."' value='' size='4'>";
                        echo "<button id='target_".$c."_" . $supplier_id . "_".$end_week_q."_" . $filtering_grade . "'>Save</button></div>";
                        echo "</td>";
                    } else {
                        echo "<td>";
                        echo "<span id='".$c."_" . $supplier_id . "' class='text'>";
                        echo "<div id='expctd_vol_value_".$c."_".$supplier_id."'>".$supplier_expected_vol_array[$supplier_id][$start_week_q][$end_week_q]."</div>";
                        echo "</span>";
                        echo "<div id='expected_vol_edit_".$c."_".$supplier_id."' class='editbox'>";
                        echo "<input class='marketing' id='expected_vol_".$c."_".$supplier_id."' value='".$supplier_expected_vol_array[$supplier_id][$start_week_q][$end_week_q]."' size='4'>";
                        echo "<button id='target_".$c."_" . $supplier_id . "_".$end_week_q."_" . $filtering_grade . "'>Save</button></div>";
                        echo "</td>";
                    }

                    $start_week_q = date('Y/m/d', strtotime("+7 days", strtotime($start_week_q)));
                    $c++;

                }
                echo "<td>";
                if ($supplier_remarks[$supplier_id] == '') {
                    echo "<div id='remarks_value_$supplier_id'><a id='".$supplier_id."' onclick='remarks(this.id);'><div id='remedit_$supplier_id'>Input</div></a></div>";
                } else {
                    echo "<div id='remarks_value_$supplier_id'><a id='".$supplier_id."' onclick='remarks(this.id);'><div id='remedit_$supplier_id'>".$supplier_remarks[$supplier_id]."</div></a></div>";
                }
                echo "<div id='remarks_edit_$supplier_id' class='editbox'><textarea style='width:200px; height:50px;' id='remarks_$supplier_id'>".$supplier_remarks[$supplier_id]."</textarea>
                <button id='remarks_".$supplier_id."_".$filtering_grade."' onclick='save2(this.id)'>Save</button>
                        </div>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</div>


<div class="



     clear">

</div>

<div class="clear">

</div>
<div class="clear">

</div>