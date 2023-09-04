<?php
session_start();

// Define predefined responses and questions as an associative array
$responses = array(
    "1" => "This is response 1.",
    "2" => "This is response 2."
);

// Default response when the bot doesn't understand the question
$defaultResponse = "I'm sorry, I don't understand your question.";


// Loop through the responses and add them to the responseData array
foreach ($responses as $key => $response) {
    $responseData[] = array(
        'question' => "Question $key", // You can replace this with actual questions
        'response' => $response
    );
}

// Get the user's input (you can replace this with actual user input)
$userInput = isset($_POST['user_input']) ? $_POST['user_input'] : '';

// Check if the user input matches a predefined response
if (isset($responses[$userInput])) {
    $botResponse = $responses[$userInput];
} else {
    $botResponse = $defaultResponse;
}

// Combine the bot's response with the responseData array
$_SESSION["responseData"][] = array(
    'question' => $userInput ? $userInput : "",
    'response' => $botResponse
);

// Redirect the user back to index.php
header('Location: index.php');

?>
