<!DOCTYPE html>
<html lang="en">
    <script type="text/javascript" src="validation/jquery.min.js"></script>
    <link rel="stylesheet" href="validation/bootstrap.css"/>
    <link rel="shortcut icon" type="image/x-icon" href="../../images/logo.png" />
    <script src="bootstrap-table/bootstrap-table.js"></script>
    <link type="text/css" rel="stylesheet" href="bootstrap-table/bootstrap.css">
    <link type="text/css" rel="stylesheet" href="bootstrap-table/bootstrap-table.css">
    <link rel="shortcut icon" type="image/x-icon" href="../../images/logo.png" />

    <script>
        $(document).ready(function () {
            $("#table").bootstrapTable({
                search: true,
                showToggle: true,
                searchAlign: 'left'
            });
        });
    </script>
    <style>
         .data{
            font-size: 13px;
        }
    </style>
    
    <body>
        <?php include 'layout/header.php'; ?>
        <script type="text/javascript">             var tableToExcel = (function () {
            var uri = 'data:application/vnd.ms-excel;base64,'
                    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml></head><body><table>{table}</table></body></html>'
                                        , base64 = function (s) {
            return window.btoa(unescape(encodeURIComponent(s)))
                }
        , format = function (s, c) {
            return s.replace(/{(\w+)}/g, function (m, p) {
                return c[p];
            })
        }
        return function (table, name) {
            if (!table.nodeType)
                table = document.getElementById(table)
            var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
            window.location.href = uri + base64(format(template, ctx))
        }
    })()
