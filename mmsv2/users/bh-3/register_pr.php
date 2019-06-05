<!DOCTYPE html>
<html lang="en">
    <link rel="stylesheet" type="text/css" href="css/pr_form.css">
    <script type="text/javascript" src="validation/jquery.min.js"></script>
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
                    <script>
                        $(document).ready(function(){
                            $('input[type="file"]').change(function(){
                                var j_ctr = 1;
                                var upload_control = Number($('#upload_control').val());
                                    while(j_ctr <= upload_control){
                                        var upload_root= $('#upload_' + j_ctr).val();
                                        var upload_type = upload_root.slice(-3);
                                        var to_lower = upload_type.toLowerCase();
                                        if(to_lower != 'pdf'){
                                          alert("Invalid file type. Please choose PDF only.");
                                          $('#upload_' + j_ctr).val('');
                                        }  
                                        j_ctr++;
                                    }
                            });
                            //adding 
                                $('#add_upload').click(function(){
                                    var upload_control = Number($('#upload_control').val());
                                    var add = 1 + upload_control;
                                        $('#add_' + add).attr('hidden',false);
                                        $('#upload_control').val(add);
                                        if(add == 5){
                                            $('#add_upload').attr('hidden',true);
                                        }
                                        if(add > 1){
                                            $('#minus_upload_span').attr('hidden',false);
                                        }
                                });
                                
                                $('#minus_upload').click(function(){
                                    var upload_control = Number($('#upload_control').val());
                                    var minus = upload_control - 1;
                                        $('#add_' + upload_control).attr('hidden',true);
                                        $('#upload_control').val(minus);
                                        if(minus == 1){
                                            $('#minus_upload_span').attr('hidden',true);                                            
                                        }
                                        if(minus <= 4){
                                            $('#add_upload').attr('hidden',false);
                                        }
                                        
                                });
                            //adding end
                        });
                    </script>
                    <style>
                        #add_upload:hover{
                            cursor: pointer;
                            height: 30px;
                            width: 30px;
                        }
                        #minus_upload:hover{
                            cursor: pointer;
                            height: 30px;
                            width: 30px;
                        }
                    </style>
                    <div class="main" align="center">
                        <br><br>
                        <form action="process/register_pr_pro.php" method="post" enctype="multipart/form-data">
                        <table width="90%">
                            <tr>
                                <td class="header1" colspan="4"><img src="../../images/logo.png" height="70" width="70"><span id="header1">Envirocycling Fiber Incorporated</span><br><span id="header2">Personnel Requisition Form<br></span></td>
                            </tr>
                            <tr>
                                <td colspan="4"><hr></td>
                            </tr>
                            <tr>
                                <td colspan="2">Date Requested: <input type="text" name="date_requested" value="<?php echo date('F d, Y');?>" readonly></td>
                                <td colspan="2">Branch: <input type="text" value="<?php echo ucwords($row_branch['branch_name']);?>" readonly><input type="hidden" name="branch" value="<?php echo ucwords($row_branch['branch_id']);?>" readonly></td>
                            </tr>
                            <tr>
                                <td colspan="4"><br><b>I. DESCRIPTION OF NEEDED</b></td>
                            </tr>
                            <tr>
                                <td><div class="label_info">Date Needed:<span class="required">*</span></div></td>
                                <td><div class="label_field"><input type="text" id="datetimepicker3" name="date_needed" required></div></td>
                            </tr>
                            <tr>
                                <td><div class="label_info">Number Needed:<span class="required">*</span></div></td>
                                <td><div class="label_field"><input type="number" name="no_needed" min="1" required></div></td>
                            </tr>
                            <tr>
                                <td><div class="label_info">Job Title:<span class="required">*</span></div></td>
                                <td><div>
                                        <select id="position" style="width: 220px;" name="job_title" onchange="f_position();" required>
                                            <option value="" selected disabled> Please Select</option>
                                            <option value="others">OTHERS</option>
                                            <?php
                                            $sql_position = mysql_query("SELECT * from positions ORDER BY position Asc") or die (mysql_error());
                                                while($row_position = mysql_fetch_array($sql_position)){
                                                    echo '<option value="'.$row_position['p_id'].'">'.strtoupper($row_position['position']).'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </td>
                                <td><div class="label_pothers" hidden id="div_specify"><input type="text" name="job_specify" id="specify" placeholder="Please specify"></div></td>
                            </tr>
                            <tr>
                                <td><div class="label_info">Status of Employment:<span class="required">*</span></div></td>
                                <td colspan="2"><div class="label_field">
                                        <input type="radio" name="status" value="Probationary" required>Probationary &nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="status" value="Temporary" required>Temporary &nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="status" value="Co-term" required>Agency/Co-term
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4"><br><b>II. REASON FOR REQUIREMENT</b></td>
                            </tr>
                            <tr>
                                <td colspan="4"><br><div class="label_info"><input type="checkbox" name="reason1" value="r1" required> Replacement of Resigned / Endo / Terminated Employee <textarea onkeyup="textAreaAdjust(this);" name="txt_reason1" id="reason1" class="txt_reason" disabled required></textarea></div></td>
                            </tr>
                            <tr>
                                <td colspan="4"><br><div class="label_info"><input type="checkbox" name="reason2" value="r2" required> Replacement of Promoted / Transferred Employee <input type="text" id="datetimepicker4" placeholder="Movement date" name="date_movement" style="width:100px;" required disabled> <textarea onkeyup="textAreaAdjust(this);" style="width:300px;" id="reason2" name="txt_reason2" class="txt_reason" disabled required></textarea></div></td>
                            </tr>
                            <tr>
                                <td colspan="4"><br><div class="label_info"><input type="checkbox" name="reason3" value="r3" required> Additional Manpower <textarea onkeyup="textAreaAdjust(this);" id="reason3" name="txt_reason3" class="txt_reason" disabled required></textarea></div></td>
                            </tr>
                            <tr>
                                <td colspan="4"><br><div class="label_info"><input type="checkbox" name="reason4" value="r4" required> Requisition for new position <textarea onkeyup="textAreaAdjust(this);" id="reason4" name="txt_reason4" class="txt_reason" disabled required></textarea></div></td>
                            </tr>
                            <tr>
                                <td colspan="4"><br><b>III. REQUIREMENTS</b></td>
                            </tr>
                            <tr>
                                <td><br><div class="label_info">Educational Requirements</div></td>
                                <td><br><div class="label_info"><input type="radio" name="ed_requirements" id="college" value="c~" onclick="f_ed()" required> College <span id="span_college" hidden><input type="text" style="width:70%;" id="txt_college" placeholder="Preferred course" name="txt_college"></div></td>
                                            <td><br><div class="label_info"><input type="radio" name="ed_requirements" value="ag" onclick="f_ed()" required> Associate Graduate</div></td>
                            </tr>
                            <tr>
                                <td><br><div class="label_info"></div></td>
                                <td><br><div class="label_info"><input type="radio" name="ed_requirements" value="dc" onclick="f_ed()" required> Diploma Course</div></td>
                                <td><br><div class="label_info"><input type="radio" name="ed_requirements" value="hg" onclick="f_ed()" required> At least High School Graduate</div></td>
                            </tr>
                            <tr>
                                <td><br><div class="label_info">Special Skills Required</div></td>
                                <td colspan="3"><br><div class="label_info"><textarea class="textarea" onkeyup="textAreaAdjust(this);" name="special_skills" placeholder="if any"></textarea></div></td>
                            </tr>
                            <tr>
                                <td><div class="label_info">Attitudinal Requirements</div></td>
                                <td colspan="3"><div class="label_info"><textarea class="textarea" onkeyup="textAreaAdjust(this);" name="attitudinal_req" placeholder="if any"></textarea></div></td>
                            </tr>
                            <tr>
                                <td><div class="label_info">Other Special Requirements</div></td>
                                <td colspan="3"><div class="label_info"><textarea class="textarea" onkeyup="textAreaAdjust(this);" name="other_skills" placeholder="if any"></textarea></div></td>
                            </tr>
                            <tr>
                                <td colspan="4"><br><b>IV. RECOMMENDATIONS</b></td>
                            </tr>
                            <tr>
                                <td colspan="3"><br><div class="label_info">After reviewing the file for the most qualified applicants for this position, I recommend that the following person be considered for employment : (please attached bio-data / resume of the applicant on <font color="red">PDF file format only</font>.)</div></td>
                            </tr>
                            <?php
                                echo '<input type="hidden" value="1" id="upload_control" name="upload_control">';
                                $upload_ctr = 1;
                                $upload_num = 5;
                                while($upload_ctr <= $upload_num){
                                    if($upload_ctr == 1){
                                        $attrib = '';
                                    }else{
                                        $attrib='hidden';
                                    }
                            ?>
                            <tr <?php echo $attrib;?> id="add_<?php echo $upload_ctr;?>">
                                <td colspan="3"><br><font color="blue"><b><i>Attach Applicant Info:<i></b></font> <input type="file" name="upload[]" id="upload_<?php echo $upload_ctr;?>" accept="application/pdf"/></td>
                            </tr>
                            <?php
                                    $upload_ctr++;
                                }
                            ?>
                            <tr>
                                <td colspan="1"><center><img id="add_upload" src="../../images/button/add_icon.png" height="25" width="25"> <span hidden id="minus_upload_span"> &nbsp;&nbsp; <img id="minus_upload" src="../../images/button/minus_icon.png" height="25" width="25"></span></center></td>
                            </tr>
                            <tr>
                                <td><div class="label_info"><br>Reason for recommendation</div></td>
                                <td colspan="3"><br><div class="label_info"><textarea class="textarea" onkeyup="textAreaAdjust(this);" name="recommendation" placeholder="if any"></textarea></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div class="label_info"><br>Salary: <input type="number" name="salary"></div></td>
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

<link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css"/>
<script src="js/jquery.js"></script>
<script src="js/jquery.datetimepicker.full.js"></script>
<script>
//date picker3 start
                            $('#datetimepicker3').datetimepicker({
                                dayOfWeekStart: 1,
                                lang:'ch',
                                timepicker:false,
                                scrollMonth : false,
                                scrollInput : false,
                                format:'Y/m/d',
                                disabledDates: ['1986/01/08', '1986/01/09', '1986/01/10'],
                                startDate: '2016'
                            });
                            $('#datetimepicker3').datetimepicker({value: ''});
                            
                            $('#datetimepicker4').datetimepicker({
                                dayOfWeekStart: 1,
                                lang:'ch',
                                timepicker:false,
                                scrollMonth : false,
                                scrollInput : false,
                                format:'Y/m/d',
                                disabledDates: ['1986/01/08', '1986/01/09', '1986/01/10'],
                                startDate: '2016'
                            });
                            $('#datetimepicker4').datetimepicker({value: ''});
//date picker3 end

</script>

<!--dropdown menu src start-->
<link href="css/select2.min.css" rel="stylesheet">
<script type="text/javascript" src="js/jquery.js"></script>
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
                $('#datetimepicker4').keydown(false);
                $('#datetimepicker3').keydown(false);
       });
       
       function f_position(){
           var position = $('#position').val();
           if(position == 'others'){
               $('#div_specify').attr('hidden',false);
               $('#specify').attr('required',true);
           }else{
               $('#div_specify').attr('hidden',true);        
               $('#specify').attr('required',false);       
           }
       }
      function f_ed(){
          if($('#college').attr('checked')){
              $('#span_college').attr('hidden',false);
              $('#txt_college').attr('required',true);
          }else{
              $('#span_college').attr('hidden',true);  
              $('#txt_college').val('');            
          }
      }

function textAreaAdjust(o) {
    o.style.height = "1px";
    o.style.height = (0+o.scrollHeight)+"px";
}
    
    $('input[type="checkbox"]').click(function(){
        var name = $(this).attr('name');
        //alert(name);
        if($('input[name="reason2"]').attr('checked')){
            $('input[type="checkbox"]').attr('required',false);
            $('#' + name).attr('disabled', false);
            $('#datetimepicker4').attr('disabled', false);   
        }else if($('input[name="'+ name + '"]').attr('checked')){
            $('#' + name).attr('disabled', false);
            $('input[type="checkbox"]').attr('required',false);
        }else{
            $('#' + name).val('');
            $('#' + name).attr('disabled', true);
            $('#datetimepicker4').attr('disabled', true);
            $('input[type="checkbox"]').attr('required',true);
        }
    });

 </script>
 <!--dropdown menu src end-->
