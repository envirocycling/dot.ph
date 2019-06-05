<?php
session_start();
include("config.php");
?>
<script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
<script src="js/setup.js" type="text/javascript"></script>
<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="src/facebox.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('a[rel*=facebox]').facebox({
            loadingImage : 'src/loading.gif',
            closeImage   : 'src/closelabel.png'
        })
    })
</script>
<script>
    function openWindow(){
        var x = screen.width/2 - 700/2;
        var y = screen.height/2 - 450/2;
        window.open("form_update_price_competition.php",'mywindow','width=400,height=470');
    }
</script>


<script>
    function openPriceWindow(str){
        var x = screen.width/2 - 700/2;
        var y = screen.height/2 - 450/2;
        window.open("view_price_update_history.php?parameter="+str,'mywindow','width=600,height=600');
    }
</script>

<style>
    #prices{
        text-align: center;
    }
    td{
        /* border-style: hidden;
        border-bottom:solid;
        border-right:solid;
        border-width: 1px;
        padding-left:10px;
        padding-right:10px;
        background-color:#FFF5E0; */

    }
    th{
        /* border-style: hidden;
        border-bottom:solid;
        border-right:solid;
        border-width: 1px;
        padding-left:10px;
        padding-right:10px; */
    }
    th{
        background-color:#FF6840;

    }
    #grade{
        font-weight: bold;
        background-color: #FFC040;
    }
    h1{
        color:maroon;
    }
    body{
        background-color: #EBE0CC;
    }
    h2{
        color:maroon;
    }
    i{
        color:maroon;
    }
</style>
<div class="grid_2">
    <div class="box round first grid">

        <img src="images/update.png" height="80px" title="UPDATE RECORDS" onclick="openWindow();">
        <a href="dashboard_pricing_against_competitors.php">  <img src="images/back.png" height="80px" title="GO BACK"></a>
    </div>
</div>
<div class="grid_10">
    <div class="box round first grid">
        <?php
        $competitors_array=array();
        $wp_grade_array=array();
        $branches_array=array();
        $branches_competitor_array=array();
        $start_date=$_SESSION['pricing_against_competitors_start_date'];
        $end_date=$_SESSION['pricing_against_competitors_end_date'];
        $branch=$_SESSION['pricing_against_competitors_branch'];
        $start_date_for_boxes =date('Y/m/01', strtotime($end_date));
        $start_date_for_boxes = date('Y/m/01', strtotime("$start_date_for_boxes". "-6 month"));

        echo " <center><h1>Pricing Analysis Against Competitors</h1><br>for the period: <u><i>$start_date</i></u> to <u><i>$end_date</i></u><hr>";

        $sql = mysql_query("SELECT * FROM pricing_against_competitors where date <='$end_date' and company_type='branch' and approved_status='approved' GROUP BY company ORDER BY company ASC");
        while ($rs = mysql_fetch_array($sql)) {
            array_push($branches_array,$rs['company']);
        }

//        $sql = mysql_query("SELECT * FROM pricing_against_competitors where date <='$end_date' and company_type='branch' and approved_status='approved' GROUP BY wp_grade");
//        while ($rs = mysql_fetch_array($sql)) {
        array_push($wp_grade_array,'LCWL','ONP','CBS','OCC','MW','CHIPBOARD');
//        }

//        $sql = mysql_query("SELECT * FROM pricing_against_competitors where date <='$end_date' and company_type='competitor' and approved_status='approved'  GROUP BY company ORDER BY company ASC");
//        while ($rs = mysql_fetch_array($sql)){
//            array_push($branches_competitor_array,$rs['company']);
//        }
        $competitors_price = array();
        foreach ($branches_array as $branch_name) {
            $branches_competitor_array=array();
            echo "<table border='1' cellspacing='1'>";
            echo "<thead>";
            echo "<th>Grade</th>";
            echo "<th id='grade'>".$branch_name."<br>min|max</th>";
            $sql = mysql_query("SELECT * FROM pricing_against_competitors WHERE  date <='$end_date' and branch_affected='$branch_name' and company!='$branch_name' and approved_status='approved' GROUP BY company ORDER BY company ASC");
            while ($rs = mysql_fetch_array($sql)) {
                echo "<th>".$rs['company']."<br>min|max</th>";
                array_push($branches_competitor_array,$rs['company']);
            }
            echo "</thead>";

            foreach ($wp_grade_array as $wp_grade) {
                echo "<tr>";
                echo "<td id='grade'>$wp_grade</td>";
                $sql_price = mysql_query("SELECT * FROM pricing_against_competitors WHERE company='$branch_name' and wp_grade='$wp_grade' ORDER BY date DESC");
                $rs_price = mysql_fetch_array($sql_price);
                echo "<td id='prices'>".$rs_price['price']."|".$rs_price['max_price']."</td>";
                foreach ($branches_competitor_array as $competitors) {
                    $sql_price = mysql_query("SELECT * FROM pricing_against_competitors WHERE company='$competitors' and wp_grade='$wp_grade' ORDER BY date DESC");
                    $rs_price = mysql_fetch_array($sql_price);
                    echo "<td id='prices'>".$rs_price['price']."|".$rs_price['max_price']."</td>";
                }
                echo "</tr>";
            }

            echo "</table>";
            echo "<br>";
            echo "<button onclick=openPriceWindow(this.value) value='".$branch_name."'>View Price Update History</button></a>";
//            echo "<br><button onclick=openPriceWindow2(this.value) value='".$branch_name."'>View Update History</button>";
            echo "<hr>";
        }



