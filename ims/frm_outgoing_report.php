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
        <h2>Please select your range of dates</h2>
        <form action="all_outgoing_report.php" method="POST">

            Start Period: <input type='text'  id='inputField' name='start_date' value="<?php echo date('Y/m/d');?>" onfocus='date1(this.id);' readonly size="8"><br>
            End Period:<input type='text'  id='inputField2' name='end_date' value="<?php echo date('Y/m/d');?>" onfocus='date1(this.id);' readonly size="8"><br>
            <?php
            $query = "SELECT * FROM wp_grades ";
            $result = mysql_query($query) ;
            echo "WP Grade:";
            $dropdown = "<select name='wp_grade' >";
            $dropdown .= "\r\n<option value=''>All Grades</option>";
            $dropdown .= "\r\n<option value=''>__________</option>";
            while($row = mysql_fetch_array($result)) {
                if (strtoupper($row['wp_grade']) != 'LCWL' && strtoupper($row['wp_grade']) != 'CHIPBOARD' && strtoupper($row['wp_grade']) != 'WBOND') {
                    $dropdown .= "\r\n<option value='LC".strtoupper($row['wp_grade'])."'>LC".strtoupper($row['wp_grade'])."</option>";
                } else {
                    $dropdown .= "\r\n<option value='".strtoupper($row['wp_grade'])."'>".strtoupper($row['wp_grade'])."</option>";
                }
            }
            $dropdown  .= "</select><br>";
            echo $dropdown;
            $query = "SELECT * FROM branches";
            $result = mysql_query($query) ;
            echo "Branch:";
            $dropdown = "<select name='branch' >";
            $dropdown .= "\r\n<option value=''>All Branches</option>";
            $dropdown .= "\r\n<option value='Sauyo/Kaybiga'>Sauyo/Kaybiga</option>";
            $dropdown .= "\r\n<option value=''>__________</option>";
            while($row = mysql_fetch_array($result)) {
                $dropdown .= "\r\n<option value='{$row['branch_name']}'>{$row['branch_name']}</option>";
            }
            $dropdown  .= "\r\n</select><br>";
            echo $dropdown;
            ?>
            Delivered to:<input type="text" name="delivered_to" value="" size="10"><br>

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
