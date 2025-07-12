
<?php
session_start();

if (isset($_SESSION['username'])) {
    // If user is logged in, redirect to the actual workout page
    header("Location: gym2.html"); // Or use gym2.php if it's a PHP file
    exit();
} else {
    // If not logged in, redirect to login
    header("Location: login.php");
    exit();
}
?>
