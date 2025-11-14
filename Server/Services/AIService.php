<?php
$prompts = require_once('PromptService.php');

function callAI(string $promptKey, string $userText): ?array {
    global $prompts;
    
    $fullPrompt = $prompts[$promptKey] . "\n\nUser Input: " . $userText;

    $response = sendAIRequest($fullPrompt);
    return parseAIResponse($response);
}


function sendAIRequest(string $prompt): string {
    $apiKey = ""; 
    $data = [
        'model' => 'gpt-3.5-turbo',
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

    if (curl_errno($ch)) {
        throw new Exception('OpenAI Request Error: ' . curl_error($ch));
    }

    curl_close($ch);
    return $response;
}

function parseAIResponse(string $response): ?array {
    $responseData = json_decode($response, true);
    $content = $responseData['choices'][0]['message']['content'] ?? "{}";

    $parsed = json_decode($content, true);
    if (!is_array($parsed)) return null;

    return $parsed;
}
