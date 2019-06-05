


<div id="faceboxxx">
    <form action="admin_edit_branch_exe.php" method="POST">
        Add new Waste Paper
        <?php
        $branch_id=$_GET['branch_id'];
        include ('config.php');
        $query="SELECT * FROM branches where branch_id='$branch_id'";
        $result=mysql_query($query);
        $row = mysql_fetch_array($result);
        ?>

        <hr>
        <table>

            <input type="hidden" name="branch_id" value="<?php echo $row['branch_id']; ?>">
            <tr>
                <td>Branch Name:</td>
                <td><input type="text" value="<?php echo $row['branch_name']; ?>" name="branch_name" size=></td>

            </tr>


            <tr>
                <td></td>
                <td><input type="submit" value="Save"></td>

            </tr>
        </table>
    </form>

</div>