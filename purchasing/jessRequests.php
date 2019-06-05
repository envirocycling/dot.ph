<style>
    #logout{
        width:30px;

    }
</style>


<?php
session_start();

if (!$_SESSION["username"]=='jess_apostol') {
    header('Location: index.php');
}
?>
<?php include("templates/template.php"); ?>
<?php include("config.php"); ?>
<body>
    <div id="wbody">
        <div id="container">


        </div>


        <?php
        echo '<a href=logout.php?><img src="exit.png" id="logout"></a><br>';

        $branch=$_SESSION['branch'];

        include("config.php");
        $query="SELECT * FROM requests where status !='cancelled'   and type ='for jess' order by status desc";
        $result=mysql_query($query);

        echo "<table border=1 id='employees'>";

        echo "<th>Branch</th>";
        echo "<th>Canvasser</th>";
        echo "<th>Verified By</th>";
        echo "<th>Approved By</th>";
        echo "<th>Date Sent</th>";
        echo "<th>Date Needed</th>";
        echo "<th>End User</th>";

        echo "<th>Remarks</th>";
        echo "<th>Action</th>";



        while($row = mysql_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" .$row['branch']. "</td>";
            echo "<td>" .$row['canvasser']. "</td>";
            echo "<td>" .$row['verified']. "</td>";
            echo "<td>" .$row['approved']. "</td>";
            echo "<td>" .$row['date']. "</td>";
            echo "<td>" .$row['date_needed']. "</td>";
            echo "<td>" .$row['end_use']. "</td>";

            echo "<td>" .$row['remarks']. "</td>";

            echo'<td><a href=cancel.php?request_id=' . $row["request_id"] . '><button>' . 'Cancel' . '</button></a><br>';


            echo'<a href=jessPrintPr.php?request_id=' . $row["request_id"] . '><button>' . 'View PR' . '</button></a><br>';

            echo"</td>";
            echo '</td>';
            echo '</td>';
            echo "</tr>";

        }

        echo "</table>";
        $result = mysql_query("SELECT count(request_id) FROM requests where type ='for jess' and status !='cancelled' and status !='approved' ");

        while($row = mysql_fetch_array($result)) {
            $dbCount=$row['count(request_id)'];
            echo "<script>
		sNotify.addToQueue('You currently have   ".$dbCount."  PRs to be  <b><i><u> approved</u></i>');
				</script>";



        }
        ?>


