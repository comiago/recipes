<?php

class Step {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Aggiungi un singolo passaggio
    public function addStep($stepNumber, $description, $idRecipe) {
        $stmt = $this->pdo->prepare("INSERT INTO step (number, description, idRecipe) VALUES (:number, :description, :idRecipe)");
        $stmt->bindParam(':number', $stepNumber);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':idRecipe', $idRecipe);
        $stmt->execute();
    }

    // Recupera i passaggi della ricetta, ordinati
    public function getStepsByRecipe($idRecipe) {
        $stmt = $this->pdo->prepare("SELECT * FROM step WHERE idRecipe = :idRecipe ORDER BY number ASC");
        $stmt->bindParam(':idRecipe', $idRecipe);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Elimina tutti i passaggi di una ricetta
    public function deleteStepsByRecipe($idRecipe) {
        $stmt = $this->pdo->prepare("DELETE FROM step WHERE idRecipe = :idRecipe");
        $stmt->bindParam(':idRecipe', $idRecipe);
        $stmt->execute();
    }
}
