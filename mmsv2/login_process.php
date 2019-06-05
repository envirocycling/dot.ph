<?php
session_start();
include('connect.php');

$username = $_POST['username'];
$password = $_POST['password'];

if(is_numeric($username) && $username > 0){
                $login_chk = mysql_query("SELECT * from employees WHERE BINARY password='$password' and emp_num = '$username'") or die(mysql_error());
                
                if(mysql_num_rows($login_chk) == 1){
    
                    $row_loginchk = mysql_fetch_array($login_chk);
                    $_SESSION['emp_num'] = $row_loginchk['emp_num'];
                    $_SESSION['user_id'] = $row_loginchk['user_id'];
                    $_SESSION['user_type'] = '5';  
                    $_SESSION['passwords'] = $row_loginchk['password'];
                    $_SESSION['username-5'] = $username['username'];
                    header("Location: users/employee-5/index.php?active=index");

                }else{
                    echo '<script>
                                alert("Login Error.");
                                location.replace("index.php");
                        </script>';
                }
}else{
    $login_chk = mysql_query("SELECT * from users WHERE username='$username' and BINARY password='$password' and user_type!='5'") or die(mysql_error());
    $row_loginchk = mysql_fetch_array($login_chk);
    
    if(!empty($row_loginchk['status'])){
    echo '<script>
                    alert("Your account is deactivated. Please contact your system administrator/ IT Dept.");
                    location.replace("index.php");
            </script>';
        
    }else if(mysql_num_rows($login_chk) == 1){
        $user_type = $row_loginchk['user_type'];

        mysql_query("UPDATE employees SET password='' WHERE emp_num='".$row_loginchk['emp_num']."'") or die(mysql_error());

        $_SESSION['user_id'] = $row_loginchk['user_id'];
        $_SESSION['emp_num'] = $row_loginchk['emp_num'];
        $_SESSION['user_type'] = $row_loginchk['user_type'];  
        $_SESSION['password'] = $row_loginchk['password'];        
        $_SESSION['dep_id'] = $row_loginchk['dep_id'];        
        $_SESSION['branch_id'] = $row_loginchk['branch_id'];        
      
        if($user_type == 0){
            $_SESSION['username-0'] = $row_loginchk['username'];
            header("Location: users/admin-01/index.php?active=index");
        }else if($user_type == 1){
            $_SESSION['username-1'] = $row_loginchk['username'];
            header("Location: users/hr-1/index.php?active=index");
        }else if($user_type == 2){
            $_SESSION['username-2'] = $row_loginchk['username'];
            header("Location: users/gm-2/index.php?active=index");
        }else if($user_type == 3){
            $_SESSION['username-3'] = $row_loginchk['username'];
            header("Location: users/bh-3/index.php?active=index");
        }else if($user_type == 4){
            $_SESSION['username-4'] = $row_loginchk['username'];
            header("Location: users/accounting-4/index.php?active=index");
        }else if($user_type == 6){
            $_SESSION['username-6'] = $row_loginchk['username'];
            $_SESSION['company_id'] = $row_loginchk['agency_id'];  
            header("Location: users/agency-6/index.php?active=index");
        }
 
    }else{
        echo '<script>
                    alert("Login Error.");
                    location.replace("index.php");
            </script>';
    }
}
