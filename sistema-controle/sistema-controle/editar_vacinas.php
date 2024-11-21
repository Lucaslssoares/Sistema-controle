<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM vacinas WHERE id = ?");
    $stmt->execute([$id]);
    $vacina = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo_vacina = $_POST['tipo_vacina'];
    $data_vacinacao = $_POST['data_vacinacao'];
    $data_validade = $_POST['data_validade'];

    $stmt_update = $pdo->prepare("UPDATE vacinas SET tipo_vacina = ?, data_vacinacao = ?, data_validade = ? WHERE id = ?");
    if ($stmt_update->execute([$tipo_vacina, $data_vacinacao, $data_validade, $id])) {
        header("Location: visualizar_vacinas.php");
        exit;
    } else {
        echo "<script>alert('Erro ao editar vacina.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Vacina</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h2>Editar Vacina</h2>
    <form method="POST">
        <div class="form-group">
            <label for="tipo_vacina">Tipo de Vacina</label>
            <input type="text" class="form-control" id="tipo_vacina" name="tipo_vacina" value="<?php echo $vacina['tipo_vacina']; ?>" required>
        </div>
        <div class="form-group">
            <label for="data_vacinacao">Data de Vacinação</label>
            <input type="date" class="form-control" id="data_vacinacao" name="data_vacinacao" value="<?php echo $vacina['data_vacinacao']; ?>" required>
        </div>
        <div class="form-group">
            <label for="data_validade">Data de Validade</label>
            <input type="date" class="form-control" id="data_validade" name="data_validade" value="<?php echo $vacina['data_validade']; ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Salvar Alterações</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
