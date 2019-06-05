
$(document).ready(function() {
    $('#defaultForm').formValidation({
        message: 'This value is not valid',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            firstname: {
                validators: {
                    notEmpty: {
                        message: 'The firstname is required'
                    }
                }
            },
            civil_status: {
                validators: {
                    notEmpty: {
                        message: 'Please choose civil status option'
                    }
                }
            },
			lastname: {
                validators: {
                    notEmpty: {
                        message: 'The lastname is required'
                    }
                }
            },
			address_brgy: {
                validators: {
                    notEmpty: {
                        message: 'The street/brgy address is required'
                    }
                }
            },
			address_towncity: {
                validators: {
                    notEmpty: {
                        message: 'The town/city address is required'
                    }
                }
            },
			address_province: {
                validators: {
                    notEmpty: {
                        message: 'The province address is required'
                    }
                }
            },
            birthdate: {
                validators: {
                    notEmpty: {
                        message: 'The birthdate is required'
                    },
                     date: {
                        format: 'YYYY/MM/DD',
                        message: 'The make sure the format is YYYY/MM/DD.'
                    }
                }
            },
            birthdate: {
                validators: {
                    notEmpty: {
                        message: 'The birthdate is required'
                    },
                     date: {
                        format: 'YYYY/MM/DD',
                        message: 'The make sure the format is YYYY/MM/DD.'
                    }
                }
            },	
                date_regularization: {
                validators: {
                     date: {
                        format: 'YYYY/MM/DD',
                        message: 'The make sure the format is YYYY/MM/DD.'
                    }
                }
            }, date_start: {
                validators: {
                    notEmpty: {
                        message: 'The date start is required'
                    },
                     date: {
                        format: 'YYYY/MM/DD',
                        message: 'The make sure the format is YYYY/MM/DD.'
                    }
                }
            },
                company: {
                validators: {
                    notEmpty: {
                        message: 'The company is required'
                    }
                }
            },
                branch: {
                validators: {
                    notEmpty: {
                        message: 'The branch is required'
                    }
                }
            },
                emp_status: {
                validators: {
                    notEmpty: {
                        message: 'Please choose employment status'
                    }
                }
            },
                tin: {
                validators: {
                    notEmpty: {
                        message: 'The TIN is required'
                    },
                    regexp:  {
                        regexp: /^[0-9-]+$/,
                        message: 'The TIN can only consist of numbers and dashes'
                    }
                }
            },
                sss: {
                validators: {
                    notEmpty: {
                        message: 'The SSS no. is required'
                    },
                    regexp:  {
                        regexp: /^[0-9-]+$/,
                        message: 'The sss no. can only consist of numbers and dashes'
                    }
                }
            },
                phic: {
                validators: {
                    notEmpty: {
                        message: 'The phic no. is required'
                    },
                    regexp:  {
                        regexp: /^[0-9-]+$/,
                        message: 'The phic no. can only consist of numbers and dashes'
                    }
                }
            },
                hdmf: {
                validators: {
                    notEmpty: {
                        message: 'The hdmf no. is required'
                    },
                    regexp:  {
                        regexp: /^[0-9-]+$/,
                        message: 'The hdmf no. can only consist of numbers and dashes'
                    }
                }
            },
            
                contact: {
                validators: {
                    notEmpty: {
                        message: 'The contact is required'
                    },
                    regexp:  {
                        regexp: /^[0-9-() ]+$/,
                        message: 'The contact no. can only consist of numbers , dashes and parenthesis'
                    }
                }
            },
            stayin: {
                validators: {
                    notEmpty: {
                        message: 'Please choose stay in option'
                    }
                }
            },
            position: {
                validators: {
                    notEmpty: {
                        message: 'Please choose position'
                    }
                }
            }
            
        }
        
    });
       /*.on('success.form.fv', function() {
        var firstname = $("input[name*='firstname']").val();
        var middlename = $("input[name*='middlename']").val();
        var lastname = $("input[name*='lastname']").val();
        var birthdate = $("input[name*='birthdate']").val();
        var address_brgy = $("input[name*='address_brgy']").val();
        var address_towncity = $("input[name*='address_towncity']").val();
        var address_province = $("input[name*='address_province']").val();
        var contact = $("input[name*='contact']").val();
        var date_hired = $("input[name*='date_hired']").val();
        var date_start = $("input[name*='date_start']").val();
        var company = $("select[name*='company']").val();
        var branch = $("select[name*='branch']").val();
        var position = $("select[name*='position']").val();
        var status = $("select[name*='emp_status']").val();
        var stayin = $("select[name*='stayin']").val();
        var tin = $("input[name*='tin']").val();
        var sss = $("input[name*='sss']").val();
        var phic = $("input[name*='phic']").val();
        var hdmf = $("input[name*='hdmf']").val();
        var civil_status = $("select[name*='civil_status']").val();
        var date_regularization = $("input[name*='date_regularization']").val();
        var emp_num = $('#emp_num').val();
        var dataX = 'firstname=' + firstname + '&middlename=' + middlename + '&lastname=' + lastname + '&birthdate=' + birthdate + '&address_brgy=' + address_brgy + '&address_towncity=' + address_towncity +
                '&address_province=' + address_province + '&contact=' + contact + '&date_hired=' + date_hired + '&date_start=' + date_start + '&company=' + company +
                '&branch=' + branch + '&position=' + position + '&status=' + status + '&stayin=' + stayin + '&tin=' + tin + '&sss=' + sss + '&phic=' + phic +
                '&hdmf=' + hdmf + '&emp_num=' + emp_num + '&date_regularization=' + date_regularization + '&civil_status=' + civil_status;
        
                $.ajax({
                    type: 'POST',
                    url: 'process/register_employee_pro.php',
                    data: dataX,
                    error: function(xhr, status, error) {
                        var err = eval("(" + xhr.responseText + ")");
                        alert(err.Message);
                        return false;
                    },
                    success: function(){
                           location.replace("view_employee.php?status=active&active=view");
                        }                    
                });
        });*/

});
