<?php
// Logout logic in logout.php
session_start();
session_unset(); // Clear all session variables
session_destroy(); // Destroy the session
header("Location: login.php"); // Redirect to the homepage or any other page after logout
exit();

