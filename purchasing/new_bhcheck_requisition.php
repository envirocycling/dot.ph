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
        <h2><?php
            if (isset($_POST['submit'])) {
                echo ucfirst($_POST['status']);
            }
            ?> Check Requests </h2>
        <form action="" method="POST">
            <h5>Search: <select name="status" required="">
                    <option value=''></option>
                    <option value=''>Pending</option>
                    <option value='audited'>Audited</option>
                    <option value='approved'>Approved</option>
                    <option value='processed'>Processed</option>
                    <option value='disapproved'>Disapproved</option>
                    <option value='cancelled'>Cancelled</option>
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
            echo "<th>Status</th>";
            echo "<th>Action</th>";
            echo "</thead>";
            if (isset($_POST['submit'])) {
                if ($_POST['status'] == 'processed') {
                    $sql = mysql_query("SELECT * FROM check_req WHERE audited_by='" . $_SESSION['name'] . "' and status='" . $_POST['status'] . "' and deposited_by!=''");
                } else {
                    $sql = mysql_query("SELECT * FROM check_req WHERE audited_by='" . $_SESSION['name'] . "' and status='" . $_POST['status'] . "' and deposited_by=''");
                }
            } else {
                $sql = mysql_query("SELECT * FROM check_req WHERE audited_by='" . $_SESSION['name'] . "' and status=''");
            }
			if($_GET['id'] == '1'){
			
			$noti =  mysql_query("SELECT * FROM check_req where approved_by ='" . $_SESSION['name'] . "' and approved_signature=''") or die (mysql_error());
				while($noti_row = mysql_fetch_array($noti)){
				mysql_query("Update check_req Set noti='1' Where log_id='".$noti_row['log_id']."'") or die(mysql_error());
				
				}
				}else{
				$noti = mysql_query("SELECT * FROM check_req where audited_by ='" . $_SESSION['name'] . "' and audited_signature=''");
				while($noti_row = mysql_fetch_array($noti)){
				mysql_query("Update check_req Set noti='1' Where log_id='".$noti_row['log_id']."'") or die(mysql_error());
				
				}
				}
			
				
            while ($row = mysql_fetch_array($sql)) {
                echo "<tr>";
                echo "<td>" . $row['log_id'] . "</td>";
                echo "<td>" . $row['date_submitted'] . "</td>";
                echo "<td>" . $row['amount'] . "</td>";
                echo "<td>" . $row['payee'] . "</td>";
                echo "<td>" . $row['accnt_no'] . "</td>";
                if ($row['status'] == '') {
                    echo "<td>Pending</td>";
                } else if ($row['status'] == 'disapproved') {
                    echo "<td>" . ucfirst($row['status']) . " by " . ucfirst($row['disapproved_by']) . "</td>";
                } else if ($row['status'] != '' && $row['deposited_by'] != '') {
                    echo "<td>Processed</td>";
                } else {
                    echo "<td>" . ucfirst($row['status']) . "</td>";
                }
                echo "<td>";

                echo "<a href='new_view_check_req.php?check_req_id=" . $row['log_id'] . "'><button>View</button></a>";

                if ($row['status'] == '') {
                    echo " <a href='new_audit_check_req.php?id=" . $row['log_id'] . "&type=auditor'><button onclick=\"return confirm('Are you sure you approve this request? once you click [OK] you cant undo your action.')\">Approve</button></a>";
                    echo " <a href='new_audit_discheck_req.php?disapprove_id=" . $row['log_id'] . "'><button onclick=\"return confirm('Are you sure you disapprove this request? once you click [OK] you cant undo your action.')\">Disapprove</button></a>";
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