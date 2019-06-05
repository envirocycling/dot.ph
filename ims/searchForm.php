<style>
    input{
        text-align:center;
    }
    #filterremove{
        border-style:solid;
        color:blue;

    }

</style>
<div id="criteria">
    <h3>Filtering Options</h3>

    <form action='searchSupplier.php' method='post'>
        <table>
            <tr>
                <td>Supplier ID: <input type="text" name="supplier_id" value="" size="10"><br><br></td>
                <td>Supplier Name: <input type="text" name="supplier_name" value=""></td>
                <td>BH In-Charge: 
                    <select name="bh_in_charge" value="">
                        <option value="">Choose</option>
                        <option value="1">Darwin Pecjo</option>
                        <option value="2">Jess Apostol</option>
                        <option value="3">Mar DeGuzman</option>
                        <option value="4">Jed Pangilinan</option>
                        <option value="5">Val Agustin</option>
                        <option value="6">Rezen Macapagal</option>
                    </select>

                <td>


                </td>



                </td>

            </tr>

            <tr>
                <?php
                $query = "SELECT * FROM branches  ";
                $result = mysql_query($query) ;

                $dropdown = "<td>Branch:<select name='supplier_branch'  id='wp_grade' >";
                $dropdown .= "\r\n<option value='{$_SESSION['supplier_branch']}'>{$_SESSION['supplier_branch']}</option>";
                while($row = mysql_fetch_array($result)) {
                    $dropdown .= "\r\n<option value='{$row['branch_name']}'>{$row['branch_name']}</option>";
                }

                $dropdown .= "\r\n</select></td>";

                echo $dropdown;
                ?>
                <?php
                $query = "SELECT classification FROM supplier_details group by classification ";
                $result = mysql_query($query) ;

                $dropdown = "<td>Classification:<select name='supplier_type'  id='wp_grade' >";
                $dropdown .= "\r\n<option value='{$_SESSION['supplier_type']}'>{$_SESSION['supplier_type']}</option>";
                while($row = mysql_fetch_array($result)) {
                    $dropdown .= "\r\n<option value='{$row['classification']}'>{$row['classification']}</option>";
                }

                $dropdown .= "\r\n</select></td>";

                echo $dropdown;
                ?>
                <td> Year: <input type="text" name="year" value="<?php echo $_SESSION['yearcriteria']; ?>"><br><br></td>
            </tr>

            <tr>
                <td></td>
                <td><br><br></td>
                <td><input type="submit" value="Filter">
                    </form>

                    <a href="cancelSearch.php" id="filterremove"><u>Remove All Filtering</u></a>
                </td>

            </tr>

        </table>

</div>
