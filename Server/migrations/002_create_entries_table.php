<?php
include("../connection/connection.php");

$sql = "CREATE TABLE entries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    free_text TEXT NOT NULL,
    steps INT DEFAULT NULL,
    caffeine INT DEFAULT NULL,
    sleep_time TIME DEFAULT NULL,
    sleep_hours DECIMAL(4,2) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
)";


$query = $connection->prepare($sql);
$query->execute();

echo "Entries table created";
?>
