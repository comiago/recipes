<?php
session_start();
include('../models/Database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $role = trim($_POST['role']);

    echo $role;

    // Verifica che tutti i campi siano stati riempiti
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password) || empty($firstName) || empty($lastName) || empty($role)) {
        $_SESSION['error'] = 'Tutti i campi sono obbligatori.';
        header('Location: ../../public/register.php');
        exit;
    }

    // Controlla se le password corrispondono
    if ($password !== $confirm_password) {
        $_SESSION['error'] = 'Le password non corrispondono. Assicurati che le due password siano identiche.';
        header('Location: ../../public/register.php');
        exit;
    }

    // Verifica se l'username o l'email esistono già
    $db = new Database();
    $conn = $db->connect();
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = :email OR username = :username");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingUser) {
        $_SESSION['error'] = 'L\'email o l\'username sono già in uso. Scegline uno diverso.';
        header('Location: ../../public/register.php');
        exit;
    }

    // Hash della password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Inserisci il nuovo utente nel database
    $stmt = $conn->prepare("INSERT INTO user (username, email, password, firstName, lastName, idROle) VALUES (:username, :email, :password, :firstName, :lastName, :role)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashed_password);
    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':role', $role);
    $stmt->execute();

    $_SESSION['success'] = 'Registrazione avvenuta con successo!';
    header('Location: ../../public/login.php');
    exit;
}
?>
