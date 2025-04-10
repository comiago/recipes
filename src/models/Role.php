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
      return false; // Nessuna ruolo trovata
    }

    return $roles;
  }

  public function getRoleById($id) {
    $stmt = $this->pdo->prepare("SELECT * FROM role WHERE idRole = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $role = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$role) {
      return false; // Ruolo non trovato
    }

    return $role;
  }

}

?>