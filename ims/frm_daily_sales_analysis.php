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
</script>
<style>
    body{
        background-color: #2e5e79;
    }
</style>


</head>
<div class="grid_5">
    <div class="box round first grid">
        <h2>Daily Sales Analysis</h2>
        <?php
        if ($_SESSION['username'] == "lonlon") {
            ?>
            <form action="daily_sales_analysis_edit.php" method="POST">
                <?php
            } else {
                ?>
                <form action="daily_sales_analysis.php" method="POST">
                    <?php
                }
                ?>
                <br>
                <h6>Please select your range of dates</h6>
                Start Period: <input type='text'  id='inputField' name='start_date' value="<?php echo date('Y/m/d'); ?>" onfocus='date1(this.id);' readonly size="8"><br>
                End Period:<input type='text'  id='inputField2' name='end_date' value="<?php echo date('Y/m/d'); ?>" onfocus='date1(this.id);' readonly size="8"><br>
                <?php
                $query = "SELECT * FROM wp_grades ";
                $result = mysql_query($query);

                $query = "SELECT * FROM branches  ";
                $result = mysql_query($query);
                echo "Branch:";
                $dropdown = "<select name='branch' >";
                $dropdown .= "\r\n<option value=''>All Branches</option>";

                $dropdown .= "\r\n<option value=''>__________</option>";
                while ($row = mysql_fetch_array($result)) {
                    $dropdown .= "\r\n<option value='".$row['branch_name']."'>".utf8_encode($row['branch_name'])."</option>";
                }
                $dropdown .= "\r\n</select><br>";
                echo $dropdown;
                ?>


                <input type="submit" value="Generate Report">
            </form>
    </div>
</div>

</body>
</html>


<div class="clear">
</div>
<div class="clear">
</div>
