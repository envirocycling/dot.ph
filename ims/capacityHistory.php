<?php
include('config.php');
$id = $_GET['id'];
$wp_grade = $_GET['grade'];
?>
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
    #example{
        border-width:50%;
    }
</style>

<table class="data display datatable" id="example">
    <?php
    echo "<thead>";
    echo '<tr class="data">';

    echo "<th class='data'>Date</th>";
    echo "<th class='data'>Grades</th>";
    echo "<th class='data'>Capacity</th>";

    echo "<th class='data'>Delivers to</th>";
    echo "<th class='data'>Competitor Price</th>";
//    echo "<th class='data'>Tons were not getting</th>";
    echo "</tr>";

    echo "</thead>";
    include("config.php");

    $query="SELECT * FROM supplier_capacity where supplier_id='$id' and wp_grade like '%$wp_grade%' GROUP BY date_effective,delivers_to";
    $result=mysql_query($query);
    while($row = mysql_fetch_array($result)) {
        echo "<tr class='data'>";
        echo "<td class='data'>".$row['date_effective']."</td>";
        echo "<td class='data'>".$row['wp_grade']."</td>";
        echo "<td class='data'>".$row['capacity']."</td>";
        echo "<td class='data'>".$row['delivers_to']."</td>";
        echo "<td class='data'>".$row['competitor_price']."</td>";
//        echo "<td class='data'>".$row['potential_to_lose']."</td>";
        echo "</tr>";

    }

    ?>
</table>


