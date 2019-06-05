<?php
include("templates/template.php");
if (isset($_POST['branch'])) {
    $branch = $_POST['branch'];
} else {
    $branch = $_SESSION['user_branch'];
}
?>

<script type="text/javascript" src="EditSupplier.js"></script>
<script>
    function openWindow(str){
        var x = screen.width/2 - 700/2;
        var y = screen.height/2 - 450/2;
        window.open("editSupplier.php?sup_id="+str,'mywindow','width=1000,height=650');
    }
    function openWindow2(str){
        var x = screen.width/2 - 700/2;
        var y = screen.height/2 - 450/2;
        window.open("frmHideSupplier.php?id="+str,'mywindow','width=500,height=200');
    }
    $(window).load(function () {
        $(".editbox").hide();
    });
</script>

<div class="grid_10">
    <div class="box round first grid">
        <?php
        $suppplierlist = array();
        $ngayon=date('F d, Y');
        echo "<h2>Edit Suppliers</h2>";
        echo "<br>";
        echo "<form action='edit_supplier.php' method='POST'>";
        $query = "SELECT * FROM branches  ";
        $result = mysql_query($query);
        if($_SESSION['usertype']=='Super User') {
            echo "Filtering Branch:";
            $dropdown = "<select name='branch' onchange='this.form.submit()'>";
            if (isset($_POST['branch'])) {
                $branch = $_POST['branch'];
                if ($branch=='') {
                    $dropdown .= "\r\n<option value=''>All Branches</option>";
                } else {
                    $dropdown .= "\r\n<option value='$branch'>$branch</option>";
                    $dropdown .= "\r\n<option value=''>All Branches</option>";
                }
            } else {
                $dropdown .= "\r\n<option value=''>All Branches</option>";
            }
            while($row = mysql_fetch_array($result)) {
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
            echo "<tr>";
            echo "<th class='data'>Supplier ID</th>";
            echo "<th class='data'>Supplier Name</th>";
            echo "<th class='data'>Classification</th>";
            echo "<th class='data'>Owner</th>";
            echo "<th class='data'>Contact</th>";
            echo "<th class='data'>Street</th>";
            echo "<th class='data'>Municipality</th>";
            echo "<th class='data'>Province</th>";
            echo "</tr>";
            echo "</thead>";
            include("config.php");

            $query="SELECT * FROM supplier_details where status!='inactive' and branch like '%$branch%'";

            $result=mysql_query($query);
            while($row = mysql_fetch_array($result)) {
                $content="";
                $supplier_id = $row['supplier_id'];
                $supplier_name = $row['supplier_name'];
                $classification = $row['classification'];
                $owner = $row['owner'];
                $owner_contact = $row['owner_contact'];
                $street = $row['street'];
                $municipality  = $row['municipality'];
                $province = $row['province'];
                $content.="<tr id='$supplier_id' class='data'>

                <td class='edit_td' >
                <span id='zero_$supplier_id' class='text'>$supplier_id</span>
                <input type='text' value='$supplier_id' class='editbox' id='zero_input_$supplier_id' readonly size='1'/>
                </td>

                <td class='edit_td' >
                <span id='one_$supplier_id' class='text'>$supplier_name</span>
                <input type='text' value='$supplier_name' class='editbox' id='one_input_$supplier_id' />
                </td>

                <td class='edit_td' >
                <span id='two_$supplier_id' class='text'>$classification</span>
                <select name='classification' class='editbox' id='two_input_$supplier_id' >
                   <option value='$classification'>$classification</option>
                <option value='PM'>PM</option>
                   <option value='C1'>C1</option>
                   <option value='C2'>C2</option>
                <option value='C3'>C3</option>
                   <option value='T1'>T1</option>
                   <option value='T2'>T2</option>
                <option value='T3'>T3</option>
                   <option value='J1'>J1</option>
                   <option value='J2'>J2</option>
                <option value='J3'>J3</option>
                <option value='S1'>S1</option>
                   <option value='S2'>S2</option>
                <option value='S3'>S3</option>

                </select>
                </td>

                <td class='edit_td' >
                <span id='three_$supplier_id' class='text'>";
                if (empty ($owner)) {
                    $content.="UNKNOWN OWNER";
                } else {
                    $content.=$owner;
                }
                $content.="</span>
                <input type='text' value='$owner' class='editbox' id='three_input_$supplier_id'/>
                </td>

                <td class='edit_td' >
                <span id='four_$supplier_id' class='text'>";
                if (empty ($owner_contact)) {
                    $content.="UNKNOWN CONTACT";
                } else {
                    $content.=$owner_contact;
                }
                $content.="</span>
                <input type='text' value='$owner_contact' class='editbox' id='four_input_$supplier_id'/>
                </td>

                <td class='edit_td' >
                <span id='five_$supplier_id' class='text'>";
                if (empty ($street)) {
//                    $content.="UNKNOWN AAA";
                    $content.="UNKNOWN STREET";
                } else {
                    $content.=$street;
                }
                $content.="</span>
                <input type='text' value='$street' class='editbox' id='five_input_$supplier_id'/>
                </td>

                <td class='edit_td' >
                <span id='six_$supplier_id' class='text'>";
                if (empty ($municipality)) {
//                    $content.="UNKNOWN AAA";
                    if ($province == 'Caloocan'
                            || $province == 'Las Piñas'
                            || $province == 'Makati'
                            || $province == 'Malabon'
                            || $province == 'Mandaluyong'
                            || $province == 'Manila'
                            || $province == 'Marikina'
                            || $province == 'Muntinlupa'
                            || $province == 'Navotas'
                            || $province == 'Parañaque'
                            || $province == 'Pasay'
                            || $province == 'Pasig'
                            || $province == 'Pateros'
                            || $province == 'Quezon City'
                            || $province == 'San Juan'
                            || $province == 'Taguig'
                            || $province == 'Valenzuela') {
                        echo " ";
                    } else {
                        $content.="UNKNOWN MUNICIPALITY";
                    }
                } else {
                    $content.=$municipality;
                }
                $content.="</span>
                <input type='text' value='$municipality' class='editbox' id='six_input_$supplier_id'/>
                </td>

                <td class='edit_td' >
                <span id='seven_$supplier_id' class='text'>";
                if (empty ($province)) {
//                    $content.="UNKNOWN AAA";
                    $content.="UNKNOWN PROVINCE";
                } else {
                    $content.=$province;
                }
                $content.="</span>
                <input type='text' value='$province' class='editbox' id='seven_input_$supplier_id'/>
                </td>
                </tr>";
                array_push($suppplierlist, $content);

            }
            foreach ($suppplierlist as $supplier) {
                echo $supplier;
            }
            echo "
            </table>";

            ?>


        </table>

    </div>
</div>
