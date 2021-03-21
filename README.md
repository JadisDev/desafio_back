# Projeto

Projeto back usando a linguagem de programação php. Projeto esta usando slim, doctrine, bibliotecas do symfone e banco de dados mysql

## Pré-requisito

- Versão do php: v7.4.3
- Composer
- Docker (opcional)
- Apache

As extensões do php são basicamente pdo_mysql, curl, mbstring, xml, ou mains algum que for criticado durante a instalação das dependências

## Como rodar projeto

- Baixar projeto: git clone https://github.com/JadisDev/desafio_back.git
- Na raiz do projeto rodar o seguinte comando, composer install

## Banco de dados
- Se precisar rodar o banco de dados pelo docker, segue o comando: docker run -d -p 3306:3306 --name=DESAFIO --env="MYSQL_ROOT_PASSWORD"="112233" mysql
- Caso tenha um mysql rodando localhost, deve ser parado para rodar pelo docker. Para parar mysql localmente, usar service mysql stop.
- docker container {id_container} exec -it /bin/bash
- mysql -u -p (enter) e colocar a senha 112233
- create database desafio, para criar o banco de dados
- para criar o banco de dados executar o arquivo ddl.sql na IDE de sua preferência ou direto no console. Arquivo localizado na raiz desse projeto.
- Caso não queria usar docker, deve ser trocado as varáveis de ambientes no .env do projeto de acordo com suas configurações

## Apache
- Na raiz do projeto, copiar arquivo desafio.conf para "/etc/apache2/sites-available". Se necessário trocar caminho da seguinte variáveis no arquivo desafio.conf: DocumentRoot e Directory.
- Ativar módulo do apache: a2enmod rewrite
- Habilitar site: a2ensite desafio.conf e depois service apache2 restart para apache reconhecer as alterações.
- Ir no arquivo /etc/hosts, precisa ter permissão de super usuário, depois adicionar essa linha 127.0.1.1 dev.desafio.com e salvar o arquivo

## Link para documentação da api
- Link gerado automaticamente pelo postman para documentação da api: https://documenter.getpostman.com/view/643394/Tz5wVZhe

## Projeto front

- Ver documentação: https://github.com/JadisDev/desafio

### Se tudo ocorrer bem até agora, o projeto deve estar rodando em http://dev.desafio.com/ (essa requisição não responde nada referente a api)