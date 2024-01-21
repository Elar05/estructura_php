<?php

namespace Elar\Mvc\Libs;

class View
{
  public $d;
  public $class;

  public function __construct(private array $user)
  {
  }

  public function render($name, $data = [])
  {
    $this->d = $data;
    $this->handleMessages();
    require "src/views/$name.php";
    exit;
  }

  public function handleMessages()
  {
    if (isset($_GET['message'])) {
      $this->handleMessage();
    }
  }

  public function handleMessage()
  {
    if (isset($_GET['message'])) {
      $this->d['message'] = $this->decrypt($_GET['message']);
      $this->class = (isset($_GET['class'])) ? $this->decrypt($_GET['class']) : 'primary';
    }
  }

  public function showMessages()
  {
    $this->showMessage();
  }

  public function showMessage()
  {
    if (array_key_exists('message', $this->d)) {
      echo "<div class='alert alert-{$this->class}' role=alert>{$this->d['message']}</div>";
    }
  }

  public function decrypt($value)
  {
    return base64_decode($value);
  }
}
