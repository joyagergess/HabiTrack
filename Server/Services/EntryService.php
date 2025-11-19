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
  public static function getByUserId(int $userId, mysqli $connection) {
        return Entry::findById($userId, "user_id", $connection); 
    }
 
}
?>
