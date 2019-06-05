<link rel="stylesheet" type="text/css" href="validation/bootstrap.css">
<link rel="stylesheet" type="text/css" href="validation/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/emp_record.css">
<script type="text/javascript" src="validation/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        //alert("asdsad");
        $("#form_up").hide();

        $("#myImage").click(function () {
            var ctr = Number($("#control").val());
            if (ctr == 0) {
                $("#form_up").hide(100);
                $("#control").val('1');
            } else {
                $("#form_up").show(100);
                $("#control").val('0');
            }
        });
    });

</script>
<style>
    #myImage:hover{
        cursor: pointer;        
    }
    table{
        text-transform: uppercase;
    }
</style>
<?php
session_start();
if (!isset($_SESSION['username-6'])) {
    header("Location:../../index.php");
}
include('../../connect.php');
if (isset($_POST['update'])) {
    $emp_num = $_GET['emp_num'];

    @$target_dir = "../../images/emp-data/";
    $new_filename = $emp_num . '.png';
    $chk_fname = $target_dir . $new_filename;
    unlink($chk_fname);
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
      } */
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
        if (move_uploaded_file(@$_FILES["fileToUpload"]["tmp_name"], $target_dir . $new_filename)) {
            unset($_SESSION['err']);
            ?>
            <script>
                window.top.location.href = "view_employee.php?status=active&active=view&http=201";
            </script>		
            <?php
        } else {
            echo '<script>
                                             window.top.location.href="view_employee.php?status=active&active=view&http=400";
                                        <script>';
        }
    }
} elseif (isset($_POST['upload'])) {
    $emp_num = $_GET['emp_num'];

    @$target_dir = "../../images/emp-data/";
    $new_filename = $emp_num . '.png';
    $chk_fname = $target_dir . $new_filename;
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
      } */
    // Allow certain file formats
    @$imageFileType = strtolower($imageFileType);
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
        if (move_uploaded_file(@$_FILES["fileToUpload"]["tmp_name"], $target_dir . $new_filename)) {
            unset($_SESSION['err']);
            ?>
            <script>
                window.top.location.href = "view_employee.php?status=active&active=view&http=201";
            </script>		
            <?php
        } else {
            echo '<script>
                                             window.top.location.href="view_employee.php?status=active&active=view&http=400";
                                        <script>';
        }
    }
} else if (@$_GET['type'] == 'request') {
    $request_id = $_GET['emp_num'];

    $sql_emp_data = mysql_query("SELECT * from employees_request WHERE request_id='$request_id'") or die(mysql_error());
    $row_emp_data = mysql_fetch_array($sql_emp_data);

    $company = mysql_query("SELECT * from company WHERE status='' and company_id='" . $row_emp_data['company_id'] . "'") or die(mysql_error());
    $row_company = mysql_fetch_array($company);

    $position = mysql_query("SELECT * from positions WHERE status='' and p_id='" . $row_emp_data['position_id'] . "'") or die(mysql_error());
    $row_position = mysql_fetch_array($position);

    $branch = mysql_query("SELECT * from branches WHERE status='' and branch_id='" . $row_emp_data['branch_id'] . "'") or die(mysql_error());
    $row_branch = mysql_fetch_array($branch);

    $sql_rank = mysql_query("SELECT * from rank WHERE r_id='" . $row_emp_data['rank_id'] . "'") or die(mysql_error());
    $row_rank = mysql_fetch_array($sql_rank);

    $emp_status = mysql_query("SELECT * from employment_status WHERE e_id='" . $row_emp_data['status_id'] . "'") or die(mysql_error());
    $row_emp_status = mysql_fetch_array($emp_status);

    if (!empty($row_emp_data['middlename'])) {
        $middlename = ', ' . $row_emp_data['middlename'];
    } else {
        $middlename = '';
    }
} else {
    $emp_num = $_GET['emp_num'];

    $sql_emp_data = mysql_query("SELECT * from employees WHERE emp_num='$emp_num'") or die(mysql_error());
    if (mysql_num_rows($sql_emp_data) == 0) {
        $sql_emp_data = mysql_query("SELECT * from employees_deactivated WHERE emp_num='$emp_num'") or die(mysql_error());
        $emp_deactivated = 1;
    }
    $row_emp_data = mysql_fetch_array($sql_emp_data);

    $company = mysql_query("SELECT * from company WHERE status='' and company_id='" . $row_emp_data['company_id'] . "'") or die(mysql_error());
    $row_company = mysql_fetch_array($company);

    $position = mysql_query("SELECT * from positions WHERE p_id='" . $row_emp_data['position_id'] . "'") or die(mysql_error());
    $row_position = mysql_fetch_array($position);

    $otherPosition = '';
    @$arrOtherPosition = str_replace('[', '', explode(']', $row_emp_data['other_positionId']));
    foreach ($arrOtherPosition as $thisVal) {
        $positionOther = mysql_query("SELECT * from positions WHERE  p_id='$thisVal'") or die(mysql_error());
        $row_positionOther = mysql_fetch_array($positionOther);
        $otherPosition .= strtoupper($row_positionOther['position']) . ', ';
    }

    $position = mysql_query("SELECT * from positions WHERE  p_id='" . $row_emp_data['position_id'] . "'") or die(mysql_error());
    $row_position = mysql_fetch_array($position);

    $branch = mysql_query("SELECT * from branches WHERE status='' and branch_id='" . $row_emp_data['branch_id'] . "'") or die(mysql_error());
    $row_branch = mysql_fetch_array($branch);

    $sql_rank = mysql_query("SELECT * from rank WHERE r_id='" . $row_emp_data['rank_id'] . "'") or die(mysql_error());
    $row_rank = mysql_fetch_array($sql_rank);

    $emp_status = mysql_query("SELECT * from employment_status WHERE e_id='" . $row_emp_data['status_id'] . "'") or die(mysql_error());
    $row_emp_status = mysql_fetch_array($emp_status);

    $arr_tertiary = explode('~', $row_emp_data['tertiary']);
    $arr_secondary = explode('~', $row_emp_data['secondary']);
    $arr_primary = explode('~', $row_emp_data['elementary']);

    if (!empty($row_emp_data['middlename'])) {
        $middlename = ', ' . $row_emp_data['middlename'];
    } else {
        $middlename = '';
    }
}
echo '<input type="hidden" id="control" value="1">';
echo '<center>';
echo @$_SESSION['err'];
if (@$emp_deactivated == 1) {
    echo '<font color="red"><h3><b>Separated</b></h3></font>';
}
echo '<table>
        <tr>
            <td>';
