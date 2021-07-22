<html>
    <head>
        <link rel="stylesheet" href="https://npm-scalableminds.s3.eu-central-1.amazonaws.com/@scalableminds/chatroom@master/dist/Chatroom.css" />        
    </head>
    <body style="width: 400px; position: fixed;">        
        <div class="chat-container"></div>

        <script src="https://npm-scalableminds.s3.eu-central-1.amazonaws.com/@scalableminds/chatroom@master/dist/Chatroom.js"></script>
        <script type="text/javascript">
        var chatroom = new window.Chatroom({
            host: "http://localhost:5005",
            title: "Chatbot",
            container: document.querySelector(".chat-container"),
            welcomeMessage: "Hey! how can I help you? I can answer queries about our business, payment options, delivery and orders.",
            speechRecognition: "en-US",
            voiceLang: "en-US"
        });
        chatroom.close();
        </script>
    </body>
</html>