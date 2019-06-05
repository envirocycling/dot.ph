<!DOCTYPE html>
<html lang="en">
    <link rel="stylesheet" href="validation/bootstrap.css"/>
    <script type="text/javascript" src="validation/jquery.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="../../images/logo.png" />
    <style>
         .data{
            font-size: 15px;
        }
    </style>
    
    <body>
        <?php include 'layout/header.php'; ?>
        <!-- Start home section -->
        <div id="home">

            <!-- Start cSlider -->
            <div id="da-slider" class="da-slider"></div>
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
                            <input type="hidden" id="emp_num">
                            <?php
                                $sql_branch = mysql_query("SELECT * from branches");
                                while($row_branch = mysql_fetch_array($sql_branch)){
                                    echo $row_branch['branch_id'].'-'.strtoupper($row_branch['branch_name']).'<br>';
                                }
                                    $sql_users = mysql_query("SELECT * from users") or die(mysql_error());
                            ?>
                            <table width="65%">
                                <tr>
                                    <td>
                                        <table  class="data display datatable">
                                            <thead>
                                                <tr class="data">
                                                    <th class="data">User ID</th>
                                                    <th class="data">Emp#</th>
                                                    <th class="data">Username</th>
                                                    <th class="data">Password</th>
                                                    <th class="data">Branch</th>
                                                    <th class="data">Agency</th>
                                                    <th class="data">Type</th>
                                                    <th class="data">Status</th>
                                                    <th class="data">E-Signature</th>
                                                    <th class="data" width="160px">Action</th>	
                                                </tr>
                                            </thead>
                                            <input type="hidden" id="user_id">
                                            <?php
                                            $num = 0;
                                                while($row_users = mysql_fetch_array($sql_users)){  
                                                    echo '<tr class="data2">
                                                            <td>'.$row_users['user_id'].'</td>
                                                            <td>'.$row_users['emp_num'].'</td>
                                                            <td>'.$row_users['username'].'</td>
                                                            <td>'.$row_users['password'].'</td>
                                                            <td>'.$row_users['branch_id'].'</td>
                                                            <td>'.$row_users['agency_id'].'</td>
                                                            <td>'.$row_users['user_type'].'</td>
                                                            <td>'.$row_users['status'].'</td>';
                                                            $signature = '../../images/signature/'.$row_users['emp_num'].'.png';
                                                            if(file_exists($signature)){
                                                                echo '<td><img src="../../images/signature/'.$row_users['emp_num'].'.png" width="50px"></td>';
                                                            }else{
                                                            echo '<td></td>';
                                                            }
                                                            echo '<td>';
                                                            echo '<input type="image" src="../../images/button/edit_icon.png" title="Edit" class="edit" id="edit_'.$row_users['user_id'].'" width="40" height="40"> | <input class="delete" title="Do you want to delete this employee?" data-id="'.$num.'" id="'.$row_users['user_id'].'" type="image" src="../../images/button/delete_icon.png" width="40" height="40"></td>';
                                                    echo '</tr>';
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
                var first = $('.delete').confirmation({
                onShow: function() {
                    console.log('Start show event');
                }
                });
            });
            
          $('input[type*="image"]').click(function(){
               var clas = $(this).attr('class');
               if(clas == 'delete'){
                  var id = $(this).attr('id');
                  $('#user_id').val(id);
                  var first = $('#' + id).confirmation({
                    onShow: function(reponse) {
                        console.log('Start show event');
                    }
                });
                }else if(clas == 'edit'){
                  var txt_id = $(this).attr('id');
                  var id = txt_id.split("_");
                  window.top.location.href="view_edit_user.php?user_id="+id[1]+"&active=view";
               }
            });
         
        </script>
        <link rel='stylesheet' href='pop-up/jAlert.css'>
	<script src='pop-up/jAlert.js'></script>
	<script src='pop-up/jAlert-functions.js'></script>
        <script src="pop-up/jAlert.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
        --><script src="pop-up/confirmation.js"></script>
<script>
	$(function(){
            //for the data-jAlerts
            $.jAlert('attach');
        });
        
</script>