$image_path = "../../images/emp-data/" . $row_emp_data['emp_num'] . ".png";
if (file_exists($image_path)) {
    ?>
    <img src="../../images/emp-data/<?php echo $row_emp_data['emp_num']; ?>.png" id="myImage" onclick="f_upload();" width="150" height="150">
    <span id="form_up"><form action="" method="post" enctype="multipart/form-data">
            Change Photo: <input type="file" name="fileToUpload" id="fileToUpload" required accept="image/*"><br>
            <input type="submit" class="btn btn-primary" value="Update" name="update">
        </form>
    </span>
<?php } else {
    ?>
    <img src="../../images/no_photo_icon.png" id="myImage" onclick="f_upload();" width="150" height="150">
    <span id="form_up">
        <form action="" method="post" enctype="multipart/form-data">
            Upload Photo: <input type="file" name="fileToUpload" id="fileToUpload" required accept="image/*"><br>
            <input type="submit" class="btn btn-success" value="Upload" name="upload">
        </form>
    </span>
    <?php
}
echo '</td>';
if (@$emp_deactivated == 1) {
    echo '<td><b>Date Separated: <i>' . date('F d, Y', strtotime($row_emp_data['date_separated']));
    $sql_clearance = mysql_query("SELECT * from form_clearance WHERE emp_num='".$row_emp_data['emp_num']."'") or die(mysql_error());
    if ($row_company['type'] == '1' && mysql_num_rows($sql_clearance) > 0) {
        echo '<br><a href="../../forms/clearance.php?emp_num=' . $row_emp_data['emp_num'] . '" target="_blank">View clearance form</a></i></b>';
    } echo'</td>
            <td><b>Reason: <i>' . $row_emp_data['reason'] . '</i></b></td>';
}
echo '</tr>
</table>';
echo '<center><table>
        <tr>
            <td id="logo" align="right"><img src="../../images/logo.png" height="80" width="80"></td>
            <td><span class="h1">Envirocycling Fiber Inc</span></td>
        </tr>
    </table></center>';

