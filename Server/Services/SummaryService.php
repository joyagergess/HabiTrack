<?php require_once(__DIR__ . "/AISummary.php");

class SummaryService {

    public static function generateWeeklySummary(int $userId, mysqli $connection) {
        if (!$userId) return null;

        $sql = "SELECT free_text, created_at 
                FROM entries 
                WHERE user_id = ? 
                AND created_at >= NOW() - INTERVAL 7 DAY
                ORDER BY created_at ASC";

        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        $entries = [];
        while ($row = $result->fetch_assoc()) {
            $entries[] = $row;
        }
        $stmt->close();

        if (empty($entries)) {
            return "No entries for the past week.";
        }

        
        $entryText = "";
        foreach ($entries as $e) {
            $date = date("Y-m-d", strtotime($e['created_at']));
            $notes = $e['free_text'] ?? '';
            $entryText .= "Date: $date, Notes: $notes\n";
        }

        return AISummary::generateWeeklySummary($entryText);
    }
}
