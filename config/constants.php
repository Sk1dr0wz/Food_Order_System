<?php 
//Start Session
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

//Create Constants to Store Non Repeating Values
define('SITEURL', 'http://localhost/food-order/');  //Root URL
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'food-order');
    
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //Database Connection
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //SElecting Database \
if (mysqli_connect_errno()) {
    echo "Error while connecting to SQL database: " . mysqli_connect_error();
}
set_error_handler(function(int $errno, string $errstr) {
    if ((strpos($errstr, 'Undefined array key') === false) && (strpos($errstr, 'Undefined variable') === false)) {
        return false;
    } else {
        return true;
    }
}, E_WARNING);

?>