echo '<center><table>
        <tr>
            <td colspan="4" class="break"><span class="h2">Personal Information</span></td>
        </tr>
        <tr>
            <td class="td_1" ' . @$attr_name . '>Fullname (L,F,M):</td>
            <td align="left"><span class="val">' . $row_emp_data['lastname'] . ', ' . $row_emp_data['firstname'] . ', ' . $row_emp_data['middlename'] . '</span></td>
            <td class="td_1">Civil Status:</td>
            <td align="left"><span class="val">' . ucwords($row_emp_data['civil_status']) . '</span></td>
        </tr>
        <tr>
            <td class="td_1">Address:</td>
            <td align="left"><span class="val">' . $row_emp_data['st_brgy'] . ',  ' . $row_emp_data['town_city'] . ',  ' . $row_emp_data['province'] . '</span></td>
            <td class="td_1">Gender:</td>
            <td align="left"><span class="val">' . ucwords($row_emp_data['gender']) . '</span></td>
        </tr>
        <tr>
            <td class="td_1">Birthdate:</td>
            <td align="left"><span class="val">' . date('F d, Y', strtotime($row_emp_data['birthdate'])) . '</span></td>
            <td class="td_1">Contact No:</td>
            <td align="left"><span class="val">' . $row_emp_data['contact_no'] . '</span></td>
        </tr>
        <tr>
            <td colspan="4" class="break"><span class="h2">Family Background</span></td>
        <tr>
        <tr>
            <td colspan="2" class="history"><center><b>Spouse\'s Maiden Fullname</b></center></td>
            <td colspan="2" class="history"><center><b>Occupation</b></center></td>
        </tr>';
echo '<tr>';
if (!empty($row_emp_data['spouse'])) {
    @$_spouse = explode('~', $row_emp_data['spouse']);
    echo '<td colspan="2" class="history"><center>' . strtoupper(@$_spouse[0]) . '</center></td>
      <td colspan="2" class="history"><center>' . strtoupper(@$_spouse[1]) . '</center></td>';
    echo '</tr>';
}
echo '<tr>
            <td colspan="2" class="history"><center><b>Mother\'s Maiden Fullname</b></center></td>
            <td colspan="2" class="history"><center><b>Occupation</b></center></td>
        </tr>';
