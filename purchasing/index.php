<?php
include('config.php');
session_start();
session_destroy();
session_start();


?>
<style>
    h1{
        color:white;
    }
</style>
<html>
    <head>
        <title>EFI PURCHASING SYSTEM</title>



        <link rel="stylesheet" type="text/css" href="mos-css/mos-style.css"> <!--pemanggilan file css-->

    </head>

    <body>
        <h1>EFI PURCHASING SYSTEM V. 02</h1>

        <div id="loginForm">
            <div class="headLoginForm">

	Login User
            </div>
            <div class="fieldLogin">



                </object>
                <form method="POST" action="validation.php">

                    <label>Username</label><br>
                    <input type="text" class="login" name="username"><br>
                    <label>Password</label><br>
                    <input type="password" class="login" name="pass"><br>
                    <input type="submit" class="button" value="Login">
                </form>
            </div>
        </div>
    </body>
</html>
