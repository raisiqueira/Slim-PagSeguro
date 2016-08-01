<?php

// Router Padrão
$app->get('/', 'HomeController:HomeActions');

//Route Session ID PagSeguro
$app->get('/session', 'PagSeguroController:SessionId');

// Route post PagSeguro
$app->post('/order', 'OrdersController:Store');
