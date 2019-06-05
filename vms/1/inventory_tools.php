<?php
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}

include('../title.php');
	?>


  <link href="../css/table.css" media="screen" rel="stylesheet" type="text/css" />
 <?php
 include('connect.php');
 ?><?php //facebox==========================================================================?>

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
      <li ><a href='maintenance.php'>Maintenance</a></li>
   <li ><a href="registration_monitoring.php">Vehicle Registration</a></li>
     <li><a href="truck_reassign.php">Vehicle Reassignment</a></li>
      <li  class='active'><a href='inventory.php'>Inventory</a></li>
        <li>|                |</li> 
        <li><a href='myaccount.php' rel="facebox">MyAccount</a></li>
            <li><a href='otheraccount.php'>Other Account</a></li>
         <li><a href="logout.php">Logout</a></li>
</ul>
</div><br /> 
<?php //startofcode===========================================================================?>
<br />

		<table  width="80%" align="center">
		<tr>
			<td align="center" colspan="2"><h3>Maintenance</h3></td>
      			<td></td>
			</tr>
            <tr>
              <td align="center" colspan="2"><h4>Tools</h4></td>
              <td></td>
			</tr>
</table> 

  <br />
  <table width="40%" align="center"><tr>  <form id="frm" action="i.php" method="post"><td>

Select:
<select name="filter"  onchange="onSelectChange();">
<option value="<?php echo $_GET['id'];?>"><?php echo $_GET['id'];?></option>
<option value="TOOLS">TOOLS</option>
<option value="TIRE">TIRE</option>
<option value="BATTERY">BATTERY</option>
</select>
</form>
</td>
</tr>
</table>
<br />
  <table align="center"  >
  <form action="in_add_tool.php"  method="post">
  <tr>
  <td valign="middle">Tool Name:
    <input type="text" name="name" id="text" onKeyUp="caps(this)" required></td>
  
  <td>Description:</td>
  <td valign="middle"><textarea name="des" cols="20" rows="2" id="text" onKeyUp="caps(this)"></textarea>
  </td>
    <td><input type="submit" value="Add New Tool"></td>
  </tr>
  </form>

  <form action="inventory_addtool.php"  method="post">
<tr>
<td>  <br />  <br /></td>
</tr>
  <tr>
  <td valign="middle">
  
  
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
Select Tool:<select name="tools" id="combobox" >

		<?php 
		$tool = mysql_query("Select * from tbl_tool") or die (mysql_error());
		while($t_row = mysql_fetch_array($tool)){
			?>
             
       	<option value="<?php echo $t_row['name'];?>"><?php echo $t_row['name'];?></option>
		<?php
		}
		?></select>
</span>

<!---end of select -->
  
  </td>
  
  <td>Quantity:</td>
  <td valign="middle">
  </td>
    <td><input type="submit" value="Add to Tool"></td>
  </tr>
  </form>
  </table>
  <br /><br /><form action="" target="_self" method="post">
    <table width="40%" align="center">
    <tr><td>
     <?php if(isset($_POST['search'])){?>
  <input type="submit" name="search" value="Search"><input type="text" name="text" value="<?php echo $_POST['text'];?>" placeholder="Type Here" onKeyUp="caps(this)"><?php }else{?>
  <input type="submit" name="search" value="Search"><input type="text" name="text" placeholder="Type Here" onKeyUp="caps(this)"><?php }?>
   </td></tr>
    <tr><td>
<table align="center" width="60%" border="1px" class="CSSTableGenerator">
<tr>
<td  colspan="2"align="center">Tool Name</td>
<td align="center">Quantity</td>
<td align="center">Issued</td>
<td align="center">Available</td>
<td align="center" >Action</td>
</tr>

<?php
$num=0;
if(isset($_POST['search'])){
	$text =$_POST['text'];
	$tool = mysql_query("Select * from tbl_addinventorytool Where name LIKE '%$text%' or qty LIKE '%$text%' or issued LIKE '%$text%' Order by name Asc") or die(mysql_error());}else{
$tool = mysql_query("Select * from tbl_addinventorytool Order by name Asc") or die (mysql_error());}
 while($row = mysql_fetch_array($tool)){

$num++;
?>
<tr>
<td width="3%"><?php echo $num?></td>
<td><?php echo $row['name'];?></td>
<td><?php echo $row['qty']; ?></td>
<td><?php echo $row['issued']; ?></td>
<td><?php $qty = $row['qty'];
$issued = $row['issued'];
$remaining = $qty - $issued;
echo $remaining; ?>
</td>
<td width="5%" align="center"><a rel="facebox" href="in_edittool.php?id=<?php echo $row['id'];?>"><input type="button" value="Edit"></a></td>
</tr>
<?php } ?>
</table>
</td></tr></table>
<?php //endtofcode===========================================================================?>
<br /><br />
<img src="../image/footer.png" height="8%" width="100%">     