
<?php require('partials-front/menu.php'); 
?>

<?php 
    //CHeck whether food id is set or not
    if(isset($_GET['item_id']))
    {
        //Get the Food id and details of the selected food
        $item_id = $_GET['item_id'];

        //Get the DEtails of the SElected Food
        $sql = "SELECT * FROM item WHERE item_id=$item_id";
        //Execute the Query
        $res = mysqli_query($conn, $sql);
        //Count the rows
        $count = mysqli_num_rows($res);
        //CHeck whether the data is available or not
        if($count==1){
            $row = mysqli_fetch_assoc($res);
            $title = $row['item_name'];
            $price = $row['item_price'];
            $image_name = $row['item_image'];
        }
        else{
            //Redirect to homepage
            header('location:'.SITEURL);
        }
    }
    else{
        header('location:'.SITEURL);
    }
?>

<section class="food-order">
    <div class="container">        
        <h2 class="text-center">Add your Order</h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend>Selected Food</legend>
                <div class="food-menu-img">
                    <?php 
            
                        //CHeck whether the image is available or not
                        if($image_name==""){
                            //Image not Availabe
                            echo "<div class='error'>Image not Available.</div>";
                        }
                        else{
                            //Image is Available
                            ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve">
                            <?php
                        }              
                    ?>
                    
                </div>
                <div class="food-menu-desc">
                    <h3"><?php echo $title; ?></h3>

                    <p class="food-price">RM<?php echo $price; ?></p>
                    
                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" min='1' required>              
                </div>
            </fieldset>
            
            <fieldset>
                <input type="submit" name="submit" value="Add to Orders" class="btn btn-primary">
            </fieldset>
        </form>

        <?php 
            //CHeck whether submit button is clicked or not
            if(isset($_POST['submit'])){
                if(empty($_SESSION["user_id"])){
                    header('location:login.php');
                }
                else{
                    // Get all the details from the form
                    $food = $_POST['food'];
                    $qty = $_POST['qty']; 
                    $date = date("Y-m-d");
                    $time = date("H:i:s");
                    $status = "Ordered";
                    $user_id=$_SESSION["user_id"];  

                    //Save the Order in Databaase
                    //Create SQL to save the data
                    $sql2 = "INSERT INTO `order`(`user_id`, `order_status`, `order_quantity`, `date`, `time`, `item_id`) 
                    VALUES (
                        '$user_id',
                        '$status',
                        '$qty',
                        '$date',
                        '$time',
                        '$item_id'
                        )";

                    //Execute the Query
                    $res2 = mysqli_query($conn, $sql2);
                    
                    //Check whether query executed successfully or not
                    if($res2==true){
                        //Query Executed and Order Saved
      
                        $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
                        header('location:'.SITEURL);
                    }
                    else{
                        //Failed to Save Order
                        $_SESSION['order'] = "<div class='error text-center'>Failed to Order Food.</div>";
                        header('location:'.SITEURL);
                    }
                }
            }
        ?>
    </div>
</section>

<?php include('partials-front/footer.php'); ?>