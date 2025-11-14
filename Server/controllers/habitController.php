<?php
require_once(__DIR__ . "/../models/User.php");
require_once(__DIR__ . "/../connection/connection.php");
require_once(__DIR__ . "/../services/HabitService.php");

class habitController {

    public static function create(mysqli $connection) {
        $data = json_decode(file_get_contents("php://input"), true);

        if (HabitService::createHabit($data, $connection)) {
            echo json_encode(["message" => "Habit created successfully"]);
        } else {
            echo json_encode(["error" => "Failed to create habit"]);
        }
    }

    public static function update(mysqli $connection, int $id) {
        $data = json_decode(file_get_contents("php://input"), true);

        if (HabitService::updateHabit($data, $id, $connection)) {
            echo json_encode(["message" => "Habit updated successfully"]);
        } else {
            echo json_encode(["error" => "Failed to update habit"]);
        }
    }

    public static function delete(mysqli $connection, int $id) {
        if (HabitService::deleteHabit($id, $connection)) {
            echo json_encode(["message" => "Habit deleted successfully"]);
        } else {
            echo json_encode(["error" => "Failed to delete habit"]);
        }
    }

    public static function getOne(mysqli $connection, int $id) {
        $habit = HabitService::findHabitById($id, $connection);
        echo json_encode($habit ?: ["error" => "Habit not found"]);
    }

    public static function getAll(mysqli $connection) {
        $habits = HabitService::findAllHabits($connection);
        echo json_encode($habits);
    }

    public static function getByUser(mysqli $connection, int $user_id) {
        $habits = HabitService::findHabitsByUser($user_id, $connection);
        echo json_encode($habits);
    }
}
?>
