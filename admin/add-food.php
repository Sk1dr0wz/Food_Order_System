<?php require('partials/menu.php'); ?>

<?php ob_start(); ?> <!-- Start output buffering -->

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
        
            <table class="tbl-30">

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="item_name" placeholder="Title of the Food">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="item_desc" cols="30" rows="5" placeholder="Description of the Food."></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" step="0.01" name="item_price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="item_image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php 
                                // Create PHP Code to display categories from Database
                                // 1. Create SQL to get all active categories from database
                                $sql = "SELECT * FROM category WHERE category_active='Yes'";
                                
                                // Executing Query
                                $res = mysqli_query($conn, $sql);

                                // Count Rows to check whether we have categories or not
                                $count = mysqli_num_rows($res);

                                // If count is greater than zero, we have categories else we don't have categories
                                if($count > 0)
                                {
                                    // We have categories
                                    while($row = mysqli_fetch_assoc($res))
                                    {
                                        // Get the details of categories
                                        $id = $row['category_id'];
                                        $title = $row['category_name'];

                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                        <?php
                                    }
                                }
                                else
                                {
                                    // We do not have category
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }
                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="item_featured" value="Yes"> Yes 
                        <input type="radio" name="item_featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="item_active" value="Yes"> Yes 
                        <input type="radio" name="item_active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        
        <?php 

            // Check whether the button is clicked or not
            if(isset($_POST['submit']))
            {
                // Add the Food in Database
                
                // Get the Data from Form
                $title = $_POST['item_name'];
                $description = $_POST['item_desc'];
                $price = $_POST['item_price'];
                $category = $_POST['category'];

                // Check whether radio button for featured and active are checked or not
                $featured = isset($_POST['item_featured']) ? $_POST['item_featured'] : "No"; // Set Default Value
                $active = isset($_POST['item_active']) ? $_POST['item_active'] : "No"; // Set Default Value

                // Check whether the select image is clicked or not and upload the image only if the image is selected
                if(isset($_FILES['item_image']['name']))
                {
                    // Get the details of the selected image
                    $image_name = $_FILES['item_image']['name'];

                    // Check Whether the Image is Selected or not and upload image only if selected
                    if($image_name != "")
                    {
                        // Image is Selected
                        // Rename the Image
                        // Get the extension of the selected image (jpg, png, gif, etc.)
                        $ext = pathinfo($image_name, PATHINFO_EXTENSION);

                        // Create New Name for Image
                        $image_name = "Food-Name-" . rand(0000, 9999) . "." . $ext; // New Image Name May Be "Food-Name-657.jpg"

                        // Upload the Image
                        // Source path is the current location of the image
                        $src = $_FILES['item_image']['tmp_name'];

                        // Destination Path for the image to be uploaded
                        $dst = "../images/food/" . $image_name;

                        // Finally Upload the food image
                        $upload = move_uploaded_file($src, $dst);

                        // Check whether image uploaded or not
                        if($upload == false)
                        {
                            // Failed to Upload the image
                            // Redirect to Add Food Page with Error Message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            header('location:'.SITEURL.'admin/add-food.php');
                            // Stop the process
                            exit();
                        }
                    }
                }
                else
                {
                    $image_name = ""; // Set Default Value as blank
                }

                // Insert Into Database

                // Create a SQL Query to Save or Add food
                $sql2 = "INSERT INTO item SET 
                    item_name = '$title',
                    item_desc = '$description',
                    item_price = $price,
                    item_image = '$image_name',
                    category_id = $category,
                    item_featured = '$featured',
                    item_active = '$active'
                ";

                // Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                // Check whether data inserted or not
                // Redirect with Message to Manage Food page
                if($res2 == true)
                {
                    // Data inserted Successfully
                    $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    // Failed to Insert Data
                    $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
            }

        ?>


    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php ob_end_flush(); ?> <!-- Flush output buffer and send content to the browser -->
