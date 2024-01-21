<?php

namespace Elar\Mvc\Models;

use PDO;
use Elar\Mvc\Libs\Model;
use PDOException;

class TypeUserModel extends Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public static function get($id)
  {
    try {
      $pdo = new Model();
      $query = $pdo->prepare("SELECT * FROM type_users WHERE id = :id;");
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
      $query = $pdo->query("SELECT * FROM type_users;");
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log('TypeUserModel::getAll() -> ' . $e->getMessage());
      return false;
    }
  }

  public static function exists($name)
  {
    try {
      $pdo = new Model();
      $query = $pdo->prepare("SELECT * FROM type_users WHERE name = :name;");
      $query->execute(['name' => $name]);

      if ($query->rowCount() > 0) return true;

      return false;
    } catch (PDOException $e) {
      error_log('UserActionModel::get() -> ' . $e->getMessage());
      return false;
    }
  }

  public function save()
  {
    try {
      $query = $this->prepare("INSERT INTO type_users (name) VALUES (:name);");
      return $query->execute(['name' => $this->name]);
    } catch (PDOException $e) {
      error_log('TypeUserModel::save() -> ' . $e->getMessage());
      return false;
    }
  }

  public function update()
  {
    try {
      $query = $this->prepare("UPDATE type_users SET name = :name WHERE id = :id;");
      return $query->execute(['name' => $this->name, 'id' => $this->id]);
    } catch (PDOException $e) {
      error_log('TypeUserModel::udpate() -> ' . $e->getMessage());
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
