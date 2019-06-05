<?php session_start(); ?>
<script type='text/javascript' src='jquery-1.3.2.min.js'></script>
<link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
<script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
<script src="js/setup.js" type="text/javascript"></script>

<script type="text/javascript">

    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();


    });
</script>


<style>
    #type{
        background-color: gray;
        font-weight:bold;
        color:white;
    }
</style>

</head>






<table class="data display datatable" id="example">
    <?php


    include("config.php");
    $query="SELECT * FROM suppliers  ";
    $result=mysql_query($query);

    echo "<thead>";
    echo "<th class='data' >Supplier Type</th>";
    echo "<th class='data'>Supplier</th>";

    echo "<th class='data'>Contact</th>";
    echo "</thead>";


    while($row = mysql_fetch_array($result)) {

        echo "<tr class='data'>";
        echo "<td class='data' id='type'>" .$row['type']. "</td>";
        echo "<td class='data'>" .$row['supplier_name']. "</td>";

        echo "<td class='data'>" .$row['contact']. "</td>";

        echo "</tr>";


    }



    ?>
</table>





