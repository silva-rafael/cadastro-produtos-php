<?php
// update.php - Formulário para atualizar produto
require_once 'config/Database.php';
require_once 'class/Produto.php';

$database = new Database();
$db = $database->getConnection();
$produto = new Produto($db);

if($_POST){
    $produto->id = $_POST['id'];
    $produto->nome = $_POST['nome'];
    $produto->descricao = $_POST['descricao'];
    $produto->preco = $_POST['preco'];
    $produto->quantidade = $_POST['quantidade'];

    if($produto->update()){
        header("Location: index.php");
    }
}

$produto->id = isset($_GET['id']) ? $_GET['id'] : die('ID não encontrado');
$produto->readOne();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Atualizar Produto</title>
    <link href="<https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css>" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Atualizar Produto</h1>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $produto->id; ?>">
            <div class="mb-3">
                <label>Nome:</label>
                <input type="text" name="nome" value="<?php echo $produto->nome; ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Descrição:</label>
                <textarea name="descricao" class="form-control"><?php echo $produto->descricao; ?></textarea>
            </div>
            <div class="mb-3">
                <label>Preço:</label>
                <input type="number" name="preco" value="<?php echo $produto->preco; ?>" step="0.01" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Quantidade:</label>
                <input type="number" name="quantidade" value="<?php echo $produto->quantidade; ?>" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar</button>
            <a href="index.php" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
</body>
</html>