<?php 
include("templates/template.php");
include("config.php");
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
<div class="grid_10">
    <div class="box round first">
        <h2>Pending Request </h2>

        <table class="data display datatable" id="example">
        
        <?php

        $branch=$_SESSION['branch'];

        $sql = mysql_query("SELECT * FROM requests where (verified='ALY' or approved='ALY') and (status='' or status='for approval' or status='pending');");

        echo "<thead>";
        echo "<th>ID</th>";
        echo "<th>Branch</th>";
        echo "<th>Verified By</th>";
        echo "<th>Date Sent</th>";
        echo "<th>Date Needed</th>";
        echo "<th>End User</th>";
        echo "<th>Status</th>";
        echo "<th>Action</th>";
        echo "</thead>";

        while($row = mysql_fetch_array($sql)) {

            echo "<tr>";
            echo "<td>" .$row['request_id']. "</td>";
            echo "<td>" .$row['branch']. "</td>";
            echo "<td>" .$row['canvasser']. "</td>";
            echo "<td>" .$row['date']. "</td>";
            echo "<td>" .$row['date_needed']. "</td>";
            echo "<td>" .$row['end_use']. "</td>";
            echo "<td>" .$row['status']. "</td>";

            echo '<td><a href=cancel.php?request_id=' . $row["request_id"] . '><button>' . 'Cancel' . '</button></a><br>';
            echo '<a href=hrToSignPrintPR.php?request_id=' . $row["request_id"] . '><button>' . 'View PR' . '</button></a><br>';
            echo"</td>";
            echo "</tr>";
        }

        $result = mysql_query("SELECT count(request_id) FROM requests where verified='ALY' and status='' and noti='0'");
			
        while($row = mysql_fetch_array($result)) {
            $dbCount=$row['count(request_id)'];

				    if($dbCount > 0) {
				        echo "<script>sNotify.addToQueue('You currently have   ".$dbCount."  <a href=hrPending.php?id=1><b><i><u>pending</u></i></b></a> PR Requests.');</script>";
            }
			  }
        ?>
        </table>
    </div>
</div>


<div class="clear">
</div>