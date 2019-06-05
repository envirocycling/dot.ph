
<?php
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}
	?>
	<form method="post">
    <br /><table>
  <td>Branch:</td>
  <td><select name="branch" onchange="return try(evt);">
  <?php 
  include('connect_out.php');
  $select = mysql_query("Select * from branches") or die (mysql_error());
  while($row = mysql_fetch_array($select)){?>
  <option value="<?php echo strtoupper($row['branch_name']);?>"><?php echo strtoupper($row['branch_name']);?></option>
  <?php }
  ?>
  </select></td>
  </tr>
</table>