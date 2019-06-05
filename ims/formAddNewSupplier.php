<?php
@session_start();
include("templates/template.php");
?>
<style>
    h1{
        color:white;
    }
    h4{
        font-size: 15px;
    }
</style>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>EFI INCOMING DELIVERIES MONITORING SYSTEM</title>
        <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
        <link href="css/table/demo_page.css" rel="stylesheet" type="text/css" />

        <script type="text/javascript" src="js/table/table.js"></script>
        <script src="js/setup.js" type="text/javascript"></script>
        <script type="text/javascript">

            $(document).ready(function () {
                setupLeftMenu();

                $('.datatable').dataTable();
                setSidebarHeight();


            });
        </script>
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
        <style>
            /*
            table {
                border: 1px solid black;
            }
            td{
                border: 1px solid black;
            } */
            .assess_table{
                font-size: 15px;
                font-weight: bold;
            }
            select{
                height: 25px;
            }
            input {
                height: 25px;
            }
        </style>
        <script type="text/javascript">
            function change(str){
                var val = document.getElementById(str).value;
                var splits = str.split("_");
                var splits2 = val.split("_");
                document.getElementById(splits[0]+"_class_"+splits[2]).value = splits2[1];
            }
        </script>

        <link rel="stylesheet" href="cbFilter/cbCss.css" />
        <link rel="stylesheet" href="cbFilter/sup_assessment.css" />
        <script src="cbFilter/jquery-1.8.3.js"></script>
        <script src="cbFilter/jquery-ui.js"></script>
        <script src="cbFilter/sup_assessment.js"></script>

    </head>
    <body>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add A New Supplier</h2>
                <div style="position: absolute; margin-left: 580px; margin-top: 5px;">
                    <img src="images/sup_class.png" height="240">
                </div>
                <div class="block">
                    <form action="addNewSupplierExec2.php" method="POST" enctype="multipart/form-data">
                        <table class="assess_table">
                            <!-- <tr>
                                <td>Supplier ID:</td>
                                <td>
                            <?php

//                                    if(!isset ($_SESSION['username'])) {
//                                        header("Location:index.php");
//                                    }
//                                    include('config.php');
//                                    $result = mysql_query("SELECT * FROM supplier_details  order by supplier_id desc limit 1");
//                                    $row = mysql_fetch_array($result);
//                                    $idNumber=$row['supplier_id']+1;
                            ?>
                                    <input type="text" class="mini" name="supplier_id" style="color:blue; font-size:25px; border-style:hidden; font-weight:bold;" value="<?php 
