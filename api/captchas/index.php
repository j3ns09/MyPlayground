<?php

include_once '../../includes/global/session.php';

notLogguedSecurity("/index.php");

if (!isAdmin($_SESSION['user_info'])) {
    header("location: /pages/errors/401.html");   
    exit();
}

header("Content-Type: application/json");
$waiter = $_SESSION['user_info']['id'];
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $captchas = getAllCaptchas($pdo);
    
    if (!$captchas) {
        echo json_encode(["error" => "Pas de captchas ou mauvaise réponse", "reponse" => $captchas]);
        exit();
    }
    
    
    echo json_encode([
        "waiter" => $_SESSION['user_info']['id'],
        "captchas" => $captchas
    ]);
}

exit();

?>