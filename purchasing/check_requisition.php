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
        <h2>Check Requests </h2>
        <?php if($_SESSION['authority']=='signatory') {?>
        <form action="filter_check_req.php" method="POST">
            <select name='type' onchange='this.form.submit()'>

                    <?php

                    if($_SESSION['check_req_type']=='all_me') {
                        echo "<option value='all_me'>All My Pending</option>";
                    }else if($_SESSION['check_req_type']=='to_be_audited') {
                        echo "<option value='to_be_audited'>To be Audited By Me</option>";
                    }else if($_SESSION['check_req_type']=='to_be_approved') {
                        echo "<option value='to_be_approved'>To be Approved By Me</option>";
                    }else if($_SESSION['check_req_type']=='audited') {
                        echo "<option value='audited'>Already Audited By Me</option>";
                    }else if($_SESSION['check_req_type']=='approved') {
                        echo "<option value='approved'>Already Approved By Me</option>";
                    }
                    ?>

                <option value="all_me">All My Pending</option>
                <option value="to_be_audited">To be Audited By Me</option>
                <option value="to_be_approved">To be Approved By Me</option>
                <option value="audited">Already Audited By Me</option>
                <option value="approved">Already Approved By Me</option>
            </select>
        </form>
            <?php }else {?>
        <form action="admin_filter_check_req.php" method="POST">
            <select name='status' onchange='this.form.submit()'>

                    <?php echo "<option value='".$_SESSION['check_req_status']."'>".$_SESSION['check_req_status']."</option>"?>
                <option value="all">all</option>
                <option value="pending">pending</option>
                <option value="audited">audited</option>
                <option value="approved">approved</option>
                <option value="completed">completed</option>
            </select>
        </form>
            <?php }?>
        <table class="data display datatable" id="example">
            <a href="frm_check_req.php"> <button>Submit New</button></a><br>
            <?php
            $branch=$_SESSION['branch'];
            include("config.php");

            if($_SESSION['username']=='lonlon') {
                
                if($_SESSION['check_req_status']=='pending') {
                    $query="SELECT * FROM check_req where audited_signature='' and approved_signature=''";
                }else  if($_SESSION['check_req_status']=='audited') {
                    $query="SELECT * FROM check_req where audited_signature!='' and approved_signature=''";
                }else  if($_SESSION['check_req_status']=='approved') {
                    $query="SELECT * FROM check_req where audited_signature='' and approved_signature!=''";

                }else if($_SESSION['check_req_status']=='completed') {
                    $query="SELECT * FROM check_req where audited_signature!='' and approved_signature!=''";

                }else  if($_SESSION['check_req_status']=='all') {
                    $query="SELECT * FROM check_req ";
                }

            }else {
                if($_SESSION['authority']=='signatory') {
                    if($_SESSION['check_req_type']=='all_me') {
                        $query="SELECT * FROM check_req where (audited_by='".$_SESSION['name']."' and audited_signature='' ) or (approved_by='".$_SESSION['name']."' and approved_signature='') ";
                    }else if($_SESSION['check_req_type']=='to_be_audited') {
                        $query="SELECT * FROM check_req where (audited_by='".$_SESSION['name']."' and audited_signature='' ) ";
                    }else if($_SESSION['check_req_type']=='to_be_approved') {
                        $query="SELECT * FROM check_req where (approved_by='".$_SESSION['name']."' and approved_signature='' ) ";
                    }else if($_SESSION['check_req_type']=='approved') {
                        $query="SELECT * FROM check_req where (approved_by='".$_SESSION['name']."' and approved_signature!='' ) ";
                    }else if($_SESSION['check_req_type']=='audited') {
                        $query="SELECT * FROM check_req where (audited_by='".$_SESSION['name']."' and audited_signature!='' ) ";
                    }
                }else {
                    if($_SESSION['check_req_status']=='pending') {
                        $query="SELECT * FROM check_req where branch_submitted='".$_SESSION['branch']."' and audited_signature='' and approved_signature=''";
                    }else  if($_SESSION['check_req_status']=='audited') {
                        $query="SELECT * FROM check_req where branch_submitted='".$_SESSION['branch']."'  and audited_signature!='' and approved_signature=''";
                    }else  if($_SESSION['check_req_status']=='approved') {
                        $query="SELECT * FROM check_req where branch_submitted='".$_SESSION['branch']."'  and audited_signature='' and approved_signature!=''";

                    }else if($_SESSION['check_req_status']=='completed') {
                        $query="SELECT * FROM check_req where branch_submitted='".$_SESSION['branch']."'  and audited_signature!='' and approved_signature!=''";

                    }else  if($_SESSION['check_req_status']=='all') {
                        $query="SELECT * FROM check_req where branch_submitted='".$_SESSION['branch']."'";
                    }
                }
            }
            $result=mysql_query($query);
            echo "<thead>";
            echo "<th>CR #</th>";
            echo "<th>Date Sent</th>";
            echo "<th>Amount</th>";
            echo "<th>Payee</th>";
            echo "<th>Status</th>";
            echo "<th>Action</th>";
            echo "</thead>";
            while($row = mysql_fetch_array($result)) {
                echo "<tr>";
                echo "<td>".$row['log_id']."</td>";
                echo "<td>".$row['date_submitted']."</td>";
                echo "<td>".$row['amount']."</td>";
                echo "<td>".$row['payee']."</td>";
                if(trim($row['audited_signature'])!='' && trim($row['approved_signature'])!='') {
                    echo "<td>Audited by <u>".$row['audited_by']."</u> and Approved by <u>".$row['approved_by']."</u></td>";
                }else if(trim($row['audited_signature'])!='') {
                    echo "<td>Audited by <u>".$row['audited_by']."</u></td>";
                }else if(trim($row['approved_signature'])!='') {
                    echo "<td>Approved by <u>".$row['approved_by']."</u></td>";
                }else {
                    echo "<td>pending</td>";
                }
                echo "<td><a href='view_check_req.php?check_req_id=".$row['log_id']."'><button>View</button></a>
                    <a href='delete_check_req.php?check_req_id=".$row['log_id']."'><button>Delete</button></a>


</td>";
                echo "</tr>";
            }
            ?>


        </table>

    </div>
</div>


<div class="clear">
</div>