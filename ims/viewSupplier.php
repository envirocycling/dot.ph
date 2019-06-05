<?php
session_start();
include 'config.php';
if(!isset ($_SESSION['username'])) {
    header("Location:index.php");
}
$sup_id=$_GET['sup_id'];

//$sql = mysql_query("SELECT * ");

?>
<style>
    #profile{
        padding: 5px;
        background-color: black;
    }
    table{
        font-weight: bold;
    }
    #viewinfo{
        background-color: #CCE6FF;
    }
    body{
        background-color: #CCE6FF;
    }
    hr.style-five {
        border: 0;
        height: 0; /* Firefox... */
        box-shadow: 0 0 10px 1px black;
    }
    hr.style-five:after {  /* Not really supposed to work, but does */
                           content: "\00a0";  /* Prevent margin collapse */
    }
</style>
<div id="viewinfo" align="center">
    <table width="650" border="0">
        <tr>
            <td colspan="3" align="center"><h3>Suppliers Info</h3></td>
        </tr>
        <tr>
            <td width="100" rowspan="7">
                <div style="padding: 5px;">
                    <div id="profile">
                        <?php
                        include 'config.php';
                        $sql = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='$sup_id'");
                        $rs = mysql_fetch_array($sql);
                        if (empty($rs["image"])) {
                            echo'<img src="images/no_avatar.png" height="200" width="200" />';
                        } else {
                            echo '<img src="supplier_prof_pic.php?sup_id='.$sup_id.'" height="200" width="200" />';
                        }
                        ?>
                    </div>
                </div>
            </td>
            <td width="331">Supplier ID </td>
            <td width="205">: <?php echo $rs["supplier_id"]; ?></td>
        </tr>
        <tr>
            <td>Supplier Name </td>
            <td>: <?php echo $rs["supplier_name"]; ?></td>
        </tr>
        <tr>
            <td>Owner Name </td>
            <td>: <?php echo $rs["owner"]; ?></td>
        </tr>
        <tr>
            <td>Contact Number </td>
            <td>: <?php echo $rs["owner_contact"]; ?></td>
        </tr>
        <tr>
            <td>Branch </td>
            <td>: <?php echo $rs["branch"]; ?></td>
        </tr>
        <tr>
            <td>Branch Head </td>
            <td>: <?php echo $rs["bh_in_charge"]; ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
    </table>
    <hr>

    <table width="650" border="0">
        <tr>
            <td colspan="2" align="center"><h3>Address Info</h3></td>
        </tr>
        <tr>
            <td width="140">Address</td>
            <td width="644">: <?php echo $rs["street"]." ".$rs["municipality"]." ".$rs["province"]; ?></td>
        </tr>
        <tr>
            <td>Warehouse 1</td>
            <td>:
                <?php
                if($rs["warehouse_add1"]!='//') {
                    echo $rs["warehouse_add1"];
                } else {
                    echo "N/A";
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>Warehouse 2</td>
            <td>:
                <?php
                if($rs["warehouse_add1"]!='//') {
                    echo $rs["warehouse_add2"];
                } else {
                    echo "N/A";
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>Warehouse 3</td>
            <td>:
                <?php
                if($rs["warehouse_add1"]!='//') {
                    echo $rs["warehouse_add3"];
                } else {
                    echo "N/A";
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>Warehouse 4</td>
            <td>:
                <?php
                if($rs["warehouse_add1"]!='//') {
                    echo $rs["warehouse_add4"];
                } else {
                    echo "N/A";
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>Warehouse 5</td>
            <td>: 
                <?php
                if($rs["warehouse_add1"]!='//') {
                    echo $rs["warehouse_add5"];
                } else {
                    echo "N/A";
                }
                ?>
            </td>
        </tr>
    </table>
    <hr>
    <table width="650" border="0">
        <tr>
            <td colspan="2" align="center"><h3>Other Info</h3></td>
        </tr>
        <tr>
            <td width="140">Representative</td>
            <td width="644">:
                <?php
                if (empty ($rs["representative"])) {
                    echo "N/A";
                } else {
                    echo $rs["representative"];
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>Contact Number</td>
            <td>:
                <?php
                if (empty ($rs["representative_contact"])) {
                    echo "N/A";
                } else {
                    echo $rs["representative_contact"];
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>Number of Trucks</td>
            <td>: 
                <?php
                if (empty ($rs["no_of_trucks"])) {
                    echo "N/A";
                } else {
                    echo $rs["no_of_trucks"];
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>Plate Number/s</td>
            <td>: 
                <?php
                if (empty ($rs["plate_number"])) {
                    echo "N/A";
                } else {
                    echo $rs["plate_number"];
                }
                ?>
            </td>
        </tr>
    </table>
    <hr>
    <table width="650" border="0">
        <tr>
            <td colspan="2" align="center"><h3>Banking Info</h3></td>
        </tr>
        <tr>
            <td width="140">Bank</td>
            <td width="644">: 
                <?php
                if (empty ($rs["bank"])) {
                    echo "N/A";
                } else {
                    echo $rs["bank"];
                }
                ?>
            </td>

        </tr>
        <tr>
            <td>Account Name</td>
            <td>:
                <?php
                if (empty ($rs["acct_name"])) {
                    echo "N/A";
                } else {
                    echo $rs["acct_name"];
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>Account Number</td>
            <td>: 
                <?php
                if (empty ($rs["acct_no"])) {
                    echo "N/A";
                } else {
                    echo $rs["acct_no"];
                }

                ?>
            </td>
        </tr>
    </table>
    <br>
    <br>
    <a href="viewDeliveryHistory.php?id=<?php echo $rs['supplier_id']; ?>"><button>View Delivery History</button></a>
</div>
