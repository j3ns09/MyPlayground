<?php

$bdd_refresh = 20;

session_start();

$root = $_SERVER['DOCUMENT_ROOT'] . "/";

include_once $root . "includes/config/variables.php";
include_once $includesConfig . "functions.php";
include_once $includesConfig . "config.php";
include_once $includesConfig . "email_functions.php";

function includeResponsiveCSS() {
    echo '<link rel="stylesheet" href="/assets/public/css/responsive.css">';
}


if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_info'])) {
    session_destroy();
    header("location: /");
    exit();
}

if (!isUserOnline($pdo, $_SESSION['user_id']) || isBanned($pdo, $_SESSION['user_id'])) {
    session_destroy();
    header("location: /");
    exit();
}


if (isset($_SESSION['last_refresh'])) {
    if (time() - $_SESSION['last_refresh'] > $bdd_refresh && isset($_SESSION['user_id'])) {
        $_SESSION['user_info'] = getUser($pdo, $_SESSION['user_id']);
        $_SESSION['last_refresh'] = time();
    }
} else {
    $_SESSION['last_refresh'] = time();
}

if (isset($_SESSION['user_info'])) {
    logAction($pdo, $_SESSION['user_info']['id']);
}
$_SESSION['last_activity'] = time();

?>