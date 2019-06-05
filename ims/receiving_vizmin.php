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

    function date1(str) {

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

        <form method="POST">

            <br>

            <h6>Please select your range of dates</h6>

            <?php
            if (isset($_POST['submit'])) {
                ?>



                Start Period: <input type='text'  id='inputField' name='from' value="<?php echo $_POST['from']; ?>" onfocus='date1(this.id);' readonly size="8"><br>

                End Period:<input type='text'  id='inputField2' name='to' value="<?php echo $_POST['to']; ?>" onfocus='date1(this.id);' readonly size="8"><br>

            <!--                WP Grade: <select name="wp_grade">

                                <option value="<?php // echo $_POST['wp_grade'];   ?>"><?php // echo $_POST['wp_grade']; ?></option>

                                <option value="">All</option>

                                <option value="LCOCC">LCOCC</option>

                                <option value="LCMW">LCMW</option>

                            </select>

                            <br>-->

                <?php
                echo "Branch: <select name='branch'>";

                $sql_branches = mysql_query("SELECT * FROM branches");

                echo "<option value='" . $_POST['branch'] . "'>" . $_POST['branch'] . "</option>";

                echo "<option value=''>All Branches</option>";



                while ($rs_branches = mysql_fetch_array($sql_branches)) {

                    echo "<option value='" . $rs_branches['branch_name'] . "'>" . $rs_branches['branch_name'] . "</option>";
                }

                echo "</select>";
            } else {
                ?>

                Start Period: <input type='text'  id='inputField' name='from' value="<?php echo date('Y/m/d'); ?>" onfocus='date1(this.id);' readonly size="8"><br>

                End Period:<input type='text'  id='inputField2' name='to' value="<?php echo date('Y/m/d'); ?>" onfocus='date1(this.id);' readonly size="8"><br>

            <!--                WP Grade: <select name="wp_grade">

                                <option value="">All</option>

                                <option value="LCOCC">OCC</option>

                                <option value="LCMW">MW</option>

                            </select>

                            <br>-->

                <?php
                echo "Branch: <select name='branch'>";

                $sql_branches = mysql_query("SELECT * FROM branches");

                echo "<option value=''>All Branches</option>";



                while ($rs_branches = mysql_fetch_array($sql_branches)) {

                    echo "<option value='" . $rs_branches['branch_name'] . "'>" . $rs_branches['branch_name'] . "</option>";
                }

                echo "</select>";
            }
            ?>

            <br>

            <input name="submit" type="submit" value="Generate Report">

        </form>

    </div>

</div>



<?php
if (isset($_POST['submit'])) {

    $sql_paperbuying = mysql_query("SELECT * FROM paper_buying WHERE branch like '%" . $_POST['branch'] . "%' and date_received>='" . $_POST['from'] . "' and date_received<='" . $_POST['to'] . "' ORDER BY date_received Asc");
    ?>

    <div class="grid_10" >

        <div class="box round first grid">

            <h2>VizMin Deliveries

                <?php
                if ($_POST['branch'] == '') {

                    echo "from All Branches";
                } else {

                    echo "from " . $_POST['branch'];
                }
                ?>

            </h2>


            <center><input type="button"  class="btn-success" onclick="tableToExcel('example', 'VizMin')" value="Export XLS"></center>
            <table class="data display datatable" id="example" border="1">

                <?php
                echo "<thead>";
                echo "<th>Date</th>";
                echo "<th>Branch Delivered</th>";
                echo "<th>Suppliername</th>";
                echo "<th>Plate</th>";
                echo "<th>Grade</th>";
                echo "<th>Price</th>";
                echo "<th>Corrected Weight</th>";
                echo "</thead>";

                while (@$row_paperbuying = mysql_fetch_array($sql_paperbuying)) {
                    $sql_supplier = mysql_query("SELECT * from supplier_details WHERE supplier_id='" . $row_paperbuying['supplier_id'] . "' and (group_island LIKE '%Visayas%' or  group_island LIKE '%Mindanao%')") or die(mysql_error());
                    if (mysql_num_rows($sql_supplier) > 0) {
                        echo '<tr>
                    <td>' . $row_paperbuying['date_received'] . '</td>
                    <td>' . $row_paperbuying['branch'] . '</td>
                    <td>' . $row_paperbuying['supplier_id'] . '_' . $row_paperbuying['supplier_name'] . '</td>
                    <td>' . $row_paperbuying['plate_number'] . '</td>
                    <td>' . $row_paperbuying['wp_grade'] . '</td>
                    <td>' . $row_paperbuying['unit_cost'] . '</td>
                    <td>' . $row_paperbuying['corrected_weight'] . '</td>
                </tr>';
                    }
                }
}
                ?>



        </table>

        <div class="clear">



        </div>



        <div class="clear">



        </div>


