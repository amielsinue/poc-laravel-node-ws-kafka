<?php

namespace App\Services;

use RdKafka\Conf;
use RdKafka\Producer;

class KafkaProducerService
{
    protected $producer;
    protected $topic;

    public function __construct()
    {
        $conf = new Conf();
        $conf->set('metadata.broker.list', 'kafka:9092');

        $this->producer = new Producer($conf);
        $this->topic = $this->producer->newTopic('jobs');
    }

    public function produce($message)
    {
        $this->topic->produce(RD_KAFKA_PARTITION_UA, 0, json_encode($message));
        $this->producer->poll(0);

        // Flush to ensure delivery
        $result = $this->producer->flush(1000);
        if ($result !== RD_KAFKA_RESP_ERR_NO_ERROR) {
            throw new \Exception('Kafka producer failed to flush messages');
        }
    }
}