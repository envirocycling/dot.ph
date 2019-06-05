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
        <h2>Quarterly Target</h2>
        <form action="record_receiving_target.php" method="POST">
            Date of Effectivity: <input type='text'  id='inputField' name='date' value="<?php echo date('Y/m/d');?>" onfocus='date1(this.id);' readonly size="8"><br>

            <?php

            include('config.php');

            $query = "SELECT * FROM branches";
            $result = mysql_query($query) ;

            echo "Branch:";
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
            Weight: <input type="text" value="" name="weight" size="10" ><br>
            Period: <select name="period" value="">
                <option value="first">1st QTR</option>
                <option value="second">2nd QTR</option>
                <option value="third">3rd QTR</option>
                <option value="fourth">4th QTR</option>
            </select><br>

            <input type="submit" value="Record">

        </form>



    </div>
</div>


<div class="grid_5">
    <div class="box round first grid">
        <h2>Quarterly Target Log</h2>

        <table class="data display datatable" id="example">
            <?php
            $query="SELECT * from target_receiving";
            $result=mysql_query($query);
            echo "<thead>";
            echo "<tr class='data'>";
            echo "<th class='data'>Log ID</th>";
            echo "<th class='data'>Period</th>";
            echo "<th class='data'>Branch</th>";
            echo "<th class='data'>WP Grade</th>";
            echo "<th class='data'>Weight</th>";
            echo "<th class='data'>Date of Effectivity</th>";
            echo "<th class='data'>Action</th>";
            echo "</tr>";
            echo "</thead>";

            $total_weight=0;
            $total_tonnage=0;
            while($row = mysql_fetch_array($result)) {
                echo "<tr class='data'>";
                echo "<td class='data'>".$row['log_id']."</td>";
                echo "<td class='data'>".strtoupper($row['period'])."</td>";
                echo "<td class='data'>".$row['branch']."</td>";
                echo "<td class='data'>".$row['wp_grade']."</td>";
                echo "<td class='data'>".$row['weight']."</td>";
                echo "<td class='data'>".$row['date']."</td>";
                echo "<td class='data'>"."<a href='delete_target_receiving.php?log_id=".$row['log_id']."'><button>delete</button></a>"."</td>";
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
