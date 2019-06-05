<?php 
include('config.php');

echo $_GET['id'];
?>
<center>
<form action="" method="post">
	<table>
		<tr>
			<td>Group Island: <input type="text" name="group_island" ></td>
		</tr>
	</table>
		<input name="submit" type="submit">
</form>
</center>
<?php
	if(isset($_POST['submit'])){
		mysql_query("UPDATE supplier_details SET group_island='".$_POST['group_island']."' WHERE supplier_id='".$_GET['id']."'") or die(mysql_error());
		echo '<script>
				alert("Okay");
				window.close();
			</script>';
	}
?>