Lib usando

slim

Criar banco de dados?

- Pre requisitos docker e docker-compose
- iniciar banco de dados:

1 - docker run -d -p 3306:3306 --name=DESAFIO --env="MYSQL_ROOT_PASSWORD"="112233" mysql
2 - docker container {id_container} exec -it /bin/bash
3 - mysql -u -p (enter)
4 - create database desafio;