echo '<tr>';
if (!empty($row_emp_data['mother'])) {
    @$_mother = explode('~', $row_emp_data['mother']);
    echo '<td colspan="2" class="history"><center>' . strtoupper(@$_mother[0]) . '</center></td>
      <td colspan="2" class="history"><center>' . strtoupper(@$_mother[1]) . '</center></td>';
    echo '</tr>';
    echo '<tr>
            <td colspan="2" class="history"><center><b>Father\'s Fullname</b></center></td>
            <td colspan="2" class="history"><center><b>Occupation</b></center></td>
        </tr>';
    echo '<tr>';
}
if (!empty($row_emp_data['father'])) {
    @$_father = explode('~', $row_emp_data['father']);
    echo '<td colspan="2" class="history"><center>' . strtoupper(@$_father[0]) . '</center></td>
      <td colspan="2" class="history"><center>' . strtoupper(@$_father[1]) . '</center></td>';
    echo '</tr>';
    echo '<tr>
            <td colspan="2" class="history"><center><b>Name of Child</b></center></td>
            <td colspan="2" class="history"><center><b>Date of Birth</b></center></td>
        </tr>';
}
if (!empty($row_emp_data['children'])) {
    @$_child = str_replace('[', '', explode(']', $row_emp_data['children']));
    @$_childCount = count($_child) - 1;
    $_ctr = 0;
    while ($_ctr < $_childCount) {
        @$_echChild = explode('~', @$_child[$_ctr]);
        if (!empty($_echChild[1])) {
            $bday = date('F d, Y', strtotime($_echChild[1]));
        } else {
            $bday = '';
        }
        echo '<tr>
            <td colspan="2" class="history"><center>' . strtoupper(@$_echChild[0]) . '</center></td>
            <td colspan="2" class="history"><center>' . strtoupper($bday) . '</center></td>';
        echo '</tr>';
        $_ctr++;
    }
}
echo '<tr>
            <td colspan="4" class="break"><span class="h2">Educational Attainment</span></td>
        <tr>
        <tr>
            <td class="td_1">Tertiary:</td>
            <td align="left"><span class="val">' . strtoupper(@$arr_tertiary[0]) . '</span></td>
            <td class="td_1">Year Graduated:</td>
            <td align="left"><span class="val">' . @$arr_tertiary[1] . '</span></td>
        </tr>
        <tr>
            <td class="td_1">Secondary:</td>
            <td align="left"><span class="val">' . strtoupper(@$arr_secondary[0]) . '</span></td>
            <td class="td_1">Year Graduated:</td>
            <td align="left"><span class="val">' . @$arr_secondary[1] . '</span></td>
        </tr>
        <tr>
            <td class="td_1">Elementary:</td>
            <td align="left"><span class="val">' . strtoupper(@$arr_primary[0]) . '</span></td>
            <td class="td_1">Year Graduated:</td>
            <td align="left"><span class="val">' . @$arr_primary[1] . '</span></td>
        </tr>
            <td colspan="4" class="break"><span class="h2">Employment Details</span></td>
        </tr>
        <tr>
            <td class="td_1">Date Hired:</td>
            <td align="left"><span class="val">' . date('F d, Y', strtotime($row_emp_data['date_hired'])) . '</span></td>
            <td>Orig. Hiring Date:</td>
            <td align="left"  style="width:20%;"><span class="val">' . date('F d, Y', strtotime($row_emp_data['date_start'])) . '</span></td>
        </tr>
        <tr>
            <td class="td_1">Company:</td>
            <td align="left"><span class="val">' . $row_company['description'] . ' (' . $row_company['name'] . ')</span></td>
            <td style="width:20%;">Branch:</td>
            <td align="left"><span class="val">' . $row_branch['branch_name'] . '</span></td>
        </tr>
        <tr>
            <td class="td_1">Position:</td>
            <td align="left"><span class="val">' . $row_position['position'] . '</span></td>
			<td class="td_1">Other Position:</td>
            <td align="left"><span class="val">' . rtrim($otherPosition, ', ') . '</span></td>	
        </tr>
        <tr>
            <td class="td_1">Rank:</td>
            <td align="left"><span class="val">' . $row_rank['description'] . '</span></td>
            <td style="width:20%;">Employment Status:</td>
            <td align="left"><span class="val">' . $row_emp_status['code'] . '</span></td>		
        </tr>
        <tr>
            <td class="td_1">Stay-in:</td>
            <td align="left"><span class="val">' . $row_emp_data['stayin'] . '</span></td>
            <td class="td_1">TIN:</td>
            <td align="left"><span class="val">' . $row_emp_data['tin'] . '</span></td>
        </tr>
        <tr>
            <td class="td_1">SSS No:</td>
            <td align="left"><span class="val">' . $row_emp_data['sss_no'] . '</span></td>
            <td class="td_1">PHIC No:</td>
            <td align="left"><span class="val">' . $row_emp_data['phic_no'] . '</span></td>
        </tr>
        <tr>
            <td class="td_1">HDMF No:</td>
            <td align="left"><span class="val">' . $row_emp_data['hdmf_no'] . '</span></td>
        </tr>';


