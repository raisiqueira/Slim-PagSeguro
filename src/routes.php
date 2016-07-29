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
$app->get('/session', 'PagSeguroController:SessionId');
