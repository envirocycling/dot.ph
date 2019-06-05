<?php
include('config.php');

if (isset($_POST['submit'])) {
    $delivers_to = preg_split("[_]", $_POST['supplier_id']);
    mysql_query("INSERT INTO supplier_assessment (
                                    `supplier_id`,
                                    `class`,
                                    `deliver_to`,
                                    `wp_grade`,
                                    `type`,
                                    `volume`,
                                    `date`)
                            VALUES ('" . $_GET['sup_id'] . "',
                                    '$delivers_to[1]',
                                    '$delivers_to[0]',
                                    '" . $_POST['wp_grade'] . "',
                                    '" . $_POST['type'] . "',
                                    '" . $_POST['volume'] . "',
                                    '" . date("Y/m/d") . "')");
    echo "<script>
        history.back();
        </script>";
}
if (isset($_GET['del_id'])) {
    mysql_query("UPDATE supplier_assessment SET status='deleted',date_deleted='" . date("Y/m/d") . "' WHERE log_id='" . $_GET['del_id'] . "'");
}
$que = preg_split("[_]",$_GET['sup_id']);
$supplier_id = $que[0];
$grade = $que[1];
$sql_sup = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='" . $_GET['sup_id'] . "'");
$rs_sup = mysql_fetch_array($sql_sup);
?>
<script type='text/javascript' src='jquery-1.3.2.min.js'></script>
<link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
<script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
<script src="js/setup.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<style>
    #example{
        border-width:50%;
    }
</style>
<script type="text/javascript">
    function change(str) {
        var splits = str.split("_");
        document.getElementById("class").value = splits[1];
    }
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
<center>
    <?php
    echo "<h2>" . $rs_sup['supplier_name'] . " Supplier Assessment</h2>";
    ?>
    <h5>Add New</h5>
    <form action="add_supplier_assessment.php?sup_id=<?php echo $que[0]; ?>" method="POST">
        <table>
            <tr>
                <td><h6>WP Grade: </h6></td>
                <td><input type="text" name="wp_grade" value="<?php echo strtoupper($que[1]); ?>">
                    <!--<select name="wp_grade" required>
                        <option value=""></option>
                        <option value="LCWL">LCWL</option>
                        <option value="ONP">ONP</option>
                        <option value="CBS">CBS</option>
                        <option value="OCC">OCC</option>
                        <option value="MW">MW</option>
                        <option value="CHIPBOARD">CHIPBOARD</option>
                    </select> --></td>
            </tr>
            <tr>
                <td><h6>Supplier Deliver To: </h6></td>
                <td><select id="combobox" name="supplier_id" onchange="change(this.value);" >
                        <option value=""></option>
                        <?php
                        $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE status!='inactive' ORDER BY supplier_name ASC");
                        while ($rs_sup = mysql_fetch_array($sql_sup)) {
                            echo "<option value='" . $rs_sup['supplier_id'] . "_" . $rs_sup['classification'] . "'>" . $rs_sup['supplier_id'] . "_" . $rs_sup['supplier_name'] . " -- " . $rs_sup['classification'] . "</option>";
                        }
                        ?>
                    </select></td>
            </tr>
            <tr>
                <td><h6>Type: </h6></td>
                <td>Deliver: <input type="radio" name="type" value="deliver">Pickup :<input type="radio" name="type" value="pickup"></td>
            </tr>
            <tr>
                <td><h6>Volume (MT): </h6></td>
                <td><input type="text" name="volume" value=""></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" name="submit" value="Submit"></td>
            </tr>

        </table>
    </form>
    <!-- <table width="600">
        <tr><td>
                <table class="data display datatable" id="example">
    <?php
//    echo "<thead>";
//    echo '<tr class="data">';
//    echo "<th class='data'>WP Grade</th>";
//    echo "<th class='data'>Delivers To</th>";
//    echo "<th class='data'>Type</th>";
//    echo "<th class='data'>Volume</th>";
//    echo "<th class='data'>Action</th>";
//    echo "</tr>";
//    echo "</thead>";
//    include("config.php");
//
//    $query = "SELECT * FROM supplier_assessment where supplier_id='$id' and status!='deleted'";
//
//    $result = mysql_query($query);
//    while ($row = mysql_fetch_array($result)) {
//        echo "<tr class='data'>";
//        echo "<td class='data'>" . $row['wp_grade'] . "</td>";
//        $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='".$row['deliver_to']."'");
//        $rs_sup = mysql_fetch_array($sql_sup);
//        echo "<td class='data'>" . $rs_sup['supplier_name'] . "</td>";
//        echo "<td class='data'>" . $row['type'] . "</td>";
//        echo "<td class='data'>" . $row['volume'] . "</td>";
//        echo "<td class='data'><a href='view_supplier_assessment.php?del_id=" . $row['log_id'] . "&sup_id=$id'><button>Delete</button></a></td>";
//        echo "</tr>";
//    }
    ?>
                </table>
            </td>
        </tr>
    </table> -->
    <a href="view_assessment_history.php?sup_id=<?php echo $_GET['sup_id']; ?>"><button>Back</button></a>
</center>
