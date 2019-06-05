<?php
@session_start();
include('config.php');
$id = $_GET['sup_id'];
$sql_sup = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='" . $_GET['sup_id'] . "'");
$rs_sup = mysql_fetch_array($sql_sup);
if (isset($_GET['del_id'])) {
    mysql_query("UPDATE supplier_assessment SET status='deleted' WHERE log_id='" . $_GET['del_id'] . "'");
}
if (isset ($_POST['edit_grade'])) {
    mysql_query("UPDATE supplier_assessment SET wp_grade='".$_POST['wp_grade']."',price='".$_POST['price']."' WHERE log_id='".$_POST['log_id']."'");
    echo "<script>";
    echo "alert('Update Successfully');";
    echo "location.replace('view_assessment_history.php?sup_id=".$_POST['sup_id']."');";
    echo "</script>";
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
    echo "<h2>" . $rs_sup['supplier_name'] . " Suspplier Assessment</h2>";
    if (isset ($_GET['assess_id'])) {
        echo "<br>";
        echo "<br>";
        echo "<h5>Edit Assessment</h5>";
        $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='".$_GET['assess_sup']."'");
        $rs_sup = mysql_fetch_array($sql_sup);
        $que = preg_split("[_]",$_GET['sup_id']);
        echo "<form action='view_assessment_history.php' method='POST'>";
        echo "<input type='hidden' name='log_id' value='".$_GET['assess_id']."'>";
        echo "<input type='hidden' name='sup_id' value='".$_GET['sup_id']."'>";
        echo "<h5>Delivers To: <input type='text' name='deliver_to' value='".$rs_sup['supplier_name']."' readonly></h5>";
        echo "<h5>Price: <input type='text' name='price' value='".$_GET['price']."'></h5>";
        echo "<h5>Grade: <select name='wp_grade'>";
        echo "<option value='".$_GET['wp_grade']."'>".$_GET['wp_grade']."</option>";
        echo "<option value='lcwl'>LCWL</option>";
        echo "<option value='cbs'>CBS</option>";
        echo "<option value='onp'>ONP</option>";
        echo "<option value='occ'>OCC</option>";
        echo "<option value='mw'>MW</option>";
        echo "<option value='chipboard'>CHIPBOARD</option>";
        echo "</select></h5>";
        echo "<input type='submit' name='edit_grade' value='Update'>";
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
                    echo "<th class='data'>Price</th>";
                    echo "<th class='data'>Volume</th>";
                    echo "<th class='data'>Action</th>";
                    echo "</tr>";
                    echo "</thead>";
                    include("config.php");
                    $query = "SELECT * FROM supplier_assessment where supplier_id='".$_GET['sup_id']."' and status!='deleted'";
                    $result = mysql_query($query);
                    while ($row = mysql_fetch_array($result)) {
                        echo "<tr class='data'>";
                        echo "<td class='data'>" . $row['wp_grade'] . "</td>";
                        $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='".$row['deliver_to']."'");
                        $rs_sup = mysql_fetch_array($sql_sup);
                        echo "<td class='data'>" . $rs_sup['supplier_name'] . "</td>";
                        echo "<td class='data'>" . $row['type'] . "</td>";
                        echo "<td class='data'>" . $row['price'] . "</td>";
                        echo "<td class='data'>" . $row['volume'] . "</td>";
                        echo "<td class='data'><a href='view_assessment_history.php?assess_id=" . $row['log_id'] . "&assess_sup=" . $row['deliver_to'] . "&sup_id=".$_GET['sup_id']."&wp_grade=".$row['wp_grade']."&price=".$row['price']."'><button>Edit</button></a>
&nbsp;<a href='view_assessment_history.php?del_id=" . $row['log_id'] . "&sup_id=".$_GET['sup_id']."'><button>Delete</button></a>
</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </td>
        </tr>
    </table>
    <a href="view_assessment_history_deleted.php?sup_id=<?php echo $_GET['sup_id']; ?>"><button>View Deleted History</button></a>
    &nbsp;<a href="editSupplier.php?sup_id=<?php echo $_GET['sup_id']; ?>&wp_grade=<?php echo $_GET['wp_grade']; ?>"><button>Back</button></a>

    <br><br>
</center>
