<?php
include('templates/template.php');



?>



<?php

if($_SESSION['usertype']=='Super User') {

    ?>

<div class="grid_10">

    <div class="box round first">

        <h2> <?php if($_SESSION['usertype']!='Super User') {



                } ?>Actual Sales Per Branch Vs Target for the Month of <?php echo $_SESSION['weekly_month'];?></h2>

        <div id="bar-chart">



            <iframe src="dist/graphs/outgoing_target_vs_actual.php" height="800" width="100%"></iframe>



        </div>

    </div>

</div>


<div class="grid_10">

    <div class="box round first">

        <h2> <?php if($_SESSION['usertype']!='Super User') {



                } ?>Actual Sales Per Branch <?php echo $_SESSION['weekly_month'];?></h2>

        <div id="pie-chart">
            <iframe src="dist/graphs/outgoing_deliveries_per_branch.php" height="400" width="100%"></iframe>

        </div>

    </div>

</div>

    <?php } ?>


<div class="clear">

</div>



<div class="clear">

</div>

