<?php

namespace RPurinton\Discommand;

class RabbitMQ
{
        function __construct(private $loop, private $queue, private $callback)
        {
                $client = new \Bunny\Async\Client($loop, Config::get('rabbitmq'));
                $client->connect()->then($this->getChannel(...))->then($this->consume(...));
        }

        private function getChannel($client)
        {
                return $client->channel();
        }

        private function consume($channel)
        {
                $channel->qos(0, 1);
                $channel->consume($this->process(...), $this->queue);
        }

        private function process($message, $channel, $client)
        {
                if (($this->callback)(json_decode($message->content, true))) $channel->ack($message);
                else $channel->nack($message);
        }

        public static function publish($queue, $data)
        {
                $data = json_encode($data);
                $client = new \Bunny\Client(Config::get('rabbitmq'));
                $client->connect();
                $channel = $client->channel();
                $channel->queueDeclare($queue, false, true, false, false);
                $channel->publish($data, [], '', $queue);
                $channel->close();
                $client->disconnect();
        }
}
