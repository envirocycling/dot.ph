<!DOCTYPE html>
<html lang="en">
    <script type="text/javascript" src="validation/jquery.min.js"></script>
    <link rel="stylesheet" href="validation/bootstrap.css"/>
    <link rel="shortcut icon" type="image/x-icon" href="../../images/logo.png" />
    <style>
         .data{
            font-size: 15px;
        }
        #branch_name, #zipcode, #address{
            height: 30px;
        }
    </style>
        
    <body>
        <?php  include 'layout/header.php'; ?>
        <!-- Start home section -->
        <div id="home">

            <!-- Start cSlider -->
            <div id="da-slider" class="da-slider">
                <div class="triangle"></div>
                <!-- mask elemet use for masking background image -->
                <div class="mask"></div>
                <!-- All slides centred in container element -->

                <div class="container">

                    <div class="title">
                        <?php
                        include 'layout/menu.php';
                        ?>
                        <link rel="stylesheet" type="text/css" href="css/override.css">
                    </div>
                    <!--Main body-->
                    <div class="main">
                        <br><br><center>
                            <table width='100%'>
                                <tr>
                                    <td class="header1" colspan="4"><center>Branch<br></center></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><hr></td>
                                </tr>
                                <tr id="datas">
                                    <td colspan="4"><center><br><br>Branch Name: <input type="text" id="branch_name" required>
                                        Comapany Name: <select id="company_name" >
                                            <option value=" " selected disabled>Select</option>
                                            <?php
                                                $sql_company = mysql_query("SELECT * from company WHERE status=''") or die(mysql_error());
                                                while($row_company = mysql_fetch_array($sql_company)){
                                                    echo '<option value="'.$row_company['company_id'].'">'.$row_company['name'].'</option>';
                                                }
                                            ?>
                                        </select>
                                        <br>Address: <input type="text" id="address" required>&nbsp;&nbsp;Zipcode: <input type="number" id="zipcode" onKeyPress="if(this.value.length==4) return false;" required>
                                        <br><button class="btn btn-primary" id="save">Save</button> | <button class="btn btn-danger" id="cancel">Cancel</button></center><br><br><br><br></td>
                                </tr>
                            </table>
                            <input type="hidden" id="update_id">
                            <div id="myTable_target">
                            <table width="80%" id="myTable">
                                <tr id="add_branch">
                                    <td colspan="4" align="right"><b>Add Branch</b><input type="image" src="../../images/button/add_icon.png" height="40" width="40" class="add_branch"><br><br><br></td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="hidden" id="branch_id">
                                        <table  class="data display datatable">
                                            <thead>
                                                <tr class="data">
                                                    <th class="data">Branch ID</th>
                                                    <th class="data">Branch Name</th>
                                                    <th class="data">Branch Address</th>
                                                    <th class="data">Branch Zipcode</th>
                                                    <th class="data">Company</th>
                                                    <th class="data" width="130px">Action</th>	
                                                </tr>
                                            </thead>
                                            <?php
                                                $sql_branch = mysql_query("SELECT * from branches WHERE status=''") or die(mysql_error());
                                                while($row_branch= mysql_fetch_array($sql_branch)){
                                                    $while_company = mysql_query("SELECT * from company WHERE company_id ='".$row_branch['company_id']."'") or die(mysql_error());
                                                    $row_companywhile = mysql_fetch_array($while_company);
                                                    echo '<tr>
                                                            <td class="data">'.strtoupper($row_branch['branch_id']).'</td>
                                                            <td class="data">'.strtoupper($row_branch['branch_name']).'</td>
                                                            <td class="data">'.strtoupper($row_branch['address']).'</td>
                                                            <td class="data">'.strtoupper($row_branch['zipcode']).'</td>
                                                            <td class="data">'.strtoupper($row_companywhile['description']).'</td>
                                                            <td class="data">';
                                                                echo '<input type="image" class="edit"  id="edit_'.$row_branch['branch_id'].'" src="../../images/button/edit_icon.png" width="40" height="40"> | <input type="image" class="cancel" title="Do you want to delete this company?" src="../../images/button/delete_icon.png" width="40" height="40" id="'.$row_branch['branch_id'].'">';
                                                                echo '</td>
                                                    </tr>';?>
                                                <?php
                                                }
                                            ?>
                                        </table>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </center><br><br><br>
                    </div>
                    <!--Main body end-->
                    
                </div>

            </div>
        </div>
        <!-- End home section -->
        <!-- Service section start -->
        <div class="section primary-section" id="service">
            <div class="container">
            </div>
        </div>
        <!-- Service section end -->

        <?php include 'layout/footer.php'; ?>

        <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <script type="text/javascript" src="js/jquery.ui.core.min.js"></script>
    <script src="js/setup.js" type="text/javascript"></script>
	<script type="text/javascript">
            $(document).ready(function () {
                setupLeftMenu();
                $('.datatable').dataTable();
                setSidebarHeight();
                var first = $('.cancel').confirmation({
                onShow: function() {
                    console.log('Start show event');
                }
                });
                
                $('#datas').hide();
            });
            
            
        $('button').click(function(){
                var action = $(this).attr("id");
                var action2 = $('#save').html();
                if(action == 'cancel'){
                    $('#datas').hide(100);
                    $('#add_branch').show(600);
                    $('#save').html('Save');
                    $('#company_name').val('');
                    $('#branch_name').val('');
                    $('#address').val('');
                    $('#zipcode').val('');
                }else if(action2 == 'Save'){
                    var company_name = Number($('#company_name').val());
                    var zipcode = Number($('#zipcode').val());
                    var branch_name = ($('#branch_name').val()).replace("&","ampersand").replace("ñ","**").replace("Ñ","(*)");
                    var address = ($('#address').val()).replace("&","ampersand").replace("ñ","**").replace("Ñ","(*)");
                    if(company_name > 0 && branch_name != ''){
                        var dataX = 'company_name=' + company_name + '&branch_name=' + branch_name + '&zipcode=' + zipcode + '&address=' + address + '&action=save';
                            $.ajax({
                                url: 'process/maintenance_edit_branch.php',
                                type: 'POST',
                                data: dataX,
                                success: function(){
                                    location.replace("maintenance_branch.php?active=maintenance&http=200");
                                }
                            });
                    }
                    
                }else if(action2 == 'Update'){
                    var company_name = Number($('#company_name').val());
                    var zipcode = Number($('#zipcode').val());
                    var branch_name = ($('#branch_name').val()).replace("&","ampersand").replace("ñ","**").replace("Ñ","(*)");
                    var address = ($('#address').val()).replace("&","ampersand").replace("ñ","**").replace("Ñ","(*)");
                    var branch_id = $('#update_id').val();
                    
                    if(company_name != '' || branch_name != ''){
                       var dataX = 'branch_id=' + branch_id + '&company_name=' + company_name + '&branch_name=' + branch_name + '&zipcode=' + zipcode + '&address=' + address + '&action=update';
                        
                            $.ajax({
                                url: 'process/maintenance_edit_branch.php',
                                type: 'POST',
                                data: dataX,
                                success: function(){
                                    location.replace("maintenance_branch.php?active=maintenance&http=200");
                                }
                            });
                    }
                }
        });
            
          $('input[type*="image"]').click(function(){
               var clas = $(this).attr('class');
               if(clas == 'cancel'){
                  var id = $(this).attr('id');
                  $('#branch_id').val(id);
                  var first = $('#' + id).confirmation({
                    onShow: function(reponse) {
                        console.log('Start show event');
                    }
                });
               }else if(clas == 'edit'){
                    var id = $(this).attr('id');
                    var branch_id = id.split("_");
                    $('#add_branch').hide();
                    $('#update_id').val(branch_id[1]);
                    var dataX = 'branch_id=' + branch_id[1] + '&action=edit';
                        $.ajax({
                            type: 'POST',
                            data: dataX,
                            url: 'process/maintenance_edit_branch.php',
                            success: function(data){
                                var data_split = data.split("~");
                                $('#branch_name').val(data_split[0]);
                                $('#company_name').val(data_split[1]);
                                $('#address').val(data_split[2]);
                                $('#zipcode').val(data_split[3]);
                            }
                        });
                    $('#datas').show(300);
                    $('#save').html('Update');
               }else if(clas == 'add_branch'){
                   $('#' + clas).hide();
                   $('#btn').html('Save');
                   $('#datas').show(300);
               }
            });
        </script>
        <link rel='stylesheet' href='pop-up/jAlert.css'>
	<script src='pop-up/jAlert.js'></script>
	<script src='pop-up/jAlert-functions.js'></script>
        <script src="pop-up/jAlert.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
        <script src="pop-up/confirmation.js"></script>