//                                    echo $idNumber;
                            ?>" readonly/>
                                </td>
                                <td></td>
                                <td></td>
                            </tr> -->
                            <tr>
                                <td colspan="4"><br><br></td>
                            </tr>
                            <tr>
                                <td>Image:</td>
                                <td><input type="file" name="image" class="large" value="" /></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Supplier Name</td>
                                <td><input type="text" name="supplier_name" class="large" value="" required/></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Classification:</td>
                                <td><select name="classification" class="mini" required>
                                        <option value="">---</option>
                                        <option value="PM">PM</option>
                                        <option value="C1">C1</option>
                                        <option value="C2">C2</option>
                                        <option value="C3">C3</option>
                                        <option value="T1">T1</option>
                                        <option value="T2">T2</option>
                                        <option value="T3">T3</option>
                                        <option value="J1">J1</option>
                                        <option value="J2">J2</option>
                                        <option value="J3">J3</option>
                                        <option value="S1">S1</option>
                                        <option value="S2">S2</option>
                                        <option value="S3">S3</option>
                                    </select></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Branch:</td>
                                <td><?php
                                    $sql = mysql_query("SELECT * FROM branches");
                                    echo '<select name="branch" class="mini" required>';
                                    echo "<option value='".$_SESSION['user_branch']."'>".$_SESSION['user_branch']."</option>";
                                    while ($rs = mysql_fetch_array($sql)) {
                                        echo "<option value='".$rs['branch_name']."'>".$rs['branch_name']."</option>";
                                    }
                                    echo "</select>";
                                    ?></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Branch Head In Charge:</td>
                                <td><select name="bh_in_charge" class="mini" required>
                                        <option value="">---</option>
                                       <?php
                                    $sql = mysql_query("SELECT * FROM branches");
                                    while ($rs = mysql_fetch_array($sql)) {
										if ($rs['branch_head'] != ""){
											echo "<option value='".$rs['branch_head']."'>".$rs['branch_head']."</option>";
										}
                                    }
                                    ?>
                                    </select></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Branch Head To Verify:</td>
                                <td><select name="bh_to_verified" class="mini" required>
                                        <option value="">---</option>
                                         <?php
                                    $sql = mysql_query("SELECT * FROM branches");
                                    while ($rs = mysql_fetch_array($sql)) {
										if ($rs['branch_head'] != ""){
											echo "<option value='".$rs['branch_head']."'>".$rs['branch_head']."</option>";
										}
                                    }
                                    ?>
                                    </select></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Restrained to branch?</td>
                                <td><select name="restrained" class="mini" required>
                                        <option value="YES">YES</option>
                                        <option value="NO">NO</option>
                                    </select></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Is the Supplier Address is in NCR?</td>
                                <td><select name="sup_address" onChange="apply_province(this.value)">
                                        <option value="NO">NO</option>
                                        <option value="YES">YES</option>
                                    </select></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Address:</td>
                                <td><input type="text" id="street_all" name="street" class="large" value="" placeholder="Street/Barangay"/></td>
                                <td><input type="text" id="municipality_all" name="municipality" class="large" value="" placeholder="Municipality"/></td>
                                <td><select id="province_all" name="province" required>
                                        <option value="">-Select-</option>
                                        <option value="Abra">Abra</option>
                                        <option value="Agusan del Norte">Agusan del Norte</option>
                                        <option value="Agusan del Sur">Agusan del Sur</option>
                                        <option value="Aklan">Aklan</option>
                                        <option value="Albay">Albay</option>
                                        <option value="Antique">Antique</option>
                                        <option value="Apayao">Apayao</option>
                                        <option value="Aurora">Aurora</option>
                                        <option value="Baguio">Baguio</option>
                                        <option value="Basilan">Basilan</option>
                                        <option value="Bataan">Bataan</option>
                                        <option value="Batanes">Batanes</option>
                                        <option value="Batangas">Batangas</option>
                                        <option value="Biliran">Biliran</option>
                                        <option value="Bohol">Bohol</option>
                                        <option value="Bukidnon">Bukidnon</option>
                                        <option value="Bulacan">Bulacan</option>
                                        <option value="Cagayan">Cagayan</option>
                                        <option value="Camarines Norte">Camarines Norte</option>
                                        <option value="Camarines Sur">Camarines Sur</option>
                                        <option value="Camiguin">Camiguin</option>
                                        <option value="Capiz">Capiz</option>
                                        <option value="Catanduanes">Catanduanes</option>
                                        <option value="Cavite">Cavite</option>
                                        <option value="Cebu">Cebu</option>
                                        <option value="Compostela Valley">Compostela Valley</option>
                                        <option value="Cotabato">Cotabato</option>
                                        <option value="Davao">Davao</option>
                                        <option value="Dinagat Islands">Dinagat Islands</option>
                                        <option value="Eastern Samar">Eastern Samar</option>
                                        <option value="Guimaras">Guimaras</option>
                                        <option value="Ifugao">Ifugao</option>
                                        <option value="Ilocos">Ilocos</option>
                                        <option value="Iloilo">Iloilo</option>
                                        <option value="Isabela">Isabela</option>
                                        <option value="Kalinga">Kalinga</option>
                                        <option value="La Union">La Union</option>
                                        <option value="Laguna">Laguna</option>
                                        <option value="Lanao del Norte">Lanao del Norte</option>
                                        <option value="Lanao del Sur">Lanao del Sur</option>
                                        <option value="Leyte">Leyte</option>
                                        <option value="Maguindanao">Maguindanao</option>
                                        <option value="Marinduque">Marinduque</option>
                                        <option value="Masbate">Masbate</option>
                                        <option value="Misamis Occidental">Misamis Occidental</option>
                                        <option value="Misamis Oriental">Misamis Oriental</option>
                                        <option value="Mountain Province">Mountain Province</option>
                                        <option value="Negros Occidental">Negros Occidental</option>
                                        <option value="Negros Oriental">Negros Oriental</option>
                                        <option value="Northern Samar">Northern Samar</option>
                                        <option value="Nueva Ecija">Nueva Ecija</option>
                                        <option value="Nueva Viscaya">Nueva Viscaya</option>
                                        <option value="Mindoro">Mindoro</option>
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
                                        <option value="Surigao del Norte">Surigao del Norte</option>
                                        <option value="Surigao del Sur">Surigao del Sur</option>
                                        <option value="Tarlac">Tarlac</option>
                                        <option value="Tawi-Tawi">Tawi-Tawi</option>
                                        <option value="Zambales">Zambales</option>
                                        <option value="Zamboanga del Norte">Zamboanga del Norte</option>
                                        <option value="Zamboanga del Sur">Zamboanga del Sur</option>
                                        <option value="Zamboanga Sibugay">Zamboanga Sibugay</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td>if Address is in NCR:</td>
                                <td><input type="text" id="street_ncr" name="street" class="large" value="" placeholder="Street/Barangay" disabled="true"/></td>
                                <td><input type="text" id="municipality_ncr" name="municipality" class="large" value="" placeholder="Municipality" disabled="true"/></td>
                                <td><select id="province_ncr" name="province" disabled="true">
                                        <option value="Caloocan">Caloocan</option>
                                        <option value="Las Pinas">Las Pinas</option>
                                        <option value="Makati">Makati</option>
                                        <option value="Malabon">Malabon</option>
                                        <option value="Mandaluyong">Mandaluyong</option>
                                        <option value="Manila">Manila</option>
                                        <option value="Marikina">Marikina</option>
                                        <option value="Muntinlupa">Muntinlupa</option>
                                        <option value="Navotas">Navotas</option>
                                        <option value="Paranaque">Paranaque</option>
                                        <option value="Pasay">Pasay</option>
                                        <option value="Pasig">Pasig</option>
                                        <option value="Pateros">Pateros</option>
                                        <option value="Quezon City">Quezon City</option>
                                        <option value="San Juan">San Juan</option>
                                        <option value="Taguig">Taguig</option>
                                        <option value="Valenzuela">Valenzuela</option>
                                    </select></td>
                            </tr>
							<tr>
								<td>Group Island</td>
								<td>
										<select name="group_island" required>
											<option value="" disabled="disabled" selected="selected"> -Select- </option>
											<option value="Luzon">Luzon</option>
											<option value="Visayas">Visayas</option>
											<option value="Mindanao">Mindanao</option>
										</select>
								</td>
							</tr>
                            <tr>
                                <td>Owner Name:</td>
                                <td><input type="text" name="owner" class="large" value="" required /></td>
                                <td>Contact:</td>
                                <td><input type="text" name="owner_contact" class="large" value="" required /></td>
                            </tr>
                            <tr>
                                <td>Representative Name:</td>
                                <td><input type="text" name="representative" class="large" value="" /></td>
                                <td>Contact:</td>
                                <td><input type="text" name="representative_contact" class="large" value="" /></td>
                            </tr>
                            <tr>
                                <td>Number of Trucks:</td>
                                <td><input type="text" name="no_of_trucks" class="mini" value="" /></td>
                                <td>Plate Number/s:</td>
                                <td><input type="text" name="plate_numbers" class="large" value="" required /></td>
                            </tr>
                            <tr>
                                <td>Number of Warehouses:</td>
                                <td><input type="text" name="no_of_wh" class="mini" value="" /></td>
                                <td>Warehouse Addresses:</td>
                                <td><input type="text" name="wh_address" class="large" value="" /></td>
                            </tr>
                            <tr>
                                <td>Warehouse Address 1:</td>
                                <td><input type="text" name="wh_st1" class="large" value="" placeholder="Street/Barangay"/></td>
                                <td><input type="text" name="wh_city1" class="large" value="" placeholder="Municipality"/></td>
                                <td><input type="text" name="wh_prov1" class="large" value="" placeholder="City/Province"/></td>
                            </tr>
                            <tr>
                                <td>Warehouse Address 2:</td>
                                <td><input type="text" name="wh_st2" class="large" value="" placeholder="Street/Barangay"/></td>
                                <td><input type="text" name="wh_city2" class="large" value="" placeholder="Municipality"/></td>
                                <td><input type="text" name="wh_prov2" class="large" value="" placeholder="City/Province"/></td>
                            </tr>
                            <tr>
                                <td>Warehouse Address 3:</td>
                                <td><input type="text" name="wh_st3" class="large" value="" placeholder="Street/Barangay"/></td>
                                <td><input type="text" name="wh_city3" class="large" value="" placeholder="Municipality"/></td>
                                <td><input type="text" name="wh_prov3" class="large" value="" placeholder="City/Province"/></td>
                            </tr>
                            <tr>
                                <td>Warehouse Address 4:</td>
                                <td><input type="text" name="wh_st4" class="large" value="" placeholder="Street/Barangay"/></td>
                                <td><input type="text" name="wh_city4" class="large" value="" placeholder="Municipality"/></td>
                                <td><input type="text" name="wh_prov4" class="large" value="" placeholder="City/Province"/></td>
                            </tr>
                            <tr>
                                <td>Warehouse Address 5:</td>
                                <td><input type="text" name="wh_st5" class="large" value="" placeholder="Street/Barangay"/></td>
                                <td><input type="text" name="wh_city5" class="large" value="" placeholder="Municipality"/></td>
                                <td><input type="text" name="wh_prov5" class="large" value="" placeholder="City/Province"/></td>
                            </tr>
                        </table>
                        <br>

                        <?php

                        $grades_array=array('lcwl','onp','cbs','occ','mw','cb');
                        echo "<table class='assess_table' width='950' style='margin-left: 30px;'>";
                        echo "<tr>";
                        echo "<td colspan='4' align='center'>WP GOING TO<br></td>";
                        echo "</tr>";
                        foreach ($grades_array as $grade) {
                            $c = 0;
                            echo "<tr>";
                            echo "<td colspan='4' align='center'><br>".strtoupper($grade)."</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td colspan='4' align='center'>Capacity: <input text='text' name='".$grade."_capacity' value=''>
&nbsp;&nbsp;&nbsp;Date Effective: <input type='text'  id='".$grade."_inputField' name='".$grade."_date_effective' value='".date('Y/m/d')."' onfocus='date1(this.id);' readonly>
<br><br></td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td align='center'>Supplier</td>";
                            echo "<td align='center'>Type</td>";
                            echo "<td align='center'>Price</td>";
                            echo "<td align='center'>Volume (MT)</td>";
                            echo "</tr>";
                            while ($c < 3) {
                                echo "<tr>";
                                echo "<td><span id='picker_".$grade."".$c."'>";
                                echo "<select name='".$grade."_sup_".$c."' id='combobox_".$grade."".$c."'>";
                                echo "<option value=''></option>";
                                $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE status!='inactive'");
                                while ($rs_sup = mysql_fetch_array($sql_sup)) {
                                    echo "<option value='" . $rs_sup['supplier_id'] . "_" . $rs_sup['classification'] . "'>" . $rs_sup['supplier_id'] . "_" . $rs_sup['supplier_name'] . " -- ". $rs_sup['classification'] . "</option>";
                                }
                                echo "</select>";
                                echo "</span></td>";
                                echo "<td>Deliver: <input type='radio' name='".$grade."_type_".$c."' value='delivery'/> Pickup: <input type='radio' name='".$grade."_type_".$c."' value='pickup'/></td>";
                                echo "<td><input type='text' name='".$grade."_price_".$c."' class='assess' value=''/></td>";
                                echo "<td><input type='text' name='".$grade."_volume_".$c."' class='assess' value=''/></td>";
                                echo "</tr>";
                                $c++;
                            }

                        }
                        echo "</table>";

                        ?>



                        <table class="assess_table">
                            <tr>
                                <td><label><h4> Is Payable Online?:</h4> </label></td>
                                <td><select name="payable_online" id="payable_online" onChange="apply(this.value)" >
                                        <option value="NO">NO</option>
                                        <option value="YES">YES</option>
                                    </select>
                                </td>
                            </tr>


                            <tr><td><i><h5 style="color:red;">To be filled-out only if the answer is yes</h5></i></td></tr>
                            <tr>
                                <td>Bank :</td>
                                <td><input type="text" name="bank"  id="bank" class="large" value="" disabled="true"/></td>
                            </tr>
                            <tr>
                                <td>Acct Name :</td>
                                <td><input type="text" name="acct_name" id="acct_name" class="large" value="" disabled="true" /></td>
                            </tr>
                            <tr>
                                <td>Acct No. :</td>
                                <td><input type="text" name="acct_no" id="acct_no" class="large" value="" disabled="true"/></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="submit" value="Save New Supplier"/></td>
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

    </body>
</html>

