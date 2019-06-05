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
                        $sql_empFirstname = mysql_query("SELECT DISTINCT(firstname) from employees ORDER BY firstname ASC") or die(mysql_error());
                        $sql_empLastname = mysql_query("SELECT DISTINCT(lastname) from employees ORDER BY lastname ASC") or die(mysql_error());
                        $sql_empMiddlename = mysql_query("SELECT DISTINCT(middlename) from employees ORDER BY middlename ASC") or die(mysql_error());
                        ?>
                    </div>
                    <!--Main body-->
                    <div class="main">
                        <style>
                            .e_buttonChildren:hover{
                                cursor: pointer;
                            }
                            .e_button:hover{
                                cursor: pointer;
                            }
                            .e_buttonHi:hover{
                                cursor: pointer;
                            }
                            input{
                                text-transform: uppercase;
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
                                            <label class="col-sm-3 control-label">Personnel Request<span class="required">*</span></label>
                                            <div class="col-sm-7">
                                                <!--<input type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" placeholder="Required" name="firstnames"/>-->
                                                <select name="pr" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" requried>
                                                    <?php
                                                    echo '<option value="" selected disabled>Required</option>';
                                                    $sql_pr = mysql_query("SELECT * from personnel_requisition WHERE (gm_status ='approved' or hr_status='served' or hr_status='noted') and status !='served'");
                                                    while ($row_pr= mysql_fetch_array($sql_pr)) {
                                                        $sql_branch = mysql_query("SELECt * from branches WHERE branch_id='".$row_pr['branch_id']."'");
                                                        $row_branch = mysql_fetch_array($sql_branch);
                                                        
                                                        $sql_position = mysql_query("SELECt * from positions WHERE p_id='".$row_pr['job_title']."'");
                                                        $row_position = mysql_fetch_array($sql_position);
                                                        echo '<option value="' . $row_pr['pr_id'] . '">PR#'.$row_pr['pr_id']. '-'. strtoupper($row_branch['branch_name']. '-' . $row_position['position']). '</option>';
                                                    }
                                                    echo '<option value="0">PR# NOT NEEDED'. '-</option>';
                                                    ?>
                                                </select>
                                            </div>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Firstname<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <!--<input type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" placeholder="Required" name="firstnames"/>-->
                                                <select name="firstname" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" requried>
                                                    <?php
                                                    echo '<option value="" selected disabled>Required</option>';
                                                    while ($row_firstname = mysql_fetch_array($sql_empFirstname)) {
                                                        echo '<option value="' . $row_firstname['firstname'] . '">' . $row_firstname['firstname'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
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
                                                <!--<input type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" placeholder="Optional" name="middlename"/>-->
                                                <select name="middlename" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;">
                                                    <?php
                                                    echo '<option value="" selected disabled>Optional</option>';
                                                    while ($row_middlename = mysql_fetch_array($sql_empMiddlename)) {
                                                        echo '<option value="' . $row_middlename['middlename'] . '">' . $row_middlename['middlename'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
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
                                                <!--<input type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" placeholder="Required" name="lastname"/>-->
                                                <select name="lastname" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" requried>
                                                    <?php
                                                    echo '<option value="" selected disabled>Required</option>';
                                                    while ($row_lastname = mysql_fetch_array($sql_empLastname)) {
                                                        echo '<option value="' . $row_lastname['lastname'] . '">' . $row_lastname['lastname'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
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
                                                <input type="text" style="height:35px; width: 120%; margin-bottom: 10px;" class="form-control myDate" id="datetimepicker" name="birthdate" placeholder="Required" autocomplete="off" required/>
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
                                                                <select type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" name="civil_status"/>
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
                                                    <td colspan="2">&nbsp;&nbsp;&nbsp;<b>Family Background</b>&nbsp;&nbsp;<b><i><font color="red"><span id="dependent_mes" hidden></span></font></i></b><br><br></td>
                                                </tr>
                                                <tr class="spouseDetails" hidden>
                                                    <td>
                                                        <div class="form-group" style=" width: 160%;">
                                                            <label class="col-sm-3 control-label">Spouse's Maiden Fullname</label>
                                                            <div class="col-sm-5">
                                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px; width: 120%;" name="spouseName"/>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Occupation</label>
                                                            <div class="col-sm-5">
                                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px;" name="spouseOccupation"/>
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

                                                echo '<input type="hidden" value="' . $r_childrenCtrl . '" id="r_childrenCtrl">';
                                                echo '<input type="hidden" id="r_childrenCount" value="1" name="r_childrenCount">';

                                                while ($r_children <= $r_childrenCtrl) {
                                                    ?>
                                                    <tr id="r_children<?php echo $r_children; ?>" class="r_childrenClass" hidden>
                                                        <td>
                                                            <div class="form-group" style=" width: 160%;">
                                                                <label class="col-sm-3 control-label">Child's Fullname</label>
                                                                <div class="col-sm-5">
                                                                    <input type="text" class="form-control" style="height:35px; margin-bottom: 10px; width: 120%;" name="childrenName<?php echo $r_children; ?>"/>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">Birthdate</label>
                                                                <div class="col-sm-5">
                                                                    <input type="text" style="height:35px; width: 110%; margin-bottom: 10px;"  id="datetimepickerChildren_<?php echo $r_children; ?>" name="childrenBirthdate<?php echo $r_children; ?>" class="myDate" autocomplete="off"/>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $r_children++;
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
                                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px; width: 120%;" name="motherName"/>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Occupation</label>
                                                            <div class="col-sm-5">
                                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px;" name="motherOccupation"/>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-group" style=" width: 160%;">
                                                            <label class="col-sm-3 control-label">Father's Fullname</label>
                                                            <div class="col-sm-5">
                                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px; width: 120%;" name="fatherName"/>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Occupation</label>
                                                            <div class="col-sm-5">
                                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px;" name="fatherOccupation"/>
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

                                                <!--Second Info star-->
                                                <tr>
                                                    <td colspan="2">&nbsp;&nbsp;&nbsp;<b>Employment Details</b><br><br></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Date Hired<span class="required">*</span></label>
                                                            <div class="col-sm-5">
                                                                <input type="text" style="height:35px; width: 120%; margin-bottom: 10px;"  id="datetimepicker2" class="form-control myDate" placeholder="Required" name="date_hired" autocomplete="off" required/>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Orig. Hiring Date<span class="required">*</span></label>
                                                            <div class="col-sm-5">
                                                                <input type="text" class="form-control myDate" style="height:35px; width: 120%; margin-bottom: 10px;"  id="datetimepicker3" placeholder="Required" name="date_start" autocomplete="off" required/>
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
                                                                <option value="" selected disabled>Select</option>
                                                                <?php
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
                                                                <select name="position" id="position" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" >
                                                                    <option value="" selected disabled> Please Select</option>
                                                                    <?php
                                                                    $sql_position = mysql_query("SELECT * from positions WHERE status='' ORDER BY position Asc") or die(mysql_error());
                                                                    while ($row_position = mysql_fetch_array($sql_position)) {
                                                                        echo '<option value="' . $row_position['p_id'] . '">' . strtoupper($row_position['position']) . '</option>';
                                                                    }
                                                                    ?>

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Other Position</label>
                                                            <div class="col-sm-5">
                                                                <select name="other_position[]" id="other_position" class="form-control js-example-basic-multiple" style="height:35px; width: 120%; margin-bottom: 10px;" multiple="multiple">
                                                                    <?php
                                                                    $sql_position = mysql_query("SELECT * from positions WHERE status='' ORDER BY position Asc") or die(mysql_error());
                                                                    while ($row_position = mysql_fetch_array($sql_position)) {
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
                                                                <option value="" selected disabled>Select</option>
                                                                <?php
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
                                                                <select type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" placeholder="Required" name="emp_status"/>
                                                                <option value="" selected disabled>Select</option>
                                                                <?php
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
                                                                <option value="" selected disabled>Select</option>
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
                                                                            <input type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" placeholder="Required" name="sss"/>
                                                                        </div>
                                                                        <div>
                                                                            </td>
                                                                            <tr>
                                                                            </tr>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <label class="col-sm-3 control-label">PHIC No.<span class="required">*</span></label>
                                                                                    <div class="col-sm-5">
                                                                                        <input type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" placeholder="Required" name="phic"/>
                                                                                    </div>
                                                                                    <div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div class="form-group">
                                                                                                <label class="col-sm-3 control-label">HDMF No.<span class="required">*</span></label>
                                                                                                <div class="col-sm-5">
                                                                                                    <input type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" placeholder="Required" name="hdmf"/>
                                                                                                </div>
                                                                                                <div>
                                                                                                    </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>
                                                                                                            <div class="form-group">
                                                                                                                <label class="col-sm-3 control-label">TIN<span class="required">*</span></label>
                                                                                                                <div class="col-sm-5">
                                                                                                                    <input type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" placeholder="Required" name="tin"/>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </td>

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
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>
                                                                                                            <div class="form-group">
                                                                                                                <label class="col-sm-3 control-label">Regularization Date</label>
                                                                                                                <div class="col-sm-5">
                                                                                                                    <input type="text" style="height:35px; width: 120%; margin-bottom: 10px;"  id="datetimepicker4" placeholder="if any" name="date_regularization" autocomplete="off"/>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </td>
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

                                                                                                        echo '<input type="hidden" value="' . $r_dependentCtrl . '" id="r_dependentCtrl">';
                                                                                                        echo '<input type="hidden" id="r_dependentCount" name="r_dependentCount">';

                                                                                                        while ($r_dependents <= $r_dependentCtrl) {
                                                                                                            ?>
                                                                                                            <tr id="r_dependents<?php echo $r_dependents; ?>" class="r_dependentClass">
                                                                                                                <td>
                                                                                                                    <div class="form-group" style=" width: 160%;">
                                                                                                                        <label class="col-sm-3 control-label">Fullname<span class="required">*</span></label>
                                                                                                                        <div class="col-sm-5">
                                                                                                                            <input type="text" class="form-control" style="height:35px; margin-bottom: 10px; width: 120%;" placeholder="Required" name="nameDependent<?php echo $r_dependents; ?>" required/>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="form-group">
                                                                                                                        <label class="col-sm-3 control-label">Birthdate<span class="required">*</span></label>
                                                                                                                        <div class="col-sm-5">
                                                                                                                            <input type="text" style="height:35px; width: 110%; margin-bottom: 10px;"  id="datetimepicker_<?php echo $r_dependents; ?>" name="birthdateDependent<?php echo $r_dependents; ?>" class="myDate" placeholder="Required" autocomplete="off" required/>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="form-group">
                                                                                                                        <label class="col-sm-3 control-label">Relationship<span class="required">*</span></label>
                                                                                                                        <div class="col-sm-5">
                                                                                                                            <input type="text" class="form-control" style="height:35px; margin-bottom: 10px;" placeholder="Required" name="relationship<?php echo $r_dependents; ?>" required/>
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
                                                                                                            <td colspan="2">&nbsp;&nbsp;&nbsp;<b>Dependents (Health Insurance)</b>&nbsp;&nbsp;<b><i><font color="red"><span id="dependent_mes" hidden></span></font></i></b><br><br></td>
                                                                                                        </tr>
                                                                                                        <?php
                                                                                                        $r_dependentsHi = 1;
                                                                                                        $r_dependentCtrlHi = 4;

                                                                                                        echo '<input type="hidden" value="' . $r_dependentCtrlHi . '" id="r_dependentCtrlHi">';
                                                                                                        echo '<input type="hidden" id="r_dependentCountHi" value="1" name="r_dependentCountHi">';

                                                                                                        while ($r_dependentsHi <= $r_dependentCtrlHi) {
                                                                                                            ?>
                                                                                                            <tr id="r_dependentsHi<?php echo $r_dependentsHi; ?>" class="r_dependentClassHi" hidden>
                                                                                                                <td>
                                                                                                                    <div class="form-group" style=" width: 160%;">
                                                                                                                        <label class="col-sm-3 control-label">Fullname<span class="required">*</span></label>
                                                                                                                        <div class="col-sm-5">
                                                                                                                            <input type="text" class="form-control" style="height:35px; margin-bottom: 10px; width: 120%;" name="nameDependentHi<?php echo $r_dependentsHi; ?>"/>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="form-group">
                                                                                                                        <label class="col-sm-3 control-label">Birthdate<span class="required">*</span></label>
                                                                                                                        <div class="col-sm-5">
                                                                                                                            <input type="text" style="height:35px; width: 110%; margin-bottom: 10px;"  id="datetimepickerHi_<?php echo $r_dependentsHi; ?>" name="birthdateDependentHi<?php echo $r_dependentsHi; ?>" class="myDate" autocomplete="off"/>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="form-group">
                                                                                                                        <label class="col-sm-3 control-label">Relationship<span class="required">*</span></label>
                                                                                                                        <div class="col-sm-5">
                                                                                                                            <input type="text" class="form-control" style="height:35px; margin-bottom: 10px;" name="relationshipHi<?php echo $r_dependentsHi; ?>"/>
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
                                                                                                        $r_emergency = 1;
                                                                                                        $r_emergencyCtrl = 5;

                                                                                                        echo '<input type="hidden" value="' . $r_emergencyCtrl . '" id="r_emergencyCtrl">';
                                                                                                        echo '<input type="hidden" value="' . $r_emergency . '" id="r_emergency" name="r_emergency">';

                                                                                                        while ($r_emergency <= $r_emergencyCtrl) {
                                                                                                            ?>
                                                                                                            <tr id="r_emergency<?php echo $r_emergency; ?>">
                                                                                                                <td>
                                                                                                                    <div class="form-group" style=" width: 160%;">
                                                                                                                        <label class="col-sm-3 control-label">Fullname</label>
                                                                                                                        <div class="col-sm-5">
                                                                                                                            <input type="text" class="form-control" style="height:35px; margin-bottom: 10px; width: 120%;" name="nameEmergency<?php echo $r_emergency; ?>"/>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <div class="form-group">
                                                                                                                        <label class="col-sm-3 control-label">Relationship</label>
                                                                                                                        <div class="col-sm-5">
                                                                                                                            <input type="text" class="form-control" style="height:35px; margin-bottom: 10px;" name="relationshipEmergency<?php echo $r_emergency; ?>"/>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr id="r_emergency2<?php echo $r_emergency; ?>">
                                                                                                                <td>
                                                                                                                    <div class="form-group">
                                                                                                                        <label class="col-sm-3 control-label">Contact No.</label>
                                                                                                                        <div class="col-sm-5">
                                                                                                                            <input type="text" class="form-control" style="height:35px; margin-bottom: 35px;" name="contactEmergency<?php echo $r_emergency; ?>"/>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td colspan="2">
                                                                                                                    <div class="form-group">
                                                                                                                        <label class="col-sm-3 control-label">Address</label>
                                                                                                                        <div class="col-sm-5">
                                                                                                                            <input type="text" class="form-control" style="height:35px; margin-bottom: 30px;" name="addressEmergency<?php echo $r_emergency; ?>"/>
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
                                                                                                            <td colspan="2"><hr></td>
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
                                                                                                                        <!--<option value="" selected disabled>If Any</option>-->
                                                                                                                        <?php
                                                                                                                        $sql_seminars = mysql_query("SELECT DISTINCT(title) as title from training_seminar ORDER BY title Asc");
                                                                                                                        while ($row_seminars = mysql_fetch_array($sql_seminars)) {
                                                                                                                            echo '<option value="' . strtoupper($row_seminars['title']) . '">' . strtoupper($row_seminars['title']) . '</option>';
                                                                                                                        }
                                                                                                                        ?>
                                                                                                                    </select>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </td>
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
                                                                                                                    $(document).ready(function () {
                                                                                                                        $('.r_dependentClass').attr('hidden', true);
                                                                                                                        $('#minus_button').attr('hidden', true);
                                                                                                                        $('#r_dependentsHi1').attr('hidden', false);
                                                                                                                        $('#minus_buttonHi').attr('hidden', true);

                                                                                                                        $('.e_buttonHi').click(function () {
                                                                                                                            var id = ($(this).attr('id')).split('_');
                                                                                                                            var action = id[0];
                                                                                                                            var maxCtr = Number($('#r_dependentCtrlHi').val());
                                                                                                                            var ctr = Number($('#r_dependentCtrlHi').val());
//                                                                                                                            alert(action + '==add' + ctr + '>' + maxCtr);
                                                                                                                            if (action === 'add') {
                                                                                                                                var ctrl = Number($('#r_dependentCountHi').val()) + 1;
                                                                                                                                $('#r_dependentsHi' + ctrl).attr('hidden', false);
//                                                                                                                            $('#r_dependentsHi' + ctrl).attr('hidden', false);
                                                                                                                                $('#r_dependentCountHi').val(ctrl);
                                                                                                                                if (maxCtr == ctrl) {
                                                                                                                                    var ids = $(this).attr('id');
                                                                                                                                    $('#' + ids).attr('hidden', true);
                                                                                                                                }
                                                                                                                                if (ctrl > 1) {
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
                                                                                                                                if (Newctrl == 1) {
                                                                                                                                    $('#minus_buttonHi').attr('hidden', true);
                                                                                                                                }
                                                                                                                            }
                                                                                                                        });
                                                                                                                        $('.e_buttonChildren').click(function () {
                                                                                                                            var id = ($(this).attr('id')).split('_');
                                                                                                                            var action = id[0];
                                                                                                                            var maxCtr = Number($('#r_childrenCtrl').val());
                                                                                                                            var ctr = Number($('#r_childrenCtrl').val());
                                                                                                                            if (action === 'add') {
                                                                                                                                var ctrl = Number($('#r_childrenCount').val()) + 1;
                                                                                                                                $('#r_children' + ctrl).attr('hidden', false);
//                                                                                                                            $('#r_dependentsHi' + ctrl).attr('hidden', false);
                                                                                                                                $('#r_childrenCount').val(ctrl);
                                                                                                                                if (maxCtr == ctrl) {
                                                                                                                                    var ids = $(this).attr('id');
                                                                                                                                    $('#' + ids).attr('hidden', true);
                                                                                                                                }
                                                                                                                                if (ctrl > 1) {
                                                                                                                                    $('#minus_buttonChildren').attr('hidden', false);
                                                                                                                                }
                                                                                                                            } else if (action === 'minus') {
                                                                                                                                var ctrl = Number($('#r_childrenCount').val());
                                                                                                                                var Newctrl = Number($('#r_childrenCount').val()) - 1;
                                                                                                                                $('#r_children' + ctrl).attr('hidden', true);
                                                                                                                                $('#r_childrenCount').val(Newctrl);
                                                                                                                                if (ctrl > 1) {
                                                                                                                                    $('#add_buttonChildren').attr('hidden', false);
                                                                                                                                }
                                                                                                                                if (Newctrl == 1) {
                                                                                                                                    $('#minus_buttonChildren').attr('hidden', true);
                                                                                                                                }
                                                                                                                            }
                                                                                                                        });

                                                                                                                        var r_dependentCtrl = Number($('#r_emergencyCtrl').val());
                                                                                                                        var ctr = 1;
                                                                                                                        while (ctr <= r_dependentCtrl) {

                                                                                                                            if (ctr === 1) {
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
                                                                                                                    $('.myDate').change(function () {
                                                                                                                        var _thisName = this.name;
                                                                                                                        $('#defaultForm').formValidation('revalidateField', _thisName);
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
                                                                                                                        $('[name=civil_status]').change(function () {
                                                                                                                          if($(this).val() == 'married'){
                                                                                                                              $('.spouseDetails').show(300);
                                                                                                                          }else{
                                                                                                                              $('.spouseDetails').hide();
                                                                                                                          }
                                                                                                                            if ($(this).val() != 'single') {
                                                                                                                                $('#r_children1').show(300);
                                                                                                                                $('.spouseDetailsBtn').show(300);
                                                                                                                            } else {
                                                                                                                                $('.spouseDetails').hide();
                                                                                                                            }
                                                                                                                        });

                                                                                                                        $('#position').select2();
                                                                                                                        $('#slctTitle').select2({
                                                                                                                            tags: true,
                                                                                                                            realtime: false
                                                                                                                        });
                                                                                                                        $('[name=firstname]').select2({
                                                                                                                            tags: true,
                                                                                                                            realtime: false
                                                                                                                        });
                                                                                                                        $('[name=middlename]').select2({
                                                                                                                            tags: true,
                                                                                                                            realtime: false
                                                                                                                        });
                                                                                                                        $('[name=lastname]').select2({
                                                                                                                            tags: true,
                                                                                                                            realtime: false
                                                                                                                        });
                                                                                                                        $('#other_position').select2({
                                                                                                                            placeholder: "Please Select"
                                                                                                                        });
                                                                                                                        $('input[name="sketch"]').change(function () {
                                                                                                                            var sketch = $('input[name="sketch"]').val();
                                                                                                                            var arr_sketch = sketch.split('.');
                                                                                                                            var count_sketch = (arr_sketch.length) - 1;
                                                                                                                            var type = (arr_sketch[count_sketch]).toUpperCase();
                                                                                                                            if (type !== 'PDF' && type !== 'JPG' && type !== 'JPEG' && type !== 'PNG') {
                                                                                                                                alert("Invalid file type. Please choose image and pdf only.");
                                                                                                                                $('input[name="sketch"]').val('');
                                                                                                                            }
                                                                                                                        });
                                                                                                                    });
                                                                                                                </script>
                                                                                                                <!--dropdown menu src end-->

