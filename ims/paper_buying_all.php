<?php
include("templates/template.php");
?>
<style>
    #total{
        font-weight: bold;
        background-color: yellow;
    }
</style>
<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
    function date2(str) {
        new JsDatePick({
            useMode: 2,
            target: str,
            dateFormat: "%Y/%m/%d"

        });
    }
    ;
</script>
<style>
    #link_ng_str{
        color:blue;
    }
    #positive{
        color:green;
        font-weight: bold;
        background-color:#FF9340;
    }
    #negative{
        color:red;
        font-weight: bold;
        background-color:#FF9340;
    }

    #zero{

        font-weight: bold;
        background-color:#FF9340;
    }
    #net{
        font-weight:bold;
        background-color:#33CCFF;
    }
    #from_location{
        font-weight:bold;
        background-color:#29A6CF;
    }
    #dr{
        font-weight:bold;
        background-color:#33CCCC;
    }
    #mc{
        background-color: #85E0FF;
    }
    #dirt{
        background-color: #00B8E6;
    }
    #corrected{
        background-color: yellow;
        font-weight:bold;
    }

</style>
<div class="grid_3">
    <div class="box round first">
        <h2>Filtering Options</h2>
        <form action="paper_buying_all.php" method="POST">
            Start Date: <input type='text'  id='from' name='from' value="<?php
            if (isset($_POST['from'])) {
                echo $_POST['from'];
            } else {
                echo date("Y/m/d");
            }
            ?>" onfocus='date2(this.id);' readonly size="8"><br>
            End Date: <input type='text'  id='to' name='to' value="<?php
            if (isset($_POST['to'])) {
                echo $_POST['to'];
            } else {
                echo date("Y/m/d");
            }
            ?>" onfocus='date2(this.id);' readonly size="8"><br>
            Group: <select name="group">
                <option value="">All</option>
                <option value="With Additional">With Additional</option>
                <option value="Without Additional">Without Additional</option>
            </select><br>
            Wp Grade: <input type="text" name="wp_grade" value="" size="8"><br>
            <input type="submit" name="submit" value="Filter">
        </form>
    </div>
</div>
<?php
if (isset($_POST['submit'])) {
    ?>
    <div class="grid_10">
        <div class="box round first grid">
            <?php
            $ngayon = date('F d, Y');
            $branch = $_SESSION['paper_buying_branch'];
            if ($branch == 'all') {
                $branch = '';
            }
            $total_receiving = 0;
            echo "<h2>Paper Buying Report from: " . $_POST['from'] . " to: " . $_POST['to'] . " " . $_POST['group'];
            if (isset($_POST['wp_grade'])) {
                echo " in " . $_POST['wp_grade'];
            } else {
                echo " All Grades";
            }
            echo "</h2>";
            ?>
            <table class="data display datatable" id="example">
                <?php
                echo "<thead>";
                echo '<tr class="data">';
                echo "<th class='data'>Date Received</th>";
                echo "<th class='data'>Supplier ID</th>";
                echo "<th class='data'>Supplier Name</th>";
                echo "<th class='data'>WP Grade</th>";
                echo "<th class='data'>Corrected Weight</th>";
                echo "<th class='data'>Buying Price</th>";
//                echo "<th class='data'>Tipco Price</th>";
//                echo "<th class='data'>Additional</th>";
//                echo "<th class='data'>Amount</th>";
                echo "<th class='data'>Paper Buying</th>";
                echo "<th class='data'>Branch</th>";
                echo "</tr>";
                echo "</thead>";
                include("config.php");
                $query = "Select * from paper_buying WHERE wp_grade like '%" . $_POST['wp_grade'] . "%' and date_received>='" . $_POST['from'] . "' and date_received<='" . $_POST['to'] . "'";
                $result = mysql_query($query);
                $total_corrected_weight = 0;
                $total_add = 0;
                $total_amount = 0;
                while ($row = mysql_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['date_received'] . "</td>";
                    echo "<td>" . $row['supplier_id'] . "</td>";
                    echo "<td>" . $row['supplier_name'] . "</td>";
                    echo "<td>" . $row['wp_grade'] . "</td>";
                    echo "<td>" . $row['corrected_weight'] . "</td>";
                    $total_corrected_weight+=$row['corrected_weight'];
                    echo "<td>" . $row['unit_cost'] . "</td>";
                    echo "<td>" . $row['paper_buying'] . "</td>";
                    $total_pp+=$row['paper_buying'];
                    echo "<td>" . $row['branch'] . "</td>";
                    echo "</tr>";
                }
                echo "<tr id='total'>";
                echo "<td>!TOTAL!</td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td>" . number_format($total_corrected_weight, 2) . "</td>";
                echo "<td></td>";
                echo "<td>" . number_format($total_pp,2)."</td>";
                echo "<td></td>";
                echo "</tr>";
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
