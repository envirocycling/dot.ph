<?php
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}

?>
<html>
<?php
include('../title.php');
?>
<script>
function isNumbers(evt) {
       var ew = event.which;
    if(ew == 32)
        return true;
    if(48 <= ew && ew <= 57)
        return true;
    if(65 <= ew && ew <= 90)
        return true;
    if(97 <= ew && ew <= 122)
        return true;
    return false;
}</script>
<?php // type numbers only==================================================================?>
<script>
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}</script>
<?php //======================================================================================?>
<script>
		function caps(element){
    element.value = element.value.toUpperCase();
		}
	</script>
	<?php //facebox==========================================================================?>

<script src="../js/jquery.min.js" type="text/javascript"></script>
<link href="../css/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="../js/facebox.js" type="text/javascript"></script>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('a[rel*=facebox]').facebox({
            loadingImage: '../src/loading.gif',
            closeImage: '../src/closelabel.png'
        })
    })
</script>
<?php //=====================================================?>
     <?php // headermenu==============?>
    <link rel="stylesheet" href="../css/header.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="../js/header.js"></script>
<body>
<img src="../image/header.png" height="25%" width="100%">
	
<div id='cssmenu'>
<ul>

   <li><a href="new_truck.php">New Vehicle</a></li>
   <li  class='active'><a href="existing_truck.php">Existing Vehicles</a></li>
      <li><a href='maintenance.php'>Maintenance</a></li>
   <li><a href="registration_monitoring.php">Vehicle Registration</a></li>
     <li><a href="truck_reassign.php">Vehicle Reassignment</a></li>
      <li><a href='summary.php'>Summary</a></li>
       <li><a href='trip.php'>Trip Schedule</a></li>
        <li>|                |</li> 
        <li><a href='myaccount.php' rel="facebox">MyAccount</a></li>
            <li><a href='otheraccount.php'>Other Account</a></li>
         <li><a href="logout.php">Logout</a></li>
</ul>
</div><br /> 

 <?php

include('connect.php');


$truck = mysql_query ("SELECT * FROM tbl_truck_report Where id='".$_GET['id']."'");
$truck_row = mysql_fetch_array($truck);

?>
<form action="update_given.php" method="post">

<table align="center">
<tr>
				<td align="center" colspan="2"><h3>EFI Vehicles</h3></td>
				<td></td>
			</tr>
             </tr>
  <td>Branch:  </td>
   
  <td>
  <select name="branches">
  <option value="<?php echo strtoupper($truck_row ['branch']); ?>"><?php echo strtoupper($truck_row ['branch']); ?></option>
  <?php
  include('connect_out.php');
  $tbl_branch=mysql_query("Select * from branches Order by branch_name ASC") or die (mysql_error());
  while($tbl_branch_row = mysql_fetch_array($tbl_branch)){
	 
	  ?><option value="<?php echo strtoupper($tbl_branch_row ['branch_name']); ?>"><?php echo strtoupper($tbl_branch_row ['branch_name']); ?></option>
      <?php
	  
  }
	  
  ?>
  </select>
 </td>
   <tr>
   <?php include('connect.php');?>
  <tr>
  <input type="hidden" name="id" value="<?php echo $truck_row['id']; ?>">
   
    <td >Plate Number: </td>
  <td><input type="text"  name="platenumber" value="<?php echo strtoupper($truck_row ['truckplate']); ?>" id="text" onKeyUp="caps(this)" onKeyPress="return isNumbers(event)" required>
  <input type="hidden"  name="oldplatenumber" value="<?php echo strtoupper($truck_row ['truckplate']); ?>" >
   <input type="hidden"  name="branch" value="<?php echo strtoupper($truck_row ['branch']); ?>" >
 </td>
  </tr>
   <tr>
  <td>Owner: </td>
   
  <td><input type="text"  name="ownersname" value="<?php echo strtoupper($truck_row ['ownersname']); ?>" id="text" onKeyUp="caps(this)" onKeyPress="return isNumbers(event)" ></td>
  </tr>
  <tr>
  <td>Acquisition Cost (PhP):  </td>
   
  <td><input type="text"  name="acquisitioncost" value="<?php echo strtoupper($truck_row ['aquisitioncost']); ?>" id="extra7" onKeyPress="return isNumber(event)"></td>
  </tr>
   <tr>
  <td>Make: </td>
   
  <td><input type="text"  name="make" value="<?php echo strtoupper($truck_row ['make']); ?>" id="text" onKeyUp="caps(this)" onKeyPress="return isNumbers(event)" ></td>
  </tr>
  <tr>
  <td>Series: </td>
   
  <td><input type="text"  name="series" value="<?php echo strtoupper($truck_row ['series']); ?>" id="text" onKeyUp="caps(this)" onKeyPress="return isNumbers(event)" ></td>
  </tr>
  <tr>
  <td>Body Type: </td>
   
  <td><input type="text"  name="bodytype" value="<?php echo strtoupper($truck_row ['bodytype']); ?>" id="text" onKeyUp="caps(this)" onKeyPress="return isNumbers(event)" ></td>
  </tr>
  <tr>
  <td>Year Model: </td>
   
  <td><input type="text"  name="yearmodel" value="<?php echo strtoupper($truck_row ['yearmodel']); ?>"  onKeyPress="return isNumber(event)"></td>
  </tr>
    <tr>
  <td>Wheels: </td>
   
  <td>
  <select name="wheels">
  <option value="<?php echo $truck_row ['wheels']; ?>"><?php echo $truck_row ['wheels']; ?></option>
  <option value="2">2</option>
    <option value="4">4</option>
  <option value="6">6</option>
 <option value="10">10</option></td>
 </select>
  </tr>
   <tr>
  <td>Net Book Value (Php): </td>
   
  <td><input type="text"  name="netbookvalue" value="<?php echo strtoupper($truck_row ['netbookvalue']); ?>" id="extra7" onKeyPress="return isNumber(event)" ></td>
  </tr>
  <tr>
  <td>Amount (Php): </td>
   
  <td><input type="text"  name="amount" value="<?php echo strtoupper($truck_row ['amount']); ?>" id="extra7" onKeyPress="return isNumber(event)" ></td>
  </tr>
  <tr>
  <td>Vehicle Condition: </td>
   
  <td><textarea cols="22" rows="3" name="truckcondition" id="text" onKeyUp="caps(this)" onKeyPress="return isNumbers(event)"><?php echo strtoupper($truck_row ['truckcondition']); ?></textarea></td>
  </tr>
 
