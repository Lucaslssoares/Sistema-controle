<?php
include 'db.php';

// Recupera os treinamentos com as informações dos funcionários
$stmt = $pdo->query("SELECT t.id, t.nome_treinamento, t.data_conclusao, t.data_validade, f.nome AS funcionario_nome 
                     FROM treinamentos t
                     JOIN funcionarios f ON t.funcionario_id = f.id
                     ORDER BY t.data_conclusao DESC");

$treinamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Se a exclusão for solicitada
if (isset($_GET['excluir_id'])) {
    $id_treinamento = $_GET['excluir_id'];

    // Exclui o treinamento do banco de dados
    $stmt_delete = $pdo->prepare("DELETE FROM treinamentos WHERE id = ?");
    if ($stmt_delete->execute([$id_treinamento])) {
        echo "<script>alert('Treinamento excluído com sucesso.');</script>";
        header("Location: visualizar_treinamentos.php"); // Redireciona após a exclusão
        exit;
    } else {
        echo "<script>alert('Erro ao excluir o treinamento.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Treinamentos</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">
        <img src="img/microdata.png" alt="Logo" width="50" height="45" class="d-inline-block align-top">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(atual)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="visualizar_treinamentos.php">Visualizar Treinamentos</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container my-5">
    <h2>Visualizar Treinamentos</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome do Funcionário</th>
                <th>Treinamento</th>
                <th>Data de Conclusão</th>
                <th>Data de Validade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($treinamentos as $treinamento): ?>
                <tr>
                    <td><?php echo $treinamento['funcionario_nome']; ?></td>
                    <td><?php echo $treinamento['nome_treinamento']; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($treinamento['data_conclusao'])); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($treinamento['data_validade'])); ?></td>
                    <td>
                        <a href="editar_treinamento.php?id=<?php echo $treinamento['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="?excluir_id=<?php echo $treinamento['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
