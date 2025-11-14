<?php
include("Model.php");

class user extends model {
    private int $id;
    private string $name;
    private string $email;
    private string $password;
    private string $role;
    private string $created_at;

    protected static string $table = "users";

    public function __construct(array $data = []) {
        if (!empty($data)) {
            $this->id = $data["id"] ;
            $this->name = $data["name"] ;
            $this->email = $data["email"] ;
            $this->password = $data["password"] ;
            $this->role = $data["role"] ;
            $this->created_at = $data["created_at"] ;
        }
    }

    
    public function getId(): int {
        return $this->id;
    }

    
    public function getName(): string {
        return $this->name;
    }
    
    public function setName(string $name): void {
        $this->name = $name;
    }

    
    public function getEmail(): string {
        return $this->email;
    }
    public function setEmail(string $email): void {
        $this->email = $email;
    }

    
    public function getPassword(): string {
        return $this->password;
    }
    public function setPassword(string $password): void {
        $this->password = $password;
    }

    
    public function getRole(): string {
        return $this->role;
    }
    public function setRole(string $role): void {
        $this->role = $role;
    }

    
    public function getCreatedAt(): string {
        return $this->created_at;
    }

   
    public function __toString(): string {
        return $this->id . " | " . $this->name . " | " . $this->email . " | " . $this->role . " | " . $this->created_at;
    }

    public function toArray(): array {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "password" => $this->password,
            "role" => $this->role,
            "created_at" => $this->created_at
        ];
    }
}
?>
