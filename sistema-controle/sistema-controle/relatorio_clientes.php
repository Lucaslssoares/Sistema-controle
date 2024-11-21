<?php
include 'db.php';

if (!$pdo) {
    die("Conexão com o banco de dados não estabelecida.");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Clientes</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="css\relatorio.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.2/xlsx.full.min.js"></script>  <!-- Incluindo a biblioteca SheetJS -->
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
                <a class="nav-link" href="relatorio_clientes.php">Relatório</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="text-center">Relatório de Clientes</h2>
    <button onclick="window.print()" class="btn btn-secondary mb-3">Imprimir Relatório</button>
    <button id="exportarExcel" class="btn btn-success mb-3">Exportar para Excel</button> <!-- Botão para exportação -->
    <div class="table-responsive">
        <table class="table table-striped" id="tabelaClientes">
            <thead>
                <tr>
                    <th>Nome do Cliente</th> 
                    <th>Código do Rep</th>
                    <th>Descrição</th>
                    <th>Série Rep</th>
                    <th>Indelével Rep</th>
                    <th>Número de Registro</th>
                    <th>Número do Chamado</th>
                    <th>Valor do Orçamento</th>
                    <th>Nota de Envio</th>
                    <th>Valor do Frete</th>
                    <th>Nota de Recebimento</th>
                    <th>Status</th>
                    <th class="acao-col">Ações</th> <!-- Coluna de ações com classe para ocultar na impressão -->
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM clientes";
                $stmt = $pdo->query($query);

                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>{$row['nome_cliente']}</td>"; 
                        echo "<td>{$row['codigo_rep']}</td>";
                        echo "<td>{$row['descricao']}</td>";
                        echo "<td>{$row['serie_rep']}</td>";
                        echo "<td>{$row['indelevel_rep']}</td>";
                        echo "<td>{$row['numero_registro']}</td>";
                        echo "<td>{$row['numero_chamado']}</td>";
                        echo "<td>{$row['valor_orcamento']}</td>";
                        echo "<td>{$row['nota_envio']}</td>";
                        echo "<td>{$row['valor_frete']}</td>";
                        echo "<td>{$row['nota_recebimento']}</td>";
                        echo "<td>{$row['status']}</td>";
                        echo "<td class='acao-col'>
                                <a href='editar_cliente.php?id={$row['id']}' class='btn btn-warning btn-sm'>Editar</a>
                                <a href='excluir_cliente.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Tem certeza que deseja excluir este cliente?\")'>Excluir</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='13' class='text-center'>Nenhum cliente encontrado.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Script para exportar para Excel -->
<script src="js/relatorio_clientes.js"></script>

</body>
</html>
