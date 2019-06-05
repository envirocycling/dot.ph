<?php
include("templates/template.php");
include("config.php");
?>
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
</style>
<div class="grid_3">
    <div class="box round first">
        <h2>Filtering Options</h2>
        <form action="acctg_trade_receivable.php" method="POST">
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
                            }?>" name="wp_grade" size="12"><br>
            Deliver To:<input type="text" value="<?php if(isset ($_POST['deliver_to'])) {
                echo $_POST['deliver_to'];
                              }?>" name="deliver_to" size="12"><br>
            <input type="submit" name="submit" value="Filter">
        </form>
    </div>
</div>
<?php
if (isset ($_POST['submit'])) {
    ?>
<div class="grid_10" >
    <div class="box round first grid">
        <h2>Trade Receivable
                <?php
                echo " ".$_POST['start_date']." to ".$_POST['end_date']." in ";
                if ($_POST['wp_grade'] == '') {
                    echo "All Grades";
                } else {
                    echo $_POST['wp_grade'];
                }

                if ($_POST['deliver_to'] == '') {
                    echo ".";
                } else {
                    echo " delivers to ".$_POST['deliver_to'].".";
                }
                ?>
        </h2>

        <table class="data display datatable" id="example" border="1">
                <?php
                $start_date = $_POST['start_date'];
                $end_date = $_POST['end_date'];
                $wp_grade = $_POST['wp_grade'];
                $deliver_to = $_POST['deliver_to'];
                $deliver_to_array = array();

                $sql_actual = mysql_query("SELECT delivered_to FROM actual WHERE date>='$start_date' and date<='$end_date' and wp_grade like '%$wp_grade%' and delivered_to like '%$deliver_to%' GROUP BY delivered_to");
                while ($rs_actual = mysql_fetch_array($sql_actual)) {
                    array_push($deliver_to_array ,$rs_actual['delivered_to']);
                }

                echo "<thead>";
                echo "<th>Deliver To</th>";
                echo "</thead>";
                foreach ($deliver_to_array as $delivered_to) {
                    echo "<tr>";
                    echo "<td>$delivered_to</td>";
                    echo "</tr>";
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

<div class="clear">

</div>
<div class="clear">

</div>