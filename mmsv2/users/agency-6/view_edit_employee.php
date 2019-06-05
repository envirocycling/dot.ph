<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="validation/bootstrap.css"/>
    <script type="text/javascript" src="validation/jquery.min.js"></script>
    <script type="text/javascript" src="validation/formValidation.js"></script>
    <script type="text/javascript" src="validation/bootstrap.js"></script>
    <script type="text/javascript" src="validation/form_validation_regisEmp.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="../../images/logo.png" />

    <style>
        #alert{
            width: 100%;
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
                    </div>
                    <!--Main body-->
                    <div class="main">
                        <style>
                            .e_button:hover{
                                cursor: pointer;
                            }
                            .e_buttonHi:hover{
                                cursor: pointer;
                            }
                            .attachement{
                                font-style: italic;
                                color: blue;
                                font-size: 13px;
                                font-weight: 700;
                            }
                            .e_buttonChildren:hover{
                                cursor: pointer;
                            }
                            a{
                                color: blue;
                            }
                            a:hover{
                                color: blue;
                                text-decoration: underline;
                            }
                        </style>
                        <br><br>
                        <form action="process/register_employee_pro.php" method="post" id="defaultForm" class="form-horizontal" enctype="multipart/form-data">
                            <input type="hidden" value="<?php echo $_GET['emp_num']; ?>" id="emp_num" name="emp_num">
                            <table width='100%'>
                                <tr>
                                    <td colspan="2"><span id="noti"></span></td>
                                </tr>
                                <tr>
                                    <td class="header1" colspan="2"><center>Edit Employee<br></center></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><hr></td>
                                </tr>
                                <?php
                                $sql_currrent_emp = mysql_query("SELECT * from employees WHERE emp_num = '" . $_GET['emp_num'] . "'") or die(mysql_error());
                                $row_current_emp = mysql_fetch_array($sql_currrent_emp);

                                //educational attainment start
                                $tertiary = explode('~', $row_current_emp['tertiary']);
                                $secondary = explode('~', $row_current_emp['secondary']);
                                $primary = explode('~', $row_current_emp['elementary']);


                                //educational attainment end
                                ?>
                                <!--Personal Info start-->
                                <tr>
                                    <td colspan="2">&nbsp;&nbsp;&nbsp;<b>Personal Information</b><br><br></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Firstname<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; width: 100%; margin-bottom: 10px;" placeholder="Required" value="<?php echo $row_current_emp['firstname']; ?>" name="firstname"/>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Address<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" value="<?php echo $row_current_emp['st_brgy']; ?>" placeholder="Street & Brgy" name="address_brgy"/>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Middlename</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; width: 100%; margin-bottom: 10px;" value="<?php echo $row_current_emp['middlename']; ?>" placeholder="Optional" name="middlename"/>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" value="<?php echo $row_current_emp['town_city']; ?>" placeholder="Town/City" name="address_towncity"/>
                                            </div>
                                        </div> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Lastname<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; width: 100%; margin-bottom: 10px;" value="<?php echo $row_current_emp['lastname']; ?>" placeholder="Required" name="lastname"/>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" value="<?php echo $row_current_emp['province']; ?>" placeholder="Province" name="address_province"/>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Birthdate<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" style="height:35px; width: 100%; margin-bottom: 10px;" class="form-control" value="<?php echo date('Y/m/d', strtotime($row_current_emp['birthdate'])); ?>" id="datetimepicker" name="birthdate" placeholder="Required" autocomplete="off" required/>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Contact No.<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" value="<?php echo $row_current_emp['contact_no']; ?>" placeholder="Required" name="contact"/>
                                            </div>
                                            <div>
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Civil Status<span class="required">*</span></label>
                                                            <div class="col-sm-5">
                                                                <select type="text" class="form-control" style="height:35px; width: 100%; margin-bottom: 10px;" placeholder="Required" name="civil_status"/>
                                                                <option  value="<?php echo ucwords($row_current_emp['civil_status']); ?>" selected ><?php echo ucwords($row_current_emp['civil_status']); ?></option>
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
                                                                <option  value="<?php echo ucwords($row_current_emp['gender']); ?>" selected ><?php echo ucwords($row_current_emp['gender']); ?></option>
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
                                                    <?php
                                                    @$_spouse = explode('~', $row_current_emp['spouse']);
                                                    @$_mother = explode('~', $row_current_emp['mother']);
                                                    @$_father = explode('~', $row_current_emp['father']);
                                                    ?>
                                                    <td colspan="2">&nbsp;&nbsp;&nbsp;<b>Family Background</b>&nbsp;&nbsp;<b><br><br></td>
                                                            </tr>
                                                            <tr class="spouseDetails" hidden>
                                                                <td>
                                                                    <div class="form-group" style=" width: 160%;">
                                                                        <label class="col-sm-3 control-label">Spouse's Maiden Fullname</label>
                                                                        <div class="col-sm-5">
                                                                            <input type="text" class="form-control" style="height:35px; margin-bottom: 10px; width: 120%;" name="spouseName" value="<?php echo @$_spouse[0]; ?>"/>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label">Occupation</label>
                                                                        <div class="col-sm-5">
                                                                            <input type="text" class="form-control" style="height:35px; margin-bottom: 10px;" name="spouseOccupation"  value="<?php echo @$_spouse[1]; ?>"/>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="spouseDetails" hidden>
                                                                <td colspan="2"><hr></td>
                                                            </tr>
                                                            <?php
                                                            $r_children = 1;
                                                            $r_childrenCtrl = 15;
                                                            $r_childrenCount = str_replace('[', '', explode(']', $row_current_emp['children']));
                                                            $r_childrenSize = count($r_childrenCount) - 1;
                                                            $_ctr = 0;

                                                            echo '<input type="hidden" value="' . $r_childrenCtrl . '" id="r_childrenCtrl">';
                                                            echo '<input type="hidden" id="r_childrenCount" value="' . $r_childrenSize . '" name="r_childrenCount">';

                                                            while ($r_children <= $r_childrenCtrl) {
                                                                @$_eachData = explode('~', $r_childrenCount[$_ctr]);
                                                                ?>
                                                                <tr id="r_children<?php echo $r_children; ?>" class="r_childrenClass" hidden>
                                                                    <td>
                                                                        <div class="form-group" style=" width: 160%;">
                                                                            <label class="col-sm-3 control-label">Child's Fullname</label>
                                                                            <div class="col-sm-5">
                                                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px; width: 120%;" name="childrenName<?php echo $r_children; ?>" value="<?php echo @$_eachData[0]; ?>"/>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <label class="col-sm-3 control-label">Birthdate</label>
                                                                            <div class="col-sm-5">
                                                                                <input type="text" style="height:35px; width: 110%; margin-bottom: 10px;"  id="datetimepickerChildren_<?php echo $r_children; ?>" name="childrenBirthdate<?php echo $r_children; ?>" class="myDate" autocomplete="off"  value="<?php echo @$_eachData[1]; ?>"/>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                                $r_children++;
                                                                $_ctr++;
                                                            }
                                                            ?>
                                                </tr>
                                                <tr class="spouseDetailsBtn" hidden>
                                                    <td colspan="3"><center><img id="add_buttonChildren" src="../../images/button/add_icon.png" width="35px" height="35px" class="e_buttonChildren"> &nbsp;&nbsp;&nbsp;&nbsp; <img id="minus_buttonChildren" src="../../images/button/minus_icon.png" width="35px" height="35px" class="e_buttonChildren"></span></center></td>
                                                </tr>
                                                <tr class="spouseDetailsBtn" hidden>
                                                    <td colspan="2"><hr></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-group" style=" width: 160%;">
                                                            <label class="col-sm-3 control-label">Mother's Maiden Fullname</label>
                                                            <div class="col-sm-5">
                                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px; width: 120%;" name="motherName" value="<?php echo @$_mother[0]; ?>"/>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Occupation</label>
                                                            <div class="col-sm-5">
                                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px;" name="motherOccupation" value="<?php echo @$_mother[1]; ?>"/>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-group" style=" width: 160%;">
                                                            <label class="col-sm-3 control-label">Father's Fullname</label>
                                                            <div class="col-sm-5">
                                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px; width: 120%;" name="fatherName" value="<?php echo @$_father[0]; ?>"/>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Occupation</label>
                                                            <div class="col-sm-5">
                                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px;" name="fatherOccupation" value="<?php echo @$_father[1]; ?>"/>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
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
                                                                <input type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" placeholder="if any" value="<?php echo @$tertiary[0]; ?>" name="tertiary"/>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Year Graduated</label>
                                                            <div class="col-sm-5">
                                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px;" placeholder="if any" value="<?php echo @$tertiary[1]; ?>" name="year_tertiary"/>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Secondary<span class="required">*</span></label>
                                                            <div class="col-sm-5">
                                                                <input type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" value="<?php echo @$secondary[0]; ?>" placeholder="Required" name="secondary"/>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Year Graduated<span class="required">*</span></label>
                                                            <div class="col-sm-5">
                                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px;" placeholder="Required" value="<?php echo @$secondary[1]; ?>"  name="year_secondary"/>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Primary<span class="required">*</span></label>
                                                            <div class="col-sm-5">
                                                                <input type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" value="<?php echo @$primary[0]; ?>"  placeholder="Required" name="primary"/>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Year Graduated<span class="required">*</span></label>
                                                            <div class="col-sm-5">
                                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px;" value="<?php echo @$primary[1]; ?>" placeholder="Required" name="year_primary"/>
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
                                                                <input type="text" style="height:35px; width: 100%; margin-bottom: 10px;"  id="datetimepicker2" class="form-control" value="<?php echo date('Y/m/d', strtotime($row_current_emp['date_hired'])); ?>" placeholder="Required" name="date_hired" autocomplete="off" required/>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Orig. Hiring Date<span class="required">*</span></label>
                                                            <div class="col-sm-5">
                                                                <input type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;"  id="datetimepicker3" value="<?php echo date('Y/m/d', strtotime($row_current_emp['date_start'])); ?>" placeholder="Required" name="date_start" autocomplete="off" required/>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Company<span class="required">*</span></label>
                                                            <div class="col-sm-5">
                                                                <select type="text" class="form-control" style="height:35px; width: 100%; margin-bottom: 10px;" placeholder="Required" name="company"/>
                                                                <?php
                                                                $sql_company1 = mysql_query("SELECT * from company WHERE company_id='" . $row_current_emp['company_id'] . "'") or die(mysql_error());
                                                                $row_company1 = mysql_fetch_array($sql_company1);
                                                                $sql_company = mysql_query("SELECT * from company WHERE status=''") or die(mysql_error());
                                                                echo '<option value="' . $row_company1['company_id'] . '">' . $row_company1['name'] . '</option>';
                                                                while ($row_company = mysql_fetch_array($sql_company)) {
                                                                    echo '<option value="' . $row_company['company_id'] . '">' . strtoupper($row_company['name']) . '</option>';
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
                                                                <?php
                                                                $sql_branch1 = mysql_query("SELECT * from branches WHERE branch_id='" . $row_current_emp['branch_id'] . "'") or die(mysql_error());
                                                                $row_branch1 = mysql_fetch_array($sql_branch1);
                                                                echo '<option value="' . $row_branch1['branch_id'] . '">' . ucwords($row_branch1['branch_name']) . '</option>';

                                                                $sql_branch = mysql_query("SELECT * from branches WHERE status=''") or die(mysql_error());
                                                                while ($row_branch = mysql_fetch_array($sql_branch)) {
                                                                    echo '<option value="' . $row_branch['branch_id'] . '">' . ucwords($row_branch['branch_name']) . '</option>';
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
                                                                <select name="position" id="position" class="form-control" style="height:35px; width: 100%; margin-bottom: 10px;" >
                                                                    <?php
                                                                    $sql_position1 = mysql_query("SELECT * from positions WHERE p_id='" . $row_current_emp['position_id'] . "'") or die(mysql_error());
                                                                    $row_position1 = mysql_fetch_array($sql_position1);
                                                                    echo '<option value="' . $row_position1['p_id'] . '">' . ucwords($row_position1['position']) . '</option>';

                                                                    $sql_position = mysql_query("SELECT * from positions WHERE status='' ORDER BY position Asc") or die(mysql_error());
                                                                    while ($row_position = mysql_fetch_array($sql_position)) {
                                                                        echo '<option value="' . $row_position['p_id'] . '">' . $row_position['position'] . '</option>';
                                                                    }
                                                                    ?>

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Other Position<span class="required">*</span></label>
                                                            <div class="col-sm-5">
                                                                <select name="other_position[]" id="other_position" class="form-control js-example-basic-multiple" style="height:35px; width: 120%; margin-bottom: 10px;" multiple="multiple">
                                                                    <?php
                                                                    $otherPosition = '';
                                                                    $attr = '';
                                                                    $arrOtherPosition = str_replace('[', '', explode(']', $row_current_emp['other_positionId']));
                                                                    foreach ($arrOtherPosition as $thisVal) {
                                                                        if ($thisVal > 0) {
                                                                            $sql_position2 = mysql_query("SELECT * from positions WHERE p_id='" . $thisVal . "' ORDER BY position Asc") or die(mysql_error());
                                                                            $row_position2 = mysql_fetch_array($sql_position2);
                                                                            echo '<option value="' . $row_position2['p_id'] . '" selected>' . strtoupper($row_position2['position']) . '</option>';
                                                                        }
                                                                    }

                                                                    $sql_position = mysql_query("SELECT * from positions WHERE status='' ORDER BY position Asc") or die(mysql_error());
                                                                    while ($row_position = mysql_fetch_array($sql_position)) {
//                                                                        echo '<script>console.log("'.$attr.'")</script>';
                                                                        echo '<option value="' . $row_position['p_id'] . '">' . strtoupper($row_position['position']) . '</option>';
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
                                                            <label class="col-sm-3 control-label">Rank<span class="required">*</span></label>
                                                            <div class="col-sm-5">
                                                                <select style="height:35px; width: 120%; margin-bottom: 10px;" name="rank" class="form-control" required/>
                                                                <?php
                                                                $sql_rank1 = mysql_query("SELECT * from rank WHERE r_id='" . $row_current_emp['rank_id'] . "'") or die(mysql_error());
                                                                $row_rank1 = mysql_fetch_array($sql_rank1);
                                                                echo '<option value="' . $row_rank1['r_id'] . '">' . ucwords($row_rank1['description']) . '</option>';

                                                                $sql_rank = mysql_query("SELECT * from rank WHERE status=''") or die(mysql_error());
                                                                while ($row_rank = mysql_fetch_array($sql_rank)) {
                                                                    echo '<option value="' . $row_rank['r_id'] . '">' . ucwords($row_rank['description']) . '</option>';
                                                                }
                                                                ?>
                                                                </select>
                                                            </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">&nbsp;&nbsp;Employment Status<span class="required">*</span></label>
                                                            <div class="col-sm-5">
                                                                <select type="text" class="form-control" style="height:35px; width: 100%; margin-bottom: 10px;" placeholder="Required" name="emp_status"/>
                                                                <?php
                                                                $sql_estat1 = mysql_query("SELECT * from employment_status WHERE e_id='" . $row_current_emp['status_id'] . "'") or die(mysql_error());
                                                                $sql_estat1 = mysql_fetch_array($sql_estat1);
                                                                echo '<option value="' . $sql_estat1['e_id'] . '">' . ucwords($sql_estat1['code']) . '</option>';

                                                                $sql_estat = mysql_query("SELECT * from employment_status ORDER BY description Asc") or die(mysql_error());
                                                                while ($row_estat = mysql_fetch_array($sql_estat)) {
                                                                    echo '<option value="' . $row_estat['e_id'] . '">' . ucwords($row_estat['description']) . '</option>';
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
                                                            <label class="col-sm-3 control-label">Stay In<span class="required">*</span></label>
                                                            <div class="col-sm-5">
                                                                <select type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" placeholder="Required" name="stayin"/>
                                                                <option value="<?php echo $row_current_emp['stayin']; ?>"><?php echo ucwords($row_current_emp['stayin']); ?></option>
                                                                <option value="Yes" >Yes</option>
                                                                <option value="No" >No</option>
                                                                </select>
                                                            </div>
                                                            <div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label">SSS No.<span class="required">*</span></label>
                                                                        <div class="col-sm-5">
                                                                            <input type="text" class="form-control" style="height:35px; width: 100%; margin-bottom: 10px;" value="<?php echo $row_current_emp['sss_no']; ?>" placeholder="Required" name="sss"/>
                                                                        </div>
                                                                        <div>
                                                                            </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <label class="col-sm-3 control-label">PHIC No.<span class="required">*</span></label>
                                                                                        <div class="col-sm-5">
                                                                                            <input type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" value="<?php echo $row_current_emp['phic_no']; ?>" placeholder="Required" name="phic"/>
                                                                                        </div>
                                                                                        <div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div class="form-group">
                                                                                                    <label class="col-sm-3 control-label">HDMF No.<span class="required">*</span></label>
                                                                                                    <div class="col-sm-5">
                                                                                                        <input type="text" class="form-control" style="height:35px; width: 100%; margin-bottom: 10px;" value="<?php echo $row_current_emp['hdmf_no']; ?>" placeholder="Required" name="hdmf"/>
                                                                                                    </div>
                                                                                                    <div>
                                                                                                        </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                <div class="form-group">
                                                                                                                    <label class="col-sm-3 control-label">TIN<span class="required">*</span></label>
                                                                                                                    <div class="col-sm-5">
                                                                                                                        <input type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" value="<?php echo $row_current_emp['tin']; ?>" placeholder="Required" name="tin"/>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                <div class="form-group">
                                                                                                                    <label class="col-sm-3 control-label">Tax Code<span class="required">*</span></label>
                                                                                                                    <div class="col-sm-5">
                                                                                                                        <select style="height:35px; width: 100%; margin-bottom: 10px;" class="form-control" name="tax_code" required/>
                                                                                                                        <option value="<?php echo $row_current_emp['tax_code']; ?>"><?php echo $row_current_emp['tax_code']; ?></option>
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
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                <div class="form-group">
                                                                                                                    <label class="col-sm-3 control-label">Regularization Date</label>
                                                                                                                    <div class="col-sm-5">
                                                                                                                        <input type="text" style="height:35px; width: 120%; margin-bottom: 10px;" value="<?php
                                                                                                                        if ($row_current_emp['date_regularization'] != '0000:00:00') {
                                                                                                                            echo date('Y/m/d', strtotime($row_current_emp['date_regularization']));
                                                                                                                        }
                                                                                                                        ?>" id="datetimepicker4" placeholder="if any" name="date_regularization" autocomplete="off"/>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                <div class="form-group">
                                                                                                                    <label class="col-sm-3 control-label">Home Address Sketch</label>
                                                                                                                    <div class="col-sm-5">
                                                                                                                        <input type="file" style="height:40px; width: 120%; margin-bottom: 10px;" class="form-control" name="sketch"/>
                                                                                                                        <span class="attachement">Uploaded: <?php
                                                                                                                            if (empty($row_current_emp['sketch'])) {
                                                                                                                                echo 'No uploaded sketch';
                                                                                                                            } else {
                                                                                                                                ?><input type="hidden" value="<?php echo $row_current_emp['emp_num'] . '-' . $row_current_emp['sketch']; ?>" name="uploaded"><a href="../../images/sketch/<?php echo $row_current_emp['emp_num'] . '-' . $row_current_emp['sketch']; ?>" target="_blank"><?php
                                                                                                                                    echo $row_current_emp['sketch'];
                                                                                                                                }
                                                                                                                                ?></a></span>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
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
                                                                                                            $arr_ctr = 0;
                                                                                                            $arr_dependents1 = explode(']', $row_current_emp['dependents']);
                                                                                                            echo '<input type="hidden" value="' . $r_dependentCtrl . '" id="r_dependentCtrl">';
                                                                                                            echo '<input type="hidden" id="r_dependentCount" name="r_dependentCount">';

                                                                                                            while ($r_dependents <= $r_dependentCtrl) {
                                                                                                                @$arr_dependents2 = str_replace('[', '', explode('~', $arr_dependents1[$arr_ctr]));
                                                                                                                ?>
                                                                                                                <tr id="r_dependents<?php echo $r_dependents; ?>" class="r_dependentClass">
                                                                                                                    <td>
                                                                                                                        <div class="form-group" style=" width: 160%;">
                                                                                                                            <label class="col-sm-3 control-label">Fullname<span class="required">*</span></label>
                                                                                                                            <div class="col-sm-5">
                                                                                                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px; width: 120%;" placeholder="Required" name="nameDependent<?php echo $r_dependents; ?>" value="<?php echo @$arr_dependents2[0]; ?>" required/>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        <div class="form-group">
                                                                                                                            <label class="col-sm-3 control-label">Birthdate<span class="required">*</span></label>
                                                                                                                            <div class="col-sm-5">
                                                                                                                                <input type="text" style="height:35px; width: 110%; margin-bottom: 10px;"  id="datetimepicker_<?php echo $r_dependents; ?>" name="birthdateDependent<?php echo $r_dependents; ?>" value="<?php
                                                                                                                                if (!empty($arr_dependents2[1])) {
                                                                                                                                    echo date('Y/m/d', strtotime(@$arr_dependents2[1]));
                                                                                                                                }
                                                                                                                                ?>" placeholder="Required" autocomplete="off" required/>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        <div class="form-group">
                                                                                                                            <label class="col-sm-3 control-label">Relationship<span class="required">*</span></label>
                                                                                                                            <div class="col-sm-5">
                                                                                                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px;" placeholder="Required" name="relationship<?php echo $r_dependents; ?>" value="<?php echo @$arr_dependents2[2]; ?>" required/>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                                <?php
                                                                                                                $r_dependents++;
                                                                                                                $arr_ctr++;
                                                                                                            }
                                                                                                            ?>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td colspan="2"><hr></td>
                                                                                                            </tr>
                                                                                                        </table>

                                                                                                        <table width="100%">
                                                                                                            <tr>
                                                                                                                <td colspan="2">&nbsp;&nbsp;&nbsp;<b>Dependents (Health Insurance)</b>&nbsp;&nbsp;<b><i><font color="red"><span id="dependent_mes" hidden></span></font></i></b><br><br></td>
                                                                                                            </tr>
                                                                                                            <?php
                                                                                                            $r_dependentsHi = 1;
                                                                                                            $r_dependentCtrlHi = 4;
                                                                                                            $r_dependentCountValHiEx = explode('|', $row_current_emp['dependentsHi']);
                                                                                                            $r_dependentCountValHi = count($r_dependentCountValHiEx) - 1;
                                                                                                            if ($r_dependentCountValHi == 0) {
                                                                                                                $r_dependentCountValHi = 1;
                                                                                                            }

                                                                                                            echo '<input type="hidden" value="' . $r_dependentCtrlHi . '" id="r_dependentCtrlHi">';
                                                                                                            echo '<input type="hidden" id="r_dependentCountHi" value="' . $r_dependentCountValHi . '" name="r_dependentCountHi">';
                                                                                                            echo '<input type="hidden" id="r_dependentCountValHi" value="' . $r_dependentCountValHi . '" name="r_dependentCountValHi">';

                                                                                                            while ($r_dependentsHi <= $r_dependentCtrlHi) {
                                                                                                                if (!empty($r_dependentCountValHiEx[$r_dependentsHi - 1]) && $r_dependentsHi <= $r_dependentCountValHi) {
                                                                                                                    $dataHi = explode('~', $r_dependentCountValHiEx[$r_dependentsHi - 1]);
                                                                                                                } else {
                                                                                                                    $dataHi[0] = '';
                                                                                                                    $dataHi[1] = '';
                                                                                                                    $dataHi[2] = '';
                                                                                                                }
                                                                                                                ?>
                                                                                                                <tr id="r_dependentsHi<?php echo $r_dependentsHi; ?>" class="r_dependentClassHi" hidden>
                                                                                                                    <td>
                                                                                                                        <div class="form-group" style=" width: 160%;">
                                                                                                                            <label class="col-sm-3 control-label">Fullname<span class="required">*</span></label>
                                                                                                                            <div class="col-sm-5">
                                                                                                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px; width: 120%;" value="<?php echo @$dataHi[0]; ?>" name="nameDependentHi<?php echo $r_dependentsHi; ?>"/>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        <div class="form-group">
                                                                                                                            <label class="col-sm-3 control-label">Birthdate<span class="required">*</span></label>
                                                                                                                            <div class="col-sm-5">
                                                                                                                                <input type="text" style="height:35px; width: 110%; margin-bottom: 10px;" value="<?php echo @$dataHi[1]; ?>"  id="datetimepickerHi_<?php echo $r_dependentsHi; ?>" name="birthdateDependentHi<?php echo $r_dependentsHi; ?>" class="myDate" autocomplete="off"/>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        <div class="form-group">
                                                                                                                            <label class="col-sm-3 control-label">Relationship<span class="required">*</span></label>
                                                                                                                            <div class="col-sm-5">
                                                                                                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px;" value="<?php echo @$dataHi[2]; ?>" name="relationshipHi<?php echo $r_dependentsHi; ?>"/>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                                <?php
                                                                                                                $r_dependentsHi++;
                                                                                                            }
                                                                                                            ?>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td colspan="3"><center><img id="add_buttonHi" src="../../images/button/add_icon.png" width="35px" height="35px" class="e_buttonHi"> &nbsp;&nbsp;&nbsp;&nbsp; <img id="minus_buttonHi" src="../../images/button/minus_icon.png" width="35px" height="35px" class="e_buttonHi"></span></center></td>
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
                                                                                                            $arr_ctr2 = 0;
                                                                                                            $r_emergencyCtrl = 5;
                                                                                                            $arr_emergency = explode(']', $row_current_emp['emergency']);
                                                                                                            $r_emergency = 1;
                                                                                                            echo '<input type="hidden" value="' . count($arr_emergency) . '" id="emerCount">';
                                                                                                            echo '<input type="hidden" value="' . $r_emergencyCtrl . '" id="r_emergencyCtrl">';
                                                                                                            echo '<input type="hidden" value="' . $r_emergency . '" id="r_emergency" name="r_emergency">';

                                                                                                            while ($r_emergency <= $r_emergencyCtrl) {
                                                                                                                @$arr_emergency2 = str_replace('[', '', explode('~', $arr_emergency[$arr_ctr2]));
                                                                                                                ?>
                                                                                                                <tr id="r_emergency<?php echo $r_emergency; ?>">
                                                                                                                    <td>
                                                                                                                        <div class="form-group" style=" width: 160%;">
                                                                                                                            <label class="col-sm-3 control-label">Fullname</label>
                                                                                                                            <div class="col-sm-5">
                                                                                                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px; width: 120%;" name="nameEmergency<?php echo $r_emergency; ?>" value="<?php echo @$arr_emergency2[0]; ?>"/>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        <div class="form-group">
                                                                                                                            <label class="col-sm-3 control-label">Relationship</label>
                                                                                                                            <div class="col-sm-5">
                                                                                                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px;" name="relationshipEmergency<?php echo $r_emergency; ?>" value="<?php echo @$arr_emergency2[2]; ?>"/>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                                <tr id="r_emergency2<?php echo $r_emergency; ?>">
                                                                                                                    <td>
                                                                                                                        <div class="form-group">
                                                                                                                            <label class="col-sm-3 control-label">Contact No.</label>
                                                                                                                            <div class="col-sm-5">
                                                                                                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 35px;" name="contactEmergency<?php echo $r_emergency; ?>" value="<?php echo @$arr_emergency2[3]; ?>"/>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                    <td colspan="2">
                                                                                                                        <div class="form-group">
                                                                                                                            <label class="col-sm-3 control-label">Address</label>
                                                                                                                            <div class="col-sm-5">
                                                                                                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 30px;" name="addressEmergency<?php echo $r_emergency; ?>" value="<?php echo @$arr_emergency2[4]; ?>"/>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                                <?php
                                                                                                                $r_emergency++;
                                                                                                                $arr_ctr2++;
                                                                                                            }
                                                                                                            ?>
                                                                                                            <tr>
                                                                                                                <td colspan="3"><center><img id="add_button" src="../../images/button/add_icon.png" width="35px" height="35px" class="e_button"> &nbsp;&nbsp;&nbsp;&nbsp; <img id="minus_button" src="../../images/button/minus_icon.png" width="35px" height="35px" class="e_button"></span></center></td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td colspan="2"><hr></td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                            <tr>
                                                                                                                <td colspan="2">&nbsp;&nbsp;&nbsp;<b>Seminar/s must be Attended</b>&nbsp;&nbsp;<b><i><font color="red"><span id="dependent_mes" hidden></span></font></i></b><br><br></td>
                                                                                                            </tr>
                                                                                                            <td colspan="2">
                                                                                                                <div class="form-group">
                                                                                                                    <label class="col-sm-3 control-label">Title</label>
                                                                                                                    <div class="col-sm-9">
                                                                                                                        <select class="form-control" multiple="multiple" name="slctTitle[]" id="slctTitle">
                                                                                                                            <?php
                                                                                                                            $arr_mustUni = explode('~', $row_current_emp['training_must_attended']);
                                                                                                                            foreach ($arr_mustUni as $val) {
                                                                                                                                if (!empty($val)) {
                                                                                                                                    echo '<option value="' . strtoupper($val) . '" selected>' . strtoupper($val) . '</option>';
                                                                                                                                }
                                                                                                                            }
                                                                                                                            $sql_seminars = mysql_query("SELECT DISTINCT(title) as title from training_seminar ORDER BY title Asc");
                                                                                                                            while ($row_seminars = mysql_fetch_array($sql_seminars)) {
                                                                                                                                echo '<option value="' . strtoupper($row_seminars['title']) . '">' . strtoupper($row_seminars['title']) . '</option>';
                                                                                                                            }
                                                                                                                            ?>
                                                                                                                        </select>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <!--<input type="hidden" name="tnsContainer[]" value="<?php echo $arr_mustUni; ?>">-->
                                                                                                            </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td colspan="4"><br><br><br><br><center>
                                                                                                                <input type="submit" class="btn btn-primary" value="Update Employee"></center>
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
                                                                                    <link href="css/select2.min.css" rel="stylesheet">
                                                                                    <script type="text/javascript" src="js/select2.min.js"></script>
                                                                                    <script>
                                                                                        //emergency start
                                                                                        $(document).ready(function () {
//                                                                                            $('#r_dependentsHi1').attr('hidden', false);
                                                                                            var r_dependentCountValHi = Number($('#r_dependentCountValHi').val());
                                                                                            var Hi_ctr = 1;
                                                                                            while (r_dependentCountValHi >= Hi_ctr) {
                                                                                                $('#r_dependentsHi' + Hi_ctr).attr('hidden', false);
                                                                                                Hi_ctr++;
                                                                                            }

                                                                                            $('#other_position').select2();
                                                                                            $('#slctTitle').select2({
                                                                                                tags: true,
                                                                                                realtime: false
                                                                                            });
                                                                                            $('#minus_button').attr('hidden', true);
                                                                                            var r_dependentCtrl = Number($('#r_emergencyCtrl').val());
                                                                                            var r_emerCount = Number($('#emerCount').val() - 1);
                                                                                            var ctr = 1;
                                                                                            $('#r_emergency').val(r_emerCount);
                                                                                            while (ctr <= r_dependentCtrl) {

                                                                                                if (ctr <= r_emerCount) {
                                                                                                    $('#r_emergency2' + ctr).attr('hidden', false);
                                                                                                    $('#r_emergency' + ctr).attr('hidden', false);
                                                                                                } else {
                                                                                                    $('#r_emergency2' + ctr).attr('hidden', true);
                                                                                                    $('#r_emergency' + ctr).attr('hidden', true);
                                                                                                }

                                                                                                $('#datetimepickerEmer_' + ctr).datetimepicker({
                                                                                                    dayOfWeekStart: 1,
                                                                                                    lang: 'en',
                                                                                                    timepicker: false,
                                                                                                    format: 'Y/m/d',
                                                                                                    formatDate: 'Y/m/d',
                                                                                                    startDate: '1900',
                                                                                                    scrollMonth: false,
                                                                                                    scrollInput: false
                                                                                                });
                                                                                                $('#datetimepickerHi_' + ctr).datetimepicker({
                                                                                                    dayOfWeekStart: 1,
                                                                                                    lang: 'en',
                                                                                                    timepicker: false,
                                                                                                    format: 'Y/m/d',
                                                                                                    formatDate: 'Y/m/d',
                                                                                                    startDate: '1900',
                                                                                                    scrollMonth: false,
                                                                                                    scrollInput: false
                                                                                                });
                                                                                                ctr++;
                                                                                            }
                                                                                            if (r_emerCount > 1) {
                                                                                                $('#minus_button').attr('hidden', false);
                                                                                            }
                                                                                        });

//                                                                                        $('#r_dependentsHi1').attr('hidden', false);
//                                                                                        $('#minus_buttonHi').attr('hidden', true);

                                                                                        $('.e_buttonHi').click(function () {
                                                                                            var id = ($(this).attr('id')).split('_');
                                                                                            var action = id[0];
                                                                                            var maxCtr = Number($('#r_dependentCtrlHi').val());
                                                                                            var ctr = Number($('#r_dependentCountHi').val());
                                                                                            if (action === 'add' && ctr < maxCtr) {
                                                                                                var ctrl = Number($('#r_dependentCountHi').val()) + 1;
                                                                                                $('#r_dependentsHi' + ctrl).attr('hidden', false);
//                                                                                                                            $('#r_dependentsHi' + ctrl).attr('hidden', false);
                                                                                                $('#r_dependentCountHi').val(ctrl);
                                                                                                if (maxCtr == ctrl) {
                                                                                                    var ids = $(this).attr('id');
                                                                                                    $('#' + ids).attr('hidden', true);
                                                                                                }
                                                                                                if (ctrl >= 1) {
                                                                                                    $('#minus_buttonHi').attr('hidden', false);
                                                                                                }
                                                                                            } else if (action === 'minus') {
                                                                                                var ctrl = Number($('#r_dependentCountHi').val());
                                                                                                var Newctrl = Number($('#r_dependentCountHi').val()) - 1;
                                                                                                $('#r_dependentsHi' + ctrl).attr('hidden', true);
                                                                                                $('#r_dependentCountHi').val(Newctrl);
                                                                                                if (ctrl > 1) {
                                                                                                    $('#add_buttonHi').attr('hidden', false);
                                                                                                }
                                                                                                if (Newctrl <= 1) {
                                                                                                    $('#minus_buttonHi').attr('hidden', true);
                                                                                                }
                                                                                            }
                                                                                        });

                                                                                        $('.e_button').click(function () {
                                                                                            var id = ($(this).attr('id')).split('_');
                                                                                            var action = id[0];
                                                                                            var maxCtr = Number($('#r_emergencyCtrl').val());

                                                                                            if (action === 'add') {
                                                                                                var ctrl = Number($('#r_emergency').val()) + 1;
                                                                                                $('#r_emergency2' + ctrl).attr('hidden', false);
                                                                                                $('#r_emergency' + ctrl).attr('hidden', false);
                                                                                                $('#r_emergency').val(ctrl);

                                                                                                if (maxCtr == ctrl) {
                                                                                                    var ids = $(this).attr('id');
                                                                                                    $('#' + ids).attr('hidden', true);
                                                                                                }
                                                                                                if (ctrl > 1) {
                                                                                                    $('#minus_button').attr('hidden', false);
                                                                                                }
                                                                                            } else if (action === 'minus') {
                                                                                                var ctrl = Number($('#r_emergency').val());
                                                                                                $('#r_emergency2' + ctrl).attr('hidden', true);
                                                                                                $('#r_emergency' + ctrl).attr('hidden', true);

                                                                                                var Newctrl = Number($('#r_emergency').val()) - 1;
                                                                                                $('#r_emergency').val(Newctrl);

                                                                                                if (ctrl > 1) {
                                                                                                    $('#add_button').attr('hidden', false);
                                                                                                }
                                                                                                if (Newctrl == 1) {
                                                                                                    $('#minus_button').attr('hidden', true);
                                                                                                }
                                                                                            }
                                                                                        });
                                                                                        //emergency end


                                                                                        //dependents start
                                                                                        $(document).ready(function () {

                                                                                            $('[name=civil_status]').change(function () {
                                                                                                if ($(this).val() == 'married') {
                                                                                                    $('.spouseDetails').show(300);
                                                                                                } else {
                                                                                                    $('.spouseDetails').hide();
                                                                                                }
                                                                                                if ($(this).val() != 'single') {
                                                                                                    $('#r_children1').show(300);
                                                                                                    $('.spouseDetailsBtn').show(300);
                                                                                                } else {
                                                                                                    $('.spouseDetails').hide();
                                                                                                }
                                                                                            });
                                                                                            
                                                                                            var _val = $('[name=civil_status]').val().toUpperCase();
                                                                                            if (_val == 'MARRIED') {
                                                                                                $('.spouseDetails').show(300);
                                                                                            } else {
                                                                                                $('.spouseDetails').hide();
                                                                                            }
                                                                                            if (_val != 'SINGLE') {
                                                                                                var childrenCount = Number($('#r_childrenCount').val());
                                                                                                if (childrenCount == 0) {
                                                                                                    var childrenCount = 1;
                                                                                                }
                                                                                                var _ctr = 1;
                                                                                                while (_ctr <= childrenCount) {
                                                                                                    $('#r_children' + _ctr).show(300);
                                                                                                    _ctr++;
                                                                                                }
                                                                                                $('.spouseDetailsBtn').show(300);
                                                                                            } else {
                                                                                                $('.spouseDetails').hide();
                                                                                            }

                                                                                            $('.e_buttonChildren').click(function () {
                                                                                                var id = ($(this).attr('id')).split('_');
                                                                                                var action = id[0];
                                                                                                var maxCtr = Number($('#r_childrenCtrl').val());
                                                                                                var ctr = Number($('#r_childrenCtrl').val());
                                                                                                if (action === 'add') {
                                                                                                    var ctrl = Number($('#r_childrenCount').val()) + 1;
                                                                                                    $('#r_children' + ctrl).show();
//                                                                                                                            $('#r_dependentsHi' + ctrl).attr('hidden', false);
                                                                                                    $('#r_childrenCount').val(ctrl);
                                                                                                    if (maxCtr == ctrl) {
                                                                                                        var ids = $(this).attr('id');
                                                                                                        $('#' + ids).hide();
                                                                                                    }
                                                                                                    if (ctrl > 1) {
                                                                                                        $('#minus_buttonChildren').show();
                                                                                                    }
                                                                                                } else if (action === 'minus') {
                                                                                                    var ctrl = Number($('#r_childrenCount').val());
                                                                                                    var Newctrl = Number($('#r_childrenCount').val()) - 1;
                                                                                                    $('#r_children' + ctrl).hide();
                                                                                                    $('#r_childrenCount').val(Newctrl);
                                                                                                    if (ctrl > 1) {
                                                                                                        $('#add_buttonChildren').attr('hidden', false);
                                                                                                    }
                                                                                                    if (Newctrl <= 1) {
                                                                                                        $('#minus_buttonChildren').attr('hidden', true);
                                                                                                    }
                                                                                                }
                                                                                            });

                                                                                            var r_childrenCtrl = Number($('#r_childrenCtrl').val());
                                                                                            var ctr = 1;
                                                                                            while (ctr <= r_childrenCtrl) {

                                                                                                $('#datetimepickerChildren_' + ctr).datetimepicker({
                                                                                                    dayOfWeekStart: 1,
                                                                                                    lang: 'en',
                                                                                                    timepicker: false,
                                                                                                    format: 'Y/m/d',
                                                                                                    formatDate: 'Y/m/d',
                                                                                                    startDate: '1900',
                                                                                                    scrollMonth: false,
                                                                                                    scrollInput: false
                                                                                                });
                                                                                                ctr++;
                                                                                            }

                                                                                            var selected = $('select[name="tax_code"]').val();
                                                                                            var counts = selected.substr(-1);
                                                                                            if ($.isNumeric(counts)) {
                                                                                                var r_dependentCtrl = Number(counts);
                                                                                                var r_dependent = 1;
                                                                                                $('.r_dependentClass').attr('hidden', true);
                                                                                                $('#r_dependentCount').val(r_dependentCtrl);
                                                                                                while (r_dependent <= r_dependentCtrl) {
                                                                                                    $('#r_dependents' + r_dependent).attr('hidden', false);
                                                                                                    /* $('#relationship' + r_dependent).attr('required',true);
                                                                                                     $('#birthdateDependent' + r_dependent).attr('required',true);*/
                                                                                                    $('#datetimepicker_' + r_dependent).datetimepicker({
                                                                                                        dayOfWeekStart: 1,
                                                                                                        lang: 'en',
                                                                                                        timepicker: false,
                                                                                                        format: 'Y/m/d',
                                                                                                        formatDate: 'Y/m/d',
                                                                                                        startDate: '1900',
                                                                                                        scrollMonth: false,
                                                                                                        scrollInput: false
                                                                                                    });
                                                                                                    r_dependent++;
                                                                                                }

                                                                                                $('#dependent_mes').attr("hidden", false);
                                                                                                $('#dependent_mes').html(counts + " dependent/s");
                                                                                            } else {
                                                                                                $('.r_dependentClass').attr('hidden', true);
                                                                                                $('#dependent_mes').html("zero dependent");
                                                                                                $('#dependent_mes').attr("hidden", false);
                                                                                            }

                                                                                            $('select[name="tax_code"]').change(function () {
                                                                                                var selected = $('select[name="tax_code"]').val();
                                                                                                var counts = selected.substr(-1);
                                                                                                if ($.isNumeric(counts)) {
                                                                                                    var r_dependentCtrl = Number(counts);
                                                                                                    var r_dependent = 1;
                                                                                                    $('.r_dependentClass').attr('hidden', true);
                                                                                                    $('#r_dependentCount').val(r_dependentCtrl);
                                                                                                    while (r_dependent <= r_dependentCtrl) {
                                                                                                        $('#r_dependents' + r_dependent).attr('hidden', false);
                                                                                                        /* $('#relationship' + r_dependent).attr('required',true);
                                                                                                         $('#birthdateDependent' + r_dependent).attr('required',true);*/
                                                                                                        $('#datetimepicker_' + r_dependent).datetimepicker({
                                                                                                            dayOfWeekStart: 1,
                                                                                                            lang: 'en',
                                                                                                            timepicker: false,
                                                                                                            format: 'Y/m/d',
                                                                                                            formatDate: 'Y/m/d',
                                                                                                            startDate: '1900',
                                                                                                            scrollMonth: false,
                                                                                                            scrollInput: false
                                                                                                        });
                                                                                                        r_dependent++;
                                                                                                    }

                                                                                                    $('#dependent_mes').attr("hidden", false);
                                                                                                    $('#dependent_mes').html(counts + " dependent/s");
                                                                                                } else {
                                                                                                    $('.r_dependentClass').attr('hidden', true);
                                                                                                    $('#dependent_mes').html("zero dependent");
                                                                                                    $('#dependent_mes').attr("hidden", false);
                                                                                                }
                                                                                            });
                                                                                        });
                                                                                        //dependents end

                                                                                        //date picker1 start
                                                                                        $('#datetimepicker').datetimepicker({
                                                                                            dayOfWeekStart: 1,
                                                                                            lang: 'en',
                                                                                            timepicker: false,
                                                                                            format: 'Y/m/d',
                                                                                            formatDate: 'Y/m/d',
                                                                                            disabledDates: ['1986/01/08', '1986/01/09', '1986/01/10'],
                                                                                            startDate: '1940',
                                                                                            scrollMonth: false,
                                                                                            scrollInput: false
                                                                                        });
                                                                                        $('#datetimepicker').datetimepicker({value: '', step: 30});
                                                                                        //date picker1 end

                                                                                        //date picker2 start
                                                                                        $('#datetimepicker2').datetimepicker({
                                                                                            dayOfWeekStart: 1,
                                                                                            lang: 'en',
                                                                                            timepicker: false,
                                                                                            format: 'Y/m/d',
                                                                                            formatDate: 'Y/m/d',
                                                                                            startDate: '1940',
                                                                                            scrollMonth: false,
                                                                                            scrollInput: false
                                                                                        });
                                                                                        $('#datetimepicker2').datetimepicker({value: '', step: 30});
                                                                                        //date picker1 end

                                                                                        //date picker2 start
                                                                                        $('#datetimepicker3').datetimepicker({
                                                                                            dayOfWeekStart: 1,
                                                                                            lang: 'en',
                                                                                            timepicker: false,
                                                                                            format: 'Y/m/d',
                                                                                            formatDate: 'Y/m/d',
                                                                                            startDate: '1940',
                                                                                            scrollMonth: false,
                                                                                            scrollInput: false
                                                                                        });
                                                                                        $('#datetimepicker3').datetimepicker({value: '', step: 30});

                                                                                        $('#datetimepicker4').datetimepicker({
                                                                                            dayOfWeekStart: 1,
                                                                                            lang: 'en',
                                                                                            timepicker: false,
                                                                                            format: 'Y/m/d',
                                                                                            formatDate: 'Y/m/d',
                                                                                            startDate: '1940',
                                                                                            scrollMonth: false,
                                                                                            scrollInput: false
                                                                                        });
                                                                                        $('#datetimepicker4').datetimepicker({value: '', step: 30});
                                                                                        //date picker1 end
                                                                                    </script>

