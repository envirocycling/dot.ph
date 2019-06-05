<?php
session_start();
include('config.php');
if (isset($_GET['id'])) {
    $approved_id = $_GET['id'];
    mysql_query("UPDATE supplier_details SET verified='1' WHERE supplier_id='$approved_id'");
    echo "<script>";
    echo "alert('Successfully Approved');";
    echo "window.close();";
    echo "</script>";
}
if (isset($_GET['del_id'])) {
    $del_id = $_GET['del_id'];
    mysql_query("DELETE FROM supplier_details WHERE supplier_id='$del_id'");
    echo "<script>";
    echo "alert('Successfully Disapproved');";
    echo "window.close();";
    echo "</script>";
}

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
        <h2>Edit Supplier Details</h2>
        <div class="block ">
                <table class="form">

                    <tr>
                        <td>
                            <label>
                                 Supplier ID:
                            </label>
                        </td>
                        <td>
                            <?php

                            if(!isset ($_SESSION['username'])) {
                                header("Location:index.php");
                            }
                            $id=$_GET['sup_id'];
                            $result = mysql_query("SELECT * FROM supplier_details where supplier_id='$id'");
                            $row = mysql_fetch_array($result);

                            ?>
                            <input id="id" type="text" class="mini" name="supplier_id"  value="<?php echo $row['supplier_id'];?>" readonly/>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>
                                 Supplier Name: </label>
                        </td>
                        <td>
                            <input type="text" name="supplier_name" class="large" value="<?php echo $row['supplier_name'];?>" readonly/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                 Classification: </label>
                        </td>
                        <td>
                            <input type="text" name="classification" class="mini" value="<?php echo $row['classification'];?>" readonly/>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>
                                 Branch: </label>
                        </td>
                        <td>
                            <input type="text" name="branch" class="mini" value="<?php echo $row['branch'];?>" readonly/>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>
                                 Branch Head In Charge: </label>
                        </td>
                        <td>
                            <input type="text" name="bh_in_charge" value="<?php echo $row['bh_in_charge'];?>" readonly/>
                        </td>
                    </tr>
                   
                    <tr>
                        <td>
                            <label>
                                Address: </label>
                        </td>
                        <td>
                            <input type="text" id="street_all" name="street" class="large" value="<?php echo $row['street']; ?>" placeholder="Street/Barangay" readonly/>
                        </td>
                        <td>
                            <input type="text" id="municipality_all" name="municipality" class="large" value="<?php echo $row['municipality']; ?>" placeholder="Municipality" readonly/>
                        </td>
                        <td>
                            <input type="text" name="province" value="<?php echo $row['province']; ?>" readonly/>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>
                                 Owner Name: </label>
                        </td>
                        <td>
                            <input type="text" name="owner" class="large" value="<?php echo $row['owner'];?>" readonly/>
                        </td>



                        <td>
                            <label>
                                  Contact: </label>
                        </td>
                        <td>
                            <input type="text" name="owner_contact" class="large" value="<?php echo $row['owner_contact'];?>" readonly/>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>
                                 Representative Name: </label>
                        </td>
                        <td>
                            <input type="text" name="representative" class="large" value="<?php echo $row['representative'];?>" readonly/>
                        </td>



                        <td>
                            <label>
                                     Contact: </label>
                        </td>
                        <td>
                            <input type="text" name="representative_contact" class="large" value="<?php echo $row['representative_contact'];?>" readonly/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                 Number of Trucks: </label>
                        </td>
                        <td>
                            <input type="text" name="no_of_trucks" class="mini" value="<?php echo $row['no_of_trucks'];?>" readonly/>
                        </td>

                        <td>
                            <label>
                                 Plate Number/s: </label>
                        </td>
                        <td>
                            <input type="text" name="plate_numbers" class="large" value="<?php echo $row['plate_number'];?>" readonly/>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>
                                 Number of Warehouses: </label>
                        </td>
                        <td>
                            <input type="text" name="no_of_wh" class="mini" value="<?php echo $row['no_of_warehouse'];?>" readonly/>
                        </td>

                        <td>
                            <label>
                                 Warehouse Addresses </label>
                        </td>
                        <td>
                            <input type="text" name="wh_address" class="large" value="<?php echo $row['warehouse_address'];?>" readonly/>
                        </td>
                    </tr>
                    <?php
                    $wh_add1=preg_split('[/]',$row['warehouse_add1']);
                    ?>
                    <tr>
                        <td>
                            <label>
                                Warehouse Address 1 </label>
                        </td>
                        <td>
                            <input type="text" name="wh_st1" class="large" value="<?php echo $wh_add1[0];?>" placeholder="Street/Barangay" readonly/>
                        </td>

                        <td>
                            <input type="text" name="wh_city1" class="large" value="<?php echo $wh_add1[1];?>" placeholder="Municipality" readonly/>
                        </td>
                        <td>
                            <input type="text" name="wh_prov1" class="large" value="<?php echo $wh_add1[2];?>" placeholder="City" readonly/>
                        </td>
                    </tr>
                    <?php
                    $wh_add2=preg_split('[/]',$row['warehouse_add2']);
                    ?>
                    <tr>
                        <td>
                            <label>
                                Warehouse Address 2 </label>
                        </td>
                        <td>
                            <input type="text" name="wh_st2" class="large" value="<?php echo $wh_add2[0];?>" placeholder="Street/Barangay" readonly/>
                        </td>

                        <td>
                            <input type="text" name="wh_city2" class="large" value="<?php echo $wh_add2[1];?>" placeholder="Municipality" readonly/>
                        </td>
                        <td>
                            <input type="text" name="wh_prov2" class="large" value="<?php echo $wh_add2[2];?>" placeholder="City/Province" readonly/>
                        </td>
                    </tr>

                    <?php
                    $wh_add3=preg_split('[/]',$row['warehouse_add3']);
                    ?>
                    <tr>
                        <td>
                            <label>
                                Warehouse Address 3 </label>
                        </td>
                        <td>
                            <input type="text" name="wh_st3" class="large" value="<?php echo $wh_add3[0];?>" placeholder="Street/Barangay" readonly/>
                        </td>

                        <td>
                            <input type="text" name="wh_city3" class="large" value="<?php echo $wh_add3[1];?>" placeholder="Municipality" readonly/>
                        </td>
                        <td>
                            <input type="text" name="wh_prov3" class="large" value="<?php echo $wh_add3[2];?>" placeholder="City/Province" readonly/>
                        </td>
                    </tr>
                    <?php
                    $wh_add4=preg_split('[/]',$row['warehouse_add4']);
                    ?>
                    <tr>
                        <td>
                            <label>
                                Warehouse Address 4 </label>
                        </td>
                        <td>
                            <input type="text" name="wh_st4" class="large" value="<?php echo $wh_add4[0];?>" placeholder="Street/Barangay" readonly/>
                        </td>

                        <td>
                            <input type="text" name="wh_city4" class="large" value="<?php echo $wh_add4[1];?>" placeholder="Municipality" readonly/>
                        </td>
                        <td>
                            <input type="text" name="wh_prov4" class="large" value="<?php echo $wh_add4[2];?>" placeholder="City/Province" readonly/>
                        </td>
                    </tr>
                    <?php
                    $wh_add5=preg_split('[/]',$row['warehouse_add5']);
                    ?>
                    <tr>
                        <td>
                            <label>
                                Warehouse Address 5 </label>
                        </td>
                        <td>
                            <input type="text" name="wh_st5" class="large" value="<?php echo $wh_add5[0];?>" placeholder="Street/Barangay" readonly/>
                        </td>

                        <td>
                            <input type="text" name="wh_city5" class="large" value="<?php echo $wh_add5[1];?>" placeholder="Municipality" readonly/>
                        </td>
                        <td>
                            <input type="text" name="wh_prov5" class="large" value="<?php echo $wh_add5[2];?>" placeholder="City/Province" readonly/>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <a href="view_supplier.php?id=<?php echo $id; ?>"><button>Approve</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="view_supplier.php?del_id=<?php echo $id; ?>" onclick="return confirm('Are you sure you want to delete?')"><button>Disapprove</button></a>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                </table>
        </div>
    </div>
</div>
<div class="clear">
</div>
</div>
<div class="clear">
</div>

