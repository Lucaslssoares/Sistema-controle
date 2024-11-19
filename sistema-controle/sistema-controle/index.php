<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Controle de Funcionários</title>
    <!-- Bootstrap CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css\index.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">
        <img src="img/microdata.png" alt="Logo" width="50" height="45" class="d-inline-block align-top">
        Sistema de Controle
    </a>
</nav>

    <div class="container my-5">
        <h1 class="text-center mb-4">Sistema de Controle </h1>

        <div class="text-center mb-4">
            <a href="cadastrar_funcionario.php" class="btn btn-primary">Cadastrar Funcionário</a>
            <a href="cadastrar_treinamento.php" class="btn btn-success">Cadastrar Treinamento</a>
            <a href="cadastrar_vacina.php" class="btn btn-info">Registrar Vacinação</a>
            <a href="cadastro_cliente.php" class="btn btn-secondary">Cadastrar cliente</a>
            <a href="relatorio_clientes.php" class="btn btn-secondary">Relatório</a>
            <a href="avisos.php" class="btn btn-warning">Ver Avisos</a>
        </div>
    </div>

    <!-- Bootstrap JS e dependências -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>