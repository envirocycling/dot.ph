<?php
session_start();
if($_SESSION['usertype']=='Super User') {
    ?>
<style>
    #body{
        margin-left:100px;
    }
</style>
<div id="body">
        <?php
        include("../../config.php");
        $grades_array=array();
        $values_array=array();


        $query="SELECT sum(weight),branch_delivered FROM sup_deliveries where month_delivered='".$_SESSION['weekly_month']."' and year_delivered='".$_SESSION['weekly_year']."'  group by branch_delivered";
        $result=mysql_query($query);


        ?>


    <link class="include" rel="stylesheet" type="text/css" href="../jquery.jqplot.min.css" />
    <link rel="stylesheet" type="text/css" href="examples.min.css" />
    <link type="text/css" rel="stylesheet" href="syntaxhighlighter/styles/shCoreDefault.min.css" />
    <link type="text/css" rel="stylesheet" href="syntaxhighlighter/styles/shThemejqPlot.min.css" />

    <!--[if lt IE 9]><script language="javascript" type="text/javascript" src="../excanvas.js"></script><![endif]-->
    <script class="include" type="text/javascript" src="../jquery.min.js"></script>


    <div class="example-content">




        <div id="pie1" style="margin-top:20px; margin-left:20px; width:200px; height:200px;"></div>






        <script class="code" type="text/javascript">$(document).ready(function(){
            var plot1 = $.jqplot('pie1', [
                [<?php while($row = mysql_fetch_array($result)) {
        echo "['".$row['branch_delivered']."'," .$row['sum(weight)']  ."],";
    }?>]], {


                gridPadding: {top:0, bottom:38, left:0, right:0},
                seriesDefaults:{
                    renderer:$.jqplot.PieRenderer,
                    trendline:{ show:false },
                    rendererOptions: { padding: 8, showDataLabels: true }
                },
                legend:{
                    show:true,
                    placement: 'outside',
                    rendererOptions: {
                        numberRows: 1
                    },
                    location:'s',
                    marginTop: '15px'
                }
            });
        });</script>


        <script class="include" type="text/javascript" src="../jquery.jqplot.min.js"></script>
        <script type="text/javascript" src="syntaxhighlighter/scripts/shCore.min.js"></script>
        <script type="text/javascript" src="syntaxhighlighter/scripts/shBrushJScript.min.js"></script>
        <script type="text/javascript" src="syntaxhighlighter/scripts/shBrushXml.min.js"></script>
        <!-- End Don't touch this! -->

        <!-- Additional plugins go here -->

        <script class="include" type="text/javascript" src="../plugins/jqplot.pieRenderer.min.js"></script>

        <!-- End additional plugins -->


    </div>


</div>
    <?php
    echo "<form action='../../weekly_filter.php' method='POST'>";

    ?>
Month: <select name="weekly_month" onchange='this.form.submit()'>
    <option value="<?php echo $_SESSION['weekly_month'];?>"><?php echo $_SESSION['weekly_month'];?></option>
    <option value="January">January</option>
    <option value="February">February</option>
    <option value="March">March</option>
    <option value="April">April</option>
    <option value="May">May</option>
    <option value="June">June</option>
    <option value="July">July</option>
    <option value="August">August</option>
    <option value="September">September</option>
    <option value="October">October</option>
    <option value="November">November</option>
    <option value="December">December</option>

</select>


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


    <?php
    echo "</form><br>";



    ?>
    <?php
}else {
    ?>

<style>
    #body{
        margin-left:100px;
    }
</style>
<div id="body">
        <?php
        include("../../config.php");
        $grades_array=array();
        $values_array=array();


        $query="SELECT sum(weight),month_delivered FROM sup_deliveries where   year_delivered='".$_SESSION['weekly_year']."'  and branch_delivered='".$_SESSION['user_branch']."' group by month_delivered order by del_id asc";
        $result=mysql_query($query);


        ?>


    <link class="include" rel="stylesheet" type="text/css" href="../jquery.jqplot.min.css" />
    <link rel="stylesheet" type="text/css" href="examples.min.css" />
    <link type="text/css" rel="stylesheet" href="syntaxhighlighter/styles/shCoreDefault.min.css" />
    <link type="text/css" rel="stylesheet" href="syntaxhighlighter/styles/shThemejqPlot.min.css" />

    <!--[if lt IE 9]><script language="javascript" type="text/javascript" src="../excanvas.js"></script><![endif]-->
    <script class="include" type="text/javascript" src="../jquery.min.js"></script>


    <div class="example-content">




        <div id="pie1" style="margin-top:20px; margin-left:20px; width:200px; height:200px;"></div>






        <script class="code" type="text/javascript">$(document).ready(function(){
            var plot1 = $.jqplot('pie1', [
                [<?php while($row = mysql_fetch_array($result)) {
        echo "['".$row['month_delivered']."'," .$row['sum(weight)']  ."],";
    }?>]], {


                gridPadding: {top:0, bottom:38, left:0, right:0},
                seriesDefaults:{
                    renderer:$.jqplot.PieRenderer,
                    trendline:{ show:false },
                    rendererOptions: { padding: 8, showDataLabels: true }
                },
                legend:{
                    show:true,
                    placement: 'outside',
                    rendererOptions: {
                        numberRows: 1
                    },
                    location:'s',
                    marginTop: '15px'
                }
            });
        });</script>


        <script class="include" type="text/javascript" src="../jquery.jqplot.min.js"></script>
        <script type="text/javascript" src="syntaxhighlighter/scripts/shCore.min.js"></script>
        <script type="text/javascript" src="syntaxhighlighter/scripts/shBrushJScript.min.js"></script>
        <script type="text/javascript" src="syntaxhighlighter/scripts/shBrushXml.min.js"></script>
        <!-- End Don't touch this! -->

        <!-- Additional plugins go here -->

        <script class="include" type="text/javascript" src="../plugins/jqplot.pieRenderer.min.js"></script>

        <!-- End additional plugins -->


    </div>


</div>
    <?php
    echo "<form action='../../weekly_filter.php' method='POST'>";

    ?>



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


    <?php
    echo "</form><br>";



    ?>
    <?php } ?>


<br>




