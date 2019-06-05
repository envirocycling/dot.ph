<!DOCTYPE html>
<html lang="en">
    <script type="text/javascript" src="validation/jquery.min.js"></script>
    <link rel="stylesheet" href="css/del_form.css">
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
                    <!--start main-->
                    <div class="main" align="center">
                        <br><br>
                        <form action="process/register_del_pro.php" method="post">
                        <table width="85%">
                            <tr>
                                <td colspan="4" class="header1"><span id="logo"><img id="comp_logo" height="100px" width="100px;"></span><span id="header1"></span><br><span id="header2"><br></span></td>
                            </tr>
                            <tr>
                                <td class="txt">To:</td>
                                <td>Whom it may concern</td>
                            </tr>
                            <tr>
                                <td class="txt">Company:</td>
                                <td>
                                    <?php
                                    $sql_company = mysql_query("SELECT * from company WHERE status='' ORDER BY name Asc");
                                    echo '<select name="company" required>';
                                        echo '<option value="" selected disabled>Please Select</option>';
                                        while($row_company = mysql_fetch_array($sql_company)){
                                            echo '<option value="'.$row_company['company_id'].'">'.strtoupper($row_company['name']).'</option>';
                                        }
                                    echo '</select>';
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="txt">RE:</td>
                                <td>Delinquency Report</td>
                            </tr>
                            <tr>
                                <td class="txt">Date:</td>
                                <td><?php echo $date = date('Y/m/d');?><input type="hidden" value="<?php echo $date;?>" name="date_submitted"></td>
                            </tr>
                            <tr>
                                <td colspan="4"><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Forwarding to you the Delinquency Report of your employee assigned in our company. Kindly arrange to return the duplicate and indicate the action taken for the infraction of erring employee/s.</td>
                            </tr>
                            <tr>
                                <td class="txt"><br><br>Name of Employee:</td>
                                <td><br><br>
                                    <select name="emp_num" id="emp_num" style="width: 300px;" required>
                                        <option value="" disabled selected>Please Select<option>
                                    </select>
                                </td>
                                <td class="txt"><br><br>Branch Assignment:</td>
                                <td width="20%" style="padding-top: 10px;"><br><span id="branch_html"></span><input type="hidden" id="branch" name="branch_id"></td>
                            </tr>
                            <tr>
                                <td class="txt"><br><br>Violation Committed:</td>
                                <td><br><br><input type="text" name="violation" placeholder="Required" required></td>
                                <td class="txt"><br><br>Date of Commission:</td>
                                <td width="20%" style="padding-top: 15px;"><br><input type="text" id="datetimepicker" placeholder="Required" name="date_committed" required></td>
                            </tr>
                            <tr>
                                <td class="txt"><br><br>Type (if any):</td>
                                <td colspan="2"><br><br>
                                    <input type="radio" name="del_type" class="radio" value="incident">Incident &nbsp;&nbsp;<input type="radio" class="radio" name="del_type" value="Accident">Accident &nbsp;&nbsp;
                                    <span id="report_num">
                                        <select name="report_number" required>
                                            <option value="" selected disabled>Select Report #</option>
                                            <option value="incident">Incident</option>
                                            <option value="accident">Accident</option>
                                        </select>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="txt" colspan="2"><br><br>Brief description of the incident:</td>
                            </tr>
                            <tr>
                                <td class="txt" colspan="4"><textarea class="textarea" onkeyup="textAreaAdjust(this);" style="width:100%; resize: none;" name="description" placeholder="Required" required></textarea></td>
                            </tr>
                            <tr>
                                <td colspan="2"><br><br>Disciplinary action (To be filled out by company):</td>
                            </tr>
                            <tr>
                                <td colspan="2"><br><br><br><br>For your immediate action.</td>
                            </tr>
                            <tr>
                                <td colspan="2"><br><!--Signature--></td>
                            </tr>
                            <tr>
                                <td colspan="2"><br><?php echo $fullname.' - <i>'.$row_position['position'].'</i>';?></td>
                            </tr>
                        </table>
                        <br><br>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <br><br><br>
                        </form>
                    </div>
                    <!--end main-->
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
<!--dropdown menu src start-->

<link href="css/select2.min.css" rel="stylesheet">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/select2.min.js"></script>
 <script>
	 $(document).ready(function () {             
                $('#report_num').attr('hidden',true);
                $('select[name="company"]').change(function(){
                        var company_id = $(this).val();
                                                                 
                                    $.ajax({
                                        url: 'process/register_del_empdata2.php',
                                        type: 'Post',
                                        data: 'company_id=' + company_id
                                    }).done(function(e){
                                        var val = e.split('~');
                                        var company_logo = company_id + '.png';
                                        $('#header1').html(val[0]);
                                        $('#header2').html(val[1]);
                                        $("#emp_num").html(val[2]);
                                        $('#comp_logo').attr('src','../../images/company_logo/'+company_logo);
                                    });
                                    
                });
                $('#emp_num').change(function(){
                    var emp_num = $(this).val();
                    $.ajax({
                        url: 'process/register_del_empdata.php',
                        type: 'Post',
                        data: 'emp_id=' + emp_num
                    }).done(function(e){
                        var emp_data = e.split('~');
                        $('#branch_html').html(emp_data[1]);
                        $('#branch').val(emp_data[0]);
                    });
                });
                
                $('.radio').click(function(){
                    if($(this).attr('checked')){
                        $('#report_num').attr('hidden',false);
                    }
                });
       });
 </script>
 <!--dropdown menu src end-->

<!--get data start-->
<script>
   //get data end-->
    
    function textAreaAdjust(o) {
    o.style.height = "1px";
    o.style.height = (0+o.scrollHeight)+"px";
}
</script>

<link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css"/>
<script src="js/jquery.datetimepicker.full.js"></script>
<script>
//date picker3 start
                            $('#datetimepicker').datetimepicker({
                                dayOfWeekStart: 1,
                                lang:'ch',
                                timepicker:false,
                                format:'Y/m/d',
                                startDate: '2016',
                                scrollMonth : false,
                                scrollInput : false
                            });
                            $('#datetimepicker').datetimepicker({value: ''});
//date picker3 end

</script>

<link href="../css/select2.min.css" rel="stylesheet">
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/select2.min.js"></script>
<script>
    $(document).ready(function(){
        $('#emp_num').select2();
        $('#datetimepicker').keydown(false);
    });
</script>