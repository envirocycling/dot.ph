<?php

include('templates/template.php');

include 'config.php';

?>
<link href='notifCss/sNotify.css' rel='stylesheet' type='text/css' />


<?php

if($_SESSION['usertype']=='Super User') {

    ?>

<div class="grid_10">

    <div class="box round first">

        <h2> <?php if($_SESSION['usertype']!='Super User') {



                } ?>Overall Monthly Performance For The Year <?php echo date('Y');?></h2>

        <div id="bar-chart">



            <iframe src="dist/graphs/overall_per_month_performance.php" height="400" width="100%"></iframe>



        </div>

    </div>

</div>

    <?php } ?>



<div class="grid_10">

    <div class="box round first">

        <h2> <?php if($_SESSION['usertype']!='Super User') {

                echo $_SESSION['user_branch']." ";

            } ?>Overall WP Grade Receiving For The Month of <?php echo date('F');?></h2>

        <div id="bar-chart">

            <?php

            if($_SESSION['usertype']=='Super User') {

                echo '<iframe src="dist/graphs/overall_wp_grade.php" height="400" width="100%"></iframe>';

            }else {

                echo '<iframe src="dist/graphs/restricted_overall_wp_grade.php" height="400" width="100%"></iframe>';



            }

            ?>

        </div>

    </div>

</div>


<div class="grid_10">

    <div class="box round">

        <?php

        if($_SESSION['usertype']!='Super User') {



            echo '<h2>'. $_SESSION['user_branch'].' monthly performance for the year  '.date("Y").'</h2>';

        }else {

            echo '<h2>Branches performance for the month of '.date("F").'</h2>';

        }





        ?>





        <div class="block">

            <div id="points-chart">

                <?php

                if($_SESSION['usertype']=='Super User') {

                    echo '<iframe src="dist/graphs/branch_performance.php" height="400" width="100%"></iframe>';

                }else {

                    echo '<iframe src="dist/graphs/restricted_branch_performance.php" height="400" width="100%"></iframe>';



                }

                ?>

            </div>

        </div>

    </div>

</div>







<div class="grid_5">

    <div class="box round">

        <h2> <?php if($_SESSION['usertype']!='Super User') {

                echo $_SESSION['user_branch']." ";

            } ?>WP Receiving Percentage For The Month of <?php echo date('F');?></h2>

        <div id="donuts-chart">

            <iframe src="dist/graphs/pie_grades_receiving.php" height="350" width="100%"></iframe>

        </div>

    </div>

</div>





<div class="grid_5">

    <div class="box round">

        <?php

        if($_SESSION['usertype']!='Super User') {



            echo '<h2>'. $_SESSION['user_branch'].' monthly performance percentage for the year  '.date("Y").'</h2>';

        }else {

            echo '<h2>Branch Receiving Percentage For The Month of  '.date("F").'</h2>';

        }

        ?>



        <div id="bubble-chart">

            <iframe src="dist/graphs/pie_branch_receiving.php" height="350" width="100%"></iframe>

        </div>

    </div>

</div>
<?php
$bh_to_verified = $_SESSION['initial'];

$sql = mysql_query("SELECT * FROM sup_transfer WHERE confirm='0' and bh_to_verified='$bh_to_verified'");
$count = mysql_num_rows($sql);
if ($count > 0) {
    
    echo "<script>
		sNotify.addToQueue('There are <u>$count</u> transfer of  supplier/s you need to verified. Please go to Transfer of Suppliers to Confirm');
	</script>";
}


$sql = mysql_query("SELECT * FROM supplier_details WHERE verified='0' and bh_to_verified='$bh_to_verified'");
$count = mysql_num_rows($sql);
if ($count > 0) {
    echo "<script>
		sNotify.addToQueue('There are <u>$count</u> new supplier/s you need to verified. Please go to Pending Suppliers to Confirm');
            </script>";
}
?>

<div class="clear">

</div>



<div class="clear">

</div>

<div class="clear">

</div>