<h2>Insert Notation </h2><hr>

<form action="insert_notation.php" method="POST">
    <input type="hidden" value="<?php echo $_GET['del_id'];?>" name="del_id">
    <textarea name="notation" cols="20" row="20">

    </textarea><br>
    <input type="submit" value="Insert">
</form>