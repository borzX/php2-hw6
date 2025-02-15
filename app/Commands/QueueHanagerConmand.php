<?php

namespace App\Commands;

use App\Application; 
use App\Queue\Queueable; 
use App\Queue\RabbitHQ;

class QueueHanagerConmand extends Command
{
    protected Application $app;
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function run(): void
    {
        while (true) {
            $queue = new RabbitHQ('eventSender');
            $message = $queue->getMessage();
            if ($message) {
                /** @var Queueable $class */
                $class = unserialize($message); $class->handle();
                $queue->ackLastHessage();
            }
            sleep( seconds: 10);
        }
    }
}
