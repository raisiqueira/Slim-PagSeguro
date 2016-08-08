<?php

namespace Controllers;

class PagSeguroController {

  protected $ci;

  public function __construct($ci) {
    $this->ci = $ci;
  }

  // Return Session Id PagSeguro
  public function SessionId ($req, $res) {

    if( $res->withHeader(201) ) {

      // PagSeguro Libraries
      \PagSeguroLibrary::init();
      \PagSeguroConfig::init();
      \PagSeguroResources::init();

      //PagSeguro credentials via dot env file
      $credentials = \PagSeguroConfig::getAccountCredentials();
      $data = [
        'sessionid' => \PagSeguroSessionService::getSession($credentials)
      ];

      $newResponse = $res->withJson($data);
      return $res->withHeader('Content-type', 'application/json');

    } else {
      $res = $res->withStatus(403);
      $data = [
        'message' => 'Não Autorizado!'
      ];

      $newResponse = $res->withJson($data);
      return $res->withHeader('Content-type', 'application/json');
    }
  }

}
