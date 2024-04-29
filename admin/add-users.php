<?php require('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add User</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['add'])) //Checking whether the Session is Set or Not
            {
                echo $_SESSION['add']; //Display the Session Message if Set
                unset($_SESSION['add']); //Remove Session Message
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="user_name" placeholder="Username">
                    </td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="user_pass" placeholder="Password">
                    </td>
                </tr>
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="user_fullname" placeholder="Full Name">
                    </td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="text" name="user_email" placeholder="User email">
                    </td>
                </tr>
                <tr>
                    <td>Contact: </td>
                    <td>
                        <input type="text" name="user_phone" placeholder="User contact">
                    </td>
                </tr>
                <tr><td>
                <b>Address:
                </td></tr>
                <tr>
                    <td>House: </td>
                    <td>
                        <input type="text" name="house">
                    </td>
                </tr>
                <tr>
                    <td>Street: </td>
                    <td>
                        <input type="text" name="street">
                    </td>
                </tr>
                <tr>
                    <td>City: </td>
                    <td>
                        <input type="text" name="city">
                    </td>
                </tr>
                <tr>
                    <td>State: </td>
                    <td>
                        <input type="text" name="state">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add User" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>


    </div>
</div>

<?php include('partials/footer.php'); ?>


<?php 
    //Process the Value from Form and Save it in Database

    //Check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        // Button Clicked
        //echo "Button Clicked";

        //1. Get the Data from form
        $user_pass= md5($_POST['user_pass']); 
        $user_fullname = $_POST['user_fullname'];
        $user_name = $_POST['user_name'];
        $user_email= $_POST['user_email'];
        $user_phone= $_POST['user_phone'];
        $house= $_POST['house'];
        $street= $_POST['street'];
        $city= $_POST['city'];
        $state= $_POST['state'];

        //2. SQL Query to Save the data into database
        $sql = "INSERT INTO `user` (`user_name`, `user_fullname`, `user_pass`, `user_email`, `user_phone`, `house`, `street`, `city`, `state`) 
        VALUES ('$user_name', '$user_fullname', '$user_pass', '$user_email', '$user_phone', '$house','$street','$city','$state')";

        //3. Executing Query and Saving Data into Database
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        //4. Check whether the Query is Executed and data is inserted or not, and display appropriate message
        if($res==TRUE)
        {
            //Data Inserted
            //echo "Data Inserted";
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='success'>User Added Successfully.</div>";
            //Redirect Page to Manage Admin
            header("location:".SITEURL.'admin/manage-users.php');
        }
        else
        {
            //Failed to Insert Data
            //echo "Failed to Insert Data";
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='error'>Failed to Add User.</div>";
            //Redirect Page to Add Admin
            header("location:".SITEURL.'admin/add-users.php');
        }
    }
    
?>
