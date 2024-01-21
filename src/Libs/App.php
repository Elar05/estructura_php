<?php

use Elar\Mvc\Controllers\Errores;
use Elar\Mvc\Controllers\Login;

class App
{
  public function __construct()
  {
    /**
     * 0 => controller
     * 1 => method
     * 2 => parameters (optional)
     */
    $url = $_GET['url'] ?? '';
    $url = rtrim($url, '/');
    $url = explode('/', $url);

    // Si la url[0] esta vacia se ejecuta un controlador por defecto
    if (empty($url[0])) {
      $login = new Login('login');
      $login->render();
    }

    $url[0] = str_replace("-", "", $url[0]);

    // ruta del controlador
    $fileController = "controllers/$url[0].php";

    // Validar que exista el controlador en los archivos
    if (file_exists($fileController)) {
      // nombre del controlador con mayusculas para ejecutar
      $nameController = "Controllers\\" . ucfirst($url[0]);
      $controller = new $nameController($url[0]);

      // validar que exista un metodo en la $url[1]
      if (isset($url[1])) {
        if (method_exists($controller, $url[1])) {
          if (isset($url[2])) {
            $nparam = sizeof($url);
            $params = [];

            for ($i = 2; $i < $nparam; $i++) {
              $params[] = $url[$i];
            }

            $controller->{$url[1]}($params);
          } else {
            $reflection = new ReflectionMethod($nameController, $url[1]);
            $parameters = $reflection->getParameters();
            if (count($parameters) > 0 && empty($url[2])) {
              new Errores();
            } else {
              $controller->{$url[1]}();
            }
          }
        } else {
          new Errores();
        }
      } else {
        // validamos que exista un metodo por defecto -> render()
        if (method_exists($controller, 'render')) {
          // Ejecutamos metodo render por defecto del controlador
          $controller->render();
        } else {
          new Errores();
        }
      }
    } else {
      // mostramos pagina de error 404
      new Errores();
    }
  }
}
