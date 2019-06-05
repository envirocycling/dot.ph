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
                        <link rel="stylesheet" type="text/css" href="css/override.css">
                    </div>
                    <!--Main body-->
                    <div class="main">
                        <?php
                        if (isset($_POST["submit"])) {
                            @$target_dir = "../../images/signature/";
                            $new_filename = $_POST['employee'].'.png';
                            $chk_fname = $target_dir.$new_filename;
                            @$target_file = $target_dir . basename($_FILES["signature"]["name"]);
                            $_SESSION['err'] = '';
                            @$imageFileType = pathinfo(@$target_file, PATHINFO_EXTENSION);
                                
                                // Check if file already exists
                                if (file_exists($chk_fname)) {
                                    unlink($chk_fname);
                                }
                                if (move_uploaded_file(@$_FILES["signature"]["tmp_name"], $target_dir.$new_filename)) {
                                    unset($_SESSION['err']);
                                    ?>
                                    <script>
                                        location.replace("register_signature.php?active=register&http=200");
                                    </script>		
                                    <?php
                                } else {
                                    echo '<script>
                                             location.replace(register_signature.php?active=register&http=400");
                                        <script>';
                                }
                        }
                        ?>
                        <br><br><center>
                            <table width='100%'>
                                <tr>
                                    <td class="header1" colspan="4"><center>Register E-Signature<br></center></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><hr></td>
                                </tr>
                                <tr>
                                    <td><br><br></td>
                                </tr>
                            </table>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data"><br>
                                <table width="80%">
                                    <tr>
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
                                    <tr>
                                        <td align="right">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">E-Signature<span class="required">*</span></label>
                                                <div class="col-sm-5">
                                                    <input type="file" class="form-control" style="height:35px;" name="signature" required>
                                                </div>
                                        </td>
                                    </tr>
                                    <tr><td align="right">
                                            <div class="form-group">
                                                <div class="col-sm-5">
                                                    <input type="submit" class="btn btn-primary" value="Register E-Signature" name="submit">
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
