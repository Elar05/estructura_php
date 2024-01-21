<?php

namespace Elar\Mvc\Controllers;

use Elar\Mvc\Libs\Session;

class Logout extends Session
{
  public function __construct($url)
  {
    parent::__construct($url);
    $this->logout();
    $this->redirect('');
  }
}
