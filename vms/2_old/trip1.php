	<?php
session_start();
if(!isset($_SESSION['bhead_username'])){
	header("Location: ../index.php");
	}

if(isset($_POST['trips'])){
	
	 include('connect.php');
$id=$_GET['id'];	
$plate = mysql_query("Select * from tbl_truck_report Where truckplate ='".$_GET['id']."'") or die(mysql_error());
$row = mysql_fetch_array($plate);
$diesel = $_POST['cost1'].'.'.$_POST['cost2'];
mysql_query("Insert into tbl_trip Set truckid='".$row['id']."',date='".$_POST['date']."',supplier='".$_POST['supplier']."',location='".$_POST['location']."',beg='".$_POST['beg']."',end='".$_POST['end']."',out1='".$_POST['out1']."',out2='".$_POST['out2']."',diesel='$diesel',driver='".$_POST['driver']."',helper='".$_POST['helper']."',remarks='".$_POST['remarks']."'")or die(mysql_error());

header("Location: trip1.php?id=$id");
}
?>
 <title>EFI Vehicles Report</title>
  <link href="../css/table.css" media="screen" rel="stylesheet" type="text/css" />
 <?php
 include('connect.php');
 ?>
 
<?php // auto submit if change==================================================================?>
<script>
function onSelectChange(){
 document.getElementById('frm').submit();
}</script>
 <?php //======================================================================================?>
	<script>
		function caps(element){
    element.value = element.value.toUpperCase();
		}
	</script>
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
      <li ><a href='maintenance.php'>Maintenance</a></li>
   <li ><a href="registration_monitoring.php">Vehicle Registration</a></li>
     <li><a href="truck_reassign.php">Vehicle Reassignment</a></li>
	<li><a href='summary.php'>Summary</a></li>
     <li  class="active"><a href='trip.php'>Trip Schedule</a></li>
        <li>|                |</li> 
        <li><a href='myaccount.php' rel="facebox">MyAccount</a></li>
         <li><a href="logout.php">Logout</a></li>
</ul>
</div><br /> 
<?php //startofcode===========================================================================?>

<center>
<table  width="80%" align="center" >
		<tr>
				<td align="center" colspan="2"><h3>Trip Schedule</h3></td>
				<td></td>
			</tr>
	</table>  
   
	<br />
    <br />
    <br />
    <center>
    <form action="" target="_self" method="post">
    <table width="30%">
    <tr>
    <td>Plate:</td>
    <td width="50%"><input type="text"  value="<?php echo $_GET['id'];?>" style="width:100%;" disabled>
    <input type="hidden" name="plate" value="<?php echo $_GET['id'];?>"  ></td>
    </tr>
    <tr>
    <td>Date:</td>
    <td><input type="date" name="date"  style="width:100%;" id="date" required></td>
    </tr>
    <tr>
    <td>Supplier:</td>
    <td> <!---beginning of select -->
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
$selectp = mysql_query("Select * from supplier_details  Order by supplier_id Asc") or die(mysql_error());?>
<span id='sup_picker'><select name='supplier' id='combobox' style="width:100%" >
<?php
while($rowp = mysql_fetch_array($selectp)){
?>
<option value="<?php echo $rowp['supplier_id'].'_'.$rowp['supplier_name'];?>"><?php echo $rowp['supplier_id'].'_'.$rowp['supplier_name'];?></option>
<?php }?>
</select>
</span>

<!---end of select --></td>
    </tr>
    <tr>
    <td>Location:</td>
    <td><input type="text" name="location" id="location" onKeyUp="caps(this)"  style="width:100%;" required></td>
    </tr>
    <tr>
    <td>Beg. Measure (cm):</td>
    <td><input type="text" name="beg" id="beg" onKeypress="return isNumber(event)"  style="width:100%;" required></td>
    </tr>
     <tr>
    <td>Ending Measure (cm):</td>
    <td><input type="text" name="end" onKeypress="return isNumber(event)" id="end" style="width:100%;" required> </td>
    </tr>
    <tr>
    <td>Diesel Conversation:</td>
    <td>
    <input type="text" maxlength="3" id="out1" min="0" name="out1" onKeypress="return isNumber(event)" style="width:25%" required><font size="+3">.</font><input type="text" maxlength="2" id="out2" name="out2"  pattern=".{2,}"  title="2 characters minimum"  onKeypress="return isNumber(event)" style="width:25%"  required></td>
    </tr>
       <td>Current Diesel Cost(Php):</td>
    <td><input type="text" maxlength="3" id="cost1"  min="0" name="cost1" onKeypress="return isNumber(event)" style="width:25%" required><font size="+3">.</font><input type="text" maxlength="2"  id="cost2" pattern=".{2,}"  title="2 characters minimum" name="cost2" onKeypress="return isNumber(event)" style="width:25%"  required></td>
    </tr>
     <tr>
    <td>Driver:</td>
    <td><input type="text" name="driver" id="driver" onKeyUp="caps(this)"  style="width:100%;"></td>
    </tr>
    <tr>
    <td>Helper:</td>
    <td><input type="text" name="helper" id="helper" onKeyUp="caps(this)"  style="width:100%;" ></td>
    </tr>
    <tr>
    <td>Remarks:</td>
    <td><textarea name="remarks"  rows="3" id="remarks" onKeyUp="caps(this)" style="width:100%"></textarea></td>
    </tr>
    <tr>
    <td colspan="2" align="right"><br><input type="submit" name="trips" value="Submit"></td>
    </tr>
    </table>
    </form>
    <br /><br />


    
    	<table width="90%"> <tr>
    <td align="left"><h4>Plate: <?php echo $_GET['id'];?></h4></td>
    </tr>
    </table>
<iframe width="90%" height="60%" frameborder="0" src="trip_table.php?id=<?php echo $_GET['id'];?>" name="trip_table"></iframe>
   </center>
 
<?php //endtofcode===========================================================================?>
<br /><br />
<img src="../image/footer.png" height="8%" width="100%">     