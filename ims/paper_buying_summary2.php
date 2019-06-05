<?php
include("templates/template.php");
?><style>    table{        font-size:12.5px;    }    .total{        background-color: yellow;        font-weight: bold;    }    th{        width:500px;    }    #totalFooter{
        background-color: yellow;
        font-weight: bold;    }</style>
    <?php include("config.php");
    $wp_array=array();
    $supplier_array=array();
    $deliveries_per_month=array();
    $total_quota=0;
    $total_perf=0;
    ?>

    <style>
    th{
        font-size: 12px;
        background-color:gray;
        color:white;
    }
    button{
        border-style:hidden;
        background-color:transparent;
        font-size: 11px;
    }
    #weekly{
        background-color:#FFE6B2;
    }
    #TARGET{
        background-color:#FFEBC2;
        font-weight:bold;
    }
    #percentage{
        background-color:#FFF0D1;

    }
    td{
        background-color:#FFF5E0;
        font-size:12px;
        text-align:right;
    }
    #left_header{
        background-color:#FFFAF0;
        font-size: 10px;
        text-align:left;
    }
    #view_brkdwn{
        font-size: 11px;
    }
    #static_size{
        width:200px;
        height:50px;

    }
    #price{
        background-color:#EBE0CC;
    }

</style>


<?php
$ngayon=date('F d, Y');
$start_date=$_POST['start_date'];
$breaker_date=$_POST['end_date'];

$filtering_branch=$_POST['branch'];
$weekly_month=date("F", strtotime($breaker_date));
$weekly_year=date("Y", strtotime($breaker_date));

?>




<div class="grid_8" >
    <div class="box round first grid">


        <h2><?php


            echo "<h2>Paper Buying Summary for the period <u>$start_date to $breaker_date</u> in MT on all grades</h2>";
            include("config.php");
            ?>
            <?php
            include("config.php");
            $filtering_grade_array=array("lcwl","onp","cbs","occ","mw","chipboard");
            foreach($filtering_grade_array as $filtering_grade) {
                ?>

            <h5><?php echo "<u><i>".$filtering_grade ."</i></u>";?></h5>



            <table >
                    <?php
                    
                    $query="SELECT (unit_cost) as unit_cost,sum(corrected_weight) FROM paper_buying where wp_grade like '%$filtering_grade%' and date_received >='$start_date' and date_received <='$breaker_date'  and unit_cost >0 group by unit_cost order by sum(corrected_weight) desc";
                    $result=mysql_query($query);
                    echo "<thead>";
                    echo "<th>Price</th>";
                    echo "<th>Tonnage</th>";
                    echo "</thead>";
                    $total_tonnage=0;
                    while($row = mysql_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td left_header>".number_format(trim($row['unit_cost']),2)."</td>";
                        echo "<td>".number_format(($row['sum(corrected_weight)']/1000),2)."</td>";
                        $total_tonnage+=($row['sum(corrected_weight)']/1000);
                        echo "</tr>";

                    }

                    echo "<tr>";
                    echo "<td id='TOTAL'>TOTAL</td>";
                    echo "<td id='TOTAL'>".number_format(($total_tonnage),2)."</td>";
                    echo "</tr>";


                    ?>

            </table>


                <?php echo "<hr>";
            }?>
    </div>
</div>



<div class="clear">

</div>

<div class="clear">

</div>
<div class="clear">

</div>

