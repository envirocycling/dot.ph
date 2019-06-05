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
        <h2>HR Requests </h2>
        <form action="" method="POST">
            <h5>Search: <select name="status" required="">
            <option value='' disabled="disabled" selected="selected">Please Select</option>
                    <option value='pending'>Pending</option>
                    <option value='served'>Served</option>
                    <option value='delivered'>Delivered</option>
                    <option value='approved'>Approved</option>
                    <option value='disapproved'>Disapproved</option>
                    <option value='cancelled'>Cancelled</option>
                </select>
                <input type="submit" name="submit" value="Submit"></h5>
        </form>
        <table class="data display datatable" id="example">


            <?php

            $branch=$_SESSION['branch'];
            $sql_approver = mysql_query("SELECT * from users WHERE user_id='" . $_SESSION['username'] . "'");
            $row_approver = mysql_fetch_array($sql_approver);
            include("config.php");
//            $query="SELECT * FROM requests where status !='cancelled' and type ='for hr' and status!='approved by HR' order by status desc";
             if (isset($_POST['submit'])) {
                $sql = mysql_query("SELECT * FROM requests WHERE status LIKE '%" . $_POST['status'] . "%'  and (type = 'for hr' or approved='".$row_approver['name']."')  order by request_id desc , status desc");
            } else { $sql = mysql_query("SELECT * FROM requests WHERE status LIKE '%pending%' and (type ='for hr' or approved='".$row_approver['name']."')  order by request_id desc , status desc");}


            echo "<thead>";
            echo "<th>ID</th>";
            echo "<th>Branch</th>";
            echo "<th>Canvasser</th>";
            echo "<th>Verified By</th>";

            echo "<th>Date Sent</th>";
            echo "<th>Date Needed</th>";
            echo "<th>End User</th>";
            echo "<th>Comments</th>";
            echo "<th>Status</th>";

            echo "<th>Action</th>";
            echo "<th>keywords</th>";
            echo "</thead>";

            while($row = mysql_fetch_array($sql)) {
                echo "<tr>";
                echo "<td>" .$row['request_id']. "</td>";
                echo "<td>" .$row['branch']. "</td>";
                echo "<td>" .$row['canvasser']. "</td>";
                echo "<td>" .$row['verified']. "</td>";

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
                echo'<td><a href=cancel.php?request_id=' . $row["request_id"] . '><button>' . 'Cancel' . '</button></a><br>';
                echo'<a href=hrPrintPR.php?request_id=' . $row["request_id"] . '><button>' . 'View PR' . '</button></a><br>';
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


            $result = mysql_query("SELECT count(request_id) FROM requests where type ='for hr' and status != approved and status !='cancelled' and  status!='approved by HR' and noti='0'");
			
			if(@$_GET['id'] == '1'){
			$noti = mysql_query("SELECT * FROM requests where type ='for hr' and status != approved and status !='cancelled' and  status!='approved by HR'");
			while($noti_row = mysql_fetch_array($noti)){
				
				mysql_query("Update requests Set noti='1' Where request_id='".$noti_row['request_id']."'") or die(mysql_error());

				}
			}else if(@$_GET['id'] == '2'){
				$noti = mysql_query("SELECT * FROM check_req where audited_by ='".$_SESSION['name']."' and audited_signature=''");
			while($noti_row = mysql_fetch_array($noti)){
				
				mysql_query("Update check_req Set noti='1' Where log_id='".$noti_row['log_id']."'") or die(mysql_error());

				}
			}else if(@$_GET['id'] == '3' ){
				$noti = mysql_query("SELECT * FROM check_req where approved_by ='".$_SESSION['name']."' and approved_signature=''");
			while($noti_row = mysql_fetch_array($noti)){
				
				mysql_query("Update check_req Set noti='1' Where log_id='".$noti_row['log_id']."'") or die(mysql_error());

				}
				
				}

            while($row = mysql_fetch_array($result)) {
                $dbCount=$row['count(request_id)'];
				if($dbCount > 0){
                if(@$_GET['id'] != '1'){
				echo "<script>
		sNotify.addToQueue('You currently have   ".$dbCount."  <a href=hrRequests.php?id=1><b><i><u>pending</u></i></b></a> PR Requests.');
				</script>";
				}
            }
			}




            ?>

        </table>
        <?php
        
        include ('config.php');
        $result = mysql_query("SELECT count(log_id) FROM check_req where audited_by ='".$_SESSION['name']."' and audited_signature=''");
        while($row = mysql_fetch_array($result)) {
            $dbCount=$row['count(log_id)'];
            if ($dbCount>0) {
				  if(@$_GET['id'] != '2'){
                echo "<script>
		sNotify.addToQueue('You currently have  ".$dbCount." <a href=hrRequests.php?id=2> <b><i><u>check requisition</u></i></b></a>&nbsp; to audit.');
				</script>";

            }
			}

        }



        $result = mysql_query("SELECT count(log_id) FROM check_req where approved_by ='".$_SESSION['name']."' and approved_signature=''");
        while($row = mysql_fetch_array($result)) {
            $dbCount=$row['count(log_id)'];
            if ($dbCount>0) {
				if(@$_GET['id'] != '3'){
                echo "<script>
		sNotify.addToQueue('You currently have  ".$dbCount."  <b><i><u>check requisition</u></i></b>&nbsp; to approve.');
				</script>";

            }
			}

        }

        ?>
    </div>
</div>


<div class="clear">
</div>