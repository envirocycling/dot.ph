<!DOCTYPE html>
 <script type="text/javascript" src="validation/jquery.min.js"></script>
    <link rel="stylesheet" href="validation/bootstrap.css"/>
    <link rel="shortcut icon" type="image/x-icon" href="../../images/logo.png" />
    <script src="bootstrap-table/bootstrap-table.js"></script>
    <link type="text/css" rel="stylesheet" href="bootstrap-table/bootstrap.css">
    <link type="text/css" rel="stylesheet" href="bootstrap-table/bootstrap-table.css">
    
    <link href="css/multiple_dropdown.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/multiple_dropdown.mini.js"></script>
    <link href="css/multiple_select.css" rel="stylesheet" type="text/css" />
    <script src="js/multiple_select.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function () {            
            var sort_php = $('#sort_txt').val();
            var arr_sort = sort_php.split('~');
            var ctr_sort = 0;
            var sel_sort = $("#sort_by option");
            
            while(arr_sort[ctr_sort] !== ''){
                sel_sort.each(function(){
                    if($(this).val() === arr_sort[ctr_sort]){
                    $(this).attr('selected',true);
                    }
                });
                ctr_sort++;
            }

            $('#sort_by').multiselect({
                includeSelectAllOption: true
            });
            
        });
    </script>
    <script>
    $(document).ready(function () {
        $("#table").bootstrapTable({
            search: true,
            showToggle: true,
            searchAlign: 'left',
            columns: [{
                    //per collumn option
                    sortable: true,
                    class: "thead",
                    field: "pr #",
                    title: "PR #",
                    switchable: true,
                    visible: false
                }, {
                    sortable: true,
                    class: "thead",
                    field: "date requested",
                    title: "Date Requested",
                    switchable: true
                }, {
                    sortable: true,
                    class: "thead",
                    field: "job title",
                    title: "Job Title",
                    switchable: true
                }, {
                    sortable: true,
                    class: "thead",
                    field: "date needed",
                    title: "Date Needed",
                    switchable: true
                }, {
                    sortable: true,
                    class: "thead",
                    field: "number needed",
                    title: "Number Needed",
                    switchable: true
                }, {
                    sortable: true,
                    class: "thead",
                    field: "employment status",
                    title: "Employment Status",
                    switchable: true
                }, {
                    sortable: true,
                    class: "thead",
                    field: "branch requested",
                    title: "Branch Requested",
                    switchable: true
                }, {
                    sortable: true,
                    class: "thead",
                    field: "reason",
                    title: "Reason",
                    switchable: true
                }, {
                    sortable: true,
                    class: "thead",
                    field: "qualification",
                    title: "Qualification",
                    switchable: true
                }, {
                    sortable: true,
                    class: "thead",
                    field: "skill",
                    title: "Skill",
                    switchable: true,
                    visible: false
                }, {
                    sortable: true,
                    class: "thead",
                    field: "attitudinal",
                    title: "Attitudinal",
                    switchable: true,
                    visible: false
                }, {
                    sortable: true,
                    class: "thead",
                    field: "salary",
                    title: "Salary",
                    switchable: true,
                    visible: false
                }, {
                    sortable: true,
                    class: "thead",
                    field: "gm status",
                    title: "GM Status",
                    switchable: true,
                    visible: false
                }, {
                    sortable: true,
                    class: "thead",
                    field: "hr status",
                    title: "HR Status",
                    switchable: true,
                    visible: false
                }, {
                    sortable: true,
                    class: "thead",
                    field: "served tat",
                    title: "Served TAT",
                    switchable: true,
                    visible: false
                }]
        });
       
       
    });

