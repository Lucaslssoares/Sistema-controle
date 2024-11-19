<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare e execute a exclusão
    $stmt = $pdo->prepare("DELETE FROM clientes WHERE id = ?");
    if ($stmt->execute([$id])) {
        echo "<script>alert('Cliente excluído com sucesso!'); window.location.href = 'relatorio_clientes.php';</script>";
    } else {
        echo "<script>alert('Erro ao excluir o cliente.'); window.location.href = 'relatorio_clientes.php';</script>";
    }
} else {
    header("Location: relatorio_clientes.php");
    exit;
}
?>