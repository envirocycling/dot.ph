<!DOCTYPE html>
<html lang="en">
    <link rel="stylesheet" href="validation/bootstrap.css"/>
    <script type="text/javascript" src="validation/jquery.min.js"></script>
    <script type="text/javascript" src="validation/formValidation.js"></script>
    <script type="text/javascript" src="validation/bootstrap.js"></script>
    <script type="text/javascript" src="validation/form_validation_regisEmp.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="../../images/logo.png" />
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
                    </div>
                    <!--Main body-->
                    <div class="main">
                        <style>
                            .e_button:hover{
                                cursor: pointer;
                            }
                        </style>
                        <br><br>
                        <form action="process/register_employee_pro.php" id="defaultForm" class="form-horizontal" method="post" enctype="multipart/form-data">
                            <table width='100%'>
                                <tr>
                                    <td class="header1" colspan="4"><center>New Employee<br></center></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><hr></td>
                                </tr>
                                <!--Personal Info start-->
                                <tr>
                                    <td colspan="2">&nbsp;&nbsp;&nbsp;<b>Personal Information</b><br><br></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Firstname<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" placeholder="Required" name="firstname"/>
                                            </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Address<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" placeholder="Street & Brgy" name="address_brgy"/>
                                            </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Middlename</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" placeholder="Optional" name="middlename"/>
                                            </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" placeholder="Town/City" name="address_towncity"/>
                                            </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Lastname<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" placeholder="Required" name="lastname"/>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" placeholder="Province" name="address_province"/>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Birthdate<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" style="height:35px; width: 120%; margin-bottom: 10px;" class="form-control" id="datetimepicker" name="birthdate" placeholder="Required" autocomplete="off" required/>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Contact No.<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" placeholder="Required" name="contact"/>
                                            </div>
                                        <div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Civil Status<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <select type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" placeholder="Required" name="civil_status"/>
                                                    <option value="" selected disabled>Select</option>
                                                    <option value="single" >Single</option>
                                                    <option value="married" >Married</option>
                                                    <option value="separated" >Separated</option>
                                                    <option value="widowed" >Widowed</option>
                                                    <option value="divorced" >Divorced</option>
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Gender<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <select type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" name="gender"/>
                                                    <option value="" selected disabled>Select</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                            </div>
                                    </td>
                                </tr>
                                <!--Personal Info end-->
                                
                                <!--educational Info star-->
                                <tr>
                                    <td colspan="2"><hr></td>
                                </tr>
                                <tr>
                                    <td colspan="2">&nbsp;&nbsp;&nbsp;<b>Educational Attainment</b><br><br></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Tertiary</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" placeholder="if any" name="tertiary"/>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Year Graduated</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px;" placeholder="if any" name="year_tertiary"/>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Secondary<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" placeholder="Required" name="secondary"/>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Year Graduated<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px;" placeholder="Required" name="year_secondary"/>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Primary<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" placeholder="Required" name="primary"/>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Year Graduated<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px;" placeholder="Required" name="year_primary"/>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!--educational Info end-->
                                <tr>
                                    <td colspan="2"><hr></td>
                                </tr>
                                
                                <!--Second Info star-->
                                <tr>
                                    <td colspan="2">&nbsp;&nbsp;&nbsp;<b>Employment Details</b><br><br></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Date Hired<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                 <input type="text" style="height:35px; width: 120%; margin-bottom: 10px;"  id="datetimepicker2" class="form-control" placeholder="Required" name="date_hired" autocomplete="off" required/>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Orig. Hiring Date<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;"  id="datetimepicker3" placeholder="Required" name="date_start" autocomplete="off" required/>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                             <label class="col-sm-3 control-label">Company<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <select type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" placeholder="Required" name="company"/>
                                                    <option value="" selected disabled>Select</option>
                                                    <?php
                                                        $sql_company = mysql_query("SELECT * from company WHERE status=''") or die(mysql_error());
                                                        while($row_company = mysql_fetch_array($sql_company)){
                                                            echo '<option value="'.$row_company['company_id'].'">'.strtoupper($row_company['name']).'</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                             <label class="col-sm-3 control-label">Branch<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <select type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" placeholder="Required" name="branch"/>
                                                    <option value="" selected disabled>Select</option>
                                                    <?php
                                                        $sql_branch = mysql_query("SELECT * from branches WHERE status=''") or die(mysql_error());
                                                        while($row_branch = mysql_fetch_array($sql_branch)){
                                                            echo '<option value="'.$row_branch['branch_id'].'">'.ucwords($row_branch['branch_name']).'</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Position<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <select name="position" id="position" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" >
                                                    <option value="" selected disabled> Please Select</option>
                                                    <?php
                                                    $sql_position = mysql_query("SELECT * from positions WHERE status='' ORDER BY position Asc") or die (mysql_error());
                                                        while($row_position = mysql_fetch_array($sql_position)){
                                                            echo '<option value="'.$row_position['p_id'].'">'.strtoupper($row_position['position']).'</option>';
                                                        }
                                                    ?>
                          
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Rank<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <select style="height:35px; width: 120%; margin-bottom: 10px;" name="rank" class="form-control" required/>
                                                    <option value="" selected disabled>Select</option>
                                                    <?php
                                                        $sql_rank = mysql_query("SELECT * from rank WHERE status=''") or die(mysql_error());
                                                        while($row_rank = mysql_fetch_array($sql_rank)){
                                                            echo '<option value="'.$row_rank['r_id'].'">'.ucwords($row_rank['description']).'</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">&nbsp;&nbsp;Employment Status<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <select type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" placeholder="Required" name="emp_status"/>
                                                    <option value="" selected disabled>Select</option>
                                                    <?php
                                                        $sql_estat = mysql_query("SELECT * from employment_status ORDER BY description Asc") or die(mysql_error());
                                                        while($row_estat = mysql_fetch_array($sql_estat)){
                                                            echo '<option value="'.$row_estat['e_id'].'">'.ucwords($row_estat['description']).'</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Stay In<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <select type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" placeholder="Required" name="stayin"/>
                                                    <option value="" selected disabled>Select</option>
                                                    <option value="Yes" >Yes</option>
                                                    <option value="No" >No</option>
                                                </select>
                                            </div>
                                        <div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">SSS No.<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" placeholder="Required" name="sss"/>
                                            </div>
                                        <div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">PHIC No.<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" placeholder="Required" name="phic"/>
                                            </div>
                                        <div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">HDMF No.<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" placeholder="Required" name="hdmf"/>
                                            </div>
                                        <div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                                <label class="col-sm-3 control-label">TIN<span class="required">*</span></label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" placeholder="Required" name="tin"/>
                                                </div>
                                        </div>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Tax Code<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <select style="height:35px; width: 120%; margin-bottom: 10px;" class="form-control" name="tax_code" required/>
                                                    <option value="" selected disabled>Select</option>
                                                    <option value="Z">Z</option>
                                                    <option value="S / ME">S / ME</option>
                                                    <option value="ME1 / S1">ME1 / S1</option>
                                                    <option value="ME4 / S2">ME2 / S2</option>
                                                    <option value="ME3 / S3">ME3 / S3</option>
                                                    <option value="ME4 / S4">ME4 / S4</option>
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                    
                                   <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Regularization Date</label>
                                            <div class="col-sm-5">
                                                <input type="text" style="height:35px; width: 120%; margin-bottom: 10px;"  id="datetimepicker4" placeholder="if any" name="date_regularization" autocomplete="off"/>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Home Address Sketch</label>
                                            <div class="col-sm-5">
                                                <input type="file" style="height:40px; width: 120%; margin-bottom: 10px;" class="form-control" name="sketch" accept="application/pdf,image/*"/>
                                            </div>
                                        </div>
                                    </td>
                                    
                                   <td></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><hr></td>
                                </tr>
                                </table>
                                <table width="100%">
                                <tr>
                                    <td colspan="2">&nbsp;&nbsp;&nbsp;<b>Dependents (base on tax code)</b>&nbsp;&nbsp;<b><i><font color="red"><span id="dependent_mes" hidden></span></font></i></b><br><br></td>
                                </tr>
                                <?php
                                $r_dependents = 1;
                                $r_dependentCtrl = 4;
                                
                                echo '<input type="hidden" value="'.$r_dependentCtrl.'" id="r_dependentCtrl">';
                                echo '<input type="hidden" id="r_dependentCount" name="r_dependentCount">';
                                
                                while($r_dependents <= $r_dependentCtrl){
                                ?>
                                <tr id="r_dependents<?php echo $r_dependents;?>" class="r_dependentClass">
                                    <td>
                                        <div class="form-group" style=" width: 160%;">
                                            <label class="col-sm-3 control-label">Fullname<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px; width: 120%;" placeholder="Required" name="nameDependent<?php echo $r_dependents;?>" required/>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Birthdate<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" style="height:35px; width: 110%; margin-bottom: 10px;"  id="datetimepicker_<?php echo $r_dependents;?>" name="birthdateDependent<?php echo $r_dependents;?>" placeholder="Required" autocomplete="off" required/>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Relationship<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px;" placeholder="Required" name="relationship<?php echo $r_dependents;?>" required/>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                $r_dependents++;
                                }
                                ?>
                                </tr>
                                <tr>
                                    <td colspan="2"><hr></td>
                                </tr>
                                </table>
                            
                            
                                <table width="100%">
                                <tr>
                                    <td colspan="2">&nbsp;&nbsp;&nbsp;<b>Emergency Contact</b><br><br></td>
                                </tr>
                                <?php
                                $r_emergency = 1;
                                $r_emergencyCtrl = 5;
                                
                                echo '<input type="hidden" value="'.$r_emergencyCtrl.'" id="r_emergencyCtrl">';
                                echo '<input type="hidden" value="'.$r_emergency.'" id="r_emergency" name="r_emergency">';
                                
                                while($r_emergency <= $r_emergencyCtrl){
                                ?>
                                <tr id="r_emergency<?php echo $r_emergency;?>">
                                    <td>
                                        <div class="form-group" style=" width: 160%;">
                                            <label class="col-sm-3 control-label">Fullname<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px; width: 120%;" placeholder="Required" name="nameEmergency<?php echo $r_emergency;?>" required/>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Birthdate<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" style="height:35px; width: 110%; margin-bottom: 10px;"  id="datetimepickerEmer_<?php echo $r_emergency;?>" name="birthdateEmergency<?php echo $r_emergency;?>" placeholder="Required" autocomplete="off" required/>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Relationship<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px;" placeholder="Required" name="relationshipEmergency<?php echo $r_emergency;?>" required/>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="r_emergency2<?php echo $r_emergency;?>">
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Contact No.<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 35px;" placeholder="Required" name="contactEmergency<?php echo $r_emergency;?>" required/>
                                            </div>
                                        </div>
                                    </td>
                                    <td colspan="2">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Address<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 30px;" placeholder="Required" name="addressEmergency<?php echo $r_emergency;?>" required/>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                $r_emergency++;
                                }
                                ?>
                                <tr>
                                    <td colspan="3"><center><img id="add_button" src="../../images/button/add_icon.png" width="35px" height="35px" class="e_button"> &nbsp;&nbsp;&nbsp;&nbsp; <img id="minus_button" src="../../images/button/minus_icon.png" width="35px" height="35px" class="e_button"></span></center></td>
                                </tr>
                                <tr>
                                    <td colspan="3"><br><br><br><br><center>
                                                <input type="submit" class="btn btn-primary" value="Add Employee"><center><br><br>
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
//emergency start
    $(document).ready(function(){
        $('.r_dependentClass').attr('hidden',true);
        $('#minus_button').attr('hidden',true);
        var r_dependentCtrl = Number($('#r_emergencyCtrl').val());
        var ctr = 1;
       
            while(ctr <= r_dependentCtrl){
                
                if(ctr === 1){
                    $('#r_emergency2' + ctr).attr('hidden',false);
                    $('#r_emergency' + ctr).attr('hidden',false);
                }else{
                    $('#r_emergency2' + ctr).attr('hidden',true);
                    $('#r_emergency' + ctr).attr('hidden',true);
                }

                $('#datetimepickerEmer_' + ctr).datetimepicker({
                    dayOfWeekStart: 1,
                    lang: 'en',
                    timepicker: false,
                    format:'Y/m/d',
                    formatDate:'Y/m/d',
                    startDate: '1900',
                    scrollMonth : false,
                    scrollInput : false
                });
            ctr++;
            }
    });
    $('.e_button').click(function(){
        var id = ($(this).attr('id')).split('_');
        var action = id[0];
        var maxCtr = Number($('#r_emergencyCtrl').val());
        
        if(action === 'add'){
            var ctrl = Number($('#r_emergency').val()) + 1;
                $('#r_emergency2' + ctrl).attr('hidden',false);
                $('#r_emergency' + ctrl).attr('hidden',false);
                $('#r_emergency').val(ctrl);
                
                if(maxCtr == ctrl){
                    var ids = $(this).attr('id');
                    $('#' + ids).attr('hidden', true);
                }
                if(ctrl > 1 ){
                    $('#minus_button').attr('hidden', false);
                }
        }else if(action === 'minus'){
            var ctrl = Number($('#r_emergency').val());
                $('#r_emergency2' + ctrl).attr('hidden',true);
                $('#r_emergency' + ctrl).attr('hidden',true);
                
            var Newctrl = Number($('#r_emergency').val()) - 1;
            $('#r_emergency').val(Newctrl);
            
            if(ctrl > 1 ){
                    $('#add_button').attr('hidden', false);
            }
            if(Newctrl == 1){
                $('#minus_button').attr('hidden', true);
            }
        }
    });
//emergency end

//dependents start
    $('select[name="tax_code"]').change(function(){
        var selected = $('select[name="tax_code"]').val();
        var counts = selected.substr(-1);
        if($.isNumeric(counts)){
                var r_dependentCtrl = Number(counts);
                var r_dependent = 1;
                    $('.r_dependentClass').attr('hidden',true);
                    $('#r_dependentCount').val(r_dependentCtrl);
                    while(r_dependent <= r_dependentCtrl){
                        $('#r_dependents' + r_dependent).attr('hidden',false);
                       /* $('#relationship' + r_dependent).attr('required',true);
                        $('#birthdateDependent' + r_dependent).attr('required',true);*/
                        $('#datetimepicker_' + r_dependent).datetimepicker({
                            dayOfWeekStart: 1,
                            lang: 'en',
                            timepicker: false,
                            format:'Y/m/d',
                            formatDate:'Y/m/d',
                            startDate: '1900',
                            scrollMonth : false,
                            scrollInput : false
                        });
                        r_dependent++;
                    }
                    
            $('#dependent_mes').attr("hidden",false);
            $('#dependent_mes').html(counts + " dependent/s");
        }else{
            $('.r_dependentClass').attr('hidden',true);
            $('#dependent_mes').html("zero dependent");
            $('#dependent_mes').attr("hidden",false);
        }
    });
//dependents end


//date picker1 start
                            $('#datetimepicker').datetimepicker({
                                dayOfWeekStart: 1,
                                lang: 'en',
                                timepicker: false,
                                format:'Y/m/d',
                                formatDate:'Y/m/d',
                                disabledDates: ['1986/01/08', '1986/01/09', '1986/01/10'],
                                startDate: '1940',
                                scrollMonth : false,
                                scrollInput : false
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
                                startDate: '1940',
                                scrollMonth : false,
                                scrollInput : false
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
                                startDate: '1940',
                                scrollMonth : false,
                                scrollInput : false
                            });
                            $('#datetimepicker3').datetimepicker({value: '', step: 30});
                            
                            $('#datetimepicker4').datetimepicker({
                                dayOfWeekStart: 1,
                                lang: 'en',
                                timepicker: false,
                                format:'Y/m/d',
                                formatDate:'Y/m/d',
                                startDate: '1940',
                                scrollMonth : false,
                                scrollInput : false
                            });
                            $('#datetimepicker4').datetimepicker({value: '', step: 30});
//date picker1 end
</script>
<!--dropdown menu src start-->
<link href="css/select2.min.css" rel="stylesheet">
<script type="text/javascript" src="js/select2.min.js"></script>
       <style>
            #position{
                width: 300px;
		text-align:center;
                color: black;
                border-radius: 4px;
            }
        </style>
 <script>
	 $(document).ready(function () {
                $('#position').select2();
                
                $('input[name="sketch"]').change(function(){
                    var sketch =  $('input[name="sketch"]').val();
                    var arr_sketch = sketch.split('.');
                    var count_sketch = (arr_sketch.length) - 1;
                    var type = (arr_sketch[count_sketch]).toUpperCase();
                    
                    if(type!=='PDF' && type!=='JPG' && type!=='JPEG' && type!=='PNG'){
                        alert("Invalid file type. Please choose jpg, png and pdf.");
                        $('input[name="sketch"]').val('');
                    }
                });
       });
 </script>
 <!--dropdown menu src end-->

