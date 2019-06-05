<!DOCTYPE html>
<html lang="en">
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
            
            var comp_php = $('#comp_txt').val();
            var arr_comp = comp_php.split('~');
            var ctr_comp = 0;
            var sel_comp = $("#company option");
            
            while(arr_comp[ctr_comp] !== ''){
                sel_comp.each(function(){
                    if($(this).val() === arr_comp[ctr_comp]){
                    $(this).attr('selected',true);
                    }
                });
                ctr_comp++;
            }
            
           
            $('#company').multiselect({
                includeSelectAllOption: true
            });
            
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
                    field: "emp name",
                    title: "Emp Name",
                    switchable: true
                }, {
                    sortable: true,
                    class: "thead",
                    field: "img",
                    title: "Image",
                    switchable: true
                }, {
                    sortable: true,
                    class: "thead",
                    field: "address",
                    title: "Address",
                    switchable: true
                }, {
                    sortable: true,
                    class: "thead",
                    field: "birthday",
                    title: "Birthday",
                    switchable: true
                }, {
                    sortable: true,
                    class: "thead",
                    field: "civil status",
                    title: "Civil Status",
                    switchable: true,
                    visible: false
                }, {
                    sortable: true,
                    class: "thead",
                    field: "contact #",
                    title: "Contact #",
                    switchable: true,
                    visible: false
                }, {
                    sortable: true,
                    class: "thead",
                    field: "tin",
                    title: "TIN",
                    switchable: true,
                    visible: false
                }, {
                    sortable: true,
                    class: "thead",
                    field: "sss #",
                    title: "SSS #",
                    switchable: true,
                    visible: false
                }, {
                    sortable: true,
                    class: "thead",
                    field: "phic #",
                    title: "PHIC #",
                    switchable: true,
                    visible: false
                }, {
                    sortable: true,
                    class: "thead",
                    field: "hdmf #",
                    title: "HDMF #",
                    switchable: true,
                    visible: false
                }, {
                    sortable: true,
                    class: "thead",
                    field: "date hired",
                    title: "Date Hired",
                    switchable: true
                }, {
                    sortable: true,
                    class: "thead",
                    field: "orig hiring date",
                    title: "Orig Hiring Date",
                    switchable: true,
                    visible: false
                }, {
                    sortable: true,
                    class: "thead",
                    field: "company",
                    title: "Company",
                    switchable: true
                }, {
                    sortable: true,
                    class: "thead",
                    field: "branch",
                    title: "Branch",
                    switchable: true
                }, {
                    sortable: true,
                    class: "thead",
                    field: "position",
                    title: "Position",
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
                    field: "stay-in",
                    title: "Stay-in",
                    switchable: true,
                    visible: false
                }]
        });
       
       
    });

</script>

    <body>
        <?php
        include 'layout/header.php'; 
        $actual_linkEmpImg = "http://$_SERVER[HTTP_HOST]/images/emp-data/";
        ?>
        <script type="text/javascript">            
//            var tableToExcel = (function () {
//            var uri = 'data:application/vnd.ms-excel;base64,'
//                    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml></head><body><table>{table}</table></body></html>'
//                                        , base64 = function (s) {
//            return window.btoa(unescape(encodeURIComponent(s)))
//                }
//        , format = function (s, c) {
//            return s.replace(/{(\w+)}/g, function (m, p) {
//                return c[p];
//            })
//        }
//        return function (table, name) {
//            if (!table.nodeType)
//                table = document.getElementById(table)
//            var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
//            window.location.href = uri + base64(format(template, ctx))
//        }

var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(s)) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
//    window.location.href = uri + base64(format(template, ctx))
  }
})()

</script>
<style>
    .imgs{
        height: 150px;
        width: 150px;
    }
