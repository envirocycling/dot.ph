<?php include ('templates/template.php'); ?>
<style>
    #items{
        color:gray;
        font-size:8px;
    }
</style>
<div class="grid_10">
    <div class="box round first">
        <h2>My Disapproved Requests </h2>
        <table class="data display datatable" id="example">
            <?php
            $branch=$_SESSION['branch'];
            include("config.php");
            $query="SELECT * FROM requests where type='heavy_vehicles' and status!='' order by status desc";
            $result=mysql_query($query);
            echo "<thead>";
            echo "<th>ID</th>";
            echo "<th>End Use</th>";
            echo "<th>Justification</th>";
            echo "<th>Branch</th>";
            echo "<th>Date Sent</th>";
            echo "<th>Date Needed</th>";
            echo "<th>Status</th>";
            echo "<th>Action</th>";
            echo "<th>keywords</th>";
            echo "</thead>";
            while($row = mysql_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" .$row['request_id']. "</td>";
                echo "<td>" .$row['end_use']. "</td>";
                echo "<td>" .$row['justification']. "</td>";
                echo "<td>" .$row['branch']. "</td>";
                echo "<td>" .$row['date']. "</td>";
                echo "<td>" .$row['date_needed']. "</td>";
                echo "<td>" .$row['status']. "</td>";
                echo'<td class="data"><a  href=PrintPR.php?request_id=' . $row["request_id"] . '><button>' . 'View' . '</button>';
//                echo '<a href=cancel.php?request_id=' . $row["request_id"] . '><button>' . 'Cancel' . '</button></a></a>';
                echo '</td>';
                echo '</td>';
                echo "<td>";
                echo "<span id='items'>";
                echo $row['desc1'].$row['desc2'].$row['desc3'].$row['desc4'].$row['desc5'].$row['desc6'].$row['desc7'].$row['desc8'].$row['desc9'].$row['desc10'].$row['desc11'].$row['desc12'];
                echo "</span>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</div>
<div class="clear">
</div>