<?php

class Ingredient {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Aggiungi un singolo ingrediente alla tabella
    public function addIngredient($name, $amount, $idRecipe) {
        $stmt = $this->pdo->prepare("INSERT INTO ingredient (name, amount, idRecipe) VALUES (:name, :amount, :idRecipe)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':idRecipe', $idRecipe);
        $stmt->execute();
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
        $stmt = $this->pdo->prepare("DELETE FROM ingredient WHERE idRecipe = :idRecipe");
        $stmt->bindParam(':idRecipe', $idRecipe);
        $stmt->execute();
    }
}
