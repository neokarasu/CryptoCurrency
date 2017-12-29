<?php 

session_start(); /* Starts the session */

// Destroy the session to log out the user

session_destroy();

// Redirect back to the first page

header("location:index.php");
exit;
?>
