<?php session_start(); ?>
<?php include("test.php") 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Chatbot</title>
</head>

<body>
    <div class="testDiv2">
        <div class="testDiv">
            <?php 
                echo $variable;
                echo "<br>";
                echo $variable2;
            ?>
        </div>
    </div>
    <form method="post" action="chatbot.php">
        <div class="chatBotWrapper">
            <div class="chatbot">
                <div class="header">
                    <h1>Chatbot</h1>
                    <img src="chatbot.png" alt="chatbot" class="chatbotImage" />
                </div>
                    <div class="defaultRobotTextWrapper">
                        <div class="imageCircle">
                            <img src="chatbot.png" alt="chatbotBubble" class="chatbotBubbleImage" />
                        </div>
                        <div for="user_input" class="robotText">
                            <p>Hello! 👋 What can i help you with today?</p>
                        </div>
                    </div>
                 <?php if(isset ($_SESSION["responseData"])){
                        foreach ($_SESSION["responseData"] as $data) {
                        echo 
                        "<div class=robotTextWrapper>
                            <div class=flexEnd>
                                <div class=userText>
                                    <p>{$data['question']}</p>
                                </div> 
                            </div>
                            <div class=flexStart>
                                <div class=imageCircle>
                                    <img src=chatbot.png alt=chatbotBubble class=chatbotBubbleImage />
                                </div>  
                                <div class=robotText>
                                    <p>{$data['response']}</p>
                                </div>
                            </div>
                        </div>";
                        }}?>
                        
                <div id="bot_response"></div>
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
                                disabled>
                                <img src="send.png" alt="send" class="sendImage" />
                            </button>
                        </div>
                  </div>
            </div>
        </div>
         <button type="submit" name="destroy-session-button">Destroy Session</button>
    </form>
   <script>
        // While loop to simulate a delay
        // let startTime = new Date().getTime();
        // while (new Date().getTime() < startTime + 3000);

        function characterCounter(){
            var text = document.getElementById("user_input").value;
            var charCount = text.length;
            document.getElementById("charCount").innerHTML = charCount;
            
             if(text.length <= 0){
                document.getElementById("sendButton").disabled = true;
                document.getElementById("sendButton").style.border = "1px solid gray";
            } else{
                document.getElementById("sendButton").disabled = false;
                document.getElementById("sendButton").style.border = "1px solid red";
            }
        }

        function scrollToBottom(){
            var element = document.getElementById("bot_response");
            element.scrollTop = element.scrollHeight;
        }

    </script>
</body>

</html>