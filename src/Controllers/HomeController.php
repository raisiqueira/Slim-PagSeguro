<?php

namespace Controllers;

class HomeController {

  protected $ci;

  public function __construct ($ci) {
    $this->ci = $ci;
  }

  public function HomeActions ($req, $res) {
    $res = $res->withStatus(403);
    $body = [
      'message' => 'não autorizado!'
    ];
    $newResponse = $res->withJson($body);
    return $res->withHeader('Content-type', 'application/json');
  }
}
