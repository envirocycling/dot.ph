<?php include("templates/template.php"); ?>
<?php
if (!$_SESSION["username"]=='bryan') {
    header('Location: index.php');
}
?>


<body>
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
    $result = mysql_query("SELECT count(request_id) FROM requests where status ='pending' ");

    while($row = mysql_fetch_array($result)) {
        $dbCount=$row['count(request_id)'];
        echo "<script>
		sNotify.addToQueue('There are currently   ".$dbCount."  <b><i><u>pending</u></i></b> PR Requests.');
				</script>";



    }

    $result = mysql_query("SELECT count(request_id) FROM requests where status ='approved' ");

    while($row = mysql_fetch_array($result)) {
        $dbCount=$row['count(request_id)'];
        echo "<script>
		sNotify.addToQueue('There are currently  ".$dbCount."  <b><i><u>approved</u></i></b> PR Requests.');
				</script>";



    }

    $result = mysql_query("SELECT count(request_id) FROM requests where status ='disapproved' ");

    while($row = mysql_fetch_array($result)) {
        $dbCount=$row['count(request_id)'];
        echo "<script>
		sNotify.addToQueue('There are currently  ".$dbCount."  <b><i><u>disapproved</u></i></b> PR Requests.');
				</script>";



    }

    ?>
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
    <div class="clear">
    </div>
    <div class="clear">
    </div>