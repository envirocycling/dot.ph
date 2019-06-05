<?php
include('config.php');
include('templates/template.php');
$_SESSION['show_affected_suppliers']='NO';
$_SESSION['pricing_against_competitors_branch']='';
$_SESSION['pricing_against_start_date']='';
$_SESSION['pricing_against_end_date']='';
?>
<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
    function date1(str){
        new JsDatePick({
            useMode:2,
            target:str,
            dateFormat:"%Y/%m/%d"

        });
    };
</script>
</head>
<div class="grid_3">
    <div class="box round first grid">
        <h2>Price Against Competitors</h2>
        <form action="dashboard_pricing_competitors_report_primer.php" method="POST">
            <br>
            <h6>Please select your range of dates</h6>
            Start Period: <input type='text'  id='inputField' name='start_date' value="<?php echo date('Y/m/d');?>" onfocus='date1(this.id);' readonly size="8"><br>
            End Period:<input type='text'  id='inputField2' name='end_date' value="<?php echo date('Y/m/d');?>" onfocus='date1(this.id);' readonly size="8"><br>
            <input type="submit" value="Generate Report">
        </form>
    </div>
</div>
<div class="grid_7">
    <div class="box round first grid">
        <h2>Pending Requests to Verify/Approve</h2>
        <table class="data display datatable" id="example">
            <?php
            include("config.php");
            $query40=" select * from pricing_against_competitors where( verified_by='".$_SESSION['username']."' and verified_status='') or (approved_by='".$_SESSION['username']."' and approved_status='')" ;
            $result40=mysql_query($query40);
            echo "<thead>";
            echo "<th>Log ID</th>";
            echo "<th>Requested By</th>";
            echo "<th>Competitor</th>";
            echo "<th>Source</th>";
            echo "<th>WP Grade</th>";
            echo "<th>STD. Price</th>";
            echo "<th>MAX. Price</th>";
            echo "<th>Date Effective</th>";
            echo "<th>To be Verified By</th>";
            echo "<th>Verified Status</th>";
            echo "<th>To be Approved By</th>";
            echo "<th>Approved Status</th>";
            echo "<th>Action</th>";
            echo "</thead>";
            while($row = mysql_fetch_array($result40)) {
                echo "<tr>";
                echo "<td>".$row['log_id']."</td>";
                $log_id=$row['log_id'];
                echo "<td>".$row['updated_by']."</td>";
                echo "<td>".$row['company']."</td>";
                echo "<td>".$row['source']."</td>";
                echo "<td>".$row['wp_grade']."</td>";
                echo "<td>".$row['price']."</td>";
                echo "<td>".$row['max_price']."</td>";
                echo "<td>".$row['date']."</td>";
                echo "<td>".$row['verified_by']."</td>";
                if($row['verified_status']=='verified') {
                    echo "<td><img src='images/check.png' height='20px'></td>";
                }else {
                    echo "<td><img src='images/pending.png' height='20px'></td>";
                }
                echo "<td>".$row['approved_by']."</td>";
                if($row['approved_status']=='approved') {
                    echo "<td><img src='images/check.png' height='20px'></td>";
                }else {
                    echo "<td><img src='images/pending.png' height='20px'></td>";
                }
                echo "<td>";
                if($row['verified_by']==$_SESSION['username'] && $row['verified_status']=='') {
                    $type='verify_only';
                    echo "<a href='verify_price_update.php?log_id=$log_id&&type=$type'>Verify</a>  |  ";
                    $type='disapprove';
                    echo "<a href='verify_price_update.php?log_id=$log_id&&type=$type'>Disapprove</a>";
                }else if ($row['approved_by']==$_SESSION['username'] && $row['approved_status']=='' && $row['verified_status']=='verified') {
                    $type='approve_only';
                    echo "<a href='verify_price_update.php?log_id=$log_id&&type=$type'>Approve</a>  |  ";
                    $type='disapprove';
                    echo "<a href='verify_price_update.php?log_id=$log_id&&type=$type'>Disapprove</a>";
                }

                echo "</td>";
                echo "</tr>";
            }


            ?>
        </table>
    </div>
</div>
</body>
</html>
<div class="clear">
</div>
<div class="clear">
</div>
