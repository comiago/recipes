USE recipes;

/*USERS*/
CREATE TABLE IF NOT EXISTS role (
    idRole INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(20) NOT NULL UNIQUE,
    PRIMARY KEY (idRole)
);

CREATE TABLE IF NOT EXISTS user (
    idUser INT AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    firstName VARCHAR(255) NOT NULL,
    lastName VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    idRole INT NOT NULL,
    approvatedBy INT,
    approvatedAt TIMESTAMP,
    PRIMARY KEY (idUser),
    FOREIGN KEY (idRole)
        REFERENCES role(idRole) ON DELETE CASCADE,
    FOREIGN KEY (approvatedBy)
        REFERENCES user(idUser) ON DELETE SET NULL
);

/*RECIPES*/
CREATE TABLE IF NOT EXISTS recipe (
	idRecipe INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(20) NOT NULL,
    description TEXT,
    amount INT NOT NULL,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    createdBy INT NOT NULL,
    PRIMARY KEY (idRecipe),
    FOREIGN KEY (createdBy)
        REFERENCES user(idUser) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS ingredient (
	idIngredient INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    amount VARCHAR(255) NOT NULL,
    idRecipe INT NOT NULL,
    PRIMARY KEY (idIngredient),
    FOREIGN KEY (idRecipe)
        REFERENCES recipe(idRecipe) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS step (
	idStep INT NOT NULL AUTO_INCREMENT,
    number INT NOT NULL,
    description TEXT,
    idRecipe INT NOT NULL,
    PRIMARY KEY (idStep),
    FOREIGN KEY (idRecipe)
        REFERENCES recipe(idRecipe) ON DELETE CASCADE
);