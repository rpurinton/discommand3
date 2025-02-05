<?php

namespace RPurinton\Discommand;

require_once(__DIR__ . '/../vendor/autoload.php');

$loop = \React\EventLoop\Loop::get();

$bunny = new RabbitMQ($loop, 'test2', process(...));

function process($message)
{
	print_r($message);
	return true;
}