</table>



<?php
$givento = mysql_query ("SELECT * FROM tbl_givento Where truckid='".$_GET['id']."'") or die(mysql_error());
$given_row = mysql_fetch_array($givento);

?>
<br />

<table align="center">
<tr>
				<td align="center" colspan="2"><h3>Given To</h3></td>
				<td></td>
			</tr>
  <tr>
  <input type="hidden"  name="truckid" value="<?php echo $given_row['id']; ?>" id="text" onKeyUp="caps(this)">
    <td >Supplier Name: </td>
  <td>
  <!---beginning of select -->
<link rel="stylesheet" href="../cbFilter/cbCss.css" />
<script src="../cbFilter/jquery-1.8.3.js"></script>
<script src="../cbFilter/jquery-ui.js"></script>
<style>
    #sup_picker{
        font-size:14px;
        width:500px;
    }
    .ui-combobox {
        position: relative;
        display: inline-block;
    }
    .ui-combobox-toggle {
        position: absolute;
        top: 0;
        bottom: 0;
        margin-left: -1px;
        padding: 0;
        /* adjust styles for IE 6/7 */
        *height: 1.7em;
        *top: 0.1em;
    }
    .ui-combobox-input {
        margin: 0;
        padding: 0.3em;
    }
</style>
<script>
    (function( $ ) {
        $.widget( "ui.combobox", {
            _create: function() {
                var input,
                that = this,
                select = this.element.hide(),
                selected = select.children( ":selected" ),
                value = selected.val() ? selected.text() : "",
                wrapper = this.wrapper = $( "<span>" )
                .addClass( "ui-combobox" )
                .insertAfter( select );

                function removeIfInvalid(element) {
                    var value = $( element ).val(),
                    matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( value ) + "$", "i" ),
                    valid = false;
                    select.children( "option" ).each(function() {
                        if ( $( this ).text().match( matcher ) ) {
                            this.selected = valid = true;
                            return false;
                        }
                    });
                    if ( !valid ) {
                        // remove invalid value, as it didn't match anything
                        $( element )
                        .val( "" )
                        .attr( "title", value + " didn't match any item" )
                        .tooltip( "open" );
                        select.val( "" );
                        setTimeout(function() {
                            input.tooltip( "close" ).attr( "title", "" );
                        }, 2500 );
                        input.data( "autocomplete" ).term = "";
                        return false;
                    }
                }

                input = $( "<input>" )
                .appendTo( wrapper )
                .val( value )
                .attr( "title", "" )
                .addClass( "ui-state-default ui-combobox-input" )
                .autocomplete({
                    delay: 0,
                    minLength: 0,
                    source: function( request, response ) {
                        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
                        response( select.children( "option" ).map(function() {
                            var text = $( this ).text();
                            if ( this.value && ( !request.term || matcher.test(text) ) )
                                return {
                                    label: text.replace(
                                    new RegExp(
                                    "(?![^&;]+;)(?!<[^<>]*)(" +
                                        $.ui.autocomplete.escapeRegex(request.term) +
                                        ")(?![^<>]*>)(?![^&;]+;)", "gi"
                                ), "<strong>$1</strong>" ),
                                    value: text,
                                    option: this
                                };
                        }) );
                    },
                    select: function( event, ui ) {
                        ui.item.option.selected = true;
                        that._trigger( "selected", event, {
                            item: ui.item.option
                        });
                    },
                    change: function( event, ui ) {
                        if ( !ui.item )
                            return removeIfInvalid( this );
                    }
                })
                .addClass( "ui-widget ui-widget-content ui-corner-left" );

                input.data( "autocomplete" )._renderItem = function( ul, item ) {
                    return $( "<li>" )
                    .data( "item.autocomplete", item )
                    .append( "<a>" + item.label + "</a>" )
                    .appendTo( ul );
                };

                $( "<a>" )
                .attr( "tabIndex", -1 )
                .attr( "title", "Show All Items" )
                .tooltip()
                .appendTo( wrapper )
                .button({
                    icons: {
                        primary: "ui-icon-triangle-1-s"
                    },
                    text: false
                })
                .removeClass( "ui-corner-all" )
                .addClass( "ui-corner-right ui-combobox-toggle" )
                .click(function() {
                    // close if already visible
                    if ( input.autocomplete( "widget" ).is( ":visible" ) ) {
                        input.autocomplete( "close" );
                        removeIfInvalid( input );
                        return;
                    }

                    // work around a bug (likely same cause as #5265)
                    $( this ).blur();

                    // pass empty string as value to search for, displaying all results
                    input.autocomplete( "search", "" );
                    input.focus();
                });

                input
                .tooltip({
                    position: {
                        of: this.button
                    },
                    tooltipClass: "ui-state-highlight"
                });
            },

            destroy: function() {
                this.wrapper.remove();
                this.element.show();
                $.Widget.prototype.destroy.call( this );
            }
        });
    })( jQuery );

    $(function() {
        $( "#combobox" ).combobox();
        $( "#toggle" ).click(function() {
            $( "#combobox" ).toggle();
        });
    });
