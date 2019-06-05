<?php

include("templates/template.php");
$date_now = date("Y/m/d");
include 'config.php';
if (isset ($_GET['del_id'])) {
    mysql_query("DELETE FROM paper_buying WHERE log_id='".$_GET['del_id']."'");
}
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

    $(window).load(function () {
        $(".editbox").hide();
        $("span").click(function() {
            var ID = $(this).attr('id');
            $("#value_" + ID).hide(500);
            $("#edit_" + ID).show(500);
            $("#weight_value_" + ID).hide(500);
            $("#weight_edit_" + ID).show(500);
        });
        $("button").click(function() {
            var ID = $(this).attr('id');
            var unit = Number($("#buying_" + ID).val());
            var unit2 = Number($("#buying2_" + ID).val());
            var weight = Number($("#corrected_weight_" + ID).val());
            var paper_buying = Number(unit * weight);
            $("#value_" + ID).html(unit);
            $("#weight_value_" + ID).html(weight);
            $("#paper_buying_" + ID).html(paper_buying);
            $("#edit_" + ID).hide(500);
            $("#value_" + ID).show(500);
            $("#weight_edit_" + ID).hide(500);
            $("#weight_value_" + ID).show(500);
            if (unit != unit2){
                var dataString = 'id=' + ID + '&unit_cost=' + unit + '&weight=' + weight;
                $.ajax({
                    type: "POST",
                    url: "edit_prices.php",
                    data: dataString,
                    cache: false
                });
            }
        });

    });

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

        <form action="filter_paper_buying.php" method="POST">

            Date: <input type='text'  id='receiving_filterer' name='date' value="<?php echo $_SESSION['paper_buying_date'];?>" onfocus='date2(this.id);' readonly size="8"><br>

            WP Grade:<input type="text" value="<?php echo $_SESSION['paper_buying_grade'];?>" name="wp_grade"><br>

            <input type="submit" value="Filter">

        </form>

        <a href="clear_filter_paper_buying.php"><button>Clear Filter</button></a>

    </div>

</div>

<div class="grid_10">

    <div class="box round first grid">

        <?php

        $ngayon=date('F d, Y');

        $total_cw = 0;

        $total_pp = 0;

        $branch=$_SESSION['paper_buying_branch'];

        if($branch=='all') {

            $branch='';

        }

        $total_receiving=0;

        echo "<h2> ".$_SESSION['paper_buying_branch']." Paper Buying as of : <u><b><i>".$_SESSION['paper_buying_date']."</i></b></u></h2>";



        ?>

        <table class="data display datatable" id="example">

            <?php
            echo "<thead>";
            echo '<tr class="data">';
            echo "<th class='data'>Date Received</th>";
            echo "<th class='data'>Priority</th>";
            echo "<th class='data'>Supplier ID</th>";
            echo "<th class='data'>Supplier Name</th>";
            echo "<th class='data'>Plate Number</th>";
            echo "<th class='data'>WP Grade</th>";
            echo "<th class='data'>Corrected Weight</th>";
            echo "<th class='data'>Buying Price</th>";
            echo "<th class='data'>Paper Buying</th>";
            echo "<th class='data'>Branch</th>";
            echo "<th class='data'>Notes</th>";
            echo "<th class='data'>Action</th>";
            echo "</tr>";
            echo "</thead>";
            include("config.php");

            $query="Select * from paper_buying  where branch like '%$branch%' and date_received like '%".$_SESSION['paper_buying_date']."%' and wp_grade like '%".$_SESSION['paper_buying_grade']."%'";

            $result=mysql_query($query);

            $total_corrected_weight=0;

            $total_add = 0;

            $total_amount = 0;

            $dateii = $_SESSION['paper_buying_date']."/01";

            $end_date = date("Y/m/t",strtotime($dateii));

            while($row = mysql_fetch_array($result)) {

                echo "<tr>";
                echo "<td>".$row['date_received']."</td>";
                echo "<td>".$row['priority_number']."</td>";
                echo "<td>".$row['supplier_id']."</td>";
                echo "<td>".$row['supplier_name']."</td>";
                echo "<td>".$row['plate_number']."</td>";
                echo "<td>".$row['wp_grade']."</td>";
                $total_cw+=$row['corrected_weight'];

                echo "<td><span id='" . $row['log_id'] . "' class='text'>
                          <div id='weight_value_" . $row['log_id'] . "'>".$row['corrected_weight']."</div></span>
                          <div id='weight_edit_" . $row['log_id'] . "' class='editbox'><input type='text' id='corrected_weight_".$row['log_id']."' name='corrected_weight_".$row['log_id']."' value='".$row['corrected_weight']."' size='8' readonly></div>
                          </td>";

                echo "<td><input type='hidden' id='buying2_" . $row['log_id'] . "' value='".$row['unit_cost']."' size='3'>
                            <span id='" . $row['log_id'] . "' class='text'>
                            <div id='value_" . $row['log_id'] . "'>".$row['unit_cost']."</div></span>
                            <div id='edit_" . $row['log_id'] . "' class='editbox'><input id='buying_" . $row['log_id'] . "' value='".$row['unit_cost']."' size='3'>
                            <button id='" . $row['log_id'] . "'>Save</button></div>
                            </td>";

                //$total_pp+=$row['paper_buying'];
                $new_paperbuying = $row['corrected_weight'] * $row['unit_cost'];
                
                $total_pp+=$new_paperbuying;

                echo "<td>
                            <div id='paper_buying_" . $row['log_id'] . "'>".$new_paperbuying."</div>
                    </td>";
                echo "<td>".$row['branch']."</td>";
                echo "<td>".$row['notes']."</td>";
                echo "<td>";
                if ($_SESSION['position'] == 'Inventory Controller' || $_SESSION['position'] == 'Programmer' || $_SESSION['position'] == 'Branch Head') {
                    ?>
            <a href="paper_buying_reports.php?del_id=<?php echo $row['log_id']; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><button>Delete</button></a>

                    <?php
                }
                echo "</td>";
                echo "</tr>";

            }

            echo "<tr id='total'>";
            echo "<td>!Total!</td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td>".number_format($total_cw,2)."</td>";
            echo "<td></td>";
            echo "<td>".number_format($total_pp,2)."</td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "</tr>";

            ?>
        </table>

        <?php
        echo "<a rel='facebox.php' href='frmDeletePaperBuying.php?branch=$branch'><button>Delete Records</button></a>";
        echo "<a rel='facebox.php' href='frmInputPaperBuying.php?branch=$branch'><button>Manual Input</button></a>";
        ?>





    </div>

</div>

<div class="clear">



</div>



<div class="clear">



</div>