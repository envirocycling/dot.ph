<?php
include("templates/template.php");
?>
<style>
    #total{
        font-weight: bold;
        background-color: yellow;
    }
    #highlight{
        background-color:85EB6A;
        color:black;
    }
    #highlight a{
        background-color:85EB6A;
        color:black;
    }
</style>
<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
    function date1(str){
        new JsDatePick({
            useMode:2,
            target:str,
            dateFormat:"%Y/%m/%d"

        });
    };

    $(window).load(function () {
        $(".editbox").hide();
        $("span").click(function() {
            var ID = $(this).attr('id');
            $("#regular_edit_" + ID).show(500);
            $("#regular_value_" + ID).hide(500);
            $("#sundry_edit_" + ID).show(500);
            $("#sundry_value_" + ID).hide(500);
            $("#date_collected_edit_" + ID).show(500);
            $("#date_collected_value_" + ID).hide(500);
        });
        $("button").click(function() {
            var ID = $(this).attr('id');
            var splits = ID.split("_");
            var ID = splits[0];
            var wp_grade = splits[1];
            var dr_number = splits[2];
            var regular = $("#regular_" + ID).val();
            var sundry = $("#sundry_" + ID).val();
            var date_collected = $("#date_collected_" + ID).val();

            $("#regular_value_" + ID).html(regular);
            $("#sundry_value_" + ID).html(sundry);

            var afc_regular = $("#afc_regular_value_" + ID).val();
            var afc_sundry = $("#afc_sundry_value_" + ID).val();

            var bfc_regular = Number(afc_regular - regular);
            var bfc_sundry = Number(afc_sundry - sundry);

            $("#bfc_regular_" + ID).html(bfc_regular);
            $("#bfc_sundry_" + ID).html(bfc_sundry);

            $("#regular_edit_" + ID).hide(500);
            $("#regular_value_" + ID).show(500);
            $("#sundry_edit_" + ID).hide(500);
            $("#sundry_value_" + ID).show(500);
            $("#date_collected_edit_" + ID).hide(500);
            $("#date_collected_value_" + ID).show(500);

            if (regular != '' && sundry != '' && date_collected != ''){
                alert('Successfully Save');
                var dataString = 'dr_number='+dr_number+'&wp_grade='+wp_grade+'&regular=' + regular + '&sundry=' + sundry + '&date_collected=' + date_collected;
                $.ajax({
                    type: "POST",
                    url: "acctg_add_amount_collected.php",
                    data: dataString,
                    cache: false
                });
            }
        });
    });
</script>
<style>
    .head{
        font-weight: bold;
        text-align: center;
        border: 1px solid;
    }
    .table td{
        font-size: 13px;
        margin-top: 20px;
        border: 1px solid;
    }
    .td td {
        border: 1px solid;
        width: 100px;
    }
</style>
<div class="grid_3">
    <div class="box round first">
        <h2>Filtering Options</h2>
        <form action="acctg_accounts_receivable.php" method="POST">
            Start date: <input type='text' id='inputField' name='start_date' value="<?php if(isset ($_POST['start_date'])) {
                echo $_POST['start_date'];
            } else {
                echo date("Y/m/d");
                               }?>" onfocus='date1(this.id);' readonly size="8"><br>
            End date: <input type='text' id='inputField2' name='end_date' value="<?php if(isset ($_POST['end_date'])) {
                echo $_POST['end_date'];
            } else {
                echo date("Y/m/d");
                             }?>" onfocus='date1(this.id);' readonly size="8"><br>
            WP Grade:<input type="text" value="<?php if(isset ($_POST['wp_grade'])) {
                echo $_POST['wp_grade'];
                            }?>" name="wp_grade"><br>
            Delivered To:<input type="text" value="<?php if(isset ($_POST['delivered_to'])) {
                echo $_POST['delivered_to'];
                                }?>" name="delivered_to"><br>
            <input type="submit" name="submit" value="Filter">
        </form>
    </div>
</div>

