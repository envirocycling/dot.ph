<style>
    body{
        background-color: #CCE6FF;
        font-family: arial;
    }
    #id{
        background-color: transparent;
        text-align: center;
        font-style: 15px;
        border-style: hidden;
        border-bottom: solid;
        border-width: 2px;
        color: blue;
    }
    #view_history{
        position: absolute;
        margin-top: -45px;
        margin-left: 500px;

    }
    .assess{
        font-size: 15px;
        font-weight: bold;
    }
    .head{

    }
    .assess_table{
        font-size: 15px;
        font-family: arial;
    }
    select{
        height: 25px;
    }
    input {
        height: 25px;
    }
    .button{
        height: 30px;
        font-size: 14px;

    }
</style>
<link rel="stylesheet" href="cbFilter/cbCss.css" />
<link rel="stylesheet" href="cbFilter/sup_assessment.css" />
<script src="cbFilter/jquery-1.8.3.js"></script>
<script src="cbFilter/jquery-ui.js"></script>
<script src="cbFilter/sup_assessment.js"></script>
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
<?php
@session_start();
include 'config.php';

if (isset ($_POST['submit'])) {
    $supplier_id = $_POST['sup_id'];
    $wp_grade = $_GET['wp_grade'];
    if ($wp_grade == '') {
        $grades_array=array('lcwl','onp','cbs','occ','mw','cb');
    } else {
        $grades_array=array($wp_grade);
    }
    foreach ($grades_array as $grade) {
        $ctr = 0;
        $capacity = $_POST[$grade.'_capacity'];
        $capacitydum = $_POST[$grade.'_capacitydum'];
        if ($capacitydum!=$capacity) {
            $date_effective = $_POST[$grade.'_date_effective'];
            mysql_query("INSERT INTO supplier_capacity (`supplier_id`, `wp_grade`, `capacity`, `updated_by`, `date_effective`, `date_updated`)
                    VALUES ('$supplier_id','$grade','$capacity','".$_SESSION['username']."','$date_effective','".date("Y/m/d")."')");
        }
        while ($ctr < 3) {
            $delivers_to = preg_split("[_]", $_POST[$grade . '_sup_' . $ctr]);
            if ($delivers_to[0] != "") {
                $price = $_POST[$grade . '_price_' . $ctr];
                $type = $_POST[$grade . '_type_' . $ctr];
                $volume = $_POST[$grade . '_volume_' . $ctr];
                if ($grade == 'cb') {
                    $gradeq = 'chipboard';
                } else {
                    $gradeq = $grade;
                }
                $date = date("Y/m/d");
                mysql_query("INSERT INTO supplier_assessment (
                                    `supplier_id`,
                                    `class`,
                                    `deliver_to`,
                                    `wp_grade`,
                                    `type`,
                                    `price`,
                                    `volume`,
                                    `date`)
                            VALUES ('$supplier_id',
                                    '$delivers_to[1]',
                                    '$delivers_to[0]',
                                    '$grade',
                                    '$type',
                                    '$price',
                                    '$volume',
                                    '$date')");
            }
            $ctr++;
        }
    }
    echo "<script>";
    echo "alert('Successfully Updated');";
    echo "location.replace('view_assessment.php?sup_id=$supplier_id&wp_grade=$wp_grade');";
    echo "</script>";

}
$value_array = array ();
$show_array = array ();
$supplier_id_array = array ();

$sql_sup = mysql_query("SELECT * FROM supplier_details WHERE status!='inactive'");
while ($rs_sup = mysql_fetch_array($sql_sup)) {
    $value = $rs_sup['supplier_id']."_".$rs_sup['classification'];
    $show = $rs_sup['supplier_id']."_".$rs_sup['supplier_name']."----".$rs_sup['classification'];
    array_push($supplier_id_array,$rs_sup['supplier_id']);
    $value_array[$rs_sup['supplier_id']]=$value;
    $show_array[$rs_sup['supplier_id']]=$show;
}

$id = $_GET['sup_id'];
$wp_grade = $_GET['wp_grade'];
$sql = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='$id'");
$rs = mysql_fetch_array($sql);
if ($wp_grade == '') {
    $grades_array=array('lcwl','onp','cbs','occ','mw','cb');
} else {
    $grades_array=array($wp_grade);
}
echo "<form action='view_assessment.php?wp_grade=$wp_grade' method='POST'>";
echo "<input type='hidden' name='sup_id' value='$id'>";
echo "<table class='assess_table' width='950' style='margin-left: 20px;'>";
echo "<tr>";
echo "<td colspan='4' align='center'><b>".$id."_".$rs['supplier_name']." WP GOING TO</b><br></td>";
echo "</tr>";
foreach ($grades_array as $grade) {
    $c = 0;
    $sql_grade = mysql_query("SELECT * FROM supplier_assessment WHERE wp_grade='$grade' and supplier_id='$id'");
    $rs_grade_c = mysql_num_rows($sql_grade);
    $sql = mysql_query("SELECT * FROM supplier_capacity WHERE supplier_id='$id' and wp_grade='$grade' and date_effective<='".date("Y/m/d")."' ORDER BY date_effective DESC");
    $rs = mysql_fetch_array($sql);
    echo "<tr>";
    echo "<td colspan='4' align='center'><br><b>".strtoupper($grade)."</b></td>";
    echo "</tr>";
    echo "</tr>";
    echo "<tr>";
    echo "<td colspan='4' align='center'>Capacity: <input type='hidden' name='".$grade."_capacitydum' value='".$rs['capacity']."'><input type='text' name='".$grade."_capacity' value='".$rs['capacity']."'>
&nbsp;&nbsp;&nbsp;Date Effective: <input type='text'  id='".$grade."_inputField' name='".$grade."_date_effective' value='".date('Y/m/d')."' onfocus='date1(this.id);' readonly>
<br><br></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td align='center'>Supplier</td>";
    echo "<td align='center'>Type</td>";
    echo "<td align='center'>Price</td>";
    echo "<td align='center'>Volume (MT)</td>";
    echo "</tr>";
    while ($rs_grade = mysql_fetch_array($sql_grade)) {
        $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='".$rs_grade['deliver_to']."'");
        $rs_sup = mysql_fetch_array($sql_sup);
        echo "<tr>";
        echo "<td><input type='text' name='' value='".$rs_sup['supplier_name']."' readonly></td>";
        echo "<td><input type='text' name='' value='".$rs_grade['type']."' readonly></td>";
        echo "<td><input type='text' name='' value='".$rs_grade['price']."' readonly></td>";
        echo "<td><input type='text' name='' value='".$rs_grade['volume']."' readonly></td>";
        echo "</tr>";
    }
    while ($c < 3) {
        echo "<tr>";
        echo "<td><span id='picker_".$grade."".$c."'>";
        echo "<select name='".$grade."_sup_".$c."' id='combobox_".$grade."".$c."'>";
        echo "<option value=''></option>";
//        $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE status!='inactive'");
//        while ($rs_sup = mysql_fetch_array($sql_sup)) {
//            echo "<option value='" . $rs_sup['supplier_id'] . "_" . $rs_sup['classification'] . "'>" . $rs_sup['supplier_id'] . "_" . $rs_sup['supplier_name'] . " -- ". $rs_sup['classification'] . "</option>";
//        }
        foreach ($supplier_id_array as $sup_id) {
            echo "<option value='$value_array[$sup_id]'>$show_array[$sup_id]</option>";
        }
        echo "</select>";
        echo "</span></td>";
        echo "<td>Deliver: <input type='radio' name='".$grade."_type_".$c."' value='delivery'/> Pickup: <input type='radio' name='".$grade."_type_".$c."' value='pickup'/></td>";
        echo "<td><input type='text' name='".$grade."_price_".$c."' class='assess' value=''/></td>";
        echo "<td><input type='text' name='".$grade."_volume_".$c."' class='assess' value=''/></td>";
        echo "</tr>";
        $c++;
    }
}
echo "<tr>";
echo "<td colspan='3' align='center'><input class='button' type='submit' name='submit' value='Update'></td>";
echo "</tr>";
echo "</table>";
echo "</form>";
echo "<center>";
echo "<a href='view_assessment_history.php?sup_id=$id&wp_grade=$wp_grade'><button class='button'>View History</button></a>";
echo "</center>";
?>
<br>