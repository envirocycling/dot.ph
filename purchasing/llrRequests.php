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
    #stamp{
        width:50px;
        height:40px;
    }
</style>
<?php include("config.php"); ?>
<div class="grid_10">
    <div class="box round first">
        <h2>LLR Requests </h2>
        <table class="data display datatable" id="example">
            <?php
            $branch = $_SESSION['branch'];
            include("config.php");
            $query = "SELECT * FROM requests where (type ='for approval' or type='for_sample' or type='heavy_vehicles' or type='electric_equipment' or approved='LLR') and (status='pending') order by status desc";
            $result = mysql_query($query);
            echo "<thead>";
            echo "<th>ID</th>";
            echo "<th>End Use</th>";
            echo "<th>Justification</th>";
            echo "<th>Branch</th>";
            echo "<th>Date Sent</th>";
            echo "<th>Date Needed</th>";
            echo "<th>Comments</th>";

            echo "<th>Action</th>";
            echo "<th class='data'>keywords</th>";
            echo "<th></th>";
            echo "</thead>";
            while ($row = mysql_fetch_array($result)) {

                    $sql_office_supplies = mysql_query("SELECT  * FROM requests where request_id='".$row['request_id']."' and date >= '2016/08/01' and type LIKE '%office supplies%' ") or die(mysql_error());
                    if(mysql_num_rows($sql_office_supplies) > 0){
                        $row = mysql_fetch_array($sql_office_supplies);
                        
                        echo "<tr>";
                echo "<td>" . $row['request_id'] . "</td>";
                echo "<td>" . $row['end_use'] . "</td>";
                echo "<td>" . $row['justification'] . "</td>";
                echo "<td>" . $row['branch'] . "</td>";


                echo "<td>" . $row['date'] . "</td>";
                echo "<td>" . $row['date_needed'] . "</td>";
                $id = $row['request_id'] . "@yahoo.com";
                $query2 = "SELECT name,dt from comments where email='$id' order by dt desc limit 1";
                $result2 = mysql_query($query2);
                $row2 = mysql_fetch_array($result2);

                if ($row2['name'] != '') {
                    echo "<td>commented by <b>" . $row2['name'] . "</b> last <i><u><b>" . $row2['dt'] . "</b></u></i></td>";
                } else {
                    echo "<td><i>No Comments yet</i></td>";
                }


                echo'<td class="data"><a  href=llrPrintPr.php?request_id=' . $row["request_id"] . '><button>' . 'View' . '</button></a><a href=cancel.php?request_id=' . $row["request_id"] . '><button>' . 'Cancel' . '</button></a>';

                echo '</td>';
                echo '</td>';
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
                        
                }else{
                echo "<tr>";
                echo "<td>" . $row['request_id'] . "</td>";
                echo "<td>" . $row['end_use'] . "</td>";
                echo "<td>" . $row['justification'] . "</td>";
                echo "<td>" . $row['branch'] . "</td>";


                echo "<td>" . $row['date'] . "</td>";
                echo "<td>" . $row['date_needed'] . "</td>";
                $id = $row['request_id'] . "@yahoo.com";
                $query2 = "SELECT name,dt from comments where email='$id' order by dt desc limit 1";
                $result2 = mysql_query($query2);
                $row2 = mysql_fetch_array($result2);

                if ($row2['name'] != '') {
                    echo "<td>commented by <b>" . $row2['name'] . "</b> last <i><u><b>" . $row2['dt'] . "</b></u></i></td>";
                } else {
                    echo "<td><i>No Comments yet</i></td>";
                }


                echo'<td class="data"><a  href=llrPrintPr.php?request_id=' . $row["request_id"] . '><button>' . 'View' . '</button></a><a href=cancel.php?request_id=' . $row["request_id"] . '><button>' . 'Cancel' . '</button></a>';

                echo '</td>';
                echo '</td>';
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
            }
			if(@$_GET['id'] == '1'){
				$noti =mysql_query("SELECT * FROM requests where type ='for approval' and status ='approved by Jess'  ");
				
		   }else if(@$_GET['id'] == '2'){
					$noti =  mysql_query("SELECT * FROM requests where type ='for approval' and status ='approved by HR'  ");
					}
			else {
				 $noti = mysql_query("SELECT * FROM requests where type ='for approval' and status !='approved' and status !='disapproved' and status !='cancelled' and status !='served'");
				}
			while($noti_row = mysql_fetch_array($noti)){
				mysql_query("Update requests Set noti='1' Where request_id='".$noti_row['request_id']."'") or die(mysql_error());

				}		
            $result = mysql_query("SELECT count(request_id) FROM requests where type ='for approval' and status !='approved' and status !='disapproved' and status !='cancelled' and status !='served'");
            while ($row = mysql_fetch_array($result)) {
                $dbCount = $row['count(request_id)'];
                if ($dbCount > 0) {
                    echo "<script> sNotify.addToQueue('You currently have   " . $dbCount . "  <a href=llrRequests.php?id='1'><b><i><u>pending</u></i></b></a> PR Requests.');</script>";
                }
            }

            $result = mysql_query("SELECT count(request_id) FROM requests where type ='for approval' and status ='approved by Jess' and noti='0' ");
            while ($row = mysql_fetch_array($result)) {
                $dbCount = $row['count(request_id)'];
                if ($dbCount > 0) {
                    echo "<script> sNotify.addToQueue('There are   " . $dbCount . "  PRs approved by <a href=llrApproved.php?id=1><b><i><u> Mr. Jess</u></i></a>');</script>";
                }
            }

            $result = mysql_query("SELECT count(request_id) FROM requests where type ='for approval' and status ='approved by HR' and noti='0'  ");

            while ($row = mysql_fetch_array($result)) {
                $dbCount = $row['count(request_id)'];
                if ($dbCount > 0) {

                    echo "<script>
		sNotify.addToQueue('There are   " . $dbCount . "  PRs approved by <a href=llrApproved.php?id=2><b><i><u> HRD</u></i></a>');
				</script>";
                }
            }

            $result = mysql_query("SELECT count(log_id) FROM check_req where approved_by ='LLR' and approved_signature ='' and noti='0' ");

            while ($row = mysql_fetch_array($result)) {
                $dbCount = $row['count(log_id)'];
                if ($dbCount > 0) {

                    echo "<script>
		sNotify.addToQueue('There are " . $dbCount . "  Check Req for <u><b><a href=new_llrcheck_requisition.php>approval</a></b></u></i>');
				</script>";
                }
            }
            ?>


        </table>

    </div>
</div>

<div class="clear">
</div>
<div class="clear">
</div>