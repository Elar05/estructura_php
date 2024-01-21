<?php

namespace Elar\Mvc\Libs\Database;

use PDO;
use PDOException;

class DatabaseMvc
{
  private $host;
  private $db;
  private $user;
  private $password;
  private $charset;

  public function __construct()
  {
    $this->host = HOST;
    $this->db = DB_MVC;
    $this->user = USER_MVC;
    $this->password = PASSWORD_MVC;
    $this->charset = CHARSET;
  }

  public function connect()
  {
    try {
      $conexion = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
      $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
      ];
      $pdo = new PDO($conexion, $this->user, $this->password, $options);
      return $pdo;
    } catch (PDOException $e) {
      error_log('Database::connec() -> ' . $e->getMessage());
      return false;
    }
  }
}
