<?php
require_once(__DIR__ . "/../connection/connection.php");
require_once(__DIR__ . "/../models/Entry.php");
require_once(__DIR__ . "/../services/EntryService.php");
require_once(__DIR__ . "/../services/AIService.php");
require_once(__DIR__ . "/../services/ResponseService.php");

class EntryController {

    public static function create() {
        global $connection;
        $data = json_decode(file_get_contents("php://input"), true);

        if (empty($data['text'])) {
            echo ResponseService::response(400, ["message" => "No entry text provided"]);
            return;
        }

        $parsedData = callAI('parseEntry', $data['text']);
        if (!$parsedData) {
            echo ResponseService::response(500, ["message" => "Failed to parse entry"]);
            return;
        }

        $entryData = [
            "user_id"     => $data["user_id"],
            "free_text"   => $data["text"],
            "steps"       => $parsedData["steps"] ?? null,
            "caffeine"    => $parsedData["caffeine"] ?? null,
            "sleep_time"  => $parsedData["sleep_time"] ?? null,
            "sleep_hours" => $parsedData["sleep_hours"] ?? null
        ];

        if (EntryService::create($entryData, $connection)) {
            echo ResponseService::response(200, ["message" => "Entry created successfully"]);
        } else {
            echo ResponseService::response(500, ["message" => "Failed to create entry"]);
        }
    }

    public static function update() {
    global $connection;
    $id = intval($_GET['id'] ?? 0);
    $data = json_decode(file_get_contents("php://input"), true);

    if (!$id) {
        echo ResponseService::response(400, ["message" => "ID required"]);
        return;
    }

    if (empty($data['text'])) {
        echo ResponseService::response(400, ["message" => "No entry text provided"]);
        return;
    }
    $parsedData = callAI('parseEntry', $data['text']);
    if (!$parsedData) {
        echo ResponseService::response(500, ["message" => "Failed to parse entry"]);
        return;
    }

    $updateData = [
        "free_text"   => $data["text"],
        "steps"       => $parsedData["steps"] ?? null,
        "caffeine"    => $parsedData["caffeine"] ?? null,
        "sleep_time"  => $parsedData["sleep_time"] ?? null,
        "sleep_hours" => $parsedData["sleep_hours"] ?? null,
    ];

    if (EntryService::update($id, $updateData, $connection)) {
        echo ResponseService::response(200, ["message" => "Entry updated successfully"]);
    } else {
        echo ResponseService::response(500, ["message" => "Failed to update entry"]);
    }
}

    public static function delete() {
        global $connection;
        $id = intval($_GET['id'] ?? 0);

        if (!$id) {
            echo ResponseService::response(400, ["message" => "ID required"]);
            return;
        }

        if (EntryService::delete($id, $connection)) {
            echo ResponseService::response(200, ["message" => "Entry deleted successfully"]);
        } else {
            echo ResponseService::response(500, ["message" => "Failed to delete entry"]);
        }
    }

  
    public static function getAll() {
        global $connection;
        $entries = EntryService::getAll($connection);
        echo ResponseService::response(200, $entries);
    }

     public static function getByUser() {
        global $connection;
        $user_id = intval($_GET['user_id'] ?? 0);

        if (!$user_id) {
            echo ResponseService::response(400, ["message" => "User ID required"]);
            return;
        }

        $entries = EntryService::getByUserId($user_id, $connection);
        echo ResponseService::response(200, $entries);
    }

}
?>
