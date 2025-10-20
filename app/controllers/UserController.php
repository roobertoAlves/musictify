<?php
require_once '../includes/db.php';
require_once '../factory/UserFactory.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = UserFactory::create($_POST['nome'], $_POST['email'], $_POST['senha']);
    global $conn;
    $nome = $conn->real_escape_string($user['nome']);
    $email = $conn->real_escape_string($user['email']);
    $senha = password_hash($user['senha'], PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
    if ($conn->query($sql)) {
        header('Location: ../views/register.php?success=1');
        exit;
    } else {
        header('Location: ../views/register.php?error=1');
        exit;
    }
}
?>
