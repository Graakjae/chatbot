<?php
session_start();

if (isset($_SESSION["responseData"])) {
    // Assume responseData is an array
    $responseData = $_SESSION["responseData"];
    header("Content-Type: application/json");
    echo json_encode($responseData);
} else {
    // Return an empty JSON object if responseData is not set
    echo json_encode([]);
}
?>
