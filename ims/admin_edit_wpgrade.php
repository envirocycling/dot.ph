

<div id="faceboxxx">
    <form action="admin_edit_wpgrade_exe.php" method="POST">
        Add new Waste Paper
        <?php
        $grade_id=$_GET['grade_id'];
        include ('config.php');
        $query="SELECT * FROM wp_grades where grade_id='$grade_id'";
        $result=mysql_query($query);
        $row = mysql_fetch_array($result);
        ?>

        <hr>
        <table>

            <input type="hidden" name="grade_id" value="<?php echo $row['grade_id']; ?>">
            <tr>
                <td>Waste Paper Code:</td>
                <td><input type="text" value="<?php echo $row['wp_grade']; ?>" name="wp_grade" size=></td>

            </tr>

            <tr>
                <td>Waste Paper Desc:</td>
                <td><input type="text" value="<?php echo $row['wp_desc']; ?>" name="wp_desc" size=></td>

            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Save"></td>

            </tr>
        </table>
    </form>

</div>