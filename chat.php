<head>        
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>    
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="chatbot.js"></script>
    <link href="chatbot.css" rel="stylesheet">
</head>
		
<Style>
    .chatbot123 {
       position: fixed;
       right: 125px;
       bottom: 80px; 
       width: fit-content;
       height: fit-content;
       z-index: 100;
    }
      
    #chatbutton {
        position: fixed;
        right: 25px;
        bottom: 30px;
        border: 2px solid orange;
        border-radius: 100px;
        width: 110px;
        height: 44px;
        background-color: gainsboro;
        color: orange;
        z-index: 110;
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

   <button id="chatbutton" onclick="myFunction()">Chat Now</button>
   <!-- Chatbot UI -->
   <div id="chatbotdiv" class="chatbot123"> 
        <div style="height: 450px; width: 300px;" class="col-sm-3 col-sm-offset-4 frame">
            <ul></ul>
            <div>
                <div class="msj-rta macro">                        
                    <div class="text text-r" style="background:whitesmoke !important">
                        <input id="mytext" class="mytext" placeholder="Type in your query to begin chat"/>
                    </div> 
                </div>
                <div style="padding:10px;">
                    <button id="sendchat" type="button" class="btn-lg btn-warning"><span class="glyphicon glyphicon-share-alt"></span></button>
                </div>                
            </div>
        </div>     
    </div>
    
</body>
