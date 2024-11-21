<?php
include 'db.php'; // Inclui a conexão com o banco de dados

// Função de validação de telefone (formato brasileiro)
function validarTelefone($telefone) {
    $padrao = "/^\(?\d{2}\)?\s?\d{4,5}-\d{4}$/";
    if (preg_match($padrao, $telefone)) {
        return true;
    }
    return false;
}

function sanitizarTelefone($telefone) {
    return preg_replace("/[^0-9]/", "", $telefone);
}

// Processamento do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $data_nascimento = $_POST['data_nascimento'];
    $contato = $_POST['contato'];
    $cargo = $_POST['cargo'];

    // Sanitizar e validar telefone
    $contato_sanitizado = sanitizarTelefone($contato);
    if (!validarTelefone($contato)) {
        $erro = "Erro: O número de telefone fornecido é inválido. Use o formato (XX) XXXX-XXXX ou (XX) XXXXX-XXXX.";
    } else {
        // Aqui a conexão com o banco de dados deve estar funcionando corretamente
        $stmt = $pdo->prepare("INSERT INTO funcionarios (nome, data_nascimento, contato, cargo) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nome, $data_nascimento, $contato_sanitizado, $cargo]);

        header("Location: index.php");
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Funcionário</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Incluindo a biblioteca Inputmask -->
    <script src="https://cdn.jsdelivr.net/npm/inputmask/dist/inputmask.min.js"></script>
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
                <a class="nav-link" href="visualizar_funcionarios.php">funcionários</a>
            </li>
           
        </ul>
    </div>
</nav>

<div class="container my-5">
    <h2>Cadastrar Funcionário</h2>
    
    <!-- Exibir erro se houver algum -->
    <?php if (isset($erro)): ?>
        <div class="alert alert-danger">
            <?php echo $erro; ?>
        </div>
    <?php endif; ?>
    
    <!-- Formulário de cadastro -->
    <form method="POST">
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="data_nascimento">Data de Nascimento</label>
            <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
        </div>
        <div class="form-group">
            <label for="contato">Telefone</label>
            <input type="text" class="form-control" id="contato" name="contato" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="cargo">Cargo</label>
            <input type="text" class="form-control" id="cargo" name="cargo" autocomplete="off" required>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
</div>

<!-- Bootstrap JS, Popper.js, and jQuery, diretorio para scprit -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="js/cadastrar_funcionario.js"></script>

</body>
</html>
