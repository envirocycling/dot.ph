<!DOCTYPE html>
<html lang="en">
    <script type="text/javascript" src="validation/jquery.min.js"></script>
    <link rel="stylesheet" href="validation/bootstrap.css"/>
    <link rel="shortcut icon" type="image/x-icon" href="../../images/logo.png" />

    <style>
         .data{
            font-size: 15px;
        }
        #position{
            height: 30px;
            width: 300px;
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
                                    <td class="header1" colspan="4"><center>Position<br></center></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><hr></td>
                                </tr>
                                <tr id="datas">
                                    <td colspan="4"><center><br><br>Position: <input type="text" id="position" placeholder="Required" required>
                                        <br><button class="btn btn-primary" id="save">Save</button> | <button class="btn btn-danger" id="cancel">Cancel</button></center><br><br><br><br></td>
                                </tr>
                            </table>
                            <input type="hidden" id="update_id">
                            <table width="50%">
                                <tr id="add_position">
                                    <td colspan="4" align="right"><b>Add Position</b><input type="image" src="../../images/button/add_icon.png" height="40" width="40" class="add_position"><br><br><br></td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="hidden" id="position_id">
                                        <table  class="data display datatable">
                                            <thead>
                                                <tr class="data">
                                                    <th class="data">ID</th>
                                                    <th class="data">Position</th>
                                                    <th class="data" width="130px">Action</th>	
                                                </tr>
                                            </thead>
                                            <?php
                                                $sql_position = mysql_query("SELECT * from positions WHERE status=''") or die(mysql_error());
                                                while($row_position= mysql_fetch_array($sql_position)){
                                                    echo '<tr>
                                                            <td class="data">'.$row_position['p_id'].'</td>
                                                            <td class="data">'.ucwords($row_position['position']).'</td>
                                                            <td class="data">';
                                                                echo '<input type="image" class="edit"  id="edit_'.$row_position['p_id'].'" src="../../images/button/edit_icon.png" width="40" height="40"> | <input type="image" class="cancel" title="Do you want to delete this company?" src="../../images/button/delete_icon.png" width="40" height="40" id="'.$row_position['p_id'].'">';
                                                                echo '</td>
                                                    </tr>';?>
                                                <?php
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
                    $('#add_position').show(600);
                    $('#save').html('Save');
                    $('#position').val('');
                }else if(action2 == 'Save'){
                    var position = ($('#position').val()).replace("&","ampersand").replace("ñ","**").replace("Ñ","(*)");
                    if( position != ''){
                        var dataX = 'position=' + position + '&action=save';
                            $.ajax({
                                url: 'process/maintenance_edit_position.php',
                                type: 'POST',
                                data: dataX,
                                success: function(e){
                                    alert(e);
                                    if(e == ''){
                                        location.replace("maintenance_position.php?active=maintenance&http=200");
                                    }else if(e != ''){
                                        location.replace("maintenance_position.php?active=maintenance&http=400");
                                    }
                                }
                            });
                    }
                    
                }else if(action2 == 'Update'){
                    var position = ($('#position').val()).replace("&","ampersand").replace("ñ","**").replace("Ñ","(*)");
                    var p_id = $('#update_id').val();
                    
                    if(position != ''){
                        var dataX = 'position_id=' + p_id + '&position=' + position + '&action=update';
                        
                            $.ajax({
                                url: 'process/maintenance_edit_position.php',
                                type: 'POST',
                                data: dataX,
                                success: function(e){
                                    if(e == ''){
                                        location.replace("maintenance_position.php?active=maintenance&http=200");
                                    }else if(e != ''){
                                        location.replace("maintenance_position.php?active=maintenance&http=400");
                                    }
                                }
                            });
                    }
                }
        });
            
          $('input[type*="image"]').click(function(){
               var clas = $(this).attr('class');
               if(clas == 'cancel'){
                  var id = $(this).attr('id');
                  $('#position_id').val(id);
                  var first = $('#' + id).confirmation({
                    onShow: function(reponse) {
                        console.log('Start show event');
                    }
                });
               }else if(clas == 'edit'){
                    var id = $(this).attr('id');
                    var position_id = id.split("_");
                    $('#add_position').hide();
                    $('#update_id').val(position_id[1]);
                    var dataX = 'position_id=' + position_id[1] + '&action=edit';
                        $.ajax({
                            type: 'POST',
                            data: dataX,
                            url: 'process/maintenance_edit_position.php',
                            success: function(data){
                                /*if(data_split[2] == '1'){
                                    var type = 'Company';
                                }*/ $('#position').val(data);
                            }
                        });
                    $('#datas').show(300);
                    $('#save').html('Update');
               }else if(clas == 'add_position'){
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
