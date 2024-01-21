<?php

use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

require_once dirname(__DIR__) . '/Bin/ChatModel.php';

class Chat implements MessageComponentInterface
{
  protected $clients;

  public function __construct()
  {
    $this->clients = new SplObjectStorage();
    echo "Server connected \n";
  }

  public function onOpen(ConnectionInterface $conn)
  {
    $this->clients->attach($conn);
    echo "New Conection: {$conn->resourceId} \n";
  }

  public function onMessage(ConnectionInterface $conn, $message)
  {
    $numReceived = count($this->clients) - 1;
    echo sprintf(
      "Conection %d sending message: %s to %d other connections \n",
      $conn->resourceId,
      $message,
      $numReceived,
    );

    $data = json_decode($message, true);

    $chat = new ChatModel();
    $chat->userSenderId = $data['userSender'];
    $chat->message = $data['message'];
    $chat->userResponderId = $data['userResponder'];

    if ($chat->save()) {
      $this->response($data);
    }
  }

  public function onClose(ConnectionInterface $conn)
  {
    $this->clients->detach($conn);
    echo "Connection {$conn->resourceId} has disconnected \n";
  }

  public function onError(ConnectionInterface $conn, Exception $e)
  {
    echo "An error has occurred: {$e->getMessage()} \n";
    $conn->close();
  }

  public function response($data)
  {
    foreach ($this->clients as $client) {
      $client->send(json_encode($data));
    }
  }
}
