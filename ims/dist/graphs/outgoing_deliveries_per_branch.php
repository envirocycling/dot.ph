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
$month = date ('Y/m');
        $grades_array=array();

        $values_array=array();





        $query="SELECT sum(weight), branch FROM actual where date like '%$month%' group by branch";

        $result=mysql_query($query);





        ?>





    <link class="include" rel="stylesheet" type="text/css" href="../jquery.jqplot.min.css" />

    <link rel="stylesheet" type="text/css" href="examples.min.css" />

    <link type="text/css" rel="stylesheet" href="syntaxhighlighter/styles/shCoreDefault.min.css" />

    <link type="text/css" rel="stylesheet" href="syntaxhighlighter/styles/shThemejqPlot.min.css" />



    <!--[if lt IE 9]><script language="javascript" type="text/javascript" src="../excanvas.js"></script><![endif]-->

    <script class="include" type="text/javascript" src="../jquery.min.js"></script>





    <div class="example-content">









        <div id="pie1" style="margin-top:20px; margin-left:20px; width:500px; height:300px;"></div>

        <script class="code" type="text/javascript">$(document).ready(function(){

            var plot1 = $.jqplot('pie1', [

                [<?php while($row = mysql_fetch_array($result)) {

        echo "['".$row['branch']."'," .$row['sum(weight)']  ."],";

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

                    marginTop: '55px'

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

}

?>





<br>









