<?php
include 'db.php';

// Captura a lista de funcionários para o dropdown
$stmt_funcionarios = $pdo->query("SELECT id, nome FROM funcionarios");
$funcionarios = $stmt_funcionarios->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $funcionario_id = $_POST['funcionario_id'];
    $tipo_vacina = $_POST['tipo_vacina'];
    $data_vacinacao = $_POST['data_vacinacao'];
    $data_validade = $_POST['data_validade'];

    $stmt = $pdo->prepare("INSERT INTO vacinas (funcionario_id, tipo_vacina, data_vacinacao, data_validade) VALUES (?, ?, ?, ?)");

    if ($stmt->execute([$funcionario_id, $tipo_vacina, $data_vacinacao, $data_validade])) {
        header("Location: index.php");
        exit;
    } else {
        echo "<script>alert('Erro ao cadastrar vacina.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Vacina</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
                <a class="nav-link" href="cadastrar_vacina.php">Vacina</a>
            </li>
            
        </ul>
    </div>
</nav>

    <div class="container my-5">
        <h2>Cadastrar Vacina</h2>
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
                <label for="tipo_vacina">Tipo de Vacina</label>
                <input type="text" class="form-control" id="tipo_vacina" name="tipo_vacina" required>
            </div>
            <div class="form-group">
                <label for="data_vacinacao">Data de Vacinação</label>
                <input type="date" class="form-control" id="data_vacinacao" name="data_vacinacao" required>
            </div>
            <div class="form-group">
                <label for="data_validade">Data de Validade</label>
                <input type="date" class="form-control" id="data_validade" name="data_validade" required>
            </div>
            <button type="submit" class="btn btn-info">Registrar Vacinação</button>
        </form>
    </div>


    <!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>