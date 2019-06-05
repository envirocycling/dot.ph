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
<?php
include('connect.php');
$select = mysql_query("Select * from tbl_trip Where id='".$_GET['id']."'") or die(mysql_error());
$select_row = mysql_fetch_array($select);
$plate = mysql_query("Select * from tbl_truck_report Where id='".$select_row['truckid']."' ") or die(mysql_error());
$plate_row = mysql_fetch_array($plate);
$d = explode('.',$select_row['diesel']);
$cost1 =$d[0];
$cost2 =$d[1];
?>
<center>
<table  width="80%" align="center" >
		<tr>
				<td align="center" colspan="2"><h3>Trip Schedule Edit</h3></td>
				<td></td>
			</tr>
	</table>  
   
    <center>
    <form action="trip_before2.php?id=<?php echo $_GET['id'];?>" target="trip_table" method="post" >
    <table>
    <tr>
    <td>
    <br />    <br />
    <table width="340px">
    <tr>
    <td width="17%">Plate:</td>
    <td width="50%"><input type="text"  value="<?php echo $plate_row['truckplate'];?>" style="width:100%;" disabled>
    <input type="hidden" name="plate" value="<?php $plate_row['truckplate'];?>"  ></td>
    </tr>
    <tr>
    <td>Date:</td>
    <td><input type="date" name="date" value="<?php echo $select_row['date']; ?>" style="width:100%;" id="date" required></td>
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
<option value="<?php echo $select_row['supplier']; ?>"><?php echo $select_row['supplier']; ?></option>
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
    <td><input type="text" name="location" id="location" value="<?php echo $select_row['location']; ?>" onKeyUp="caps(this)"  style="width:100%;" required></td>
    </tr>
         <tr>
    <td>Driver:</td>
    <td><input type="text" onKeyUp="caps(this)" name="driver" value="<?php echo $select_row['driver']; ?>" id="driver"  style="width:100%;"></td>
    </tr>
    <tr>
    <td>Helper:</td>
    <td><input type="text" name="helper" onKeyUp="caps(this)" id="helper" value="<?php echo $select_row['helper']; ?>"  style="width:100%;" ></td>
    </tr>
    <tr>
    <td>Remarks:</td>
    <td><textarea name="remarks"  rows="3" onKeyUp="caps(this)" id="remarks" style="width:100%"><?php echo $select_row['remarks'];?></textarea></td>
    </tr>
    </table>
    </td>
    <td>
    <table width="350px">
    <tr>
    <td width="50%">Beg. Measure (cm):</td>
    <td><input type="text" name="beg" id="beg" value="<?php echo $select_row['beg']; ?>" onKeypress="return isNumber(event)"  style="width:100%;" required></td>
    </tr>
     <tr>
    <td>Ending Measure (cm):</td>
    <td><input type="text" name="end" value="<?php echo $select_row['end']; ?>" id="end" style="width:100%;" required> </td>
    </tr>
    <tr>
    <td>Diesel Conversation:</td>
    <td>
    <input type="text" maxlength="3" value="<?php echo $select_row['out1']; ?>" id="out1" min="0" name="out1" onKeypress="return isNumber(event)" style="width:25%" required>
    <font size="+3">.</font>
    <input type="text" maxlength="2" id="out2" name="out2" value="<?php echo $select_row['out2']; ?>"  pattern=".{2,}"  title="2 characters minimum"  onKeypress="return isNumber(event)" style="width:25%"  required></td>
    </tr>
       <td>Current Diesel Cost(Php):</td>
    <td><input type="text" maxlength="3" value="<?php echo $cost1; ?>" id="cost1"  min="0" name="cost1" onKeypress="return isNumber(event)" style="width:25%" required><font size="+3">.</font>
    <input type="text" value="<?php echo $cost2; ?>" maxlength="2"  id="cost2" pattern=".{2,}"  title="2 characters minimum" name="cost2" onKeypress="return isNumber(event)" style="width:25%"  required></td>
    </tr>

    <tr>
    <td colspan="2" align="right"><br><input type="submit" name="update" value="Update"></td>
    </tr>
    </table>
    <td>
    </tr>
    <table>
  
    </form>
   
</center>