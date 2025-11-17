<?php
include("../connection/connection.php");


$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

$query = $connection->prepare($sql);
$query->execute();

echo "  table users created ";


$email = "admin@gmail.com";

$query = $connection->prepare("SELECT * FROM users WHERE email = ?");
$query->bind_param("s", $email);
$query->execute();
$result = $query->get_result();

if ($result->num_rows == 0) {
    $password = password_hash("Admin123", PASSWORD_DEFAULT);
    $role = "admin";

    $insert = $connection->prepare("INSERT INTO users (name, email, password, role, created_at) VALUES (?, ?, ?, ?, NOW())");
    $name = "Admin";
    $insert->bind_param("ssss", $name, $email, $password, $role);
    $insert->execute();

    echo "Admin user created successfully.<br>";
} else {
    echo "Admin user already exists.<br>";
}
?>