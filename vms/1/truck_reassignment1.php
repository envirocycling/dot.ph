<?php
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}
include('../title.php');
?>

 <?php
 include('connect.php');

 ?>
     <link rel="stylesheet" href="../css/tables.css">

   <script src="../js/val_tools.js" type="text/javascript"></script>
 <script>
function getData(dropdown) {
var value = dropdown.options[dropdown.selectedIndex].value;
if (value != 'none'){
document.getElementById("name").style.display = "block";
document.getElementById("name").disabled = false;
}else if(value == 'none'){
	document.getElementById("name").disabled = true;
	} 
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
 <?php // auto submit if change==================================================================?>
<script>
function onSelectChange(){
 document.getElementById('frm').submit();
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
 <?php // headermenu==============?>
    <link rel="stylesheet" href="../css/header.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="../js/header.js"></script>
   <img src="../image/header.png" height="25%" width="100%">
	
<div id='cssmenu'>
<ul>

   <li><a href="new_truck.php">New Truck</a></li>
   <li  ><a href="existing_truck.php">Existing Trucks</a></li>
     <li><a href='maintenance.php'>Maintenance</a></li>
   <li><a href="registration_monitoring.php">Truck Registration</a></li>
     <li class='active'><a href="truck_reassign.php">Truck Reassignment</a></li>
      <li><a href='inventory.php'>Inventory</a></li>
 
        <li>|                |</li> 
            <li><a href='myaccount.php' rel='facebox'>MyAccount</a></li>
            <li><a href='otheraccount.php'>Other Account</a></li>
         <li><a href="logout.php">Logout</a></li>
</ul>
</div><br /> 

<?php //startofcode===========================================================================?>
<br />

		<table align="center">
			<tr>
				<td colspan="2"><h3>Truck Reassignment</h3></td>
                <td></td>
            </tr>
  </table>

   <center>	
 <br />
 <table width="70%" >
 

<tr><td><br /></td></tr>
<tr>


 </td>
<td>Plate No.<input  type="text" name="f_palte" value="<?php echo $_GET['p'];?>"  disabled="disabled"></td>



         <td  width="30%" align="left">Suppliername:<?php
	$given = mysql_query("Select * from tbl_truck_report Where truckplate='".@$_GET['p']."'") or die(mysql_error());
	$givenrow = mysql_fetch_array($given);
	$given_name = $givenrow['id'];
	$select = mysql_query("Select * from tbl_givento Where truckid='$given_name' ") or die (mysql_error());
	$select_row = mysql_fetch_array($select);
	
	?>
    <input type="text" value="<?php 	echo $select_row['suppliername'];?>"  disabled="disabled">

   
    </td>
<td  align="left">Branch: <input type="text"  value="<?php echo $givenrow['branch'];?>"  disabled="disabled">
</td>
</tr>
</table>

 
 <br />
  
<table  width="80%" align="center" >
            <tr>
              <td align="center" colspan="2"><h4>List of Added Tools</h4></td>
           
			</tr>
            </table>
             <form id="frm" action="truck_reassignment11.php?p=<?php echo $_GET['p'];?>" method="post">
               <input type="hidden" name="plate" value="<?php echo $_POST['plate']?>"> 
                <input type="hidden" name="branch" value="<?php echo $givenrow['branch'];?>"  >
                    <input type="hidden" name="suppname_old" value="<?php 	echo $select_row['suppliername'];?>"  >
                <table align="center" width="50%" >

<tr><td>
</td>
</tr>
</table>

<table width="50%"  align="center">
<tr>
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

<span id='sup_picker'>
Select Tool:<select name="tool" onChange="onSelectChange()" id="combobox">
<option value=" ">Add Another Tool</option>
<?php
$select = mysql_query("Select * from tbl_addinventorytool Where zero=0") or die (mysql_query());
while($row = mysql_fetch_array($select)){
?>
<option value="<?php echo $row['name'];?>"><?php echo $row['name'];?></option>
<?php } ?>
<select>
</span>

<!---end of select -->
</td>
</tr>
</table>
 <br />
 <center>
        </form>
        <center>  
            <table width="40%" align="center"><tr><td>

<table   class="CSSTableGenerator" >
<tr>
<td align="center">Tool Name</td>
<td width="10%" align="center">Quantity</td>
<td width="10%" align="center">Reassign</td>
<td  align="center" width="20%" colspan="2">Sold</td>
</tr>
<?php
$select = mysql_query("Select * from tbl_truck_report Where truckplate='".$_GET['p']."'") or die(mysql_error());
$row_select = mysql_fetch_array($select);
$view = mysql_query("Select * from tbl_toolreassign Where  truckid='".$row_select['id']."'") or die (mysql_error());
while($vrow = mysql_fetch_array($view)){
	?>
   <form action="re_ok1.php?p=<?php echo $_GET['p'];?>" method="post" name="tools">
<input type="hidden" name="plate" value="<?php echo $vrow['truckid'];?>">
    <tr><td><input type="hidden" name="toolname" value="<?php echo $vrow['toolname'];?>"><?php echo $vrow['toolname'];?></td>
     <td align="center"><?php echo $vrow['qty'];?>
     </td>
     <td>
     <input type="number" style="width:60%" id="reasign" name="reassign" value="<?php echo $vrow['reassign'];?>" max="<?php echo $vrow['qty'];?>" min="0"></td>
      <td>
       <input type="number" id="sold" style="width:100%" name="sold"  max="<?php echo $vrow['qty'];?>" min="0" id="extra7" onKeyPress="return isNumber(event)" value="<?php echo $vrow['sold'];?>"></td>

    <td><input type='submit' value="OK" /></td>  
    <input type="hidden" name="branch" value="<?php echo $givenrow['branch'];?>" >
    <input type="hidden" name="suppname_old" value="<?php 	echo $select_row['name'];?>"  >
     <input type="hidden" name="qty" value="<?php echo $vrow['qty'];?>">
     <input type="hidden" name="dateadded" value="<?php echo $vrow['dateadded'];?>">
      <input type="hidden" name="id" value="<?php echo $vrow['ti'];?>">
    </form>
     </tr>

	<?php }

$view2 = mysql_query("Select * from tbl_trucktools Where  truckid='".$row_select['id']."'") or die (mysql_error());
while($vrow2 = mysql_fetch_array($view2)){
	?>
   <form action="re_ok.php?p=<?php echo $_GET['p'];?>" method="post" name="tools">
<input type="hidden" name="plate" value="<?php echo $vrow['truckid'];?>">
    <tr><td><input type="hidden" name="toolname" value="<?php echo $vrow2['toolname'];?>"><?php echo $vrow2['toolname'];?></td>
     <td align="center"><?php echo $vrow2['qty'];?>
     </td>
     <td>
     <input type="number" style="width:60%" id="reasign" name="reassign" value="<?php echo $vrow2['reassign'];?>" max="<?php echo $vrow2['qty'];?>" min="0"></td>
      <td>
       <input type="number" id="sold" style="width:100%" name="sold"  max="<?php echo $vrow2['qty'];?>" min="0" id="extra7" onKeyPress="return isNumber(event)" value="<?php echo $vrow2['sold'];?>"></td>

    <td><input type='submit' value="OK" /></td>  
    <input type="hidden" name="branch" value="<?php echo $givenrow['branch'];?>" >
    <input type="hidden" name="suppname_old" value="<?php 	echo $select_row['name'];?>"  >
     <input type="hidden" name="qty" value="<?php echo $vrow2['qty'];?>">
     <input type="hidden" name="dateadded" value="<?php echo $vrow['dateadded'];?>">
      <input type="hidden" name="id" value="<?php echo $vrow2['ti'];?>">
    </form>
     </tr>

	<?php }
?>


</table>
</td>
</tr>
   </table>  

  </td>
  </tr>
  </table>
  <br />
<br />
  <center>
  
  <a href="truck_reassignreview.php?p=<?php echo $_GET['p'];?>">
  <input type="button" value="Done"></a>
  </center>


<?php //endtofcode===========================================================================?>
<br /><br />
<br /><br />
<img src="../image/footer.png" height="8%" width="100%">     	