<?php include("templates/template.php"); ?>
<?php include("config.php"); ?>

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
<div class="grid_10">
    <div class="box round first">
        <h2>Unclassified PR Requests </h2>
        <table class="data display datatable" id="example">
            <?php


            $branch=$_SESSION['branch'];

            include("config.php");
            $query="SELECT * FROM requests where type='unclassified' and status !='cancelled'   order by date desc";
            $result=mysql_query($query);

            echo "<thead>";
            echo "<th class='data'>ID</th>";
            echo "<th class='data'>End Use</th>";
            echo "<th class='data'>Justification</th>";
            echo "<th class='data'>Branch</th>";


            echo "<th class='data'>Date Sent</th>";
            echo "<th class='data'>Date Needed</th>";

            echo "<th class='data'>Type</th>";
            echo "<th class='data'>Status</th>";
            echo "<th class='data'>Comments</th>";
            echo "<th class='data'>Action</th>";
            echo "<th class='data'>keywords</th>";
            echo "</thead>";


            while($row = mysql_fetch_array($result)) {
                if($row['request_id']%2=='1') {
                    echo "<tr class='data'>";
                }else {
                    echo "<tr class='data'>";
                }
                echo "<td class='data'>" .$row['request_id']. "</td>";
                echo "<td class='data'>" .$row['end_use']. "</td>";
                echo "<td class='data'>" .$row['justification']. "</td>";
                echo "<td class='data'>" .$row['branch']. "</td>";

                echo "<td class='data'>" .$row['date']. "</td>";
                echo "<td class='data'>" .$row['date_needed']. "</td>";

                echo "<td class='data'>" .$row['type']. "</td>";
                echo "<td class='data'>" .$row['status']. "</td>";
                $id=$row['request_id']."@yahoo.com";
                $query2="SELECT name,dt from comments where email='$id' order by dt desc limit 1";
                $result2=mysql_query($query2);
                $row2 = mysql_fetch_array($result2);

                if($row2['name']!='') {
                    echo "<td>commented by <b>".$row2['name']."</b> last <i><u><b>".$row2['dt']."</b></u></i></td>";

                }else {
                    echo "<td><i>No Comments yet</i></td>";
                }


                echo'<td class="data">';
                echo "<form action='changePRStatus.php' method='POST'>";
                echo "<input type='hidden' name='request_id' value ='".$row['request_id']."'>";
                echo "Change Status:<select name='status' value=''>";

                echo "<option value='printed'>printed</option>";
                echo "<option value='approved'>approved</option>";
                echo "<option value='disapproved'>disapproved</option>";
                echo "<option value='for approval'>for approval</option>";
                echo "<option value='cancelled'>cancelled</option>";
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