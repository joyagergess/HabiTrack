<?php
include("../connection/connection.php");

$sql = "CREATE TABLE IF NOT EXISTS entries (
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(255) NOT NULL,
    free_text TEXT NOT NULL,
    json_text JSON NULL,
    steps INT NULL,
    caffeine INT NULL,
    sleep_time TIME NULL,
    sleep_hours DECIMAL(4,2) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
)";

$query = $connection->prepare($sql);
$query->execute();

echo "Entries table created ";
?>
