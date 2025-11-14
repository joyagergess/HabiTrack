<?php
include(__DIR__ . "/../models/entries.php");

class EntriesService {

    public static function getAll(mysqli $connection) {
        return entries::findAll($connection);
    }

    public static function getById(int $id, mysqli $connection) {
        return entries::findById($id, "id", $connection);
    }

    public static function create(array $data, mysqli $connection) {
        $entry = new entries($data);
        return $entry->create($data, $connection);
    }

    public static function update(int $id, array $data, mysqli $connection) {
        $entry = new entries([]);
        return $entry->update($data, "id", $id, $connection);
    }

    public static function delete(int $id, mysqli $connection) {
        $entry = new entries([]);
        return $entry->delete("id", $id, $connection);
    }

    public static function findByUser(int $user_id, mysqli $connection) {
        $sql = "SELECT * FROM entries WHERE user_id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
