<!DOCTYPE html>
<html lang="en">
    <script type="text/javascript" src="validation/jquery.min.js"></script>
    <body>
        <?php include 'layout/header.php';?>
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
                            function zoom(id){
                                var zoom =  $('#' + id).attr('class');
                               if(zoom != 'out'){
                                    $('#' + id).width("100%");
                                    $('#ann_ctrl').val('1');
                                    $('#' + id).attr('class','out');
                               }else{
                                    $('#' + id).width("50%");
                                    $('#ann_ctrl').val('0');
                                    $('#' + id).attr('class','imgs');
                               }
                           }
                    </script>
                    <style>
                        .imgs:hover{
                            cursor:zoom-in;
                        }
                        .out:hover{
                            cursor:zoom-out;
                        }
                    </style>
                    </div>
                    <div class="main">
                        <link rel="stylesheet" type="text/css" href="css/index_portions.css">
                        <link rel="stylesheet" href="../../slider/birthday_corner/iframe_agency.css">
                        <div class="main_wrapper">
                            <!--Anoouncement start -->
<!--                            <div id="announcements"><span class="announcements2">Announce</span>ments</div>
                            <div id="announcements_frame">
                                <?php
                                    $ctr = 1;
                                    $sql_announce = mysql_query("SELECT * from announcement WHERE status='1' ORDER By date_post Desc") or die(mysql_error());
                                    while($row_announce = mysql_fetch_array($sql_announce)){
                                        echo '<img class="imgs" onclick="zoom(this.id);" id="imgs'.$ctr.'" src="../../images/announcement/'.$row_announce['image_name'].'" width="50%" height="100%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="ann_content"><h3>'.strtoupper($row_announce['title']).'</h3> - '.strtoupper($row_announce['content']).'<br> Date posted - '.date('F d, Y', strtotime($row_announce['date_post'])).'</span><hr>';
                                    
                                        $ctr++;
                                    }
                                ?>
                            </div>-->
                            <!--Anoouncement end -->
                            
                            <!--noti start -->
                            <div id="event"><span class="noti">Notifications</span></div>
                            <div id="event_frames">
                                <br />
                                <?php
                                                                        
                                    $sql_noti_del = mysql_query("SELECT * from delinquency WHERE implementation_status='pending to agency'  and company_id='".$row_user['agency_id']."'") or die(mysql_error());
                                    $row_noti_del = mysql_num_rows($sql_noti_del);
                                    if($row_noti_del > 0){ 
                                        while($row_notit_del = mysql_fetch_array($sql_noti_del)){
                                            @$del_pending += 1;
                                        }
                                        echo '<a href="view_delinquency.php?status=active&active=view">You have <font color="black">'.@$del_pending.' pending to take an action </font> delinquency request.</a><hr>';
                                    }
                                    
                                ?>
                            </div>
                            <!--noti end -->
                            <br/>
                            <br/>
                            <br/>
                            <!--birthday start -->
                                <div id="bday"><center>Birthday Corner<br>
                                    <span id="bday2"><?php echo 'Month of '.date('F');?><br></span>
                                    <span id="bday3">Happy Birthday!<br><br></span>
                                    <div id="bday4">
                                        <?php
                                        echo '<br>';
                                        $ctrl = 1;
                                        $chk_date = '';
                                            $sql_bday = mysql_query("SELECT DATE_FORMAT(`birthdate`,'%m-%d') as birthdate, DATE_FORMAT(`birthdate`,'%Y-%m-%d') as birthdate2, lastname, firstname, middlename, company_id from employees WHERE company_id='".$row_user['agency_id']."' Order By birthdate Asc") or die(mysql_error());
                                            while($row_bday = mysql_fetch_array($sql_bday)){
                                                $sql_company = mysql_query("SELECT * from company WHERE company_id = '".$row_bday['company_id']."'");
                                                $row_company = mysql_fetch_array($sql_company);
                                                $c_month = date('m');
                                                $row_m = date('m', strtotime($row_bday['birthdate2']));
                                                
                                                $c_day = date('d');
                                                $row_day = date('d', strtotime($row_bday['birthdate2']));
                                                
                                                if($c_month == $row_m && $c_day <= $row_day){
                                                    $chk_str = strlen($row_bday['middlename']);
                                                    if($chk_str > 1){
                                                        $str_count = strlen($row_bday['middlename']) - 1;
                                                    $middlename = substr($row_bday['middlename'],0,-$str_count);
                                                    }else{
                                                        $str_count = strlen($row_bday['middlename']);
                                                    $middlename = $row_bday['middlename'];
                                                    }
                                                    if(empty($row_bday['middlename'])){
                                                        $middlename = '';
                                                    }else{
                                                        $middlename = ' '.$middlename.'. ';
                                                    }
                                                    $fullname = ucwords(strtolower($row_bday['firstname'].$middlename.$row_bday['lastname']));
                                                    if(empty($chk_date)){
                                                        $chk_date = date('M d',strtotime($row_bday['birthdate2']));
                                                    }
                                                    if($ctrl == 1 && $chk_date == date('M d',strtotime($row_bday['birthdate2']))){
                                                        echo '&nbsp;<font size="5em">'.$fullname.'('.$row_company['name'].') - '.date('M d',strtotime($row_bday['birthdate2'])).'</font>&nbsp;&nbsp;<hr>';
                                                    }else{
                                                        echo '&nbsp;'.$fullname.' - '.date('M d',strtotime($row_bday['birthdate2'])).'&nbsp;&nbsp;<hr>';
                                                        $ctrl++;
                                                    }
                                                    $chk_date = date('M d',strtotime($row_bday['birthdate2']));
                                                }
                                            }
                                        ?></div>
                                    </center>
                                </div>
                                <div id="iframe_wrapper">
                                    <iframe id="iframe_bday" frameborder="0" src="../../slider/birthday_corner/page_agency.php" height="100%" width="100%"></iframe>
                                </div>
                            <!--birthday end -->
                        </div>
                    </div>
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
    </body>
</html>

