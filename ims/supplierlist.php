<?php
include("templates/template.php");
include 'config.php';
if (isset($_POST['branch'])) {
    $branch = $_POST['branch'];
} else {
    $branch = '';
}

//$sql = mysql_query("SELECT * FROM supplier_details WHERE status !='inactive'");
//while ($rs = mysql_fetch_array($sql)) {
//    mysql_query("UPDATE supplier_details SET style='".$rs['classification']."',date_updated='".date("Y/m/d")."' WHERE supplier_id='".$rs['supplier_id']."'");
//}
?>


<script>
    function openWindow(str) {
        var x = screen.width / 2 - 700 / 2;
        var y = screen.height / 2 - 450 / 2;
        window.open("editSupplier.php?sup_id=" + str, 'mywindow', 'width=1000,height=650');
    }
    function openWindow2(str) {
        var x = screen.width / 2 - 700 / 2;
        var y = screen.height / 2 - 450 / 2;
        window.open("frmHideSupplier.php?id=" + str, 'mywindow', 'width=300,height=200');
    }
    function openWindow3(str) {
        var x = screen.width / 2 - 700 / 2;
        var y = screen.height / 2 - 450 / 2;
        window.open("viewSupplier.php?sup_id=" + str, 'mywindow', 'width=700,height=650');
    }
</script>

<div class="grid_10">
    <div class="box round first grid">
        <?php
        $ngayon = date('F d, Y');
        echo "<h2>  Suppliers as of : <u><b><i>" . $ngayon . "</i></b></u></h2>";
        echo "<br>";
        echo "<form action='supplierlist.php' method='POST'>";
        $query = "SELECT * FROM branches  ";
        $result = mysql_query($query);
        if ($_SESSION['usertype'] == 'Super User') {
            echo "Filtering Branch:";
            $dropdown = "<select name='branch' onchange='this.form.submit()'>";
            if (isset($_POST['branch'])) {
                $branch = $_POST['branch'];
                if ($branch == '') {
                    $dropdown .= "\r\n<option value=''>All Branches</option>";
                } else {
                    $dropdown .= "\r\n<option value='$branch'>$branch</option>";
                    $dropdown .= "\r\n<option value=''>All Branches</option>";
                }
            } else {
                if ($branch == '') {
                    $dropdown .= "\r\n<option value=''>All Branches</option>";
                }
            }
            while ($row = mysql_fetch_array($result)) {
                $dropdown .= "\r\n<option value='{$row['branch_name']}'>{$row['branch_name']}</option>";
            }
            $dropdown.= "\r\n</select>";
            echo $dropdown;
            echo "</form>";
        }
        ?>
        <br>
        <table class="data display datatable" id="example">
            <?php
            echo "<thead>";
            echo '<tr class="data">';

            echo "<th class='data'> Supplier ID</th>";
            echo "<th class='data'>Supplier Name</th>";
            echo "<th class='data'>Classification</th>";
//            echo "<th class='data'>Desc</th>";
            echo "<th class='data'>Branch</th>";
            echo "<th class='data'>BH In-Charge</th>";
            echo "<th class='data'>Owner</th>";
            echo "<th class='data'>Contact</th>";
            echo "<th class='data'>Address</th>";
            echo "<th class='data'>Group</th>";
			if($_SESSION['main'] == 20){
				echo "<th class='data'>Status</th>";
			}
            echo "<th class='data'>Action</th>";

            echo "</tr>";

            echo "</thead>";
            include("config.php");



            
			 if($_SESSION['main'] == 20 ){
			 $query = "SELECT * FROM supplier_details where branch like '%$branch%'";
			 }else{
			 $query = "SELECT * FROM supplier_details where status !='inactive' and branch like '%$branch%'";
			 }

            $result = mysql_query($query);
            while ($row = mysql_fetch_array($result)) {

                echo "<tr class='data'>";
                echo "<td class='data'>" . $row['supplier_id'] . "</td>";
                echo "<td class='data'>" . $row['supplier_name'] . "</td>";
                if (!empty($row['classification'])) {
                    echo "<td class='data'>" . $row['classification'] . "</td>";
                } else {
                    echo "<td class='data'>" . $row['style'] . "</td>";
                }
//                echo "<td class='data'>".$row['description']."</td>";
                echo "<td class='data'>" . $row['branch'] . "</td>";
                echo "<td class='data'>" . $row['bh_in_charge'] . "</td>";
                if (empty($row['owner'])) {
                    echo "<td class='data'>UNKNOWN OWNER</td>";
                } else {
                    echo "<td class='data'>" . $row['owner'] . "</td>";
                }
                if (empty($row['owner_contact'])) {
                    echo "<td class='data'>UNKNOWN CONTACT</td>";
                } else {
                    echo "<td class='data'>" . $row['owner_contact'] . "</td>";
                }
                if ($row['street'] == '' && $row['municipality'] == '' && $row['province'] == '') {
                    echo "<td class='data'>-</td>";
                } else {
                    echo "<td class='data'>" . $row['street'] . "," . $row['municipality'] . "," . $row['province'] . "</td>";
                }
                echo "<td class='data'>" . $row['group_island'] . "</td>";
				if($_SESSION['main'] == 20){
					echo "<td class='data'>" . $row['status'] . "</td>";
				}
                if ($_SESSION['usertype'] == 'Super User') {
                    echo "<td class='data' width='180'>";
                    echo "<table>";
                    echo "<tr>";
                    echo "<td><button id='" . $row['supplier_id'] . "' onclick='openWindow3(this.id);'>View</button></td>";
                    if($_SESSION['main'] == 20){
						 ?><td><button id='" . $row['supplier_id'] . "' onclick="window.open('edit_new_supp.php?id=<?php echo $row['supplier_id'];?>','supp','height=200,width=200');">Rj Edit</button></td><?php
					}else{
					echo "<td><button id='" . $row['supplier_id'] . "' onclick='openWindow(this.id);'>Edit</button></td>";
					}
                    echo "<td><button id='" . $row['supplier_id'] . "' onclick='openWindow2(this.id);' title='Click to mark as inactive'>Inactive</button></td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td colspan='3' align='center'><i>Date Updated: " . $row['date_updated'] . "</i></td>";
                    echo "</tr>";
                    echo "</table>";
                } else {
                    echo "<td class='data'><button id='" . $row['supplier_id'] . "' onclick='openWindow3(this.id);'>View</button></td>";
                }
                echo "</tr>";
            }


            echo "</table>";
            ?>
        </table>

    </div>
</div>
