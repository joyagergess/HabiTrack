<?php
require_once(__DIR__ . "/../connection/connection.php");
require_once(__DIR__ . "/../models/Entry.php");
require_once(__DIR__ . "/../services/EntryService.php");
require_once(__DIR__ . "/../services/AIService.php");
require_once(__DIR__ . "/../services/ResponseService.php");
require_once(__DIR__ . "/../services/SummaryService.php");
class SummaryController {

    public static function weeklySummary() {
        global $connection;

        $data = json_decode(file_get_contents("php://input"), true);
        $userId = intval($data["user_id"] ?? 0);

        if (!$userId) {
            echo ResponseService::response(400, ["message" => "User ID required"]);
            return;
        }

        $summary = SummaryService::generateWeeklySummary($userId, $connection);

        echo ResponseService::response(200, [
            "summary" => $summary
        ]);
    }
}
