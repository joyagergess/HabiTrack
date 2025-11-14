<?php
require_once(__DIR__ . "/../models/Entry.php");

class EntryService {

    public static function getAll(mysqli $connection) {
        return Entry::findAll($connection);
    }

    public static function getById(int $id, mysqli $connection) {
        return Entry::findById($id, "id", $connection);
    }

    public static function create(array $data, mysqli $connection) {
        $entry = new Entry($data);
        return $entry->create($data, $connection);
    }

    public static function update(int $id, array $data, mysqli $connection) {
        $entry = new Entry([]);
        return $entry->update($data, "id", $id, $connection);
    }

    public static function delete(int $id, mysqli $connection) {
        $entry = new Entry([]);
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
?>
