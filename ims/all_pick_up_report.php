<?php
include("templates/template.php");
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
    function date2(str){
        new JsDatePick({
            useMode:2,
            target:str,
            dateFormat:"%Y/%m"

        });
    };
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
<div class="grid_3">
    <div class="box round first">
        <h2>Filtering Options</h2>
        <form action="filter_pick_up.php" method="POST">
            Date: <input type='text'  id='outgoing_filterer' name='date' value="<?php echo $_SESSION['pick_up_date'];?>" onfocus='date2(this.id);' readonly size="8"><br>
            <input type="submit" value="Filter">
        </form>
        <a href="clear_filter_pickup.php"><button>Clear Filter</button></a>
    </div>
</div>
<div class="grid_10">
    <div class="box round first grid">
        <?php
        $ngayon=date('F d, Y');
        $branch=$_SESSION['pick_up_branch'];
        echo "<h2> CONSOLIDATED PICK UP DELIVERIES as of : <u><b><i>".$_SESSION['pick_up_date']."</i></b></u></h2>";
        ?>
        <table class="data display datatable" id="example">
            <?php
            echo "<thead>";
            echo '<tr class="data">';
            echo "<th class='data'>Date</th>";
            echo "<th class='data'>Supplier</th>";
            echo "<th class='data'>Truck Number</th>";
            echo "<th class='data'>WP Grade</th>";
            echo "<th class='data'>Estimated Weight</th>";
            echo "<th class='data'>Net Weight</th>";
            echo "<th class='data'>Variance</th>";
            echo "<th class='data'>% MC/Dirt</th>";
            echo "<th class='data'>Total MC/Dirt</th>";
            echo "<th class='data'>Corrected Weight</th>";
            echo "<th class='data'>Price</th>";

            echo "<th class='data'>Total Cost</th>";
            echo "<th class='data'>Remarks</th>";
            echo "<th class='data'>Branch</th>";
            echo "</tr>";
            echo "</thead>";
            include("config.php");
            $query="SELECT * from pick_up where  date like '%".$_SESSION['pick_up_date']."%' ";
            $result=mysql_query($query);
            $total_estimated_weight=0;
            $total_net_weight=0;
            $total_variance=0;
            $total_percentage=0;
            $total_mc_dirt=0;
            $total_corrected_weight=0;
            $total_price=0;
            $total_cost=0;
            while($row = mysql_fetch_array($result)) {
                echo "<tr>";
                echo "<td>".$row['date']."</td>";
                echo "<td>".$row['supplier_name']."</td>";
                echo "<td>".$row['truck_number']."</td>";
                echo "<td>".$row['wp_grade']."</td>";
                echo "<td>".number_format(($row['estimated_weight']*1),2)."</td>";
                echo "<td>".number_format($row['net_weight']*1,2)."</td>";
                echo "<td>".$row['variance']."</td>";

                echo "<td>".number_format($row['mc_percentage']*1,2)."</td>";
                echo "<td>".number_format($row['total_mc_dirt'],2)."</td>";
                echo "<td>".number_format($row['corrected_weight'],2)."</td>";
                echo "<td>".number_format($row['price'],2)."</td>";

                echo "<td>".number_format($row['total_cost'],2)."</td>";
                echo "<td>".$row['remarks']."</td>";
                echo "<td>".$row['branch']."</td>";
                echo "</tr>";

                $total_estimated_weight+=$row['estimated_weight'];
                $total_net_weight+=$row['net_weight'];
                $total_variance+=$row['variance'];
                $total_percentage+=$row['mc_percentage'];
                $total_mc_dirt+=$row['total_mc_dirt'];
                $total_corrected_weight+=$row['corrected_weight'];
                $total_price+=$row['price'];
                $total_cost+=$row['total_cost'];
            }



            echo "<tr>";
            echo "<td id='total'>z_TOTAL_z</td>";
            echo "<td id='total'></td>";
            echo "<td id='total'></td>";
            echo "<td id='total'></td>";
            echo "<td id='total'>".number_format($total_estimated_weight,2)."</td>";
            echo "<td id='total'>".number_format($total_net_weight,2)."</td>";
            echo "<td id='total'>".number_format($total_variance,2)."</td>";
            echo "<td id='total'>".number_format($total_percentage,2)."</td>";
            echo "<td id='total'>".number_format($total_mc_dirt,2)."</td>";
            echo "<td id='total'>".number_format($total_corrected_weight,2)."</td>";
            echo "<td id='total'>".number_format($total_price,2)."</td>";
            echo "<td id='total'>".number_format($total_cost,2)."</td>";
            echo "<td id='total'></td>";
            echo "<td id='total'></td>";
            echo "</tr>";
            ?>

        </table>

    </div>
</div>
<div class="clear">

</div>

<div class="clear">

</div>