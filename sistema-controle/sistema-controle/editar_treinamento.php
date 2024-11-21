<?php
include 'db.php';

// Verifica se o ID foi passado
if (!isset($_GET['id'])) {
    header("Location: visualizar_treinamentos.php");
    exit;
}

$id_treinamento = $_GET['id'];

// Recupera os dados do treinamento
$stmt = $pdo->prepare("SELECT * FROM treinamentos WHERE id = ?");
$stmt->execute([$id_treinamento]);
$treinamento = $stmt->fetch(PDO::FETCH_ASSOC);

// Verifica se o treinamento foi encontrado
if (!$treinamento) {
    echo "<script>alert('Treinamento não encontrado.');</script>";
    header("Location: visualizar_treinamentos.php");
    exit;
}

// Atualiza o treinamento
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se todos os campos foram enviados
    if (isset($_POST['nome_treinamento'], $_POST['data_conclusao'], $_POST['data_validade'])) {
        $nome_treinamento = $_POST['nome_treinamento'];
        $data_conclusao = $_POST['data_conclusao'];
        $data_validade = $_POST['data_validade'];

        // Verifica se a data de validade é posterior à data de conclusão
        if (strtotime($data_validade) <= strtotime($data_conclusao)) {
            echo "<script>alert('A data de validade deve ser posterior à data de conclusão.');</script>";
        } else {
            // Atualiza o treinamento no banco de dados
            $stmt_update = $pdo->prepare("UPDATE treinamentos SET nome_treinamento = ?, data_conclusao = ?, data_validade = ? WHERE id = ?");
            if ($stmt_update->execute([$nome_treinamento, $data_conclusao, $data_validade, $id_treinamento])) {
                header("Location: visualizar_treinamentos.php");
                exit;
            } else {
                echo "<script>alert('Erro ao atualizar treinamento.');</script>";
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
    <title>Editar Treinamento</title>
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
    <h2>Editar Treinamento</h2>
    <form method="POST">
        <div class="form-group">
            <label for="nome_treinamento">Nome do Treinamento</label>
            <input type="text" class="form-control" id="nome_treinamento" name="nome_treinamento" value="<?php echo $treinamento['nome_treinamento']; ?>" required>
        </div>
        <div class="form-group">
            <label for="data_conclusao">Data de Conclusão</label>
            <input type="date" class="form-control" id="data_conclusao" name="data_conclusao" value="<?php echo $treinamento['data_conclusao']; ?>" required>
        </div>
        <div class="form-group">
            <label for="data_validade">Data de Validade</label>
            <input type="date" class="form-control" id="data_validade" name="data_validade" value="<?php echo $treinamento['data_validade']; ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Salvar Alterações</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
