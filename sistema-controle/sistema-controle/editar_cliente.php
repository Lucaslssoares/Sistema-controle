<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilo.css">
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
    <h2 class="text-center">Editar Cliente</h2>
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM clientes WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    ?>

    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $cliente['id']; ?>">
        
        <!-- Campo Nome do Cliente -->
        <div class="form-group">
            <label for="nomeCliente">Nome do Cliente</label>
            <input type="text" class="form-control" name="nomeCliente" value="<?php echo $cliente['nome_cliente']; ?>" required>
        </div>

        <div class="form-group">
            <label for="codigoRep">Código do Rep</label>
            <input type="text" class="form-control" name="codigoRep" value="<?php echo $cliente['codigo_rep']; ?>" required>
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <input type="text" class="form-control" name="descricao" value="<?php echo $cliente['descricao']; ?>">
        </div>
        <div class="form-group">
            <label for="serieRep">Série Rep</label>
            <input type="text" class="form-control" name="serieRep" value="<?php echo $cliente['serie_rep']; ?>">
        </div>
        <div class="form-group">
            <label for="indelevelRep">Indelével Rep</label>
            <input type="text" class="form-control" name="indelevelRep" value="<?php echo $cliente['indelevel_rep']; ?>">
        </div>
        <div class="form-group">
            <label for="numeroRegistro">Número de Registro</label>
            <input type="text" class="form-control" name="numeroRegistro" value="<?php echo $cliente['numero_registro']; ?>">
        </div>
        <div class="form-group">
            <label for="numeroChamado">Número do Chamado</label>
            <input type="text" class="form-control" name="numeroChamado" value="<?php echo $cliente['numero_chamado']; ?>">
        </div>
        <div class="form-group">
            <label for="valorOrcamento">Valor do Orçamento</label>
            <input type="number" class="form-control" name="valorOrcamento" value="<?php echo $cliente['valor_orcamento']; ?>" step="0.01">
        </div>
        <div class="form-group">
            <label for="notaEnvio">Nota Fiscal de Envio</label>
            <input type="text" class="form-control" name="notaEnvio" value="<?php echo $cliente['nota_envio']; ?>">
        </div>
        <div class="form-group">
            <label for="valorFrete">Valor do Frete</label>
            <input type="number" class="form-control" name="valorFrete" value="<?php echo $cliente['valor_frete']; ?>" step="0.01">
        </div>
        <div class="form-group">
            <label for="notaRecebimento">Nota Fiscal de Recebimento</label>
            <input type="text" class="form-control" name="notaRecebimento" value="<?php echo $cliente['nota_recebimento']; ?>">
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" class="form-control" name="status" value="<?php echo $cliente['status']; ?>">
        </div>
        <button type="submit" class="btn btn-warning">Salvar Alterações</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $nomeCliente = $_POST['nomeCliente']; 
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

        // Atualizando o campo nome_cliente na consulta SQL
        $sql = "UPDATE clientes SET nome_cliente=?, codigo_rep=?, descricao=?, serie_rep=?, indelevel_rep=?, numero_registro=?, numero_chamado=?, valor_orcamento=?, nota_envio=?, valor_frete=?, nota_recebimento=?, status=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        
        if ($stmt->execute([$nomeCliente, $codigoRep, $descricao, $serieRep, $indelevelRep, $numeroRegistro, $numeroChamado, $valorOrcamento, $notaEnvio, $valorFrete, $notaRecebimento, $status, $id])) {
            echo "<p class='text-success mt-3'>Cliente atualizado com sucesso!</p>";
        } else {
            echo "<p class='text-danger mt-3'>Erro ao atualizar cliente.</p>";
        }
    }
    ?>
</div>




<!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>