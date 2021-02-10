
function message(text){
    jQuery('#chat-result').append(text);
}

jQuery(document).ready(function ($){

    var socket = new WebSocket("ws://yiiproject.com:80/yiiproject/basic/components/chatserver.php");

    socket.onopen = function (){
        message("Is Connected");
    }

    socket.onerror = function (error){
        message("<div>Connection error" + (error.message ? error.message : '') + "<div>");
    }

    socket.onclose = function (){
        message('<div>Connection is closed<div>');
    }

    socket.onmessage = function (event){
        var data = JSON.parse(event.data);
        message('<div>' + data.type + '-' + data.message +'</div>')
    }
})