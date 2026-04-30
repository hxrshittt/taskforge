<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// UNSET ALL SESSION VARIABLES
$_SESSION = [];

// DESTROY SESSION
session_destroy();

// REDIRECT
header("Location: login.php");
exit();
?>