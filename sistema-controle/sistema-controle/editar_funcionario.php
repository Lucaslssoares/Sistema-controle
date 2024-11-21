<?php
include 'db.php'; // Inclui a conexão com o banco de dados

// Verifica se o ID foi passado
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Recupera os dados do funcionário
    $stmt = $pdo->prepare("SELECT * FROM funcionarios WHERE id = ?");
    $stmt->execute([$id]);
    $funcionario = $stmt->fetch();

    if (!$funcionario) {
        die('Funcionário não encontrado.');
    }
} else {
    die('ID do funcionário não especificado.');
}

// Processa a atualização do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $data_nascimento = $_POST['data_nascimento'];
    $contato = $_POST['contato'];
    $cargo = $_POST['cargo'];

    // Atualiza os dados do funcionário
    $stmt = $pdo->prepare("UPDATE funcionarios SET nome = ?, data_nascimento = ?, contato = ?, cargo = ? WHERE id = ?");
    $stmt->execute([$nome, $data_nascimento, $contato, $cargo, $id]);

    header("Location: visualizar_funcionarios.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Funcionário</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container my-5">
    <h2>Editar Funcionário</h2>
    
    <form method="POST">
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($funcionario['nome']); ?>" required>
        </div>
        <div class="form-group">
            <label for="data_nascimento">Data de Nascimento</label>
            <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" value="<?php echo htmlspecialchars($funcionario['data_nascimento']); ?>" required>
        </div>
        <div class="form-group">
            <label for="contato">Telefone</label>
            <input type="text" class="form-control" id="contato" name="contato" value="<?php echo htmlspecialchars($funcionario['contato']); ?>" required>
        </div>
        <div class="form-group">
            <label for="cargo">Cargo</label>
            <input type="text" class="form-control" id="cargo" name="cargo" value="<?php echo htmlspecialchars($funcionario['cargo']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>

<!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
