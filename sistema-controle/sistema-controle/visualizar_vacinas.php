<?php
include 'db.php';

// Recupera a lista de vacinas com informações dos funcionários
$stmt_vacinas = $pdo->query("SELECT v.id, v.tipo_vacina, v.data_vacinacao, v.data_validade, f.nome AS funcionario_nome 
                             FROM vacinas v
                             JOIN funcionarios f ON v.funcionario_id = f.id
                             ORDER BY v.data_vacinacao DESC");
$vacinas = $stmt_vacinas->fetchAll(PDO::FETCH_ASSOC);

// Se a exclusão for solicitada
if (isset($_GET['excluir_id'])) {
    $id_vacina = $_GET['excluir_id'];

    // Exclui a vacina do banco de dados
    $stmt_delete = $pdo->prepare("DELETE FROM vacinas WHERE id = ?");
    if ($stmt_delete->execute([$id_vacina])) {
        echo "<script>alert('Vacina excluída com sucesso.');</script>";
        header("Location: visualizar_vacinas.php"); // Redireciona após a exclusão
        exit;
    } else {
        echo "<script>alert('Erro ao excluir a vacina.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Vacinas</title>
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
                <a class="nav-link" href="index.php">Home </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="visualizar_vacinas.php">Visualizar Vacinas <span class="sr-only">(atual)</span></a>
            </li>
            <!-- Adicione outros itens de menu conforme necessário -->
        </ul>
    </div>
</nav>

<div class="container my-5">
    <h2>Visualizar Vacinas de Funcionários</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome do Funcionário</th>
                <th>Tipo de Vacina</th>
                <th>Data de Vacinação</th>
                <th>Data de Validade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vacinas as $vacina): ?>
                <tr>
                    <td><?php echo $vacina['funcionario_nome']; ?></td>
                    <td><?php echo $vacina['tipo_vacina']; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($vacina['data_vacinacao'])); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($vacina['data_validade'])); ?></td>
                    <td>
                        <!-- Botões para editar e excluir -->
                        <a href="editar_vacinas.php?id=<?php echo $vacina['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="?excluir_id=<?php echo $vacina['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir esta vacina?')">Excluir</a>
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
