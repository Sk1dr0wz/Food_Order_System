<?php require('partials/menu.php'); ?>

<div class="wrapper">
    <h1>Manage Order</h1>
</div>

<br /><br /><br />

<?php 
    if(isset($_SESSION['update']))
    {
        echo $_SESSION['update'];
        unset($_SESSION['update']);
    }
?>
<br><br>

<table class="content-table">
    <tr>
        <th>S.N.</th>
        <th>Food</th>
        <th>Price</th>
        <th>Order Date</th>
        <th>Time</th>
        <th>Quantity</th>
        <th>Status</th>
        <th>Customer Name</th>
        <th>Contact</th>
        <th>Email</th>
        <th>Address</th>
        <th>Update Orders</th>
    </tr>

    <?php 
        //Get all the orders from database
        $sql = "SELECT `order`.*, user.*, item.*
                FROM `order` 
                INNER JOIN user ON `order`.user_id = user.user_id
                INNER JOIN item on `order`.item_id = item.item_id"; 

        //Execute Query
        $res = mysqli_query($conn, $sql);
        //Count the Rows
        $count = mysqli_num_rows($res);

        $sn = 1; //Create a Serial Number and set its initial value as 1

        if($count > 0)
        {
            //Order Available
            while($row = mysqli_fetch_assoc($res))
            {
                //Get all the order details
                $id = $row['order_id'];
                $food = $row['item_name']; // Assuming item_name is the column name for food in the item table
                $price = $row['item_price'];
                $date = $row['date'];
                $time = $row['time'];
                $qty = $row['order_quantity'];
                $status = $row['order_status'];
                $customer_name = $row['user_fullname'];
                $customer_contact = $row['user_phone'];
                $customer_email = $row['user_email'];
                $customer_address = $row['house'] . " " . $row['street'] . " " . $row['city'] . " " . $row['state'];               
                ?>

                <tr>
                    <td><?php echo $sn++; ?>. </td>
                    <td><?php echo $food; ?></td>
                    <td><?php echo $price; ?></td>
                    <td><?php echo $date; ?></td>
                    <td><?php echo $time; ?></td>
                    <td><?php echo $qty; ?></td>
                    <td>
                        <?php 
                            // Ordered, On Delivery, Delivered, Cancelled

                            if($status=="Ordered")
                            {
                                echo "<label>$status</label>";
                            }
                            elseif($status=="Complete")
                            {
                                echo "<label style='color: green;'>$status</label>";
                            }
                            elseif($status=="Cancelled")
                            {
                                echo "<label style='color: red;'>$status</label>";
                            }
                        ?>
                    </td>

                    <td><?php echo $customer_name; ?></td>
                    <td><?php echo $customer_contact; ?></td>
                    <td><?php echo $customer_email; ?></td>
                    <td><?php echo $customer_address; ?></td>
                    <td>
                        <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>"><img src="../images/icons/update.png"/></a>
                    </td>
                </tr>

                <?php
            }
        }
        else
        {
            //Order not Available
            echo "<tr><td colspan='14' class='error'>Orders not Available</td></tr>";
        }
    ?>
</table>

<?php include('partials/footer.php'); ?>
