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
        <h2>Pending Fund Requests </h2>
        <table class="data display datatable" id="example">
            <?php
            if ($_SESSION['username'] == 'AFR' || $_SESSION['username'] == 'afr') {
                ?>
                <h5><a href="fund_requisition2.php">Pending</a> | <a href="approved_fund_req.php">Approved</a></h5>
                <?php
            }
            ?>
            <?php
            include("config.php");
            if (isset($_GET['approve_req_id'])) {
                mysql_query("UPDATE fund_req SET for_approved_signature='AFR',status='approved' WHERE log_id='" . $_GET['approve_req_id'] . "'");
            }
            $branch = $_SESSION['branch'];

            $query = "SELECT * FROM fund_req WHERE audited_signature!='' and for_approved_signature=''";
            $result = mysql_query($query);
            echo "<thead>";
            echo "<th>CR #</th>";
            echo "<th>Date Sent</th>";
            echo "<th>Amount</th>";
            echo "<th>Payee</th>";
            echo "<th>Status</th>";
            echo "<th>Action</th>";
            echo "</thead>";
            while ($row = mysql_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row['log_id'] . "</td>";
                echo "<td>" . $row['date_submitted'] . "</td>";
                if ($row['amount'] == '') {
                    echo "<td>0</td>";
                } else {
                    echo "<td>Php " . number_format($row['amount'], 2) . "</td>";
                }
                echo "<td>" . $row['payee'] . "</td>";
                if (trim($row['audited_signature']) != '' && trim($row['approved_signature']) != '') {
                    echo "<td>Audited by <u>" . $row['audited_by'] . "</u> and Approved by <u>" . $row['approved_by'] . "</u></td>";
                } else if (trim($row['audited_signature']) != '') {
                    echo "<td>Audited by <u>" . $row['audited_by'] . "</u></td>";
                } else if (trim($row['approved_signature']) != '') {
                    echo "<td>Approved by <u>" . $row['approved_by'] . "</u></td>";
                } else {
                    echo "<td>pending</td>";
                }
                echo "<td><a href='view_fund_req.php?check_req_id=" . $row['log_id'] . "'><button>View</button></a>";
                if ($_SESSION['username'] == 'AFR' || $_SESSION['username'] == 'afr') {
                    echo "<a href='fund_requisition2.php?approve_req_id=" . $row['log_id'] . "'><button>Approve</button></a></td>";
                }
                echo "</tr>";
            }
            ?>

        </table>

    </div>
</div>

<div class="clear">
</div>