<?php
include("templates/template.php");
include 'config.php';
?>

<style>

    #total{

        font-weight: bold;

        background-color: yellow;

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
</script>

<style>
    body{
        background-color: #2e5e79;
    }
    .paper{
        border: 1px solid;
        font-size: 15px;
    }
    .paper th {
        background-color: #dbe5f1;
        padding: 3px;
        border: 1px solid;
    }
    .paper td{
        padding: 3px;
        border: 1px solid;
        width: 250px;
    }
    .header {
        background-color: #dbe5f1;
        font-weight: bold;
    }
    .total{
        background-color: yellow;
        font-weight: bold;
    }
</style>

<div class="grid_3">
    <div class="box round first">
        <h2>Filtering Options</h2>
        <form action="paper_buying_report_horizontal.php" method="POST">
            Start Period: <input type='text'  id='inputField' name='start_date' value="<?php echo date('Y/m/d');?>" onfocus='date1(this.id);' readonly size="8"><br>
            End Period:<input type='text'  id='inputField2' name='end_date' value="<?php echo date('Y/m/d');?>" onfocus='date1(this.id);' readonly size="8"><br>
            <?php
            $query = "SELECT * FROM branches";
            $result = mysql_query($query) ;
            echo "Branch:";
            $dropdown = "<select name='branch' >";
            $dropdown .= "\r\n<option value=''>All Branches</option>";

            $dropdown .= "\r\n<option value=''>__________</option>";
            while($row = mysql_fetch_array($result)) {
                $dropdown .= "\r\n<option value='{$row['branch_name']}'>{$row['branch_name']}</option>";
            }
            $dropdown  .= "\r\n</select><br>";
            echo $dropdown;

            ?>
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
</div>
<?php
if (isset ($_POST['submit'])) {
    ?>
<div class="grid_15">
    <div class="box round first grid">

            <?php

            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $tonnage_array = array ();
            $amount_array = array ();
            $total_tonnage_array = array ();
            $total_amount_array = array ();
            if ($_POST['branch'] == '') {
                echo "<h2>All Branches Paper Buying from $start_date to $end_date</h2>";
            } else {
                echo "<h2>".$_POST['branch']." Paper Buying from $start_date to $end_date</h2>";
            }

            $wp_grade_array = array('LCWL','ONP','CBS','OCC','MW','CHIPBOARD');

            foreach ($wp_grade_array as $wp_grade) {
                $start_q = $start_date;
                while ($start_q <= $end_date) {
                    $sql_paper = mysql_query("SELECT sum(corrected_weight),sum(paper_buying) FROM paper_buying WHERE date_received='$start_q' and wp_grade='$wp_grade' and branch like '%".$_POST['branch']."%'");
                    $rs_paper = mysql_fetch_array($sql_paper);
                    $tonnage_array[$wp_grade][$start_q] = $rs_paper['sum(corrected_weight)'];
                    $amount_array[$wp_grade][$start_q] = $rs_paper['sum(paper_buying)'];
                    $total_tonnage_array[$start_q]+=$tonnage_array[$wp_grade][$start_q];
                    $total_amount_array[$start_q]+=$amount_array[$wp_grade][$start_q];
                    $start_q = date('Y/m/d', strtotime("+1 day", strtotime($start_q)));
                }
            }

            echo '<table class="paper">';
            echo "<thead>";
            echo '<tr>';
            echo "<th></th>";
            $start_q = $start_date;
            while ($start_q <= $end_date) {
                echo "<th colspan='2'>".date("M d, Y", strtotime($start_q))."</th>";
                $start_q = date('Y/m/d', strtotime("+1 day", strtotime($start_q)));
            }
            echo "</tr>";
            echo "</thead>";

            echo '<tr class="header">';
            echo "<td>WP Grade</td>";
            $start_q = $start_date;
            while ($start_q <= $end_date) {
                echo "<td>Tonnage</td>";
                echo "<td>Amount</td>";
                $start_q = date('Y/m/d', strtotime("+1 day", strtotime($start_q)));
            }
            echo "</tr>";

            foreach ($wp_grade_array as $wp_grade) {
                $start_q = $start_date;
                echo "<tr>";
                echo "<td width='200'>$wp_grade</td>";
                while ($start_q <= $end_date) {
                    echo "<td width='100'>".round($tonnage_array[$wp_grade][$start_q]/1000,2)."</td>";
                    echo "<td width='100'>".number_format($amount_array[$wp_grade][$start_q]/1000,2)."</td>";
                    $start_q = date('Y/m/d', strtotime("+1 day", strtotime($start_q)));
                }
                echo "</tr>";
            }

            echo '<tr class="total">';
            echo "<td> TOTAL </td>";
            $start_q = $start_date;
            while ($start_q <= $end_date) {
                echo "<td>".round($total_tonnage_array[$start_q]/1000,2)."</td>";
                echo "<td>".number_format($total_amount_array[$start_q]/1000,2)."</td>";
                $start_q = date('Y/m/d', strtotime("+1 day", strtotime($start_q)));
            }
            echo "</tr>";
            echo "</table>";
            ?>
    </div>
</div>
    <?php
}
?>
<div class="clear">
</div>

<div class="clear">
</div>