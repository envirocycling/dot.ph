

<?php include("templates/template.php"); ?>


<?php


?>
<div class="grid_10">
    <div class="box round first">
        <h2>Change Password </h2>
        <form action="changePass.php" method="POST">
      
            Old Password: <input type="password" name="current_pass" value=""><br>
            New Password: <input type="password" name="new_pass" value="">Must contain numbers and at least 8 characters long        <br>
            Confirm Password: <input type="password" name="confirm_pass" value=""><br>
            <input type="submit" value="Change">

        </form>
        <a href="home.php"><button>Cancel</button></a>

    </div>
</div>


<div class="clear">
</div>