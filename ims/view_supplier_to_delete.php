<?php
session_start();
include('config.php');

if (isset($_GET['del_id'])) {
    $del_id = $_GET['del_id'];
    mysql_query("DELETE FROM supplier_details WHERE supplier_id='$del_id'");
    mysql_query("DELETE FROM sup_deliveries WHERE supplier_id='$del_id'");
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
        <h2>Please Review The Supplier.</h2>
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
                            <a href="view_supplier_to_delete.php?del_id=<?php echo $id; ?>" onclick="return confirm('Are you sure you want to delete?')"><button>Delete</button></a>
                        </td>
                        <td><a href="viewDeliveryHistory.php?id=<?php echo $row['supplier_id']; ?>"><button>View Delivery History</button></a></td>
                        <td></td>
                        <td></td>
                    </tr>

                </table>

            <?php
//            $start_q = $start_date;
//                    while ($start_q <= $breaker_date) {
//                        $month_q = date('F', strtotime($start_q));
//                        $year_q = date('Y', strtotime($start_q));
//                        if ($filtering_branch!='' && $filtering_grade='') {
//                            $sql_del = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE branch_delivered='$filtering_branch' and supplier_id='" . $rs_supplier['supplier_id'] . "' and month_delivered='$month_q' and year_delivered='$year_q'");
//                        } else if ($filtering_branch='' && $filtering_grade!='') {
//                            $sql_del = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE wp_grade='$filtering_grade' and supplier_id='" . $rs_supplier['supplier_id'] . "' and month_delivered='$month_q' and year_delivered='$year_q'");
//                        } else if ($filtering_branch!='' && $filtering_grade!='') {
//                            $sql_del = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE wp_grade='$filtering_grade' and branch_delivered='$filtering_branch' and supplier_id='" . $rs_supplier['supplier_id'] . "' and month_delivered='$month_q' and year_delivered='$year_q'");
//                        } else {
//                            $sql_del = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='" . $rs_supplier['supplier_id'] . "' and month_delivered='$month_q' and year_delivered='$year_q'");
//                        }
//                        $rs_del = mysql_fetch_array($sql_del);
//                        if ($month_q == $end_month_q && $year_q == $end_year) {
//                            $week_1 = date('Y/m/d', strtotime($start_q));
//                            $week_2 = date('Y/m/d', strtotime("+7 days", strtotime($week_1)));
//                            $week_3 = date('Y/m/d', strtotime("+7 days", strtotime($week_2)));
//                            $week_4 = date('Y/m/d', strtotime("+7 days", strtotime($week_3)));
//                            $week_5 = date('Y/m/d', strtotime("+7 days", strtotime($week_4)));
//                            $week_6 = date('Y/m/d', strtotime("+7 days", strtotime($week_5)));
//                            if ($filtering_branch!='' && $filtering_grade='') {
//                                $sql_week1 = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE branch_delivered='$filtering_branch' and supplier_id='" . $rs_supplier['supplier_id'] . "' and date_delivered>='$week_1' and date_delivered<='$week_2'");
//                                $sql_week2 = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE branch_delivered='$filtering_branch' and supplier_id='" . $rs_supplier['supplier_id'] . "' and date_delivered>='$week_2' and date_delivered<='$week_3'");
//                                $sql_week3 = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE branch_delivered='$filtering_branch' and supplier_id='" . $rs_supplier['supplier_id'] . "' and date_delivered>='$week_3' and date_delivered<='$week_4'");
//                                $sql_week4 = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE branch_delivered='$filtering_branch' and supplier_id='" . $rs_supplier['supplier_id'] . "' and date_delivered>='$week_4' and date_delivered<='$week_5'");
//                                $sql_week5 = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE branch_delivered='$filtering_branch' and supplier_id='" . $rs_supplier['supplier_id'] . "' and date_delivered>='$week_5' and date_delivered<='$week_6'");
//                            } else if ($filtering_branch='' && $filtering_grade!='') {
//                                $sql_week1 = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE wp_grade='$filtering_grade' and supplier_id='" . $rs_supplier['supplier_id'] . "' and date_delivered>='$week_1' and date_delivered<='$week_2'");
//                                $sql_week2 = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE wp_grade='$filtering_grade' and supplier_id='" . $rs_supplier['supplier_id'] . "' and date_delivered>='$week_2' and date_delivered<='$week_3'");
//                                $sql_week3 = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE wp_grade='$filtering_grade' and supplier_id='" . $rs_supplier['supplier_id'] . "' and date_delivered>='$week_3' and date_delivered<='$week_4'");
//                                $sql_week4 = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE wp_grade='$filtering_grade' and supplier_id='" . $rs_supplier['supplier_id'] . "' and date_delivered>='$week_4' and date_delivered<='$week_5'");
//                                $sql_week5 = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE wp_grade='$filtering_grade' and supplier_id='" . $rs_supplier['supplier_id'] . "' and date_delivered>='$week_5' and date_delivered<='$week_6'");
//                            } else if ($filtering_branch!='' && $filtering_grade!='') {
//                                $sql_week1 = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE wp_grade='$filtering_grade' and branch_delivered='$filtering_branch' and supplier_id='" . $rs_supplier['supplier_id'] . "' and date_delivered>='$week_1' and date_delivered<='$week_2'");
//                                $sql_week2 = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE wp_grade='$filtering_grade' and branch_delivered='$filtering_branch' and supplier_id='" . $rs_supplier['supplier_id'] . "' and date_delivered>='$week_2' and date_delivered<='$week_3'");
//                                $sql_week3 = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE wp_grade='$filtering_grade' and branch_delivered='$filtering_branch' and supplier_id='" . $rs_supplier['supplier_id'] . "' and date_delivered>='$week_3' and date_delivered<='$week_4'");
//                                $sql_week4 = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE wp_grade='$filtering_grade' and branch_delivered='$filtering_branch' and supplier_id='" . $rs_supplier['supplier_id'] . "' and date_delivered>='$week_4' and date_delivered<='$week_5'");
//                                $sql_week5 = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE wp_grade='$filtering_grade' and branch_delivered='$filtering_branch' and supplier_id='" . $rs_supplier['supplier_id'] . "' and date_delivered>='$week_5' and date_delivered<='$week_6'");
//                            } else {
//                                $sql_week1 = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='" . $rs_supplier['supplier_id'] . "' and date_delivered>='$week_1' and date_delivered<='$week_2'");
//                                $sql_week2 = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='" . $rs_supplier['supplier_id'] . "' and date_delivered>='$week_2' and date_delivered<='$week_3'");
//                                $sql_week3 = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='" . $rs_supplier['supplier_id'] . "' and date_delivered>='$week_3' and date_delivered<='$week_4'");
//                                $sql_week4 = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='" . $rs_supplier['supplier_id'] . "' and date_delivered>='$week_4' and date_delivered<='$week_5'");
//                                $sql_week5 = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='" . $rs_supplier['supplier_id'] . "' and date_delivered>='$week_5' and date_delivered<='$week_6'");
//                            }
//                            $rs_week1 = mysql_fetch_array($sql_week1);
//                            $total_per_week['week1'] = $rs_week1['sum(weight)'] / 1000;
//                            echo "<td id='weekly'>" . round($rs_week1['sum(weight)'] / 1000, 2) . "</td>";
//                            $rs_week2 = mysql_fetch_array($sql_week2);
//                            $total_per_week['week2'] = $rs_week2['sum(weight)'] / 1000;
//                            echo "<td id='weekly'>" . round($rs_week2['sum(weight)'] / 1000, 2) . "</td>";
//                            $rs_week3 = mysql_fetch_array($sql_week3);
//                            $total_per_week['week3'] = $rs_week3['sum(weight)'] / 1000;
//                            echo "<td id='weekly'>" . round($rs_week3['sum(weight)'] / 1000, 2) . "</td>";
//                            $rs_week4 = mysql_fetch_array($sql_week4);
//                            $total_per_week['week4'] = $rs_week4['sum(weight)'] / 1000;
//                            echo "<td id='weekly'>" . round($rs_week4['sum(weight)'] / 1000, 2) . "</td>";
//                            $rs_week5 = mysql_fetch_array($sql_week5);
//                            $total_per_week['week5'] = $rs_week5['sum(weight)'] / 1000;
//                            echo "<td id='weekly'>" . round($rs_week5['sum(weight)'] / 1000, 2) . "</td>";
//                        } else {
//                            $total_per_month[$mon_ctr]+=$rs_del['sum(weight)'] / 1000;
//                            echo "<td>" . round($rs_del ['sum(weight)'] / 1000, 2) . "</td>";
//                        }
//                        $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
//                        $mon_ctr++;
//                    }
//
//                    ?>

        </div>
    </div>
</div>
<div class="clear">
</div>
</div>
<div class="clear">
</div>

