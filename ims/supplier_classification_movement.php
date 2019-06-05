<?php
ini_set('max_execution_time', 1000);
include("templates/template.php");
?>
<style>
    .assess{
        border: 1px solid black;
        font-size: 12px;
    }
</style>
<?php
include("config.php");
?>
<script>
    function openWindow(str) {
        var x = screen.width / 2 - 700 / 2;
        var y = screen.height / 2 - 450 / 2;
        window.open("view_supplier_assessment_delivery.php?sup_id=" + str, 'mywindow', 'width=600,height=600');
    }
</script>
<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
    function date1(str){
        new JsDatePick({
            useMode:2,
            target:str,
            dateFormat:"%Y/%m"

        });
    };
    //    $(document).ready(function()
    //    {
    $(window).load(function () {
        $(".editbox").hide();
        $("span").click(function(){
            var ID=$(this).attr('id');
            $("#value_"+ID).hide(500);
            $("#form_"+ID).show(500);
            var value=$("#remdummy_"+ID).val();
            $("#textarea_"+ID).html(value);
        });
        $("button").click(function(){
            var ID=$(this).attr('id');
            $("#form_"+ID).hide(500);
            $("#value_"+ID).show(500);
            var remarks=$("#textarea_"+ID).val();
            $("#value_"+ID).html(remarks);
            var dataString = 'id='+ ID +'&remarks='+remarks;
            $.ajax({
                type: "POST",
                url: "sup_class_movement_remarks_update.php",
                data: dataString,
                cache: false
            });
        });
    });
    //    });

</script>
<?php

