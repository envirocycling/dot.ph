<?php session_start(); ?>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<script src="../../js/jquery-1.6.4.min.js" type="text/javascript"></script>
<script src="../../js/setup.js" type="text/javascript"></script>
<link href="../../src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="../../src/facebox.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('a[rel*=facebox]').facebox({
            loadingImage : 'src/loading.gif',
            closeImage   : 'src/closelabel.png'
        })
    })
</script>
<?php include("../../config.php"); ?>

<link class="include" rel="stylesheet" type="text/css" href="../jquery.jqplot.min.css" />

<style>

    #legend{
        float:right;
    }
    #tipco{
        background-color:yellow;
        color:white;

    }
    #competitor{
        background-color:red;
        color:white;

    }

    #competitor2{
        background-color:green;
        color:white;

    }
</style>
<script class="include" type="text/javascript" src="../jquery.min.js"></script>

<script>

    $(document).ready(function () {
<?php
$tipco=array();
$competitor=array();
$competitor2=array();
$sales=array();

$query="SELECT month,tipco_price,competitor_price,total_sales,competitor2_price from pricing_with_competitors where grade_id='".$_GET['grade']."' and year='".$_SESSION['weekly_year']."'";
$result=mysql_query($query);

while($row = mysql_fetch_array($result)) {
    array_push($tipco,"[".$row['month'].",".$row['tipco_price']."]");
    array_push($competitor,"[".$row['month'].",".$row['competitor_price']."]");
    array_push($competitor2,"[".$row['month'].",".$row['competitor2_price']."]");
    array_push($sales,"[".$row['month'].",".$row['total_sales']."]");

}

?>
        var s1 = [
<?php
foreach($tipco as $value) {
    echo $value.",";

}
?>

        ];

        var s2 = [<?php
foreach($sales as $value) {
    echo $value.",";

}
?>];
            var s3 = [

<?php
foreach($competitor as $value) {
    echo $value.",";

}
?>

            ];

            var s4 = [

<?php
foreach($competitor2 as $value) {
    echo $value.",";

}
?>

            ];
            plot1 = $.jqplot("chart1", [s2, s3,s1,s4], {
                seriesDefaults:{
                },


                seriesColors: ['blue','red','green','yellow'],
                highlighter: { show: false },
                animate: true,

                animateReplot: true,
                cursor: {
                    show: true,
                    zoom: true,
                    looseZoom: true,
                    showTooltip: false
                },

                series:[

                    {
                        pointLabels: {
                            show: true

                        },
                        renderer: $.jqplot.BarRenderer,
                        showHighlight: false,
                        yaxis: 'y2axis',

                        rendererOptions: {

                            animation: {
                                speed: 4000
                            },
                            barWidth: 15,
                            barPadding: -15,
                            barMargin: 0,
                            highlightMouseOver: false
                        }
                    },
                    {
                        rendererOptions: {

                            animation: {
                                speed: 5000
                            }
                        }
                    }


                ],
                axesDefaults: {
                    pad: 0
                },
                axes: {
                    // These options will set up the x axis like a category axis.
                    xaxis: {

                        tickInterval: 1,
                        drawMajorGridlines: false,
                        label:'Months',

                        drawMinorGridlines: true,
                        drawMajorTickMarks: false,

                        rendererOptions: {
                            tickInset: 0.5,
                            minorTicks: 1,
                            tickOptions: {

                                formatString: "%'  .2f"


                            },
                            rendererOptions: {
                                forceTickAt0: true
                            }

                        }

                    },


                    x2axis: {

                        tickInterval: 1,
                        drawMajorGridlines: false,
                        label:'aw',

                        drawMinorGridlines: true,
                        drawMajorTickMarks: false,
                        rendererOptions: {
                            tickInset: 0.5,
                            minorTicks: 1,
                            tickOptions: {

                                formatString: "%' d"


                            },
                            rendererOptions: {
                                forceTickAt0: true
                            }

                        }
                    },
                    yaxis: {

                        label:'Price',
                        tickOptions: {


                        },
                        rendererOptions: {
                            forceTickAt0: true
                        }
                    },


                    y2axis: {
                        label:'&nbsp; Sales',
                        tickOptions: {
                            formatString: "%' .2f"
                        },
                        rendererOptions: {
                            // align the ticks on the y2 axis with the y axis.
                            alignTicks: true,
                            forceTickAt0: true
                        }
                    }
                },
                highlighter: {
                    show: true,
                    showLabel: true,
                    tooltipAxes: 'y',
                    sizeAdjust: 7.5 , tooltipLocation : 'ne'
                }


            });


        });


