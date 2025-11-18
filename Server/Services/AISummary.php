<?php
$prompts = require_once(__DIR__ . "/PromptService.php");

class AISummary {

    public static function generateWeeklySummary(string $userText): string {
      
        $prompts = require(__DIR__ . "/PromptService.php"); 
       

        $weeklyPrompt = $prompts['weeklySummary'] ;

        $fullPrompt = $weeklyPrompt . "\n\nUser Input: " . $userText;

        $response = self::sendAIRequest($fullPrompt)
;

        $summary = self::parseAIResponse($response);

        return $summary ?: "No summaries for today. ";
    }

    public static function sendAIRequest(string $prompt): string {
        $apiKey ="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"; 

        $data = [
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'user', 'content' => $prompt]
            ],
            'temperature' => 0
        ];

        $ch = curl_init('https://api.openai.com/v1/chat/completions');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: ' . 'Bearer ' . $apiKey
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public static function parseAIResponse(string $response): ?string {
        $responseData = json_decode($response, true);
        return $responseData['choices'][0]['message']['content'] ?? null;
    }
}
