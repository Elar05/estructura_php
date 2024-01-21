<?php

use Elar\Mvc\Controllers\Chat;
use Elar\Mvc\Controllers\Main;
use Elar\Mvc\Controllers\Login;
use Elar\Mvc\Controllers\Logout;
use Elar\Mvc\Controllers\TypeUser;
use Elar\Mvc\Controllers\UserAction;

$router = new \Bramus\Router\Router();

$router->get('/', function () {
  $login = new Login('login');
  $login->render();
});

$router->mount('/login', function () use ($router) {
  $router->get('/', function () {
    $login = new Login('login');
    $login->render();
  });

  $router->post('/auth', function () {
    $login = new Login('login');
    $login->auth();
  });
});

$router->get('/main', function () {
  $main = new Main('main');
  $main->render();
});

$router->mount('/useraction', function () use ($router) {
  $router->get('/', function () {
    $useraction = new UserAction('useraction');
    $useraction->render();
  });

  $router->get('/create', function () {
    $useraction = new UserAction('useraction');
    $useraction->create();
  });

  $router->post('/save', function () {
    $useraction = new UserAction('useraction');
    $useraction->save();
  });

  $router->get('/edit/(\d+)', function ($id) {
    $useraction = new UserAction('useraction');
    $useraction->edit($id);
  });

  $router->post('/update', function () {
    $useraction = new UserAction('useraction');
    $useraction->update();
  });
});

$router->mount('/typeuser', function () use ($router) {
  $router->get('/', function () {
    $typeuser = new TypeUser('typeuser');
    $typeuser->render();
  });

  $router->get('/create', function () {
    $typeuser = new TypeUser('typeuser');
    $typeuser->create();
  });

  $router->post('/save', function () {
    $typeuser = new TypeUser('typeuser');
    $typeuser->save();
  });

  $router->get('/edit/(\d+)', function ($id) {
    $typeuser = new TypeUser('typeuser');
    $typeuser->edit($id);
  });

  $router->post('/update', function () {
    $typeuser = new TypeUser('typeuser');
    $typeuser->update();
  });

  $router->post('/getPermissions', function () {
    $typeuser = new TypeUser('typeuser');
    $typeuser->getPermissions();
  });

  $router->post('/storePermission', function () {
    $typeuser = new TypeUser('typeuser');
    $typeuser->storePermission();
  });
});

$router->get('/chat', function () {
  $chat = new Chat('chat');
  $chat->render();
});
$router->post('/chat/getHistory', function () {
  $chat = new Chat('chat');
  $chat->getHistory();
});

$router->get('/logout', function () {
  new Logout('logout');
});

$router->set404(function () {
  echo "404";
});

$router->run();
