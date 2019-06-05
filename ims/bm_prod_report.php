<?php include("templates/template.php");?>
<style>
    #summary_per{
        float:right;

    }
</style>
<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
    function date1(str){
        new JsDatePick({
            useMode:2,
            target:str,
            dateFormat:"%Y/%m/%d"

        });
    };
</script>

<?php
function secondsToWords($seconds) {
    /*** return value ***/
    $ret = "";
    /*** get the hours ***/
    $hours = intval(intval($seconds) / 3600);
    if($hours > 0) {
        if($hours<10) {
            $ret .= "0$hours:";
        }else {
            $ret .= "$hours:";
        }
    }else {
        $ret .= "0$hours:";
    }
    $minutes = fmod((intval($seconds) / 60),60);
    if($hours > 0 || $minutes > 0) {
        if($minutes<10) {
            $ret .= "0$minutes";
        }else {
            $ret .= "$minutes";
        }
    }

    if($minutes==0) {
        $ret .= "0$minutes";
    }


    /*** get the seconds ***/
    $seconds = fmod(intval($seconds),60);


    return $ret;
}


function secondsToWords2($seconds) {
    /*** return value ***/
    $ret = "";

    /*** get the hours ***/
    $hours = intval(intval($seconds) / 3600);
    if($hours > 0) {
        if($hours<10) {
            $ret .= "0$hours:";
        }else {
            $ret .= "$hours:";
        }
    }else {
        $ret .= "0$hours:";
    }
    $minutes = fmod((intval($seconds) / 60),60);
    if($hours > 0 || $minutes > 0) {
        if($minutes<10) {
            $ret .= "0$minutes";
        }else {
            $ret .= "$minutes";
        }
    }

    if($minutes==0) {
        $ret .= "0$minutes";
    }


    /*** get the seconds ***/
    $seconds = fmod(intval($seconds),60);


    return $ret;
}



function sec_to_time($seconds) {
    $hours = floor($seconds / 3600);
    $minutes = floor($seconds % 3600 / 60);
    $seconds = $seconds % 60;

    return sprintf("%02d:%02d", $minutes, $seconds);
}


?>


<style>

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
    #total{
        background-color: yellow;
        font-weight:bold;
    }
</style>
<div class="grid_3">
    <div class="box round first grid">
        <h2>Filtering Options</h2>

        <form action="filter_bm.php" method="POST">
            From: <input type='text'  id='inputField' name='from' value="" onfocus='date1(this.id);' readonly><br>
            TO: <input type='text'  id='inputField2' name='to' value="" onfocus='date1(this.id);' readonly><br>
            <input type="submit" value="Filter">
        </form>
        <a href="clear_bm.php"><button>Clear Filter</button></a>


    </div>
</div>
<div class="grid_10">
    <div class="box round first grid">
        <?php
        $ngayon=date('F d, Y');
        $month=date('Y/m');
        $from=$_SESSION['bm_from'];
        $to=$_SESSION['bm_to'];
        $branch=$_SESSION['selected_branch'];
        if($from=='') {
            echo "<h2> ".$_SESSION['selected_branch']." BM PRODUCTION as of: <u><b><i>".$ngayon."</i></b></u></h2>";
        }else {
            echo "<h2> ".$_SESSION['selected_branch']." BM PRODUCTION for the period:<u><b><i>".$from." to ".$to."</i></b></u></h2>";

        }

        ?>
        <table class="data display datatable" id="example">
            <?php
            echo "<thead>";
            echo '<tr class="data">';

            echo "<th class='data'>Log_ID</th>";
            echo "<th class='data'>DATE</th>";
            echo "<th class='data'>WP GRADE</th>";
            echo "<th class='data'>START</th>";

            echo "<th class='data'>FINISH</th>";
            echo "<th class='data'>NO. OF BALES</th>";
            echo "<th class='data'>MINUTES</th>";
            echo "<th class='data'>MIN/BALE</th>";
            echo "<th class='data'>REBALE</th>";
            echo "<th class='data'>BRANCH</th>";

            echo "</tr>";

            echo "</thead>";
            include("config.php");
            if($from=='') {
                $query="SELECT * FROM bm_prod where branch like '%$branch%' and date like '%$month%' ";
            }else {
                $query="SELECT * FROM bm_prod where branch like '%$branch%' and date between '$from' and '$to'";

            }
            $result=mysql_query($query);
            while($row = mysql_fetch_array($result)) {
                echo "<tr class='data'>";
                echo "<td class='data'>".$row['log_id']."</td>";
                echo "<td class='data'>".$row['date']."</td>";
                echo "<td class='data'>".$row['wp_grade']."</td>";
                echo "<td class='data'>".$row['start']."</td>";
                echo "<td class='data'>".$row['finish']."</td>";
                echo "<td class='data'>".$row['no_of_bales']."</td>";
                echo "<td class='data'>".$row['minutes']."</td>";
                echo "<td class='data'>".$row['min_per_bale']."</td>";
                echo "<td class='data'>".$row['rebale']."</td>";
                echo "<td class='data'>".$row['branch']."</td>";


                echo "</tr>";
            }




            echo "</table>";


            ?>
        </table>
    </div>
