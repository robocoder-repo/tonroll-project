
<?php
require_once 'config.php';
require_once 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $user_id = loginUser($username, $password);
    if ($user_id) {
        session_start();
        $_SESSION['user_id'] = $user_id;
        echo "Login successful!";
    } else {
        echo "Invalid username or password.";
    }
}

include 'includes/header.php';
?>

<h2>Login</h2>
<form method="post" action="">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br>
    
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br>
    
    <input type="submit" value="Login">
</form>

<?php include 'includes/footer.php'; ?>
