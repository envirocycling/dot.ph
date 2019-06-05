<?php
include('config.php');
include('templates/template.php');
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



</head>
<div class="grid_5">
    <div class="box round first grid">
        <h2>Per Grade Daily Receiving Performance</h2>
        <form action="dist/graphs/dashboard_daily_receiving_per_grade.php" method="POST">
            <br>
            <h6>Please select your range of dates</h6>
            Start Period: <input type='text'  id='inputField' name='start_date' value="<?php echo date('Y/m/d');?>" onfocus='date1(this.id);' readonly size="8"><br>
            End Period:<input type='text'  id='inputField2' name='end_date' value="<?php echo date('Y/m/d');?>" onfocus='date1(this.id);' readonly size="8"><br>
            <?php
            include("config.php");
            $query = "SELECT * FROM wp_grades  ";
            $result = mysql_query($query) ;
            echo "Branch:";
            $dropdown = "<select name='wp_grade' >";
     
            while($row = mysql_fetch_array($result)) {
                $dropdown .= "\r\n<option value='{$row['wp_grade']}'>{$row['wp_grade']}</option>";
            }
            $dropdown  .= "\r\n</select><br>";
            echo $dropdown;

            ?>

            <?php
            include("config.php");
            $query = "SELECT * FROM branches  ";
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
