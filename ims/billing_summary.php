<?php
include("templates/template.php");
include 'config.php';
?>
<style>
    #total{

        font-weight: bold;

        background-color: yellow;

    }
</style>

<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />

<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>

<script type="text/javascript">

    function date2(str) {

        new JsDatePick({
            useMode: 2,
            target: str,
            dateFormat: "%Y/%m/%d"



        });

    }
    ;



</script>
<script type="text/javascript">
                    var tableToExcel = (function () {
                    var uri = 'data:application/vnd.ms-excel;base64,'
                            , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
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

<style>

    #link_ng_str{

        color:blue;

    }

    #positive{

        color:green;

        font-weight: bold;

        background-color:#FF9340;

    }

    #negative{

        color:red;

        font-weight: bold;

        background-color:#FF9340;

    }



    #zero{



        font-weight: bold;

        background-color:#FF9340;

    }

    #net{

        font-weight:bold;

        background-color:#33CCFF;

    }

    #from_location{

        font-weight:bold;

        background-color:#29A6CF;

    }

    #dr{

        font-weight:bold;

        background-color:#33CCCC;

    }

    #mc{

        background-color: #85E0FF;

    }

    #dirt{

        background-color: #00B8E6;

    }

    #corrected{

        background-color: yellow;

        font-weight:bold;

    }



</style>

<div class="grid_4">

    <div class="box round first">

        <h2>Billing Summary</h2>

        <br>

        <h6>Filtering Options</h6>

        <form action="billing_summary.php" method="POST">

            Start Date: <input type='text'  id='from' name='from' value="<?php
            if (isset($_POST['from'])) {

                echo $_POST['from'];
            } else {

                echo date("Y/m/d");
            }
            ?>" onfocus='date2(this.id);' readonly size="8"><br>

            End Date: <input type='text'  id='to' name='to' value="<?php
            if (isset($_POST['to'])) {

                echo $_POST['to'];
            } else {

                echo date("Y/m/d");
            }
            ?>" onfocus='date2(this.id);' readonly size="8"><br>

            Branch: <select name="branch">



                <?php
                if ($usertype == 'Super User' || $_SESSION['username'] == 'ic_pampanga' || $usertype == 'Tipco Accounting') {
                    echo "<option value=''>All Branch</option>";
                    $sql_branch = mysql_query("SELECT * FROM branches");
                    while ($rs_branch = mysql_fetch_array($sql_branch)) {

                        echo "<option value='" . $rs_branch['branch_name'] . "'>" . $rs_branch['branch_name'] . "</option>";
                    }
                } else {
                    echo "<option value='" . $_SESSION['user_branch'] . "'>" . $_SESSION['user_branch'] . "</option>";
                }
                ?>

            </select><br>
            Delivered to :<select name="delivered_to">
                <?php
                    if(isset($_POST['submit'])){
                        echo '<option value="'.$_POST['delivered_to'].'">'.$_POST['delivered_to'].'</option>';
                    }
                ?>
                <option value="TIPCO/MULTIPLY">TIPCO/MULTIPLY</option>
                <option value="FSI">FSI</option>
                <option value="ALL">ALL</option>
                        </select><br>

            <input type="submit" name="submit" value="Filter">

        </form>

    </div>

</div>