</script>
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
                        <?php
                        include 'layout/menu.php';
                            if(isset($_POST['filter'])){
                                $sort_query = '';
                                $sort_php = '';
                                 foreach($_POST['sort_by'] as $sel_comp){
                                   $sort_query .= " employment_status = '".$sel_comp."' or"; 
                                   $sort_php .= $sel_comp.'~';
                                }
                                $sort_query = substr($sort_query,0,-2);
                                 
                                $sql_pr = mysql_query("SELECT * from personnel_requisition WHERE date_requested >= '".$_POST['from']."' and date_requested <= '".$_POST['to']."' and ($sort_query) ORDER by date_requested Asc") or die(mysql_error());
                                 $from = $_POST['from'];
                                 $to = $_POST['to'];
                            }else{
                                $sort_php = '';
                                $sql_attrSort= mysql_query("SELECT * from employment_status");
                                while($row_attrSort = mysql_fetch_array($sql_attrSort)){
                                     $sort_php .= $row_attrSort['code'].'~';
                                }
                                
                                 $sql_pr = mysql_query("SELECT * from personnel_requisition WHERE date_requested LIKE '".date('Y-m')."%' ORDER by date_requested Asc") or die(mysql_error());
                                 $from = date('Y/m');
                                 $from = $from.'/01'; 
                                $to = date('Y/m/t');                                
                            }
                        echo '<input type="hidden" id="sort_txt" value="'.$sort_php.'">';
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
                                    <td class="header1" colspan="4"><center>Report Personnel Requisition<br></center></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><hr></td>
                                </tr>
                            </table>
                            <input type="hidden" id="emp_num">
                            <table width="95%">
                                <tr>
                                    <td colspan="8" align="right">
                                <form action="" method="post">
                                        <?php
                                            $sql_EmpStatSet = mysql_query("SELECT * from employment_status") or die(mysql_error());
                                            echo 'Filtering Option: <select name="sort_by[]" id="sort_by" multiple required>';
                                               while ($row_EmpStatSet = mysql_fetch_array($sql_EmpStatSet)) {
                                                        echo '<option value="' . $row_EmpStatSet['code'] . '">' . $row_EmpStatSet['code'] . '</option>';
                                               }
                                            echo '</select>';
                                            ?>
                                       <input type="text" style="width:115px; height: 30px; margin-top: 10px;" id="datetimepicker" name="from" autocomplete="off" placeholder="required" value="<?php echo $from;?>" required/> To: <input type="text" style="width:115px; height: 30px; margin-top: 10px;" id="datetimepicker1" name="to" autocomplete="off"  placeholder="required" value="<?php echo $to;?>" required/> 
                                       <input type="submit" class="btn btn-primary" value="Filter" name="filter">
                                    
                                </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right"><br><br><input type="button" onclick="tableToExcel('table', 'Personnel Requisition Report')" value="Export XLS" class="btn-success"><br></td>
                                </tr>
                                <tr>
                                    <td>
                                        <table id="table" style="background:white;" data-show-columns="true" data-url="/gh/get/response.json/wenzhixin/bootstrap-table/tree/master/docs/data/data1/">
                                    <thead class="thead">

                                    </thead>
                                    <tbody>
                                            <input type="hidden" id="pr_id">
                                            <?php
                                               
                                                while($row_pr = mysql_fetch_array($sql_pr)){
                                                                                                       
                                                    $emp_branch = mysql_query("SELECT * from branches WHERE branch_id = '".$row_pr['branch_id']."' ") or die(mysql_error());
                                                    $row_emp_branch = mysql_fetch_array($emp_branch);
                                                    
                                                    $emp_position = mysql_query("SELECT * from positions WHERE p_id = '".$row_pr['job_title']."' ") or die(mysql_error());
                                                    $row_emp_position = mysql_fetch_array($emp_position);
                                                    
                                                    $emp_company = mysql_query("SELECT * from company WHERE company_id = '".$row_pr['company_id']."' ") or die(mysql_error());
                                                    $row_emp_company = mysql_fetch_array($emp_company);
                                                    
                                                    if($row_pr['employment_status'] == 'Agency'){
                                                        $emp_status = $row_pr['employment_status'].'<br> under '.$row_emp_company['name'];
                                                            
                                                    }else{
                                                            $emp_status = $row_pr['employment_status'];
                                                    }
                                                    $chk_served = strtotime($row_pr['hr_serve_date']);
                                                    
                                                    //served tat start
                                                    if($chk_served > 0){
                                                        $date1 = $row_pr['gm_date'];
                                                        $date2 = $row_pr['hr_serve_date'];
                                                        $diff = abs(strtotime($date2) - strtotime($date1));
                                                        $years = floor($diff / (365*60*60*24));
                                                        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                                        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                                        if($days > 1){
                                                            $served_tat = $days.' days';
                                                        }else{
                                                            $served_tat = $days.' day';
                                                        }
                                                        
                                                        $hr_status = ucwords($row_pr['hr_status'].' <i><font size="-1">'.date('M d, Y', strtotime($row_pr['hr_date']))).'</i></font>';
                                                    }else{
                                                        $served_tat = '-';
                                                    }
                                                    //served tat end
                                                    
                                                    //hr status start
                                                    if($row_pr['hr_status'] == 'noted'){
                                                        $hr_status = ucwords($row_pr['hr_status'].'<br> <i><font size="-1"> at '.date('M d, Y', strtotime($row_pr['hr_date']))).'</i></font>';
                                                    }else if($row_pr['hr_status'] == 'served'){
                                                        $hr_status = ucwords($row_pr['hr_status'].'<br> <i><font size="-1"> at '.date('M d, Y', strtotime($row_pr['hr_serve_date']))).'</i></font>';
                                                    }else if($chk_served > 0){
                                                        $hr_status = ucwords($row_pr['hr_status'].'<br> <i><font size="-1"> at '.date('M d, Y', strtotime($row_pr['hr_date']))).'</i></font>';
                                                    }else if($row_pr['hr_status'] == 'cancelled'){
                                                        $hr_status = ucwords($row_pr['hr_status'].'<br> <i><font size="-1"> at '.date('M d, Y', strtotime($row_pr['hr_date']))).'</i></font>';
                                                    }else{
                                                        $hr_status = ucwords($row_pr['hr_status']);
                                                    }
                                                    //hr status end
                                                    
                                                    //gm status start
                                                    if($row_pr['gm_status'] != 'pending'){
                                                        $gm_status = ucwords($row_pr['gm_status'].'<br> <i><font size="-1"> at '.date('M d, Y', strtotime($row_pr['gm_date']))).'</i></font>';
                                                    }else{
                                                        $gm_status = ucwords($row_pr['gm_status']);
                                                    }
                                                    //gm status end
                                                    $reason = array();
                                                    $reason_val = '';
                                                    $reason = explode("~",$row_pr['reason']);
                                                    if($reason[0] == 'r1'){
                                                        $reason_val = '•Replacement, '.$reason[1].'.<br>';
                                                    }if($reason[2] == 'r2'){
                                                        $reason_val .= '•Replacement, '.$reason[3].'.<br>';
                                                    }if($reason[4] == 'r3'){
                                                        $reason_val .= '•Additional, '.$reason[5].'.<br>';
                                                    }if($reason[6] == 'r4'){
                                                        $reason_val .= '•New, '.$reason[7].'.<br>';
                                                    }
                                                    
                                                    $ed_req = explode("~",$row_pr['education_req']);
                                                    if(empty($ed_req[1])){
                                                       if($ed_req[0] == 'ag'){
                                                           $ed_val = 'Associate Graduate';
                                                       }else if($ed_req[0] == 'dc'){
                                                           $ed_val = 'Diploma Course';
                                                       }else if($ed_req[0] == 'hg'){
                                                           $ed_val = 'At least High School Graduate';
                                                       }
                                                    }else{
                                                        $ed_val = 'College ('.$ed_req[1].')';
                                                    }
                                                    
                                                        
                                                    echo '<tr class="data2">
                                                            <td>'.$row_pr['pr_id'].'</td>
                                                            <td>'.date('Y/m/d', strtotime($row_pr['date_requested'])).'</td>
                                                            <td>'.$row_emp_position['position'].'</td>
                                                            <td>'.date('Y/m/d', strtotime($row_pr['date_needed'])).'</td>
                                                            <td>'.$row_pr['no_needed'].'</td>
                                                            <td>'.$emp_status.'</td>
                                                            <td>'.$row_emp_branch['branch_name'].'</td>
                                                            <td>'.$reason_val.'</td>
                                                            <td>'.$ed_val.'</td>
                                                            <td>'.$row_pr['special_skills'].'<br>'.$row_pr['other_skills'].'</td>
                                                            <td>'.$row_pr['attitudinal_req'].'</td>
                                                            <td>'.number_format($row_pr['salary'],2).'</td>
                                                            <td>'.$gm_status.'</td>
                                                            <td>'.$hr_status.'</td>
                                                            <td>'.$served_tat.'</td>
                                                    </tr>';?>
                                                <?php
                                                }
                                            ?>
                                         </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right"><br><input type="button" onclick="tableToExcel('table', 'Personnel Requisition Report')" value="Export XLS" class="btn-success"></td>
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


        