<?php
include 'db.php';

// Função para obter aniversariantes do mês atual
function obterAniversarios($pdo) {
    $aniversarios = [];
    $mes_atual = date('m');
    $stmt = $pdo->prepare("SELECT nome, data_nascimento FROM funcionarios WHERE MONTH(data_nascimento) = ?");
    $stmt->execute([$mes_atual]);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data_aniversario = date('d/m', strtotime($row['data_nascimento']));
        $aniversarios[] = [
            'tipo' => 'Aniversário',
            'mensagem' => "Aniversário de {$row['nome']} em $data_aniversario"
        ];
    }
    return $aniversarios;
}

// Função para verificar se a data está dentro dos próximos 31 dias
function dentroDosProximos31Dias($data) {
    $data_atual = strtotime("today"); // Data de hoje
    $data_vencimento = strtotime($data); // Data de vencimento
    $diferenca_dias = ($data_vencimento - $data_atual) / (60 * 60 * 24); // Diferença em dias
    return $diferenca_dias >= 0 && $diferenca_dias <= 31; // Verifica se a diferença está entre 0 e 31 dias
}

// Função para obter vencimentos de vacinas dentro dos próximos 31 dias
function obterVencimentoVacinas($pdo) {
    $vencimentosVacinas = [];
    $stmt = $pdo->prepare("SELECT f.nome AS nome_colaborador, v.data_validade FROM vacinas v JOIN funcionarios f ON v.funcionario_id = f.id");
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data_vencimento = $row['data_validade'];

        // Verifica se o vencimento está dentro dos próximos 31 dias
        if (dentroDosProximos31Dias($data_vencimento)) {
            $vencimentosVacinas[] = [
                'tipo' => 'Vacina',
                'mensagem' => "Vacina de {$row['nome_colaborador']} vence em " . date('d/m/Y', strtotime($data_vencimento))
            ];
        }
    }
    return $vencimentosVacinas;
}

// Função para obter vencimentos de treinamentos dentro dos próximos 31 dias
function obterVencimentoTreinamentos($pdo) {
    $vencimentosTreinamentos = [];
    $stmt = $pdo->prepare("SELECT f.nome AS nome_colaborador, t.data_validade FROM treinamentos t JOIN funcionarios f ON t.funcionario_id = f.id");
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data_vencimento = $row['data_validade'];

        // Verifica se o vencimento está dentro dos próximos 31 dias
        if (dentroDosProximos31Dias($data_vencimento)) {
            $vencimentosTreinamentos[] = [
                'tipo' => 'Treinamento',
                'mensagem' => "Treinamento de {$row['nome_colaborador']} vence em " . date('d/m/Y', strtotime($data_vencimento))
            ];
        }
    }
    return $vencimentosTreinamentos;
}

// Função principal para agregar todos os avisos
function obterAvisos($pdo) {
    $avisos = array_merge(
        obterAniversarios($pdo),
        obterVencimentoVacinas($pdo),
        obterVencimentoTreinamentos($pdo)
    );
    return $avisos;
}

try {
    $avisos = obterAvisos($pdo);
} catch (Exception $e) {
    $avisos = [["tipo" => "Erro", "mensagem" => "Erro ao carregar avisos: " . $e->getMessage()]];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avisos</title>
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
                <a class="nav-link" href="cadastrar_funcionario.php">Cadastrar funcionário</a>
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
        <h2>Avisos</h2>
        <ul class="list-group">
            <?php foreach ($avisos as $aviso): ?>
                <li class="list-group-item">
                    <strong><?php echo $aviso['tipo']; ?>:</strong> <?php echo $aviso['mensagem']; ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <a href="index.php" class="btn btn-secondary mt-3">Voltar</a>
    </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
