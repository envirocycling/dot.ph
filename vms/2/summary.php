<!doctype HTML>
    <html lang=''>
      <head>
        <title>Vehicle Management System</title>
        <meta charset='utf-8'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="shortcut icon" type="image/x-icon" href="img/logo.png" />
        <link rel="stylesheet" href="css/styles.css">
        <link href="css/table.css" media="screen" rel="stylesheet" type="text/css" />

        <script src="js/header.js" type="text/javascript"></script>
        <script src="js/script.js"></script>

        <script type="text/javascript">
          function show_table() {
            if (document.getElementById('show_tally').checked){
              document.getElementById('sum_table').hidden=false;
              document.getElementById('sum_table2').hidden=false;
            }else{
              document.getElementById('sum_table').hidden=true;
              document.getElementById('sum_table2').hidden=true;
            }
          }
        </script>
      </head>

    <body>

      <?php
      include('layout/header.php');
      include('connect.php');
      include("css/drop_down.php");
      ?>

      <center>
        <div id="body">

          <table id="page1">
            <tr>
              <td align="left">Summary</td>
              <td align="right"><span id="back" onClick="backed();">Back</span></td>
            </tr>
          </table>

          <br><br>

          <!---TALLY----------------------------------------------------->
          <?php

          include('connect.php');

          $branch = $_SESSION['owner'];

          $query = "SELECT * FROM tbl_truck_report WHERE status='' AND branch='$branch' ";
          $result = mysql_query($query) or die(mysql_error());
          $count = 1;

          ?>

      
          <table width="30%"  align="right" >

            <tr><td align="right">Show Vehicle Tally<input type="checkbox" id="show_tally" onClick="show_table();"></td></tr>

            <tr>
              <td>
                <?php 
                include('connect.php');

                $branch = $_SESSION['owner'];

                $elf= mysql_query("SELECT * from tbl_truck_report WHERE branch='$branch' AND  wheels='6' and series NOT LIKE '%FORWARD%' and class not like '%HE%' and status=''") or die (mysql_error());
                $elf_num = mysql_num_rows($elf);

                $forward= mysql_query("SELECT * from tbl_truck_report WHERE branch='$branch' AND wheels='6' and series LIKE '%FORWARD%' and class not like '%HE%' and status=''") or die (mysql_error());
                $forward_num = mysql_num_rows($forward);

                $ten= mysql_query("SELECT * from tbl_truck_report WHERE branch='$branch' AND wheels='10' and class not like '%HE%' and status=''") or die (mysql_error());
                $ten_num = mysql_num_rows($ten);

                $motor= mysql_query("SELECT * from tbl_truck_report WHERE branch='$branch' AND wheels='2' and class not like '%HE%' and status=''") or die (mysql_error());
                $motor_num = mysql_num_rows($motor);

                $company= mysql_query("SELECT * from tbl_truck_report WHERE branch='$branch' AND class like '%COMPANY%' and class not like '%HE%' and status=''") or die (mysql_error());
                $company_num = mysql_num_rows($company);

                $he= mysql_query("SELECT * from tbl_truck_report WHERE branch='$branch' AND class like '%HE%' and status=''") or die (mysql_error());
                $he_num = mysql_num_rows($he);

                $all_vec = $elf_num + $forward_num + $ten_num + $motor_num + $he_num;

                ?>

                <center>
                  <table  style="border-collapse:collapse;"id="sum_table" hidden="" border="1px">

                    <tr style="background-color:#2b2b2b; font-size:12px; color:#FFFFFF;">
                      <td>SERVICE</td>
                      <td>ELF</td>
                      <td>FORWARD</td>
                      <td>10 WHEELER</td>
                      <td>MOTORCYCLE</td>
                      <td>HEAVY EQPMNT</td>
                      <td>TOTAL</td>
                    </tr>

                    <tr>
                      <td><?php echo $company_num;?></td>
                      <td><?php echo $elf_num;?></td>
                      <td><?php echo $forward_num;?></td>
                      <td><?php echo $ten_num;?></td>
                      <td><?php echo $motor_num;?></td>
                      <td><?php echo $he_num;?></td>
                      <td><?= $all_vec; ?></td>
                    </tr>

                  </table>
                </center>

                <table width="100%" id="sum_table2" hidden="">
                  <tr align="right">
                    <td>
                      <br />

                      <?php 
                      include('connect_out.php');
                      $num2 = 0;
                      $branch_num2 = 0;
                      $branches = mysql_query("Select * from branches order by branch_name Asc") or die (mysql_error());
                      ?>

                      <table  style="border-collapse:collapse;" border="1px" width="300px">

                        <tr style="background-color:#2b2b2b; font-size:12px; color:#FFFFFF;">
                          <td>BRANCH</td>
                          <td>ASSIGN TO BRANCH</td>
                          <td>GIVEN TO SUPPLIER</td>
                          <td>VEHICLE PER BRANCH</td>
                        </tr>

                        <?php while ($branches_row  = mysql_fetch_array($branches)){

                          include('connect.php');

                          $trucks = mysql_query("SELECT * from tbl_truck_report Where branch like '%".$branches_row['branch_name']."%' and class!='HE'  and status=''") or die (mysql_error());

                          while($row_trucks = mysql_fetch_array($trucks)) {
                                
                            $trucks_branch= mysql_query("SELECT * from tbl_givento  Where truckid='".$row_trucks['id']."' and (suppliername = '1449' or suppliername = '1450' or suppliername = '1452' or suppliername = '1453'  or suppliername = '1454' or suppliername = '1455' or suppliername = '1456' or suppliername = '1458' or suppliername = '14025' or suppliername = '14066' or suppliername = '14317')") or die (mysql_error());
                            $trucks_branch2= mysql_query("SELECT * from tbl_givento  Where truckid='".$row_trucks['id']."' and (suppliername != '1449' or suppliername != '1450' or suppliername != '1452' or suppliername != '1453'  or suppliername != '1454' or suppliername != '1455' or suppliername != '1456' or suppliername != '1458' or suppliername != '14025' or suppliername != '14066' or suppliername != '14317')") or die (mysql_error());

                            if(mysql_num_rows($trucks_branch) > 0) {
                              @$branchs[$branches_row['branch_name']]++;
                            }else if(mysql_num_rows($trucks_branch2) > 0) {
                              @$givens[$branches_row['branch_name']]++;
                            }
                          }

                          @$tot_branch += $branchs[$branches_row['branch_name']]; 
                          @$tot_gives += $givens[$branches_row['branch_name']]; 
                          @$per_branch[$branches_row['branch_name']] += $branchs[$branches_row['branch_name']] + $givens[$branches_row['branch_name']];
                          @$per_branchs+= $branchs[$branches_row['branch_name']] + $givens[$branches_row['branch_name']];

                        ?>

                        <tr>
                          <td><?php echo $branches_row['branch_name'];?></td>
                          <td><?php echo round(@$branchs[$branches_row['branch_name']]);?></td>
                          <td><?php echo round(@$givens[$branches_row['branch_name']]);?></td>
                          <td><?php echo round($per_branch[$branches_row['branch_name']]);?></td>
                        </tr>

                        <?php }?>

                        <tr style="background-color:#FFFF00;">
                          <td>Total:</td>
                          <td><?php echo $tot_branch;?></td>
                          <td><?php echo $tot_gives;?></td>
                          <td><?php echo $per_branchs;?></td>
                        </tr>

                        <tr>
                          <td colspan="4" style="color:#FF0000; font-size:12.5px;" align="center">Note: Heavy Equiment and Truck with no Assign Supplier are not being Counted.</td>
                        </tr>

                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
          <!---TALLY----------------------------------------------------->

          <center>
            <table>
              <tr>
                <form action="" method="post" target="_self">
                <td>
                  View History: 
                  <select name="plate" id="summary" required>
                    <?php if(isset($_POST['submit'])) { ?>
                    <option value="<?php echo @$_POST['plate'];?>"><?php echo @$_POST['plate'];?></option>
                    <?php } else { ?>
                    <option value="" selected="selected" disabled="disabled">--PleaseSelect--</option>
                    <?php }
                    $query=mysql_query("Select * from tbl_truck_report") or die (mysql_error());
                    while($row = mysql_fetch_array($query)) { ?>
                    <option value="<?php echo $row['truckplate'];?>"><?php echo $row['truckplate'];?></option>
                    <?php }
                    $query2 = mysql_query("Select DISTINCT(driver) from tbl_trip") or die (mysql_error());
                    while($row2 = mysql_fetch_array($query2)) { ?>
                    <option value="<?php echo $row2['driver'];?>"><?php echo $row2['driver'];?></option>
                    <?php }
                    $query3 = mysql_query("Select DISTINCT(helper) from tbl_trip") or die (mysql_error());
                    while($row3 = mysql_fetch_array($query3)) { ?>
                    <option value="<?php echo $row3['helper'];?>"><?php echo $row3['helper'];?></option>
                    <?php } ?>
                  </select>
                </td>
                <td>
                  <input value="View Summary" type="submit" name="submit" id="button">
                </td>
              </tr>
            </table>

            <?php
            if(isset($_POST['submit'])) {
            	$plate = mysql_query("Select * from tbl_truck_report Where truckplate='".$_POST['plate']."'") or die (mysql_error());
            	if(mysql_num_rows($plate) > 0) {
            ?>
	
          <center>
            <table width="60% "> 
              <tr>
                <td>
	                <table class="CSSTableGenerator">
                    <tr>
                      <td colspan="2">Date</td>
                      <td >Plate</td>
                      <td>Branch</td>
                      <td>Remarks</td>
                      <td>Description</td>
                    </tr>

                    <?php
            	      $rows = mysql_fetch_array($plate);
                    $select = mysql_query("Select * from tbl_reassignmenthistory Where truckplate = '".$rows['id']."' Order by id Asc") or die(mysql_error());
                    $sql_assign_supp = mysql_query("Select * from tbl_assigntosupp_history Where truckid = '".$rows['id']."' Order by id Asc") or die(mysql_error());
            	
                  	$num = 1;
                  	while($row_his = mysql_fetch_array($select)) {
                  	$num++;
		                ?>

                    <tr>
                      <td><?php echo $num;?></td>
                      <td><?php echo date('F d, Y', strtotime($row_his['date_approved']));?></td>
                      <td><?php echo $_POST['plate'];?></td>
                      <td><?php echo $row_his['branch'];?></td>
                      <td><?php echo strtoupper($row_his['remarks']);?></td>
                      <td><?php echo $row_his['status'];?></td>
                    </tr>

                    <?php }

                    while($row_assign = mysql_fetch_array($sql_assign_supp)) { ?>

                    <tr>
                      <td><?php echo $num;?></td>
                      <td><?php echo date('F d, Y', strtotime($row_his['date_submitted']));?></td>
                      <td><?php echo $_POST['plate'];?></td>
                      <td><?php echo $row_his['branch'];?></td>
                      <td colspan="2"><?php echo strtoupper($row_his['description']);?></td>
                    </tr>

                  <?php 
                  $num++; }
	              }else { ?>

	              <br />
                <br />
                <iframe src="summary2.php?plate=<?php echo $_POST['plate'];?>" width="100%" height="600px" frameborder="0" name="summary"></iframe>

                <?php }?>
              </table>
            </td>
          </tr>
        </table>
      </center>

      <?php } ?>

    <!---end of select -->
    </center>
  <?php //endtofcode===========================================================================?>
	</div>

<?php include('layout/footer.php');?>
</center>
</body>
</html>