</div>


<div class="grid_3">
    <div class="box round first grid">
        <?php
        $ngayon=date('F d, Y');
        $branch=$_SESSION['selected_branch'];
        if($from=='') {
            echo "<h2> ".$_SESSION['selected_branch']." MINUTES/GRADE as of: <u><b><i>".$ngayon."</i></b></u></h2>";
        }else {
            echo "<h2> ".$_SESSION['selected_branch']." MINUTES/GRADE for the period: <u><b><i>".$from." to ".$to."</i></b></u></h2>";

        }


        ?>
        <table class="data display datatable" id="example">
            <?php
            echo "<thead>";
            echo '<tr class="data">';

            echo "<th class='data'>WP GRADE</th>";
            echo "<th class='data'>TOTAL BALING TIME (hh:mm)</th>";


            echo "</tr>";

            echo "</thead>";
            include("config.php");
            $total_time='';
            foreach($_SESSION['wp_grades'] as $wp_grade) {

                if($from=='') {
                    $query="SELECT minutes FROM bm_prod where branch like '%$branch%'  and wp_grade='$wp_grade' and date like '%$month%'";
                }else {
                    $query="SELECT minutes FROM bm_prod  where branch like '%$branch%'  and wp_grade='$wp_grade' and date between '$from' and '$to' ";

                }

                $result=mysql_query($query);
                $sum_minutes=0;
                while($row = mysql_fetch_array($result)) {
                    $minute_per_grade=$row['minutes'];
                    $minute_per_grade=preg_split('/[:]/',$minute_per_grade);
                    if($minute_per_grade[0]!='0') {
                        $minute_per_grade=($minute_per_grade[1]*60)+($minute_per_grade[0]*3600);
                    }else {
                        $minute_per_grade=($minute_per_grade[1]*60);
                    }
                    $sum_minutes+=$minute_per_grade;
                    $total_time+=$minute_per_grade;
                }
                echo "<tr>";
                echo "<td>".strtoupper($wp_grade)."</td>";
                echo "<td>".secondsToWords($sum_minutes)."</td>";
                echo "</tr>";

            }

            echo "<tr>";
            echo "<td id='total'>z_TOTAL_z</td>";
            echo "<td id='total'>".secondsToWords2($total_time)."</td>";
            $tonnage_per_hour_time=secondsToWords2($total_time);
            echo "</tr>";

            echo "</table>";


            ?>
        </table>
    </div>
