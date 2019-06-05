<?php
//error_reporting(E_ERROR | E_PARSE);
include('templates/template.php');
if (!isset($_SESSION['username'])) {
    echo "<script>
window.location = 'index.php';
</script>";
}
include 'config.php';

$branch_array = array();

$sql_branch = mysql_query("SELECT * FROM branches");
while ($rs_branch = mysql_fetch_array($sql_branch)) {
    array_push($branch_array, $rs_branch['branch_name']);
}
?>
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
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.ui.core.min.js"></script>
<script src="js/setup.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();

    });

    function tbls() {
        var tbl = $('#tbl').val();

        if (tbl == 'bales' || tbl == 'actual' || tbl == 'sup_deliveries' || tbl == 'paper_buying') {
            $('#bales_date').show(500);
        } else {
            $('#bales_date').hide(500);
        }
        if (tbl == 'loose_papers' || tbl == 'outgoing') {
            $('#loose_date').show(500);
        } else {
            $('#loose_date').hide(500);
        }


    }

    function bales_chks() {
        var tbl = $('#tbl').val();
        if (document.getElementById('bales_chked').checked) {
            $('#another').show(500);
        } else {
            $('#another').hide(500);
        }

    }

</script>
<html>
    <body  onload="tbls();">
        <div class="grid_4">

            <div class="box round first">
                <form action="expired_billings.php" method="POST">

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

                    Group: <select name="group">

                        <option value="">All</option>

                        <option value="LCWL">LCWL</option>

                        <option value="ONP">ONP</option>

                        <option value="OCC">OCC</option>

                        <option value="MW">MW</option>

                        <option value="CBS">CBS</option>

                        <option value="CHIPBOARD">CHIPBOARD</option>

                    </select><br>

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

                    <input type="submit" name="submit" value="Filter">

                </form>

            </div>

        </div>
        <div class="grid_10">
            <div class="box round first">
                <?php
                if (isset($_POST['submit'])) {
                    $from = $_POST['from'];
                    $to = $_POST['to'];
                    $branch = $_POST['branch'];
                    $group = $_POST['group'];
                    ?>
                    <table class="data display datatable" id="example">

                        <?php
                        $sample_tot = 0;

                        echo "<thead>";

                        echo '<tr class="data">';

                        echo "<th class='data' width='50'></th>";

                        if ($chk_branch == 'PAMPANGA') {
                            echo "<td>STR</td>";
                        }

                        echo "<th class='data'>Date Received</th>";

                        echo "<th class='data'>Supplier Name</th>";

                        echo "<th class='data'>WP Grade</th>";

                        echo "<th class='data'>Weight</th>";

                        echo "<th class='data'>Buying Price</th>";

                        echo "<th class='data'>Tipco Price</th>";

                        echo "<th class='data'>Additional</th>";

                        echo "<th class='data'>Amount</th>";


                        echo "<th class='data'>Branch</th>";


                        echo "</tr>";

                        echo "</thead>";

                        $current_date = date('Y/m/d');
                        $exp_date = date('Y/m/d', strtotime('-1 month', strtotime($current_date)));
                        if ($group == 'MW') {
                            $query = "Select * from paper_buying WHERE (wp_grade like '%CORETUBE%' or wp_grade like '%CT%' or wp_grade like '%LCAP_K%' or wp_grade like '%MW%') and date_received>='$from' and date_received<='$to' and date_received<'$exp_date' and (dr_number='' or status='') and branch like '%$branch%'";
                        } else if ($group == 'ONP') {
                            $query = "Select * from paper_buying WHERE (wp_grade like '%ONP%' or wp_grade like '%OPD%' or wp_grade like '%NPB%' or wp_grade like '%OIN%') and date_received>='$from' and date_received<='$to' and date_received<'$exp_date' and branch like '%$branch%'";
                        } else if ($group == 'OCC') {
                            $query = "Select * from paper_buying WHERE (wp_grade like '%HM.OCC%' or wp_grade like '%LCOCC%' or wp_grade like '%WT.OCC%' or wp_grade like '%OCC%' or wp_grade like '%OLD.CC%') and date_received>='$from' and date_received<='$to' and date_received<'$exp_date' and (dr_number='' or status='')  and  branch like '%$branch%'";
                        } else if ($group == 'LCWL') {
                            $query = "Select * from paper_buying WHERE (wp_grade like '%BOOK.LCWL%' or wp_grade like '%GUMS.LCWL%' or wp_grade like '%LCWL STICKIES%' or wp_grade like '%WL%' or wp_grade like '%LCWL%') and date_received>='$from' and date_received<='$to' and date_received<'$exp_date' and (dr_number='' or status='')  and branch like '%$branch%'";
                        } else if ($group == 'CHIPBOARD') {
                            $query = "Select * from paper_buying WHERE wp_grade like '%CHIPBOARD%' and date_received>='$from' and date_received<='$to' and date_received<'$exp_date' and (dr_number='' or status='') and branch like '%$branch%'";
                        } else if ($group == 'CBS') {
                            $query = "Select * from paper_buying WHERE wp_grade like '%CBS%' and date_received>='$from' and date_received<='$to' and date_received<'$exp_date' and (dr_number='' or status='') and branch like '%$branch%'";
                        } else {
                            $query = "Select * from paper_buying WHERE (wp_grade like '%CBS%' or wp_grade like '%BOOK.LCWL%' or wp_grade like '%GUMS.LCWL%' or wp_grade like '%LCWL STICKIES%' or wp_grade like '%WL%' or wp_grade like '%LCWL%' or wp_grade like '%HM.OCC%' or wp_grade like '%LCOCC%' or wp_grade like '%WT.OCC%' or wp_grade like '%OCC%' or wp_grade like '%OLD.CC%'  or wp_grade like '%CORETUBE%' or wp_grade like '%CT%' or wp_grade like '%LCAP_K%' or wp_grade like '%MW%' or wp_grade like '%BOOK.LCWL%' or wp_grade like '%GUMS.LCWL%' or wp_grade like '%LCWL STICKIES%' or wp_grade like '%WL%') and date_received>='$from' and date_received<='$to' and date_received<'$exp_date' and (dr_number='' or status='') and branch like '%$branch%'";
                            //echo "Select * from paper_buying WHERE (wp_grade like '%CBS%' or wp_grade like '%BOOK.LCWL%' or wp_grade like '%GUMS.LCWL%' or wp_grade like '%LCWL STICKIES%' or wp_grade like '%WL%' or wp_grade like '%LCWL%' or wp_grade like '%HM.OCC%' or wp_grade like '%LCOCC%' or wp_grade like '%WT.OCC%' or wp_grade like '%OCC%' or wp_grade like '%OLD.CC%'  or wp_grade like '%CORETUBE%' or wp_grade like '%CT%' or wp_grade like '%LCAP_K%' or wp_grade like '%MW%' or wp_grade like '%BOOK.LCWL%' or wp_grade like '%GUMS.LCWL%' or wp_grade like '%LCWL STICKIES%' or wp_grade like '%WL%') and date_received>='$from' and date_received<='$to' and date_received<'$exp_date' and (dr_number='' or status='') and branch like '%$branch%'";
                        }

                        $result = mysql_query($query);

                        $total_corrected_weight = 0;

                        $total_add = 0;

                        $total_amount = 0;

                        $ctr = 0;

                        while ($row = mysql_fetch_array($result)) {

                            if (trim($row['wp_grade']) == 'ONP' || trim($row['wp_grade']) == 'LCONP' || trim($row['wp_grade']) == 'OIN' || trim($row['wp_grade']) == 'OPD' || trim($row['wp_grade']) == 'NPB' || trim($row['wp_grade']) == 'ONP BOOKS' || trim($row['wp_grade']) == 'ONP GUMS' || trim($row['wp_grade']) == 'ONP STICKIES' || trim($row['wp_grade']) == 'STICKIES ONP') {
                                $wp_grade = "ONP";
                            }
                            if (trim($row['wp_grade']) == 'HM.OCC' || trim($row['wp_grade']) == 'LCOCC' || trim($row['wp_grade']) == 'WT.OCC' || trim($row['wp_grade']) == 'OCC' || trim($row['wp_grade']) == 'OLD.CC') {
                                $wp_grade = "OCC";
                            }

                            if (trim($row['wp_grade']) == 'CORETUBE' || trim($row['wp_grade']) == 'CT' || trim($row['wp_grade']) == 'LCAP_K' || trim($row['wp_grade']) == 'MW') {
                                $wp_grade = "MW";
                            }

                            if (trim($row['wp_grade']) == 'BOOK.LCWL' || trim($row['wp_grade']) == 'GUMS.LCWL' || trim($row['wp_grade']) == 'LCWL STICKIES' || trim($row['wp_grade']) == 'WL' || trim($row['wp_grade']) == 'LCWL') {
                                $wp_grade = "LCWL";
                            }

                            if (trim($row['wp_grade']) == 'CHIPBOARD') {
                                $wp_grade = "CHIPBOARD";
                            }

                            if (trim($row['wp_grade']) == 'CBS') {
                                $wp_grade = "CBS";
                            }
                            
                            //start new code tipco price
                            $sql_tipcoPrice = mysql_query("SELECT * from tipco_prices WHERE wp_grade='" . $row['wp_grade'] . "' and branch = '" . $row['branch'] . "' and date_effective <= '" . $row['date_received'] . "' ORDER BY date_effective Desc LIMIT 1") or die(mysq_error());
                            $tipco_price = 0;
                            if (mysql_num_rows($sql_tipcoPrice) == 0) {
                                $sql_baseGrade = mysql_query("SELECT * from material WHERE details = '" . $row['wp_grade'] . "'") or die(mysql_error());
                                $row_baseGrade = mysql_fetch_array($sql_baseGrade);

                                $sql_mat = mysql_query("SELECT * from material WHERE material_id = '" . $row_baseGrade['under_by'] . "'") or die(mysql_error());
                                $row_mat = mysql_fetch_array($sql_mat);

                                $wp_grade = strtoupper($row_mat['details']);
                                $sql = mysql_query("SELECT * FROM tipco_prices WHERE wp_grade='$wp_grade' and branch='" . $row['branch'] . "' and date_effective <= '" . $row['date_received'] . "' ORDER BY date_effective DESC LIMIT 1") or die(mysql_error());
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
                            
                            $additional = $row['unit_cost'] - $tipco_price;
                            //end new code tipco price

                            /*$sql = mysql_query("SELECT * FROM tipco_prices WHERE wp_grade='$wp_grade' and branch='" . $row['branch'] . "' and date_effective <= '" . $row['date_received'] . "' ORDER BY date_effective DESC");

                            $rs = mysql_fetch_array($sql);

                            $additional = $row['unit_cost'] - $rs['price'];*/
//echo $additional.'<br>';
                            if ($additional > 0) {

                                echo "<tr>";
                                if ($_SESSION['position'] == 'Inventory Controller' || $_SESSION['position'] == 'Programmer' || $_SESSION['position'] == 'Branch Head') {
                                    $now = date("Y/m/d");
                                    if ($row['status'] != 'billed') {
                                        echo "<td></td>";
                                        //echo "<input id='corrected_weight$ctr' type='hidden' name='corrected_weight' value='" . $row['corrected_weight'] . "'>";
                                        $sample_tot+=$row['corrected_weight'];
                                        $ctr++;
                                    } else {
                                        echo "<td>BILLED</td>";
                                    }
                                } else {
                                    if ($row['status'] == 'billed') {
                                        echo "<td></td>";
                                        $ctr++;
                                    } else {
                                        echo "<td>BILLED</td>";
                                    }
                                }
                                if ($chk_branch == 'PAMPANGA') {
                                    echo "<td>" . $row['dr_number'] . "</td>";
                                }
                                echo "<td>" . $row['date_received'] . "</td>";


                                echo "<td>" . $row['supplier_id'] . "_" . $row['supplier_name'] . "</td>";

                                echo "<td>" . $row['wp_grade'] . "</td>";

                                echo "<td>" . $row['corrected_weight'] . "</td>";

                                $total_corrected_weight+=$row['corrected_weight'];

                                echo "<td>" . $row['unit_cost'] . "</td>";

                                if (!empty($tipco_price)) {

                                    echo "<td>" . $tipco_price. "</td>";
                                } else {

                                    echo "<td>0</td>";
                                }

                                echo "<td>" . number_format($additional, 2) . "</td>";

                                echo "<td>" . number_format($additional * $row['corrected_weight'], 2) . "</td>";

                                echo "<td>" . $row['branch'] . "</td>";

                                echo "</tr>";



                                $total_add+=$additional;

                                $total_amount+=$additional * $row['corrected_weight'];
                            }
                        }

                        echo "<tr id='total'>";

                        echo "<td>!TOTAL!</td>";
                        if ($chk_branch == 'PAMPANGA') {
                            echo "<td></td>";
                        }

                        echo "<td></td>";

                        echo "<td></td>";

                        echo "<td></td>";

                        echo "<td>" . number_format($total_corrected_weight, 2) . "</td>";

                        echo "<td></td>";

                        echo "<td></td>";

//                    echo "<td>" . number_format($total_add, 2) . "</td>";
                        echo "<td></td>";

                        echo "<td>" . number_format($total_amount, 2) . "</td>";

                        echo "<td></td>";

                        echo "</tr>";
                        ?>

                    </table>
                </div>
            </div>
<?php } ?>		 
        <div class="clear">

        </div>

        <div class="clear">

        </div>


    </body>
</html>



