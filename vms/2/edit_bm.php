<!doctype html>
<html lang=''>
    <head>
        <title>Vehicle Management System</title>
        <meta charset='utf-8'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="shortcut icon" type="image/x-icon" href="img/logo.png" />
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
        <link href="css/select2.min.css" rel="stylesheet">
        <link rel="stylesheet" href="validation/bootstrap.css"/>

        <script src="js/header.js" type="text/javascript"></script>
        <script src="js/script.js"></script>
        <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/jquery.ui.core.min.js"></script>
        <script src="js/setup.js" type="text/javascript"></script>
        <script type="text/javascript" src="validation/jquery.min.js"></script>
        <script type="text/javascript" src="validation/formValidation.js"></script>
        <script type="text/javascript" src="validation/bootstrap.js"></script>
        <script type="text/javascript" src="js/jquery.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {

                setupLeftMenu();
                $('.datatable').dataTable();
                setSidebarHeight();

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
        
        <?php
        include('layout/header.php');
        include("css/drop_down.php");
        ?>

        <center>
            <div id="body">

                <table id="page1"><tr><td align="left">Existing Baling Machine : Edit<br /><td><td align="right"><span id="back" onClick="backed();">Back</span><td/></tr></table>
                <br/><br/>

                <?php
                include('connect.php');

                $bm = mysql_query("SELECT * FROM tbl_bm_report Where id='" . $_GET['id'] . "'");
                $bm_row = mysql_fetch_array($bm);
                ?>

                <form id="defaultForm2" method="post" class="form-horizontal" action="update_bm.php" >
                    <table width="100%" align="center">
                        <tr>
                            <td> 
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Branch<span class="required">*</span></label>
                                    <div class="col-sm-5">
                                        <input type="hidden" name="id" value="<?php echo $bm_row['id']; ?>">
                                        <input type="text" class="form-control" name="branch" value="<?php echo strtoupper($bm_row['branch']); ?>" autocomplete="off" readonly />
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
                                        <input type="text" class="form-control"  name="series_no" value="<?php echo strtoupper($bm_row['series_no']); ?>" autocomplete="off" />
                                        <input type="hidden" name="old_series_no" value="<?php echo strtoupper($bm_row['series_no']); ?>" />
                                    </div>
                                </div>
                            </td>

                            <td> 
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Aquisition Cost (Php)<span class="required">*</span></label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="aquisition_cost" value="<?= $bm_row['aquisition_cost']; ?>" autocomplete="off" />
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td> 
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Motor(Hp)<span class="required">*</span></label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="motor" value="<?= $bm_row['motor']; ?>" autocomplete="off" />
                                    </div>
                                </div>
                            </td>

                            <td> 
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Date Purchased<span class="required">*</span></label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="date_purchased" value="<?= $bm_row['date_purchased']; ?>" placeholder="YYYY/MM/DD" autocomplete="off" />
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
                                            <option value="1" <?= ($bm_row['cylinder'] == 1) ? 'selected' : ''; ?>>1</option>
                                            <option value="2" <?= ($bm_row['cylinder'] == 2) ? 'selected' : ''; ?>>2</option>
                                        </select>
                                    </div>
                                </div>
                            </td>
                                    
                            <td> 
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Date Release<span class="required">*</span></label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="date_release" value="<?= $bm_row['date_release']; ?>" placeholder="YYYY/MM/DD" autocomplete="off" />
                                    </div>
                                </div>
                            </td>     
                        </tr>

                        <tr>
                            <td> 
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Tonne<span class="required">*</span></label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="tonne" value="<?= $bm_row['tonne']; ?>" autocomplete="off" />
                                    </div>
                                </div>
                            </td>

                            <td> 
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">BM Condition<span class="required">*</span></label>
                                    <div class="col-sm-5">
                                        <textarea class="form-control" name="condition" ><?= $bm_row['condition']; ?></textarea>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td> 
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Capacity(kg)<span class="required">*</span></label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="capacity" value="<?= $bm_row['capacity']; ?>" autocomplete="off" />
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
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </td>
                                    
                            <td></td>
                        </tr>
                    </table>
                </form> 
            </div>
        </center>

        <?php include('layout/footer.php'); ?>

    </body>
</html>									