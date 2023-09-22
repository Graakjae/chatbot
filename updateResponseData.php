<?php
session_start();

// Read the JSON file into an associative array
$responsesJSON = file_get_contents('responses.json');
$responses = json_decode($responsesJSON, true);

// Default response when the bot doesn't understand the question
$defaultResponse = "I'm sorry, I don't understand your question.";

// Get the user's input
$userInput = isset($_POST['user_input']) ? $_POST['user_input'] : null;

// Initialize bot response as default
$botResponse = $defaultResponse;

// Update the session data (responseData)
if (!isset($_SESSION["responseData"])) {
    $_SESSION["responseData"] = [];
}

// Check if the user input contains a word that matches a predefined response
$matchFound = false; // Flag to track if a match is found

if ($userInput) {
    foreach ($responses['keywords'] as $category => $keywords) {
        foreach ($keywords as $keyword) {
            if (stripos($userInput, $keyword) !== false) {
                // Push the answer associated with the matched keyword to the response array
                $botResponse = $responses['answers'][$category];
                $_SESSION["responseData"][] = array(
                    'question' => $userInput,
                    'response' => $botResponse
                );
                // Exit the loop once a match is found
                $matchFound = true;
                break 2;
            }
        }
    }
}

// Set the default response if no match is found
if (!$matchFound) {
    $botResponse = $defaultResponse;
    $_SESSION["responseData"][] = array(
        'question' => $userInput,
        'response' => $botResponse
    );
}

// Return a response if needed (e.g., success message)
$response = [
    "message" => "Chat data updated successfully.",
    "responseData" => $_SESSION["responseData"]
];
header("Content-Type: application/json");
echo json_encode($response);
?>
