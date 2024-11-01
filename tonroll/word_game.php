
<?php
session_start();
require_once 'config.php';
require_once 'functions.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$words = ['программирование', 'компьютер', 'алгоритм', 'интернет', 'разработка'];

if (!isset($_SESSION['word_game'])) {
    $_SESSION['word_game'] = [
        'word' => $words[array_rand($words)],
        'guessed' => [],
        'attempts' => 6
    ];
}

$game = &$_SESSION['word_game'];

$message = '';
$game_over = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $letter = strtolower($_POST['letter']);
    
    if (!in_array($letter, $game['guessed'])) {
        $game['guessed'][] = $letter;
        
        if (strpos($game['word'], $letter) === false) {
            $game['attempts']--;
        }
    }
    
    if ($game['attempts'] == 0) {
        $message = "Игра окончена. Загаданное слово было: {$game['word']}";
        $game_over = true;
    } elseif (count(array_diff(str_split($game['word']), $game['guessed'])) == 0) {
        $message = "Поздравляем! Вы угадали слово: {$game['word']}";
        $game_over = true;
        $score = 10;
        updateUserScore($_SESSION['user_id'], $score);
        checkAchievement($_SESSION['user_id'], 'word_game_win');
    }
}

if ($game_over) {
    unset($_SESSION['word_game']);
}

include 'includes/header.php';
?>

<h2>Угадай слово</h2>
<p>У вас осталось попыток: <?php echo $game['attempts']; ?></p>

<?php if ($message): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>

<?php if (!$game_over): ?>
    <p>
        <?php
        foreach (str_split($game['word']) as $letter) {
            if (in_array($letter, $game['guessed'])) {
                echo $letter . ' ';
            } else {
                echo '_ ';
            }
        }
        ?>
    </p>

    <form method="post" action="">
        <label for="letter">Введите букву:</label>
        <input type="text" id="letter" name="letter" maxlength="1" required>
        <input type="submit" value="Угадать">
    </form>
<?php else: ?>
    <p><a href="word_game.php">Играть снова</a></p>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
