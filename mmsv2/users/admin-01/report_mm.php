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
                                    if(empty(@$_POST['from'])){
                                        $from = date('Y/m');
                                        $from = $from.'/01'; 
                                        $to = date('Y/m/t'); 
                                    }else{
                                        $from = @$_POST['from'];
                                        $to = @$_POST['to'];
                                    }
                                    $sql_mm = mysql_query("SELECT * from manpower_movement WHERE date_submitted >= '$from' and date_submitted <= '$to' and status='transferred' ORDER by date_submitted Asc") or die(mysql_error());
                                    
                                }else{
                                    $sql_mm = mysql_query("SELECT * from manpower_movement WHERE status='transferred' ORDER by date_submitted Asc") or die(mysql_error());
                                    $from = date('Y/m');
                                    $from = $from.'/01'; 
                                    $to = date('Y/m/t');
                                }
                            }else{
                                $sql_mm = mysql_query("SELECT * from manpower_movement WHERE date_submitted LIKE '".date('Y-m')."%' and status='transferred' ORDER by date_submitted Asc") or die(mysql_error());
                                    $from = date('Y/m');
                                    $from = $from.'/01'; 
                                    $to = date('Y/m/t');                                
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
                        </style>
                    </div>
                    <!--Main body-->
                    <div class="main">
                        <br><br><center>
                            <table width='100%'>
                                <tr>
                                    <td class="header1" colspan="4"><center>Report Manpower Movement<br></center></td>
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
                                                                           </select>
                                        <span id="s_date">From: <input type="text" style="width:115px; height: 30px; margin-top: 10px;" id="datetimepicker" name="from" autocomplete="off" placeholder="required" value="<?php echo $from;?>" required/> To: <input type="text" style="width:115px; height: 30px; margin-top: 10px;" id="datetimepicker1" name="to" autocomplete="off"  placeholder="required" value="<?php echo $to;?>" required/></span>
                                       <input type="submit" class="btn btn-primary" value="Filter" name="filter">
                                    </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right"><br><br><input type="button" onclick="tableToExcel('table', 'Manpower Movement Report')" value="Export XLS" class="btn-success"><br></td>
                                </tr>
                                <tr>
                                    <td>
                                        <table id="table" data-show-columns="true" data-url="/gh/get/response.json/wenzhixin/bootstrap-table/tree/master/docs/data/data1/">
                                            <thead>
                                                <tr class="data">
                                                    <?php
                                                        if((@$_POST['sort_by'] == 'Date') || (!isset($_POST['sort_by']))){
                                                    ?>
                                                        <th class="data">Date Submitted</th>
                                                        <th class="data">Employee Name</th>
                                                        <th class="data" width="150px">Current Position</th>
                                                        <th class="data">Class</th>
                                                        <th class="data">Date Effective</th>
                                                        <th class="data">Type of Movement</th>
                                                        <th class="data">Entitled To</th>
                                                    <?php }else if(@$_POST['sort_by'] == 'Name'){?>
                                                        <th class="data">Employee Name</th>
                                                        <th class="data">Movement Details</th>
                                                    <?php }?>
                                                </tr>
                                            </thead>
                                            <input type="hidden" id="pr_id">
                                            <?php
                                            if(@$_POST['sort_by'] != 'Name'){
                                                while($row_mm = mysql_fetch_array($sql_mm)){
                                                    
                                                    if((@$_POST['sort_by'] == 'Date') || (!isset($_POST['sort_by']))){
                                                                $emp_num = $row_mm['emp_num'];

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
                                                                
                                                                $sql_position = mysql_query("SELECT * from positions WHERE p_id = '".$row_mm['position_id']."' ") or die(mysql_error());
                                                                $row_position = mysql_fetch_array($sql_position);

                                                                $employee_fullname = ucwords($row_emp['lastname'].', '.$row_emp['firstname'].$middle);
                                                                
                                                                if($row_mm['class'] == 'permanent'){
                                                                    $date_effective = date('Y/m/d h:i A', strtotime($row_mm['per_date']));
                                                                }else{
                                                                    $date_effective = date('Y/m/d h:i A', strtotime($row_mm['temp_date1'])).'<br/>to<br/>'.date('Y/m/d h:i A', strtotime($row_mm['temp_date2']));
                                                                }
                                                                
                                                                $type = explode('~',$row_mm['type']);
                                                                $type_val = '';
                                                                if($type[0] == 'transfer' ){
                                                                    $sql_position_t = mysql_query("SELECT * from positions WHERE p_id = '".$type[1]."' ") or die(mysql_error());
                                                                    $row_position_t = mysql_fetch_array($sql_position_t); 
                                                                    $type_val = 'Transfer to other position: '.$row_position_t['position'];
                                                                }else if($type[0] == 'move' ){
                                                                    $sql_company_t = mysql_query("SELECT * from company WHERE company_id = '".$type[1]."' ") or die(mysql_error());
                                                                    $row_company_t = mysql_fetch_array($sql_company_t); 
                                                                    $type_val = 'Move to other company: '.$row_company_t['name'];
                                                                }else if($type[0] == 'deactivate' ){
                                                                    $type_val = 'Deactivated (Resigned / Endo) '.ucwods($type[1]);
                                                                }else if($type[0] == 'reassign' ){
                                                                    $sql_branch_t = mysql_query("SELECT * from branches WHERE branch_id = '".$type[1]."' ") or die(mysql_error());
                                                                    $row_branch_t = mysql_fetch_array($sql_branch_t);
                                                                    $type_val = 'Reassign to other branch: '.ucwords($row_branch_t['branch_name']);
                                                                }
                                                                
                                                                $entitled = '';
                                                                if($row_mm['in_house'] == 'yes'){
                                                                    $entitled .= 'In-house accommodation';
                                                                }if($row_mm['transportation'] == 'yes'){
                                                                    $entitled .= '<br>Free transportation';
                                                                }if(!empty($row_mm['change_rate'])){
                                                                    $entitled .= '<br>Change Rate '. $row_mm['change_rate'];
                                                                }

                                                        echo '<tr class="data2">
                                                                <td>'.date('Y/m/d', strtotime($row_mm['date_submitted'])).'</td>
                                                                <td>'.$employee_fullname.'</td>
                                                                <td>'.ucwords($row_position['position']).'</td>
                                                                <td>'.ucwords($row_mm['class']).'</td>
                                                                <td>'.$date_effective.'</td>
                                                                <td>'.$type_val.'</td>
                                                                <td>'.$entitled.'</td>
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
                                                                
                                                                
                                                                $sql_tns_name = mysql_query("SELECT * from manpower_movement WHERE emp_num = '".$row_amp_act['emp_num']."' and status='transferred'") or die(mysql_error());
                                                                $ctr = 1;
                                                                $tns = '';
                                                                
                                                                $movement_val = '';
                                                                if(mysql_num_rows($sql_tns_name) > 0){
                                                                    echo '<tr class="data2">
                                                                           <td>'.$employee_fullname.'</td>';
                                                                   
                                                                   while($row_tns_name = mysql_fetch_array($sql_tns_name)){
                                                                       
                                                                    $date_submitted = '';
                                                                    $date_submitted1 = '';
                                                                    $current_position = '';
                                                                    $current_position1 = '';
                                                                    $class = '';
                                                                    $date_effective = '';
                                                                    $type_val1 = '';
                                                                    $entitled1 = '';
                                                                    $entitled = '';
                                                                    $date_effective1 = '';
                                                                    
                                                                        $sql_position = mysql_query("SELECT * from positions WHERE p_id = '".$row_tns_name['position_id']."' ") or die(mysql_error());
                                                                        $row_position = mysql_fetch_array($sql_position);
                                                                        
                                                                    if($row_tns_name['class'] == 'permanent'){
                                                                        $date_effective = date('Y/m/d', strtotime($row_tns_name['per_date']));
                                                                    }else{
                                                                        $date_effective = date('Y/m/d', strtotime($row_tns_name['temp_date1'])).' - '.date('Y/m/d', strtotime($row_tns_name['temp_date2']));
                                                                    }
                                                                    
                                                                $type = explode('~',$row_tns_name['type']);
                                                                if($type[0] == 'transfer' ){
                                                                    $sql_position_t = mysql_query("SELECT * from positions WHERE p_id = '".$type[1]."' ") or die(mysql_error());
                                                                    $row_position_t = mysql_fetch_array($sql_position_t); 
                                                                    $type_val = 'Transfer to other position: '.$row_position_t['position'];
                                                                }else if($type[0] == 'move' ){
                                                                    $sql_company_t = mysql_query("SELECT * from company WHERE company_id = '".$type[1]."' ") or die(mysql_error());
                                                                    $row_company_t = mysql_fetch_array($sql_company_t); 
                                                                    $type_val = 'Move to other company: '.$row_company_t['name'];
                                                                }else if($type[0] == 'deactivate' ){
                                                                    $type_val = 'Deactivated (Resigned / Endo): '.ucwods($type[1]);
                                                                }else if($type[0] == 'reassign' ){
                                                                    $sql_branch_t = mysql_query("SELECT * from branches WHERE branch_id = '".$type[1]."' ") or die(mysql_error());
                                                                    $row_branch_t = mysql_fetch_array($sql_branch_t);
                                                                    $type_val = 'Reassign to other branch: '.ucwods($row_branch_t['branch_name']);
                                                                }
                                                                
                                                                if($row_tns_name['in_house'] == 'yes'){
                                                                    $entitled .= 'In-house accommodation, ';
                                                                }if($row_tns_name['transportation'] == 'yes'){
                                                                    $entitled .= 'Free transportation, ';
                                                                }if(!empty($row_tns_name['change_rate'])){
                                                                    $entitled .= 'Change Rate '. $row_tns_name['change_rate'].'';
                                                                }
                                                                           $date_submitted1 = date('Y/m/d', strtotime($row_tns_name['date_submitted']));
                                                                           $current_position1 = ucwords($row_position['position']);
                                                                           $class .= ucwords($row_tns_name['class']);
                                                                           $date_effective1 = $date_effective;
                                                                           $type_val1 = $type_val;
                                                                           $entitled1 = $entitled;
                                                                           $movement_val .= 'Date Submitted: '.$date_submitted1.'<br>Current Position: '.$current_position1.'<br>Movement Class: '. $class.' date effective '.$date_effective.'<br>Movement Type:'.$type_val1.'<br>Entitled To: '.$entitled1.'<hr>';
                                                                   }
                                                                   echo '<td>'.$movement_val.'</td>';
                                                                   echo '</tr>'; 
                                                                }
                                                }
                                            }
                                            ?>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right"><br><input type="button" onclick="tableToExcel('table', 'Manpower Movement Report')" value="Export XLS" class="btn-success"></td>
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
    $('#datetimepicker').keydown(false);
    $('#datetimepicker1').keydown(false);
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


        