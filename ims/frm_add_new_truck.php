<?php
include("templates/template.php");
include('config.php');
?>
<style>
    h1{
        color:white;
    }
</style>


        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add A New Truck</h2>
                <div class="block ">
                    <form action="add_new_truck_exec.php" method="POST">
                        <table class="form">

                            <tr>
                                <td>
                                    <label>
                                        <h4> Truck Plate:</h4> </label>
                                </td>
                                <td>
                                    <input type="text" class="large" name="plate_number" value="" />
                                </td>
                                <td width="300"></td>
                                <td width="300"></td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <h4> Aquisition Cost (Php):</h4> </label>
                                </td>
                                <td>
                                    <input type="text" class="large" name="aquisition_cost"  value="" />
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <h4> Net Book Value (Php):</h4> </label>
                                </td>
                                <td>
                                    <input type="text" class="large" name="netbook_value"  value="" />
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <h4> Amount (Php):</h4> </label>
                                </td>
                                <td>
                                    <input type="text" class="large" name="amount"  value="" />
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <h4> Truck Condition:</h4> </label>
                                </td>
                                <td>
                                    <input type="text" class="large" name="truck_condition"  value="" />
                                </td>
                                <td></td>
                                <td></td>
                            </tr>

                        </table>
                        <input type="submit" value="Save New Truck"/>
                    </form>
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>

</body>
</html>
