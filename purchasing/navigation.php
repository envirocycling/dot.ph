<li class="ic-dashboard"><a href="home.php"><span>HOME</span></a> </li>

<?php

$usertype=$_SESSION['usertype'];
$branch=$_SESSION['branch'];

echo '



        <li class="ic-dashboard"><a href="formPR.php"><b>Send PR</b></a></li>
        <li class="ic-dashboard"><li><a href="prRequests.php"><b>View Requests Status</b></a></li>
       <li class="ic-dashboard"><li><a href="formChangePass.php"><b><i><u>Change Password</u></i></b></a></li>
        <li class="ic-dashboard"><li><a href="logout.php"><b><i><u>Logout</u></i></b></a></li>
    ';


?>

