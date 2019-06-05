<script type='text/javascript' src='jquery-1.3.2.min.js'></script>
<link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
<script src="js_2/jquery-1.6.4.min.js" type="text/javascript"></script>
<!--<script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>-->
<script src="js_2/setup.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>

<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
    function date1(str){
        new JsDatePick({
            useMode:2,
            target:str,
            dateFormat:"%Y/%m/%d"
        });
    };

</script>
<script src="js_2/jquery-1.6.4.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js_2/jquery-ui/jquery.ui.core.min.js"></script>
<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="src/facebox.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('a[rel*=facebox]').facebox({
            loadingImage : 'src/loading.gif',
            closeImage   : 'src/closelabel.png'
        })
    })

</script>


    <?php
    include("config.php");
    $branch=$_GET['parameter'];
    echo "<h2>$branch Competitors Price Update History</h2>";
    $query40=" select * from pricing_against_competitors where branch_affected='$branch' and company_type='competitor' and approved_status='approved'" ;
    $result40=mysql_query($query40);
    echo '<table class="data display datatable" id="example">';
    echo "<thead>";
    echo "<th>Log ID</th>";
    echo "<th>Competitor</th>";
    echo "<th>WP Grade</th>";

    echo "<th>STD. Price</th>";
    echo "<th>MAX. Price</th>";
    echo "<th>Date Effective</th>";
    echo "<th>Updated By</th>";
    echo "<th>Source</th>";
    echo "<th>Verified By</th>";
    echo "<th>Approved By</th>";
    echo "</thead>";
    while($row = mysql_fetch_array($result40)) {
        echo "<tr>";
        echo "<td>".$row['log_id']."</td>";
        echo "<td>".$row['company']."</td>";
        echo "<td>".$row['wp_grade']."</td>";
        echo "<td>".$row['price']."</td>";
        echo "<td>".$row['max_price']."</td>";
        echo "<td>".$row['date']."</td>";
        echo "<td>".$row['updated_by']."</td>";
        echo "<td>".$row['source']."</td>";
        echo "<td>".$row['verified_by']."</td>";
        echo "<td>".$row['approved_by']."</td>";
        echo "</tr>";

    }

    echo "</table>";
    ?>