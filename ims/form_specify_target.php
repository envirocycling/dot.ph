

<form action="../../specify_target.php" method="POST">
    <table>
        <tr><td> Year:</td><td> <input type="text" value="" size="2" name="year"></td>
        <tr><td>    Month: </td><td><select name="month" value="">
                    <option value="<?php echo date('m'); ?>"><?php echo date('F'); ?></option>
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>


                </select></td>
        <tr><td>Branch</td><td>
                <select name="branch" value="">
                    <?php
                    include('config.php');
                    $query="SELECT * FROM branches";
                    $result=mysql_query($query);
                    while($row = mysql_fetch_array($result)) {
                        if($row['branch_name']=='Kaybiga') {
                            echo "<option value='".$row['branch_id']."_"."Novaliches"."'>".$row['branch_name']."</option>";
                        }else {
                            echo "<option value='".$row['branch_id']."_".$row['branch_name']."'>".$row['branch_name']."</option>";
                            
                        }

                    }


                    ?>
                </select></td>

            <td>   Target:  <input type="text" value="" name="target" size="5"></td></tr>
        <tr><td></td><td></td><td><input type="submit" value="Update"></td></tr>
    </table>
</form>