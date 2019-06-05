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
        <h2>Office Supply Requests </h2>
        <table class="data display datatable" id="example">


            <?php


            $branch=$_SESSION['branch'];

            include("config.php");
            $query="SELECT * FROM requests where branch='".$_SESSION['branch']."' and  type='for hr' and verified_signature != '' order by status desc";
            $result=mysql_query($query);

            echo "<thead>";
            echo "<th>ID</th>";
            echo "<th>Branch</th>";
            echo "<th>Canvasser</th>";
            echo "<th>Verified By</th>";
            echo "<th>Approved By</th>";
            echo "<th>Date Sent</th>";
            echo "<th>Date Needed</th>";
            echo "<th>End User</th>";
            echo "<th>Comments</th>";
            echo "<th>Status</th>";
            echo "<th>Action</th>";
            echo "<th>keywords</th>";
            echo "</thead>";

            while($row = mysql_fetch_array($result)) {
                if($row['request_id']%2=='1') {
                    echo "<tr id='odd'>";
                }else {
                    echo "<tr id='even'>";
                }
                echo "<td class='data'>" .$row['request_id']. "</td>";
                echo "<td>" .$row['branch']. "</td>";
                echo "<td>" .$row['canvasser']. "</td>";
                echo "<td>" .$row['verified']. "</td>";
                echo "<td>" .$row['approved']. "</td>";
                echo "<td>" .$row['date']. "</td>";
                echo "<td>" .$row['date_needed']. "</td>";
                echo "<td>" .$row['end_use']. "</td>";

                $id=$row['request_id']."@yahoo.com";
                $query2="SELECT name,dt from comments where email='$id' order by dt desc limit 1";
                $result2=mysql_query($query2);
                $row2 = mysql_fetch_array($result2);

                if($row2['name']!='') {
                    echo "<td>commented by <b>".$row2['name']."</b> last <i><u><b>".$row2['dt']."</b></u></i></td>";

                }else {
                    echo "<td><i>No Comments yet</i></td>";
                }


                echo "<td>" .$row['status']. "</td>";

                echo'<td>';
                echo'<a href=printPR.php?request_id=' . $row["request_id"] . '><button>' . 'Print PR' . '</button></a><br>';

                echo"</td>";
                echo '</td>';
                echo '</td>';
                echo "<td>";
                echo "<span id='items'>";

                echo $row['qty1'].$row['um1'].":".$row['desc1'].$row['qty2'].$row['um2'].":".$row['desc2'].$row['qty3'].$row['um3'].":".$row['desc3'].$row['qty4'].$row['um4'].":".$row['desc4'].$row['qty5'].$row['um5'].":".$row['desc5'].$row['qty6'].$row['um6'].":".$row['desc6'].$row['qty7'].$row['um7'].":".$row['desc7'].$row['qty8'].$row['um8'].":".$row['desc8'].$row['qty9'].$row['um9'].":".$row['desc9'].$row['qty10'].$row['um10'].":".$row['desc10'].$row['qty11'].$row['um11'].":".$row['desc11'].$row['qty12'].$row['um12'].":".$row['desc12'];
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