<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_cliente = $_POST['nome_cliente'];
    $codigoRep = $_POST['codigoRep'];
    $descricao = $_POST['descricao'];
    $serieRep = $_POST['serieRep'];
    $indelevelRep = $_POST['indelevelRep'];
    $numeroRegistro = $_POST['numeroRegistro'];
    $numeroChamado = $_POST['numeroChamado'];
    $valorOrcamento = $_POST['valorOrcamento'];
    $notaEnvio = $_POST['notaEnvio'];
    $valorFrete = $_POST['valorFrete'];
    $notaRecebimento = $_POST['notaRecebimento'];
    $status = $_POST['status'];

    $stmt = $pdo->prepare("INSERT INTO clientes (nome_cliente, codigo_rep, descricao, serie_rep, indelevel_rep, numero_registro, numero_chamado, valor_orcamento, nota_envio, valor_frete, nota_recebimento, status) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$nome_cliente, $codigoRep, $descricao, $serieRep, $indelevelRep, $numeroRegistro, $numeroChamado, $valorOrcamento, $notaEnvio, $valorFrete, $notaRecebimento, $status]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Cliente</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="css\cliente.css" rel="stylesheet">
   
</head>
<body>

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

<div class="container mt-5">
    <h2 class="text-center">Cadastrar Cliente</h2>
    <form method="POST">
        <div class="form-group">
            <label for="nome_cliente">Nome cliente</label>
            <input type="text" class="form-control" id="nome_cliente" name="nome_cliente" required>
        </div>
        <div class="form-group">
            <label for="codigoRep">Código do Rep</label>
            <input type="text" class="form-control" id="codigoRep" name="codigoRep" required>
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <input type="text" class="form-control" id="descricao" name="descricao" required>
        </div>
        <div class="form-group">
            <label for="serieRep">Série Rep</label>
            <input type="text" class="form-control" id="serieRep" name="serieRep" required>
        </div>
        <div class="form-group">
            <label for="indelevelRep">Indelével Rep</label>
            <input type="text" class="form-control" id="indelevelRep" name="indelevelRep" required>
        </div>
        <div class="form-group">
            <label for="numeroRegistro">Número de Registro</label>
            <input type="text" class="form-control" id="numeroRegistro" name="numeroRegistro" required>
        </div>
        <div class="form-group">
            <label for="numeroChamado">Número do Chamado</label>
            <input type="text" class="form-control" id="numeroChamado" name="numeroChamado" required>
        </div>
        <div class="form-group">
            <label for="valorOrcamento">Valor do Orçamento</label>
            <input type="number" class="form-control" id="valorOrcamento" name="valorOrcamento" step="0.01" inputmode="decimal" required>
        </div>
        <div class="form-group">
            <label for="notaEnvio">Nota Fiscal de Envio</label>
            <input type="text" class="form-control" id="notaEnvio" name="notaEnvio" required>
        </div>
        <div class="form-group">
            <label for="valorFrete">Valor do Frete</label>
            <input type="number" class="form-control" id="valorFrete" name="valorFrete" step="0.01" inputmode="decimal" required>
        </div>
        <div class="form-group">
            <label for="notaRecebimento">Nota Fiscal de Recebimento</label>
            <input type="text" class="form-control" id="notaRecebimento" name="notaRecebimento" required>
        </div>
        <div class="form-group">
            <label for="notaRecebimento">Status</label>
            <input type="text" class="form-control" id="status" name="status" required>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar Cliente</button>
    </form>
</div>

<script>
    function atualizarCor() {
        const select = document.getElementById("status");
        const option = select.options[select.selectedIndex];
        select.className = "form-control " + option.className;
    }

    document.addEventListener("DOMContentLoaded", atualizarCor);
</script>




<!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>