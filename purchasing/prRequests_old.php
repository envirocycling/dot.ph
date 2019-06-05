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
    #stamp{
        width:50px;
        height:40px;
    }
</style>

<div class="grid_10">
    <div class="box round first">
        <h2>My PR Requests </h2>
        <table class="data display datatable" id="example">

            <?php
            $branch = $_SESSION['branch'];
            include("config.php");
            $query = "SELECT * FROM requests WHERE branch='$branch' and (type!='office supplies' or type!='for hr') and (status !='cancelled' and status !='') order by request_id desc , status desc";
            $result = mysql_query($query);
            echo "<thead>";
            echo "<th class='data'>ID</th>";
            echo "<th class='data'>End Use</th>";
            echo "<th class='data'>Justification</th>";



            echo "<th class='data'>Date Sent</th>";


            echo "<th class='data'>Status</th>";
            echo "<th class='data'>Comments</th>";
            echo "<th class='data'>Action</th>";
            echo "<th class='data'>keywords</th>";
            echo "<th class='data'></th>";

            echo "</thead>";


            while ($row = mysql_fetch_array($result)) {
			mysql_query("Update requests Set notiapproved='1',notidisapproved='1',notipending='1' Where request_id='".$row['request_id']."'") or die(mysql_error());

                echo "<tr class='data'>";
                echo "<td class='data'>" . $row['request_id'] . "</td>";
                echo "<td class='data'>" . $row['end_use'] . "</td>";
                echo "<td class='data'>" . $row['justification'] . "</td>";
                echo "<td class='data'>" . $row['date'] . "</td>";
                echo "<td class='data'>" . $row['status'] . "</td>";


                $id = $row['request_id'] . "@yahoo.com";
                $query2 = "SELECT name,dt from comments where email='$id' order by dt desc limit 1";
                $result2 = mysql_query($query2);
                $row2 = mysql_fetch_array($result2);

                if ($row2['name'] != '') {
                    echo "<td>commented by <b>" . $row2['name'] . "</b> last <i><u><b>" . $row2['dt'] . "</b></u></i></td>";
                } else {
                    echo "<td><i>No Comments yet</i></td>";
                }

                echo'<td class="data"><a  href=printPR.php?request_id=' . $row["request_id"] . '><button>' . 'View' . '</button></a>';
                if ($row['status'] == 'disapproved' || $row['status'] == 'approved') {
                    echo'    <a href=cancel.php?request_id=' . $row["request_id"] . ' disabled><button disabled>' . 'Cancel' . '</button></a>';
                } else {
                    echo'    <a href=cancel.php?request_id=' . $row["request_id"] . ' ><button >' . 'Cancel' . '</button></a>';
                }
                if ($row['status'] == 'disapproved' || $row['status'] == 'pending' || $row['request_id'] == '1175') {
                    echo'<a href=editPR.php?request_id=' . $row["request_id"] . '><button>' . 'Edit' . '</button></a>';
                }

                echo "<form action='changePRStatus.php' method='POST'>";
                echo "<input type='hidden' name='request_id' value ='" . $row['request_id'] . "'>";
                echo "<input type='hidden' value='served' name='status'>";
                if ($row['status'] != 'disapproved') {
                    echo "<input type='submit' name='Submit' value='served'>";
                }
                echo "</form>";
                echo "</td>";
                echo "<td>";
                echo "<span id='items'>";
                echo $row['desc1'] . $row['desc2'] . $row['desc3'] . $row['desc4'] . $row['desc5'] . $row['desc6'] . $row['desc7'] . $row['desc8'] . $row['desc9'] . $row['desc10'] . $row['desc11'] . $row['desc12'];
                echo "</span>";
                echo "</td>";


                echo "<td>";
                if ($row['stamp'] == 'approved' && $row['status'] != 'approved') {
                    echo "<img src='img/icon_ok_for_canvass.png' id='stamp'>";
                } else if ($row['stamp'] == 'denied' && $row['status'] != 'disapproved') {
                    echo "<img src='img/denied.png' id='stamp'>";
                } else if ($row['stamp'] == 'notify') {
                    echo "<img src='img/notify.png' id='stamp'>";
                }
                echo "</td>";


                echo "</tr>";
            }
            ?>
        </table>

    </div>
</div>


<div class="clear">
</div>