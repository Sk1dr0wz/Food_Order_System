
<?php require('partials-front/menu.php'); ?>

    <!-- Categories -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 

                //Display only active categories
                $sql = "SELECT * FROM category WHERE category_active='Yes'";

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //Count Rows
                $count = mysqli_num_rows($res);

                //Check categories available
                if($count>0){
                    while($row=mysqli_fetch_assoc($res)){
                        //Get the Values
                        $id = $row['category_id'];
                        $title = $row['category_name'];
                        $image_name = $row['category_image'];
                        ?>
                        
                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php 
                                    if($image_name==""){
                                        //Image not Available
                                        echo "<div class='error'>Image not found.</div>";
                                    }
                                    else{
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>                            
                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a>

                        <?php
                    }
                }
                else{
                    echo "<div class='error'>Category not found.</div>";
                }     
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories End -->

    <?php include('partials-front/footer.php'); ?>