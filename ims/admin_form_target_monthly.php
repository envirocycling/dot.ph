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
        <h2>Monthly Target</h2>
        <form action="insert_monthly_target.php" method="POST">
            <?php
            include('config.php');
            $months=1;
            echo "Month: <select name='month' value=''>";
            echo "<option>".date('m')."</option>";
            while($months <=12) {
                if($months < 10) {
                    echo "<option>"."0".$months."</option>";
                }else {
                    echo "<option>".$months."</option>";
                }
                $months++;
            }
            echo "</select>";

            echo "Year: <select name='year' value=''>";
            $year=date('Y');
            $year_start=$year-10;
            $year_end=$year+10;
            echo "<option>".date('Y')."</option>";
            while($year_start <=$year_end) {
                echo "<option>$year_start</option>";
                $year_start++;
            }
            echo "</select>";
            ?>





            <?php

            $query = "SELECT * FROM branches";
            $result = mysql_query($query) ;
            echo "<br>Branch:";
            $dropdown = "<select name='branch'  id='wp_grade' >";
            while($row = mysql_fetch_array($result)) {
                $dropdown .= "\r\n<option value='".strtoupper ($row['branch_name'])."'>".strtoupper ($row['branch_name'])."</option>";
            }
            $dropdown .= "\r\n</select><br>";
            echo $dropdown;
            $query = "SELECT * FROM wp_grades";
            $result = mysql_query($query) ;

            echo "WP Grade:";
            $dropdown = "<select name='wp_grade'  id='wp_grade' >";

            while($row = mysql_fetch_array($result)) {
                $dropdown .= "\r\n<option value='".strtoupper ($row['wp_grade'])."'>".strtoupper ($row['wp_grade'])."</option>";
            }
            $dropdown .= "\r\n</select><br>";
            echo $dropdown;
            ?>
            Weight (in MT): <input type="text" value="" name="target" size="10" ><br>

            <input type="submit" value="Record">
        </form>
    </div>
</div>
<div class="grid_5">
    <div class="box round first grid">
        <h2>Monthly Target Log</h2>
        <table class="data display datatable" id="example">
            <?php
            $query="SELECT * from monthly_target";
            $result=mysql_query($query);
            echo "<thead>";
            echo "<tr class='data'>";
            echo "<th class='data'>Log ID</th>";
            echo "<th class='data'>Month</th>";
            echo "<th class='data'>Branch</th>";
            echo "<th class='data'>WP Grade</th>";
            echo "<th class='data'>Target</th>";

            echo "<th class='data'>Action</th>";
            echo "</tr>";
            echo "</thead>";
            $total_weight=0;
            $total_tonnage=0;
            while($row = mysql_fetch_array($result)) {
                echo "<tr class='data'>";
                echo "<td class='data'>".$row['log_id']."</td>";
                echo "<td class='data'>".$row['month']."</td>";
                echo "<td class='data'>".$row['branch']."</td>";
                echo "<td class='data'>".$row['wp_grade']."</td>";
                echo "<td class='data'>".$row['target']."</td>";

                echo "<td class='data'>"."<a href='delete_target_monthly.php?log_id=".$row['log_id']."'><button>delete</button></a>"."</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</div>
</body>
</html>


<div class="clear">
</div>
<div class="clear">
</div>