</script>
<?php  include('connect_out.php');
$selectp = mysql_query("Select * from supplier_details Where branch LIKE '%".$given_row['name']."%' Order by supplier_id Asc") or die(mysql_error());?>
<span id='sup_picker'><select name='supplier_name' id='combobox' >
<option value="<?php echo $given_row['suppliername'];?>"><?php echo $given_row['suppliername'];?></option>
<?php
while($rowp = mysql_fetch_array($selectp)){
?>
<option value="<?php echo $rowp['supplier_id'].'_'.$rowp['supplier_name'];?>"><?php echo $rowp['supplier_id'].'_'.$rowp['supplier_name'];?></option>
<?php }?>
</select>
</span>

<!---end of select -->
 </td>
  </tr>
  <td>Issuance Date:  </td>
   
  <td><input type="date"  name="issuancedate" value="<?php echo $given_row ['issuancedate']; ?>" ></td>
   <tr>
  <td>End Date: </td>
   
  <td><input type="date"  name="enddate" value="<?php echo $given_row ['enddate']; ?>" ></td>
  </tr>
  <tr>
  <td>Amortization: </td>
   
  <td><input type="text"  name="amortization" value="<?php echo strtoupper($given_row ['amortization']); ?>" id="text" onKeyUp="caps(this)"></td>
  </tr>
  <tr>
  <td>Cash Bond: </td>
   
  <td><input type="text"  name="cashbond" value="<?php echo strtoupper($given_row ['cashbond']); ?>" id="extra7" onKeyPress="return isNumber(event)"></td>
  </tr>
   <tr>
  <td>Proposed Volume: </td>
   
  <td><input type="text"  name="volume" value="<?php echo strtoupper($given_row ['proposedvolume']); ?>" id="text" onKeyUp="caps(this)"></td>
  </tr>
     <tr>
  <td>Remarks: </td>
   
  <td><textarea  name="remarks" id="text" cols="22" rows="3"  onKeyUp="caps(this)"><?php echo strtoupper($given_row ['remarks']); ?></textarea></td>
  </tr>
 
 
</table>

 <center>
 <br /><input type="submit" value="Update" onClick="return confirm('Update Vehicle?');"> </form></td>
  </center>
 <br /><br />
<img src="../image/footer.png" height="8%" width="100%">                       
</body>
</html>                                     
												