<!doctype html>
<html lang=''>
    <head>
        <title>Vehicle Management System</title>
        <meta charset='utf-8'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="img/logo.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/styles.css">
        <script src="js/header.js" type="text/javascript"></script>
        <!-- <script src="js/script.js"></script> -->
        <link rel="stylesheet" href="validation/bootstrap.css"/>
        <script type="text/javascript" src="validation/jquery.min.js"></script>
        <script type="text/javascript" src="validation/formValidation.js"></script>
        <script type="text/javascript" src="validation/bootstrap.js"></script>
        
        <script>
            $(document).ready(function() { 


                //Bailing machineform validation

                $('#defaultForm2').formValidation({
                    message: 'This value is not valid',
                    icon: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        branch: {
                            validators: {
                                notEmpty: {
                                    message: 'The branch name is required'
                                },
                            }
                        },
                        owner_name: {
                            validators: {
                                notEmpty: {
                                    message: 'The owner/s name is required'
                                }
                            }
                        },

                        series_no: {
                            validators: {
                                notEmpty: {
                                    message: 'The Series no. is required'
                                },
                                // regexp: {
                                //     regexp: /^[0-9\.]+$/,
                                //     message: 'The amount can only consist of numbers'
                                // }
                            }
                        },
                        
                        cash_bond: {
                            validators: {
                                notEmpty: {
                                    message: 'The Cash Bond is required'
                                },
                                regexp: {
                                    regexp: /^[0-9\.]+$/,
                                    message: 'The cash bond can only consist of numbers'
                                }
                            }
                        },

                        date_purchase: {
                            validators: {
                                stringLength: {
                                    min: 10,
                                    max: 10,
                                    message: 'Date must be 10 characters long'
                                },
                                date: {
                                    format: 'YYYY/MM/DD',
                                    message: 'The make sure the format is YYYY/MM/DD.'
                                }
                            }
                        },

                        date_release: {
                            validators: {
                                stringLength: {
                                    min: 10,
                                    max: 10,
                                    message: 'Date must be 10 characters long'
                                },
                                date: {
                                    format: 'YYYY/MM/DD',
                                    message: 'The make sure the format is YYYY/MM/DD.'
                                }
                            }
                        },

                        aquisition_cost: {
                            validators: {
                                notEmpty: {
                                    message: 'The aquisition cost is required'
                                },
                                regexp: {
                                    regexp: /^[0-9\.]+$/,
                                    message: 'The aquisition cost can only consist of numbers'
                                }
                            }
                        },

                        motor: {
                            validators: {
                                notEmpty: {
                                    message: 'The motor is required'
                                },
                                regexp: {
                                    regexp: /^[0-9\.]+$/,
                                    message: 'The motor can only consist of numbers (Hp)'
                                }
                            }
                        },

                        cylinder: {
                            validators: {
                                notEmpty: {
                                    message: 'The cylinder is required'
                                },
                                regexp: {
                                    regexp: /^[0-9\.]+$/,
                                    message: 'The cylinder can only consist of numbers'
                                }
                            }
                        },

                        tonne: {
                            validators: {
                                notEmpty: {
                                    message: 'The tonne is required'
                                },
                                regexp: {
                                    regexp: /^[0-9\.]+$/,
                                    message: 'The tonne can only consist of numbers (t)'
                                }
                            }
                        },

                        capacity: {
                            validators: {
                                notEmpty: {
                                    message: 'The capacity is required'
                                },
                                regexp: {
                                    regexp: /^[0-9\.]+$/,
                                    message: 'The capacity can only consist of numbers (Kg)'
                                }
                            }
                        },

                        condition: {
                            validators: {
                                notEmpty: {
                                    message: 'The Bail Machine condition is required'
                                },
                            }
                        }
                    }
                });

            });
        </script>
    </head>
    <body>
    <html>
        <style>
            #success_message{ display: none;}
        </style>
        <?php
        include('layout/header.php');
