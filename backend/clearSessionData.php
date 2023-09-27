<?php
session_start();

// Clear the session data (responseData)
if (isset($_SESSION["responseData"])) {
    $_SESSION["responseData"] = [];
}

// Respond with a success message
$response = [
    "message" => "Session data cleared successfully"
];

header("Content-Type: application/json");
echo json_encode($response);
?>
