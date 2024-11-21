<?php
include 'db.php'; // Inclui a conexão com o banco de dados

// Verifica se o ID foi passado
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Exclui o funcionário
    $stmt = $pdo->prepare("DELETE FROM funcionarios WHERE id = ?");
    $stmt->execute([$id]);

    // Redireciona de volta para a tela de visualização
    header("Location: visualizar_funcionarios.php");
    exit;
} else {
    die('ID do funcionário não especificado.');
}
