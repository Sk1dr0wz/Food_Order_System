<?php include('..\config\constants.php'); 
?>

<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/adminlogin.css">
    </head>

    <body>
        <div class="login">
            <br><br><br>
            <h2 class="text-center">Admin Login</h2>
            <br><br>

            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
            ?>
            <br><br>
            <div class="container">
                <div class="myform">
                <!-- Login -->
                <form action="" method="POST">
                    Username: <br>
                    <input type="text" name="user_name" placeholder="Enter Username"><br><br>

                    Password: <br>
                    <input type="password" name="user_pass" placeholder="Enter Password"><br><br>
                    <input type="submit" name="submit" value="Login" class="btn-primary">
                    <br><br>
                </form>
                </div>
            </div>
            <!-- Login End  -->
        </div>
    </body>
</html>

<?php 
    //Check Submit Button Clicked
    if(isset($_POST['submit']))
    {

        //escape special characters prevent sql injection
        $username = mysqli_real_escape_string($conn, $_POST['user_name']);
        $raw_password = md5($_POST['user_pass']);
        $password = mysqli_real_escape_string($conn, $raw_password);

        $sql = "SELECT * FROM user WHERE user_name='$username' AND user_pass='$password' AND user_role=1";

        // Query statement
        $res = mysqli_query($conn, $sql);

        // Count rows to check entry exists
        $count = mysqli_num_rows($res);
		
        if($count==1)
        {
            //User Available and Login Success
            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
            $_SESSION['user'] = $username; //To check whether the user is logged in or not and logout will unset it

            //Redirect to Dashboard
            header('location:'.SITEURL.'admin/');
            exit(); // Important to stop further execution after redirect
  
        }    
        else
        {
            $message = "Username or Password is incorrect.\\nTry again.";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }
?>