</style>
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
                                   $sort_query .= ' status_id = '.$sel_comp.' or'; 
                                   $sort_php .= $sel_comp.'~';
                                }
                                $sort_query = substr($sort_query,0,-2);
                                
                                $comp_query = '';
                                $comp_php = '';
                                foreach($_POST['company'] as $sel_comp1){
                                   $comp_query .= ' company_id = '.$sel_comp1.' or'; 
                                   $comp_php .= $sel_comp1.'~';
                                }
                                $comp_query = substr($comp_query,0,-2);
                                
                                $sql_filter = mysql_query("SELECT * from employees WHERE ($sort_query) and ($comp_query) ORDER BY lastname Asc") or die(mysql_error());
                            }else{
                                $sort_php = '';
                                $comp_php = '';
                                $sql_attrSort= mysql_query("SELECT * from employment_status");
                                while($row_attrSort = mysql_fetch_array($sql_attrSort)){
                                     $sort_php .= $row_attrSort['e_id'].'~';
                                }
                                
                                $sql_attrComp = mysql_query("SELECT * from company WHERE status=''");
                                while($row_attrComp = mysql_fetch_array($sql_attrComp)){
                                    $comp_php .= $row_attrComp['company_id'].'~';
                                }
                                
                                $sql_filter = mysql_query("SELECT * from employees ORDER BY lastname Asc") or die(mysql_error());
                            }
                            
                        echo '<input type="hidden" id="sort_txt" value="'.$sort_php.'">';
                        echo '<input type="hidden" id="comp_txt" value="'.$comp_php.'">';
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
                                    <td class="header1" colspan="4"><center>Report Employee<br></center></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><hr></td>
                                </tr>
                            </table>
                            <input type="hidden" id="emp_num">
                            <table width="95%">
                                <tr>
                                    <td colspan="8" align="right">
                                        <form action="" method="post" id="form">
                                            <?php
                                            $sql_EmpStatSet = mysql_query("SELECT * from employment_status") or die(mysql_error());
                                            echo 'Filtering Option: <select name="sort_by[]" id="sort_by" multiple required>';
                                               while ($row_EmpStatSet = mysql_fetch_array($sql_EmpStatSet)) {
                                                        echo '<option value="' . $row_EmpStatSet['e_id'] . '">' . $row_EmpStatSet['code'] . '</option>';
                                               }
                                            echo '</select>';
                                            ?>
                                       
                                        <select name="company[]" id="company" multiple="multiple" required>
                                            <?php
                                            $sql_comp = mysql_query("SELECT * from company WHERE status='' Order by name Asc") or die(mysql_error());
                                            while ($row_comp = mysql_fetch_array($sql_comp)) {
                                                echo '<option value="' . $row_comp['company_id'] . '">' . $row_comp['name'] . '</option>';
                                                
                                            }
                                            ?>
                                        </select>

                                       <input type="submit" class="btn btn-primary" value="Filter"  name="filter" id="filter">
                                       </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right"><br><br><input type="button" onclick="tableToExcel('table', 'MMS Employee Report')" value="Export XLS" class="btn-success btnExport"></td>
                                </tr>
                                <tr>
                                    <td>
                                       <!--table here-->
                                       <table id="table" summary="Code page support in different versions of MS Windows." rules="groups" frame="hsides" border="2" style="background:white;" data-show-columns="true" data-url="/gh/get/response.json/wenzhixin/bootstrap-table/tree/master/docs/data/data1/">
                                    <thead class="thead">

                                    </thead>
                                    <tbody>
        <?php
                                            while($row_emp = mysql_fetch_array($sql_filter)){
                                                $chk_str = strlen($row_emp['middlename']);
                                                if($chk_str > 1){
                                                    $str_count = strlen($row_emp['middlename']) - 1;
                                                $middlename = substr($row_emp['middlename'],0,-$str_count);
                                                }else{
                                                    $str_count = strlen($row_emp['middlename']);
                                                $middlename = $row_emp['middlename'];
                                                }
                                                if(empty($row_emp['middlename'])){
                                                    $middlename = '';
                                                }else{
                                                    $middlename = ', '.$middlename.'.';
                                                }
                                                $fullname = ucwords($row_emp['lastname'].', '.$row_emp['firstname'].$middlename);
                                                
                                                $sql_EmpComp = mysql_query("SELECT * from company WHERE company_id='".$row_emp['company_id']."'") or die(mysql_error());
                                                $row_EmpComp = mysql_fetch_array($sql_EmpComp);
                                                
                                                $sql_EmpBra = mysql_query("SELECT * from branches WHERE branch_id='".$row_emp['branch_id']."'") or die(mysql_error());
                                                $row_EmpBra = mysql_fetch_array($sql_EmpBra);
                                                
                                                $sql_EmpPos = mysql_query("SELECT * from positions WHERE p_id='".$row_emp['position_id']."'") or die(mysql_error());
                                                $row_EmpPos = mysql_fetch_array($sql_EmpPos);
                                                
                                                $sql_EmpStat = mysql_query("SELECT * from employment_status WHERE e_id='".$row_emp['status_id']."'") or die(mysql_error());
                                                $row_EmpStat = mysql_fetch_array($sql_EmpStat);
                                                
                                                $imgPath = '../../images/emp-data/'.$row_emp['emp_num'].'.png';
                                                if(file_exists($imgPath)){
                                                    $img = '<img src="'.$actual_linkEmpImg.$row_emp['emp_num'].'.png" height="10%" width="10%" class="imgs">';
                                                }else{
                                                    $img = '';
                                                }
                                                
                                                echo '<tr class="data2">
                                                        <td>'.$img.'</td>
                                                        <td>'.strtoupper($fullname).'</td>
                                                        <td>'.strtoupper($row_emp['st_brgy'].', '.$row_emp['town_city'].', '.$row_emp['province']).'</td>
                                                        <td>'.date('F d, Y', strtotime($row_emp['birthdate'])).'</td>
                                                        <td>'.strtoupper($row_emp['civil_status']).'</td>
                                                        <td>'.$row_emp['contact_no'].'</td>
                                                        <td>'.$row_emp['tin'].'</td>
                                                        <td>'.$row_emp['sss_no'].'</td>
                                                        <td>'.$row_emp['phic_no'].'</td>
                                                        <td>'.$row_emp['hdmf_no'].'</td>
                                                        <td>'.date('Y/m/d', strtotime($row_emp['date_hired'])).'</td>
                                                        <td>'.date('Y/m/d', strtotime($row_emp['date_start'])).'</td>
                                                        <td>'.strtoupper($row_EmpComp['name']).'</td>
                                                        <td>'.strtoupper($row_EmpBra['branch_name']).'</td>
                                                        <td>'.strtoupper($row_EmpPos['position']).'</td>
                                                        <td>'.strtoupper($row_EmpStat['code']).'</td>
                                                        <td>'.strtoupper($row_emp['stayin']).'</td>
                                                </tr>';
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right"><br><input type="button" onclick="tableToExcel('table', 'MMS Employee Report')" value="Export XLS"  class="btn-success"></td>
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
</body>
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
        <!--<script src="pop-up/jAlert.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>-->
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
