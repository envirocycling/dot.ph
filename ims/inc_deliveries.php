<?php
session_start();
date_default_timezone_set('America/Los_Angeles');
include("templates/template.php");

include("config.php");
if (isset($_GET['approve_id'])) {
    $approve_id = $_GET['approve_id'];
    mysql_query("UPDATE incentive_scheme SET confirm='1' WHERE del_id='$approve_id'");
    echo "<script>
    alert('Successfully Approved...');
    window.location = 'inc_deliveries.php';
    </script>";
}
if (isset($_GET['disapprove_id'])) {
    $disapprove_id = $_GET['disapprove_id'];
    mysql_query("DELETE FROM incentive_scheme WHERE del_id='$disapprove_id'");
    echo "<script>
    alert('Successfully Disapproved...');
    window.location = 'inc_deliveries.php';
    </script>";
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <?php
        $ngayon = date('F d, Y');
        echo "<h2>  Pending Supplier Incentives as of : <u><b><i>" . $ngayon . "</i></b></u></h2>";
        ?>
        <table class="data display datatable" id="example">
            <?php
            echo "<thead>";
            echo "<th width='30px'>ID</th>";
            echo "<th>Suppliername</th>";
            echo "<th>Branch</th>";
            echo "<th>Incentive Type</th>";
            echo "<th>Scheme</th>";
            echo "<th>WP Grades</th>";
            echo "<th>Base Price</th>";
            echo "<th>WP Prices</th>";
            echo "<th>Incentive</th>";
            echo "<th>Quota (KG)</th>";
            echo "<th>Cov Inc.</th>";
            if ($_SESSION['username'] == 'lonlon' || $_SESSION['username'] == 'rj' || $_SESSION['username'] == 'lorna_regala') {
                echo "<th class='data'>Action</th>";
            }

            echo "</thead>";


            $query = "SELECT * FROM incentive_scheme where confirm='0'";
            $result = mysql_query($query);
            while ($row = mysql_fetch_array($result)) {
                $range = $row['scheme'];
                $range_date_array = preg_split('/[ -.]/', $range);
                $query2 = "SELECT supplier_name from supplier_details where supplier_id='" . $row['sup_id'] . "'";
                $result2 = mysql_query($query2);
                $row2 = mysql_fetch_array($result2);
                echo "<tr>";
                echo "<td class='data'>" . $row['sup_id'] . "</td>";
                echo "<td class='data'>" . $row2['supplier_name'] . "</td>";
                $sql = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='" . $row['sup_id'] . "'");
                $rs = mysql_fetch_array($sql);
                echo "<td class='data'>" . $rs['branch'] . "</td>";
                echo "<td class='data'>" . ucfirst($row['type']) . "</td>";
                echo "<td class='data'>" . $row['scheme'] . "</td>";
                echo "<td class='data'>" . $row['wp_grade'] . "</td>";
                $formatted_inc = number_format($row['incentive'], 2);
                echo "<td class='data'>" . $row['base_price'] . "</td>";
                echo "<td class='data'>$wp_prices" . $row['wp_prices'] . "</td>";
                echo "<td class='data'>" . $formatted_inc . "</td>";
                echo "<td class='data'>" . number_format($row['quota'], 1) . "</td>";
                echo "<td class='data'>" . number_format($row['covered_incentive'], 1) . "</td>";
                $incentive_to_receive = 0;




                if ($_SESSION['username'] == 'lonlon' || $_SESSION['username'] == 'rj' || $_SESSION['username'] == 'lorna_regala') {
                    echo "<td class='data'>";
                    echo '<a href="inc_deliveries.php?approve_id=' . $row['del_id'] . '"><button>' . 'Approve' . '</button></a>';
                    echo '<a  href="inc_deliveries.php?disapprove_id=' . $row['del_id'] . '"><button>' . 'Disapprove' . '</button></a>';
                    echo "</td>";
                }
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</div>
<div class="grid_10">
    <div class="box round first grid">
        <?php
        $ngayon = date('F d, Y');
        $start_year = '2012';
        $end_year = date('Y', strtotime('+1 year', strtotime($ngayon)));
        $year = date('Y');
        if (isset($_POST['submit_year'])) {
            $year = $_POST['year'];
        }
        echo "<h2>  Deliveries as of : <u><b><i>" . $ngayon . "</i></b></u></h2>";
        ?>
        <br>
        <center>
            <form method="post">
                Year:<select name="year">
                    <?php
                    echo'<option value="' . $year . '">' . $year . '</option>';
                    while ($start_year <= $end_year) {
                        echo '<option value="' . $start_year . '">' . $start_year . '</option>';
                        $start_year++;
                    }
                    ?>
                </select>
                <input type="submit" name="submit_year" value="Submit">
            </form>
        </center>
        <br>
        <table class="data display datatable" id="example">
            <?php
            echo "<thead>";
            echo "<th width='30px'>ID</th>";
            echo "<th>Suppliername</th>";
            echo "<th>Branch</th>";
            echo "<th>Incentive Type</th>";
            echo "<th>Scheme</th>";
            echo "<th>WP Grades</th>";
            echo "<th>Base Price</th>";
            echo "<th>WP Prices</th>";
            echo "<th>Incentive</th>";
            echo "<th>Quota (KG)</th>";
            echo "<th>Cov Inc.</th>";
            echo "<th>Tonnage Output</th>";
            echo "<th>% Performance</th>";
            echo "<th>Occurs Incurred</th>";
            echo "<th>Remarks</th>";
            echo "<th>Action</th>";
            echo "</thead>";

            if ($_SESSION['inc_criteria_status'] == 'met') {
                $query = "SELECT * FROM incentive_scheme where (current_deliveries/quota)>=1 and wp_grade like '%" . $_SESSION['inc_criteria_grade'] . "%' and confirm='1'";
            } else if ($_SESSION['inc_criteria_status'] == 'above 50') {
                $query = "SELECT * FROM incentive_scheme where (current_deliveries/quota)>=.5 and (current_deliveries/quota)< 1 and wp_grade like '%" . $_SESSION['inc_criteria_grade'] . "%' and confirm='1'";
            } else if ($_SESSION['inc_criteria_status'] == 'below 50') {
                $query = "SELECT * FROM incentive_scheme where (current_deliveries/quota)<.5and wp_grade like '%" . $_SESSION['inc_criteria_grade'] . "%' and confirm='1'";
            } else {
                $query = "SELECT * FROM incentive_scheme where wp_grade like '%" . $_SESSION['inc_criteria_grade'] . "%' and confirm='1' and scheme LIKE '%$year%'";
            }
            $result = mysql_query($query);
            while ($row = mysql_fetch_array($result)) {
                $range = $row['scheme'];
                $range_date_array = preg_split('/[ -.]/', $range);
                $query2 = "SELECT supplier_name from supplier_details where supplier_id='" . $row['sup_id'] . "'";
                $result2 = mysql_query($query2);
                $row2 = mysql_fetch_array($result2);
                $sql = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='" . $row['sup_id'] . "'");
                $rs = mysql_fetch_array($sql);
//                echo strtoupper($_SESSION['user_branch']) . '~' . strtoupper($rs['branch']) . '==========';
                if (strtoupper($_SESSION['user_branch']) == strtoupper($rs['branch']) || $_SESSION['username'] == 'rj' || $_SESSION['username'] == 'lorna_regala') {
                    echo "<tr>";
                    echo "<td class='data'>" . $row['sup_id'] . "</td>";
                    echo "<td class='data'>" . $row2['supplier_name'] . "</td>";
                    echo "<td class='data'>" . $rs['branch'] . "</td>";
                    echo "<td class='data'>" . ucfirst($row['type']) . "</td>";
                    echo "<td class='data'>" . $row['scheme'] . "</td>";
                    echo "<td class='data'>" . $row['wp_grade'] . "</td>";
                    $formatted_inc = number_format($row['incentive'], 2);
                    echo "<td class='data'>" . $row['base_price'] . "</td>";
                    echo "<td class='data'>$wp_prices" . $row['wp_prices'] . "</td>";
                    echo "<td class='data'>" . $formatted_inc . "</td>";
                    echo "<td class='data'>" . number_format($row['quota'], 1) . "</td>";
                    echo "<td class='data'>" . number_format($row['covered_incentive'], 1) . "</td>";
                    $incentive_to_receive = 0;
                    $date_explode = explode('-', $row['scheme']);
                    $from = $date_explode[0];
                    $to = $date_explode[1];
                    if ($row['wp_grade'] == 'all_grades') {
                        $sql_paper = mysql_query("SELECT sum(corrected_weight) as  corrected_weight, sum(paper_buying) as  paper_buying from paper_buying WHERE date_received>='$from' and  date_received<='$to' and supplier_id='" . $row['sup_id'] . "'") or die(mysql_error());
                    } else if ($row['wp_grade'] == 'all_without_lcwl') {
                        $sql_paper = mysql_query("SELECT sum(corrected_weight) as  corrected_weight, sum(paper_buying) as  paper_buying from paper_buying WHERE date_received>='$from' and  date_received<='$to' and wp_grade NOT LIKE 'LCWL%' and supplier_id='" . $row['sup_id'] . "'") or die(mysql_error());
                    } else {
                        $sql_paper = mysql_query("SELECT sum(corrected_weight) as  corrected_weight, sum(paper_buying) as  paper_buying from paper_buying WHERE date_received>='$from' and  date_received<='$to' and wp_grade LIKE '" . $row['wp_grade'] . "%' and supplier_id='" . $row['sup_id'] . "'") or die(mysql_error());
                        // echo "SELECT sum(corrected_weight) as  corrected_weight, sum(paper_buying) as  paper_buying from paper_buying WHERE date_received>='$from' and  date_received<='$to' and wp_grade LIKE '".$row['wp_grade']."%' and branch LIKE '%".$rs['branch']."%'<br>";
                    }
                    $row_paper = mysql_fetch_array($sql_paper);
                    echo "<td class='data'>" . $output = round(($row_paper['corrected_weight'] / 1000)) . "</td>";

                    $percent = round(($row_paper['corrected_weight'] / $row['quota']) * 100);
                    echo "<td class='data'>" . $percent . "%</td>";
                    echo "<td class='data'>" . number_format($row_paper['paper_buying']) . "</td>";
                    echo "<td class='data'>" . $row['remarks'] . "</td>";
                    echo "<td class='data'>";


//                if($row['remarks']=='') {
                    echo "
                    <form  action='reportIncentiveDeliveries.php' method='POST'>
                    <input type=hidden  name='sup_id' value='" . $row['sup_id'] . "'>
                     <input type=hidden  name='type' value='" . $row['type'] . "'>
                    <input type=hidden  name='wp_grade' value='" . $row['wp_grade'] . "'>
                    <input type=hidden  name='scheme' value='" . $row['scheme'] . "'>
                    <input type=hidden  name='quota' value='" . $row['quota'] . "'>
                    <input type=hidden  name='incentive' value='" . $row['incentive'] . "'>
                    <input type=hidden  name='supplier_name' value='" . $row2['supplier_name'] . "'>
                   
                    <input type='Submit' value='Generate Report'>
                   </form>";
                    echo "
                    <form action='new_incentiveRenew.php' method='POST'>
                    <input type=hidden  name='sup_id' value='" . $row['sup_id'] . "'>
                    <input type=hidden  name='type' value='" . $row['type'] . "'>
                    <input type=hidden  name='wp_grade' value='" . $row['wp_grade'] . "'>
                    <input type=hidden  name='scheme' value='" . $row['scheme'] . "'>
                    <input type=hidden  name='quota' value='" . $row['quota'] . "'>
                    <input type=hidden  name='incentive' value='" . $row['incentive'] . "'>
                        <input type=hidden  name='supplier_name' value='" . $row2['supplier_name'] . "'>
                    <input type='Submit' value='Renew Incentive'>
                   </form>";
//                }
                    if(empty($row['remarks'])) {
                        echo "<a href='deleteIncentive.php?del_id=" . $row['del_id'] . "'><button>Delete</button></a>";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </table>
        <a href=frm_addnewincsup.php><button>Add New Supplier</button></a>
        <a  href=viewIncentiveProcessing.php><button>Processing History</button></a>
    </div>
</div>
