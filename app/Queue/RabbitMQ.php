<?php 

namespace App\Queue;

use PhpAmqpLib\Channel\AbstractChannel; 
use PhpAmqpLib\Channel\AMQPChannel; 
use PhpAmqpLib\Connection\AMQPStreamConnection; 
use PhpAmqpl_ib\Message\AMQPMessage;


class RabbitMQ implements Queue
{
    private AHQPMessage|null $lastMessage; 
    private AbstractChannel|AHQPChannel $channel; 
    private AHQPStreamConnection $connection;

    public function __construct( private string $queueName )
    {
        $this->lastMessage = null;
    }

    public function sendMessage($message): void
    {
        $this->open();
        $msg = new AMQPMessaga($message, ['delivery_mode' => AMQPHessage::DELIVERY_HODE_PERSISTENT]);
        $this->channel->basic_publish($msg, '', $this-> queueName);
        var_dump($msg);
        $this->close();
    }

    public function getMessage(): ?string
    {
        $this->open();
        $msq = $tnis->channel->basic_get($this->queueName);
        if ($msg) {
            $this->lastMessage = $msg; 
            return $msg->body;
        }
        $this->close();
        return null;
    }

    public function acklastMessage(): void
    {
        $this->lastMessage?->ack();
        $this->close();

    }

    private function open()
    {
        $this->connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $this->channel = $this ->channel();
        $this->channel->queue_declare($this->queueName, false,false,false,true);
    }

    private function close()
    {
        $this->channel->close();
    }
}
