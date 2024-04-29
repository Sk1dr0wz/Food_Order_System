<?php require('partials-front/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <br>
        <h1 class="text-center">Delivery Summary</h1>

        <br><br><br>
        <br><br>
        <center>
            <table class="content-table">
                <tr>
                    <th>S.N. </th>
                    <th>Food </th>
                    <th>Price </th>
                    <th>Qty. </th>
                </tr>
                <hr>
                <?php
                $user_id = $_SESSION["user_id"];
                //Get all the orders from database
                $sql = "SELECT * FROM `order` LEFT JOIN `item` ON `order`.item_id = `item`.item_id WHERE user_id={$user_id} AND delivery_id IS NULL AND order_status = 'Ordered' ORDER BY order_id DESC"; // DIsplay the Latest Order First
                //Execute Query
                $res = mysqli_query($conn, $sql);
                //Count the Rows
                $count = mysqli_num_rows($res);
                $total = '0';
                $sn = 1; //Create a Serial Number and set its initail value as 1

                if ($count > 0) {
                    //Order Available
                    while ($row = mysqli_fetch_assoc($res)) {
                        //Get all the order details
                        $order_id = $row['order_id'];
                        $food = $row['item_name'];
                        $price = $row['item_price'];
                        $quantity = $row['order_quantity'];

                ?>
                        <tr>
                            <td><?php echo $sn++; ?>. </td>
                            <td><?php echo $food; ?></td>
                            <td><?php echo $price; ?></td>
                            <td><?php echo $quantity; ?></td>
                            <td>
                                <?php
                                // Ordered, On Delivery, Delivered, Cancelled
                                if ($status == "Ordered") {
                                    echo "<label>$status</label>";
                                } elseif ($status == "Complete") {
                                    echo "<label style='color: green;'>$status</label>";
                                }
                                $total = $total + $price * $quantity;
                                ?>
                            </td>
                        </tr>
                <?php

                    }
                } else {
                    //Order not Available
                    echo "<tr><td colspan='7' class='error'>You have not placed any recent orders.</td></tr>";
                }
                ?>
            </table>
        </center>

        <form action="" method="POST" class="order">
            <fieldset>
                <div class="food-menu-desc">
                    TOTAL:
                    <p>RM<?php echo $total; ?></p>
                </div>
            </fieldset>

            <center>Deliver from restaurants in your state:
                <select name="restaurant">
                    <?php

                    $sql2 = "SELECT * FROM restaurant, user WHERE res_active='Yes' AND user.user_id = '$user_id' AND restaurant.`state` = user.`state`";

                    // Executing Query
                    $res2 = mysqli_query($conn, $sql2);

                    // Count Rows to check whether we have categories or not
                    $count2 = mysqli_num_rows($res2);

                    // If count is greater than zero, we have categories else we don't have categories
                    if ($count2 > 0) {
                        // We have categories
                        while ($row2 = mysqli_fetch_assoc($res2)) {
                            // Get the details 
                            $res_id = $row2['res_id'];
                            $res_name = $row2['res_name'];
                    ?>

                            <option value="<?php echo $res_id; ?>"><?php echo $res_name; ?></option>

                        <?php
                        }
                    } else {
                        // We do not have 
                        ?>
                        <option value="0">No Restaurant Found</option>
                    <?php
                    }
                    ?>
                </select>
            </center>
            <center>

                <fieldset>
                    <input type="submit" name="deliver" value="Confirm" class="btn btn-primary">
                </fieldset>
            </form>
            </center>
    </div>

</div>
<?php

if (isset($_POST['deliver'])) {

    $resX = "SELECT `AUTO_INCREMENT`
                FROM INFORMATION_SCHEMA.TABLES
                WHERE TABLE_SCHEMA = 'food-order'
                AND TABLE_NAME = 'delivery';";

    // 1. Get all the details from the form
    $delivery_id = mysqli_fetch_assoc(mysqli_query($conn, $resX))['AUTO_INCREMENT'];
    $date = date("Y-m-d");
    $time = date("H:i:s");
    $restaurant = $_POST['restaurant'];
    $_SESSION['d_id'] = $delivery_id;

    $sql3 = "INSERT INTO `delivery`(`delivery_status`, `date`, `time`, `delivery_total`, `res_id`) 
                VALUES ('Pending', '$date','$time','$total','$restaurant')
                ";
    // Execute the SQL Query
    $res3 = mysqli_query($conn, $sql3);
    $sql4 = "UPDATE `order` SET delivery_id=$delivery_id WHERE user_id={$user_id} AND order_status = 'Ordered' AND delivery_id IS NULL ";

    // Execute the SQL Query
    $res4 = mysqli_query($conn, $sql4);
    // Check whether the query is executed or not 
    if ($res3 == true and $res4 == true) {
        $_SESSION['order'] = "<div class='success'>Your Delivery is Confirmed. Please have your money ready on delivery.</div>";
        header('location:' . SITEURL);
        exit();
    } else {
        // Failed to Update Food
        $_SESSION['order'] = "<div class='error'>Failed to confirm delivery.</div>";
        header('location:' . SITEURL);
        exit();
    }
}
?>
<?php include('partials-front/footer.php'); ?>
