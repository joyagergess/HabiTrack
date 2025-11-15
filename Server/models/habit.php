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
        $this->category = $data["category"] ?? "";
        $this->target = $data["target"] ?? "";
        $this->status = $data["status"] ?? 1;
        $this->created_at = $data["created_at"] ?? null;
    }

    public function getId(): ?int { return $this->id; }
    public function getUserId(): int { return $this->user_id; }
    public function getName(): string { return $this->name; }
    public function getCategory(): string { return $this->category; }
    public function getTarget(): string { return $this->target; }
    public function getStatus(): int { return $this->status; }
    public function getCreatedAt(): ?string { return $this->created_at; }

    public function setUserId(int $user_id): void { $this->user_id = $user_id; }
    public function setName(string $name): void { $this->name = $name; }
    public function setCategory(string $category): void { $this->category = $category; }
    public function setTarget(string $target): void { $this->target = $target; }
    public function setStatus(int $status): void { $this->status = $status; }

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
        return "{$this->id} | {$this->name} | {$this->category} | {$this->target} | Status: {$this->status} | User: {$this->user_id} | {$this->created_at}";
    }
}
?>
