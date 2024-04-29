<?php require('partials/menu.php'); ?>

        <!-- Main Content Section Starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Dashboard</h1>
                <br><br>
                <?php 
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <br><br>
                <div class="row">
                <div class="col text-center">

                    <?php 
                        // Sql Query 
                        $sql = "SELECT * FROM `category`";
                        // Execute Query
                        $res = mysqli_query($conn, $sql);
                        if($res){
                            // Count Rows
                            $count = mysqli_num_rows($res);
                        } else {
                            $count = 0; // Handle error
                        }
                    ?>

                    <h1><?php echo $count; ?></h1>
                    <br />
                    Categories
                </div>

                <div class="col text-center">

                    <?php 
                        // Sql Query 
                        $sql2 = "SELECT * FROM `item`";
                        // Execute Query
                        $res2 = mysqli_query($conn, $sql2);
                        if($res2){
                            // Count Rows
                            $count2 = mysqli_num_rows($res2);
                        } else {
                            $count2 = 0; // Handle error
                        }
                    ?>

                    <h1><?php echo $count2; ?></h1>
                    <br />
                    Foods
                </div>

                <div class="col text-center">
                    
                    <?php 
                        // Sql Query 
                        $sql3 = "SELECT * FROM `order`";
                        // Execute Query
                        $res3 = mysqli_query($conn, $sql3);
                        if($res3){
                            // Count Rows
                            $count3 = mysqli_num_rows($res3);
                        } else {
                            $count3 = 0; // Handle error
                        }
                    ?>

                    <h1><?php echo $count3; ?></h1>
                    <br />
                    Total Orders
                </div>
                <div class="col text-center">
                    
                    <?php 
                        // Sql Query 
                        $sql4 = "SELECT * FROM `user`";
                        // Execute Query
                        $res4 = mysqli_query($conn, $sql4);
                        if($res4){
                            // Count Rows
                            $count4 = mysqli_num_rows($res4);
                        } else {
                            $count4 = 0; // Handle error
                        }
                    ?>

                    <h1><?php echo $count4; ?></h1>
                    <br />
                    Total Users
                </div>


                </div>

                <div class="clearfix"></div>
                <br><br><br><br>

            </div>
        </div>
        <!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>
