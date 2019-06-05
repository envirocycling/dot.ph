<!--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>
    function saveNotations() {
        var notation = $("#edit_notation").val();
        var type = $("#type").val();
        var log_id = $("#log_id").val();
        var dataString = 'log_id=' + log_id + '&notation=' + notation;
        if (type == 'branch') {
            $.ajax({
                type: "POST",
                url: "insert_outgoing_notation_branch.php",
                data: dataString,
                cache: false,
                success: function (e)
                {
                    $("#val_notation_b_" + log_id).html(notation);
                    $('.close').click();
                    e.stopImmediatePropagation();
                }
            });
        } else {
            $.ajax({
                type: "POST",
                url: "insert_outgoing_notation.php",
                data: dataString,
                cache: false,
                success: function (e)
                {
                    $("#val_notation_a_" + log_id).html(notation);
                    $('.close').click();
                    e.stopImmediatePropagation();
                }
            });
        }
    }

    function typeNotation(id) {
        var split = id.split("_");
        if (split[0] == 'branch') {
            var notation = $("#val_notation_b_" + split[1]).html();
        } else {
            var notation = $("#val_notation_a_" + split[1]).html();
        }
        $("#edit_notation").val(notation);
        $("#log_id").val(split[1]);
        $("#type").val(split[0]);
    }
</script>
<?php
include("templates/template.php");
$_SESSION['outgoing_log_ids'] = array();
?>
<style>
    #total{
        font-weight: bold;
        background-color: yellow;
    }
    #highlight{
        background-color:85EB6A;
        color:black;
    }
    #highlight a{
        background-color:85EB6A;
        color:black;
    }


    .modal-open{overflow:hidden}
    .modal{
        position:fixed;
        top:0;
        right:0;
        bottom:0;
        left:0;
        z-index:1050;
        display:none;
        overflow:hidden;
        -webkit-overflow-scrolling:touch;
        outline:0
    }
    .modal.fade .modal-dialog{
        -webkit-transition:-webkit-transform .3s ease-out;
        -o-transition:-o-transform .3s ease-out;
        transition:transform .3s ease-out;
        -webkit-transform:translate(0,-25%);
        -ms-transform:translate(0,-25%);
        -o-transform:translate(0,-25%);
        transform:translate(0,-25%)
    }
    .modal.in .modal-dialog{
        -webkit-transform:translate(0,0);
        -ms-transform:translate(0,0);
        -o-transform:translate(0,0);
        transform:translate(0,0)
    }
    .modal-open .modal{
        overflow-x:hidden;
        overflow-y:auto
    }
    .modal-dialog{
        position:relative;
        width:auto;
        margin:10px
    }.modal-content{
        position:relative;
        background-color:#fff;
        -webkit-background-clip:padding-box;
        background-clip:padding-box;
        border:1px solid #999;
        border:1px solid rgba(0,0,0,.2);
        border-radius:6px;
        outline:0;
        -webkit-box-shadow:0 3px 9px rgba(0,0,0,.5);
        box-shadow:0 3px 9px rgba(0,0,0,.5)
    }
    .modal-backdrop{
        position:fixed;
        top:0;
        right:0;
        bottom:0;
        left:0;
        z-index:1040;
        background-color:#000
    }
    .modal-backdrop.fade{
        filter:alpha(opacity=0);
        opacity:0
    }
    .modal-backdrop.in{
        filter:alpha(opacity=50);
        opacity:.5
    }
    .modal-header{
        min-height:16.43px;
        padding:15px;
        border-bottom:1px solid #e5e5e5
    }
    .modal-header .close{
        margin-top:-2px
    }
    .modal-title{
        margin:0;
        line-height:1.42857143
    }
    .modal-body{
        position:relative;
        padding:15px
    }
    .modal-footer{
        padding:15px;
        text-align:right;
        border-top:1px solid #e5e5e5
    }
    .modal-footer .btn+.btn{
        margin-bottom:0;
        margin-left:5px
    }
    .modal-footer .btn-group .btn+.btn{
        margin-left:-1px
    }
    .modal-footer .btn-block+.btn-block{
        margin-left:0
    }
    .modal-scrollbar-measure{
        position:absolute;
        top:-9999px;
        width:50px;
        height:50px;
        overflow:scroll
    }
    @media (min-width:768px){
        .modal-dialog{
            width:600px;
            margin:30px auto
        }
        .modal-content{
            -webkit-box-shadow:0 5px 15px rgba(0,0,0,.5);
            box-shadow:0 5px 15px rgba(0,0,0,.5)
        }
        .modal-sm{
            width:300px
        }
    }
    @media (min-width:992px){
        .modal-lg{
            width:900px
        }
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
    #highlighted td{
        background-color: #65EC3B;
        color:red;
    }
