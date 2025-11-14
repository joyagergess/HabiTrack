<?php
require_once(__DIR__ . "/model.php");


class user extends model {
    protected static  $table = "users";

    private ?int $id;            
    private string $name;     
    private string $email;       
    private string $password;  
    private string $role;         
    private ?string $created_at; 

    public function __construct(array $data = []) {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->password = $data['password'] ?? '';
        $this->role = $data['role'] ?? 'user';
        $this->created_at = $data['created_at'] ?? null;
    }


    public function getId(): ?int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getRole(): string {
        return $this->role;
    }

    public function getCreatedAt(): ?string {
        return $this->created_at;
    }

    
    public function setName(string $name) {
        $this->name = $name;
    }

    public function setEmail(string $email) {
        $this->email = $email;
    }

    public function setPassword(string $password) {
        $this->password = $password;
    }

    public function setRole(string $role) {
        $this->role = $role;
    }
}
?>
