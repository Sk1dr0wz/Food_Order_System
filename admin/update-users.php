<?php require('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update User</h1>
        <br><br>

        <?php 
            //1. Get the ID of Selected Admin
            $id = $_GET['id'];

            //2. Create SQL Query to Get the Details
            $sql = "SELECT * FROM user WHERE user_id=$id";

            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //Check whether the query is executed or not
            if($res==true)
            {
                // Check whether the data is available or not
                $count = mysqli_num_rows($res);
                //Check whether we have user data or not
                if($count==1)
                {
                    // Get the Details
                    $row = mysqli_fetch_assoc($res);
                    $user_fullname = $row['user_fullname'];
                    $username = $row['user_name'];
                    $user_email = $row['user_email'];
                    $user_phone = $row['user_phone'];
                    $house=$row["house"];
                    $street=$row["street"];
                    $city=$row["city"];
                    $state=$row["state"];
                }
                else
                {
                    //Redirect to Manage User Page
                    header('location:'.SITEURL.'admin/manage-users.php');
                }
            }
        
        ?>


        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="user_fullname" value="<?php echo $user_fullname; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="text" name="user_email" value="<?php echo $user_email; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Contact: </td>
                    <td>
                        <input type="text" name="user_phone" value="<?php echo $user_phone; ?>">
                    </td>
                </tr>
                <tr>
                    <td>House: </td>
                    <td>
                        <input type="text" name="house" value="<?php echo $house; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Street: </td>
                    <td>
                        <input type="text" name="street" value="<?php echo $street; ?>">
                    </td>
                </tr>
                <tr>
                    <td>City: </td>
                    <td>
                        <input type="text" name="city" value="<?php echo $city; ?>">
                    </td>
                </tr>
                <tr>
                    <td>State: </td>
                    <td>
                        <input type="text" name="state" value="<?php echo $state; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="user_pass" placeholder="Enter new password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="user_id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update User" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>

<?php 

    //Check whether the Submit Button is Clicked or not
    if(isset($_POST['submit']))
    {
        //Get all the values from form to update
        $id = $_POST['user_id'];
        $user_fullname = $_POST['user_fullname'];
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_phone = $_POST['user_phone'];
        $house=$_POST["house"];
        $street=$_POST["street"];
        $city=$_POST["city"];
        $state=$_POST["state"];
        $user_password = $_POST['user_pass']; // Get password from form

        // Create an empty variable to hold the hashed password
        $hashed_password = '';

        // Check if a new password is provided
        if(!empty($user_password)) {
            // Hash the new password
            $hashed_password = md5($user_password);
        }

        //Create a SQL Query to Update user
        $sql = "UPDATE user SET
        `user_fullname` = '$user_fullname',
        `user_name` = '$username',
        `user_email` = '$user_email',
        `user_phone` = '$user_phone',
        `house` = '$house',
        `street` = '$street',
        `city` = '$city',
        `state` = '$state'";

        // Add the hashed password to the SQL query if it's not empty
        if(!empty($hashed_password)) {
            $sql .= ", user_pass = '$hashed_password'";
        }

        $sql .= " WHERE user_id = '$id'";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Check whether the query executed successfully or not
        if($res==true)
        {
            //Query Executed and user Updated
            $_SESSION['update'] = "<div class='success'>User Updated Successfully.</div>";
            //Redirect to Manage Admin Page
            header('location:'.SITEURL.'admin/manage-users.php');
        }
        else
        {
            //Failed to Update user
            $_SESSION['update'] = "<div class='error'>Failed to Update User.</div>";
            //Redirect to Manage user Page
            header('location:'.SITEURL.'admin/manage-users.php');
        }
    }

?>

<?php include('partials/footer.php'); ?>
