<?php
require_once(__DIR__ . "/../models/habit.php");
require_once(__DIR__ . "/../connection/connection.php");
require_once(__DIR__ . "/../services/HabitService.php");
require_once(__DIR__ . "/../services/ResponseService.php");

class habitController {

    public static function create() {
        global $connection;
        $data = json_decode(file_get_contents("php://input"), true);

        if (HabitService::createHabit($data, $connection)) {
            echo ResponseService::response(200, "Habit created successfully");
        } else {
            echo ResponseService::response(500, "Failed to create habit");
        }
    }

    public static function update() {
        global $connection;
        $data = json_decode(file_get_contents("php://input"), true);
        $id = intval($_GET["id"] ?? 0);

        if ($id <= 0) {
            echo ResponseService::response(400, "Habit ID is required");
            return;
        }

        if (HabitService::updateHabit($data, $id, $connection)) {
            echo ResponseService::response(200, "Habit updated successfully");
        } else {
            echo ResponseService::response(500, "Failed to update habit");
        }
    }

    public static function delete() {
        global $connection;
        $id = intval($_GET["id"] ?? 0);

        if ($id <= 0) {
            echo ResponseService::response(400, "Habit ID is required");
            return;
        }

        if (HabitService::deleteHabit($id, $connection)) {
            echo ResponseService::response(200, "Habit deleted successfully");
        } else {
            echo ResponseService::response(500, "Failed to delete habit");
        }
    }

    public static function getOne() {
        global $connection;
        $id = intval($_GET["id"] ?? 0);

        if ($id <= 0) {
            echo ResponseService::response(400, "Habit ID is required");
            return;
        }

        $habit = HabitService::findHabitById($id, $connection);
        echo ResponseService::response($habit ? 200 : 404, $habit ?: "Habit not found");
    }

    public static function getAll() {
        global $connection;
        $habits = HabitService::findAllHabits($connection);
        echo ResponseService::response(200, $habits);
    }

    public static function getByUser() {
        global $connection;
        $user_id = intval($_GET["user_id"] ?? 0);

        if ($user_id <= 0) {
            echo ResponseService::response(400, "User ID is required");
            return;
        }

        $habits = HabitService::findHabitsByUser($user_id, $connection);
        echo ResponseService::response(200, $habits);
    }

    public static function toggleStatus() {
        global $connection;
        $id = intval($_GET["id"] ?? 0);

        if ($id <= 0) {
            echo ResponseService::response(400, "Habit ID is required");
            return;
        }

        if (HabitService::toggleStatus($id, $connection)) {
            echo ResponseService::response(200, "Habit status toggled");
        } else {
            echo ResponseService::response(500, "Failed to toggle habit status");
        }
    }
}
?>
