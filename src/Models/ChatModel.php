<?php

namespace Elar\Mvc\Models;

use PDO;
use Elar\Mvc\Libs\Model;
use PDOException;

class ChatModel extends Model
{
  public $userSenderId;
  public $userResponderId;
  public $message;

  public function __construct()
  {
    parent::__construct();
  }

  public function getHistory()
  {
    try {
      $query = $this->prepare(
        "SELECT * FROM chats
        WHERE (user_sender_id = ? AND user_responder_id = ?) 
        OR (user_sender_id = ? AND user_responder_id = ?);"
      );
      $query->execute([
        $this->userSenderId, $this->userResponderId,
        $this->userResponderId, $this->userSenderId
      ]);
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log('ChatModel::getHistory() -> ' . $e->getMessage());
      return false;
    }
  }
}
