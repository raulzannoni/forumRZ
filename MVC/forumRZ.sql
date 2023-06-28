CREATE DATABASE IF NOT EXISTS `forumRZ`
USE `forumRZ`;

CREATE TABLE IF NOT EXISTS `user`(
   id_user INT NOT NULL AUTO_INCREMENT,
   nickname_user CHAR(25) NOT NULL,
   mail_user VARCHAR(50) NOT NULL,
   password_user VARCHAR(255) NOT NULL,
   date_user DATETIME DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY(id_user)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `message`(
   id_message INT NOT NULL AUTO_INCREMENT,
   date_message DATETIME DEFAULT CURRENT_TIMESTAMP,
   text_message TEXT NOT NULL,
   topic_id INT NOT NULL,
   user_id INT NOT NULL,
   PRIMARY KEY(id_message),
   KEY `user_id` (`user_id`),
   KEY `topic_id` (`topic_id`),
   CONSTRAINT `FK_post_topic` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`),
   CONSTRAINT `FK_post_users` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
