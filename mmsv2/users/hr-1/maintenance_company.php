<!DOCTYPE html>
<html lang="en">
    <script type="text/javascript" src="validation/jquery.min.js"></script>
    <link rel="stylesheet" href="validation/bootstrap.css"/>
    <link rel="shortcut icon" type="image/x-icon" href="../../images/logo.png" />

    <style>
         .data{
            font-size: 15px;
        }
        #company_name{
            height: 30px;
            width: 100px;
        }
        #description{
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
                                    <td class="header1" colspan="4"><center>Company<br></center></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><hr></td>
                                </tr>
                                <tr id="datas">
                                    <td colspan="4"><center><br><br>Company Name: <input type="text" id="company_name" required> Description: <input type="text" id="description" required>
                                        Type: <select id="type" >
                                            <option value=" " selected disabled>Select</option>
                                            <option value="1">Company</option>
                                            <option value="0">Agency</option>
                                        </select>
                                        <br>Address: <input type="text" id="address" style="width:300px;">&nbsp;&nbsp;Gov. #: <textarea id="gov_no" style="width:300px;" rows="3"></textarea>
                                        <br><button class="btn btn-primary" id="save">Save</button> | <button class="btn btn-danger" id="cancel">Cancel</button></center><br><br><br><br></td>
                                </tr>
                            </table>
                            <input type="hidden" id="emp_num">
                            <input type="hidden" id="update_id">
                            <table width="90%">
                                <tr id="add_company">
                                    <td colspan="4" align="right"><b>Add Company</b><input type="image" src="../../images/button/add_icon.png" height="40" width="40" class="add_company"><br><br><br></td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="hidden" id="company_id">
                                        <table  class="data display datatable">
                                            <thead>
                                                <tr class="data">
                                                    <th class="data">Company ID</th>
                                                    <th class="data">Name</th>
                                                    <th class="data">Description</th>
                                                    <th class="data">Address</th>
                                                    <th class="data">Gov. #</th>
                                                    <th class="data">Type</th>
                                                    <th class="data" width="130px">Action</th>	
                                                </tr>
                                            </thead>
                                            <?php
                                                $sql_company = mysql_query("SELECT * from company WHERE status=''") or die(mysql_error());
                                                while($row_company = mysql_fetch_array($sql_company)){
                                                    $num = 1;
                                                    if($row_company['type'] == 1){
                                                        $type = 'Company';
                                                    }else{
                                                        $type = 'Agency';
                                                    }
                                                    echo '<tr>
                                                            <td class="data">'.$row_company['company_id'].'</td>
                                                            <td class="data">'.strtoupper($row_company['name']).'</td>
                                                            <td class="data">'.strtoupper($row_company['description']).'</td>
                                                            <td class="data">'.strtoupper($row_company['address']).'</td>
                                                            <td class="data">'.strtoupper($row_company['gov_no']).'</td>
                                                            <td class="data">'.strtoupper($type).'</td>
                                                            <td class="data">';
                                                                echo '<input type="image" class="edit"  id="edit_'.$row_company['company_id'].'" src="../../images/button/edit_icon.png" width="40" height="40"> | <input type="image" class="cancel" title="Do you want to delete this company?" src="../../images/button/delete_icon.png" width="40" height="40" id="'.$row_company['company_id'].'">';
                                                                echo '</td>
                                                    </tr>';?>
                                                <?php
                                                $num++;
                                                }
                                            ?>
                                        </table>
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
                    $('#add_company').show(600);
                    $('#save').html('Save');
                    $('#company_name').val('');
                    $('#description').val('');
                    $('#address').val('');
                    $('#gov_no').val('');
                    $('#type').val('');
                }else if(action2 == 'Save'){
                    var company_name = escape($('#company_name').val());
                    var description = escape($('#description').val());
                    var address = escape($('#address').val());
                    var gov_no = escape($('#gov_no').val());
                    var type = $('#type').val();
                    if(company_name != '' && description != '' && address != '' && gov_no != '' && (type == '1' || type == '0')){
                        var dataX = 'company_name=' + company_name + '&description=' + description + '&type=' + type + '&address=' + address + '&gov_no=' + gov_no + '&action=save';
                            $.ajax({
                                url: 'process/maintenance_edit.php',
                                type: 'POST',
                                data: dataX,
                                success: function(){
                                    location.replace("maintenance_company.php?active=maintenance&http=200");
                                }
                            });
                    }else{
                        alert("Please fill out all fields.");
                    }
                    
                }else if(action2 == 'Update'){
                    var company_name = escape($('#company_name').val());
                    var description = escape($('#description').val());
                    var address = escape($('#address').val());
                    var gov_no = escape($('#gov_no').val());
                    var type = $('#type').val();
                    var company_id = $('#update_id').val();
                    
                    if(company_name != '' && description != '' && address != '' && gov_no != '' && (type == '1' || type == '0')){
                        var dataX = 'company_name=' + company_name + '&description=' + description + '&type=' + type + '&address=' + address + '&gov_no=' + gov_no +  '&company_id=' + company_id + '&action=update';
                            $.ajax({
                                url: 'process/maintenance_edit.php',
                                type: 'POST',
                                data: dataX,
                                success: function(){
                                    location.replace("maintenance_company.php?active=maintenance&http=200");
                                }
                            });
                    }
                }
        });
            
          $('input[type*="image"]').click(function(){
               var clas = $(this).attr('class');
               if(clas == 'cancel'){
                  var id = $(this).attr('id');
                  $('#company_id').val(id);
                  var first = $('#' + id).confirmation({
                    onShow: function(reponse) {
                        console.log('Start show event');
                    }
                });
               }else if(clas == 'edit'){
                    var id = $(this).attr('id');
                    var company_id = id.split("_");
                    $('#add_company').hide();
                    $('#update_id').val(company_id[1]);
                    var dataX = 'company_id=' + company_id[1] + '&action=edit';
                        $.ajax({
                            type: 'POST',
                            data: dataX,
                            url: 'process/maintenance_edit.php',
                            success: function(data){
                                var data_split = data.split("~");
                                /*if(data_split[2] == '1'){
                                    var type = 'Company';
                                }*/ $('#company_name').val(data_split[0]);
                                    $('#description').val(data_split[1]);
                                    $('#type').val(data_split[2]);
                                    $('#address').val(data_split[3]);
                                    $('#gov_no').val(data_split[4]);
                            }
                        });
                    $('#datas').show(300);
                    $('#save').html('Update');
               }else if(clas == 'add_company'){
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
