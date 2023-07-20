<!DOCTYPE html>
<html>
<head>
    <title>Chat em tempo real</title>
</head>
<body>
    <h1>Chat em tempo real</h1>
    <div id="chat-box"></div>
    <input type="text" id="message" placeholder="Digite sua mensagem...">
    <button onclick="sendMessage()">Enviar</button>

    <script>
        const socket = new WebSocket('ws://localhost:8080');

        function displayMessage(message) {
            const chatBox = document.getElementById('chat-box');
            chatBox.innerHTML += '<p>' + message + '</p>';
        }

        socket.onmessage = function (event) {
            displayMessage('Recebida: ' + event.data);
        };

        function sendMessage() {
            const message = document.getElementById('message').value;
            socket.send(message);
            displayMessage('Enviada: ' + message);
            document.getElementById('message').value = '';
        }
    </script>
</body>
</html>
