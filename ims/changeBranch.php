<?php
session_start();
unset($_SESSION['selected_branch']);
$branch=$_GET['branch'];
$_SESSION['selected_branch']=$branch;

//header('Location:outgoing_report.php');
if(!empty($_SESSION['selected_branch'])){
?>
<script>
	location.replace('outgoing_report.php?-slct_branch=<?php echo $branch;?>');
</script>
<?php }?>