</script>


<script class="include" type="text/javascript" src="../jquery.jqplot.min.js"></script>

<script class="include" type="text/javascript" src="../plugins/jqplot.barRenderer.min.js"></script>

<script type="text/javascript" src="../plugins/jqplot.cursor.min.js"></script>


<div id="chart1" style=""></div>
<form action='../../weekly_filter.php' method='POST'>
    Year: <select name="weekly_year" onchange='this.form.submit()'>
        <option value="<?php echo $_SESSION['weekly_year'];?>"><?php echo $_SESSION['weekly_year'];?></option>
        <option value="2011">2011</option>
        <option value="2012">2012</option>
        <option value="2013">2013</option>
        <option value="2014">2014</option>
        <option value="2015">2015</option>
        <option value="2016">2016</option>
        <option value="2017">2017</option>
        <option value="2018">2018</option>
        <option value="2019">2019</option>
        <option value="2020">2020</option>


    </select>
</form>
<input type="button" value="Reset ZOOM" onClick="window.location.reload()"> <br><br>
<span id="legend">
    <h3><i>LEGEND</i></h3>
    <table border="1">
        <tr>
            <td id="tipco">TIPCO</td>

        </tr>

        <tr>
            <td id="competitor">Competitor1</td>

        </tr>

        <tr>
            <td id="competitor2">Competitor2</td>

        </tr>
    </table>
</span>

<span id="pricing_data">
    <?php


    $query="SELECT month,tipco_price,competitor_price,effect_date,total_sales ,competitor2_price,remarks  from pricing_with_competitors where grade_id='".$_GET['grade']."' and year='".$_SESSION['weekly_year']."' ";
    $result=mysql_query($query);


    $query2="SELECT effect_date from pricing_with_competitors where grade_id='".$_GET['grade']."'  order by change_log_id desc limit 1";
    $result2=mysql_query($query2);
    $row2 = mysql_fetch_array($result2);

    echo "<h4>Last price update: <i><u>".$row2['effect_date']."</u></i></h4>";

    echo "<table border='1'>";
    echo "<th>Effectivity Date</th>";
    echo "<th>TIPCO PRICE (Php)</th>";
    echo "<th>COMPETITOR 1's PRICE (Php)</th>";
    echo "<th>COMPETITOR 2's PRICE (Php)</th>";
    echo "<th>SALES (MT)</th>";
    echo "<th>Remarks</th>";
    echo "<th>ACTION</th>";

    while($row = mysql_fetch_array($result)) {
        echo "<tr>";
        $date=$row['effect_date'];
        $newDate = date("F d, Y", strtotime($date));
        echo "<td>".$newDate."</td>";
        echo "<td>".$row['tipco_price']."</td>";
        echo "<td>".$row['competitor_price']."</td>";
        echo "<td>".$row['competitor2_price']."</td>";
        echo "<td>".$row['total_sales']."</td>";
        echo "<td>".$row['remarks']."</td>";
        echo "<td><a rel='facebox' href='../../price_change_history.php?grade=".$_GET['grade']." & month=".$row['month']."'><button>Price History</button></a></td>";
        echo "</tr>";
        ;

    }
    if($_SESSION['usertype']=='Super User') {
        echo "<a rel='facebox' href='../../whole_year_price_history.php?grade=".$_GET['grade']."'><button>Overall Price History</button></a>";
        echo "<a rel='facebox' href='../../updatePrice.php?grade=".$_GET['grade']."'><button>Update Price</button></a>";
    }
    ?>
</span>
