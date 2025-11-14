<?php
include("../connection/connection.php");

$sql = "CREATE TABLE entries (
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(255) NOT NULL,
    steps INT NOT NULL,
    caffeine INT NOT NULL,
    sleep_time TIME NOT NULL,
    sleep_hours DECIMAL(4,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
)";

$query = $connection->prepare($sql);
$query->execute();

echo "Entries table created";
?>
