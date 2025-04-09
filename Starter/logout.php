<?php session_start();?>
<?php if (isset($_SESSION['name'])){
    $name = $_SESSION['name'];
    session_destroy();
    $_SESSION = array();
    (setcookie('PHPSESSID', " ", time()-3600, '/'));
    $message = "You're now logged out $name";
    $message2 = "See you next time";
} else { 
    $message = 'You have reached this page in error';
    $message2 = 'Please use the menu at the top';	
}

require 'includes/header.php';
echo "<h2>".$message."</h2>";
echo "<h3>".$message2."</h3>";
include ('includes/footer.php'); ?> 
