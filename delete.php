<?php
// delete.php - Script para deletar produto
require_once 'config/Database.php';
require_once 'class/Produto.php';

if(isset($_GET['id'])){
    $database = new Database();
    $db = $database->getConnection();
    $produto = new Produto($db);

    $produto->id = $_GET['id'];

    if($produto->delete()){
        header("Location: index.php");
    }
}
?>