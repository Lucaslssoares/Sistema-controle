document.getElementById('exportarExcel').addEventListener('click', function() {
    var tabela = document.getElementById('tabelaClientes');
    var rows = Array.from(tabela.rows);
    
    // Remover a última coluna (ações) antes de exportar
    rows.forEach(function(row) {
        row.deleteCell(row.cells.length - 1); // Remove a última coluna de cada linha
    });

    // Usar a biblioteca SheetJS para gerar o Excel
    var wb = XLSX.utils.table_to_book(tabela, {sheet: "Clientes"});
    XLSX.writeFile(wb, "relatorio_clientes.xlsx");

    // Re-adicionar a coluna "Ações" após exportação (se necessário)
    rows.forEach(function(row) {
        var td = row.insertCell(row.cells.length);
        td.innerHTML = ''; // Ou algo como: 'Ações';
    });
});