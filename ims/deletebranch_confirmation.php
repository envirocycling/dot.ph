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

    $branch=$_GET['branch_id'];

    echo "Are You Sure You Want to Delete This Branch ?<br><Br>";

    echo "<a href='admin_delete_branch.php?branch_id=".$branch."'>YES</a>&nbsp&nbsp&nbsp|&nbsp&nbsp&nbsp";
    echo "<a href='".$_SERVER['HTTP_REFERER']."'>NO</a>";



    ?>
</div>
