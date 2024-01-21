<?php

namespace Elar\Mvc\Models;

use PDO;
use Elar\Mvc\Libs\Model;
use PDOException;

class LoginModel extends Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function login($email, $password)
  {
    try {
      $query = $this->prepare("SELECT * FROM users WHERE email = :email;");
      $query->bindValue(":email", $email, PDO::PARAM_STR);
      $query->execute();
      if ($query->rowCount() == 1) {
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $user['password'])) {
          return $user;
        }

        return null;
      }
      return null;
    } catch (PDOException $e) {
      error_log('Login::login() -> ' . $e->getMessage());
      return false;
    }
  }
}
