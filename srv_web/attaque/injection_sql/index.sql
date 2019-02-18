CREATE DATABASE IF NOT EXISTS injections_sql CHARACTER SET utf8;

USE injections_sql;

CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    username VARCHAR(20) NOT NULL,
    password VARCHAR(40) NOT NULL,
    rank TINYINT UNSIGNED NOT NULL DEFAULT 2,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS categories (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS articles (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    content TEXT NULL,
    category_id INT UNSIGNED NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(category_id) 
    REFERENCES categories(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO users (username, password, rank) VALUES
('thomas', 'root', 1),
('root', 'monsupermotdepasseintrouvable', 2),
('lprt', 'formationinitiale', 2),
('informatique', 'jesaispasquoimettre', 2);

INSERT INTO categories (title) VALUES
('Réseaux'),
('Système'),
('Télécommunications');

INSERT INTO articles (title, content, category_id) VALUES
('Un article pour M.PEZERIL', 'Il fallait marquer un contenu', 3),
('Mon second article pour M.DELANOUE', 'Il faut battre le fer tant qu il est chaud', 2),
('Troisième article pour M.SAVIO', 'Jamais deux sans trois !', 1);
