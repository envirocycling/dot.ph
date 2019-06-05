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
<div class="grid_4">
    <div class="box round first grid">
        <h2>Starting Volume of Suppliers</h2>
        <form action="start_vol_vs_current_perf.php" method="POST">
            <br>
            <h6>Filtering Options</h6>
            <?php
            $query = "SELECT * FROM wp_grades ";
            $result = mysql_query($query) ;
            echo "WP Grade:";
            $dropdown = "<select name='wp_grade' >";
            $dropdown .= "\r\n<option value=''>All Grades</option>";
            $dropdown .= "\r\n<option value=''>__________</option>";
            while($row = mysql_fetch_array($result)) {
                $dropdown .= "\r\n<option value='{$row['wp_grade']}'>{$row['wp_grade']}</option>";
            }
            $dropdown  .= "</select><br>";
            echo $dropdown;
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
