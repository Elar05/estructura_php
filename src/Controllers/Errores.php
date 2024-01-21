<?php

namespace Elar\Mvc\Controllers;

use Elar\Mvc\Libs\Controller;

class Errores extends Controller
{
  public function __construct()
  {
    parent::__construct([]);
    $this->view->render('errores/index');
  }
}
