<?php
require_once(__DIR__ . "/model.php");

class Entry extends model {
    protected static $table = "entries";

    private ?int $id = null;
    private int $user_id;
    private int $steps;
    private int $caffeine;
    private string $sleep_time;
    private float $sleep_hours;
    private ?string $created_at = null;

    public function __construct(array $data = []) {
        $this->user_id = $data["user_id"] ?? 0;
        $this->steps = $data["steps"] ?? 0;
        $this->caffeine = $data["caffeine"] ?? 0;
        $this->sleep_time = $data["sleep_time"] ?? "00:00:00";
        $this->sleep_hours = $data["sleep_hours"] ?? 0.0;

      
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

    public function toArray(): array {
        return [
            "id" => $this->id,
            "user_id" => $this->user_id,
            "steps" => $this->steps,
            "caffeine" => $this->caffeine,
            "sleep_time" => $this->sleep_time,
            "sleep_hours" => $this->sleep_hours,
            "created_at" => $this->created_at
        ];
    }

    public function __toString(): string {
        return "Entry #{$this->id} | User: {$this->user_id} | Steps: {$this->steps} | Caffeine: {$this->caffeine} | Sleep Time: {$this->sleep_time} | Sleep Hours: {$this->sleep_hours} | Created At: {$this->created_at}";
    }
}
?>
