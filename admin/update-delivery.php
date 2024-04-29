<?php require('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Delivery</h1>
        <br><br>
        <?php 
            //CHeck whether id is set or not
            if(isset($_GET['id']))
            {
                //GEt the Order Details
                $id=$_GET['id'];
                //Get all other details based on this id
                //SQL Query to get the order details
                $sql = "SELECT * FROM `delivery` WHERE delivery_id=$id";
                //Execute Query
                $res = mysqli_query($conn, $sql);
                //Count Rows
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //Detail Availble
                    $row=mysqli_fetch_assoc($res);
                    $price = $row['delivery_total'];
                    $status = $row['delivery_status'];
                }
                else
                {
                    //DEtail not Available/
                    //Redirect to Manage Order
                    header('location:'.SITEURL.'admin/manage-delivery.php');
                }
            }
            else
            {
                //REdirect to Manage ORder PAge
                header('location:'.SITEURL.'admin/manage-delivery.php');
            }
        
        ?>

        <form action="" method="POST">
        
            <table class="tbl-30">
                <tr>
                    <td>Price</td>
                    <td>
                        <b>RM</b>
                    <input type="number" name="price" step="0.01" value="<?php echo $price; ?>">
                
                    </td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Pending"){echo "selected";} ?> value="Pending">Pending</option>
                            <option <?php if($status=="In delivery"){echo "selected";} ?> value="In delivery">In delivery</option>
                            <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td clospan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Delivery" class="btn-secondary">
                    </td>
                </tr>
            </table>
        
        </form>


        <?php 
            //CHeck whether Update Button is Clicked or Not
            if(isset($_POST['submit']))
            {
                //echo "Clicked";
                //Get All the Values from Form
                $id = $_POST['id'];
                $price = $_POST['price'];
                $status = $_POST['status'];
                //Update the Values
                $sql2 = "UPDATE `delivery` SET 
                    delivery_status = '$status',
                    delivery_total = '$price'
                    WHERE delivery_id=$id
                ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //CHeck whether update or not
                //And REdirect to Manage Order with Message
                if($res2==true)
                {
                    //Updated
                    $_SESSION['update'] = "<div class='success'>Order Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-delivery.php');
                }
                else
                {
                    //Failed to Update
                    $_SESSION['update'] = "<div class='error'>Failed to Update .</div>";
                    header('location:'.SITEURL.'admin/manage-delivery.php');
                }
            }
        ?>


    </div>
</div>

<?php include('partials/footer.php'); ?>