//        $pricing_details_array=array();
//        $query="SELECT * FROM pricing_against_competitors where date>='$start_date' and date <='$end_date' and approved_status='approved' ORDER BY date ASC ";
//        $result =mysql_query($query);
//
//
//        while($row = mysql_fetch_array($result)) {
//            if($row['company_type']=='competitor') {
//                array_push($competitors_array,$row['company']."+".$row['branch_affected']);
//            }else {
//                array_push($branches_array,$row['company']."+"."none");
//            }
//            array_push($wp_grade_array,$row['wp_grade']);
//
//            if($row['company_type']=='competitor') {
//                $pricing_details_array[$row['company']."+".$row['branch_affected']."+".$row['wp_grade']]=$row['price']."-".$row['max_price'];
//            } else {
//                $pricing_details_array[$row['company']."+"."branch"."+".$row['wp_grade']]=$row['price']."-".$row['max_price'];
//            }
//
//        }
//
//        $wp_grade_array=array_unique($wp_grade_array);
//        $competitors_array=array_unique($competitors_array);
//        $branches_array=array_unique($branches_array);

//        foreach($branches_array as $branch_array_element) {
//
//            $branch_array_element_array = preg_split("/[+]/",$branch_array_element);
//            $branch_name=$branch_array_element_array[0];
//            $static_branch_name=$branch_name;
//            //echo "<table class='data display datatable' id='example'>";
//            echo "<table >";
//            echo "<thead>";
//            echo "<th>Grade</th>";
//            echo "<th>".$static_branch_name."<hr>min|max</th>";
//            foreach($competitors_array as $competitor) {
//                $temp_competitor=preg_split("/[+]/",$competitor);
//                $affected_branch=$temp_competitor[1];
//                echo $competitor."-".$branch_name."<br>";
//                if($affected_branch==$branch_name) {
//                    echo "<th>".$temp_competitor[0]."<hr>min|max</th>";
//                }
//
//
//            }
//
//
//            echo "</thead>";
//
//            foreach($wp_grade_array as $wp_grade) {
//                echo "<tr>";
//                echo "<td id='grade'>".$wp_grade."</td>";
//
//                if(!empty($pricing_details_array[$static_branch_name."+"."branch"."+".$wp_grade])) {
//                    $price_details_element=$pricing_details_array[$static_branch_name."+"."branch"."+".$wp_grade];
//                    $price_details_element=preg_split("/[-]/",$price_details_element);
//                    echo "<td id='prices'>".$price_details_element[0]."|".$price_details_element[1]."</td>";
//                } else {
//                    echo "<td id='prices'>|</td>";
//                }
//
//                foreach($competitors_array as $competitor_name) {
//                    $tmp_competitor_name=preg_split("/[+]/",$competitor_name);
//                    $real_competitor_name=$tmp_competitor_name[0];
//                    $affected_branch=$tmp_competitor_name[1];
//                        if($static_branch_name==$affected_branch) {
//                            if(!empty($pricing_details_array[$real_competitor_name."+".$static_branch_name."+".$wp_grade])) {
//                                $price_details_element=$pricing_details_array[$real_competitor_name."+".$static_branch_name."+".$wp_grade];
//                                $price_details_element=preg_split("/[-]/",$price_details_element);
//                                echo "<td id='prices'>".$price_details_element[0]."|".$price_details_element[1]."</td>";
//                            }else {
//                                echo "<td></td>";
//
//                            }
//                        }
//                }
//                echo "</tr>";
//            }
//
//
//            echo "</table>";
        //       echo "<br><button onclick=openPriceWindow(this.value) value='".$static_branch_name."'>View Price Update History</button></a>";
//            echo "<br> <a rel='facebox' href='ifrm_view_price_update_history.php?parameter=$static_branch_name'>View Update History</a>";
//            echo "<hr>";

//        }

        if($_SESSION['show_affected_suppliers']=='YES') {
            echo "<a  href='show_affected_suppliers.php?answer=NO'><button>HIDE Effects on Suppliers</button></a>";
            echo "<hr>";
            foreach($wp_grade_array as $wp_grade) {
                echo "<h2>Effects of price on <u><i>$wp_grade</i></u> suppliers for the period: <u>$start_date_for_boxes</u> to <u>$end_date</u> </h2><br>";

                echo "<iframe width=100%; height=50%; src='ifrm_suppliers_performance_rank.php?start_date=$start_date_for_boxes&&end_date=$end_date&&wp_grade=$wp_grade&&branch=$branch'></iframe><hr>";




            }
        }else {
            echo "<a  rel='facebox' href='show_affected_suppliers1.php?answer=YES'><button>Show Effects on Suppliers</button></a>";
            echo "<hr>";

        }


        ?>

    </div>
</div>

<div class="clear">



</div>