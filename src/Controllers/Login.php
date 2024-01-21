<?php

namespace Elar\Mvc\Controllers;

use Elar\Mvc\Libs\Session;
use Elar\Mvc\Models\LoginModel;

class Login extends Session
{
  public function __construct($url)
  {
    parent::__construct($url);
  }

  public function render()
  {
    $this->view->render('login/index');
  }

  public function auth()
  {
    if (!$this->existsPOST(['email', 'password'])) {
      $this->redirect('login', [
        "message" => 'The parameters must not be empty',
        "class" => 'warning'
      ]);
    }

    $login = new LoginModel();
    $user = $login->login($_POST['email'], $_POST['password']);
    if ($user !== null) {
      $this->initialize($user);
    } else {
      $this->redirect('', [
        "message" => 'Email or password is incorrect',
        'class' => 'danger'
      ]);
    }
  }
}
