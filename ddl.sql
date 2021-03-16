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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci

CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `login` varchar(3) NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_an` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci

CREATE TABLE `games` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `question_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `games_FK` (`user_id`),
  KEY `games_user_FK_1` (`question_id`),
  CONSTRAINT `games_question_FK` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`),
  CONSTRAINT `games_user_FK_1` FOREIGN KEY (`question_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci