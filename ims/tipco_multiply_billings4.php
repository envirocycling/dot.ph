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

    };

    $(window).load(function () {
        $(".unbilled").hide();
        $("button").click(function () {
            var val = $(this).attr('id');
            var split = val.split("_");
            var ID = split[1];
            if (split[0] == 'billed') {
                $("#billed_" + ID).hide();
                $("#unbilled_" + ID).show();
                var dataString = 'id=' + ID + '&type=billed';
                $.ajax({
                    type: "POST",
                    url: "billed_receiving.php",
                    data: dataString,
                    cache: false
                });
            }
            if (split[0] == 'unbilled') {
                $("#unbilled_" + ID).hide();
                $("#billed_" + ID).show();
                var dataString = 'id=' + ID + '&type=';
                $.ajax({
                    type: "POST",
                    url: "billed_receiving.php",
                    data: dataString,
                    cache: false
                });
            }
        });
    });


    $(document).ready(function () {
        var total = document.getElementById("sample_total").value;
        $('#selectall').click(function () {  //on click
            if (this.checked) { // check select status
                $('.checkbox').each(function () { //loop through each checkbox
                    this.checked = true;  //select all checkboxes with class "checkbox1"
                });
                document.getElementById("sub_total").value = total;
            } else {
                $('.checkbox').each(function () { //loop through each checkbox
                    this.checked = false; //deselect all checkboxes with class "checkbox1"
                });
                document.getElementById("sub_total").value = '0';
            }
        });


        $("button").click(function () {
            var val = $(this).attr('id');
            var split = val.split("_");
            if (confirm('Are you sure you want to delete ?')) {
                $("#bill_" + split[1]).hide();
                var dataString = 'log_id=' + split[1];
                $.ajax({
                    type: "POST",
                    url: "paper_buying_dr_del.php",
                    data: dataString,
                    cache: false
                });
            }
        });

        $('.checkbox').click(function () {
            var val = $(this).attr('id');
            var split = val.split("_");
            var weight = Number($("#corrected_weight" + split[1]).val());
            if (this.checked) {
                var sub_total = Number($("#sub_total").val());
                sub_total += Number(weight);
                document.getElementById("sub_total").value = sub_total;
            } else {
                var sub_total = Number($("#sub_total").val());
                sub_total -= Number(weight);
                document.getElementById("sub_total").value = sub_total;
            }
        });
    });


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

        <h2>Tipco Multiply Billing</h2>

        <br>

        <h6>Filtering Options</h6>

        <form action="tipco_multiply_billings.php" method="POST">

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



