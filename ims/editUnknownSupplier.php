<?php
session_start();
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

<script type="text/javascript">



    function apply(val)
    {

        if (val=='YES') {

            document.getElementById('acct_name').disabled = false;
            document.getElementById('acct_no').disabled = false;
            document.getElementById('bank').disabled = false;
        } else {
            document.getElementById('acct_name').disabled = true;
            document.getElementById('acct_no').disabled = true;
            document.getElementById('bank').disabled = true;

            document.getElementById('acct_name').value = "";
            document.getElementById('acct_no').value = "";
            document.getElementById('bank').value = "";
        }
    }
    function apply_province(val2)
    {
        if (val2=='YES') {

            document.getElementById('street_ncr').disabled = false;
            document.getElementById('municipality_ncr').disabled = false;
            document.getElementById('province_ncr').disabled = false;

            document.getElementById('street_all').disabled = true;
            document.getElementById('municipality_all').disabled = true;
            document.getElementById('province_all').disabled = true;

        } else {

            document.getElementById('street_all').disabled = false;
            document.getElementById('municipality_all').disabled = false;
            document.getElementById('province_all').disabled = false;

            document.getElementById('street_ncr').disabled = true;
            document.getElementById('municipality_ncr').disabled = true;
            document.getElementById('province_ncr').disabled = true;
        }

    }


