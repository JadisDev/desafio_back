CREATE TABLE desafio.users (
	id INT auto_increment NOT NULL,
	name varchar(100) NOT NULL,
	login varchar(3) NOT NULL,
	senha varchar(100) NOT NULL,
	created_an varchar(100) NOT NULL,
	CONSTRAINT users_PK PRIMARY KEY (id)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE desafio.type_challenges (
	id INT auto_increment NOT NULL,
	description varchar(100) NOT NULL,
	CONSTRAINT type_challenges_PK PRIMARY KEY (id)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE desafio.questions (
	id int NOT NULL,
	type_challenge_id INT NOT NULL,
	description varchar(100) NOT NULL COMMENT 'Descrição da pergunta',
	CONSTRAINT questions_PK PRIMARY KEY (id),
	CONSTRAINT questions_FK FOREIGN KEY (type_challenge_id) REFERENCES desafio.type_challenges(id)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE desafio.alternatives (
	id INT auto_increment NOT NULL,
	question_id INT NOT NULL,
	description varchar(100) NOT NULL COMMENT 'Descrição da alternativa',
	is_right BOOL NOT NULL,
	CONSTRAINT alternatives_PK PRIMARY KEY (id),
	CONSTRAINT alternatives_FK FOREIGN KEY (question_id) REFERENCES desafio.questions(id)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `games` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `question_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `games_FK` (`user_id`),
  KEY `games_FK_1` (`question_id`),
  CONSTRAINT `games_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `games_FK_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci