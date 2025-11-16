<?php
require_once(__DIR__ . "/../connection/connection.php");
require_once(__DIR__ . "/SummaryService.php");

require_once(__DIR__ . "/AIService.php");

// Replace with a valid user ID that exists in your database
$userId = 3;

$summary = SummaryService::generateWeeklySummary($userId, $connection);

echo "<pre>";
if ($summary) {
    echo "Weekly Summary for user {$userId}:\n\n";
    echo $summary;
} else {
    echo "No summary generated. Check entries or AIService.";
}
echo "</pre>";
