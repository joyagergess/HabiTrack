<?php
require_once(__DIR__ . "/../models/user.php");
require_once(__DIR__ . "/UserService.php"); 

class AuthService {

    public static function signup(array $data, mysqli $connection) {
        $existing = UserService::findUserByEmail($data['email'], $connection);
        if ($existing) return false;

        $user = new user($data);
        return $user->create($data, $connection);
    }

    public static function login(string $email, string $password, mysqli $connection) {
        $user = UserService::findUserByEmail($email, $connection);
        if (!$user) return false;
        if (!password_verify($password, $user['password'])) return false;

        unset($user['password']);
        return $user;
    }
}
?>
