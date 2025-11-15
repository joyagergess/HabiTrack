<?php
require_once(__DIR__ . "/../models/habit.php");

class HabitService {

    public static function createHabit(array $data, mysqli $connection) {
        $habit = new habit($data);
        return $habit->create($data, $connection);
    }

    public static function updateHabit(array $data, int $id, mysqli $connection) {
        $habit = new habit([]);
        return $habit->update($data, 'id', $id, $connection);
    }

    public static function deleteHabit(int $id, mysqli $connection) {
        $habit = new habit([]);
        return $habit->delete('id', $id, $connection);
    }

    public static function findHabitById(int $id, mysqli $connection) {
        return habit::findById($id, 'id', $connection);
    }

    public static function findAllHabits(mysqli $connection) {
        return habit::findAll($connection);
    }

    public static function findHabitsByUser(int $user_id, mysqli $connection) {
        $sql = "SELECT * FROM habits WHERE user_id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    
    public static function toggleStatus(int $id, mysqli $connection) {
        $habit = self::findHabitById($id, $connection);
        if (!$habit) return false;
        $newStatus = $habit['status'] == 1 ? 0 : 1;
    
        $habitModel = new habit([]);
        return $habitModel->update(['status' => $newStatus], 'id', $id, $connection);
    }
}


?>
