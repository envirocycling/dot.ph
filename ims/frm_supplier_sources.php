<?php
include('config.php');
include('templates/template.php');
?>

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

<style>
    body{
        background-color: #2e5e79;
    }
</style>

</head>
<div class="grid_8">
    <div class="box round first grid">
        <h2>Supplier Sources</h2>
        <br>
        <form action="supplier_sources.php" method="POST">
            <h6>
                Filtering Options
                <br>
                Supplier Name: <select name="supplier_id" id="combobox">

                    <?php
                    if (isset ($_POST['submit'])) {
                        $que = preg_split("[_]",$_POST['supplier_id']);
                        $supplier_id = $que[0];
                        $supplier_name = $que[1];
                        echo '<option value="'.$supplier_id.'_'.$supplier_name.'">'.$supplier_name.'</option>';
                    } else {
                        echo '<option value=""></option>';
                    }
                    $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE status!='inactive' ORDER BY supplier_name ASC");
                    while ($rs_sup = mysql_fetch_array($sql_sup)) {
                        echo "<option value='".$rs_sup['supplier_id']."_".$rs_sup['supplier_name']."'>".$rs_sup['supplier_id']."_".$rs_sup['supplier_name']."</option>";
                    }
                    ?>

                </select>
                WP Grade: <select name="wp_grade">
                    <?php
                    if (isset ($_POST['submit'])) {
                        $wp_grade =$_POST['wp_grade'];
                        if ($wp_grade == '') {
                            echo '<option value="">All Grades</option>';
                        } else {
                            echo '<option value="'.$wp_grade.'">'.strtoupper($wp_grade).'</option>';
                        }
                    } else {
                        echo '<option value=""></option>';
                    }
                    ?>
                    <option value="">All Grades</option>
                    <option value="lcwl">LCWL</option>
                    <option value="onp">ONP</option>
                    <option value="cbs">CBS</option>
                    <option value="occ">OCC</option>
                    <option value="mw">MW</option>
                    <option value="chipboard">CHIPBOARD</option>
                </select>
                Type: <select name="type">
                    <option value="">All Type</option>
                    <option value="deliver">Deliver</option>
                    <option value="pickup">Pick up</option>
                </select>

                <input type="submit" name="submit" value="Submit">
            </h6>
        </form>
    </div>
</div>

</body>
</html>

<div class="clear">
</div>
<div class="clear">
</div>
