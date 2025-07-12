

<?php
session_start();
session_unset();  // Unset session variables
session_destroy(); // Destroy the session
header("Location: login.php");  // Redirect to the login page
exit();
?>
