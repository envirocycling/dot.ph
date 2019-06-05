<?php
include('config.php');
$id=$_GET['id'];
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



<?php
$ngayon=date('F d, Y');
echo "<h2>Supplier <u>$id</u>   Deliveries as of : <u><b><i>".$ngayon."</i></b></u></h2>";


?>
<table class="data display datatable" id="example">
    <?php
    echo "<thead>";
    echo '<tr class="data">';

    echo "<th class='data'>Deliver Date</th>";
    echo "<th class='data'>Branch Delivered</th>";

    echo "<th class='data'>WP Grade</th>";
    echo "<th class='data'>Weight</th>";
    echo "</tr>";

    echo "</thead>";
    include("config.php");



    $query="SELECT * FROM sup_deliveries where supplier_id='$id'   ";


    $result=mysql_query($query);
    while($row = mysql_fetch_array($result)) {
        echo "<tr class='data'>";
        echo "<td class='data'>".$row['date_delivered']."</td>";
        echo "<td class='data'>".$row['branch_delivered']."</td>";

        echo "<td class='data'>".$row['wp_grade']."</td>";

        echo "<td class='data'>".$row['weight']."</td>";
        echo "</tr>";

    }

    ?>
</table>


