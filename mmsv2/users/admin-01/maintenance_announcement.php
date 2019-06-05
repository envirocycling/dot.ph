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
                            $content = mysql_real_escape_string($_POST['content']);
                            $title = mysql_real_escape_string($_POST['title']);
                            if(mysql_query("INSERT INTO announcement (image_name, title, content, emp_num, date_post, status) VALUES ('".basename($_FILES["fileToUpload"]["name"])."', '$title', '$content', '".$row_emp['emp_num']."','".date('Y-m-d')."', '1')") or die(mysql_error())){
                                $sql_maxann = mysql_query("SELECT max(a_id) as a_id from announcement") or die(mysql_error());
                                $row_maxann = mysql_fetch_array();
                            }else{
                                echo '<script>
                                             location.replace("maintenance_announcement.php?active=maintenance&http=400");
                                        <script>';
                            }
                            @$target_dir = "../../images/announcement/";
                            $new_filename = basename($_FILES["fileToUpload"]["name"]);
                            $chk_fname = $target_dir.$new_filename;
                            if(file_exists($chk_fname)){
                                $_SESSION['err'] .= "Image already exist.";
                                @$uploadOk = 0;
                            }else{
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
                                            location.replace("maintenance_announcement.php?active=maintenance&http=200");
                                        </script>		
                                        <?php
                                    } else {
                                        echo '<script>
                                                 location.replace("maintenance_announcement.php?active=maintenance&http=400");
                                            <script>';
                                    }
                                }
                            }
                        }else{
                            unset($_SESSION['err']);
                        }
                        ?>
                        <br><br><center>
                            <table width='100%'>
                                <tr>
                                    <td class="header1" colspan="4"><center>Announcements<br></center></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><hr></td>
                                </tr>
                            </table>
                            <table width="100%">
                                <tr>
                                    <td colspan="2"><center><br><form method="post" enctype="multipart/form-data">
                                            <input type="text" name="title" placeholder="Announcement Title" style="width:40%;" required><br>
                                            <textarea name="content" required rows="10" style="width:60%; text-transform: uppercase;" placeholder="Enter your text here..."></textarea><br>
                                            Upload Photo:<input type="file" name="fileToUpload" id="fileToUpload" required accept="image/*"><br>
                                            <input type="submit" class="btn btn-primary" value="Post Announcement" name="submit"><br>
                                            <?php echo '<font color="red"><i>'.@$_SESSION['err'].'<i></font>';?>
                                        </form></center></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><hr></td>
                                </tr>
                            </table>
                            </form>
                             <table width="75%">
                                <tr>
                                <form method="post">
                                    <td>
                                        <table  class="data display datatable">
                                            <thead>
                                                <tr class="data">
                                                    <th class="data">Date Post</th>
                                                    <th class="data">Title</th>
                                                    <th class="data" width="150px">Content</th>
                                                    <th class="data">Status</th>
                                                    <th class="data" width="120px">Action</th>	
                                                </tr>
                                            </thead>
                                            <?php
                                            echo '<input type="hidden" id="a_iddel">';
                                            $sql_announce = mysql_query("SELECT * from announcement ORDER By date_post Desc") or die(mysql_error());
                                            while($row_announce = mysql_fetch_array($sql_announce)){
                                                if($row_announce['status'] == 0){    
                                                    $status = 'hidden';
                                                }else{
                                                    $status = 'Active';
                                                }
                                                    echo '<tr>
                                                            <td class="data">'.strtoupper($row_announce['date_post']).'</td>
                                                                <td class="data">'.strtoupper($row_announce['title']).'</td>
                                                                <td class="data" style="width:50%;">'.strtoupper($row_announce['content']).'</td>
                                                                <td class="data">'.strtoupper($status).'</td>
                                                                <td><center>';
                                                    
                                                if($row_announce['status'] == 0){        
                                                    echo '<input type="image" class="btns" title="Hide" src="../../images/button/btn_hide.png" width="40" height="40" id="show_'.$row_announce['a_id'].'">';
                                                }else{
                                                    echo '<input type="image" class="btns" title="Active" src="../../images/button/btn_show.png" width="40" height="40" id="hide_'.$row_announce['a_id'].'">';
                                                }      
                                                echo '| <input type="image" class="btns_del" title="Do you want to remove?" src="../../images/button/delete_icon.png" width="40" height="40" id="'.$row_announce['a_id'].'">';
                                                   echo '</center></tr>';
                                            }
                                            ?>
                                        </table>
                                        <br><br><br><br><br>
                                    </td>
                                </tr>
                            </table>
                        </center>
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
  
        <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <script type="text/javascript" src="js/jquery.ui.core.min.js"></script>
    <script src="js/setup.js" type="text/javascript"></script>
	<script type="text/javascript">
            $(document).ready(function () {
                setupLeftMenu();
                $('.datatable').dataTable();
                setSidebarHeight();
                var first = $('.cancel').confirmation({
                onShow: function() {
                    console.log('Start show event');
                }
                });
               
                  var first = $('.btns_del').confirmation({
                    onShow: function(reponse) {
                        console.log('Start show event');
                    }
                });
            });
            
            $('.btns').click(function(){
                var btn_id = $(this).attr('id');
                var btn_id_split = btn_id.split("_");
                if(btn_id_split[0] == 'hide'){
                    $('#' + btn_id).attr('src', '../../images/button/btn_hide.png');
                    $('#' + btn_id).attr('id', 'show_' + btn_id_split[1]);
                    var dataX = 'a_id=' + btn_id_split[1] + '&status=0';
                    $.ajax({
                        type: 'POST',
                        data: dataX,
                        url: 'process/view_delete_maintenance.php'
                    }).done(function(){
                        location.reload();  
                    });
                }else{
                    $('#' + btn_id).attr('src', '../../images/button/btn_show.png');
                    $('#' + btn_id).attr('id', 'hide_'+ btn_id_split[1]);
                    var dataX = 'a_id=' + btn_id_split[1] + '&status=1';
                    $.ajax({
                        type: 'POST',
                        data: dataX,
                        url: 'process/view_delete_maintenance.php'
                    }).done(function(){
                        location.reload();   
                    });
                }
            });
            
            $('.btns_del').click(function(){
                var id = $(this).attr('id');
                $('#a_iddel').val(id);
                  var first = $('#' + id).confirmation({
                    onShow: function(reponse) {
                        console.log('Start show event');
                    }
                });
            });
          </script>
        <link rel='stylesheet' href='pop-up/jAlert.css'>
	<script src='pop-up/jAlert.js'></script>
	<script src='pop-up/jAlert-functions.js'></script>
        <script src="pop-up/jAlert.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
        --><script src="pop-up/confirmation.js"></script>
<script>
	$(function(){
            //for the data-jAlerts
            $.jAlert('attach');
        });
        
</script>