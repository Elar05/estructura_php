<?php

namespace Elar\Mvc\Libs;

use Elar\Mvc\Controllers\Errores;
use Elar\Mvc\Models\UserPermissionsModel;

class Session extends Controller
{
  public $permissions;
  public $defaultSite;
  public $url;
  public $userId;
  public $userType;
  public $userName;

  public function __construct($url)
  {
    if (session_status() == PHP_SESSION_NONE) session_start();

    /**
     * 1 => invitado
     * 2 => user
     * 3 => admin
     */
    $this->userId = $_SESSION['userId'] ?? '';
    $this->userType = $_SESSION['userType'] ?? 1;
    $this->userName = $_SESSION['userName'] ?? '';

    $this->url = $url;
    $this->permissions = $this->permissions();
    $this->defaultSite = 'main';

    $this->validateSession();

    parent::__construct([
      "name" => $this->userName,
      "type" => $this->userType,
      "id" => $this->userId,
    ]);
  }

  public function permissions()
  {
    $permissions = new UserPermissionsModel();
    return $permissions->getPermissions($this->userType);
  }

  public function validateSession()
  {
    if ($this->existsSession()) {
      if (!$this->isAuthorized($this->url)) {
        $this->redirect($this->defaultSite);
      }
    } else {
      if (!$this->isAuthorized($this->url)) {
        new Errores();
      }
    }
  }

  public function existsSession()
  {
    return isset($_SESSION['userId']);
  }

  public function isAuthorized($permission)
  {
    return in_array($permission, $this->permissions);
  }

  public function initialize($user)
  {
    $_SESSION['userId'] = $user['id'];
    $_SESSION['userType'] = $user['type_user_id'];
    $_SESSION['userName'] = $user['name'];

    $this->redirect($this->defaultSite);
  }

  public function logout()
  {
    session_unset();
    session_destroy();
  }
}
