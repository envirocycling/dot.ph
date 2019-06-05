<?php
include("templates/template.php");
?>
<style>
    #total{
        font-weight: bold;
        background-color: yellow;
    }
    #arrival {
        background-color: #85E0FF;
    }
    #start {
        background-color: #00B8E6;
    }
    #finish{
        font-weight:bold;
        background-color: yellow;
        <!-- background-color:#33CCCC; -->
    }
</style>
<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
    function date2(str){
        new JsDatePick({
            useMode:2,
            target:str,
            dateFormat:"%Y/%m/%d"

        });
    };
</script>

<div class="grid_3">
    <div class="box round first">
        <h2>Filtering Options</h2>
        <form action="filter_tat.php" method="POST">
            Date: <input type='text'  id='receiving_filterer' name='date' value="<?php echo $_SESSION['tat_date'];?>" onfocus='date2(this.id);' readonly size="8"><br>
            <input type="submit" value="Filter">
        </form>
        <a href="clear_filter_tat.php"><button>Clear Filter</button></a>
    </div>
</div>
<div class="grid_10">
    <div class="box round first grid">
        <?php
        $ngayon=date('F d, Y');
        $branch=$_SESSION['tat_branch'];
        if($branch=='all') {
            $branch='';
        }
        $total_receiving=0;
        echo "<h2> ".$_SESSION['tat_branch']." WP Receiving TAT as of : <u><b><i>".$_SESSION['tat_date']."</i></b></u></h2>";
        ?>
        <table class="data display datatable" id="example">
            <?php
            echo "<thead>";
            echo '<tr class="data">';
            echo "<th class='data'>Date</th>";
            echo "<th class='data'>Supplier Id</th>";
            echo "<th class='data'>Supplier Name</th>";
            echo "<th class='data'># of Grades</th>";
            echo "<th class='data'>Actual Weight</th>";
            echo "<th class='data'>Arrival</th>";
            echo "<th class='data'>Start</th>";
            echo "<th class='data'>Finish</th>";
            echo "<th class='data'>Queue Time</th>";
            echo "<th class='data'>Unloading Time</th>";
            echo "<th class='data'>Total Time</th>";

            echo "</tr>";
            echo "</thead>";
            include("config.php");
            $start_date = $_SESSION['tat_date'];
            $start_date = date("Y/m", strtotime($start_date));
            $start_date = $start_date."/01";
            $query="Select * from tat where branch like '%$branch%' and date >= '$start_date' and date <= '".$_SESSION['tat_date']."';";
            $result=mysql_query($query);
            $total_corrected_weight=0;

            while($row = mysql_fetch_array($result)) {
                echo "<tr>";
                echo "<td>".$row['date']."</td>";
                echo "<td>".$row['supplier_id']."</td>";
                $sql = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='".$row['supplier_id']."'");
                $rs=mysql_fetch_array($sql);
                echo "<td>".$rs['supplier_name']."</td>";
                echo "<td>".$row['no_of_grades']."</td>";
                echo "<td>".$row['actual_weight']."</td>";
                echo "<td id='arrival'>".$row['arrival']."</td>";
                echo "<td id='start'>".$row['start']."</td>";
                echo "<td id='finish'>".$row['finish']."</td>";
                echo "<td id='arrival'>".$row['queue_time']."</td>";
                echo "<td id='start'>".$row['unloading_time']."</td>";
                echo "<td id='total'>".$row['total_time']."</td>";




                echo "</tr>";

            }


            ?>



        </table>
        <?php
        echo "<a rel='facebox.php' href='frmDeleteTat.php?branch=$branch'><button>Delete Records</button></a>";
        ?>


    </div>
</div>
<div class="clear">

</div>

<div class="clear">

</div>