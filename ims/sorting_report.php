<?php
include("templates/template.php");
?>

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
    #total{
        font-weight: bold;
        background-color: yellow;
    }
</style>
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
        <form action="filter_sorting_prod.php" method="POST">
            Date: <input type='text'  id='outgoing_filterer' name='date' value="<?php echo $_SESSION['sorting_date'];?>" onfocus='date2(this.id);' readonly size="8"><br>
            <input type="submit" value="Filter">
        </form>
        <a href="clear_filter_sorting.php"><button>Clear Filter</button></a>
    </div>
</div>
<div class="grid_10">
    <div class="box round first grid">
        <?php
        $ngayon=date('F d, Y');
        $branch=$_SESSION['sorting_branch'];
        echo "<h2> ".$_SESSION['sorting_branch']." SORTING PRODUCTION as of : <u><b><i>".$_SESSION['sorting_date']."</i></b></u></h2>";
        ?>
        <table class="data display datatable" id="example">
            <?php
            echo "<thead>";
            echo '<tr class="data">';
            echo "<th class='data'>Date</th>";
            echo "<th class='data'>WP Grade</th>";
            echo "<th class='data'>Weight</th>";

            echo "<th class='data'>Remarks</th>";
            echo "<th class='data'>Branch</th>";

            echo "</tr>";
            echo "</thead>";
            include("config.php");
            $query="SELECT * from sorting_prod where branch='$branch' and date like '%".$_SESSION['sorting_date']."%' ";
            $result=mysql_query($query);
            $total_weight=0;
            while($row = mysql_fetch_array($result)) {
                echo "<tr>";
                echo "<td>".$row['date']."</td>";
                echo "<td>".$row['wp_grade']."</td>";
                echo "<td>".$row['weight']."</td>";
                echo "<td>".$row['remarks']."</td>";
                echo "<td>".$row['branch']."</td>";

                echo "</tr>";


                $total_weight+=$row['weight'];
            }

            echo "<tr>";
            echo "<td id='total'>z_TOTAL_z</td>";
            echo "<td id='total'></td>";
            echo "<td id='total'>".number_format($total_weight,2)."</td>";
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