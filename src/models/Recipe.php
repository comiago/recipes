<?php

class Recipe {
  private $pdo;

  public function __construct($pdo) {
      $this->pdo = $pdo;
  }

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

}

?>