<?php
require_once(__DIR__ . "/../models/Entries.php");
require_once(__DIR__ . "/../services/EntriesService.php");
require_once(__DIR__ . "/../connection/connection.php");

class EntriesController {

    public static function create(mysqli $connection) {
        $data = json_decode(file_get_contents("php://input"), true);

        if (EntriesService::create($data, $connection)) {
            echo json_encode(["message" => "Entry created successfully"]);
        } else {
            echo json_encode(["error" => "Failed to create entry"]);
        }
    }

    public static function update(mysqli $connection, int $id) {
        $data = json_decode(file_get_contents("php://input"), true);

        if (EntriesService::update($id, $data, $connection)) {
            echo json_encode(["message" => "Entry updated successfully"]);
        } else {
            echo json_encode(["error" => "Failed to update entry"]);
        }
    }

    public static function delete(mysqli $connection, int $id) {
        if (EntriesService::delete($id, $connection)) {
            echo json_encode(["message" => "Entry deleted successfully"]);
        } else {
            echo json_encode(["error" => "Failed to delete entry"]);
        }
    }

    public static function getOne(mysqli $connection, int $id) {
        $entry = EntriesService::getById($id, $connection);
        echo json_encode($entry ?: ["error" => "Entry not found"]);
    }

    public static function getAll(mysqli $connection) {
        $entries = EntriesService::getAll($connection);
        echo json_encode($entries);
    }

    public static function getByUser(mysqli $connection, int $user_id) {
        $entries = EntriesService::getByUser($user_id, $connection);
        echo json_encode($entries);
    }
}
