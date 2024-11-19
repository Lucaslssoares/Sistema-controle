<?php
include 'db.php';

// seleciona a lista de funcionários 
$stmt_funcionarios = $pdo->query("SELECT id, nome FROM funcionarios");
$funcionarios = $stmt_funcionarios->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se todos os campos foram enviados
    if (isset($_POST['funcionario_id'], $_POST['nome_treinamento'], $_POST['data_conclusao'], $_POST['data_validade'])) {
        $funcionario_id = $_POST['funcionario_id'];
        $nome_treinamento = $_POST['nome_treinamento'];
        $data_conclusao = $_POST['data_conclusao'];
        $data_validade = $_POST['data_validade'];

        // Verifica se a data de validade é posterior à data de conclusão
        if (strtotime($data_validade) <= strtotime($data_conclusao)) {
            echo "<script>alert('A data de validade deve ser posterior à data de conclusão.');</script>";
        } else {
            // Insere o treinamento no banco de dados
            $stmt = $pdo->prepare("INSERT INTO treinamentos (funcionario_id, nome_treinamento, data_conclusao, data_validade) VALUES (?, ?, ?, ?)");
            if ($stmt->execute([$funcionario_id, $nome_treinamento, $data_conclusao, $data_validade])) {
                header("Location: index.php");
                exit;
            } else {
                echo "<script>alert('Erro ao cadastrar treinamento: " . $stmt->errorInfo()[2] . "');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Treinamento</title>
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
        <h2>Cadastrar Treinamento</h2>
        <form method="POST">
            <div class="form-group">
                <label for="funcionario_id">Nome do Colaborador</label>
                <select class="form-control" id="funcionario_id" name="funcionario_id" required>
                    <option value="" disabled selected>Selecione o colaborador</option>
                    <?php foreach ($funcionarios as $funcionario): ?>
                        <option value="<?php echo $funcionario['id']; ?>"><?php echo $funcionario['nome']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="nome_treinamento">Nome do Treinamento</label>
                <input type="text" class="form-control" id="nome_treinamento" name="nome_treinamento" required>
            </div>
            <div class="form-group">
                <label for="data_conclusao">Data de Conclusão</label>
                <input type="date" class="form-control" id="data_conclusao" name="data_conclusao" required>
            </div>
            <div class="form-group">
                <label for="data_validade">Data de Validade</label>
                <input type="date" class="form-control" id="data_validade" name="data_validade" required>
            </div>
            <button type="submit" class="btn btn-success">Cadastrar</button>
        </form>
    </div>


<!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>