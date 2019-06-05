<?php
include("templates/template.php");
include 'config.php';
if (isset ($_POST['add'])) {
    $user_id = $_POST['user_id'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $branch = $_POST['branch'];
    $initial = $_POST['initial'];
    $position = $_POST['position'];
    $usertype = $_POST['user_type'];
    mysql_query("INSERT INTO users (`user_id`, `password`, `image`, `name`, `branch`, `initial`, `position`, `user_type`)
        VALUES ('$user_id', '$password', '', '$name', '$branch', '$initial', '$position', '$usertype')");
    echo "<script>
        alert('Successfully Added.');
        </script>
        ";
}

?>
<style>    
    h1{
        color:white;
    }
</style>
<body>   
    <div class="grid_9">
        <div class="box round first grid">
            <h2>Account Settings</h2>
            <br>
            <?php
            $user_id = $_SESSION['username'];
            $profpic = mysql_query("SELECT image FROM users WHERE user_id='$user_id'");
            $rs_profpic = mysql_fetch_array($profpic);
            $profpic=$rs_profpic["image"];
            if (!empty($profpic)) {
                echo '<img src="prof_pic.php?user_id='.$user_id.'" height="100" width="100" alt=""/>';
            } else {
                echo'<img src="images/no_avatar.png" height="100" width="100" alt="view profile" />';
            }
            ?>
            <br />
            <br />
            <form action="change_prof_pic.php" method="post" enctype="multipart/form-data">
                Change Profile Picture : 
                <br /><br />
                <input class="upload_button" type="file" name="image"/>
                <br /><br />
                <input class="allprod_button" name="upload" type="submit" value="Upload"/>
            </form>
            <div class="block ">
                <form action="changePass.php" method="POST">
                    <table class="form">

                        <tr>
                            <td>
                                <label>
                                    <h4> Username:</h4> </label>
                            </td>                            <td>
                                <input type="text" class="mini" name="username" value="<?php echo $_SESSION['username'];?>" readonly/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    <h4> Current Password:</h4>
                                </label>
                            </td>
                            <td>
                                <input type="password" name="current_pass" class="mini" value="" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    <h4> New Password:</h4>
                                </label>
                            </td>
                            <td>
                                <input type="password" name="new_pass" class="mini" value="" /> Must contain numbers and atleast 8 characters long
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    <h4> Confirm Password:</h4>
                                </label>
                            </td>
                            <td>
                                <input type="password" name="confirm_pass" class="mini" value="" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                            </td>
                            <td>
                                <input type="submit" value="Change Password"/>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <?php if($_SESSION['username']=='lonlon') { ?>
    <div class="grid_9">
        <div class="box round first grid">
            <h2>Add New Account</h2>

            <form action="viewAccountDetails.php" method="POST">
                <table class="form">

                    <tr>
                        <td>
                            <label>
                                <h4> Username:</h4> </label>
                        </td>                            <td>
                            <input type="text" class="mini" name="user_id" value="" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                <h4>Password:</h4>
                            </label>
                        </td>
                        <td>
                            <input type="password" name="password" class="mini" value="" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                <h4>Name:</h4>
                            </label>
                        </td>
                        <td>
                            <input type="name" name="name" class="mini" value="" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                <h4>Branch:</h4>
                            </label>
                        </td>
                        <td>
                                <?php
                                $sql = mysql_query("SELECT * FROM branches");
                                echo '<select name="branch" class="mini" required>';
                                echo "<option value='".$_SESSION['user_branch']."'>".$_SESSION['user_branch']."</option>";
                                while ($rs = mysql_fetch_array($sql)) {
                                    echo "<option value='".$rs['branch_name']."'>".$rs['branch_name']."</option>";
                                }
                                echo "</select>";
                                ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                <h4> Initial:</h4>
                            </label>
                        </td>
                        <td>
                            <input type="text" name="initial" class="mini" value="" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                <h4> Position:</h4>
                            </label>
                        </td>
                        <td>
                            <input type="text" name="position" class="mini" value="" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                <h4> UserType:</h4>
                            </label>
                        </td>
                        <td>
                            <select name="user_type" class="mini" required>
                                <option value="User">User</option>
                                <option value="Super User">Super User</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input type="submit" name="add" value="Add Account"/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

        <?php } ?>

    <?php
//    if($_SESSION['username']=='bryan') {
    ?>


    <!-- <div class="grid_5">
        <div class="box round first grid">
            <h2>Top Visitors</h2>
            <div class="block ">
    <?php
//                    include("config.php");
//                }
//                $query="SELECT user,login_date,log_id FROM login_frequency order by login_date desc limit 100";
//                $result=mysql_query($query);
    ?>
                <table class="data display datatable" id="example">
    <?php
//                    echo "<thead>";
//                    echo "<tr class='data'>";
//                    echo "<th class='data'>Log ID</th>";
//                    echo "<th class='data'>User</th>";
//                    echo "<th class='data'>Last Login</th>";
//                    echo "</tr>";
//                    echo "</thead>";
//                    while($row = mysql_fetch_array($result)) {
//                        echo "<tr class='data'>";
//                        echo "<td class='data'>".$row['log_id']."</td>";
//                        echo "<td class='data'>".$row['user']."</td>";
//                        echo "<td class='data'>".$row['login_date']."</td>";
//                        echo "</tr>";
//                    }
//                    echo "</table>";
    ?>
            </div>
        </div>
    </div> -->

    <div class="clear">
    </div>
    <div class="clear">
    </div>
</body>
</html>