</div>
<div class="grid_3">
    <div class="box round first grid">
        <?php
        $ngayon=date('F d, Y');
        $branch=$_SESSION['selected_branch'];
        if($from=='') {
            echo "<h2> ".$_SESSION['selected_branch']." SUM OF BALES as of: <u><b><i>".$ngayon."</i></b></u></h2>";
        }else {
            echo "<h2> ".$_SESSION['selected_branch']." SUM OF BALES for the period: <u><b><i>".$from." to ".$to."</i></b></u></h2>";

        }
        ?>
        <table class="data display datatable" id="example">
            <?php
            echo "<thead>";
            echo '<tr class="data">';

            echo "<th class='data'>WP GRADE</th>";
            echo "<th class='data'>Number of Bales</th>";


            echo "</tr>";

            echo "</thead>";
            include("config.php");
            $total_time='';
            if($from=='') {
                $query="SELECT wp_grade,sum(no_of_bales) FROM bm_prod where  branch like '%$branch%'   and date like '%$month%' group by wp_grade ";
            }else {
                $query="SELECT wp_grade,sum(no_of_bales) FROM bm_prod where branch like '%$branch%'  and date between '$from' and '$to' group by wp_grade ";


            }
            $result=mysql_query($query);
            $sum_of_bales=0;
            while($row = mysql_fetch_array($result)) {
                echo "<tr>";
                echo "<td class='data'>".$row['wp_grade']."</td>";
                echo "<td class='data'>".$row['sum(no_of_bales)']."</td>";
                $sum_of_bales=$sum_of_bales+$row['sum(no_of_bales)'];
                echo "</tr>";
            }
            echo "<tr>";
            echo "<td id='total'>z_TOTAL_z</td>";
            echo "<td id='total'>$sum_of_bales</td>";

            echo "</tr>";

            echo "</table>";


            ?>

        </table>

    </div>
</div>


<div class="grid_3">
    <div class="box round first grid">
        <?php
        $ngayon=date('F d, Y');
        $branch=$_SESSION['selected_branch'];
        if($from=='') {
            echo "<h2> ".$_SESSION['selected_branch']." SUM OF BALE Wt. as of: <u><b><i>".$ngayon."</i></b></u></h2>";
        }else {
            echo "<h2> ".$_SESSION['selected_branch']." SUM OF BALE Wt. for the period: <u><b><i>".$from." to ".$to."</i></b></u></h2>";

        }
        ?>
        <table class="data display datatable" id="example">
            <?php
            echo "<thead>";
            echo '<tr class="data">';
            echo "<th class='data'>WP GRADE</th>";
            echo "<th class='data'>Bale Wt.</th>";
            echo "</tr>";
            echo "</thead>";
            include("config.php");
            $total_time='';
            if($from=='') {
                $query="SELECT wp_grade,sum(bale_weight) FROM bales where branch like '%$branch%' and date like '%$month%'  and status !='rebaled'  group by wp_grade ";
            }else {
                $query="SELECT wp_grade,sum(bale_weight) FROM bales where branch like '%$branch%' and date between '$from' and '$to'  and status !='rebaled'  group by wp_grade ";

            }
            $result=mysql_query($query);
            $sum_of_bales=0;
            while($row = mysql_fetch_array($result)) {
                echo "<tr>";
                echo "<td class='data'>".$row['wp_grade']."</td>";
                echo "<td class='data'>".$row['sum(bale_weight)']."</td>";
                $sum_of_bales=$sum_of_bales+$row['sum(bale_weight)'];
                echo "</tr>";

            }
            echo "<tr>";
            echo "<td id='total'>z_TOTAL_z</td>";
            echo "<td id='total'>$sum_of_bales</td>";
            $total_weight_bales=$sum_of_bales;
            echo "</tr>";
            echo "</table>";
            ?>
        </table>
    </div>
