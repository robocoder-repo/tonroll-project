
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
$choices = ['камень', 'ножницы', 'бумага'];
$achievement = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $player_choice = $_POST['choice'];
    $computer_choice = $choices[array_rand($choices)];
    
    $result = determineWinner($player_choice, $computer_choice);
    
    if ($result == 'win') {
        $message = "Вы выиграли! Компьютер выбрал {$computer_choice}.";
        $score = 5;
        updateUserScore($_SESSION['user_id'], $score);
        $achievement = checkAchievement($_SESSION['user_id'], 'rps_win');
    } elseif ($result == 'lose') {
        $message = "Вы проиграли. Компьютер выбрал {$computer_choice}.";
    } else {
        $message = "Ничья. Компьютер тоже выбрал {$computer_choice}.";
    }
}

$total_score = getUserScore($_SESSION['user_id']);

include 'includes/header.php';
?>
<link rel="stylesheet" href="css/rps_styles.css">

<div class="game-container">
    <h2>Камень, ножницы, бумага</h2>
    
    <div class="score">Ваш общий счет: <?php echo $total_score; ?></div>
    
    <?php if ($message): ?>
        <div class="result"><?php echo $message; ?></div>
    <?php endif; ?>
    
    <?php if ($achievement): ?>
        <div class="achievement"><?php echo $achievement; ?></div>
    <?php endif; ?>
    
    <form method="post" action="">
        <div class="choices">
            <button type="submit" name="choice" value="камень" class="choice">
                <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="50" cy="50" r="45" fill="#8B4513" />
                </svg>
            </button>
            <button type="submit" name="choice" value="ножницы" class="choice">
                <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                    <path d="M30,30 L70,70 M30,70 L70,30" stroke="#000" stroke-width="10" />
                </svg>
            </button>
            <button type="submit" name="choice" value="бумага" class="choice">
                <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                    <rect x="20" y="20" width="60" height="60" fill="#FFF" stroke="#000" stroke-width="5" />
                </svg>
            </button>
        </div>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
