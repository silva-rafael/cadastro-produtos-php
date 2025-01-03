<?php
// index.php - Lista todos os produtos
require_once 'config/Database.php';
require_once 'class/Produto.php';

$database = new Database();
$db = $database->getConnection();
$produto = new Produto($db);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistema de Produtos</title>
    <link href="<https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css>" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Lista de Produtos</h1>
        <a href="create.php" class="btn btn-success mb-3">Novo Produto</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $produto->read();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    echo "<tr>";
                    echo "<td>{$id}</td>";
                    echo "<td>{$nome}</td>";
                    echo "<td>{$descricao}</td>";
                    echo "<td>R$ {$preco}</td>";
                    echo "<td>{$quantidade}</td>";
                    echo "<td>";
                    echo "<a href='update.php?id={$id}' class='btn btn-primary btn-sm'>Editar</a> ";
                    echo "<a href='delete.php?id={$id}' class='btn btn-danger btn-sm' onclick='return confirm(\"Tem certeza?\")'>Excluir</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>