<?php

class User {
  private $pdo;

  public function __construct($pdo) {
    $this->pdo = $pdo;
  }

  // Registra un nuovo utente
  public function register($username, $email, $password) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $this->pdo->prepare("INSERT INTO user (username, email, password) VALUES (?, ?, ?)");
    return $stmt->execute([$username, $email, $hashedPassword]);
  }

  // Login utente
  public function login($usernameOrEmail, $password) {
    $stmt = $this->pdo->prepare("SELECT * FROM user WHERE username = ? OR email = ?");
    $stmt->execute([$usernameOrEmail, $usernameOrEmail]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
      return $user;
    }

    return false;
  }

  // Ottieni utente
  public function getUserById($id) {
    $stmt = $this->pdo->prepare("SELECT * FROM user WHERE idUser = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
  }

  // Aggiorna utente
  public function updateUser($id, $username, $email) {
    $stmt = $this->pdo->prepare("UPDATE user SET username = ?, email = ? WHERE idUser = ?");
    return $stmt->execute([$username, $email, $id]);
  }

  // Elimina utente
  public function deleteUser($id) {
    $stmt = $this->pdo->prepare("DELETE FROM user WHERE idUser = ?");
    return $stmt->execute([$id]);
  }

  // Controlla se l'email è già registrata
  public function isEmailRegistered($email) {
    $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM user WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetchColumn() > 0;
  }

  // Controlla se il nome utente è già registrato
  public function isUsernameRegistered($username) {
    $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM user WHERE username = ?");
    $stmt->execute([$username]);
    return $stmt->fetchColumn() > 0;
  }
}