</style>
<script type="text/javascript">
    function addOutgoing(str) {
        if (str == "")
        {
            document.getElementById("txtHint").innerHTML = "";
            return;
        }
        if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        }
        else
        {// code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function ()
        {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
            {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        }

        //xmlhttp.open("OPEN","sessionista_add_outgoing.php?log_id="+str,true);
        window.open("sessionista_add_outgoing.php?log_id=" + str, 'mywindow', 'width=1,height=1');
        xmlhttp.send();

    }




</script>


<div class="grid_3">
    <div class="box round first">
        <h2>Filtering Options</h2>
        <form action="filter_outgoing.php" method="POST">
            As of: <input type='text'  id='outgoing_filterer' name='date' value="<?php echo $_SESSION['outgoing_date']; ?>" onfocus='date2(this.id);' readonly size="8"><br>
            WP Grade:<input type="text" value="<?php echo $_SESSION['outgoing_grade']; ?>" name="wp_grade"><br>
            Delivered To:<input type="text" value="<?php echo $_SESSION['delivered_to']; ?>" name="delivered_to"><br>
            <input type="submit" value="Filter">
        </form>
        <a href="clear_filter_outgoing.php"><button>Clear Filter</button></a>
    </div>
</div>

<div class="grid_15">
    <div class="box round first grid">
        <?php
        $ngayon = date('F d, Y');
        $branch = $_GET['-slct_branch'];
        echo "<h2> " . $_SESSION['-slct_branch'] . " OUTGOING DELIVERIES as of : <u><b><i>" . $_SESSION['outgoing_date'] . "</i></b></u></h2>";
        ?>
        <table class="data display datatable" id="example">
            <?php
            echo "<thead>";
            echo '<tr class="data"> ';
            echo "<th class='data'></th>";
            echo "<th class='data'>Delivery Date</th>";
            echo "<th class='data'>STR #</th>";
            echo "<th class='data'>Branch</th>";
            echo "<th class='data'>Delivered To</th>";
            echo "<th class='data'>Trucking</th>";
            echo "<th class='data'>Plate Number</th>";
            echo "<th class='data'>Trucking Fee</th>";
            echo "<th class='data'>WP Grade</th>";
            echo "<th class='data'>No. of Bales</th>";
            echo "<th class='data'>From Loc. Wt.</th>";
            echo "<th class='data'>Avg. Wt. per Bale</th>";
            echo "<th class='data'>NET Weight</th>";
            echo "<th class='data'>Variance</th>";
            echo "<th class='data'>Branch Mc (Kg)</th>";
            echo "<th class='data'>Client Mc (Kg)</th>";
            echo "<th class='data'>Dirt</th>";
            echo "<th class='data'>Corrected Wt.</th>";
            echo "<th class='data'>DR #</th>";
            echo "<th class='data'>Client Mc Perct.</th>";
            echo "<th class='data'>Branch Notations</th>";
            echo "<th class='data'>Acctg Notations</th>";
            echo "<th class='data'>Action</th>";
            echo "</tr>";
            echo "</thead>";
            include("config.php");

            $total_from_loc = 0;
            $total_net_weight = 0;
            $total_variance = 0;
            $total_c_mc = 0;
            $total_mc = 0;
            $total_dirt = 0;
            $total_corrected = 0;
            $total_dr = 0;
            $outgoing_date = $_SESSION['outgoing_date'];
            $outgoing_date_month = date("Y/m", strtotime($outgoing_date));
            if (trim($_SESSION['outgoing_grade']) != '') {
                $query = "SELECT outgoing.notations as notations ,outgoing.notations_b as notations_b ,outgoing.trucking_fee as trucking_fee,sum(outgoing.weight) as weights,outgoing.date as date,outgoing.str as str,outgoing.branch as branch,outgoing.trucking as trucking,outgoing.plate_number as plate_number,outgoing.wp_grade as wp_grade,outgoing.remarks as remarks,outgoing.is_marked as is_marked,outgoing.log_id as log_id,sum(mc_weight) as mc_weight FROM outgoing where outgoing.branch='$branch' and outgoing.str !='VOID' and outgoing.date like '%" . $outgoing_date_month . "%' and outgoing.date <='$outgoing_date' and outgoing.wp_grade='" . $_SESSION['outgoing_grade'] . "' and outgoing.wp_grade !='' group by outgoing.str,outgoing.wp_grade";
            } else {
                $query = "SELECT outgoing.notations as notations ,outgoing.notations_b as notations_b ,outgoing.trucking_fee as trucking_fee,sum(outgoing.weight) as weights,outgoing.date as date,outgoing.str as str,outgoing.branch as branch,outgoing.trucking as trucking,outgoing.plate_number as plate_number,outgoing.wp_grade as wp_grade,outgoing.remarks as remarks,outgoing.is_marked as is_marked,outgoing.log_id as log_id,sum(mc_weight) as mc_weight FROM outgoing  where outgoing.branch='$branch' and outgoing.str !='VOID' and outgoing.date like '%" . $outgoing_date_month . "%' and outgoing.date <='$outgoing_date' and outgoing.wp_grade !='' group by outgoing.str,outgoing.wp_grade";
            }
            $result = mysql_query($query);
            while ($row = mysql_fetch_array($result)) {
                $str_number = $row['str'];
                $del_id = $row['log_id'];
                $branch = $row['branch'];
                $log_id = 0;
                if (preg_match('/DR/', $str_number)) {
                    $str_number = preg_split("[_]", $str_number);
                    $str_number = $str_number[1];
                    if ($branch == 'Pampanga') {
                        $query2 = "SELECT log_id,delivered_to,dr_number,sum(weight)as weight,mc,dirt,sum(net_wt) as net_wt  FROM actual where dr_number like '%" . $str_number . "%' and wp_grade='" . $row['wp_grade'] . "'  and delivered_to like '%$delivered_to%' group by dr_number";
                    } else {
                        if (trim($_SESSION['outgoing_grade']) != '') {
                            $query2 = "SELECT log_id,delivered_to,dr_number,sum(weight)as weight,mc,dirt,sum(net_wt) as net_wt,comments as comments  FROM actual where str_no like '%" . $str_number . "%' and wp_grade='" . $row['wp_grade'] . "'  and delivered_to like '%" . $_SESSION['delivered_to'] . "%' and wp_grade='" . $_SESSION['outgoing_grade'] . "' group by str_no";
                        } else {
                            $query2 = "SELECT log_id,delivered_to,dr_number,sum(weight)as weight,mc,dirt,sum(net_wt) as net_wt,comments as comments  FROM actual where str_no like '%" . $str_number . "%' and wp_grade='" . $row['wp_grade'] . "'  and delivered_to like '%" . $_SESSION['delivered_to'] . "%' group by str_no";
                        }
                    }
                } else {
                    if ($branch == 'Pampanga') {
                        $query2 = "SELECT log_id,delivered_to,dr_number,sum(weight)as weight,mc,dirt,sum(net_wt) as net_wt  FROM actual where dr_number like '%" . $str_number . "%' and wp_grade='" . $row['wp_grade'] . "'  and delivered_to like '%$delivered_to%' group by dr_number";
                    } else {
                        if (trim($_SESSION['outgoing_grade']) != '') {
                            $query2 = "SELECT log_id,delivered_to,dr_number,sum(weight) as weight,mc,dirt,sum(net_wt) as net_wt,comments as comments  FROM actual where str_no like '%" . $str_number . "%' and wp_grade='" . $row['wp_grade'] . "'and delivered_to like '%" . $_SESSION['delivered_to'] . "%'  and wp_grade='" . $_SESSION['outgoing_grade'] . "' group by str_no";
                        } else {
                            $query2 = "SELECT log_id,delivered_to,dr_number,sum(weight)as weight,mc,dirt,sum(net_wt) as net_wt,comments as comments  FROM actual where str_no like '%" . $str_number . "%' and wp_grade='" . $row['wp_grade'] . "'and delivered_to like '%" . $_SESSION['delivered_to'] . "%' group by str_no";
                        }
                    }
                }

                $result2 = mysql_query($query2);
                if ($row2 = mysql_fetch_array($result2)) {
                    $netwt = $row2['weight'];
                } else {
                    $netwt = "";
                }

                /// lon
                $comm = '';
                $sql_comments = mysql_query("SELECT * FROM actual WHERE str_no='$str_number'  and wp_grade='" . $row['wp_grade'] . "'");
                while ($rs_comments = mysql_fetch_array($sql_comments)) {
                    if ($comm == '') {
                        $comm = $rs_comments['comments'];
                    } else {
                        $comm .= " / " . $rs_comments['comments'];
                    }
                }

///////////////////////////////////////////////////////////////////////////////
                if (trim($_SESSION['delivered_to']) != '') {
                    if ($netwt != '') {
                        if ($row['is_marked'] == "!") {
                            echo "<tr class='data' id='highlighted' >";
                        } else {
                            echo "<tr class='data'>";
                        }


                        echo "<td>" . "<input type='checkbox' name='$del_id'  id='$del_id' value='" . $del_id . "' onclick='addOutgoing(this.id);'>" . "</td>";
                        echo "<td class='data' >" . $row['date'] . "</td>";
                        echo "<td class='data'><u id='link_ng_str'><a rel='facebox' ";
                        $query10 = "SELECT * from actual where str_no ='" . $row['str'] . "'";
                        $result10 = mysql_query($query10);
                        echo "title='";
                        while ($row10 = mysql_fetch_array($result10)) {
                            echo $row10['wp_grade'] . ": " . $row10['weight'] . "\r\n";
                        }
                        echo "'";
                        echo "href='frmAddNetweight.php?str=" . $row['str'] . "&wp_grade=" . $row['wp_grade'] . "'>" . $row['str'] . "</a></u></td>";
                        echo "<td class='data'>" . $row['branch'] . "</td>";
                        echo "<td class='data'>" . $row2['delivered_to'] . "</td>";
                        $log_id = $row2['log_id'];
                        echo "<td class='data'>" . $row['trucking'] . "</td>";
                        echo "<td class='data'>" . $row['plate_number'] . "</td>";
                        echo "<td class='data'>" . $row['trucking_fee'] . "</td>";
                        echo "<td class='data'><u><a rel='facebox' href='upgrade_downgrade.php?str=" . $row['str'] . "&wp_grade=" . $row['wp_grade'] . "' title='Click to UPGRADE/DOWNGRADE'>" . $row['wp_grade'] . "</a></u></td>";
                        echo "<td>";
                        $bale_count_grade = '';
                        $bale_count_grade = $row['wp_grade'];
                        if ($row['wp_grade'] != 'LCWL' && $row['wp_grade'] != 'CHIPBOARD' && $row['wp_grade'] != 'LCCB') {
                            $bale_count_grade = substr($row['wp_grade'], 2);
                        }


                        $query21 = "SELECT * from bales where str_no like '%" . $row['str'] . "%' and wp_grade='" . $bale_count_grade . "'";
                        $result21 = mysql_query($query21);
                        $bale_count = 0;
                        while ($row21 = mysql_fetch_array($result21)) {
                            $bale_count++;
                        }
                        echo $bale_count;
                        echo "</td>";
                        if ($row['is_marked'] == "yes") {
                            echo "<td id='higlight'>" . $row['weights'] . "</td>";
                        } else {
                            echo "<td id='from_location'>" . $row['weights'] . "</td>";
                        }
                        if ($bale_count > 0) {

                            echo "<td id=''>" . number_format(($row['weights'] / $bale_count), 2, '.', '') . "</td>";
                        } else {
                            echo "<td id=''>" . number_format(0, 2) . "</td>";
                        }
                        if ($row['str'] == '') {
                            if ($row['is_marked'] == "yes") {
                                echo "<td class='data' id='highlight'></td>";
                                echo "<td class='data' id='highlight'></td>";
                                echo "<td class='data' id='highlight'></td>";
                                echo "<td class='data' id='highlight'></td>";
                                echo "<td class='data' id='highlight'></td>";
                                echo "<td id='highlight'></td>";
                                echo "<td class='data' id='highlight'></td>";
                            } else {
                                echo "<td class='data' id='net'></td>";
                                echo "<td class='data' id='negative'></td>";
                                echo "<td class='data' id='mc'></td>";
                                echo "<td class='data' id='mc'></td>";
                                echo "<td class='data' id='dirt'></td>";
                                echo "<td id='corrected'></td>";
                                echo "<td class='data' id='dr'></td>";
                            }
                        } else {
                            $netnet_wt = 0;
                            if ($row2['net_wt'] < 1) {
                                if ($row['is_marked'] == "yes") {
                                    echo "<td class='data' id='highlight'>" . $row2['weight'] . "</td>";
                                } else {
                                    echo "<td class='data' id='net'>" . $row2['weight'] . "</td>";
                                }
                                $netnet_wt = $row2['weight'];
                            } else {
                                if ($row['is_marked'] == "yes") {
                                    echo "<td class='data' id='highlight'>" . $row2['net_wt'] . "</td>";
                                } else {
                                    echo "<td class='data' id='net'>" . $row2['net_wt'] . "</td>";
                                }
                                $netnet_wt = $row2['net_wt'];
                            }
                            $variance = ($netnet_wt - $row['weights']);
                            $variance_number = $variance;
                            if ($variance < 0) {
                                $variance = $variance * -1;
                                $variance = "(" . $variance . ")";
                                if ($row['is_marked'] == "yes") {
                                    echo "<td class='data' id='highlight'>" . $variance . "</td>";
                                } else {
                                    echo "<td class='data' id='negative'>" . $variance . "</td>";
                                }
                            } else if ($variance == 0) {
                                if ($row['is_marked'] == "yes") {
                                    echo "<td class='data' id='highlight'>" . $variance . "</td>";
                                } else {
                                    echo "<td class='data' id='zero'>" . $variance . "</td>";
                                }
                            } else {
                                if ($row['is_marked'] == "yes") {
                                    echo "<td class='data' id='highlight'>" . $variance . "</td>";
                                } else {
                                    echo "<td class='data' id='positive'>" . $variance . "</td>";
                                }
                            }

                            if ($row['is_marked'] == "yes") {
                                if ($row['mc_weight'] != '0') {
                                    echo "<td class='data' id='highlight'>" . $row['mc_weight'] . "</td>";
                                } else {
                                    echo "<td class='data' id='highlight'></td>";
                                }
                            } else {
                                if ($row['mc_weight'] != '0') {
                                    echo "<td class='data' id='mc'>" . $row['mc_weight'] . "</td>";
                                } else {
                                    echo "<td class='data' id='mc'></td>";
                                }
                            }

                            if ($row['is_marked'] == "yes") {
                                if ($row2['mc'] != '0') {
                                    echo "<td class='data' id='highlight'>" . $row2['mc'] . "</td>";
                                } else {
                                    echo "<td class='data' id='highlight'></td>";
                                }
                            } else {
                                if ($row2['mc'] != '0') {
                                    echo "<td class='data' id='mc'>" . $row2['mc'] . "</td>";
                                } else {
                                    echo "<td class='data' id='mc'></td>";
                                }
                            }

                            if ($row['is_marked'] == "yes") {
                                echo "<td class='data' id='highlight'>" . $row2['dirt'] . "</td>";
                            } else {
                                echo "<td class='data' id='dirt'>" . $row2['dirt'] . "</td>";
                            }

                            if ($row['is_marked'] == "yes") {
                                echo "<td id='highlight'>" . $netwt . "</td>";
                            } else {
                                echo "<td id='corrected'>" . $netwt . "</td>";
                            }

                            if ($row['is_marked'] == "yes") {
                                echo "<td class='data' id='highlight'>" . $row2['dr_number'] . "</td>";
                            } else {
                                echo "<td class='data' id='dr'>" . $row2['dr_number'] . "</td>";
                            }
                        }
                        if ($row2['mc'] != '0' && $row2['mc'] != '') {
                            echo "<td class='data'>" . round(($row2['mc'] / $row2['net_wt']) * 100, 2) . " %</td>";
                        } else {
                            echo "<td class='data'></td>";
                        }
                        echo "<td class='data'>" . $row['notations_b'] . "</td>";

                        if ($row['notations'] == '') {
                            echo "<td class='data'>$comm</td>";
                        } else {
                            echo "<td class='data'>" . $row['notations'] . "</td>";
                        }
                        if ($row['is_marked'] == 'yes') {
                            echo "<td class='data'>";
                            echo "<a href='highlight_outgoing.php?log_id=" . $row['log_id'] . "' title='Click to Remove Highlight'><img src='icon/mark.png'></a>";
                            echo "<a href='delete_one_actual.php?log_id=" . $log_id . "' title='Click to Erase Encoded Actual'><img src='icon/bura.png' ></a>";
                            echo "</td>";
                        } else {
                            echo "<td class='data'>";
                            if ($_SESSION['usertype'] == 'Super User') {
                                echo "<a href='delete_one_actual.php?log_id=" . $log_id . "' title='Click to Erase Encoded Actual'><img src='icon/bura.png'></a>";
                                echo "<a rel='facebox' href='outgoing_frm_notation.php?log_id=" . $row['log_id'] . "' title='Click to input notation.'>N</a>";
                            } else {
                                echo "<a href='delete_one_actual.php?log_id=" . $log_id . "' title='Click to Erase Encoded Actual'><img src='icon/bura.png'></a>";
                                echo "<a rel='facebox' href='outgoing_frm_notation_branch.php?log_id=" . $row['log_id'] . "' title='Click to input notation.'>N</a>";
                            }
                            echo "</td>";
                        }


                        echo "</tr>";

                        $total_from_loc +=$row['weights'];
                        $total_net_weight +=$netnet_wt;
                        $total_variance+=$variance_number;
                        $total_c_mc+=$row['mc_weight'];
                        $total_mc+=$row2['mc'];
                        $total_dirt+=$row2['dirt'];
                        $total_corrected+=$netwt;
                    }
                } else {
                    if ($row['is_marked'] == "!") {
                        echo "<tr class='data' id='highlighted' >";
                    } else {
                        echo "<tr class='data'>";
                    }


                    echo "<td>" . "<input type='checkbox' name='$del_id'  id='$del_id' value='" . $del_id . "' onclick='addOutgoing(this.id);'>" . "</td>";
                    echo "<td class='data' >" . $row['date'] . "</td>";
                    echo "<td class='data'><u id='link_ng_str'>";
//                    echo "<a id='" . $row['log_id'] . "' type='button' data-toggle='modal' data-target='#myModal2' onclick='typeNotation(this.id);'>" . $row['str'] . "</a>";
                    echo "<a rel='facebox' ";
                    $query10 = "SELECT * from actual where str_no ='" . $row['str'] . "'";
                    $result10 = mysql_query($query10);
                    echo "title='";
                    while ($row10 = mysql_fetch_array($result10)) {
                        echo $row10['wp_grade'] . ": " . $row10['weight'] . "\r\n";
                    }
                    echo "'";
                    echo "href='frmAddNetweight.php?str=" . $row['str'] . "&wp_grade=" . $row['wp_grade'] . "'>" . $row['str'] . "</a></u></td>";
                    echo "<td class='data'>" . $row['branch'] . "</td>";
                    echo "<td class='data'>" . $row2['delivered_to'] . "</td>";
                    $log_id = $row2['log_id'];
                    echo "<td class='data'>" . $row['trucking'] . "</td>";
                    echo "<td class='data'>" . $row['plate_number'] . "</td>";
                    echo "<td class='data'>" . $row['trucking_fee'] . "</td>";
                    echo "<td class='data'><u><a rel='facebox' href='upgrade_downgrade.php?str=" . $row['str'] . "&wp_grade=" . $row['wp_grade'] . "' title='Click to UPGRADE/DOWNGRADE'>" . $row['wp_grade'] . "</a></u></td>";
                    echo "<td>";
                    $bale_count_grade = '';
                    $bale_count_grade = $row['wp_grade'];
                    if ($row['wp_grade'] != 'LCWL' && $row['wp_grade'] != 'CHIPBOARD' && $row['wp_grade'] != 'LCCB') {
                        $bale_count_grade = substr($row['wp_grade'], 2);
                    }


                    $query21 = "SELECT * from bales where str_no like '%" . $row['str'] . "%' and wp_grade='" . $bale_count_grade . "'";
                    $result21 = mysql_query($query21);
                    $bale_count = 0;
                    while ($row21 = mysql_fetch_array($result21)) {
                        $bale_count++;
                    }
                    echo $bale_count;
                    echo "</td>";
                    if ($row['is_marked'] == "yes") {
                        echo "<td id='higlight'>" . $row['weights'] . "</td>";
                    } else {
                        echo "<td id='from_location'>" . $row['weights'] . "</td>";
                    }
                    if ($bale_count > 0) {

                        echo "<td id=''>" . number_format(($row['weights'] / $bale_count), 2, '.', '') . "</td>";
                    } else {
                        echo "<td id=''>" . number_format(0, 2) . "</td>";
                    }
                    if ($row['str'] == '') {
                        if ($row['is_marked'] == "yes") {
                            echo "<td class='data' id='highlight'></td>";
                            echo "<td class='data' id='highlight'></td>";
                            echo "<td class='data' id='highlight'></td>";
                            echo "<td class='data' id='highlight'></td>";
                            echo "<td class='data' id='highlight'></td>";
                            echo "<td id='highlight'></td>";
                            echo "<td class='data' id='highlight'></td>";
                        } else {
                            echo "<td class='data' id='net'></td>";
                            echo "<td class='data' id='negative'></td>";
                            echo "<td class='data' id='mc'></td>";
                            echo "<td class='data' id='mc'></td>";
                            echo "<td class='data' id='dirt'></td>";
                            echo "<td id='corrected'></td>";
                            echo "<td class='data' id='dr'></td>";
                        }
                    } else {
                        $netnet_wt = 0;
                        if ($row2['net_wt'] < 1) {
                            if ($row['is_marked'] == "yes") {
                                echo "<td class='data' id='highlight'>" . $row2['weight'] . "</td>";
                            } else {
                                echo "<td class='data' id='net'>" . $row2['weight'] . "</td>";
                            }
                            $netnet_wt = $row2['weight'];
                        } else {
                            if ($row['is_marked'] == "yes") {
                                echo "<td class='data' id='highlight'>" . $row2['net_wt'] . "</td>";
                            } else {
                                echo "<td class='data' id='net'>" . $row2['net_wt'] . "</td>";
                            }
                            $netnet_wt = $row2['net_wt'];
                        }

                        $variance = ($netnet_wt - $row['weights']);
                        $variance_number = $variance;
                        if ($variance < 0) {
                            $variance = $variance * -1;
                            $variance = "(" . $variance . ")";
                            if ($row['is_marked'] == "yes") {
                                echo "<td class='data' id='highlight'>" . $variance . "</td>";
                            } else {
                                echo "<td class='data' id='negative'>" . $variance . "</td>";
                            }
                        } else if ($variance == 0) {
                            if ($row['is_marked'] == "yes") {
                                echo "<td class='data' id='highlight'>" . $variance . "</td>";
                            } else {
                                echo "<td class='data' id='zero'>" . $variance . "</td>";
                            }
                        } else {
                            if ($row['is_marked'] == "yes") {
                                echo "<td class='data' id='highlight'>" . $variance . "</td>";
                            } else {
                                echo "<td class='data' id='positive'>" . $variance . "</td>";
                            }
                        }

                        if ($row['is_marked'] == "yes") {
                            if ($row['mc_weight'] != '0') {
                                echo "<td class='data' id='highlight'>" . $row['mc_weight'] . "</td>";
                            } else {
                                echo "<td class='data' id='highlight'></td>";
                            }
                        } else {
                            if ($row['mc_weight'] != '0') {
                                echo "<td class='data' id='mc'>" . $row['mc_weight'] . "</td>";
                            } else {
                                echo "<td class='data' id='mc'></td>";
                            }
                        }

                        if ($row['is_marked'] == "yes") {
                            if ($row2['mc'] != '0') {
                                echo "<td class='data' id='highlight'>" . $row2['mc'] . "</td>";
                            } else {
                                echo "<td class='data' id='highlight'></td>";
                            }
                        } else {
                            if ($row2['mc'] != '0') {
                                echo "<td class='data' id='mc'>" . $row2['mc'] . "</td>";
                            } else {
                                echo "<td class='data' id='mc'></td>";
                            }
                        }

                        if ($row['is_marked'] == "yes") {
                            echo "<td class='data' id='highlight'>" . $row2['dirt'] . "</td>";
                        } else {
                            echo "<td class='data' id='dirt'>" . $row2['dirt'] . "</td>";
                        }

                        if ($row['is_marked'] == "yes") {
                            echo "<td id='highlight'>" . $netwt . "</td>";
                        } else {
                            echo "<td id='corrected'>" . $netwt . "</td>";
                        }

                        if ($row['is_marked'] == "yes") {
                            echo "<td class='data' id='highlight'>" . $row2['dr_number'] . "</td>";
                        } else {
                            echo "<td class='data' id='dr'>" . $row2['dr_number'] . "</td>";
                        }
                    }
                    if ($row2['mc'] != '0' && $row2['mc'] != '') {
                        echo "<td class='data'>" . round(($row2['mc'] / $row2['net_wt']) * 100, 2) . " %</td>";
                    } else {
                        echo "<td class='data'></td>";
                    }
                    echo "<td class='data'><span id='val_notation_b_" . $row['log_id'] . "'>" . $row['notations_b'] . "</span></td>";

                    if ($row['notations'] == '') {
                        echo "<td class='data'><span id='val_notation_a_" . $row['log_id'] . "'>$comm</span></td>";
                    } else {
                        echo "<td class='data'><span id='val_notation_a_" . $row['log_id'] . "'>" . $row['notations'] . "</span></td>";
                    }
                    if ($row['is_marked'] == 'yes') {
                        echo "<td class='data'>";
                        echo "<a href='highlight_outgoing.php?log_id=" . $row['log_id'] . "' title='Click to Remove Highlight'><img src='icon/mark.png'></a>";
                        echo "<a href='delete_one_actual.php?log_id=$log_id' title='Click to Erase Encoded Actual'><img src='icon/bura.png' ></a>";
                        echo "</td>";
                    } else {
                        echo "<td class='data'>";
                        if ($_SESSION['position'] == 'Accounting Staff') {
                            echo "<a href='delete_one_actual.php?log_id=" . $log_id . "' title='Click to Erase Encoded Actual' onclick='return confirm('Do you want to Proceed?');'><img src='icon/bura.png'></a>";
//                            echo "<a rel='facebox' href='outgoing_frm_notation.php?log_id=" . $row['log_id'] . "' title='Click to input notation.'>N</a>";
//                            echo "<button id='admin_" . $row['log_id'] . "' type='button' data-toggle='modal' data-target='#myModal' onclick='typeNotation(this.id);'>N</button>";
                            echo "<a id='admin_" . $row['log_id'] . "' type='button' data-toggle='modal' data-target='#myModal' onclick='typeNotation(this.id);'><img src='icon/notation.png'></a>";
                        } else {
                            echo "<a href='delete_one_actual.php?log_id=" . $log_id . "' title='Click to Erase Encoded Actual'><img src='icon/bura.png'></a>";
//                            echo "<a rel='facebox' href='outgoing_frm_notation_branch.php?log_id=" . $row['log_id'] . "' title='Click to input notation.'>N</a>";
//                            echo "<button id='branch_" . $row['log_id'] . "' type='button' data-toggle='modal' data-target='#myModal' onclick='typeNotation(this.id);'>N</button>";
                            echo "<a id='branch_" . $row['log_id'] . "' type='button' data-toggle='modal' data-target='#myModal' onclick='typeNotation(this.id);'><img src='icon/notation.png'></a>";
                            echo "</td>";
                        }
                        echo "</tr>";
                        $total_from_loc +=$row['weights'];
                        $total_net_weight +=$netnet_wt;
                        $total_variance+=$variance_number;
                        $total_c_mc+=$row['mc_weight'];
                        $total_mc+=$row2['mc'];
                        $total_dirt+=$row2['dirt'];
                        $total_corrected+=$netwt;
                    }
                }
                /////////////////////////////////////////////////////////////////////
            }

            echo "<tr>";
            echo "<td id = 'total'></td>";
            echo "<td id = 'total'>z_TOTAL_z</td>";
            echo "<td id = 'total'></td>";
            echo "<td id = 'total'></td>";
            echo "<td id = 'total'></td>";
            echo "<td id = 'total'></td>";
            echo "<td id = 'total'></td>";
            echo "<td id = 'total'></td>";
            echo "<td id = 'total'></td>";
            echo "<td id = 'total'></td>";
            echo "<td id = 'total'>" . number_format($total_from_loc, 2) . "</td>";
            echo "<td id = 'total'></td>";
            echo "<td id = 'total'>" . number_format($total_net_weight, 2) . "</td>";
            echo "<td id = 'total'>" . number_format($total_variance, 2) . "</td>";
            echo "<td id = 'total'>" . number_format($total_c_mc, 2) . "</td>";
            echo "<td id = 'total'>" . number_format($total_mc, 2) . "</td>";
            echo "<td id = 'total'>" . number_format($total_dirt, 2) . "</td>";
            echo "<td id = 'total'>" . number_format($total_corrected, 2) . "</td>";
            echo "<td id = 'total'>" . number_format($total_dr, 2) . "</td>";
            echo "<td id = 'total'></td>";
            echo "<td id = 'total'></td>";
            echo "<td id = 'total'></td>";
            echo "<td id = 'total'></td>";
            echo "</tr>";
            echo "</table>";
            if ($_SESSION['usertype'] == 'Super User') {
				//echo $_SESSION['selected_branch'];
                echo '<a rel="facebox" href="form_encode_outgoing.php?branch = ' . $_SESSION['selected_branch'] . '"><button>Encode Outgoing</button></button></a>';
                echo '<a rel="facebox" href="form_delete_manual_outgoing.php?branch = ' . $_SESSION['selected_branch'] . '"><button>Delete Manually Encoded Outgoing</button></a>';
                echo '<a rel="facebox" href="form_delete_outgoing.php?branch = ' . $_SESSION['selected_branch'] . '"><button>Delete Exported Outgoing</button></a>';
                echo '<a rel="facebox" href="form_delete_actual.php?branch = ' . $_SESSION['selected_branch'] . '"><button>Delete Actual</button></a>';
            }
            echo "<a href = 'highlight_outgoing.php'><img src = 'icon/highlight.png' width = '30px;' title = 'highlight selected records'></a>";
            ?>

        </table>



        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" hidden="hidden">&times;</button>
                        <h4 class="modal-title">Outgoing Notations</h4>
                    </div>
                    <div class="modal-body">
                        <div align="center">
                            <input type="hidden" id="type" name="type">
                            <input type="hidden" id="log_id" name="log_id">
                            <textarea rows="5" cols="60" id="edit_notation"></textarea>
                            <br>
                        </div>                                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="saveNotations();
                                ">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

        <div class="modal fade" id="myModal2" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" hidden="hidden">&times;</button>
                        <h4 class="modal-title">Outgoing Delivery</h4>
                    </div>
                    <div class="modal-body">
                        <div align="center">
                            <input type="hidden" id="type" name="type">
                            <input type="hidden" id="log_id" name="log_id">
                            <textarea rows="5" cols="60" id="edit_notation"></textarea>
                            <br>
                        </div>                                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="saveNotations();
                                ">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
<div class="clear">

</div>

<div class="clear">

</div>