</div>
<div class="grid_10">
    <div class="box round first grid">
        <?php
        $ngayon=date('F d, Y');
        $branch=$_SESSION['selected_branch'];
        if($from=='') {
            echo "<h2> ".$_SESSION['selected_branch']." Uploaded Bales. as of: <u><b><i>".$ngayon."</i></b></u></h2>";
        }else {
            echo "<h2> ".$_SESSION['selected_branch']." Uploaded Bales. for the period  : <u><b><i>".$from." to ".$to."</i></b></u></h2>";
        }
        ?>
		<form action="delete_new_bales.php" method="post">
        <table class="data display datatable" id="example">
            <?php
            echo "<thead>";
            echo '<tr class="data">';
			//echo '<th class="data" width="20px">Select</th>';
            echo "<th class='data'>Bale ID</th>";
            echo "<th class='data'>STR</th>";
            echo "<th class='data'>Date Created</th>";
            echo "<th class='data'>Out Date</th>";
            echo "<th class='data'>WP Grade.</th>";
            echo "<th class='data'>Weight</th>";
            echo "<th class='data'>Action</th>";
            echo "</tr>";
            echo "</thead>";
            include("config.php");
            if($from=='') {
                $query="SELECT  * FROM bales where  branch like '%$branch%' and date like '%$month%'  and status !='rebaled' ";
            }else {
                $query="SELECT  * FROM bales where branch like '%$branch%' and date between '$from' and '$to'  and status !='rebaled' ";
            }
            $result=mysql_query($query);
            $total_weight=0;
			
            while($row = mysql_fetch_array($result)) {
				$actualDate = date('Y/m/d');
				$txtDate = date('F, Y',strtotime($actualDate));
				 $mydate = date('Y/m', strtotime("-2 month", strtotime($actualDate)));
				 $bale_date = date('Y/m', strtotime($row['date']));
                echo "<tr>";
				//echo '<td class="data">'.$row['log_id'].'</td>';
                echo "<td class='data'><input type='checkbox' name='chk[]' value=".$row['log_id'].">| " .$row['bale_id']."</td>";
                echo "<td class='data'>".$row['str_no']."</td>";
                echo "<td class='data'>".$row['date']."</td>";
                echo "<td class='data'>".$row['out_date']."</td>";
                echo "<td class='data'>".$row['wp_grade']."</td>";
                echo "<td class='data'>".$row['bale_weight']."</td>";
                if($row['str_no']=='0' || empty($row['str_no'])) {
                    echo "<td class='data'><a rel='facebox' href='editBale.php?bale_id=".$row['log_id']."'><button>Edit</button></a> <a target=new  href='deleteBaleVerification.php?bale_id=".$row['log_id']."'><input type='button' value='Rebale'></a>";
						if($bale_date <= $mydate && $row['str_no']=='0'){
							echo '  <a href="new_renewbales.php?id='.$row['log_id'].'" onclick="return confirm(\'Do you want to Proceed?\');"><input type="button" value="Renew For '.$txtDate.'"></a>';
					} 
					"</td>";
                } else {
                    echo "<td class='data'><button disabled>Edit</button></a><button disabled>Rebale</button></td>";
                }
                echo "</tr>";
                $total_weight+=$row['bale_weight'];
            }
            echo "<tr>";
            echo "<td id='total'>z_TOTAL_z</td>";
            echo "<td id='total'></td>";
            echo "<td id='total'></td>";
            echo "<td id='total'></td>";
            echo "<td id='total'></td>";
            echo "<td id='total'>$total_weight</td>";
            echo "<td id='total'></td>";
            echo "</tr>";
            echo "</table>";
            ?>
        </table>
		<br />
	<center> <input type="submit" onclick="return confirm('Do you want to Delete?');"" value="Delete Selected Bale/s"></center>
	<form>
    </div>
	<br />
</div>

