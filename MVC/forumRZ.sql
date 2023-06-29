CREATE DATABASE IF NOT EXISTS `forumRZ`
USE `forumRZ`;

CREATE TABLE IF NOT EXISTS `user`(
   id_user INT NOT NULL AUTO_INCREMENT,
   nickname_user CHAR(25) NOT NULL,
   mail_user VARCHAR(50) NOT NULL,
   password_user VARCHAR(255) NOT NULL,
   date_user DATETIME DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY(id_user)
)ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `user` (`id_user`, `nickname_user`, `mail_user`, `password_user`, `date_user`) VALUES
   (1, 'user_1', 'user_1@gmail.com', '1234', '2023-06-29 08:55:35'),
   (2, 'user_2', 'user_2@gmail.com', '2345', '2023-06-29 08:56:02'),
   (3, 'user_3', 'user_3@gmail.com', '3456', '2023-06-29 08:57:19');

CREATE TABLE IF NOT EXISTS `category`(
   id_category INT NOT NULL AUTO_INCREMENT,
   name_category VARCHAR(50),
   PRIMARY KEY(id_category)
)ENGINE=InnoDB AUTO_INCREMENT=5 CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `category` (`id_category`, `name_category`) VALUES
	(1, 'Games'),
	(2, 'News'),
	(3, 'Art'),
	(4, 'Politics');
	

CREATE TABLE IF NOT EXISTS `topic`(
   id_topic INT NOT NULL AUTO_INCREMENT,
   title_topic VARCHAR(150) NOT NULL DEFAULT '',
   date_topic DATETIME DEFAULT CURRENT_TIMESTAMP,
   category_id INT NOT NULL,
   user_id INT NOT NULL,
   PRIMARY KEY(id_topic),
   KEY `FK_topic_category` (`category_id`),
   KEY `FK_topic_users` (`user_id`),
   CONSTRAINT `FK_topic_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`),
   CONSTRAINT `FK_topic_users` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
)ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `topic` (`id_topic`, `title_topic`, `date_topic`, `category_id`, `user_id`) VALUES
   (1, 'Title Topic 1->games', '2023-06-29 09:01:35', 1, 2),
   (2, 'Title Topic 2->news', '2023-06-29 09:22:23', 2, 1),
   (3, 'Title Topic 3->art', '2023-06-29 10:37:51', 3, 3),
   (4, 'Title Topic 4->politics', '2023-06-29 10:41:00', 4, 1);


CREATE TABLE IF NOT EXISTS `post`(
   id_post INT NOT NULL AUTO_INCREMENT,
   date_post DATETIME DEFAULT CURRENT_TIMESTAMP,
   text_post TEXT NOT NULL,
   topic_id INT NOT NULL,
   user_id INT NOT NULL,
   PRIMARY KEY(id_post),
   KEY `user_id` (`user_id`),
   KEY `topic_id` (`topic_id`),
   CONSTRAINT `FK_post_topic` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`),
   CONSTRAINT `FK_post_users` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
)ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `post` (`id_post`, `date_post`, `text_post`, `topic_id`, `user_id`) VALUES
   (1, '2023-06-29 11:02:35', '1st text for games, topic 1', 1, 2),
   (2, '2023-06-29 12:31:03', 'answer to topic 1', 1, 3),
   (3, '2023-06-29 10:02:35', '1st text for news, topic 2', 2, 1),
   (4, '2023-06-29 10:03:31', 'answer to topic 2', 2, 2),
   (5, '2023-06-29 10:04:32', '1st text for art, topic 3', 3, 3),
   (6, '2023-06-29 10:05:33', 'answer to topic 3', 3, 1),
   (7, '2023-06-29 10:06:38', '1st text for politics, topic 4', 2, 1),
   (8, '2023-06-29 10:07:39', 'answer to topic 4', 2, 3);


CREATE TABLE IF NOT EXISTS `like` (
   `id_like` int NOT NULL AUTO_INCREMENT,
   `user_id` int NOT NULL,
   `post_id` int NOT NULL,
   `type_like` int NOT NULL,
   PRIMARY KEY (`id_like`) USING BTREE,
   KEY `user_id` (`user_id`),
   KEY `post_id` (`post_id`),
   CONSTRAINT `FK__post` FOREIGN KEY (`post_id`) REFERENCES `post` (`id_post`),
   CONSTRAINT `FK__user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=1 CHARSET=utf8 COLLATE=utf8_general_ci;
