<?php

class Produto{
    public $id;
    public $nome;
    public $preco;
    public $quantidade;
    public $categoria_id;

    public function __construct($id = false){
        if($id){
            $this->id = $id;
            $this->carregar();
        }
    }

    public static function listar(){
        $query = "select p.id, p.nome, p.preco, p.quantidade, p.categoria_id, c.nome as categoria_nome
                  from produtos p
                  inner join categorias c on p.categoria_id = c.id
                  order by p.nome";
        $conexao = Conexao::conectar();
        $resultado = $conexao->query($query);
        $lista = $resultado->fetchAll();
        return $lista;
    }
    
    public static function listarPorCategoria($categoria_id){
        $query = "select id, nome, preco, quantidade from produtos
                  where categoria_id = :categoria_id";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(":categoria_id", $categoria_id);
        $stmt->execute();
        return $stmt->fetchAll(); 
    }

    public function inserir(){
        $query = "insert into produtos (nome, preco, quantidade, categoria_id) 
                  values (:nome, :preco, :quantidade, :categoria_id)";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':nome', $this->nome);
        $stmt->bindValue(':preco', $this->preco);
        $stmt->bindValue(':quantidade', $this->quantidade);
        $stmt->bindValue(':categoria_id', $this->categoria_id);
        $stmt->execute();
    }

    public function atualizar(){
        $query = "update produtos set nome = :nome, preco = :preco, quantidade = :quantidade, categoria_id = :categoria_id where id = :id";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(":nome", $this->nome);
        $stmt->bindValue(":preco", $this->preco);
        $stmt->bindValue(":quantidade", $this->quantidade);
        $stmt->bindValue(":categoria_id", $this->categoria_id);
        $stmt->bindValue(":id", $this->id);
        $stmt->execute();
    }

    public function carregar(){
        $query = "SELECT nome, preco, quantidade, categoria_id FROM produtos where id=:id";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(":id", $this->id);
        $stmt->execute();
        $lista = $stmt->fetch();
        $this->nome = $lista['nome'];
        $this->preco = $lista['preco'];
        $this->quantidade = $lista['quantidade'];
        $this->categoria_id = $lista['categoria_id'];
    }

    public function deletar(){
        $query = "delete from produtos where id=:id";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(":id", $this->id);
        $stmt->execute();
    }
}