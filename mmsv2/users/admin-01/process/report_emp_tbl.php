<!DOCTYPE html>
<html lang="en">
    <script type="text/javascript" src="../validation/jquery.min.js"></script>
    <link rel="stylesheet" href="../validation/bootstrap.css"/>
    <script src="../bootstrap-table/bootstrap-table.js"></script>
    <link type="text/css" rel="stylesheet" href="../bootstrap-table/bootstrap.css">
    <link type="text/css" rel="stylesheet" href="../bootstrap-table/bootstrap-table.css">
    
    <script type="text/javascript" src="../js/multiple_dropdown.mini.js"></script>
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
                    field: "emp #",
                    title: "Emp #",
                    switchable: true,
                    visible: false,
                }, {
                    sortable: true,
                    class: "thead",
                    field: "emp name",
                    title: "Emp Name",
                    switchable: true,
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
        <script type="text/javascript">            
            var tableToExcel = (function () {
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

                                       <table id="table" style="background:white;" data-show-columns="true" data-url="/gh/get/response.json/wenzhixin/bootstrap-table/tree/master/docs/data/data1/">
                                    <thead class="thead">

                                    </thead>
                                    <tbody>
        <?php
        include('../../../connect.php');
        $query_val = '';
        $val_sort = intval($_GET['val_sort']);
        $val_sort_array = explode('~',$val_sort);
        
        foreach ($val_sort_array as $sel_sort_array){
            $query_val .= ' status_id='.$sel_sort_array.' or';
        }
        $query_val = substr($query_val, 0, -2);
                
        $con = mysqli_connect('localhost','root','');
            if (!$con) {
                die('Could not connect: ' . mysqli_error($con));
            }
        mysqli_select_db($con,"efi_pamp");
        
            $sql_filter = mysql_query("SELECT * from employees WHERE ($query_val)");
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
                                                
                                                echo '<tr>
                                                        <td class="data">'.$row_emp['emp_num'].'</td>
                                                        <td class="data">'.$fullname.'</td>
                                                        <td class="data">'.ucwords($row_emp['st_brgy'].', '.$row_emp['town_city'].', '.$row_emp['province']).'</td>
                                                        <td class="data">'.date('F d, Y', strtotime($row_emp['birthdate'])).'</td>
                                                        <td class="data">'.ucwords($row_emp['civil_status']).'</td>
                                                        <td class="data">'.$row_emp['contact_no'].'</td>
                                                        <td class="data">'.$row_emp['tin'].'</td>
                                                        <td class="data">'.$row_emp['sss_no'].'</td>
                                                        <td class="data">'.$row_emp['phic_no'].'</td>
                                                        <td class="data">'.$row_emp['hdmf_no'].'</td>
                                                        <td class="data">'.date('Y/m/d', strtotime($row_emp['date_hired'])).'</td>
                                                        <td class="data">'.date('Y/m/d', strtotime($row_emp['date_start'])).'</td>
                                                        <td class="data">'.$row_EmpComp['name'].'</td>
                                                        <td class="data">'.$row_EmpBra['branch_name'].'</td>
                                                        <td class="data">'.$row_EmpPos['position'].'</td>
                                                        <td class="data">'.ucwords($row_EmpStat['code']).'</td>
                                                        <td class="data">'.strtoupper($row_emp['stayin']).'</td>
                                                </tr>';
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right"><br><input type="button" onclick="tableToExcel('table', 'Personnel Requisition Report')" value="Export XLS"  class="btn-success"></td>
                                </tr>
                            </table>
 