// if(empty(@$_GET['type'])){
echo '<tr>
        
            <td class="td_1">Tax Code:</td>
            <td align="left"><span class="val">' . strtoupper($row_emp_data['tax_code']) . '</span></td>';
if (@$emp_deactivated == 1) {
    echo '<td style="width:20%;">Date Separated:</td>
                <td align="left"><span class="val">';
    if (strtotime($row_emp_data['date_separated']) > 0) {
        echo date('F d, Y', strtotime($row_emp_data['date_separated']));
    } echo'</span></td>';
} else {
    echo '<td style="width:20%;">Regularization Date:</td>
                <td align="left"><span class="val">';
    if (strtotime($row_emp_data['date_regularization']) > 0) {
        echo date('F d, Y', strtotime($row_emp_data['date_regularization']));
    } echo'</span></td>';
}
echo '</tr>
            <tr>
                <td class="td_1">Home Address Sketch:</td>
                <td align="left" colspan="3"><span class="val">';
if (empty($row_emp_data['sketch'])) {
    echo 'No uploaded sketch';
} else {
    echo '<i><a href="../../images/sketch/' . $row_emp_data['emp_num'] . '-' . $row_emp_data['sketch'] . '" target="_blank">' . $row_emp_data['sketch'];
} echo '</a></i></span></td>
            </tr>
        <tr>
            <td colspan="4" class="break"><span class="h2">Dependents (Tax Code)</span></td>
        </tr>
        <tr>
            <td colspan="2" class="history"><center><b>Fullname</b></center></td>
            <td class="history"><center><b>Birthdate</b></center></td>
            <td class="history"><center><b>Relationship</b></center></td>
        </tr>';
$sql_dependents = mysql_query("SELECT * from employees WHERE emp_num = '$emp_num'") or die(mysql_error());
$row_dependents = mysql_fetch_array($sql_dependents);
$arr_depedents = str_replace("[", "", explode("]", $row_dependents['dependents']));
foreach ($arr_depedents as $sel_dependents) {
    $dependent_data = explode("~", $sel_dependents);
    if (!empty($sel_dependents)) {
        echo '<tr>
                            <td colspan="2" class="history">' . strtoupper($dependent_data[0]) . '</td>
                            <td class="history">' . date('F d, Y', strtotime($dependent_data[1])) . '</td>
                            <td class="history">' . strtoupper($dependent_data[2]) . '</td>
                        </tr>';
    }
}
echo '<tr>
            <td colspan="4" class="history"></td>
        </tr>
        <tr>
            <td colspan="4" class="break"><span class="h2">Dependents (Health Insurance)</span></td>
        </tr>
        <tr>
            <td colspan="2" class="history"><center><b>Fullname</b></center></td>
            <td class="history"><center><b>Birthdate</b></center></td>
            <td class="history"><center><b>Relationship</b></center></td>
        </tr>';
$sql_dependents1 = mysql_query("SELECT * from employees WHERE emp_num = '$emp_num'") or die(mysql_error());
$row_dependents1 = mysql_fetch_array($sql_dependents1);
$arr_depedents1 = explode("|", $row_dependents1['dependentsHi']);
foreach ($arr_depedents1 as $sel_dependents1) {
    $dependent_data1 = explode("~", $sel_dependents1);
    if (!empty($sel_dependents1)) {
        echo '<tr>
                            <td colspan="2" class="history">' . strtoupper($dependent_data1[0]) . '</td>
                            <td class="history">' . date('F d, Y', strtotime($dependent_data1[1])) . '</td>
                            <td class="history">' . strtoupper($dependent_data1[2]) . '</td>
                        </tr>';
    }
}
echo '<tr>
            <td colspan="4" class="history"></td>
        </tr>
         <tr>
            <td colspan="4" class="break"><span class="h2">Emergency Contact</span></td>
        </tr>
        <tr>
            <td class="history"><center><b>Fullname</b></center></td>
            <td class="history"><center><b>Address</b></center></td>
            <td class="history"><center><b>Contact</b></center></td>
            <td class="history"><center><b>Relationship</b></center></td>
        </tr>';
