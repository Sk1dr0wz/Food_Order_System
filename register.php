<?php
    $showAlert = false; 
    $showError = false; 
    $exists=false;
        
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        require('config/constants.php');   
        
        $username = $_POST["user_name"]; 
        $password = $_POST["user_pass"]; 
        $cpassword = $_POST["cpassword"];
        $user_fullname=$_POST["user_fullname"];
        $user_email=$_POST["user_email"];
        $user_phone=$_POST["user_phone"];
        $house=$_POST["house"];
        $street=$_POST["street"];
        $city=$_POST["city"];
        $state=$_POST["state"];
        
        $sql = "SELECT * FROM user WHERE user_name='$username'";      
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result); 

        // Check if user_name does not exist yet
        if($num == 0){
            // Check password & confirm match
            if(($password == $cpassword) && $exists==false) {
                // Password Hashing MD5
                $hash = md5($password);                   
                $sql = "INSERT INTO `user` 
                    ( `user_name`,`user_pass`,`user_fullname`,`user_email`,`user_phone`,`house`,`street`,`city`,`state`) 
                    VALUES ('$username','$hash','$user_fullname','$user_email','$user_phone','$house','$street','$city','$state')";
                $result = mysqli_query($conn, $sql);

                if ($result){
                    $showAlert = true; 
                }
            } 
            else{ 
                $showError = "Passwords do not match"; 
            }      
        }
        if($num>0){
          $exists="Username not available"; 
        } 
    }
?>
        
<!doctype html>
<html lang="en">
      
<head>  
    <!-- Required meta tags --> 
    <meta charset="utf-8"> 
    <meta name="viewport" content=
        "width=device-width, initial-scale=1, 
        shrink-to-fit=no">
    <link rel="stylesheet" href="css/style.css">
    <title>Register</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
<!-- Bootstrap CSS --> 
<link rel="stylesheet" href=
    "https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
            integrity=
    "sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
            crossorigin="anonymous">  
            <link rel="stylesheet" href="css/style.css">
</head>
        
<body>
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="http://localhost/food-order/" title="Logo">
                    <img src="images/logo.png" alt="Logo" class="img-responsive">
                </a>
            </div>
            <br>
            <div class="clearfix"></div>
        </div>
    </section>
        
    <?php       
        if($showAlert) {        
            echo "<script>alert('Account Creation Successful. You can now login on the next page')
            window.location='login.php'</script>";
        }  
        if($showError) {
            echo "<script>alert('$showError.')            
            window.location='register.php'</script>";
       } 
        if($exists) {
            echo "<script>alert('$exists.')
            window.location='register.php'</script>";
        }   
    ?>
        
    <div class="container my-4 ">  
        <h2>Register</h2>
        <br>
        <form action="" method="post">
            <div class="form-group"> 
                <label for="username">Username</label> 
                <input type="text" required class="form-control" id="user_name" 
                    name="user_name" aria-describedby="emailHelp" placeholder="ali123" >    
            </div>
            <br>

            <div class="form-group"> 
                <label for="userfullname">Full Name</label> 
            <input type="text" required class="form-control" 
                name="user_fullname" aria-describedby="emailHelp" placeholder="Ali Abu" >    
            </div>
            <br>

            <div class="form-group"> 
                <label for="password">Password</label> 
                <input type="password" required class="form-control" 
                id="user_pass" name="user_pass" > 
            </div>
            <br>

            <div class="form-group"> 
                <label for="cpassword">Confirm Password</label> 
                <input type="password" required class="form-control" id="cpassword" name="cpassword" >
            </div>  
            <small>
                Make sure to type the same password
            </small>
            <br><br>

            <div class="form-group"> 
                <label for="username">Email</label> 
                <input type="email" 
                    name="user_email" required class="form-control" aria-describedby="emailHelp" placeholder="ali@gmail.com" >    
            </div>
            <small>
                Enter a valid email address
            </small>
            <br><br>

            <div> 
                <label for="username">Phone +60</label> 
            <input type="number" min="0"  
                name="user_phone" required class="form-control" aria-describedby="emailHelp" placeholder="1234567890">    
            </div>
            <small>
                Enter a valid mobile number
            </small> 
            <br><br>

            <label for="username">Address</label>
            <br> 
            <div>
            <label for="username">House</label> 
            <input type="text" 
                name="house" class="form-control" aria-describedby="emailHelp"> 
                <small>
                not compulsory
                </small>   
            </div>
            
            <div>
            <label for="username">Street</label> 
            <input type="text" 
                name="street" required class="form-control" aria-describedby="emailHelp" placeholder="Lorong Delima" required>    
            </div>
            
            <div>
            <label for="username">City</label> 
            <input type="text" 
                name="city" required class="form-control" aria-describedby="emailHelp" placeholder="Kota Kinabalu" required>    
            </div>
            
            <div>
            <label for="username">State</label> 
            <input type="text" 
                name="state" required class="form-control" aria-describedby="emailHelp" placeholder="Sabah" required>    
            </div>
            <br>    
        
            <button type="submit" class="btn btn-primary">
            Sign up
            </button> 
        </form> 
    </div>
    <!-- Optional JavaScript --> 
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        
    <script src="
    https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="
    sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous">
    </script>
        
    <script src="
    https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity=
    "sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" 
        crossorigin="anonymous">
    </script>
        
    <script src="
    https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" 
        integrity=
    "sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
        crossorigin="anonymous">
    </script> 
<?php include('partials-front/footer.php'); ?>