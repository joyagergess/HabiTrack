<?php
require_once(__DIR__ . "/model.php");

class Entry extends model {
    protected static $table = "entries";

    private ?int $id = null;
    private int $user_id;
    private ?int $steps = null;
    private ?int $caffeine = null;
    private ?string $sleep_time = null;
    private ?float $sleep_hours = null;
    private ?string $created_at = null;
    private string $free_text;



    public function __construct(array $data = []) {
        $this->user_id = $data["user_id"] ?? 0;
        $this->steps = $data["steps"] ?? null;
        $this->caffeine = $data["caffeine"] ?? null;
        $this->sleep_time = $data["sleep_time"] ?? null;
        $this->sleep_hours = $data["sleep_hours"] ?? null;
        $this->free_text = $data["free_text"] ?? "";

        if (!empty($data["id"])) $this->id = $data["id"];
        if (!empty($data["created_at"])) $this->created_at = $data["created_at"];
    }

    public function getId(): ?int { return $this->id; }
    public function getUserId(): int { return $this->user_id; }
    public function getSteps(): int { return $this->steps; }
    public function getCaffeine(): int { return $this->caffeine; }
    public function getSleepTime(): string { return $this->sleep_time; }
    public function getSleepHours(): float { return $this->sleep_hours; }
    public function getCreatedAt(): ?string { return $this->created_at; }

    public function setUserId(int $user_id): void { $this->user_id = $user_id; }
    public function setSteps(int $steps): void { $this->steps = $steps; }
    public function setCaffeine(int $caffeine): void { $this->caffeine = $caffeine; }
    public function setSleepTime(string $sleep_time): void { $this->sleep_time = $sleep_time; }
    public function setSleepHours(float $sleep_hours): void { $this->sleep_hours = $sleep_hours; }

    public function getFreeText(): string { return $this->free_text; }
    public function setFreeText(string $free_text): void { $this->free_text = $free_text; }


    public function toArray(): array {
    return [
        "id" => $this->id,
        "user_id" => $this->user_id,
        "free_text" => $this->free_text,  
        "steps" => $this->steps,
        "caffeine" => $this->caffeine,
        "sleep_time" => $this->sleep_time,
        "sleep_hours" => $this->sleep_hours,
        "created_at" => $this->created_at
    ];
}

}
?>
