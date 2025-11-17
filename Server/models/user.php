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


}
?>
