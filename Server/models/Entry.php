<?php
require_once(__DIR__ . "/Model.php");

class Entry extends Model {
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
        $this->id = $data["id"] ?? null;
        $this->created_at = $data["created_at"] ?? null;
       
    }

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
