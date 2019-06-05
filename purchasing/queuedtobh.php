<?php include("templates/template.php"); ?>
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
        <h2>For BH's Approval</h2>
        <table class="data display datatable" id="example">



            <?php


            $branch=$_SESSION['branch'];

            include("config.php");
            $query="SELECT * FROM pr_to_sign where status !='cancelled' and status !='disapproved' ";
            $result=mysql_query($query);


            echo "<thead>";
            echo "<th>ID</th>";
            echo "<th>End Use</th>";
            echo "<th>Branch</th>";

            echo "<th>Date Sent</th>";
            echo "<th>Date Needed</th>";
            echo "<th>Status</th>";
            echo "<th>Action</th>";
            echo "<th class='data'>keywords</th>";
            echo "</thead>";


            while($row = mysql_fetch_array($result)) {
                if($row['request_id']%2=='1') {
                    echo "<tr id='odd'>";
                }else {
                    echo "<tr id='even'>";
                }
                echo "<td>" .$row['request_id']. "</td>";
                echo "<td>" .$row['end_use']. "</td>";
                echo "<td>" .$row['branch']. "</td>";

                echo "<td>" .$row['date']. "</td>";
                echo "<td>" .$row['date_needed']. "</td>";
                echo "<td>" .$row['status']. "</td>";

                echo'<td><a href=cancel.php?request_id=' . $row["request_id"] . '><button>' . 'Cancel' . '</button></a><br>';

                echo "<form action='changePRStatus.php' method='POST'>";
                echo "<input type='hidden' name='request_id' value ='".$row['request_id']."'>";
                echo "Change Status:<select name='status' value=''>";

                echo "<option value='printed'>printed</option>";
                echo "<option value='approved'>approved</option>";
                echo "<option value='disapproved'>disapproved</option>";
                echo "<option value='for approval'>for approval</option>";
                echo "</select>";

                echo "<input type='submit' name='Submit' value='Update'>";

                echo "</form>";
                echo'<a href=bhTOSignPrintPR.php?request_id=' . $row["request_id"] . '><button>' . 'Print PR' . '</button></a><br>';

                echo"</td>";
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