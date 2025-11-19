<?php
require_once(__DIR__ . "/../models/habit.php");

class HabitService {

    public static function createHabit(array $data, mysqli $connection) {
        $habit = new Habit($data);
        return $habit->create($data, $connection);
    }

    public static function updateHabit(array $data, int $id, mysqli $connection) {
        $habit = new Habit([]);
        return $habit->update($data, 'id', $id, $connection);
    }

    public static function deleteHabit(int $id, mysqli $connection) {
        $habit = new Habit([]);
        return $habit->delete('id', $id, $connection);
    }

     public static function getByUserId(int $userId, mysqli $connection) {
        return Habit::findById($userId, "user_id", $connection); 
    }
 

    public static function findAllHabits(mysqli $connection) {
        return Habit::findAll($connection);
    }


    public static function toggleStatus(int $id, mysqli $connection) {
        $habit = Habit::findById($id, "id", $connection);
    
        if (!$habit || empty($habit[0])) {
            return false; 
        }
    
        $currentStatus = $habit[0]["status"];
        $newStatus = $currentStatus == 1 ? 0 : 1;
    
        $habitModel = new Habit([]);
        return $habitModel->update(
            ['status' => $newStatus],
            "id",
            $id,
            $connection
        );
    }



}


?>