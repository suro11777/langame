<?php

namespace App\Services;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQService
{
    protected AMQPStreamConnection $connection;

    public AMQPChannel $channel;

    public string $rabbitHost;

    public string $rabbitPort;

    public string $rabbitUser;

    public string $rabbitPassword;

    public string $rabbitQueue;

    public function __construct()
    {
        $this->init();
    }

    public function rabbitConnect(): void
    {
        $this->connection = new AMQPStreamConnection($this->rabbitHost, $this->rabbitPort, $this->rabbitUser, $this->rabbitPassword);
        $this->channel = $this->connection->channel();
    }

    public function init(): void
    {
        $this->rabbitHost = config('rabbit.rabbit_host');
        $this->rabbitPort = config('rabbit.rabbit_port');
        $this->rabbitUser = config('rabbit.rabbit_user');
        $this->rabbitPassword = config('rabbit.rabbit_password');
        $this->rabbitQueue = config('rabbit.rabbit_queue');
    }

    public function setDeclare(): void
    {
        $this->channel->queue_declare($this->rabbitQueue, false, true, false, false, false, []);
    }

    public function sendConfirmationCode(string $confirmationCode): void
    {
        $this->setDeclare();
        $message = new AMQPMessage($confirmationCode);
        $this->channel->basic_publish($message, '', 'telegram_queue');
    }

    public function consume(callable $callback): void
    {
        $this->channel->basic_consume($this->rabbitQueue, '', false, false, false, false, $callback);
    }

    public function closeConnection(): void
    {
        $this->channel->close();
        $this->connection->close();
    }
}
