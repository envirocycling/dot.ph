<?php
include("templates/template.php");
include('config.php');
?>
<style>
    h1{
        color:white;
    }
</style>
<div class="grid_7">
    <div class="box round first grid">
        <h2>IC Monitoring</h2>
        <div class="block ">
            <table class="data display datatable" id="example" border="1">
                <thead>
                <th>Branch</th>
                <th>Receiving</th>
                <th>Outgoing</th>
                <th>Paper Buying</th>
                </thead>
                <?php
                $sql = mysql_query("SELECT * FROM branches");
                while($rs=mysql_fetch_array($sql)){
                    echo "<tr>";
                    echo "<td>".$rs['branch_name']."</td>";
                    $sql_r = mysql_query("SELECT * FROM sup_deliveries WHERE branch_delivered='".$rs['branch_name']."' ORDER BY date_delivered DESC");
                    $rs_r = mysql_fetch_array($sql_r);
                    echo "<td>".$rs_r['date_delivered']."</td>";
                    $sql_o = mysql_query("SELECT * FROM outgoing WHERE branch='".$rs['branch_name']."' ORDER BY date DESC");
                    $rs_o = mysql_fetch_array($sql_o);
                    echo "<td>".$rs_o['date']."</td>";
                    $sql_p = mysql_query("SELECT * FROM paper_buying WHERE branch='".$rs['branch_name']."' ORDER BY date_received DESC");
                    $rs_p = mysql_fetch_array($sql_p);
                    echo "<td>".$rs_p['date_received']."</td>";
                    echo "</tr>";
                }

                ?>
            </table>

        </div>
    </div>
</div>
<div class="clear">
</div>
<div class="clear">
</div>

</body>
</html>
