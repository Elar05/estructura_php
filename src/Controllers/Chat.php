<?php

namespace Elar\Mvc\Controllers;

use Elar\Mvc\Libs\Session;
use Elar\Mvc\Models\ChatModel;
use Elar\Mvc\Models\UserModel;

class Chat extends Session
{
  public function __construct($url)
  {
    parent::__construct($url);
  }

  public function render()
  {
    $idSession = $this->userId;
    $users = UserModel::getAll();

    $usersWithoutMe = array_filter($users, function ($user) use ($idSession) {
      return $user['id'] !== $idSession;
    });

    $this->view->render('chat/index', ["users" => $usersWithoutMe]);
  }

  public function getHistory()
  {
    if (!$this->existsPOST(['userResponder'])) {
      $this->response(['error' => 'Faltan parametros']);
    }

    $chats = new ChatModel();
    $chats->userSenderId = $this->userId;
    $chats->userResponderId = $_POST['userResponder'];

    $this->response(['chats' => $chats->getHistory()]);
  }
}
