<?php

class Role {
  private $pdo;

  public function __construct($pdo) {
      $this->pdo = $pdo;
  }

  public function getAllRoles() {
    $stmt = $this->pdo->prepare("SELECT * FROM role");
    $stmt->execute();
    $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($roles)) {
      return false; // Nessuna ricetta trovata
    }

    return $roles;
  }

}

?>