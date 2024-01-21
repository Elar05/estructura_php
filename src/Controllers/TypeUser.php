<?php

namespace Elar\Mvc\Controllers;

use Elar\Mvc\Libs\Session;
use Elar\Mvc\Models\TypeUserModel;
use Elar\Mvc\Models\UserActionModel;
use Elar\Mvc\Models\UserPermissionsModel;

class TypeUser extends Session
{
  public function __construct($url)
  {
    parent::__construct($url);
  }

  public function render()
  {
    $this->view->render('typeuser/index', [
      "types" => TypeUserModel::getAll(),
      "actions" => UserActionModel::getAll()
    ]);
  }

  public function create()
  {
    $this->view->render('typeuser/form', [
      'action' => "/typeuser/save",
      'title' => 'Create User Type',
      'textButton' => 'Save',
    ]);
  }

  public function save()
  {
    if (!$this->existsPOST(['name'])) {
      $this->redirect('typeuser/create', [
        'message' => 'Name is required',
        'class' => 'danger'
      ]);
    }

    if (!preg_match("/^[a-zA-Z]+$/", $_POST['name'])) {
      $this->redirect('typeuser', [
        'message' => 'The name field must be letters only',
        'class' => 'warning'
      ]);
    }

    if (TypeUserModel::exists($_POST['name'])) {
      $this->redirect('typeuser', [
        'message' => 'User Type already exists',
        'class' => 'warning'
      ]);
    }

    $action = new TypeUserModel();
    $action->__set('name',  $_POST['name']);

    if ($action->save()) {
      $this->redirect('typeuser', [
        'message' => 'Register created successfully',
        'class' => 'success'
      ]);
    }

    $this->redirect('typeuser/create', [
      'message' => 'An error has occurred',
      'class' => 'danger'
    ]);
  }

  public function edit($id)
  {
    if ($type = TypeUserModel::get($id)) {
      $this->view->render('typeuser/form', [
        'action' => "/typeuser/update",
        'title' => 'Edit User Type',
        'textButton' => 'Save Changes',
        'type' => $type
      ]);
    }

    $this->redirect('typeuser', [
      'message' => 'Parameters are missing',
      'class' => 'danger'
    ]);
  }

  public function update()
  {
    if (!$this->existsPOST(['name', 'id'])) {
      $this->redirect('typeuser', [
        'message' => 'Parameters are missing',
        'class' => 'danger'
      ]);
    }

    if (!preg_match("/^[a-zA-Z]+$/", $_POST['name'])) {
      $this->redirect('typeuser', [
        'message' => 'The name field must be letters only',
        'class' => 'warning'
      ]);
    }

    if (TypeUserModel::exists($_POST['name'])) {
      $this->redirect('typeuser', [
        'message' => 'User Type already exists',
        'class' => 'warning'
      ]);
    }

    $action = new TypeUserModel();
    $action->__set('id',  $_POST['id']);
    $action->__set('name',  $_POST['name']);

    if ($action->update()) {
      $this->redirect('typeuser', [
        'message' => 'Register updated successfully',
        'class' => 'success'
      ]);
    }

    $this->redirect('typeuser', [
      'message' => 'An error has occurred',
      'class' => 'danger'
    ]);
  }

  public function getPermissions()
  {
    if (!$this->existsPOST(['typeUserId'])) {
      $this->response(["error" => "Faltan parametros"]);
    }

    $permissions = UserPermissionsModel::getAll($_POST['typeUserId']);

    $this->response(["permissions" => array_column($permissions, 'action_id')]);
  }

  public function storePermission()
  {
    if (!$this->existsPOST(['typeUserId', 'actionId'])) {
      $this->response(["error" => "Faltan parametros"]);
    }

    $permission = new UserPermissionsModel();

    $permiso = $permission->get($_POST['typeUserId'], $_POST['actionId']);

    if (empty($permiso)) {
      $permission->save($_POST['typeUserId'], $_POST['actionId']);
      $this->response(["success" => "Permiso agregado"]);
    } else {
      $permission->delete($_POST['typeUserId'], $_POST['actionId']);
      $this->response(["success" => "Permiso eliminado"]);
    }
  }
}
