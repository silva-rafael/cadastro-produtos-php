<?php
// create.php - Formulário para criar novo produto
require_once 'config/Database.php';
require_once 'class/Produto.php';

if($_POST){
    $database = new Database();
    $db = $database->getConnection();
    $produto = new Produto($db);

    $produto->nome = $_POST['nome'];
    $produto->descricao = $_POST['descricao'];
    $produto->preco = $_POST['preco'];
    $produto->quantidade = $_POST['quantidade'];

    if($produto->create()){
        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Criar Produto</title>
    <link href="<https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css>" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Criar Novo Produto</h1>
        <form method="post">
            <div class="mb-3">
                <label>Nome:</label>
                <input type="text" name="nome" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Descrição:</label>
                <textarea name="descricao" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label>Preço:</label>
                <input type="number" name="preco" step="0.01" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Quantidade:</label>
                <input type="number" name="quantidade" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Criar</button>
            <a href="index.php" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
</body>
</html>
