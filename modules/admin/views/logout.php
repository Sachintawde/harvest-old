<?php
require_once 'php_action/core.php';
// remove all session variables
session_unset();

$_SESSION['success'] = 'You are logged out successfully';
header('location: ../login.php');
?>