
<center>
    <br>
    <link href="css/tables.css" media="screen" rel="stylesheet" type="text/css" />
    <table width="95%">
        <tr>
            <td>
                <table class="CSSTableGenerator">
                    <td width="15%">Plate</td>
                    <td width="15%">Branch</td>
                    <td width="15%">Type</td>
                    <td>Action</td>
        </tr>
        <?php
        include('connect.php');

        $sql_he = mysql_query("SELECT * from tbl_truck_report WHERE class = 'HE' and coSet > 0 and status=''") or die(mysql_error());
        while ($row_he = mysql_fetch_array($sql_he)) {
            $sql_coSet = mysql_query("SELECT * from tbl_changeoilset WHERE id='" . $row_he['coSet'] . "'") or die(mysql_error());
            $row_coSet = mysql_fetch_array($sql_coSet);

            $sql_hrm = mysql_query("SELECT * from tbl_hrm WHERE truck_id='" . $row_he['id'] . "' ORDER BY date Desc LIMIT 1") or die(mysql_error());
            $row_hrm = mysql_fetch_array($sql_hrm);

            $last_hrm = $row_hrm['hrm'];
            $next_engineOil = $row_he['engine_oil'] - 10;
            $next_atf = $row_he['atf'] - 10;
            $next_gearOil = $row_he['gear_oil'] - 10;
            $next_hydraulicOil = $row_he['hydraulic_oil'] - 10;
            $next_coolant = $row_he['coolant'] - 10;
            $type = '';

            if ($last_hrm >= $next_engineOil) {
                $type .= '<li>Engine Oil</li>';
            }
            if ($last_hrm >= $next_atf) {
                $type .= '<li>ATF</li>';
            }
            if ($last_hrm >= $next_gearOil) {
                $type .= '<li>Gear Oil</li>';
            }
            if ($last_hrm >= $next_hydraulicOil) {
                $type .= '<li>Hydraulic Oil</li>';
            }
            if ($last_hrm >= $next_coolant) {
                $type .= '<li>Coolant</li>';
            }
            ?>
            <tr>
                <td><?php echo $row_he['truckplate']; ?></td>
                <td><?php echo $row_he['branch']; ?></td>
                <td><?php echo $type; ?></td>
                <td width="20%"><a href="m_changeoil.php?id=<?php echo $row_he['id'];?>&page=maintenance" target="_top"><img src="../images/me.gif" width="50%" height="15%"><a></td>
            </tr>
            <?php
        }
        ?>
    </table>
</td>
</tr>
</table>
</center>