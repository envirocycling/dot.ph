<!DOCTYPE html>
<html lang="en">
    <link rel="stylesheet" href="validation/bootstrap.css"/>
    <script type="text/javascript" src="validation/jquery.min.js"></script>
    <script type="text/javascript" src="validation/formValidation.js"></script>
    <script type="text/javascript" src="validation/bootstrap.js"></script>
    <script type="text/javascript" src="validation/form_validation_updateaccount.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="../../images/logo.png" />

    <style>
        .data{
            font-size: 15px;
        }
        #branch_name{
            height: 30px;
        }
    </style>

    <body>
        <?php include 'layout/header.php'; ?>
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
                        <script>
                            $(document).ready(function () {
                                var user_type = $('select[name="user_type"]').val();

                                    if (user_type === '6') {
                                        $('#agency').attr('hidden', false);
                                        $('#branchs').attr('hidden', true);
                                        $('#branch').attr('hidden', true);
                                    } else {
                                        $('#agency').attr('hidden', true);
                                        $('#branch').attr('hidden', false);
                                        $('#branchs').attr('hidden', false);
                                    }
                                
                                $('.drp_branch').hide();
                                var input_ctr = Number($('#input_ctr').val());
                                var f_ctr = 1;
                                while(f_ctr <= input_ctr){
                                    $('#branch' + f_ctr).show();
                                    f_ctr++;
                                }
                                
                                $('input[name="add"]').click(function(){
                                    var input_ctr = Number($('#input_ctr').val());
                                    var ctr = 1;
                                    if(input_ctr < 5){
                                        var ctr_add = input_ctr + 1;
                                        $('#input_ctr').val(ctr_add);
                                    }
                                    
                                    var new_input_ctr = Number($('#input_ctr').val());
                                    $('#branch' + new_input_ctr).show();
                                });

                                $('select[name="user_type"]').change(function () {
                                    var user_type = $(this).val();

                                    if (user_type === '6') {
                                        $('#agency').attr('hidden', false);
                                        $('#branch').attr('hidden', true);
                                        $('#branchs').attr('hidden', true);
                                    } else {
                                        $('#agency').attr('hidden', true);
                                        $('#branch').attr('hidden', false);
                                        $('#branchs').attr('hidden', false);
                                    }
                                    
                                });
                            });
                        </script>
                        <link rel="stylesheet" type="text/css" href="css/override.css">
                    </div>
                    <!--Main body-->
                    <div class="main">
                        <?php
                        if (isset($_POST['update'])) {
                            $username = $_POST['username'];
                            $password = $_POST['password'];
                            $user_type = $_POST['user_type'];
                            $input_ctr = $_POST['input_ctr'];
                            $emp_num = $_POST['employee'];
                            $ctr_input = 1;
                            $branch = '';
                            $agency = '';
                            if (!is_numeric($username)) {
                                $sql_chk = mysql_query("SELECT * from users WHERE username='$username' and user_id != '".$_GET['user_id']."'")or die(mysql_error());
                                if (mysql_num_rows($sql_chk) == 0) {
                                    if($user_type != '6'){
                                        while($ctr_input <= $input_ctr){
                                            $val= $_POST['branch'.$ctr_input];
                                            if(!empty($val)){
                                                $branch .= $val;
                                            }
                                            $ctr_input++;
                                        }
                                    }else{
                                        $agency = $_POST['agency']; 
                                    }
                                    if (mysql_query("UPDATE users SET username='$username', password='$password', emp_num='$emp_num', agency_id='$agency', branch_id='$branch', user_type='$user_type' WHERE user_id='".$_GET['user_id']."'") or die(mysql_error())) {
                                        echo '<script>
                                                    location.replace("view_user.php?status=active&active=view&http=200");
                                               </script>';
                                    } else {
                                        echo '<script>
                                                        location.replace("view_user.php?status=active&active=view&http=400");
                                                   </script>';
                                    }
                                } else {
                                    @$_SESSION['up_err'] .= 'Username already exist. ';
                                }
                            } else {
                                @$_SESSION['up_err'] .= 'Username must not a number. ';
                            }
                        } else {
                            unset($_SESSION['err']);
                            unset($_SESSION['up_err']);
                        }
                        
                        $sql_users = mysql_query("SELECT * from users WHERE user_id='".$_GET['user_id']."'") or die(mysql_errro());
                        $row_users = mysql_fetch_array($sql_users);
                        
                        $curr_emp = mysql_query("SELECT * from employees WHERE emp_num = '".$row_users['emp_num']."'") or die(mysql_error());
                        $row_curr_emp = mysql_fetch_array($curr_emp);
                        
                        $sql_agency = mysql_query("SELECT * from company WHERE company_id='".$row_users['agency_id']."'");
                        $row_agency = mysql_fetch_array($sql_agency);
                        ?>
                        <br><br><center>
                            <table width='100%'>
                                <tr>
                                    <td class="header1" colspan="4"><center>Register User<br></center></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><hr></td>
                                </tr>
                                <tr>
                                    <td><br><br></td>
                                </tr>
                            </table>
                            <form id="defaultForm" class="form-horizontal" method="post"><br>
                                <?php echo '<font color="red"><i>' . @$_SESSION['up_err'] . '</i></font>'; ?>
                                <table width="80%">
                                    <tr>
                                        <td align="right">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Username<span class="required">*</span></label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" style="height:35px;" placeholder="Required" name="username" value="<?php echo $row_users['username'] ;?>" autocomplete="off" required/>
                                                </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Password<span class="required">*</span></label>
                                                <div class="col-sm-5">
                                                    <input type="password" class="form-control" style="height:35px;" placeholder="Required" value="<?php echo $row_users['password'] ;?>" name="password" required/>
                                                </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Restriction Level<span class="required">*</span></label>
                                                <div class="col-sm-5">
                                                    <?php
                                                    echo '<select class="form-control" style="height:35px;" name="user_type" required/>';
                                                    echo '<option value="'.$row_users['user_type'].'" selected>'.$row_users['user_type'].'</option>';

                                                    $sql_usertype = mysql_query("SELECT distinct(user_type) from users WHERE user_type != '".$row_users['user_type']."' ORDER by user_type Asc") or die(mysql_error());
                                                    while ($row_usertype = mysql_fetch_array($sql_usertype)) {
                                                        echo '<option value="' . $row_usertype['user_type'] . '">' . $row_usertype['user_type'] . '</option>';
                                                    }

                                                    echo '</select>';
                                                    ?>
                                                </div>
                                        </td>
                                    </tr>
                                    
                                    <tr id="branchs" hidden>
                                        <td align="right">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Employee Name<span class="required">*</span></label>
                                                <div class="col-sm-5">
                                                    <select name="employee" class="form-control" style="height:35px;" required>
                                                        <?php
                                                        echo '<option value="'.$row_curr_emp['emp_num'].'" selected>' . strtoupper($row_curr_emp['lastname'] . ', ' . $row_curr_emp['firstname']) . '</option>';
                                                        $sql_employee = mysql_query("SELECT * from employees ORDER BY lastname Asc") or die(mysql_error());
                                                        while ($row_employee = mysql_fetch_array($sql_employee)) {
                                                            $sql_users = mysql_query("SELECT * from users WHERE emp_num='" . $row_employee['emp_num'] . "'") or die(mysql_error());
                                                            if (mysql_num_rows($sql_users) == 0) {
                                                                echo '<option value="' . $row_employee['emp_num'] . '">' . strtoupper($row_employee['lastname'] . ', ' . $row_employee['firstname']) . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                        </td>
                                    </tr>
                                    <tr id="branch" hidden>
                                        <td align="right">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Branch<span class="required">*</span></label>
                                                <div class="col-sm-5">
                                                    <?php
                                                    $ctr = 5;
                                                    $ctr_chk = 1;
                                                    $arr_count = str_replace('(','',explode(')',$row_users['branch_id']));
                                                    echo '<input type="hidden" value="'.(count($arr_count)-1).'" id="input_ctr" name="input_ctr">';
                                                    while ($ctr_chk <= $ctr) {
                                                        $ctr_chk_arr = $ctr_chk - 1;
                                                        echo '<span class="drp_branch" id="branch' . $ctr_chk . '">';
                                                        echo '<select class="form-control" style="height:35px;" name="branch' . $ctr_chk . '">';
                                                        if(!empty($arr_count[$ctr_chk_arr])){
                                                            echo '<option value="('.$arr_count[$ctr_chk_arr].')">'.$arr_count[$ctr_chk_arr].'</option>';
                                                        }else{
                                                            echo '<option value="">Please Select</option>';
                                                        }
                                                        $sql_branches = mysql_query("SELECT * from branches WHERE status=''") or die(mysql_error());
                                                        while ($row_branches = mysql_fetch_array($sql_branches)) {
                                                            echo '<option value="(' . $row_branches['branch_id'] . ')">' . $row_branches['branch_name'] . '</option>';
                                                        }

                                                        echo '</select>';
                                                        echo '<br/><br/>';
                                                        echo '</span>';
                                                        $ctr_chk++;
                                                    }
                                                    echo '<input type="button" value="Add" name="add">';
                                                    ?>
                                                </div>
                                        </td>
                                    </tr>
                                    <tr id="agency" hidden>
                                        <td align="right">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Agency<span class="required">*</span></label>
                                                <div class="col-sm-5">
                                                    <?php
                                                    echo '<select class="form-control" style="height:35px;" name="agency"/>';
                                                    echo '<option value="'.$row_agency['company_id'].'">'.$row_agency['name'].'</option>';
                                                    $sql_company = mysql_query("SELECT * from company WHERE status='' and type=0 and company_id!= '".$row_agency['company_id']."'") or die(mysql_error());
                                                    while ($row_company = mysql_fetch_array($sql_company)) {
                                                        echo '<option value="' . $row_company['company_id'] . '">' . $row_company['name'] . '</option>';
                                                    }

                                                    echo '</select>';
                                                    ?>
                                                </div>
                                        </td>
                                    </tr>
                                    <tr><td align="right">
                                            <div class="form-group">
                                                <div class="col-sm-5">
                                                    <input type="submit" class="btn btn-primary" value="Update User" name="update">
                                                </div>
                                        </td>
                                    </tr>
                                </table>
                            </form>
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
