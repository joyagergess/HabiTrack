<?php
require_once(__DIR__ . "/../models/habit.php");
require_once(__DIR__ . "/../connection/connection.php");
require_once(__DIR__ . "/../services/HabitService.php");
require_once(__DIR__ . "/../services/ResponseService.php");

class HabitController {

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
        $id = $_GET["id"] ;

        if (HabitService::updateHabit($data, $id, $connection)) {
            echo ResponseService::response(200, "Habit updated successfully");
        } else {
            echo ResponseService::response(500, "Failed to update habit");
        }
    }

    public static function delete() {
        global $connection;
        $id = $_GET["id"] ;

        if (HabitService::deleteHabit($id, $connection)) {
            echo ResponseService::response(200, "Habit deleted successfully");
        } else {
            echo ResponseService::response(500, "Failed to delete habit");
        }
    }

    public static function getAll() {
        global $connection;
        $habits = HabitService::findAllHabits($connection);
        echo ResponseService::response(200, $habits);
    }

    public static function getByUser() {
        global $connection;
        $user_id = $_GET["user_id"] ;

        $habits = HabitService::getByUserId($user_id, $connection);
        HabitService::getByUserId($user_id, $connection);
        echo ResponseService::response(200, $habits);
    }
  
    public static function toggleStatus() {
        global $connection;
        $id = $_GET["id"] ;

        if (HabitService::toggleStatus($id, $connection)) {
            echo ResponseService::response(200, "Habit status toggled");
        } else {
            echo ResponseService::response(500, "Failed to toggle habit status");
        }
    }
}
?>
