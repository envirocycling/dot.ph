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
        <h2>My PR Requests </h2>
        <table class="data display datatable" id="example">

            <?php
            $branch=$_SESSION['branch'];
            include("config.php");
			$up = mysql_query("Select * from pr_to_sign  Where  branch='$branch' and status='disapproved'") or die(mysql_error());
			while($rows = mysql_fetch_array($up)){
				mysql_query("Update pr_to_sign Set noti='1' Where request_id='".$rows['request_id']."'") or die(mysql_error());
				}
			
            $query="SELECT * FROM requests WHERE mecha_signature!='' and branch='$branch' and status='' order by request_id desc , status desc";
            $result=mysql_query($query);
            echo "<thead>";
            echo "<th class='data'>ID</th>";
            echo "<th class='data'>End Use</th>";
            echo "<th class='data'>Justification</th>";



            echo "<th class='data'>Date Sent</th>";


            echo "<th class='data'>Status</th>";

            echo "<th class='data'>Action</th>";
            echo "<th>keywords</th>";
            echo "</thead>";


            while($row = mysql_fetch_array($result)) {
				

                echo "<tr class='data'>";
                echo "<td class='data'>" .$row['request_id']. "</td>";
                echo "<td class='data'>" .$row['end_use']. "</td>";
                echo "<td class='data'>" .$row['justification']. "</td>";
                echo "<td class='data'>" .$row['date']. "</td>";
                echo "<td class='data'>" .$row['status']. "</td>";





                echo'<td class="data"><a  href=bhTOSignPrintPR.php?request_id=' . $row["request_id"] . '><button>' . 'View' . '</button></a><a href=bhToSignCancel.php?request_id=' . $row["request_id"] . '><button>' . 'Cancel' . '</button></a>';
                if($row['status']=='disapproved' || $row['status']=='pending') {
                    echo'<a href=bhToSignEdit.php?request_id=' . $row["request_id"] . '><button>' . 'Edit' . '</button></a>';
                }

                echo "<form action='changePRStatus.php' method='POST'>";
                echo "<input type='hidden' name='request_id' value ='".$row['request_id']."'>";


                echo "</form>";
                echo "</td>";

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