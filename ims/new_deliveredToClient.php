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
    ;</script>
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

        <h2>Delivered to Client</h2>

        <br>

        <h6>Filtering Options</h6>

        <form action="new_deliveredToClient.php" method="POST">

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
                if (isset($_POST['submit'])) {
                    echo '<option value="' . $_POST['delivered_to'] . '">' . $_POST['delivered_to'] . '</option>';
                }
                $sql_client = mysql_query("SELECT * from client");
                echo '<option value="">All</option>';
                while ($row_client = mysql_fetch_array($sql_client)) {
                    echo '<option value="' . $row_client['client_name'] . '">' . $row_client['client_name'] . '</option>';
                }
                ?>

            </select><br>

            <input type="submit" name="submit" value="Filter">

        </form>

    </div>

</div>



<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['submit'])) {
        $from = $_POST['from'];
        $to = $_POST['to'];
        $branch = $_POST['branch'];
        $delTo = $_POST['delivered_to'];
    }
    ?>

    <div class="grid_10">

        <div class="box round first grid">

            <?php
            $ngayon = date('F d, Y');

            $total_receiving = 0;

            echo "<h2>Delivered to Client from: $from to: $to ";

            if ($branch == '') {
                echo " All Branch";
            } else {
                echo " in " . $branch;
            }
            echo "</h2>";
            ?>
            <br/>
            <input type="button" onclick="tableToExcel('example', 'Delivered to Client')" value="Export XLS">
            <br/><br/>
            <table class="data display datatable" id="example">

                <?php
                echo "<thead>";
                echo '<tr class="data">';
                echo "<th class='data'>Date Received</th>";
                echo "<th class='data'>Supplier Name</th>";
                echo "<th class='data'>Branch Delivered</th>";
                echo "<th class='data'>Plate No</th>";
                echo "<th class='data'>WP Grade</th>";
                echo "<th class='data'>Corrected Weight</th>";
                echo "<th class='data'>Delivered To</th>";
                echo "<th class='data'>Ref</th>";
                echo "</tr>";
                echo "</thead>";
                $sql_paperBuying = mysql_query("SELECT * from paper_buying WHERE date_received >= '$from' and date_received <= '$to' and dr_number LIKE '%$delTo%' and branch LIKE '%$branch%'  and dr_number!=''") or die(mysql_error());
                while ($row_paperBuying = mysql_fetch_array($sql_paperBuying)) {
                    if (empty($delTo)) {
                        $sql_client2 = mysql_query("SELECT * from client") or die(mysql_error());
                        while ($row_client2 = mysql_fetch_array($sql_client2)) {
                            $dr = strtoupper($row_paperBuying['dr_number']);
                            if (strpos($dr, $row_client2['description']) !== false) {
                                $dell = strtoupper($row_client2['client_name']);
                                break;
                            } else {
                                $dell = 'None';
                            }
                        }
                    } else {
                        $dell = $delTo;
                        $dr = strtoupper($row_paperBuying['dr_number']);
                    }
                    if($dell != 'None') {
                        echo '<tr>
                            <td>' . $row_paperBuying['date_received'] . '</td>
                            <td>' . $row_paperBuying['supplier_id'] . '_' . $row_paperBuying['supplier_name'] . '</td>
                            <td>' . $row_paperBuying['branch'] . '</td>
                            <td>' . $row_paperBuying['plate_number'] . '</td>
                            <td>' . $row_paperBuying['wp_grade'] . '</td>
                            <td>' . $row_paperBuying['corrected_weight'] . '</td>
                            <td>' . $dell . '</td>
                            <td>' . $dr . '</td>
                        </tr>';
                    }
                }
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


