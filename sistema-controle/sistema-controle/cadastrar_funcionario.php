<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $data_nascimento = $_POST['data_nascimento'];
    $contato = $_POST['contato'];
    $cargo = $_POST['cargo'];

    $stmt = $pdo->prepare("INSERT INTO funcionarios (nome, data_nascimento, contato, cargo) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nome, $data_nascimento, $contato, $cargo]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Funcionário</title>
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
                <a class="nav-link" href="cadastrar_funcionario.php">Cadastrar funcionário</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cadastrar_treinamento.php">Cadastrar treinamento</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cadastrar_vacina.php">Cadastrar vacina</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cadastro_cliente.php">Cadastrar cliente</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="relatorio_clientes.php">Relatório</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="avisos.php">Avisos</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container my-5">
    <h2>Cadastrar Funcionário</h2>
    <form method="POST">
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="form-group">
            <label for="data_nascimento">Data de Nascimento</label>
            <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
        </div>
        <div class="form-group">
            <label for="contato">Contato</label>
            <input type="text" class="form-control" id="contato" name="contato" required>
        </div>
        <div class="form-group">
            <label for="cargo">Cargo</label>
            <input type="text" class="form-control" id="cargo" name="cargo" required>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
</div>

<!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>