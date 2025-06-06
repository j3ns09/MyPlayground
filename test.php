
<?php
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require_once "vendor/autoload.php";

include_once "includes/public/header.php";
include_once "includes/config/config.php";
include_once 'includes/config/functions.php';


echo "<p>Bonjour! Ce serveur fonctionne.</p>";

$stmt = $pdo->query("
    SELECT c.id_captcha, c.captcha_question, r.reponse FROM captcha c JOIN captcha_reponse r ON c.id_captcha = r.id_captcha ORDER BY RAND() LIMIT 1");

$captcha = $stmt->fetch();

print_r($captcha);

print($_SERVER['HTTP_HOST']);

var_dump($_SESSION['user_info']);


$username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$captcha = filter_input(INPUT_POST, "captcha", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

echo $username, $password, $captcha;

?>

<?php
include_once "includes/global/footer.php";
?>