<?php
if (isset($_POST['submit']) || isset($_GET['submit'])) {
    if (isset($_POST['submit'])) {
        $from = $_POST['from'];
        $to = $_POST['to'];
        $branch = $_POST['branch'];
    }
    if (isset($_GET['submit'])) {
        $from = $_GET['from'];
        $to = $_GET['to'];
        $branch = $_GET['branch'];
    }
    if($_POST['delivered_to'] == 'TIPCO/MULTIPLY'){
        $query_delivered = " and (delivered_to='TIPCO' or delivered_to='MULTIPLY')";
    }else if($_POST['delivered_to'] == 'ALL'){
        $query_delivered = "";
    }else{
        $query_delivered = " and delivered_to='FSI'";
    }
    ?>

    <div class="grid_10">

        <div class="box round first grid">

            <?php
            $ngayon = date('F d, Y');

            $total_receiving = 0;

            echo "<h2>Tipco/Multiply Billing from: $from to: $to ";
            if ($group == '') {
                echo " All Grades ";
            } else {
                echo " " . $group;
            }
            if ($branch == '') {
                echo " All Branch";
            } else {
                echo " in " . $branch;
            }
            echo "</h2>";
            ?>
<br/>
<input type="button" onclick="tableToExcel('example', 'Summary Of Billing')" value="Export XLS">
<br/><br/>
            <table class="data display datatable" id="example">

                <?php
                echo "<thead>";
                echo '<tr class="data">';
                echo "<th class='data'>Date Received</th>";
                echo "<th class='data'>Supplier Name</th>";
                echo "<th class='data'>Branch Delivered</th>";
                echo "<th class='data'>Plate No</th>";
                echo "<th class='data'>STR No</th>";
                echo "<th class='data'></th>";
                echo "<th class='data'></th>";
                echo "<th class='data'></th>";
                echo "<th class='data'>Delivered To</th>";
                echo "<th class='data'>Series No</th>";
                echo "<th class='data'>WP Grade</th>";
                echo "<th class='data'></th>";
                echo "<th class='data'>Weight</th>";
                echo "<th class='data'>Amount Billed</th>";
                echo "</tr>";

                echo "</thead>";
                //echo "SELECT * from actual WHERE date >= '$from' and date <= '$to' and branch LIKE '%$branch%' and branch!='' and trans_id > 0 $query_delivered";
                $sql_actual = mysql_query("SELECT * from actual WHERE date >= '$from' and date <= '$to' and branch LIKE '%$branch%' and branch!='' and trans_id > 0 $query_delivered GROUP BY str_no, wp_grade ORDER BY wp_grade ASC") or die(mysql_error());
                while($row_actual = mysql_fetch_array($sql_actual)){
                    
                    $sql_paperGrade = mysql_query("SELECT * from material WHERE code = '".$row_actual['wp_grade']."'") or die(mysql_error());
                    $row_paperGrade = mysql_fetch_array($sql_paperGrade); 
                    
                    $sql_paperbuying = mysql_query("SELECT * from  paper_buying WHERE dr_number = '".$row_actual['str_no']."' and status='billed' and wp_grade = '".$row_paperGrade['details']."'") or die (mysql_error());
                    
                    if(mysql_num_rows($sql_paperbuying) > 0){
                        while($row_paperbuying = mysql_fetch_array($sql_paperbuying)){
                            $tipco_price = 0;
                            $sql_tipcoPrice = mysql_query("SELECT * from tipco_prices WHERE wp_grade='" . $row_paperbuying['wp_grade'] . "' and branch = '" . $row_paperbuying['branch'] . "' and date_effective <= '" . $row_paperbuying['date_received'] . "' ORDER BY date_effective Desc LIMIT 1") or die(mysq_error());

                            if (mysql_num_rows($sql_tipcoPrice) == 0) {
                                $sql_baseGrade = mysql_query("SELECT * from material WHERE details = '" . $row_paperbuying['wp_grade'] . "'") or die(mysql_error());
                                $row_baseGrade = mysql_fetch_array($sql_baseGrade);

                                $sql_mat = mysql_query("SELECT * from material WHERE material_id = '" . $row_baseGrade['under_by'] . "'") or die(mysql_error());
                                $row_mat = mysql_fetch_array($sql_mat);

                                $wp_grade = strtoupper($row_mat['details']);
                                $sql = mysql_query("SELECT * FROM tipco_prices WHERE wp_grade='$wp_grade' and branch='" . $row_paperbuying['branch'] . "' and date_effective <= '" . $row_paperbuying['date_received'] . "' ORDER BY date_effective DESC LIMIT 1") or die(mysql_error());
                                $rs = mysql_fetch_array($sql);
                                //echo $row_baseGrade['material_id'].'~'.$rs['price'].'~'.$row_actual['str_no']."SELECT * FROM tipco_prices WHERE wp_grade='$wp_grade' and branch='" . $row_paperbuying['branch'] . "' and date_effective <= '".$row_paperbuying['date_received']."' ORDER BY date_effective DESC<br>";

                                if ($row_baseGrade['material_id'] == '11' || $row_baseGrade['material_id'] == '15') {
                                    $tipco_price = $rs['price'] - 2;
                                } else if ($row_baseGrade['material_id'] == '13') {
                                    $tipco_price = $rs['price'] - 3;
                                } else if ($row_baseGrade['material_id'] == '14' || $row_baseGrade['material_id'] == '16') {
                                    $tipco_price = $rs['price'] - 2;
                                }
                            } else {
                                $row_tipcoPrice = mysql_fetch_array($sql_tipcoPrice);
                                $tipco_price = $row_tipcoPrice['price'];
                            }
                            $arr_grade = strtoupper($row_actual['wp_grade']);
                            $str_no = strtoupper($row_actual['str_no']);
                            $del_to = strtoupper($row_actual['delivered_to']);
                            $special_billing = $row_paperbuying['unit_cost'] - $tipco_price;
                            
                            if($special_billing > 0){
                                $amount_billed = $special_billing * $row_paperbuying['corrected_weight'];
                                @$arr_amountBilled[$str_no][$del_to][$arr_grade]+= $amount_billed; 
                            }
                            
                    //echo $str_no.'~'.$arr_grade.'~'.$amount_billed.'if<br>';
                        }
                    }else{
                        $under_by = 0;
                            $sql_chkActualUnder = mysql_query("SELECT * from material WHERE code = '".$row_actual['wp_grade']."'") or die(mysql_error());
                            $row_chkActualUnder = mysql_fetch_array($sql_chkActualUnder);
                            
                            $sql_mat = mysql_query("SELECT * from material WHERE under_by = '".$row_chkActualUnder['under_by']."' and code != '".$row_actual['wp_grade']."'");
                            while($row_mat = mysql_fetch_array($sql_mat)){
                                $sql_actualPaper = mysql_query("SELECT * from actual WHERE str_no='".$row_actual['str_no']."' and wp_grade='".$row_mat['code']."' $query_delivered");
                            
                                if(mysql_num_rows($sql_actualPaper) > 0){
                                  $under_by = 1;  
                                }
                            }
                        if($under_by == 0){
                        //echo "SELECT * from material WHERE under_by = '".$row_paperGrade['under_by']."' and code != '".$row_paperGrade['code']."'<br>";
                        $sql_paperUnder = mysql_query("SELECT * from material WHERE under_by = '".$row_paperGrade['under_by']."' and code != '".$row_paperGrade['code']."' ") or die(mysql_error());
                            while($row_paperUnder = mysql_fetch_array($sql_paperUnder)){
                                //echo "SELECT * from  paper_buying WHERE dr_number = '".$row_actual['str_no']."' and status='billed' and wp_grade = '".$row_paperUnder['details']."'<br>";
                                $sql_paperbuying = mysql_query("SELECT * from  paper_buying WHERE dr_number = '".$row_actual['str_no']."' and status='billed' and wp_grade = '".$row_paperUnder['details']."'") or die (mysql_error());
                                if(mysql_num_rows($sql_paperbuying) > 0){
                                    while($row_paperbuying = mysql_fetch_array($sql_paperbuying)){
                                        
                                        $str_no = strtoupper($row_actual['str_no']);
                                        $arr_grade = strtoupper($row_actual['wp_grade']);
                                        
                                        $variance = $row_actualWeight['actual_weight'] - $row_paperbuyingWeight['paper_weight'];
                                        
                                        
                                            $tipco_price = 0;
                                            $sql_tipcoPrice = mysql_query("SELECT * from tipco_prices WHERE wp_grade='" . $row_paperbuying['wp_grade'] . "' and branch = '" . $row_paperbuying['branch'] . "' and date_effective <= '" . $row_paperbuying['date_received'] . "' ORDER BY date_effective Desc LIMIT 1") or die(mysq_error());

                                                if (mysql_num_rows($sql_tipcoPrice) == 0) {
                                                        $sql_baseGrade = mysql_query("SELECT * from material WHERE details = '" . $row_paperbuying['wp_grade'] . "'") or die(mysql_error());
                                                        $row_baseGrade = mysql_fetch_array($sql_baseGrade);

                                                        $sql_mat = mysql_query("SELECT * from material WHERE material_id = '" . $row_baseGrade['under_by'] . "'") or die(mysql_error());
                                                        $row_mat = mysql_fetch_array($sql_mat);

                                                        $wp_grade = strtoupper($row_mat['details']);
                                                        $sql = mysql_query("SELECT * FROM tipco_prices WHERE wp_grade='$wp_grade' and branch='" . $row_paperbuying['branch'] . "' and date_effective <= '" . $row_paperbuying['date_received'] . "' ORDER BY date_effective DESC LIMIT 1") or die(mysql_error());
                                                        $rs = mysql_fetch_array($sql);
                                                        //echo $row_baseGrade['material_id'].'~'.$rs['price'].'~'.$row_actual['str_no']."SELECT * FROM tipco_prices WHERE wp_grade='$wp_grade' and branch='" . $row_paperbuying['branch'] . "' and date_effective <= '".$row_paperbuying['date_received']."' ORDER BY date_effective DESC<br>";

                                                        if ($row_baseGrade['material_id'] == '11' || $row_baseGrade['material_id'] == '15') {
                                                            $tipco_price = $rs['price'] - 2;
                                                        } else if ($row_baseGrade['material_id'] == '13') {
                                                            $tipco_price = $rs['price'] - 3;
                                                        } else if ($row_baseGrade['material_id'] == '14' || $row_baseGrade['material_id'] == '16') {
                                                            $tipco_price = $rs['price'] - 2;
                                                        }
                                                    }else {
                                                        $row_tipcoPrice = mysql_fetch_array($sql_tipcoPrice);
                                                        $tipco_price = $row_tipcoPrice['price'];
                                                    }
                                                    $arr_grade = strtoupper($row_actual['wp_grade']);
                                                    $str_no = strtoupper($row_actual['str_no']);
                                                    $del_to = strtoupper($row_actual['delivered_to']);
                                                    $special_billing = $row_paperbuying['unit_cost'] - $tipco_price;

                                                    if($special_billing > 0){
                                                        $amount_billed = $special_billing * $row_paperbuying['corrected_weight'];
                                                        @$arr_amountBilled[$str_no][$del_to][$arr_grade]+= $amount_billed; 
                                                    }

                       // echo $str_no.'~'.$arr_grade.'~'.$amount_billed.'else<br>';
                                        
                                    }
                                } 
                            }
                        }
                    }
                }
              // echo "SELECT sum(weight) as weight, str_no, wp_grade, branch, plate_number, date, delivered_to from actual WHERE date >= '$from' and date <= '$to' and branch LIKE '%$branch%' and branch!='' and trans_id > 0  $query_delivered GROUP BY str_no, delivered_to, wp_grade ORDER BY date ASC<br>";
                $sql_actual2 = mysql_query("SELECT sum(weight) as weight, str_no, wp_grade, branch, plate_number, date, delivered_to from actual WHERE date >= '$from' and date <= '$to' and branch LIKE '%$branch%' and branch!='' and trans_id > 0  $query_delivered GROUP BY str_no, delivered_to, wp_grade ORDER BY date ASC") or die(mysql_error());
                while($row_actual2 = mysql_fetch_array($sql_actual2)){
                        $str_no2 = strtoupper($row_actual2['str_no']);
                        $wp_grade2 = strtoupper($row_actual2['wp_grade']);
                        $del_to2 = strtoupper($row_actual2['delivered_to']);
                        
                        $sql_supplier = mysql_query("SELECT * from  paper_buying WHERE dr_number = '$str_no2' LIMIT 1") or die (mysql_error);
                        $row_supplier= mysql_fetch_array($sql_supplier);
                        
                        if(strtoupper($row_actual2['branch']) == 'PAMPANGA'){
                            $supplier = strtoupper($row_supplier['supplier_name']);
                        }else{
                            $supplier = 'BRANCH '.strtoupper($row_actual2['branch']);
                        }
                        
                        $branch_del = ucwords(strtolower($row_actual2['branch']));
                        if($branch_del == 'Kaybiga'){
                            $branch_del = 'Novaliches';
                        }else if($branch_del == 'Pasay'){
                            $branch_del = 'Makati';
                        }
                        
                        /*$sql_chk = mysql_query("SELECT * from paper_buying WHERE dr_number='$str_no2'") or die(mysql_error());
                        while($row_chk = mysql_fetch_array($sql_chk)){
                            $chk_grade = strtoupper($row_chk['wp_grade']);
                            if($chk_grade == $wp_grade2){
                                
                            }
                        } */     
                    echo '<tr>
                                <td>'.$row_actual2['date'].'</td>
                                <td>'.$supplier.'</td>
                                <td>'.$branch_del.'</td>
                                <td>'.$row_actual2['plate_number'].'</td>
                                <td>'.$row_actual2['str_no'].'</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>'.$row_actual2['delivered_to'].'</td>
                                <td>'.$row_actual2['str_no'].'</td>
                                <td>'.$wp_grade2.'</td>
                                <td></td>
                                <td>'.$row_actual2['weight'].'</td>
                                <td>'.number_format($arr_amountBilled[$str_no2][$del_to2][$wp_grade2],2).'</td>
                        </tr>';
                }
                
               /*echo "<tr id='total'>";
                echo "<td>!TOTAL!</td>";

                //echo "<td></td>";

                echo "<td></td>";


                echo "<td></td>";

                echo "<td>" . number_format($total_corrected_weight, 2) . "</td>";

              //  echo "<td></td>";

              //  echo "<td></td>";

//                echo "<td>" . number_format($total_add, 2) . "</td>";
                //echo "<td></td>";

                echo "<td>" . number_format($total_amount, 2) . "</td>";

                echo "<td colspan='9'></td>";
                echo "</tr>";*/
                ?>
            </table>

        </div>
    </div>

    <?php
}
?>

<div class="clear">



</div>



<div class="clear">



</div>


