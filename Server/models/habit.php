<?php
require_once(__DIR__ . "/model.php");

class habit extends model {
    private ?int $id = null;
    private int $user_id;
    private string $name;
    private string $category;
    private string $target;
    private int $status;  
    private ?string $created_at = null;

    protected static $table = "habits";

    public function __construct(array $data = []) {
        $this->id = $data["id"] ?? null;
        $this->user_id = $data["user_id"] ?? 0;
        $this->name = $data["name"] ?? "";
        $this->target = $data["target"] ?? "";
        $this->status = $data["status"] ?? 1;
        $this->created_at = $data["created_at"] ?? null;
    }

    public function toArray(): array {
        return [
            "id" => $this->id,
            "user_id" => $this->user_id,
            "name" => $this->name,
            "category" => $this->category,
            "target" => $this->target,
            "status" => $this->status,
            "created_at" => $this->created_at
        ];
    }

    public function __toString(): string {
        return "{$this->id} | {$this->name} | {$this->category} | {$this->target} |
         Status: {$this->status} | User: {$this->user_id} | {$this->created_at}";
    }
}
?>
