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
                            $(document).keypress(
                                function(event){
                                 if (event.which == '13') {
                                    event.preventDefault();
                                    alert("Kindly click the button to submit.");
                                  }
                            });
                        </script>
                        <link rel="stylesheet" type="text/css" href="css/override.css">
                    </div>
                    <!--Main body-->
                    <div class="main">
                        <?php
                        if(isset($_POST['update'])){
                            $username = strtolower($_POST['username']);
                            $ses_uname = strtolower($_SESSION['username-3']);
                            $password = $_POST['password'];
                            $current_password = $_POST['current_password'];
                            if(!is_numeric($username)){
                                if($_SESSION['password'] == $current_password){
                                    if($username == $ses_uname){
                                        if(mysql_query("UPDATE users SET password = '$password' WHERE username='$username'") or die(mysql_error())){
                                            $_SESSION['password'] = $password;
                                           echo '<script>
                                                    location.replace("myaccount_update.php?active=myaccount&http=201");
                                               </script>'; 
                                        }else{
                                            echo '<script>
                                                    location.replace("myaccount_update.php?active=myaccount&http=400");
                                               </script>'; 
                                        }
                                    }else{
                                     $sql_chk = mysql_query("SELECT * from users WHERE username='$username'")or die(mysql_error());
                                        if(mysql_num_rows($sql_chk) == 0){
                                            $_SESSION['password'] = $password;
                                            $_SESSION['username-3'] = $username;
                                            if(mysql_query("UPDATE users SET username='$username', password='$password' WHERE user_id='".$_SESSION['user_id']."'") or die(mysql_error())){
                                             echo '<script>
                                                    location.replace("myaccount_update.php?active=myaccount&http=201");
                                               </script>'; 
                                            }else{
                                                echo '<script>
                                                        location.replace("myaccount_update.php?active=myaccount&http=400");
                                                   </script>'; 
                                            }
                                        }else{
                                            @$_SESSION['up_err'] .= 'Username already exist. ';
                                        }
                                    }
                                }else{
                                    @$_SESSION['up_err'] .= 'Incorrect Current Password. ';
                                }
                            }else{
                                @$_SESSION['up_err'] .= 'Username must not a number. ';
                            }
                            
                        }else if (isset($_POST["submit"])) {
                            @$target_dir = "../../images/employee/";
                            $new_filename = $row_user['emp_num'].'.png';
                            $chk_fname = $target_dir.$new_filename;
                            @$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                            @$uploadOk = 1;
                            $_SESSION['err'] = '';
                            @$imageFileType = pathinfo(@$target_file, PATHINFO_EXTENSION);
                            // Check if image file is a actual image or fake image
                            if (isset($_POST["submit"])) {
                                @$check = getimagesize(@$_FILES["fileToUpload"]["tmp_name"]);
                                if (@$check !== false) {
                                    @$uploadOk = 1;
                                } else {
                                    $_SESSION['err'] .= "File is not an image.";
                                    @$uploadOk = 0;
                                }
                            }
                            /* Check file size
                            if (@$_FILES["fileToUpload"]["size"] > 7000000) {
                                echo "Sorry, your file is too large.";
                                @$uploadOk = 0;
                            }*/
                            // Allow certain file formats
                            if (@$imageFileType != "jpg" && @$imageFileType != "png" && @$imageFileType != "jpeg" && @$imageFileType != "gif") {
                               $_SESSION['err'] .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                @$uploadOk = 0;
                            }
                            // Check if $uploadOk is set to 0 by an error
                            if (@$uploadOk == 0) {
                                $_SESSION['err'] .= "Sorry, your file was not uploaded.";
                                // if everything is ok, try to upload file
                            } else {
                                
                                // Check if file already exists
                                if (file_exists($chk_fname)) {
                                    unlink($chk_fname);
                                }
                                if (move_uploaded_file(@$_FILES["fileToUpload"]["tmp_name"], $target_dir.$new_filename)) {
                                    unset($_SESSION['err']);
                                    ?>
                                    <script>
                                        location.replace("myaccount_update.php?active=myaccount&http=201");
                                    </script>		
                                    <?php
                                } else {
                                    echo '<script>
                                             location.replace("myaccount_update.php?active=myaccount&http=400");
                                        <script>';
                                }
                            }
                        }else{
                            unset($_SESSION['err']);
                            unset($_SESSION['up_err']);
                        }
                        ?>
                        <br><br><center>
                            <table width='100%'>
                                <tr>
                                    <td class="header1" colspan="4"><center>Update Account<br></center></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><hr></td>
                                </tr>
                                <tr>
                                    <td><br><br></td>
                                </tr>
                            </table>
                            <table width="80%">
                                <tr>
                                    <td colspan="2"><center>
                                        <?php
                                        $image_path = "../../images/employee/" . $row_emp['emp_num'] . ".png";
                                        if (file_exists($image_path)) {
                                            ?>
                                            <img src="../../images/employee/<?php echo $row_emp['emp_num']; ?>.png" style="width:300px;">
                                            <?php } else {
                                            ?>
                                            <img src="../../images/employee/icon.png" style="width:300px;">
                                        <?php }
                                        ?></center></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><center><br><form method="post" enctype="multipart/form-data">
                                            <input type="file" name="fileToUpload" id="fileToUpload" required accept="image/*">
                                            <input type="submit" class="btn btn-primary" value="Change Picture" name="submit"><br>
                                            <?php echo '<font color="red"><i>'.@$_SESSION['err'].'<i></font>';?>
                                        </form></center></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><hr></td>
                                </tr>
                                </table>
                            <form id="defaultForm" class="form-horizontal" method="post"><br>
                            <?php echo '<font color="red"><i>'.@$_SESSION['up_err'].'</i></font>';?>
                            <table width="80%">
                                <tr>
                                    <td align="right">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Username<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" style="height:35px;" placeholder="Required" value="<?php echo $_SESSION['username-4'];?>" name="username" autocomplete="off"/>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Password<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="password" class="form-control" style="height:35px;" placeholder="Required" name="password"/>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Current-Password<span class="required">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="password" class="form-control" style="height:35px;" placeholder="Required" name="current_password"/>
                                        </div>
                                    </td>
                                </tr>
                                <tr><td align="right">
                                        <div class="form-group">
                                            <div class="col-sm-5">
                                                <input type="submit" class="btn btn-primary" value="Update Account" name="update">
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

