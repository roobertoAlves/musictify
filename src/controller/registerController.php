<?php
require_once '../factory/Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if ($nome && $email && $senha) {
        $db = new Database();
        $stmt = $db->pdo->prepare('INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)');
        $stmt->execute([$nome, $email, password_hash($senha, PASSWORD_DEFAULT)]);
        header('Location: ../view/home.php?cadastro=sucesso');
        exit;
    } else {
        header('Location: ../view/home.php?cadastro=erro');
        exit;
    }
}