<div class="grid_16">
    <div class="box round first grid">
        <?php
        include("config.php");
        if (isset ($_POST['start_date'])) {
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $wp_grade = $_POST['wp_grade'];
            $delivered_to = $_POST['delivered_to'];
        } else {
            $start_date = date("Y/m/");
            $start_date = $start_date."01";
            $end_date = date("Y/m/d");
            $wp_grade = '';
            $delivered_to = '';
        }

        echo "<h2>Accounts Receivable as of ";
        if (!isset ($_POST['start_date'])) {
            echo $start_date." to ".$end_date.".";
        } else {
            if ($start_date == $end_date) {
                echo $start_date.".";
            } else {
                echo $start_date." to ".$end_date.".";
            }
        }
        echo "</h2>";
        ?>
        <table class="table">
            <?php
            $total_weight = 0;
            $total_mc = 0;
            $total_dirt = 0;
            $total_corrected =0;
            echo '<tr class="head"> ';
            echo "<td rowspan='2'>Date</td>";
            echo "<td rowspan='2'>Branch</td>";
            echo "<td rowspan='2'>DR #</td>";
            echo "<td rowspan='2'>WP Grade</td>";
            echo "<td rowspan='2'>Corrected Wt</td>";
            echo "<td rowspan='2'>TAT</td>";
            echo "<td colspan='2'>Unit SP</td>";
            echo "<td colspan='3'>Amount for Collection</td>";
            echo "<td colspan='3'>Amount Collected</td>";
            echo "<td colspan='2'>Balance for Collection</td>";
            echo "</tr>";
            echo "<tr class='head'>";
            echo "<td>Regular</td>";
            echo "<td>Sundry</td>";
            echo "<td>Regular</td>";
            echo "<td>Creditable w/ tax</td>";
            echo "<td>Sundry</td>";
            echo "<td>Regular</td>";
            echo "<td>Sundry</td>";
            echo "<td>Date Collected</th>";
            echo "<td>Regular</td>";
            echo "<td>Sundry</td>";
            echo "</tr>";

            if (isset ($_POST['submit'])) {
                $sql_actual = mysql_query("SELECT * FROM actual WHERE date>='$start_date' and date<='$end_date' and wp_grade like '%$wp_grade%' and delivered_to like '%$delivered_to%' ORDER BY date ASC");
            } else {
                $sql_actual = mysql_query("SELECT * FROM actual WHERE date>='$start_date' and date<='$end_date' and wp_grade like '%$wp_grade%' and (delivered_to like '%MULTIPLY%' or delivered_to like '%TIPCO%') ORDER BY date ASC");
            }

            while ($rs_actual = mysql_fetch_array($sql_actual)) {
                echo "<tr class='td'>";
                echo "<td>".$rs_actual['date']."</td>";
                echo "<td>".$rs_actual['branch']."</td>";
                echo "<td>".$rs_actual['dr_number']."</td>";
                echo "<td>".$rs_actual['wp_grade']."</td>";
                echo "<td>".$rs_actual['weight']."</td>";
                echo "<td>".$rs_actual['tat']."</td>";
                $sql_reg_price = mysql_query("SELECT price FROM price_regular WHERE date_effective<='".$rs_actual['date']."' ORDER BY date_effective,id DESC LIMIT 1");
                $rs_reg_price = mysql_fetch_array($sql_reg_price);
                if ($rs_reg_price['price'] == '') {
                    $sql_reg_price = mysql_query("SELECT price FROM price_regular WHERE date_effective<='$end_date' ORDER BY date_effective,id DESC LIMIT 1");
                    $rs_reg_price = mysql_fetch_array($sql_reg_price);
                    echo "<td align='right'>".number_format($rs_reg_price['price'],2)."</td>";
                } else {
                    echo "<td align='right'>".number_format($rs_reg_price['price'],2)."</td>";
                }
                $sql = mysql_query("SELECT * FROM tipco_prices WHERE wp_grade like '%".$rs_actual['wp_grade']."%' and branch='" . $rs_actual['branch'] . "' and date_effective <= '" . $rs_actual['date'] . "' ORDER BY date_effective,log_id DESC");
                $rs = mysql_fetch_array($sql);
                $usp_sundry = $rs['price']-$rs_reg_price['price'];
                $afc_regular = $rs_actual['weight']*$rs_reg_price['price'];
                $afc_cwt = ($rs_reg_price['price']*$rs_actual['weight']/1.12)*0.01;
                $afc_sundry = $afc_regular*$usp_sundry;
                echo "<td align='right'>".number_format($usp_sundry,2)."</td>";
                echo "<td align='right'>
                    <input type='hidden' id='afc_regular_value_".$rs_actual['log_id']."' value='$afc_regular'>
                    <div id='afc_regular_".$rs_actual['log_id']."'>".number_format($afc_regular,2)."</div></td>";
                echo "<td align='right'>".number_format($afc_cwt,2)."</td>";
                echo "<td align='right'>
                    <input type='hidden' id='afc_sundry_value_".$rs_actual['log_id']."' value='$afc_regular'>
                    <div id='afc_sundry_".$rs_actual['log_id']."'>".number_format($afc_sundry,2)."</div></td>";
                $sql_ar = mysql_query("SELECT * FROM accounts_receivable WHERE dr_number='".$rs_actual['dr_number']."' and wp_grade='".$rs_actual['wp_grade']."'");
                $rs_ar = mysql_fetch_array($sql_ar);
                if ($_SESSION['position'] == 'Accounting Staff') {
                    echo "<td align='right'>";
                    echo "<span id='".$rs_actual['log_id']. "' class='text'>";
                    if ($rs_ar['regular'] == '') {
                        echo "<div id='regular_value_".$rs_actual['log_id']. "'>0</div>";
                    } else {
                        echo "<div id='regular_value_".$rs_actual['log_id']. "'>".$rs_ar['regular']."</div>";
                    }
                    echo "</span>";
                    echo "<div id='regular_edit_".$rs_actual['log_id']. "' class='editbox'>";
                    echo "<input class='marketing' id='regular_".$rs_actual['log_id']. "' value='".$rs_ar['regular']."' size='4'>";
                    echo "</div>";
                    echo "</td>";
                    echo "<td align='right'>";
                    echo "<span id='".$rs_actual['log_id']. "' class='text'>";
                    if ($rs_ar['sundry'] == '') {
                        echo "<div id='sundry_value_".$rs_actual['log_id']. "'>0</div>";
                    } else {
                        echo "<div id='sundry_value_".$rs_actual['log_id']. "'>".$rs_ar['sundry']."</div>";
                    }
                    echo "</span>";
                    echo "<div id='sundry_edit_".$rs_actual['log_id']. "' class='editbox'>";
                    echo "<input class='marketing' id='sundry_".$rs_actual['log_id']. "' value='".$rs_ar['sundry']."' size='4'>";
                    echo "<button id='".$rs_actual['log_id']. "_".$rs_actual['wp_grade']. "_".$rs_actual['dr_number']. "'>Save</button></div>";
                    echo "</td>";
                    echo "<td align='right'>";
                    echo "<span id='".$rs_actual['log_id']. "' class='text'>";
                    if ($rs_ar['date_collected'] == '') {
                        echo "<div id='date_collected_value_".$rs_actual['log_id']. "'>0</div>";
                    } else {
                        echo "<div id='date_collected_value_".$rs_actual['log_id']. "'>".$rs_ar['date_collected']."</div>";
                    }
                    echo "</span>";
                    echo "<div id='date_collected_edit_".$rs_actual['log_id']. "' class='editbox'>";
                    echo "<input class='marketing' id='date_collected_".$rs_actual['log_id']. "' value='".$rs_ar['date_collected']."' size='4'>";
                    echo "</div>";
                    echo "</td>";
                } else {
                    echo "<td align='right'>".$rs_ar['regular']."</td>";
                    echo "<td align='right'>".$rs_ar['sundry']."</td>";
                    echo "<td align='right'>".$rs_ar['date_collected']."</td>";
                }
                if (!empty ($rs_ar['regular'])) {
                    echo "<td align='right'><div id='bfc_regular_".$rs_actual['log_id']."'>".number_format($afc_regular-$rs_ar['regular'],2)."</div></td>";
                    echo "<td align='right'><div id='bfc_sundry_".$rs_actual['log_id']."'>".number_format($afc_sundry-$rs_ar['sundry'],2)."</div></td>";
                } else {
                    echo "<td align='right'><div id='bfc_regular_".$rs_actual['log_id']."'>".number_format($afc_regular-$afc_cwt,2)."</div></td>";
                    echo "<td align='right'><div id='bfc_sundry_".$rs_actual['log_id']."'>".number_format(($rs_actual['weight']*$usp_sundry)-$rs_ar['sundry'],2)."</div></td>";
                }
                echo "</tr>";
            }

            ?>

        </table>

    </div>
</div>

<div class="clear">

</div>

<div class="clear">

</div>;