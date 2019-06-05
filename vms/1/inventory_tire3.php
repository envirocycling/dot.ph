<?php
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}
?>
<?php include('connect.php');?>

<link href="../css/table.css" media="screen" rel="stylesheet" type="text/css" />

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
<?php
$select_plate = mysql_query("Select * from tbl_truck_report Where id='".@$_POST['plate']."' or id='".@$_GET['p']."'") or die(mysql_error());
$row_plate = mysql_fetch_array($select_plate);
?>
<br />
<br />
<form action="inventory_tire3.php" method="post" id="frm"  target="in_tire">
<table width="40%" align="left">

<tr><td align="right">
Plate:</td><td width="70%">


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

<span id='sup_picker'><select name="plate"  onchange="onSelectChange();" id="combobox">
<?php 
$select_truck  = mysql_query("Select * from tbl_truck_report ORDER by ending ASC") or die (mysql_error());
$select = mysql_query("Select * from tbl_truck_report Where id='".$_POST['plate']."' or id='".$_GET['p']."'") or die(mysql_error());
$row_trucks  = mysql_fetch_array($select);?>
<option value="<?php echo $row_trucks['truckplate'];?>"><?php echo $row_trucks['truckplate'];?></option><?php
while ($row_truck  = mysql_fetch_array($select_truck)){
?>
<option value="<?php echo $row_truck['id'];?>"><?php echo $row_truck['truckplate'];?></option>
<?php } ?>
</select>
</span>

<!---end of select -->
</td>

<td colspan="2" align="center" width="60%"><a href="in_addtire.php?p=<?php echo $_POST['plate'];?>" rel="facebox"><input type="button" value="Add Tire"></a></td></tr>

</table>
</form>
<br />

  <center>
 <table width="80%" align="center"><tr><td>
<table align="center" width="60%" border="1px" class="CSSTableGenerator">
<tr>
<td align="center">Tire ID</td>
<td align="center" width="18%">Tire Position</td>
<td align="center">Tire Name</td>
<td align="center">Tire Size</td>
<td align="center">Decription</td>
<td align="center">Status</td>

</tr>

<?php
$num=0;
if(@$_POST['plate'] == ''){$tool = mysql_query("Select * from tbl_trucktires ORDER by tireid ASC ") or die (mysql_error());}else{
$tool = mysql_query("Select * from tbl_trucktires Where truckplate='".@$_POST['plate']."' ORDER by tireid ASC ") or die (mysql_error());}
 while($row = mysql_fetch_array($tool)){

$num++;
?>
<tr>
<td width="5%"><?php echo $row['tireid'];?></td>
<td><?php
if($row_plate['wheels']== 4){
if($row['position'] == 1){
	$position = "Front Left";
	}else
if($row['position'] == 2){
	$position = "Front Right";
	}else
if($row['position'] == 3){
	$position = "Back Left";
	}else
if($row['position'] == 4){
	$position = "Back Right";
	}else{$position="Spare";}
	echo $position;
	
}else if($row_plate['wheels'] == 10){
if($row['position'] == 1){
	$position2 = "Front Left";
	}else
if($row['position'] == 2){
	$position2 = "Front Right";
	}else
if($row['position'] == 3){
	$position2 = "2nd Left Outer";
	}else
if($row['position'] == 4){
	$position2 = "2nd Left Inner";
	}
if($row['position'] == 5){
	$position2 = "2nd Right Inner";
	}
if($row['position'] == 6){
	$position2 = "2nd Right Outer";
	}
if($row['position'] == 7){
	$position2 = "3rd Left Outer";
	}
if($row['position'] == 8){
	$position2 = "3rd Left Inner";
	}
if($row['position'] == 9){
	$position2 = "3rd Right Outer";
	}
if($row['position'] == 10){
	$position2 = "3rd Right Inner";
	}
else{$position2="Spare";}	

	echo $position2;
}else if($row_plate['wheels'] == 6){
if($row['position'] == 1){
	$position3 = "Front Left";
	}else
if($row['position'] == 2){
	$position3 = "Front Right";
	}else
if($row['position'] == 3){
	$position3 = "2nd Left Outer";
	}else
if($row['position'] == 4){
	$position3 = "2nd Left Inner";
	}
if($row['position'] == 5){
	$position3 = "2nd Right Inner";
	}
if($row['position'] == 6){
	$position3 = "2nd Right Outer";
	}
else{$position3="Spare";}	

	echo $position3;
}
 ?></td>
<td><?php echo $row['tirename'];?></td>
<td><?php echo $row['tiresize']; ?></td>
<td><?php echo $row['description']; ?></td>
<td><?php echo $row['status']; ?></td>



</tr>
<?php } ?>
</table>
</td></tr></table>
</center>