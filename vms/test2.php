<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_efi_truck_report";
 
//making an array with the data recieved, to use as named placeholders for INSERT by PDO.
$data = array('elementname' => $_POST['elementname'] , 'elementsymbol' => $_POST['elementsymbol'], 'atomicnumber' => $_POST['atomicnumber']);
 
try {
    // preparing database handle $dbh
    $dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // query with named placeholders to avoid sql injections
    $query = "INSERT INTO tbl_history (name) VALUES (:atomicnumber )";
    //statement handle $sth
    $sth = $dbh->prepare($query);
    $sth->execute($data);
    echo "New record created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
$dbh = null;
?>