$sql_emergency = mysql_query("SELECT * from employees WHERE emp_num = '$emp_num'") or die(mysql_error());
$row_emergency = mysql_fetch_array($sql_emergency);
$arr_emergency = str_replace("[", "", explode("]", $row_emergency['emergency']));
foreach ($arr_emergency as $sel_emergency) {
    $emergency_data = explode("~", $sel_emergency);
    if (!empty($sel_emergency)) {
        echo '<tr>
                            <td class="history">' . strtoupper($emergency_data[0]) . '</td>
                            <td class="history">' . strtoupper($emergency_data[4]) . '</td>
                            <td class="history">' . strtoupper($emergency_data[3]) . '</td>
                            <td class="history">' . strtoupper($emergency_data[2]) . '</td>
                        </tr>';
    }
}
echo '<tr>
            <td colspan="4" class="history"></td>
        </tr>
        <tr>
            <td colspan="4" class="break"><span class="h2">Position Movement History</span></td>
        </tr>
        <tr>
            <td class="history"><center><b>Date</b></center></td>
            <td class="history" colspan="2"><center><b>Position</b></center></td>
            <td class="history"><center><b>Type</b></center></td>
        </tr>';
//query position history start
$sql_posHis = mysql_query("SELECT * from manpower_movement WHERE emp_num='$emp_num' and type LIKE 'transfer%' and status = 'transferred' ORDER BY date_submitted Asc") or die(mysql_error());
while ($row_posHis = mysql_fetch_array($sql_posHis)) {
    $pos_ex = explode("~", $row_posHis['type']);
    $slctd_pos = mysql_query("SELECT * from positions WHERE p_id='" . $pos_ex[1] . "'") or die(mysql_error());
    $row_slctd_pos = mysql_fetch_array($slctd_pos);
    if ($row_posHis['class'] == 'permanent') {
        $date_effecttive = date('F d, Y', strtotime($row_posHis['per_date']));
    } else {
        $date_effecttive = date('F d, Y', strtotime($row_posHis['temp_date1'])) . '<br/>to<br/>' . date('F d, Y', strtotime($row_posHis['temp_date2']));
    }

    echo '<tr>
                                <td class="history">' . $date_effecttive . '</td>
                                <td colspan="2" class="history">' . $row_slctd_pos['position'] . '</td>
                                <td class="history">' . strtoupper($row_posHis['class']) . '</td>
                          </tr>';
}
//query position history end
echo '<tr>
            <td colspan="4" class="history"></td>
        </tr>';
echo '<tr>
            <td colspan="4" class="break"><span class="h2">Company/Branch Movement History</span></td>
        </tr>
        <tr>
            <td class="history"><center><b>Date</b></center></td>
            <td class="history" colspan="2"><center><b>Company/Branch</b></center></td>
            <td class="history"><center><b>Type</b></center></td>
        </tr>';
