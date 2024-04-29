<?php 
    //Check whether the user not logged in
    if(!isset($_SESSION['user'])){

        header('location:'.SITEURL.'/admin/login.php');

    }

?>