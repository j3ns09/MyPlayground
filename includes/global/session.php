<?php

$inactive = 900;

session_start();

$root = $_SERVER['DOCUMENT_ROOT'] . "/";

include_once $root . "includes/config/variables.php";
include_once $includesConfig . "functions.php";
include_once $includesConfig . "config.php";

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $inactive)) {
    makeOffline($pdo, $_SESSION['user_id']);
    session_unset();
    session_destroy();
    header("Location: ../../login.php");
    exit();
}

// Update last activity time stamp
$_SESSION['last_activity'] = time();

?>