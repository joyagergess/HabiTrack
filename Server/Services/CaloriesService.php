<?php
require_once(__DIR__ . "/AISummary.php");
class CaloriesService {
    public static function generateCaloriesFromText(string $foodLog): string {
        $prompts = require(__DIR__ . "/PromptService.php"); 
     
        $caloriesPrompt = $prompts['nutritionAdvice'] ;
        $fullPrompt = $caloriesPrompt . "\n\nUser Meals:\n" . $foodLog;

        $response = AISummary::sendAIRequest($fullPrompt);
        return AISummary::parseAIResponse($response) ?: "Failed to generate nutrition summary.";
    }
}
