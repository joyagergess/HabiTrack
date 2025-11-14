<?php
include("Model.php");

class habit extends model {
    private int $id;
    private int $user_id;
    private string $name;
    private string $category;
    private string $target;
    private string $created_at;

    protected static string $table = "habits";

    public function __construct(array $data = []) {
        if (!empty($data)) {
            $this->id = $data["id"] ;
            $this->user_id = $data["user_id"] ;
            $this->name = $data["name"] ;
            $this->category = $data["category"] ;
            $this->target = $data["target"] ;
            $this->created_at = $data["created_at"] ;
        }
    }

    public function getId(): int {
         return $this->id;
         }

    public function getUserId(): int { 
        return $this->user_id;
     }

    public function setUserId(int $user_id): void { 
        $this->user_id = $user_id;
     }

    public function getName(): string { 
        return $this->name;
     }

    public function setName(string $name): void {
         $this->name = $name; 
        }

    public function getCategory(): string { 
        return $this->category; 
    }

    public function setCategory(string $category): void {
         $this->category = $category;
         }

    public function getTarget(): string {
         return $this->target; 
        }
    public function setTarget(string $target): void {
         $this->target = $target;
         }

    public function getCreatedAt(): string { 
        return $this->created_at; 
    }

    
    public function __toString(): string {
        return "{$this->id} | {$this->name} | {$this->category} | {$this->target} | User: {$this->user_id} | {$this->created_at}";
    }

    public function toArray(): array {
        return [
            "id" => $this->id,
            "user_id" => $this->user_id,
            "name" => $this->name,
            "category" => $this->category,
            "target" => $this->target,
            "created_at" => $this->created_at
        ];
    }
}
?>
