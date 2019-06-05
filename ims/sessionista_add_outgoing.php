<?php session_start();?>
<script>
    function closeMe(){
        window.close();
    }
</script>

<h2>Loading... Please wait... </h1>
<?php
include ('config.php');
$log_id=$_GET['log_id'];
$key = array_search($log_id, $_SESSION['outgoing_log_ids']);
if (false !== $key) {
    unset($_SESSION['outgoing_log_ids'][$key]);
}else {
    array_push($_SESSION['outgoing_log_ids'],$log_id);
}



?>

<script>

    closeMe();
</script>
