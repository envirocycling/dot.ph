<?php
include('templates/template.php');
?>

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
<div class="grid_5">
    <div class="box round first">
        <h2>Filtering Options</h2>
        <form action="update_charts.php" method="POST">
            As of: <input type='text'  id='inputField' name='date' value="<?php echo $_SESSION['planning_as_of'];?>" onfocus='date1(this.id);' readonly><br>
           <input type="submit" value="Filter">
        </form>







    </div>
</div>
<div class="grid_10">

    <div class="box round first">



        </form><h2>Deliveries Per Branch for the month of: <?php echo date('F d, Y' ,strtotime($_SESSION['planning_as_of']));?></h2>
        <div id="bar-chart">
            <iframe src="dist/graphs/planning_pie_deliveries_per_branch.php" height="600" width="100%"></iframe>



        </div>

    </div>

</div>


<div class="grid_10">

    <div class="box round first">

        <h2> <?php if($_SESSION['usertype']!='Super User') {
            } ?>Branch Delivery Performance (Origin VS Destination Weight) for the month of:   <?php echo date('F d,Y' ,strtotime($_SESSION['planning_as_of']));?></h2>

        <div id="bar-chart">
            <iframe src="dist/graphs/planning_monthly_outgoing.php" height="600" width="100%"></iframe>
        </div>

    </div>

</div>

<div class="grid_10">

    <div class="box round first">

        <h2>
            Month To Date for the month of:   <?php echo date('F d,Y' ,strtotime($_SESSION['planning_as_of']));?></h2>

        <div id="bar-chart">
            <iframe src="planning_month_to_date.php" height="400" width="100%"></iframe>
        </div>

    </div>

</div>



<div class="grid_10">

    <div class="box round first">

        <h2>
            Daily Deliveries</h2>

        <div id="bar-chart">
            <iframe src="planning_daily.php" height="400" width="100%"></iframe>
        </div>

    </div>

</div>



<div class="clear">

</div>



<div class="clear">

</div>