<div class="grid_10">
    <div class="box round first grid">
        <?php
        $ngayon=date('F d, Y');
        $branch=$_SESSION['selected_branch'];
        if($from=='') {
            echo "<h2> ".$_SESSION['selected_branch']."  Rebales Record as of: <u><b><i>".$ngayon."</i></b></u></h2>";
        }else {
            echo "<h2> ".$_SESSION['selected_branch']."  Rebales Record  for the period: <u><b><i>".$from." to ".$to."</i></b></u></h2>";

        }
        ?>
        <table class="data display datatable" id="example">
            <?php
            echo "<thead>";
            echo '<tr class="data">';
            echo "<th class='data'>Bale ID</th>";
            echo "<th class='data'>STR</th>";
            echo "<th class='data'>Date Created</th>";
            echo "<th class='data'> Date Rebaled</th>";
            echo "<th class='data'>WP Grade.</th>";
            echo "<th class='data'>Weight</th>";

            echo "</thead>";
            if($from=='') {
                $query="SELECT * FROM bales where  branch like '%$branch%' and date like '%$month%'  and date_rebaled !='' ";
            }else {
                $query="SELECT * FROM bales where branch like '%$branch%' and date between '$from' and '$to'  and date_rebaled !='' ";

            }
            $result=mysql_query($query);
            $total_weight=0;
            while($row = mysql_fetch_array($result)) {
                echo "<tr>";
                echo "<td class='data'>".$row['bale_id']."</td>";
                echo "<td class='data'>".$row['str_no']."</td>";
                echo "<td class='data'>".$row['date']."</td>";
                echo "<td class='data'>".$row['date_rebaled']."</td>";
                echo "<td class='data'>".$row['wp_grade']."</td>";
                echo "<td class='data'>".$row['bale_weight']."</td>";

                echo "</tr>";

            }


            ?>

        </table>
    </div>
