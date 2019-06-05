<?php
include("config.php");
include("templates/template.php");
?>
<style>
    table td{
        font-size: 12px;
        border-bottom:solid;
        border-width:1px;
        padding:5px;
    }
    #items{
        color:gray;
        font-size:8px;
    }
</style>
<?php include("config.php"); ?>
<div class="grid_11">
    <div class="box round first">
        <h2>Check Requests </h2>

        <form action="" method="POST">
            <h5>Search: <select name="status" required="">
                    <option value=''></option>
                    <option value='approved'>Approved</option>
                    <option value='deposited'>Deposited</option>
                </select>
                <input type="submit" name="submit" value="Submit"></h5>
        </form>

        <table class="data display datatable" id="example">
            <?php
            echo "<thead>";
            echo "<th>CR #</th>";
            echo "<th>Date Sent</th>";
            echo "<th>Amount</th>";
            echo "<th>Account Name</th>";
            echo "<th>Account No.</th>";
            echo "<th>Branch</th>";
            echo "<th>Status</th>";
            echo "<th>Action</th>";
            echo "</thead>";
            if (isset($_POST['submit'])) {
                if ($_POST['status'] == 'approved') {
                    $sql = mysql_query("SELECT * FROM check_req WHERE status='approved' and deposited_by=''");
                } else {
                    $sql = mysql_query("SELECT * FROM check_req WHERE status='approved' and deposited_by='" . $_SESSION['name'] . "'");
                }
            } else {
                $sql = mysql_query("SELECT * FROM check_req WHERE status='approved' and deposited_by=''");
            }
            while ($row = mysql_fetch_array($sql)) {
                echo "<tr>";
                echo "<td>" . $row['log_id'] . "</td>";
                echo "<td>" . $row['date_submitted'] . "</td>";
                echo "<td>" . $row['amount'] . "</td>";
                echo "<td>" . $row['payee'] . "</td>";
                echo "<td>" . $row['accnt_no'] . "</td>";
                echo "<td>" . $row['branch_submitted'] . "</td>";
                if ($row['deposited_by']) {
                    echo "<td>Processed</td>";
                } else {
                    echo "<td>" . ucfirst($row['status']) . "</td>";
                }
                echo "<td>";

                echo "<a href='new_view_check_req.php?check_req_id=" . $row['log_id'] . "'><button>View</button></a>";

                if ($row['deposited_by'] == '') {
                    echo " <a href='new_mark_deposited.php?id=" . $row['log_id'] . "&type=check'><button onclick=\"return confirm('Are you sure you want to mark as processed this request? once you click [OK] you cant undo your action.')\">Mark as Processed</button></a>";
                }
                echo "</td>";
                echo "</tr>";
            }
            ?>


        </table>

    </div>
</div>


<div class="clear">
</div>