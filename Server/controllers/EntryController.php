<?php

require_once(__DIR__ . "/../connection/connection.php");
require_once(__DIR__ . "/../models/Entry.php");
require_once(__DIR__ . "/../services/EntryService.php");
require_once(__DIR__ . "/../services/AIService.php");


class EntryController {

    public static function create() {
    global $connection;

    $data = json_decode(file_get_contents("php://input"), true);

    if (empty($data['text'])) {
        echo json_encode(["error" => "No entry text provided"]);
        return;
    }

    $parsedData = callAI('parseEntry', $data['text']);

    if (!$parsedData) {
        echo json_encode(["error" => "Failed to parse entry"]);
        return;
    }
    $entryData = [
    "user_id"     => $data["user_id"],
    "steps"       => $parsedData["steps"] ?? 0,
    "caffeine"    => $parsedData["caffeine"] ?? 0,
    "sleep_time"  => $parsedData["sleep_time"] ?? "00:00:00",
    "sleep_hours" => $parsedData["sleep_hours"] ?? 0
];



    if (EntryService::create($entryData, $connection)) {
        echo json_encode(["message" => "Entry created successfully"]);
    } else {
        echo json_encode(["error" => "Failed to create entry"]);
    }
  }



    public static function update() {
        global $connection;
        $data = json_decode(file_get_contents("php://input"), true);
        $id = intval($_GET['id'] ?? 0);

        if (!$id) {
            echo json_encode(["error" => "ID required"]);
            return;
        }

        if (EntryService::update($id, $data, $connection)) {
            echo json_encode(["message" => "Entry updated successfully"]);
        } else {
            echo json_encode(["error" => "Failed to update entry"]);
        }
    }

    public static function delete() {
        global $connection;
        $id = intval($_GET['id'] ?? 0);

        if (!$id) {
            echo json_encode(["error" => "ID required"]);
            return;
        }

        if (EntryService::delete($id, $connection)) {
            echo json_encode(["message" => "Entry deleted successfully"]);
        } else {
            echo json_encode(["error" => "Failed to delete entry"]);
        }
    }

    public static function getOne() {
        global $connection;
        $id = intval($_GET['id'] ?? 0);

        if (!$id) {
            echo json_encode(["error" => "ID required"]);
            return;
        }

        $entry = EntryService::getById($id, $connection);
        echo json_encode($entry ?: ["error" => "Entry not found"]);
    }

    public static function getAll() {
        global $connection;
        $entries = EntryService::getAll($connection);
        echo json_encode($entries);
    }

    public static function getByUser() {
        global $connection;
        $user_id = intval($_GET['user_id'] ?? 0);

        if (!$user_id) {
            echo json_encode(["error" => "User ID required"]);
            return;
        }

        $entries = EntryService::findByUser($user_id, $connection);
        echo json_encode($entries);
    }
}
?>
