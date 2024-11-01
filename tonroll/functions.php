
<?php
require_once 'config.php';

// ... (оставьте существующие функции)

function getUserAchievements($user_id) {
    global $conn;
    
    $user_id = mysqli_real_escape_string($conn, $user_id);
    
    $sql = "SELECT achievement_type, count FROM achievements WHERE user_id = $user_id";
    $result = mysqli_query($conn, $sql);
    
    $achievements = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $achievements[] = $row;
    }
    
    return $achievements;
}

// ... (оставьте остальные функции без изменений)

?>