//query branch history start
$sql_braHis = mysql_query("SELECT * from manpower_movement WHERE emp_num='$emp_num' and status = 'transferred' and (type LIKE 'move%' or type LIKE 'reassign%') ORDER BY date_submitted Asc") or die(mysql_error());
while ($row_braHis = mysql_fetch_array($sql_braHis)) {
    $branch_ex = explode('~', $row_braHis['type']);
    $slctd_bra = mysql_query("SELECT * from branches WHERE branch_id='" . $branch_ex[1] . "'") or die(mysql_error());
    $row_slctd_bra = mysql_fetch_array($slctd_bra);

    $slctd_comp = mysql_query("SELECT * from company WHERE company_id='" . $row_braHis['company_id'] . "'") or die(mysql_error());
    $row_slctd_comp = mysql_fetch_array($slctd_comp);
    if (strtoupper($row_braHis['class']) == 'PERMANENT') {
        $myDate = date('M d, Y', strtotime('-1 day', strtotime($row_braHis['per_date'])));
    } else {
        $myDate = date('M d, Y', strtotime($row_braHis['temp_date1'])) . '<br>to<br>' . date('M d, Y', strtotime($row_braHis['temp_date2']));
    }
    echo '<tr>
                            <td class="history">' . $myDate . '</td>
                            <td colspan="2" class="history">' . $row_slctd_bra['branch_name'] . '</td>
                            <td class="history">' . strtoupper($row_braHis['class']) . '</td>
                        </tr>';
}
//query branch history end
echo '<tr>
            <td colspan="4" class="history"></td>
        </tr>';
echo '<tr>
            <td colspan="4" class="break"><span class="h2">Training and Seminar Attended</span></td>
        </tr>
        <tr>
            <td class="history"><center><b>Date</b></center></td>
            <td class="history" colspan="2"><center><b>Title</b></center></td>
            <td class="history"><center><b>Bond Duration</b></center></td>
        </tr>';
//query tns history start
$sql_tnsHis = mysql_query("SELECT * from training_seminar WHERE participants LIKE '%($emp_num)%' and status LIKE '%approved%' ORDER BY from_date Asc") or die(mysql_error());
while ($row_tnsHis = mysql_fetch_array($sql_tnsHis)) {
    echo '<tr><td class="history">' . date('M d, Y h:i A', strtotime($row_tnsHis['from_date'])) . '<br> to <br>' . date('M d, Y h:i A', strtotime($row_tnsHis['to_date'])) . '</td>
                          <td colspan="2" class="history"><center>' . $row_tnsHis['title'] . '</center></td>
                          <td class="history"><center>' . $row_tnsHis['bond'] . ' months</center></td>
                            </tr>';
}
echo '<tr>
            <td colspan="4" class="break"><span class="h2">Pending Training and Seminar</span></td>
        </tr>
        <tr>
            <td class="history" colspan="4"><center><b>Title</b></center></td>
        </tr>';
//query tns history start
@$arr_tnsPending = explode('~', $row_emp_data['training_must_attended']);
foreach ($arr_tnsPending as $val) {
    if (!empty($val)) {
        echo '<tr><td class="history" colspan="4"><center>' . strtoupper($val) . '</center></td></tr>';
    }
}
//query tns history end
echo '<tr>
            <td colspan="4" class="break"><span class="h2">Delinquency History</span></td>
        </tr>
        <tr>
            <td class="history"><center><b>Date Committed</b></center></td>
            <td class="history" colspan="3"><b><center>Violation</b></center></td>
        </tr>';
//query tns history start
$sql_delHis = mysql_query("SELECT * from delinquency WHERE emp_num = '$emp_num' ORDER BY date_committed Asc") or die(mysql_error());
while ($row_delHis = mysql_fetch_array($sql_delHis)) {
    echo '<tr><td class="history">' . date('F, d, Y', strtotime($row_delHis['date_committed'])) . '</td>
                          <td colspan="3" class="history"><center>' . $row_delHis['violation'] . '</center><td></tr>';
}
//query tns history end
echo '<tr>
            <td colspan="4" class="break"><span class="h2"></span></td>
        </tr>';
// }
echo '</table>';
//if(!empty(@$_GET['type'])){ echo '<br><br><br><br><input type="button" value="Delete Request" class="btn btn-danger" onclick="return confirm(\'Do you want to delete this request. You cannot undo this process.\')">';}
echo '</center>';
