CREATE TABLE `type_challenges` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci

CREATE TABLE `questions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type_challenge_id` int NOT NULL,
  `description` varchar(100) NOT NULL COMMENT 'Descrição da pergunta',
  PRIMARY KEY (`id`),
  KEY `questions_FK` (`type_challenge_id`),
  CONSTRAINT `questions_FK` FOREIGN KEY (`type_challenge_id`) REFERENCES `type_challenges` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci

CREATE TABLE `alternatives` (
  `id` int NOT NULL AUTO_INCREMENT,
  `question_id` int NOT NULL,
  `description` varchar(100) NOT NULL COMMENT 'Descrição da alternativa',
  `is_right` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `alternatives_FK` (`question_id`),
  CONSTRAINT `alternatives_FK` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci

CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `login` varchar(3) NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_an` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci

CREATE TABLE `games` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `question_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `games_user_FK_1` (`question_id`),
  KEY `games_FK` (`user_id`),
  CONSTRAINT `games_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `games_question_FK` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci


-- Povoar dados

INSERT INTO desafio.type_challenges (description) VALUES
	 ('Matemática'),
	 ('História'),
	 ('Desenvolvimento');

INSERT INTO desafio.questions (type_challenge_id,description) VALUES
	 (1,'Quanto é 1 + 1?'),
	 (1,'Quanto é 10 x 10?'),
	 (2,'Quando ocorreu a primeira guerra mundial?'),
	 (2,'Quando ocorreu a segunda guerra mundial?'),
	 (2,'Qual dia da libertação dos escravos?'),
	 (3,'Qual desses não é uma linguagem de programação?'),
	 (3,'Qual desses é sgbd?');

INSERT INTO desafio.alternatives (question_id,description,is_right) VALUES
	 (1,'Igual a 2',1),
	 (1,'Igual a 4',0),
	 (2,'Igual a 99',0),
	 (2,'Igual a 100',1),
	 (3,'28 de julho de 1914 – 11 de novembro de 1918',1),
	 (3,'29 de julho de 1914 – 11 de novembro de 1918',0),
	 (4,'2 de setembro de 1939 – 2 de setembro de 1945',0),
	 (4,'1 de setembro de 1939 – 2 de setembro de 1945',1),
	 (5,'13 de maio',1),
	 (5,'15 de abril',0);
INSERT INTO desafio.alternatives (question_id,description,is_right) VALUES
	 (6,'PHP, JS',1),
	 (6,'HTML',0),
	 (7,'Servidor',0),
	 (7,'Mysql',1);

