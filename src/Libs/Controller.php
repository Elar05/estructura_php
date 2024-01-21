<?php

namespace Elar\Mvc\Libs;

class Controller
{
  public $view;

  public function __construct(array $user)
  {
    $this->view = new View($user);
  }

  public function redirect($url, $messages = [])
  {
    $data = [];
    $params = "";

    foreach ($messages as $key => $value) {
      $data[] = $key . '=' . $this->encrypt($value);
    }
    $params = join('&', $data);

    if ($params !== "")
      $params = "?$params";

    header("Location: " . URL . "/$url$params");
    exit;
  }

  public function existsPOST($params)
  {
    foreach ($params as $param) {
      if (!isset($_POST[$param]) || empty($_POST[$param])) {
        return false;
      }
    }
    return true;
  }

  public function existsGET($params)
  {
    foreach ($params as $param) {
      if (!isset($_GET[$param]) || empty($_POST[$param])) {
        return false;
      }
    }
    return true;
  }

  public function response($data)
  {
    echo json_encode($data);
    exit();
  }

  public function encrypt($value)
  {
    return base64_encode($value);
  }
}
