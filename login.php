<?php

session_start();

include_once 'includes/config/variables.php';
include_once 'includes/config/config.php';
include_once 'includes/config/functions.php';

$captcha = getRandomCaptcha($pdo);

$captcha_id = $captcha['id'];
$question = $captcha['question'];
$reponse = $captcha['reponse'];


$_SESSION['captcha_expected'] = $reponse;
$_SESSION['captcha_id'] = $captcha_id;

$login_error = $_SESSION['errors']['login_error'] ?? null;
$register_success = $_SESSION['register_success'] ?? null;
$captcha_error = $_SESSION['errors']['captcha_error'] ?? null;

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Se connecter</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .form-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .header-title {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
        }
        .header-title img {
            height: 50px;
            margin-right: 15px;
        }
        .header-title h1 {
            font-size: 36px;
            font-weight: bold;
            margin: 0;
        }
        .shape-button {
            display: inline-block;
            border: 2px solid #555;
            border-radius: 6px;
            margin: 5px;
            padding: 8px;
            cursor: pointer;
            user-select: none;
            transition: border-color 0.3s, background-color 0.3s;
        }
        .shape-button:hover,
        .shape-button:focus {
            border-color: #0d6efd;
            outline: none;
        }
        .shape-button.selected {
            background-color: #0d6efd;
            border-color: #0a58ca;
        }
        .captcha-instruction {
            margin-bottom: 10px;
            font-weight: 600;
            font-size: 1.1rem;
        }
        .error-message {
            color: #dc3545;
            font-weight: 600;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header-title pt-3">
        <img src="assets/public/img/logo.png" alt="Logo" />
        <h1>Se connecter</h1>
    </div>

    <?php
    if (!is_null($login_error)) {
        alertMessage($login_error, 1);
        unset($_SESSION['errors']['login_error']);
    }
    if (!is_null($register_success)) {
        alertMessage($register_success, 0);
        $_SESSION['register_success'] = null;
    }
    if (!is_null($captcha_error)) {
        alertMessage($captcha_error, 1);
        $_SESSION['errors']['captcha_error'] = null;
    }
    ?>

    <div class="form-container">

        <form method="POST" action="redirects/auth.php" id="login-form">
            <div class="mb-3">
                <label for="username" class="form-label">Nom d'utilisateur ou adresse e-mail</label>
                <input type="text" class="form-control" id="username" name="username" required />
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required />
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="captcha-checkbox" />
                <label class="form-check-label" for="captcha-checkbox">Je ne suis pas un robot</label>
            </div>

            <div id="captcha-selection" style="display:none; margin-bottom: 15px;">
                <div class="captcha-instruction">
                    <?= $question ?>
                </div>
                <input type="text" class="form-control" id="reponse" name="reponse" />
            </div>
            <input type="hidden" name="captcha_id" value="<?= $captcha_id ?>" />

            <button type="submit" id="submit-btn" class="btn btn-primary w-100" disabled>Se connecter</button>
        </form>

        <div class="text-center mt-3">
            <p>Vous n'avez pas de compte ? <a href="register.php" class="text-primary">Inscrivez-vous ici</a>.</p>
        </div>
    </div>
</div>

<script src="assets/shared/js/captchaScript.js"></script>
</body>
</html>