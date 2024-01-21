<?php

namespace Elar\Mvc\Libs;

class Model
{
  private $db;

  public function __construct(string $database = "mvc")
  {
    $databases = [
      "mvc" => "DatabaseMvc",
      "repraciones" => "DatabaseReparaciones"
    ];

    $base = "\\Elar\\Mvc\\Libs\\Database\\$databases[$database]";

    $this->db = new $base();
  }

  public function connect()
  {
    return $this->db->connect();
  }

  public function query($sql)
  {
    return $this->db->connect()->query($sql);
  }

  public function prepare($sql)
  {
    return $this->db->connect()->prepare($sql);
  }
}
