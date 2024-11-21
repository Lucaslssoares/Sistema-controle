<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Controle de Funcionários</title>
    
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">
        <img src="img/microdata.png" alt="Logo" width="50" height="45" class="d-inline-block align-top">
        Sistema de Controle
    </a>
</nav>

<!-- Botões de navegação -->
<div class="container my-5">
    <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
        <a href="visualizar_funcionarios.php" class="btn btn-primary w-100 w-sm-auto">Funcionários</a>
        <a href="visualizar_treinamentos.php" class="btn btn-success w-100 w-sm-auto">Treinamentos</a>
        <a href="relatorio_clientes.php" class="btn btn-info w-100 w-sm-auto">Relatório Clientes</a>
        <a href="visualizar_vacinas.php" class="btn btn-warning w-100 w-sm-auto">vacinas</a>
    </div>
</div>

<!-- Bootstrap 5 JS e dependências -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
