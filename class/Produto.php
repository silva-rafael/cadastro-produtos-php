<?php
class Produto{
    private $conn;
    private $table_name = "produtos";

    public $id;
    public $nome;
    public $descricao;
    public $preco;
    public $quantidade;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    //criar produtos
    public function create() {
        $query = "INSERT INTO ". $this->table_name ." SET nome=:nome, descricao=:descricao, preco=:preco, quantidade=:quantidade";
        $stmt = $this->conn->prepare($query);

        //limpar e sanitizar os dados
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));
        $this->preco = htmlspecialchars(strip_tags($this->preco));
        $this->quantidade = htmlspecialchars(strip_tags($this->quantidade));

        //bind dos valores
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":descricao", $this->descricao);
        $stmt->bindParam(":preco", $this->preco);
        $stmt->bindParam(":quantidade", $this->quantidade);

        if($stmt->execute()){
            return true;
        }
        return false;
        
    }

    // Ler todos os produtos
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

        // Ler um produto específico
        public function readOne() {
            $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 0,1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $this->id);
            $stmt->execute();
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->nome = $row['nome'];
            $this->descricao = $row['descricao'];
            $this->preco = $row['preco'];
            $this->quantidade = $row['quantidade'];
        }
    
        // Atualizar produto
        public function update() {
            $query = "UPDATE " . $this->table_name . "
                    SET nome = :nome,
                        descricao = :descricao,
                        preco = :preco,
                        quantidade = :quantidade
                    WHERE id = :id";
    
            $stmt = $this->conn->prepare($query);
    
            // Limpar e sanitizar dados
            $this->nome = htmlspecialchars(strip_tags($this->nome));
            $this->descricao = htmlspecialchars(strip_tags($this->descricao));
            $this->preco = htmlspecialchars(strip_tags($this->preco));
            $this->quantidade = htmlspecialchars(strip_tags($this->quantidade));
            $this->id = htmlspecialchars(strip_tags($this->id));
    
            // Bind dos valores
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":descricao", $this->descricao);
            $stmt->bindParam(":preco", $this->preco);
            $stmt->bindParam(":quantidade", $this->quantidade);
            $stmt->bindParam(":id", $this->id);
    
            if($stmt->execute()) {
                return true;
            }
            return false;
        }
    
        // Deletar produto
        public function delete() {
            $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            
            $this->id = htmlspecialchars(strip_tags($this->id));
            $stmt->bindParam(":id", $this->id);
    
            if($stmt->execute()) {
                return true;
            }
            return false;
        }

}