</div>
<div class="grid_10">
    <div class="box round first grid">
        <?php
        $ngayon=date('F d, Y');
        $branch=$_SESSION['selected_branch'];
        if($from=='') {
            echo "<h2> ".$_SESSION['selected_branch']." BM PERFORMANCE SUMMARY as of: <u><b><i>".$ngayon."</i></b></u></h2>";
        }else {
            echo "<h2> ".$_SESSION['selected_branch']." BM PERFORMANCE SUMMARY for the period: <u><b><i>".$from." to ".$to."</i></b></u></h2>";

        }
        ?>
        <table class="data display datatable" id="example">
            <?php
            $total_bales=0;
            $total_seconds=0;
            echo "<thead>";
            echo '<tr class="data">';

            echo "<th class='data'>WP GRADE</th>";
            echo "<th class='data'>Weight</th>";
            echo "<th class='data'>BALES</th>";
            echo "<th class='data'>AVG MIN/BALE (mm:ss)</th>";
            echo "<th class='data'>MT/HR</th>";
            echo "<th class='data'>AVG. WT/BALE</th>";

            echo "</tr>";

            echo "</thead>";
            include("config.php");

            if($from =='') {
                $query="SELECT bm_prod.wp_grade as bm_grade,sum(bm_prod.no_of_bales) as bm_count, sum(bales.bale_weight) as weight,sum(bm_prod.minutes) as minutes FROM bm_prod join bales on bales.wp_grade=bm_prod.wp_grade where bales.branch like '%$branch%'  and bm_prod.date like '%$month%'  and bales.status !='rebaled'  group by bales.wp_grade; ";
            }else {
                $query="SELECT bm_prod.wp_grade as bm_grade,sum(bm_prod.no_of_bales) as bm_count, sum(bales.bale_weight) as weight,sum(bm_prod.minutes) as minutes FROM bm_prod join bales on bales.wp_grade=bm_prod.wp_grade where bales.branch like '%$branch%'  and bm_prod.date between '$from' and '$to'   and bales.status !='rebaled'  group by bales.wp_grade; ";
            }
            mysql_query("SET SQL_BIG_SELECTS=1");
            $result=mysql_query($query);
            $sum_of_bales=0;
            $total_weight=0;
            $total_avg_wt_per_bale=0;
            $total_avg_min_per_bale=0;
            $total_ton_per_hour=0;
            $counter=0;

            while($row = mysql_fetch_array($result)) {
                if($from =='') {
                    $query2="SELECT minutes,no_of_bales FROM bm_prod where  branch like '%$branch%'  and wp_grade='".$row['bm_grade']."' and date like '%$month%' ";
                }else {
                    $query2="SELECT minutes,no_of_bales FROM bm_prod where  branch like '%$branch%'  and wp_grade='".$row['bm_grade']."' and date between '$from' and '$to'";
                }

                $result2=mysql_query($query2);
                $sum_minutes=0;
                $no_of_bales=0;

                while($row2 = mysql_fetch_array($result2)) {
                    $minute_per_grade=$row2['minutes'];
                    $minute_per_grade=preg_split('/[:]/',$minute_per_grade);
                    if($minute_per_grade[0]!='0') {
                        $minute_per_grade=($minute_per_grade[1]*60)+($minute_per_grade[0]*3600);
                    }else {
                        $minute_per_grade=($minute_per_grade[1]*60);
                    }
                    $sum_minutes+=$minute_per_grade;
                    $total_time+=$minute_per_grade;
                    $no_of_bales=$no_of_bales+$row2['no_of_bales'];

                }

                echo "<tr>";
                if($from=='') {
                    $query5="SELECT sum(bale_weight) from bales where wp_grade='".$row['bm_grade']."' and  branch like '%$branch%' and date like '%$month%'    group by wp_grade";

                }else {
                    $query5="SELECT sum(bale_weight) from bales where wp_grade='".$row['bm_grade']."' and  branch like '%$branch%' and date between '$from' and '$to'  group by wp_grade";

                }
                $result5=mysql_query($query5);
                $weight=0;
                if( $row5 = mysql_fetch_array($result5)) {
                    $weight=$row5['sum(bale_weight)'];
                }
                echo "<td class='data'>".$row['bm_grade']."</td>";

                echo "<td class='data'>".number_format($weight,2)."</td>";
                $total_weight+=$weight;
                echo "<td class='data'>".$no_of_bales."</td>";
                $total_bales+=$no_of_bales;

                $hours_per_grade=secondsToWords2($sum_minutes);


                $sum_of_bales=0;
                $total_seconds+=$sum_minutes;
                $average_minutes=($sum_minutes/$no_of_bales);

                $total_avg_min_per_bale=$total_avg_min_per_bale+$average_minutes;
                echo "<td>".sec_to_time($average_minutes)."</td>";


                $time_array=preg_split("/[:]/",$hours_per_grade);
                $hour=$time_array[0];
                $minutes=$time_array[1];
                $hours=$hour.".".$minutes;

                if($weight==0) {
                    $tonnage_per_hour=0;

                }else {
                    $tonnage_per_hour=(($weight/1000)/$hours);


                }
                $total_ton_per_hour+=$tonnage_per_hour;
                echo "<td>".number_format($tonnage_per_hour,2)."</td>";
                echo "<td>".number_format($weight/$no_of_bales,2)."</td>";
                $avg_wt_pe_bale=($weight/$no_of_bales);
                $total_avg_wt_per_bale+=$avg_wt_pe_bale;





                echo "</tr>";
                $counter++;


            }


            echo "<tr>";
            echo "<td id='total'>z_TOTAL_z</td>";
            echo "<td id='total'>".number_format($total_weight,2)."</td>";
            echo "<td id='total'>".$total_bales."</td>";
            echo "<td id='total'>".sec_to_time($total_avg_min_per_bale)."</td>";



            echo "<td id='total'>".number_format($total_ton_per_hour/ $counter,2)."</td>";
            echo "<td id='total'>".number_format($total_avg_wt_per_bale,2)."</td>";
            echo "</tr>";



            echo "</table>";


            ?>
        </table>
        <span id="summary_per">
            <h6>
                TONNAGE/HOUR:
                <?php
                $time_array=preg_split("/[:]/",$tonnage_per_hour_time);
                $hour=$time_array[0];
                $minutes=$time_array[1];
                $hours=$hour.".".$minutes;
                echo  number_format($total_weight_bales/$hours,2);
                ?>
                <br>
                MIN/BALE:
                <?php
                echo  number_format(($hours*60)/($total_bales),2);
                ?>
                <br>
                AVG. WT PER BALE:
                <?php
                echo  number_format($total_weight_bales/$total_bales,2);
                ?>
                <br>

            </h6>
        </span>

    </div>


    <?php

   // echo '<a rel="facebosx" href="delete_bales_authenticate.php"><button>Delete BM Prod </button></a>';
    echo '<a rel="facebosx" href="delete_bales_authenticate.php"><input type="button" value="Delete Bales"></a>';

    ?>

</div>








<div class="clear">

</div>

<div class="clear">

</div>