</script>
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
                        <script>
                            $(document).ready(function(){
                                var sort_by = $('select[name="sort_by"]').val();
                                if(sort_by == 'Date'){
                                    $('#s_date').show(200);
                                }else{
                                    $('#s_date').hide();
                                }
                                $('select[name="sort_by"]').change(function(){
                                    var sort_by = $('select[name="sort_by"]').val();
                                    if(sort_by == 'Date'){
                                        $('#s_date').show(200);
                                    }else{
                                        $('#s_date').hide();
                                    }
                                });
                            });
                        </script>
                        <?php
                        include 'layout/menu.php';
                            if(isset($_POST['filter'])){
                                if($_POST['sort_by'] == 'Date'){
                                    $sql_tns = mysql_query("SELECT * from training_seminar WHERE from_date LIKE  '".$_POST['year']."%' ORDER by from_date Asc") or die(mysql_error());
                                    
                                }else{
                                    $sql_tns = mysql_query("SELECT * from training_seminar ORDER by from_date Asc") or die(mysql_error());
                                }
                            }else{
                                $sql_tns = mysql_query("SELECT * from training_seminar WHERE from_date LIKE '".date('Y-')."%' ORDER by from_date Asc") or die(mysql_error());                              
                            }
                        ?>
                        <link rel="stylesheet" type="text/css" href="css/override.css">
                        <style>
                            .data2{
                                font-size: 11px;
                                padding-bottom: 15px;
                                text-transform: uppercase;
                            }
                        </style>
                    </div>
                    <!--Main body-->
                    <div class="main">
                        <br><br><center>
                            <table width='100%'>
                                <tr>
                                    <td class="header1" colspan="4"><center>Report Training & Seminars<br></center></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><hr></td>
                                </tr>
                            </table>
                            <input type="hidden" id="emp_num">
                            <table width="95%">
                                <tr>
                                <form method="post">
                                    <td colspan="8" align="right">Sort By: <select name="sort_by" style="width: 100px; margin-top: 10px;">
                                                                                <?php
                                                                                    if(isset($_POST['sort_by'])){
                                                                                        echo '<option value="'.$_POST['sort_by'].'">'.$_POST['sort_by'].'</option>';
                                                                                    }
                                                                                ?>
                                                                                <option value="Date">Date</option>
                                                                                <option value="Name">Name</option>
                                                                                <option value="Title">Title</option>
                                                                           </select>
                                        <span id="s_date"> Year: <select name="year" style="width:100px; margin-top: 10px;" >
                                                <?php
                                                    $year_from = '2010';
                                                    $year_to = date('Y') + 1;
                                                    $year = date('Y');
                                                    while($year_from <= $year_to){
                                                        if(isset($_POST['filter'])){
                                                            if($_POST['year'] == $year_from){
                                                                $attr = 'selected';
                                                            }else{
                                                                $attr = '';
                                                            }
                                                        }else if($year == $year_from){
                                                            $attr = 'selected';
                                                        }else{
                                                            $attr = '';
                                                        }
                                                        echo '<option value="'.$year_from.'" '.@$attr.'>'.$year_from.'</option>';
                                                        $year_from++;
                                                    }
                                                ?>
                                        </select></span>
                                       <input type="submit" class="btn btn-primary" value="Filter" name="filter">
                                    </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right"><br><br><input type="button"  class="btn-success" onclick="tableToExcel('table', 'Trainig & Seminar Report')" value="Export XLS"><br></td>
                                </tr>
                                <tr>
                                    <td>
                                        <table id="table" data-show-columns="true" data-url="/gh/get/response.json/wenzhixin/bootstrap-table/tree/master/docs/data/data1/">
                                            <thead>
                                                <tr class="data">
                                                    <?php
                                                        if((@$_POST['sort_by'] == 'Date') || (!isset($_POST['sort_by']))){
                                                    ?>
                                                        <th class="data">From</th>
                                                        <th class="data">To</th>
                                                        <th class="data">Title</th>
                                                        <th class="data" width="150px">Facilitator</th>
                                                        <th class="data">Venue</th>
                                                        <th class="data">Participants</th>
                                                    <?php }else if(@$_POST['sort_by'] == 'Name'){?>
                                                        <th class="data">Employee Name</th>
                                                        <th class="data">Training & Seminars</th>
                                                    <?php }else if(@$_POST['sort_by'] == 'Title'){?>
                                                        <th class="data">Title</th><th class="data">From</th>
                                                        <th class="data">To</th>
                                                        <th class="data" width="150px">Facilitator</th>
                                                        <th class="data">Venue</th>
                                                        <th class="data">Participants</th>
                                                    <?php }?>
                                                </tr>
                                            </thead>
                                            <input type="hidden" id="pr_id">
                                            <?php
                                            if(@$_POST['sort_by'] != 'Name'){
                                                while($row_tns = mysql_fetch_array($sql_tns)){
                                                    
                                                    $participants = '';
                                                    $ex_participants = explode(')',$row_tns['participants']);
                                                    
                                                    if((@$_POST['sort_by'] == 'Date') || (!isset($_POST['sort_by']))){
                                                        $ctr = 1;
                                                        foreach($ex_participants as $slctd_part){
                                                            if(!empty($slctd_part)){
                                                                $emp_num = str_replace('(',"",$slctd_part);

                                                                $sql_emp = mysql_query("SELECT * from employees WHERE emp_num = '$emp_num'") or die(mysql_error());
                                                                if(mysql_num_rows($sql_emp) == 0){
                                                                  $sql_emp = mysql_query("SELECT * from employees_deactivated WHERE emp_num = '$emp_num'") or die(mysql_error()); 
                                                                }
                                                                $row_emp = mysql_fetch_array($sql_emp);    
                                                                $chk_count = strlen($row_emp['middlename']);
                                                                if($chk_count > 1){
                                                                    $str_counted = strlen($row_emp['middlename']) - 1;
                                                                    $middle = ', '.substr($row_emp['middlename'],0,-$str_counted).'.';
                                                                }else{
                                                                    $middle = ', '.$row_emp['middlename'].'.';
                                                                }

                                                                $employee_fullname = ucwords($row_emp['lastname'].', '.$row_emp['firstname'].$middle);
                                                                $participants .= $ctr.') '.$employee_fullname.'<br>';
                                                                $ctr++;
                                                            }
                                                        }

                                                        echo '<tr class="data2">
                                                                <td>'.date('Y/m/d h:i A', strtotime($row_tns['from_date'])).'</td>
                                                                <td>'.date('Y/m/d h:i A', strtotime($row_tns['to_date'])).'</td>
                                                                <td>'.ucwords($row_tns['title']).'</td>
                                                                <td>'.ucwords($row_tns['facilitator']).'</td>
                                                                <td>'.ucwords($row_tns['venue']).'</td>
                                                                <td>'.$participants.'</td>
                                                        </tr>';
                                                    }else  if(@$_POST['sort_by'] == 'Title'){
                                                        $ctr = 1;
                                                        foreach($ex_participants as $slctd_part){
                                                            if(!empty($slctd_part)){
                                                                $emp_num = str_replace('(',"",$slctd_part);

                                                                $sql_emp = mysql_query("SELECT * from employees WHERE emp_num = '$emp_num'") or die(mysql_error());
                                                                if(mysql_num_rows($sql_emp) == 0){
                                                                  $sql_emp = mysql_query("SELECT * from employees_deactivated WHERE emp_num = '$emp_num'") or die(mysql_error()); 
                                                                }
                                                                $row_emp = mysql_fetch_array($sql_emp);    
                                                                $chk_count = strlen($row_emp['middlename']);
                                                                if($chk_count > 1){
                                                                    $str_counted = strlen($row_emp['middlename']) - 1;
                                                                    $middle = ', '.substr($row_emp['middlename'],0,-$str_counted).'.';
                                                                }else{
                                                                    $middle = ', '.$row_emp['middlename'].'.';
                                                                }

                                                                $employee_fullname = ucwords($row_emp['lastname'].', '.$row_emp['firstname'].$middle);
                                                                $participants .= $ctr.'.) '.$employee_fullname.'<br>';
                                                                $ctr++;
                                                            }
                                                        }

                                                        echo '<tr class="data2">
                                                                <td>'.ucwords($row_tns['title']).'</td>
                                                                <td>'.date('Y/m/d', strtotime($row_tns['from_date'])).'</td>
                                                                <td>'.date('Y/m/d', strtotime($row_tns['to_date'])).'</td>
                                                                <td>'.ucwords($row_tns['facilitator']).'</td>
                                                                <td>'.ucwords($row_tns['venue']).'</td>
                                                                <td>'.$participants.'</td>
                                                        </tr>';
                                                    }
                                                }
                                            }else{
                                                $sql_emp_act = mysql_query("SELECT * from employees ORDER BY lastname Asc") or die(mysql_error());
                                                while($row_amp_act = mysql_fetch_array($sql_emp_act)){ 
                                                                $chk_count = strlen($row_amp_act['middlename']);
                                                                if($chk_count > 1){
                                                                    $str_counted = strlen($row_amp_act['middlename']) - 1;
                                                                    $middle = ', '.substr($row_amp_act['middlename'],0,-$str_counted).'.';
                                                                }else{
                                                                    $middle = ', '.$row_amp_act['middlename'].'.';
                                                                }

                                                                $employee_fullname = ucwords($row_amp_act['lastname'].', '.$row_amp_act['firstname'].$middle);
                                                                
                                                                
                                                                $sql_tns_name = mysql_query("SELECT * from training_seminar WHERE participants LIKE '%(".$row_amp_act['emp_num'].")%'") or die(mysql_error());
                                                                $ctr = 1;
                                                                $tns = '';
                                                                if(mysql_num_rows($sql_tns_name) > 0){
                                                                   echo '<tr class="data2">
                                                                           <td class="data">'.$employee_fullname.'</td>';
                                                                   while($row_tns_name = mysql_fetch_array($sql_tns_name)){
                                                                           $tns .= $ctr.') '.ucwords($row_tns_name['title']).' facilitate by: '.ucwords($row_tns_name['facilitator']).' at '.ucwords($row_tns_name['venue']).', '.date('Y/m/d h:i A', strtotime($row_tns_name['from_date'])).' to'.date('Y/m/d h:i A', strtotime($row_tns_name['to_date'])).'<br>';  
                                                                       $ctr++;
                                                                   }
                                                                   echo '<td>'.$tns.'</td>';
                                                                   echo '</tr>'; 
                                                                }
                                                }
                                                $sql_emp_act = mysql_query("SELECT * from employees_deactivated ORDER BY lastname Asc") or die(mysql_error());
                                                while($row_amp_act = mysql_fetch_array($sql_emp_act)){ 
                                                                $chk_count = strlen($row_amp_act['middlename']);
                                                                if($chk_count > 1){
                                                                    $str_counted = strlen($row_amp_act['middlename']) - 1;
                                                                    $middle = ', '.substr($row_amp_act['middlename'],0,-$str_counted).'.';
                                                                }else{
                                                                    $middle = ', '.$row_amp_act['middlename'].'.';
                                                                }

                                                                $employee_fullname = ucwords($row_amp_act['lastname'].', '.$row_amp_act['firstname'].$middle);
                                                                
                                                                                                                                
                                                                $sql_tns_name = mysql_query("SELECT * from training_seminar WHERE participants LIKE '%(".$row_amp_act['emp_num'].")%'") or die(mysql_error());
                                                                $ctr = 1;
                                                                $tns = '';
                                                                if(mysql_num_rows($sql_tns_name) > 0){
                                                                   echo '<tr class="data2">
                                                                           <td>'.$employee_fullname.'</td>';
                                                                while($row_tns_name = mysql_fetch_array($sql_tns_name)){
                                                                        $tns .= $ctr.') '.ucwords($row_tns_name['title']).' facilitate by: '.ucwords($row_tns_name['facilitator']).' at '.ucwords($row_tns_name['venue']).', '.date('Y/m/d h:i A', strtotime($row_tns_name['from_date'])).' to'.date('Y/m/d h:i A', strtotime($row_tns_name['to_date'])).'<br>';  
                                                                    $ctr++;
                                                                }
                                                                echo '<td>'.$tns.'</td>';
                                                                echo '</tr>'; 
                                                                }
                                                }
                                            }
                                            ?>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right"><br><input type="button"  class="btn-success" onclick="tableToExcel('table', 'Trainig & Seminar Report')" value="Export XLS"></td>
                                </tr>
                            </table>
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
            });
            
          $('input[type*="image"]').click(function(){
               var clas = $(this).attr('class');
               if(clas == 'cancel'){
                  var id = $(this).attr('id');
                  $("#pr_id").val(id);
                  var first = $('#' + id).confirmation({
                    onShow: function(reponse) {
                        console.log('Start show event');
                    }
                });
               }
            });
         
        </script>
        <link rel='stylesheet' href='pop-up/jAlert.css'>
	<script src='pop-up/jAlert.js'></script>
	<script src='pop-up/jAlert-functions.js'></script>
        <script src="pop-up/jAlert.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
        <script src="pop-up/confirmation.js"></script>
<script>
	$(function(){
            //for the data-jAlerts
            $.jAlert('attach');
        });
</script>
<link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css"/>
<script src="js/jquery.datetimepicker.full.js"></script>
<script>
    $('#datetimepicker').datetimepicker({
                                dayOfWeekStart: 1,
                                lang:'ch',
                                timepicker:false,
                                format:'Y/m/d',
                                formatDate:'Y/m/d',
                                disabledDates: ['1986/01/08', '1986/01/09', '1986/01/10'],
                                startDate: '2016',
                                scrollMonth : false,
                                scrollInput : false
                            });
                            $('#datetimepicker').datetimepicker({value: '', step: 30});
                            
    $('#datetimepicker1').datetimepicker({
                                dayOfWeekStart: 1,
                                lang:'ch',
                                timepicker:false,
                                format:'Y/m/d',
                                formatDate:'Y/m/d',
                                disabledDates: ['1986/01/08', '1986/01/09', '1986/01/10'],
                                startDate: '2016',
                                scrollMonth : false,
                                scrollInput : false
                            });
                            $('#datetimepicker1').datetimepicker({value: '', step: 30});
</script>


        