[![Build Status](https://travis-ci.org/raisiqueira/Slim-PagSeguro.svg?branch=master)](https://travis-ci.org/raisiqueira/Slim-PagSeguro)

# Slim Framework 3 Skeleton Application + PagSeguro Lib

Aplicação simples para geração do Token para pagamentos no PagSeguro (método transparente) e envio dos dados gerados via front-end.

## Install the Application

Clone o repositório e rode um `composer install`.

* Sete o virtual host para a pasta `public/`;
* Garanta que a pasta `logs/` está com permissões de escrita;
* Configure o arquivo `src/middleware.php` com suas configurações de [CORS](https://developer.mozilla.org/en-US/docs/Web/HTTP/Access_control_CORS);
* Edite o arquivo `.env.example` para `.env` e preencha com seus dados do PagSeguro.

### Rotas

* `GET` */session*  - Rota para gerar Token do PagSeguro | *Retorno* `JSON`.
* `POST` */order*   - Rota para enviar os dados para o PagSeguro.

É isso aí! Agora é só construir algo legal com essa base!

* [Documentação PagSeguro](https://pagseguro.uol.com.br/v2/guia-de-integracao/documentacao-da-biblioteca-pagseguro-em-php.html#!rmcl).
* [Documentação do Slim Framework](http://www.slimframework.com/docs/).
