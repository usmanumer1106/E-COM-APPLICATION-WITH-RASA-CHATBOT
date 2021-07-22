<html>
    <head>
        <link rel="stylesheet" href="https://npm-scalableminds.s3.eu-central-1.amazonaws.com/@scalableminds/chatroom@master/dist/Chatroom.css" />        
    </head>
    		
<Style>
    .chatbot123 {
       position: fixed;
       right: 5rem;
       bottom: 1rem; 
       width: 30vw;
       height: fit-content;
       z-index: 100;
       background-color:#c43b68;
    }
      
   
</Style>

<script>
    function myFunction() {
        var y = document.getElementById("chatbutton");
        var x = document.getElementById("chatbotdiv");
        if (x.style.display === "none") {
            x.style.display = "block";
            y.innerText = 'Close';
        } else {
            x.style.display = "none";
            y.innerText = 'Chat Now';
        }
    }
</script>

    <body>       
        <!-- <button id="chatbutton" onclick="myFunction()">Chat Now</button>  -->
        <div id="chatbotdiv" class="chat-container chatbot123"></div>
        <script src="https://npm-scalableminds.s3.eu-central-1.amazonaws.com/@scalableminds/chatroom@master/dist/Chatroom.js"></script>
        <script type="text/javascript">
        var chatroom = new window.Chatroom({
            host: "http://localhost:5005",
            title: "Chat Now",
            container: document.querySelector(".chat-container"),
            welcomeMessage: "Hey! how can I help you? I can answer queries about our business, payment options, delivery and orders.",
           // speechRecognition: "en-US",
         //   voiceLang: "en-US"
        });
        chatroom.close();
        </script>
    </body>
</html>