<?php require('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Restaurant</h1>

        <br /><br />
        <?php 
        
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['no-category-found']))
            {
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['failed-remove']))
            {
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }
        
        ?>
        <br><br>

                <!-- Button to Add Admin -->
                <a href="<?php echo SITEURL; ?>admin/add-restaurant.php" class="btn-primary">Add Restaurant</a>

                <br /><br /><br />

                <table class="content-table">
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Address</th>
                        <th>Active</th>
                        <th>Update Restaurant</th>
                        <th>Delete Restaurant</th>
                    </tr>

                    <?php 

                        //Query to Get all CAtegories from Database
                        $sql = "SELECT * FROM restaurant";

                        //Execute Query
                        $res = mysqli_query($conn, $sql);

                        //Count Rows
                        $count = mysqli_num_rows($res);

                        //Create Serial Number Variable and assign value as 1
                        $sn=1;

                        //Check whether we have data in database or not
                        if($count>0)
                        {
                            //We have data in database
                            //get the data and display
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id = $row['res_id'];
                                $title = $row['res_name'];
                                $address = $row['building'] . ", " . $row['street'] . ", " . $row['city'] . ", " . $row['state'];
                                $active = $row['res_active'];

                                ?>

                                    <tr>
                                        <td><?php echo $sn++; ?>. </td>
                                        <td><?php echo $title; ?></td>
                                        <td><?php echo $address; ?></td>
                                        <td><?php echo $active; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-restaurant.php?id=<?php echo $id; ?>"><img src="../images/icons/update.png"/></a>
                                            </td>
                                            <td>
                                            <a href="<?php echo SITEURL; ?>admin/delete-restaurant.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"><img src="../images/icons/delete.png"/></a>
                                        </td>
                                    </tr>

                                <?php

                            }
                        }
                        else
                        {
                            //WE do not have data
                            //We'll display the message inside table
                            ?>

                            <tr>
                                <td colspan="5"><div class="error">No Restaurant Added.</div></td>
                            </tr>

                            <?php
                        }
                    
                    ?>

                    

                    
                </table>
    </div>
    
</div>

<?php include('partials/footer.php'); ?>