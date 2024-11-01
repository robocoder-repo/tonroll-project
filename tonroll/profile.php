
<?php
session_start();
require_once 'config.php';
require_once 'functions.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$score = getUserScore($user_id);

// Получаем достижения пользователя
$achievements = getUserAchievements($user_id);

include 'includes/header.php';
?>

<h2>Профиль пользователя</h2>
<p>Ваш текущий счет: <?php echo $score; ?></p>

<h3>Ваши достижения:</h3>
<ul>
<?php foreach ($achievements as $achievement): ?>
    <li><?php echo $achievement['achievement_type']; ?> (<?php echo $achievement['count']; ?> раз)</li>
<?php endforeach; ?>
</ul>

<h3>Доступные игры:</h3>
<ul>
    <li><a href="game.php">Угадай число</a></li>
    <li><a href="rps_game.php">Камень, ножницы, бумага</a></li>
    <li><a href="word_game.php">Угадай слово</a></li>
</ul>

<?php include 'includes/footer.php'; ?>
