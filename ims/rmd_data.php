<?php
@session_start();
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
    #highlighted td{
        background-color: #65EC3B;
        color:red;
    }
</style>
<div class="grid_3">
    <div class="box round first">
        <h2>Filtering Options</h2>
        <form action="rmd_data.php" method="POST">
            Start date: <input type='text' id='inputField' name='start_date' value="<?php
            if (isset($_POST['start_date'])) {
                echo $_POST['start_date'];
            } else {
                echo date("Y/m/d");
            }
            ?>" onfocus='date1(this.id);' readonly size="8"><br>
            End date: <input type='text' id='inputField2' name='end_date' value="<?php
            if (isset($_POST['end_date'])) {
                echo $_POST['end_date'];
            } else {
                echo date("Y/m/d");
            }
            ?>" onfocus='date1(this.id);' readonly size="8"><br>
            WP Grade:<input type="text" value="<?php
            if (isset($_POST['wp_grade'])) {
                echo $_POST['wp_grade'];
            }
            ?>" name="wp_grade"><br>
            Delivered To:<input type="text" value="<?php
            if (isset($_POST['delivered_to'])) {
                echo $_POST['delivered_to'];
            }
            ?>" name="delivered_to"><br>
            <input type="submit" name="submit" value="Filter">
        </form>
    </div>
</div>

<div class="grid_9">
    <div class="box round first grid">
        <?php
        include("config.php");
        if (isset($_POST['start_date'])) {
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $wp_grade = $_POST['wp_grade'];
            $delivered_to = $_POST['delivered_to'];
        } else {
            $start_date = date("Y/m/");
            $start_date = $start_date . "01";
            $end_date = date("Y/m/d");
            $wp_grade = '';
            $delivered_to = '';
        }

        echo "<h2>RMD Receiving as of ";
        if (!isset($_POST['start_date'])) {
            echo $start_date . " to " . $end_date . ".";
        } else {
            if ($start_date == $end_date) {
                echo $start_date . ".";
            } else {
                echo $start_date . " to " . $end_date . ".";
            }
        }
        echo "</h2>";
        ?>
        <table class="data display datatable" id="example">
            <?php
            $total_weight = 0;
            $total_mc = 0;
            $total_dirt = 0;
            $total_corrected = 0;
            echo "<thead>";
            echo '<tr class="data"> ';
            echo "<th class='data' width='70'>Date</th>";
            echo "<th class='data' width='70'>Branch</th>";
            echo "<th class='data' width='70'>DR #</th>";
            echo "<th class='data' width='20'>WP Grade</th>";
            echo "<th class='data' width='70'>Weight</th>";
            echo "<th class='data' width='30'>MC</th>";
            echo "<th class='data' width='30'>Dirt</th>";
            echo "<th class='data' width='50'>Corrected Weight</th>";
            echo "<th class='data' width='20'>TAT</th>";
            echo "<th class='data' width='50'>Delivered to</th>";
            echo "<th class='data' width='100'>Remarks</th>";
            echo "<th class='data' width='60'>Action</th>";
            echo "</tr>";
            echo "</thead>";
            if (isset($_POST['submit'])) {
                $sql_actual = mysql_query("SELECT * FROM actual2 WHERE date>='$start_date' and date<='$end_date' and wp_grade like '%$wp_grade%' and delivered_to like '%$delivered_to%'");
            } else {
                $sql_actual = mysql_query("SELECT * FROM actual2 WHERE date>='$start_date' and date<='$end_date' and wp_grade like '%$wp_grade%' and (delivered_to like '%MULTIPLY%' or delivered_to like '%TIPCO%')");
            }
            while ($rs_actual = mysql_fetch_array($sql_actual)) {
                echo "<tr>";
                echo "<td>" . $rs_actual['date'] . "</td>";
                echo "<td>" . $rs_actual['branch'] . "</td>";
                echo "<td>" . $rs_actual['dr_number'] . "</td>";
                echo "<td>" . $rs_actual['wp_grade'] . "</td>";
                if ($rs_actual['net_wt'] == '') {
                    echo "<td>" . $rs_actual['weight'] . "</td>";
                    $total_weight+=$rs_actual['weight'];
                } else {
                    echo "<td>" . $rs_actual['net_wt'] . "</td>";
                    $total_weight+=$rs_actual['net_wt'];
                }
                echo "<td>" . $rs_actual['mc'] . "</td>";
                $total_mc+=$rs_actual['mc'];
                echo "<td>" . $rs_actual['dirt'] . "</td>";
                $total_dirt+=$rs_actual['dirt'];
                echo "<td>" . $rs_actual['weight'] . "</td>";
                $total_corrected+=$rs_actual['weight'];
                echo "<td></td>";
                echo "<td>" . $rs_actual['delivered_to'] . "</td>";
                echo "<td>" . $rs_actual['comments'] . "</td>";
                echo "<td>";
                if ($_SESSION['usertype'] == 'RMD Supervisor') {
//                <a rel='facebox' href='edit_rmd_data.php?log_id=".$rs_actual['log_id']."'><button>Edit</button></a>&nbsp;";
                    ?>
                    <a href="rmd_data_del.php?log_id=<?php echo $rs_actual['log_id']; ?>" onclick="return confirm('Are you sure you want to delete?')"><button>Delete</button></a>
                    <?php
                }
                echo "</td></tr>";
            }
            echo "<tr id='total'>";
            echo "<td>!TOTAL!</td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td>$total_weight</td>";
            echo "<td>$total_mc</td>";
            echo "<td>$total_dirt</td>";
            echo "<td>$total_corrected</td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "</tr>";
            ?>

        </table>

    </div>
</div>

<div class="clear">

</div>

<div class="clear">

</div>