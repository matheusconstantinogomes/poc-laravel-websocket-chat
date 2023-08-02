<!-- resources/views/welcome.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Chat em tempo real</title>
</head>
<body>
    <h1>Chat em tempo real</h1>
    <div id="chat-box"></div>
    <input type="text" id="message" placeholder="Digite sua mensagem...">
    <button onclick="sendMessage()" id="send-button">Enviar</button>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        const socket = new WebSocket('ws://localhost:8080');
        let websocketReady = false;

        function displayMessage(message) {
            const chatBox = document.getElementById('chat-box');
            chatBox.innerHTML += '<p>' + message + '</p>';
        }

        socket.onopen = function () {
            websocketReady = true;
        };

        socket.onclose = function () {
            websocketReady = false;
        };

        socket.onmessage = function (event) {
            displayMessage('Recebida: ' + event.data);
        };

        function sendMessage() {
            if (!websocketReady) {
                console.error('WebSocket não está pronto para enviar mensagens.');
                return;
            }

            const message = document.getElementById('message').value;
            socket.send(message);
            displayMessage('Enviada: ' + message);

            axios.post('/send-message', { message: message })
                .then(response => {
                    console.log('Mensagem salva no banco de dados.');
                })
                .catch(error => {
                    console.error('Erro ao salvar a mensagem no banco de dados: ', error);
                });

            document.getElementById('message').value = '';
        }

        axios.get('/get-messages')
            .then(response => {
                const messages = response.data.messages;
                messages.forEach(message => {
                    displayMessage('Banco de dados: ' + message.content);
                });
            })
            .catch(error => {
                console.error('Erro ao recuperar mensagens do banco de dados: ', error);
            });
    </script>
</body>
</html>
