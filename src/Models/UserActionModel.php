<?php

namespace Elar\Mvc\Models;

use PDO;
use Elar\Mvc\Libs\Model;
use PDOException;

class UserActionModel extends Model
{
  public int $id;
  public string $name;

  public function __construct()
  {
    parent::__construct();
  }

  public static function get($id)
  {
    try {
      $pdo = new Model();
      $query = $pdo->prepare("SELECT * FROM user_actions WHERE id = :id;");
      $query->execute(['id' => $id]);
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log('UserActionModel::get() -> ' . $e->getMessage());
      return false;
    }
  }

  public static function getAll()
  {
    try {
      $pdo = new Model();
      $query = $pdo->query("SELECT * FROM user_actions;");
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log('UserActionModel::getAll() -> ' . $e->getMessage());
      return false;
    }
  }

  public function save()
  {
    try {
      $query = $this->prepare("INSERT INTO user_actions (name) VALUES (:name);");
      return $query->execute(['name' => $this->name]);
    } catch (PDOException $e) {
      error_log('UserActionModel::save() -> ' . $e->getMessage());
      return false;
    }
  }

  public function update()
  {
    try {
      $query = $this->prepare("UPDATE user_actions SET name = :name WHERE id = :id;");
      return $query->execute(['name' => $this->name, 'id' => $this->id]);
    } catch (PDOException $e) {
      error_log('UserActionModel::udpate() -> ' . $e->getMessage());
      return false;
    }
  }

  public function __get($name)
  {
    return $this->{$name};
  }

  public function __set($name, $value)
  {
    $this->{$name} = $value;
  }
}
