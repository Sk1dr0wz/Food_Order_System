<?php require('partials/menu.php'); ?>

<?php 
    //CHeck whether id is set or not 
    if(isset($_GET['id']))
    {
        //Get all the details
        $id = $_GET['id'];

        //SQL Query to Get the Selected Food
        $sql2 = "SELECT * FROM restaurant WHERE res_id=$id";
        //execute the Query
        $res2 = mysqli_query($conn, $sql2);

        //Get the value based on query executed
        $row2 = mysqli_fetch_assoc($res2);

        //Get the Individual Values of Selected Restaurant
        $title = $row2['res_name'];
        $building = $row2['building'];
        $street = $row2['street'];
        $city = $row2['city'];
        $state = $row2['state'];
        $active = $row2['res_active'];

    }
    else
    {
        //Redirect to Manage Restaurant
        header('location:'.SITEURL.'admin/manage-restaurant.php');
    }
?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Restaurant</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
        
        <table class="tbl-30">

            <tr>
                <td>Restaurant Name: </td>
                <td>
                    <input type="text" name="res_name" value="<?php echo $title; ?>">
                </td>
            </tr>

            <tr>
                <td>Building</td>
                <td>
                <input type="text" name="building" value="<?php echo $building; ?>">
                </td>
            </tr>
            <tr>
                <td>street </td>
                <td>
                <input type="text" name="street" value="<?php echo $street; ?>">
                </td>
            </tr>
            <tr>
                <td>city </td>
                <td>
                <input type="text" name="city" value="<?php echo $city; ?>">
                </td>
            </tr>
            <tr>
                <td>state </td>
                <td>
                <input type="text" name="state" value="<?php echo $state; ?>">
                </td>
            </tr>

            <tr>
                <td>Active: </td>
                <td>
                    <input <?php if($active=="Yes") {echo "checked";} ?> type="radio" name="res_active" value="Yes"> Yes 
                    <input <?php if($active=="No") {echo "checked";} ?> type="radio" name="res_active" value="No"> No 
                </td>
            </tr>

            <tr>
                <td>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Update Restaurant" class="btn-secondary">
                </td>
            </tr>
        
        </table>
        
        </form>

        <?php 
        
            if(isset($_POST['submit']))
            {
                //echo "Button Clicked";

                //1. Get all the details from the form
                $id = $_POST['id'];
                $title = $_POST['res_name'];
                $building = $_POST['building'];
                $street = $_POST['street'];
                $city = $_POST['city'];
                $state = $_POST['state'];
                $active = $_POST['res_active'];

                //4. Update the Restaurant in Database
                $sql3 = "UPDATE restaurant SET 
                    res_name = '$title',
                    building = '$building',
                    street = '$street',
                    city = '$city',
                    `state` = '$state',
                    res_active = '$active'
                    WHERE res_id=$id
                ";

                //Execute the SQL Query
                $res3 = mysqli_query($conn, $sql3);

                //CHeck whether the query is executed or not 
                if($res3==true)
                {
                    //Query Exectued and Restaurant Updated
                    $_SESSION['update'] = "<div class='success'>Restaurant Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-restaurant.php');
                }
                else
                {
                    //Failed to Update Restaurant
                    $_SESSION['update'] = "<div class='error'>Failed to Update Restaurant.</div>";
                    header('location:'.SITEURL.'admin/manage-restaurant.php');
                }

                
            }
        
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>