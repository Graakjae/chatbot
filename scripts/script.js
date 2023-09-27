function characterCounter() {
    var text = document.getElementById("user_input").value;
    var charCount = text.length;
    document.getElementById("charCount").innerHTML = charCount;

    if (text.length <= 0) {
        document.getElementById("sendButton").disabled = true;
        document.getElementById("sendImg").src = "img/sendDefault.png";
    } else {
        document.getElementById("sendButton").disabled = false;
        document.getElementById("sendImg").src = "img/send.png";
    }
}

function retrieveSessionData() {
    // Send a Fetch GET request to the server endpoint
    fetch("../backend/getResponseData.php")
        .then(function (response) {
            return response.json(); // Parse the JSON response
        })
        .then(function (data) {
            // Handle the session data received from the server
            updateChatInterface(data); // Call a function to update the chat interface
        })
        .catch(function (error) {
            console.error("Error fetching session data:", error);
        });
}

// Call the retrieveSessionData function to fetch session data initially
retrieveSessionData();

function sendUserInput() {
    var userInput = document.getElementById("user_input").value;

    // Prepare the data to be sent in the POST request
    var formData = new FormData();
    formData.append("user_input", userInput);

    // Send a Fetch POST request to update_response_data.php
    fetch("../backend/updateResponseData.php", {
        method: "POST",
        body: formData
    })
        .then(function (response) {
            return response.json(); // Parse the JSON response (if needed)
        })
        .then(function (data) {
            // Check if responseData exists and has elements
            if (data.responseData && data.responseData.length > 0) {
                // Append the new chat message to the chat container
                appendChatMessage(userInput, data.responseData[data.responseData.length - 1].response);
            }
        })
        .catch(function (error) {
            console.error("Error updating chat data:", error);
        });
}

// Add an event listener to the form submission
document.getElementById("chatForm").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent the default form submission behavior
    sendUserInput(); // Call the sendUserInput function
    document.getElementById("user_input").value = "";
    text = "";
    text.length = 0;
    characterCounter();
    if (text.length <= 0) {
        document.getElementById("sendButton").disabled = true;
        document.getElementById("sendImg").src = "img/sendDefault.png";
    } else {
        document.getElementById("sendButton").disabled = false;
        document.getElementById("sendImg").src = "img/send.png";
    }
});

function updateChatInterface(sessionData) {
    // Reference to the chat container element
    var chatContainer = document.querySelector(".robotTextWrapper");

    // Clear the existing chat messages
    chatContainer.innerHTML = "";

    // Iterate through the sessionData array and create and append chat messages
    sessionData.forEach(function (chatEntry) {
        var flexEndDiv = document.createElement("div");
        flexEndDiv.className = "flexEnd";

        var userTextDiv = document.createElement("div");
        userTextDiv.className = "userText";

        var responsePara = document.createElement("p");
        responsePara.className = "response";
        responsePara.textContent = chatEntry.response;

        var flexStartDiv = document.createElement("div");
        flexStartDiv.className = "flexStart";

        var robotTextDiv = document.createElement("div");
        robotTextDiv.className = "robotText";

        var questionPara = document.createElement("p");
        questionPara.className = "question";
        questionPara.textContent = chatEntry.question;

        chatContainer.appendChild(flexEndDiv);
        chatContainer.appendChild(flexStartDiv);

        flexEndDiv.appendChild(userTextDiv);
        flexStartDiv.appendChild(robotTextDiv);

        robotTextDiv.appendChild(responsePara);
        userTextDiv.appendChild(questionPara);
    });
}

function appendChatMessage(sender, message) {
    var chatContainer = document.querySelector(".robotTextWrapper");

    var flexEndDiv = document.createElement("div");
    flexEndDiv.className = "flexEnd";

    var userTextDiv = document.createElement("div");
    userTextDiv.className = "userText";

    var questionPara = document.createElement("p");
    questionPara.className = "sender";
    questionPara.textContent = sender;

    var flexStartDiv = document.createElement("div");
    flexStartDiv.className = "flexStart";

    var robotTextDiv = document.createElement("div");
    robotTextDiv.className = "robotText";

    var responsePara = document.createElement("p");
    responsePara.className = "messageText";
    responsePara.textContent = message;

    chatContainer.appendChild(flexEndDiv);
    chatContainer.appendChild(flexStartDiv);

    flexEndDiv.appendChild(userTextDiv);
    flexStartDiv.appendChild(robotTextDiv);

    robotTextDiv.appendChild(responsePara);
    userTextDiv.appendChild(questionPara);
}
