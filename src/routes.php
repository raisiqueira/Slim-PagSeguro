<?php

// Router Padrão
$app->get('/', function ($request, $response) {
  $response = $response->withStatus(403);
  $body = [
    'message' => 'não autorizado!'
  ];
  $newResponse = $response->withJson($body);
  return $response->withHeader('Content-type', 'application/json');
});

//Routes Session ID PagSeguro
$app->get('/session', function ($request, $response) {

  if( $response->withHeader(200) ) {

      //Init libs PagSeguro
      \PagSeguroLibrary::init();
      \PagSeguroConfig::init();
      \PagSeguroResources::init();

      // Generate PagSeguro credentials via dot env file.
      $credentials = \PagSeguroConfig::getAccountCredentials();
      $data = [
        'sessionid' => \PagSeguroSessionService::getSession($credentials)
      ];

      $newResponse = $response->withJson($data);
      return $response->withHeader('Content-type', 'application/json');

    }else {
      $response = $response->withStatus(403);
      $body = [
        'message' => 'não autorizado!'
      ];
      $newResponse = $response->withJson($body);
      return $response->withHeader('Content-type', 'application/json');
    }
});
