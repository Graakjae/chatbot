// Add an event listener to the clear session button
document.getElementById("clearSessionButton").addEventListener("click", function () {
    clearSessionData();
});

function clearSessionData() {
    // Send a Fetch POST request to a PHP script to clear the session data
    fetch("../backend/clearSessionData.php", {
        method: "POST"
    })
        .then(function (response) {
            return response.json(); // Parse the JSON response
        })
        .then(function () {
            // Clear the chat container on the client side
            clearChatContainer();
        })
        .catch(function (error) {
            console.error("Error clearing session data:", error);
        });
}

function clearChatContainer() {
    var chatContainer = document.querySelector(".robotTextWrapper");
    chatContainer.innerHTML = ""; // Clear all chat messages from the container
}
