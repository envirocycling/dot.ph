<?php
include("config.php");
if(isset($_POST['date'])){
   $date = $_POST['date'];
   $qty = $_POST['qty'];
   $txn = $_POST['txn'];
   $brand = $_POST['brand'];
   $branch = $_POST['branch'];
   $type = $_POST['type'];
   $date_from = $_POST['from'];
   $date_to = $_POST['to'];

   mysql_query("INSERT INTO bale_wire
       (date_use, quantity, transaction_type, brand, bale_wire_type, branch)
       VALUES
       ('$date','$qty','$txn','$brand','$type','$branch')");
  echo "<script>
      alert('Successful added');
      window.location = 'bale_wire_inventory.php?branch=$branch&&from=$date_from&&to=$date_to';
      </script>
      ";
}


?>