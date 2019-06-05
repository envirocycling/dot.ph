<!DOCTYPE html>
<html lang="en">
    <link rel="stylesheet" href="validation/bootstrap.css"/>
    <script type="text/javascript" src="validation/jquery.min.js"></script>
    <script type="text/javascript" src="validation/formValidation.js"></script>
    <script type="text/javascript" src="validation/bootstrap.js"></script>
    <script type="text/javascript" src="validation/form_validation_regEmp.js"></script>
    
        <link rel="shortcut icon" type="image/x-icon" href="../../images/logo.png" />

    <style>
        #alert{
            width: 100%;
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
                    </div>
                    <!--Main body-->
                    <div class="main">
                        <br><br>
                        <form action="process/register_employee_pro.php?action=edit" method="post" id="defaultForm" class="form-horizontal">
                            <input type="hidden" value="<?php echo $_GET['emp_num'];?>" id="emp_num" name="emp_num">
                            <table width='100%'>
                                <tr>
                                    <td colspan="4"><span id="noti"></span></td>
                                </tr>
                                <tr>
                                    <td class="header1" colspan="4"><center>Edit Employee<br></center></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><hr></td>
                                </tr>
                                <?php
                                    $sql_currrent_emp = mysql_query("SELECT * from employees WHERE emp_num = '".$_GET['emp_num']."'") or die(mysql_error());
                                    $row_current_emp = mysql_fetch_array($sql_currrent_emp);
                                ?>
                                <!--Personal Info start-->
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Firstname<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px;" value="<?php echo $row_current_emp['firstname'];?>" placeholder="Required" name="firstname"/>
                                            </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Address<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" value="<?php echo $row_current_emp['st_brgy'];?>"  placeholder="Street & Brgy" name="address_brgy"/>
                                            </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Middlename</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px;" value="<?php echo $row_current_emp['middlename'];?>" placeholder="Optional" name="middlename"/>
                                            </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px; width: 120%;" value="<?php echo $row_current_emp['town_city'];?>" placeholder="Town/City" name="address_towncity"/>
                                            </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Lastname<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px;" value="<?php echo $row_current_emp['lastname'];?>" placeholder="Required" name="lastname"/>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px; width: 120%;" value="<?php echo $row_current_emp['province'];?>" placeholder="Province" name="address_province"/>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Birthdate<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" style="height:35px; width: 110%; margin-bottom: 10px;"  id="datetimepicker" value="<?php echo date('Y/m/d', strtotime($row_current_emp['birthdate']));?>" name="birthdate" placeholder="Required" autocomplete="off" required/>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Contact No.<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" value="<?php echo $row_current_emp['contact_no'];?>" placeholder="Required" name="contact"/>
                                            </div>
                                        <div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Civil Status<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <select type="text" class="form-control" style="height:35px; margin-bottom: 10px;" placeholder="Required" name="civil_status"/>
                                                    <option value="<?php echo $row_current_emp['civil_status'];?>" selected ><?php echo ucwords($row_current_emp['civil_status']);?></option>
                                                    <option value="single" >Single</option>
                                                    <option value="married" >Married</option>
                                                    <option value="separated" >Separated</option>
                                                    <option value="widowed" >Widowed</option>
                                                    <option value="divorced" >Divorced</option>
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                    <td> </td>
                                </tr>
                                <!--Personal Info end-->
                                <tr>
                                    <td colspan="2"><hr></td>
                                </tr>
                                <!--Second Info star-->
                                <tr hidden>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Date Hired<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                 <input type="text" style="height:35px; width: 110%; margin-bottom: 10px;"  id="datetimepicker2" value="<?php echo date('Y/m/d', strtotime($row_current_emp['date_hired']));?>" placeholder="Required" name="date_hired" autocomplete="off" required/>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Date Start<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" style="height:35px; width: 120%; margin-bottom: 10px;" value="<?php echo date('Y/m/d', strtotime($row_current_emp['date_start']));?>" id="datetimepicker3" placeholder="Required" name="date_start" autocomplete="off" required/>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr hidden>
                                    <td>
                                        <div class="form-group">
                                             <label class="col-sm-3 control-label">Company</label>
                                            <div class="col-sm-5">
                                                <select class="form-control" style="height:35px; margin-bottom: 10px;" placeholder="Required" name="company"/>
                                                    <?php
                                                    $sql_current_comp = mysql_query("SELECT * from company WHERE company_id = '".$row_current_emp['company_id']."'") or die(mysql_error());
                                                    $row_curren_comp = mysql_fetch_array($sql_current_comp);
                                                    ?>
                                                    <option value="<?php echo $row_curren_comp['company_id'];?>"><?php echo $row_curren_comp['name'];?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                             <label class="col-sm-3 control-label">Branch</label>
                                            <div class="col-sm-5">
                                                <select class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" placeholder="Required" name="branch"/>
                                                    <?php
                                                        $sql_current_branch = mysql_query("SELECT * from branches WHERE branch_id = '".$row_current_emp['branch_id']."'") or die(mysql_error());
                                                        $row_curren_branch = mysql_fetch_array($sql_current_branch);
                                                        echo '<option value="'.$row_curren_branch['branch_id'].'">'.$row_curren_branch['branch_name'].'</option>';
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr hidden>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Position<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <select name="position" class="form-control" style="height:35px; width: 110%; margin-bottom: 10px;">
                                                    <?php
                                                        $sql_current_position = mysql_query("SELECT * from positions WHERE p_id = '".$row_current_emp['position_id']."'") or die(mysql_error());
                                                        $row_curren_position = mysql_fetch_array($sql_current_position);
                                                        echo '<option value="'.$row_curren_position['p_id'].'">'.$row_curren_position['position'].'</option>';
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Status<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <select class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" name="emp_status"/>
                                                    <?php
                                                        $sql_current_stat = mysql_query("SELECT * from employment_status WHERE e_id = '".$row_current_emp['status_id']."'") or die(mysql_error());
                                                        $row_curren_stat = mysql_fetch_array($sql_current_stat);
                                                        echo '<option value="'.$row_curren_stat['e_id'].'">'.$row_curren_stat['code'].'</option>';
                                                    ?>
                                                </select>
                                            </div>
                                        <div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Stay In<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <select type="text" class="form-control" style="height:35px; margin-bottom: 10px;" placeholder="Required" name="stayin"/>
                                                <option value="<?php echo $row_current_emp['stayin'];?>" disabled><?php echo $row_current_emp['stayin'];?></option>
                                                    <option value="Yes" >Yes</option>
                                                    <option value="No" >No</option>
                                                </select>
                                            </div>
                                        <div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">TIN<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" value="<?php echo $row_current_emp['tin'];?>" placeholder="Required" name="tin"/>
                                            </div>
                                        <div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">SSS No.<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px;" value="<?php echo $row_current_emp['sss_no'];?>" placeholder="Required" name="sss"/>
                                            </div>
                                        <div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">PHIC No.<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" value="<?php echo $row_current_emp['phic_no'];?>" placeholder="Required" name="phic"/>
                                            </div>
                                        <div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">HDMF No.<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px;" placeholder="Required" value="<?php echo $row_current_emp['hdmf_no'];?>" name="hdmf"/>
                                            </div>
                                        <div>
                                    </td>
                                    <td>
                                        <div class="form-group" hidden>
                                            <label class="col-sm-3 control-label">Regularization Date</label>
                                            <div class="col-sm-5">
                                                <input type="text" style="height:35px; width: 120%; margin-bottom: 10px;"  id="datetimepicker4" placeholder="if any" name="date_regularization" value="<?php if(strtotime($row_current_emp['date_regularization']) > 0){echo date('Y/m/d', strtotime($row_current_emp['date_regularization']));}?>" autocomplete="off" disabled/>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><br><br><br><br><center>
                                                <input type="submit" class="btn btn-primary" value="Submit Request to Edit"></center>
                                    </td>
                                </tr>
                                <!--Second Info star-->
                                <tr>
                                    <td></td>
                                </tr>
                            </table>
                        </form>
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
<link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css"/>
<script src="js/jquery.datetimepicker.full_employee.js"></script>
<script>
//date picker1 start
                            $('#datetimepicker').datetimepicker({
                                dayOfWeekStart: 1,
                                lang: 'en',
                                timepicker: false,
                                format:'Y/m/d',
                                formatDate:'Y/m/d',
                                disabledDates: ['1986/01/08', '1986/01/09', '1986/01/10'],
                                startDate: '1940'
                            });
                            $('#datetimepicker').datetimepicker({value: '', step: 30});
//date picker1 end

//date picker2 start
                            $('#datetimepicker2').datetimepicker({
                                dayOfWeekStart: 1,
                                lang: 'en',
                                timepicker: false,
                                format:'Y/m/d',
                                formatDate:'Y/m/d',
                                startDate: '1940'
                            });
                            $('#datetimepicker2').datetimepicker({value: '', step: 30});
//date picker1 end

//date picker2 start
                            $('#datetimepicker3').datetimepicker({
                                dayOfWeekStart: 1,
                                lang: 'en',
                                timepicker: false,
                                format:'Y/m/d',
                                formatDate:'Y/m/d',
                                startDate: '1940'
                            });
                            $('#datetimepicker3').datetimepicker({value: '', step: 30});
                            
                            $('#datetimepicker4').datetimepicker({
                                dayOfWeekStart: 1,
                                lang: 'en',
                                timepicker: false,
                                format:'Y/m/d',
                                formatDate:'Y/m/d',
                                startDate: '1940'
                            });
                            $('#datetimepicker4').datetimepicker({value: '', step: 30});
//date picker1 end
</script>

