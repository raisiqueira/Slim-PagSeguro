# Imagem Docker para o Micro service
FROM ambientum/php:7.0-caddy

MAINTAINER <contato@raisiqueira.com>

# Env da pasta home
ENV HOME=/var/www/app

EXPOSE 8080

#Copia o arquivo composer para a pasta /var/www/app do Container
COPY composer.json $HOME/

# Define o diretório de trabalho
WORKDIR /var/www/app

# Compose install
RUN composer install --no-interaction --no-progress --prefer-dist

# Copia os outros arquivos
COPY . $HOME
