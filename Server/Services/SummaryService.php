<?php 
require_once(__DIR__ . "/AISummary.php");

class SummaryService {

    public static function generateWeeklySummary(int $userId, mysqli $connection) {
        if (!$userId) return null;

        $sqlEntries = "SELECT free_text, created_at 
                       FROM entries 
                       WHERE user_id = ? 
                       AND created_at >= NOW() - INTERVAL 7 DAY
                       ORDER BY created_at ASC";

        $stmt = $connection->prepare($sqlEntries);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        $entries = [];
        while ($row = $result->fetch_assoc()) {
            $entries[] = $row;
        }
        $stmt->close();

        $sqlHabits = "SELECT name, target, status 
                      FROM habits 
                      WHERE user_id = ?";
        $stmt = $connection->prepare($sqlHabits);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        $habits = [];
        while ($row = $result->fetch_assoc()) {
            $habits[] = $row;
        }
        $stmt->close();

        if (empty($entries) && empty($habits)) {
            return "No entries or habits found for the past week.";
        }

        $entryText = "";

        if (!empty($entries)) {
            foreach ($entries as $e) {
                $date = date("Y-m-d", strtotime($e['created_at']));
                $notes = $e['free_text'] ?? '';
                $entryText .= "Date: $date, Notes: $notes\n";
            }
        }

        if (!empty($habits)) {
            $entryText .= "\nUser Habits:\n";
            foreach ($habits as $h) {
                $status = $h['status'] ? 'active' : 'inactive';
                $target = $h['target'] ? " with target {$h['target']}" : "";
                $entryText .= "- {$h['name']} ($status)$target\n";
            }
        }

        return AISummary::generateWeeklySummary($entryText);
    }
}
