<?php
session_start();

// Destroy the session to log the user out
session_destroy();

// Redirect to the index.php file which is outside of the folder
header('Location: ../index.php');
exit();
?>
