<?php
include("templates/template.php");
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = mysql_query("SELECT * FROM sup_transfer WHERE id='$id'");
    $rs = mysql_fetch_array($sql);
    $supplier_id = $rs['supplier_id'];
    $branch_trans = $rs['branch_trans'];
    $bh_to_verified = $rs['bh_to_verified'];
    mysql_query("UPDATE supplier_details SET branch='$branch_trans', bh_in_charge='$bh_to_verified',branch_update='' WHERE supplier_id='$supplier_id'");
    mysql_query("UPDATE sup_transfer SET confirm='1' WHERE id='$id'");
    echo '<script>';
    echo 'alert("Successfully Approved.");';
    echo 'location.replace="transfer_suppliers.php";';
    echo '</script>';
}
if(isset ($_GET['del_id'])) {
    $id = $_GET['del_id'];
    mysql_query("DELETE FROM sup_transfer WHERE id='$id'");
    echo '<script>';
    echo 'alert("Successfully Disapproved.");';
    echo 'location.replace="transfer_suppliers.php";';
    echo '</script>';
}
?>


<script>
    function openWindow(str){
        var x = screen.width/2 - 700/2;
        var y = screen.height/2 - 450/2;
        window.open("editSupplier.php?sup_id="+str,'mywindow','width=1000,height=650');
    }
</script>

<div class="grid_10">
    <div class="box round first grid">
        <?php
        $ngayon=date('F d, Y');
        echo "<h2> Transfer of Suppliers as of : <u><b><i>".$ngayon."</i></b></u></h2>";
        ?>
        <table class="data display datatable" id="example">
            <?php
            echo "<thead>";
            echo '<tr class="data">';

            echo "<th class='data'> Supplier ID</th>";
            echo "<th class='data'>Supplier Name</th>";
            echo "<th class='data'>Classification</th>";
            echo "<th class='data'>Branch</th>";
            echo "<th class='data'>Transfer to</th>";
            echo "<th class='data'>BH In-Charge</th>";
            echo "<th class='data'>Owner</th>";
            echo "<th class='data'>Contact</th>";
            echo "<th class='data'>Address</th>";
            echo "<th class='data'>Action</th>";
            echo "</tr>";

            echo "</thead>";
            include("config.php");

            $bh_to_verified = $_SESSION['initial'];
            if($_SESSION['user_branch'] =='Cavite'){
                $sql = mysql_query("SELECT * FROM sup_transfer WHERE confirm='0' and (branch_trans LIKE '%".$_SESSION['user_branch']."%' or old_branch  LIKE '%".$_SESSION['user_branch']."%' or branch_trans='Calamba' or old_branch='Calamba')");
            
            }else{
            /*if ($_SESSION['username'] == 'lonlon' || $_SESSION['username']=='lorna_regala') {
                $sql = mysql_query("SELECT * FROM sup_transfer WHERE confirm='0'");
            } else {*/
                $sql = mysql_query("SELECT * FROM sup_transfer WHERE confirm='0' and (branch_trans LIKE '%".$_SESSION['user_branch']."%' or old_branch  LIKE '%".$_SESSION['user_branch']."%')");
            //}
            }
            while($rs = mysql_fetch_array($sql)) {
                $query= mysql_query("SELECT * FROM supplier_details where supplier_id='".$rs['supplier_id']."'");
                $row = mysql_fetch_array($query);

                echo "<tr class='data'>";
                echo "<td class='data'>".$rs['supplier_id']."</td>";
                echo "<td class='data'>".$row['supplier_name']."</td>";
                echo "<td class='data'>".$row['style']."</td>";
                echo "<td class='data'>".$row['branch']."</td>";
                echo "<td class='data'>".$rs['branch_trans']."</td>";
                echo "<td class='data'>".$row['bh_in_charge']."</td>";
                echo "<td class='data'>".$row['owner']."</td>";
                echo "<td class='data'>".$row['owner_contact']."</td>";
                if ($row['street']=='' && $row['municipality']=='' && $row['province']=='') {
                    echo "<td class='data'>-</td>";
                } else {
                    echo "<td class='data'>".$row['street'].",".$row['municipality'].",".$row['province']."</td>";
                }
                echo "<td class='data'>";
                $ses_branch = strtoupper($_SESSION['user_branch']);
                $row_branch = strtoupper($rs['old_branch']);
                
                 if($row_branch == $ses_branch){
                    echo 'Pending to Branch';
                }else{
                echo "<a href='transfer_suppliers.php?id=".$rs['id']."'><button>Approve</button></a>";
                ?>
                <a href="transfer_suppliers.php?del_id=<?php echo $rs['id']; ?>" onclick="return confirm('Are you sure you want to disapprove transfer?')"><button>Disapprove</button></a>
                <?php }?>
                </td>
                <?php
                echo "</tr>";
            }


            echo "</table>";

            ?>







        </table>

    </div>
</div>
