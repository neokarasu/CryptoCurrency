<?php

// Start the session

session_start();

// Destroy the session to log out the user

session_destroy();

// Redirect back to the first page

header("location:index.php");
exit;

?>
