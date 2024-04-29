<?php require('partials/menu.php'); ?>

<div class="wrapper">
    <h1>Manage Delivery</h1>
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

        <th>Total</th>
        <th>Order Date</th>
        <th>Time</th>

        <th>Status</th>
        <th>Customer Name</th>
        <th>Contact</th>
        <th>Email</th>
        <th>Address</th>
        <th>Update Orders</th>
    </tr>

    <?php 
        //Get all the orders from database
        $sql = "SELECT delivery.*, restaurant.res_id,restaurant.res_name, `order`.user_id, `user`.*
                FROM `delivery` 
                INNER JOIN restaurant ON `delivery`.res_id = restaurant.res_id
                INNER JOIN `order` ON `delivery`.delivery_id = `order`.delivery_id
                INNER JOIN user ON `order`.user_id = user.user_id
                GROUP BY `delivery`.delivery_id
                "; 

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
                $id = $row['delivery_id'];
                $date = $row['date'];
                $time = $row['time'];
                $status = $row['delivery_status'];
                $price = $row['delivery_total'];
                $customer_name = $row['user_fullname'];
                $customer_contact = $row['user_phone'];
                $customer_email = $row['user_email'];       
                $customer_address=$row['house'] . ", " . $row['street'] . ", " . $row['city'] . ", " . $row['state'];    
                ?>

                <tr>
                    <td><?php echo $sn++; ?>. </td>

                    <td><?php echo $price; ?></td>
                    <td><?php echo $date; ?></td>
                    <td><?php echo $time; ?></td>
                    <td>
                        <?php 
                            // Ordered, On Delivery, Delivered, Cancelled

                            if($status=="Pending")
                            {
                                echo "<label>$status</label>";
                            }
                            elseif($status=="In delivery")
                            {
                                echo "<label style='color: orange;'>$status</label>";
                            }
                            elseif($status=="Delivered")
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
                        <a href="<?php echo SITEURL; ?>admin/update-delivery.php?id=<?php echo $id; ?>"><img src="../images/icons/update.png"/></a>
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
