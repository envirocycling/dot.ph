<?php
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}
include('../title.php');
?>

    <link rel="stylesheet" href="../css/tables.css">
 <?php
 include('connect.php');
 ?>
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
<script>
function openwin(){
	 window.open("re_view.php?id=<?php echo $id?>","TH","width=500, height=500");
	}
</script>
<?php //=====================================================?>
<?php // auto submit if change==================================================================?>
<script>
function onSelectChange(){
 document.getElementById('frm').submit();
}</script>
<?php //disabledfileds=====-=-=--=-==-===---------------------------[?>
<script>
function active(){
  if(document.getElementById('checkbox').checked){
   ;
	      document.getElementById('pdate').disabled=false;
	 document.getElementById('adate').disabled=false;
	  document.getElementById('quantity').disabled=false;
	   document.getElementById('reassign').disabled=false;
	    document.getElementById('sold').disabled=false;

}else{
   
	   document.getElementById('pdate').disabled=true;
	   	   document.getElementById('adate').disabled=true;
	   	  document.getElementById('quantity').disabled=true;
	   document.getElementById('reassign').disabled=true;
	    document.getElementById('sold').disabled=true;
	   }
}</script>
<?php //======================================================================================?>

	<script>
		function caps(element){
    element.value = element.value.toUpperCase();
		}
	</script>
 <?php // headermenu==============?>
    <link rel="stylesheet" href="../css/header.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="../js/header.js"></script>
   <img src="../image/header.png" height="25%" width="100%">
	
<div id='cssmenu'>
<ul>

   <li><a href="new_truck.php">New Vehicle</a></li>
   <li ><a href="existing_truck.php">Existing Vehicles</a></li>
      <li><a href='maintenance.php'>Maintenance</a></li>
   <li><a href="registration_monitoring.php">Vehicle Registration</a></li>
     <li  class='active'><a href="truck_reassign.php">Vehicle Reassignment</a></li>
      <li><a href='summary.php'>Summary</a></li>
       <li><a href='trip.php'>Trip Schedule</a></li>
        <li>|                |</li> 
        <li><a href='myaccount.php' rel="facebox">MyAccount</a></li>
            <li><a href='otheraccount.php'>Other Account</a></li>
         <li><a href="logout.php">Logout</a></li>
</ul>
</div><br /> 
<?php //startofcode===========================================================================?>
<br />
<form action="b.php" method="post" id="frm">
		<table align="center">
			<tr>
				<td colspan="2"><h3>Truck Reassignment</h3></td>
                <td></td>
            </tr>
  </table>
 <center>
 <table width="60%" >
 


<tr>
<td width="50%">
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
<span id="sup_picker">
Select Plate No.
<select name="plate" onchange="onSelectChange();" id="combobox">
<?php
$query=mysql_query("Select * from tbl_truck_report") or die (mysql_error());
while($row = mysql_fetch_array($query)){
	$select_pending = mysql_query("Select * from tbl_reassign Where truckid='".$row['id']."' order by id Asc") or die(mysql_error());
	if(mysql_num_rows($select_pending) > 0){}else{
	?>

    <option value="<?php echo $row['truckplate'];?>"><?php echo $row['truckplate'];?></option><?php
	}}
?>
</select>

</span>
</div>
<!---end of select -->

</td>
<td><input type="submit" value="Submit"></td>





</center>
</table>
</form>
<br /><br />
<?php 

$select = mysql_query("Select * from tbl_reassign Order by id Asc")or die (mysql_error());?>
<table width="60%"  align="center">
<tr>
<td>
<?php if(mysql_num_rows($select) > 0){?>
<h5>Pending</h5><?php }else{?><h5>No Pending</h5><?php } ?>
<table  class="CSSTableGenerator">
<td >Sending Branch</td>
<td>Plate No.</td>
<td>Receiving Branch</td>
<td>Prepared By</td>
<td>Description</td>
<td colspan="3">Action</td>
</tr>
<?php 
while($rows = mysql_fetch_array($select)){
	$plate =mysql_query("Select * from tbl_truck_report Where id='".$rows['truckid']."' ") or die(mysql_error());
	$rowp = mysql_fetch_array($plate); 
	?>
    <tr>
        <td><?php echo $rowp['branch'];?></td>
    <td><?php echo $rowp['truckplate'];?></td>
    <td><?php echo $rows['suppliername'];?></td>
    <td ><?php echo $rows['preparedby']; ?></td>
    <td ><?php echo $rows['status']; ?></td>
  
        <td >
    <br />
      <form action="re_view.php?id=<?php echo $rows['id'];?>" method="post">
            
      <input type="submit" name="view" value="View" ></form></td>

        <td ><br />
                  <form action="re_approve.php?id=<?php echo $rows['id'];?>" method="post">
    <input type="hidden" name="plate" value="<?php echo $rowp['truckplate'];?>">
     <input type="hidden" name="id" value="<?php echo $rowp['id'];?>">
     <input type="hidden" name="sendingbranch" value="<?php echo $rowp['branch'];?>">
     <?php
     $given = mysql_query("Select * from tbl_givento Where truckid='".$rowp['id']."'") or die(mysql_error());
	 $given_row =mysql_fetch_array($given);
	 ?>
     <input type="hidden" name="branch2" value="<?php echo $given_row['name'];?>">
     <input type="hidden" name="truckid" value="<?php echo $given_row['truckid'];?>">
     <input type="hidden" name="suppliername2" value="<?php echo $given_row['suppliername'];?>">
     <input type="hidden" name="issuancedate2" value="<?php echo $given_row['issuancedate'];?>"
     <input type="hidden" name="enddate2" value="<?php echo $given_row['enddate'];?>">
     <input type="hidden" name="amortization2" value="<?php echo $given_row['amortization'];?>">
     <input type="hidden" name="cashbond2" value="<?php echo $given_row['cashbond'];?>">
     <input type="hidden" name="proposedvolume2" value="<?php echo $given_row['proposedvolume'];?>">
        
        
    <input type="hidden" name="branch" value="<?php echo $rows['suppliername'];?>">
       <input type="hidden" name="issuancedate" value="<?php echo $rows['issuancedate'];?>">
         <input type="hidden" name="enddate" value="<?php echo $rows['enddate'];?>">
           <input type="hidden" name="amortization" value="<?php echo $rows['amotization'];?>">
             <input type="hidden" name="cashbond" value="<?php echo $rows['cashbond'];?>">
               <input type="hidden" name="proposedvolume" value="<?php echo $rows['proposedvolume'];?>">
    <input type="hidden" name="preparedby" value="<?php echo $rows['preparedby'];?>">
    <input type="hidden" name="remarks" value="<?php echo $rows['remarks'];?>">   
        <?php if($rows['approved'] == 1 ){?>
        <input type="submit" value="Accept" onclick="return confirm('Do you want to Accept?');">
        <?php }else {?>
		  <input type="submit" value="Accept" disabled="disabled">
		<?php }?></td>
   <td >      <a href="cancel.php?id=<?php echo $rows['id'];?>"> <input type="button" value="Cancel" onclick="return confirm('Do you want to Cancel?');"></a></td></form>
   
    </tr>
	<?php }
?>
</table>
</td>
</tr>
</table>

<?php //endtofcode===========================================================================?>

<br /><br />
<br /><br />
<br /><br />
<br /><br />
<br /><br />
<br /><br />
<br /><br />
<img src="../image/footer.png" height="8%" width="100%">     