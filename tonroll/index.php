
<?php
require_once 'config.php';
require_once 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if (registerUser($username, $email, $password)) {
        echo "User registered successfully!";
    } else {
        echo "Error registering user.";
    }
}

include 'includes/header.php';
?>

<h2>Register</h2>
<form method="post" action="">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br>
    
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br>
    
    <input type="submit" value="Register">
</form>

<?php include 'includes/footer.php'; ?>