<?php
if (isset($_POST['submit']) || isset($_GET['submit'])) {
    if (isset($_POST['submit'])) {
        $from = $_POST['from'];
        $to = $_POST['to'];
        $branch = $_POST['branch'];
        $group = $_POST['group'];
    }
    if (isset($_GET['submit'])) {
        $from = $_GET['from'];
        $to = $_GET['to'];
        $branch = $_GET['branch'];
        $group = $_GET['group'];
    }
    ?>



    <div class="grid_5">

        <div class="box round first">


            <?php
            echo "<h2>Outgoing from: $from to: $to in ";
            if ($branch == '') {
                echo "All Branch";
            } else {
                echo $branch;
            }
            echo "</h2>";
            echo '<table class="data display datatable" id="example">';

            $array_of_dates = array();
            $daily_actual = array();
            $total_billed_per_date = array();
            $total_per_date = array();

            echo "<thead>";

            echo '<tr class="data">';

            echo "<th class='data'>Date</th>";

            echo "<th class='data'>Tipco Incoming</th>";

            echo "<th class='data'>Billed</th>";

            echo "<th class='data'>Amount Billed</th>";

            echo "</tr>";

            echo "</thead>";

//            if ($_POST['group'] == 'Multiply') {
//                $sql_actual = mysql_query("SELECT sum(weight),date,wp_grade FROM actual where (wp_grade='LCOCC' or wp_grade='LCMW' or wp_grade='LCMW-PPQ') and branch like '%".$_POST['branch']."%' and date >= '" . $_POST['from'] . "' and date <='" . $_POST['to'] . "' group by date,wp_grade");
//            } else if ($_POST['group'] == 'Tipco') {
//                $sql_actual = mysql_query("SELECT sum(weight),date,wp_grade FROM actual where wp_grade='LCWL' and branch like '%".$_POST['branch']."%' and date >= '" . $_POST['from'] . "' and date <='" . $_POST['to'] . "' group by date,wp_grade");
//            } else {
//                $sql_actual = mysql_query("SELECT sum(weight),date,wp_grade FROM actual where (wp_grade='LCOCC' or wp_grade='LCMW' or wp_grade='LCMW-PPQ' or wp_grade='LCWL') and branch like '%".$_POST['branch']."%' and date >= '" . $_POST['from'] . "' and date <='" . $_POST['to'] . "' group by date,wp_grade");
//            }
//
//            while ($rs_actual = mysql_fetch_array($sql_actual)) {
//                $daily_actual[$rs_actual['date']]=($rs_actual['sum(weight)']/1000);
//                array_push($array_of_dates,$rs_actual['date']);
//            }

            $start_q = $from;
            while ($start_q <= $to) {
                if ($group == 'MW') {
                    $sql_actual = mysql_query("SELECT sum(weight),date,wp_grade FROM actual where (wp_grade='LCMW' or wp_grade='LCMW-PPQ') and branch like '%$branch%' and date='$start_q' group by date,wp_grade");
                } else if ($group == 'ONP') {
                    $sql_actual = mysql_query("SELECT sum(weight),date,wp_grade FROM actual where (wp_grade='LCONP' or wp_grade='LCNPB' or wp_grade='LCOIN' or wp_grade='LCOIN') and branch like '%$branch%' and date='$start_q' group by date,wp_grade");
                } else if ($group == 'OCC') {
                    $sql_actual = mysql_query("SELECT sum(weight),date,wp_grade FROM actual where wp_grade='LCOCC' and branch like '%$branch%' and date='$start_q' group by date,wp_grade");
                } else if ($group == 'LCWL') {
                    $sql_actual = mysql_query("SELECT sum(weight),date,wp_grade FROM actual where wp_grade='LCWL' and branch like '%$branch%' and date='$start_q' group by date,wp_grade");
                } else if ($group == 'CHIPBOARD') {
                    $sql_actual = mysql_query("SELECT sum(weight),date,wp_grade FROM actual where wp_grade='CHIPBOARD' and branch like '%$branch%' and date='$start_q' group by date,wp_grade");
                } else {
                    $sql_actual = mysql_query("SELECT sum(weight),date,wp_grade FROM actual where (wp_grade='LCONP' or wp_grade='LCNPB' or wp_grade='LCOIN' or wp_grade='LCOIN' or wp_grade='CHIPBOARD' or wp_grade='LCOCC' or wp_grade='LCMW' or wp_grade='LCMW-PPQ' or wp_grade='LCWL') and branch like '%$branch%' and date='$start_q' group by date,wp_grade");
                }
                $rs_actual = mysql_fetch_array($sql_actual);
                $daily_actual[$rs_actual['date']] = $rs_actual['sum(weight)'];
                array_push($array_of_dates, $start_q);
                $start_q = date('Y/m/d', strtotime("+1 day", strtotime($start_q)));
            }

            foreach ($array_of_dates as $date) {
                $total_billed = 0;
                $total_amount = 0;
                if ($group == 'MW') {
                    $sql_amount = mysql_query("Select * from paper_buying WHERE dr_number!='' and (wp_grade like '%CORETUBE%' or wp_grade like '%CT%' or wp_grade like '%LCAP_K%' or wp_grade like '%MW%') and date_received='$date' and branch like '%$branch%' and dr_number NOT LIKE '%export%' and dr_number NOT LIKE '%others%' and dr_number NOT LIKE '%uppc%' and dr_number NOT LIKE '%gs%' and dr_number NOT LIKE '%fsi%' and dr_number NOT LIKE '%cmi%' and dr_number NOT LIKE '%st%'");
                } else if ($group == 'ONP') {
                    $sql_amount = mysql_query("Select * from paper_buying WHERE dr_number!='' and (wp_grade like '%ONP%' or wp_grade like '%OPD%' or wp_grade like '%NPB%' or wp_grade like '%OIN%') and date_received='$date' and branch like '%$branch%' and dr_number NOT LIKE '%export%' and dr_number NOT LIKE '%others%' and dr_number NOT LIKE '%uppc%' and dr_number NOT LIKE '%gs%' and dr_number NOT LIKE '%fsi%' and dr_number NOT LIKE '%cmi%' and dr_number NOT LIKE '%st%'");
                } else if ($group == 'OCC') {
                    $sql_amount = mysql_query("Select * from paper_buying WHERE dr_number!='' and (wp_grade like '%HM.OCC%' or wp_grade like '%LCOCC%' or wp_grade like '%WT.OCC%' or wp_grade like '%OCC%' or wp_grade like '%OLD.CC%') and date_received='$date' and branch like '%$branch%' and dr_number NOT LIKE '%export%' and dr_number NOT LIKE '%others%' and dr_number NOT LIKE '%uppc%' and dr_number NOT LIKE '%gs%' and dr_number NOT LIKE '%fsi%' and dr_number NOT LIKE '%cmi%' and dr_number NOT LIKE '%st%'");
                } else if ($group == 'LCWL') {
                    $sql_amount = mysql_query("Select * from paper_buying WHERE dr_number!='' and (wp_grade like '%BOOK.LCWL%' or wp_grade like '%GUMS.LCWL%' or wp_grade like '%LCWL STICKIES%' or wp_grade like '%WL%' or wp_grade like '%LCWL%') and date_received='$date' and branch like '%$branch%' and dr_number NOT LIKE '%export%' and dr_number NOT LIKE '%others%' and dr_number NOT LIKE '%uppc%' and dr_number NOT LIKE '%gs%' and dr_number NOT LIKE '%fsi%' and dr_number NOT LIKE '%cmi%' and dr_number NOT LIKE '%st%'");
                } else if ($group == 'CHIPBOARD') {
                    $sql_amount = mysql_query("Select * from paper_buying WHERE dr_number!='' and wp_grade like '%CHIPBOARD%' and date_received='$date' and branch like '%$branch%' and dr_number NOT LIKE '%export%' and dr_number NOT LIKE '%others%' and dr_number NOT LIKE '%uppc%' and dr_number NOT LIKE '%gs%' and dr_number NOT LIKE '%fsi%' and dr_number NOT LIKE '%cmi%' and dr_number NOT LIKE '%st%'");
                } else if ($group == 'CBS') {
                    $sql_amount = mysql_query("Select * from paper_buying WHERE dr_number!='' and wp_grade like '%CBS%' and date_received='$date' and branch like '%$branch%' and dr_number NOT LIKE '%export%' and dr_number NOT LIKE '%others%' and dr_number NOT LIKE '%uppc%' and dr_number NOT LIKE '%gs%' and dr_number NOT LIKE '%fsi%' and dr_number NOT LIKE '%cmi%' and dr_number NOT LIKE '%st%'");
                } else {
                    $sql_amount = mysql_query("Select * from paper_buying WHERE dr_number!='' and (wp_grade like '%ONP%' or wp_grade like '%OPD%' or wp_grade like '%NPB%' or wp_grade like '%OIN%' OR wp_grade like '%CBS%' or wp_grade like '%CHIPBOARD%' or wp_grade like '%BOOK.LCWL%' or wp_grade like '%GUMS.LCWL%' or wp_grade like '%LCWL STICKIES%' or wp_grade like '%WL%' or wp_grade like '%LCWL%' or wp_grade like '%HM.OCC%' or wp_grade like '%LCOCC%' or wp_grade like '%WT.OCC%' or wp_grade like '%OCC%' or wp_grade like '%OLD.CC%'  or wp_grade like '%CORETUBE%' or wp_grade like '%CT%' or wp_grade like '%LCAP_K%' or wp_grade like '%MW%' or wp_grade like '%BOOK.LCWL%' or wp_grade like '%GUMS.LCWL%' or wp_grade like '%LCWL STICKIES%' or wp_grade like '%WL%') and date_received='$date' and branch like '%$branch%' and dr_number NOT LIKE '%export%' and dr_number NOT LIKE '%others%' and dr_number NOT LIKE '%uppc%' and dr_number NOT LIKE '%gs%' and dr_number NOT LIKE '%fsi%' and dr_number NOT LIKE '%cmi%' and dr_number NOT LIKE '%st%'");
                }
                while ($rs_amount = mysql_fetch_array($sql_amount)) {
                    if (trim($rs_amount['wp_grade']) == 'ONP' || trim($rs_amount['wp_grade']) == 'LCONP' || trim($rs_amount['wp_grade']) == 'OIN' || trim($rs_amount['wp_grade']) == 'OPD' || trim($rs_amount['wp_grade']) == 'NPB' || trim($rs_amount['wp_grade']) == 'ONP BOOKS' || trim($rs_amount['wp_grade']) == 'ONP GUMS' || trim($rs_amount['wp_grade']) == 'ONP STICKIES' || trim($rs_amount['wp_grade']) == 'STICKIES ONP') {
                        $wp_grade = "ONP";
                    }
                    if (trim($rs_amount['wp_grade']) == 'HM.OCC' || trim($rs_amount['wp_grade']) == 'LCOCC' || trim($rs_amount['wp_grade']) == 'WT.OCC' || trim($rs_amount['wp_grade']) == 'OCC' || trim($rs_amount['wp_grade']) == 'OLD.CC') {
                        $wp_grade = "OCC";
                    }
                    if (trim($rs_amount['wp_grade']) == 'CORETUBE' || trim($rs_amount['wp_grade']) == 'CT' || trim($rs_amount['wp_grade']) == 'LCAP_K' || trim($rs_amount['wp_grade']) == 'MW') {
                        $wp_grade = "MW";
                    }
                    if (trim($rs_amount['wp_grade']) == 'BOOK.LCWL' || trim($rs_amount['wp_grade']) == 'GUMS.LCWL' || trim($rs_amount['wp_grade']) == 'LCWL STICKIES' || trim($rs_amount['wp_grade']) == 'WL' || trim($rs_amount['wp_grade']) == 'LCWL') {
                        $wp_grade = "LCWL";
                    }
                    if (trim($rs_amount['wp_grade']) == 'CHIPBOARD') {
                        $wp_grade = "CHIPBOARD";
                    }
                    if (trim($rs_amount['wp_grade']) == 'CBS') {
                        $wp_grade = "CBS";
                    }
                    $sql = mysql_query("SELECT * FROM tipco_prices WHERE wp_grade='$wp_grade' and branch='" . $rs_amount['branch'] . "' and date_effective <= '$to' ORDER BY date_effective DESC");
                    $rs = mysql_fetch_array($sql);

                    $additional = $rs_amount['unit_cost'] - $rs['price'];
                    if ($additional > 0) {
//                        echo $rs_amount['unit_cost']."-$$".$rs['price']."-**".$additional."-".$rs_amount['corrected_weight']."-----".$wp_grade."-" . $_POST['branch'] . "-".$_POST['to']."<br>";
                        $total_amount+=$additional * $rs_amount['corrected_weight'];
                        if ($rs_amount['status'] == 'billed') {
//                        echo $wp_grade."-".$_POST['group']."-".$_POST['branch']."-".$date."-".$rs_amount['corrected_weight']."<br>";
                            $total_billed+=$rs_amount['corrected_weight'];
                        }
                    }
                }
                $total_billed_per_date[$date] = $total_billed;
                $total_per_date[$date] = $total_amount;
            }
            $total_inc = 0;
            $total_billed = 0;
            $total_amount_billed = 0;
            foreach ($array_of_dates as $date) {
                echo "<tr>";
                echo "<td>$date</td>";
                if ($daily_actual[$date] == '') {
                    echo "<td>0</td>";
                } else {
                    echo "<td>" . number_format($daily_actual[$date], 2) . "</td>";
                    $total_inc+=$daily_actual[$date];
                }
                if ($total_billed_per_date[$date] == '') {
                    echo "<td>0</td>";
                } else {
                    echo "<td>" . number_format($total_billed_per_date[$date], 2) . "</td>";
                    $total_billed+=$total_billed_per_date[$date];
                }
                if ($total_per_date[$date] == '') {
                    echo "<td>0</td>";
                } else {
                    echo "<td>" . number_format($total_per_date[$date], 2) . "</td>";
                    $total_amount_billed+=$total_per_date[$date];
                }
                echo "</tr>";
            }
            echo "<tr id='total'>";
            echo "<td>TOTAL</td>";
            echo "<td>" . number_format($total_inc, 2) . "</td>";
            echo "<td>" . number_format($total_billed, 2) . "</td>";
            echo "<td>" . number_format($total_amount_billed, 2) . "</td>";
            echo "</tr>";
            echo "</table>";
            ?>



        </div>

    </div>


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
            
            $chk_branch = strtoupper($branch);
            ?>

            <table class="data display datatable" id="example">

                <?php
                echo "<thead>";
                echo '<tr class="data">';

                echo "<th class='data'>Ref No</th>";
//                echo "<th class='data'>TN</th>";
                
                if($chk_branch == 'PAMPANGA'){
                   echo "<th class='data'>STR</th>"; 
                }

                echo "<th class='data'>Date Billed</th>";

                echo "<th class='data'>Supplier Name</th>";

                echo "<th class='data'>WP Grade</th>";

                echo "<th class='data'>Weight</th>";

                echo "<th class='data'>Buying Price</th>";

                echo "<th class='data'>Tipco Price</th>";

                echo "<th class='data'>Additional</th>";

                echo "<th class='data'>Amount</th>";

                echo "<th class='data'>Branch</th>";

                if ($_SESSION['position'] == 'Inventory Controller' || $_SESSION['position'] == 'Programmer' || $_SESSION['position'] == 'Branch Head') {
                    echo "<th class='data'>Action</th>";
                }

                echo "</tr>";

                echo "</thead>";
                    $chk_branch = strtoupper($branch);
                if ($group == 'MW') {
                    $query = "Select * from paper_buying WHERE dr_number!='' and (wp_grade like '%CORETUBE%' or wp_grade like '%CT%' or wp_grade like '%LCAP_K%' or wp_grade like '%MW%') and date_received>='$from' and date_received<='$to' and branch like '%$branch%' and dr_number NOT LIKE '%export%' and dr_number NOT LIKE '%others%' and dr_number NOT LIKE '%uppc%' and status='billed' and dr_number NOT LIKE '%gs%' and dr_number NOT LIKE '%fsi%' and dr_number NOT LIKE '%cmi%' and dr_number NOT LIKE '%st%'";
                } else if ($group == 'ONP') {
                    $query = "Select * from paper_buying WHERE dr_number!='' and (wp_grade like '%ONP%' or wp_grade like '%OPD%' or wp_grade like '%NPB%' or wp_grade like '%OIN%') and date_received>='$from' and date_received<='$to' and branch like '%$branch%' and dr_number NOT LIKE '%export%' and dr_number NOT LIKE '%others%' and dr_number NOT LIKE '%uppc%' and status='billed' and dr_number NOT LIKE '%gs%' and dr_number NOT LIKE '%fsi%' and dr_number NOT LIKE '%cmi%' and dr_number NOT LIKE '%st%'";
                } else if ($group == 'OCC') {
                    $query = "Select * from paper_buying WHERE dr_number!='' and (wp_grade like '%HM.OCC%' or wp_grade like '%LCOCC%' or wp_grade like '%WT.OCC%' or wp_grade like '%OCC%' or wp_grade like '%OLD.CC%') and date_received>='$from' and date_received<='$to' and branch like '%$branch%' and dr_number NOT LIKE '%export%' and dr_number NOT LIKE '%others%' and dr_number NOT LIKE '%uppc%' and status='billed' and dr_number NOT LIKE '%gs%' and dr_number NOT LIKE '%fsi%' and dr_number NOT LIKE '%cmi%' and dr_number NOT LIKE '%st%'";
                } else if ($group == 'LCWL') {
                    $query = "Select * from paper_buying WHERE dr_number!='' and (wp_grade like '%BOOK.LCWL%' or wp_grade like '%GUMS.LCWL%' or wp_grade like '%LCWL STICKIES%' or wp_grade like '%WL%' or wp_grade like '%LCWL%') and date_received>='$from' and date_received<='$to' and branch like '%$branch%' and dr_number NOT LIKE '%export%' and dr_number NOT LIKE '%others%' and dr_number NOT LIKE '%uppc%' and status='billed' and dr_number NOT LIKE '%gs%' and dr_number NOT LIKE '%fsi%' and dr_number NOT LIKE '%cmi%' and dr_number NOT LIKE '%st%'";
                } else if ($group == 'CHIPBOARD') {
                    $query = "Select * from paper_buying WHERE dr_number!='' and wp_grade like '%CHIPBOARD%' and date_received>='$from' and date_received<='$to' and branch like '%$branch%' and dr_number NOT LIKE '%export%' and dr_number NOT LIKE '%others%' and dr_number NOT LIKE '%uppc%' and status='billed' and dr_number NOT LIKE '%gs%' and dr_number NOT LIKE '%fsi%' and dr_number NOT LIKE '%cmi%' and dr_number NOT LIKE '%st%'";
                } else if ($group == 'CBS') {
                    $query = "Select * from paper_buying WHERE dr_number!='' and wp_grade like '%CBS%' and date_received>='$from' and date_received<='$to' and branch like '%$branch%' and dr_number NOT LIKE '%export%' and dr_number NOT LIKE '%others%' and dr_number NOT LIKE '%uppc%' and status='billed' and dr_number NOT LIKE '%gs%' and dr_number NOT LIKE '%fsi%' and dr_number NOT LIKE '%cmi%' and dr_number NOT LIKE '%st%'";
                } else {
                    $query = "Select * from paper_buying WHERE dr_number!='' and (wp_grade like '%CBS%' or wp_grade like '%CHIPBOARD%' or wp_grade like '%BOOK.LCWL%' or wp_grade like '%GUMS.LCWL%' or wp_grade like '%LCWL STICKIES%' or wp_grade like '%WL%' or wp_grade like '%LCWL%' or wp_grade like '%HM.OCC%' or wp_grade like '%LCOCC%' or wp_grade like '%WT.OCC%' or wp_grade like '%OCC%' or wp_grade like '%OLD.CC%'  or wp_grade like '%CORETUBE%' or wp_grade like '%CT%' or wp_grade like '%LCAP_K%' or wp_grade like '%MW%' or wp_grade like '%BOOK.LCWL%' or wp_grade like '%GUMS.LCWL%' or wp_grade like '%LCWL STICKIES%' or wp_grade like '%WL%') and date_received>='$from' and date_received<='$to' and branch like '%$branch%' and dr_number NOT LIKE '%export%' and dr_number NOT LIKE '%others%' and dr_number NOT LIKE '%uppc%' and status='billed' and dr_number NOT LIKE '%gs%' and dr_number NOT LIKE '%fsi%' and dr_number NOT LIKE '%cmi%' and dr_number NOT LIKE '%st%'";
                }

                $result = mysql_query($query);

                $total_corrected_weight = 0;

                $total_add = 0;

                $total_amount = 0;

                $ctr = 0;

                while ($row = mysql_fetch_array($result)) {

                    /*if (trim($row['wp_grade']) == 'ONP' || trim($row['wp_grade']) == 'LCONP' || trim($row['wp_grade']) == 'OIN' || trim($row['wp_grade']) == 'OPD' || trim($row['wp_grade']) == 'NPB' || trim($row['wp_grade']) == 'ONP BOOKS' || trim($row['wp_grade']) == 'ONP GUMS' || trim($row['wp_grade']) == 'ONP STICKIES' || trim($row['wp_grade']) == 'STICKIES ONP') {
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
                    }*/
                    $wp_grade = strtoupper($row['wp_grade']);
                    $tipo_price = 0;
                    $sql = mysql_query("SELECT * FROM tipco_prices WHERE wp_grade='$wp_grade' and branch='" . $row['branch'] . "' and date_effective <= '".$row['date_received']."' ORDER BY date_effective DESC");
//echo $row['dr_number'].'~'.trim($row['wp_grade'])."~SELECT * FROM tipco_prices WHERE wp_grade='$wp_grade' and branch='" . $row['branch'] . "' and date_effective <= '".$row['date_received']."' ORDER BY date_effective DESC<br>";
                    if(mysql_num_rows($sql) == 0){
                        $sql_baseGrade = mysql_query("SELECT * from material WHERE details = '$wp_grade'") or die(mysql_error());
                        $row_baseGrade = mysql_fetch_array($sql_baseGrade);
                        
                        $sql_mat = mysql_query("SELECT * from material WHERE material_id = '".$row_baseGrade['under_by']."'") or die(mysql_error());
                        $row_mat = mysql_fetch_array($sql_mat);
                        
                        $wp_grade = strtoupper($row_mat['details']);
                        $sql = mysql_query("SELECT * FROM tipco_prices WHERE wp_grade='$wp_grade' and branch='" . $row['branch'] . "' and date_effective <= '".$row['date_received']."' ORDER BY date_effective DESC");
                        $rs = mysql_fetch_array($sql);
                        
                        if($row_baseGrade['material_id'] == 11 || $row_baseGrade['material_id'] == 15){
                            $tipo_price = $rs['price'] - 2 ;
                        }else if($row_baseGrade['material_id'] == 13){
                            $tipo_price = $rs['price'] - 3 ;
                        }else if($row_baseGrade['material_id'] == 14 || $row_baseGrade['material_id'] == 16){
                            $tipo_price = $rs['price'] - 2 ;
                        }
                    }else{
                        $rs = mysql_fetch_array($sql);
                        $tipo_price = $rs['price'];
                    }

                    $additional = $row['unit_cost'] - $tipo_price;
//echo $additional.'<br>';
                    
                    if ($additional > 0) {

                        echo "<tr id='bill_" . $row['log_id'] . "'>";
                    if($chk_branch == 'PAMPANGA'){
                        echo "<td>" . $row['ref_no'] . "</td>";
                        echo "<td>" . $row['dr_number'] . "</td>";
                    }else{
                       
                        echo "<td>" . $row['dr_number'] . "</td>"; 
                    }
//$sql_strCode = mysql_query("SELECT * FROM branches WHERE branch_name LIKE '%".$row['branch']."%'");
//$row_strCode = mysql_fetch_array($sql_strCode);
//if(!empty($row_strCode['str'])){
//    $tn = str_repalce('/','',$row['date_received']).'-'.$row_strCode['str'].'-'.$row['priority_number'];
//}else{
//    $tn = str_repalce('/','',$row['date_received']).'-0-'.$row['priority_number'];
//}
//                        echo "<td>" . str_repalce('/','',$row['date_received']) . "</td>";
                        echo "<td>" . $row['date_received'] . "</td>";

                        echo "<td>" . $row['supplier_id'] . "_" . $row['supplier_name'] . "</td>";

                        echo "<td>" . $row['wp_grade'] . "</td>";

                        echo "<td>" . $row['corrected_weight'] . "</td>";

                        $total_corrected_weight+=$row['corrected_weight'];

                        echo "<td>" . $row['unit_cost'] . "</td>";

                        if (!empty($tipo_price)) {

                            echo "<td>" . $tipo_price . "</td>";
                        } else {

                            echo "<td>0</td>";
                        }

                        echo "<td>" . number_format($additional, 2) . "</td>";

                        echo "<td>" . number_format($additional * $row['corrected_weight'], 2) . "</td>";

                        echo "<td>" . $row['branch'] . "</td>";

                        if ($_SESSION['position'] == 'Inventory Controller' || $_SESSION['position'] == 'Programmer' || $_SESSION['position'] == 'Branch Head') {
                            echo "<td><button id='del_" . $row['log_id'] . "'>Delete</button</td>";
                        }

                        echo "</tr>";



                        $total_add+=$additional;

                        $total_amount+=$additional * $row['corrected_weight'];
                    }
                }

                echo "<tr id='total'>";

                echo "<td>!TOTAL!</td>";

                if($chk_branch == 'PAMPANGA'){echo "<td></td>";echo "<td></td>";
                    }else{
                       
                        echo "<td></td>";
                    }

                echo "<td></td>";
                echo "<td></td>";


                echo "<td></td>";

                echo "<td>" . number_format($total_corrected_weight, 2) . "</td>";

                echo "<td></td>";

                echo "<td></td>";

//                echo "<td>" . number_format($total_add, 2) . "</td>";
                echo "<td></td>";

                echo "<td>" . number_format($total_amount, 2) . "</td>";

                echo "<td></td>";

                if ($_SESSION['position'] == 'Inventory Controller' || $_SESSION['position'] == 'Programmer' || $_SESSION['position'] == 'Branch Head') {
                    echo "<td></td>";
                }

                echo "</tr>";
                ?>
            </table>

        </div>
    </div>
    <div class="grid_10">

        <div class="box round first grid">

            <?php
            $ngayon = date('F d, Y');

            $total_receiving = 0;

            echo "<h2>Paper Buying Report from: $from to: $to ";
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
            <form method='POST' action='paper_buying_dr_exec.php'>

                <table class="data display datatable" id="example">

                    <?php
                    $sample_tot = 0;

                    echo "<thead>";

                    echo '<tr class="data">';

                    echo "<th class='data' width='50'></th>";
                    
                   if($chk_branch == 'PAMPANGA'){ echo "<td>STR</td>";}

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

                    include("config.php");
                    $current_date = date('Y/m/d');
                    $exp_date = date('Y/m/d', strtotime('-1 month', strtotime($current_date))); 
                    
                    if ($group == 'MW') {
                        $query = "Select * from paper_buying WHERE (wp_grade like '%CORETUBE%' or wp_grade like '%CT%' or wp_grade like '%LCAP_K%' or wp_grade like '%MW%') and date_received>='$from' and date_received<='$to' and date_received>='$exp_date' and (dr_number='' or status='') and branch like '%$branch%'";
                    } else if ($group == 'ONP') {
                        $query = "Select * from paper_buying WHERE (wp_grade like '%ONP%' or wp_grade like '%OPD%' or wp_grade like '%NPB%' or wp_grade like '%OIN%') and date_received>='$from' and date_received<='$to' and date_received>='$exp_date' and branch like '%$branch%'";
                    } else if ($group == 'OCC') {
                        $query = "Select * from paper_buying WHERE (wp_grade like '%HM.OCC%' or wp_grade like '%LCOCC%' or wp_grade like '%WT.OCC%' or wp_grade like '%OCC%' or wp_grade like '%OLD.CC%') and date_received>='$from' and date_received<='$to' and date_received>='$exp_date' and (dr_number='' or status='')  and  branch like '%$branch%'";
                    } else if ($group == 'LCWL') {
                        $query = "Select * from paper_buying WHERE (wp_grade like '%BOOK.LCWL%' or wp_grade like '%GUMS.LCWL%' or wp_grade like '%LCWL STICKIES%' or wp_grade like '%WL%' or wp_grade like '%LCWL%') and date_received>='$from' and date_received<='$to' and date_received>='$exp_date' and (dr_number='' or status='')  and branch like '%$branch%'";
                    } else if ($group == 'CHIPBOARD') {
                        $query = "Select * from paper_buying WHERE wp_grade like '%CHIPBOARD%' and date_received>='$from' and date_received<='$to' and date_received>='$exp_date' and (dr_number='' or status='') and branch like '%$branch%'";
                    } else if ($group == 'CBS') {
                        $query = "Select * from paper_buying WHERE wp_grade like '%CBS%' and date_received>='$from' and date_received<='$to' and date_received>='$exp_date' and (dr_number='' or status='') and branch like '%$branch%'";
                    } else {
                        $query = "Select * from paper_buying WHERE (wp_grade like '%CBS%' or wp_grade like '%BOOK.LCWL%' or wp_grade like '%GUMS.LCWL%' or wp_grade like '%LCWL STICKIES%' or wp_grade like '%WL%' or wp_grade like '%LCWL%' or wp_grade like '%HM.OCC%' or wp_grade like '%LCOCC%' or wp_grade like '%WT.OCC%' or wp_grade like '%OCC%' or wp_grade like '%OLD.CC%'  or wp_grade like '%CORETUBE%' or wp_grade like '%CT%' or wp_grade like '%LCAP_K%' or wp_grade like '%MW%' or wp_grade like '%BOOK.LCWL%' or wp_grade like '%GUMS.LCWL%' or wp_grade like '%LCWL STICKIES%' or wp_grade like '%WL%') and date_received>='$from' and date_received<='$to' and date_received>='$exp_date' and (dr_number='' or status='') and branch like '%$branch%'";
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
                        
                        /*$sql = mysql_query("SELECT * FROM tipco_prices WHERE wp_grade='$wp_grade' and branch='" . $row['branch'] . "' and date_effective <= '$to' ORDER BY date_effective DESC");

                        $rs = mysql_fetch_array($sql);

                        $additional = $row['unit_cost'] - $rs['price'];*/
//echo $additional.'<br>';
                        if ($additional > 0) {

                            echo "<tr>";
                            if ($_SESSION['position'] == 'Inventory Controller' || $_SESSION['position'] == 'Programmer' || $_SESSION['position'] == 'Branch Head') {
                                $now = date("Y/m/d");
                                if ($row['status'] != 'billed') {
                                    echo "<td><input id='cv_" . $ctr . "' class='checkbox' type='checkbox' name='cv_" . $ctr . "' value='" . $row['log_id'] . "'></td>";
                                    echo "<input id='corrected_weight$ctr' type='hidden' name='corrected_weight' value='" . $row['corrected_weight'] . "'>";
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
                            if($chk_branch == 'PAMPANGA'){ echo "<td>" . $row['dr_number'] . "</td>";}
                            echo "<td>" . $row['date_received'] . "</td>";


                            echo "<td>" . $row['supplier_id'] . "_" . $row['supplier_name'] . "</td>";

                            echo "<td>" . $row['wp_grade'] . "</td>";

                            echo "<td>" . $row['corrected_weight'] . "</td>";

                            $total_corrected_weight+=$row['corrected_weight'];

                            echo "<td>" . $row['unit_cost'] . "</td>";

                            if (!empty($tipco_price)) {

                                echo "<td>" . $tipco_price . "</td>";
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
                    if($chk_branch == 'PAMPANGA'){ echo "<td></td>";}

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
                <br>
                <?php
                echo "<table>";
                echo "<tr>";
                echo "<input id='sample_total' type='hidden' name='sample_total' value='$sample_tot'>";
                echo '<input type="hidden" name="ctr" value="' . $ctr . '">';
                echo '<input type="hidden" name="from" value="' . $from . '">';
                echo '<input type="hidden" name="to" value="' . $to . '">';
                echo '<input type="hidden" name="branch" value="' . $branch . '">';
                echo '<input type="hidden" name="group" value="' . $group . '">';
                if ($_SESSION['position'] == 'Inventory Controller' || $_SESSION['position'] == 'Programmer' || $_SESSION['position'] == 'Branch Head') {
                    ?>
                    <td>Select All : <input type="checkbox" id="selectall"></td>
                    <td>Sub Total<input id="sub_total" type="text" name="sub_total" value="0" readonly></td>
                    <td>Ref No.:<input type="text" name="dr_number" value="" required></td>
                    <td><input type="submit" name="submit" value="Submit"></td>
                    <?php
                }
                echo "</tr>";
                echo "</table>";
                ?>
            </form>
            <!-- <a href="tipco_multiply_billings.php?billed=all&from=<?php // echo $_POST['from'];            ?>&to=<?php // echo $_POST['to'];            ?>&group=<?php // echo $_POST['branch'];            ?>&branch=<?php // echo $_POST['branch'];            ?>"><button>Billed All</button></a> -->
        </div>

    </div>

    <?php
}
?>

<div class="clear">



</div>



<div class="clear">



</div>