//        include('../connect_out.php');
        ?>

        <center>
            <div id="body">
                <table id="page1"><tr><td align="left">Baling Machine Info<td><td align="right"><span id="back" onClick="backed();">Back</span><td/></tr></table><br />
                <div id="tbl_soSched" hidden>
                    <?php
                    $sql_coSched = mysql_query("SELECT * from tbl_changeoilset") or die(mysql_error());
                    echo '<table border="1">';
                    echo '<tr>
                        <td colspan="6"><center><b>HRM CHANGE OIL SCHEDULE</b></center></td>
                    </tr>';
                    echo '<tr>
                        <td>Set</td>
                        <td>Engine Oil</td>
                        <td>ATF</td>
                        <td>Gear Oil</td>
                        <td>Hydraulic Oil</td>
                        <td>Coolant</td>';
                    echo '</tr>';
                    while ($row_coSched = mysql_fetch_array($sql_coSched)) {
                        echo '<tr>';
                        echo '<td>' . strtoupper($row_coSched['set']) . '</td>';
                        echo '<td>' . number_format($row_coSched['engine_oil']) . '</td>';
                        echo '<td>' . number_format($row_coSched['atf']) . '</td>';
                        echo '<td>' . number_format($row_coSched['gear_oil']) . '</td>';
                        echo '<td>' . number_format($row_coSched['hydraulic_oil']) . '</td>';
                        echo '<td>' . number_format($row_coSched['coolant']) . '</td>';
                        echo '</tr>';
                    }
                    echo '</table><br /><br />';
                    ?>
                </div>
                <br />
                <center>



                    <form id="defaultForm2" method="post" class="form-horizontal" action="save_new_bm.php">
                        <table width="100%" align="center">
                            <tr>
                                <td> 
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Branch<span class="required">*</span></label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" name="branch" value="<?php echo ucwords($_SESSION['owner']) ?>" autocomplete="off" readonly />
                                        </div>
                                    </div>
                                </td>
                                <td> 
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Owner's Name<span class="required">*</span></label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" value="Envirocycling Fiber Inc" name="owner_name" readonly />
                                        </div>
                                    </div>
                                </td>

                            </tr>

                            <tr>
                                <td> 
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Series No.<span class="required">*</span></label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control"  name="series_no" autocomplete="off" />
                                        </div>
                                    </div>
                                </td>
                                <td> 
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Aquisition Cost (Php)<span class="required">*</span></label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" name="aquisition_cost" autocomplete="off" />
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td> 
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Motor(Hp)<span class="required">*</span></label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" name="motor" autocomplete="off" />
                                        </div>
                                    </div>
                                </td>

                                <td> 
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Date Purchased<span class="required">*</span></label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" name="date_purchased" placeholder="YYYY/MM/DD" autocomplete="off" />
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            
                        
                            <tr>
                                <td> 
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Cylinder<span class="required">*</span></label>
                                        <div class="col-sm-5">
                                            <select class="form-control" name="cylinder">
                                                <option value=""></option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                            </select>
                                        </div>
                                    </div>
                                </td>
                                
                                <td> 
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Date Release<span class="required">*</span></label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" name="date_release" placeholder="YYYY/MM/DD" autocomplete="off" />
                                        </div>
                                    </div>
                                </td>
                                
                            </tr>

                            <tr>
                                <td> 
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Tonne<span class="required">*</span></label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" name="tonne" autocomplete="off" />
                                        </div>
                                    </div>
                                </td>

                                <td> 
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">BM Condition<span class="required">*</span></label>
                                        <div class="col-sm-5">
                                            <textarea class="form-control" name="condition"></textarea>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td> 
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Capacity(kg)<span class="required">*</span></label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" name="capacity" autocomplete="off" />
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                <br />
                                <br />
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"></label>
                                        <div class="col-sm-5">
                                            <button type="submit" class="btn btn-primary">Save New Baling Machine</button>
                                        </div>
                                    </div>
                                </td>
                                
                                <td></td>
                            </tr>
                            
                        </table>
                       
                        <!-- <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3">
                                <button type="submit" class="btn btn-primary">Save New Bailing Machine</button>
                            </div>
                        </div> -->

                    </form>
                    <br /><br />
            </div>

<?php include('layout/footer.php'); ?>
        </center>
    </body>
</html>

