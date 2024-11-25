<?php
include 'db.php';

// Função para obter aniversariantes do mês
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

// Função para obter vencimentos de vacinas dentro de 31 dias
function obterVencimentoVacinas($pdo) {
    $vencimentosVacinas = [];
    $data_atual = date('Y-m-d'); // Data atual no formato YYYY-MM-DD
    $data_limite = date('Y-m-d', strtotime('+31 days')); // Data limite de 31 dias à frente

    $stmt = $pdo->prepare("
        SELECT f.nome AS nome_colaborador, v.data_validade 
        FROM vacinas v 
        JOIN funcionarios f ON v.funcionario_id = f.id 
        WHERE v.data_validade BETWEEN ? AND ?
    ");
    $stmt->execute([$data_atual, $data_limite]);
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data_vencimento = date('d/m/Y', strtotime($row['data_validade']));
        $vencimentosVacinas[] = [
            'tipo' => 'Vacina',
            'mensagem' => "Vacina de {$row['nome_colaborador']} vence em $data_vencimento"
        ];
    }
    return $vencimentosVacinas;
}

// Função para obter vencimentos de treinamentos dentro de 31 dias
function obterVencimentoTreinamentos($pdo) {
    $vencimentosTreinamentos = [];
    $data_atual = date('Y-m-d'); // Data atual no formato YYYY-MM-DD
    $data_limite = date('Y-m-d', strtotime('+31 days')); // Data limite de 31 dias à frente

    $stmt = $pdo->prepare("
        SELECT f.nome AS nome_colaborador, t.data_validade 
        FROM treinamentos t 
        JOIN funcionarios f ON t.funcionario_id = f.id 
        WHERE t.data_validade BETWEEN ? AND ?
    ");
    $stmt->execute([$data_atual, $data_limite]);

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data_vencimento = date('d/m/Y', strtotime($row['data_validade']));
        $vencimentosTreinamentos[] = [
            'tipo' => 'Treinamento',
            'mensagem' => "Treinamento de {$row['nome_colaborador']} vence em $data_vencimento"
        ];
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

<!-- Conteúdo -->
<div class="container my-5">
    <h1 class="text-center mb-4">Bem-vindo ao Sistema de Controle de Funcionários</h1>

    <!-- Botões de Navegação -->
    <div class="d-flex flex-column flex-sm-row justify-content-center gap-3 mb-4">
        <a href="cadastrar_funcionario.php" class="btn btn-primary w-100 w-sm-auto">Cadastrar Funcionário</a>
        <a href="cadastro_cliente.php" class="btn btn-primary w-100 w-sm-auto">Cadastrar Cliente</a>
        <a href="cadastrar_treinamento.php" class="btn btn-primary w-100 w-sm-auto">Cadastrar Treinamento</a>
        <a href="cadastrar_vacina.php" class="btn btn-primary w-100 w-sm-auto">Registrar Vacinação</a>
        <a href="avisos.php" class="btn btn-primary w-100 w-sm-auto">Ver Avisos</a>
        <a href="menu.php" class="btn btn-dark w-100 w-sm-auto">Menu</a>
    </div>

    <!-- Exibição dos Avisos -->
    <div class=" text-center mb-4">
  <h3 class="text-white">Avisos do Mês</h3>
</div>
    <!-- Avisos em cards -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        <?php foreach ($avisos as $aviso): ?>
            <div class="col">
                <div class="card shadow-sm border-info">
                    <div class="card-body">
                        <h5 class="card-title text-info"><?php echo $aviso['tipo']; ?></h5>
                        <p class="card-text"><?php echo $aviso['mensagem']; ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>

<!-- Bootstrap 5 JS e dependências -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
