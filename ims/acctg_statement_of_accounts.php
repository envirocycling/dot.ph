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
</script>
<style>
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
        } else {
            $start_date = date("Y/m/");
            $start_date = $start_date."01";
            $end_date = date("Y/m/d");
            $wp_grade = '';
        }

        echo "<h2>RMD Receiving as of ";
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
            echo "<td rowspan='2'>Date</td>";
            echo "<td rowspan='2'>Corrected Wt</td>";
            echo "<td rowspan='2'>TAT</td>";
            echo "<td colspan='2'>Unit SP</td>";
            echo "<td colspan='3'>Amount for Collection</td>";
            echo "<td colspan='3'>Amount Collected</td>";
            echo "<td colspan='2'>Balance for Collection</td>";
            echo "</tr>";

            if (isset ($_POST['submit'])) {
                $sql_actual = mysql_query("SELECT * FROM actual WHERE date>='$start_date' and date<='$end_date' and wp_grade like '%$wp_grade%' and delivered_to like '%$delivered_to%' ORDER BY date ASC");
            } else {
                $sql_actual = mysql_query("SELECT * FROM actual WHERE date>='$start_date' and date<='$end_date' and wp_grade like '%$wp_grade%' and (delivered_to like '%MULTIPLY%' or delivered_to like '%TIPCO%') ORDER BY date ASC");
            }

            while ($rs_actual = mysql_fetch_array($sql_actual)) {

            }

            ?>

        </table>

    </div>
</div>

<div class="clear">

</div>

<div class="clear">

</div>;