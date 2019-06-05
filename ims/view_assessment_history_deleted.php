<?php
@session_start();
include('config.php');

$sql_sup = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='" . $_GET['sup_id'] . "'");
$rs_sup = mysql_fetch_array($sql_sup);
if (isset($_GET['del_id'])) {
    mysql_query("DELETE FROM supplier_assessment WHERE log_id='" . $_GET['del_id'] . "'");
}
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
    $(document).ready(function() {
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
<script type="text/javascript">
    function change(str) {
        var splits = str.split("_");
        document.getElementById("class").value = splits[1];
    }
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
<center>
    <?php
    echo "<h2>" . $rs_sup['supplier_name'] . " Suspplier Deleted Assessment</h2>";

    if (isset ($_GET['edit'])) {
        $que = preg_split("[_]",$_GET['sup_id']);
        echo "<form action='view_assessment_history.php' method='POST'>";
        echo "<input type='hidden' name='sup_id' value='$que[0]'>";
        echo "<input type='hidden' name='wp_grade' value='$que[1]'>";
        echo "<h6>Input New Capacity: <input type='text' name='capacity' value=''></h6>";
        echo "<h6>Date Effective: <input type='text'  id='inputField' name='date_effective' value='".date('Y/m/d')."' onfocus='date1(this.id);' readonly></h6><br>";
        echo "<input type='submit' name='update' value='Update'>";
        echo "</form>";
    }

    ?>

    <table width="600">
        <tr><td>
                <table class="data display datatable" id="example">
                    <?php
                    echo "<thead>";
                    echo '<tr class="data">';
                    echo "<th class='data'>WP Grade</th>";
                    echo "<th class='data'>Delivers To</th>";
                    echo "<th class='data'>Type</th>";
                    echo "<th class='data'>Volume</th>";
                    echo "<th class='data'>Action</th>";
                    echo "</tr>";
                    echo "</thead>";
                    include("config.php");

                    $query = "SELECT * FROM supplier_assessment where supplier_id='".$_GET['sup_id']."' and status='deleted'";

                    $result = mysql_query($query);
                    while ($row = mysql_fetch_array($result)) {
                        echo "<tr class='data'>";
                        echo "<td class='data'>" . $row['wp_grade'] . "</td>";
                        $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='".$row['deliver_to']."'");
                        $rs_sup = mysql_fetch_array($sql_sup);
                        echo "<td class='data'>" . $rs_sup['supplier_name'] . "</td>";
                        echo "<td class='data'>" . $row['type'] . "</td>";
                        echo "<td class='data'>" . $row['volume'] . "</td>";
                        echo "<td class='data'><a href='view_assessment_history.php?del_id=" . $row['log_id'] . "&sup_id=".$_GET['sup_id']."'><button>Delete</button></a></td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </td>
        </tr>
    </table>
    <a href="view_assessment_history.php?sup_id=<?php echo $_GET['sup_id']; ?>"><button>Back</button></a>
    <br><br>
</center>
