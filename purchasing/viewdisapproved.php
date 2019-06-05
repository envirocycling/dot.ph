<?php
session_start();

if (!$_SESSION["username"]=='bryan') {
    header('Location: index.php');
}
?>
<?php include("templates/template.php"); ?>
<?php include("config.php"); ?>
<body>
    <div id="wbody">
        <div id="container">
            <?php
            include('navigation2.php');
            ?>

        </div>

        <div id='tablearea'>
            <?php


            $branch=$_SESSION['branch'];

            include("config.php");
            $query="SELECT * FROM requests where ='disapproved' and status !='cancelled' and type!='office supplies'  order by date desc";
            $result=mysql_query($query);

            echo "<table border=1 id='employees'>";
            echo "<th>Justification</th>";
            echo "<th>Branch</th>";
            echo "<th>Canvasser</th>";
            echo "<th>Verified By</th>";

            echo "<th>Date Sent</th>";
            echo "<th>Date Needed</th>";
            echo "<th>End User</th>";
            echo "<th>Type</th>";
            echo "<th>Status</th>";
            echo "<th>Remarks</th>";
            echo "<th>Action</th>";



            while($row = mysql_fetch_array($result)) {
                if($row['request_id']%2=='1') {
                    echo "<tr id='odd'>";
                }else {
                    echo "<tr id='even'>";
                }
                echo "<td>" .$row['justification']. "</td>";
                echo "<td>" .$row['branch']. "</td>";
                echo "<td>" .$row['canvasser']. "</td>";
                echo "<td>" .$row['verified']. "</td>";

                echo "<td>" .$row['date']. "</td>";
                echo "<td>" .$row['date_needed']. "</td>";
                echo "<td>" .$row['end_use']. "</td>";
                echo "<td>" .$row['type']. "</td>";
                echo "<td>" .$row['status']. "</td>";
                echo "<td>" .$row['remarks']. "</td>";

                echo'<td><a href=cancel.php?request_id=' . $row["request_id"] . '><button>' . 'Cancel' . '</button></a><br>';
                echo "<form action='changePRStatus.php' method='POST'>";
                echo "<input type='hidden' name='request_id' value ='".$row['request_id']."'>";
                echo "Change Status:<select name='status' value=''>";

                echo "<option value='printed'>printed</option>";
                echo "<option value='approved'>approved</option>";
                echo "<option value='disapproved'>disapproved</option>";
                echo "<option value='for approval'>for approval</option>";

                echo "</select>";

                echo "<input type='submit' name='Submit' value='Change Status'>";

                echo "</form>";
                echo "<form action='changePRType.php' method='POST'>";
                echo "<input type='hidden' name='request_id' value ='".$row['request_id']."'>";
                echo "Change type:<select name='type' value=''>";

                echo "<option value='for approval'>For Ms Lorna </option>";
                echo "<option value='for jess'>For Sir Jess</option>";
                echo "<option value='for hr'>For HRD</option>";
                echo "<option value='office supplies'>Office Supplies</option>";


                echo "</select>";

                echo "<input type='submit' name='Submit' value='Change Type'>";

                echo "</form>";
                echo'<a href=printPR.php?request_id=' . $row["request_id"] . '><button>' . 'Print' . '</button></a><br>';
                 echo'<a href=editPR.php?request_id=' . $row["request_id"] . '><button>' . 'Edit' . '</button></a><br>';
                
                echo"</td>";
                echo '</td>';
                echo '</td>';
                echo "</tr>";

            }

            echo "</table>";

            ?>
        </div>

    </div>
</body>

</html>		