</script>
<div class="grid_10">
    <div class="box round first fullpage">
        <h2>Edit Supplier Details</h2>
        <div class="block ">
            <form action="editSupplierExec.php" method="POST">
                <table class="form">

                    <tr>
                        <td>
                            <label>
                                <h4> Supplier ID:</h4>
                            </label>
                        </td>
                        <td>
                            <?php

                            if(!isset ($_SESSION['username'])) {
                                header("Location:index.php");
                            }
                            $id=$_GET['sup_id'];
                            include('config.php');
                            $result = mysql_query("SELECT * FROM supplier_details where supplier_id='$id'");
                            $row = mysql_fetch_array($result);

                            ?>
                            <input id="id" type="text" class="mini" name="supplier_id"  value="<?php echo $row['supplier_id'];?>" readonly/>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>
                                <h4> Supplier Name:</h4> </label>
                        </td>
                        <td>
                            <input type="text" name="supplier_name" class="large" value="<?php echo $row['supplier_name'];?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                <h4> Classification:</h4> </label>
                        </td>
                        <td>
                            <input type="text" name="classification" class="mini" value="<?php echo $row['classification'];?>" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>
                                <h4> Branch:</h4> </label>
                        </td>
                        <td>
                            <input type="text" name="branch" class="mini" value="<?php echo $row['branch'];?>"/>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>
                                <h4> Branch Head In Charge:</h4> </label>
                        </td>
                        <td>
                            <select name="bh_in_charge" class="mini">
                                <option value="<?php echo $row['bh_in_charge'];?>"><?php echo $row['bh_in_charge'];?></option>
                                <option value="CLC">CLC</option>
                                <option value="EAA">EAA</option>
                                <option value="FDM">FDM</option>
                                <option value="JLA">JLA</option>
                                <option value="JRP">JRP</option>
                                <option value="MDG">MDG</option>
                            </select>
                        </td>
                    </tr>
                    <?php
                    if(empty($row['province'])) {
                        ?>
                    <tr>
                        <td>
                            <label>
                                <h4>Please Update Your Suppliers Address Info!</h4> </label>
                        </td>
                        <td>
                            Your Current Supplier Address is: <?php echo $row['address']; ?>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                        <?php
                    } else {
                        ?>
                    <tr>
                        <td>
                            <label>
                                <h4>Supplier Address is Updated</h4> </label>
                        </td>
                        <td>
                                <?php echo $row['address']; ?>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                        <?php
                    }
                    ?>
                    <tr>
                        <td>
                            <label>
                                <h4>Is the Supplier Address is in NCR?</h4> </label>
                        </td>
                        <td>
                            <select name="sup_address" onchange="apply_province(this.value)">
                                <option value="NO">NO</option>
                                <option value="YES">YES</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                <h4>Address:</h4> </label>
                        </td>
                        <td>
                            <input type="text" id="street_all" name="street" class="large" value="<?php echo $row['street']; ?>" placeholder="Street/Barangay"/>
                        </td>
                        <td>
                            <input type="text" id="municipality_all" name="municipality" class="large" value="<?php echo $row['municipality']; ?>" placeholder="Municipality"/>
                        </td>
                        <td>
                            <select id="province_all" name="province">
                                <option value="<?php echo $row['province']; ?>"><?php echo $row['province']; ?></option>
                                <option value="Abra">Abra</option>
                                <option value="Agusan del Norte">Agusan</option>
                                <option value="Aklan">Aklan</option>
                                <option value="Albay">Albay</option>
                                <option value="Antique">Antique</option>
                                <option value="Apayao">Apayao</option>
                                <option value="Aurora">Aurora</option>
                                <option value="Basilan">Basilan</option>
                                <option value="Bataan">Bataan</option>
                                <option value="Batanes">Batanes</option>
                                <option value="Batangas">Batangas</option>
                                <option value="Benguet">Benguet / Baguio</option>
                                <option value="Biliran">Biliran</option>
                                <option value="Bohol">Bohol</option>
                                <option value="Bukidnon">Bukidnon</option>
                                <option value="Bulacan">Bulacan</option>
                                <option value="Cagayan">Cagayan</option>
                                <option value="Camarines Norte">Camarines</option>
                                <option value="Camiguin">Camiguin</option>
                                <option value="Capiz">Capiz</option>
                                <option value="Catanduanes">Catanduanes</option>
                                <option value="Cavite">Cavite</option>
                                <option value="Cebu">Cebu</option>
                                <option value="Compostela Valley">Compostela Valley</option>
                                <option value="Cotabato">Cotabato</option>
                                <option value="Davao del Sur">Davao</option>
                                <option value="Dinagat Islands">Dinagat Islands</option>
                                <option value="Eastern Samar">Eastern Samar</option>
                                <option value="Guimaras">Guimaras</option>
                                <option value="Ifugao">Ifugao</option>
                                <option value="Ilocos Norte">Ilocos</option>
                                <option value="Iloilo">Iloilo</option>
                                <option value="Isabela">Isabela</option>
                                <option value="Kalinga">Kalinga</option>
                                <option value="La Inion">La Inion</option>
                                <option value="Laguna">Laguna</option>
                                <option value="Lanao del Norte">Lanao</option>
                                <option value="Leyte">Leyte</option>
                                <option value="Maguindanao">Maguindanao</option>
                                <option value="Marinduque">Marinduque</option>
                                <option value="Masbate">Masbate</option>
                                <option value="Misamis Occidental">Misamis</option>
                                <option value="Mountain Province">Mountain Province</option>
                                <option value="Negros Occidental">Negros Occidental</option>
                                <option value="Negros Oriental">Negros Oriental</option>
                                <option value="Northern Samar">Northern Samar</option>
                                <option value="Nueva Ecija">Nueva Ecija</option>
                                <option value="Nueva Viscaya">Nueva Viscaya</option>
                                <option value="Occidental Mindoro">Mindoro</option>
                                <option value="Palawan">Palawan</option>
                                <option value="Pampanga">Pampanga</option>
                                <option value="Pangasinan">Pangasinan</option>
                                <option value="Quezon Province">Quezon Province</option>
                                <option value="Quirino">Quirino</option>
                                <option value="Rizal">Rizal</option>
                                <option value="Romblon">Romblon</option>
                                <option value="Samar">Samar</option>
                                <option value="Sarangani">Sarangani</option>
                                <option value="Siquijor">Siquijor</option>
                                <option value="Sorsogon">Sorsogon</option>
                                <option value="South Cotabato">South Cotabato</option>
                                <option value="Southern Leyte">Southern Leyte</option>
                                <option value="Sultan Kudara">Sultan Kudara</option>
                                <option value="Sulu">Sulu</option>
                                <option value="Surigao del Norte">Surigao</option>
                                <option value="Tarlac">Tarlac</option>
                                <option value="Tawi-Tawi">Tawi-Tawi</option>
                                <option value="Zambales">Zambales</option>
                                <option value="Zamboanga del Norte">Zamboanga</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                <h4>if Address is in NCR:</h4> </label>
                        </td>
                        <td>
                            <input type="text" id="street_ncr" name="street" class="large" value="<?php echo $row['street']; ?>" placeholder="Street/Barangay" disabled="true"/>
                        </td>
                        <td>
                            <input type="text" id="municipality_ncr" name="municipality" class="large" value="<?php echo $row['municipality']; ?>" placeholder="Municipality" disabled="true"/>
                        </td>
                        <td>
                            <select id="province_ncr" name="province" disabled="true">
                                <option value="<?php echo $row['province']; ?>"><?php echo $row['province']; ?></option>
                                <option value="Caloocan">Caloocan</option>
                                <option value="Las Piñas">Las Piñas</option>
                                <option value="Makati">Makati</option>
                                <option value="Malabon">Malabon</option>
                                <option value="Mandaluyong">Mandaluyong</option>
                                <option value="Manila">Manila</option>
                                <option value="Marikina">Marikina</option>
                                <option value="Muntinlupa">Muntinlupa</option>
                                <option value="Navotas">Navotas</option>
                                <option value="Parañaque">Parañaque</option>
                                <option value="Pasay">Pasay</option>
                                <option value="Pasig">Pasig</option>
                                <option value="Pateros">Pateros</option>
                                <option value="Quezon City">Quezon City</option>
                                <option value="San Juan">San Juan</option>
                                <option value="Taguig">Taguig</option>
                                <option value="Valenzuela">Valenzuela</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>
                                <h4> Owner Name:</h4> </label>
                        </td>
                        <td>
                            <input type="text" name="owner" class="large" value="<?php echo $row['owner'];?>" />
                        </td>



                        <td>
                            <label>
                                <h4>  Contact:</h4> </label>
                        </td>
                        <td>
                            <input type="text" name="owner_contact" class="large" value="<?php echo $row['owner_contact'];?>" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>
                                <h4> Representative Name:</h4> </label>
                        </td>
                        <td>
                            <input type="text" name="representative" class="large" value="<?php echo $row['representative'];?>" />
                        </td>



                        <td>
                            <label>
                                <h4>     Contact:</h4> </label>
                        </td>
                        <td>
                            <input type="text" name="representative_contact" class="large" value="<?php echo $row['representative_contact'];?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                <h4> Number of Trucks:</h4> </label>
                        </td>
                        <td>
                            <input type="text" name="no_of_trucks" class="mini" value="<?php echo $row['no_of_trucks'];?>" />
                        </td>

                        <td>
                            <label>
                                <h4> Plate Number/s:</h4> </label>
                        </td>
                        <td>
                            <input type="text" name="plate_numbers" class="large" value="<?php echo $row['plate_number'];?>" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>
                                <h4> Number of Warehouses:</h4> </label>
                        </td>
                        <td>
                            <input type="text" name="no_of_wh" class="mini" value="<?php echo $row['no_of_warehouse'];?>" />
                        </td>

                        <td>
                            <label>
                                <h4> Warehouse Addresses:</h4> </label>
                        </td>
                        <td>
                            <input type="text" name="wh_address" class="large" value="<?php echo $row['warehouse_address'];?>" />
                        </td>
                    </tr>
                    <?php
                    $wh_add1=preg_split('[/]',$row['warehouse_add1']);
                    ?>
                    <tr>
                        <td>
                            <label>
                                <h4>Warehouse Address 1</h4> </label>
                        </td>
                        <td>
                            <input type="text" name="wh_st1" class="large" value="<?php echo $wh_add1[0];?>" placeholder="Street/Barangay"/>
                        </td>

                        <td>
                            <input type="text" name="wh_city1" class="large" value="<?php echo $wh_add1[1];?>" placeholder="Municipality"/>
                        </td>
                        <td>
                            <input type="text" name="wh_prov1" class="large" value="<?php echo $wh_add1[2];?>" placeholder="City"/>
                        </td>
                    </tr>
                    <?php
                    $wh_add2=preg_split('[/]',$row['warehouse_add2']);
                    ?>
                    <tr>
                        <td>
                            <label>
                                <h4>Warehouse Address 2</h4> </label>
                        </td>
                        <td>
                            <input type="text" name="wh_st2" class="large" value="<?php echo $wh_add2[0];?>" placeholder="Street/Barangay"/>
                        </td>

                        <td>
                            <input type="text" name="wh_city2" class="large" value="<?php echo $wh_add2[1];?>" placeholder="Municipality"/>
                        </td>
                        <td>
                            <input type="text" name="wh_prov2" class="large" value="<?php echo $wh_add2[2];?>" placeholder="City/Province"/>
                        </td>
                    </tr>

                    <?php
                    $wh_add3=preg_split('[/]',$row['warehouse_add3']);
                    ?>
                    <tr>
                        <td>
                            <label>
                                <h4>Warehouse Address 3</h4> </label>
                        </td>
                        <td>
                            <input type="text" name="wh_st3" class="large" value="<?php echo $wh_add3[0];?>" placeholder="Street/Barangay"/>
                        </td>

                        <td>
                            <input type="text" name="wh_city3" class="large" value="<?php echo $wh_add3[1];?>" placeholder="Municipality"/>
                        </td>
                        <td>
                            <input type="text" name="wh_prov3" class="large" value="<?php echo $wh_add3[2];?>" placeholder="City/Province"/>
                        </td>
                    </tr>
                    <?php
                    $wh_add4=preg_split('[/]',$row['warehouse_add4']);
                    ?>
                    <tr>
                        <td>
                            <label>
                                <h4>Warehouse Address 4</h4> </label>
                        </td>
                        <td>
                            <input type="text" name="wh_st4" class="large" value="<?php echo $wh_add4[0];?>" placeholder="Street/Barangay"/>
                        </td>

                        <td>
                            <input type="text" name="wh_city4" class="large" value="<?php echo $wh_add4[1];?>" placeholder="Municipality"/>
                        </td>
                        <td>
                            <input type="text" name="wh_prov4" class="large" value="<?php echo $wh_add4[2];?>" placeholder="City/Province"/>
                        </td>
                    </tr>
                    <?php
                    $wh_add5=preg_split('[/]',$row['warehouse_add5']);
                    ?>
                    <tr>
                        <td>
                            <label>
                                <h4>Warehouse Address 5</h4> </label>
                        </td>
                        <td>
                            <input type="text" name="wh_st5" class="large" value="<?php echo $wh_add5[0];?>" placeholder="Street/Barangay"/>
                        </td>

                        <td>
                            <input type="text" name="wh_city5" class="large" value="<?php echo $wh_add5[1];?>" placeholder="Municipality"/>
                        </td>
                        <td>
                            <input type="text" name="wh_prov5" class="large" value="<?php echo $wh_add5[2];?>" placeholder="City/Province"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                <h4> Is Payable Online?:</h4> </label>
                        </td>
                        <td>
                            <select name="payable_online" id="payable_online" onchange="apply(this.value)" >
                                <option value="<?php echo $row['payable_online'];?>"><?php echo $row['payable_online'];?></option>
                                <option value="NO">NO</option>
                                <option value="YES">YES</option>
                            </select>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>


                    <tr><td><i><h5 style="color:red;">To be filled-out only if the answer is yes</h5></i></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>

                            <label>
                                <h4>Bank :</h4> </label>
                        </td>
                        <td>
                            <input type="text" name="bank"  id="bank" class="large" value="<?php echo $row['bank'];?>" disabled="true"/>

                        </td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>

                            <label>
                                <h4>Acct Name :</h4> </label>
                        </td>
                        <td>
                            <input type="text" name="acct_name" id="acct_name" class="large" value="<?php echo $row['acct_name'];?>" disabled="true" />

                        </td>
                        <td></td>
                        <td></td>




                    </tr>
                    <tr>
                        <td>

                            <label>
                                <h4>Acct No. :</h4> </label>
                        </td>
                        <td>
                            <input type="text" name="acct_no" id="acct_no" class="large" value="<?php echo $row['acct_no'];?>" disabled="true"/>

                        </td>
                        <td></td>
                        <td></td>
                    </tr>


                    <tr>
                        <td>
                            <input type="submit" value="Update Supplier Details"/>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                </table>
            </form>
            <a href="viewDeliveryHistory.php?id=<?php echo $row['supplier_id']; ?>"><button>View Delivery History</button></a>

        </div>
    </div>
</div>
<div class="clear">
</div>
</div>
<div class="clear">
</div>

