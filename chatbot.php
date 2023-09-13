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

// Check if the user input contains a word that matches a predefined response
$matchFound = false; // Flag to track if a match is found

if (!empty($userInput)) {
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

// Create a new session variable for storing deleted chats
if (!isset($_SESSION["deletedChats"])) {
    $_SESSION["deletedChats"] = [];
}

// Check if the user wants to destroy the session
if (isset($_POST['destroy-session-button'])) {
    // Move the current chat session to the deletedChats array
    $_SESSION["deletedChats"][] = $_SESSION["responseData"];
    // Clear the responseData array
    $_SESSION["responseData"] = array();

    // Destroy the session
    //session_destroy();
    
    // Redirect the user back to index.php
    header('Location: index.php');
    exit;
}

// Replace responseData with deletedChats
if (isset($_POST['restore-session-button'])) {
    // Move the current chat session to the deletedChats array
    ($_SESSION["responseData"] = $_SESSION["deletedChats"][0]);
    // Redirect the user back to index.php
    header('Location: index.php');
    exit;
}


// Redirect the user back to index.php
header('Location: index.php');
exit;

// //Destroy the session when the user clicks the button
// if (isset($_POST['destroy-session-button'])) {
//     session_destroy();
//     header('Location: index.php'); // Redirect the user back to index.php
//     exit;
// }

?>

