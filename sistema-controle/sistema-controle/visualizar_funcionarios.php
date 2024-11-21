<?php
include 'db.php'; // Inclui a conexão com o banco de dados

// Consulta para obter todos os funcionários cadastrados
$stmt = $pdo->prepare("SELECT * FROM funcionarios");
$stmt->execute();
$funcionarios = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionários Cadastrados</title>
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
            <li class="nav-item active">
                <a class="nav-link" href="visualizar_funcionarios.php">Funcionarios <span class="sr-only">(atual)</span></a>
            </li>
        </ul>
    </div>
</nav>

<div class="container my-5">
    <h2>Funcionários Cadastrados</h2>
    
    <!-- Tabela de Funcionários -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Data de Nascimento</th>
                <th>Telefone</th>
                <th>Cargo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($funcionarios as $funcionario): ?>
                <tr>
                    <td><?php echo htmlspecialchars($funcionario['nome']); ?></td>
                    <td><?php echo htmlspecialchars($funcionario['data_nascimento']); ?></td>
                    <td><?php echo htmlspecialchars($funcionario['contato']); ?></td>
                    <td><?php echo htmlspecialchars($funcionario['cargo']); ?></td>
                    <td>
                        <!-- Botões de ação -->
                        <a href="editar_funcionario.php?id=<?php echo $funcionario['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="excluir_funcionario.php?id=<?php echo $funcionario['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este funcionário?');">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
