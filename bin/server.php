<?php

use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/Bin/Chat.php';

$server = IoServer::factory(
  new HttpServer(
    new WsServer(
      new Chat()
    )
  ),
  8080
);

$server->run();