?>
<div class="grid_10" >
    <div class="box round first grid">
        <h2>Supplier Classification Movement</h2>
        <br>
        <form action="supplier_classification_movement.php" method="POST">
            <h6>Filtering Options</h6>
            <br>
            Select Date: <input type='text'  id='inputField' name='date' value="<?php echo date("Y/m");?>" onfocus='date1(this.id);' readonly size="8">
            Branch:
            <select name="branch" required>

                <?php
                if (isset ($_POST['branch'])) {
                    echo "<option value='".$_POST['branch']."'>".$_POST['branch']."</option>";
                } else {
                    echo "<option value=''></option>";
                }
                echo "<option value=''>All Branches</option>";
                $sql_sup = mysql_query("SELECT * FROM branches");
                while ($rs_sup = mysql_fetch_array($sql_sup)) {
                    echo "<option value='".$rs_sup['branch_name']."'>".$rs_sup['branch_name']."</option>";
                }
                ?>
            </select>
            Reason:
            <select id="reason" name="reason" required>
                <?php
                if (isset ($_POST['reason'])) {
                    echo "<option value='".$_POST['reason']."'>".$_POST['reason']."</option>";
                } else {
                    echo '<option value=""></option>';
                }
                ?>
                <option value="">All Reasons</option>
                <option value="Incorrect Classification">Incorrect Classification</option>
                <option value="Diverted to EFI">Diverted to EFI</option>
                <option value="Diverted to EFI Suppliers">Diverted to EFI Suppliers</option>
                <option value="Diverted to Competitors">Diverted to Competitors</option>
            </select>

            <input type="submit" name="submit" value="Submit">

        </form>
        <br><br>
        <?php
        if (isset ($_POST['submit'])) {
            $s_date = $_POST['date']."/01";
            $start_date = date('Y/m/d', strtotime("-6 months", strtotime($s_date)));
            $end_date = date("Y/m/t",strtotime($s_date));
            echo '<table class="data display datatable" id="example" border="1">';
            echo "<thead>";
            echo "<th>ID</th>";
            echo "<th>Supplier</th>";
            echo "<th>Capacity</th>";
            echo "<th>Delivers To</th>";
            echo "<th>From</th>";
            echo "<th>To</th>";
            $start_q = $start_date;
            while ($start_q <= $end_date) {
                $month_q = date('F', strtotime($start_q));
                $year_q = date('Y', strtotime($start_q));
                echo "<th>" . $month_q . " " . $year_q . "</th>";
                $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
            }
            echo "<th>Remarks</th>";
            echo "</thead>";

            $supplier_id = array ();
            $supplier_name = array ();
            $capacity = array ();
            $grades_array = array('lcwl', 'onp', 'cbs', 'occ', 'mw', 'chipboard');
            $sup_movement = array();
            $sup_movement_date = array();
            $movemen_c = array ();
            $sup_rem = array ();
            if ($_POST['reason']!='') {
                $sql_sup = mysql_query("SELECT * FROM sup_class_movement INNER JOIN supplier_details ON sup_class_movement.supplier_id = supplier_details.supplier_id WHERE sup_class_movement.reason like '%".$_POST['reason']."%' and sup_class_movement.date>='$s_date' and sup_class_movement.date<='$end_date' and supplier_details.branch like '%".$_POST['branch']."%'");
            } else {
                $sql_sup = mysql_query("SELECT * FROM sup_class_movement INNER JOIN supplier_details ON sup_class_movement.supplier_id = supplier_details.supplier_id WHERE sup_class_movement.reason!='start_class' and sup_class_movement.date>='$s_date' and sup_class_movement.date<='$end_date' and supplier_details.branch like '%".$_POST['branch']."%'");
            }
            while ($rs_sup = mysql_fetch_array($sql_sup)) {
                $sql_c_sup = mysql_query("SELECT * FROM sup_class_movement WHERE supplier_id='".$rs_sup['supplier_id']."'");
                $rs_cc = mysql_num_rows($sql_c_sup);
                if ($rs_cc > 1) {
                    array_push($supplier_id, $rs_sup['supplier_id']);
                    $supplier_name[$rs_sup['supplier_id']]=$rs_sup['supplier_name'];
                }
            }

            foreach($supplier_id as $sup_id) {
                $capa = 0;
                $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE supplier_id='$sup_id' and date_effective<='$end_date' order by date_effective desc LIMIT 1");
                $rs_cap = mysql_fetch_array($sql_cap);
                $capa += $rs_cap['capacity'];
                $capacity[$sup_id] = $capa;

                foreach ($grades_array as $grade) {
                    $ctr = 0;
                    $sql_del_to = mysql_query("SELECT * FROM supplier_assessment WHERE wp_grade='$grade' and supplier_id='$sup_id' and date<='$end_date' and status!='deleted'");
                    while ($rs_del_to = mysql_fetch_array($sql_del_to)) {
                        $del_to_j1[$sup_id][$grade][$ctr]=$rs_del_to['deliver_to'];
                        $del_to_vol_j1[$sup_id][$grade][$ctr]=$rs_del_to['volume'];
                        $del_to_type_j1[$sup_id][$grade][$ctr]=$rs_del_to['type'];
                        $ctr++;
                    }
                    $sup_del_count_j1[$sup_id][$grade]=$ctr;
                }

                $start_q = $start_date;
                while ($start_q <= $end_date) {
                    $month_q = date('F', strtotime($start_q));
                    $year_q = date('Y', strtotime($start_q));
                    $sql_del = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='$sup_id' and month_delivered='$month_q' and year_delivered='$year_q'");
                    $rs_del = mysql_fetch_array($sql_del);
                    $del_j1[$sup_id][$month_q][$year_q]=$rs_del['sum(weight)']/1000;
                    $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
                }

                $ctr = 0;
                $sql_move = mysql_query("SELECT * FROM sup_class_movement WHERE supplier_id = '$sup_id'");
                while ($rs_move = mysql_fetch_array($sql_move)) {
                    $sup_movement[$sup_id][$ctr]=$rs_move['classification'];
                    $sup_movement_date[$sup_id][$ctr]=$rs_move['date'];
                    $ctr++;
                }
                $movemen_c[$sup_id]=$ctr;

                $sql_rem = mysql_query("SELECT * FROM sup_class_movement_remarks WHERE supplier_id = '$sup_id' and date<='$end_date'");
                while ($rs_rem = mysql_fetch_array($sql_rem)) {
                    $sup_rem[$sup_id]=$rs_rem['remarks'];
                }
            }


            $supplier_id = array_unique($supplier_id);

            foreach($supplier_id as $sup_id) {
                echo "<tr>";
                echo "<td>$sup_id</td>";
                echo "<td>".$supplier_name[$sup_id]."</td>";
                echo "<td>".$capacity[$sup_id]."</td>";
                echo "<td>";
                foreach ($grades_array as $grade) {
                    $ctr = 0;
                    if ($sup_del_count_j1[$sup_id][$grade] != 0) {
                        echo "<table class='assess'>";
                        echo "<td colspan='3' class='assess' align='center'>".strtoupper($grade)."</td>";
                        while ($ctr < $sup_del_count_j1[$sup_id][$grade]) {
                            if (!empty ($del_to_j1[$sup_id][$grade][$ctr])) {
                                $sql_del_to = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='".$del_to_j1[$sup_id][$grade][$ctr]."'");
                                $rs_del_to = mysql_fetch_array($sql_del_to);
                                echo "<tr>";
                                echo "<td class='assess'>".$rs_del_to['supplier_name']."</td>";
                                echo "<td class='assess'>".$del_to_vol_j1[$sup_id][$grade][$ctr]."</td>";
                                echo "<td class='assess'>".strtoupper($del_to_type_j1[$sup_id][$grade][$ctr])."</td>";
                                echo "</tr>";
                            }
                            $ctr++;
                        }
                        echo "</table>";
                    }
                }
                echo "</td>";
                echo "<td>";
                echo "<table class='assess'>";
                echo "<tr>";
                echo "<td class='assess'>CLASS</td>";
                echo "<td class='assess'>DATE</td>";
                echo "</tr>";
                if ($movemen_c[$sup_id] != 0) {
                    $ctr = 0;
                    if ($movemen_c[$sup_id] >= 1) {
                        $movemen_c[$sup_id]=$movemen_c[$sup_id]-1;
                    }
                    while ($ctr < $movemen_c[$sup_id]) {
                        echo "<tr>";
                        echo "<td class='assess'>".$sup_movement[$sup_id][$ctr]."</td>";
                        echo "<td class='assess'>".$sup_movement_date[$sup_id][$ctr]."</td>";
                        echo "</tr>";
                        $ctr++;
                    }
                }
                echo "</table>";
                echo "</td>";
                echo "<td>";
                echo "<table class='assess'>";
                echo "<tr>";
                echo "<td class='assess'>CLASS</td>";
                echo "<td class='assess'>DATE</td>";
                echo "</tr>";
                if ($ctr != 0) {
                    echo "<tr>";
                    echo "<td class='assess'>".$sup_movement[$sup_id][$ctr]."</td>";
                    echo "<td class='assess'>".$sup_movement_date[$sup_id][$ctr]."</td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "</td>";
                $start_q = $start_date;
                while ($start_q <= $end_date) {
                    $month_q = date('F', strtotime($start_q));
                    $year_q = date('Y', strtotime($start_q));
                    echo "<td id='".$sup_id."_".$month_q."_".$year_q."'>".$del_j1[$sup_id][$month_q][$year_q]."</td>";
                    $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
                }
                if (!empty($sup_rem[$sup_id])) {
                    echo "<td>
                    <input type='hidden' id='remdummy_$sup_id' value='".$sup_rem[$sup_id]."'>
                    <span id='$sup_id' class='text'><p id='value_$sup_id'><b>".$sup_rem[$sup_id]."</b></p></span>
                    <div id='form_$sup_id' class='editbox'>
                    <b>Remarks:</b>
                    <textarea style='width:200px; height:50px;' id='textarea_$sup_id'></textarea>
                    <br><button id='$sup_id'>Save</button></div>
                    </td>";
                } else {
                    echo "<td>
                    <span id='$sup_id' class='text'><p id='value_$sup_id'><u style='color:blue; font-size:12'><i>input</i></u></p></span>
                    <div id='form_$sup_id' class='editbox'>
                    <b>Remarks:</b>
                    <textarea style='width:200px; height:50px;' id='textarea_$sup_id'></textarea>
                    <br><button id='$sup_id'>Save</button></div>
                    </td>";
                }
                echo "</tr>";
            }

            echo "</table>";
        }



        ?>
    </div>
</div>
<div class="clear">

</div>

<div class="clear">

</div>
<div class="clear">

</div>