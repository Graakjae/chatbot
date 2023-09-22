<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title>Chatbot</title>
    </head>
    
    <body>
    <form id="chatForm">
        <div class="chatBotWrapper">
            <div class="chatbot">
                <div class="header">
                    <h1>Chatbot</h1>
                    <button id="clearSessionButton" type="button">Clear session</button>
                    <img src="chatbot.png" alt="chatbot" class="chatbotImage" />
                </div>
                    <div class="defaultRobotTextWrapper">
                        <div class="imageCircle">
                            <img src="chatbot.png" alt="chatbotBubble" class="chatbotBubbleImage" />
                        </div>
                        <div for="user_input" class="defaultRobotText">
                            <p>Hello! 👋 What can i help you with today?</p>
                        </div>
                    </div>
                <div class="robotTextWrapper" id="bot_response">
                </div>
                    <div class="inputWrapper">
                        <div class="inputfield">
                            <input 
                            type="text" 
                            class="input" 
                            name="user_input" 
                            id="user_input" 
                            placeholder="Enter a message" 
                            oninput="characterCounter()" 
                            maxlength="500" />
                            <p>
                                <span id="charCount" value="characterCounter()">0</span>/500</p>
                                <button 
                                class="sendButton" 
                                type="submit" 
                                value="Submit" 
                                id="sendButton" 
                                disabled
                                >
                                <img src="sendDefault.png" alt="send" class="sendImage" id="sendImg" />
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </body>
    <script src="script.js"></script> 
    <script src="clearSession.js"></script> 

    <script></script>
 <script>
        function characterCounter(){
            var text = document.getElementById("user_input").value;
            var charCount = text.length;
            document.getElementById("charCount").innerHTML = charCount;
            
             if(text.length <= 0){
                document.getElementById("sendButton").disabled = true;
                document.getElementById("sendImg").src="sendDefault.png";
            } else{
                document.getElementById("sendButton").disabled = false;
                document.getElementById("sendImg").src="send.png";
            }
        }

        function scrollToBottom(){
            var element = document.getElementById("bot_response");
            element.scrollTop = element.scrollHeight;
        }
    </script>
</body>

</html>