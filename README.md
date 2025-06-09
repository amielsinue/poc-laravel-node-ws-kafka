# Kafka + Laravel + Node.js + Websockets Demo

This project demonstrates a basic event-driven architecture using **Laravel** (PHP) to send messages to **Kafka**, and a **Node.js** consumer that receives those messages and broadcasts them over **WebSockets** to the browser in real-time.

---

## ✅ Requirements

Make sure you have the following installed:

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)
- [GNU Make](https://www.gnu.org/software/make/)

---

## 🚀 Getting Started

Clone the repository and run the following command:

```bash
make up
```

Then, open:

- **Laravel Web UI:** [http://localhost:8000](http://localhost:8000)
- **Kafka UI:** [http://localhost:8080](http://localhost:8080)

---

## 🛠️ Available Commands

To list all available commands:

```bash
make help
```

### 🔧 Environment Management

| Command              | Description                                 |
|----------------------|---------------------------------------------|
| `make up`            | Start containers in background              |
| `make down`          | Stop and remove all containers              |
| `make restart`       | Restart all services                        |
| `make rebuild`       | Rebuild containers from scratch             |
| `make ps`            | Show container status                       |

### 📄 Logs

| Command              | Description                                 |
|----------------------|---------------------------------------------|
| `make logs`          | Show all logs                               |
| `make logs-laravel`  | Show logs for the Laravel app               |
| `make logs-node`     | Show logs for the Node.js consumer          |

### 💻 Shell Access

| Command              | Description                                 |
|----------------------|---------------------------------------------|
| `make ssh-laravel`   | Open shell inside Laravel container         |
| `make ssh-node`      | Open shell inside Node.js consumer container|

---

## 🧪 Sending Test Messages

To send a test message to Kafka from Laravel:

```bash
make seed-message
```

You can also use the simple UI at [http://localhost:8000](http://localhost:8000) to send messages and see them broadcast in real-time.

---

## 📂 Project Structure

```
.
├── docker-compose.yml
├── Makefile
├── laravel/             # Laravel project (producer)
└── node-consumer/       # Node.js project (consumer + WebSocket server)
```

---

## 🧼 Cleanup

To stop and reset everything:

```bash
make rebuild
```

---

## 🧠 Credits

Built by Amiel Yañez.  
Simple proof of concept to demonstrate real-time message broadcasting with Kafka, Laravel, and Node.js.