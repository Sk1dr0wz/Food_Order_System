<?php require('partials-front/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <br>
        <h1 class="text-center">Order History</h1>

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
                        <th> </th>
                    </tr>
                    <hr>
                    <?php 
                        //Get all the orders from database
                        $sql = "SELECT * FROM `order` LEFT JOIN `item` ON `order`.item_id = `item`.item_id WHERE user_id={$_SESSION['user_id']} ORDER BY order_id DESC"; // DIsplay the Latest Order First
                        //Execute Query
                        $res = mysqli_query($conn, $sql);
                        //Count the Rows
                        $count = mysqli_num_rows($res);

                        $sn = 1; //Create a Serial Number and set its initail value as 1
                     
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
                                    </tr>

                                <?php

                            }
                        }
                        else
                        {
                            //Order not Available
                            echo "<tr><td colspan='12' class='error'>You have not placed any orders</td></tr>";
                        }
                    ?>

 
                </table>
                </center>
    </div>
    
</div>

<?php include('partials-front/footer.php'); ?>