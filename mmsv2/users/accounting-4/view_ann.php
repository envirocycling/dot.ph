<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" />
<link rel="stylesheet" href="css/del_form.css">
<script type="text/javascript" src="validation/jquery.min.js"></script>
<?php
include("../../connect.php");
echo '<center>';
$sql_announce = mysql_query("SELECT * from announcement WHERE a_id='".$_GET['a_id']."'") or die(mysql_error());
$row_announce = mysql_fetch_array($sql_announce);

echo '<h3>' . strtoupper($row_announce['title']) . '</h3>  ' . strtoupper($row_announce['content']) . '<br> Date posted  ' . date('F d, Y', strtotime($row_announce['date_post'])) . '<br><img src="../../images/announcement/' . $row_announce['image_name'] . '"  width="50%" height="50%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="ann_content">';

echo '</center>';
