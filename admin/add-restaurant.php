<?php require('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>

        <?php 
        
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        
        ?>

        <br><br>

        <!-- Add CAtegory Form Starts -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Restaurant Name: </td>
                    <td>
                        <input type="text" name="res_name" placeholder="Restaurant Name">
                    </td>
                </tr>

                <tr>
                <td>Building</td>
                <td>
                <input type="text" name="building">
                </td>
            </tr>
            <tr>
                <td>street </td>
                <td>
                <input type="text" name="street">
                </td>
            </tr>
            <tr>
                <td>city </td>
                <td>
                <input type="text" name="city">
                </td>
            </tr>
            <tr>
                <td>state </td>
                <td>
                <input type="text" name="state">
                </td>
            </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="res_active" value="Yes"> Yes 
                        <input type="radio" name="res_active" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Restaurant" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
        <!-- Add CAtegory Form Ends -->

        <?php 
        
            //CHeck whether the Submit Button is Clicked or Not
            if(isset($_POST['submit']))
            {
                //echo "Clicked";

                //1. Get the Value from CAtegory Form
                $title = $_POST['res_name'];
                $building = $_POST['building'];
                $street = $_POST['street'];
                $city = $_POST['city'];
                $state = $_POST['state'];


                //For Radio input, we need to check whether the button is selected or not
                if(isset($_POST['res_active']))
                {
                    $active = $_POST['res_active'];
                }
                else
                {
                    $active = "No";
                }

                //2. Create SQL Query to Insert CAtegory into Database
                $sql = "INSERT INTO restaurant SET 
                    res_name='$title',                    
                    building='$building',
                    street='$street',
                    city='$city',
                    `state`='$state',
                    res_active='$active'
                ";

                //3. Execute the Query and Save in Database
                $res = mysqli_query($conn, $sql);

                //4. Check whether the query executed or not and data added or not
                if($res==true)
                {
                    //Query Executed and Category Added
                    $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                    //Redirect to Manage Category Page
                    header('location:'.SITEURL.'admin/manage-restaurant.php');
                }
                else
                {
                    //Failed to Add CAtegory
                    $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
                    //Redirect to Manage Category Page
                    header('location:'.SITEURL.'admin/add-restaurant.php');
                }
            }
        
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>