<?php
include('templates/template.php');
?>
<div class="grid_5">
    <div class="box round first">
        <h2>Filtering Options</h2>
        <form action="update_charts.php" method="POST">
            <h3>Select Month and Year</h3><hr>
            <?php
            $months=1;


            echo "Month: <select name='month' value=''>";
            echo "<option>".date('m')."</option>";
            while($months <=12) {
                if($months < 10) {
                    echo "<option>"."0".$months."</option>";
                }else {
                    echo "<option>".$months."</option>";
                }
                $months++;
            }
            echo "</select>";

            echo "Year: <select name='year' value=''>";
            $year=date('Y');
            $year_start=$year-10;
            $year_end=$year+10;
            echo "<option>".date('Y')."</option>";
            while($year_start <=$year_end) {
                echo "<option>$year_start</option>";
                $year_start++;
            }
            echo "</select>";
            ?>
            <input type="Submit" value="Update Charts">
            </div>
            </div>
            <div class="grid_10">

                <div class="box round first">

                    <h2>Deliveries Per Branch for the month of: <?php echo date('Y/m/d' ,strtotime($_SESSION['planning_month']."/01"));?></h2>


                    </form>
                    <div id="bar-chart">
                        <iframe src="dist/graphs/planning_pie_deliveries_per_branch.php" height="600" width="100%"></iframe>



                    </div>

                </div>

            </div>


            <div class="grid_10">

                <div class="box round first">

                    <h2> <?php if($_SESSION['usertype']!='Super User') {
                        } ?>Branch Delivery Performance (Origin VS Destination Weight) for the month of:  <?php echo date('F' ,strtotime($_SESSION['planning_month']."/01"));?></h2>

                    <div id="bar-chart">
                        <iframe src="dist/graphs/planning_monthly_outgoing.php" height="600" width="100%"></iframe>
                    </div>

                </div>

            </div>

            <div class="grid_10">

                <div class="box round first">

                    <h2>
                        Month To Date for the month of:  <?php echo date('F' ,strtotime($_SESSION['planning_month']."/01"));?></h2>

                    <div id="bar-chart">
                        <iframe src="planning_month_to_date.php" height="400" width="100%"></iframe>
                    </div>

                </div>

            </div>



            <div class="clear">

            </div>



            <div class="clear">

            </div>

