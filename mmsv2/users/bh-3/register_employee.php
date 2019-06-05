<!DOCTYPE html>
<html lang="en">
    <link rel="stylesheet" href="validation/bootstrap.css"/>
    <script type="text/javascript" src="validation/jquery.min.js"></script>
    <script type="text/javascript" src="validation/formValidation.js"></script>
    <script type="text/javascript" src="validation/bootstrap.js"></script>
    <script type="text/javascript" src="validation/form_validation_regEmp.js"></script>
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
                        <br><br>
                        <form action="process/register_employee_pro.php" id="defaultForm" class="form-horizontal" method="post">
                            <table width='100%'>
                                <tr>
                                    <td class="header1" colspan="4"><center>New Employee<br></center></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><hr></td>
                                </tr>
                                <!--Personal Info start-->
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Firstname<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px;" placeholder="Required" name="firstname"/>
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
                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px;" placeholder="Optional" name="middlename"/>
                                            </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px; width: 120%;" placeholder="Town/City" name="address_towncity"/>
                                            </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Lastname<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px;" placeholder="Required" name="lastname"/>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px; width: 120%;" placeholder="Province" name="address_province"/>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Birthdate<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" style="height:35px; width: 110%; margin-bottom: 10px;"  id="datetimepicker" name="birthdate" placeholder="Required" autocomplete="off" required/>
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
                                                <select type="text" class="form-control" style="height:35px; margin-bottom: 10px;" placeholder="Required" name="civil_status"/>
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
                                    <td> </td>
                                </tr>
                                <!--Personal Info end-->
                                <tr>
                                    <td colspan="2"><hr></td>
                                </tr>
                                <!--Second Info star-->
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Date Hired<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                 <input type="text" style="height:35px; width: 110%; margin-bottom: 10px;"  id="datetimepicker2" placeholder="Required" name="date_hired" autocomplete="off" required/>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Date Start<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" style="height:35px; width: 120%; margin-bottom: 10px;"  id="datetimepicker3" placeholder="Required" name="date_start" autocomplete="off" required/>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                             <label class="col-sm-3 control-label">Company<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <select type="text" class="form-control" style="height:35px; margin-bottom: 10px;" placeholder="Required" name="company"/>
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
                                                            if(strpos($row_user['branch_id'],'('.$row_branch['branch_id'].')') !== false){
                                                            echo '<option value="'.$row_branch['branch_id'].'">'.ucwords($row_branch['branch_name']).'</option>';
                                                            }
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
                                                <select name="position" id="position" class="form-control" style="height:35px; width: 110%; margin-bottom: 10px;" >
                                                    <option value="" selected disabled> Please Select</option>
                                                    <?php
                                                    $sql_position = mysql_query("SELECT * from positions WHERE status='' ORDER BY position Asc") or die (mysql_error());
                                                        while($row_position = mysql_fetch_array($sql_position)){
                                                            echo '<option value="'.$row_position['p_id'].'">'.$row_position['position'].'</option>';
                                                        }
                                                    ?>
                          
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Status<span class="required">*</span></label>
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
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Stay In<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <select type="text" class="form-control" style="height:35px; margin-bottom: 10px;" placeholder="Required" name="stayin"/>
                                                    <option value="" selected disabled>Select</option>
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
                                                <input type="text" class="form-control" style="height:35px; width: 120%; margin-bottom: 10px;" placeholder="Required" name="tin"/>
                                            </div>
                                        <div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">SSS No.<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px;" placeholder="Required" name="sss"/>
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
                                                <input type="text" class="form-control" style="height:35px; margin-bottom: 10px;" placeholder="Required" name="hdmf"/>
                                            </div>
                                        <div>
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
                                    <td colspan="2"><br><br><br><br><center>
                                                <input type="submit" class="btn btn-primary" value="Submit Request to Add Employee"><center>
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
       });
 </script>
 <!--dropdown menu src end-->

