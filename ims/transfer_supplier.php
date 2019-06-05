<?php
session_start();
include('config.php');
if (isset ($_POST['submit'])) {
    $sup_id = $_POST['sup_id'];
    $old_branch = $_POST['old_branch'];
    $que = $_POST['branch'];
    $details = preg_split("/[_]/", $que);
    $branch_trans = $details[0];
    $branch_head = $details[1];
    $bh_who_trans = $_SESSION['initial'];
    $date = date("Y/m/d");
    mysql_query("INSERT into sup_transfer (supplier_id, old_branch, branch_trans, bh_who_trans, bh_to_verified, date_transfer)
        VALUES
        ('$sup_id', '$old_branch', '$branch_trans', '$bh_who_trans', '$branch_head', '$date')");
    echo "<script>
        alert('Transfer Successfully... Please Contact the BH of the branch to Confirm the Transfering');
        window.close();
        </script>";

}
$id=$_GET['sup_id'];
$sql = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='$id'");
$rs=mysql_fetch_array($sql);
?>
<style>
    body{
        background-color: #CCE6FF;
    }
    #id{
        background-color: transparent;
        text-align: center;
        font-style: 15px;
        border-style: hidden;
        border-bottom: solid;
        border-width: 2px;
        color: blue;
    }
    #view_history{
        position: absolute;
        margin-top: -45px;
        margin-left: 500px;

    }
</style>

<div class="grid_10">
    <div class="box round first fullpage">
        <h2>Transfer <?php echo $rs['supplier_name'];?> to other Branch</h2>
        <div class="block ">
            <form action="transfer_supplier.php" method="POST">
                <table class="form">
                    <tr>
                        <td>
                            <label>
                                <font size="5">Branch:</font></label>
                        </td>
                        <td>
                            <input type="text" name="old_branch" class="mini" value="<?php echo $rs['branch'];?>" readonly/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                <font size="5">Transfer to:</font></label>
                        </td>
                        <td>
                            <input type="hidden" name="sup_id" value="<?php echo $id; ?>">
                            <select name="branch" required>
                                <?php
                                $sql = mysql_query("SELECT * FROM branches");
                                echo '<option value="">---</option>';
                                while ($rs=mysql_fetch_array($sql)) {
                                    echo '<option value="'.$rs['branch_name'].'_'.$rs['branch_head'].'">'.$rs['branch_name'].'</option>';
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Transfer">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<div class="clear">
</div>
<div class="clear">
</div>

