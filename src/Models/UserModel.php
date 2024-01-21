<?php

namespace Elar\Mvc\Models;

use PDO;
use Elar\Mvc\Libs\Model;
use PDOException;

class UserModel extends Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public static function getAll()
  {
    try {
      $pdo = new Model();
      $query = $pdo->query("SELECT * FROM users;");
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log('UserModel::getAll() -> ' . $e->getMessage());
      return false;
    }
  }
}
