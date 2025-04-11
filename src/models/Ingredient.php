<?php

class Ingredient {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Aggiungi un singolo ingrediente alla tabella
    public function addIngredient($name) {
        // Controlla se l'ingrediente esiste già
        $ingredient = $this->getIngredientByName($name);
        if ($ingredient) {
            return $ingredient['idIngredient'];  // Ritorna l'ID dell'ingrediente esistente
        }
        $stmt = $this->pdo->prepare("INSERT INTO ingredient (name) VALUES (:name)");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        return $this->pdo->lastInsertId();  // Ritorna l'ID dell'ingrediente appena inserita
    }

    public function getAllIngredients() {
        $stmt = $this->pdo->prepare("SELECT * FROM ingredient");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Recupera tutti gli ingredienti per una ricetta
    public function getIngredientsByRecipe($idRecipe) {
        $stmt = $this->pdo->prepare("SELECT * FROM ingredient WHERE idRecipe = :idRecipe");
        $stmt->bindParam(':idRecipe', $idRecipe);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getIngredientByName($name) {
        $stmt = $this->pdo->prepare("SELECT * FROM ingredient WHERE name = :name");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Elimina tutti gli ingredienti collegati a una ricetta (utile per modifica)
    public function deleteIngredientsByRecipe($idRecipe) {
        $stmt = $this->pdo->prepare("DELETE FROM ir WHERE idRecipe = :idRecipe");
        $stmt->bindParam(':idRecipe', $idRecipe);
        $stmt->execute();
    }

    public function unlinkIngredient($idIR) {
        $stmt = $this->pdo->prepare("DELETE FROM ir WHERE idIR = :idIR");
        $stmt->bindParam(':idIR', $idIR);
        $stmt->execute();
    }
}
