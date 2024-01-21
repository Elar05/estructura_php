<?php

namespace Elar\Mvc\Controllers;

use Elar\Mvc\Libs\Session;
use Elar\Mvc\Models\UserActionModel;

class UserAction extends Session
{
  public function __construct($url)
  {
    parent::__construct($url);
  }

  public function render()
  {
    $this->view->render('useraction/index', [
      "actions" => UserActionModel::getAll()
    ]);
  }

  public function create()
  {
    $this->view->render('useraction/form', [
      'action' => '/useraction/save',
      'title' => 'Create User Action',
      'textButton' => 'Save',
    ]);
  }

  public function save()
  {
    if (!$this->existsPOST(['name'])) {
      $this->redirect('useraction/create', [
        'message' => 'Name is required',
        'class' => 'danger'
      ]);
    }

    $action = new UserActionModel();
    $action->__set('name',  $_POST['name']);

    if ($action->save()) {
      $this->redirect('useraction', [
        'message' => 'Register created successfully',
        'class' => 'success'
      ]);
    }

    $this->redirect('useraction/create', [
      'message' => 'An error has occurred',
      'class' => 'danger'
    ]);
  }

  public function edit($id)
  {
    if ($action = UserActionModel::get($id)) {
      $this->view->render('useraction/form', [
        'action' => '/useraction/update',
        'title' => 'Edit User Action',
        'textButton' => 'Save Changes',
        'userAction' => $action
      ]);
    }

    $this->redirect('useraction', [
      'message' => 'Parameters are missing',
      'class' => 'danger'
    ]);
  }

  public function update()
  {
    if (!$this->existsPOST(['name', 'id'])) {
      $this->redirect('useraction', [
        'message' => 'Parameters are missing',
        'class' => 'danger'
      ]);
    }

    $action = new UserActionModel();
    $action->__set('id',  $_POST['id']);
    $action->__set('name',  $_POST['name']);

    if ($action->update()) {
      $this->redirect('useraction', [
        'message' => 'Register updated successfully',
        'class' => 'success'
      ]);
    }

    $this->redirect('useraction', [
      'message' => 'An error has occurred',
      'class' => 'danger'
    ]);
  }
}
