<!DOCTYPE html>
<html>
<head><title>Kafka Sender</title></head>
<body>
    @if(session('status'))
        <p>{{ session('status') }}</p>
    @endif
    <form id="kafkaForm">
        <input type="text" id="messageInput" name="message" placeholder="Escribe tu mensaje">
        <button type="submit">Enviar a Kafka</button>
    </form>
    <script>
        const form = document.getElementById("kafkaForm");
        const input = document.getElementById("messageInput");
        const csrfToken = "{{ csrf_token() }}"; // Laravel 5.4, manual

        form.addEventListener("submit", async (e) => {
            e.preventDefault();

            const message = input.value;

            if (!message.trim()) return;

            await fetch("/send", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken
                },
                body: JSON.stringify({ message })
            });

            input.value = "";
        });
    </script>
    <hr>
    <h3>📡 Mensajes recibidos:</h3>
    <ul id="messages"></ul>

    <script>
        const ws = new WebSocket("ws://localhost:3001");
        const list = document.getElementById("messages");

        ws.onmessage = function(event) {
            const li = document.createElement("li");
            li.textContent = event.data;
            list.appendChild(li);
        };
    </script>
</body>
</html>