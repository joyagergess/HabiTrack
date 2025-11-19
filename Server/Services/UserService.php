<?php
require_once(__DIR__ . "/../models/User.php");
require_once(__DIR__ . "/../services/ResponseService.php");

class UserService {

    public static function createUser(array $data, mysqli $connection) {
        $user = new user($data);
        return $user->create($data, $connection);
    }

    public static function updateUser(array $data, int $id, mysqli $connection) {
        $user = new user([]);
        return $user->update($data, 'id', $id, $connection);
    }

    public static function deleteUser(int $id, mysqli $connection) {
        $user = new user([]);
        return $user->delete('id', $id, $connection);
    }

    public static function findUserByID(int $id, mysqli $connection) {
        return user::findById($id, 'id', $connection);
    }

    public static function findAllUsers(mysqli $connection) {
        return user::findAll($connection);
    }

    public static function findUserByEmail(string $email, mysqli $connection) {
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
   }  
   
   
    public static function findUserByName(string $name, mysqli $connection) {
        $sql = "SELECT * FROM users WHERE name = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

  public static function findUserByPassword(string $password, mysqli $connection) {
    $sql = "SELECT password FROM users";
    $result = $connection->query($sql);

    if (!$result) return null;

    while ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            return true;
        }
    }

    return false; 
}

}



?>
