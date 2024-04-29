<?php require('partials-front/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <br>
        <h1 class="text-center">Order Details</h1>

        <br><br><br>
        <br><br>
        <center>
            <table class="content-table">
                <tr>
                    <th>S.N. </th>
                    <th>Food </th>
                    <th>Price </th>
                    <th>Qty. </th>
                    <th>Date </th>
                    <th>Time </th>
                    <th>Status </th>
                    <th>Action</th> <!-- Added Action column -->
                </tr>
                <hr>
                <?php 
                    //Get all the orders from database
                    $sql = "SELECT * FROM `order` LEFT JOIN `item` ON `order`.item_id = `item`.item_id WHERE user_id={$_SESSION['user_id']} AND order_status = 'Ordered' AND delivery_id IS NULL ORDER BY order_id DESC"; // DIsplay the Latest Order First
                    //Execute Query
                    $res = mysqli_query($conn, $sql);
                    //Count the Rows
                    $count = mysqli_num_rows($res);

                    $sn = 1; //Create a Serial Number and set its initial value as 1
                 
                    if($count>0)
                    {
                        //Order Available
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //Get all the order details
                            $id = $row['order_id'];
                            $food = $row['item_name'];
                            $price = $row['item_price'];
                            $quantity = $row['order_quantity'];
                            $date = $row['date'];
                            $time = $row['time'];
                            $status = $row['order_status'];

                            ?>

                                <tr>
                                    <td><?php echo $sn++; ?>. </td>
                                    <td><?php echo $food; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td><?php echo $quantity; ?></td>
                                    <td><?php echo $date; ?></td>
                                    <td><?php echo $time; ?></td>
                                    <td><?php echo $status; ?></td>
                                    <td>
                                        <?php 
                                            // Display delete or deduct buttons based on order status
                                            if($status=="Ordered") {
                                                if($quantity > 1) {
                                                    echo "<a href='?action=deduct&id=$id' class='btn btn-warning'>Deduct</a>";
                                                }
                                                echo "<a href='?action=delete&id=$id' class='btn btn-danger'>Delete</a>";
                                            }
                                        ?>
                                    </td>
                                </tr>

                            <?php

                        }
                    }
                    else
                    {
                        //Order not Available
                        echo "<tr><td colspan='7' class='error'>You have not placed any recent orders.</td></tr>";
                    }

                    // Handle delete and deduct actions
                    if(isset($_GET['action']) && isset($_GET['id'])) {
                        $action = $_GET['action'];
                        $orderId = $_GET['id'];

                        if($action == 'delete') {
                            // Query to delete order
                            $delete_sql = "DELETE FROM `order` WHERE order_id = $orderId";

                            if(mysqli_query($conn, $delete_sql)) {
                                // Order deleted successfully
                                header("Location: order-current.php"); // Redirect to order-current.php after deletion
                                exit;
                            } else {
                                // Error in deletion
                                echo "Error: " . mysqli_error($conn);
                            }
                        } elseif ($action == 'deduct') {
                            // Check if quantity is greater than 1
                            $deduct_sql = "";
                            $check_sql = "SELECT order_quantity FROM `order` WHERE order_id = $orderId";
                            $check_result = mysqli_query($conn, $check_sql);
                            $row = mysqli_fetch_assoc($check_result);
                            $current_quantity = $row['order_quantity'];

                            if($current_quantity > 1) {
                                $deduct_sql = "UPDATE `order` SET order_quantity = order_quantity - 1 WHERE order_id = $orderId";
                            } else {
                                $deduct_sql = "DELETE FROM `order` WHERE order_id = $orderId";
                            }

                            if(mysqli_query($conn, $deduct_sql)) {
                                // Quantity deducted successfully or order deleted
                                header("Location: order-current.php"); // Redirect to order-current.php after deduction
                                exit;
                            } else {
                                // Error in deduction or deletion
                                echo "Error: " . mysqli_error($conn);
                            }
                        }
                    }
                ?>
            </table>
        </center>

        <a href="order-all.php" class="nav-link active">View All Order History</a>

        <center>
            <?php 
            if($count>0)          
            echo "<a href='delivery-confirm.php' class='btn btn-primary'>Confirm for Delivery</a>";
            ?>
        </center>
    </div>
    
</div>

<?php include('partials-front/footer.php'); ?>
