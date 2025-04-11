<?php

class Recipe {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Ottieni tutte le ricette
    public function getAllRecipes() {
        $stmt = $this->pdo->prepare("SELECT * FROM recipe");
        $stmt->execute();
        $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Se non ci sono ricette, ritorna un array vuoto
        if (empty($recipes)) {
            return false; // Nessuna ricetta trovata
        }
        return $recipes;
    }

    // Ottieni una ricetta per ID
    public function getRecipeById($idRecipe) {
        $stmt = $this->pdo->prepare("SELECT * FROM recipe WHERE idRecipe = :idRecipe");
        $stmt->bindParam(':idRecipe', $idRecipe);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Ottieni una ricetta per ID del creatore
    public function getRecipesByUserId($userId) {
        $stmt = $this->pdo->prepare("SELECT * FROM recipe WHERE createdBy = :userId ORDER BY createdAt DESC");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Aggiungi una nuova ricetta
    public function addRecipe($title, $description, $amount, $userId) {
        $stmt = $this->pdo->prepare("INSERT INTO recipe (title, description, amount, createdBy) VALUES (:title, :description, :amount, :createdBy)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':amount', $amount); // Assicurati di passare anche l'importo se necessario
        $stmt->bindParam(':createdBy', $userId);
        $stmt->execute();
        return $this->pdo->lastInsertId();  // Ritorna l'ID della ricetta appena inserita
    }

    // Modifica una ricetta esistente
    public function updateRecipe($idRecipe, $title, $description, $amount) {
        $stmt = $this->pdo->prepare("UPDATE recipe SET title = :title, description = :description, amount = :amount WHERE idRecipe = :idRecipe");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':idRecipe', $idRecipe);
        $stmt->bindParam(':amount', $amount);
        $stmt->execute();
    }

    // Elimina una ricetta
    public function deleteRecipe($idRecipe) {
        $stmt = $this->pdo->prepare("DELETE FROM recipe WHERE idRecipe = :idRecipe");
        $stmt->bindParam(':idRecipe', $idRecipe);
        $stmt->execute();
    }

    // Collega un ingrediente a una ricetta
    public function linkIngredientToRecipe($amount, $idIngredient, $idRecipe) {
        $stmt = $this->pdo->prepare("INSERT INTO ir (amount, idIngredient, idRecipe) VALUES (:amount, :idIngredient, :idRecipe)");
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':idIngredient', $idIngredient);
        $stmt->bindParam(':idRecipe', $idRecipe);
        $stmt->execute();
    }

    // Aggiungi i passaggi alla ricetta
    public function addStepsToRecipe($idRecipe, $steps) {
        $stepNumber = 1; // Iniziamo da 1
        foreach ($steps as $step) {
            $stmt = $this->pdo->prepare("INSERT INTO step (number, description, idRecipe) VALUES (:number, :description, :idRecipe)");
            $stmt->bindParam(':number', $stepNumber);
            $stmt->bindParam(':description', $step['description']);
            $stmt->bindParam(':idRecipe', $idRecipe);
            $stmt->execute();
            $stepNumber++;
        }
    }

    // Recupera gli ingredienti di una ricetta
    public function getIngredientsByRecipe($idRecipe) {
        $stmt = $this->pdo->prepare("SELECT * FROM ir JOIN ingredient ON ir.idIngredient = ingredient.idIngredient WHERE ir.idRecipe = :idRecipe");
        $stmt->bindParam(':idRecipe', $idRecipe);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Recupera i passaggi di una ricetta
    public function getStepsByRecipe($idRecipe) {
        $stmt = $this->pdo->prepare("SELECT * FROM step WHERE idRecipe = :idRecipe ORDER BY number");
        $stmt->bindParam(':idRecipe', $idRecipe);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
