<?php include("templates/template.php"); ?>
<?php
if ($_SESSION['username']=='lorna_regala') {
    header('Location: llrRequests.php');
}

if ($_SESSION['username']=='bryan') {
    header('Location: admin.php');
}

if ($_SESSION['username']=='jess_apostol') {
    header('Location: jessRequests.php');
}
if ($_SESSION['username']=='efi_hrd') {
    header('Location: hrRequests.php');
}

$branch=$_SESSION['branch'];
?>
<?php
if($_SESSION['position']=='BH') {?>

<div class="grid_10">
    <div class="box round first">
        <h2>Pending Requests </h2>
        <table class="data display datatable" id="example">

                <?php


                $branch=$_SESSION['branch'];

                include("config.php");
                $query="SELECT * FROM pr_to_sign where status='pending'  and verified='". $_SESSION['name']."' order by status desc";
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
            echo "<script>
		sNotify.addToQueue('You currently have  ".$dbCount."  <b><i><u>check requisition</u></i></b>&nbsp; to approve.');
				</script>";

        }

    }
    ?>



    <?php
}else {
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
    $result = mysql_query("SELECT count(request_id) FROM requests where status ='pending' and branch = '$branch'");

    while($row = mysql_fetch_array($result)) {
        $dbCount=$row['count(request_id)'];
        if ($dbCount>0) {
            echo "<script>
		sNotify.addToQueue('You currently have  ".$dbCount."  <b><i><u>pending</u></i></b> PR Requests.');
				</script>";

        }

    }

    $result = mysql_query("SELECT count(request_id) FROM requests where status ='approved' and branch = '$branch'");

    while($row = mysql_fetch_array($result)) {
        $dbCount=$row['count(request_id)'];
        if ($dbCount>0) {
            echo "<script>
		sNotify.addToQueue('You currently have  ".$dbCount."  <b><i><u>approved</u></i></b> PR Requests.');
				</script>";

        }

    }

    $result = mysql_query("SELECT count(request_id) FROM requests where status ='disapproved' and branch = '$branch'");

    while($row = mysql_fetch_array($result)) {
        $dbCount=$row['count(request_id)'];
        if ($dbCount>0) {
            echo "<script>
		sNotify.addToQueue('You currently have  ".$dbCount."  <b><i><u>disapproved</u></i></b> PR Requests.');
				</script>";

        }

    }

    $result = mysql_query("SELECT count(request_id) FROM pr_to_sign where status ='disapproved' and branch = '$branch'");

    while($row = mysql_fetch_array($result)) {
        $dbCount=$row['count(request_id)'];
        if ($dbCount>0) {
            echo "<script>
		sNotify.addToQueue('You currently have  ".$dbCount."  <b><i><u>disapproved</u></i></b>&nbsp; PR Requests by your BH.');
				</script>";

        }

    }

    $result = mysql_query("SELECT count(log_id) FROM check_req where audited_by ='".$_SESSION['name']."' and audited_signature=''");
    while($row = mysql_fetch_array($result)) {
        $dbCount=$row['count(log_id)'];
        if ($dbCount>0) {
            echo "<script>
		sNotify.addToQueue('You currently have  ".$dbCount."  <b><i><u>check requisition</u></i></b>&nbsp; to audit.');
				</script>";

        }

    }



    ?>
    <?php }?>
<div class="clear">
</div>
<div class="clear">
</div>