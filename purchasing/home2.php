<?php include("templates/template.php"); ?>
<?php
$username = $_SESSION['username'];
if ($username == 'lorna_regala') {
    header('Location:llrRequests.php');
    echo "<script>";
    echo "window.location='llrRequests.php';";
    echo "</script>";
} else if (trim($username) == 'lonlon') {
    header('Location:admin.php');
    echo "<script>";
    echo "window.location='admin.php';";
    echo "</script>";
} else if ($username == 'jess_apostol') {
    header('Location:jessRequests.php');
    echo "<script>";
    echo "window.location='jessRequests.php';";
    echo "</script>";
} else if ($username == 'efi_hrd' || $username == 'dsd') {
    header('Location:hrRequests.php');
    echo "<script>";
    echo "window.location='hrRequests.php';";
    echo "</script>";
} else if ($username == 'canvasser') {
    header('Location:canvassing_home.php');
    echo "<script>";
    echo "window.location='canvassing_home.php';";
    echo "</script>";
} else if ($username == 'rex') {
    header('Location:mechanic.php');
    echo "<script>";
    echo "window.location='mechanic.php';";
    echo "</script>";
}else if ($username == 'restie') {
    header('Location:electric.php');
    echo "<script>";
    echo "window.location='electric.php';";
    echo "</script>";
} else if ($username == 'acctg') {
    header('Location:cash_requisition.php');
    echo "<script>";
    echo "window.location='check_requisition.php';";
    echo "</script>";
} else if ($username == 'rgm') {
    header('Location:adminOfficeSupplies.php');
    echo "<script>";
    echo "window.location='adminOfficeSupplies.php';";
    echo "</script>";
} else if ($username == 'jake' || $username == 'JAKE') {
    header('Location:new_approve_check_requisition.php');
    echo "<script>";
    echo "window.location='new_approve_check_requisition.php';";
    echo "</script>";
}
?>

<?php
$branch = $_SESSION['branch'];
?>
<?php if ($_SESSION['position'] == 'BH') { ?>

    <div class="grid_10">
        <div class="box round first">
            <h2>Pending Requests </h2>
            <table class="data display datatable" id="example">

                <?php
                $branch = $_SESSION['branch'];
                include("config.php");
                $query = "SELECT * FROM requests where mecha_signature!='' and status='' and verified='" . $_SESSION['name'] . "' order by status desc";
                $result = mysql_query($query);
                echo "<thead>";
                echo "<th>ID</th>";
                echo "<th>End Use</th>";
                echo "<th>Justification</th>";
                echo "<th>Branch</th>";
                echo "<th>Date Sent</th>";
                echo "<th>Date Needed</th>";
                echo "<th>Action</th>";
                echo "</thead>";
                while ($row = mysql_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['request_id'] . "</td>";
                    echo "<td>" . $row['end_use'] . "</td>";
                    echo "<td>" . $row['justification'] . "</td>";
                    echo "<td>" . $row['branch'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['date_needed'] . "</td>";
                    echo'<td class="data"><a  href=bhTOSignPrintPR.php?request_id=' . $row["request_id"] . '><button>' . 'View' . '</button><a href=bhToSignCancel.php?request_id=' . $row["request_id"] . '><button>' . 'Cancel' . '</button></a></a>';
                    echo '</td>';
                    echo '</td>';
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>
    <?php
    include ('config.php');
    $result = mysql_query("SELECT count(log_id) FROM check_req where audited_by ='" . $_SESSION['name'] . "' and audited_signature='' and noti='0'");
    while ($row = mysql_fetch_array($result)) {
        $dbCount = $row['count(log_id)'];
        if ($dbCount > 0) {
            echo "<script>
		sNotify.addToQueue('You currently have  " . $dbCount . "  <a href=new_bhcheck_requisition.php><b><i><u>check requisition</u></i></b><a/>&nbsp; to audit.');
				</script>";
        }
    }
    $result = mysql_query("SELECT count(log_id) FROM check_req where approved_by ='" . $_SESSION['name'] . "' and approved_signature='' and noti='0' ");
    while ($row = mysql_fetch_array($result)) {
        $dbCount = $row['count(log_id)'];
        if ($dbCount > 0) {
            echo "<script>sNotify.addToQueue('You currently have  " . $dbCount . "  <a href=new_bhcheck_requisition.php?id=1><b><i><u>check requisition</u></i></b></a>&nbsp; to approve.');</script>";
        }
    }
    ?>
    <?php
} else {
    ?>

    <div class="grid_10">
        <div class="box round first">
            <h2>Branches PR Frequency</h2>
            <div id="bar-chart">
                <?php
                echo '<iframe src="dist/graphs/overall_wp_grade.php" height="360" width="100%"></iframe>';
                ?>
            </div>
        </div>
    </div>
    <?php
    include ('config.php');
    $result = mysql_query("SELECT count(request_id) FROM requests where status ='pending' and branch = '$branch' And notipending='0'");
    while ($row = mysql_fetch_array($result)) {
        $dbCount = $row['count(request_id)'];
        if ($dbCount > 0 ) {

			?>
           <script> sNotify.addToQueue("You currently have   <?php echo $dbCount ;?>   <a href='prRequests.php'><u><i><b>pending</u></i></b> </a> PR Requests.");</script>;
        <?php 
		}
		
    }
    $result = mysql_query("SELECT count(request_id) FROM requests where status ='approved' and branch = '$branch' And notiapproved='0'");
    while ($row = mysql_fetch_array($result)) {
        $dbCount = $row['count(request_id)'];
        if ($dbCount > 0 ) {
			?>
           <script> sNotify.addToQueue("You currently have    <?php echo $dbCount ;?> <a href='prRequests.php'><u><i><b>approved</u></i></b></a> PR Requests.");</script>
        <?php
        }
		
    }
    $result = mysql_query("SELECT count(request_id) FROM requests where status ='disapproved' and branch = '$branch' And notidisapproved='0'");
			
    while ($row = mysql_fetch_array($result)) {
        $dbCount = $row['count(request_id)'];
        if ($dbCount > 0) {
			?>
           <script> sNotify.addToQueue("You currently have   <?php echo $dbCount ;?>  <a href='prRequests.php'> <b><i><u>disapproved</u></i></b></a> </a>PR Requests.");</script>
           <?php
       
	  }
    }
    $result = mysql_query("SELECT count(request_id) FROM pr_to_sign where status ='disapproved' and branch = '$branch' and noti='0'");
		
    while ($row = mysql_fetch_array($result)) {
        $dbCount = $row['count(request_id)'];
        if ($dbCount > 0) {
			
			?>
            <script> sNotify.addToQueue("You currently have   <?php echo $dbCount;?>  <a href='forBHApproval.php'> <b><i><u>disapproved</u></i></b></a>&nbsp; PR Requests by your BH.");</script>
            <?php
			
		}
    }
    $result = mysql_query("SELECT count(log_id) FROM check_req where branch_submitted='" . $_SESSION['branch'] . "' and status='audited' and deposited_by='' and noti='0' ");
			
    while ($row = mysql_fetch_array($result)) {
        $dbCount = $row['count(log_id)'];
        if ($dbCount > 0) {
			
			?>
        <script>sNotify.addToQueue("You currently have  <?php echo $dbCount ;?>  <a href='new_check_requisition.php'> <b><i><u>check requisition</u></i></b></a>&nbsp; to audit.");</script><?php
        }
		
    }
    ?>
<?php } ?>
<div class="clear">
</div>
<div class="clear">
</div>