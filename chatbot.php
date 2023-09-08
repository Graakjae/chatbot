<?php

session_start();

// Define predefined responses and questions as an associative array
$responses = array(
    "Hello" => "Hello! 👋",
    "Hi" => "Hello! 👋",
    "Hej" => "Hello! 👋",
    "2" => "This is response 2."
);

// Default response when the bot doesn't understand the question
$defaultResponse = "I'm sorry, I don't understand your question.";

// Get the user's input
$userInput = isset($_POST['user_input']) ? $_POST['user_input'] : null;

// Check if the user input matches a predefined response
if (isset($responses[$userInput])) {
    $botResponse = $responses[$userInput];
} else{
    $botResponse = $defaultResponse;
}

// Combine the bot's response with the responseData array
$_SESSION["responseData"][] = array(
    'question' => $userInput ? $userInput : "",
    'response' => $botResponse
);

// Redirect the user back to index.php
header('Location: index.php');
exit;

//Destroy the session when the user clicks the button
if (isset($_POST['destroy-session-button'])) {
    session_destroy();
    header('Location: index.php'); // Redirect the user back to index.php
    exit;
}

?>

