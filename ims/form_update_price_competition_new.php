<?php
session_start();
?>

<h3>Update Pricing Records</h3><hr>
<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
    function date1(str){
        new JsDatePick({
            useMode:2,
            target:str,
            dateFormat:"%Y/%m/%d"

        });
    };
</script>
<link rel="stylesheet" href="cbFilter/cbCss.css" />
<script src="cbFilter/jquery-1.8.3.js"></script>
<script src="cbFilter/jquery-ui.js"></script>
<style>

    #paliit{
        font-size:12px;
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
<?php
include("config.php");
$branch = $_SESSION['user_branch'];
if ($branch == "kaybiga" || $branch == "Sauyo") {
    $company = "Quezon City";
} else {
    $company=$branch;
}
echo "<form action='update_price_competition_exec.php' method='POST'>";

echo "Company: <input type='text' value='' name='company' required><br>";
echo "Company Type: <select name='company_type'>";
echo "<option>competitor</option>";
echo "<option>branch</option>";

echo "</select><br>";
echo "WP Grade:";
$query = "SELECT * FROM wp_grades ";
$result = mysql_query($query) ;
$dropdown = "<select name='wp_grade' >";

while($row = mysql_fetch_array($result)) {
    $dropdown .= "\r\n<option value='{$row['wp_grade']}'>{$row['wp_grade']}</option>";
}
$dropdown  .= "</select><br>";
echo $dropdown;

echo "Branch Affected:<input type='text' name='branch_affected' value='$company' readonly><br>";
?>
Price:<input type="text" name="price" value="" size="4" required><br>
Max Price:<input type="text" name="max_price" value="" size="4" required><br>
Date: <input type='text'  id='inputField' name='date' value="<?php echo date('Y/m/d');?>" onfocus='date1(this.id);' readonly size="8"><br>
Source:<input type="text" name="source" value="" size="20"><br>

<?php
$dropdown = "<select name='wp_grade' >";

while($row = mysql_fetch_array($result)) {
    $dropdown .= "\r\n<option value='{$row['wp_grade']}'>{$row['wp_grade']}</option>";
}
$dropdown  .= "</select><br>";


$query = "SELECT * FROM users where user_type='Super User'  ";
$result = mysql_query($query) ;
echo "To be verified by:";
$dropdown = "<select name='verified_by' >";
$dropdown .= "\r\n<option value='lorna_regala'>Lorna Regala</option>";
while($row = mysql_fetch_array($result)) {
    $dropdown .= "\r\n<option value='{$row['user_id']}'>{$row['name']}</option>";
}
$dropdown  .= "\r\n</select><br>";
echo $dropdown;




$dropdown = "<select name='wp_grade' >";

while($row = mysql_fetch_array($result)) {
    $dropdown .= "\r\n<option value='{$row['wp_grade']}'>{$row['wp_grade']}</option>";
}
$dropdown  .= "</select><br>";


$query = "SELECT * FROM users where user_type='Super User'  ";
$result = mysql_query($query) ;
echo "To be approved by:";
$dropdown = "<select name='approved_by' >";
$dropdown .= "\r\n<option value='lorna_regala'>Lorna Regala</option>";
while($row = mysql_fetch_array($result)) {
    $dropdown .= "\r\n<option value='{$row['user_id']}'>{$row['name']}</option>";
}
$dropdown  .= "\r\n</select><br>";
echo $dropdown;


?>




<input type="submit" value="Record">
<?php

echo "</form><br>";

?>