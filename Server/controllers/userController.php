<?php
require_once(__DIR__ . "/../models/User.php");
require_once(__DIR__ . "/../connection/connection.php");
require_once(__DIR__ . "/../services/UserService.php");

class UserController {

   
    public function getUserByID() {
        global $connection;

        try {
            if (empty($_GET["id"])) {
                echo ResponseService::response(400, "ID is missing");
                return;
            }

            $id = $_GET["id"];
            $user = UserService::findUserByID($id, $connection);

            if ($user) {
                echo ResponseService::response(200, $user);
            } else {
                echo ResponseService::response(404, "User not found");
            }

        } catch (Exception $e) {
            echo ResponseService::response(500, "Server Error: " . $e->getMessage());
        }
    }

 
    public function getUsers() {
        global $connection;

        try {
            $users = UserService::findAllUsers($connection);
            echo ResponseService::response(200, $users);

        } catch (Exception $e) {
            echo ResponseService::response(500, "Server Error: " . $e->getMessage());
        }
    }

    
    public function createUser() {
        global $connection;

      
        if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password'])) {
            echo ResponseService::response(400, "Name, email, and password are required");
            return;
        }

        $data = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
            'role' => $_POST['role'] ?? 'user'
        ];

        $user = UserService::createUser($data, $connection);

        if ($user) {
            echo ResponseService::response(200, "User created successfully");
        } else {
            echo ResponseService::response(500, "Failed to create user");
        }
    }

    public function updateUser() {
        global $connection;

        if (empty($_POST["id"])) {
            echo ResponseService::response(400, "User ID is required");
            return;
        }

        $id = $_POST["id"];

        if (empty($_POST["name"]) || empty($_POST["email"])) {
            echo ResponseService::response(400, "Name and email are required");
            return;
        }

        $data = [
            "name" => $_POST["name"],
            "email" => $_POST["email"],
            "role" => $_POST["role"] ?? 'user'
        ];

        if (!empty($_POST['password'])) {
            $data['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
        }

        $updated = UserService::updateUser($data, $id, $connection);

        if ($updated) {
            echo ResponseService::response(200, "User updated successfully");
        } else {
            echo ResponseService::response(500, "Failed to update user");
        }
    }

  
    public function deleteUser() {
        global $connection;

        if (empty($_POST["id"])) {
            echo ResponseService::response(400, "User ID is required");
            return;
        }

        $id = $_POST["id"];
        $deleted = UserService::deleteUser($id, $connection);

        if ($deleted) {
            echo ResponseService::response(200, "User deleted successfully");
        } else {
            echo ResponseService::response(500, "Failed to delete user");
        }
    }
}
?>
