
<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'tonroll_db');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Create users table if not exists
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    score INT DEFAULT 0
)";

if (!mysqli_query($conn, $sql)) {
    echo "Error creating table: " . mysqli_error($conn);
}
?>
