
$(document).ready(function() {   

    $('#defaultForm').formValidation({
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
			ownersname: {
                validators: {
                    notEmpty: {
                        message: 'The owner/s name is required'
                    }
                }
            },
			truckplate: {
                validators: {
                    notEmpty: {
                        message: 'The truck plate is required'
                    }, 
					regexp: {
                        regexp: /^[a-zA-Z0-9 ]+$/,
                        message: 'The aquisition cost can only consist of numbers'
                    }
                }
            },
			ending: {
                validators: {
                    notEmpty: {
                        message: 'The truck plate is required'
                    }
                }
            },
			bodytype: {
                validators: {
                    notEmpty: {
                        message: 'The body type is required'
                    }
                }
            },
			wheels: {
                validators: {
                    notEmpty: {
                        message: 'The wheels is required'
                    }
                }
            },
			class: {
                validators: {
                    notEmpty: {
                        message: 'The class is required'
                    }
                }
            },
			 aquisitioncost: {
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
			yearmodel: {
                validators: {
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'The year model can only consist of numbers'
                    },
			stringLength: {
                        min: 4,
                        max: 4,
                        message: 'The year model must be 4 characters long'
                    },
                }
            },
            date: {
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
			amount: {
                validators: {
                    notEmpty: {
                        message: 'The amount is required'
                    },
                    regexp: {
                        regexp: /^[0-9\.]+$/,
                        message: 'The amount can only consist of numbers'
                    }
                }
            },
			truckcondition: {
                validators: {
                    notEmpty: {
                        message: 'The truck condition is required'
                    },
                }
            },
        }
    });



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
			ownersname: {
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

            aquisitioncost: {
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

            truckcondition: {
                validators: {
                    notEmpty: {
                        message: 'The Bail Machine condition is required'
                    },
                }
            }
        }
    });

});
