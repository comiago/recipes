<?php
session_start();
include('../models/Database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = trim($_POST['username']);
    $password = $_POST['password'];

    // Verifica che i campi non siano vuoti
    if (empty($input) || empty($password)) {
        $_SESSION['error'] = 'Entrambi i campi (Username/Email e Password) sono obbligatori.';
        header('Location: ../../public/login.php');
        exit;
    }

    $db = new Database();
    $conn = $db->connect();

    // Cerca utente tramite username o email
    $stmt = $conn->prepare("SELECT * FROM user WHERE username = :input OR email = :input");
    $stmt->bindParam(':input', $input);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica la password
    if ($user && password_verify($password, $user['password']) && !is_null($user['approvatedBy'])) {
        $_SESSION['user_id'] = $user['idUser'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['idRole'];
        header('Location: ../../public/dashboard.php');
        exit;
    } else if (is_null($user['approvatedBy'])) {
        $_SESSION['error'] = 'Il tuo account non è ancora stato approvato. Contatta l\'amministratore.';
        header('Location: ../../public/login.php');
        exit;
    } 
    else {
        $_SESSION['error'] = 'Il nome utente/email o la password non sono corretti. Riprova.';
        header('Location: ../../public/login.php');
        exit;
    }
}
?>
