//links
//http://eloquentjavascript.net/09_regexp.html
//https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Regular_Expressions


var messages = [], //array that hold the record of each string in chat
    lastUserMessage = "", //keeps track of the most recent input string from the user
    botMessage = "", //var keeps track of what the chatbot is going to say
    botMessageOut = "", //var keeps track of what the chatbot is going to say
    botName = 'Chatbot', //name of the chatbot
    talking = true; //when false the speach function doesn't work


//edit this function to change what the chatbot says
function chatbotResponse() {

    console.log("chatbotResponse ::::: " + lastUserMessage);

    lastUserMessage = lastUserMessage.trim();

    talking = true;
    botMessageOut = "No entendi, por favor repetir.";
    botMessage = "No entendi, por favor repetir."; //the default message

    if (lastUserMessage === 'hi' || lastUserMessage =='hola') {
        const hi = ['Hola amigo!','Que hay de nuevo!','Hola, estoy para ayudarte!']
        botMessage = hi[Math.floor(Math.random()*(hi.length))];
        botMessageOut = botMessage;
    }

    if (lastUserMessage === 'nombre') {
        botMessage = 'Mi nombre es ' + botName;
        botMessageOut = botMessage;
    }

    if (lastUserMessage.toString().trim().toLowerCase().indexOf("estadistica") >= 0) {
        botMessage = 'Te presento la información sobre: estadistica';
        botMessageOut = 'Información del curso de estadística <br><a href="https://www.youtube.com/watch?v=fOuRqk1nzgY"><img id="img" width="168" src="https://i.ytimg.com/vi/fOuRqk1nzgY/hqdefault.jpg?sqp=-oaymwEZCNACELwBSFXyq4qpAwsIARUAAIhCGAFwAQ==&amp;rs=AOn4CLC1DWfOFd-MTI3Ay45KcVMNTDxk1w"></a>';
    }

    if (lastUserMessage.toString().trim().toLowerCase().indexOf("economia") >= 0) {
        botMessage = 'Te presento la información sobre: economía';
        botMessageOut = 'Información del curso de economía <br><a href="https://www.youtube.com/watch?v=Memoa2BL39w"><img id="img" width="168" src="https://i.ytimg.com/vi/Memoa2BL39w/hqdefault.jpg?sqp=-oaymwEZCNACELwBSFXyq4qpAwsIARUAAIhCGAFwAQ==&rs=AOn4CLAdKjFPpNKBVJnLSNjSHJXJaHnEFQ"></a>';
    }

    //clone user message
    var cloneUser = $("#clone-user").clone();
    cloneUser.find(".direct-chat-text").html(lastUserMessage);
    cloneUser.appendTo(".direct-chat-messages").css("display", "block");

    //clone chatbot message
    var cloneChatBot = $("#clone-chat-bot").clone();
    cloneChatBot.find(".direct-chat-text").html(botMessageOut);
    cloneChatBot.appendTo(".direct-chat-messages").css("display", "block");

}

//this runs each time enter is pressed.
//It controls the overall input and output
function newEntry() {

    var messageBox = $("#chatbox").val();

    if (messageBox == "") {
        return false;
    }

    //if the message from the user isn't empty then run
    if (document.getElementById("chatbox").value != "") {

        //pulls the value from the chatbox ands sets it to lastUserMessage
        lastUserMessage = document.getElementById("chatbox").value;

        //sets the chat box to be clear
        document.getElementById("chatbox").value = "";

        //adds the value of the chatbox to the array messages
        messages.push(lastUserMessage);

        //Speech(lastUserMessage);  //says what the user typed outloud
        //sets the variable botMessage in response to lastUserMessage
        chatbotResponse();

        //add the chatbot's name and message to the array messages
        messages.push("<b>" + botName + ":</b> " + botMessage);
        // says the message using the text to speech function written below
        Speech(botMessage);

        //outputs the last few array elements of messages to html
        // for (var i = 1; i < 8; i++) {
        //     if (messages[messages.length - i])
        //         document.getElementById("chatlog" + i).innerHTML = messages[messages.length - i];
        // }
    }
}

//text to Speech
//https://developers.google.com/web/updates/2014/01/Web-apps-that-talk-Introduction-to-the-Speech-Synthesis-API
function Speech(say) {
    if ('speechSynthesis' in window && talking) {
        var utterance = new SpeechSynthesisUtterance(say);
        //msg.voice = voices[10]; // Note: some voices don't support altering params
        //msg.voiceURI = 'native';
        //utterance.volume = 1; // 0 to 1
        //utterance.rate = 0.1; // 0.1 to 10
        //utterance.pitch = 1; //0 to 2
        //utterance.text = 'Hello World';
        // utterance.lang = 'en-US';
        utterance.lang = 'es-PE';
        speechSynthesis.speak(utterance);
    }
}

//runs the keypress() function when a key is pressed
document.onkeypress = keyPress;
//if the key pressed is 'enter' runs the function newEntry()
function keyPress(e) {
    var x = e || window.event;
    var key = (x.keyCode || x.which);
    if (key == 13 || key == 3) {
        //runs this function when enter is pressed
        newEntry();
    }
    if (key == 38) {
        console.log('hi')
        //document.getElementById("chatbox").value = lastUserMessage;
    }
}

//clears the placeholder text ion the chatbox
//this function is set to run when the users brings focus to the chatbox, by clicking on it
function placeHolder() {
    document.getElementById("chatbox").placeholder = "";
}