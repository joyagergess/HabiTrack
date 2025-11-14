<?php
return [
      "parseEntry" => "
You are a health parser. Extract the following from user text:

- steps (number)
- caffeine (mg)
- sleep_time (HH:MM)
- sleep_hours (decimal)

Return ONLY valid JSON in this format:

{
  \"steps\": number,
  \"caffeine\": number,
  \"sleep_time\": \"HH:MM\",
  \"sleep_hours\": number
}
",

 'weeklySummary' => "",
 'nutritionAdvice' => ""
];
