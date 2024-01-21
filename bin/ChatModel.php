<?php

use Elar\Mvc\Libs\Model;

require_once dirname(__DIR__) . '/src/config/config.php';
require_once dirname(__DIR__) . '/src/Libs/Model.php';
require_once dirname(__DIR__) . '/src/Libs/Database.php';

class ChatModel extends Model
{
  public $userSenderId;
  public $userResponderId;
  public $message;

  public function __construct()
  {
    parent::__construct();
  }

  public function save()
  {
    try {
      $query = $this->prepare("INSERT INTO chats (user_sender_id, user_responder_id, message) VALUES (:user_sender_id, :user_responder_id, :message)");

      $query->bindValue(':user_sender_id', $this->userSenderId, PDO::PARAM_INT);
      $query->bindValue(':user_responder_id', $this->userResponderId, PDO::PARAM_INT);
      $query->bindValue(':message', $this->message, PDO::PARAM_STR);

      return $query->execute();
    } catch (PDOException $e) {
      error_log('ChatModel::save() -> ' . $e->getMessage());
      return false;
    }
  }
}
