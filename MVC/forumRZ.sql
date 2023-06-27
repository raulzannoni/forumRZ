CREATE TABLE USER_FORUM(
   id_user INT,
   nickname_user CHAR(25) NOT NULL,
   mail_user VARCHAR(50) NOT NULL,
   password_user CHAR(255) NOT NULL,
   date_inscription_user DATE NOT NULL,
   PRIMARY KEY(id_user),
   UNIQUE(nickname_user)
);

CREATE TABLE CATEGORIE(
   id_categorie INT,
   name_categorie VARCHAR(50),
   PRIMARY KEY(id_categorie)
);

CREATE TABLE TOPIC_FORUM(
   id_topic INT AUTOINCREMENT,
   title_topic CHAR(50) NOT NULL,
   creator_topic INT NOT NULL AUTOINCREMENT,
   date_topic DATE NOT NULL,
   id_categorie INT NOT NULL,
   id_user INT NOT NULL,
   PRIMARY KEY(id_topic),
   FOREIGN KEY(id_categorie) REFERENCES CATEGORIE(id_categorie),
   FOREIGN KEY(id_user) REFERENCES USER_FORUM(id_user)
);

CREATE TABLE MESSAGE(
   id_message INT AUTOINCREMENT,
   date_message DATE NOT NULL,
   creator_message INT NOT NULL,
   text_message TEXT NOT NULL,
   id_topic INT NOT NULL,
   id_user INT NOT NULL,
   PRIMARY KEY(id_message),
   FOREIGN KEY(id_topic) REFERENCES TOPIC_FORUM(id_topic),
   FOREIGN KEY(id_user) REFERENCES USER_FORUM(id_user)
);
