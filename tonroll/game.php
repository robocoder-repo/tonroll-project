
<?php
session_start();
require_once 'config.php';
require_once 'functions.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$message = '';
$score = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $guess = $_POST['guess'];
    $number = $_SESSION['number'];
    
    if ($guess == $number) {
        $message = "Поздравляем! Вы угадали число!";
        $score = 10;
        updateUserScore($_SESSION['user_id'], $score);
        unset($_SESSION['number']);
    } elseif ($guess < $number) {
        $message = "Попробуйте число побольше";
    } else {
        $message = "Попробуйте число поменьше";
    }
}

if (!isset($_SESSION['number'])) {
    $_SESSION['number'] = rand(1, 100);
}

include 'includes/header.php';
?>

<h2>Игра "Угадай число"</h2>
<p>Угадайте число от 1 до 100</p>

<?php if ($message): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>

<form method="post" action="">
    <input type="number" name="guess" min="1" max="100" required>
    <input type="submit" value="Угадать">
</form>

<?php include 'includes/footer.php'; ?>
