<?php include("templates/template.php"); ?>
<style>
    table td{
        font-size: 12px;
        border-bottom:solid;
        border-width:1px;
        padding:5px;
    }

</style>
<?php include("config.php"); ?>
<div class="grid_10">
    <div class="box round first">
        <h2>LLR Requests </h2>
        <table class="data display datatable" id="example">

            <?php


            $branch=$_SESSION['branch'];

            include("config.php");
            $query="SELECT * FROM requests where status !='cancelled'   and (type ='for approval' or type='for_sample' or type='heavy_vehicles') and status ='approved'  order by status desc";
            $result=mysql_query($query);

            echo "<thead>";
            echo "<th>ID</th>";
            echo "<th>End Use</th>";
            echo "<th>Justification</th>";
            echo "<th>Branch</th>";


            echo "<th>Date Sent</th>";
            echo "<th>Date Needed</th>";
            echo "<th>Comments</th>";


            echo "<th>Action</th>";
            echo "</thead>";


            while($row = mysql_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" .$row['request_id']. "</td>";
                echo "<td>" .$row['end_use']. "</td>";
                echo "<td>" .$row['justification']. "</td>";
                echo "<td>" .$row['branch']. "</td>";


                echo "<td>" .$row['date']. "</td>";
                echo "<td>" .$row['date_needed']. "</td>";
                $id=$row['request_id']."@yahoo.com";
                $query2="SELECT name,dt from comments where email='$id' order by dt desc limit 1";
                $result2=mysql_query($query2);
                $row2 = mysql_fetch_array($result2);

                if($row2['name']!='') {
                    echo "<td>commented by <b>".$row2['name']."</b> last <i><u><b>".$row2['dt']."</b></u></i></td>";

                }else {
                    echo "<td><i>No Comments yet</i></td>";
                }


                echo'<td class="data"><a href=llrPrintPr.php?request_id=' . $row["request_id"] . '><button>' . 'View' . '</button></a>';
                if($row['status']=='disapproved' || $row['status']=='pending') {
                    echo'<a href=editPR.php?request_id=' . $row["request_id"] . '><button>' . 'Edit' . '</button></a>';
                }
                echo '</td>';
                echo '</td>';
                echo "</tr>";

            }





            ?>


        </table>

    </div>
</div>

<div class="clear">
</div>
<div class="clear">
</div>