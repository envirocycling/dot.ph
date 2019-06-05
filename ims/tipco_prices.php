<?php
include('config.php');
include('templates/template.php');

if (isset($_POST['submit'])) {
    if (mysql_query("INSERT INTO `tipco_prices`(`branch`, `wp_grade`, `price`, `type`, `date_effective`, `date_updated`)
        VALUES ('" . $_POST['branch'] . "','" . $_POST['wp_grade'] . "','" . $_POST['price'] . "','" . $_POST['type'] . "','" . $_POST['date_effective'] . "','" . date("Y/m/d") . "')")) {
        echo "<script>
            alert('Succesfully Added.');
            location.replace('tipco_prices.php');
            </script>";
    } else {
        echo "<script>
            alert('Failed to Add.');
            location.replace('tipco_prices.php');
            </script>";
    }
}

if (isset($_GET['del_id'])) {
    if (mysql_query("DELETE FROM tipco_prices WHERE log_id='" . $_GET['del_id'] . "'")) {
        echo "<script>
            alert('Succesfully Deleted.');
            location.replace('tipco_prices.php');
            </script>";
    } else {
        echo "<script>
            alert('Failed to Delete.');
            location.replace('tipco_prices.php');
            </script>";
    }
}
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
<div class="grid_4">
    <div class="box round first grid">
        <h2>Add Tipco Prices Form</h2>
        <form action="tipco_prices.php" method="POST">
            <?php
            $query = "SELECT * FROM branches";

            $branch_array = array();

            $result = mysql_query($query);
            echo "<br>Branch:";
            $dropdown = "<select name='branch'  id='wp_grade'>";
            while ($row = mysql_fetch_array($result)) {
                array_push($branch_array, $row['branch_name']);
                $dropdown .= "\r\n<option value='" . strtoupper($row['branch_name']) . "'>" . strtoupper($row['branch_name']) . "</option>";
            }
            $dropdown .= "\r\n</select><br>";
            echo $dropdown;
            $query = "SELECT * FROM wp_grades";
            $result = mysql_query($query);

            echo "WP Grade:";
            $dropdown = "<select name='wp_grade'  id='wp_grade' >";

            while ($row = mysql_fetch_array($result)) {
                $dropdown .= "\r\n<option value='" . strtoupper($row['wp_grade']) . "'>" . strtoupper($row['wp_grade']) . "</option>";
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
            Date Effective: <input type='text'  id='inputField' name='date_effective' value="<?php echo date('Y/m/d'); ?>" onfocus='date1(this.id);' readonly size="8"><br>

            <input type="submit" name="submit" value="Record">
        </form>
    </div>
</div>

<div class="grid_5">
    <div class="box round first grid">
        <h2>Latest Tipco Prices</h2>
        <table class="data display datatable" id="example">
            <?php
            $wp_grade_array = array('LCWL', 'ONP', 'CBS', 'OCC', 'MW', 'CHIPBOARD');
            $branch_price = array();
            foreach ($branch_array as $branch) {
                foreach ($wp_grade_array as $wp_grade) {
                    $sql = mysql_query("SELECT * from tipco_prices WHERE branch='$branch' and wp_grade='$wp_grade' order by date_effective DESC");
                    $rs = mysql_fetch_array($sql);
                    $branch_price[$branch][$wp_grade] = $rs['price'];
                }
            }
            echo "<thead>";
            echo "<tr class='data'>";
            echo "<th class='data'>Branch</th>";
            foreach ($wp_grade_array as $wp_grade) {
                echo "<th class='data'>$wp_grade</th>";
            }
            echo "</thead>";
            foreach ($branch_array as $branch) {
                echo "<tr class='data'>";
                echo "<td class='data'>$branch</td>";
                foreach ($wp_grade_array as $wp_grade) {
                    echo "<td class='data'>" . $branch_price[$branch][$wp_grade] . "</td>";
                }
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</div>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Tipco Prices Log</h2>
        <table class="data display datatable" id="example">
            <?php
            $query = "SELECT * from tipco_prices";
            $result = mysql_query($query);
            echo "<thead>";
            echo "<tr class='data'>";
            echo "<th class='data'>Log ID</th>";
            echo "<th class='data'>Date Effective</th>";
            echo "<th class='data'>Branch</th>";
            echo "<th class='data'>WP Grade</th>";
            echo "<th class='data'>Type</th>";
            echo "<th class='data'>Price</th>";
//            echo "<th class='data'>Action</th>";
            echo "</tr>";
            echo "</thead>";
            $total_weight = 0;
            $total_tonnage = 0;
            while ($row = mysql_fetch_array($result)) {
                echo "<tr class='data'>";
                echo "<td class='data'>" . $row['log_id'] . "</td>";
                echo "<td class='data'>" . $row['date_effective'] . "</td>";
                echo "<td class='data'>" . $row['branch'] . "</td>";
                echo "<td class='data'>" . $row['wp_grade'] . "</td>";
                echo "<td class='data'>" . $row['type'] . "</td>";
                echo "<td class='data'>" . $row['price'] . "</td>";
//                echo "<td class='data'>" . "<a href='tipco_prices.php?del_id=" . $row['log_id'] . "'><button>delete</button></a>" . "</td>";
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
