<?php
include("templates/template.php");
?>
<style>
    h1{
        color:white;
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


    </head>
    <body>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add A New Supplier</h2>
                <div class="block ">
                    <form action="addNewSupplierExec.php" method="POST">
                        <table class="form">

                            <tr>
                                <td>
                                    <label>
                                        <h4> Supplier ID:</h4> </label>
                                </td>
                                <td>
                                    <?php
                                    
                                    if(!isset ($_SESSION['username'])) {
                                        header("Location:index.php");
                                    }
                                    include('config.php');
                                    $result = mysql_query("SELECT * FROM supplier_details  order by supplier_id desc limit 1");
                                    $row = mysql_fetch_array($result);
                                    $idNumber=$row['supplier_id']+1;
                                    ?>
                                    <input type="text" class="mini" name="supplier_id" style="color:blue; font-size:25px; border-style:hidden; font-weight:bold;" value="<?php echo $idNumber;?>" readonly/>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>
                                        <h4> Supplier Name:</h4> </label>
                                </td>
                                <td>
                                    <input type="text" name="supplier_name" class="large" value="" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <h4> Classification:</h4> </label>
                                </td>
                                <td>
                                    <input type="text" name="classification" class="mini" value="" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>
                                        <h4> Branch:</h4> </label>
                                </td>
                                <td>
                                    <input type="text" name="branch" class="mini" value="<?php echo $_SESSION['user_branch'];?>" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>
                                        <h4> Branch Head In Charge:</h4> </label>
                                </td>
                                <td>
                                    <input type="text" name="bh_in_charge" class="mini" value="" />
                                </td>
                            </tr>
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
                                    <input type="text" id="street_all" name="street" class="large" value="" placeholder="Street/Barangay"/>
                                </td>
                                <td>
                                    <input type="text" id="municipality_all" name="municipality" class="large" value="" placeholder="Municipality"/>
                                </td>
                                <td>
                                    <select id="province_all" name="province">
                                        <option value="Abra">Abra</option>
                                        <option value="Agusan del Norte">Agusan del Norte</option>
                                        <option value="Agusan del Sur">Agusan del Sur</option>
                                        <option value="Aklan">Aklan</option>
                                        <option value="Albay">Albay</option>
                                        <option value="Antique">Antique</option>
                                        <option value="Apayao">Apayao</option>
                                        <option value="Aurora">Aurora</option>
                                        <option value="Basilan">Basilan</option>
                                        <option value="Bataan">Bataan</option>
                                        <option value="Batanes">Batanes</option>
                                        <option value="Batangas">Batangas</option>
                                        <option value="Benguet">Benguet</option>
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
                                        <option value="Cebu">Cebu</option>
                                        <option value="Compostela Valley">Compostela Valley</option>
                                        <option value="Cotabato">Cotabato</option>
                                        <option value="Davao del Sur">Davao del Sur</option>
                                        <option value="DAvao Occidental">Davao Occidental</option>
                                        <option value="Davao Oriental">Davao Oriental</option>
                                        <option value="Dinagat Islands">Dinagat Islands</option>
                                        <option value="Eastern Samar">Eastern Samar</option>
                                        <option value="Guimaras">Guimaras</option>
                                        <option value="Ifugao">Ifugao</option>
                                        <option value="Ilocos Norte">Ilocos Norte</option>
                                        <option value="Ilocos Sur">Ilocos Sur</option>
                                        <option value="Iloilo">Iloilo</option>
                                        <option value="Isabela">Isabela</option>
                                        <option value="Kalinga">Kalinga</option>
                                        <option value="La Inion">La Inion</option>
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
                                        <option value="Occidental Mindoro">Occidental Mindoro</option>
                                        <option value="Oriental Mindoro">Oriental Mindoro</option>
                                        <option value="Palawan">Palawan</option>
                                        <option value="Pampanga">Pampanga</option>
                                        <option value="Pangasinan">Pangasinan</option>
                                        <option value="Quezon">Quezon</option>
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
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <h4>if Address is in NCR:</h4> </label>
                                </td>
                                <td>
                                    <input type="text" id="street_ncr" name="street" class="large" value="" placeholder="Street/Barangay" disabled="true"/>
                                </td>
                                <td>
                                    <input type="text" id="municipality_ncr" name="municipality" class="large" value="" placeholder="Municipality" disabled="true"/>
                                </td>
                                <td>
                                    <select id="province_ncr" name="province" disabled="true">
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
                                        <option value="Quezon">Quezon</option>
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
                                    <input type="text" name="owner" class="large" value="" />
                                </td>



                                <td>
                                    <label>
                                        <h4>  Contact:</h4> </label>
                                </td>
                                <td>
                                    <input type="text" name="owner_contact" class="large" value="" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>
                                        <h4> Representative Name:</h4> </label>
                                </td>
                                <td>
                                    <input type="text" name="representative" class="large" value="" />
                                </td>



                                <td>
                                    <label>
                                        <h4>     Contact:</h4> </label>
                                </td>
                                <td>
                                    <input type="text" name="representative_contact" class="large" value="" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <h4> Number of Trucks:</h4> </label>
                                </td>
                                <td>
                                    <input type="text" name="no_of_trucks" class="mini" value="" />
                                </td>

                                <td>
                                    <label>
                                        <h4> Plate Number/s:</h4> </label>
                                </td>
                                <td>
                                    <input type="text" name="plate_numbers" class="large" value="" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>
                                        <h4> Number of Warehouses:</h4> </label>
                                </td>
                                <td>
                                    <input type="text" name="no_of_wh" class="mini" value="" />
                                </td>
                                <td>
                                    <label>
                                        <h4> Warehouse Addresses:</h4> </label>
                                </td>
                                <td>
                                    <input type="text" name="wh_address" class="large" value="" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <h4>Warehouse Address 1:</h4> </label>
                                </td>
                                <td>
                                    <input type="text" name="wh_st1" class="large" value="" placeholder="Street/Barangay"/>
                                </td>

                                <td>
                                    <input type="text" name="wh_city1" class="large" value="" placeholder="Municipality"/>
                                </td>
                                <td>
                                    <input type="text" name="wh_prov1" class="large" value="" placeholder="City/Province"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <h4>Warehouse Address 2:</h4> </label>
                                </td>
                                <td>
                                    <input type="text" name="wh_st2" class="large" value="" placeholder="Street/Barangay"/>
                                </td>

                                <td>
                                    <input type="text" name="wh_city2" class="large" value="" placeholder="Municipality"/>
                                </td>
                                <td>
                                    <input type="text" name="wh_prov2" class="large" value="" placeholder="City/Province"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <h4>Warehouse Address 3:</h4> </label>
                                </td>
                                <td>
                                    <input type="text" name="wh_st3" class="large" value="" placeholder="Street/Barangay"/>
                                </td>

                                <td>
                                    <input type="text" name="wh_city3" class="large" value="" placeholder="Municipality"/>
                                </td>
                                <td>
                                    <input type="text" name="wh_prov3" class="large" value="" placeholder="City/Province"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <h4>Warehouse Address 4:</h4> </label>
                                </td>
                                <td>
                                    <input type="text" name="wh_st4" class="large" value="" placeholder="Street/Barangay"/>
                                </td>

                                <td>
                                    <input type="text" name="wh_city4" class="large" value="" placeholder="Municipality"/>
                                </td>
                                <td>
                                    <input type="text" name="wh_prov4" class="large" value="" placeholder="City/Province"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <h4>Warehouse Address 5:</h4> </label>
                                </td>
                                <td>
                                    <input type="text" name="wh_st5" class="large" value="" placeholder="Street/Barangay"/>
                                </td>

                                <td>
                                    <input type="text" name="wh_city5" class="large" value="" placeholder="Municipality"/>
                                </td>
                                <td>
                                    <input type="text" name="wh_prov5" class="large" value="" placeholder="City/Province"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <h4> Is Payable Online?:</h4> </label>
                                </td>
                                <td>
                                    <select name="payable_online" id="payable_online" onchange="apply(this.value)" >
                                        <option value="NO">NO</option>
                                        <option value="YES">YES</option>
                                    </select>
                                </td>
                            </tr>


                            <tr><td><i><h5 style="color:red;">To be filled-out only if the answer is yes</h5></i></td></tr>
                            <tr>
                                <td>

                                    <label>
                                        <h4>Bank :</h4> </label>
                                </td>
                                <td>
                                    <input type="text" name="bank"  id="bank" class="large" value="" disabled="true"/>

                                </td>





                            </tr>

                            <tr>
                                <td>

                                    <label>
                                        <h4>Acct Name :</h4> </label>
                                </td>
                                <td>
                                    <input type="text" name="acct_name" id="acct_name" class="large" value="" disabled="true" />

                                </td>





                            </tr>
                            <tr>
                                <td>

                                    <label>
                                        <h4>Acct No. :</h4> </label>
                                </td>
                                <td>
                                    <input type="text" name="acct_no" id="acct_no" class="large" value="" disabled="true"/>

                                </td>





                            </tr>


                            <tr>
                                <td>

                                </td>
                                <td>
                                    <input type="submit" value="Save New Supplier"/>
                                </td>
                            </tr>

                        </table>
                    </form>
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>

</body>
</html>
