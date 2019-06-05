<?php 
include("templates/template.php");
$branch=$_SESSION['branch'];
?>

<div class="grid_10">
    <div class="box round first">
        <h2>Pending Requests</h2>
        <table class="data display datatable" id="example">

            <?php
            $branch=$_SESSION['branch'];
            include("config.php");
            $query="SELECT * FROM requests WHERE type='heavy_vehicles' and mecha_signature='' and status='for mechanic' order by status desc";
            $result=mysql_query($query);
            echo "<thead>";
            echo "<th>ID</th>";
            echo "<th>End Use</th>";
            echo "<th>Justification</th>";
            echo "<th>Branch</th>";
            echo "<th>Date Sent</th>";
            echo "<th>Date Needed</th>";
            echo "<th>Action</th>";
            echo "</thead>";
            while($row = mysql_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" .$row['request_id']. "</td>";
                echo "<td>" .$row['end_use']. "</td>";
                echo "<td>" .$row['justification']. "</td>";
                echo "<td>" .$row['branch']. "</td>";
                echo "<td>" .$row['date']. "</td>";
                echo "<td>" .$row['date_needed']. "</td>";
                // echo'<td class="data"><a  href=mechaTOSignPrintPR.php?request_id=' . $row["request_id"] . '><button>' . 'View' . '</button><a href=mechaToSignCancel.php?request_id=' . $row["request_id"] . '><button>' . 'Cancel' . '</button></a></a>';
                echo'<td class="data"><a  href=mechaTOSignPrintPR.php?request_id=' . $row["request_id"] . '><button>' . 'View' . '</button>';
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
$result = mysql_query("SELECT count(log_id) FROM check_req where audited_by ='".$_SESSION['name']."' and audited_signature=''");
while($row = mysql_fetch_array($result)) {
    $dbCount=$row['count(log_id)'];
    if ($dbCount>0) {
        echo "<script>
		sNotify.addToQueue('You currently have  ".$dbCount."  <b><i><u>check requisition</u></i></b>&nbsp; to audit.');
				</script>";
    }
}
$result = mysql_query("SELECT count(log_id) FROM check_req where approved_by ='".$_SESSION['name']."' and approved_signature=''");
while($row = mysql_fetch_array($result)) {
    $dbCount=$row['count(log_id)'];
    if ($dbCount>0) {
        echo "<script>sNotify.addToQueue('You currently have  ".$dbCount."  <b><i><u>check requisition</u></i></b>&nbsp; to approve.');</script>";
    }
}
?>

<div class="clear">
</div>
<div class="clear">
</div>