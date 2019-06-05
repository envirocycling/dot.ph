<?php
include('config.php');
include('templates/template.php');

if (isset ($_POST['submit'])) {
    if (mysql_query("UPDATE `tipco_buying` SET `date_effective` = '".$_POST['date_effective']."', `price` = '".$_POST['price']."', `date_updated`='".date("Y/m/d")."' WHERE wp_grade LIKE '%".$_POST['wp_grade']."%'")) {
        echo "<script>
            alert('Succesfull');
            location.replace('new_tipco_buying.php');
            </script>";
    } else {
        echo "<script>
            alert('Failed');
            location.replace('new_tipco_buying.php');
            </script>";
    }
}

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
//    function change(val)
//    {
//        if (val == 'PAMPANGA'){
//            document.getElementById('type').disabled = false;
//        } else {
//            document.getElementById('type').disabled = true;
//        }
//    }
</script>



</head>
<div class="grid_5">
    <div class="box round first grid">
        <h2>Update Tipco Buying</h2>
        <form action="new_tipco_buying.php" method="POST">
            <?php
            
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
            Price: <input type="text" value="" name="price" size="10" required><br>
            <!-- Type: <select id="type" name="type" required disabled="true">
                <option value=""></option>
                <option value="Baled">Baled</option>
                <option value="Loose">Loose</option>
            </select><br> -->
            Date Effective: <input type='text'  id='inputField' name='date_effective' value="<?php echo date('Y/m/d');?>" onfocus='date1(this.id);' readonly size="8"><br>

            <input type="submit" name="submit" value="Update">
        </form>
    </div>
</div>
<div class="grid_5">
    <div class="box round first grid">
        <h2>Tipco Buying Based Price</h2>
        <table class="data display datatable" id="example">
            <?php
            $query="SELECT * from tipco_buying";
            $result=mysql_query($query);
            echo "<thead>";
            echo "<tr class='data'>";
            echo "<th class='data'>Date Effective</th>";
            echo "<th class='data'>WP Grade</th>";
            echo "<th class='data'>Price</th>";
            echo "</tr>";
            echo "</thead>";
            $total_weight=0;
            $total_tonnage=0;
            while($row = mysql_fetch_array($result)) {
                echo "<tr class='data'>";
                echo "<td class='data'>".$row['date_effective']."</td>";
                echo "<td class='data'>".$row['wp_grade']."</td>";
                echo "<td class='data'>".$row['price']."</td>";
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
