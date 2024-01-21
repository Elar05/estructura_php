<?php

namespace Elar\Mvc\Models;

use PDO;
use Elar\Mvc\Libs\Model;
use PDOException;

class UserPermissionsModel extends Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function get($type_user_id, $action_id)
  {
    try {
      $query = $this->prepare("SELECT * FROM user_permissions WHERE type_user_id = ? AND action_id = ?;");
      $query->execute([$type_user_id, $action_id]);
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("UserPermissionsModel::get() -> " . $e->getMessage());
      return false;
    }
  }

  public static function getAll($id)
  {
    try {
      $pdo = new Model();
      $query = $pdo->prepare(
        "SELECT action_id FROM user_permissions WHERE type_user_id = ?;"
      );
      $query->execute([$id]);
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("UserPermissionsModel::getAll() -> " . $e->getMessage());
      return false;
    }
  }

  public function getPermissions($typeUserId)
  {
    try {
      $query = $this->prepare(
        "SELECT ua.name
        FROM user_permissions up
        INNER JOIN user_actions ua ON up.action_id = ua.id
        WHERE up.type_user_id = ?;"
      );
      $query->execute([$typeUserId]);
      $data = $query->fetchAll(PDO::FETCH_ASSOC);
      /**
       * ? Lo que devuelve la consulta: [["name" => 'user'], ["name" => 'main']]
       * ! Lo que debemos devolver: ['user', 'main']
       */
      return array_column($data, 'name');
    } catch (PDOException $e) {
      error_log("UserPermissionsModel::getPermissions() -> " . $e->getMessage());
      return false;
    }
  }

  public function save($type_user_id, $action_id)
  {
    try {
      $query = $this->prepare(
        "INSERT INTO user_permissions (type_user_id, action_id) VALUES (?, ?);"
      );
      return $query->execute([$type_user_id, $action_id]);
    } catch (PDOException $e) {
      error_log("UserPermissionsModel::save() -> " . $e->getMessage());
      return false;
    }
  }

  public function delete($type_user_id, $action_id)
  {
    try {
      $query = $this->prepare(
        "DELETE FROM user_permissions WHERE type_user_id = ? AND action_id = ?;"
      );
      return $query->execute([$type_user_id, $action_id]);
    } catch (PDOException $e) {
      error_log("UserPermissionsModel::delete() -> " . $e->getMessage());
      return false;
    }
  }
}
