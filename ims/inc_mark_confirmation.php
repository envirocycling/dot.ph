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

    $del_id=$_GET['del_id'];

    echo "Do you want to mark this as processed and disable other users to process it?<br><Br>";

    echo "<a href='inc_mark_as_processed.php?del_id=".$del_id."'>YES</a>";

    ?>

</div>
