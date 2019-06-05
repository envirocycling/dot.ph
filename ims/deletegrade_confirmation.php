<style>

    #confirmation_code{
        font-size:20px;
        color:red;
        float:left;
        background-color:white;
    }


</style>

<div id="confirmation_code">
    <?php

    $grade_id=$_GET['grade_id'];

    echo "Are You Sure You Want to Delete This WP GRADE ?<br><Br>";

    echo "<a href='admin_delete_wpgrade.php?grade_id=".$grade_id."'>YES</a>&nbsp&nbsp&nbsp|&nbsp&nbsp&nbsp";
    echo "<a href='".$_SERVER['HTTP_REFERER']."'>NO</a>";



    ?>
</div>
