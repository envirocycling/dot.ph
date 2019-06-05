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
                                $('input[type="checkbox"]').click(function(){
                                    if($(this).prop('checked') === true){
                                        $("#if_agency").show();
                                        $("#if_emp").hide();
                                    }else{
                                        $("#if_agency").hide();
                                        $("#if_emp").show();
                                    }
                                });
                            });
                        </script>
                        <link rel="stylesheet" type="text/css" href="css/override.css">
                    </div>
                    <!--Main body-->
                    <div class="main">
                        <?php
                        if (isset($_POST['register'])) {
                            $if_agency = $_POST['if_agency'];
                            $email = $_POST['email'];
                            $department = $_POST['department'];
                            if($if_agency == 1){
                                $registrant = $_POST['agency'];
                            }else{
                                $registrant = $_POST['employee'];
                            }
                            $sql_chk = mysql_query("SELECT * from email WHERE status='' and emp_num='$registrant' and department!='agency'");
                            if(mysql_num_rows($sql_chk) == 0){
                                if(mysql_query("INSERT INTO email (emp_num, department, email) VALUES('$registrant', '$department', '$email')") or die(mysql_error())){
                                    echo '<script>
                                                    location.replace("register_email.php?active=register&http=200");
                                               </script>';
                                }else{
                                    echo '<script>
                                                    location.replace("register_email.php?active=register&http=400");
                                               </script>';
                                }
                            }else{
                                if(mysql_query("UPDATE email SET emp_num='$registrant', department='$department', email='$email' WHERE emp_num = '$registrant'") or die(mysql_error())){
                                    echo '<script>
                                                    location.replace("register_email.php?active=register&http=200");
                                               </script>';
                                }else{
                                    echo '<script>
                                                    location.replace("register_email.php?active=register&http=400");
                                               </script>';
                                }
                            }
                        }
                        ?>
                        <br><br><center>
                            <table width='100%'>
                                <tr>
                                    <td class="header1" colspan="4"><center>Register Email Address<br></center></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><hr></td>
                                </tr>
                                <tr>
                                    <td><br><br></td>
                                </tr>
                            </table>
                            <?php
                                $sql_emails = mysql_query("SELECT * from email WHERE status=''");
                                while($row_emails = mysql_fetch_array($sql_emails)){
                                    echo $row_emails['department'].' ';
                                }
                            ?>
                            <form id="defaultForm" class="form-horizontal" method="post"><br>
                                <?php echo '<font color="red"><i>' . @$_SESSION['up_err'] . '</i></font>'; ?>
                                <table width="80%">
                                    <tr>
                                        <td colspan="2" align="center"><input type="checkbox" name="if_agency" value="1">If Agency</td>
                                    </tr>
                                    <tr id="if_emp">
                                        <td align="right">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Employee Name<span class="required">*</span></label>
                                                <div class="col-sm-5">
                                                    <select name="employee" class="form-control" style="height:35px;" required>
                                                        <option value="" selected disabled>Please Select</option>
                                                        <?php
                                                        $sql_employee = mysql_query("SELECT * from employees ORDER BY lastname Asc") or die(mysql_error());
                                                        while ($row_employee = mysql_fetch_array($sql_employee)) {
                                                                echo '<option value="' . $row_employee['emp_num'] . '">' . strtoupper($row_employee['lastname'] . ', ' . $row_employee['firstname']) . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                        </td>
                                    </tr>
                                    <tr id="if_agency" hidden>
                                        <td align="right">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Agency List<span class="required">*</span></label>
                                                <div class="col-sm-5">
                                                    <select name="agency" class="form-control" style="height:35px;">
                                                        <option value="" selected disabled>Please Select</option>
                                                        <?php
                                                        $sql_employee = mysql_query("SELECT * from company WHERE type=0 ORDER BY name Asc") or die(mysql_error());
                                                        while ($row_employee = mysql_fetch_array($sql_employee)) {
                                                                echo '<option value="' . $row_employee['company_id'] . '">' . strtoupper($row_employee['name']) . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Email Address<span class="required">*</span></label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" style="height:35px;" placeholder="Required" name="email" autocomplete="off" required/>
                                                </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Department<span class="required">*</span></label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" style="height:35px;" placeholder="Required" name="department" autocomplete="off" required/>
                                                </div>
                                        </td>
                                    </tr>
                                    <tr><td align="right">
                                            <div class="form-group">
                                                <div class="col-sm-5">
                                                    <input type="submit" class="btn btn-primary" value="Register Email Address" name="register">
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
