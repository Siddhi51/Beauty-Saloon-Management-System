<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: application/json");

// Read raw POST data
$raw_post_data = file_get_contents("php://input");

// Debugging log
file_put_contents("debug_log.txt", "Received Data: " . $raw_post_data . PHP_EOL, FILE_APPEND);

// Check if data is received
if (!$raw_post_data) {
    echo json_encode(["error" => "No data received"]);
    exit();
}

// Decode JSON input
$input = json_decode($raw_post_data, true);

// Validate JSON decoding
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(["error" => "Invalid JSON format"]);
    exit();
}

// Validate 'message' field
if (!isset($input["message"]) || empty($input["message"])) {
    echo json_encode(["error" => "No message received"]);
    exit();
}

// Get user message
$user_message = strtolower(trim($input["message"]));

// Define responses
$responses = [
    "hello" => "Hello! How can I help you?",
    "hy" => "Hello! How can I help you?",
    "hi" => "Hello! How can I help you?",
    "how are you" => "I'm just a bot, but I'm doing great! How about you?",
    "what is your name" => "I'm your friendly chatbot!",
    "bye" => "Goodbye! Have a great day!",
    "default" => "Sorry, I didn't understand that. Can you rephrase? other wise contact 
+7896541236",
    "service"=>" ok its avaliable on your home page ",
    "help"=>" yes i am always ready for thw your help tell me  ",
    "payment not complete"=>"it's ok just contact salon maneger and check your id !"
];

// Check if user message matches a predefined response
$bot_reply = $responses[$user_message] ?? $responses["default"];

// Send response
echo json_encode(["reply" => $bot_reply]);
?>
