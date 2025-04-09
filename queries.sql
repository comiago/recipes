USE recipes;

/*USERS*/
CREATE TABLE user (
    idUser INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    firstName VARCHAR(255) NOT NULL,
    lastName VARCHAR(255) NOT NULL,
    PRIMARY KEY (idUser)
);


/*RECIPES*/
CREATE TABLE IF NOT EXISTS recipe (
	idRecipe INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(20) NOT NULL,
    description VARCHAR(255),
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    idUser INT NOT NULL,
    PRIMARY KEY (idRecipe),
    FOREIGN KEY (idUser)
        REFERENCES user(idUser) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS ingredient (
	idIngredient INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(20) NOT NULL,
    amount VARCHAR(255) NOT NULL,
    idRecipe INT NOT NULL,
    PRIMARY KEY (idIngredient),
    FOREIGN KEY (idRecipe)
        REFERENCES recipe(idRecipe) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS step (
	idStep INT NOT NULL AUTO_INCREMENT,
    number INT NOT NULL,
    description VARCHAR(255),
    idRecipe INT NOT NULL,
    PRIMARY KEY (idStep),
    FOREIGN KEY (idRecipe)
        REFERENCES recipe(idRecipe) ON DELETE CASCADE
);