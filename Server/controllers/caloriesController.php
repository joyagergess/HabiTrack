<?php
require_once(__DIR__ . "/../connection/connection.php");
require_once(__DIR__ . "/../models/Entry.php");
require_once(__DIR__ . "/../services/EntryService.php");
require_once(__DIR__ . "/../services/AIService.php");
require_once(__DIR__ . "/../services/ResponseService.php");
require_once(__DIR__ . "/../services/CaloriesService.php");

class CaloriesController {

    public static function calculateCalories() {
        global $connection;
        $data = json_decode(file_get_contents("php://input"), true);
        $userId = intval($data["user_id"] ?? 0);
        $foodLog = trim($data["food_log"] ?? '');

        if (!$userId || !$foodLog) {
            echo ResponseService::response(400, ["message" => "User ID and food log required"]);
            return;
        }
        
        $caloriesSummary = CaloriesService::generateCaloriesFromText($foodLog);
        echo ResponseService::response(200, ["summary" => $caloriesSummary]);
            }}