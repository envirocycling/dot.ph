<style>
    body{
        font-size:30px;
        padding:100px;
    }
    input{
        font-size:30px;

    }
    button{
        font-size:30px;
    }

</style>
<?php
session_start();
$from=$_POST['from'];
$to=$_POST['to'];
$branch=$_POST['branch'];
echo "Please ask your supervisor to authorize the following transaction:<br><br><hr>";
echo "Transaction Type: Delete Bales<br>";
echo "For the period:$from to $to <br>";
echo "Branch : $branch";
echo "<form action='delete_bales.php' method ='POST' >";
echo "<input type='hidden' name='from' value='$from'>";
echo "<input type='hidden' name='to' value='$to'>";
echo "<input type='hidden' name='branch' value='$branch'>";
echo "<input type='password' value='' name='supervisor_code'>";
echo "<br><input type='submit' value='Authenticate'>";

echo "</form>";
echo "<a href='outgoing_report.php'><button>Back</button></a>";
?>