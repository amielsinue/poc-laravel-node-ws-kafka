const { Kafka } = require('kafkajs');
const WebSocket = require('ws');

const kafka = new Kafka({
  clientId: 'node-consumer',
  brokers: ['kafka:9092']
});

const consumer = kafka.consumer({ groupId: 'laravel-group' });

// WebSocket server
const wss = new WebSocket.Server({ port: 3001 });

let clients = [];

wss.on('connection', (ws) => {
  console.log('🟢 Cliente WebSocket conectado');
  clients.push(ws);

  ws.on('close', () => {
    clients = clients.filter(client => client !== ws);
    console.log('🔴 Cliente WebSocket desconectado');
  });
});

const broadcast = (message) => {
  clients.forEach(ws => {
    if (ws.readyState === WebSocket.OPEN) {
      ws.send(message);
    }
  });
};

const run = async () => {
  await consumer.connect();
  await consumer.subscribe({ topic: 'jobs', fromBeginning: false });

  await consumer.run({
    eachMessage: async ({ topic, partition, message }) => {
      const msg = message.value.toString();
      console.log(`📨 Mensaje recibido: ${msg}`);
      broadcast(msg);
    },
  });
};

run().catch(console.error);