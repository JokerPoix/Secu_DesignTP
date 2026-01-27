CREATE DATABASE IF NOT EXISTS secbydes
  CHARACTER SET utf8
  COLLATE utf8_general_ci;

USE secbydes;

CREATE TABLE IF NOT EXISTS users (
                                     id INT AUTO_INCREMENT PRIMARY KEY,
                                     login VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL
    ) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS news (
                                    id INT AUTO_INCREMENT PRIMARY KEY,
                                    title VARCHAR(100) NOT NULL UNIQUE,
    content VARCHAR(100) NOT NULL
    ) ENGINE=InnoDB;

INSERT INTO users (login, password) VALUES('raphael', CONCAT('*', UPPER(SHA1(UNHEX(SHA1('assalamualaikum')))))),
                                        ('admin',   CONCAT('*', UPPER(SHA1(UNHEX(SHA1('admin123')))))),
                                        ('guest',   CONCAT('*', UPPER(SHA1(UNHEX(SHA1('guest'))))));

INSERT INTO news (title, content) VALUES
                                      ('Bienvenue', 'Bienvenue sur SecByDes'),
                                      ('Maintenance', 'Le site sera mis a jour cette semaine'),
                                      ('Securite', 'Pensez a utiliser des mots de passe robustes');
